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
			
			/* �ش� �����о߿� �ش� �̷¼���İ� ��ġ�ϴ� �ڰݿ�� ������ �ε� -������ ������� */
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
			
			// �ڰݿ���� �ִ°Ÿ� 
			// �ش� �ڰݿ�ǰ� ����� �����о߸� ����Ʈ���Ѵ�.
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
			
			
			
			/* ���� �����о� ����Ʈ�� */
			$unitRs = $this->unit->getUnitLeafNodeList(array($PRJ_IDX,'N',$PRJ_IDX,'N'));
			$unitObj = array();
			foreach ($unitRs->result() as $key => $unitList)
			{
				$unitObj[] = array($unitList->UNIT_IDX,$unitList->PATH);
			}
		
			// �ڰݿ���� �̷¼� ���� ���ؼ� ���� ����� ���������.
			$res = $this->reqmdl->getResumeFormList(array($COMP_ID,$PRJ_IDX,$RSM_IDX,'N'));
			//var_dump($res->result());
			$data['rsmDataUseYn'] = $res->result();
			
			$this->formbox->setId('UNIT_IDX');
			$this->formbox->setName('UNIT_IDX');
			$this->formbox->setOption('onchange="javascript:selectUnitList(this);"');
			$data['SELECTBOX_UNIT_IDX'] = $this->formbox->getSelectBox($unitObj, '�����о� ����' , $UNIT_IDX , $objType = 'array');
		
			$this->formbox->setId('SELECTED_UNIT_LIST');
			$this->formbox->setName('SELECTED_UNIT_LIST[]');
			$this->formbox->setOption('multiple="multiple"');
			$data['SELECTBOX_SELECTED_UNIT_LIST'] = $this->formbox->getSelectBox($unitObj, NULL , '', $objType = 'array');
			
			
			
			//�Ż����� ����ϸ� ����
			if ($data['rsmDataUseYn'][0]->PERSONAL_USE_YN == 'Y')
			{
				
			}
			
			//�з»����� ����ϸ� ����
			if ($data['rsmDataUseYn'][0]->SCHOOL_USE_YN == 'Y')
			{
				
				$res = $this->reqmdl->getCodeList(array('SCG','Y','N'));
				$this->formbox->setId('SCHL_SCORE_TP');
				$this->formbox->setName('SCHL_SCORE_TP');
				$this->formbox->setOption('');
				$data['SELECTBOX_SCHL_SCORE_TP'] = $this->formbox->getSelectBox($res->result(), '�з�/�кμ���' , $data['SCHL_SCORE_TP'] , $objType = 'db');
				
				//�����з�
				$res = $this->reqmdl->getCodeList(array('SCT','Y','N'));
				$this->formbox->setId('SCT_CD');
				$this->formbox->setName('SCT_CD');
				$this->formbox->setOption('');
				$data['SELECTBOX_SCT_CD'] = $this->formbox->getSelectBox($res->result(), '�����з¼���' , $data['SCHL_SCT_CD'] , $objType = 'db');
			}
			
			//���н����׸��� ����ϸ� ����
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
					
					
					
					if (preg_match('/^14|15$/', $lanList->SCORE_TP)) // �ڵ尡 ����ڵ��ϰ�� ����Ʈ�� �̾ƿ���
					{
						$subRs = $this->reqmdl->getLanguageLevelList(array($lanList->LAN_IDX,'N'));
						if ($subRs->num_rows() > 0)
						{
							/* ��ϵ� ���н��� �Ⱓ ������ */
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
							$data['SELECTBOX_LAN_LVL_IDX_' . ($key+1)] = $this->formbox->getSelectBox($subRs->result(), '���' , $lanList->LAN_LVL_IDX , $objType = 'db');
						}
					}
				
				}
			
			}
			
			$this->popView('admin/require/requireManager_form' , $data);
		}
		
		//�ڰݿ�ǵ�� ����
		//���� �����о� ����
		function requireProcess()
		{
			$this->load->model('admin/require/requiremanagement_model','reqmdl',true);
			// �⺻�ɼ�
			$PRJ_IDX = $this->input->post('PRJ_IDX');
			$RSM_IDX = $this->input->post('RSM_IDX');
			$UNIT_IDX = $this->input->post('UNIT_IDX');
			$SELECTED_UNIT_LIST = $this->input->post('SELECTED_UNIT_LIST');
			
			$SELECTED_UNIT_LIST_AR = !$SELECTED_UNIT_LIST ? NULL : implode('|',$SELECTED_UNIT_LIST);
			
			// �Ż����� ����
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
			
			// �з»��� ����
			$SCHL_STDT1 = $this->input->post('SCHL_STDT1');
			$SCHL_STDT2 = $this->input->post('SCHL_STDT2');
			
			$SCHL_STDT = null;
			if ($SCHL_STDT1 != '' && $SCHL_STDT2 != '') $SCHL_STDT = $SCHL_STDT1 . '-' . $SCHL_STDT2 . '-10';
			
			$SCT_CD = $this->input->post('SCT_CD');
			
			$SCHL_SCORE_TP = $this->input->post('SCHL_SCORE_TP');
			$SCHL_SCORE = $this->input->post('SCHL_SCORE');
			
			// ������� ����
			$ARMY_STDT1 = $this->input->post('ARMY_STDT1');
			$ARMY_STDT2 = $this->input->post('ARMY_STDT2');
			$ARMY_STDT3 = $this->input->post('ARMY_STDT3');
			$ARMY_STDT = null;
			if ($ARMY_STDT1 != '' && $ARMY_STDT2 != '' && $ARMY_STDT3 != '') $ARMY_STDT = $ARMY_STDT1 . '-' . $ARMY_STDT2 . '-' . $ARMY_STDT3;
			
			/*
			���н��� ������
			LAN_IDX_
			
			LANGUAGE_LIST_COUNT // ���н��� ī��Ʈ
			LAN_LVL_IDX_ // ���
			SCORE_TP_ // ����
			LAN_IDX_ // IDX
			LAN_STDT1_ //������
			LAN_EDDT1_ //������
			*/
			
			
			$LANGUAGE_OBJ = array();
			
			$LANGUAGE_LIST_COUNT = $this->input->post('LANGUAGE_LIST_COUNT');
			
			
			
			//�ڰݿ�� �ڵ� �������� - ���࿡ ������ ���� ���
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