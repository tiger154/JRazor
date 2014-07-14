<?
	class BbsControl extends MY_Controller
	{
		protected $_prjIdx;
		protected $_bbsCode;
		protected $_bbsIdx;
		protected $_pageUrl;
		
		function __construct()
		{
			parent::__construct();
			$this->_pageUrl = '/admin/bbsManagement/';	
			$this->_bbsCode = null;
			$this->_prjidx = $this->input->get('project_id') != '' ? $this->input->get('project_id') : null;
			$this->_bbsIdx = $this->input->get('bbs_idx') != '' ? $this->input->get('bbs_idx') : null ;
		}
		
		function setPageUrl($arg)			{ $this->_pageUrl = $arg; }
		function setProjectId($arg) 	{ $this->_prjIdx = $arg; }
		function setBbsCode($arg)  		{ $this->_bbsCode = $arg; }
		function setBbsIdx($arg)			{ $this->_bbsIdx = $arg; }
		function getProjectId()				{ return $this->_prjidx; }
		function getBbsCode()				{ return $this->_bbsCode; }
		
		function getBbsGroupList()
		{
			
			$this->load->model('admin/setmanager/bbsmanagement_model','bbslist',true);
			$res = $this->bbslist->getBbsGroupList(array($this->_prjidx));
			
			$htmlStr = null;
			$htmlStr .= '<ul class="tabStyle01">';
			foreach ($res->result() as $key => $dataList)
			{
				$class_on = preg_match('/^' . $dataList->BBS_TYPE . '/' , $this->uri->segment(3)) ? 'on' : '';
				$htmlStr .= '<li class="' . $class_on . '"><a href="' . $this->_pageUrl . $dataList->BBS_TYPE . '?project_id=' . $this->_prjidx . '">' . $dataList->BBS_NAME . '</a></li>';
			}
			$htmlStr .= '</ul>';
			return $htmlStr;
		}
		
		function getProjectList()
		{
			$PRJ_IDX = $this->_prjidx;
			$this->load->library('FormBox'); 
			$COMP_ID = $this->authadmin->getCompanyId();
			
			$res = null;
			if ($COMP_ID != null)
			{
				$this->load->model('admin/project/projectManager_model','prjlist',true);
				$res = $this->prjlist->getSimpleProjectList(array($COMP_ID,'N'));
			}
			else
			{
				$this->load->model('front/recruit/recruit_model','prjlist',true);
				$res = $this->prjlist->getSimpleProjectList(array(HOSTID,'O','Y','N','N'));
			}
			
			$rdata = null;
			$rdata = $res->result();
			
			if ($res->num_rows() == 0)
			{
				jsalertmsg('채용공고가 없습니다.');
				jshistoryback();
				exit;
			}
			
			if (!$PRJ_IDX && $rdata[0]->CODE != '' ) $PRJ_IDX = $rdata[0]->CODE;
		
			$this->_prjidx = $PRJ_IDX;
			
			$this->formbox->setId('PRJ_IDX');
			$this->formbox->setName('PRJ_IDX');
			$this->formbox->setOption('onchange="javascript:changeProject();"');
			return $this->formbox->getSelectBox($res->result(),'선택하세요',$PRJ_IDX);
			
		}
		
		function actModify()
		{
			$data['MODE'] = 'EDIT';
			$bbsType = $this->_bbsCode;
			$data['bbsType'] = $bbsType;
			$data['SELECTBOX_PRJ_IDX'] = $this->getProjectList();
			$data['BBSGROUP_LIST'] = $this->getBbsGroupList();
			
			$this->load->model('admin/setmanager/bbsmanagement_model','bbslist',TRUE);
	
			$bbs_idx = $this->input->get('bbs_idx');
			$res = $this->bbslist->getBbs(array('N',$bbs_idx));
			if ($res->num_rows() > 0)
			{
			    $row = $res->row(); 
				$data['BBS_IDX'] = $row->BBS_IDX;
				$data['BBS_GROUP_IDX'] = $row->BBS_GROUP_IDX;
				$data['PRJ_IDX'] = $row->PRJ_IDX;
				$data['REF_BBS_IDX'] = $row->REF_BBS_IDX;
				$data['PARENT_BBS_IDX'] = $row->PARENT_BBS_IDX;
			    $data['BBS_TITLE'] = $row->BBS_TITLE;
			    $data['BBS_CONTENT'] = $row->BBS_CONTENT;
			    $data['HIT'] = $row->HIT;
			    $data['STATUS'] = $row->STATUS;
				$data['EDIT_DT'] = $row->EDIT_DT;
			    $data['REG_DT'] = $row->REG_DT;
			    $data['END_DT'] = $row->END_DT;
				$data['IP_ADDR'] = $row->IP_ADDR;
			    $data['MANAGER_ID'] = $row->MANAGER_ID;
			    $data['APPL_IDX'] = $row->APPL_IDX;
				$data['WRITER_NM'] = $row->WRITER_NM;
				$data['EMAIL'] = $row->EMAIL;
			} else {
				$data['BBS_IDX'] = NULL;
				$data['BBS_GROUP_IDX'] = NULL;
				$data['PRJ_IDX'] = NULL;
				$data['REF_BBS_IDX'] = NULL;
				$data['PARENT_BBS_IDX'] = NULL;
			    $data['BBS_TITLE'] = NULL;
			    $data['BBS_CONTENT'] = NULL;
			    $data['HIT'] = NULL;
			    $data['STATUS'] = NULL;
				$data['EDIT_DT'] = NULL;
			    $data['REG_DT'] = NULL;
			    $data['END_DT'] = NULL;
				$data['IP_ADDR'] = NULL;
			    $data['MANAGER_ID'] = NULL;
			    $data['APPL_IDX'] = NULL;
				$data['WRITER_NM'] = NULL;
				$data['EMAIL'] = null;
			}
			
			$res2 = $this->bbslist->getBbsFiles(array('N',$bbs_idx));
			$data['bbsFilesCount'] = $res2->num_rows();
			$data['BBS_FILES'] = $res2->result();
			foreach ($data['BBS_FILES'] as $row) {
				$row->FILE_NAME = iconv("euckr", "utf-8",$row->FILE_NAME);
		    }
			$data['BBS_FILES'] = json_encode($data['BBS_FILES']);
	
			$res3 = $this->bbslist->getBbsGroup(array('N', $data['PRJ_IDX'], $bbsType));
			$data['bbsGroupCount'] = $res3->num_rows();
			$data['bbsGroup'] = $res3->result();
			
			return $data;
		}
		
		function actReply()
		{
			$data['MODE'] = 'ANSWER';
			$data['SELECTBOX_PRJ_IDX'] = $this->getProjectList();
		 	$data['BBSGROUP_LIST'] = $this->getBbsGroupList();
			$data['BBS_IDX'] = $this->input->get('bbs_idx'); //PARENT_BBS_IDX
			$data['PRJ_IDX'] = $this->input->get('prj_idx');
			$bbsType = $this->_bbsCode;
			$data['bbsType'] = $bbsType;
			$this->load->model('admin/setmanager/bbsmanagement_model','bbslist',TRUE);
			
			$data['BBS_GROUP_IDX'] = NULL;
			//$data['BBS_IDX'] = NULL;
			$data['BBS_TITLE'] = NULL;
			$data['BBS_CONTENT'] = NULL;
			$data['MANAGER_ID'] = $this->authadmin->getUserId();
			$data['APPL_IDX'] = NULL;
	
			$data['BBS_FILES'] = null;
			return $data;
		}
		
		function actWrite()
		{
			$data['MODE'] = 'NEW';
			$userId = null;
			if ($this->authadmin->getUserId() != '') $userId = $this->authadmin->getUserId();
			
			$bbsType = $this->_bbsCode;
			$data['bbsType'] = $bbsType;
			$data['SELECTBOX_PRJ_IDX'] = $this->getProjectList();
		 	$data['BBSGROUP_LIST'] = $this->getBbsGroupList();
		 	$data['PRJ_IDX'] = $this->_prjidx;
			$this->load->model('admin/setmanager/bbsmanagement_model','bbslist',TRUE);
			
			$res1 = $this->bbslist->getBbsGroup(array($this->_prjidx, $bbsType,'N'));
			$data['bbsGroupCount'] = $res1->num_rows();
			$data['bbsGroup'] = $res1->result();
			
			$data['BBS_IDX'] = NULL;
			$data['BBS_GROUP_IDX'] = $data['bbsGroup'][0]->BBS_GROUP_IDX;
			
			$data['REF_BBS_IDX'] = NULL;
			$data['PARENT_BBS_IDX'] = NULL;
			$data['BBS_TITLE'] = NULL;
			$data['BBS_CONTENT'] = NULL;
			$data['HIT'] = NULL;
			$data['STATUS'] = NULL;
			$data['EDIT_DT'] = NULL;
			$data['REG_DT'] = NULL;
			$data['END_DT'] = NULL;
			$data['IP_ADDR'] = NULL;
			$data['MANAGER_ID'] = $userId ;
			$data['APPL_IDX'] = NULL;
			$data['WRITER_NM'] = NULL;
			$data['EMAIL'] = NULL;
			
			$data['BBS_FILES'] = NULL;
			
			
			
			return $data;
		}
		
		function actList($curPage = 1)
		{
			$bbsType = $this->_bbsCode;
			$COMP_ID = $this->authadmin->getCompanyId();
		 	$data['SELECTBOX_PRJ_IDX'] = $this->getProjectList();
		 	$data['BBSGROUP_LIST'] = $this->getBbsGroupList();
			$prjIdx = $this->_prjidx;
			$this->load->library('pagination');
			$this->pagination->setProperty('base_url',$this->_pageUrl . $bbsType);
			$this->load->model('admin/setmanager/bbsmanagement_model','bbslist',TRUE);
			$data['PRJ_IDX'] = $this->_prjidx;
		
			$res1 = $this->bbslist->getBbsGroup(array($prjIdx, $bbsType,'N'));
			$data['bbsGroupCount'] = $res1->num_rows();
			$data['bbsGroup'] = $res1->result();
			$curPage = $this->uri->segment(4);
			//$curPage = $this->input->get('per_page');
			$curPage = ($curPage > 0)? $curPage : 1;
			$data['WRITE_YN'] = $data['bbsGroup'][0]->WRITE_YN;
			$pageSize = $data['bbsGroup'][0]->ALIST_CNT;
			$this->pagination->setProperty('per_page',$pageSize);
			$data['bbsType'] = $bbsType;
			$data['pageUrl'] = $this->_pageUrl;
			
			$res2 = $this->bbslist->getBbsList(array('N',$prjIdx,$data['bbsGroup'][0]->BBS_GROUP_IDX,$curPage,$pageSize,$pageSize));
			
			$this->pagination->setProperty('total_rows',  ($res2->row() == null)? 0 : $res2->row()->TOTAL_COUNT);
			
			$this->pagination->setProperty('page_query_string', FALSE);
			$data['bbsListCount'] = $res2->num_rows();
			$data['bbsList'] = $res2->result();
			$data['paging'] = $this->pagination->create_links();
			$data['curPage'] = $curPage;
			return $data;
		}
		
		function actView()
		{
			
			$bbsType = $this->_bbsCode;
			$data['bbsType'] = $bbsType;
			$this->load->model('admin/setmanager/bbsmanagement_model','bbslist',TRUE);
			$data['SELECTBOX_PRJ_IDX'] = $this->getProjectList();
			$data['BBSGROUP_LIST'] = $this->getBbsGroupList();
			$bbsIdx = $this->input->get('bbs_idx');
			$res = $this->bbslist->getBbs(array('N', $bbsIdx));
			if ($res->num_rows() > 0)
			{
		    $row = $res->row(); 
				$data['BBS_IDX'] = $row->BBS_IDX;
				$data['BBS_GROUP_IDX'] = $row->BBS_GROUP_IDX;
				$data['PRJ_IDX'] = $row->PRJ_IDX;
				$data['REF_BBS_IDX'] = $row->REF_BBS_IDX;
				$data['PARENT_BBS_IDX'] = $row->PARENT_BBS_IDX;
			    $data['BBS_TITLE'] = $row->BBS_TITLE;
			    $data['BBS_CONTENT'] = String2Html($row->BBS_CONTENT);
			    $data['HIT'] = $row->HIT;
			    $data['STATUS'] = $row->STATUS;
				$data['EDIT_DT'] = $row->EDIT_DT;
			    $data['REG_DT'] = $row->REG_DT;
			    $data['END_DT'] = $row->END_DT;
				$data['IP_ADDR'] = $row->IP_ADDR;
			    $data['MANAGER_ID'] = $row->MANAGER_ID;
			    $data['APPL_IDX'] = $row->APPL_IDX;
				$data['WRITER_NM'] = $row->WRITER_NM;
			} else {
				$data['BBS_IDX'] = NULL;
				$data['BBS_GROUP_IDX'] = NULL;
				$data['PRJ_IDX'] = NULL;
				$data['REF_BBS_IDX'] = NULL;
				$data['PARENT_BBS_IDX'] = NULL;
			    $data['BBS_TITLE'] = NULL;
			    $data['BBS_CONTENT'] = NULL;
			    $data['HIT'] = NULL;
			    $data['STATUS'] = NULL;
				$data['EDIT_DT'] = NULL;
			    $data['REG_DT'] = NULL;
			    $data['END_DT'] = NULL;
				$data['IP_ADDR'] = NULL;
			    $data['MANAGER_ID'] = NULL;
			    $data['APPL_IDX'] = NULL;
				$data['WRITER_NM'] = NULL;
			}
	
			$data['backPage'] = $this->input->get('backPage');
	
			
			$res3 = $this->bbslist->getBbsFiles(array('N', $bbsIdx));
			$data['bbsFilesCount'] = $res3->num_rows();
			$data['bbsFiles'] = $res3->result();
			return $data;
		}
		
		//*****************************************
		//**             공통 메소드             **
		//*****************************************
			function Upload() {
				header("Content-type: application/json");
		
				//$verifyToken = md5('unique_salt' . $this->input->post('timestamp'));
		
				$BBS_GROUP_IDX = $this->input->post('BBS_GROUP_IDX');
				//$BBS_IDX = $this->input->post('BBS_IDX');
				
				$SAVE_FOLD = date("Ymd");
		
				$this->load->library('upload');
				$config['upload_path'] = BBS_FILE_DIRECTORY.'/'.$BBS_GROUP_IDX.'/'.$SAVE_FOLD;
				$config['allowed_types'] = '*';
				$config['max_size'] = '5120';
				$config['date_name'] = TRUE;
				$this->upload->initialize($config);
		//		 && $_POST['token'] == $verifyToken
				if (!empty($_FILES)) {
					if( ! $this->upload->do_upload('Filedata'))
					{
						$data['upload_message'] = $this->upload->display_errors('<p>', '</p>');
						echo json_encode(array('MESSAGE'=>$data['upload_message']));
						//$this->load->vars($data);
					}
					else
					{
						// Build a file array from all uploaded files
						$files = $this->upload->data();
						//$data['message'] = '1';
						echo json_encode(array('MESSAGE'=>'1',
							                   'SAVE_NAME'=>$files['file_name'],
											   'SAVE_FOLD'=>$SAVE_FOLD,
							                   'SAVE_URL'=>BBS_FILE_URL.'/'.$BBS_GROUP_IDX.'/'.$SAVE_FOLD.'/'.$files['file_name'],
											   'IS_IMAGE'=>($files['is_image'])? 1 : 0
							));
					}
				} else {
					echo json_encode(array('MESSAGE'=>'Invalid file type.'));
				}
			}
		
			function getPrjCombo() {
				$this->load->model('admin/setmanager/bbsmanagement_model','bbslist',TRUE);
			}
			
			
			///////////////////////////////////////////////////////////
			
			function DeleteBbs() {
				
				$BBS_IDX = $this->input->post('BBS_IDX');
				$PRJ_IDX = $this->input->post('PRJ_IDX');
				$bbsType = $this->input->post('bbsType');
				$PASSWD = $this->input->post('PASSWD');
				$this->load->model('admin/setmanager/bbsmanagement_model','bbslist',TRUE);
				$PASSWD = $PASSWD == '' ? NULL : $PASSWD;
				
				$res1 = $this->bbslist->deleteBbs(array($BBS_IDX,md5($PASSWD)));
				$rs = $res1->result();
				
				if (count($rs) == 0)
				{
					jsalertmsg('비밀번호가 일치하지 않습니다.');
					jshistoryback();
					exit;
				}
				
				if (!$rs[0]->BBS_IDX > 0)
				{
					jsalertmsg('비밀번호가 일치하지 않습니다.');
					jshistoryback();
					exit;
				}
				
				redirect($this->_pageUrl . $bbsType . '?project_id=' . $PRJ_IDX);
			}
		
			function InsertBbsAnswer() {
				
				$this->load->model('admin/setmanager/bbsmanagement_model','bbslist',TRUE);
				$bbsType = $this->input->post('bbsType');
				$BBS_IDX = $this->input->post('BBS_IDX');
				$BBS_GROUP_IDX = $this->input->post('BBS_GROUP_IDX');
				$PRJ_IDX = $this->input->post('PRJ_IDX');
				$BBS_TITLE = $this->input->post('BBS_TITLE');
				$BBS_CONTENT = $this->input->post('BBS_CONTENT');
				$IP_ADDR = $_SERVER['REMOTE_ADDR'];
				$MANAGER_ID = $this->input->post('MANAGER_ID');
				$APPL_IDX = $this->input->post('APPL_IDX');
				$BBS_FILES = json_decode(iconv("euckr", "utf-8",$this->input->post('BBS_FILES')),true);
				
				$res1 = $this->bbslist->insertBbsAnswer(array(
					  $BBS_IDX
					, $BBS_TITLE
					, Html2String($BBS_CONTENT)
					, $IP_ADDR
					, $MANAGER_ID
					, $APPL_IDX
				));
				$row = $res1->row();
				foreach($BBS_FILES as $key => $value) {
					$this->bbslist->insertBbsFiles(array(
						  $value['FLS_IDX']
						, ($BBS_IDX > 0)? $BBS_IDX : $row->BBS_IDX
						, $value['SAVE_FOLD'] //file name
						, iconv("utf-8", "euckr",$value['FILE_NAME']) //file name
						, $value['SAVE_NAME'] //save name
						, $value['FILE_SIZE'] //byte file size
						, $value['FILE_EXT'] //file ext
						, $value['IS_IMAGE'] //image 여부
						, $MANAGER_ID
						, $APPL_IDX
					    , $value['DEL_YN']
					));
				}
				
				redirect($this->_pageUrl . $bbsType . '?project_id=' . $PRJ_IDX);
			}
		
			function InsertBbs() {
				
				$this->load->model('admin/setmanager/bbsmanagement_model','bbslist',TRUE);
				
				$WRITER_NM = $this->input->post('WRITER_NM');
				$BBS_TYPE = $this->input->post('bbsType');
				$BBS_IDX = $this->input->post('BBS_IDX');
				$BBS_GROUP_IDX = $this->input->post('BBS_GROUP_IDX');
				$PRJ_IDX = $this->input->post('PRJ_IDX');
				$BBS_TITLE = $this->input->post('BBS_TITLE');
				$BBS_CONTENT = $this->input->post('BBS_CONTENT');
				$IP_ADDR = $_SERVER['REMOTE_ADDR'];
				$MANAGER_ID = $this->input->post('MANAGER_ID');
				$APPL_IDX = $this->input->post('APPL_IDX');
				$BBS_FILES = json_decode(iconv("euckr", "utf-8",$this->input->post('BBS_FILES')),true);
				$EMAIL = $this->input->post('EMAIL');
				$PASSWD = $this->input->post('PASSWD'); 
				$WRITER_NM = $WRITER_NM == '' ? null : $WRITER_NM;
				$EMAIL = $EMAIL == '' ? null : $EMAIL;
				$PASSWD = $PASSWD == '' ? null : $PASSWD;
				//print_r($BBS_FILES);
				//echo($this->input->post('BBS_FILES'));
				//foreach($BBS_FILES as $key => $value) {
				//	echo $key.$value['SAVE_NAME'];
				//}
				
		//		if($this->input->post('BBS_IDX') > 0) {
		//			$this->UpdateBbs();
		//			return;
		//		}
		
				$res1 = $this->bbslist->insertBbs(array(
					  $BBS_IDX
					, $BBS_GROUP_IDX
					, $PRJ_IDX
					, $BBS_TITLE
					, Html2String($BBS_CONTENT)
					, $IP_ADDR
					, $MANAGER_ID
					, $APPL_IDX
					, $WRITER_NM
					, $EMAIL
					, md5($PASSWD)
				));
				//var_dump($res1->result());
				
				$rs = $res1->result();
			
				if (count($rs) == 0)
				{
					jsalertmsg('비밀번호가 일치하지 않습니다.');
					jshistoryback();
					exit;
				}
				
				if (!$rs[0]->BBS_IDX > 0)
				{
					jsalertmsg('비밀번호가 일치하지 않습니다.');
					jshistoryback();
					exit;
				}
				
				$row = $res1->row();
				foreach($BBS_FILES as $key => $value) {
					$this->bbslist->insertBbsFiles(array(
						  $value['FLS_IDX']
						, ($BBS_IDX > 0)? $BBS_IDX : $row->BBS_IDX
						, $value['SAVE_FOLD'] //file name
						, iconv("utf-8", "euckr",$value['FILE_NAME']) //file name
						, $value['SAVE_NAME'] //save name
						, $value['FILE_SIZE'] //byte file size
						, $value['FILE_EXT'] //file ext
						, $value['IS_IMAGE'] //image 여부
						, $MANAGER_ID
						, $APPL_IDX
					    , $value['DEL_YN']
					));
						//echo(iconv("utf-8", "euckr",$value['FILE_NAME']));
				}
				
				redirect($this->_pageUrl . $BBS_TYPE . '?project_id=' . $PRJ_IDX);
			}
			
			
			function fileDownload()
			{
				
				$BBS_GROUP_IDX = $this->input->get('bbsGidx');
				$FILE_NM = $this->input->get('fls_nm');
				$SAVE_FOLD = $this->input->get('filedate');
				
				$filename = $FILE_NM;
				$filepath = BBS_FILE_DIRECTORY . '/' . $BBS_GROUP_IDX .'/' . $SAVE_FOLD . '/';
			
				header("Pragma: public");
				header("Expires: 0");
				header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
				header("Cache-Control: public");
				header("Content-Description: File Transfer");
				header("Content-type: application/octet-stream");
				header("Content-Disposition: attachment; filename=\"".$filename."\"");
				header("Content-Transfer-Encoding: binary");
				header("Content-Length: ".filesize($filepath.$filename));
				ob_end_flush();
				@readfile($filepath.$filename);
				
			}

	}	
