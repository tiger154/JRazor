<?
	class Index extends MY_Controller
	{
		
		function __construct()
		{
				parent::__construct();
		}
		
		function Index()
		{
			// �б��۾� -- �α������� ������ �������� ������
		  $this->authadmin->loginCheck('/admin/projectManagement');
		}
	}