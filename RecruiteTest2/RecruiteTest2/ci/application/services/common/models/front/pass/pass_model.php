<?
	class Pass_model extends CI_Model
	{
		
		function getAdminPassFlag($arg)
		{
			$query = 'SELECT PRJ_IDX
								  FROM TBL_PROJECT 
								 WHERE PRJ_IDX = ? 
								   AND PASSWD = ?
								   AND DEL_YN = \'N\'';
			return $this->db->query($query,$arg);
		}
		
		function getPassInfoList($arg)
    {
    	$query = 'SELECT APPLY_NO
										  ,GUBUN
										  ,APPLY_NM
										  ,STEP_IDX
										  ,ETC1VAR
										  ,ETC1VALUE
										  ,(SELECT FRM_CNTNT
												  FROM TBL_STEP_DATA_FORM R
												 WHERE PRJ_IDX = TBL.PRJ_IDX
												   AND STEP_IDX = TBL.STEP_IDX
												   AND GUBUN = TBL.GUBUN
												   AND DEL_YN = \'N\' ) FRM_CNTNT
								  FROM TBL_STEP_DATA TBL
								 WHERE PRJ_IDX = ?
								   AND EXISTS ( SELECT 1
																  FROM (SELECT ROW_NUMBER() OVER (ORDER BY STEP_IDX) ORD
																						  ,STEP_IDX
																						  ,STEP_STDT
																						  ,STEP_EDDT
																				  FROM TBL_STEP
																				 WHERE PRJ_IDX = ?
																				   AND STEP_STDT <= GETDATE()
																				   AND STEP_EDDT >= GETDATE()
																				   AND DEL_YN = ?) RES
																		 WHERE ORD = 1
																		   AND STEP_IDX = TBL.STEP_IDX ) 
								   AND EXISTS (  SELECT 1
																   FROM TBL_APPLY AA
																   JOIN TBL_APPLY_PERSONAL BB
																	 ON AA.PRJ_IDX = BB.PRJ_IDX
																	AND AA.APPL_IDX = BB.APPL_IDX 
																  WHERE AA.PRJ_IDX = ?
																	AND NAMEKOR = ?
																	AND USER_PW = ?
																	AND BB.HTEL = ?
																	AND AA.DEL_YN = ?
																	AND AA.APPLY_NO = TBL.APPLY_NO  )
									AND EXISTS ( SELECT 1
															   FROM TBL_COMPANY CA
															   JOIN TBL_PROJECT CB
															     ON CA.COMP_ID = CB.COMP_ID
															  WHERE CA.DOMAIN_ID = ?
															    AND CB.PRJ_IDX = TBL.PRJ_IDX
															    AND CA.DEL_YN = ?
															    AND CB.DEL_YN = ?)';
			return $this->db->query($query,$arg);
    }
    
    function getNoPassInfoList($arg)
    {
    	$query = 'SELECT APPLY_NO
										  ,GUBUN
										  ,APPLY_NM
										  ,STEP_IDX
										  ,ETC1VAR
										  ,ETC1VALUE
										  ,(SELECT FRM_CNTNT
												  FROM TBL_STEP_DATA_FORM R
												 WHERE PRJ_IDX = TBL.PRJ_IDX
												   AND STEP_IDX = TBL.STEP_IDX
												   AND GUBUN = TBL.GUBUN
												   AND DEL_YN = \'N\' ) FRM_CNTNT
								  FROM TBL_STEP_DATA TBL
								 WHERE PRJ_IDX = ?
								   AND STEP_IDX = ?
								   AND EXISTS (  SELECT 1
																   FROM TBL_APPLY AA
																   JOIN TBL_APPLY_PERSONAL BB
																	   ON AA.PRJ_IDX = BB.PRJ_IDX
																	  AND AA.APPL_IDX = BB.APPL_IDX 
																  WHERE AA.PRJ_IDX = ?
																    AND AA.APPLY_NO = ?
																	  AND AA.DEL_YN = \'N\'
																	  AND AA.APPLY_NO = TBL.APPLY_NO  )
									  AND EXISTS ( SELECT 1
															     FROM TBL_COMPANY CA
															     JOIN TBL_PROJECT CB
															       ON CA.COMP_ID = CB.COMP_ID
															    WHERE CA.DOMAIN_ID = ?
															      AND CB.PRJ_IDX = TBL.PRJ_IDX
															      AND CA.DEL_YN = \'N\'
															      AND CB.DEL_YN = \'N\')';
			return $this->db->query($query,$arg);
    }
   	
   	function getDataViewList($arg1,$arg2)
    {
    	
    	 $query = 'SELECT APPLY_NO
											 ,APPLY_NM' . 
											 $arg1
											 
										 . ' FROM TBL_STEP_DATA
									      WHERE PRJ_IDX = ?
									        AND STEP_IDX = ?
									        AND GUBUN = ?
									        AND APPLY_NO = ?';
    	return $this->db->query($query, $arg2);		
    }
   	
  }