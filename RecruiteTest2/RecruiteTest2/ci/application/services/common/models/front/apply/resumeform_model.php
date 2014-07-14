<?
	class ResumeForm_model extends CI_Model
	{
		
		function getResumeFormDisplayYNList($arg)
		{
			$query = '	SELECT PERSONAL_USE_YN
											  ,FAMILY_USE_YN
											  ,SCHOOL_USE_YN
											  ,CAREER_USE_YN
											  ,LANGUAGE_USE_YN
											  ,LANGUAGE2_USE_YN
											  ,LICENSE_USE_YN
											  ,ARMY_USE_YN
											  ,TRAINING_USE_YN
											  ,SERVE_USE_YN
											  ,WRITE_USE_YN
											  ,TECH_USE_YN
											  ,EDUCATION_USE_YN
											  ,PRIZE_USE_YN
											  ,PC_USE_YN
											  ,CONTENT_USE_YN
											  ,FILE_USE_YN
											  ,FAMILY_FORM_CNT
												,SCHOOL_FORM_CNT
												,CAREER_FORM_CNT
												,LICENSE_FORM_CNT
												,TRAINING_FORM_CNT
												,EDUCATION_FORM_CNT
												,SERVE_FORM_CNT
												,PRIZE_FORM_CNT
												,TECH_FORM_CNT
												,LANGUAGE2_FORM_CNT
												,WRITE_FORM_CNT
									  FROM TBL_RESUME_FORM
									 WHERE PRJ_IDX = ?
									   AND RSM_IDX = ?
									   AND DEL_YN = ?';
			return $this->db->query($query, $arg);
		}
		
		function getContentList($arg)
		{
			$query = 'SELECT GRPA.*
										  ,GRPB.APPL_CNTNT
								  FROM (SELECT ORD_NO
														  ,CNTNT_TITLE
														  ,CNTNT_COMMENT
														  ,CNTNT_ESN_YN
														  ,CNTNT_MIN_LEN
														  ,CNTNT_LEN
														  ,RSM_CNTNT_IDX
												  FROM TBL_RESUME_FORM_CONTENT 
												 WHERE RSM_IDX = ?
												   AND DEL_YN = ? ) GRPA
		   LEFT OUTER JOIN (SELECT RSM_CNTNT_IDX
														  ,APPL_CNTNT
												  FROM TBL_APPLY_CONTENT
												 WHERE PRJ_IDX = ?
												   AND APPL_IDX = ?
												   AND DEL_YN = ? ) GRPB
								    ON GRPA.RSM_CNTNT_IDX = GRPB.RSM_CNTNT_IDX 
							ORDER BY ORD_NO';
			return $this->db->query($query, $arg);
		}
		
		function getFileList($arg)
		{
			$query = 'SELECT GRPA.FILE_TITLE
											,GRPA.ORD_NO
											,GRPA.FILE_COMMENT
											,GRPA.FILE_ESN_YN
											,GRPA.FILE_MAX_SIZE
											,GRPA.RSM_FILE_IDX
											,LOWER(REPLACE(REPLACE(GRPA.FILE_AVL_EXT,\',\',\'|\'),\';\',\'|\')) FILE_AVL_EXT
										  ,GRPB.APPL_FILE_NM
										  ,GRPB.APPL_FILE_CD
										  ,GRPB.RSM_FILE_IDX SEL_RSM_FILE_IDX
								  FROM (SELECT ORD_NO
														  ,FILE_TITLE
														  ,FILE_COMMENT
														  ,FILE_ESN_YN
														  ,FILE_AVL_EXT
														  ,FILE_MAX_SIZE
														  ,RSM_FILE_IDX
												  FROM TBL_RESUME_FORM_FILE 
												 WHERE RSM_IDX = ?
												   AND DEL_YN = ? ) GRPA
		   LEFT OUTER JOIN (SELECT RSM_FILE_IDX
														  ,APPL_FILE_NM
														  ,APPL_FILE_CD
												  FROM TBL_APPLY_FILE
												 WHERE PRJ_IDX = ?
												   AND APPL_IDX = ?
												   AND DEL_YN = ? ) GRPB
								    ON GRPA.RSM_FILE_IDX = GRPB.RSM_FILE_IDX 
							ORDER BY ORD_NO';
			return $this->db->query($query, $arg);
		}
		
		function getMajorAffiliationList($arg)
		{
			$query = 'SELECT AFF_NM NAME
										  ,AFF_IDX CODE
								  FROM TBL_CODE_AFFILIATION
								 WHERE DEL_YN = ?';
			return $this->db->query($query, $arg);
		}
		
		function getLocationList($arg)
		{
			$query = 'SELECT LOC_NM NAME
										  ,LOC_IDX CODE
								  FROM TBL_CODE_LOCATION
								 WHERE DEL_YN = ?';
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
	 	
	 	function getApplyUnitList($arg)
	 	{
			$query = 'SELECT UNIT_IDX
											,ORD
									FROM TBL_APPLY_UNIT
								 WHERE PRJ_IDX = ?
								   AND APPL_IDX = ?
								   AND DEL_YN = ?';
			return $this->db->query($query,$arg);
	 	}
	 	
	 	function getComputerList($arg)
	 	{
	 		 $query ='SELECT GRPA.CPU_NM
										  ,GRPA.CD_CPU_IDX
										  ,GRPB.LVL_CD
										  ,GRPB.LVL_NM
									  FROM (SELECT B.CPU_NM
												  ,B.CD_CPU_IDX
											  FROM TBL_RESUME_FORM_COMPUTER A
											  JOIN TBL_CODE_COMPUTER B
												ON A.CD_CPU_IDX = B.CD_CPU_IDX
											 WHERE A.RSM_IDX = ?
											   AND A.DEL_YN = ?
											   AND B.DEL_YN = ?) GRPA 
						   LEFT OUTER JOIN (SELECT C.CD_CPU_IDX
												  ,C.LVL_CD
												  ,C.LVL_NM
											  FROM TBL_APPLY_COMPUTER C
											 WHERE C.PRJ_IDX = ?
											   AND C.APPL_IDX = ?
											   AND DEL_YN = ?) GRPB
								        ON GRPA.CD_CPU_IDX = GRPB.CD_CPU_IDX';
				return $this->db->query($query, $arg);
	 	}
	 	
	 	function getLanguageList($arg)
	 	{
	 		 $query ='SELECT GRPA.*
										  ,GRPB.LAN_SCORE
										  ,GRPB.LAN_LVL_IDX
										  ,CONVERT(VARCHAR(4),GRPB.LAN_DT,121) LAN_DT1
					  					,SUBSTRING(CONVERT(VARCHAR(10),GRPB.LAN_DT,121),6,2) LAN_DT2
					  					,SUBSTRING(CONVERT(VARCHAR(10),GRPB.LAN_DT,121),9,2) LAN_DT3
										  ,GRPB.LAN_FILE_CD
										  ,GRPB.LAN_FILE_NM
										  ,GRPB.LAN_NUM
									  FROM (SELECT AA.* 
															  ,BB.CD_NM -- 등급인지 , 점수인지 (명칭)
													  FROM (SELECT B.LAN_NM -- 언어시험명칭
																			  ,B.LAN_PB -- 기관
																			  ,B.CD_IDX -- 언어종류
																			  ,A.LANG_IDX -- 이력서폼_언어_idx
																			  ,A.LAN_IDX -- 언어테이블 idx
																			  ,B.SCORE_TP -- 등급인지 , 점수인지
																			  ,A.ORD
																	  FROM TBL_RESUME_FORM_LANGUAGE A
																	  JOIN TBL_CODE_LANGUAGE B
																		ON A.LAN_IDX = B.LAN_IDX
																	 WHERE A.RSM_IDX = ?
																	   AND A.DEL_YN = ?
																	   AND B.DEL_YN = ?) AA
													  JOIN TBL_CODE BB
															ON AA.SCORE_TP = BB.CD_IDX
													 WHERE BB.CD_GB = ?
													   AND BB.DEL_YN = ?) GRPA
					LEFT OUTER JOIN (SELECT LAN_IDX
																  ,RSM_LANG_IDX
																  ,LAN_SCORE
																  ,LAN_LVL_IDX
																  ,LAN_DT
																  ,LAN_NUM
																  ,LAN_FILE_CD
																  ,LAN_FILE_NM
														  FROM TBL_APPLY_LANGUAGE
														 WHERE PRJ_IDX = ?
														   AND APPL_IDX = ?
														   AND DEL_YN = ?) GRPB
									      ON GRPA.LAN_IDX = GRPB.LAN_IDX
									ORDER BY GRPA.ORD';
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
	 	
	 	function getCareerSetList($arg)
	 	{
	 		$query = 'SELECT CAREER_USE_TP
										  ,CAREER_INTRN_DIV_YN
										  ,UNIT_IDX
									  FROM TBL_RESUME_FORM_CAREER
									 WHERE RSM_IDX = ?
									   AND DEL_YN = ?';
			return $this->db->query($query, $arg);
	 	}
	 	
	 	function getCareerEmployTypeList($arg)
	 	{
	 		//print_r($arg);
	 		//echo '<br><br>';
	 		$query = 'SELECT CD_CAR_IDX CODE
										  ,CD_CAR_NM NAME
								  FROM TBL_CODE_CAREER A
								  JOIN TBL_CODE B
								    ON A.CD_CAR_TP = B.CD_IDX
							   WHERE B.CD_GB = ? ';
			if ($arg[1] != '') $query .= '    AND CD_CAR_TP = ? ';
			if ($arg[2] != '') $query .= '    AND CD_CAR_PB_YN = ? ';
	 		$query .= '    AND A.DEL_YN = ?
								     AND B.DEL_YN = ?';
			
			if (!$arg[1] && !$arg[2]) { array_splice($arg,1,2); }
			if (!$arg[1] && $arg[2])  { array_splice($arg,1,1); }
			if ($arg[1]  && !$arg[2]) { array_splice($arg,2,1); } 
		
			return $this->db->query($query, $arg);
	 	}
	 	
	 	// 모집단위에 따른 근무지 리스트 //
	 	function getWorkPlaceList($arg)
  	{
  		$query = '   SELECT GRPA.*
												 ,GRPB.ORD
												 ,GRPB.APPL_WP_IDX
								     FROM ( SELECT B.WRK_PLC_NM NAME
																  ,B.WP_IDX CODE
																  ,C.WRK_PLC_CNT
														  FROM TBL_UNIT_WORK_PLACE A 
														  JOIN TBL_WORKPLACE B
																ON A.WP_IDX = B.WP_IDX
														  JOIN TBL_UNIT_RESUME C
																ON A.PRJ_IDX = C.PRJ_IDX
														 AND A.UNIT_IDX = C.UNIT_IDX
													 WHERE B.COMP_ID = (SELECT COMP_ID FROM TBL_COMPANY WHERE DOMAIN_ID = ? AND DEL_YN = ? ) 
													   AND A.PRJ_IDX = ?
													   AND A.UNIT_IDX = ?
													   AND A.DEL_YN = ?
													   AND B.DEL_YN = ?
													   AND C.RSM_IDX = ?
													   AND C.DEL_YN = ? ) GRPA
					LEFT OUTER JOIN (SELECT WP_IDX APPL_WP_IDX
															   ,ORD
													   FROM TBL_APPLY_LOCATION
													  WHERE PRJ_IDX = ?
													    AND APPL_IDX = ?
													    AND DEL_YN = ?) GRPB
									    ON GRPA.CODE = GRPB.APPL_WP_IDX'; 
  		return $this->db->query($query,$arg);  
  	}
	 	
	 	/* S - 데이터에 저장된 지원자 정보 들고오는 부분 */
	 	
	 	function getApplyUserDataSchool($arg)
	 	{
 		  $query = 'SELECT SCH_SEQ
											,SCH_TP
											,SCH_NM
											,SCH_CD
											,SCH_LOC
											,CONVERT(VARCHAR(4),SCH_STDT,121) SCH_STDT1
										  ,SUBSTRING(CONVERT(VARCHAR(10),SCH_STDT,121),6,2) SCH_STDT2	   
											,CONVERT(VARCHAR(4),SCH_EDDT,121) SCH_EDDT1
										  ,SUBSTRING(CONVERT(VARCHAR(10),SCH_EDDT,121),6,2) SCH_EDDT2	   
										  ,SUBSTRING(CONVERT(VARCHAR(10),SCH_EDDT,121),9,2) SCH_EDDT3	   
											,SCH_ETTP1
											,SCH_ETTP2
											,SCH_JUYA
											,SCH_MAJOR_CD
											,SCH_MAJOR_NM
											,SCH_AFF
											,SCH_SUB_MAJOR_TP
											,SCH_SUB_MAJOR_CD
											,SCH_SUB_MAJOR_NM
											,SCH_SUB_AFF
											,SCH_HAKJUM
											,SCH_MAX_HAKJUM
											,SCH_ISU_HAKJUM
											,SCH_FGRD_TP
											,SCH_BRANCH_TP
							    FROM TBL_APPLY_SCHOOL
							   WHERE PRJ_IDX = ?
							     AND APPL_IDX = ?
							     AND DEL_YN = ?';
			return $this->db->query($query, $arg);
	 	}
	 	
	 	function getApplyUserData($arg)
	 	{
	 		$query = 'SELECT A.NAMEKOR
								      ,A.EMAIL
								      ,B.TEL
								      ,B.HTEL
								      ,B.NAMEENG1
								      ,B.NAMEENG2
								      ,B.MARRY_YN
								      ,B.ADDRESS1
								      ,B.ADDRESS2
								      ,SUBSTRING(B.ZIPCODE,1,3) ZIPCODE1
								      ,SUBSTRING(B.ZIPCODE,4,3) ZIPCODE2
								      ,CONVERT(VARCHAR(10),B.BIRTH_DT,121) BIRTH_DT
										  ,B.BIRTH_TP
										  ,B.NAMECHA
										  ,B.RELIGION
										  ,B.HOBBY
										  ,B.FORTE
										  ,B.BOHUN_TP_CD
										  ,B.BOHUN_TP_NM
										  ,B.BOHUN_SCORE_CD
										  ,B.BOHUN_SCORE_NM
										  ,B.BOHUN_NUM
										  ,B.PSN_HEIGHT
										  ,B.PSN_WEIGHT
										  ,B.PSN_OBSTACLE_TP_CD
										  ,B.PSN_OBSTACLE_TP_NM
										  ,B.PSN_OBSTACLE_TP_REASON
										  ,B.PSN_OBSTACLE_LVL_NM
										  ,B.PSN_OBSTACLE_LVL_CD
										  ,B.PSN_LSIGHT
										  ,B.PSN_RSIGHT
										  ,B.PSN_CLRBLND_YN
										  ,B.PSN_LOWINCOME_YN
										  ,B.PHOTO_YN
										  -- 가족사항 한로우짜리 (
										  ,A.FMLY_NONE_YN
										  
										  -- 경력기본
										  ,A.CAREER_TP 
										  ,CASE A.CAREER_TERM / 12 WHEN 0 THEN NULL ELSE A.CAREER_TERM / 12 END CAREER_TERM1
										  ,CASE A.CAREER_TERM % 12 WHEN 0 THEN NULL ELSE A.CAREER_TERM % 12 END CAREER_TERM2
										  ,A.FOREIGN_CAREER_YN 
										  ,CASE A.FOREIGN_CAREER_TERM / 12 WHEN 0 THEN NULL ELSE A.FOREIGN_CAREER_TERM / 12 END FOREIGN_CAREER_TERM1
										  ,CASE A.FOREIGN_CAREER_TERM % 12 WHEN 0 THEN NULL ELSE A.FOREIGN_CAREER_TERM % 12 END FOREIGN_CAREER_TERM2
										  ,CASE A.EMP_INSUR_TERM / 12 WHEN 0 THEN NULL ELSE A.EMP_INSUR_TERM / 12 END EMP_INSUR_TERM1
										  ,CASE A.EMP_INSUR_TERM % 12 WHEN 0 THEN NULL ELSE A.EMP_INSUR_TERM % 12 END EMP_INSUR_TERM2
										  
										  -- 병역기본
										  ,C.ARMY_YN_CD
										  ,C.ARMY_YN_NM
										  ,C.ARMY_TP_NM
										  ,C.ARMY_TP_CD
										  ,C.ARMY_LVL_NM
										  ,C.ARMY_LVL_CD
										  ,C.ARMY_FINISH_NM
										  ,C.ARMY_FINISH_CD
										  ,CONVERT(VARCHAR(10),C.ARMY_STDT,121) ARMY_STDT
										  ,CONVERT(VARCHAR(10),C.ARMY_EDDT,121) ARMY_EDDT
										  ,C.ARMY_REASON
										  ,C.ARMY_TERM_NM
										  ,C.ARMY_TERM_CD
								  FROM TBL_APPLY A
								  JOIN TBL_APPLY_PERSONAL B
								    ON A.PRJ_IDX = B.PRJ_IDX
								   AND A.APPL_IDX = B.APPL_IDX
			 LEFT OUTER JOIN TBL_APPLY_ARMY C
								    ON A.PRJ_IDX = C.PRJ_IDX
								   AND A.APPL_IDX = C.APPL_IDX
								 WHERE A.PRJ_IDX = ?
								   AND A.APPL_IDX = ?
								   AND A.DEL_YN = ?
								   AND B.DEL_YN = ?';
			return $this->db->query($query, $arg);
	 	}
	 	
	 	function getApplyUserDataFamily($arg)
	 	{
		 		$query = 'SELECT FMLY_SEQ
											  ,FMLY_REL_CD
											  ,FMLY_REL_NM
											  ,FMLY_NM
											  ,FMLY_NAI
											  ,FMLY_SCH_NM
											  ,FMLY_SCH_CD
											  ,FMLY_JOB
											  ,FMLY_WRK_NM
											  ,FMLY_WRK_PSTN
											  ,FMLY_LIVE_YN
											  ,FMLY_HELP_YN
									  FROM TBL_APPLY_FAMILY 
									 WHERE PRJ_IDX = ?
									   AND APPL_IDX = ?
									   AND DEL_YN = ?	
								ORDER BY FMLY_SEQ';
				return $this->db->query($query, $arg);
	 	}
	 	
	 	
	 	function getApplyUserDataCareer($arg)
	 	{
		 		$query = 'SELECT CAREER_SEQ
												,CONVERT(VARCHAR(4),CAREER_STDT,121) CAREER_STDT1
												,SUBSTRING(CONVERT(VARCHAR(7),CAREER_STDT,121),6,2) CAREER_STDT2
												,CONVERT(VARCHAR(4),CAREER_EDDT,121) CAREER_EDDT1
												,SUBSTRING(CONVERT(VARCHAR(7),CAREER_EDDT,121),6,2) CAREER_EDDT2
												,CAREER_STS_NM
												,CAREER_STS_CD
												,CAREER_CMP_NM
												,CAREER_CMP_TP_NM
												,CAREER_CMP_TP_CD
												,CAREER_JOB_TP_NM
												,CAREER_JOB_TP_CD
												,CAREER_DEPT_NM
												,CAREER_PSTN_NM
												,CAREER_PSTN_CD
												,CAREER_CNTNT
												,CAREER_RETIRE_NM
												,CAREER_RETIRE_CD
												,CAREER_LOC_NM
												,CAREER_LOC_CD
												,CAREER_CMP_CD
												,CAREER_PSTN_LVL_NM
												,CAREER_PSTN_LVL_CD
												,CAREER_EMP_TP_CD
												,CAREER_EMP_TP_NM	
								    FROM TBL_APPLY_CAREER
								   WHERE PRJ_IDX = ?
								     AND APPL_IDX = ?
								     AND DEL_YN = ?
								ORDER BY CAREER_SEQ ';
				return $this->db->query($query, $arg);
	 	}
	 	function getApplyUserDataWrite($arg)
	 	{
	 		$query = 'SELECT WRT_SEQ	
										  ,WRT_NM
										  ,WRT_PB
										  ,CONVERT(VARCHAR(4),WRT_DT,121) WRT_DT1
										  ,SUBSTRING(CONVERT(VARCHAR(10),WRT_DT,121),6,2) WRT_DT2
										  ,SUBSTRING(CONVERT(VARCHAR(10),WRT_DT,121),9,2) WRT_DT3
								  FROM TBL_APPLY_WRITE
								 WHERE PRJ_IDX = ?
								   AND APPL_IDX = ?
								   AND DEL_YN = ?
								 ORDER BY WRT_SEQ';
			return $this->db->query($query, $arg);
 		}
	 	
	 	function getApplyUserDataPrize($arg)
	 	{
	 		$query = 'SELECT PRZ_SEQ
	 										,PRZ_NM
										  ,PRZ_PB_NM
										  ,CONVERT(VARCHAR(4),PRZ_DT,121) PRZ_DT1
										  ,SUBSTRING(CONVERT(VARCHAR(10),PRZ_DT,121),6,2) PRZ_DT2
										  ,SUBSTRING(CONVERT(VARCHAR(10),PRZ_DT,121),9,2) PRZ_DT3
								  FROM TBL_APPLY_PRIZE			 
								 WHERE PRJ_IDX = ?
								   AND APPL_IDX = ?
								   AND DEL_YN = ? 
							  ORDER BY PRZ_SEQ';
			return $this->db->query($query, $arg);
	 	}
	 	
	 	function getApplyUserDataLicense($arg)
	 	{
	 		$query = 'SELECT LIC_SEQ
											,LIC_NM
											,LIC_NUM
											,LIC_CD
											,LIC_PB_NM
											,CONVERT(VARCHAR(4),LIC_DT,121) LIC_DT1
										  ,SUBSTRING(CONVERT(VARCHAR(10),LIC_DT,121),6,2) LIC_DT2
										  ,SUBSTRING(CONVERT(VARCHAR(10),LIC_DT,121),9,2) LIC_DT3
											,LIC_FILE_NM
											,LIC_FILE_CD
							   FROM TBL_APPLY_LICENSE
							  WHERE PRJ_IDX = ?
									AND APPL_IDX = ?
									AND DEL_YN = ?
					   ORDER BY LIC_SEQ';
			return $this->db->query($query, $arg);
	 	}
	 	
	 	function getApplyUserDataLanguage2($arg)
	 	{
	 		$query = 'SELECT LANG2_SEQ
											,LANG2_NM
											,LANG2_CD
											,LANG2_SPCH_LVL_NM
											,LANG2_SPCH_LVL_CD
											,LANG2_WRT_LVL_NM
											,LANG2_WRT_LVL_CD
											,LANG2_CMP_LVL_NM
											,LANG2_CMP_LVL_CD
								  FROM TBL_APPLY_LANGUAGE2			 
								 WHERE PRJ_IDX = ?
								   AND APPL_IDX = ?
								   AND DEL_YN = ? 
							  ORDER BY LANG2_SEQ';
			return $this->db->query($query, $arg);
	 	}
	 	
	 	function getApplyUserDataServe($arg)
	 	{
	 		 $query = 'SELECT  SRV_SEQ
												,CONVERT(VARCHAR(4),SRV_STDT,121) SRV_STDT1
												,SUBSTRING(CONVERT(VARCHAR(10),SRV_STDT,121),6,2) SRV_STDT2	   
												,CONVERT(VARCHAR(4),SRV_EDDT,121) SRV_EDDT1
												,SUBSTRING(CONVERT(VARCHAR(10),SRV_EDDT,121),6,2) SRV_EDDT2	   
												,SRV_TP_NM
												,SRV_TP_CD
												,SRV_ORG_NM
												,SRV_CNTNT
								   FROM TBL_APPLY_SERVE
								  WHERE PRJ_IDX = ?
										AND APPL_IDX = ?
										AND DEL_YN = ?
							 ORDER BY SRV_SEQ';
			return $this->db->query($query, $arg);
	 	}
	 	
	 	function getApplyUserDataTech($arg)
	 	{
	 		  $query = 'SELECT TCH_SEQ
												,TCH_NM
												,TCH_LVL
												,TCH_CNTNT
								   FROM TBL_APPLY_TECH
								  WHERE PRJ_IDX = ?
										AND APPL_IDX = ?
										AND DEL_YN = ?
							 ORDER BY TCH_SEQ';
			return $this->db->query($query, $arg);
	 	}
	 	
	 	function getApplyUserDataEducation($arg)
	 	{
 			$query = ' SELECT EDU_SEQ
											 ,CONVERT(VARCHAR(4),EDU_STDT,121) EDU_STDT1
											 ,SUBSTRING(CONVERT(VARCHAR(10),EDU_STDT,121),6,2) EDU_STDT2	   
											 ,CONVERT(VARCHAR(4),EDU_EDDT,121) EDU_EDDT1
											 ,SUBSTRING(CONVERT(VARCHAR(10),EDU_EDDT,121),6,2) EDU_EDDT2	   
											 ,EDU_NM
											 ,EDU_ORG_NM
											 ,EDU_CNTNT
							     FROM TBL_APPLY_EDUCATION
							    WHERE PRJ_IDX = ?
							      AND APPL_IDX = ?
							      AND DEL_YN = ?
							 ORDER BY EDU_SEQ';
			return $this->db->query($query, $arg);
	 	}
	 	
	 	function getApplyUserDataTraining($arg)
	 	{
 			 $query = ' SELECT TRN_SEQ
												,CONVERT(VARCHAR(4),TRN_STDT,121) TRN_STDT1
												,SUBSTRING(CONVERT(VARCHAR(10),TRN_STDT,121),6,2) TRN_STDT2	   
												,CONVERT(VARCHAR(4),TRN_EDDT,121) TRN_EDDT1
												,SUBSTRING(CONVERT(VARCHAR(10),TRN_EDDT,121),6,2) TRN_EDDT2	   
												,TRN_TP_CD
												,TRN_TP_NM
												,TRN_CTRY_NM
												,TRN_ORG_NM
												,TRN_OBJ_NM
												,TRN_CNTNT
								    FROM TBL_APPLY_TRAINING
								   WHERE PRJ_IDX = ?
								     AND APPL_IDX = ?
								     AND DEL_YN = ?';
			return $this->db->query($query, $arg);
	 	}
	 
	 	// - 여기부터 지원서 저장및 수정
	 	
	 	// tbl_apply 비밀번호 저장 
	 	function getApplyPasswordProcess($arg)
	 	{
	 		$query = 'UPDATE TBL_APPLY SET USER_PW = ? WHERE PRJ_IDX = ? AND APPL_IDX = ? AND DEL_YN = ?';
	 		return $this->db->query($query, $arg);
	 	}
	 	
	 	
	 	// tbl_apply
	 	function getApplyBaseProcess($arg,$car_flag,$fmly_flag)
	 	{
	 		$query = ' UPDATE TBL_APPLY
							      SET EMAIL = ? ';
			if ($car_flag == 'Y' )							     
 		  $query .= ' ,CAREER_TP = ?
											 ,CAREER_TERM = ?
											 ,FOREIGN_CAREER_YN = ?
											 ,FOREIGN_CAREER_TERM = ?
									         ,EMP_INSUR_TERM = ? ';
			if ($fmly_flag == 'Y' )										         
			$query .= '									         
									         ,FMLY_NONE_YN = ? ';
					 $query .= 'WHERE PRJ_IDX = ?
									      AND APPL_IDX = ?
									      AND DEL_YN = ?';
			return $this->db->query($query, $arg);
	 	}
	 	
	 	//tbl_apply_personal
	 	function getApplyPersonalProcess($arg)
	 	{
	 		
	 		$query = 'MERGE INTO TBL_APPLY_PERSONAL AS T
										 USING (SELECT ? PRJ_IDX , ? APPL_IDX) S
												ON (S.PRJ_IDX = T.PRJ_IDX
										   AND S.APPL_IDX = T.APPL_IDX)
										  WHEN MATCHED THEN
										UPDATE SET TEL = ?,HTEL = ?
												  ,NAMEENG1 = ?,NAMEENG2 = ?,NAMECHA = ?
												  ,MARRY_YN = ?
												  ,ADDRESS1 = ?,ADDRESS2 = ?,ZIPCODE = ?
												  ,BIRTH_DT = CONVERT(DATETIME,?),BIRTH_TP = ?,RELIGION = ?,HOBBY = ?,FORTE = ?
												  ,BOHUN_TP_NM = ?,BOHUN_TP_CD = ?,BOHUN_SCORE_CD = ?,BOHUN_SCORE_NM = ?,BOHUN_NUM = ?
												  ,PSN_OBSTACLE_TP_CD = ?,PSN_OBSTACLE_TP_NM = ?,PSN_OBSTACLE_LVL_CD = ?,PSN_OBSTACLE_LVL_NM = ?,PSN_OBSTACLE_TP_REASON = ?
												  ,PSN_HEIGHT = CONVERT(INT,?),PSN_WEIGHT = CONVERT(INT,?),PSN_LSIGHT = CONVERT(NUMERIC(2,1),?),PSN_RSIGHT = CONVERT(NUMERIC(2,1),?),PSN_CLRBLND_YN = ?,PSN_LOWINCOME_YN = ?
												  ,PHOTO_YN = ?
										  WHEN NOT MATCHED THEN  
										INSERT (APPL_IDX,PRJ_IDX
												   ,TEL,HTEL
												   ,NAMEENG1,NAMEENG2,NAMECHA
												   ,MARRY_YN
												   ,ADDRESS1,ADDRESS2,ZIPCODE
												   ,BIRTH_DT,BIRTH_TP,RELIGION,HOBBY,FORTE
												   ,BOHUN_TP_NM,BOHUN_TP_CD,BOHUN_SCORE_CD,BOHUN_SCORE_NM,BOHUN_NUM
												   ,PSN_OBSTACLE_TP_CD,PSN_OBSTACLE_TP_NM,PSN_OBSTACLE_LVL_CD,PSN_OBSTACLE_LVL_NM,PSN_OBSTACLE_TP_REASON
												   ,PSN_HEIGHT,PSN_WEIGHT,PSN_LSIGHT,PSN_RSIGHT,PSN_CLRBLND_YN,PSN_LOWINCOME_YN
												   ,PHOTO_YN) 
										VALUES (?,?
												   ,?,?
												   ,?,?,?
												   ,?
												   ,?,?,?
												   ,CONVERT(DATETIME,?),?,?,?,?
												   ,?,?,?,?,?
												   ,?,?,?,?,?
												   ,CONVERT(INT,?),CONVERT(INT,?),CONVERT(NUMERIC(2,1),?),CONVERT(NUMERIC(2,1),?),?,?
												   ,?);';
				return $this->db->query($query, $arg);							   
	 	}
	 	
	 	//tbl_apply_army
	 	function getApplyArmyProcess($arg)
	 	{
	 		$query = 'MERGE INTO TBL_APPLY_ARMY AS T
										 USING (SELECT ? PRJ_IDX , ? APPL_IDX) S
												ON (S.PRJ_IDX = T.PRJ_IDX
										   AND S.APPL_IDX = T.APPL_IDX)
										  WHEN MATCHED THEN
										UPDATE SET ARMY_YN_NM = ?,ARMY_YN_CD = ?
												  ,ARMY_TP_NM = ?,ARMY_TP_CD = ?
												  ,ARMY_LVL_NM = ?,ARMY_LVL_CD = ?
												  ,ARMY_FINISH_NM = ?,ARMY_FINISH_CD = ?
												  ,ARMY_STDT = CONVERT(DATETIME,?),ARMY_EDDT = CONVERT(DATETIME,?),ARMY_REASON = ?
												  ,ARMY_TERM_NM = ?,ARMY_TERM_CD = ?
										  WHEN NOT MATCHED THEN  
									INSERT (PRJ_IDX,APPL_IDX
												 ,ARMY_YN_NM,ARMY_YN_CD
											   ,ARMY_TP_NM,ARMY_TP_CD
											   ,ARMY_LVL_NM,ARMY_LVL_CD
											   ,ARMY_FINISH_NM,ARMY_FINISH_CD
											   ,ARMY_STDT,ARMY_EDDT,ARMY_REASON
											   ,ARMY_TERM_NM,ARMY_TERM_CD)
										VALUES (?,?
												   ,?,?
												   ,?,?
												   ,?,?
												   ,?,?
												   ,CONVERT(DATETIME,?),CONVERT(DATETIME,?) , ?
												   ,?,?);';
	 		return $this->db->query($query, $arg);				
		}
		
		/* 여기서부터 이력서 여러건들어가는 데이터 */
		//tbl_apply_unit
		function getApplyUnitProcess($arg)
		{
			$query = 'MERGE INTO TBL_APPLY_UNIT AS T
										 USING (SELECT ? PRJ_IDX , ? APPL_IDX , ? UNIT_IDX ) S
												ON (S.PRJ_IDX = T.PRJ_IDX
											   AND S.APPL_IDX = T.APPL_IDX
											   AND S.UNIT_IDX = T.UNIT_IDX)
									      WHEN MATCHED THEN
									    UPDATE SET ORD = ?
										      WHEN NOT MATCHED THEN  
									    INSERT (PRJ_IDX,APPL_IDX,UNIT_IDX,ORD)
									    VALUES (?,?,?,?);';
			return $this->db->query($query, $arg);
		}
		
		function getApplyUnitDelProcess($arg,$listObj)
		{
			$str = null;
			$str2 = null;
			
			foreach ($listObj as $key => $idxlist)
			{
				$str .= ',' . $idxlist . ' ID' . $key;
				$str2 .= ',ID' . $key;
			}
			$str = substr($str,1,strlen($str));
			$str2 = substr($str2,1,strlen($str2));
			
			$query = 'UPDATE TBL_APPLY_UNIT 
								   SET DEL_YN = ?   
								 WHERE PRJ_IDX = ?
								   AND APPL_IDX = ?
								   AND UNIT_IDX IN (SELECT UNIT_IDX
													  FROM TBL_APPLY_UNIT APL
													 WHERE PRJ_IDX = ?
													   AND APPL_IDX = ?
													   AND NOT EXISTS ( SELECT 1
																							  FROM (SELECT RES
																											  FROM ( SELECT ' . $str . ' ) P
																										   UNPIVOT (RES FOR IDX IN (' . $str2 . ')) AS UNPVT) SEQTBL
																									 WHERE APL.UNIT_IDX = SEQTBL.RES ) )';
			return $this->db->query($query, $arg);
		}
		
		//tbl_apply_location
		function getApplyLocationProcess($arg)
		{
			$query = 'MERGE INTO TBL_APPLY_LOCATION AS T
										 USING (SELECT ? PRJ_IDX , ? APPL_IDX , ? WP_IDX ) S
												ON (S.PRJ_IDX = T.PRJ_IDX
										   AND S.APPL_IDX = T.APPL_IDX
										   AND S.WP_IDX = T.WP_IDX)
								      WHEN MATCHED THEN
								    UPDATE SET ORD = ? , DEL_YN = \'N\'
	 								      WHEN NOT MATCHED THEN  
								    INSERT (PRJ_IDX,APPL_IDX,WP_IDX,ORD)
								    VALUES (?,?,?,?);';
			return $this->db->query($query, $arg);
		}
		
		function getApplyLocationDelProcess($arg,$listObj)
		{
			$str = null;
			$str2 = null;
			
			foreach ($listObj as $key => $idxlist)
			{
				$str .= ',' . $idxlist . ' ID' . $key;
				$str2 .= ',ID' . $key;
			}
			$str = substr($str,1,strlen($str));
			$str2 = substr($str2,1,strlen($str2));
			
			$query = 'UPDATE TBL_APPLY_LOCATION 
								   SET DEL_YN = ?   
								 WHERE PRJ_IDX = ?
								   AND APPL_IDX = ?
								   AND WP_IDX IN (SELECT WP_IDX
													  FROM TBL_APPLY_LOCATION APL
													 WHERE PRJ_IDX = ?
													   AND APPL_IDX = ?
													   AND NOT EXISTS ( SELECT 1
																							  FROM (SELECT RES
																											  FROM ( SELECT ' . $str . ' ) P
																										   UNPIVOT (RES FOR IDX IN (' . $str2 . ')) AS UNPVT) SEQTBL
																									 WHERE APL.WP_IDX = SEQTBL.RES ) )';
			return $this->db->query($query, $arg);
		}
		
		//tbl_apply_family
		function getApplyFamilyProcess($arg)
		{
			$query = 'MERGE INTO TBL_APPLY_FAMILY AS T
										 USING (SELECT ? PRJ_IDX , ? APPL_IDX , ? FMLY_SEQ ) S
												ON (S.PRJ_IDX = T.PRJ_IDX
										   AND S.APPL_IDX = T.APPL_IDX
										   AND S.FMLY_SEQ = T.FMLY_SEQ)
										  WHEN MATCHED THEN
										UPDATE SET FMLY_REL_NM = ?,FMLY_REL_CD = ?
												   ,FMLY_NM = ?,FMLY_NAI = ?
												   ,FMLY_SCH_NM = ?,FMLY_SCH_CD = ?
												   ,FMLY_JOB = ?,FMLY_WRK_NM = ?,FMLY_WRK_PSTN = ?
												   ,FMLY_LIVE_YN = ?,FMLY_HELP_YN = ?
										  WHEN NOT MATCHED THEN  
										INSERT (PRJ_IDX,APPL_IDX
												   ,FMLY_SEQ
												   ,FMLY_REL_NM,FMLY_REL_CD
												   ,FMLY_NM,FMLY_NAI
												   ,FMLY_SCH_NM,FMLY_SCH_CD
												   ,FMLY_JOB,FMLY_WRK_NM,FMLY_WRK_PSTN
												   ,FMLY_LIVE_YN,FMLY_HELP_YN)
										VALUES (?,?
												   ,(SELECT ISNULL(MAX(FMLY_SEQ),0) + 1 FROM TBL_APPLY_FAMILY WHERE PRJ_IDX = ? AND APPL_IDX = ?)
												   ,?,?
												   ,?,?
												   ,?,?
												   ,?,?,?
												   ,?,?);';
			return $this->db->query($query, $arg);
		}
		
		function getApplyFamIlyDelProcess($arg,$listObj)
		{
			$str = null;
			$str2 = null;
			
			foreach ($listObj as $key => $idxlist)
			{
				$str .= ',' . $idxlist . ' ID' . $key;
				$str2 .= ',ID' . $key;
			}
			$str = substr($str,1,strlen($str));
			$str2 = substr($str2,1,strlen($str2));
			
			$query = 'UPDATE TBL_APPLY_FAMILY 
								   SET DEL_YN = ?   
								 WHERE PRJ_IDX = ?
								   AND APPL_IDX = ?
								   AND FMLY_SEQ IN (SELECT FMLY_SEQ
													  FROM TBL_APPLY_FAMILY FMLY
													 WHERE PRJ_IDX = ?
													   AND APPL_IDX = ?
													   AND NOT EXISTS ( SELECT 1
																							  FROM (SELECT RES
																											  FROM ( SELECT ' . $str . ' ) P
																										   UNPIVOT (RES FOR IDX IN (' . $str2 . ')) AS UNPVT) SEQTBL
																									 WHERE FMLY.FMLY_SEQ = SEQTBL.RES ) )';
			return $this->db->query($query, $arg);
		}
		
		//tbl_apply_career
		function getApplyCareerProcess($arg)
		{
			$query = 'MERGE INTO TBL_APPLY_CAREER AS T
										 USING (SELECT ? PRJ_IDX , ? APPL_IDX , ? CAREER_SEQ ) S
												ON (S.PRJ_IDX = T.PRJ_IDX
										   AND S.APPL_IDX = T.APPL_IDX
										   AND S.CAREER_SEQ = T.CAREER_SEQ)
										  WHEN MATCHED THEN
										UPDATE SET CAREER_STDT = ?,CAREER_EDDT = ?
															,CAREER_STS_NM = ?,CAREER_STS_CD = ?
															,CAREER_CMP_NM = ?,CAREER_CMP_CD = ?
															,CAREER_CMP_TP_NM = ?,CAREER_CMP_TP_CD = ?
															,CAREER_JOB_TP_NM = ?,CAREER_JOB_TP_CD = ?
															,CAREER_DEPT_NM = ?
															,CAREER_PSTN_NM = ?,CAREER_PSTN_CD = ?
															,CAREER_LOC_NM = ?,CAREER_LOC_CD = ?
															,CAREER_RETIRE_NM = ?,CAREER_RETIRE_CD = ?
															,CAREER_PSTN_LVL_NM = ?,CAREER_PSTN_LVL_CD = ?
															,CAREER_EMP_TP_NM = ?,CAREER_EMP_TP_CD = ?
															,CAREER_CNTNT = ?
										  WHEN NOT MATCHED THEN  
										INSERT (PRJ_IDX,APPL_IDX
														,CAREER_SEQ
														,CAREER_STDT,CAREER_EDDT
														,CAREER_STS_NM,CAREER_STS_CD
														,CAREER_CMP_NM,CAREER_CMP_CD
														,CAREER_CMP_TP_NM,CAREER_CMP_TP_CD
														,CAREER_JOB_TP_NM,CAREER_JOB_TP_CD
														,CAREER_DEPT_NM
														,CAREER_PSTN_NM,CAREER_PSTN_CD
														,CAREER_LOC_NM,CAREER_LOC_CD
														,CAREER_RETIRE_NM,CAREER_RETIRE_CD
														,CAREER_PSTN_LVL_NM,CAREER_PSTN_LVL_CD
														,CAREER_EMP_TP_NM,CAREER_EMP_TP_CD
														,CAREER_CNTNT)
										VALUES (?,?
												   ,(SELECT ISNULL(MAX(CAREER_SEQ),0) + 1 FROM TBL_APPLY_CAREER WHERE PRJ_IDX = ? AND APPL_IDX = ?)
												   ,?,?
												   ,?,?
												   ,?,?
												   ,?,?
												   ,?,?
												   ,?
												   ,?,?
												   ,?,?
												   ,?,?
												   ,?,?
												   ,?,?
												   ,?);';
			return $this->db->query($query, $arg);
		}
		
		function getApplyCareerDelProcess($arg,$listObj)
		{
			$str = null;
			$str2 = null;
			
			foreach ($listObj as $key => $idxlist)
			{
				$str .= ',' . $idxlist . ' ID' . $key;
				$str2 .= ',ID' . $key;
			}
			$str = substr($str,1,strlen($str));
			$str2 = substr($str2,1,strlen($str2));
			
			$query = 'UPDATE TBL_APPLY_CAREER 
								   SET DEL_YN = ?   
								 WHERE PRJ_IDX = ?
								   AND APPL_IDX = ?
								   AND CAREER_SEQ IN (SELECT CAREER_SEQ
																			  FROM TBL_APPLY_CAREER CAREER
																			 WHERE PRJ_IDX = ?
																			   AND APPL_IDX = ?
																			   AND NOT EXISTS ( SELECT 1
																													  FROM (SELECT RES
																																	  FROM ( SELECT ' . $str . ' ) P
																																   UNPIVOT (RES FOR IDX IN (' . $str2 . ')) AS UNPVT) SEQTBL
																															 WHERE CAREER.CAREER_SEQ = SEQTBL.RES ) )';
			return $this->db->query($query, $arg);
		}
		
		
		//tbl_apply_write
		function getApplyWriteProcess($arg)
		{
			$query = 'MERGE INTO TBL_APPLY_WRITE AS T
										 USING (SELECT ? PRJ_IDX , ? APPL_IDX , ? WRT_SEQ ) S
												ON (S.PRJ_IDX = T.PRJ_IDX
										   AND S.APPL_IDX = T.APPL_IDX
										   AND S.WRT_SEQ = T.WRT_SEQ)
									  WHEN MATCHED THEN
									UPDATE SET WRT_NM = ?,WRT_PB = ?
											  ,WRT_DT = CONVERT(DATETIME,?)
									  WHEN NOT MATCHED THEN  
									INSERT (PRJ_IDX,APPL_IDX
											,WRT_SEQ
											,WRT_NM,WRT_PB
											,WRT_DT)
									VALUES (?,?
										   ,(SELECT ISNULL(MAX(WRT_SEQ),0) + 1 FROM TBL_APPLY_WRITE WHERE PRJ_IDX = ? AND APPL_IDX = ?)
										   ,?,?
										   ,CONVERT(DATETIME,?));';
			return $this->db->query($query, $arg);
		}
		
		function getApplyWriteDelProcess($arg,$listObj)
		{
			$str = null;
			$str2 = null;
			
			foreach ($listObj as $key => $idxlist)
			{
				$str .= ',' . $idxlist . ' ID' . $key;
				$str2 .= ',ID' . $key;
			}
			$str = substr($str,1,strlen($str));
			$str2 = substr($str2,1,strlen($str2));
			
			$query = 'UPDATE TBL_APPLY_WRITE
								   SET DEL_YN = ?   
								 WHERE PRJ_IDX = ?
								   AND APPL_IDX = ?
								   AND WRT_SEQ IN (SELECT WRT_SEQ
													  FROM TBL_APPLY_WRITE WRT
													 WHERE PRJ_IDX = ?
													   AND APPL_IDX = ?
													   AND NOT EXISTS ( SELECT 1
																							  FROM (SELECT RES
																											  FROM ( SELECT ' . $str . ' ) P
																										   UNPIVOT (RES FOR IDX IN (' . $str2 . ')) AS UNPVT) SEQTBL
																									 WHERE WRT.WRT_SEQ = SEQTBL.RES ) )';
			return $this->db->query($query, $arg);
		}
		
		//tbl_apply_prize
		function getApplyPrizeProcess($arg)
		{

			$query = 'MERGE INTO TBL_APPLY_PRIZE AS T
										 USING (SELECT ? PRJ_IDX , ? APPL_IDX , ? PRZ_SEQ ) S
												ON (S.PRJ_IDX = T.PRJ_IDX
										   AND S.APPL_IDX = T.APPL_IDX
										   AND S.PRZ_SEQ = T.PRZ_SEQ)
									  WHEN MATCHED THEN
									UPDATE SET PRZ_NM = ?,PRZ_PB_NM = ?
											  ,PRZ_DT = CONVERT(DATETIME,?)
									  WHEN NOT MATCHED THEN  
									INSERT (PRJ_IDX,APPL_IDX
											,PRZ_SEQ
											,PRZ_NM,PRZ_PB_NM
											,PRZ_DT)
									VALUES (?,?
										   ,(SELECT ISNULL(MAX(PRZ_SEQ),0) + 1 FROM TBL_APPLY_PRIZE WHERE PRJ_IDX = ? AND APPL_IDX = ?)
										   ,?,?
										   ,CONVERT(DATETIME,?));';
			return $this->db->query($query, $arg);
		}
		
		function getApplyPrizeDelProcess($arg,$listObj)
		{
			$str = null;
			$str2 = null;
			
			foreach ($listObj as $key => $idxlist)
			{
				$str .= ',' . $idxlist . ' ID' . $key;
				$str2 .= ',ID' . $key;
			}
			$str = substr($str,1,strlen($str));
			$str2 = substr($str2,1,strlen($str2));
			
			$query = 'UPDATE TBL_APPLY_PRIZE
								   SET DEL_YN = ?   
								 WHERE PRJ_IDX = ?
								   AND APPL_IDX = ?
								   AND PRZ_SEQ IN (SELECT PRZ_SEQ
													  FROM TBL_APPLY_PRIZE PRZ
													 WHERE PRJ_IDX = ?
													   AND APPL_IDX = ?
													   AND NOT EXISTS ( SELECT 1
																							  FROM (SELECT RES
																											  FROM ( SELECT ' . $str . ' ) P
																										   UNPIVOT (RES FOR IDX IN (' . $str2 . ')) AS UNPVT) SEQTBL
																									 WHERE PRZ.PRZ_SEQ = SEQTBL.RES ) )';
			return $this->db->query($query, $arg);
		}
		
		
		
		//tbl_apply_language2
		function getApplyLanguage2Process($arg)
		{

			$query = 'MERGE INTO TBL_APPLY_LANGUAGE2 AS T
										 USING (SELECT ? PRJ_IDX , ? APPL_IDX , ? LANG2_SEQ ) S
												ON (S.PRJ_IDX = T.PRJ_IDX
										   AND S.APPL_IDX = T.APPL_IDX
										   AND S.LANG2_SEQ = T.LANG2_SEQ)
									  WHEN MATCHED THEN
									UPDATE SET  LANG2_NM = ?,LANG2_CD = ?
														 ,LANG2_SPCH_LVL_NM = ?,LANG2_SPCH_LVL_CD = ?
														 ,LANG2_WRT_LVL_NM = ?,LANG2_WRT_LVL_CD = ?
														 ,LANG2_CMP_LVL_NM = ?,LANG2_CMP_LVL_CD = ?
									  WHEN NOT MATCHED THEN  
									INSERT (PRJ_IDX,APPL_IDX
												,LANG2_SEQ
												,LANG2_NM,LANG2_CD
												,LANG2_SPCH_LVL_NM,LANG2_SPCH_LVL_CD
												,LANG2_WRT_LVL_NM,LANG2_WRT_LVL_CD
												,LANG2_CMP_LVL_NM,LANG2_CMP_LVL_CD)
									VALUES (?,?
										   ,(SELECT ISNULL(MAX(LANG2_SEQ),0) + 1 FROM TBL_APPLY_LANGUAGE2 WHERE PRJ_IDX = ? AND APPL_IDX = ?)
										   ,?,?
										   ,?,?
										   ,?,?
										   ,?,?);';
			return $this->db->query($query, $arg);
		}
		
		function getApplyLanguage2DelProcess($arg,$listObj)
		{
			$str = null;
			$str2 = null;
			
			foreach ($listObj as $key => $idxlist)
			{
				$str .= ',' . $idxlist . ' ID' . $key;
				$str2 .= ',ID' . $key;
			}
			$str = substr($str,1,strlen($str));
			$str2 = substr($str2,1,strlen($str2));
			
			$query = 'UPDATE TBL_APPLY_LANGUAGE2
								   SET DEL_YN = ?   
								 WHERE PRJ_IDX = ?
								   AND APPL_IDX = ?
								   AND LANG2_SEQ IN (SELECT LANG2_SEQ
																		  FROM TBL_APPLY_LANGUAGE2 LAN
																		 WHERE PRJ_IDX = ?
																		   AND APPL_IDX = ?
																		   AND NOT EXISTS ( SELECT 1
																												  FROM (SELECT RES
																																  FROM ( SELECT ' . $str . ' ) P
																															   UNPIVOT (RES FOR IDX IN (' . $str2 . ')) AS UNPVT) SEQTBL
																														 WHERE LAN.LANG2_SEQ = SEQTBL.RES ) )';
			return $this->db->query($query, $arg);
		}
		
		
		
		//tbl_apply_License
		function getApplyLicenseProcess($arg)
		{

			$query = 'MERGE INTO TBL_APPLY_LICENSE AS T
										 USING (SELECT ? PRJ_IDX , ? APPL_IDX , ? LIC_SEQ ) S
												ON (S.PRJ_IDX = T.PRJ_IDX
										   AND S.APPL_IDX = T.APPL_IDX
										   AND S.LIC_SEQ = T.LIC_SEQ)
									  WHEN MATCHED THEN
									UPDATE SET  LIC_NM = ?,LIC_CD = ?
														 ,LIC_PB_NM = ?
														 ,LIC_DT = ?
														 ,LIC_FILE_NM = ?,LIC_FILE_CD = ?
														 ,LIC_NUM = ?
									  WHEN NOT MATCHED THEN  
									INSERT (PRJ_IDX,APPL_IDX
												 ,LIC_SEQ
												 ,LIC_NM,LIC_CD
												 ,LIC_PB_NM
												 ,LIC_DT
												 ,LIC_FILE_NM,LIC_FILE_CD
												 ,LIC_NUM)
									VALUES (?,?
										   ,(SELECT ISNULL(MAX(LIC_SEQ),0) + 1 FROM TBL_APPLY_LICENSE WHERE PRJ_IDX = ? AND APPL_IDX = ?)
										   ,?,?
										   ,?
										   ,CONVERT(DATETIME,?)
										   ,?,?
										   ,?);';
			return $this->db->query($query, $arg);
		}
		
		function getApplyLicenseDelProcess($arg,$listObj)
		{
			$str = null;
			$str2 = null;
			
			foreach ($listObj as $key => $idxlist)
			{
				$str .= ',' . $idxlist . ' ID' . $key;
				$str2 .= ',ID' . $key;
			}
			$str = substr($str,1,strlen($str));
			$str2 = substr($str2,1,strlen($str2));
			
			$query = 'UPDATE TBL_APPLY_LICENSE
								   SET DEL_YN = ?   
								 WHERE PRJ_IDX = ?
								   AND APPL_IDX = ?
								   AND LIC_SEQ IN (SELECT LIC_SEQ
																		  FROM TBL_APPLY_LICENSE LIC
																		 WHERE PRJ_IDX = ?
																		   AND APPL_IDX = ?
																		   AND NOT EXISTS ( SELECT 1
																												  FROM (SELECT RES
																																  FROM ( SELECT ' . $str . ' ) P
																															   UNPIVOT (RES FOR IDX IN (' . $str2 . ')) AS UNPVT) SEQTBL
																														 WHERE LIC.LIC_SEQ = SEQTBL.RES ) )';
			return $this->db->query($query, $arg);
		}
		
		//tbl_apply_computer
		function getApplyComputerProcess($arg)
		{
			$query = 'MERGE INTO TBL_APPLY_COMPUTER AS T
										 USING (SELECT ? PRJ_IDX , ? APPL_IDX , ? CD_CPU_IDX ) S
												ON (S.PRJ_IDX = T.PRJ_IDX
										   AND S.APPL_IDX = T.APPL_IDX
										   AND S.CD_CPU_IDX = T.CD_CPU_IDX)
									  WHEN MATCHED THEN
									UPDATE SET  LVL_NM = ?,LVL_CD = ?
									  WHEN NOT MATCHED THEN  
									INSERT (PRJ_IDX,APPL_IDX
												 ,CD_CPU_IDX
												 ,LVL_NM,LVL_CD)
									VALUES (?,?
										   		,?
										   		,?,?);';
			return $this->db->query($query, $arg);
		}
		
		
		
		
		//tbl_apply_serve
		function getApplyServeProcess($arg)
		{

			$query = 'MERGE INTO TBL_APPLY_SERVE AS T
										 USING (SELECT ? PRJ_IDX , ? APPL_IDX , ? SRV_SEQ ) S
												ON (S.PRJ_IDX = T.PRJ_IDX
										   AND S.APPL_IDX = T.APPL_IDX
										   AND S.SRV_SEQ = T.SRV_SEQ)
									  WHEN MATCHED THEN
									UPDATE SET  SRV_STDT = CONVERT(DATETIME,?),SRV_EDDT = CONVERT(DATETIME,?)
														 ,SRV_TP_NM = ?,SRV_TP_CD = ?
														 ,SRV_ORG_NM = ?
														 ,SRV_CNTNT = ?
									  WHEN NOT MATCHED THEN  
									INSERT (PRJ_IDX,APPL_IDX
												 ,SRV_SEQ
												 ,SRV_STDT,SRV_EDDT
												 ,SRV_TP_NM,SRV_TP_CD
												 ,SRV_ORG_NM
												 ,SRV_CNTNT)
									VALUES (?,?
										   ,(SELECT ISNULL(MAX(SRV_SEQ),0) + 1 FROM TBL_APPLY_SERVE WHERE PRJ_IDX = ? AND APPL_IDX = ?)
										   ,CONVERT(DATETIME,?),CONVERT(DATETIME,?)
										   ,?,?
										   ,?
										   ,?);';
			return $this->db->query($query, $arg);
		}
		
		function getApplyServeDelProcess($arg,$listObj)
		{
			$str = null;
			$str2 = null;
			
			foreach ($listObj as $key => $idxlist)
			{
				$str .= ',' . $idxlist . ' ID' . $key;
				$str2 .= ',ID' . $key;
			}
			$str = substr($str,1,strlen($str));
			$str2 = substr($str2,1,strlen($str2));
			
			$query = 'UPDATE TBL_APPLY_SERVE
								   SET DEL_YN = ?   
								 WHERE PRJ_IDX = ?
								   AND APPL_IDX = ?
								   AND SRV_SEQ IN (SELECT SRV_SEQ
																		  FROM TBL_APPLY_SERVE SRV
																		 WHERE PRJ_IDX = ?
																		   AND APPL_IDX = ?
																		   AND NOT EXISTS ( SELECT 1
																												  FROM (SELECT RES
																																  FROM ( SELECT ' . $str . ' ) P
																															   UNPIVOT (RES FOR IDX IN (' . $str2 . ')) AS UNPVT) SEQTBL
																														 WHERE SRV.SRV_SEQ = SEQTBL.RES ) )';
			return $this->db->query($query, $arg);
		}
		
		
		
		
		//tbl_apply_tech
		function getApplyTechProcess($arg)
		{

			$query = 'MERGE INTO TBL_APPLY_TECH AS T
										 USING (SELECT ? PRJ_IDX , ? APPL_IDX , ? TCH_SEQ ) S
												ON (S.PRJ_IDX = T.PRJ_IDX
										   AND S.APPL_IDX = T.APPL_IDX
										   AND S.TCH_SEQ = T.TCH_SEQ)
									  WHEN MATCHED THEN
									UPDATE SET TCH_NM = ?,TCH_LVL = ?,TCH_CNTNT = ?
									  WHEN NOT MATCHED THEN  
									INSERT (PRJ_IDX,APPL_IDX
												 ,TCH_SEQ
												 ,TCH_NM,TCH_LVL,TCH_CNTNT)
									VALUES (?,?
										   ,(SELECT ISNULL(MAX(TCH_SEQ),0) + 1 FROM TBL_APPLY_TECH WHERE PRJ_IDX = ? AND APPL_IDX = ?)
										   ,?,?,?);';
			return $this->db->query($query, $arg);
		}
		
		function getApplyTechDelProcess($arg,$listObj)
		{
			$str = null;
			$str2 = null;
			
			foreach ($listObj as $key => $idxlist)
			{
				$str .= ',' . $idxlist . ' ID' . $key;
				$str2 .= ',ID' . $key;
			}
			$str = substr($str,1,strlen($str));
			$str2 = substr($str2,1,strlen($str2));
			
			$query = 'UPDATE TBL_APPLY_TECH
								   SET DEL_YN = ?   
								 WHERE PRJ_IDX = ?
								   AND APPL_IDX = ?
								   AND TCH_SEQ IN (SELECT TCH_SEQ
																		  FROM TBL_APPLY_TECH TCH
																		 WHERE PRJ_IDX = ?
																		   AND APPL_IDX = ?
																		   AND NOT EXISTS ( SELECT 1
																												  FROM (SELECT RES
																																  FROM ( SELECT ' . $str . ' ) P
																															   UNPIVOT (RES FOR IDX IN (' . $str2 . ')) AS UNPVT) SEQTBL
																														 WHERE TCH.TCH_SEQ = SEQTBL.RES ) )';
			return $this->db->query($query, $arg);
		}
		
		//tbl_apply_education
		function getApplyEducationProcess($arg)
		{

			$query = 'MERGE INTO TBL_APPLY_EDUCATION AS T
										 USING (SELECT ? PRJ_IDX , ? APPL_IDX , ? EDU_SEQ ) S
												ON (S.PRJ_IDX = T.PRJ_IDX
										   AND S.APPL_IDX = T.APPL_IDX
										   AND S.EDU_SEQ = T.EDU_SEQ)
									  WHEN MATCHED THEN
									UPDATE SET EDU_STDT = ? , EDU_EDDT = ?
														,EDU_NM = ?,EDU_ORG_NM = ?,EDU_CNTNT = ?
									  WHEN NOT MATCHED THEN  
									INSERT (PRJ_IDX,APPL_IDX
												 ,EDU_SEQ
												 ,EDU_STDT,EDU_EDDT
												 ,EDU_NM,EDU_ORG_NM,EDU_CNTNT)
									VALUES (?,?
										   ,(SELECT ISNULL(MAX(EDU_SEQ),0) + 1 FROM TBL_APPLY_EDUCATION WHERE PRJ_IDX = ? AND APPL_IDX = ?)
										   ,?,?
										   ,?,?,?);';
			return $this->db->query($query, $arg);
		}
		
		function getApplyEducationDelProcess($arg,$listObj)
		{
			$str = null;
			$str2 = null;
			
			foreach ($listObj as $key => $idxlist)
			{
				$str .= ',' . $idxlist . ' ID' . $key;
				$str2 .= ',ID' . $key;
			}
			$str = substr($str,1,strlen($str));
			$str2 = substr($str2,1,strlen($str2));
			
			$query = 'UPDATE TBL_APPLY_EDUCATION
								   SET DEL_YN = ?   
								 WHERE PRJ_IDX = ?
								   AND APPL_IDX = ?
								   AND EDU_SEQ IN (SELECT EDU_SEQ
																		  FROM TBL_APPLY_EDUCATION EDU
																		 WHERE PRJ_IDX = ?
																		   AND APPL_IDX = ?
																		   AND NOT EXISTS ( SELECT 1
																												  FROM (SELECT RES
																																  FROM ( SELECT ' . $str . ' ) P
																															   UNPIVOT (RES FOR IDX IN (' . $str2 . ')) AS UNPVT) SEQTBL
																														 WHERE EDU.EDU_SEQ = SEQTBL.RES ) )';
			return $this->db->query($query, $arg);
		}
		
		
		
		//tbl_apply_training
		function getApplyTrainingProcess($arg)
		{

			$query = 'MERGE INTO TBL_APPLY_TRAINING AS T
										 USING (SELECT ? PRJ_IDX , ? APPL_IDX , ? TRN_SEQ ) S
												ON (S.PRJ_IDX = T.PRJ_IDX
										   AND S.APPL_IDX = T.APPL_IDX
										   AND S.TRN_SEQ = T.TRN_SEQ)
									  WHEN MATCHED THEN
									UPDATE SET TRN_STDT = ? , TRN_EDDT = ?
														,TRN_TP_NM = ?,TRN_TP_CD = ?
														,TRN_ORG_NM = ?,TRN_OBJ_NM = ?,TRN_CNTNT = ?,TRN_CTRY_NM = ?
									  WHEN NOT MATCHED THEN  
									INSERT (PRJ_IDX,APPL_IDX
												 ,TRN_SEQ
												 ,TRN_STDT,TRN_EDDT
												 ,TRN_TP_NM,TRN_TP_CD
												 ,TRN_ORG_NM,TRN_OBJ_NM,TRN_CNTNT,TRN_CTRY_NM)
									VALUES (?,?
										   ,(SELECT ISNULL(MAX(TRN_SEQ),0) + 1 FROM TBL_APPLY_TRAINING WHERE PRJ_IDX = ? AND APPL_IDX = ?)
										   ,?,?
										   ,?,?
										   ,?,?,?,?);';
			return $this->db->query($query, $arg);
		}
		
		function getApplyTrainingDelProcess($arg,$listObj)
		{
			$str = null;
			$str2 = null;
			
			foreach ($listObj as $key => $idxlist)
			{
				$str .= ',' . $idxlist . ' ID' . $key;
				$str2 .= ',ID' . $key;
			}
			$str = substr($str,1,strlen($str));
			$str2 = substr($str2,1,strlen($str2));
			
			$query = 'UPDATE TBL_APPLY_TRAINING
								   SET DEL_YN = ?   
								 WHERE PRJ_IDX = ?
								   AND APPL_IDX = ?
								   AND TRN_SEQ IN (SELECT TRN_SEQ
																		  FROM TBL_APPLY_TRAINING TRN
																		 WHERE PRJ_IDX = ?
																		   AND APPL_IDX = ?
																		   AND NOT EXISTS ( SELECT 1
																												  FROM (SELECT RES
																																  FROM ( SELECT ' . $str . ' ) P
																															   UNPIVOT (RES FOR IDX IN (' . $str2 . ')) AS UNPVT) SEQTBL
																														 WHERE TRN.TRN_SEQ = SEQTBL.RES ) )';
			return $this->db->query($query, $arg);
		}
		
		//tbl_apply_file
		function getApplyFileProcess($arg)
		{

			$query = 'MERGE INTO TBL_APPLY_FILE AS T
										 USING (SELECT ? PRJ_IDX , ? APPL_IDX , ? RSM_FILE_IDX ) S
												ON (S.PRJ_IDX = T.PRJ_IDX
										   AND S.APPL_IDX = T.APPL_IDX
										   AND S.RSM_FILE_IDX = T.RSM_FILE_IDX)
									    WHEN MATCHED THEN
									  UPDATE SET APPL_FILE_NM = ?
									  					,APPL_FILE_CD = ?
									  					,DEL_YN = \'N\'
									    WHEN NOT MATCHED THEN  
									  INSERT (PRJ_IDX,APPL_IDX,RSM_FILE_IDX,APPL_FILE_NM,APPL_FILE_CD)
									  VALUES (?,?,?,?,?);';
			return $this->db->query($query, $arg);
		}
		
		function getApplyFileDelete($arg)
		{
			$query = 'UPDATE TBL_APPLY_FILE 
								   SET DEL_YN = \'Y\' 
								 WHERE PRJ_IDX = ?
								   AND APPL_IDX = ?
								   AND RSM_FILE_IDX = ?';
			return $this->db->query($query, $arg);
		}
		
		//tbl_apply_content
		function getApplyContentProcess($arg)
		{

			$query = 'MERGE INTO TBL_APPLY_CONTENT AS T
										 USING (SELECT ? PRJ_IDX , ? APPL_IDX , ? RSM_CNTNT_IDX ) S
												ON (S.PRJ_IDX = T.PRJ_IDX
										   AND S.APPL_IDX = T.APPL_IDX
										   AND S.RSM_CNTNT_IDX = T.RSM_CNTNT_IDX)
									    WHEN MATCHED THEN
									  UPDATE SET APPL_CNTNT = ?
									    WHEN NOT MATCHED THEN  
									  INSERT (PRJ_IDX,APPL_IDX,RSM_CNTNT_IDX,APPL_CNTNT)
									  VALUES (?,?,?,?);';
			return $this->db->query($query, $arg);
		}
		
		//tbl_apply_language
		function getApplyLanguageProcess($arg)
		{

			$query = 'MERGE INTO TBL_APPLY_LANGUAGE AS T
										 USING (SELECT ? PRJ_IDX , ? APPL_IDX , ? LAN_IDX ) S
												ON (S.PRJ_IDX = T.PRJ_IDX
										   AND S.APPL_IDX = T.APPL_IDX
										   AND S.LAN_IDX = T.LAN_IDX)
									    WHEN MATCHED THEN
									  UPDATE SET LAN_SCORE = ?
									  					,LAN_LVL_IDX = ?
									  					,LAN_DT = CONVERT(DATETIME,?)
									  					,LAN_NUM = ?
									    WHEN NOT MATCHED THEN  
									  INSERT (PRJ_IDX,APPL_IDX
									  			 ,LAN_IDX
													 ,RSM_LANG_IDX
													 ,LAN_SCORE
													 ,LAN_LVL_IDX
													 ,LAN_DT
													 ,LAN_NUM)
									  VALUES (?,?,?,?,?,?,CONVERT(DATETIME,?),?);';
			return $this->db->query($query, $arg);
		}
		
		
		//tbl_apply_school
		function getApplySchoolProcess($arg)
		{

			$query = 'MERGE INTO TBL_APPLY_SCHOOL AS T
										 USING (SELECT ? PRJ_IDX , ? APPL_IDX , ? SCH_SEQ ) S
												ON (S.PRJ_IDX = T.PRJ_IDX
										   AND S.APPL_IDX = T.APPL_IDX
										   AND S.SCH_SEQ = T.SCH_SEQ)
									  WHEN MATCHED THEN
									UPDATE SET  SCH_TP = ?
														 ,SCH_STDT = CONVERT(DATETIME,?),SCH_EDDT = CONVERT(DATETIME,?)
														 ,SCH_ETTP1 = ?,SCH_ETTP2 = ?
														 ,SCH_NM = ?,SCH_CD = ?
														 ,SCH_LOC = ?,SCH_JUYA = ?
														 ,SCH_MAJOR_NM = ?,SCH_MAJOR_CD = ?,SCH_AFF = ?
														 ,SCH_SUB_MAJOR_TP = ?
														 ,SCH_SUB_MAJOR_NM = ?,SCH_SUB_MAJOR_CD = ?,SCH_SUB_AFF = ?
														 ,SCH_HAKJUM = ?,SCH_MAX_HAKJUM = ?,SCH_ISU_HAKJUM = ?,SCH_FGRD_TP = ?,SCH_BRANCH_TP = ?
									  WHEN NOT MATCHED THEN  
									INSERT (PRJ_IDX,APPL_IDX
												 ,SCH_SEQ
												 ,SCH_TP
												 ,SCH_STDT,SCH_EDDT
												 ,SCH_ETTP1,SCH_ETTP2
												 ,SCH_NM,SCH_CD
												 ,SCH_LOC,SCH_JUYA
												 ,SCH_MAJOR_NM,SCH_MAJOR_CD,SCH_AFF
												 ,SCH_SUB_MAJOR_TP
												 ,SCH_SUB_MAJOR_NM,SCH_SUB_MAJOR_CD,SCH_SUB_AFF
												 ,SCH_HAKJUM,SCH_MAX_HAKJUM,SCH_ISU_HAKJUM,SCH_FGRD_TP,SCH_BRANCH_TP)
									VALUES (?,?
										   	,(SELECT ISNULL(MAX(SCH_SEQ),0) + 1 FROM TBL_APPLY_SCHOOL WHERE PRJ_IDX = ? AND APPL_IDX = ?)
										   	,?
										   	,CONVERT(DATETIME,?),CONVERT(DATETIME,?)
										   	,?,?
										   	,?,?
										   	,?,?
										   	,?,?,?
										   	,?
										   	,?,?,?
										   	,?,?,?,?,?);';
			return $this->db->query($query, $arg);
		}
		
		function getApplySchoolDelProcess($arg,$listObj)
		{
			$str = null;
			$str2 = null;
			
			foreach ($listObj as $key => $idxlist)
			{
				$str .= ',' . $idxlist . ' ID' . $key;
				$str2 .= ',ID' . $key;
			}
			$str = substr($str,1,strlen($str));
			$str2 = substr($str2,1,strlen($str2));
			
			$query = 'UPDATE TBL_APPLY_SCHOOL
								   SET DEL_YN = ?   
								 WHERE PRJ_IDX = ?
								   AND APPL_IDX = ?
								   AND SCH_SEQ IN (SELECT SCH_SEQ
																		  FROM TBL_APPLY_SCHOOL SCH
																		 WHERE PRJ_IDX = ?
																		   AND APPL_IDX = ?
																		   AND NOT EXISTS ( SELECT 1
																												  FROM (SELECT RES
																																  FROM ( SELECT ' . $str . ' ) P
																															   UNPIVOT (RES FOR IDX IN (' . $str2 . ')) AS UNPVT) SEQTBL
																														 WHERE SCH.SCH_SEQ = SEQTBL.RES ) )';
			return $this->db->query($query, $arg);
		}
		
		function getConfirmApplyNo($arg)
		{
			$query = 'SELECT APPLY_NO
								  FROM TBL_APPLY
								 WHERE PRJ_IDX = ?
								   AND APPL_IDX = ?
								   AND DEL_YN = ?';
			return $this->db->query($query, $arg);					   
		}
		
		function getApplyNoExec($arg)
		{
			return $this->msdb->output('applyNoExec', $arg, 'SELECT'); 
		}
		
		function getApplyResultData($arg)
		{
			$query = 'SELECT A.APPLY_NO
										  ,A.NAMEKOR
										  ,A.EMAIL
										  ,B.HTEL
										  ,D.UNIT_NM
										  ,E.PRJ_NM
										  ,F.COMP_NM
								  FROM TBL_APPLY A
								  JOIN TBL_APPLY_PERSONAL B
								    ON A.PRJ_IDX = B.PRJ_IDX 
								   AND A.APPL_IDX = B.APPL_IDX 
								  JOIN TBL_APPLY_UNIT C
								    ON A.PRJ_IDX = C.PRJ_IDX
								   AND A.APPL_IDX = C.APPL_IDX
								  JOIN TBL_UNIT D
								    ON C.PRJ_IDX = D.PRJ_IDX
								   AND C.UNIT_IDX = D.UNIT_IDX
								  JOIN TBL_PROJECT E
								    ON A.PRJ_IDX = E.PRJ_IDX
								  JOIN TBL_COMPANY F
								    ON E.COMP_ID = F.COMP_ID
								WHERE A.PRJ_IDX = ?
								  AND A.APPL_IDX = ?
								  AND C.ORD = 1
								  AND C.DEL_YN = ?
								  AND A.DEL_YN = ?
								  AND B.DEL_YN = ?
								  AND D.DEL_YN = ?
								  AND E.DEL_YN = ?
								  AND F.DEL_YN = ?';
			return $this->db->query($query, $arg);	
		}
		
		function getApplyFormLoginList($arg)
		{
			$query = 'SELECT APPL_IDX 
											,APPL_YN
											,APPLY_NO
											,(SELECT TOP 1 RSM_IDX FROM TBL_RESUME_FORM RSM WHERE RSM.PRJ_IDX = APL.PRJ_IDX AND DEL_YN = ?) RSM_IDX
							    FROM TBL_APPLY APL
							   WHERE PRJ_IDX = ?
							     AND AUTH_DI = ?
							     AND DEL_YN = ?';
			return $this->db->query($query, $arg);
		}
		
		function getCommentList($arg)
		{
			$query = 'SELECT DFC_CD,DFC_CNTNT
								  FROM (SELECT ROW_NUMBER() OVER (PARTITION BY DFC_CD ORDER BY ORD) ORDX
											  ,*
												  FROM (SELECT DFC_CD,DFC_CNTNT,1 ORD
																  FROM TBL_RESUME_COMMENT
																 WHERE RSM_IDX = ?
																 UNION ALL
																SELECT DFC_CD,DFC_CNTNT,2
																  FROM TBL_DEFAULT_COMMENT) RES ) R
								 WHERE ORDX = 1';
			return $this->db->query($query, $arg);
		}
		
		function getRecvDiInfo($arg)
		{
			$query = 'SELECT AUTH_DI
			  				  FROM TBL_APPLY
			  				 WHERE PRJ_IDX = ?
			  				   AND APPLY_NO = ?
			  				   AND DEL_YN = \'N\'';
			return $this->db->query($query, $arg);
		}
		
}
