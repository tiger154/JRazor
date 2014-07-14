<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class AuthUser extends CI_Session {

	var $ses_user_id 			= 's_user_id';
	var $ses_user_nm 			= 's_user_nm';
	var $ses_user_type 		= 's_user_type';
	var $ses_user_level		= 's_user_level';
	var $ses_domain_id		= 's_domain_id';
	
	var $ses_user_agr 		= 's_user_agreement';
	var $ses_user_comp_id = 's_user_company_id';
	var $ses_user_comp_nm = 's_user_company_nm';

	function __construct()
	{
		parent::__construct();
	}

	/* 기본 로그인 정보 */
	function setUserId($arg) 							{ $this->set_userdata($this->ses_user_id,$arg); }
	function setUserNm($arg) 							{ $this->set_userdata($this->ses_user_nm,$arg); }
	function setDomainId($arg)						{ $this->set_userdata($this->ses_domain_id,$arg); }
	
	function getUserId() 									{ return $this->userdata($this->ses_user_id); }
	function getUserNm() 									{ return $this->userdata($this->ses_user_nm); }
	function getDomainId() 								{ return $this->userdata($this->ses_domain_id); }
	
	// 로그인체크후 리다이렉트할때 -- 로그인이 아니면 무조건 로그인창이동
	function loginCheck($rd_path = null)
	{
		
		if ($rd_path == null )
		{
			return $this->userdata($this->ses_user_id) != '' ? true : false;
		}
		else
		{
		
			if ($this->userdata($this->ses_user_id) != '')
			{
					redirect($rd_path, 'refresh');
			}
			else
			{
					redirect('https://' . SSL_SUB_DOMAIN . '.' . MAIN_SERVICE_DOAMIN . '/login/UserLogin', 'refresh');
			}
			
		}
	}
	
	function logout()
	{
		$this->sess_destroy();
		$this->loginCheck('/admin/login');
	}

}