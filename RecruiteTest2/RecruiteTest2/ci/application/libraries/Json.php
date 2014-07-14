<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 

/**************************************************
	* Maker : flashone
	* Make Date : 2012.11.26
	* File : Json.php
	* Contents : json 통신 ( 추후에 한글을위한 인코딩을 위해서 )
	**************************************************/

class Json {

    public function __construct()
    {
    	$this->err = null;
    } 
    
    public function Error()
    {
    	return json_last_error();
    }
    
    //오브젝트를 JSON 으로
    public function getObj2Json($obj)
    {
    	return json_encode($obj);
    }
    
    //배열을 JSON 으로
    public function getArray2Json($arr)
    {
    	return json_encode($arr);
    }
    
    //JSON을 오브젝트로 
    public function getJson2Obj($jsn)
    {
			return json_decode($jsn);
    }
    //JSON을 배열로
    public function getJson2Array($jsn)
    {
    	return json_decode($jsn);
    }
    
}

/* End of file Someclass.php */
