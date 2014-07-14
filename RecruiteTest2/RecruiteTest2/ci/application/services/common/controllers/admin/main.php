<?
	class Main extends MY_Controller
	{
		
		function __construct()
		{
				parent::__construct();
		}
		
		function Index()
		{
			$this->load->model('test', '', TRUE);
			$data['loginid'] = $this->authadmin->getUserId();
			$data['res'] = $this->test->select(1);
			$this->loadView('admin/sample/test' , $data);
		}
	}