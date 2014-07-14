<?
	class WebFileManagement extends MY_Controller
	{
		function Index()
		{
			$COMP_ID = $this->authadmin->getCompanyId();
			
			$data = null;
			$this->load->model('admin/webfile/webfile_model','webfile',true);
			$res = $this->webfile->getList(array($COMP_ID));
			
			$data['num_rows'] = $res->num_rows();
			$data['rdata'] = $res->result();
			
			$this->loadView('admin/webfile/webfile_list_view' , $data);
		}
		
		
		function Process()
		{
			$this->load->model('admin/webfile/webfile_model','webfile',true);
			
			$COMP_ID = $this->authadmin->getCompanyId();
			$RETURN_URL = $this->input->post('RETURN_URL');
			$ACT_FLAG = $this->input->post('ACT_FLAG');
			$WEBIDX = $this->input->post('WEBIDX');
			
			$res = $this->webfile->getDomainId(array($COMP_ID));
			$rdata = $res->result();
			$DOMAIN_ID = $rdata[0]->DOMAIN_ID;
			
			
			
			if (!file_exists(WEBFILE_DIRECTORY . '/' . $DOMAIN_ID)) mkdir(WEBFILE_DIRECTORY . '/' . $DOMAIN_ID);
	
			$config['upload_path'] = WEBFILE_DIRECTORY . '/' . $DOMAIN_ID;
			$config['overwrite'] = TRUE;
			$config['allowed_types'] = 'gif|jpg|jpeg|png|swf|pdf|hwp|doc|docx|xls|xlsx';
			$config['max_size'] = 0;
			$this->load->library('upload',$config);
			
			if (!$this->upload->do_upload('FILE_NM'))
			{
				
				if (@$_FILES['FILE_NM'][tmp_name])
				{
					jsalertmsg('파일업로드가 실패 하였습니다. ');
					jshistoryback();
					exit;
				}
				
			}
			else
			{
				// 정상일경우 데이터 넣기
				
				$uploaddata = $this->upload->data();
				
				$this->webfile->getProcess(array($COMP_ID,$WEBIDX
																						 ,$uploaddata['file_name']
																						 ,$COMP_ID
																						 ,$uploaddata['file_name']));
			}
			
			redirect($RETURN_URL);
			
		}
		
		function Form()
		{
			$data = null;
			
			$ACT_FLAG = $this->input->post('ACT_FLAG');
			
			$data['WEBIDX'] = null;
			
			if ($ACT_FLAG == 'modify')
			{
				$COMP_ID = $this->authadmin->getCompanyId();
				$WEBIDX = $this->input->post('WEBIDX');
				$data['WEBIDX'] = $WEBIDX;
			}
			
			$this->loadView('admin/webfile/webfile_form_view' , $data);
		}
	}