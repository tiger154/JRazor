<?
	class Mypage_model extends CI_Model
	{
		
		function getMyPageInfoList($arg)
		{
			$query = 'SELECT *
								  FROM (	SELECT ROW_NUMBER() OVER (PARTITION BY GRPB.PRJ_IDX ORDER BY ORD_NO,GRPB.STEP_IDX) STEP_ORD
																,CASE WHEN GRPB.STEP_STDT <= GETDATE() AND GRPB.STEP_EDDT >= GETDATE() THEN \'Y\' ELSE \'N\' END APPLY_STS
															  ,GRPA.*
													  FROM (SELECT A.APPLY_NO
																			  ,CASE APPL_YN WHEN \'Y\' THEN CONVERT(VARCHAR(16),A.APPL_DT,121) ELSE NULL END APPL_DT
																			  ,D.PRJ_NM
																			  ,C.UNIT_NM
																			  ,A.APPL_YN
																			  ,E.STEP_NM
																			  ,E.STEP_IDX
																			  ,E.STEP_STDT
																			  ,E.STEP_EDDT
																			  ,A.PRJ_IDX
																			  ,CASE WHEN E.STEP_STDT <= GETDATE() AND E.STEP_EDDT >= GETDATE() THEN \'Y\' ELSE \'N\' END STS
																	  FROM TBL_APPLY A
																	  JOIN TBL_APPLY_UNIT B
																		  ON A.PRJ_IDX = B.PRJ_IDX
																	   AND A.APPL_IDX = B.APPL_IDX
																	  JOIN TBL_UNIT C
																		  ON B.UNIT_IDX = C.UNIT_IDX
																	  JOIN TBL_PROJECT D
																		  ON C.PRJ_IDX = D.PRJ_IDX
																	  JOIN TBL_COMPANY D1
																		  ON D.COMP_ID = D1.COMP_ID
																	  JOIN TBL_STEP E
																		  ON A.PRJ_IDX = E.PRJ_IDX
																	   AND A.STEP_IDX = E.STEP_IDX
																	 WHERE D1.DOMAIN_ID = ?
																	   AND A.AUTH_DI = ?
																	   AND B.ORD = 1
																	   AND A.DEL_YN = ?
																	   AND B.DEL_YN = ?
																	   AND C.DEL_YN = ?
																	   AND D.DEL_YN = ?
																	   AND D1.DEL_YN = ?
																	   AND E.DEL_YN = ?) GRPA
																JOIN TBL_STEP GRPB
																  ON GRPA.prj_idx = GRPB.PRJ_IDX
																 AND GRPB.DEL_YN = ? ) RES
												  WHERE RES.STEP_ORD = 1';
			return $this->db->query($query, $arg);														   
		}
		
	}