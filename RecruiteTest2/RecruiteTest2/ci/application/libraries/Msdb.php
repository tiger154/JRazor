<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
@Class Name: Msdb Class
@Description: This class allows you to use MSSQL stored procedures with codeigniter without altering the db class.
@authors: noadek, tbenjis, sam
@Email: noadek@yahoo.co.uk, t.visualb@hotmail.com

Example:

put this class in your application/library folder and load the class in the usual way:

	//$this->load->library('msdb');

in model or controller assign the result to a variable. Note the result is an array:
To select data use:

	//$result = $this->msdb->output('SP_Name', array('Param1'=>1, 'Param2'=>2), 'SELECT');

To execute any other query e.g. insert, update, delete...

	//$result = $this->msdb->output('SP_Name', array('Param1'=>1, 'Param2'=>2), 'EXECUTE');
	
Sample stored procedure:

	//	Alter Procedure [dbo].[SP_Name]
	//	@Param1 int, @Param2 varchar(500)
	//	As
	//	
	//	BEGIN
	//	
	//		Select
	//			*
	//		From
	//			Table_Name
	//		Where FieldName1 = @Param1 And FieldName2 = @Param2  
	//	
	//	End

use printf($result) in your view to see the returned array

NOTE: When inserting or updating a field with data type TEXT in your table parse the parameter as shown:

	//$result = $this->msdb->output('SP_Name', array('Param1||'=>1, 'Param2'=>2), 'EXECUTE');
	
	Param1 here is of data type TEXT.

*/

class Msdb{
	
	// stored procedure that gets data or perform a request
	var $sp;
	
	// array that contains array of the parameters required by the stored procedure
	var $params;
	
	// determines the action to be performed by the stored procedure, either a select call or execute call.
	var $action; // or EXECUTE
	
		
	public function output($sp_, $params_ = array(), $action_ = 'SELECT')
	{
		$this->sp = $sp_;
		$this->params = $params_;
		$this->action = $action_;
			
		return $this->get_result();
	}
	
	// returns an array of the result of the stored procedure
	private	function get_result()
	{
		$result = array();
		
		switch($this->action){
		
			case 'SELECT':
					$result = $this->select($this->sp, $this->params);
				break;
			case 'EXECUTE':
					$result = $this->execute($this->sp, $this->params);
				break;
		}
		
		return $result;
	}
	
	
	// selects data from a database and returns an array of the selected data
	private	function select($sp_, $params_)
	{
		$resultset = array();
		$rsp = $this->selectRecord($sp_, $params_);
		$rspcount = count($rsp);
		
		if($rspcount > 0 && $rsp[0]["ExecStatus"] != "false"){
			
			$resultset = $rsp;
		}
		
		return $resultset;
	}
	
	
	// executes a stored procedure and returns a true if successful and false otherwise
	private	function execute($sp_, $params_)
	{
		$bool = false;
		$rsp = $this->execQuery($sp_, $params_);
		$rspcount = count($rsp);
		
		if($rspcount>0 && $rsp["ExecStatus"] != "false")
		{
			$bool = true;
		}	
		
		return $bool;	
	}
	
	private	function execQuery($sPName,$Parameters = NULL,$isAuto = NULL){
		$sp = mssql_init($sPName); // stored procedure name
		
		if (!empty($Parameters)):
			foreach ($Parameters as $key => $value) {
				$key = $key;
				$$key = $this->formValidation($value);
				///SQLTEXT will soon be deprecated and hence it is advisable to use VARCHAR(MAX)
		
				$tpar = explode("||",$key);
				
				if (isset($tpar[1]) && @$tpar[1] != ''){
					if ($tpar[1] == "SQLTEXT"){ $dtype = SQLTEXT; }
					
				}else{
					$dtype = SQLVARCHAR;
				}
				//echo $tpar[0];
				//echo $dtype;
				//mssql_bind($sp,"@".$tpar[0], $$key, $dtype,false,false,20);
				mssql_bind($sp,"@".$tpar[0], $$key, $dtype);
			}
		endif;
	
		
		if ($result = mssql_execute($sp)):
			$autoid = "";
			
			if ($isAuto == 'true'){
				$autoidsql = mssql_query("select @@IDENTITY as aid");
				$autoid = mssql_result($autoidsql,0,"aid");}
			$returnresult = array("ExecStatus" => "true","autoid" => $autoid);
		else:
			$returnresult = array("ExecStatus" => "false");
		endif;
	
		return $returnresult;
	}
	
	
	private	function selectRecord($sPName,$Parameters = NULL){
		
		$sp = mssql_init($sPName); ///my stored procedure name
		
		if (!empty($Parameters)):
			foreach ($Parameters as $key => $value) {
				$key = $key;
				$$key = $this->formValidation($value);
				
				mssql_bind($sp,"@".$key, $$key, SQLVARCHAR,false,false,20);
			}
		endif;
	
	
	
		if ($resultquery = mssql_execute($sp)):
			if (@mssql_num_rows($resultquery) > 0):
				$totalrows = mssql_num_rows($resultquery);
				$arraycounter = 0;
				//echo mysql_num_fields($resultquery);
				//echo mysql_field_name($resultquery,0);
				$stringname=array();
				$stringvalue=array();
				//$arraystring=array("AffectedRows" => mysql_num_fields($resultquery));
				$arraystring=array();
				while($resultarray = mssql_fetch_array($resultquery)):
					for ($i = 0; $i <= mssql_num_fields($resultquery)-1; $i++) {
					   $fieldname = mssql_field_name($resultquery,$i);
					   array_push($stringname,$fieldname);
					   array_push($stringvalue,$resultarray[$fieldname]);
					}
					   array_push($stringname,"AffectedRows");
					   array_push($stringvalue, $totalrows);
	
					   array_push($stringname,"ExecStatus");
					   array_push($stringvalue, "true");
					   
						array_push($arraystring, array_combine($stringname,$stringvalue));
						$stringname=array();
						$stringvalue=array();
						//print_r($arraystring);
				endwhile;
				//$arraystring = array($arraystringall);
			else:
				$arraystring = array(0=>array("ExecStatus" => "false"));
			endif;
		else:
			$arraystring = array(0=>array("ExecStatus" => "false"));
		endif;
	
	
		return $arraystring;
	}
	
	private	function formValidation($theValue)
	{
		//$theValue = get_magic_quotes_gpc() ? stripslashes($theValue) : $theValue;
		//$theValue = htmlspecialchars($theValue, ENT_QUOTES );
		//$theValue = preg_replace("/[^\x9\xA\xD\x20-\x7F]/", "", $theValue);
		
		return $theValue;
	}
}

/*
End of File
*/
