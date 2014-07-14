<?
	class Content extends MY_Controller
	{
	
		function CheckPrivacy()
		{
			$data = null;
			$this->load->model('front/common/sitecontent_model','site',true);
			$res = $this->site->getContentView(HOSTID,'front_cntntp');
			$rs = $res->result();
			$data['front_cntntp'] = String2Html($rs[0]->DFC_CNTNT);
			
			$this->frontView('front/content/checkprivacy_view' , $data);
		}
		
		function CheckProcess()
		{
			$data = null;
			$this->load->model('front/common/sitecontent_model','site',true);
			$res = $this->site->getContentView(HOSTID,'front_cntntm');
			$rs = $res->result();
			$data['front_cntntm'] = String2Html($rs[0]->DFC_CNTNT);
			
			$this->frontView('front/content/checkprocess_view' , $data);
		}
		
		function CheckEmail()
		{
			$data = null;
			$this->load->model('front/common/sitecontent_model','site',true);
			$res = $this->site->getContentView(HOSTID,'front_cntnte');
			$rs = $res->result();
			$data['front_cntnte'] = String2Html($rs[0]->DFC_CNTNT);
			
			$this->frontView('front/content/checkemail_view' , $data);
		}
		
	}