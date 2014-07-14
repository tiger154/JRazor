<?php
class Agreement_model extends CI_Model
{

	function executeUpdate($updateData)
	{
			$query = 'UPDATE TBL_MANAGER SET 
											 AGREEMENT_YN = ? , 
											 AGREEMENT_DT = ? ,
											 MANAGER_PW = ? ,
											 MOBILE = ?
							   WHERE MANAGER_ID = ?
							     AND DEL_YN = ?
							     AND USE_YN = ?
							     AND MANAGER_PW = ?';

		return $this->db->query($query,$updateData);
	}

}