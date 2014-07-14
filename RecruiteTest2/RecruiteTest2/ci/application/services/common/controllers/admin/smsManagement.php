<?
	class SmsManagement extends MY_Controller
	{
		function Index()
		{
			$STEP_IDX = $this->input->post('STEP_IDX');
			$PRJ_IDX = $this->input->post('PRJ_IDX');
			$GUBUN = $this->input->post('GUBUN');
			$COMP_ID = $this->authadmin->getCompanyId();
			
			$data = null;
			$this->load->library('DataControl'); 
			$this->load->library('FormBox'); 
			$this->load->model('admin/step/stepManagement_model','unit',true);
			
			$res = $this->unit->getCompanyInfoDtl(array($COMP_ID,'N'));
			$data['CMP_TEL1'] = null;
			$data['CMP_TEL2'] = null;
			$data['CMP_TEL3'] = null;
			if ($res->num_rows() > 0 )
			{
				$rdata = $res->result();
				$CMP_TEL_AR = explode('-',$rdata[0]->CMP_TEL);
				
				if ( count($CMP_TEL_AR) == 3)
				{
					$data['CMP_TEL1'] = $CMP_TEL_AR[0];
					$data['CMP_TEL2'] = $CMP_TEL_AR[1];
					$data['CMP_TEL3'] = $CMP_TEL_AR[2];
				}
				
			}
			
			$res = $this->unit->getSimpleStepList(array($PRJ_IDX,'N'));
			
			$this->formbox->setId('STEP_IDX');
			$this->formbox->setName('STEP_IDX');
			$this->formbox->setOption('onchange="javascript:getGubunList(this.value)&getCountList();"');
			
			
			$data['SELECTBOX_STEP_IDX'] = $this->formbox->getSelectBox($res->result(),'선택하세요',$STEP_IDX);
			$data['GUBUN'] = $GUBUN;
			$data['PRJ_IDX'] = $PRJ_IDX;
			$unitObj = array();
			$unitRs = $this->unit->getUnitLeafNodeList(array($PRJ_IDX,'N',$PRJ_IDX,'N'));
			
			foreach ($unitRs->result() as $key => $unitList)
			{
				$unitObj[] = array($unitList->UNIT_IDX,$unitList->PATH);
			}
			
			$this->formbox->setId('UNIT_IDX');
			$this->formbox->setName('UNIT_IDX');
			$this->formbox->setOption('onchange="javascript:getCountList();"');
			
			$data['SELECTBOX_UNIT_IDX'] = $this->formbox->getSelectBox($unitObj, '모집분야 선택' , '' , $objType = 'array');
			
			$this->popView('admin/sms/sms_form' , $data);
		}
		
		function getGubunList()
		{
			
			$PRJ_IDX = $this->input->get('PRJ_IDX');
			$STEP_IDX = $this->input->get('STEP_IDX');
			$this->load->library('Json');
			$this->load->model('admin/step/stepManagement_model','unit',true);
			$res = $this->unit->getDataList(array($PRJ_IDX,$STEP_IDX,'N'));
			
			$obj = array();
			
			foreach ($res->result() as $key => $gbnList)
			{
				$obj[$key]['GUBUN_NAME'] = iconv('EUC-KR','UTF-8',$gbnList->GUBUN);
				$obj[$key]['GUBUN_CODE'] = base64_encode($gbnList->GUBUN);
			}
		
			header("Cache-Control: no-cache");
			header("Pragma: no-cache");
			header("Content-Type: text/html; charset=UTF-8");
			echo $this->json->getArray2Json($obj);
			
		}
		
		function getCountList()
		{
			
			$this->load->model('admin/sms/smsmanagement_model','sms',true);
			
			$obj = array();
			$obj['P_PRJ_IDX'] = $this->input->post('PRJ_IDX');
			$obj['P_UNIT_IDX'] = $this->input->post('UNIT_IDX');
			$obj['P_STEP_IDX'] = $this->input->post('STEP_IDX');
			
			$obj['P_GUBUN'] = base64_decode($this->input->post('GUBUN'));
			
			$res = $this->sms->getCountList($obj);
			
			header("Cache-Control: no-cache");
			header("Pragma: no-cache");
			header("Content-Type: text/html; charset=EUC-KR");
			
			if ( count($res) > 0 )
			{
				echo number_format($res[0]['CNT']);
			}
			
		}
		
		// SMS 발송
		function smsProcess()
		{
			$COMP_ID = $this->authadmin->getCompanyId();
			$PRJ_IDX = $this->input->post('PRJ_IDX');
			$UNIT_IDX = $this->input->post('UNIT_IDX');
			$STEP_IDX = $this->input->post('STEP_IDX');
			$CNTNT	 = $this->input->post('CNTNT');
			
			$SEND_TEL1 = $this->input->post('SEND_TEL1');
			$SEND_TEL2 = $this->input->post('SEND_TEL2');
			$SEND_TEL3 = $this->input->post('SEND_TEL3');
			
			$SEND_TEL = $SEND_TEL1. $SEND_TEL2 . $SEND_TEL3;
			
			$GUBUN = base64_decode($this->input->post('GUBUN'));
			
			$obj = array();
			$obj['P_COMP_ID'] = $COMP_ID;
			$obj['P_PRJ_IDX'] = $PRJ_IDX;
			$obj['P_UNIT_IDX'] = $UNIT_IDX;
			$obj['P_STEP_IDX'] = $STEP_IDX;
			$obj['P_GUBUN'] = $GUBUN;
			$obj['P_MANAGER_ID'] = $this->authadmin->getUserId();
			$obj['P_MANAGER_IP'] = $_SERVER['REMOTE_ADDR'];
			$obj['P_CNTNT'] = $CNTNT;
			$obj['P_CALLBACK'] = $SEND_TEL;
			
			
			$this->load->model('admin/sms/smsmanagement_model','sms',true);
			$this->sms->getSendSmsSelect($obj);
			header("Content-Type: text/html; charset=EUC-KR");
			jsalertmsg('발송되었습니다.');
			winclose(); 
			
		}
		
		
	}