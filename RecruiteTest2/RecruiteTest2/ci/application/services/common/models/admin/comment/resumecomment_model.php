<?
	class ResumeComment_model extends CI_Model
	{
		
		function getCommentList($arg = null)
		{
			
			$query = 'SELECT DFC_NM
										  ,DFC_CD
										  ,DFC_CNTNT
									FROM TBL_DEFAULT_COMMENT';
			if ($arg[0] != null)
			{
				$query .= ' WHERE DFC_CD = ? ';
			}
			return $this->db->query($query,$arg[0] != null ? $arg : null);
		}
		
		function getCommentUpdate($arg)
		{
			$query = 'UPDATE TBL_DEFAULT_COMMENT SET DFC_CNTNT = ? WHERE DFC_CD = ?';
			return $this->db->query($query,$arg);
		}
		
		function getCommentSubList($arg)
		{	
			$query = 'SELECT DFC_NM
										  ,DFC_CD
										  ,DFC_CNTNT
										  ,RSM_IDX
									FROM TBL_RESUME_COMMENT
								 WHERE RSM_IDX = (SELECT RSM_IDX 
								 										FROM TBL_RESUME_FORM 
								 									 WHERE PRJ_IDX = ? 
								 									 	 AND DEL_YN = \'N\')'; 
			
			if ($arg[1] != null)
			{					 									 	 
				$query .= ' AND DFC_CD = ? ';
			}
			return $this->db->query($query,$arg);
		}
		
		function getCommentGroupList()
		{
			$query = 'SELECT DFC_CD CODE
											,MAX(DFC_NM) NAME
									FROM TBL_DEFAULT_COMMENT
							GROUP BY DFC_CD';
			return $this->db->query($query,null);				
		}
		
		function getCommentSubProcess($arg)
		{
			$query = 'MERGE INTO TBL_RESUME_COMMENT AS T
										 USING (SELECT ? RSM_IDX , ? DFC_CD ) S
												ON (S.RSM_IDX = T.RSM_IDX
										   AND S.DFC_CD = T.DFC_CD)
							  WHEN MATCHED THEN
							UPDATE SET DFC_NM = ?
									  ,DFC_CNTNT = ?
							  WHEN NOT MATCHED THEN
							INSERT (RSM_IDX,DFC_CD,DFC_NM,DFC_CNTNT)
							 VALUES(?,?,?,?);';
			return $this->db->query($query,$arg);
		}
		
		function getRsmIdx($arg)
		{
			$query = 'SELECT RSM_IDX
			   			    FROM TBL_RESUME_FORM
			   			   WHERE PRJ_IDX = ?
			   			     AND DEL_YN = \'N\'';
			return $this->db->query($query,$arg);  			     
		}
		
	}