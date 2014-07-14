<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class AuthAdmin extends CI_Session {

	var $ses_user_id 		= 's_user_id';
	var $ses_user_nm 		= 's_user_nm';
	var $ses_user_type 	= 's_user_type';
	var $ses_user_level	= 's_user_level';
	var $ses_domain_id	= 's_domain_id';
	
	var $ses_user_agr 	= 's_user_agreement';
	var $ses_user_comp_id = 's_user_company_id';
	var $ses_user_comp_nm = 's_user_company_nm';

	var $ses_user_origin_comp_id = 's_origin_comp_id';
	var $ses_user_origin_comp_nm = 's_origin_comp_nm';
	var $ses_origin_domain_id = 's_origin_domain_id';
	
	function __construct()
	{
		parent::__construct();
	}

	/* 기본 로그인 정보 */
	function setUserId($arg) 							{ $this->set_userdata($this->ses_user_id,$arg); }
	function setUserNm($arg) 							{ $this->set_userdata($this->ses_user_nm,$arg); }
	function setUserAgreement($arg) 			{ $this->set_userdata($this->ses_user_agr,$arg); }
	function setUserType($arg) 						{ $this->set_userdata($this->ses_user_type,$arg); }
	function setUserLevel($arg)						{ $this->set_userdata($this->ses_user_level,$arg); }
	function setDomainId($arg)						{ $this->set_userdata($this->ses_domain_id,$arg); }
	
	
	function setOriginCompanyId($arg)			{ $this->set_userdata($this->ses_user_origin_comp_id,$arg); }
	function setOriginCompanyNm($arg)			{ $this->set_userdata($this->ses_user_origin_comp_nm,$arg); }
	function setOriginDomainId($arg)			{ $this->set_userdata($this->ses_origin_domain_id,$arg); }
	
	function getOriginCompanyId()					{ return $this->userdata($this->ses_user_origin_comp_id); }
	function getOriginCompanyNm()					{ return $this->userdata($this->ses_user_origin_comp_nm); }
	function getOriginDomainId()					{ return $this->userdata($this->ses_origin_domain_id); }
	
	function getUserId() 						{ return $this->userdata($this->ses_user_id); }
	function getUserNm() 						{ return $this->userdata($this->ses_user_nm); }
	function getUserType() 					{ return $this->userdata($this->ses_user_type); }
	function getUserLevel() 				{ return $this->userdata($this->ses_user_level); }
	function getUserAgreement() 		{ return $this->userdata($this->ses_user_agr); }
	function getDomainId() 					{ return $this->userdata($this->ses_domain_id); }
	
	/* 기업 관련 정보 */
	function getCompanyId() 				{ return $this->userdata($this->ses_user_comp_id); }
	function getCompanyNm() 				{ return $this->userdata($this->ses_user_comp_nm); }
	
	function setCompanyId($arg)			{ $this->set_userdata($this->ses_user_comp_id,$arg); }
	function SetCompanyNm($arg)			{ $this->set_userdata($this->ses_user_comp_nm,$arg); }
	
	function agreementCheck()
	{
		return $this->userdata($this->ses_user_agr) == 'Y' ? true : false;
	}
	
	// 로그인체크후 로그인상태인지 아닌지 체크할때만 쓰는.
	
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
					exit;
			}
			else
			{
					redirect('/admin/login', 'refresh');
					exit;
			}
			
		}
	}
	
	function companyBackLogin($url)
	{
		$this->setCompanyId($this->getOriginCompanyId());
		$this->setCompanyNm($this->getOriginCompanyNm());
		redirect($url, 'refresh');
	}
	
	function logout($LOGIN_HOST_ID = null)
	{
		$this->sess_destroy();
		if ($LOGIN_HOST_ID != null)
		{
			redirect('http://' . $LOGIN_HOST_ID . '.' . MAIN_SERVICE_DOMAIN . '/admin/login');
		}
		else
		{
			$this->loginCheck('/admin/login');
		}
	}

}