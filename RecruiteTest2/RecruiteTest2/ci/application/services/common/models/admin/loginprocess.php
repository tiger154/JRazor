<?php
class LoginProcess extends CI_Model
{
//loginCheckforDeveloper

	function loginCheckforDeveloper($arg)
	{
		$query = 'SELECT MANAGER_ID
						  			,A.COMP_ID COMP_ID
						  			,MANAGER_PW
						  			,MANAGER_NM
						  			,MANAGER_TP
						  			,MANAGER_LVL
						  			,DOMAIN_ID
						  			,AGREEMENT_YN
						  			,B.COMP_NM COMP_NM
						  			,B.CMP_NO
				  			FROM TBL_MANAGER A
				  			JOIN TBL_COMPANY B
				  			  ON A.COMP_ID = B.COMP_ID
				 		   WHERE MANAGER_ID = ?
				   			 AND USE_YN = ?
							 	 AND A.DEL_YN = ?
							 	 AND B.DEL_YN = ?';

		return $this->db->query($query,$arg);
	}

	function loginCheck($arg)
	{
			  $query = 'SELECT MANAGER_ID
								  			,A.COMP_ID COMP_ID
								  			,MANAGER_PW
								  			,MANAGER_NM
								  			,MANAGER_TP
								  			,MANAGER_LVL
								  			,DOMAIN_ID
								  			,AGREEMENT_YN
								  			,B.COMP_NM COMP_NM
								  			,B.CMP_NO
						  			FROM TBL_MANAGER A
						  			JOIN TBL_COMPANY B
						  			  ON A.COMP_ID = B.COMP_ID
						 		   WHERE MANAGER_ID = ?
						 		     AND MANAGER_PW = ?
						 		     AND CMP_NO = ?
						   			 AND USE_YN = ?
									 	 AND A.DEL_YN = ?
									 	 AND B.DEL_YN = ?';

		return $this->db->query($query,$arg);
	}

}