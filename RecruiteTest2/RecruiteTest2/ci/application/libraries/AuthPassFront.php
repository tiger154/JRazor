<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class AuthPassFront extends CI_Session {

	var $ses_user_nm 		= 'pf_user_nm';
	var $ses_user_pass	= 'pf_user_pwd';
	var $ses_domain_id	= 'pf_domain_id';
	var $ses_htel				= 'pf_htel';
	var $ses_project_id	= 'pf_prj_idx';
	
	function __construct()
	{
		parent::__construct();
	}

	/* 기본 로그인 정보 */
	
	function setUserNm($arg) 										{ $this->set_userdata($this->ses_user_nm,$arg); 		}
	function setUserDomain($arg) 								{ $this->set_userdata($this->ses_domain_id,$arg); 	}
	function setUserPass($arg) 									{ $this->set_userdata($this->ses_user_pass,$this->Encrypt($arg)); 			}
	function setUserHtel($arg) 									{ $this->set_userdata($this->ses_htel,$this->Encrypt($arg)); 	}
	function setUserDefaultProject($arg) 				{ $this->set_userdata($this->ses_project_id,$this->Encrypt($arg)); 			}
	
	function getUserNm() 												{ return $this->userdata($this->ses_user_nm); 			}
	function getUserDomain() 										{ return $this->userdata($this->ses_domain_id); 		}
	function getUserPass() 											{ return $this->Decrypt($this->userdata($this->ses_user_pass)); 			}
	function getUserHtel() 											{ return $this->Decrypt($this->userdata($this->ses_htel)); 	}
	function getUserDefaultProject() 						{ return $this->Decrypt($this->userdata($this->ses_project_id)); 			}
	
	function LoginCheckRedirect($url1 = null,$url2 = null )
	{
		if ( $this->LoginCheck() == 'ON' )
		{
			// 난 정상이오~	
		}
		else
		{
			/*
			echo $this->userdata($this->ses_user_email) .'<br>';
			echo $this->userdata($this->ses_user_nm) .'<br>';
			echo $this->userdata($this->ses_domain_id) .'<br>';
			echo $this->userdata($this->ses_unique_id) .'<br>';
			*/
			$url2 = !$url2 ? '/front/login/UserLogin' : $url2;
			redirect($url2 . '?return_url=' . $url1);
			
			exit;
		}
	}
	
	function LoginCheck()
	{
		if ($this->userdata($this->ses_domain_id) == HOSTID)
		{
			if (	
						$this->userdata($this->ses_user_nm) != '' &&
						$this->userdata($this->ses_user_pass) != '' &&
						$this->userdata($this->ses_domain_id) != '' &&
						$this->userdata($this->ses_htel) != '' &&
						$this->userdata($this->ses_project_id) != '' 
				  )
			{
				// 정상인데 말이다
				return 'ON';
			}
			else
			{
				return 'OFF';
			}
		}
		else
		{
			return 'OFF';
		}
	}
	
	function Encrypt($arg)
	{
		return base64_encode($arg);
	}
	
	function Decrypt($arg)
	{
		return base64_decode($arg);
	}
	
	function logout()
	{
		$this->sess_destroy();
	}
	
}