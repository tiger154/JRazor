<?
	class Password extends MY_Controller
	{
		
		function PasswordResult()
		{
			$this->load->library('AuthFront');
			if ($this->authfront->getUserAuthType() == 'searchPassword')
			{
				$data = null;
				$this->frontView('front/password/password_result' , $data);
			}
			else
			{
				redirect('/front/login/SearchPassword');
			}
		}
		
		function PasswordResultProcess()
		{
			$this->load->library('AuthFront');
			if ($this->authfront->getUserAuthType() == 'searchPassword')
			{
				$this->load->model('front/password/password_model','pwd',true);
				
				$USER_PASS = $this->input->post('PASSWORD');
				$PRJ_IDX = $this->authfront->getUserDefaultProject();
				$APPL_IDX = $this->authfront->getUserApplyId();
				$AUTH_DI = $this->authfront->getUserApplyDI();
				$NAMEKOR = $this->authfront->getUserNm();
				
				$this->pwd->updatePasswordList(array(md5($USER_PASS),$PRJ_IDX,$APPL_IDX,$AUTH_DI,$NAMEKOR));
				
				jsalertmsg('변경되었습니다.');
				jsredirect('/front/recruit');
				exit;
			}
			
		}
		
	}