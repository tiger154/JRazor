<?
	class RequireManagement extends MY_Controller
	{
		function Index()
		{
			// library
			$this->load->library('DataControl'); 
			$this->load->library('FormBox'); 
			$this->load->model('admin/require/requiremanagement_model','reqmdl',true);
			$this->load->model('admin/step/stepManagement_model','unit',true);
			
			$COMP_ID = $this->authadmin->getCompanyId();
			
			$PRJ_IDX = $this->input->post('PRJ_IDX');
			$UNIT_IDX = $this->input->post('UNIT_IDX');
			$RSM_IDX = $this->input->post('RSM_IDX');
			//$REQ_IDX = $this->input->post('REQ_IDX');
			$REQ_IDX = null;
			$data = null;
			
			$data['PRJ_IDX'] = $PRJ_IDX;
			$data['RSM_IDX'] = $RSM_IDX;
			//$data['REQ_IDX'] = $REQ_IDX;
			
			/* 해당 모집분야와 해당 이력서양식과 일치하는 자격요건 데이터 로드 -없으면 빈거지뭐 */
			$rsmRes = $this->reqmdl->getRequireList(array($PRJ_IDX,$UNIT_IDX,$RSM_IDX,'N','N'));
			$reqDataList = $rsmRes->result();
			
			
			$data['PSNR_NAI_STDT1'] = null;
			$data['PSNR_NAI_STDT2'] = null;
			$data['PSNR_NAI_STDT3'] = null;
			$data['PSNR_NAI_EDDT1'] = null;
			$data['PSNR_NAI_EDDT2'] = null;
			$data['PSNR_NAI_EDDT3'] = null;
			$data['SCHL_STDT1'] = null;
			$data['SCHL_STDT2'] = null;
			$data['SCHL_SCT_CD'] = null;
			$data['SCHL_SCORE_TP'] = null;
			$data['SCHL_SCORE'] = null;
			$data['ARMY_STDT1'] = null;
			$data['ARMY_STDT2'] = null;
			$data['ARMY_STDT3'] = null;
			
			if ($rsmRes->num_rows() > 0)
			{
				 
				 $REQ_IDX = !$reqDataList[0]->REQ_IDX ? $REQ_IDX : $reqDataList[0]->REQ_IDX;
				 //$data['REQ_IDX'] = $REQ_IDX;
				 
				 $PSNR_NAI_STDT_AR = explode('-',$reqDataList[0]->PSNR_NAI_STDT == null ? '--' : $reqDataList[0]->PSNR_NAI_STDT);
				 $data['PSNR_NAI_STDT1'] = $PSNR_NAI_STDT_AR[0];
				 $data['PSNR_NAI_STDT2'] = $PSNR_NAI_STDT_AR[1];
				 $data['PSNR_NAI_STDT3'] = $PSNR_NAI_STDT_AR[2];
				 
				 $PSNR_NAI_EDDT_AR = explode('-',$reqDataList[0]->PSNR_NAI_EDDT == null ? '--' : $reqDataList[0]->PSNR_NAI_EDDT);
				 $data['PSNR_NAI_EDDT1'] = $PSNR_NAI_EDDT_AR[0];
				 $data['PSNR_NAI_EDDT2'] = $PSNR_NAI_EDDT_AR[1];
				 $data['PSNR_NAI_EDDT3'] = $PSNR_NAI_EDDT_AR[2];
				 
				 $SCHL_STDT_AR = explode('-',$reqDataList[0]->SCHL_STDT == null ? '--' : $reqDataList[0]->SCHL_STDT);
				 $data['SCHL_STDT1'] = $SCHL_STDT_AR[0];
				 $data['SCHL_STDT2'] = $SCHL_STDT_AR[1];
				 
				 $data['SCHL_SCT_CD'] = $reqDataList[0]->SCHL_SCT_CD;
				 $data['SCHL_SCORE_TP'] = $reqDataList[0]->SCHL_SCORE_TP;
				 $data['SCHL_SCORE'] = $reqDataList[0]->SCHL_SCORE;
				 
				 $ARMY_STDT_AR = explode('-',$reqDataList[0]->ARMY_STDT == null ? '--' : $reqDataList[0]->ARMY_STDT);
				 $data['ARMY_STDT1'] = $ARMY_STDT_AR[0];
				 $data['ARMY_STDT2'] = $ARMY_STDT_AR[1];
				 $data['ARMY_STDT3'] = $ARMY_STDT_AR[2];
				 
			}
			
			// 자격요건이 있는거면 
			// 해당 자격요건과 연결된 모집분야를 리스트업한다.
			$data['SAME_UNIT_LIST'] = null;
			$reqUnitListString = null;
			$reqUnitListAr = array();
			if ($REQ_IDX != '')
			{
				$res = $this->reqmdl->getUnitRequireSameList(array($PRJ_IDX,$REQ_IDX,'N'));
				foreach ($res->result() as $key => $reqUnitList)
				{
					$reqUnitListAr[] = $reqUnitList->UNIT_IDX;
				}
				
				$data['SAME_UNIT_LIST'] = implode('|',$reqUnitListAr);
				
			}
			
			
			
			/* 관련 모집분야 리스트업 */
			$unitRs = $this->unit->getUnitLeafNodeList(array($PRJ_IDX,'N',$PRJ_IDX,'N'));
			$unitObj = array();
			foreach ($unitRs->result() as $key => $unitList)
			{
				$unitObj[] = array($unitList->UNIT_IDX,$unitList->PATH);
			}
		
			// 자격요건은 이력서 폼에 의해서 최초 모양이 만들어진다.
			$res = $this->reqmdl->getResumeFormList(array($COMP_ID,$PRJ_IDX,$RSM_IDX,'N'));
			//var_dump($res->result());
			$data['rsmDataUseYn'] = $res->result();
			
			$this->formbox->setId('UNIT_IDX');
			$this->formbox->setName('UNIT_IDX');
			$this->formbox->setOption('onchange="javascript:selectUnitList(this);"');
			$data['SELECTBOX_UNIT_IDX'] = $this->formbox->getSelectBox($unitObj, '모집분야 선택' , $UNIT_IDX , $objType = 'array');
		
			$this->formbox->setId('SELECTED_UNIT_LIST');
			$this->formbox->setName('SELECTED_UNIT_LIST[]');
			$this->formbox->setOption('multiple="multiple"');
			$data['SELECTBOX_SELECTED_UNIT_LIST'] = $this->formbox->getSelectBox($unitObj, NULL , '', $objType = 'array');
			
			
			
			//신상정보 사용하면 노출
			if ($data['rsmDataUseYn'][0]->PERSONAL_USE_YN == 'Y')
			{
				
			}
			
			//학력사항을 사용하면 노출
			if ($data['rsmDataUseYn'][0]->SCHOOL_USE_YN == 'Y')
			{
				
				$res = $this->reqmdl->getCodeList(array('SCG','Y','N'));
				$this->formbox->setId('SCHL_SCORE_TP');
				$this->formbox->setName('SCHL_SCORE_TP');
				$this->formbox->setOption('');
				$data['SELECTBOX_SCHL_SCORE_TP'] = $this->formbox->getSelectBox($res->result(), '학력/학부선택' , $data['SCHL_SCORE_TP'] , $objType = 'db');
				
				//기준학력
				$res = $this->reqmdl->getCodeList(array('SCT','Y','N'));
				$this->formbox->setId('SCT_CD');
				$this->formbox->setName('SCT_CD');
				$this->formbox->setOption('');
				$data['SELECTBOX_SCT_CD'] = $this->formbox->getSelectBox($res->result(), '기준학력선택' , $data['SCHL_SCT_CD'] , $objType = 'db');
			}
			
			//어학시험항목을 사용하면 노출
			if ($data['rsmDataUseYn'][0]->LANGUAGE_USE_YN == 'Y')
			{
				$resLan1 = $this->reqmdl->getResumeFormLanguageList(array($RSM_IDX,'N','N',$REQ_IDX,'N'));
				$data['rsmDataLanguage'] = $resLan1->result();
				
				foreach ($data['rsmDataLanguage'] as $key => $lanList)
				{
					$data['LAN_STDT1_' . ($key+1)] = null;
					$data['LAN_STDT2_' . ($key+1)] = null;
					$data['LAN_STDT3_' . ($key+1)] = null;
					
					$data['LAN_EDDT1_' . ($key+1)] = null;
					$data['LAN_EDDT2_' . ($key+1)] = null;
					$data['LAN_EDDT3_' . ($key+1)] = null;
					
					$data['SCORE_TP_' . ($key+1)] = $lanList->SCORE_TP_NUM;
					$data['SELECTBOX_LAN_LVL_IDX_' . ($key+1)] = '';
					
					
					
					if (preg_match('/^14|15$/', $lanList->SCORE_TP)) // 코드가 등급코드일경우 리스트를 뽑아오기
					{
						$subRs = $this->reqmdl->getLanguageLevelList(array($lanList->LAN_IDX,'N'));
						if ($subRs->num_rows() > 0)
						{
							/* 등록된 어학시험 기간 데이터 */
							$LAN_STDT_AR = explode('-',$lanList->LAN_STDT);
							$LAN_EDDT_AR = explode('-',$lanList->LAN_EDDT);
							
							if ( count($LAN_STDT_AR) == 3 )
							{
								$data['LAN_STDT1_' . ($key+1)] = $LAN_STDT_AR[0];
								$data['LAN_STDT2_' . ($key+1)] = $LAN_STDT_AR[1];
								$data['LAN_STDT3_' . ($key+1)] = $LAN_STDT_AR[2];
							}
							
							if ( count($LAN_EDDT_AR) == 3 )
							{
								$data['LAN_EDDT1_' . ($key+1)] = $LAN_EDDT_AR[0];
								$data['LAN_EDDT2_' . ($key+1)] = $LAN_EDDT_AR[1];
								$data['LAN_EDDT3_' . ($key+1)] = $LAN_EDDT_AR[2];
							}
							
							$this->formbox->setId('LAN_LVL_IDX_' . ($key+1));
							$this->formbox->setName('LAN_LVL_IDX_' . ($key+1));
							$this->formbox->setOption('');
							$data['SELECTBOX_LAN_LVL_IDX_' . ($key+1)] = $this->formbox->getSelectBox($subRs->result(), '등급' , $lanList->LAN_LVL_IDX , $objType = 'db');
						}
					}
				
				}
			
			}
			
			$this->popView('admin/require/requireManager_form' , $data);
		}
		
		//자격요건등록 수정
		//관련 모집분야 연결
		function requireProcess()
		{
			$this->load->model('admin/require/requiremanagement_model','reqmdl',true);
			// 기본옵션
			$PRJ_IDX = $this->input->post('PRJ_IDX');
			$RSM_IDX = $this->input->post('RSM_IDX');
			$UNIT_IDX = $this->input->post('UNIT_IDX');
			$SELECTED_UNIT_LIST = $this->input->post('SELECTED_UNIT_LIST');
			
			$SELECTED_UNIT_LIST_AR = !$SELECTED_UNIT_LIST ? NULL : implode('|',$SELECTED_UNIT_LIST);
			
			// 신상정보 변수
			$PSNR_NAI_STDT1 = $this->input->post('PSNR_NAI_STDT1');
			$PSNR_NAI_STDT2 = $this->input->post('PSNR_NAI_STDT2');
			$PSNR_NAI_STDT3 = $this->input->post('PSNR_NAI_STDT3');
			$PSNR_NAI_STDT = null;
			if ($PSNR_NAI_STDT1 != '' && $PSNR_NAI_STDT2 != '' && $PSNR_NAI_STDT3 != '') $PSNR_NAI_STDT = $PSNR_NAI_STDT1 . '-' . $PSNR_NAI_STDT2 . '-' . $PSNR_NAI_STDT3;
			
			$PSNR_NAI_EDDT1 = $this->input->post('PSNR_NAI_EDDT1');
			$PSNR_NAI_EDDT2 = $this->input->post('PSNR_NAI_EDDT2');
			$PSNR_NAI_EDDT3 = $this->input->post('PSNR_NAI_EDDT3');
			$PSNR_NAI_EDDT = null;
			if ($PSNR_NAI_EDDT1 != '' && $PSNR_NAI_EDDT2 != '' && $PSNR_NAI_EDDT3 != '') $PSNR_NAI_EDDT = $PSNR_NAI_EDDT1 . '-' . $PSNR_NAI_EDDT2 . '-' . $PSNR_NAI_EDDT3;
			
			// 학력사항 변수
			$SCHL_STDT1 = $this->input->post('SCHL_STDT1');
			$SCHL_STDT2 = $this->input->post('SCHL_STDT2');
			
			$SCHL_STDT = null;
			if ($SCHL_STDT1 != '' && $SCHL_STDT2 != '') $SCHL_STDT = $SCHL_STDT1 . '-' . $SCHL_STDT2 . '-10';
			
			$SCT_CD = $this->input->post('SCT_CD');
			
			$SCHL_SCORE_TP = $this->input->post('SCHL_SCORE_TP');
			$SCHL_SCORE = $this->input->post('SCHL_SCORE');
			
			// 군대사항 변수
			$ARMY_STDT1 = $this->input->post('ARMY_STDT1');
			$ARMY_STDT2 = $this->input->post('ARMY_STDT2');
			$ARMY_STDT3 = $this->input->post('ARMY_STDT3');
			$ARMY_STDT = null;
			if ($ARMY_STDT1 != '' && $ARMY_STDT2 != '' && $ARMY_STDT3 != '') $ARMY_STDT = $ARMY_STDT1 . '-' . $ARMY_STDT2 . '-' . $ARMY_STDT3;
			
			/*
			어학시험 변수들
			LAN_IDX_
			
			LANGUAGE_LIST_COUNT // 어학시험 카운트
			LAN_LVL_IDX_ // 등급
			SCORE_TP_ // 점수
			LAN_IDX_ // IDX
			LAN_STDT1_ //이후일
			LAN_EDDT1_ //이전일
			*/
			
			
			$LANGUAGE_OBJ = array();
			
			$LANGUAGE_LIST_COUNT = $this->input->post('LANGUAGE_LIST_COUNT');
			
			
			
			//자격요건 코드 가져오기 - 만약에 없으면 새로 등록
			//echo $SELECTED_UNIT_LIST_AR;
			//exit;
			$obj = array();
			$obj['P_PRJ_IDX'] = $PRJ_IDX;
			$obj['P_RSM_IDX'] = $RSM_IDX;
			$obj['P_UNIT_IDX'] = $UNIT_IDX;
			$obj['P_SELECTED_UNIT_LIST'] = $SELECTED_UNIT_LIST_AR;
			$obj['P_PSNR_NAI_STDT'] = $PSNR_NAI_STDT;
			$obj['P_PSNR_NAI_EDDT'] = $PSNR_NAI_EDDT;
			$obj['P_SCHL_STDT'] = $SCHL_STDT;
			$obj['P_SCT_CD'] = $SCT_CD;
			$obj['P_SCHL_SCORE_TP'] = $SCHL_SCORE_TP;
			$obj['P_SCHL_SCORE'] = $SCHL_SCORE;
			$obj['P_ARMY_STDT'] = $ARMY_STDT;
			//var_dump($obj);
			$res = $this->reqmdl->getUnitRequireUpdate($obj);
			//var_dump($res);
			//exit;
			$REQ_IDX = $res[0]['REQ_IDX'];
			//echo $REQ_IDX;
			//exit;
			//$REQ_IDX = $rdata[0]->REQ_IDX;
			//echo $LANGUAGE_LIST_COUNT;
			//exit;
			for ($a = 1; $a <= $LANGUAGE_LIST_COUNT; $a++)
			{
				${'LAN_IDX_' . $a} = $this->input->post('LAN_IDX_' . $a);
				
				${'LAN_STDT1_' . $a} = $this->input->post('LAN_STDT1_' . $a);
				${'LAN_STDT2_' . $a} = $this->input->post('LAN_STDT2_' . $a);
				${'LAN_STDT3_' . $a} = $this->input->post('LAN_STDT3_' . $a);
				
				${'LAN_STDT_' . $a} = null;
				if (${'LAN_STDT1_' . $a} != '' && ${'LAN_STDT2_' . $a} != '' && ${'LAN_STDT3_' . $a} != '') 
				${'LAN_STDT_' . $a} = ${'LAN_STDT1_' . $a} . '-' . ${'LAN_STDT2_' . $a} . '-' . ${'LAN_STDT3_' . $a};
				
				${'LAN_EDDT1_' . $a} = $this->input->post('LAN_EDDT1_' . $a);
				${'LAN_EDDT2_' . $a} = $this->input->post('LAN_EDDT2_' . $a);
				${'LAN_EDDT3_' . $a} = $this->input->post('LAN_EDDT3_' . $a);
				
				${'LAN_EDDT_' . $a} = null;
				if (${'LAN_EDDT1_' . $a} != '' && ${'LAN_EDDT2_' . $a} != '' && ${'LAN_EDDT3_' . $a} != '') 
				${'LAN_EDDT_' . $a} = ${'LAN_EDDT1_' . $a} . '-' . ${'LAN_EDDT2_' . $a} . '-' . ${'LAN_EDDT3_' . $a};
				
				${'LAN_LVL_IDX_' . $a} = $this->input->post('LAN_LVL_IDX_' . $a);
				${'SCORE_TP_' . $a} = $this->input->post('SCORE_TP_' . $a);
				//echo ${'LAN_STDT1_' . $a} . '-' . ${'LAN_STDT2_' . $a} . '-' . ${'LAN_STDT3_' . $a};
				///echo '<br>';
				//echo ${'LAN_STDT_' . $a};
				//exit;
				
				$res = $this->reqmdl->getUnitRequireLanguageUpdate(array($REQ_IDX,${'LAN_IDX_' . $a},${'LAN_STDT_' . $a},${'LAN_EDDT_' . $a},!${'SCORE_TP_' . $a} ? NULL : ${'SCORE_TP_' . $a},!${'LAN_LVL_IDX_' . $a} ? NULL : ${'LAN_LVL_IDX_' . $a},$REQ_IDX,${'LAN_IDX_' . $a},${'LAN_STDT_' . $a},${'LAN_EDDT_' . $a},!${'SCORE_TP_' . $a} ? NULL : ${'SCORE_TP_' . $a},!${'LAN_LVL_IDX_' . $a} ? NULL : ${'LAN_LVL_IDX_' . $a} ));
				
			}
			$data = null;
			$data['PRJ_IDX'] = $PRJ_IDX;
			$data['RSM_IDX'] = $RSM_IDX;
			$data['UNIT_IDX'] = $UNIT_IDX;
			$this->popView('admin/require/requireManager_process' , $data);
			
		}
		
	}