<?
	class CodeManagement extends MY_Controller
	{
		// 구분용 코드 리스트 
		private function codeList($code,$opt = 'form',$name = 'sch_gubun', $seldata = null)
		{
			$this->load->model('admin/code/codemanagement_model','codelist',true);
			$res = $this->codelist->getCodeList(array($code,'N','Y'));
			
			if ($opt == 'db') // resultset
			{
				return $res->result();
			}
			
			if ($opt == 'form') // selectbox 형태
			{
				$this->load->library('FormBox');
				$this->formbox->setId($name);
				$this->formbox->setName($name);
				$this->formbox->setOption('');
				$rdata = $res->result();
				return $this->formbox->getSelectBox($res->result(),'구분 선택',$seldata);
			}
		}
		
		// 자격증 관리 리스트
		function licenseManagerList()
		{
			$data = null;
			$SCH_CD_IDX = $this->input->get('sch_gubun');
			$SCH_LIC_NM = $this->input->get('sch_lic_nm');
			$per_page = $this->input->get('per_page');
			
			$data['codeTitle'] = '자격증';
			$data['sch_gubun'] = $SCH_CD_IDX;
			$data['sch_lic_nm'] = $SCH_LIC_NM;
			$this->load->library('pagination');	
			$this->load->model('admin/code/codemanagement_model','codelist',true);
			
			$per_page = !$per_page ? 1 : $per_page;
			$list = $this->pagination->getProperty('per_page');
			
			$res = $this->codelist->getLicenseList(array('LIC',$SCH_CD_IDX,$SCH_LIC_NM ? '%' . $SCH_LIC_NM . '%' : null ,'N','Y','N',$list * ($per_page - 1) + 1 ,$per_page * $list));
			$rData = $res->result();
			$data['rowCount'] = $res->num_rows() > 0 ? $rData[0]->ALL_LIST_COUNT : 0;
			$data['rdata'] = $rData;
			
			$paging['total_rows'] = $data['rowCount'];
			$paging['base_url'] = '/admin/codeManagement/licenseManagerList?q=&sch_lic_nm=' . $SCH_LIC_NM . '&sch_gubun=' . $SCH_CD_IDX;
			$this->pagination->initialize($paging); 
			
			$data['per_page'] = $per_page;
			$data['paging'] = $this->pagination->create_links();
			$data['allPage'] = $this->pagination->getProperty('total_pages');
			
			
			$data['gubunList'] = $this->codeList('LIC','form','sch_gubun',$SCH_CD_IDX);
			
			$data['SELECTBOX_CD_IDX'] = $this->codeList('LIC','form','CD_IDX');
			//var_dump($rdata);
			$this->loadView('admin/code/licenseList_form' , $data);
		}
		
		function licenseManagerData()
		{
			$this->load->library('Json');
			$this->load->model('admin/code/codemanagement_model','codelist',true);
			$LIC_IDX = $this->input->get('LIC_IDX');
			$res = $this->codelist->getLicenseData(array($LIC_IDX,'N'));
			
			$rdata = $res->result();
			
			$obj = array();
			foreach ($rdata as $key => $licdata)
			{
				$obj['LIC_NM'] = iconv('EUC-KR','UTF-8',$licdata->LIC_NM);
				$obj['LIC_PB'] = iconv('EUC-KR','UTF-8',$licdata->LIC_PB);
				$obj['CD_IDX'] = $licdata->CD_IDX;
				$obj['LIC_IDX'] = $licdata->LIC_IDX;
			}
			
			header("Cache-Control: no-cache");
			header("Pragma: no-cache");
			header("Content-Type: text/html; charset=UTF-8");
			echo $this->json->getArray2Json($obj);
		}
		
		function licenseManagerProcess()
		{
			$this->load->model('admin/code/codemanagement_model','codelist',true);
			
			$LIC_IDX = $this->input->post('LIC_IDX');
			$LIC_NM = $this->input->post('LIC_NM');
			$CD_IDX = $this->input->post('CD_IDX');
			$LIC_PB = $this->input->post('LIC_PB');
			$P_TYPE = $this->input->post('P_TYPE');
			$sch_gubun = $this->input->post('h_sch_gubun');
			$sch_lic_nm = $this->input->post('h_sch_lic_nm');
			$per_page = $this->input->post('h_per_page');
			
			if ($P_TYPE == 'regist')
			{
				$this->codelist->getInsertLicense(array($LIC_NM,$LIC_PB,$CD_IDX));
			}
			
			if ($P_TYPE == 'modify')
			{
				$this->codelist->getUpdateLicense(array($LIC_NM,$LIC_PB,$CD_IDX,$LIC_IDX,'N'));
				
			}
			
			if ($P_TYPE == 'delete')
			{
				$this->codelist->getDeleteLicense(array('Y',$LIC_IDX));
			}
			redirect('/admin/codeManagement/licenseManagerList?q=&sch_lic_nm=' . $sch_lic_nm . '&sch_gubun=' . $sch_gubun . '&per_page=' . $per_page);
		}
		
		
		
		
		
		// 전공 관리 리스트
		function majorManagerList()
		{
			$data = null;
			$SCH_CD_IDX = $this->input->get('sch_gubun');
			$SCH_MJR_NM = $this->input->get('sch_mjr_nm');
			$per_page = $this->input->get('per_page');
			
			$data['codeTitle'] = '전공';
			$data['sch_gubun'] = $SCH_CD_IDX;
			$data['sch_mjr_nm'] = $SCH_MJR_NM;
			$this->load->library('pagination');	
			$this->load->model('admin/code/codemanagement_model','codelist',true);
			
			$per_page = !$per_page ? 1 : $per_page;
			$list = $this->pagination->getProperty('per_page');
			
			$res = $this->codelist->getMajorList(array('MJR',$SCH_CD_IDX,$SCH_MJR_NM ? '%' . $SCH_MJR_NM . '%' : null ,'N','Y','N',$list * ($per_page - 1) + 1 ,$per_page * $list));
			$rData = $res->result();
			$data['rowCount'] = $res->num_rows() > 0 ? $rData[0]->ALL_LIST_COUNT : 0;
			$data['rdata'] = $rData;
			
			$paging['total_rows'] = $data['rowCount'];
			$paging['base_url'] = '/admin/codeManagement/majorManagerList?q=&sch_mjr_nm=' . $SCH_MJR_NM . '&sch_gubun=' . $SCH_CD_IDX;
			$this->pagination->initialize($paging); 
			
			$data['per_page'] = $per_page;
			$data['paging'] = $this->pagination->create_links();
			$data['allPage'] = $this->pagination->getProperty('total_pages');
			
			
			$data['gubunList'] = $this->codeList('MJR','form','sch_gubun',$SCH_CD_IDX);
			
			$data['SELECTBOX_CD_IDX'] = $this->codeList('MJR','form','CD_IDX');
			//var_dump($rdata);
			$this->loadView('admin/code/majorList_form' , $data);
		}
		
		function majorManagerData()
		{
			$this->load->library('Json');
			$this->load->model('admin/code/codemanagement_model','codelist',true);
			$MJR_IDX = $this->input->get('MJR_IDX');
			$res = $this->codelist->getMajorData(array($MJR_IDX,'N'));
			
			$rdata = $res->result();
			
			$obj = array();
			foreach ($rdata as $key => $mjrdata)
			{
				$obj['MJR_NM'] = iconv('EUC-KR','UTF-8',$mjrdata->MJR_NM);
				$obj['CD_IDX'] = $mjrdata->CD_IDX;
				$obj['MJR_IDX'] = $mjrdata->MJR_IDX;
			}
			
			header("Cache-Control: no-cache");
			header("Pragma: no-cache");
			header("Content-Type: text/html; charset=UTF-8");
			echo $this->json->getArray2Json($obj);
		}
		
		function majorManagerProcess()
		{
			$this->load->model('admin/code/codemanagement_model','codelist',true);
			
			$MJR_IDX = $this->input->post('MJR_IDX');
			$MJR_NM = $this->input->post('MJR_NM');
			$CD_IDX = $this->input->post('CD_IDX');
			$P_TYPE = $this->input->post('P_TYPE');
			$sch_gubun = $this->input->post('h_sch_gubun');
			$sch_mjr_nm = $this->input->post('h_sch_mjr_nm');
			$per_page = $this->input->post('h_per_page');
			
			if ($P_TYPE == 'regist')
			{
				$this->codelist->getInsertMajor(array($MJR_NM,$CD_IDX));
			}
			
			if ($P_TYPE == 'modify')
			{
				$this->codelist->getUpdateMajor(array($MJR_NM,$CD_IDX,$MJR_IDX,'N'));
				
			}
			
			if ($P_TYPE == 'delete')
			{
				$this->codelist->getDeleteMajor(array('Y',$MJR_IDX));
			}
			redirect('/admin/codeManagement/majorManagerList?q=&sch_mjr_nm=' . $sch_mjr_nm . '&sch_gubun=' . $sch_gubun . '&per_page=' . $per_page);
		}
		
		
		
		
		
		
		// 학교 관리 리스트
		function schoolManagerList()
		{
			$data = null;
			$SCH_CD_IDX = $this->input->get('sch_gubun');
			$SCH_SCH_NM = $this->input->get('sch_sch_nm');
			$per_page = $this->input->get('per_page');
			
			$data['codeTitle'] = '학교';
			$data['sch_gubun'] = $SCH_CD_IDX;
			$data['sch_sch_nm'] = $SCH_SCH_NM;
			$this->load->library('pagination');	
			$this->load->model('admin/code/codemanagement_model','codelist',true);
			
			$per_page = !$per_page ? 1 : $per_page;
			$list = $this->pagination->getProperty('per_page');
			
			$res = $this->codelist->getSchoolList(array('SCH',$SCH_CD_IDX,$SCH_SCH_NM ? '%' . $SCH_SCH_NM . '%' : null ,'N','Y','N',$list * ($per_page - 1) + 1 ,$per_page * $list));
			$rData = $res->result();
			$data['rowCount'] = $res->num_rows() > 0 ? $rData[0]->ALL_LIST_COUNT : 0;
			$data['rdata'] = $rData;
			
			$paging['total_rows'] = $data['rowCount'];
			$paging['base_url'] = '/admin/codeManagement/schoolManagerList?q=&sch_sch_nm=' . $SCH_SCH_NM . '&sch_gubun=' . $SCH_CD_IDX;
			$this->pagination->initialize($paging); 
			
			$data['per_page'] = $per_page;
			$data['paging'] = $this->pagination->create_links();
			$data['allPage'] = $this->pagination->getProperty('total_pages');
			
			
			$data['gubunList'] = $this->codeList('SCH','form','sch_gubun',$SCH_CD_IDX);
			
			$data['SELECTBOX_CD_IDX'] = $this->codeList('SCH','form','CD_IDX');
			//var_dump($rdata);
			$this->loadView('admin/code/schoolList_form' , $data);
		}
		
		function schoolManagerData()
		{
			$this->load->library('Json');
			$this->load->model('admin/code/codemanagement_model','codelist',true);
			$SCH_IDX = $this->input->get('SCH_IDX');
			$res = $this->codelist->getSchoolData(array($SCH_IDX,'N'));
			
			$rdata = $res->result();
			
			$obj = array();
			foreach ($rdata as $key => $schdata)
			{
				$obj['SCH_NM'] = iconv('EUC-KR','UTF-8',$schdata->SCH_NM);
				$obj['CD_IDX'] = $schdata->CD_IDX;
				$obj['SCH_IDX'] = $schdata->SCH_IDX;
			}
			
			header("Cache-Control: no-cache");
			header("Pragma: no-cache");
			header("Content-Type: text/html; charset=UTF-8");
			echo $this->json->getArray2Json($obj);
		}
		
		function schoolManagerProcess()
		{
			$this->load->model('admin/code/codemanagement_model','codelist',true);
			
			$SCH_IDX = $this->input->post('SCH_IDX');
			$SCH_NM = $this->input->post('SCH_NM');
			$CD_IDX = $this->input->post('CD_IDX');
			$P_TYPE = $this->input->post('P_TYPE');
			$sch_gubun = $this->input->post('h_sch_gubun');
			$sch_lic_nm = $this->input->post('h_sch_sch_nm');
			$per_page = $this->input->post('h_per_page');
			
			if ($P_TYPE == 'regist')
			{
				$this->codelist->getInsertSchool(array($SCH_NM,$CD_IDX));
			}
			
			if ($P_TYPE == 'modify')
			{
				$this->codelist->getUpdateSchool(array($SCH_NM,$CD_IDX,$SCH_IDX,'N'));
				
			}
			
			if ($P_TYPE == 'delete')
			{
				$this->codelist->getDeleteSchool(array('Y',$SCH_IDX));
			}
			redirect('/admin/codeManagement/schoolManagerList?q=&sch_lic_nm=' . $sch_sch_nm . '&sch_gubun=' . $sch_gubun . '&per_page=' . $per_page);
		}
		
		
		
		
		// 어학 리스트
		function languageManagerList()
		{
			$data = null;
			$SCH_CD_IDX = $this->input->get('sch_gubun');
			$SCH_LAN_NM = $this->input->get('sch_lan_nm');
			$per_page = $this->input->get('per_page');
			
			$data['codeTitle'] = '어학';
			$data['sch_gubun'] = $SCH_CD_IDX;
			$data['sch_lan_nm'] = $SCH_LAN_NM;
			$this->load->library('pagination');	
			$this->load->model('admin/code/codemanagement_model','codelist',true);
			
			$per_page = !$per_page ? 1 : $per_page;
			$list = $this->pagination->getProperty('per_page');
			
			$res = $this->codelist->getLanguageList(array($SCH_CD_IDX,$SCH_LAN_NM ? '%' . $SCH_LAN_NM . '%' : null ,'N',$list * ($per_page - 1) + 1 ,$per_page * $list));
			$rData = $res->result();
			$data['rowCount'] = $res->num_rows() > 0 ? $rData[0]->ALL_LIST_COUNT : 0;
			$data['rdata'] = $rData;
			
			$paging['total_rows'] = $data['rowCount'];
			$paging['base_url'] = '/admin/codeManagement/languageManagerList?q=&sch_lan_nm=' . $SCH_LAN_NM . '&sch_gubun=' . $SCH_CD_IDX;
			$this->pagination->initialize($paging); 
			
			$data['per_page'] = $per_page;
			$data['paging'] = $this->pagination->create_links();
			$data['allPage'] = $this->pagination->getProperty('total_pages');
			
			
			$data['gubunList'] = $this->codeList('LAN','form','sch_gubun',$SCH_CD_IDX);
			
			$data['SELECTBOX_CD_IDX'] = $this->codeList('LAN','form','CD_IDX');
			$data['SELECTBOX_SCORE_TP'] = $this->codeList('LNT','form','SCORE_TP');
			//var_dump($rdata);
			$this->loadView('admin/code/languageList_form' , $data);
		}
		
		function languageManagerData()
		{
			$this->load->library('Json');
			$this->load->model('admin/code/codemanagement_model','codelist',true);
			$LAN_IDX = $this->input->get('LAN_IDX');
			$res = $this->codelist->getLanguageData(array($LAN_IDX,'N'));
			
			$rdata = $res->result();
			
			$obj = array();
			foreach ($rdata as $key => $landata)
			{
				$obj['LAN_NM'] = iconv('EUC-KR','UTF-8',$landata->LAN_NM);
				$obj['LAN_PB'] = iconv('EUC-KR','UTF-8',$landata->LAN_PB);
				$obj['SCORE_TP'] = $landata->SCORE_TP; 
				$obj['CD_IDX'] = $landata->CD_IDX;
				$obj['LAN_IDX'] = $landata->LAN_IDX;
			}
			
			header("Cache-Control: no-cache");
			header("Pragma: no-cache");
			header("Content-Type: text/html; charset=UTF-8");
			echo $this->json->getArray2Json($obj);
		}
		
		function languageManagerProcess()
		{
			$this->load->model('admin/code/codemanagement_model','codelist',true);
			
			$LAN_IDX = $this->input->post('LAN_IDX');
			$LAN_NM = $this->input->post('LAN_NM');
			$CD_IDX = $this->input->post('CD_IDX');
			$LAN_PB = $this->input->post('LAN_PB');
			$SCORE_TP = $this->input->post('SCORE_TP');
			
			$P_TYPE = $this->input->post('P_TYPE');
			$sch_gubun = $this->input->post('h_sch_gubun');
			$sch_lan_nm = $this->input->post('h_sch_lan_nm');
			$per_page = $this->input->post('h_per_page');
			
			if ($P_TYPE == 'regist')
			{
				$this->codelist->getInsertLanguage(array($LAN_NM,$LAN_PB,$SCORE_TP,$CD_IDX));
			}
			
			if ($P_TYPE == 'modify')
			{
				$this->codelist->getUpdateLanguage(array($LAN_NM,$LAN_PB,$SCORE_TP,$CD_IDX,$LAN_IDX,'N'));
				
			}
			
			if ($P_TYPE == 'delete')
			{
				$this->codelist->getDeleteLanguage(array('Y',$LAN_IDX));
			}
			redirect('/admin/codeManagement/languageManagerList?q=&sch_lic_nm=' . $sch_lan_nm . '&sch_gubun=' . $sch_gubun . '&per_page=' . $per_page);
		}
		
		
		
		
		
		// 근무지 리스트
		function workplaceManagerList()
		{
			$data = null;
			$COMP_ID = $this->authadmin->getCompanyId();
			$SCH_WRK_PLC_NM = $this->input->get('sch_wrk_plc_nm');
			$per_page = $this->input->get('per_page');
			
			$data['codeTitle'] = '근무지';
			$data['sch_wrk_plc_nm'] = $SCH_WRK_PLC_NM;
			$this->load->library('pagination');	
			$this->load->model('admin/code/codemanagement_model','codelist',true);
			
			$per_page = !$per_page ? 1 : $per_page;
			$list = $this->pagination->getProperty('per_page');
			
			$res = $this->codelist->getWorkPlaceList(array($COMP_ID,$SCH_WRK_PLC_NM ? '%' . $SCH_WRK_PLC_NM . '%' : null ,'N',$list * ($per_page - 1) + 1 ,$per_page * $list));
			$rData = $res->result();
			$data['rowCount'] = $res->num_rows() > 0 ? $rData[0]->ALL_LIST_COUNT : 0;
			$data['rdata'] = $rData;
			
			$paging['total_rows'] = $data['rowCount'];
			$paging['base_url'] = '/admin/codeManagement/workplaceManagerList?q=&sch_wrk_plc_nm=' . $SCH_WRK_PLC_NM;
			$this->pagination->initialize($paging); 
			
			$data['per_page'] = $per_page;
			$data['paging'] = $this->pagination->create_links();
			$data['allPage'] = $this->pagination->getProperty('total_pages');
			
			//var_dump($rdata);
			$this->loadView('admin/code/workplaceList_form' , $data);
		}
		
		function workplaceManagerData()
		{
			$this->load->library('Json');
			$this->load->model('admin/code/codemanagement_model','codelist',true);
			$COMP_ID = $this->authadmin->getCompanyId();
			$WP_IDX = $this->input->get('WP_IDX');
			$res = $this->codelist->getWorkPlaceData(array($COMP_ID,$WP_IDX,'N'));
			
			$rdata = $res->result();
			
			$obj = array();
			foreach ($rdata as $key => $wpdata)
			{
				$obj['WRK_PLC_NM'] = iconv('EUC-KR','UTF-8',$wpdata->WRK_PLC_NM);
				$obj['WP_IDX'] = $wpdata->WP_IDX;
			}
			
			header("Cache-Control: no-cache");
			header("Pragma: no-cache");
			header("Content-Type: text/html; charset=UTF-8");
			echo $this->json->getArray2Json($obj);
		}
		
		function workplaceManagerProcess()
		{
			$this->load->model('admin/code/codemanagement_model','codelist',true);
			
			$COMP_ID = $this->authadmin->getCompanyId();
			$WP_IDX = $this->input->post('WP_IDX');
			$WRK_PLC_NM = $this->input->post('WRK_PLC_NM');
			$P_TYPE = $this->input->post('P_TYPE');
			$sch_wrk_plc_nm = $this->input->post('h_wrk_plc_nm');
			$per_page = $this->input->post('h_per_page');
			
			if ($P_TYPE == 'regist')
			{
				$this->codelist->getInsertWorkPlace(array($COMP_ID,$WRK_PLC_NM));
			}
			
			if ($P_TYPE == 'modify')
			{
				$this->codelist->getUpdateWorkPlace(array($WRK_PLC_NM,$COMP_ID,$WP_IDX,'N'));
				
			}
			
			if ($P_TYPE == 'delete')
			{
				$this->codelist->getDeleteWorkPlace(array('Y',$COMP_ID,$WP_IDX));
			}
			redirect('/admin/codeManagement/workplaceManagerList?q=&sch_wrk_plc_nm=' . $sch_wrk_plc_nm . '&per_page=' . $per_page);
		}
		
		
		// 계열 관리 
		function majorAffiliationManagerList()
		{
			$data = null;
			$SCH_AFF_NM = $this->input->get('sch_aff_nm');
			$per_page = $this->input->get('per_page');
			
			$data['codeTitle'] = '계열';
			$data['sch_aff_nm'] = $SCH_AFF_NM;
			$this->load->library('pagination');	
			$this->load->model('admin/code/codemanagement_model','codelist',true);
			
			$per_page = !$per_page ? 1 : $per_page;
			$list = $this->pagination->getProperty('per_page');
			
			$res = $this->codelist->getMajorAffiliationList(array($SCH_AFF_NM ? '%' . $SCH_AFF_NM . '%' : null ,'N',$list * ($per_page - 1) + 1 ,$per_page * $list));
			$rData = $res->result();
			$data['rowCount'] = $res->num_rows() > 0 ? $rData[0]->ALL_LIST_COUNT : 0;
			$data['rdata'] = $rData;
			
			$paging['total_rows'] = $data['rowCount'];
			$paging['base_url'] = '/admin/codeManagement/majorAffiliationManagerList?q=&sch_aff_nm=' . $SCH_AFF_NM;
			$this->pagination->initialize($paging); 
			
			$data['per_page'] = $per_page;
			$data['paging'] = $this->pagination->create_links();
			$data['allPage'] = $this->pagination->getProperty('total_pages');
			
			//var_dump($rdata);
			$this->loadView('admin/code/affiliation_form' , $data);
		}
		
		function majorAffiliationManagerData()
		{
			$this->load->library('Json');
			$this->load->model('admin/code/codemanagement_model','codelist',true);
			$AFF_IDX = $this->input->get('AFF_IDX');
			$res = $this->codelist->getMajorAffiliationData(array($AFF_IDX,'N'));
			
			$rdata = $res->result();
			
			$obj = array();
			foreach ($rdata as $key => $mjrdata)
			{
				$obj['AFF_NM'] = iconv('EUC-KR','UTF-8',$mjrdata->AFF_NM);
				$obj['AFF_IDX'] = $mjrdata->AFF_IDX;
			}
			
			header("Cache-Control: no-cache");
			header("Pragma: no-cache");
			header("Content-Type: text/html; charset=UTF-8");
			echo $this->json->getArray2Json($obj);
		}
		
		function majorAffiliationManagerProcess()
		{
			$this->load->model('admin/code/codemanagement_model','codelist',true);
			
			$AFF_IDX = $this->input->post('AFF_IDX');
			$AFF_NM = $this->input->post('AFF_NM');
			$P_TYPE = $this->input->post('P_TYPE');
	
			$sch_aff_nm = $this->input->post('h_sch_aff_nm');
			$per_page = $this->input->post('h_per_page');
			
			if ($P_TYPE == 'regist')
			{
				$this->codelist->getInsertMajorAffiliation(array($AFF_NM));
			}
			
			if ($P_TYPE == 'modify')
			{
				$this->codelist->getUpdateMajorAffiliation(array($AFF_NM,$AFF_IDX,'N'));
				
			}
			
			if ($P_TYPE == 'delete')
			{
				$this->codelist->getDeleteMajorAffiliation(array('Y',$AFF_IDX));
			}
			redirect('/admin/codeManagement/majorAffiliationManagerList?q=&sch_aff_nm=' . $sch_aff_nm . '&per_page=' . $per_page);
		}
		
		
		
		
		
		// 소재지 관리 
		function majorLocationManagerList()
		{
			$data = null;
			$SCH_LOC_NM = $this->input->get('sch_loc_nm');
			$per_page = $this->input->get('per_page');
			
			$data['codeTitle'] = '소재지';
			$data['sch_loc_nm'] = $SCH_LOC_NM;
			$this->load->library('pagination');	
			$this->load->model('admin/code/codemanagement_model','codelist',true);
			
			$per_page = !$per_page ? 1 : $per_page;
			$list = $this->pagination->getProperty('per_page');
			
			$res = $this->codelist->getMajorLocationList(array($SCH_LOC_NM ? '%' . $SCH_LOC_NM . '%' : null ,'N',$list * ($per_page - 1) + 1 ,$per_page * $list));
			$rData = $res->result();
			$data['rowCount'] = $res->num_rows() > 0 ? $rData[0]->ALL_LIST_COUNT : 0;
			$data['rdata'] = $rData;
			
			$paging['total_rows'] = $data['rowCount'];
			$paging['base_url'] = '/admin/codeManagement/majorLocationManagerList?q=&sch_aff_nm=' . $SCH_LOC_NM;
			$this->pagination->initialize($paging); 
			
			$data['per_page'] = $per_page;
			$data['paging'] = $this->pagination->create_links();
			$data['allPage'] = $this->pagination->getProperty('total_pages');
			
			//var_dump($rdata);
			$this->loadView('admin/code/location_form' , $data);
		}
		
		function majorLocationManagerData()
		{
			$this->load->library('Json');
			$this->load->model('admin/code/codemanagement_model','codelist',true);
			$LOC_IDX = $this->input->get('LOC_IDX');
			$res = $this->codelist->getMajorLocationData(array($LOC_IDX,'N'));
			
			$rdata = $res->result();
			
			$obj = array();
			foreach ($rdata as $key => $mjrdata)
			{
				$obj['LOC_NM'] = iconv('EUC-KR','UTF-8',$mjrdata->LOC_NM);
				$obj['LOC_IDX'] = $mjrdata->LOC_IDX;
			}
			
			header("Cache-Control: no-cache");
			header("Pragma: no-cache");
			header("Content-Type: text/html; charset=UTF-8");
			echo $this->json->getArray2Json($obj);
		}
		
		function majorLocationManagerProcess()
		{
			$this->load->model('admin/code/codemanagement_model','codelist',true);
			
			$LOC_IDX = $this->input->post('LOC_IDX');
			$LOC_NM = $this->input->post('LOC_NM');
			$P_TYPE = $this->input->post('P_TYPE');
	
			$sch_loc_nm = $this->input->post('h_sch_loc_nm');
			$per_page = $this->input->post('h_per_page');
			
			if ($P_TYPE == 'regist')
			{
				$this->codelist->getInsertMajorLocation(array($LOC_NM));
			}
			
			if ($P_TYPE == 'modify')
			{
				$this->codelist->getUpdateMajorLocation(array($LOC_NM,$LOC_IDX,'N'));
				
			}
			
			if ($P_TYPE == 'delete')
			{
				$this->codelist->getDeleteMajorLocation(array('Y',$LOC_IDX));
			}
			redirect('/admin/codeManagement/majorLocationManagerList?q=&sch_loc_nm=' . $sch_loc_nm . '&per_page=' . $per_page);
		}
		
	}
	