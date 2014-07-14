<?
	class Stepmanagement_model extends CI_Model
	{
	
		function getStepList($arg)
    {
    	
    	$query = 'SELECT STEP_IDX
										  ,STEP_NM
										  ,ORD_NO
										  ,CONVERT(VARCHAR(10),A.STEP_STDT,121) STEP_STDT1
											,CONVERT(VARCHAR(10),A.STEP_EDDT,121) STEP_EDDT1
											,CONVERT(VARCHAR(2),A.STEP_STDT,114) STEP_STDT2
											,CONVERT(VARCHAR(2),A.STEP_EDDT,114) STEP_EDDT2
											,SUBSTRING(CONVERT(VARCHAR(5),A.STEP_STDT,114),4,2) STEP_STDT3
				  						,SUBSTRING(CONVERT(VARCHAR(5),A.STEP_EDDT,114),4,2) STEP_EDDT3
										  ,(SELECT COUNT(*) FROM TBL_STEP_DATA X WHERE X.PRJ_IDX = A.PRJ_IDX AND X.STEP_IDX = A.STEP_IDX ) CNT
								  FROM TBL_STEP A
								 WHERE PRJ_IDX = ?
								   AND DEL_YN = ?';
    	return $this->db->query($query, $arg);
    }
    
    function getDataList($arg)
    {
    	$query = 'SELECT A.STEP_DATA_FRM_IDX
											,B.STEP_IDX
											,B.PRJ_IDX
											,B.GUBUN
											,A.FRM_CNTNT
											,B.CNT
											,B.ETCVAR
							    FROM TBL_STEP_DATA_FORM A
									JOIN (SELECT MAX(PRJ_IDX) PRJ_IDX
															,MAX(STEP_IDX) STEP_IDX
															,MAX(ETC1VAR) ETCVAR
															,COUNT(*) CNT 
															,GUBUN
													FROM TBL_STEP_DATA
											   WHERE PRJ_IDX = ?
												   AND STEP_IDX = ? 
											GROUP BY GUBUN) B
						  	    ON A.PRJ_IDX = B.PRJ_IDX 
									 AND A.STEP_IDX = B.STEP_IDX 
									 AND A.GUBUN = B.GUBUN
							   WHERE A.DEL_YN = ?';
    	return $this->db->query($query, $arg);
    }
    
    function getSimpleStepList($arg)
    {
    	 $query = 'SELECT STEP_IDX CODE
											 ,STEP_NM NAME
									 FROM TBL_STEP
									WHERE PRJ_IDX = ?
									  AND DEL_YN = ?';
				return $this->db->query($query, $arg);					  
    }
    
    function getDataDelete($arg)
    {
    	$query = 'DELETE FROM TBL_STEP_DATA WHERE PRJ_IDX = ? AND STEP_IDX = ?';
    	return $this->db->query($query, $arg);
  	}
    
    function getDataInsert($arg)
    {
    
    	$query = 'INSERT INTO 
    									 TBL_STEP_DATA 
    									 (PRJ_IDX,STEP_IDX,GUBUN,APPLY_NO,APPLY_NM,ETC1VAR,ETC1VALUE) VALUES(?,?,?,?,?,?,?)';
    	return $this->db->query($query, $arg);					  		
    	
    }
    
    function getCreateForm($arg1,$arg2)
    {
    	return $this->msdb->output('sp_insertFormdata', array('p_prj_idx' => $arg1, 'p_step_idx' => $arg2 ), 'EXECUTE'); 
    }
    
    function getProjectPassCode($arg)
    {
    	$query = 'SELECT PASSWD 
    							FROM TBL_PROJECT 
    						 WHERE PRJ_IDX = ?
    						   AND DEL_YN = \'N\'';
    	return $this->db->query($query, $arg);
    }
    
    function getDataViewList($arg1,$arg2)
    {
    	
    	 $query = 'SELECT APPLY_NO
											 ,APPLY_NM' . 
											 $arg1
											 
										 . ' FROM TBL_STEP_DATA
									      WHERE PRJ_IDX = ?
									        AND STEP_IDX = ?
									        AND GUBUN = ?';
    	return $this->db->query($query, $arg2);		
    }
    
    function getStepRegist($arg)
    {
    	$query = 'INSERT INTO TBL_STEP (PRJ_IDX,STEP_NM) VALUES(?,?)';
    	return $this->db->query($query, $arg);
    }
    
    function getStepModify($arg)
    {
    	$query = 'UPDATE TBL_STEP
    							 SET STEP_NM = ?,
    							 		 STEP_STDT = CONVERT(DATETIME,?),
    							 		 STEP_EDDT = CONVERT(DATETIME,?)
    						 WHERE PRJ_IDX = ?
    						 	 AND STEP_IDX = ?';
    	return $this->db->query($query, $arg);
    }
    
    function getStepDelete($arg)
    {
    	return $this->msdb->output('setCommonStepDelete', $arg, 'EXECUTE'); 
    }
    
    function getEtcVarList($arg)
    {
    	   $query = 'SELECT ETC1VAR
											   ,FRM_CNTNT
									       FROM TBL_STEP_DATA_FORM A
										   JOIN (SELECT TOP 1
											      	    ETC1VAR
											     	   ,PRJ_IDX
											     	   ,STEP_IDX
											     	   ,GUBUN
												   FROM TBL_STEP_DATA 
												  WHERE PRJ_IDX = ?
												    AND STEP_IDX = ?
												    AND GUBUN = ?) B
									         ON A.PRJ_IDX = B.PRJ_IDX
									        AND A.STEP_IDX = B.STEP_IDX
									        AND A.GUBUN = B.GUBUN';
				return $this->db->query($query, $arg);					   
    }
    
    function getStepFormProcess($arg)
    {
	   $query = 'UPDATE TBL_STEP_DATA_FORM 
							    SET FRM_CNTNT = ?
							  WHERE PRJ_IDX = ?
							    AND STEP_IDX = ?
							    AND GUBUN = ?
							    AND STEP_DATA_FRM_IDX = ?
							    AND DEL_YN = ?';
    	return $this->db->query($query, $arg);					   
    }
    
    function getApplyList($DISPLAY_YN
    										 ,$COMP_ID
    										 ,$PRJ_IDX
    										 ,$UNIT_IDX
    										 ,$STEP_IDX
    										 ,$NAMEKOR
    										 ,$S_NAI
    										 ,$E_NAI
    										 ,$SEX_CD
    										 ,$SCH_NM
    										 ,$SCH_TP
    										 ,$SCH_FGRD_TP
    										 ,$CAREER_TP
    										 ,$CAREER_CMP_NM
    										 ,$S_CAREER_SUM
    										 ,$E_CAREER_SUM
    										 ,$LAN_IDX
    										 ,$ROW_NUM1
    										 ,$ROW_NUM2
    										 ,$flag)
    {
    	 $query = null;
    	 if ($flag != 'excel') 
    	 $query .= 'SELECT *
									 FROM (';
				
			 $query .= 'SELECT BASE.* ';
									 
			 if( $DISPLAY_YN[0]->CAREER_USE_YN == 'Y' ) {
			 $query .= '							
														   ,(ISNULL(EXT3.CAREER_SUM / 12,0)) CAREER_SUM_YEAR
														   ,(ISNULL(EXT3.CAREER_SUM % 12,0)) CAREER_SUM_MONTH
														   ,EXT3.CAREER_CMP_NM	
														   ,EXT3.CAREER_STDT
														   ,EXT3.CAREER_EDDT ';
			 }
			 
			 if( $DISPLAY_YN[0]->SCHOOL_USE_YN == 'Y' ) {
			 $query .= '							
														   ,EXT1.SCH_NM
														   ,EXT1.SCH_MAJOR_NM ';
			 }
			 
			
			 $query .= '						 ,SUBEXT4.UNIT_NM';	
			 
			 $arrayList[] = $COMP_ID;
			 $query .= ',(	SELECT TOP 1 WRK_PLC_NM
										    FROM TBL_APPLY_LOCATION EXT5 
										    JOIN TBL_WORKPLACE SUBEXT5
										      ON EXT5.WP_IDX = SUBEXT5.WP_IDX
										   WHERE EXT5.PRJ_IDX = BASE.PRJ_IDX
										     AND EXT5.APPL_IDX = BASE.APPL_IDX
											 	 AND EXT5.DEL_YN = \'N\'
										     AND EXT5.ORD = 1
										     AND COMP_ID = ?
										     AND SUBEXT5.DEL_YN = \'N\' ) WRK_PLC_NM ';
			 
			 if( $DISPLAY_YN[0]->LANGUAGE_USE_YN == 'Y'&& $LAN_IDX != '' ) {
			 $query .= '								
														   ,EXT2.LAN_SCORE
														   ,( SELECT LVL_NM FROM TBL_CODE_LANGUAGE_LVLLIST WHERE LAN_IDX = EXT2.LAN_IDX AND LAN_LVL_IDX = EXT2.LAN_LVL_IDX AND DEL_YN = \'N\' ) LAN_GRADE ';
			 }
			 
			 $arrayList[] = $PRJ_IDX;
			 $query .= '
														   ,ROW_NUMBER() OVER (ORDER BY BASE.APPL_IDX DESC) ROW_NUM
														   ,COUNT(*) OVER() ALL_LIST_COUNT 
												  FROM (SELECT A.APPLY_NO
																		  ,CONVERT(VARCHAR(16),A.APPL_DT,121) APPL_DT 
																		  ,A.NAMEKOR
																		  ,A.SEX_CD
																		  ,A.SEX_NM
																		  ,A.NAI
																		  ,A.PRJ_IDX
																		  ,A.APPL_IDX  
																	  FROM TBL_APPLY A
																	  JOIN TBL_APPLY_PERSONAL B
																		ON A.PRJ_IDX = B.PRJ_IDX
																	   AND A.APPL_IDX = B.APPL_IDX
																	 WHERE A.PRJ_IDX = ?   ';
			 
			 if ($STEP_IDX != '' )
			 {
			 	$arrayList[] = $STEP_IDX;
			 	$query .= '								AND A.STEP_IDX = ? ';
			 }
				
			 
			 
			 if ($NAMEKOR != '')
			 {
			 	$arrayList[] = $NAMEKOR;											   
			 	$query .= '									 AND NAMEKOR LIKE ? ';
			 }
			 
			 if ($S_NAI != '')
			 {
			 	$arrayList[] = $S_NAI;		
			 	$query .= '									 AND NAI >= ? ';
			 }
			 
			 if ($E_NAI != '')
			 {
			 	$arrayList[] = $E_NAI;
			 	$query .= '									 AND NAI <= ? ';
			 }
			 
			 if ($SEX_CD != '')
			 {
			 	$arrayList[] = $SEX_CD;
			 	$query .= '									 AND SEX_CD = ? ';
			 }
			 
			 $query .= '
																	   AND APPL_YN = \'Y\'				   
																	   AND A.DEL_YN = \'N\'		   
																	   AND B.DEL_YN = \'N\' ';
			 if( $DISPLAY_YN[0]->CAREER_USE_YN == 'Y' ) {
				 if ($CAREER_TP != '')
				 {
				 	$arrayList[] = $CAREER_TP;
				 	//																		   																		  
				  $query .= '
																		   AND A.CAREER_TP = \'C\' ';
				 }
			 }
			 $query .= '
																) BASE ';
			 
			
			 $query .= ' 				JOIN TBL_APPLY_UNIT EXT4
													  ON BASE.PRJ_IDX = EXT4.PRJ_IDX
													 AND BASE.APPL_IDX = EXT4.APPL_IDX 
													JOIN TBL_UNIT SUBEXT4
													  ON EXT4.PRJ_IDX = SUBEXT4.PRJ_IDX
													 AND EXT4.UNIT_IDX = SUBEXT4.UNIT_IDX ';
			
			 if( $DISPLAY_YN[0]->SCHOOL_USE_YN == 'Y' ) {
			 $arrayList[] = $PRJ_IDX;	
			 //-- 학력사항 -- 
			 $query .= '
													   
									         JOIN (SELECT  REXT1.SCH_NM
																			  ,REXT1.SCH_TP
																			  ,REXT1.SCH_MAJOR_NM
																			  ,REXT1.PRJ_IDX
																			  ,REXT1.APPL_IDX
																		  FROM (  SELECT ROW_NUMBER() OVER (PARTITION BY APPL_IDX ORDER BY SCH_SEQ DESC) SCH_ORD
																										,SCH_NM
																										,SCH_TP 
																										,SCH_MAJOR_NM
																										,PRJ_IDX 
																										,APPL_IDX
																								FROM TBL_APPLY_SCHOOL
																						   WHERE PRJ_IDX = ? ';
				
			 if ($SCH_NM != '') 
			 {
			 	$arrayList[] = $SCH_NM;	
			 	$query .= ' 															 AND SCH_NM LIKE ? ';
			 }
			 
			 if ($SCH_TP != '')
			 {
			 	$arrayList[] = $SCH_TP;	
				$query .= '													     AND SCH_TP = ? ';
			 }
			 
			 if ($SCH_FGRD_TP != '')
			 {
			 	$arrayList[] = $SCH_FGRD_TP;	
				$query .= '												     AND SCH_FGRD_TP = ? ';
			 }
			 	$query .= '
			 
																							 AND DEL_YN = \'N\' 
																					  ) REXT1
																		 WHERE REXT1.SCH_ORD = 1 ) EXT1
														 ON BASE.PRJ_IDX = EXT1.PRJ_IDX
														AND BASE.APPL_IDX = EXT1.APPL_IDX ';
			 }
			 
			 if( $DISPLAY_YN[0]->LANGUAGE_USE_YN == 'Y' && $LAN_IDX != '' ) {
			 	//-- 어학시험 --
			 $query .= '
													   
								           JOIN TBL_APPLY_LANGUAGE EXT2
														 ON BASE.PRJ_IDX = EXT2.PRJ_IDX
														AND BASE.APPL_IDX = EXT2.APPL_IDX  ';
			 }
			 
			 if( $DISPLAY_YN[0]->CAREER_USE_YN == 'Y' ) {
			 $arrayList[] = $PRJ_IDX;	
			 //-- 경력사항 --
			 $query .= ' 					
								           JOIN (   SELECT CAREER_SUM
																				  ,CAREER_CMP_NM	
																				  ,CAREER_STDT
																				  ,CAREER_EDDT
																				  ,PRJ_IDX
																				  ,APPL_IDX
																		  FROM (SELECT IEXT3.*
																								  ,ROW_NUMBER() OVER (PARTITION BY APPL_IDX ORDER BY CAREER_EDDT DESC) CAREER_ORD 
																						  FROM (SELECT CAREER_CMP_NM
																												  ,CAREER_EDDT
																												  ,CAREER_STDT
																												  ,PRJ_IDX
																												  ,APPL_IDX
																												  ,SUM(DATEDIFF(MM,CAREER_STDT,CAREER_EDDT)) OVER(PARTITION BY APPL_IDX) CAREER_SUM
																										  FROM TBL_APPLY_CAREER
																										 WHERE PRJ_IDX = ? 
																										   AND DEL_YN = \'N\') IEXT3
																						 WHERE 1=1 ';
				
				if ($CAREER_CMP_NM != '') 
				{
					$arrayList[] = $CAREER_CMP_NM;	
				  $query .= '																	   AND CAREER_CMP_NM LIKE ? ';
				}
				
				if ($S_CAREER_SUM != '') 
				{
					$arrayList[] = $S_CAREER_SUM;	
					$query .= '												   AND CAREER_SUM > ? ';
				}
				
				if ($E_CAREER_SUM != '') 
				{
					$arrayList[] = $E_CAREER_SUM;	
					$query .= '											     AND CAREER_SUM < ? ';
				}
				$query .= '
																							) REXT3
																		 WHERE CAREER_ORD = 1 ) EXT3
														  ON BASE.PRJ_IDX = EXT3.PRJ_IDX
														 AND BASE.APPL_IDX = EXT3.APPL_IDX ';
				}
				
				$query .= '
													  WHERE 1=1 ';
				
				if ($UNIT_IDX != '' ) 
				{
					$arrayList[] = $UNIT_IDX;	
					$query .= '  			 AND EXT4.UNIT_IDX = ?  ';
				}	
			
				$query .= '
														 AND EXT4.DEL_YN = \'N\'
													 	 AND EXT4.ORD = 1
													 	 AND SUBEXT4.DEL_YN = \'N\'';				  
				
				if( $DISPLAY_YN[0]->LANGUAGE_USE_YN == 'Y' && $LAN_IDX != '' ) {
					
					if ($LAN_IDX != '')
					{
						$arrayList[] = $LAN_IDX;	
						//-- 어학시험 --
						$query .= '
													    
													    AND EXT2.LAN_IDX = ? ';
					}
					$query .= '
													    AND EXT2.DEL_YN = \'N\' ';
					
					
				}
				
				$arrayList[] = $ROW_NUM1;
				$arrayList[] = $ROW_NUM2;
				
				if ($flag != 'excel') 	
				{
				$query .= ' 
											) RTABLE ';
				
				$query .= '		
								WHERE ROW_NUM >= ? and ROW_NUM <= ? ';
				}
//				echo $query;
//				exit;
			return $this->db->query($query,$arrayList);    	
    }
    
    function getMoveStep($arg)
    {
    	return $this->msdb->output('setCommonStepMove',$arg, 'EXECUTE'); 
    }
    
    function getUnitTreeList($arg)
    {
    	$query = 'SELECT A.UNIT_IDX CODE
    									,A.UNIT_NM NAME
    									,A.PUNIT_IDX
    									,(SELECT COUNT(*) FROM TBL_UNIT X WHERE PRJ_IDX = ? AND X.PUNIT_IDX = A.UNIT_IDX) CNT
    						  FROM TBL_UNIT A
    						 WHERE A.PRJ_IDX = ?';
    						  
    
    	if ($arg[2] == '' || $arg[2] == NULL)
			{
				array_splice($arg,2,1);
				$query .= ' AND A.PUNIT_IDX IS NULL ';
			}
			else
			{
				$query .= ' AND A.PUNIT_IDX = ?';
			}
			$query .= ' AND A.DEL_YN = ? ';
			//echo $query;
			return $this->db->query($query,$arg);
    }
    
    function getUnitTopList($arg)
    {
    	$query = 'SELECT UNIT_IDX CODE
    								  ,PUNIT_IDX
										  ,UNIT_NM NAME
								  FROM TBL_UNIT
								 WHERE PRJ_IDX = ?
								   AND PUNIT_IDX IS NULL
								   AND DEL_YN = ?';
			return $this->db->query($query,$arg);
    }
    
    function getUnitLevelList($arg)
    {
    	$query = 'SELECT X.UNIT_IDX CODE
										  ,X.UNIT_NM NAME
										  ,(SELECT COUNT(*) CNT FROM TBL_UNIT Y WHERE Y.PRJ_IDX = X.PRJ_IDX AND Y.PUNIT_IDX = X.UNIT_IDX AND DEL_YN = \'N\') CNT
								  FROM TBL_UNIT X
								 WHERE PRJ_IDX = ?';
			
			if ($arg[1] == '' || $arg[1] == NULL)
			{
				array_splice($arg,1,1);
				$query .= ' AND PUNIT_IDX IS NULL ';
			}
			else
			{
				$query .= ' AND PUNIT_IDX = ?';
			}
			$query .= ' AND DEL_YN = ? ';
			//echo $query;
			return $this->db->query($query,$arg);
    }
    
    function getUnitRegist($arg)
    {
    	$query = 'INSERT INTO TBL_UNIT (PRJ_IDX,UNIT_NM,PUNIT_IDX) VALUES(?,?,?)';
    	//echo $query;
    	//var_dump($arg);
    	//exit;
    	return $this->db->query($query,$arg);
    }
    
    function getUnitModify($arg)
    {
    	$query = 'UPDATE TBL_UNIT
					    	   SET UNIT_NM = ?
					    	 WHERE PRJ_IDX = ? 
					    	   AND UNIT_IDX = ?';
    	
    	return $this->db->query($query,$arg);
  	}
  	
  	function getUnitDelete($arg)
  	{
  			 $query = 'UPDATE TBL_UNIT
					    	   		SET DEL_YN = ?
					    	 		WHERE PRJ_IDX = ? 
					    	   		AND UNIT_IDX = ?';
    	
    	return $this->db->query($query,$arg);
  	}
  	
  	function getWorkPlaceList($arg)
  	{
  		$query = 'SELECT A.WP_IDX CODE
										  ,A.WRK_PLC_NM NAME
										  ,B.UNIT_IDX
								  FROM TBL_WORKPLACE A
		   LEFT OUTER JOIN (SELECT WP_IDX 
														  ,UNIT_IDX
												  FROM TBL_UNIT_WORK_PLACE
										     WHERE PRJ_IDX = ? 
										       AND UNIT_IDX = ?
										       AND DEL_YN = ?) B
										ON A.WP_IDX = B.WP_IDX
								 WHERE A.COMP_ID = ?
								   AND A.DEL_YN = ?'; 
  		return $this->db->query($query,$arg);  
  	}
  
  
  	function getWorkManagerList($arg)
  	{
  		$query = 'SELECT MANAGER_ID 
										  ,MANAGER_NM
										  ,MANAGER_TP
									  FROM TBL_MANAGER
									 WHERE COMP_ID = ?
									   AND MANAGER_TP IN (\'U\',\'C\')
									   AND USE_YN = ?
									   AND DEL_YN = ?';
			return $this->db->query($query,$arg);  
  	}
  
  	function getUnitAuthList($arg)
  	{
			$query = 'SELECT A.APPLY_CNT
										  ,B.WRK_PLC_CNT
									  FROM TBL_UNIT A
									  JOIN TBL_UNIT_RESUME B
									    ON A.PRJ_IDX = B.PRJ_IDX 
									   AND A.UNIT_IDX = B.UNIT_IDX
									 WHERE A.PRJ_IDX = ?
									   AND A.UNIT_IDX = ?
									   AND RSM_IDX = ?
									   AND A.DEL_YN = ?
									   AND B.DEL_YN = ?';
			return $this->db->query($query,$arg);  
  	}
  
  	function getManagerAuthList($arg)
  	{
  		$query = 'SELECT MANAGER_ID
										  ,APPLY_MNG
										  ,APPLY_VW
										  ,MAIL_MNG
										  ,SMS_MNG
									  FROM TBL_MANAGER_AUTH
									 WHERE PRJ_IDX = ?
									   AND UNIT_IDX = ?
									   AND DEL_YN = ?';
			return $this->db->query($query,$arg);  						   
  	}
  	
  	function getUnitLeafNodePlaceList($arg)
  	{
  		 $query = 'SELECT B.WRK_PLC_NM
										   ,B.WP_IDX
										   ,A.PRJ_IDX
										   ,A.UNIT_IDX
										   ,C.WRK_PLC_CNT
										   ,C.WRK_PLC_YN
									   FROM TBL_UNIT_RESUME C
									   JOIN TBL_UNIT_WORK_PLACE A
									     ON C.PRJ_IDX = A.PRJ_IDX
									    AND C.UNIT_IDX = A.UNIT_IDX
									   JOIN TBL_WORKPLACE B
										 ON A.WP_IDX = B.WP_IDX
									  WHERE B.COMP_ID = ?
									    AND C.PRJ_IDX =?
									    AND C.UNIT_IDX = ?
										AND A.DEL_YN = \'N\'
										AND B.DEL_YN = \'N\'
										AND C.DEL_YN = \'N\'';
  		return $this->db->query($query,$arg);  						   
  	}
  	
  	function getUnitLeafNodeManagerList($arg)
  	{
  		$query = ' SELECT C.MANAGER_TP
										   ,C.MANAGER_ID
										   ,C.MANAGER_NM
										   ,B.PRJ_IDX
										   ,B.UNIT_IDX
									   FROM TBL_MANAGER_AUTH B
									   JOIN TBL_MANAGER C
										 ON B.MANAGER_ID = C.MANAGER_ID
									  WHERE C.COMP_ID = ?
									    AND B.PRJ_IDX = ?
											AND B.UNIT_IDX = ?
											AND C.USE_YN = \'Y\'
											AND C.DEL_YN = \'N\'
											AND B.DEL_YN = \'N\' ';
			return $this->db->query($query,$arg);  						   
  	}
  	
  	function getUnitLeafNodeList($arg)
  	{
  		$query = 'WITH TREE_LIST(PRJ_IDX, UNIT_IDX, PUNIT_IDX, UNIT_NM,APPLY_CNT,CODELIST,PATH,CHK) --SRT
								AS
								(
									SELECT PRJ_IDX
											  ,UNIT_IDX
											  ,PUNIT_IDX
											  ,UNIT_NM 
											  ,APPLY_CNT
											--,CAST(UNIT_IDX AS VARBINARY(900)) SRT
												,CONVERT(VARCHAR(100), CONVERT(VARCHAR(20),UNIT_IDX) ) CODELIST
											  ,CONVERT(VARCHAR(100), UNIT_NM) PATH
											  ,(SELECT UNIT_IDX 
													  FROM (SELECT UNIT_IDX
																			  ,ROW_NUMBER() OVER (ORDER BY UNIT_IDX) STING 
																	  FROM TBL_UNIT X 
																	 WHERE X.PRJ_IDX = F.PRJ_IDX 
																	   AND X.PUNIT_IDX = F.UNIT_IDX) TBL 
													 WHERE STING = 1) CHK
										  FROM TBL_UNIT F
										 WHERE PRJ_IDX = ?
										   AND PUNIT_IDX IS NULL 
										   AND DEL_YN = ?
										 UNION ALL		
										SELECT R.PRJ_IDX
											  ,R.UNIT_IDX
											  ,R.PUNIT_IDX
											  ,R.UNIT_NM 
											  ,R.APPLY_CNT
											--,CAST(SRT + CAST(R.UNIT_IDX AS VARBINARY(10)) AS VARBINARY(900))
												,CONVERT(VARCHAR(100), CODELIST + \'|\' + CONVERT(VARCHAR(20),R.UNIT_IDX) ) CODELIST
											  ,CONVERT(VARCHAR(100), PATH + \' - \' + R.UNIT_NM ) 
											  ,(SELECT UNIT_IDX 
													  FROM (SELECT UNIT_IDX
																			  ,ROW_NUMBER() OVER (ORDER BY UNIT_IDX) STING 
																	  FROM TBL_UNIT X 
																	 WHERE X.PRJ_IDX = R.PRJ_IDX 
																	   AND X.PUNIT_IDX = R.UNIT_IDX) TBL 
													 WHERE STING = 1) CHK
										  FROM TBL_UNIT AS R
								      JOIN TREE_LIST AS C
								        ON R.PUNIT_IDX = C.UNIT_IDX
								     WHERE R.PRJ_IDX = ?
								       AND R.DEL_YN = ?
								)	
											SELECT PRJ_IDX
													  ,UNIT_IDX
													  ,UNIT_NM
													  ,PATH
													  ,CODELIST
													  ,APPLY_CNT
											  FROM TREE_LIST 
											 WHERE CHK IS NULL';
											 
			return $this->db->query($query,$arg);  						   
  	}
  	
  	//수험번호 체계가져오는 부분 
  	function getApplyNoList($arg)
  	{
			  		$query = 'SELECT A.*
														,CASE WHEN B.TABLE_NAME IS NOT NULL THEN \'ON\' ELSE \'OFF\' END SEQ_YN
														,IDENT_CURRENT(SEQ_NM) SEQ_NO
												FROM (SELECT CASE APPL_TP 
																	  WHEN \'U\' THEN 
																		\'seq_applyno_\' + CONVERT(VARCHAR(20),PRJ_IDX) + \'_\' + CONVERT(VARCHAR(20),UNIT_IDX) 
																	  WHEN \'P\' THEN 
																		\'seq_applyno_\' + CONVERT(VARCHAR(20),PRJ_IDX)
																	  ELSE NULL
																	  END SEQ_NM
																,APPL_PREFIX
																,APPL_SUFFIX
																,APPL_LEN
																,APPL_TP
															FROM TBL_APPLY_CREATE
														   WHERE PRJ_IDX = ?
														     AND UNIT_IDX = ?
															 AND DEL_YN = ?) A
										 LEFT OUTER JOIN INFORMATION_SCHEMA.TABLES B
													  ON A.SEQ_NM = B.TABLE_NAME';
			return $this->db->query($query,$arg);
  	}
  	
  	 	
  	//지원분야 및 자격요건관리에서 업데이트또는 insert 되는 부분 
  	
  	
  	//수험번호
  	function getApplyNoProcess($arg)
  	{
  		return $this->msdb->output('applyNoSequenceProcess', $arg, 'EXECUTE'); 
  	}
  	
  	//채용인원
  	function getUpdateUnitApplyCount($arg)
  	{
  		$query = 'UPDATE TBL_UNIT
								   SET APPLY_CNT = ?
								 WHERE PRJ_IDX = ?
								   AND UNIT_IDX = ?
								   AND DEL_YN = ?';
			return $this->db->query($query,$arg);					   
  	}
  	
  	// 희망근무지 관련
  	// 근무지 지망수 데이터
  	function getUpdatePlaceCount($arg)
  	{
  		$query = 'MERGE INTO TBL_UNIT_RESUME AS T
										 USING (SELECT ? PRJ_IDX , ? UNIT_IDX, ? RSM_IDX) S
											ON (S.PRJ_IDX = T.PRJ_IDX
										   AND S.UNIT_IDX = T.UNIT_IDX
										   AND S.RSM_IDX = T.RSM_IDX)
										  WHEN MATCHED THEN
										UPDATE SET WRK_PLC_YN = ?,
												   WRK_PLC_CNT = ?,
												   DEL_YN = ?
										  WHEN NOT MATCHED THEN  
										INSERT (UNIT_IDX,RSM_IDX,PRJ_IDX,WRK_PLC_YN,WRK_PLC_CNT) VALUES(?,?,?,?,?);';
			return $this->db->query($query,$arg);					   
  	}
  	
  	// 희망근무지 모집단위별 선택한 근무지 리스트
  	function getUpdatePlaceList($arg)
  	{
  		$query = 'MERGE INTO TBL_UNIT_WORK_PLACE AS T
										 USING (SELECT ? PRJ_IDX , ? UNIT_IDX , ? WP_IDX) S
										    ON (S.PRJ_IDX = T.PRJ_IDX 
										   AND S.UNIT_IDX = T.UNIT_IDX 
										   AND S.WP_IDX = T.WP_IDX)
									      WHEN MATCHED THEN
									    UPDATE SET DEL_YN = ?
										  WHEN NOT MATCHED THEN 
										INSERT (UNIT_IDX,PRJ_IDX,WP_IDX,DEL_YN) values(?,?,?,?);';
			return $this->db->query($query,$arg);					   
  	}
  	
  	// 권한 데이터 처리 
  	function getUpdateManagerAuth($arg)
  	{
  		
  		 $query ='MERGE INTO TBL_MANAGER_AUTH AS T
										 USING (SELECT ? PRJ_IDX , ? UNIT_IDX , ? MANAGER_ID) S
										    ON (T.PRJ_IDX = S.PRJ_IDX
										   AND  T.UNIT_IDX = S.UNIT_IDX
										   AND  T.MANAGER_ID = S.MANAGER_ID)
										  WHEN MATCHED THEN
										UPDATE SET APPLY_MNG = ?,
														   APPLY_VW = ?,
														   MAIL_MNG = ?,
														   SMS_MNG = ?,
														   DEL_YN = \'N\'
									  WHEN NOT MATCHED THEN 
									INSERT (PRJ_IDX ,UNIT_IDX , MANAGER_ID,APPLY_MNG,APPLY_VW,MAIL_MNG,SMS_MNG) values(?,?,?,?,?,?,?);';
			return $this->db->query($query,$arg);									  
  	}
  	
  	function getDeleteManagerAuth($arg)
  	{
  		$query = 'UPDATE TBL_MANAGER_AUTH
  								 SET DEL_YN = \'Y\'
  							 WHERE PRJ_IDX = ?
  							   AND UNIT_IDX = ?
  							   AND MANAGER_ID = ?';
			return $this->db->query($query,$arg);									  
  	}
  	
  	function getUnitRequireDelete($arg)
  	{
  		return $this->msdb->output('setCommonUnitRequireDelete', $arg, 'EXECUTE'); 
  	}
  	
  	// getMajorAffiliationList
  	
  	   
    function getResumeFormSetList($arg)
    {
    	$query = 'SELECT A.LAN_IDX 
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
								   AND B.DEL_YN = ?';
			return $this->db->query($query,$arg);
    }
    
    function getResumeIndex($arg)
    {
    	$query = 'SELECT TOP 1 RSM_IDX
								  FROM TBL_RESUME_FORM						
								 WHERE COMP_ID = ?
								   AND PRJ_IDX = ?
								   AND DEL_YN = ?';
			return $this->db->query($query,$arg);					   
    }
  	
  	function getConfirmUnitDelete($arg)
  	{
  		$query = 'SELECT COUNT(*) STEP_COUNT 
							    FROM TBL_STEP 
							   WHERE PRJ_IDX = ?
							     AND STEP_STDT <= GETDATE()
							     AND STEP_EDDT >= GETDATE()
							     AND DEL_YN = ?';
			return $this->db->query($query,$arg);					   				     
  	}
  	
  	function getCompanyInfoDtl($arg)
  	{
  		$query = 'SELECT A.EMAIL
											,A.CMP_TEL
											,A.CEO_NM
							    FROM TBL_COMPANY_DTL A
							   WHERE EXISTS (SELECT 1
															   FROM TBL_COMPANY B
															  WHERE B.COMP_ID = ?
															    AND B.COMP_ID = A.COMP_ID
															    AND B.DEL_YN = ?)';
			return $this->db->query($query,$arg);
  	}
  	
  	function getApplyStepHistory($arg)
  	{
  		$query = 'SELECT A.LOG_IP
										  ,CONVERT(VARCHAR(24),A.LOG_DT,121) LOG_DT
										  ,B.STEP_NM
										  ,B.DEL_YN
										  ,C.MANAGER_ID
										  ,C.MANAGER_NM
										  ,C.DEL_YN
										  ,C.USE_YN
										  ,ROW_NUMBER() OVER (ORDER BY A.LOG_DT) ROW_IDX
									  FROM TBL_APPLY_STEP_HISTORY A
									  JOIN TBL_STEP B
									    ON A.STEP_IDX = B.STEP_IDX 
									  JOIN TBL_MANAGER C
									    ON A.MANAGER_ID = C.MANAGER_ID
									 WHERE A.PRJ_IDX = ?
									   AND A.APPLY_NO = ?';
			return $this->db->query($query,$arg);
  	}
  	
  	function getApplyPasswordUpdate($arg)
  	{
  		$query = 'UPDATE TBL_APPLY 
   								 SET USER_PW = ? 
 							   WHERE PRJ_IDX = ? 
   								 AND APPL_IDX = ? 
   								 AND DEL_YN = \'N\'';
   		return $this->db->query($query,$arg);						 
  	}
  	
  }