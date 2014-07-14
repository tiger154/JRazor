<?
	class PopupManagement extends MY_Controller
	{
	
		function Index()
		{
			$COMP_ID = $this->authadmin->getCompanyId();
			
			$data = null;
			$this->load->model('admin/popup/popup_model','pop',true);
			$res = $this->pop->getList(array($COMP_ID));
			
			$data['num_rows'] = $res->num_rows();
			$data['rdata'] = $res->result();
			
			$this->loadView('admin/popup/popup_list_view' , $data);
		}
		
		function Process()
		{
			$COMP_ID = $this->authadmin->getCompanyId();
			$RETURN_URL = $this->input->post('RETURN_URL');
			$ACT_FLAG = $this->input->post('ACT_FLAG');
			$POPUP_TITLE = $this->input->post('POPUP_TITLE');
			$POP_IDX = $this->input->post('POP_IDX');
			$OPN_STDT1 = $this->input->post('OPN_STDT1');
			$OPN_STDT2 = $this->input->post('OPN_STDT2');
			$OPN_STDT3 = $this->input->post('OPN_STDT3');
			$OPN_EDDT1 = $this->input->post('OPN_EDDT1');
			$OPN_EDDT2 = $this->input->post('OPN_EDDT2');
			$OPN_EDDT3 = $this->input->post('OPN_EDDT3');
			$POP_WIDTH = $this->input->post('POP_WIDTH');
			$VIEW_TP = $this->input->post('VIEW_TP');
			$POP_HEIGHT = $this->input->post('POP_HEIGHT');
			$USE_YN = $this->input->post('USE_YN');
			$CNTNT = $this->input->post('CNTNT');
			
			$OPN_STDT = $OPN_STDT1 . ' ' . str_pad($OPN_STDT2, 2,'0', STR_PAD_LEFT) .':'. str_pad($OPN_STDT3, 2,'0', STR_PAD_LEFT) .':'. '00'; 
			$OPN_EDDT = $OPN_EDDT1 . ' ' .  str_pad($OPN_EDDT2, 2,'0', STR_PAD_LEFT) .':'. str_pad($OPN_EDDT3, 2,'0', STR_PAD_LEFT) .':'. '00'; 
			
			$this->load->model('admin/popup/popup_model','pop',true);
			
			if ($ACT_FLAG == 'delete')
			{
				$res = $this->pop->getDelete(array($COMP_ID,$POP_IDX));				
			}
			else
			{
				$res = $this->pop->getProcess(array(
						$COMP_ID,
						$POP_IDX,
						$POPUP_TITLE,
						$OPN_STDT,
						$OPN_EDDT,
						$USE_YN,
						Html2String($CNTNT),
						$POP_WIDTH,
						$POP_HEIGHT,
						$VIEW_TP,
						$COMP_ID,
						$POPUP_TITLE,
						$OPN_STDT,
						$OPN_EDDT,
						$USE_YN,
						Html2String($CNTNT),
						$POP_WIDTH,
						$POP_HEIGHT,
						$VIEW_TP
				));
			}
			$this->actPublish();
			redirect($RETURN_URL);
			
		}
		
		function Form()
		{
			$data = null;
			
			$ACT_FLAG = $this->input->post('ACT_FLAG');
			
			$data['POP_IDX'] = null;
			$data['OPN_STDT1'] = null;
			$data['OPN_STDT2'] = null;
			$data['OPN_STDT3'] = null;
			$data['POP_WIDTH'] = null;
			$data['POP_HEIGHT'] = null;
			$data['OPN_EDDT1'] = null;
			$data['OPN_EDDT2'] = null;
			$data['OPN_EDDT3'] = null;
			$data['VIEW_TP'] = 'W';
			$data['CNTNT'] = null;
			$data['USE_YN'] = 'Y';
			$data['POPUP_TITLE'] = null;
			
			if ($ACT_FLAG == 'modify')
			{
				$COMP_ID = $this->authadmin->getCompanyId();
				$POP_IDX = $this->input->post('POP_IDX');
				$this->load->model('admin/popup/popup_model','pop',true);
				$res = $this->pop->getView(array($COMP_ID,$POP_IDX));
				$rdata = $res->result();
				
				$data['POP_IDX'] = $POP_IDX;
				$data['VIEW_TP'] = $rdata[0]->VIEW_TP;
				$data['POPUP_TITLE'] = $rdata[0]->POPUP_TITLE;
				$data['POP_WIDTH'] = $rdata[0]->POP_WIDTH;
				$data['POP_HEIGHT'] = $rdata[0]->POP_HEIGHT;
				$data['OPN_STDT1'] = $rdata[0]->OPN_STDT1;
				$data['OPN_STDT2'] = $rdata[0]->OPN_STDT2;
				$data['OPN_STDT3'] = $rdata[0]->OPN_STDT3;
				$data['OPN_EDDT1'] = $rdata[0]->OPN_EDDT1;
				$data['OPN_EDDT2'] = $rdata[0]->OPN_EDDT2;
				$data['OPN_EDDT3'] = $rdata[0]->OPN_EDDT3;
				$data['USE_YN'] = $rdata[0]->USE_YN;
				$data['CNTNT'] = $rdata[0]->CNTNT;
				
			}
			
			
			$this->loadView('admin/popup/popup_form_view' , $data);
		}
		
		function View()
		{
			$data = null;
			$COMP_ID = $this->authadmin->getCompanyId();
			$POP_IDX = $this->input->post('POP_IDX');
			
			$this->load->model('admin/popup/popup_model','pop',true);
			$res = $this->pop->getView(array($COMP_ID,$POP_IDX));
			
			$rdata = $res->result();
			
			$data['POP_IDX'] = $POP_IDX;
			$data['OPN_STDT1'] = $rdata[0]->OPN_STDT1;
			$data['OPN_STDT2'] = $rdata[0]->OPN_STDT2;
			$data['OPN_STDT3'] = $rdata[0]->OPN_STDT3;
			$data['VIEW_TP'] = $rdata[0]->VIEW_TP;
			$data['OPN_EDDT1'] = $rdata[0]->OPN_EDDT1;
			$data['OPN_EDDT2'] = $rdata[0]->OPN_EDDT2;
			$data['OPN_EDDT3'] = $rdata[0]->OPN_EDDT3;
			
			$data['POP_WIDTH'] = $rdata[0]->POP_WIDTH;
			$data['POP_HEIGHT'] = $rdata[0]->POP_HEIGHT;
			
			$data['CNTNT'] = String2Html($rdata[0]->CNTNT);
			$data['USE_YN'] = $rdata[0]->USE_YN;
			$data['POPUP_TITLE'] = $rdata[0]->POPUP_TITLE;
			
			$this->loadView('admin/popup/popup_view_view' , $data);
		}
		
		private function actPublish()
		{
			/* XML FILE */
			$COMP_ID = $this->authadmin->getCompanyId();

			$this->load->helper('file');
			$this->load->model('admin/popup/popup_model','pop',true);
			$res = $this->pop->getCreateList(array($COMP_ID));
			if ($res->num_rows() > 0)
			{
				
				$data = null;
				$data .= '<?xml version="1.0"  encoding="EUC-KR"?><root>' . "\n";
				
				foreach ($res->result() as $key => $pList)
				{
					$data .= '<pop>' . "\n";	
					$data .= '<flag>' . $pList->VIEW_TP . '</flag>' . "\n";
					$data .= '<code>' . $pList->POP_IDX . '</code>' . "\n";
					$data .= '<width>' . $pList->POP_WIDTH . '</width>' . "\n";
					$data .= '<height>' . $pList->POP_HEIGHT . '</height>' . "\n";
					$data .= '<title><![CDATA[' . $pList->POPUP_TITLE . ']]></title>' . "\n";
					$data .= '<stdt>' . $pList->OPN_STDT . '</stdt>' . "\n";
					$data .= '<eddt>' . $pList->OPN_EDDT . '</eddt>' . "\n";
					$data .= '<content><![CDATA[' . $pList->CNTNT . ']]></content>' . "\n";
					$data .= '</pop>' . "\n";	
				}
				$data .= '</root>' . "\n";
				
				if (!file_exists(APPPATH . MAIN_SERVICE_DIRECTORY . $pList->DOMAIN_ID))  mkdir(APPPATH . MAIN_SERVICE_DIRECTORY . $pList->DOMAIN_ID);
	 			if (!file_exists(APPPATH . MAIN_SERVICE_DIRECTORY . $pList->DOMAIN_ID . '/set'))  mkdir(APPPATH . MAIN_SERVICE_DIRECTORY . $pList->DOMAIN_ID . '/set');
	 			
	 			//if (file_exists(APPPATH . LOCAL_SERVICE_DIRECTORY
	 			
				if ( ! write_file(APPPATH . MAIN_SERVICE_DIRECTORY . $pList->DOMAIN_ID . '/set/popup.xml', $data))
				{
					jsalertmsg('팝업파일 생성에 실패하였습니다. 다시 시도해주세요.[XML 파일생성 실패]');
					jshistoryback();
					exit;
				}
				
			}
			
		}
	
	}
	