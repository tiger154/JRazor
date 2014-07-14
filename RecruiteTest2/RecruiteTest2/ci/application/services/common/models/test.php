<?
	class Test extends CI_Model {
	
	    function __construct()
	    {
	        parent::__construct();
	    }
	    
	    function Select($arg)
	    {
	    	
	    	$sql = 'SELECT * FROM TEST_TBL WHERE TXT LIKE ?'; 
	    	$sql = 'exec test_proc(?)';
				//$this->db->query($sql, $arg); 
				return $this->msdb->output('test_proc', array('param1'=>$arg), 'SELECT'); 
				//$this->db->query('call test_proc('.$this->db->escape($arg).');  '); 
	    }
	    
	    function Insert()
	    {
	    	
	    }
	}
