<?
	class Test_model extends CI_Model {
	
	    function __construct()
	    {
	        parent::__construct();
	    }
	    
	    function Select()
	    {
	    	$sql = 'SELECT * FROM TEST_TBL WHERE TXT LIKE ?'; 
				$this->db->query($sql, array('%123%')); 
	    }
	    
	    function Insert()
	    {
	    	
	    }
	}
