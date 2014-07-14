<?
	class CompanyManagement extends MY_Controller
	{
		
		function Index()
		{
			$this->load->library('DataControl'); 
			$this->load->library('FormBox'); 
			$this->load->library('pagination');	
			$SCH_TYPE = $this->input->get('SCH_TYPE');
			$SCH_KEY = $this->input->get('SCH_KEY');
			$per_page = $this->input->get('per_page');
			$per_page = !$per_page ? 1 : $per_page;
			$list = $this->pagination->getProperty('per_page');
			
			$this->load->model('admin/setmanager/companyManagement_model','cmplist',TRUE);
			
			$data['paging'] = $this->pagination->create_links();
			$res = $this->cmplist->getCompanyList(array('N',$SCH_KEY ? '%' . $SCH_KEY .'%' : null ,$list * ($per_page - 1) + 1 ,$per_page * $list),$SCH_TYPE);
			$data['cmpListCount'] = $res->num_rows();
			$data['cmpList'] = $res->result();
			
			$data['rowCount'] = $res->num_rows() > 0 ? $data['cmpList'][0]->ALL_LIST_COUNT : 0;
			$data['rData'] = $res->result();
			
			$paging['total_rows'] = $data['rowCount'];
			$paging['base_url'] = '/admin/chargerManagement?SCH_KEY=' . $SCH_KEY . '&SCH_TYPE=' . $SCH_TYPE . '&q=';
			
			$this->pagination->initialize($paging); 
			
			$data['paging'] = $this->pagination->create_links();
			$data['cur_page'] = $per_page;		
			$data['allPage'] = $this->pagination->getProperty('total_pages');
			$arrSCH_TYPE = array();
			$arrSCH_TYPE[] = array('COMP_ID','아이디');
			$arrSCH_TYPE[] = array('COMP_NM','기업명');
			$arrSCH_TYPE[] = array('DOMAIN_ID','도메인');
			
			$this->formbox->setId('SCH_TYPE');
			$this->formbox->setName('SCH_TYPE');
			$this->formbox->setOption('');
			$data['SELECTBOX_SCH_TYPE'] = $this->formbox->getSelectBox($arrSCH_TYPE, '검색구분' , $SCH_TYPE , $objType = 'array');
			$data['SCH_KEY'] = $SCH_KEY;
			$this->loadView('admin/setmanager/companymanagement_view' , $data);
		}
		
		//기업 아이디 검색
		function checkCompanyId()
		{
			
			//$this->input->get('COMP_ID');
			$COMP_ID = $this->input->post('COMP_ID');
			$this->load->model('admin/setmanager/companyManagement_model','cmpcheck',TRUE);
			
			$res = $this->cmpcheck->checkCompanyId(array($COMP_ID));
			$data = $res->num_rows();
			if ($data > 0) {
				echo 'false'; 
			} else { 
				echo 'true';
			}
			
			//echo 'false';
			
		}
		
		//기업 도메인 검색
		function checkCompanyDomain()
		{
			//$this->input->get('COMP_ID');
			$DOMAIN_ID = $this->input->post('DOMAIN_ID');
			$this->load->model('admin/setmanager/companyManagement_model','dmncheck',TRUE);
			
			$res = $this->dmncheck->checkDomainId(array($DOMAIN_ID));
			$data = $res->num_rows();
			
			if (preg_match('/^common|sample|admin$/' , $DOMAIN_ID)) $data = 1;

			if ($data > 0) {
				echo 'false'; 
			} else { 
				echo 'true';
			}
		}
		
		//기업 정보 보기
		function ViewCompanyInfo()
		{
			$this->load->library('DataControl'); 
			$this->load->model('admin/setmanager/companyManagement_model','cmplist',TRUE);
			
			$comp_id = $this->input->get('company_id');
			
			
			$res = $this->cmplist->getCompanyDetail(array($comp_id,'N'));
			$data['cmpInfo'] = $res->result();
			
			$res2 = $this->cmplist->getManagerList(array($comp_id,'N'));
			$data['mngInfoCount'] = $res2->num_rows();
			$data['mngInfo'] = $res2->result();
			
			//$data['LOGO_IMG1'] = $this->datacontrol->getLogoPath($comp_id , $data['cmpInfo'][0]->LOGO_IMG1);
			//$data['LOGO_IMG2'] = $this->datacontrol->getLogoPath($comp_id , $data['cmpInfo'][0]->LOGO_IMG2);
			
			$data['LOGO_IMG1'] = $this->datacontrol->getLogoPath($data['cmpInfo'][0]->DOMAIN_ID,1);
			$data['LOGO_IMG2'] = $this->datacontrol->getLogoPath($data['cmpInfo'][0]->DOMAIN_ID,2);
			
			$data['FRONT_MAIN_IMG'] = $this->datacontrol->getFrontImagePath($data['cmpInfo'][0]->DOMAIN_ID , 'main');
			$data['FRONT_SUB_IMG'] = $this->datacontrol->getFrontImagePath($data['cmpInfo'][0]->DOMAIN_ID , 'sub');
			
			$xmlStr = file_get_contents($this->datacontrol->getFileLocation('front_setup.xml',$data['cmpInfo'][0]->DOMAIN_ID));
			
			$xmlObj = simplexml_load_string($xmlStr);
			
			$data['APPLY_SITE_TITLE'] = iconv('UTF-8','EUC-KR',$xmlObj->{'title'});
			$data['APPLY_SITE_TEMPLATE'] = $xmlObj->{'template'};
			
			$this->loadView('admin/setmanager/companymanagement_detail_view' , $data);
		}
		
		//기업 정보 수정폼
		function ModifyCompanyInfo()
		{
			$this->load->model('admin/setmanager/companyManagement_model','cmplist',TRUE);
			
			$comp_id = $this->input->get('company_id');
			
			$res = $this->cmplist->getCompanyDetail(array($comp_id,'N'));
			
			$data['cmpInfo'] = $res->result();
			
			$rdata = $res->result();
			
			$data['COMP_ID'] = $rdata[0]->COMP_ID;
			$data['COMP_NM'] = $rdata[0]->COMP_NM;
			$data['CMP_ADD'] = $rdata[0]->CMP_ADD;
			$data['CMP_TP'] = $rdata[0]->CMP_TP;
			$data['CMP_GUBUN'] = $rdata[0]->CMP_GUBUN;
			$data['QNA_MAIL'] = $rdata[0]->QNA_MAIL;
			$data['SRV_STS'] = $rdata[0]->SRV_STS;
			$data['PRJ_MNG'] = $rdata[0]->PRJ_MNG;
			$data['CEO_NM'] = $rdata[0]->CEO_NM;
			$data['DOMAIN_ID'] = $rdata[0]->DOMAIN_ID;
			
			$tel_ar = explode('-' , $rdata[0]->CMP_TEL);
			$fax_ar = explode('-' , $rdata[0]->CMP_FAX);
			$cmpno_ar = explode('-' , $rdata[0]->CMP_NO);
			$crpno_ar = explode('-' , $rdata[0]->CRP_NO);
			
			$data['TEL1'] = $tel_ar[0];
			$data['TEL2'] = $tel_ar[1];
			$data['TEL3'] = $tel_ar[2];
			
			$data['FAX1'] = $fax_ar[0];
			$data['FAX2'] = $fax_ar[1];
			$data['FAX3'] = $fax_ar[2];
			
			$this->load->library('DataControl'); 
			$this->load->library('FormBox'); 
			
			$this->formbox->setId('CMP_TEL1');
			$this->formbox->setName('CMP_TEL1');
			$this->formbox->setOption('style="width:84px;"');
			$data['SELECTBOX_TEL'] = $this->formbox->getSelectBox($this->datacontrol->getFile2Array('TEL.txt'), '선택' , $tel_ar[0]  , $objType = 'array');
			
			$this->formbox->setId('CMP_FAX1');
			$this->formbox->setName('CMP_FAX1');
			$this->formbox->setOption('style="width:84px;"');
			
			$data['SELECTBOX_FAX'] = $this->formbox->getSelectBox($this->datacontrol->getFile2Array('TEL.txt'), '선택' , $fax_ar[0] , $objType = 'array');
			
			//$data['LOGO_IMG1'] = $this->datacontrol->getLogoPath($comp_id , $rdata[0]->LOGO_IMG1);
			//$data['LOGO_IMG2'] = $this->datacontrol->getLogoPath($comp_id , $rdata[0]->LOGO_IMG2);
			
			$data['LOGO_IMG1'] = $this->datacontrol->getLogoPath($rdata[0]->DOMAIN_ID,1);
			$data['LOGO_IMG2'] = $this->datacontrol->getLogoPath($rdata[0]->DOMAIN_ID,2);
			
			
			$data['LOGO_IMG1_FILE'] = $rdata[0]->LOGO_IMG1;
			$data['LOGO_IMG2_FILE'] = $rdata[0]->LOGO_IMG2;
			
			$data['FRONT_MAIN_IMG'] = $this->datacontrol->getFrontImagePath($data['cmpInfo'][0]->DOMAIN_ID , 'main');
			$data['FRONT_SUB_IMG'] = $this->datacontrol->getFrontImagePath($data['cmpInfo'][0]->DOMAIN_ID , 'sub');
			
			$xmlStr = file_get_contents($this->datacontrol->getFileLocation('front_setup.xml',$data['cmpInfo'][0]->DOMAIN_ID));
			
			$xmlObj = simplexml_load_string($xmlStr);
			
			$data['APPLY_SITE_TITLE'] = iconv('UTF-8','EUC-KR',$xmlObj->{'title'});
			$data['APPLY_SITE_TEMPLATE'] = $xmlObj->{'template'};
			
			$data['CMP_NO1'] = $cmpno_ar[0];
			$data['CMP_NO2'] = $cmpno_ar[1];
			$data['CMP_NO3'] = $cmpno_ar[2];
			
			$data['CRP_NO1'] = $crpno_ar[0];
			$data['CRP_NO2'] = $crpno_ar[1];
			$data['backURL'] = '/admin/companyManagement/ViewCompanyInfo?company_id=' . $rdata[0]->COMP_ID;
			$data['process_type']	= 'edit';
			$this->loadView('admin/setmanager/companymanagement_detail_form' , $data);
		}
		
		function RegistCompanyInfo()
		{
			
			$this->load->library('DataControl'); 
			$this->load->library('FormBox'); 
			
			$data['backURL'] = '/admin/companyManagement';
			$data['process_type']	= 'regist';
			$data['COMP_ID'] 		= null;
			$data['COMP_NM'] 		= null;
			$data['CMP_ADD'] 		= null;
			$data['CMP_TP'] 		= null;
			$data['CMP_GUBUN'] 	= null;
			$data['QNA_MAIL'] 	= null;
			$data['SRV_STS'] 		= null;
			$data['PRJ_MNG'] 		= null;
			$data['CEO_NM'] 		= null;
			$data['DOMAIN_ID'] 	= null;
			
			$data['LOGO_IMG1']  = null;
			$data['LOGO_IMG2']  = null;
			
			$tel_ar = explode('-' , '--');
			$fax_ar = explode('-' , '--');
			$cmpno_ar = explode('-' , '--');
			$crpno_ar = explode('-' , '-');
			
			$data['TEL1'] = $tel_ar[0];
			$data['TEL2'] = $tel_ar[1];
			$data['TEL3'] = $tel_ar[2];
			
			$data['FAX1'] = $fax_ar[0];
			$data['FAX2'] = $fax_ar[1];
			$data['FAX3'] = $fax_ar[2];
			
			$data['LOGO_IMG1_FILE'] = null;
			$data['LOGO_IMG2_FILE'] = null;
			
			$data['LOGO_IMG1'] = $this->datacontrol->getLogoPath();
			$data['LOGO_IMG2'] = $this->datacontrol->getLogoPath();
			
			$data['FRONT_MAIN_IMG'] = $this->datacontrol->getFrontImagePath(null , 'main');
			$data['FRONT_SUB_IMG'] = $this->datacontrol->getFrontImagePath(null , 'sub');
			
			$data['APPLY_SITE_TITLE'] = null;
			$data['APPLY_SITE_TEMPLATE'] = 'design1';
			
			$data['CMP_NO1'] = $cmpno_ar[0];
			$data['CMP_NO2'] = $cmpno_ar[1];
			$data['CMP_NO3'] = $cmpno_ar[2];
			
			$data['CRP_NO1'] = $crpno_ar[0];
			$data['CRP_NO2'] = $crpno_ar[1];
			
			$this->load->library('DataControl'); 
			$this->load->library('FormBox'); 
			
			$this->formbox->setId('CMP_TEL1');
			$this->formbox->setName('CMP_TEL1');
			$this->formbox->setOption('style="width:84px;"');
			$data['SELECTBOX_TEL'] = $this->formbox->getSelectBox($this->datacontrol->getFile2Array('TEL.txt'), '선택' , '' , $objType = 'array');
			
			$this->formbox->setId('CMP_FAX1');
			$this->formbox->setName('CMP_FAX1');
			$this->formbox->setOption('style="width:84px;"');
			
			$data['SELECTBOX_FAX'] = $this->formbox->getSelectBox($this->datacontrol->getFile2Array('TEL.txt'), '선택' , '' , $objType = 'array');
			
			
			
			$this->loadView('admin/setmanager/companymanagement_detail_form' , $data);
		}
		
		function companyInfoProcess()
		{
			//TBL_COMPANY
			$P_COMP_NM = $this->input->post('COMP_NM');
			$P_COMP_ID = $this->input->post('COMP_ID');
			$P_CMP_NO1 = $this->input->post('CMP_NO1');
			$P_CMP_NO2 = $this->input->post('CMP_NO2');
			$P_CMP_NO3 = $this->input->post('CMP_NO3');
			$P_DOMAIN_ID = $this->input->post('DOMAIN_ID');
			$P_QNA_MAIL = $this->input->post('QNA_MAIL');
			$P_SRV_STS = $this->input->post('SRV_STS');
			$P_PRJ_MNG = $this->input->post('PRJ_MNG');
			
			$P_CMP_NO  = $P_CMP_NO1 . '-' . $P_CMP_NO2 . '-' . $P_CMP_NO3;
			
			//TBL_COMPANY_DTL
			$P_CRP_NO1 = $this->input->post('CRP_NO1');
			$P_CRP_NO2 = $this->input->post('CRP_NO2');
			$P_CEO_NM = $this->input->post('CEO_NM');
			$P_CMP_ADD = $this->input->post('CMP_ADD');
			$P_CMP_TP = $this->input->post('CMP_TP');
			$P_CMP_GUBUN = $this->input->post('CMP_GUBUN');
			 
			$P_CMP_FAX1 = $this->input->post('CMP_FAX1');
			$P_CMP_FAX2 = $this->input->post('CMP_FAX2');
			$P_CMP_FAX3 = $this->input->post('CMP_FAX3');
			$P_CMP_TEL1 = $this->input->post('CMP_TEL1');
			$P_CMP_TEL2 = $this->input->post('CMP_TEL2');
			$P_CMP_TEL3 = $this->input->post('CMP_TEL3');
			
			$APPLY_SITE_TITLE = $this->input->post('APPLY_SITE_TITLE');
			$APPLY_SITE_TEMPLATE = $this->input->post('APPLY_SITE_TEMPLATE');
			
			$P_CMP_TEL = $P_CMP_TEL1 . '-' . $P_CMP_TEL2 . '-' . $P_CMP_TEL3;
			$P_CMP_FAX = $P_CMP_FAX1 . '-' . $P_CMP_FAX2 . '-' . $P_CMP_FAX3;
			$P_CRP_NO  = $P_CRP_NO1 . '-' . $P_CRP_NO2;
			
			$P_TYPE 		= $this->input->post('process_type');
			
			$LOGO_IMG1_FILE = $this->input->post('LOGO_IMG1_FILE');
			$LOGO_IMG2_FILE = $this->input->post('LOGO_IMG2_FILE');
			
			//echo $_FILES['LOGO_IMG1']['type'];
			
			/* XML FILE */
			$this->load->helper('file');
			
			 $data = '<?xml version="1.0"  encoding="EUC-KR"?>
								<root>
									<title>' . $APPLY_SITE_TITLE . '</title>
									<template>' . $APPLY_SITE_TEMPLATE . '</template>
								</root>';
 			
 			if (!file_exists(APPPATH . MAIN_SERVICE_DIRECTORY . $P_DOMAIN_ID))  mkdir(APPPATH . MAIN_SERVICE_DIRECTORY . $P_DOMAIN_ID);
 			if (!file_exists(APPPATH . MAIN_SERVICE_DIRECTORY . $P_DOMAIN_ID . '/set'))  mkdir(APPPATH . MAIN_SERVICE_DIRECTORY . $P_DOMAIN_ID . '/set');
 			
 			//if (file_exists(APPPATH . LOCAL_SERVICE_DIRECTORY
 			
			if ( ! write_file(APPPATH . MAIN_SERVICE_DIRECTORY . $P_DOMAIN_ID . '/set/front_setup.xml', $data))
			{
				jsalertmsg('접수사이트 생성에 필요한 파일 생성에 실패하였습니다.[XML 파일생성 실패]');
				jshistoryback();
				exit;
			}
			
			$file_extension = null;
			
			$file_nm1 = null;
			$file_nm2 = null;		
			if ($_FILES['LOGO_IMG1']['name'] != '')
			{
				if (preg_match('/png|peg|jpg|gif$/',$_FILES['LOGO_IMG1']['type']))
				{
			
					switch (substr($_FILES['LOGO_IMG1']['type'],-3))
					{
						case 'png' :
							$file_extension = 'png';
							break;
							
						case 'gif' :
							$file_extension = 'gif';
							break;
						case 'peg' :
						case 'jpg' :
							$file_extension = 'jpg';
							break;
					}
					
					if (!file_exists(FRONT_SERVICE_DIRECTORY . '/logo/' . $P_DOMAIN_ID)) mkdir(FRONT_SERVICE_DIRECTORY . '/logo/' . $P_DOMAIN_ID);
					$file_nm1 = 'logo' .'1';
					if(move_uploaded_file($_FILES['LOGO_IMG1']['tmp_name'],FRONT_SERVICE_DIRECTORY . '/logo/' . $P_DOMAIN_ID . '/' . $file_nm1))
					{
						//echo 'OK';
					}
					else
					{
						//echo 'BAD';
					}
					
				}
				else
				{
					jsalertmsg('이미지만 업로드 가능합니다.');
					jshistoryback();
					exit;
				}
			}
			
			if ($_FILES['LOGO_IMG2']['name'] != '')
			{
				if (preg_match('/png|peg|jpg|gif$/',$_FILES['LOGO_IMG2']['type']))
				{
			
					switch (substr($_FILES['LOGO_IMG2']['type'],-3))
					{
						case 'png' :
							$file_extension = 'png';
							break;
						case 'gif' :
							$file_extension = 'gif';
							break;
						case 'peg' :
						case 'jpg' :
							$file_extension = 'jpg';
							break;
					}
					
					if (!file_exists(FRONT_SERVICE_DIRECTORY . '/logo/' . $P_DOMAIN_ID)) mkdir(FRONT_SERVICE_DIRECTORY . '/logo/' . $P_DOMAIN_ID);
					$file_nm2 = 'logo' .'2';
					if(move_uploaded_file($_FILES['LOGO_IMG2']['tmp_name'],FRONT_SERVICE_DIRECTORY . '/logo/' . $P_DOMAIN_ID . '/' . $file_nm2))
					{
						//echo 'OK';
					}
					else
					{
						//echo 'BAD';
					}
				}		
				else
				{
					jsalertmsg('이미지만 업로드 가능합니다.');
					jshistoryback();
					exit;
				}
			}
			
			// 메인이미지 
			
			if ($_FILES['TOP_IMG1']['name'] != '')
			{
				if (preg_match('/jpg|jpeg$/',$_FILES['TOP_IMG1']['type']))
				{
					if (!file_exists(FRONT_SERVICE_DIRECTORY . '/design/' . $P_DOMAIN_ID)) mkdir(FRONT_SERVICE_DIRECTORY . '/design/' . $P_DOMAIN_ID);
					$file_nm1 = 'main_visual.jpg';
					move_uploaded_file($_FILES['TOP_IMG1']['tmp_name'],FRONT_SERVICE_DIRECTORY . '/design/' . $P_DOMAIN_ID . '/' . $file_nm1);
				}
				else
				{
					jsalertmsg('JPG 이미지만 업로드 가능합니다.');
					jshistoryback();
					exit;
				}
			}
			
			// 서브이미지 
			if ($_FILES['TOP_IMG2']['name'] != '')
			{
				if (preg_match('/jpg|jpeg$/',$_FILES['TOP_IMG2']['type']))
				{
					if (!file_exists(FRONT_SERVICE_DIRECTORY . '/design/' . $P_DOMAIN_ID)) mkdir(FRONT_SERVICE_DIRECTORY . '/design/' . $P_DOMAIN_ID);
					$file_nm2 = 'sub_visual.jpg';
					move_uploaded_file($_FILES['TOP_IMG2']['tmp_name'],FRONT_SERVICE_DIRECTORY . '/design/' . $P_DOMAIN_ID . '/' . $file_nm2);
				}
				else
				{
					jsalertmsg('JPG 이미지만 업로드 가능합니다.');
					jshistoryback();
					exit;
				}
			}
			
				//$LOGO_IMG1_FILE = $this->input->post('LOGO_IMG1_FILE');
			//$LOGO_IMG2_FILE = $this->input->post('LOGO_IMG2_FILE');
		//	echo $file_nm2;
		//	echo $LOGO_IMG2_FILE ;
		//	exit;
			if (!$file_nm1 AND $LOGO_IMG1_FILE != '') $file_nm1 = $LOGO_IMG1_FILE;
			if (!$file_nm2 AND $LOGO_IMG2_FILE != '') $file_nm2 = $LOGO_IMG2_FILE;
			/*
				
			$file_type = $_FILES['EX_FILE_UPLOAD']['type'];
			$P_PRJ_IDX = $this->input->post('PRJ_IDX');
			$P_STEP_IDX = $this->input->post('STEP_IDX');
			$this->load->library('excel');
			
			$this->excel->setLoadFile($_FILES['EX_FILE_UPLOAD']);
			$excel_data = $this->excel->getExcel2Array($_FILES['EX_FILE_UPLOAD']);
			*/
			
			
			// 등록 또는 수정
			$this->load->model('admin/setmanager/companyManagement_model','cmpproc',TRUE);
			if ($P_TYPE == 'edit')
			{
				$res1 = $this->cmpproc->CompanyUpdateInfoBase(array($P_COMP_NM,$P_CMP_NO,$P_QNA_MAIL,$P_SRV_STS,$P_PRJ_MNG,$P_COMP_ID));
				$res2 = $this->cmpproc->CompanyUpdateInfoDetail(array($P_CRP_NO,$P_CEO_NM,$P_CMP_TEL,$P_CMP_FAX,$P_CMP_ADD,$P_CMP_TP,$P_CMP_GUBUN,$file_nm1,$file_nm2,$P_COMP_ID));
			
				redirect('/admin/companyManagement/ViewCompanyInfo?company_id=' . $P_COMP_ID);
				
			}
			
			if ($P_TYPE == 'regist') 
			{
				$res1 = $this->cmpproc->CompanyInsertInfoBase(array($P_COMP_ID,$P_COMP_NM,$P_CMP_NO,$P_DOMAIN_ID,$P_QNA_MAIL,$P_SRV_STS,$P_PRJ_MNG));
				$res2 = $this->cmpproc->CompanyInsertInfoDetail(array($P_COMP_ID,$P_CRP_NO,$P_CEO_NM,$P_CMP_TEL,$P_CMP_FAX,$P_CMP_ADD,$P_CMP_TP,$P_CMP_GUBUN,$file_nm1,$file_nm2));
				
				redirect('/admin/companyManagement');
			}
			
		}
		
		
		
	}
	