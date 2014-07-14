<?
	class Hello extends CI_Controller
	{

		function __construct()
		{
			echo 'test';
		}

		function Index()
		{
			echo $_SERVER['HTTP_HOST'];
		}

  		function Test()
		{
		echo 'good';
		}

	}
