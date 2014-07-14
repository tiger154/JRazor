<?
	class MailManagement extends MY_Controller
	{
		function Index()
		{
			$STEP_IDX = $this->input->post('STEP_IDX');
			$PRJ_IDX 	= $this->input->post('PRJ_IDX');
			$GUBUN 		= base64_decode($this->input->post('GUBUN'));
			$COMP_ID 	= $this->authadmin->getCompanyId();
			$data 		= null;
			$this->load->library('DataControl'); 
			$this->load->library('FormBox'); 
			$this->load->model('admin/step/stepManagement_model','unit',true);
			
			$res = $this->unit->getEtcVarList(array($PRJ_IDX,$STEP_IDX,$GUBUN));
			$rowCount = $res->num_rows();
			$data['ETCVARLIST'] = null;
			
			if ($rowCount > 0)
			{
				$rdata = $res->result();
				$data['ETCVARLIST'] = $this->datacontrol->getEtcList($rdata[0]->ETC1VAR);
			}
			
			$res = $this->unit->getCompanyInfoDtl(array($COMP_ID,'N'));
			$data['EMAIL'] = null;
			$data['COMP_NM'] = $this->authadmin->getOriginCompanyNm();
			if ($res->num_rows() > 0 )
			{
				$rdata = $res->result();
				$data['EMAIL'] = $rdata[0]->EMAIL;
			}
			
			$res = $this->unit->getSimpleStepList(array($PRJ_IDX,'N'));
			
			$this->formbox->setId('STEP_IDX');
			$this->formbox->setName('STEP_IDX');
			$this->formbox->setOption('onchange="javascript:getGubunList()&getCountList();"');
			
			
			$data['SELECTBOX_STEP_IDX'] = $this->formbox->getSelectBox($res->result(),'선택하세요',$STEP_IDX);
			
			$data['PRJ_IDX'] = $PRJ_IDX;
			$data['GUBUN'] = $GUBUN;
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
			
			$this->popView('admin/mail/mail_form' , $data);
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
			$obj['P_PRJ_IDX'] = $this->input->get('PRJ_IDX');
			$obj['P_UNIT_IDX'] = $this->input->get('UNIT_IDX');
			$obj['P_STEP_IDX'] = $this->input->get('STEP_IDX');
			$obj['P_GUBUN'] = $this->input->get('GUBUN');
			
			$res = $this->sms->getCountList($obj);
			
			header("Cache-Control: no-cache");
			header("Pragma: no-cache");
			header("Content-Type: text/html; charset=UTF-8");
			echo $res[0]['CNT'];
			
		}
		
		// 메일 발송 프로세스
		function mailProcess()
		{
			$this->load->library('DataControl'); 
			$this->load->model('admin/mail/mail_model','maildb',true);  	
			
			$TPL_IDX = 1;
			$IMG_URL = MAIL_IMG_URL . '/' . $TPL_IDX; 
			$tres = $this->maildb->getMailTemplate(array($TPL_IDX,'N'));
			$LOGO_IMG = 'http://' . HOSTID . '.' . MAIN_SERVICE_DOMAIN . $this->datacontrol->getLogoPath(HOSTID,1);
			$SERVICE_URL = 'http://' . HOSTID . '.' . MAIN_SERVICE_DOMAIN;
			$tplData = $tres->result();
			$tplListData = $tplData[0]->CNTNT;
			foreach ($_POST as $key => $dataList)
			{
				${$key} = $this->input->post($key);	
			}
		
			$COMP_ID = $this->authadmin->getCompanyId();
			$MANAGER_ID = $this->authadmin->getUserId();
			
			$obj = array();
			//$obj['P_MAIL_SEND'] = $SEND_MAIL;
			$obj['P_MAIL_SEND'] = 'noreply@trns.co.kr';
			//$obj['P_MAIL_NAME'] = $SEND_NAME;
			
			$obj['P_MAIL_NAME'] = $this->authadmin->getCompanyNm();
			$obj['P_MAIL_TITLE'] = $MAIL_TITLE;
			
			$obj['P_MAIL_CONTENT'] = str_replace('{{IMG_URL}}',$IMG_URL,String2Html($tplListData));
			$obj['P_MAIL_CONTENT'] = str_replace('{{APPLY_LINK}}',$SERVICE_URL,$obj['P_MAIL_CONTENT']);
			$obj['P_MAIL_CONTENT'] = str_replace('{{LOGO_IMG}}',$LOGO_IMG,$obj['P_MAIL_CONTENT']);
			$obj['P_MAIL_CONTENT'] = str_replace('{{CONTENT}}',$FRM_CNTNT,$obj['P_MAIL_CONTENT']);
			
			$obj['P_COMP_ID'] = $COMP_ID;
			$obj['P_MANAGER_ID'] = $MANAGER_ID;
			$obj['P_PRJ_IDX'] = $PRJ_IDX;
			$obj['P_TPL_IDX'] = 1;
			$obj['P_UNIT_IDX'] = $UNIT_IDX;
			$obj['P_STEP_IDX'] = $STEP_IDX;
			$obj['P_GUBUN'] = $SEL_GUBUN;
			$obj['P_GUBUN_USED'] = $GUBUN_USED;
			$res = $this->maildb->getSendMailList($obj);
			
			$data['MAIL_IDX'] = $res[0]['MAIL_IDX'];
			$this->popView('admin/mail/mail_result_form' , $data);
			
			//$exe_data = system('lynx http://sendmail.trns.co.kr:18023/MailService.asmx/SendMailByGrouping?mail_idx=' . $res[0]['MAIL_IDX'] . '&per_count=3&delay=2000');

		}
	}