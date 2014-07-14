<?
	class Sample extends CI_Controller
	{
		function Index()
		{
			
			//$this->load->model('test', '', TRUE);
			//$data['res'] = $this->test->select(1);
			$data['te1111'] = null;
			$layout['LAYOUT_TOP'] = $this->load->view('admin/topmenu',$data,true);
			$layout['LAYOUT_NAVIGATOR'] = $this->load->view('admin/navigator',$data,true);
			$layout['LAYOUT_BOTTOM'] = $this->load->view('admin/bottom',$data,true);
			$layout['LAYOUT_MAIN'] = $this->load->view('admin/sample/test',$data,true);
			$this->load->view('admin/main',$layout);
		}
		
		public function test()
		{
			echo 'admintest';
		}
	}
 
