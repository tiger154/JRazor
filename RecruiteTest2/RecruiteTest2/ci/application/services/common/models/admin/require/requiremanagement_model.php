<?
	class Requiremanagement_model extends CI_Model
	{
	
		function getResumeCodeList($arg)
		{
			$query = 'SELECT TOP 1 RSM_IDX
							    FROM TBL_UNIT_RESUME
							   WHERE PRJ_IDX = ? ';
			if ($arg[1] != null) $query .= ' AND UNIT_IDX = ? ';
			$query .= ' AND DEL_YN = ? ';
			
			if (!$arg[1]) array_splice($arg,1,1);
			return $this->db->query($query, $arg);
		}
	
		function getResumeFormList($arg)
    {
    	  $query = 'SELECT PERSONAL_USE_YN
												,EDUCATION_USE_YN
												,TECH_USE_YN
												,LANGUAGE2_USE_YN
												,WRITE_USE_YN
												,FAMILY_USE_YN
												,SCHOOL_USE_YN
												,CAREER_USE_YN
												,LANGUAGE_USE_YN
												,LICENSE_USE_YN
												,ARMY_USE_YN
												,TRAINING_USE_YN
												,SERVE_USE_YN
												,PRIZE_USE_YN
												,PC_USE_YN
												,CONTENT_USE_YN
												,FILE_USE_YN
								    FROM TBL_RESUME_FORM
								   WHERE COMP_ID = ?
								     AND PRJ_IDX = ?
								     AND RSM_IDX = ?
								     AND DEL_YN = ?';
    	return $this->db->query($query, $arg);
    }
 
    function getResumeFormLanguageList($arg)
    {
    	 $query = 'SELECT *
									 FROM ( SELECT A.LAN_IDX 
															  ,B.LAN_NM
															  ,(SELECT CD_NM FROM TBL_CODE X WHERE X.CD_GB = \'LAN\' AND X.CD_IDX = B.CD_IDX AND USE_YN = \'Y\' AND DEL_YN = \'N\' ) LANG_TP_NM
															  ,(SELECT CD_NM FROM TBL_CODE X WHERE X.CD_GB = \'LNT\' AND X.CD_IDX = B.SCORE_TP AND USE_YN = \'Y\' AND DEL_YN = \'N\' ) SCORE_TP_NM
															  ,SCORE_TP 
															  ,ORD
													  FROM TBL_RESUME_FORM_LANGUAGE A
													  JOIN TBL_CODE_LANGUAGE B
														  ON A.LAN_IDX = B.LAN_IDX
												   WHERE RSM_IDX = ?
													   AND A.DEL_YN = ?
													   AND B.DEL_YN = ?) X
			  LEFT OUTER JOIN (SELECT LAN_IDX SELECTED_LAN_IDX
													     ,CONVERT(VARCHAR(10),LAN_STDT,121) LAN_STDT
													     ,CONVERT(VARCHAR(10),LAN_EDDT,121) LAN_EDDT
													     ,SCORE_TP SCORE_TP_NUM
													     ,LAN_LVL_IDX
													 FROM TBL_REQUIRE_LANGUAGE
													WHERE REQ_IDX = ?
													  AND DEL_YN = ?) Y
										 ON X.LAN_IDX = Y.SELECTED_LAN_IDX
							 ORDER BY ORD';
			return $this->db->query($query, $arg);						 
    }
    
    function getLanguageLevelList($arg)
	 	{
	 		$query = 'SELECT LAN_LVL_IDX CODE
										  ,LVL_NM NAME
								  FROM TBL_CODE_LANGUAGE_LVLLIST
								 WHERE LAN_IDX = ?
								   AND DEL_YN = ?';
	 		return $this->db->query($query, $arg);
	 	}
	 	
	 	function getCodeList($arg)
	 	{
	 		$query = 'SELECT CD_IDX CODE
										  ,CD_NM NAME
								  FROM TBL_CODE 
								 WHERE CD_GB = ?
								   AND USE_YN = ?
								   AND DEL_YN = ?';
			return $this->db->query($query, $arg);
	 	}
	 	
	 	function getRequireList($arg)
	 	{
			 $query = 'SELECT B.REQ_IDX
										   ,CONVERT(VARCHAR(10) , B.PSNR_NAI_STDT,121) PSNR_NAI_STDT
										   ,CONVERT(VARCHAR(10) , B.PSNR_NAI_EDDT,121) PSNR_NAI_EDDT
										   ,CONVERT(VARCHAR(10) , B.SCHL_STDT,121) SCHL_STDT
										   ,B.SCHL_SCT_CD
										   ,B.SCHL_SCORE_TP
										   ,B.SCHL_SCORE
										   ,CONVERT(VARCHAR(10) , B.ARMY_STDT,121) ARMY_STDT
								   FROM TBL_UNIT_REQUIRE A
								   JOIN TBL_REQUIRE B
								     ON A.REQ_IDX = B.REQ_IDX
								  WHERE PRJ_IDX = ? 
								    AND UNIT_IDX = ?
								    AND B.RSM_IDX = ?
								    AND A.DEL_YN = ?
								    AND B.DEL_YN = ?';
			return $this->db->query($query, $arg);
		}
		
		function getUnitRequireSameList($arg)
		{
			$query = 'SELECT UNIT_IDX
								  FROM TBL_UNIT_REQUIRE
								 WHERE PRJ_IDX = ?
								   AND REQ_IDX = ?
								   AND DEL_YN = ?';
			return $this->db->query($query, $arg);
		}
		
		function getUnitRequireUpdate($arg)
		{
			return $this->msdb->output('setCommonRequireProcess', $arg, 'SELECT'); 
		}
   	
   	function getUnitRequireLanguageUpdate($arg)
   	{
   		$query = 'MERGE INTO TBL_REQUIRE_LANGUAGE AS T
										 USING (SELECT ? REQ_IDX, ? LAN_IDX) S
												ON (S.REQ_IDX = T.REQ_IDX
										   AND  S.LAN_IDX = T.LAN_IDX)
										  WHEN MATCHED THEN
										UPDATE SET LAN_STDT = CONVERT(DATETIME,?)
												  ,LAN_EDDT = CONVERT(DATETIME,?)
												  ,SCORE_TP = ?
												  ,LAN_LVL_IDX = ?
										  WHEN NOT MATCHED THEN  
										INSERT (REQ_IDX,LAN_IDX,LAN_STDT,LAN_EDDT,SCORE_TP,LAN_LVL_IDX)
										VALUES (?,?,CONVERT(DATETIME,?),CONVERT(DATETIME,?),?,?);';
 		return $this->db->query($query, $arg);
   	}
   	
  }