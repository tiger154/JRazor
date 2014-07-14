<?
	class Recruit_model extends CI_Model
	{
		
		function getCertLogInsert($arg)
		{
			$query = 'INSERT INTO TBL_CERT_LOG(COMP_ID,REQ_CD,REQ_RECV_NUM,CERT_TP
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
											,ERR_MSG)
							 values (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)';
											
			return $this->db->query($query, $arg);
		}
	
	}