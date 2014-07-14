<?
	class ChargerManagement extends MY_Controller
	{
		function Index()
		{	
			$this->load->library('DataControl'); 
			$this->load->library('FormBox'); 
			$COMP_ID = $this->authadmin->getCompanyId();
			$SCH_TYPE = $this->input->get('SCH_TYPE');
			$SCH_KEY = $this->input->get('SCH_KEY');
			$this->load->library('pagination');	
			$per_page = $this->input->get('per_page');
			$per_page = !$per_page ? 1 : $per_page;
			$list = $this->pagination->getProperty('per_page');

			$this->load->model('admin/setmanager/chargerManagement_model','mnglist',TRUE);
			$res = $this->mnglist->getManagerList(array($COMP_ID,$SCH_KEY ? '%' . $SCH_KEY .'%' : null ,'N',$list * ($per_page - 1) + 1 ,$per_page * $list),$SCH_TYPE);
			$data['mngInfoCount'] = $res->num_rows();
			$data['adminList'] = $res->result();
			$data['rowCount'] = $res->num_rows() > 0 ? $data['adminList'][0]->ALL_LIST_COUNT : 0;
			$data['rData'] = $res->result();
			
			
			$paging['total_rows'] = $data['rowCount'];
			$paging['base_url'] = '/admin/chargerManagement?SCH_TYPE=' . $SCH_TYPE . '&SCH_KEY=' . $SCH_KEY . '&q=';
			
			$this->pagination->initialize($paging); 
			
			$data['paging'] = $this->pagination->create_links();
			$data['cur_page'] = $per_page;			
			$data['allPage'] = $this->pagination->getProperty('total_pages');
			$arrSCH_TYPE = array();
			$arrSCH_TYPE[] = array('MANAGER_ID','아이디');
			$arrSCH_TYPE[] = array('MANAGER_NM','담당자명');
			
			$data['SCH_KEY'] = $SCH_KEY;
			$data['SCH_TYPE'] = $SCH_TYPE;
			
			$this->formbox->setId('SCH_TYPE');
			$this->formbox->setName('SCH_TYPE');
			$this->formbox->setOption('');
			$data['SELECTBOX_SCH_TYPE'] = $this->formbox->getSelectBox($arrSCH_TYPE, '검색구분' , $SCH_TYPE , $objType = 'array');
			
			$this->loadView('admin/setmanager/chargermanagement' , $data);
		
		}
		
		function registManager()
		{
			$data['MANAGER_ID'] = NULL;
			$data['MANAGER_NM'] = NULL;
			$data['DEPT'] = NULL;
			$data['PSTN'] = NULL;
			$data['TEL1'] = NULL;
			$data['TEL2'] = NULL;
			$data['TEL3'] = NULL;
			
			$data['MOBILE1'] = NULL;
			$data['MOBILE2'] = NULL;
			$data['MOBILE3'] = NULL;
			
			$data['MANAGER_TP'] = NULL;
			$data['EMAIL'] = NULL;
			$data['USE_YN'] = NULL;
			$this->load->library('DataControl'); 
			$this->load->library('FormBox'); 
			
			$this->load->model('admin/setmanager/chargerManagement_model','mngproc',TRUE);
			$res = $this->mngproc->getManagerTypeList(array('ADM','Y','N'));
			$this->formbox->setId('MANAGER_TP');
			$this->formbox->setName('MANAGER_TP');
			$this->formbox->setOption('');
			$data['SELECTBOX_MANAGER_TP'] = $this->formbox->getSelectBox($res->result(), '선택' , $data['MANAGER_TP'] , $objType = 'db');
			
			$this->formbox->setId('TEL1');
			$this->formbox->setName('TEL1');
			$this->formbox->setOption('style="width:54px;"');
			$data['SELECTBOX_TEL'] = $this->formbox->getSelectBox($this->datacontrol->getFile2Array('TEL.txt'), '선택' , '' , $objType = 'array');
			
			$this->formbox->setId('MOBILE1');
			$this->formbox->setName('MOBILE1');
			$this->formbox->setOption('style="width:54px;"');
			
			$data['SELECTBOX_MOBILE'] = $this->formbox->getSelectBox($this->datacontrol->getFile2Array('HTEL.txt'), '선택' , '' , $objType = 'array');
			
			$this->popView('admin/setmanager/chargermanagement_detail_form' , $data);
		}
		
		function modifyManager()
		{
			// 수정인데 ID가 없을경우 본인 수정페이지로 인식
			
			$this->load->library('DataControl'); 
			$this->load->library('FormBox'); 
			
			$data = null;
			
			$this->load->model('admin/setmanager/chargerManagement_model','mngproc',TRUE);
			
			$P_MANAGER_ID = $this->input->get('manager_id');
			
			if (!$P_MANAGER_ID) $P_MANAGER_ID = $this->authadmin->getUserId();
			
			$P_COMP_ID = $this->authadmin->getCompanyId();
			$res = $this->mngproc->getManagerView(array($P_COMP_ID,$P_MANAGER_ID,'N'));
			
			$rdata = $res->result();
			$data['MANAGER_ID'] = $P_MANAGER_ID;
			$data['MANAGER_NM'] = $rdata[0]->MANAGER_NM;
			$data['DEPT'] = $rdata[0]->DEPT;
			$data['PSTN'] = $rdata[0]->PSTN;
			$TEL = explode('-',$rdata[0]->TEL);
			if (count($TEL)< 3)
			{
				$TEL[0] = null;
				$TEL[1] = null;
				$TEL[2] = null;
			}
			$data['TEL1'] = $TEL[0];
			$data['TEL2'] = $TEL[1];
			$data['TEL3'] = $TEL[2];
			
			$MOBILE = explode('-',$rdata[0]->MOBILE);
			if (count($MOBILE)< 3)
			{
				$MOBILE[0] = null;
				$MOBILE[1] = null;
				$MOBILE[2] = null;
			}
			$data['MOBILE1'] = $MOBILE[0];
			$data['MOBILE2'] = $MOBILE[1];
			$data['MOBILE3'] = $MOBILE[2];
			
			$data['MANAGER_TP'] = $rdata[0]->MANAGER_TP;
			$data['EMAIL'] = $rdata[0]->EMAIL;
			$data['USE_YN'] = $rdata[0]->USE_YN;
			
			$this->load->model('admin/setmanager/chargerManagement_model','mngproc',TRUE);
			$res = $this->mngproc->getManagerTypeList(array('ADM','Y','N'));
			$this->formbox->setId('MANAGER_TP');
			$this->formbox->setName('MANAGER_TP');
			$this->formbox->setOption('');
			$data['SELECTBOX_MANAGER_TP'] = $this->formbox->getSelectBox($res->result(), '선택' , $data['MANAGER_TP'] , $objType = 'db');
			
			$this->formbox->setId('TEL1');
			$this->formbox->setName('TEL1');
			$this->formbox->setOption('style="width:54px;"');
			$data['SELECTBOX_TEL'] = $this->formbox->getSelectBox($this->datacontrol->getFile2Array('TEL.txt'), '선택' , $TEL[0] , $objType = 'array');
			
			$this->formbox->setId('MOBILE1');
			$this->formbox->setName('MOBILE1');
			$this->formbox->setOption('style="width:54px;"');
			
			$data['SELECTBOX_MOBILE'] = $this->formbox->getSelectBox($this->datacontrol->getFile2Array('HTEL.txt'), '선택' , $MOBILE[0] , $objType = 'array');
			
					
			$this->popView('admin/setmanager/chargermanagement_detail_form' , $data);
		}
		
		function managerProcess()
		{
			$P_TYPE = $this->input->post('process_type');
			$P_MANAGER_ID = $this->input->post('MANAGER_ID');
			$P_MANAGER_NM = $this->input->post('MANAGER_NM');
			$P_MANAGER_PW = $this->input->post('MANAGER_PW');
			$P_DEPT = $this->input->post('DEPT');
			$P_PSTN = $this->input->post('PSTN');
			$P_TEL1 = $this->input->post('TEL1');
			$P_TEL2 = $this->input->post('TEL2');
			$P_TEL3 = $this->input->post('TEL3');
			$P_MOBILE1 = $this->input->post('MOBILE1');
			$P_MOBILE2 = $this->input->post('MOBILE2');
			$P_MOBILE3 = $this->input->post('MOBILE3');
			$P_MANAGER_TP = $this->input->post('MANAGER_TP');
			$P_EMAIL = $this->input->post('EMAIL');
			$P_USE_YN = $this->input->post('USE_YN');
			
			$P_TEL = $P_TEL1 . '-' . $P_TEL2 . '-' . $P_TEL3;
			$P_MOBILE = $P_MOBILE1 . '-' . $P_MOBILE2 . '-' . $P_MOBILE3;
			$P_COMP_ID = $this->authadmin->getCompanyId();
			
			if ($P_TYPE == 'regist' )
			{
				$this->load->model('admin/setmanager/chargerManagement_model','mngproc',TRUE);
				$res = $this->mngproc->getManagerInsertInfo(array($P_COMP_ID,$P_MANAGER_ID,$P_MANAGER_NM,md5($P_MANAGER_PW),$P_USE_YN,$P_PSTN,$P_TEL,$P_MOBILE,$P_DEPT,$P_EMAIL));
			}
			
			if ($P_TYPE == 'modify' )
			{
				$this->load->model('admin/setmanager/chargerManagement_model','mngproc',TRUE);
				$res = $this->mngproc->getManagerUpdateInfo(array($P_MANAGER_NM,md5($P_MANAGER_PW),$P_MANAGER_TP,$P_USE_YN,$P_PSTN,$P_TEL,$P_MOBILE,$P_DEPT,$P_EMAIL,$P_COMP_ID,$P_MANAGER_ID));
			}
			
			winclose();
		}
		
		function checkManagerId()
		{
			$MANAGER_ID = $this->input->post('MANAGER_ID');
			$this->load->model('admin/setmanager/chargerManagement_model','mngproc1',TRUE);
			$res = $this->mngproc1->checkManagerId(array($MANAGER_ID));
		  $rdata = $res->num_rows();
			
			if ($rdata > 0)
			{
				echo 'false';
			} 
			else 
			{
				echo 'true';
			}
			
		
		}
		
	}
	