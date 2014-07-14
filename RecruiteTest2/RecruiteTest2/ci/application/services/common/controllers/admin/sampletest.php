<?
	class Sampletest extends MY_Controller
	{
		
		function Index()
		{

			$this->cm_admin_data['te1111'] = null;
			
			$this->load->model('test', '', TRUE);
			$data['res'] = $this->test->select(1);
			//$this->data = null;
			$data['loginid'] = $this->authadmin->getUserId();
			$this->loadView('admin/sample/test' , $data);
			
		}
		
		public function test()
		{
			echo 'admintest';
		}
		
	}
 
