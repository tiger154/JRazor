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
			echo 'ä����� ����(����Ʈ)';
		}
		
		
		
		function AuthConfirm()
		{
			$data = null;
			echo '����Ȯ�� ������';
			echo '�̵����������� �޴´�.';
			$this->frontView('front/recruit/authconfirm_form' , $data);
		}
		
		//�������� ����� ���� 
		function AuthConfirmResult()
		{
			
			/* ������ ��ü���� �� ���� �����ؼ� ���� */
			$data = null;
			
			$enc_data = $this->input->post('EncodeData');		// ��ȣȭ�� ��� ����Ÿ
    
	    $sReserved1 = $this->input->post('param_r1'); // $COMP_ID
			$sReserved2 = $this->input->post('param_r2'); // $DOMAIN_ID
			$sReserved3 = $this->input->post('param_r3'); // 
			
			$sitecode = $this->_certCode;
			$cb_encode_path = $this->_cb_encode_path;
			$sitepasswd = $this->_certPassword;
		
			if ($enc_data != "") {
					
	        $plaindata = exec("$cb_encode_path DEC $sitecode $sitepasswd $enc_data");		// ��ȣȭ�� ��� �������� ��ȣȭ
	        
					$returnMsg = null;
	        if ($plaindata == -1){
	            $returnMsg  = "��/��ȣȭ �ý��� ����";
	        }else if ($plaindata == -4){
	            $returnMsg  = "��ȣȭ ó�� ����";
	        }else if ($plaindata == -5){
	            $returnMsg  = "HASH�� ����ġ - ��ȣȭ �����ʹ� ���ϵ�";
	        }else if ($plaindata == -6){
	            $returnMsg  = "��ȣȭ ������ ����";
	        }else if ($plaindata == -9){
	            $returnMsg  = "�Է°� ����";
	        }else if ($plaindata == -12){
	            $returnMsg  = "����Ʈ ��й�ȣ ����";
	        }else{
	    	  }
	    	  
	          // ��ȣȭ�� �������� ��� �����͸� �Ľ��մϴ�.
	          $ciphertime = exec("$cb_encode_path CTS $sitecode $sitepasswd $enc_data");	// ��ȣȭ�� ��� ������ ���� (��ȣȭ�� �ð�ȹ��)
	      		
	          $requestnumber = $this->GetValue($plaindata , "REQ_SEQ");
	          $responsenumber = $this->GetValue($plaindata , "RES_SEQ");
	          $authtype = $this->GetValue($plaindata , "AUTH_TYPE");
	          $name = $this->GetValue($plaindata , "NAME");
	          $birthdate = $this->GetValue($plaindata , "BIRTHDATE");
	          $gender = $this->GetValue($plaindata , "GENDER");
	          $nationalinfo = $this->GetValue($plaindata , "NATIONALINFO");	//��/�ܱ�������(���߰��̵� ����)
	          $dupinfo = $this->GetValue($plaindata , "DI");
	          $conninfo = $this->GetValue($plaindata , "CI");
	          $err_code = $this->GetValue($plaindata , "ERR_CODE");
						
						
						$this->recruit->getCertLogInsert(array($sReserved1,$requestnumber,$responsenumber,$authtype,$ciphertime,$name,$birthdate,$gender,$nationalinfo,$dupinfo,$conninfo,$sReserved1,$sReserved2,$sReserved3,$returnMsg,$err_code));
						
	          if(strcmp($_SESSION["REQ_SEQ"], $requestnumber) != 0)
	          {
	          	jsalertmsg('�ùٸ� ��η� �����Ͻðų� �ٽ� �õ����ֽñ� �ٶ��ϴ�.');
	          	winclose();
	          	exit;
	          }
	        
	    }
			
			$this->frontView('front/recruit/authconfirm_result' , $data);
		}
		
		function AuthConfirmProcess()
		{
			echo '�α��μ��� - ���μ���ó����';
		}
		
		/* �����ʿ��� �������ִ� �Լ� - ��� ��Ʈ�� �и� */
		private function GetValue($str , $name)
    {
    		
    		//echo $str .'---------' . $name . '<br>';
        $pos1 = 0;  //length�� ���� ��ġ
        $pos2 = 0;  //:�� ��ġ

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
                // �ٸ��� ��ŵ�Ѵ�.
                $pos2 = strpos( $str , ":" , $pos1);
                $len = substr($str , $pos1 , $pos2 - $pos1);
                $pos1 = $pos2 + $len + 1;
            }
        }
    }
		
		
		// ���������Ⱓ üũ
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