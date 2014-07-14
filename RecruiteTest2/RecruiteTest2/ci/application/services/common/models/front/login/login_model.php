<?
	class Login_model extends CI_Model
	{
		
		function getCertLogInsert($arg)
		{
			$query = 'INSERT INTO TBL_CERT_LOG(COMP_ID
																				,REQ_CD
																				,REQ_RECV_NUM
																				,CERT_TP
																				,REC_DATA_DEC_DATE
																				,REC_DATA_NM
																				,REC_DATA_BIRTH_DT
																				,REC_DATA_SEX_CD
																				,REC_DATA_FOREIGN_CD
																				,REC_DATA_DI
																				,REC_DATA_CI
																				,REC_DATA_ETC1
																				,REC_DATA_ETC2
																				,REC_DATA_ETC3
																				,ERR_MSG
																				,ERR_CD)
							 VALUES( ( SELECT COMP_ID FROM TBL_COMPANY WHERE DOMAIN_ID = ? AND DEL_YN = ? ) ,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)';
											
			return $this->db->query($query, $arg);
		}
		
		function getAuthLoginApplySave($arg)
		{
			return $this->msdb->output('setCommonAuthApplySave', $arg, 'SELECT'); 
		}
		
		function getLoginConfirmList($arg)
		{
			$query = 'SELECT A.APPL_IDX 
										  ,A.NAMEKOR
										  ,A.AUTH_DI
										  ,A.PRJ_IDX
										  ,A.EMAIL
								  FROM TBL_APPLY A
								  JOIN TBL_APPLY_PERSONAL B
								    ON A.PRJ_IDX = B.PRJ_IDX
								   AND A.APPL_IDX = B.APPL_IDX
								 WHERE A.PRJ_IDX = ?
								   AND A.NAMEKOR = ?
								   AND A.USER_PW = ?
								   AND B.HTEL = ?
								   AND A.DEL_YN = ?
								   AND B.DEL_YN = ?
								   AND EXISTS (SELECT 1	
																 FROM TBL_PROJECT AA
																 JOIN TBL_COMPANY BB
														       ON AA.COMP_ID = BB.COMP_ID
														    WHERE AA.PRJ_IDX = A.PRJ_IDX
														    	AND BB.DOMAIN_ID = ?
														      AND BB.DEL_YN = ?
														      AND AA.DEL_YN = ?) ';
			return $this->db->query($query, $arg);	 
		}
		
		function getPasswordSearchList($arg)
		{
			$query = 'SELECT A.APPL_IDX 
										  ,A.NAMEKOR
										  ,A.AUTH_DI
										  ,A.PRJ_IDX
										  ,A.EMAIL
								  FROM TBL_APPLY A
								  JOIN TBL_APPLY_PERSONAL B
								    ON A.PRJ_IDX = B.PRJ_IDX
								   AND A.APPL_IDX = B.APPL_IDX
								 WHERE A.PRJ_IDX = ?
								   AND A.AUTH_DI = ?
								   AND A.NAMEKOR = ?
								   AND A.DEL_YN = ?
								   AND B.DEL_YN = ?
								   AND EXISTS (SELECT 1	
																 FROM TBL_PROJECT AA
																 JOIN TBL_COMPANY BB
														       ON AA.COMP_ID = BB.COMP_ID
														    WHERE AA.PRJ_IDX = A.PRJ_IDX
														    	AND BB.DOMAIN_ID = ?
														      AND BB.DEL_YN = ?
														      AND AA.DEL_YN = ?) ';
			return $this->db->query($query, $arg);	 
		}
		
	}