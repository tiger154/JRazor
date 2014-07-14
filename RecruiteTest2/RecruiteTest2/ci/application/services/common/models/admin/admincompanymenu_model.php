<?
	class AdminCompanyMenu_model extends CI_Model
	{
			function getCompanyList($arg)
			{
				$query = 'SELECT COMP_ID CODE
											  ,COMP_NM NAME
									  FROM TBL_COMPANY
									 WHERE DEL_YN = ?';
				return $this->db->query($query, $arg);
			}
	}