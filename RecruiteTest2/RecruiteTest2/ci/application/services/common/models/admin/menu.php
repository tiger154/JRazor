<?
	class Menu extends CI_Model {
	
	    function __construct()
	    {
	        parent::__construct();
	    }
	    
	    function topMenuList()
	    {
				return $this->msdb->output('sp_menuList', array(), 'SELECT'); 
	    }
	    
	    function Insert()
	    {
	    	
	    }
	}
