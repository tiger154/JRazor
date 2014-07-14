<?
	class ProjectManagement extends MY_Controller
	{
	
		function Index()
		{
			$data = null;
			$this->load->library('pagination');	
			$per_page = $this->input->get('per_page');
			$per_page = !$per_page ? 1 : $per_page;
			$list = $this->pagination->getProperty('per_page');
			$this->load->model('admin/project/projectmanager_model','prjlist',true);
			$res = $this->prjlist->getSummaryList(array('N','O','N',$list * ($per_page - 1) + 1 ,$per_page * $list));
			$data['rowCount'] = 0;
			$rData = $res->result();
			$data['rowCount'] = $res->num_rows() > 0 ? $rData[0]->ALL_LIST_COUNT : 0;
			$data['rData'] = $res->result();
			
			$paging['total_rows'] = $data['rowCount'];
			$paging['base_url'] = '/admin/projectManagement?q=';
			$this->pagination->initialize($paging); 
			$data['paging'] = $this->pagination->create_links();
			
			$this->loadView('admin/project/project_summary' , $data);
		}
		
		function projectList()
		{
			$this->load->library('pagination');	
			$sch_prj_nm = $this->input->get('sch_prj_nm');
			$per_page = $this->input->get('per_page');
			$per_page = !$per_page ? 1 : $per_page;
			$list = $this->pagination->getProperty('per_page');;
			$COMP_ID = $this->authadmin->getCompanyId();

			$this->load->model('admin/project/projectmanager_model','prjlist',true);
			$res = $this->prjlist->getProjectList(array($COMP_ID,$sch_prj_nm != null ? '%' . $sch_prj_nm . '%' : NULL,'N','N',$list * ($per_page - 1) + 1 ,$per_page * $list));
			$data['prjdata'] = $res->result();
			$data['rowCount'] = $res->num_rows() > 0 ? $data['prjdata'][0]->ALL_LIST_COUNT : 0;
			
			$data['prjdataCount'] = $res->num_rows();
			
			$paging['total_rows'] = $data['rowCount'];
			$paging['base_url'] = '/admin/projectManagement/projectList?q=&sch_prj_nm=' . $sch_prj_nm;
			$this->pagination->initialize($paging); 
			$data['paging'] = $this->pagination->create_links();
			$data['sch_prj_nm'] = $sch_prj_nm;
			$this->loadView('admin/project/projectlist' , $data);
		}
		
		function projectViewForContent()
		{
			$PRJ_IDX = $this->input->get('project_id');
			$COMP_ID = $this->authadmin->getCompanyId();
			$COMP_NM = $this->authadmin->getCompanyNm();
			$DISPLAY_CODE = $this->input->get('DISPLAY_CODE');
			$this->load->model('admin/project/projectmanager_model','prjview',true);
			$res = $this->prjview->getProjectViewForContent(array($COMP_ID,$PRJ_IDX,'N','N'));
			$rdata = $res->result();
			
			if ($DISPLAY_CODE == 'CNTNT')
			{
				echo '' . String2Html($rdata[0]->PRJ_CNTNT) . '';
			}
			
			if ($DISPLAY_CODE == 'SUMMARY')
			{
				echo '' . String2Html($rdata[0]->PRJ_SUMMARY) . '';
			}
		}
		
		function projectView()
		{
			$P_PRJ_IDX = $this->input->get('project_id');
			$data = null;
			
			$COMP_ID = $this->authadmin->getCompanyId();
			$COMP_NM = $this->authadmin->getCompanyNm();
			
			$this->load->model('admin/project/projectmanager_model','prjview',true);
			$res = $this->prjview->getProjectView(array($COMP_ID,$P_PRJ_IDX,'N','N','N'));
			
			$rdata = $res->result();
			$data['COMP_ID']			= $COMP_ID;
			$data['COMP_NM']			= $COMP_NM;
			$data['DOMAIN_ID']		= $rdata[0]->DOMAIN_ID;
			$data['PRJ_IDX'] 			= $rdata[0]->PRJ_IDX;
			$data['PRJ_NM'] 			= String2Html($rdata[0]->PRJ_NM);
			$data['PRJ_STDT1'] 		= $rdata[0]->PRJ_STDT1;
			$data['PRJ_EDDT1'] 		= $rdata[0]->PRJ_EDDT1;
			$data['PRJ_STDT2'] 		= $rdata[0]->PRJ_STDT2;
			$data['PRJ_EDDT2'] 		= $rdata[0]->PRJ_EDDT2;
			$data['PRJ_STDT3'] 		= $rdata[0]->PRJ_STDT3;
			$data['PRJ_EDDT3'] 		= $rdata[0]->PRJ_EDDT3;
			$data['PRJ_STS'] 			= $rdata[0]->PRJ_STS;
			
			$data['PERSONAL_USE_YN']		= $rdata[0]->PERSONAL_USE_YN == 'Y' ? '사용' : '미사용';
			$data['FAMILY_USE_YN']			= $rdata[0]->FAMILY_USE_YN == 'Y' ? '사용' : '미사용';
			$data['SCHOOL_USE_YN']			= $rdata[0]->SCHOOL_USE_YN == 'Y' ? '사용' : '미사용';
			$data['CAREER_USE_YN']			= $rdata[0]->CAREER_USE_YN == 'Y' ? '사용' : '미사용';
			$data['LANGUAGE_USE_YN']		= $rdata[0]->LANGUAGE_USE_YN == 'Y' ? '사용' : '미사용';
			$data['LICENSE_USE_YN']			= $rdata[0]->LICENSE_USE_YN == 'Y' ? '사용' : '미사용';
			$data['ARMY_USE_YN']				= $rdata[0]->ARMY_USE_YN == 'Y' ? '사용' : '미사용';
			$data['TRAINING_USE_YN']		= $rdata[0]->TRAINING_USE_YN == 'Y' ? '사용' : '미사용';
			$data['SERVE_USE_YN']				= $rdata[0]->SERVE_USE_YN == 'Y' ? '사용' : '미사용';
			$data['PRIZE_USE_YN']				= $rdata[0]->PRIZE_USE_YN == 'Y' ? '사용' : '미사용';
			$data['PC_USE_YN']					= $rdata[0]->PC_USE_YN == 'Y' ? '사용' : '미사용';
			$data['CONTENT_USE_YN']			= $rdata[0]->CONTENT_USE_YN == 'Y' ? '사용' : '미사용';
			$data['FILE_USE_YN']				= $rdata[0]->FILE_USE_YN == 'Y' ? '사용' : '미사용';
			$data['EDUCATION_USE_YN']		= $rdata[0]->EDUCATION_USE_YN == 'Y' ? '사용' : '미사용';
			$data['TECH_USE_YN']				= $rdata[0]->TECH_USE_YN == 'Y' ? '사용' : '미사용';
			$data['LANGUAGE2_USE_YN']		= $rdata[0]->LANGUAGE2_USE_YN == 'Y' ? '사용' : '미사용';
			$data['WRITE_USE_YN']				= $rdata[0]->WRITE_USE_YN == 'Y' ? '사용' : '미사용';

			
			//$data['PRJ_CNTNT'] 		= String2Html($rdata[0]->PRJ_CNTNT);
			//$data['PRJ_CNTNT'] 		= $rdata[0]->PRJ_CNTNT;
			//$data['PRJ_SUMMARY'] 	= String2Html($rdata[0]->PRJ_SUMMARY);
			//$data['PRJ_SUMMARY'] 	= $rdata[0]->PRJ_SUMMARY;
			 
			$this->load->model('admin/stat/statmanagement_model','stat',true);
			$res = $this->stat->getStatStepList(array($P_PRJ_IDX,$P_PRJ_IDX,$P_PRJ_IDX,$P_PRJ_IDX));
			$data['stepData'] = $res->result();
			
			$this->loadView('admin/project/project_detail_view' , $data);
		}
		
		function projectModify()
		{
			$P_PRJ_IDX = $this->input->get('project_id');
			
			$COMP_ID = $this->authadmin->getCompanyId();
			$COMP_NM = $this->authadmin->getCompanyNm();
			
			$this->load->model('admin/project/projectmanager_model','prjview',true);
			$res = $this->prjview->getProjectView(array($COMP_ID,$P_PRJ_IDX,'N','N','N'));
			
			$rdata = $res->result();
			$data['P_BACK_URL']		= '/admin/projectManagement/projectView?project_id=' . $P_PRJ_IDX;
			$data['P_TYPE']				= 'modify';
			$data['COMP_ID']			= $COMP_ID;
			$data['COMP_NM']			= $COMP_NM;
			foreach ($rdata[0] as $key => $rsList)
			{
				$data[$key] 			= $rsList;
			}
			
			
			
			$this->load->library('DataControl'); 
			$this->load->library('FormBox'); 
			
			$this->formbox->setId('PRJ_STDT2');
			$this->formbox->setName('PRJ_STDT2');
			$this->formbox->setOption('style="width:54px;"');
			$data['SELECTBOX_STDT_HOUR'] = $this->formbox->getSelectBox($this->datacontrol->getFile2Array('HOUR.txt'), '선택' , $rdata[0]->PRJ_STDT2 , $objType = 'array');
			
			$this->formbox->setId('PRJ_STDT3');
			$this->formbox->setName('PRJ_STDT3');
			$this->formbox->setOption('style="width:54px;"');
			$data['SELECTBOX_STDT_MIN'] = $this->formbox->getSelectBox($this->datacontrol->getFile2Array('MIN.txt'), '선택' , $rdata[0]->PRJ_STDT3 , $objType = 'array');
			
			$this->formbox->setId('PRJ_EDDT2');
			$this->formbox->setName('PRJ_EDDT2');
			$this->formbox->setOption('style="width:54px;"');
			$data['SELECTBOX_EDDT_HOUR'] = $this->formbox->getSelectBox($this->datacontrol->getFile2Array('HOUR.txt'), '선택' , $rdata[0]->PRJ_EDDT2 , $objType = 'array');
			
			$this->formbox->setId('PRJ_EDDT3');
			$this->formbox->setName('PRJ_EDDT3');
			$this->formbox->setOption('style="width:54px;"');
			$data['SELECTBOX_EDDT_MIN'] = $this->formbox->getSelectBox($this->datacontrol->getFile2Array('MIN.txt'), '선택' , $rdata[0]->PRJ_EDDT3 , $objType = 'array');
			
			$contents_res = $this->prjview->getSubContentList(array($P_PRJ_IDX));
			
			$data['CNTNT_count'] = $contents_res->num_rows();
			$data['CNTNT_data'] = null;
			if ($data['CNTNT_count'] > 0 ) $data['CNTNT_data'] = $contents_res->result();
			
			/////////////////////////////////////////////////////////////////////////////
			
			$file_res = $this->prjview->getSubFileList(array($P_PRJ_IDX));
			
			$data['FILE_count'] = $file_res->num_rows();
			$data['FILE_data'] = null;
			if ($data['FILE_count'] > 0 ) $data['FILE_data'] = $file_res->result();
			
			/////////////////////////////////////////////////////////////////////////////
			
			$computer_res = $this->prjview->getSubComputerList(array($P_PRJ_IDX));
			
			$data['COMPUTER_count'] = $computer_res->num_rows();
			$data['COMPUTER_data'] = null;
			if ($data['COMPUTER_count'] > 0 ) $data['COMPUTER_data'] = $computer_res->result();
			
			/////////////////////////////////////////////////////////////////////////////
			
			$language_res = $this->prjview->getSubLanguageList(array($P_PRJ_IDX));
			
			$data['LANGUAGE_count'] = $language_res->num_rows();
			$data['LANGUAGE_data'] = null;
			if ($data['LANGUAGE_count'] > 0 ) $data['LANGUAGE_data'] = $language_res->result();
			
			$this->loadView('admin/project/project_detail_form' , $data);
		}
		
		function projectRegist()
		{
			$COMP_ID = $this->authadmin->getCompanyId();
			$COMP_NM = $this->authadmin->getCompanyNm();
			$data['CNTNT_count'] = 0;
			$data['P_BACK_URL']		= '/admin/projectManagement/projectList';
			$data['P_TYPE'] 			= 'regist';
			$data['COMP_ID']			= $COMP_ID;
			$data['COMP_NM']			= $COMP_NM;
			$data['PRJ_IDX'] 			= null;
			$data['PRJ_NM'] 			= null;
			$data['PRJ_STDT1'] 		= null;
			$data['PRJ_EDDT1'] 		= null;
			$data['PRJ_STDT2'] 		= null;
			$data['PRJ_EDDT2'] 		= null;
			$data['PRJ_STS'] 			= null;
			$data['PRJ_CNTNT'] 		= null;
			$data['PRJ_SUMMARY'] 	= null; 
			$data['LANGUAGE_count'] = 0;
			$data['COMPUTER_count'] = 0;
			$data['PERSONAL_USE_YN']		= null;
			$data['FAMILY_USE_YN']			= null;
			$data['FAMILY_FORM_CNT']	  = null;
			$data['SCHOOL_USE_YN']			= null;
			$data['SCHOOL_FORM_CNT']		= null;
			$data['CAREER_USE_YN']			= null;
			$data['CAREER_FORM_CNT']		= null;
			$data['LANGUAGE_USE_YN']		= null;
			$data['LICENSE_USE_YN']			= null;
			$data['LICENSE_FORM_CNT']			= null;
			$data['ARMY_USE_YN']				= null;
			$data['TRAINING_USE_YN']		= null;
			$data['TRAINING_FORM_CNT']		= null;
			$data['SERVE_USE_YN']				= null;
			$data['SERVE_FORM_CNT']				= null;
			$data['PRIZE_USE_YN']				= null;
			$data['PRIZE_FORM_CNT']				= null;
			$data['PC_USE_YN']					= null;
			$data['CONTENT_USE_YN']			= null;
			$data['FILE_USE_YN']				= null;
			$data['EDUCATION_USE_YN']		= null;
			$data['EDUCATION_FORM_CNT']		= null;
			$data['TECH_USE_YN']				= null;
			$data['TECH_FORM_CNT']				= null;
			$data['LANGUAGE2_USE_YN']		= null;
			$data['LANGUAGE2_FORM_CNT']		= null;
			$data['WRITE_USE_YN']				= null;
			$data['WRITE_FORM_CNT']				= null;
			
			
			
			$this->load->library('DataControl'); 
			$this->load->library('FormBox'); 
			
			$this->formbox->setId('PRJ_STDT2');
			$this->formbox->setName('PRJ_STDT2');
			$this->formbox->setOption('style="width:54px;"');
			$data['SELECTBOX_STDT_HOUR'] = $this->formbox->getSelectBox($this->datacontrol->getFile2Array('HOUR.txt'), '선택' , '' , $objType = 'array');
			
			$this->formbox->setId('PRJ_STDT3');
			$this->formbox->setName('PRJ_STDT3');
			$this->formbox->setOption('style="width:54px;"');
			$data['SELECTBOX_STDT_MIN'] = $this->formbox->getSelectBox($this->datacontrol->getFile2Array('MIN.txt'), '선택' , '' , $objType = 'array');
			
			$this->formbox->setId('PRJ_EDDT2');
			$this->formbox->setName('PRJ_EDDT2');
			$this->formbox->setOption('style="width:54px;"');
			$data['SELECTBOX_EDDT_HOUR'] = $this->formbox->getSelectBox($this->datacontrol->getFile2Array('HOUR.txt'), '선택' , '' , $objType = 'array');
			
			$this->formbox->setId('PRJ_EDDT3');
			$this->formbox->setName('PRJ_EDDT3');
			$this->formbox->setOption('style="width:54px;"');
			$data['SELECTBOX_EDDT_MIN'] = $this->formbox->getSelectBox($this->datacontrol->getFile2Array('MIN.txt'), '선택' , '' , $objType = 'array');
			
			
			$data['CNTNT_count'] = 0;
			$data['CNTNT_data'] = null;
			
			/////////////////////////////////////////////////////////////////////////////
			
			$data['FILE_count'] = 0;
			$data['FILE_data'] = null;
			
			$this->load->model('admin/project/projectmanager_model','prjview',true);
			$computer_res = $this->prjview->getSubComputerList(array(null));
			
			$data['COMPUTER_count'] = $computer_res->num_rows();
			$data['COMPUTER_data'] = null;
			if ($data['COMPUTER_count'] > 0 ) $data['COMPUTER_data'] = $computer_res->result();
			
			/////////////////////////////////////////////////////////////////////////////
			
			$language_res = $this->prjview->getSubLanguageList(array(null));
			
			$data['LANGUAGE_count'] = $language_res->num_rows();
			$data['LANGUAGE_data'] = null;
			if ($data['LANGUAGE_count'] > 0 ) $data['LANGUAGE_data'] = $language_res->result();
		
			
			
			$this->loadView('admin/project/project_detail_form' , $data);        
		}
		
		//프로젝트및 이력서 등록 또는 수정
		function projectProcess()
		{

			//$obj[]['P_COMP_ID'] = 
			//$this->input->post('COMP_ID');
			
			$P_TYPE = $this->input->post('P_TYPE');
			
			$PRJ_IDX = $this->input->post('PRJ_IDX');
			$PRJ_NM = Html2String($this->input->post('PRJ_NM'));
			
			$PERSONAL_USE_YN = null;
			$FAMILY_USE_YN = null;
			$SCHOOL_USE_YN = null;
			$CAREER_USE_YN = null;
			$LANGUAGE_USE_YN = null;
			$LICENSE_USE_YN = null;
			$ARMY_USE_YN = null;
			$TRAINING_USE_YN = null;
			$SERVE_USE_YN = null;
			$PRIZE_USE_YN = null;
			$PC_USE_YN = null;
			$CONTENT_USE_YN = null;
			$FILE_USE_YN = null;
			$EDUCATION_USE_YN = null;
			$TECH_USE_YN = null;
			$LANGUAGE2_USE_YN = null;
			$WRITE_USE_YN = null;
			
			
			foreach ($_POST as $key => $postData)
			{
				${$key} = $postData;
			}
		
			$PRJ_STDT = $PRJ_STDT1 .' '. $PRJ_STDT2 .':'. $PRJ_STDT3.':00';
			$PRJ_EDDT = $PRJ_EDDT1 .' '. $PRJ_EDDT2 .':'. $PRJ_EDDT3.':00';
			
			$PRJ_STS = $this->input->post('PRJ_STS');
			
			$obj = array();
			$obj['P_COMP_ID'] = $this->authadmin->getCompanyId();
			$obj['P_PRJ_NM'] = $PRJ_NM;
			$obj['P_PRJ_STDT'] = $PRJ_STDT;
			$obj['P_PRJ_EDDT'] = $PRJ_EDDT;
			$obj['P_PRJ_STS']  = $PRJ_STS;
			$obj['P_PRJ_CNTNT||SQLTEXT'] = Html2String($PRJ_CNTNT);
			$obj['P_PRJ_SUMMARY||SQLTEXT'] = Html2String($PRJ_SUMMARY);
			$obj['P_PERSONAL_USE_YN'] = !$PERSONAL_USE_YN ? 'N' : 'Y';
			$obj['P_FAMILY_USE_YN'] = !$FAMILY_USE_YN ? 'N' : 'Y';
			$obj['P_SCHOOL_USE_YN'] = !$SCHOOL_USE_YN ? 'N' : 'Y';
			$obj['P_CAREER_USE_YN'] = !$CAREER_USE_YN ? 'N' : 'Y';
			$obj['P_LANGUAGE_USE_YN'] = !$LANGUAGE_USE_YN ? 'N' : 'Y';
			$obj['P_LICENSE_USE_YN'] = !$LICENSE_USE_YN ? 'N' : 'Y';
			$obj['P_ARMY_USE_YN'] = !$ARMY_USE_YN ? 'N' : 'Y';
			$obj['P_TRAINING_USE_YN'] = !$TRAINING_USE_YN ? 'N' : 'Y';
			$obj['P_SERVE_USE_YN'] = !$SERVE_USE_YN ? 'N' : 'Y';
			$obj['P_PRIZE_USE_YN'] = !$PRIZE_USE_YN ? 'N' : 'Y';
			$obj['P_PC_USE_YN'] = !$PC_USE_YN ? 'N' : 'Y';
			$obj['P_CONTENT_USE_YN'] = !$CONTENT_USE_YN ? 'N' : 'Y';
			$obj['P_FILE_USE_YN'] = !$FILE_USE_YN ? 'N' : 'Y';
			$obj['P_EDUCATION_USE_YN'] = !$EDUCATION_USE_YN ? 'N' : 'Y';
			$obj['P_TECH_USE_YN'] = !$TECH_USE_YN ? 'N' : 'Y';
			$obj['P_LANGUAGE2_USE_YN'] = !$LANGUAGE2_USE_YN ? 'N' : 'Y';
			$obj['P_WRITE_USE_YN'] = !$WRITE_USE_YN ? 'N' : 'Y';
			
			$obj['P_FAMILY_FORM_CNT'] 		= $FAMILY_FORM_CNT;
			$obj['P_SCHOOL_FORM_CNT'] 		= $SCHOOL_FORM_CNT;
			$obj['P_CAREER_FORM_CNT'] 		= $CAREER_FORM_CNT;
			$obj['P_LICENSE_FORM_CNT'] 		= $LICENSE_FORM_CNT;
			$obj['P_TRAINING_FORM_CNT'] 	= $TRAINING_FORM_CNT;
			$obj['P_EDUCATION_FORM_CNT'] 	= $EDUCATION_FORM_CNT;
			$obj['P_SERVE_FORM_CNT'] 			= $SERVE_FORM_CNT;
			$obj['P_PRIZE_FORM_CNT'] 			= $PRIZE_FORM_CNT;
			$obj['P_TECH_FORM_CNT'] 			= $TECH_FORM_CNT;
			$obj['P_LANGUAGE2_FORM_CNT'] 	= $LANGUAGE2_FORM_CNT;
			$obj['P_WRITE_FORM_CNT'] 			= $WRITE_FORM_CNT;
			
			
			$this->load->model('admin/project/projectmanager_model','prjprc',true);
			$RSM_IDX = null;
			if ($P_TYPE == 'regist')
			{
				// res -> 이력서 코드 반환
				$res = $this->prjprc->getProjectRegist($obj);
				$RSM_IDX = $res[0]['RSM_IDX'];
				
				//redirect('/admin/projectManagement/projectList');
			}
			
			if ($P_TYPE  == 'modify')
			{
				$obj['P_PRJ_IDX'] = $PRJ_IDX;
				$this->prjprc->getProjectModify($obj);
				//redirect('/admin/projectManagement/projectView?project_id=' . $PRJ_IDX);
				
			
			}
			
			$rsm_idx_res = $this->prjprc->getRsmIdxList(array($PRJ_IDX));
			if ($RSM_IDX == null && $rsm_idx_res->num_rows() > 0)
			{
				$rdata = $rsm_idx_res->result();
				$RSM_IDX = $rdata[0]->RSM_IDX;
			}
			
			
			// LANGUAGE
			$LANGUAGE_listCount = $this->input->post('LANGUAGE_listCount');
			$LANGUAGE_array = array('LAN_IDX','LAN_ORD','LAN_ESN_YN');
			$aa = 1;
			
			for ($a = 1 ;$a <= $LANGUAGE_listCount ; $a ++)
			{
				foreach ($LANGUAGE_array as $key => $postData)
				{
					${$postData . '_' . $aa} = $this->input->post($postData . '_' . $aa) == '' ? null : $this->input->post($postData . '_' . $aa);
				}
				$aa++;
			}
			// 항목이 있는 것에 대해서 다시 변수가공된것으로 .
			$LANGUAGE_SeqList = array();
			$LANGUAGE_SeqList[] = 0; // 전체 삭제가 있을경우에 쿼리 오류발생 방지
			// 삭제부터 처리하고 나서 머지작업 ( 머지를 먼저하니까 새로 등록된것도 삭제되넹;;;; )
			for ($c = 1 ; $c < $aa ; $c ++ ) if (${'LAN_IDX_' . $c} != null ) $LANGUAGE_SeqList[] = ${'LAN_IDX_' . $c};
			
			//var_dump($LANGUAGE_SeqList);
			
			$this->prjprc->getSubLanguageDelProcess(array('Y',$RSM_IDX,$RSM_IDX),$LANGUAGE_SeqList);
		
			for ($a = 1 ;$a < $aa ; $a ++)
			{
				if (${'LAN_IDX_' . $a} != null)
				{
				
					 $this->prjprc->getSubLanguageProcess(array($RSM_IDX
																								 ,${'LAN_IDX_' . $a}
																								 ,${'LAN_ESN_YN_' . $a} == null ? 'N' : 'Y'
																								 ,${'LAN_ORD_' . $a} == null ? 0 : ${'LAN_ORD_' . $a}
																								 ,$RSM_IDX
																								 ,${'LAN_IDX_' . $a}
																								 ,${'LAN_ESN_YN_' . $a} == null ? 'N' : 'Y'
																								 ,${'LAN_ORD_' . $a} == null ? 0 : ${'LAN_ORD_' . $a}
																								 ));
				}
			
			}
			
			
			
			// COMPUTER
			$COMPUTER_listCount = $this->input->post('LANGUAGE_listCount');
			$COMPUTER_array = array('CD_CPU_IDX','CPU_ESN_YN');
			$aa = 1;
			for ($a = 1 ;$a <= $COMPUTER_listCount ; $a ++)
			{
				foreach ($COMPUTER_array as $key => $postData)
				{
					${$postData . '_' . $aa} = $this->input->post($postData . '_' . $aa) == '' ? null : $this->input->post($postData . '_' . $aa);
				}
				$aa++;
			}
			// 항목이 있는 것에 대해서 다시 변수가공된것으로 .
			$COMPUTER_SeqList = array();
			$COMPUTER_SeqList[] = 0; // 전체 삭제가 있을경우에 쿼리 오류발생 방지
			// 삭제부터 처리하고 나서 머지작업 ( 머지를 먼저하니까 새로 등록된것도 삭제되넹;;;; )
			for ($c = 1 ; $c < $aa ; $c ++ ) if (${'CD_CPU_IDX_' . $c} != null ) $COMPUTER_SeqList[] = ${'CD_CPU_IDX_' . $c};
			
			//var_dump($LANGUAGE_SeqList);
			
			$this->prjprc->getSubComputerDelProcess(array('Y',$RSM_IDX,$RSM_IDX),$COMPUTER_SeqList);
			
			for ($a = 1 ;$a < $aa ; $a ++)
			{
				if (${'CD_CPU_IDX_' . $a} != null)
				{
				
					 $this->prjprc->getSubComputerProcess(array($RSM_IDX
					 																				,${'CD_CPU_IDX_' . $a}
																								 ,${'CPU_ESN_YN_' . $a} == null ? 'N' : 'Y'
																								 ,$RSM_IDX
																								 ,${'CD_CPU_IDX_' . $a}
																								 ,${'LAN_ESN_YN_' . $a} == null ? 'N' : 'Y'
																								 ));
				}
			
			}
			
		
			
			// FILE
			$FILE_listCount = $this->input->post('FILE_listCount');
			$FILE_array = array('RSM_FILE_IDX','ORD_NO','FILE_TITLE','FILE_COMMENT','FILE_MAX_SIZE','FILE_AVL_EXT','FILE_ESN_YN');
			$aa = 1;
			for ($a = 1 ;$a <= $FILE_listCount ; $a ++)
			{
				foreach ($FILE_array as $key => $postData)
				{
					${$postData . '_' . $aa} = $this->input->post($postData . '_' . $aa) == '' ? null : $this->input->post($postData . '_' . $aa);
					//echo $this->input->post($postData . '_' . $aa) . '---' . ${$postData . '_' . $aa} . '------->' . $postData . '<br>';
				}
				$aa++;
			}
			// 항목이 있는 것에 대해서 다시 변수가공된것으로 .
			$FILE_SeqList = array();
			$FILE_SeqList[] = 0; // 전체 삭제가 있을경우에 쿼리 오류발생 방지
			// 삭제부터 처리하고 나서 머지작업 ( 머지를 먼저하니까 새로 등록된것도 삭제되넹;;;; )
			for ($c = 1 ; $c < $aa ; $c ++ ) if (${'RSM_FILE_IDX_' . $c} != null ) $FILE_SeqList[] = ${'RSM_FILE_IDX_' . $c};
			
			$this->prjprc->getSubFileDelProcess(array('Y',$RSM_IDX,$RSM_IDX),$FILE_SeqList);
			
			for ($a = 1 ;$a < $aa ; $a ++)
			{
				if (${'FILE_TITLE_' . $a} != null)
				{
					
					 $this->prjprc->getSubFileProcess(array($RSM_IDX
																								 ,${'RSM_FILE_IDX_' . $a}
																								 ,${'ORD_NO_' . $a} == null ? 0 : ${'ORD_NO_' . $a}
																								 ,${'FILE_TITLE_' . $a}
																								 ,${'FILE_COMMENT_' . $a}
																								 ,${'FILE_MAX_SIZE_' . $a} == null ? 0 : ${'FILE_MAX_SIZE_' . $a}
																								 ,${'FILE_AVL_EXT_' . $a}
																								 ,${'FILE_ESN_YN_' . $a} == null ? 'N' : 'Y'
																								 ,$RSM_IDX
																								 ,${'ORD_NO_' . $a} == null ? 0 : ${'ORD_NO_' . $a}
																								 ,${'FILE_TITLE_' . $a}
																								 ,${'FILE_COMMENT_' . $a}
																								 ,${'FILE_MAX_SIZE_' . $a} == null ? 0 : ${'FILE_MAX_SIZE_' . $a}
																								 ,${'FILE_AVL_EXT_' . $a}
																								 ,${'FILE_ESN_YN_' . $a} == null ? 'N' : 'Y'));
				}
			
			}
			
			// CNTNT
			$CNTNT_listCount = $this->input->post('CNTNT_listCount');
			$CNTNT_array = array('RSM_CNTNT_IDX','ORD_NO','CNTNT_TITLE','CNTNT_COMMENT','CNTNT_LEN','CNTNT_ESN_YN','CNTNT_MIN_LEN');
			$aa = 1;
			for ($a = 1 ;$a < $CNTNT_listCount ; $a ++)
			{
				foreach ($CNTNT_array as $key => $postData)
				{
					${$postData . '_' . $aa} = $this->input->post($postData . '_' . $aa) == '' ? null : $this->input->post($postData . '_' . $aa);
					//echo $this->input->post($postData . '_' . $aa) . '---' . ${$postData . '_' . $aa} . '------->' . $postData . '<br>';
				}
				$aa++;
			}
			// 항목이 있는 것에 대해서 다시 변수가공된것으로 .
			$CNTNT_SeqList = array();
			$CNTNT_SeqList[] = 0; // 전체 삭제가 있을경우에 쿼리 오류발생 방지
			// 삭제부터 처리하고 나서 머지작업 ( 머지를 먼저하니까 새로 등록된것도 삭제되넹;;;; )
			for ($c = 1 ; $c < $aa ; $c ++ ) if (${'RSM_CNTNT_IDX_' . $c} != null ) $CNTNT_SeqList[] = ${'RSM_CNTNT_IDX_' . $c};
			
			$this->prjprc->getSubContentDelProcess(array('Y',$RSM_IDX,$RSM_IDX),$CNTNT_SeqList);
			
			for ($a = 1 ;$a < $aa ; $a ++)
			{
				if (${'CNTNT_TITLE_' . $a} != null)
				{
					$this->prjprc->getSubContentProcess(array($RSM_IDX
																									 ,${'RSM_CNTNT_IDX_' . $a}
																									 ,${'ORD_NO_' . $a} == null ? 0 : ${'ORD_NO_' . $a}
																									 ,${'CNTNT_TITLE_' . $a}
																									 ,${'CNTNT_COMMENT_' . $a}
																									 ,${'CNTNT_LEN_' . $a} == null ? 0 : ${'CNTNT_LEN_' . $a}
																									 ,${'CNTNT_MIN_LEN_' . $a} == null ? 0 : ${'CNTNT_MIN_LEN_' . $a}
																									 ,${'CNTNT_ESN_YN_' . $a} == null ? 'N' : 'Y'
																									 ,$RSM_IDX
																									 ,${'ORD_NO_' . $a} == null ? 0 : ${'ORD_NO_' . $a}
																									 ,${'CNTNT_TITLE_' . $a}
																									 ,${'CNTNT_COMMENT_' . $a}
																									 ,${'CNTNT_LEN_' . $a} == null ? 0 : ${'CNTNT_LEN_' . $a}
																									 ,${'CNTNT_MIN_LEN_' . $a} == null ? 0 : ${'CNTNT_MIN_LEN_' . $a}
																									 ,${'CNTNT_ESN_YN_' . $a} == null ? 'N' : 'Y'));
				}
				
			}
			
			if ($P_TYPE == 'regist') redirect('/admin/projectManagement/projectList');	
			if ($P_TYPE  == 'modify') redirect('/admin/projectManagement/projectView?project_id=' . $PRJ_IDX);
			
		}
		
		
		function deleteProcess()
		{
			$PRJ_IDX = $this->input->post('PRJ_IDX');
			$this->load->model('admin/project/projectmanager_model','prjprc',true);
			$res = $this->prjprc->getProjectDelete(array($PRJ_IDX));
			if ($res == 0)
			{
				jsalertmsg('삭제가 되지 않았습니다. - 이미 삭제되었거나, 현재 열려있는 공고는 삭제할 수 없습니다.');
				jshistoryback();
				exit;
			}
			else
			{
				redirect('/admin/projectManagement/projectList');		
			}
			
		}
		
	}