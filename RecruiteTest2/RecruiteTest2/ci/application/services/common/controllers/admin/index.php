<?
	class Index extends MY_Controller
	{
		
		function __construct()
		{
				parent::__construct();
		}
		
		function Index()
		{
			// 분기작업 -- 로그인으로 가던지 메인으로 가던지
		  $this->authadmin->loginCheck('/admin/projectManagement');
		}
	}