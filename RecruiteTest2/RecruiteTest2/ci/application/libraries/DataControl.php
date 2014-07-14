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

class DataControl { 
	
	function getEtcList($arg)
	{
		$ETCVAR = substr($arg,0,-3);
		$ETCVAR = substr($ETCVAR,3,strlen($ETCVAR));
		
		return explode('@@@',$ETCVAR);
	}
	
	function getFileLocation($file_name,$domain_id = HOSTID)
	{
			return file_exists(APPPATH . MAIN_SERVICE_DIRECTORY . $domain_id .'/' . 'set/' . $file_name) ? APPPATH . MAIN_SERVICE_DIRECTORY . $domain_id .'/' . 'set/' . $file_name : APPPATH . COMMON_SERVICE_DIRECTORY . 'set/' . $file_name;
	}
	
	function getFile2Array($arg)
	{
		$file = $this->getFileLocation($arg);
		
		$lines = file($file);		
		$listdata = array();
		foreach ($lines as $line_num => $line) $listdata[] = explode('	' , $line);
		return $listdata;
	}
	
	function getFile2Object($arg)
	{
		$file = $this->getFileLocation($arg);
		
		$lines = file($file);		
		$listdata = array();
		foreach ($lines as $line_num => $line) $listdata[] = explode('/t' , $line);
		return $listdata;
	}
	
	/* DB로 변경함 - 소스에 이걸 사용하면 쿼리에서 가져오게 수정할것 */
	function getManagerType($code)
	{
		switch ($code)
		{
			case 'A' : return '관리자';
			case 'C' : return '심사위원';
			case 'U' : return '모집분야 담당자';
			default : return '';
		}
	}
	
	function getFrontImagePath($domain_id = null , $type = null)
	{
		if ($domain_id != null && $type != null)
		{
			if (file_exists(FRONT_SERVICE_DIRECTORY . '/design/' . $domain_id . '/' . $type . '_visual.jpg') )
			{
				return '/design/' . $domain_id . '/' . $type . '_visual.jpg';
			}
			else
			{
				return '/design/common/' . $type . '_visual.jpg';
			}
		}
		else
		{
			return '/design/common/' . $type . '_visual.jpg';
		}
	}
	
	function getLogoPath($domain_id = null, $seq = null)
	{
		if ($seq != null && $domain_id != null && file_exists(FRONT_SERVICE_DIRECTORY . '/logo/' . $domain_id . '/logo' . $seq . ''))
		{
			return '/logo/' . $domain_id . '/' . 'logo' . $seq . '';
		}
		else
		{
			return '/logo/nologo.gif';
		}
	}
	
	
	
	/*
	function getLogoPath($company_id = null, $file = null)
	{
		if ($file != null && $company_id != null && file_exists(FRONT_SERVICE_DIRECTORY . '/logo/' . $company_id . '/' . $file))
		{
			return '/logo/' . $company_id . '/' . $file;
		}
		else
		{
			return '/logo/nologo.gif';
		}
	}
	*/
	
}
	
			