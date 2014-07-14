<?
	class Recruit_model extends CI_Model
	{
		
	
		
		function getProjectList($arg)
		{
			$query = 'SELECT B.PRJ_NM
										  ,B.PRJ_IDX
										  ,CONVERT(VARCHAR(16),B.PRJ_STDT,121) PRJ_STDT
	  									,CONVERT(VARCHAR(16),B.PRJ_EDDT,121) PRJ_EDDT
	  									,ROW_NUMBER() OVER (ORDER BY B.PRJ_IDX DESC) ROW_IDX
								  FROM TBL_COMPANY A
								  JOIN TBL_PROJECT B
								    ON A.COMP_ID = B.COMP_ID
								 WHERE A.DOMAIN_ID = ?
								   AND B.PRJ_STS = ?
								   AND B.PRJ_STDT <= GETDATE()
								   AND B.PRJ_EDDT >= GETDATE()
								   AND B.USE_YN = ?
								   AND B.DEL_YN = ?
								   AND A.DEL_YN = ?';
			return $this->db->query($query, $arg);
		}
		
		function getSimpleProjectList($arg)
		{
			$query = 'SELECT B.PRJ_NM NAME
										  ,B.PRJ_IDX CODE
								  FROM TBL_COMPANY A
								  JOIN TBL_PROJECT B
								    ON A.COMP_ID = B.COMP_ID
								 WHERE A.DOMAIN_ID = ?
								   AND B.PRJ_STS = ?
								   AND B.PRJ_STDT <= GETDATE()
								   AND B.PRJ_EDDT >= GETDATE()
								   AND B.USE_YN = ?
								   AND B.DEL_YN = ?
								   AND A.DEL_YN = ?';
			return $this->db->query($query, $arg);
		}
		
		function getProjectView($arg)
		{
			$query = 'SELECT B.PRJ_NM
										  ,B.PRJ_IDX
										  ,B.PRJ_CNTNT
										  ,CONVERT(VARCHAR(16),B.PRJ_STDT,121) PRJ_STDT
										  ,CONVERT(VARCHAR(16),B.PRJ_EDDT,121) PRJ_EDDT
								  FROM TBL_COMPANY A
								  JOIN TBL_PROJECT B
								    ON A.COMP_ID = B.COMP_ID
								 WHERE A.domain_id = ?
								   AND B.PRJ_IDX = ?
								   AND B.PRJ_STS = ?
								   AND B.PRJ_STDT <= GETDATE()
								   AND B.PRJ_EDDT >= GETDATE()
								   AND B.USE_YN = ?
								   AND B.DEL_YN = ?
								   AND A.DEL_YN = ?';
			return $this->db->query($query, $arg);
		}
		
	}