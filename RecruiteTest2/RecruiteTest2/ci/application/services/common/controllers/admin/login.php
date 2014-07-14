<?
	class Login extends CI_Controller
	{
		function Index()
		{
			$this->load->model('test', '', TRUE);
			$data['res'] = $this->test->select(1);
			$this->load->view('admin/login',$data);
		}
		
		//�α����� �Ҷ� Ÿ�� ���μ���
		function loginProcess()
		{
			
			$p_id 		= $this->input->post('id');
			$p_pw 		= $this->input->post('pw');
			$p_reg01	= $this->input->post('reg01');
			$p_reg02	= $this->input->post('reg02');
			$p_reg03	= $this->input->post('reg03');
			$LOGIN_HOST_ID = $this->input->post('LOGIN_HOST_ID');
			$DOMAIN_ID = $this->input->post('DOMAIN_ID');
			
			$CMP_NO = $p_reg01 . '-' . $p_reg02 . '-' . $p_reg03;
			$this->load->model('admin/LoginProcess','lgnProcess');
			$res = null;
			if (DEVELOPER_FLAG == 'OFF')
			{
				$res = $this->lgnProcess->loginCheck(array($p_id,md5($p_pw),$CMP_NO,'Y','N','N'));
			}
			
			if (DEVELOPER_FLAG == 'ON')
			{
				$res = $this->lgnProcess->loginCheckforDeveloper(array($p_id,'Y','N','N'));
			}
			$data = $res->result();
			
			if ( count($data) >= 1 )
			{
				//echo $data[0]->MANAGER_ID . '--' . $data[0]->MANAGER_NM;
				
				// �α����� �ǳ� 
				//$hash = strlen($this->encrypt->sha1('Some string'));
				
				//�α����� �Ǿ����� �α��� ������ A�� �ƴҰ�� �����ΰ� ��ϵ� �����ξ��̵� üũ
				
				if ($data[0]->MANAGER_LVL != 'A' && $LOGIN_HOST_ID != $data[0]->DOMAIN_ID)
				{
					$this->logoutProcess($LOGIN_HOST_ID);
				}
				
				//�⺻������ �α����ϸ� ������ ���ƾ��� ������
				$this->authadmin->setUserId($data[0]->MANAGER_ID);
				$this->authadmin->setUserNm($data[0]->MANAGER_NM);
				$this->authadmin->setUserLevel($data[0]->MANAGER_LVL);
				$this->authadmin->setUserType($data[0]->MANAGER_TP);
				
				//���� �α��ν� �ش� ���̵�� ���õ� ���� ������̵� ����.
				$this->authadmin->setOriginCompanyId($data[0]->COMP_ID);
				$this->authadmin->setOriginCompanyNm($data[0]->COMP_NM);
				$this->authadmin->setOriginDomainId($data[0]->DOMAIN_ID);
				
				//�ܺ����� �������� ���ؼ� ������ ������ ������ - �� �����Ͱ� ���� �ְ�����ڰ� �ٸ� ����� �۾��Ҷ� ����Ǵ� ������̵�
				$this->authadmin->setCompanyId($data[0]->COMP_ID);
				$this->authadmin->setCompanyNm($data[0]->COMP_NM);
				$this->authadmin->setDomainId($data[0]->DOMAIN_ID);
				
				//���ʷα��ν� ����ɵ����� 
				$this->authadmin->setUserAgreement($data[0]->AGREEMENT_YN);
				$this->authadmin->loginCheck('http://' . $LOGIN_HOST_ID . '.' . MAIN_SERVICE_DOMAIN . '/admin/projectManagement');
			}
			else
			{	
				
				//$inVar = iconv('UTF-8','EUC-KR',$targetCh);
				//$inVar = iconv('UTF-8','EUC-KR',$targetCh);
				//$inVar = iconv('EUC-KR','UTF-8',$targetCh);
				//echo mb_detect_encoding($targetCh);
				//$invalues = iconv('UTF-8','EUC-KR',$targetCh);
				jsalertmsg('Wrong infromation!!');
				jshistoryback();
				exit;
			}
			
			//$this->authadmin->loginCheck('http://' . $LOGIN_HOST_ID . '.' . MAIN_SERVICE_DOMAIN . '/admin/projectManagement');
		}
		
		//�ְ�����ڰ� ����α����� �Ҷ� Ÿ�� ���μ���
		function companyLoginProcess()
		{
			if ($this->authadmin->getUserLevel() == 'A')
			{
				$admin_login_comp_nm = $this->input->post('admin_login_comp_nm');
				$admin_login_comp_id = $this->input->post('admin_login_comp_id');
				$this->authadmin->setCompanyId($admin_login_comp_id);
				$this->authadmin->setCompanyNm($admin_login_comp_nm);
				//$backUrl = $this->input->post('backUrl');
				$this->authadmin->loginCheck('/admin/projectManagement/projectList');
				//$this->authadmin->loginCheck($backUrl);
			}
			else
			{
				$this->logoutProcess();
			}
		}
		
		function logoutProcess($LOGIN_HOST_ID = null)
		{
			$this->authadmin->logout($LOGIN_HOST_ID);
		}
		
	}
 
