<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 

/**************************************************
	* Maker : flashone
	* Make Date : 2012.11.26
	* File : .php
	* Contents : DataGet
	**************************************************/
	
class Databind
{
	
	private $sqlstr;
	private $que;
	private $DB;
	
	public function __construct()
	{
		$this->sqlstr = null;
		$this->que = null;
		//$this->DB = $dbo;
	}
	
	public function setQuery()
	{
			
			//$this->que = $this->db->query
			
	}
	
	public function getObj()
	{
		//$query = $this->db->query('select *from testtbl'); 
	}
	
	public function getArray()
	{
		//$this->db->query('');
	}
	
	public function getData()
	{
		$this->db->query("SELECT * FROM mytable");
	}

}