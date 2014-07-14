<?
	class webfile_model extends CI_Model
	{
		function getList($arg)
		{
			$query = 'SELECT ROW_NUMBER() OVER(ORDER BY WEBIDX DESC) ORD
											,WEBIDX
											,FILE_NM
											,B.DOMAIN_ID
								  FROM TBL_WEBFILE A
								  JOIN TBL_COMPANY B
								    ON A.COMP_ID = B.COMP_ID
								 WHERE B.COMP_ID = ?
								   AND B.DEL_YN = \'N\'';
			return $this->db->query($query, $arg);
		}
		
		function getDomainId($arg)
		{
			$query = 'SELECT DOMAIN_ID 
									FROM TBL_COMPANY 
								 WHERE COMP_ID = ? 
								   AND DEL_YN = \'N\'';
			return $this->db->query($query, $arg);
		}
		
		function getView($arg)
		{
			$query = 'SELECT WEBIDX
											,FILE_NM
								  FROM TBL_WEBFILE
								 WHERE COMP_ID = ?
								   AND WEBIDX = ?';
			return $this->db->query($query, $arg);
		}
		
		function getProcess($arg)
		{
			$query = 'MERGE INTO TBL_WEBFILE AS T
										 USING (SELECT ? COMP_ID , ? WEBIDX) S
											  ON (S.COMP_ID = T.COMP_ID
										   AND S.WEBIDX = T.WEBIDX)
										  WHEN MATCHED THEN
										UPDATE SET FILE_NM = ?
										  WHEN NOT MATCHED THEN  
										INSERT (COMP_ID,FILE_NM)
										VALUES (?,?);';
			return $this->db->query($query, $arg);							
		}
		
		function getDelete($arg)
		{
			$query = 'UPDATE TBL_WEBFILE 
									 SET DEL_YN = \'Y\' 
								 WHERE COMP_ID = ? 
								   AND WEBIDX = ?';
			return $this->db->query($query, $arg);
		}
		
	}
	
								