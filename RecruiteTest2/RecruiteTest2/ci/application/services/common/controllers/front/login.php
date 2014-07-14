<?
	class Login extends MY_Controller
	{
		
		private $_reqseq = "REQ_0123456789";
		private $_certCode = 'G2858';
		private $_certPassword = 'IAOIBLSGG7YG';
		private $_cb_encode_path = "/wwwRoot/api/CPClient";
		private $_returnurl = null;
   
		// 일반 사용자 로그인 - 원서작성
		
		function __construct()
		{
			$this->_returnurl = 'http://' . HOSTID . '.' . MAIN_SERVICE_DOMAIN .'/front/login/UserAuthConfirmProcess';	
			parent::__construct();
		}
		
		// SSL 처리부분 
		function UserAuthSSLConfirmProcess()
		{
			$this->load->library('AuthFront'); 
			$PRJ_IDX = $this->input->post('projectListIdx');
			$DOMAIN_ID = $this->input->post('domainListIdx');
			$RECV_DI = $this->input->post('RECV_DI');
			$RECV_CI = $this->input->post('RECV_CI');
			$RECV_FOREIGN_TP = $this->input->post('RECV_FOREIGN_TP');
			$RECV_GENDER = $this->input->post('RECV_GENDER');
			$RECV_BIRTH_DT = $this->input->post('RECV_BIRTH_DT');
			$RECV_NAME = $this->input->post('RECV_NAME');
			
			$obj = array();
			$obj['P_PRJ_IDX'] = $PRJ_IDX;
			$obj['P_AUTH_DI'] = $RECV_DI;
			$obj['P_NAME'] = $RECV_NAME;
			$obj['P_SEX_CD'] = $RECV_GENDER == '1' ? 'M' : 'F';
			$obj['P_SEX_NM'] = $RECV_GENDER == '1' ? '남자' : '여자';
			$obj['P_BIRTH_DT'] = $RECV_BIRTH_DT;
			$obj['P_FOREIGN_TP'] = $RECV_FOREIGN_TP == '0' ? 'N' : 'Y';
			
			$this->load->model('front/login/login_model','lgn',true);
			$res = $this->lgn->getAuthLoginApplySave($obj);
			
			//var_dump($res);
			
			$this->authfront->setUserApplyId($res[0]['APPL_IDX']);
			$this->authfront->setUserNm($res[0]['NAMEKOR']);
			$this->authfront->setUserEmail($res[0]['EMAIL']);
			$this->authfront->setUserDomain($DOMAIN_ID);
			$this->authfront->setUserApplyDI($RECV_DI);
			$this->authfront->setUserDefaultProject($PRJ_IDX);
			
			
	  	if ($res[0]['APPL_YN'] == 'Y') // 헉 접수했다 병신
	  	{
				redirect('http://' . $DOMAIN_ID . '.' . MAIN_SERVICE_DOMAIN . '/front/mypage');
	  	}
	  	else
	  	{
	  		// appl_idx 값 받아와서 쿠키에 넣어려썅
	  		if (trim($res[0]['APPL_IDX']) != '')
	  		{
					$data['RECV_DI'] = $RECV_DI;
					$data['PRJ_IDX'] = $PRJ_IDX;
					$data['redirect_url'] = 'http://' . $DOMAIN_ID . '.' . MAIN_SERVICE_DOMAIN . '/front/apply';
					
					$this->frontView('front/login/authSSLprocess_form' , $data);
				}
				else
				{
					/* 인서트를 하던 기존에 접수를 했던 뭔가 있어야하는데 아무것도 없을때 */
					jsalertmsg('오류가 발생하였습니다.[에러코드:ERR005]');
					exit;
				}
	  	}
	  
			//if ($res) redirect('http://' . $DOMAIN_ID . '.' . MAIN_SERVICE_DOMAIN . '/front/apply');
		}
		
		function LoginForm()
		{
			$data = null;
			$getRtnURL = $this->input->get('return_url');
			$this->load->model('front/recruit/recruit_model','rct',true);
			$res = $this->rct->getProjectList(array(HOSTID,'O','Y','N','N'));
			$projectListCount = $res->num_rows();
			$projectList = $res->result();
			
			$objList = array();
			
			$data['loginURL'] = SSL_LOGIN_DOMAIN . '/front/login/UserLoginConfirmProcess';
			$data['DOMAIN_ID'] = HOSTID;
			$data['RETURN_URL'] = $getRtnURL != '' ? 'http://' . HOSTID . '.' . MAIN_SERVICE_DOMAIN . $getRtnURL : 'http://' . HOSTID . '.' . MAIN_SERVICE_DOMAIN . '/front/mypage';
			foreach ($projectList as $key => $prjList)
			{
				$objList[] = array($prjList->PRJ_IDX , $prjList->PRJ_NM);
			}
			// library
			$this->load->library('DataControl'); 
			$this->load->library('FormBox'); 
			// 채용공고들 
			$this->formbox->setId('PROJECT_LIST');
			$this->formbox->setName('PROJECT_LIST');
			$this->formbox->setOption('');
			$data['SELECTBOX_PROJECT_LIST'] = $this->formbox->getSelectBox($objList, '선택' , '' , $objType = 'array');
			
			// 휴대폰 앞자리
			$this->formbox->setId('HTEL1');
			$this->formbox->setName('HTEL1');
			$this->formbox->setOption('');
			
			$data['SELECTBOX_HTEL'] = $this->formbox->getSelectBox($this->datacontrol->getFile2Array('HTEL.txt'), '선택' , '', $objType = 'array');
			
			return $data;
		}
		
		function UserLogin()
		{
			$this->load->library('AuthFront'); 
			$this->authfront->logout();
			$data = $this->LoginForm();
			$this->frontView('front/login/applylogin_form' , $data);
			
		}
		
		// 일반 사용자 로그인 - 각종 발표 부분
		function PassLogin()
		{
			$this->load->library('AuthPassFront'); 
			$this->authpassfront->logout();
			$data = $this->LoginForm();
			$ADMIN_FLAG = $this->input->get('code');
			$data['ADMIN_FLAG'] = $ADMIN_FLAG;
			$data['loginURL'] = SSL_LOGIN_DOMAIN . '/front/login/PassUserLoginProcess';
			$this->frontView('front/login/passlogin_form' , $data);
		}
		
		// 비밀번호 찾기 - 처리부분
		function SearchPasswordProcess()
		{
			session_start();
			$this->load->library('AuthFront'); 
			
			$PRJ_IDX = $this->input->post('PRJECT_LIST');
			$DOMAIN_ID = $this->input->post('DOMAIN_ID');
			$RETURN_URL = $this->input->post('RETURN_URL');
			$RECV_DI = $_SESSION['RECV_DI'];
			$RECV_CI =  $_SESSION['RECV_CI'];
			$RECV_FOREIGN_TP = $_SESSION['RECV_FOREIGN_TP'];
			$RECV_GENDER = $_SESSION['RECV_GENDER'];
			$RECV_BIRTH_DT = $_SESSION['RECV_BIRTH_DT'];
			$RECV_NAME = $_SESSION['RECV_NAME'];
			$NAMECHECK = $this->input->post('NAMECHECK');
			
			$this->load->model('front/login/login_model','lgn',true);
			
			/*
			$PRJ_IDX = 30;
			$RECV_DI = 'MC0GCCqGSIb3DQIJAyEAmV2zybvb2LmPrjQJ9sc/cxzPnM52ZUZCXgD+btzGnz8=';
			$RECV_NAME = '박명훈';
			$DOMAIN_ID = 'google';
			*/
			$res = $this->lgn->getPasswordSearchList(array($PRJ_IDX,$RECV_DI,$RECV_NAME,'N','N',$DOMAIN_ID,'N','N'));
			if ($res->num_rows() > 0 )
			{
				$rs = $res->result();
		  	if ($rs[0]->APPL_IDX != '') // 패스워드 변경할수있는 상태
		  	{
		  		$this->authfront->setUserAuthType('searchPassword'); //인증_위치 -> 패스워드용 다른곳에서 초기화할때 쓰려고 만들긴했는데;;;
		  		$this->authfront->setUserApplyId($rs[0]->APPL_IDX);
					$this->authfront->setUserNm($rs[0]->NAMEKOR);
					$this->authfront->setUserDomain($DOMAIN_ID);
					$this->authfront->setUserApplyDI($RECV_DI);
					$this->authfront->setUserDefaultProject($PRJ_IDX);
		  		
					redirect($RETURN_URL);
					exit;
		  	}
		  	else
		  	{
		  		jsalertmsg('일치하는 정보가 없습니다.');
			  	jshistoryback();
			  	exit;
		  	}
		  	
		  }
		  else
		  {
		  	jsalertmsg('일치하는 정보가 없습니다.');
		  	jshistoryback();
		  	exit;
		  }
			
			
			
		}
		
		// 비밀번호 찾기 
		function SearchPassword()
		{
			//$this->load->library('AuthPassFront'); 
			//$this->authpassfront->logout();
			$data = null;
			//$data['reqseq'] = $this->_reqseq;
			//$data['sitecode'] = $this->_certCode;
			$data['sitepasswd'] = $this->_certPassword;
			//$data['cb_encode_path'] = $this->_cb_encode_path;
			$reqseq_str = $this->_cb_encode_path . ' ' . 'SEQ' . ' ' .$this->_certCode;
    	$data['reqseq'] = exec($reqseq_str);
    	$_SESSION["REQ_SEQ"] = $data['reqseq'];
    
    	///'9:AUTH_TYPE' . strlen($authtype) . ':'. $authtype .
    	$plaindata =  '7:REQ_SEQ' . strlen($data['reqseq']) . ':' . $data['reqseq'] .
			    			  '8:SITECODE' . strlen($this->_certCode) . ':' . $this->_certCode .
			    			  '7:RTN_URL' . strlen($this->_returnurl) . ':' . $this->_returnurl .
			    			  '7:ERR_URL' . strlen($this->_returnurl) . ':' . $this->_returnurl ;
	    $enc_data = exec($this->_cb_encode_path . ' ' . 'ENC' . ' ' . $this->_certCode . ' ' . $this->_certPassword . ' ' . $plaindata);
	
	    if( $enc_data == -1 )
	    {
	        $returnMsg = "암/복호화 시스템 오류입니다.";
	        $enc_data = "";
	    }
	    else if( $enc_data== -2 )
	    {
	        $returnMsg = "암호화 처리 오류입니다.";
	        $enc_data = "";
	    }
	    else if( $enc_data== -3 )
	    {
	        $returnMsg = "암호화 데이터 오류 입니다.";
	        $enc_data = "";
	    }
	    else if( $enc_data== -9 )
	    {
	        $returnMsg = "입력값 오류 입니다.";
	        $enc_data = "";
	    }
    	
    	$data['enc_data'] = $enc_data;
    	$data['_returnurl'] = $this->_returnurl;
			
			// library
			$this->load->library('DataControl'); 
			$this->load->library('FormBox'); 
			// 채용공고들 
			
			
			$getRtnURL = $this->input->get('return_url');
			$this->load->model('front/recruit/recruit_model','rct',true);
			$res = $this->rct->getProjectList(array(HOSTID,'O','Y','N','N'));
			$projectListCount = $res->num_rows();
			$projectList = $res->result();
			
			$objList = array();
			
			//$data['loginURL'] = SSL_LOGIN_DOMAIN . '/front/login/UserLoginConfirmProcess';
			$data['DOMAIN_ID'] = HOSTID;
			$data['RETURN_URL'] = $getRtnURL != '' ? 'http://' . HOSTID . '.' . MAIN_SERVICE_DOMAIN . $getRtnURL : 'http://' . HOSTID . '.' . MAIN_SERVICE_DOMAIN . '/front/password/PasswordResult';
			foreach ($projectList as $key => $prjList)
			{
				$objList[] = array($prjList->PRJ_IDX , $prjList->PRJ_NM);
			}
			
			$this->formbox->setId('PROJECT_LIST');
			$this->formbox->setName('PROJECT_LIST');
			$this->formbox->setOption('');
			$data['SELECTBOX_PROJECT_LIST'] = $this->formbox->getSelectBox($objList, '선택' , '' , $objType = 'array');
			
			$ADMIN_FLAG = $this->input->get('code');
			$data['loginURL'] = SSL_LOGIN_DOMAIN . '/front/login/SearchPasswordProcess';
			$this->frontView('front/login/searchPass_form' , $data);
		}
		
		
		// 합격자로그인 처리 -- 로그인처리라기보단;;;; 합격자 조회용으로 작업하기 위한 용도.
		function PassUserLoginProcess()
		{
			$this->load->library('AuthPassFront'); 

			$ADMIN_FLAG 		= $this->input->post('ADMIN_FLAG');
			$DOMAIN_ID 			= $this->input->post('DOMAIN_ID');
			$RETURN_URL 		= $this->input->post('RETURN_URL');
			$PRJ_IDX 				= $this->input->post('PROJECT_LIST');
			$NAMEKOR 				= $this->input->post('USERNAME');
			$HTEL1 					= $this->input->post('HTEL1');
			$HTEL2		 			= $this->input->post('HTEL2');
			$HTEL3 					= $this->input->post('HTEL3');
			$USER_PW 				= $this->input->post('USER_PW');
			
			$HTEL = $HTEL1 .'-'. $HTEL2 .'-'. $HTEL3;
			
			$this->load->model('front/pass/pass_model','pass',true);
			if ($ADMIN_FLAG != '')
			{
				$res = $this->pass->getPassInfoList(array($PRJ_IDX,$PRJ_IDX,'N',$PRJ_IDX,$NAMEKOR,md5($USER_PW),$HTEL,'N',$DOMAIN_ID,'N','N'));
				exit;
			}
			else
			{
				$res = $this->pass->getPassInfoList(array($PRJ_IDX,$PRJ_IDX,'N',$PRJ_IDX,$NAMEKOR,md5($USER_PW),$HTEL,'N',$DOMAIN_ID,'N','N'));
			}
			
			if ($res->num_rows() == 1)
			{
				$this->authpassfront->setUserNm($NAMEKOR);
				$this->authpassfront->setUserDomain($DOMAIN_ID);
				$this->authpassfront->setUserPass($USER_PW);
				$this->authpassfront->setUserHtel($HTEL);
				$this->authpassfront->setUserDefaultProject($PRJ_IDX);
				
				redirect($RETURN_URL);
			}
			else
			{
				if ($res->num_rows() > 1)
				{
					jsalertmsg('일치하는 정보가 있습니다만 시스템 안전 문제로 잠시 불가능합니다. 문의주세요.[ERR009]');
				}
				else
				{
					jsalertmsg('일치하는 정보가 없습니다. 다시확인하세요.');	
				}
				jshistoryback();
				exit;
			}
			
		}
		
		// 입사지원확인 또는 합격자 발표용 로그인처리 
		function UserLoginConfirmProcess()
		{
			$this->load->library('AuthFront'); 
			$this->load->model('front/login/login_model','lgn',true);
			
			$PRJ_IDX = $this->input->post('PROJECT_LIST');
			$NAMEKOR = $this->input->post('USERNAME');
			$HTEL1 = $this->input->post('HTEL1');
			$HTEL2 = $this->input->post('HTEL2');
			$HTEL3 = $this->input->post('HTEL3');
			$USER_PW = $this->input->post('USER_PW');
			$DOMAIN_ID = $this->input->post('DOMAIN_ID');
			$HTEL = $HTEL1 . '-' . $HTEL2 . '-' . $HTEL3;
			$rtnURL = $this->input->post('RETURN_URL');
			$res = $this->lgn->getLoginConfirmList(array($PRJ_IDX,$NAMEKOR,md5($USER_PW),$HTEL,'N','N',$DOMAIN_ID,'N','N'));
			
			if ($res->num_rows() == 1)
			{
				$rdata = $res->result();
				$this->authfront->setUserNm($rdata[0]->NAMEKOR);
				$this->authfront->setUserEmail($rdata[0]->EMAIL);
				$this->authfront->setUserDomain($DOMAIN_ID);
				$this->authfront->setUserApplyId($rdata[0]->APPL_IDX);
				$this->authfront->setUserApplyDI($rdata[0]->AUTH_DI);
				$this->authfront->setUserDefaultProject($PRJ_IDX);
				redirect($rtnURL);
			}
			else
			{
				jsalertmsg('일치하는 정보가 없습니다. 다시 확인하세요.');
				jshistoryback();
				exit;
			}
			
			
		}
		
		function UserNameCheck()
		{
			$data['sslUrlHost'] = SSL_LOGIN_DOMAIN . '/front/login/UserAuthConfirm';
			$this->frontView('front/login/sslNameCheck_form' , $data);
		}
		
		// 본인확인 처리 폼
		function UserAuthConfirm()
		{
			session_start();
			session_unset();
			$data = null;
			$this->load->model('front/common/sitecontent_model','site',true);
			$res = $this->site->getContentView(HOSTID,'front_agreement');
			$rs = $res->result();
			$data['front_agreement'] = String2Html($rs[0]->DFC_CNTNT);
			
			$PRJ_IDX = $this->input->get('projectListIdx');
			$data['PRJ_IDX'] = $PRJ_IDX;
			
			//$data['reqseq'] = $this->_reqseq;
			//$data['sitecode'] = $this->_certCode;
			$data['sitepasswd'] = $this->_certPassword;
			//$data['cb_encode_path'] = $this->_cb_encode_path;
			$reqseq_str = $this->_cb_encode_path . ' ' . 'SEQ' . ' ' .$this->_certCode;
    	$data['reqseq'] = exec($reqseq_str);
    	$_SESSION["REQ_SEQ"] = $data['reqseq'];
    
    	///'9:AUTH_TYPE' . strlen($authtype) . ':'. $authtype .
    	$plaindata =  '7:REQ_SEQ' . strlen($data['reqseq']) . ':' . $data['reqseq'] .
			    			  '8:SITECODE' . strlen($this->_certCode) . ':' . $this->_certCode .
			    			  '7:RTN_URL' . strlen($this->_returnurl) . ':' . $this->_returnurl .
			    			  '7:ERR_URL' . strlen($this->_returnurl) . ':' . $this->_returnurl ;
	    $enc_data = exec($this->_cb_encode_path . ' ' . 'ENC' . ' ' . $this->_certCode . ' ' . $this->_certPassword . ' ' . $plaindata);
	
	    if( $enc_data == -1 )
	    {
	        $returnMsg = "암/복호화 시스템 오류입니다.";
	        $enc_data = "";
	    }
	    else if( $enc_data== -2 )
	    {
	        $returnMsg = "암호화 처리 오류입니다.";
	        $enc_data = "";
	    }
	    else if( $enc_data== -3 )
	    {
	        $returnMsg = "암호화 데이터 오류 입니다.";
	        $enc_data = "";
	    }
	    else if( $enc_data== -9 )
	    {
	        $returnMsg = "입력값 오류 입니다.";
	        $enc_data = "";
	    }
    	
    	$data['enc_data'] = $enc_data;
    	$data['_returnurl'] = $this->_returnurl;
			
			$this->frontView('front/login/authuser_form' , $data);
		}
		
		function UserAuthConfirmFlag()
		{
			session_start();
			header("Cache-Control: no-cache");
			header("Pragma: no-cache");
			header("Content-Type: text/html; charset=UTF-8");
			
			$this->load->library('Json');
			
			if (
			$_SESSION['RECV_REQ_SEQ'] != null && 
      $_SESSION['RECV_DI'] != null && 
     
      $_SESSION['RECV_FOREIGN_TP'] != null && 
      $_SESSION['RECV_GENDER'] != null && 
      $_SESSION['RECV_BIRTH_DT'] != null && 
      $_SESSION['RECV_NAME'] != null )
      {
      	
      	$obj = array();
      	
	      	$obj['RECV_REQ_SEQ'] = $_SESSION['RECV_REQ_SEQ'];
		      $obj['RECV_DI'] = $_SESSION['RECV_DI'];
		      $obj['RECV_CI'] = $_SESSION['RECV_CI'];
		      $obj['RECV_FOREIGN_TP'] = $_SESSION['RECV_FOREIGN_TP'];
		      $obj['RECV_GENDER'] = $_SESSION['RECV_GENDER'];
		      $obj['RECV_BIRTH_DT'] = $_SESSION['RECV_BIRTH_DT'];
		      $obj['RECV_NAME'] = iconv('EUC-KR','UTF-8',$_SESSION['RECV_NAME']);
	      	echo $this->json->getArray2Json($obj);
	      
      }
		}
		
		// 본인확인 처리 결과 처리부분 
		function UserAuthConfirmProcess()
		{
			session_start();
			$_SESSION['RECV_FLAG'] = null;
			$_SESSION['RECV_REQ_SEQ'] = null; 
      $_SESSION['RECV_DI'] = null;
      $_SESSION['RECV_CI'] = null;
      $_SESSION['RECV_FOREIGN_TP'] = null;
      $_SESSION['RECV_GENDER'] = null;
      $_SESSION['RECV_BIRTH_DT'] = null;
      $_SESSION['RECV_NAME'] = null;
			$this->load->model('front/login/login_model','lgn',true);
			$enc_data = $this->input->post('EncodeData');
			$sReserved1 = $this->input->post('param_r1');
			$sReserved2 = $this->input->post('param_r2');
			$sReserved3 = $this->input->post('param_r3');
			
			//echo $sReserved2;
			
			//echo $enc_data;
			
			/* 본인인증 샘플 코드 S */
			
				if ($enc_data != "") {
	
	        //$plaindata = `$cb_encode_path DEC $sitecode $sitepasswd $enc_data`;		// 암호화된 결과 데이터의 복호화
	        $plaindata = exec($this->_cb_encode_path . ' ' . 'DEC' . ' ' . $this->_certCode . ' ' . $this->_certPassword . ' ' . $enc_data);
	        //echo "[plaindata]  " . $plaindata . "<br>";
					
					$ciphertime = exec($this->_cb_encode_path . ' ' . 'CTS' . ' ' . $this->_certCode . ' ' . $this->_certPassword . ' ' . $enc_data);	// 암호화된 결과 데이터 검증 (복호화한 시간획득)
					
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
	            // 복호화가 정상적일 경우 데이터를 파싱합니다.
	        }
	        
	        $this->lgn->getCertLogInsert(array($sReserved2,'N',$requestnumber,$responsenumber,$authtype,$ciphertime,$name,$birthdate,$gender,$nationalinfo,$dupinfo,$conninfo,$sReserved1,$sReserved2,$sReserved3,$returnMsg,$err_code));
	         
          if(strcmp($_SESSION["REQ_SEQ"], $requestnumber) != 0)
          {
          	jsalertmsg('올바른 경로로 접근하시거나 다시 시도해주시기 바랍니다.');
          	winclose();
          	exit;
          }
          
          $_SESSION['RECV_FLAG'] = $err_code;
          $_SESSION['RECV_REQ_SEQ'] = $requestnumber; 
          $_SESSION['RECV_DI'] = $dupinfo;
          $_SESSION['RECV_CI'] = $conninfo;
          $_SESSION['RECV_FOREIGN_TP'] = $nationalinfo;
          $_SESSION['RECV_GENDER'] = $gender;
          $_SESSION['RECV_BIRTH_DT'] = $birthdate;
          $_SESSION['RECV_NAME'] = $name;
          
          jsalertmsg('본인확인이 완료되었습니다.');
          winclose('on');
          
	    }
	    
	    /* 본인인증 샘플 코드 E */
			
		}
		
		private function GetValue($str , $name)
    {
        $pos1 = 0;  //length의 시작 위치
        $pos2 = 0;  //:의 위치

        while( $pos1 <= strlen($str) )
        {
            $pos2 = strpos( $str , ":" , $pos1);
            $len = substr($str , $pos1 , $pos2 - $pos1);
            $key = @substr($str , $pos2 + 1 , $len);
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
		
	}