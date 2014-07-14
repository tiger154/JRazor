<?
	if (file_exists($application_folder . '/' . MAIN_SERVICE_CONTROLLER_DIRECTORY . 'admin/bbsControl.php'))
	{
		include $application_folder . '/' . MAIN_SERVICE_CONTROLLER_DIRECTORY . 'admin/bbsControl.php';
	}
	else
	{
		include $application_folder . '/' . COMMON_SERVICE_CONTROLLER_DIRECTORY . 'admin/bbsControl.php';
	}
	class Bbs extends BbsControl
	{
		
		function __construct()
		{
			parent::__construct();
			$this->setPageUrl('/front/bbs/');
		}
		
		function Notice()
		{
			$this->setBbsCode('Notice');
			$data = $this->actList();
			$this->frontView('front/bbs/bbs_list_view' , $data);
		}
		
		function NoticeDetail()
		{
			$this->setBbsCode('Notice');
			$data = $this->actView();
			$this->frontView('front/bbs/bbs_view_view' , $data);
		}
		
		
		
		
		function FAQ()
		{
			$this->setBbsCode('FAQ');
			$data = $this->actList();
			$this->frontView('front/bbs/bbs_list_view' , $data);
		}
		
		function FAQDetail()
		{
			$this->setBbsCode('FAQ');
			$data = $this->actView();
			$this->frontView('front/bbs/bbs_view_view' , $data);
		}
		
		
		
		
		function QnA()
		{
			$this->setBbsCode('QnA');
			$data = $this->actList();
			$this->frontView('front/bbs/bbs_list_view' , $data);
		}
		
		function QnADetail()
		{
			$this->setBbsCode('QnA');
			$data = $this->actView();
			$this->frontView('front/bbs/bbs_view_view' , $data);
		}
		
		function QnANewPost()
		{
			$this->setBbsCode('QnA');
			$data = $this->actWrite();
		
			$this->frontView('front/bbs/bbs_form_view' , $data);
		}
		
		function QnAEditPost()
		{
			$this->setBbsCode('QnA');
			$data = $this->actModify();
		
			$this->frontView('front/bbs/bbs_form_view' , $data);
		}
		
			
		function QnADeleteFormPost()
		{
			$this->setBbsCode('QnA');
			$data = $this->actModify();
			$this->frontView('front/bbs/bbs_delete_form' , $data);
		}
	
	
	}
	