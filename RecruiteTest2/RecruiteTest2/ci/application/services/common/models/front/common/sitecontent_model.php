<?
	class Sitecontent_model extends CI_Model
	{
		function getContentView($hostId,$dfc_code)
    { 
    		$arg = array($hostId,$dfc_code,$dfc_code);
    	  $query = 'SELECT DFC_CNTNT
									  FROM (SELECT ROW_NUMBER() OVER (ORDER BY ORD) ORDX
															  ,DFC_CNTNT
													  FROM (SELECT DFC_CNTNT,1 ORD
																	  FROM TBL_SITE_CONTENT
																	 WHERE COMP_ID = (SELECT COMP_ID FROM TBL_COMPANY WHERE DOMAIN_ID = ? AND DEL_YN = \'N\' ) 
																	   AND DFC_CD = ?
																	 UNION ALL
																	SELECT DFC_CNTNT,2 ORD
																	  FROM TBL_DEFAULT_CONTENT
																	 WHERE DFC_CD = ?) CNTNT ) TBL
													 WHERE ORDX = 1';
				return $this->db->query($query, $arg);
    }
  }