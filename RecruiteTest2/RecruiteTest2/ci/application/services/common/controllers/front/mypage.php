<?
	class Mypage extends MY_Controller
	{
		
		function __construct()
		{
			parent::__construct();
			$this->load->library('AuthFront'); 
			$this->authfront->LoginCheckRedirect($_SERVER['REQUEST_URI']);
		}
		
		function Index()
		{
			$this->load->model('front/mypage/mypage_model','mypg',true);
			$this->load->library('AuthFront'); 
			$APPL_IDX = $this->authfront->getUserApplyId();
			$PRJ_IDX = $this->authfront->getUserDefaultProject();
			
			$NAMEKOR = $this->authfront->getUserNm();
			$AUTH_DI = $this->authfront->getUserApplyDI();
			
			$data = null;
			$res = $this->mypg->getMyPageInfoList(array(HOSTID,$AUTH_DI,'N','N','N','N','N','N','N',$PRJ_IDX));
			$data['rdataCount'] = $res->num_rows();
			$data['rdata'] = $res->result();
			///var_dump($data['rdata']);
			$data['NAMEKOR'] = $NAMEKOR;
			
			$this->frontView('front/mypage/mypage_view' , $data);
		}
	}
	