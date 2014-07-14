<?
	class ProjectManager_model extends CI_Model
	{
		
		function getSummaryList($arg)
		{
			  $query = 'SELECT * 
		  						  FROM (SELECT X.COMP_ID
											  ,X.COMP_NM
											  ,X.DOMAIN_ID
											  ,X.LOGO_IMG1
											  ,ISNULL(Y.CNT,0) CNT
											  ,ROW_NUMBER() OVER (ORDER BY REG_DT) ROW_NUM
											  ,COUNT(*) OVER() ALL_LIST_COUNT
										  FROM (SELECT A.COMP_ID
													  ,A.COMP_NM
													  ,A.DOMAIN_ID
													  ,B.LOGO_IMG1
													  ,B.REG_DT
												  FROM TBL_COMPANY A 
												  JOIN TBL_COMPANY_DTL B
													ON A.COMP_ID = B.COMP_ID
												 WHERE A.DEL_YN = ?) X
							  LEFT OUTER  JOIN (SELECT COMP_ID , COUNT(*) CNT
						 						  FROM TBL_PROJECT
												 WHERE PRJ_STS = ?
												   AND PRJ_STDT <= GETDATE() AND PRJ_EDDT >= GETDATE()
												   AND DEL_YN = ?
											  GROUP BY COMP_ID) Y
											ON X.COMP_ID = Y.COMP_ID) RTABLE
								  WHERE ROW_NUM >= ? and ROW_NUM <= ?';
			return $this->db->query($query, $arg);
		}
		
		function getProjectList($arg)
    {
    	  $query = 'SELECT * 
		  						  FROM (SELECT A.PRJ_IDX
															  ,B.COMP_NM
															  ,A.PRJ_NM
															  ,REPLACE(CONVERT(VARCHAR(16),A.PRJ_STDT,121),\'-\',\'/\') PRJ_STDT
															  ,REPLACE(CONVERT(VARCHAR(16),A.PRJ_EDDT,121),\'-\',\'/\') PRJ_EDDT
															  ,B.DOMAIN_ID
															  ,A.PRJ_STS
															  ,A.USE_YN
															  ,( SELECT COUNT(*) CNT FROM TBL_UNIT WHERE PRJ_IDX = A.PRJ_IDX AND DEL_YN = \'N\' ) UNIT_CNT
															  ,ROW_NUMBER() OVER (ORDER BY REG_DT DESC) ROW_NUM
																,COUNT(*) OVER() ALL_LIST_COUNT
																,(SELECT COUNT(*) BBS_CNT 
																		FROM TBL_BBS X 
																	 WHERE X.PRJ_IDX = A.PRJ_IDX 
																	   AND EXISTS (SELECT 1
																	   							 FROM TBL_BBS_GROUP Y
																	   							WHERE Y.PRJ_IDX = X.PRJ_IDX 
																	   								AND Y.BBS_GROUP_IDX = X.BBS_GROUP_IDX
																	   							  AND BBS_TYPE = \'QnA\')
																	   AND DEL_YN = \'N\' ) BBS_CNT
													  FROM TBL_PROJECT A
										  		  JOIN TBL_COMPANY B
													    ON A.COMP_ID = B.COMP_ID 
													 WHERE A.COMP_ID = ?';
				if ($arg[1] != '') $query .= ' AND A.PRJ_NM LIKE ? ';	
									$query .= ' AND A.DEL_YN = ? 
													   AND B.DEL_YN = ?) RTABLE
								   WHERE ROW_NUM >= ? and ROW_NUM <= ?';
				if (!$arg[1]) array_splice($arg,1,1);
				
			return $this->db->query($query, $arg);
    }
    
    function getProjectViewForContent($arg)
    {
    	$query = 'SELECT A.PRJ_CNTNT
											,A.PRJ_SUMMARY
							    FROM TBL_PROJECT A
							    JOIN TBL_RESUME_FORM B
							      ON A.PRJ_IDX = B.PRJ_IDX
							   WHERE A.COMP_ID = ?
							     AND A.PRJ_IDX = ? 
							     AND A.DEL_YN = ?
							     AND B.DEL_YN = ?';
			return $this->db->query($query, $arg);     
    }
    
    function getProjectView($arg)
    {
    	$query = 'SELECT A.PRJ_IDX
											,A.PRJ_NM
											,CONVERT(VARCHAR(10),A.PRJ_STDT,121) PRJ_STDT1
											,CONVERT(VARCHAR(10),A.PRJ_EDDT,121) PRJ_EDDT1
											,CONVERT(VARCHAR(2),A.PRJ_STDT,114) PRJ_STDT2
											,CONVERT(VARCHAR(2),A.PRJ_EDDT,114) PRJ_EDDT2
											,SUBSTRING(CONVERT(VARCHAR(5),A.PRJ_STDT,114),4,2) PRJ_STDT3
				  						,SUBSTRING(CONVERT(VARCHAR(5),A.PRJ_EDDT,114),4,2) PRJ_EDDT3
											,A.PRJ_STS
											,A.PRJ_CNTNT
											,A.PRJ_SUMMARY
											,B.PERSONAL_USE_YN
											,B.EDUCATION_USE_YN
											,B.TECH_USE_YN
											,B.LANGUAGE2_USE_YN
											,B.WRITE_USE_YN
											,B.FAMILY_USE_YN
											,B.SCHOOL_USE_YN
											,B.CAREER_USE_YN
											,B.LANGUAGE_USE_YN
											,B.LICENSE_USE_YN
											,B.ARMY_USE_YN
											,B.TRAINING_USE_YN
											,B.SERVE_USE_YN
											,B.PRIZE_USE_YN
											,B.PC_USE_YN
											,B.CONTENT_USE_YN
											,B.FILE_USE_YN
											--
											,B.FAMILY_FORM_CNT
											,B.SCHOOL_FORM_CNT
											,B.CAREER_FORM_CNT
											,B.LICENSE_FORM_CNT
											,B.TRAINING_FORM_CNT
											,B.EDUCATION_FORM_CNT
											,B.SERVE_FORM_CNT
											,B.PRIZE_FORM_CNT
											,B.TECH_FORM_CNT
											,B.LANGUAGE2_FORM_CNT
											,B.WRITE_FORM_CNT
									
											--
											,C.DOMAIN_ID
							    FROM TBL_COMPANY C
							    JOIN TBL_PROJECT A
							      ON C.COMP_ID = A.COMP_ID
							    JOIN TBL_RESUME_FORM B
							      ON A.PRJ_IDX = B.PRJ_IDX
							   WHERE C.COMP_ID = ?
							     AND A.PRJ_IDX = ? 
							     AND A.DEL_YN = ?
							     AND A.DEL_YN = ?
							     AND B.DEL_YN = ?';
			return $this->db->query($query, $arg);     
    }
    
    function getSimpleProjectListForDomain($arg)
    {
    	$query = 'SELECT PRJ_IDX CODE
										  ,PRJ_NM NAME
								  FROM TBL_PROJECT
								 WHERE COMP_ID = (SELECT DOMAIN_ID FROM TBL_COMPANY WHERE DOMAIN_ID = ? AND DEL_YN = \'N\')
								   AND DEL_YN = ?';
   		return $this->db->query($query, $arg);     
    }
    
   	function getSimpleProjectList($arg)
   	{
   		
   		$query = 'SELECT PRJ_IDX CODE
										  ,PRJ_NM NAME
									  FROM TBL_PROJECT
									 WHERE COMP_ID = ?
									   AND DEL_YN = ?';
   		return $this->db->query($query, $arg);     
   	}
   	
   	function getProjectRegist($arg)
   	{
   		//array('p_prj_idx' => $arg1, 'p_step_idx' => $arg2 )
   		return $this->msdb->output('setCommonProjectRegist',$arg,'SELECT'); 
   	}
   	
   	function getProjectModify($arg)
   	{
   		return $this->msdb->output('setCommonProjectModify',$arg,'EXECUTE'); 
   	}
   	
   	// 컬럼단위 필수여부 체크하려고 했는데.. 이건 안할란다....
   	function getResumeConstContentList($arg)
   	{
   		 $query ='SELECT RSM_CNTNT_IDX
										  ,CNTNT_TITLE
										  ,CNTNT_COMMENT
										  ,ORD_NO
										  ,CNTNT_LEN
										  ,ESN_YN
										  ,MIN_LEN
								  FROM TBL_RESUME_FORM_CONTENT
								 WHERE RSM_IDX = (SELECT TOP 1 RSM_IDX 
								 										FROM TBL_RESUME_FORM 
								 									 WHERE PRJ_IDX = ?
								 									   AND DEL_YN = \'N\')
								   AND DEL_YN = \'N\' 
							ORDER BY ORD_NO';
							
			return $this->db->query($query, $arg);     
   	}
   	
   	function getSubComputerList($arg)
   	{
	   		$query = ' SELECT GRPA.CD_CPU_IDX
											   ,GRPA.CPU_NM
											   ,GRPB.CD_CPU_IDX SEL_CD_CPU_IDX
											   ,GRPB.CPU_IDX 
											   ,GRPB.CPU_ESN_YN
									   FROM TBL_CODE_COMPUTER GRPA
					LEFT OUTER JOIN ( SELECT CD_CPU_IDX
																	,CPU_IDX
																	,CPU_ESN_YN
															FROM TBL_RESUME_FORM_COMPUTER
													   WHERE RSM_IDX = (SELECT TOP 1 RSM_IDX FROM TBL_RESUME_FORM WHERE PRJ_IDX = ? AND DEL_YN = \'N\') 
															 AND DEL_YN = \'N\' ) GRPB
											 ON GRPA.CD_CPU_IDX = GRPB.CD_CPU_IDX
									  WHERE GRPA.DEL_YN = \'N\'';
   		 return $this->db->query($query, $arg);     
   	}
   	
   	function getSubLanguageList($arg)
   	{
			$query ='SELECT GRPA.LAN_IDX
									   ,GRPA.LAN_NM
									   ,GRPB.LAN_IDX SEL_LAN_IDX
									   ,GRPB.LAN_ESN_YN
									   ,GRPB.ORD
								 FROM TBL_CODE_LANGUAGE GRPA
			LEFT OUTER JOIN ( SELECT LAN_IDX
															,LAN_ESN_YN
															,ORD
													FROM TBL_RESUME_FORM_LANGUAGE
											   WHERE RSM_IDX = (SELECT TOP 1 RSM_IDX FROM TBL_RESUME_FORM WHERE PRJ_IDX = ? AND DEL_YN = \'N\') 
													 AND DEL_YN = \'N\' ) GRPB
									 ON GRPA.LAN_IDX = GRPB.LAN_IDX
							  WHERE GRPA.DEL_YN = \'N\'';   
			return $this->db->query($query, $arg);   
   	}
   	
   	function getSubLanguageProcess($arg)
   	{
   		$query = 'MERGE INTO TBL_RESUME_FORM_LANGUAGE AS T
										 USING (SELECT ? RSM_IDX , ? LAN_IDX) S
												ON (S.RSM_IDX = T.RSM_IDX
										   AND S.LAN_IDX = T.LAN_IDX)
									    WHEN MATCHED THEN
								UPDATE SET LAN_ESN_YN = ?
									  			,ORD = ?
									  			,DEL_YN =\'N\'
									    WHEN NOT MATCHED THEN  
									  INSERT (RSM_IDX
										  		 ,LAN_IDX
										  		 ,LAN_ESN_YN
									  			 ,ORD)
									  VALUES (?,?,?,?);';
			return $this->db->query($query, $arg);   
   	}
   	
   	function getSubLanguageDelProcess($arg,$listObj)
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
			
			$query = 'UPDATE TBL_RESUME_FORM_LANGUAGE
								   SET DEL_YN = ?   
								 WHERE RSM_IDX = ?
								   AND LAN_IDX IN ( SELECT LAN_IDX
																		  FROM TBL_RESUME_FORM_LANGUAGE TBL
																		 WHERE RSM_IDX = ?
																		   AND NOT EXISTS ( SELECT 1
																												  FROM (SELECT RES
																																  FROM ( SELECT ' . $str . ' ) P
																															   UNPIVOT (RES FOR IDX IN (' . $str2 . ')) AS UNPVT) SEQTBL
																											   WHERE TBL.LAN_IDX = SEQTBL.RES ) )';
			return $this->db->query($query, $arg);
		}
		
		
		
		function getSubComputerProcess($arg)
   	{
   		$query = 'MERGE INTO TBL_RESUME_FORM_COMPUTER AS T
										 USING (SELECT ? RSM_IDX , ? CD_CPU_IDX) S
												ON (S.RSM_IDX = T.RSM_IDX
										   AND S.CD_CPU_IDX = T.CD_CPU_IDX)
									    WHEN MATCHED THEN
								UPDATE SET CPU_ESN_YN = ?
													,DEL_YN =\'N\'
									    WHEN NOT MATCHED THEN  
									  INSERT (RSM_IDX
										  		 ,CD_CPU_IDX
									  			 ,CPU_ESN_YN)
									  VALUES (?,?,?);';
			return $this->db->query($query, $arg);   
   	}
   	
   	function getSubComputerDelProcess($arg,$listObj)
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
			
			$query = 'UPDATE TBL_RESUME_FORM_COMPUTER
								   SET DEL_YN = ?   
								 WHERE RSM_IDX = ?
								   AND CD_CPU_IDX IN (SELECT CD_CPU_IDX
																			  FROM TBL_RESUME_FORM_COMPUTER TBL
																			 WHERE RSM_IDX = ?
																			   AND NOT EXISTS ( SELECT 1
																													  FROM (SELECT RES
																																	  FROM ( SELECT ' . $str . ' ) P
																																   UNPIVOT (RES FOR IDX IN (' . $str2 . ')) AS UNPVT) SEQTBL
																												   WHERE TBL.CD_CPU_IDX = SEQTBL.RES ) )';
			return $this->db->query($query, $arg);
		}
		
		
		
   	
   	function getSubFileList($arg)
   	{
   		$query = 'SELECT RSM_FILE_IDX
										  ,ORD_NO
										  ,FILE_TITLE
										  ,FILE_COMMENT
										  ,FILE_MAX_SIZE
										  ,FILE_AVL_EXT
										  ,FILE_ESN_YN
								  FROM TBL_RESUME_FORM_FILE
								 WHERE RSM_IDX = (SELECT TOP 1 RSM_IDX FROM TBL_RESUME_FORM WHERE PRJ_IDX = ? AND DEL_YN = \'N\') 
								   AND DEL_YN = \'N\'';
			return $this->db->query($query, $arg);
   	}
   	
   	function getSubContentList($arg)
   	{
			 $query ='SELECT RSM_CNTNT_IDX
										  ,ORD_NO
										  ,CNTNT_TITLE
										  ,CNTNT_COMMENT
										  ,CNTNT_LEN
										  ,CNTNT_ESN_YN
										  ,CNTNT_MIN_LEN
								  FROM TBL_RESUME_FORM_CONTENT
								 WHERE RSM_IDX = (SELECT TOP 1 RSM_IDX FROM TBL_RESUME_FORM WHERE PRJ_IDX = ? AND DEL_YN = \'N\')
								   AND DEL_YN = \'N\'
					    ORDER BY ORD_NO';			    
			return $this->db->query($query, $arg);   
   	}
   	
   	function getSubContentProcess($arg)
   	{
   		$query = 'MERGE INTO TBL_RESUME_FORM_CONTENT AS T
										 USING (SELECT ? RSM_IDX , ? RSM_CNTNT_IDX) S
												ON (S.RSM_IDX = T.RSM_IDX
										   AND S.RSM_CNTNT_IDX = T.RSM_CNTNT_IDX)
									    WHEN MATCHED THEN
									  UPDATE SET ORD_NO = ?
									  			,CNTNT_TITLE = ?
									  			,CNTNT_COMMENT = ?
									  			,CNTNT_LEN = ?
									  			,CNTNT_MIN_LEN = ?
									  			,CNTNT_ESN_YN = ?
									    WHEN NOT MATCHED THEN  
									  INSERT (RSM_IDX,ORD_NO
								  			 ,CNTNT_TITLE
											 ,CNTNT_COMMENT
											 ,CNTNT_LEN
											 ,CNTNT_MIN_LEN
											 ,CNTNT_ESN_YN)
									  VALUES (?,?,?,?,?,?,?);';
			return $this->db->query($query, $arg);
   	}
   	
   	
   	function getSubContentDelProcess($arg,$listObj)
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
			
			$query = 'UPDATE TBL_RESUME_FORM_CONTENT
								   SET DEL_YN = ?   
								 WHERE RSM_IDX = ?
								   AND RSM_CNTNT_IDX IN ( SELECT RSM_CNTNT_IDX
																					  FROM TBL_RESUME_FORM_CONTENT TBL
																					 WHERE RSM_IDX = ?
																					   AND NOT EXISTS ( SELECT 1
																															  FROM (SELECT RES
																																			  FROM ( SELECT ' . $str . ' ) P
																																		   UNPIVOT (RES FOR IDX IN (' . $str2 . ')) AS UNPVT) SEQTBL
																																	 WHERE TBL.RSM_CNTNT_IDX = SEQTBL.RES ) )';
			return $this->db->query($query, $arg);
		}
		
		
		
		
		function getSubFileProcess($arg)
   	{
   		$query = 'MERGE INTO TBL_RESUME_FORM_FILE AS T
										 USING (SELECT ? RSM_IDX , ? RSM_FILE_IDX) S
												ON (S.RSM_IDX = T.RSM_IDX
										   AND S.RSM_FILE_IDX = T.RSM_FILE_IDX)
									    WHEN MATCHED THEN
									  UPDATE SET ORD_NO = ?
											  			,FILE_TITLE = ?
											  			,FILE_COMMENT = ?
											  			,FILE_MAX_SIZE = ?
											  			,FILE_AVL_EXT = ?
											  			,FILE_ESN_YN = ?
									    WHEN NOT MATCHED THEN  
									  INSERT (RSM_IDX
									  			 ,ORD_NO
								  			   ,FILE_TITLE
												   ,FILE_COMMENT
												   ,FILE_MAX_SIZE
												   ,FILE_AVL_EXT
												   ,FILE_ESN_YN)
											  VALUES (?,?,?,?,?,?,?);';
			return $this->db->query($query, $arg);
   	}
   	
   	
   	function getSubFileDelProcess($arg,$listObj)
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
			
			$query = 'UPDATE TBL_RESUME_FORM_FILE
								   SET DEL_YN = ?   
								 WHERE RSM_IDX = ?
								   AND RSM_FILE_IDX IN (  SELECT RSM_FILE_IDX
																					  FROM TBL_RESUME_FORM_FILE TBL
																					 WHERE RSM_IDX = ?
																					   AND NOT EXISTS ( SELECT 1
																															  FROM (SELECT RES
																																			  FROM ( SELECT ' . $str . ' ) P
																																		   UNPIVOT (RES FOR IDX IN (' . $str2 . ')) AS UNPVT) SEQTBL
																																	 WHERE TBL.RSM_FILE_IDX = SEQTBL.RES ) )';
			return $this->db->query($query, $arg);
		}
		
		
   	
   	function getRsmIdxList($arg)
   	{
   		$query = 'SELECT TOP 1 
										   RSM_IDX
								  FROM TBL_RESUME_FORM
								 WHERE PRJ_IDX = ?
								   AND DEL_YN = \'N\'';
   		return $this->db->query($query, $arg);
   	}
   	
   	function getProjectDelete($arg)
   	{
   		$query = 'UPDATE TBL_PROJECT 
   								 SET DEL_YN = \'Y\' 
   							 WHERE PRJ_IDX = ? 
   							 	 AND DEL_YN = \'N\' 
   							 	 AND PRJ_STS = \'C\'';
   		$this->db->query($query, $arg);
   		return $this->db->affected_rows();

   	}
   	
   	
   	
   }