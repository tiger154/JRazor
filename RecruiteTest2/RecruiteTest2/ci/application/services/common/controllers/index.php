<?
	class Index extends MY_Controller
	{
		
		function __construct()
		{
			parent::__construct();
		}
		
		function Index()
		{
			redirect('/front/recruit');
		}
	}