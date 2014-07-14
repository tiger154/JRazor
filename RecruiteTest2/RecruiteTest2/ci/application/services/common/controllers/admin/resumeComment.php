<?
	class ResumeComment extends MY_Controller
	{
	
		function Index()
		{
			$this->load->model('admin/comment/resumecomment_model','cmt',true);
			$res = $this->cmt->getCommentList();
			
			$data['cmtList'] = $res->result();
			$this->loadView('admin/comment/commentList_view' , $data);
			
		}
		
		function commentView()
		{
			$code = $this->input->post('code');
			$this->load->model('admin/comment/resumecomment_model','cmt',true);
			$res = $this->cmt->getCommentList(array($code));
			
			$rdata = $res->result();
			$data['DFC_NM'] = $rdata[0]->DFC_NM;
			$data['DFC_CD'] = $rdata[0]->DFC_CD;
			$data['DFC_CNTNT'] = $rdata[0]->DFC_CNTNT;
			
			$this->loadView('admin/comment/commentView_form' , $data);
		}
		
		function commentProcess()
		{
		
			$DFC_CD = $this->input->post('DFC_CD');
			$DFC_CNTNT = $this->input->post('DFC_CNTNT');
			
			$this->load->model('admin/comment/resumecomment_model','cmt',true);
			$res = $this->cmt->getCommentUpdate(array(Html2String($DFC_CNTNT),$DFC_CD));
			redirect('/admin/resumeComment');
		}
		
		// 각 프로젝트별 이력서 양식에 따른 유의사항 목록
		function resumeSubList()
		{
			$PRJ_IDX = $this->input->get('project_id');
			$this->load->model('admin/comment/resumecomment_model','cmt',true);
			
			$res = $this->cmt->getRsmIdx(array($PRJ_IDX));
			$rdata = $res->result();
			
			$rsm_idx = $rdata[0]->RSM_IDX;
			$res = $this->cmt->getCommentSubList(array($PRJ_IDX,null));
			
			
			
			
			$data['PRJ_IDX'] = $PRJ_IDX;
			$data['cmtListCount'] = $res->num_rows();
			$data['cmtList'] = $res->result();
			$data['RSM_IDX'] = $rsm_idx;
			$this->loadView('admin/comment/commentSubList_view' , $data);
		}
		
		function commentSubView()
		{
			$data = null;	
			$RSM_IDX = $this->input->post('RSM_IDX');
			$PRJ_IDX = $this->input->post('PRJ_IDX');
			$data['PRJ_IDX'] = $PRJ_IDX;
			$data['RSM_IDX'] = $RSM_IDX;
			$code = $this->input->post('code');
			$data['DFC_CNTNT'] = null;
			$data['CUSTOM_DFC_CD'] = null;
			$data['CUSTOM_DFC_NM'] = null;
			$data['DFC_CD'] = null;
			$data['DFC_NM'] = null;
			
				$this->load->model('admin/comment/resumecomment_model','cmt',true);
				$res = $this->cmt->getCommentGroupList();
				$this->load->library('DataControl'); 
				$this->load->library('FormBox'); 
				
				$this->formbox->setId('SEL_DFC_CD');
				$this->formbox->setName('SEL_DFC_CD');
				$this->formbox->setOption('onchange="javascript:selDfcCd();"');
				$data['SELECTBOX_SEL_DFC_CD'] = $this->formbox->getSelectBox($res->result(),'항목선택',$code);
			if ($code != null)
			{	
				
				$res = $this->cmt->getCommentSubList(array($PRJ_IDX,$code));
				
				$rdata = $res->result();
				$data['DFC_CNTNT'] = $rdata[0]->DFC_CNTNT;
				$data['CUSTOM_DFC_CD'] = $rdata[0]->DFC_CD;
				$data['CUSTOM_DFC_NM'] = $rdata[0]->DFC_NM;
				$data['DFC_CD'] = $rdata[0]->DFC_CD;
				$data['DFC_NM'] = $rdata[0]->DFC_NM;
			}
			
			$this->loadView('admin/comment/commentSubView_form' , $data);
		}
		
		function commentSubProcess()
		{
			$PRJ_IDX = $this->input->post('PRJ_IDX');
			$RSM_IDX = $this->input->post('RSM_IDX');
			$DFC_CD = $this->input->post('DFC_CD');
			$DFC_CNTNT = $this->input->post('DFC_CNTNT');
			$DFC_NM = $this->input->post('DFC_NM');
			$CUSTOM_DFC_CD = $this->input->post('CUSTOM_DFC_CD');
			$CUSTOM_DFC_NM = $this->input->post('CUSTOM_DFC_NM');
			
			if ($CUSTOM_DFC_CD != '' && $CUSTOM_DFC_NM != '' )
			{
				$DFC_CD = $CUSTOM_DFC_CD;
				$DFC_NM = $CUSTOM_DFC_NM;
			}
			
			
			
			$this->load->model('admin/comment/resumecomment_model','cmt',true);
			$res = $this->cmt->getCommentSubProcess(array($RSM_IDX,$DFC_CD,$DFC_NM,Html2String($DFC_CNTNT),$RSM_IDX,$DFC_CD,$DFC_NM,Html2String($DFC_CNTNT)));
			redirect('/admin/resumeComment/resumeSubList?project_id=' . $PRJ_IDX);
			
		}
		
		
	}