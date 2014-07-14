<?
	class Mail_model extends CI_Model
	{
	
		function getSendMailList($arg)
  	{
  		return $this->msdb->output('setCommonSendMail', $arg, 'SELECT'); 
  	}
  	
  	function getMailTemplate($arg)
  	{
  		$query = 'SELECT CNTNT
									FROM TBL_MAIL_TEMPLATE
							   WHERE TPL_IDX = ?
							     AND DEL_YN = ?'; 
			return $this->db->query($query, $arg);
  	}
  	
  }
