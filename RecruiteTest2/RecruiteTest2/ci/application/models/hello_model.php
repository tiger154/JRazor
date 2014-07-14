<?php

	class Hello_model extends CI_Model 
	{
	
		function Formmodel() {

			parent::Model();

		}

		function submit_posted_data() {

			$this->db->insert('form',$_POST);
	//		$this->db->query('select *From form');

		}
			
		function getTest()
		{
			
			return $this->db->query('select *From form');
		}

		function get_all_data() {

	//		$data['result'] = $this->db->get('form');

			return $data['result'];

		}

	}

	

?>
