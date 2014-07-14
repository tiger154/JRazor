<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class AuthFront extends CI_Session {

	var $ses_user_nm 		= 'f_user_nm';
	var $ses_user_email	= 'f_user_email';
	var $ses_domain_id	= 'f_domain_id';
	var $ses_unique_id	= 'f_apply_id';
	var $ses_project_id	= 'f_prj_idx';
	var $ses_unique_object	= 'f_auth_di';
	var $ses_authtype		= 'f_auth_type';
	
	function __construct()
	{
		parent::__construct();
	}

	/* 기본 로그인 정보 */
	function setUserEmail($arg) 								{ $this->set_userdata($this->ses_user_email,$arg); 	}
	function setUserNm($arg) 										{ $this->set_userdata($this->ses_user_nm,$arg); 		}
	function setUserDomain($arg) 								{ $this->set_userdata($this->ses_domain_id,$arg); 	}
	function setUserApplyId($arg) 							{ $this->set_userdata($this->ses_unique_id,$this->Encrypt($arg)); 			}
	function setUserApplyDI($arg) 							{ $this->set_userdata($this->ses_unique_object,$this->Encrypt($arg)); 	}
	function setUserDefaultProject($arg) 				{ $this->set_userdata($this->ses_project_id,$this->Encrypt($arg)); 			}
	function setUserAuthType($arg)							{ $this->set_userdata($this->ses_authtype, $this->Encrypt($arg));				}
	
	function getUserEmail() 										{ return $this->userdata($this->ses_user_email); 		}
	function getUserNm() 												{ return $this->userdata($this->ses_user_nm); 			}
	function getUserDomain() 										{ return $this->userdata($this->ses_domain_id); 		}
	function getUserApplyId() 									{ return $this->Decrypt($this->userdata($this->ses_unique_id)); 			}
	function getUserApplyDI() 									{ return $this->Decrypt($this->userdata($this->ses_unique_object)); 	}
	function getUserDefaultProject() 						{ return $this->Decrypt($this->userdata($this->ses_project_id)); 			}
	function getUserAuthType()									{	return $this->Decrypt($this->userdata($this->ses_authtype));				}	
	
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
						$this->userdata($this->ses_domain_id) != '' &&
						$this->userdata($this->ses_unique_id) != '' &&
						$this->userdata($this->ses_unique_object) != '' 
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