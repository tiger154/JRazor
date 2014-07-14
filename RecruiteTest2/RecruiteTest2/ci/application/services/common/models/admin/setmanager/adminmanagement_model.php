<?
	class AdminManagement_model extends CI_Model
	{
	
	/*
	 EDIT : ROW_NUM CONDITION, 2013-02-25, BY WON
	  1) BEFORE(ORDER BY MANAGER_NM) -> AFTER(ORDER BY REG_DT DESC) 
	*/
	function getAdminList($arg){

    		 $query = 'SELECT * 
		  						   FROM (SELECT MANAGER_ID
																 ,MANAGER_NM
																 ,USE_YN
																 ,DEPT
																 ,PSTN
																 ,MOBILE
																 ,TEL
																 ,EMAIL
																 ,REPLACE(CONVERT(VARCHAR(10),REG_DT,121),\'-\',\'/\') REG_DT
																 ,ROW_NUMBER() OVER (ORDER BY REG_DT DESC) ROW_NUM
																 ,COUNT(*) OVER() ALL_LIST_COUNT
														 FROM TBL_MANAGER
												    WHERE MANAGER_LVL = ?
												      AND DEL_YN = ?) RTABLE
								  WHERE ROW_NUM >= ? and ROW_NUM <= ? ORDER BY REG_DT DESC' ;
								  //echo $query;
    	return $this->db->query($query , $arg);
    }
    
    	function getManagerUpdateInfo($arg)
	   {
	   	   $query = 'UPDATE TBL_MANAGER SET MANAGER_NM = ?
																				 ,MANAGER_PW = ?
																				 ,MANAGER_TP = ?
																				 ,USE_YN = ?
																				 ,PSTN = ?
																				 ,TEL = ?
																				 ,MOBILE = ?
																				 ,DEPT = ?
																				 ,EMAIL = ?
																				 ,MANAGER_LVL = \'A\'
																	  WHERE COMP_ID = ? 
																	  	AND MANAGER_ID = ?';
				return $this->db->query($query , $arg);	
	   }
	   
	   function getManagerInsertInfo($arg)
	   {
	   	    $query = 'INSERT INTO TBL_MANAGER (COMP_ID
	   	    																	,MANAGER_ID
																						,MANAGER_NM
																						,MANAGER_PW
																						,USE_YN
																						,PSTN
																						,TEL
																						,MOBILE
																						,DEPT
																						,EMAIL
																						,MANAGER_LVL)
																 		  VALUES(?,?,?,?,?,?,?,?,?,?,\'A\')';
				return $this->db->query($query , $arg);	
	   }
    
	}