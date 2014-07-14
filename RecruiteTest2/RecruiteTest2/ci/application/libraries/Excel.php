<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/* 
 *  ======================================= 
 *  Author     : Muhammad Surya Ikhsanudin 
 *  License    : Protected 
 *  Email      : mutofiyah@gmail.com 
 *   
 *  Dilarang merubah, mengganti dan mendistribusikan 
 *  ulang tanpa sepengetahuan Author 
 *  ======================================= 
 */  
require_once APPPATH."/third_party/PHPExcel.php"; 
 
class Excel extends PHPExcel { 
	
		private $fileObject;
	
    public function __construct() { 
        parent::__construct(); 
    } 
    
    public function setLoadFile($arg) { $this->fileObject = $arg; }
    public function getFileType()			{ return $this->fileObject['type']; }
    public function getExcel2Array()
    {
    	$file_type = $this->fileObject['type'];
			
			$obj = null;
			
			if ($file_type == 'application/vnd.ms-excel')
			$obj = new PHPExcel_Reader_Excel5();
			
			if ($file_type == 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet')
			$obj = new PHPExcel_Reader_Excel2007();
			
			if (!$obj) return false;
			
			$excel1 = $obj->load($this->fileObject['tmp_name']);
			//$objWorksheet = $excel1->getActiveSheet();
			return $excel1->getActiveSheet()->toArray(null,true,true,true);

    }
    
} 
