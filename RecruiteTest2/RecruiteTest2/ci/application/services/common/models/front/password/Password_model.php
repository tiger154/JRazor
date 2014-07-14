<?
	class Password_model extends CI_Model
	{
		
		function updatePasswordList($arg)
		{
			$query = 'UPDATE TBL_APPLY 
									 SET USER_PW = ? 
								 WHERE PRJ_IDX = ? 
								 	 AND APPL_IDX = ? 
								 	 AND AUTH_DI = ? 
								 	 AND NAMEKOR = ? 
								 	 AND DEL_YN = \'N\'';
			$this->db->query($query, $arg);	 
		}
		
	}