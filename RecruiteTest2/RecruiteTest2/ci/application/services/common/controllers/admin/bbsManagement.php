<?

if (file_exists($application_folder . '/' . MAIN_SERVICE_CONTROLLER_DIRECTORY . 'admin/bbsControl.php'))
{
	include $application_folder . '/' . MAIN_SERVICE_CONTROLLER_DIRECTORY . 'admin/bbsControl.php';
}
else
{
	include $application_folder . '/' . COMMON_SERVICE_CONTROLLER_DIRECTORY . 'admin/bbsControl.php';
}

class BbsManagement extends BbsControl
{
	function Index()
	{
		//phpinfo();
		//exit;
		redirect('/admin/bbsManagement/Notice');
	}
	
	function Notice($curPage = 1)
	{
		$this->setBbsCode('Notice');
		$data = $this->actList();
		$this->loadView('admin/setmanager/bbs_notice_view' , $data);
	}

	function NoticeDetail()
	{
		$this->setBbsCode('Notice');
		$data = $this->actView();
		$this->loadView('admin/setmanager/bbs_notice_detail_view' , $data);
	}

	function NoticeNewPost()
	{
		$this->setBbsCode('Notice');
		$data = $this->actWrite();
		
		$this->loadView('admin/setmanager/bbs_notice_detail_form' , $data);
	}

	function NoticeAnswerPost()
	{
		$this->setBbsCode('Notice');
		$data = $this->actReply();
		$this->loadView('admin/setmanager/bbs_notice_detail_form' , $data);
	}

	function NoticeEditPost()
	{
		$this->setBbsCode('Notice');
		$data = $this->actModify();
		$this->loadView('admin/setmanager/bbs_notice_detail_form' , $data);
	}
	
	
	
	function FAQ($curPage = 1)
	{
		$this->setBbsCode('FAQ');
		$data = $this->actList();
		$this->loadView('admin/setmanager/bbs_notice_view' , $data);
	}

	function FAQDetail()
	{
		$this->setBbsCode('FAQ');
		$data = $this->actView();
		$this->loadView('admin/setmanager/bbs_notice_detail_view' , $data);
	}

	function FAQNewPost()
	{
		$this->setBbsCode('FAQ');
		$data = $this->actWrite();
		
		$this->loadView('admin/setmanager/bbs_notice_detail_form' , $data);
	}

	function FAQAnswerPost()
	{
		$this->setBbsCode('FAQ');
		$data = $this->actReply();
		$this->loadView('admin/setmanager/bbs_notice_detail_form' , $data);
	}

	function FAQEditPost()
	{
		$this->setBbsCode('FAQ');
		$data = $this->actModify();
		$this->loadView('admin/setmanager/bbs_notice_detail_form' , $data);
	}
	
	
	
	
	function QnA($curPage = 1)
	{
		$this->setBbsCode('QnA');
		$data = $this->actList();
		$this->loadView('admin/setmanager/bbs_notice_view' , $data);
	}

	function QnADetail()
	{
		$this->setBbsCode('QnA');
		$data = $this->actView();
		$this->loadView('admin/setmanager/bbs_notice_detail_view' , $data);
	}

	function QnANewPost()
	{
		$this->setBbsCode('QnA');
		$data = $this->actWrite();
		
		$this->loadView('admin/setmanager/bbs_notice_detail_form' , $data);
	}

	function QnAAnswerPost()
	{
		$this->setBbsCode('QnA');
		$data = $this->actReply();
		$this->loadView('admin/setmanager/bbs_notice_detail_form' , $data);
	}

	function QnAEditPost()
	{
		$this->setBbsCode('QnA');
		$data = $this->actModify();
		$this->loadView('admin/setmanager/bbs_notice_detail_form' , $data);
	}
	
}

