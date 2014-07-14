<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 

/**************************************************
	* Maker : flashone
	* Make Date : 2012.11.26
	* File : Json.php
	* Contents : json 통신 ( 추후에 한글을위한 인코딩을 위해서 )
	**************************************************/

class FormBox {

	private $id;
	private $name;
	private $opt;
	private $selected_title;

	function __construct()
	{
		$this->id = null;
		$this->name = null;
		$this->opt = null;
		$this->selected_title;
	}
	
	function setId($arg) { $this->id = $arg; }
	function setName($arg) { $this->name = $arg; }
	function setOption($arg) { $this->opt = $arg; }
	
	function getSelectBoxText($obj, $first_title = null , $selectedvalue = null , $objType = 'db')
	{
		if ($objType == 'db') 
		{
			foreach ($obj as $key => $data)
			{
				if ($data->CODE == $selectedvalue) 
				{
					$this->selected_title = $data->NAME;
					return $this->selected_title;
				}
			}	
		}
		
		if ($objType == 'array') 
		{
			foreach ($obj as $key => $data)
			{
				
				if ($data[0] == $selectedvalue)
				{
					  $this->selected_title = $data[1];
					  return $this->selected_title;
				}
			}	
		}
	}
	
	function getSelectBox($obj, $first_title = null , $selectedvalue = null , $objType = 'db')
	{
		$str = '<select id="' . $this->id . '" name="' . $this->name . '" ' . $this->opt . ' >';
		
		if ($first_title !== null) $str .= '<option value="">' . $first_title . '</option>';
		
							if ($objType == 'db') 
							{
								foreach ($obj as $key => $data)
								{
									$selcode = $data->CODE == $selectedvalue ? ' selected ' : '';
									$this->selected_title = $data->CODE == $selectedvalue ? $data->NAME : '';
									$str .= '<option value="' . $data->CODE . '"' . $selcode . '>' . $data->NAME . '</option>';
								}	
							}
							
							if ($objType == 'array') 
							{
								
								foreach ($obj as $key => $data)
								{
								
									$selcode = $data[0] == $selectedvalue ? ' selected ' : '';
									$str .= '<option value="' . $data[0] . '"' . $selcode . '>' . $data[1] . '</option>';
								}	
							}
		$str .= '</select>';
		
		return $str;
	}

}