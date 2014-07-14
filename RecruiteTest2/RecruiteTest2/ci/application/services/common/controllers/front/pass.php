<?
	class Pass extends MY_Controller
	{
		/*
		function __construct()
		{
			parent::__construct();
			
		}
		*/
		
		function Index()
		{
			
			$this->load->library('AuthPassFront'); 
			$this->load->model('front/pass/pass_model','pass',true);
			$PRJ_IDX = $this->authpassfront->getUserDefaultProject();
			$data = null;
			
			$NAMEKOR = $this->authpassfront->getUserNm();
			$USER_PW = $this->authpassfront->getUserPass();
			$HTEL = $this->authpassfront->getUserHtel();
			$DOMAIN_ID = $this->authpassfront->getUserDomain();
			
			$ADMIN_FLAG = $this->input->post('code');
			
			// 로그인 체크 
			
			if ($ADMIN_FLAG != '')
			{
				$PRJ_IDX = $this->input->post('PRJ_IDX');	
				$res = $this->pass->getAdminPassFlag(array($PRJ_IDX,base64_decode($ADMIN_FLAG)));
				$APPLY_NO = $this->input->post('APPLY_NO');
				$STEP_IDX = $this->input->post('STEP_IDX');
				$DOMAIN_ID = $this->input->post('DOMAIN_ID');	
				$rdata = $res->result();
				
				if ($rdata[0]->PRJ_IDX > 0)
				{
					$res = $this->pass->getNoPassInfoList(array($PRJ_IDX,$STEP_IDX,$PRJ_IDX,$APPLY_NO,$DOMAIN_ID));
				}
			}
			else
			{
				$this->authpassfront->LoginCheckRedirect($_SERVER['REQUEST_URI'],'/front/login/PassLogin');
				$res = $this->pass->getPassInfoList(array($PRJ_IDX,$PRJ_IDX,'N',$PRJ_IDX,$NAMEKOR,md5($USER_PW),$HTEL,'N',$DOMAIN_ID,'N','N'));
				
			}
			
			
			$data['PASSINFO_LIST'] = null;
			
			if ($res->num_rows() == 1)
			{
				$data['PASSINFO_LIST'] = $res->result();
				
				$this->load->library('DataControl');
				$etclist = $this->datacontrol->getEtcList($data['PASSINFO_LIST'][0]->ETC1VAR);
				
				//echo $ETCVAR;
				$query_str = null;
				foreach ($etclist as $key => $etcdata)
				{
					$query_str .= ',DBO.FN_ETCDATA(ETC1VAR,ETC1VALUE,\'' . $etcdata . '\') ETCDATA' . ($key + 1);
				}
				
				$result_data = $this->pass->getDataViewList($query_str,array($PRJ_IDX,$data['PASSINFO_LIST'][0]->STEP_IDX,$data['PASSINFO_LIST'][0]->GUBUN,$data['PASSINFO_LIST'][0]->APPLY_NO));
				
				$dataList = $result_data->result();
				$htmlform = $data['PASSINFO_LIST'][0]->FRM_CNTNT;
				
				foreach ( $dataList as $xkey => $etcvaluelist)
				{
					foreach ($etclist as $key => $titleNm) 
					{
						$htmlform = str_replace('[$'.$titleNm.']',$etcvaluelist->{'ETCDATA' . ($key + 1)}, $htmlform);		
					}
				}
				$data['htmlform'] = $htmlform;
			}
			else
			{
				if ($res->num_rows() > 1)
				{
					jsalertmsg('일치하는 정보가 있습니다만 시스템 안전 문제로 조회가 불가능합니다. 문의주세요.[ERR009]');
				}
				else
				{
					jsalertmsg('일치하는 결과정보가 없습니다. 다시 확인하세요.');
				}
				jshistoryback();
				exit;
			}
			
			$this->frontView('front/pass/pass_view' , $data);
		}
	}
	