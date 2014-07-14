<?
	class Agreement extends MY_Controller
	{
		function Index()
		{
			$this->load->library('DataControl'); 
			$this->load->library('FormBox'); 
			
			$this->formbox->setId('mobile01');
			$this->formbox->setName('mobile01');
			$this->formbox->setOption('');
			$data['SELECTBOX_mobile01'] = $this->formbox->getSelectBox($this->datacontrol->getFile2Array('HTEL.txt'), '¼±ÅÃ' , '' , $objType = 'array');
			
			$this->load->model('front/common/sitecontent_model','site',true);
			$res = $this->site->getContentView(HOSTID,'admin_agreement');
			$rs = $res->result();
			$data['admin_agreement'] = String2Html($rs[0]->DFC_CNTNT);
			
			$res = $this->site->getContentView(HOSTID,'admin_information');
			$rs = $res->result();
			$data['admin_information'] = String2Html($rs[0]->DFC_CNTNT);
			
			$this->load->model('test', '', TRUE);
			$data['LoginNm'] = $this->authadmin->getUserNm();
			$data['res'] = $this->test->select(1);
			$this->checkByPassAgreement();
			$this->loadView('admin/agreement' , $data);
		}
		
		function agreeProcess()
		{
			$pwd_tem 	= $this->input->post('password_tem');
			$pwd 			= $this->input->post('password');
			$pwd_re 	= $this->input->post('password_re');
			$mobile01 = $this->input->post('mobile01');
			$mobile02 = $this->input->post('mobile02');
			$mobile03 = $this->input->post('mobile03');
			
			$mobile = $mobile01 . '-' . $mobile02 . '-' . $mobile03; 
			
			$this->load->model('admin/agreement_model','agreement');
			$this->authadmin->setUserAgreement('Y');
			$this->agreement->executeUpdate(array('Y',date('Y-m-d h:i:s'),md5($pwd_re),$mobile,$this->authadmin->getUserId(),'N','Y',md5($pwd_tem)));
			redirect('/admin/projectManagement/projectList');
		}
		
	}
 
