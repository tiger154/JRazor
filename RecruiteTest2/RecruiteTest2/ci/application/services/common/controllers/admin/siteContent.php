<?
	class SiteContent extends MY_Controller
	{
	
		function Index()
		{
			$this->load->model('admin/site/sitecontent_model','cmt',true);
			$res = $this->cmt->getCommentList();
			
			$data['cmtList'] = $res->result();
			$this->loadView('admin/sitecontent/commentList_view' , $data);
			
		}
		
		function commentView()
		{
			$code = $this->input->post('code');
			$this->load->model('admin/site/sitecontent_model','cmt',true);
			$res = $this->cmt->getCommentList(array($code));
			
			$rdata = $res->result();
			$data['DFC_NM'] = $rdata[0]->DFC_NM;
			$data['DFC_CD'] = $rdata[0]->DFC_CD;
			$data['DFC_CNTNT'] = $rdata[0]->DFC_CNTNT;
			
			$this->loadView('admin/sitecontent/commentView_form' , $data);
		}
		
		function commentProcess()
		{
		
			$DFC_CD = $this->input->post('DFC_CD');
			$DFC_CNTNT = $this->input->post('DFC_CNTNT');
			
			$this->load->model('admin/site/sitecontent_model','cmt',true);
			$res = $this->cmt->getCommentUpdate(array(Html2String($DFC_CNTNT),$DFC_CD));
			redirect('/admin/siteContent');
		}
		
		// 각 프로젝트별 이력서 양식에 따른 유의사항 목록
		function resumeSubList()
		{
			$COMP_ID = $this->authadmin->getCompanyId();
			$this->load->model('admin/site/sitecontent_model','cmt',true);
			
			$res = $this->cmt->getCommentSubList(array($COMP_ID,null));
			
			$data['cmtListCount'] = $res->num_rows();
			$data['cmtList'] = $res->result();
			
			$this->loadView('admin/sitecontent/commentSubList_view' , $data);
		}
		
		function commentSubView()
		{
			$data = null;	
			$COMP_ID = $this->authadmin->getCompanyId();
			$code = $this->input->post('code');
			$data['DFC_CNTNT'] = null;
			$data['CUSTOM_DFC_CD'] = null;
			$data['CUSTOM_DFC_NM'] = null;
			$data['DFC_CD'] = null;
			$data['DFC_NM'] = null;
			
				$this->load->model('admin/site/sitecontent_model','cmt',true);
				$res = $this->cmt->getCommentGroupList();
				$this->load->library('DataControl'); 
				$this->load->library('FormBox'); 
				
				$this->formbox->setId('SEL_DFC_CD');
				$this->formbox->setName('SEL_DFC_CD');
				$this->formbox->setOption('onchange="javascript:selDfcCd();"');
				$data['SELECTBOX_SEL_DFC_CD'] = $this->formbox->getSelectBox($res->result(),'항목선택',$code);
			if ($code != null)
			{	
				
				$res = $this->cmt->getCommentSubList(array($COMP_ID,$code));
				
				$rdata = $res->result();
				$data['DFC_CNTNT'] = $rdata[0]->DFC_CNTNT;
				$data['CUSTOM_DFC_CD'] = $rdata[0]->DFC_CD;
				$data['CUSTOM_DFC_NM'] = $rdata[0]->DFC_NM;
				$data['DFC_CD'] = $rdata[0]->DFC_CD;
				$data['DFC_NM'] = $rdata[0]->DFC_NM;
			}
			
			$this->loadView('admin/sitecontent/commentSubView_form' , $data);
		}
		
		function commentSubProcess()
		{
			$COMP_ID = $this->authadmin->getCompanyId();
			$DFC_CD = $this->input->post('DFC_CD');
			$DFC_CNTNT = $this->input->post('DFC_CNTNT');
			$DFC_NM = $this->input->post('DFC_NM');
			$CUSTOM_DFC_CD = $this->input->post('CUSTOM_DFC_CD');
			$CUSTOM_DFC_NM = $this->input->post('CUSTOM_DFC_NM');
			
			if ($DFC_CD == '' ) $DFC_CD = null;
			
			if ($CUSTOM_DFC_CD != '' && $CUSTOM_DFC_NM != '' )
			{
				$DFC_CD = $CUSTOM_DFC_CD;
				$DFC_NM = $CUSTOM_DFC_NM;
			}
			
			$this->load->model('admin/site/sitecontent_model','cmt',true);
			$res = $this->cmt->getCommentSubProcess(array($COMP_ID,$DFC_CD,$DFC_NM,Html2String($DFC_CNTNT),$COMP_ID,$DFC_CD,$DFC_NM,Html2String($DFC_CNTNT)));
			redirect('/admin/siteContent/resumeSubList');
			
		}
		
		
	}