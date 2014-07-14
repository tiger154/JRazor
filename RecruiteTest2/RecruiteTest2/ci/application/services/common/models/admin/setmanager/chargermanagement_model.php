<?
	class ChargerManagement_model extends CI_Model
	{
		
		function getManagerTypeList($arg)
		{
			$query = 'SELECT CD_CD CODE
											,CD_NM NAME
									FROM TBL_CODE
								 WHERE CD_GB = ?
								   AND USE_YN = ?
								   AND DEL_YN = ?';
			return $this->db->query($query , $arg);
		}
		
		function getManagerList($arg,$type)
    {
    
     	   $query = 'SELECT * 
		  						   FROM (SELECT MANAGER_ID
																 ,MANAGER_NM
																 ,B.CD_NM  MANAGER_TP
																 ,A.USE_YN
																 ,DEPT
																 ,PSTN
																 ,MOBILE
																 ,TEL
																 ,EMAIL
																 ,REPLACE(CONVERT(VARCHAR(10),REG_DT,121),\'-\',\'/\') REG_DT
																 ,ROW_NUMBER() OVER (ORDER BY MANAGER_NM) ROW_NUM
																 ,COUNT(*) OVER() ALL_LIST_COUNT
														 FROM TBL_MANAGER A
														 JOIN TBL_CODE B
														   ON A.MANAGER_TP = B.CD_CD
												    WHERE COMP_ID = ? ';
				if ($arg[1] != null)
				{
					
					if ($type == 'MANAGER_ID') $query .= ' AND A.MANAGER_ID like ? ';
					if ($type == 'MANAGER_NM') $query .= ' AND A.MANAGER_NM like ? ';
				}		      
				$query .= 'AND B.DEL_YN = \'N\' AND B.USE_YN = \'Y\'
												      AND B.CD_GB = \'ADM\'
										  	      AND A.DEL_YN = ?) RTABLE
								  WHERE ROW_NUM >= ? and ROW_NUM <= ?';
				
				if (!$arg[1])
				{
					array_splice($arg,1,1);
				}
				
    	return $this->db->query($query , $arg);
    }
    
    function getManagerView($arg)
    {
			$query = 'SELECT MANAGER_ID
										  ,MANAGER_PW
										  ,MANAGER_NM
										  ,USE_YN
										  ,PSTN
										  ,TEL
										  ,MOBILE
										  ,DEPT
										  ,EMAIL
										  ,MANAGER_TP
								  FROM TBL_MANAGER
								 WHERE COMP_ID = ?
								   AND MANAGER_ID = ?
								   AND DEL_YN = ?';
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
																					,EMAIL)
															 		  VALUES(?,?,?,?,?,?,?,?,?,?)';
			return $this->db->query($query , $arg);	
   }
   
   function checkManagerId($arg)
   {
   	$query = 'SELECT MANAGER_ID
   	   					FROM TBL_MANAGER
   	   				 WHERE MANAGER_ID = ?';
   	return $this->db->query($query , $arg);	
   }
   
  }