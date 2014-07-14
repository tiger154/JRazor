<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 

/**************************************************
	* Maker : flashone
	* Make Date : 2012.11.26
	* File : Json.php
	* Contents : json ��� ( ���Ŀ� �ѱ������� ���ڵ��� ���ؼ� )
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
    
    //������Ʈ�� JSON ����
    public function getObj2Json($obj)
    {
    	return json_encode($obj);
    }
    
    //�迭�� JSON ����
    public function getArray2Json($arr)
    {
    	return json_encode($arr);
    }
    
    //JSON�� ������Ʈ�� 
    public function getJson2Obj($jsn)
    {
			return json_decode($jsn);
    }
    //JSON�� �迭��
    public function getJson2Array($jsn)
    {
    	return json_decode($jsn);
    }
    
}

/* End of file Someclass.php */
