<?
	class Recruit extends MY_Controller
	{
		
		function Index()
		{
			
			$data = null;
			$this->load->model('front/recruit/recruit_model','rct',true);
			$res = $this->rct->getProjectList(array(HOSTID,'O','Y','N','N'));
			
			$data['projectListCount'] = $res->num_rows();
			$data['projectList'] = $res->result();
			
			if ($data['projectListCount'] == 1)
			{
				redirect('/front/recruit/ProjectView?projectListIdx=' . $data['projectList'][0]->PRJ_IDX);
				exit;
			}
			
			$data['popupJsFile'] = $this->FrontPopUp();
		
			$this->frontView('front/recruit/project_index' , $data);
		}
		
		function ProjectList()
		{
			$data = null;
			$this->load->model('front/recruit/recruit_model','rct',true);
			$res = $this->rct->getProjectList(array(HOSTID,'O','Y','N','N'));
			
			$data['projectListCount'] = $res->num_rows();
			$data['projectList'] = $res->result();
			
			if ($data['projectListCount'] == 1)
			{
				redirect('/front/recruit/ProjectView?projectListIdx=' . $data['projectList'][0]->PRJ_IDX);
			}
			
			$this->frontView('front/recruit/project_list' , $data);
		}
		
		function ProjectViewAjax()
		{
			$PRJ_IDX = $this->input->get('PRJ_IDX');
			$data = null;
			$this->load->model('front/recruit/recruit_model','rct',true);
			$res = $this->rct->getProjectView(array(HOSTID,$PRJ_IDX,'O','Y','N','N'));
			$rdata = $res->result();
			
			echo '<body>';
			echo '<h3>' . String2Html($rdata[0]->PRJ_NM) . '</h3>';
			echo '<br>';
			echo String2Html($rdata[0]->PRJ_CNTNT);
			echo '</body>';
		}
		
		function ProjectView()
		{
			$data = null;
			$this->load->model('front/recruit/recruit_model','rct',true);
			
			$res = $this->rct->getProjectList(array(HOSTID,'O','Y','N','N'));
			
			$data['popupJsFile'] = null;
			
			if ($res->num_rows() == 1 )
			{
				$data['popupJsFile'] = $this->FrontPopUp();
			}
			
			$PRJ_IDX = $this->input->get('projectListIdx');
			$listflag = $this->input->get('listflag');
			
			$data['PRJ_IDX'] = $PRJ_IDX;			
			$data['LISTFLAG'] = $listflag;
			
			$data['APPLY_CHECK_YN'] = $this->ApplyDateCheck($PRJ_IDX);
			
			
			$res = $this->rct->getProjectList(array(HOSTID,'O','Y','N','N'));
			
			$data['projectListCount'] = $res->num_rows();
			$data['projectList'] = $res->result();
			
			$this->frontView('front/recruit/project_view' , $data);
		}
		
		function SelectProject()
		{
			echo '채용공고 선택(리스트)';
		}
		
		
		
		function AuthConfirm()
		{
			$data = null;
			echo '본인확인 페이지';
			echo '이동페이지값을 받는다.';
			$this->frontView('front/recruit/authconfirm_form' , $data);
		}
		
		//본인인증 결과에 대한 
		function AuthConfirmResult()
		{
			
			/* 인증쪽 업체에서 준 샘플 복사해서 수정 */
			$data = null;
			
			$enc_data = $this->input->post('EncodeData');		// 암호화된 결과 데이타
    
	    $sReserved1 = $this->input->post('param_r1'); // $COMP_ID
			$sReserved2 = $this->input->post('param_r2'); // $DOMAIN_ID
			$sReserved3 = $this->input->post('param_r3'); // 
			
			$sitecode = $this->_certCode;
			$cb_encode_path = $this->_cb_encode_path;
			$sitepasswd = $this->_certPassword;
		
			if ($enc_data != "") {
					
	        $plaindata = exec("$cb_encode_path DEC $sitecode $sitepasswd $enc_data");		// 암호화된 결과 데이터의 복호화
	        
					$returnMsg = null;
	        if ($plaindata == -1){
	            $returnMsg  = "암/복호화 시스템 오류";
	        }else if ($plaindata == -4){
	            $returnMsg  = "복호화 처리 오류";
	        }else if ($plaindata == -5){
	            $returnMsg  = "HASH값 불일치 - 복호화 데이터는 리턴됨";
	        }else if ($plaindata == -6){
	            $returnMsg  = "복호화 데이터 오류";
	        }else if ($plaindata == -9){
	            $returnMsg  = "입력값 오류";
	        }else if ($plaindata == -12){
	            $returnMsg  = "사이트 비밀번호 오류";
	        }else{
	    	  }
	    	  
	          // 복호화가 정상적일 경우 데이터를 파싱합니다.
	          $ciphertime = exec("$cb_encode_path CTS $sitecode $sitepasswd $enc_data");	// 암호화된 결과 데이터 검증 (복호화한 시간획득)
	      		
	          $requestnumber = $this->GetValue($plaindata , "REQ_SEQ");
	          $responsenumber = $this->GetValue($plaindata , "RES_SEQ");
	          $authtype = $this->GetValue($plaindata , "AUTH_TYPE");
	          $name = $this->GetValue($plaindata , "NAME");
	          $birthdate = $this->GetValue($plaindata , "BIRTHDATE");
	          $gender = $this->GetValue($plaindata , "GENDER");
	          $nationalinfo = $this->GetValue($plaindata , "NATIONALINFO");	//내/외국인정보(개발가이드 참조)
	          $dupinfo = $this->GetValue($plaindata , "DI");
	          $conninfo = $this->GetValue($plaindata , "CI");
	          $err_code = $this->GetValue($plaindata , "ERR_CODE");
						
						
						$this->recruit->getCertLogInsert(array($sReserved1,$requestnumber,$responsenumber,$authtype,$ciphertime,$name,$birthdate,$gender,$nationalinfo,$dupinfo,$conninfo,$sReserved1,$sReserved2,$sReserved3,$returnMsg,$err_code));
						
	          if(strcmp($_SESSION["REQ_SEQ"], $requestnumber) != 0)
	          {
	          	jsalertmsg('올바른 경로로 접근하시거나 다시 시도해주시기 바랍니다.');
	          	winclose();
	          	exit;
	          }
	        
	    }
			
			$this->frontView('front/recruit/authconfirm_result' , $data);
		}
		
		function AuthConfirmProcess()
		{
			echo '로그인서버 - 프로세스처리분';
		}
		
		/* 인증쪽에서 제공해주는 함수 - 결과 스트링 분리 */
		private function GetValue($str , $name)
    {
    		
    		//echo $str .'---------' . $name . '<br>';
        $pos1 = 0;  //length의 시작 위치
        $pos2 = 0;  //:의 위치

        while( $pos1 <= strlen($str) )
        {
            $pos2 = strpos($str , ":" , $pos1);
            $len  = substr($str , $pos1 , $pos2 - $pos1);
            $key  = @substr($str , $pos2 + 1 , $len);
            $pos1 = $pos2 + $len + 1;
            if( $key == $name )
            {
                $pos2 = strpos( $str , ":" , $pos1);
                $len = substr($str , $pos1 , $pos2 - $pos1);
                $value = substr($str , $pos2 + 1 , $len);
                return $value;
            }
            else
            {
                // 다르면 스킵한다.
                $pos2 = strpos( $str , ":" , $pos1);
                $len = substr($str , $pos1 , $pos2 - $pos1);
                $pos1 = $pos2 + $len + 1;
            }
        }
    }
		
		
		// 서류접수기간 체크
		private function ApplyDateCheck($PRJ_IDX)
		{
			$this->load->model('front/common/DateCheck_model','step',true);
			$res = $this->step->getApplyCheck(array($PRJ_IDX,'N'));
			$rdata = $res->result();
			if ($res->num_rows() > 0)
			{
				return 'ON';
			}
			else
			{
				return 'OFF';
				
			}
			
			return 'OFF';
			
		}
		
		private function FrontPopUp()
		{
			$this->load->library('DataControl'); 
			
			$xmlStr = file_get_contents($this->datacontrol->getFileLocation('popup.xml'));
			$xmlObj = simplexml_load_string($xmlStr);
			
			//var_dump($xmlObj);
			$now_date = date('YmdHis');
			//echo $now_date;
			$popJs = null;
			foreach ($xmlObj as $key => $pList)
			{
				if ($now_date >= $pList->stdt && $now_date <= $pList->eddt)
				{
					$popJs .= 'goPopup(' . $pList->code . ',' . $pList->stdt . ',' . $pList->eddt . ',' . $pList->width . ',' . $pList->height . ',\'' . $pList->flag . '\');' . "\n";
				}
				//echo $pList->stdt . '<br>';
				//echo $pList->eddt . '<br>';
				//echo iconv('UTF-8','EUC-KR',$pList->title) . '<br>';
				//echo String2Html(iconv('UTF-8','EUC-KR',$pList->content)) . '<br>';
				
			}
			
			return $popJs;
			
		}
		
	}