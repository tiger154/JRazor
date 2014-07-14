<?
	class Smsmanagement_model extends CI_Model
	{
	
		function getCountList($arg)
    {	
				return $this->msdb->output('setCommonSmsCountList', $arg, 'SELECT'); 
    }
    
    function getSendSmsSelect($arg)
    {
    		return $this->msdb->output('setCommonSendSms', $arg, 'EXECUTE'); 
    }
  }