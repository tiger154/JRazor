<?
	class Apply extends MY_Controller
	{
		
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
		
		function Index()
		{
			
			$this->load->model('front/apply/resumeform_model','rmf',true);
			$this->load->model('admin/step/stepManagement_model','unit',true);
			
			// library
			
			$this->load->library('DataControl'); 
			$this->load->library('AuthFront');
			$this->load->library('FormBox'); 
			
			// �̷¼� ��� ������ 
			$this->load->model('front/common/sitecontent_model','site',true);
			$res = $this->site->getContentView(HOSTID,'front_resume_top');
			$rs = $res->result();
			$data['front_resume_top'] = String2Html($rs[0]->DFC_CNTNT);
			
			// default val
			$PRJ_IDX = $this->input->post('PRJ_IDX');
			$RECV_DI = $this->input->post('RECV_DI');
			$RECV_DI = !trim($RECV_DI) ? $this->authfront->getUserApplyDI() : $RECV_DI;
			$ADMIN_FLAG = $this->input->post('ADMIN_FLAG');
			$data['ADMIN_FLAG'] = $ADMIN_FLAG;
			$data['APPLY_NO'] = null;
			// ������ ��� �ϰ�� (üũ�ѹ� ���ֽð�)
			if ($ADMIN_FLAG != '')
			{
				$PRJ_IDX = $this->input->post('SPRJ_IDX');
				$APPLY_NO = $this->input->post('APPLY_NO');
				$data['APPLY_NO'] = $APPLY_NO;	
				$res = $this->unit->getProjectPassCode(array($PRJ_IDX));
				$rdata = $res->result();
				if ( $rdata[0]->PASSWD != base64_decode($ADMIN_FLAG) )
				{
					jsalertmsg('������ ������ �̻��� ���� ���밡�����⿡ �����Ͽ����ϴ�.');
					winclose('on');
					exit;	
				}
				//�����ڸ�� üũ�� apply_no�� �̿��ؼ� RECV_DI ���� ��������
				$di_res = $this->rmf->getRecvDiInfo(array($PRJ_IDX,$APPLY_NO));
				if ($di_res->num_rows() == 1)
				{
					$rdata = $di_res->result();
					$RECV_DI = $rdata[0]->AUTH_DI;
				}
			}
			
			
			if ( $this->ApplyDateCheck($PRJ_IDX) == 'OFF' )
			{
				if ($ADMIN_FLAG != '')
				{
					// �� �����ڿ� �Ծ��	
				}
				else
				{
					jsalertmsg('�ش� ä������� ���� ������ �����Ǿ����ϴ�');
					jsredirect('/front/mypage');
					exit;
				}
			}
		
			$mainrs = $this->rmf->getApplyFormLoginList(array('N',$PRJ_IDX,$RECV_DI,'N'));
			$mRs = $mainrs->result();
			$RESUME_IDX = null;
			$APPL_IDX = null;
			$APPL_YN = null;
				
			
			if ($mainrs->num_rows() == 1)
			{
				$APPL_YN 			= $mRs[0]->APPL_YN;
				$RESUME_IDX 	= $mRs[0]->RSM_IDX;
				$APPL_IDX 		= $mRs[0]->APPL_IDX;
			}
			else
			{
				redirect('/front/login/UserLogin');
				exit;
			}
			
			$data['cmtData'] = null;
			$resComment = $this->rmf->getCommentList(array($RESUME_IDX));
			if ($resComment->num_rows() > 0)
			{
				$data['cmtData'] = $resComment->result();
			}
			else
			{
				
			}
			
			$data['APPL_YN'] = $APPL_YN;
			$data['PRJ_IDX'] = $PRJ_IDX;
			$data['RSM_IDX'] = $RESUME_IDX;
			$data['APPL_IDX'] = $APPL_IDX;
			// set - db
			// �ڱ�Ұ� - �ؽ�Ʈ ������
			
			// ���Ŀ� ���� �����о� �۾��� �������� - �׷��� ���ǵǴ� ���µ� �׿� �°� �ٲ�����. �մ�� �� �����.
			$unitRs = $this->unit->getUnitLeafNodeList(array($PRJ_IDX,'N',$PRJ_IDX,'N'));
			$applyUnitRs = $this->rmf->getApplyUnitList(array($PRJ_IDX,$APPL_IDX,'N'));
			
			$myUnitCdList = array();
			$myUnitCd = null;
			if ($applyUnitRs->num_rows() > 0)
			{
				$myUnitCdList = $applyUnitRs->result();
				$myUnitCd = $myUnitCdList[0]->UNIT_IDX;
			}
			
			
			$unitObj = array();
			foreach ($unitRs->result() as $key => $unitList)
			{
				$unitObj[] = array($unitList->UNIT_IDX,$unitList->PATH);
			}
			
			$this->formbox->setId('UNIT_IDX1');
			$this->formbox->setName('UNIT_IDX1');
			$this->formbox->setOption('onchange="javascript:getWorkPlaceList(this.id);"');
			$data['SELECTBOX_UNIT_IDX1'] = $this->formbox->getSelectBox($unitObj, '�����о� ����' , $myUnitCd , $objType = 'array');
			
			$res = $this->rmf->getApplyUserData(array($PRJ_IDX,$APPL_IDX,'N','N'));
			$applData = $res->result();
			
			foreach ($applData[0] as $key => $applDataList)
			{
				$data[$key] = $applDataList;
			}
			
			$data['PHOTO_URL'] = APPLY_PHOTO_URL .'/'. $PRJ_IDX .'/'. $APPL_IDX .'.jpg';
			
			$BIRTH_DT_AR = explode('-',$applData[0]->BIRTH_DT);
			$data['BIRTH_DT1'] = $BIRTH_DT_AR[0];
			$data['BIRTH_DT2'] = $BIRTH_DT_AR[1];
			$data['BIRTH_DT3'] = $BIRTH_DT_AR[2];
		
			$TEL_AR = explode('-',$applData[0]->TEL);
			if ( count($TEL_AR) != 3 ) $TEL_AR = array('','','');
			
			
			$data['TEL1'] = $TEL_AR[0];
			$data['TEL2'] = $TEL_AR[1];
			$data['TEL3'] = $TEL_AR[2];
			
			$HTEL_AR = explode('-',$applData[0]->HTEL);
			if ( count($HTEL_AR) != 3 ) $HTEL_AR = array('','','');
			
			$data['HTEL1'] = $HTEL_AR[0];
			$data['HTEL2'] = $HTEL_AR[1];
			$data['HTEL3'] = $HTEL_AR[2];
			
			$ARMY_STDT_AR = explode('-',$applData[0]->ARMY_STDT);
			if ( count($ARMY_STDT_AR) != 3 ) $ARMY_STDT_AR = array('','','');
			
			$data['ARMY_STDT1'] = $ARMY_STDT_AR[0];
			$data['ARMY_STDT2'] = $ARMY_STDT_AR[1];
			$data['ARMY_STDT3'] = $ARMY_STDT_AR[2];
			
			$ARMY_EDDT_AR = explode('-',$applData[0]->ARMY_EDDT);
			if ( count($ARMY_EDDT_AR) != 3 ) $ARMY_EDDT_AR = array('','','');
			
			$data['ARMY_EDDT1'] = $ARMY_EDDT_AR[0];
			$data['ARMY_EDDT2'] = $ARMY_EDDT_AR[1];
			$data['ARMY_EDDT3'] = $ARMY_EDDT_AR[2];
			
			// �̷¼� ��з� �׸��� �����ִ� ����
			$res = $this->rmf->getResumeFormDisplayYNList(array($PRJ_IDX,$RESUME_IDX,'N'));
			$data['rsmdisplay'] = $res->result();
			
			
			// �������� ������ select box ����
			$data['fmlyRs'] = null;
			if ($data['rsmdisplay'][0]->FAMILY_USE_YN == 'Y')
			{
				$fmlyres = $this->rmf->getApplyUserDataFamily(array($PRJ_IDX,$APPL_IDX,'N'));
				$data['fmlyRs'] = $fmlyres->result();
				
				// ��������
				/* �̰� ���ÿ��� ����ҿ뵵 �̹Ƿ� �� �ֶ� */
				$this->formbox->setId('FMLY_REL_CD');
				$this->formbox->setName('FMLY_REL_CD');
				$this->formbox->setOption('');
				$data['frmFMLY_REL_CD'] = $this->formbox->getSelectBox($this->datacontrol->getFile2Array('FAMILY_REL.txt'), '����' , '' , $objType = 'array');	
				
				$this->formbox->setId('FMLY_SCH_CD');
				$this->formbox->setName('FMLY_SCH_CD');
				$this->formbox->setOption('');
				$data['frmFMLY_SCH_CD'] = $this->formbox->getSelectBox($this->datacontrol->getFile2Array('FAMILY_SCH.txt'), '����' , '' , $objType = 'array');	
				
				$this->formbox->setId('FMLY_LIVE_YN');
				$this->formbox->setName('FMLY_LIVE_YN');
				$this->formbox->setOption('');
				$data['frmFMLY_LIVE_YN'] = $this->formbox->getSelectBox(array(array('Y','Y'),array('N','N')), '����' , '' , $objType = 'array');	
				
				$this->formbox->setId('FMLY_HELP_YN');
				$this->formbox->setName('FMLY_HELP_YN');
				$this->formbox->setOption('');
				$data['frmFMLY_HELP_YN'] = $this->formbox->getSelectBox(array(array('Y','Y'),array('N','N')), '����' , '' , $objType = 'array');	
				
				/* �ε嵥���Ϳ� ���� ����Ʈ �ڽ� */
				foreach ($data['fmlyRs'] as $key => $fmlyList)
				{
					$fmlyIdx = $key + 1;
					$this->formbox->setId('FMLY_REL_CD_' . $fmlyIdx);
					$this->formbox->setName('FMLY_REL_CD_' . $fmlyIdx);
					$this->formbox->setOption('');
					$data['frmFMLY_REL_CD_' . $fmlyIdx] = $this->formbox->getSelectBox($this->datacontrol->getFile2Array('FAMILY_REL.txt'), '����' , $fmlyList->FMLY_REL_CD , $objType = 'array');	
					
					$this->formbox->setId('FMLY_SCH_CD_' . $fmlyIdx);
					$this->formbox->setName('FMLY_SCH_CD_' . $fmlyIdx);
					$this->formbox->setOption('');
					$data['frmFMLY_SCH_CD_' . $fmlyIdx] = $this->formbox->getSelectBox($this->datacontrol->getFile2Array('FAMILY_SCH.txt'), '����' , $fmlyList->FMLY_SCH_CD , $objType = 'array');	
					
					$this->formbox->setId('FMLY_LIVE_YN_' . $fmlyIdx);
					$this->formbox->setName('FMLY_LIVE_YN_' . $fmlyIdx);
					$this->formbox->setOption('');
					$data['frmFMLY_LIVE_YN_' . $fmlyIdx] = $this->formbox->getSelectBox(array(array('Y','Y'),array('N','N')), '����' , $fmlyList->FMLY_LIVE_YN , $objType = 'array');	
					
					$this->formbox->setId('FMLY_HELP_YN_' . $fmlyIdx);
					$this->formbox->setName('FMLY_HELP_YN_' . $fmlyIdx);
					$this->formbox->setOption('');
					$data['frmFMLY_HELP_YN_' . $fmlyIdx] = $this->formbox->getSelectBox(array(array('Y','Y'),array('N','N')), '����' , $fmlyList->FMLY_HELP_YN , $objType = 'array');
				}
				
			}
			
			// ��»��� ������ select box ����
			$data['carrRs'] = null;
			if ($data['rsmdisplay'][0]->CAREER_USE_YN == 'Y')
			{
				$carrres = $this->rmf->getApplyUserDataCareer(array($PRJ_IDX,$APPL_IDX,'N'));
				$data['carrRs'] = $carrres->result();
				
				//�¾�
				$crSubres = $this->rmf->getCareerSetList(array($RESUME_IDX,'N'));
				$data['careerDisplayType'] = $crSubres->result();
				
				$empTypeRs = $this->rmf->getCareerEmployTypeList(array('CIT',NULL,NULL,'N','N'));
				
				
				
				// ��»���
				/* �̰� ���� */
				// ������� ( ū������ ���������� )
				$this->formbox->setId('CAREER_EMP_TP_CD');
				$this->formbox->setName('CAREER_EMP_TP_CD');
				$this->formbox->setOption('');
				$data['frmCAREER_EMP_TP_CD'] = $this->formbox->getSelectBox($empTypeRs->result(), '�������' , '' , $objType = 'db');		
				
				$this->formbox->setId('CAREER_CMP_TP_CD');
				$this->formbox->setName('CAREER_CMP_TP_CD');
				$this->formbox->setOption('');
				$data['frmCAREER_CMP_TP_CD'] = $this->formbox->getSelectBox($this->datacontrol->getFile2Array('CAREER_COMPANY_TYPE.txt'), '�������' , '' , $objType = 'array');		
				
				// �������� �������
				$this->formbox->setId('CAREER_STS_CD');
				$this->formbox->setName('CAREER_STS_CD');
				$this->formbox->setOption('');
				$data['frmCAREER_STS_CD'] = $this->formbox->getSelectBox($this->datacontrol->getFile2Array('CAREER_STATUS.txt'), '��������' , '' , $objType = 'array');		
				
				// ����
				$this->formbox->setId('CAREER_PSTN_CD');
				$this->formbox->setName('CAREER_PSTN_CD');
				$this->formbox->setOption('');
				$data['frmCAREER_PSTN_CD'] = $this->formbox->getSelectBox($this->datacontrol->getFile2Array('CAREER_PSTN.txt'), '����' , '' , $objType = 'array');		
				
				// ��å
				$this->formbox->setId('CAREER_PSTN_LVL_CD');
				$this->formbox->setName('CAREER_PSTN_LVL_CD');
				$this->formbox->setOption('');
				$data['frmCAREER_PSTN_LVL_CD'] = $this->formbox->getSelectBox($this->datacontrol->getFile2Array('CAREER_PSTN_LEVEL.txt'), '��å' , '' , $objType = 'array');
				
				// ����� ����־��µ�?
				$this->formbox->setId('CAREER_LOC_CD');
				$this->formbox->setName('CAREER_LOC_CD');
				$this->formbox->setOption('');
				$data['frmCAREER_LOC_CD'] = $this->formbox->getSelectBox($this->datacontrol->getFile2Array('CAREER_LOCATION.txt'), '������' , '' , $objType = 'array');
				
				//������
				$this->formbox->setId('CAREER_RETIRE_CD');
				$this->formbox->setName('CAREER_RETIRE_CD');
				$this->formbox->setOption('');
				$data['frmCAREER_RETIRE_CD'] = $this->formbox->getSelectBox($this->datacontrol->getFile2Array('CAREER_RETIRE_TYPE.txt'), '������' , '' , $objType = 'array');
				
				/* �ε嵥���Ϳ� ���� ����Ʈ �ڽ� */
				foreach ($data['carrRs'] as $key => $carrList)
				{
					$carrIdx = $key + 1;
					
					$this->formbox->setId('CAREER_EMP_TP_CD_' . $carrIdx);
					$this->formbox->setName('CAREER_EMP_TP_CD_' . $carrIdx);
					$this->formbox->setOption('');
					$data['frmCAREER_EMP_TP_CD_' . $carrIdx] = $this->formbox->getSelectBox($empTypeRs->result(), '�������' , $carrList->CAREER_EMP_TP_CD  , $objType = 'db');		
						
					$this->formbox->setId('CAREER_CMP_TP_CD_' . $carrIdx);
					$this->formbox->setName('CAREER_CMP_TP_CD_' . $carrIdx);
					$this->formbox->setOption('');
					$data['frmCAREER_CMP_TP_CD_' . $carrIdx] = $this->formbox->getSelectBox($this->datacontrol->getFile2Array('CAREER_COMPANY_TYPE.txt'), '�������' , $carrList->CAREER_CMP_TP_CD , $objType = 'array');		
					
					// �������� �������
					$this->formbox->setId('CAREER_STS_CD_' . $carrIdx);
					$this->formbox->setName('CAREER_STS_CD_' . $carrIdx);
					$this->formbox->setOption('');
					$data['frmCAREER_STS_CD_' . $carrIdx] = $this->formbox->getSelectBox($this->datacontrol->getFile2Array('CAREER_STATUS.txt'), '��������' , $carrList->CAREER_STS_CD , $objType = 'array');		
					
					// ����
					$this->formbox->setId('CAREER_PSTN_CD_' . $carrIdx);
					$this->formbox->setName('CAREER_PSTN_CD_' . $carrIdx);
					$this->formbox->setOption('');
					
					$data['frmCAREER_PSTN_CD_' . $carrIdx] = $this->formbox->getSelectBox($this->datacontrol->getFile2Array('CAREER_PSTN.txt'), '����' , $carrList->CAREER_PSTN_CD , $objType = 'array');		
					
					// ��å
					$this->formbox->setId('CAREER_PSTN_LVL_CD_' . $carrIdx);
					$this->formbox->setName('CAREER_PSTN_LVL_CD_' . $carrIdx);
					$this->formbox->setOption('');
					
					$data['frmCAREER_PSTN_LVL_CD_' . $carrIdx] = $this->formbox->getSelectBox($this->datacontrol->getFile2Array('CAREER_PSTN_LEVEL.txt'), '��å' , $carrList->CAREER_PSTN_LVL_CD , $objType = 'array');
					
					// ����� ����־��µ�?
					$this->formbox->setId('CAREER_LOC_CD_' . $carrIdx);
					$this->formbox->setName('CAREER_LOC_CD_' . $carrIdx);
					$this->formbox->setOption('');
					$data['frmCAREER_LOC_CD_' . $carrIdx] = $this->formbox->getSelectBox($this->datacontrol->getFile2Array('CAREER_LOCATION.txt'), '������' , $carrList->CAREER_LOC_CD , $objType = 'array');
					
					//������
					$this->formbox->setId('CAREER_RETIRE_CD_' . $carrIdx);
					$this->formbox->setName('CAREER_RETIRE_CD_' . $carrIdx);
					$this->formbox->setOption('');
					$data['frmCAREER_RETIRE_CD_' . $carrIdx] = $this->formbox->getSelectBox($this->datacontrol->getFile2Array('CAREER_RETIRE_TYPE.txt'), '������' , $carrList->CAREER_RETIRE_CD , $objType = 'array');
				}
				
			}
			
			// �������� ������ ����
			$data['wrteRs'] = null;
			if ($data['rsmdisplay'][0]->WRITE_USE_YN == 'Y')
			{
				$wrteres = $this->rmf->getApplyUserDataWrite(array($PRJ_IDX,$APPL_IDX,'N'));
				$data['wrteRs'] = $wrteres->result();
			}
			
			//���Ͼ��ε� ��뿩�� 
			$data['frmFile'] = null;
			if ($data['rsmdisplay'][0]->FILE_USE_YN == 'Y') 
			{ 
				$res = $this->rmf->getFileList(array($RESUME_IDX,'N',$PRJ_IDX,$APPL_IDX,'N'));	
				$data['frmFile'] = $res->result();
			}
			
			// ������� ������ ����
			$data['przeRs'] = null;
			if ($data['rsmdisplay'][0]->PRIZE_USE_YN == 'Y')
			{
				$przres = $this->rmf->getApplyUserDataPrize(array($PRJ_IDX,$APPL_IDX,'N'));
				$data['przeRs'] = $przres->result();
			}
			
			// ���дɷ�2 ������ ����
			$data['lan2Rs'] = null;
			if ($data['rsmdisplay'][0]->LANGUAGE2_USE_YN == 'Y')
			{
				$lan2res = $this->rmf->getApplyUserDataLanguage2(array($PRJ_IDX,$APPL_IDX,'N'));
				$data['lan2Rs'] = $lan2res->result();
				
				/*���� */
				$this->formbox->setId('LANG2_CD');
				$this->formbox->setName('LANG2_CD');
				$this->formbox->setOption('');
				$data['frmLANG2_CD'] = $this->formbox->getSelectBox($this->datacontrol->getFile2Array('LANGUAGE_LIST.txt'), '��޼���' , '' , $objType = 'array');		
				
				$this->formbox->setId('LANG2_SPCH_LVL_CD');
				$this->formbox->setName('LANG2_SPCH_LVL_CD');
				$this->formbox->setOption('');
				$data['frmLANG2_SPCH_LVL_CD'] = $this->formbox->getSelectBox($this->datacontrol->getFile2Array('LEVEL1.txt'), '��޼���' , '' , $objType = 'array');		
				
				$this->formbox->setId('LANG2_WRT_LVL_CD');
				$this->formbox->setName('LANG2_WRT_LVL_CD');
				$this->formbox->setOption('');
				$data['frmLANG2_WRT_LVL_CD'] = $this->formbox->getSelectBox($this->datacontrol->getFile2Array('LEVEL1.txt'), '��޼���' , '' , $objType = 'array');		
				
				$this->formbox->setId('LANG2_CMP_LVL_CD');
				$this->formbox->setName('LANG2_CMP_LVL_CD');
				$this->formbox->setOption('');
				$data['frmLANG2_CMP_LVL_CD'] = $this->formbox->getSelectBox($this->datacontrol->getFile2Array('LEVEL1.txt'), '��޼���' , '' , $objType = 'array');		
				
				/* �ε嵥���Ϳ� ���� ����Ʈ �ڽ� */
				foreach ($data['lan2Rs'] as $key => $lan2List)
				{
					$lan2Idx = $key + 1;
					$this->formbox->setId('LANG2_CD_' . $lan2Idx);
					$this->formbox->setName('LANG2_CD_' . $lan2Idx);
					$this->formbox->setOption('');
					$data['frmLANG2_CD_' . $lan2Idx] = $this->formbox->getSelectBox($this->datacontrol->getFile2Array('LANGUAGE_LIST.txt'), '��޼���' , $lan2List->LANG2_CD , $objType = 'array');		
					
					$this->formbox->setId('LANG2_SPCH_LVL_CD_' . $lan2Idx);
					$this->formbox->setName('LANG2_SPCH_LVL_CD_' . $lan2Idx);
					$this->formbox->setOption('');
					$data['frmLANG2_SPCH_LVL_CD_' . $lan2Idx] = $this->formbox->getSelectBox($this->datacontrol->getFile2Array('LEVEL1.txt'), '��޼���' , $lan2List->LANG2_SPCH_LVL_CD , $objType = 'array');		
					
					$this->formbox->setId('LANG2_WRT_LVL_CD_' . $lan2Idx);
					$this->formbox->setName('LANG2_WRT_LVL_CD_' . $lan2Idx);
					$this->formbox->setOption('');
					$data['frmLANG2_WRT_LVL_CD_' . $lan2Idx] = $this->formbox->getSelectBox($this->datacontrol->getFile2Array('LEVEL1.txt'), '��޼���' , $lan2List->LANG2_WRT_LVL_CD , $objType = 'array');		
					
					$this->formbox->setId('LANG2_CMP_LVL_CD_' . $lan2Idx);
					$this->formbox->setName('LANG2_CMP_LVL_CD_' . $lan2Idx);
					$this->formbox->setOption('');
					$data['frmLANG2_CMP_LVL_CD_' . $lan2Idx] = $this->formbox->getSelectBox($this->datacontrol->getFile2Array('LEVEL1.txt'), '��޼���' , $lan2List->LANG2_CMP_LVL_CD , $objType = 'array');		
				}
				
			}
			
			// �ڰ����� ������ ����
			$data['licRs'] = null;
			if ($data['rsmdisplay'][0]->LICENSE_USE_YN == 'Y')
			{
				$wrteres = $this->rmf->getApplyUserDataLicense(array($PRJ_IDX,$APPL_IDX,'N'));
				$data['licRs'] = $wrteres->result();
			}
			
			// OA ��� ���� - �����׸��̶� ����Ʈ �θ��� �ƿ� �����͵� ���� �����´�.
			$data['frmComputerDataList'] = null;
			if ($data['rsmdisplay'][0]->PC_USE_YN == 'Y')
			{
				$res = $this->rmf->getComputerList(array($RESUME_IDX,'N','N',$PRJ_IDX,$APPL_IDX,'N'));
				$data['frmComputerDataList'] = $res->result();
				
				foreach ($res->result() as $key => $clistData)
				{
					
					$this->formbox->setId('PC_LVL_CD_' . ($key + 1));
					$this->formbox->setName('PC_LVL_CD_'. ($key + 1));
					$this->formbox->setOption('onchange="SelDataSet(\'PC_LVL_CD_' . ($key + 1) . '\',\'PC_LVL_NM_' . ($key + 1) . '\');"');
					$data['frmPC_LVL_CD_' . ($key + 1)] = $this->formbox->getSelectBox($this->datacontrol->getFile2Array('LEVEL1.txt'), '��޼���' , $clistData->LVL_CD , $objType = 'array');		
				}
			}
			
			// �ؿܿ��� �� �ؿܰ���
			$data['srveRs'] = null;
			if ($data['rsmdisplay'][0]->SERVE_USE_YN == 'Y')
			{
				$srveres = $this->rmf->getApplyUserDataServe(array($PRJ_IDX,$APPL_IDX,'N'));
				$data['srveRs'] = $srveres->result();
				//Ȱ������
				/* ���� */
				$this->formbox->setId('SRV_TP_CD');
				$this->formbox->setName('SRV_TP_CD');
				$this->formbox->setOption('');
				$data['frmSRV_TP_CD'] = $this->formbox->getSelectBox($this->datacontrol->getFile2Array('SERVE_TYPE.txt'), 'Ȱ�����м���' , '' , $objType = 'array');	
				
				/* �ε嵥���Ϳ� ���� ����Ʈ �ڽ� */
				foreach ($data['srveRs'] as $key => $srveList)
				{
					$srveIdx = $key + 1;
					$this->formbox->setId('SRV_TP_CD_' . $srveIdx);
					$this->formbox->setName('SRV_TP_CD_' . $srveIdx);
					$this->formbox->setOption('');
					$data['frmSRV_TP_CD_' . $srveIdx] = $this->formbox->getSelectBox($this->datacontrol->getFile2Array('SERVE_TYPE.txt'), 'Ȱ�����м���' , $srveList->SRV_TP_CD , $objType = 'array');		
						
				}
				
			}
			
			// �������
			$data['techRs'] = null;
			if ($data['rsmdisplay'][0]->TECH_USE_YN == 'Y')
			{
				$techres = $this->rmf->getApplyUserDataTech(array($PRJ_IDX,$APPL_IDX,'N'));
				$data['techRs'] = $techres->result();
			}
			
			// ��������
			$data['educRs'] = null;
			if ($data['rsmdisplay'][0]->EDUCATION_USE_YN == 'Y')
			{
				$educres = $this->rmf->getApplyUserDataEducation(array($PRJ_IDX,$APPL_IDX,'N'));
				$data['educRs'] = $educres->result();
			}
			
			// �ֿ�Ȱ���� ��ȸ����
			$data['trngRs'] = null;
			if ($data['rsmdisplay'][0]->TRAINING_USE_YN == 'Y')
			{
				$trngres = $this->rmf->getApplyUserDataTraining(array($PRJ_IDX,$APPL_IDX,'N'));
				$data['trngRs'] = $trngres->result();
				
				//���� ����
				$this->formbox->setId('TRN_TP_CD');
				$this->formbox->setName('TRN_TP_CD');
				$this->formbox->setOption('');
				$data['frmTRN_TP_CD'] = $this->formbox->getSelectBox($this->datacontrol->getFile2Array('TRAINING_TYPE.txt'), '�ؿܰ�������' , '' , $objType = 'array');
				
				/* �ε嵥���Ϳ� ���� ����Ʈ �ڽ� */
				foreach ($data['trngRs'] as $key => $trngList)
				{
					//���� ����
					$trngIdx = $key + 1;
					$this->formbox->setId('TRN_TP_CD_' . $trngIdx);
					$this->formbox->setName('TRN_TP_CD_' . $trngIdx);
					$this->formbox->setOption('');
					$data['frmTRN_TP_CD_' . $trngIdx] = $this->formbox->getSelectBox($this->datacontrol->getFile2Array('TRAINING_TYPE.txt'), '�ؿܰ�������' , $trngList->TRN_TP_CD , $objType = 'array');
				}
			}
			$data['frmContent'] = null;
			if ($data['rsmdisplay'][0]->CONTENT_USE_YN == 'Y') 
			{ 
				$res = $this->rmf->getContentList(array($RESUME_IDX,'N',$PRJ_IDX,$APPL_IDX,'N'));	
				$data['frmContent'] = $res->result();
			}
			
			
			// ����
			$this->formbox->setId('BOHUN_TP_CD');
			$this->formbox->setName('BOHUN_TP_CD');
			$this->formbox->setOption('');
			$tmpArray = array(array('Y','���'),array('N','����'));
			$data['SELECTBOX_BOHUN_TP_CD'] = $this->formbox->getSelectBox($tmpArray, '����' ,$data['BOHUN_TP_CD'] , $objType = 'array');
			
			$this->formbox->setId('BOHUN_SCORE_CD');
			$this->formbox->setName('BOHUN_SCORE_CD');
			$this->formbox->setOption('');
			$tmpArray = array(array('5','5%'),array('10','10%'));
			$data['SELECTBOX_BOHUN_SCORE_CD'] = $this->formbox->getSelectBox($tmpArray, '����' ,$data['BOHUN_SCORE_CD'] , $objType = 'array');
			
			// ����ο���
			$this->formbox->setId('PSN_OBSTACLE_TP_CD');
			$this->formbox->setName('PSN_OBSTACLE_TP_CD');
			$this->formbox->setOption('');
			$tmpArray = array(array('Y','�����'),array('N','�������'));
			$data['SELECTBOX_PSN_OBSTACLE_TP_CD'] = $this->formbox->getSelectBox($tmpArray, '����' , $data['PSN_OBSTACLE_TP_CD'] , $objType = 'array');
			
			$this->formbox->setId('PSN_OBSTACLE_LVL_CD');
			$this->formbox->setName('PSN_OBSTACLE_LVL_CD');
			$this->formbox->setOption('');
			
			$data['SELECTBOX_PSN_OBSTACLE_LVL_CD'] = $this->formbox->getSelectBox($this->datacontrol->getFile2Array('OBSTACLE_LEVEL.txt'), '��޼���' , $data['PSN_OBSTACLE_LVL_CD'] , $objType = 'array');
			
			// ��ȭ
			
			$this->formbox->setId('TEL1');
			$this->formbox->setName('TEL1');
			$this->formbox->setOption('');
			
			$data['SELECTBOX_TEL'] = $this->formbox->getSelectBox($this->datacontrol->getFile2Array('TEL.txt'), '����' , $data['TEL1'] , $objType = 'array');
			
			$this->formbox->setId('HTEL1');
			$this->formbox->setName('HTEL1');
			$this->formbox->setOption('');
			
			$data['SELECTBOX_HTEL'] = $this->formbox->getSelectBox($this->datacontrol->getFile2Array('HTEL.txt'), '����' , $data['HTEL1'] , $objType = 'array');
			
			if ($data['rsmdisplay'][0]->ARMY_USE_YN == 'Y')
			{
	 
				$this->formbox->setId('ARMY_TP_CD');
				$this->formbox->setName('ARMY_TP_CD');
				$this->formbox->setOption('');
				
				$data['SELECTBOX_ARMY_TP_CD'] = $this->formbox->getSelectBox($this->datacontrol->getFile2Array('ARMY_TYPE.txt'), '����' , $data['ARMY_TP_CD'] , $objType = 'array');
				
				$this->formbox->setId('ARMY_LVL_CD');
				$this->formbox->setName('ARMY_LVL_CD');
				$this->formbox->setOption('');
				
				$data['SELECTBOX_ARMY_LVL_CD'] = $this->formbox->getSelectBox($this->datacontrol->getFile2Array('ARMY_LEVEL.txt'), '����' , $data['ARMY_LVL_CD'] , $objType = 'array');
				
				$this->formbox->setId('ARMY_YN_CD');
				$this->formbox->setName('ARMY_YN_CD');
				$this->formbox->setOption('');
				
				$data['SELECTBOX_ARMY_YN_CD'] = $this->formbox->getSelectBox($this->datacontrol->getFile2Array('ARMY_YN.txt'), '����' , $data['ARMY_YN_CD'] , $objType = 'array');
				
				$this->formbox->setId('ARMY_FINISH_CD');
				$this->formbox->setName('ARMY_FINISH_CD');
				$this->formbox->setOption('');
				
				$data['SELECTBOX_ARMY_FINISH_CD'] = $this->formbox->getSelectBox($this->datacontrol->getFile2Array('ARMY_FINISH.txt'), '����' , $data['ARMY_FINISH_CD'] , $objType = 'array');
				
			}
			
			
			// �߿��Ѿ�� - ������������ �ƴ� �����ڿ��� ������ �� ������ ������ �̰�. 
			// ����� ������ ������ �������� �׸��� �����ɽô�.ajax �� ��������� �׽�Ʈ��
			// ���ϰڴ�.
			$data['lanData'] = null;
			if ($data['rsmdisplay'][0]->LANGUAGE_USE_YN == 'Y')
			{
				$res = $this->rmf->getLanguageList(array($RESUME_IDX,'N','N','LNT','N',$PRJ_IDX,$APPL_IDX,'N'));
				$data['lanData'] = $res->result();
				// view���� 1������ �����ϹǷ� 
				foreach ($data['lanData'] as $key => $lanList)
				{
					$data['frmLAN_LVL_IDX_' . ($key+1)] = '';
					if (preg_match('/^14|15$/', $lanList->SCORE_TP)) // �ڵ尡 ����ڵ��ϰ�� ����Ʈ�� �̾ƿ���
					{
						$subRs = $this->rmf->getLanguageLevelList(array($lanList->LAN_IDX,'N'));
						if ($subRs->num_rows() > 0)
						{
							$this->formbox->setId('LAN_LVL_IDX_' . ($key+1));
							$this->formbox->setName('LAN_LVL_IDX_' . ($key+1));
							$this->formbox->setOption('');
							$data['frmLAN_LVL_IDX_' . ($key+1)] = $this->formbox->getSelectBox($subRs->result(), '���' , $lanList->LAN_LVL_IDX , $objType = 'db');
						}
					}
				}
				
			}
			
			
			// �з»��� -- ��� �ִ°��� ���ֺθ��⶧���� �̰� �����ؾ��Ѵ�. ������ ���ϴ� �켱 �����ؼ� �۾�;;;
			if ($data['rsmdisplay'][0]->SCHOOL_USE_YN == 'Y')
			{
				
				$schlres = $this->rmf->getApplyUserDataSchool(array($PRJ_IDX,$APPL_IDX,'N'));
				$data['schlRs'] = $schlres->result();
				
				$data['SCH_SEQ_1'] = null;
				$data['SCH_TP_1'] = null;
				$data['SCH_NM_1'] = null;
				$data['SCH_CD_1'] = null;
				$data['SCH_FGRD_TP_1'] = null;
				$data['SCH_STDT1_1'] = null;
				$data['SCH_STDT2_1'] = null;
				$data['SCH_EDDT1_1'] = null;
				$data['SCH_EDDT2_1'] = null;
				$data['SCH_EDDT3_1'] = null;
				
				if ($schlres->num_rows() > 0)
				{
					foreach ($data['schlRs'][0] as $hkey => $schlHighList)
					{
						//	echo $hkey . '----' . $schlHighList . '<br>';
						$data[$hkey . '_1'] = $schlHighList;	
					}
				}
				
				/*--*/
				//�б����� (�з±���)
				$res = $this->rmf->getCodeList(array('SCT','Y','N'));
				$this->formbox->setId('SCH_TP');
				$this->formbox->setName('SCH_TP');
				$this->formbox->setOption('');
				$data['frmSCH_TP'] = $this->formbox->getSelectBox($res->result(), '�з±��м���' , '' , $objType = 'db');
				
				//�迭 - ����
				$res = $this->rmf->getMajorAffiliationList(array('N'));
				$this->formbox->setId('SCH_AFF');
				$this->formbox->setName('SCH_AFF');
				$this->formbox->setOption('');
				$data['frmSCH_AFF'] = $this->formbox->getSelectBox($res->result(), '�迭����' , '' , $objType = 'db');
				
				//�迭 - ������
				$res = $this->rmf->getMajorAffiliationList(array('N'));
				$this->formbox->setId('SCH_SUB_AFF');
				$this->formbox->setName('SCH_SUB_AFF');
				$this->formbox->setOption('');
				$data['frmSCH_SUB_AFF'] = $this->formbox->getSelectBox($res->result(), '�迭����' , '' , $objType = 'db');
				
				//������
				$res = $this->rmf->getLocationList(array('N'));
				$this->formbox->setId('SCH_LOC');
				$this->formbox->setName('SCH_LOC');
				$this->formbox->setOption('');
				$data['frmSCH_LOC'] = $this->formbox->getSelectBox($res->result(), '������' , '' , $objType = 'db');
				
				//��/�߰�
				$res = $this->rmf->getCodeList(array('JUY','Y','N'));
				$this->formbox->setId('SCH_JUYA');
				$this->formbox->setName('SCH_JUYA');
				$this->formbox->setOption('');
				$data['frmSCH_JUYA'] = $this->formbox->getSelectBox($res->result(), '��/�߰�' , '' , $objType = 'db');
		
				//����/�б�
				$res = $this->rmf->getCodeList(array('BRC','Y','N'));
				$this->formbox->setId('SCH_BRANCH_TP');
				$this->formbox->setName('SCH_BRANCH_TP');
				$this->formbox->setOption('');
				$data['frmSCH_BRANCH_TP'] = $this->formbox->getSelectBox($res->result(), '��������' , '' , $objType = 'db');
				
				//���б��� 
				$res = $this->rmf->getCodeList(array('ET1','Y','N'));
				$this->formbox->setId('SCH_ETTP1');
				$this->formbox->setName('SCH_ETTP1');
				$this->formbox->setOption('');
				$data['frmSCH_ETTP1'] = $this->formbox->getSelectBox($res->result(), '���б���' , '' , $objType = 'db');
				
				//�������� 
				$res = $this->rmf->getCodeList(array('ET2','Y','N'));
				$this->formbox->setId('SCH_ETTP2');
				$this->formbox->setName('SCH_ETTP2');
				$this->formbox->setOption('');
				$data['frmSCH_ETTP2'] = $this->formbox->getSelectBox($res->result(), '��������' , '' , $objType = 'db');
				
				//���� ������ ����
				$res = $this->rmf->getCodeList(array('MJT','Y','N'));
				$this->formbox->setId('SCH_SUB_MAJOR_TP');
				$this->formbox->setName('SCH_SUB_MAJOR_TP');
				$this->formbox->setOption('');
				$data['frmSCH_SUB_MAJOR_TP'] = $this->formbox->getSelectBox($res->result(), '�������з�' , '' , $objType = 'db');
				
				//������� ����
	
				$this->formbox->setId('SCH_MAX_HAKJUM');
				$this->formbox->setName('SCH_MAX_HAKJUM');
				$this->formbox->setOption('');
				$data['frmSCH_MAX_HAKJUM'] = $this->formbox->getSelectBox($this->datacontrol->getFile2Array('HAKJUM.txt'), '����' , '' , $objType = 'array');
				
				/* ����б� �׸��� �̸� ���;��ؼ� */
				// �����Ͱ� ������찡 ����� �Ʒ����� ������ �����ͼ� select �ڽ�����鼭 �������� ���������̴�.
					//������
					$res = $this->rmf->getLocationList(array('N'));
					$this->formbox->setId('SCH_LOC_1');
					$this->formbox->setName('SCH_LOC_1');
					$this->formbox->setOption('');
					$data['frmSCH_LOC_1'] = $this->formbox->getSelectBox($res->result(), '������' , '' , $objType = 'db');
					
					//��/�߰�
					$res = $this->rmf->getCodeList(array('JUY','Y','N'));
					$this->formbox->setId('SCH_JUYA_1');
					$this->formbox->setName('SCH_JUYA_1');
					$this->formbox->setOption('');
					$data['frmSCH_JUYA_1'] = $this->formbox->getSelectBox($res->result(), '��/�߰�' , '' , $objType = 'db');
			
					//����/�б�
					$res = $this->rmf->getCodeList(array('BRC','Y','N'));
					$this->formbox->setId('SCH_BRANCH_TP_1');
					$this->formbox->setName('SCH_BRANCH_TP_1');
					$this->formbox->setOption('');
					$data['frmSCH_BRANCH_TP_1'] = $this->formbox->getSelectBox($res->result(), '��������' , '' , $objType = 'db');
					
					//���б��� 
					$res = $this->rmf->getCodeList(array('ET1','Y','N'));
					$this->formbox->setId('SCH_ETTP1_1');
					$this->formbox->setName('SCH_ETTP1_1');
					$this->formbox->setOption('');
					
					//17	ET1 ����
					$tmpEttp1ar = array();
					foreach ($res->result() as $key => $tmpEttp1List) if ($tmpEttp1List->CODE != '17') $tmpEttp1ar[] = array($tmpEttp1List->CODE , $tmpEttp1List->NAME);
				
					$data['frmSCH_ETTP1_1'] = $this->formbox->getSelectBox($tmpEttp1ar, '���б���' , '' , $objType = 'array');
					
					//�������� 
					$res = $this->rmf->getCodeList(array('ET2','Y','N'));
					$this->formbox->setId('SCH_ETTP2_1');
					$this->formbox->setName('SCH_ETTP2_1');
					$this->formbox->setOption('');
					$data['frmSCH_ETTP2_1'] = $this->formbox->getSelectBox($res->result(), '��������' , '' , $objType = 'db');
					
				/* �ε嵥���Ϳ� ���� ����Ʈ �ڽ� */
				foreach ($data['schlRs'] as $key => $schlList)
				{
					//���� ����
					$schlIdx = $key + 1;
					//�б����� (�з±���)
					$res = $this->rmf->getCodeList(array('SCT','Y','N'));
					$this->formbox->setId('SCH_TP_' . $schlIdx);
					$this->formbox->setName('SCH_TP_' . $schlIdx);
					$this->formbox->setOption('');
					$data['frmSCH_TP_' . $schlIdx] = $this->formbox->getSelectBox($res->result(), '�з±��м���' , $schlList->SCH_TP , $objType = 'db');
					
					//�迭 - ����
					$res = $this->rmf->getMajorAffiliationList(array('N'));
					$this->formbox->setId('SCH_AFF_' . $schlIdx);
					$this->formbox->setName('SCH_AFF_' . $schlIdx);
					$this->formbox->setOption('');
					$data['frmSCH_AFF_' . $schlIdx] = $this->formbox->getSelectBox($res->result(), '�迭����' , $schlList->SCH_AFF , $objType = 'db');
					
					//�迭 - ������
					$res = $this->rmf->getMajorAffiliationList(array('N'));
					$this->formbox->setId('SCH_SUB_AFF_' . $schlIdx);
					$this->formbox->setName('SCH_SUB_AFF_' . $schlIdx);
					$this->formbox->setOption('');
					$data['frmSCH_SUB_AFF_' . $schlIdx] = $this->formbox->getSelectBox($res->result(), '�迭����' , $schlList->SCH_SUB_AFF , $objType = 'db');
					
					//������
					$res = $this->rmf->getLocationList(array('N'));
					$this->formbox->setId('SCH_LOC_' . $schlIdx);
					$this->formbox->setName('SCH_LOC_' . $schlIdx);
					$this->formbox->setOption('');
					$data['frmSCH_LOC_' . $schlIdx] = $this->formbox->getSelectBox($res->result(), '������' , $schlList->SCH_LOC , $objType = 'db');
					
					//��/�߰�
					$res = $this->rmf->getCodeList(array('JUY','Y','N'));
					$this->formbox->setId('SCH_JUYA_' . $schlIdx);
					$this->formbox->setName('SCH_JUYA_' . $schlIdx);
					$this->formbox->setOption('');
					$data['frmSCH_JUYA_' . $schlIdx] = $this->formbox->getSelectBox($res->result(), '��/�߰�' , $schlList->SCH_JUYA , $objType = 'db');
			
					//����/�б�
					$res = $this->rmf->getCodeList(array('BRC','Y','N'));
					$this->formbox->setId('SCH_BRANCH_TP_' . $schlIdx);
					$this->formbox->setName('SCH_BRANCH_TP_' . $schlIdx);
					$this->formbox->setOption('');
					$data['frmSCH_BRANCH_TP_' . $schlIdx] = $this->formbox->getSelectBox($res->result(), '��������' , $schlList->SCH_BRANCH_TP , $objType = 'db');
					
					//���б��� 
					$this->formbox->setId('SCH_ETTP1_' . $schlIdx);
					$this->formbox->setName('SCH_ETTP1_' . $schlIdx);
					$this->formbox->setOption('');
					$res = $this->rmf->getCodeList(array('ET1','Y','N'));
					if ($schlIdx == 1)
					{
						//17	ET1 ����
						$tmpEttp1ar = array();
						foreach ($res->result() as $key => $tmpEttp1List) if ($tmpEttp1List->CODE != '17') $tmpEttp1ar[] = array($tmpEttp1List->CODE , $tmpEttp1List->NAME);
						$data['frmSCH_ETTP1_1'] = $this->formbox->getSelectBox($tmpEttp1ar, '���б���' , $schlList->SCH_ETTP1 , $objType = 'array');
					}
					else
					{
						$data['frmSCH_ETTP1_' . $schlIdx] = $this->formbox->getSelectBox($res->result(), '���б���' , $schlList->SCH_ETTP1 , $objType = 'db');
					}
					
					//�������� 
					$res = $this->rmf->getCodeList(array('ET2','Y','N'));
					$this->formbox->setId('SCH_ETTP2_' . $schlIdx);
					$this->formbox->setName('SCH_ETTP2_' . $schlIdx);
					$this->formbox->setOption('');
					$data['frmSCH_ETTP2_' . $schlIdx] = $this->formbox->getSelectBox($res->result(), '��������' , $schlList->SCH_ETTP2 , $objType = 'db');
					
					//���� ������ ����
					$res = $this->rmf->getCodeList(array('MJT','Y','N'));
					$this->formbox->setId('SCH_SUB_MAJOR_TP_' . $schlIdx);
					$this->formbox->setName('SCH_SUB_MAJOR_TP_' . $schlIdx);
					$this->formbox->setOption('');
					$data['frmSCH_SUB_MAJOR_TP_' . $schlIdx] = $this->formbox->getSelectBox($res->result(), '�������з�' , $schlList->SCH_SUB_MAJOR_TP , $objType = 'db');
					
					//������� ����
		
					$this->formbox->setId('SCH_MAX_HAKJUM_' . $schlIdx);
					$this->formbox->setName('SCH_MAX_HAKJUM_' . $schlIdx);
					$this->formbox->setOption('');
					$data['frmSCH_MAX_HAKJUM_' . $schlIdx] = $this->formbox->getSelectBox($this->datacontrol->getFile2Array('HAKJUM.txt'), '����' , $schlList->SCH_MAX_HAKJUM , $objType = 'array');
				}
				
			}
			
			if ($ADMIN_FLAG != '')
			{
				$this->adminfrontView('front/apply/resumeform' , $data);
			}
			else
			{
				$this->frontView('front/apply/resumeform' , $data);
			}
			//$this->frontView('front/apply/test_resume_form' , $data);
		}
		
		// ����ٹ��� ajax 
		function workPlaceList()
		{
			$this->load->library('Json');
			$this->load->model('front/apply/resumeform_model','rmf',true);
			
			$PRJ_IDX = $this->input->post('SN_PRJ_IDX');
			$UNIT_IDX = $this->input->post('SN_UNIT_IDX');
			$RSM_IDX = $this->input->post('SN_RSM_IDX');
			$APPL_IDX = $this->input->post('SN_APPL_IDX');
			$res = $this->rmf->getWorkPlaceList(array(HOSTID,'N',$PRJ_IDX,$UNIT_IDX,'N','N',$RSM_IDX,'N',$PRJ_IDX,$APPL_IDX,'N'));
			
			$rdata = $res->result();
			$ar = array();
			foreach ($rdata as $key => $listdata)
			{
				$ar[] = array($listdata->CODE,iconv('EUC-KR','UTF-8',$listdata->NAME),$listdata->WRK_PLC_CNT,$listdata->APPL_WP_IDX,$listdata->ORD);
			}
			
			header("Cache-Control: no-cache");
			header("Pragma: no-cache");
			header("Content-Type: text/html; charset=UTF-8");

			echo $this->json->getArray2Json($ar);
		}
		
		
		// ������ ������ ȭ��
		function applyView()
		{
			
			$this->load->model('front/apply/resumeform_model','rmf',true);
			$this->load->model('admin/step/stepManagement_model','unit',true);
			
			// library
			$this->load->library('DataControl'); 
			$this->load->library('AuthFront');
			$this->load->library('FormBox'); 
			
			// default val
			$PRJ_IDX = $this->input->post('PRJ_IDX');
			$RECV_DI = $this->input->post('RECV_DI');
			$ADMIN_FLAG = $this->input->post('ADMIN_FLAG');
			
			$data['APPLY_CHECK_YN'] = $this->ApplyDateCheck($PRJ_IDX);
			$RECV_DI = !trim($RECV_DI) ? $this->authfront->getUserApplyDI() : $RECV_DI;
			
			if ($ADMIN_FLAG != '')
			{
				$PRJ_IDX = $this->input->post('SPRJ_IDX') != null ? $this->input->post('SPRJ_IDX') : $PRJ_IDX;
				$APPLY_NO = $this->input->post('APPLY_NO');
				$res = $this->unit->getProjectPassCode(array($PRJ_IDX));
				$rdata = $res->result();
				
				if ( $rdata[0]->PASSWD != base64_decode($ADMIN_FLAG) )
				{
					jsalertmsg('������ ������ �̻��� ���� ���밡�����⿡ �����Ͽ����ϴ�.');
					winclose('on');
					exit;	
				}
				//�����ڸ�� üũ�� apply_no�� �̿��ؼ� RECV_DI ���� ��������
			
				$di_res = $this->rmf->getRecvDiInfo(array($PRJ_IDX,$APPLY_NO));
				if ($di_res->num_rows() == 1)
				{
				
					$rdata = $di_res->result();
					$RECV_DI = $rdata[0]->AUTH_DI;
				}
			}
			
			
			$mainrs = $this->rmf->getApplyFormLoginList(array('N',$PRJ_IDX,$RECV_DI,'N'));
			$mRs = $mainrs->result();
			$RESUME_IDX = null;
			$APPL_IDX = null;
			$APPL_YN = null;
		
			if ($mainrs->num_rows() == 1)
			{
				$APPL_YN 			= $mRs[0]->APPL_YN;
				$RESUME_IDX 	= $mRs[0]->RSM_IDX;
				$APPL_IDX 		= $mRs[0]->APPL_IDX;
			}
			else
			{
			
				redirect('/front/login/UserLogin');
				exit;
			}
		
			$data['APPL_YN'] = $APPL_YN;
			$data['PRJ_IDX'] = $PRJ_IDX;
			$data['RSM_IDX'] = $RESUME_IDX;
			$data['APPL_IDX'] = $APPL_IDX;
			
			// set - db
			// �ڱ�Ұ� - �ؽ�Ʈ ������
			
			
			
			// ���Ŀ� ���� �����о� �۾��� �������� - �׷��� ���ǵǴ� ���µ� �׿� �°� �ٲ�����. �մ�� �� �����.
			$unitRs = $this->unit->getUnitLeafNodeList(array($PRJ_IDX,'N',$PRJ_IDX,'N'));
			$applyUnitRs = $this->rmf->getApplyUnitList(array($PRJ_IDX,$APPL_IDX,'N'));
			
			$myUnitCdList = array();
			$myUnitCd = null;
			if ($applyUnitRs->num_rows() > 0)
			{
				$myUnitCdList = $applyUnitRs->result();
				$myUnitCd = $myUnitCdList[0]->UNIT_IDX;
			}
			
			$data['UNIT_IDX'] = $myUnitCd;
			
			// ����ٹ��� ����Ʈ
			$res = $this->rmf->getWorkPlaceList(array(HOSTID,'N',$PRJ_IDX,$myUnitCd,'N','N',$RESUME_IDX,'N',$PRJ_IDX,$APPL_IDX,'N'));
			$data['WRK_PLACELIST'] = $res->result();
			
			
			$unitObj = array();
			foreach ($unitRs->result() as $key => $unitList)
			{
				$unitObj[] = array($unitList->UNIT_IDX,$unitList->PATH);
			}
			
			$this->formbox->setId('UNIT_IDX1');
			$this->formbox->setName('UNIT_IDX1');
			$this->formbox->setOption('onchange="javascript:getWorkPlaceList(this.id);"');
			
			$data['SELECTBOX_UNIT_IDX1'] = $this->formbox->getSelectBoxText($unitObj, '�����о� ����' , $myUnitCd , $objType = 'array');
			
			$res = $this->rmf->getApplyUserData(array($PRJ_IDX,$APPL_IDX,'N','N'));
			$applData = $res->result();
			
			foreach ($applData[0] as $key => $applDataList)
			{
				$data[$key] = $applDataList;
			}
			
			$BIRTH_DT_AR = explode('-',$applData[0]->BIRTH_DT);
			$data['BIRTH_DT1'] = $BIRTH_DT_AR[0];
			$data['BIRTH_DT2'] = $BIRTH_DT_AR[1];
			$data['BIRTH_DT3'] = $BIRTH_DT_AR[2];
		
			$TEL_AR = explode('-',$applData[0]->TEL);
			if ( count($TEL_AR) != 3 ) $TEL_AR = array('','','');
			
			
			$data['TEL1'] = $TEL_AR[0];
			$data['TEL2'] = $TEL_AR[1];
			$data['TEL3'] = $TEL_AR[2];
			
			$HTEL_AR = explode('-',$applData[0]->HTEL);
			if ( count($HTEL_AR) != 3 ) $HTEL_AR = array('','','');
			
			$data['HTEL1'] = $HTEL_AR[0];
			$data['HTEL2'] = $HTEL_AR[1];
			$data['HTEL3'] = $HTEL_AR[2];
			
			$ARMY_STDT_AR = explode('-',$applData[0]->ARMY_STDT);
			if ( count($ARMY_STDT_AR) != 3 ) $ARMY_STDT_AR = array('','','');
			
			$data['ARMY_STDT1'] = $ARMY_STDT_AR[0];
			$data['ARMY_STDT2'] = $ARMY_STDT_AR[1];
			$data['ARMY_STDT3'] = $ARMY_STDT_AR[2];
			
			$ARMY_EDDT_AR = explode('-',$applData[0]->ARMY_EDDT);
			if ( count($ARMY_EDDT_AR) != 3 ) $ARMY_EDDT_AR = array('','','');
			
			$data['ARMY_EDDT1'] = $ARMY_EDDT_AR[0];
			$data['ARMY_EDDT2'] = $ARMY_EDDT_AR[1];
			$data['ARMY_EDDT3'] = $ARMY_EDDT_AR[2];
			
			// �̷¼� ��з� �׸��� �����ִ� ����
			$res = $this->rmf->getResumeFormDisplayYNList(array($PRJ_IDX,$RESUME_IDX,'N'));
			$data['rsmdisplay'] = $res->result();
			
			$data['PHOTO_URL'] = APPLY_PHOTO_URL .'/'. $PRJ_IDX .'/'. $APPL_IDX .'.jpg';
			
			// �������� ������ select box ����
			$data['fmlyRs'] = null;
			if ($data['rsmdisplay'][0]->FAMILY_USE_YN == 'Y')
			{
				$fmlyres = $this->rmf->getApplyUserDataFamily(array($PRJ_IDX,$APPL_IDX,'N'));
				$data['fmlyRs'] = $fmlyres->result();
				
				// ��������
				/* �̰� ���ÿ��� ����ҿ뵵 �̹Ƿ� �� �ֶ� */
				$this->formbox->setId('FMLY_REL_CD');
				$this->formbox->setName('FMLY_REL_CD');
				$this->formbox->setOption('');
				$data['frmFMLY_REL_CD'] = $this->formbox->getSelectBoxText($this->datacontrol->getFile2Array('FAMILY_REL.txt'), '����' , '' , $objType = 'array');	
				
				$this->formbox->setId('FMLY_SCH_CD');
				$this->formbox->setName('FMLY_SCH_CD');
				$this->formbox->setOption('');
				$data['frmFMLY_SCH_CD'] = $this->formbox->getSelectBoxText($this->datacontrol->getFile2Array('FAMILY_SCH.txt'), '����' , '' , $objType = 'array');	
				
				$this->formbox->setId('FMLY_LIVE_YN');
				$this->formbox->setName('FMLY_LIVE_YN');
				$this->formbox->setOption('');
				$data['frmFMLY_LIVE_YN'] = $this->formbox->getSelectBoxText(array(array('Y','Y'),array('N','N')), '����' , '' , $objType = 'array');	
				
				$this->formbox->setId('FMLY_HELP_YN');
				$this->formbox->setName('FMLY_HELP_YN');
				$this->formbox->setOption('');
				$data['frmFMLY_HELP_YN'] = $this->formbox->getSelectBoxText(array(array('Y','Y'),array('N','N')), '����' , '' , $objType = 'array');	
				
				/* �ε嵥���Ϳ� ���� ����Ʈ �ڽ� */
				foreach ($data['fmlyRs'] as $key => $fmlyList)
				{
					$fmlyIdx = $key + 1;
					$this->formbox->setId('FMLY_REL_CD_' . $fmlyIdx);
					$this->formbox->setName('FMLY_REL_CD_' . $fmlyIdx);
					$this->formbox->setOption('');
					$data['frmFMLY_REL_CD_' . $fmlyIdx] = $this->formbox->getSelectBoxText($this->datacontrol->getFile2Array('FAMILY_REL.txt'), '����' , $fmlyList->FMLY_REL_CD , $objType = 'array');	
					
					$this->formbox->setId('FMLY_SCH_CD_' . $fmlyIdx);
					$this->formbox->setName('FMLY_SCH_CD_' . $fmlyIdx);
					$this->formbox->setOption('');
					$data['frmFMLY_SCH_CD_' . $fmlyIdx] = $this->formbox->getSelectBoxText($this->datacontrol->getFile2Array('FAMILY_SCH.txt'), '����' , $fmlyList->FMLY_SCH_CD , $objType = 'array');	
					
					$this->formbox->setId('FMLY_LIVE_YN_' . $fmlyIdx);
					$this->formbox->setName('FMLY_LIVE_YN_' . $fmlyIdx);
					$this->formbox->setOption('');
					$data['frmFMLY_LIVE_YN_' . $fmlyIdx] = $this->formbox->getSelectBoxText(array(array('Y','Y'),array('N','N')), '����' , $fmlyList->FMLY_LIVE_YN , $objType = 'array');	
					
					$this->formbox->setId('FMLY_HELP_YN_' . $fmlyIdx);
					$this->formbox->setName('FMLY_HELP_YN_' . $fmlyIdx);
					$this->formbox->setOption('');
					$data['frmFMLY_HELP_YN_' . $fmlyIdx] = $this->formbox->getSelectBoxText(array(array('Y','Y'),array('N','N')), '����' , $fmlyList->FMLY_HELP_YN , $objType = 'array');
				}
				
			}
			
			// ��»��� ������ select box ����
			$data['carrRs'] = null;
			if ($data['rsmdisplay'][0]->CAREER_USE_YN == 'Y')
			{
				$carrres = $this->rmf->getApplyUserDataCareer(array($PRJ_IDX,$APPL_IDX,'N'));
				$data['carrRs'] = $carrres->result();
				
				//�¾�
				$crSubres = $this->rmf->getCareerSetList(array($RESUME_IDX,'N'));
				$data['careerDisplayType'] = $crSubres->result();
				
				$empTypeRs = $this->rmf->getCareerEmployTypeList(array('CIT',NULL,NULL,'N','N'));
				
				
				
				// ��»���
				/* �̰� ���� */
				// ������� ( ū������ ���������� )
				$this->formbox->setId('CAREER_EMP_TP_CD');
				$this->formbox->setName('CAREER_EMP_TP_CD');
				$this->formbox->setOption('');
				$data['frmCAREER_EMP_TP_CD'] = $this->formbox->getSelectBoxText($empTypeRs->result(), '�������' , '' , $objType = 'db');		
				
				$this->formbox->setId('CAREER_CMP_TP_CD');
				$this->formbox->setName('CAREER_CMP_TP_CD');
				$this->formbox->setOption('');
				$data['frmCAREER_CMP_TP_CD'] = $this->formbox->getSelectBoxText($this->datacontrol->getFile2Array('CAREER_COMPANY_TYPE.txt'), '�������' , '' , $objType = 'array');		
				
				// �������� �������
				$this->formbox->setId('CAREER_STS_CD');
				$this->formbox->setName('CAREER_STS_CD');
				$this->formbox->setOption('');
				$data['frmCAREER_STS_CD'] = $this->formbox->getSelectBoxText($this->datacontrol->getFile2Array('CAREER_STATUS.txt'), '��������' , '' , $objType = 'array');		
				
				// ����
				$this->formbox->setId('CAREER_PSTN_CD');
				$this->formbox->setName('CAREER_PSTN_CD');
				$this->formbox->setOption('');
				$data['frmCAREER_PSTN_CD'] = $this->formbox->getSelectBoxText($this->datacontrol->getFile2Array('CAREER_PSTN.txt'), '����' , '' , $objType = 'array');		
				
				// ��å
				$this->formbox->setId('CAREER_PSTN_LVL_CD');
				$this->formbox->setName('CAREER_PSTN_LVL_CD');
				$this->formbox->setOption('');
				$data['frmCAREER_PSTN_LVL_CD'] = $this->formbox->getSelectBoxText($this->datacontrol->getFile2Array('CAREER_PSTN_LEVEL.txt'), '��å' , '' , $objType = 'array');
				
				// ����� ����־��µ�?
				$this->formbox->setId('CAREER_LOC_CD');
				$this->formbox->setName('CAREER_LOC_CD');
				$this->formbox->setOption('');
				$data['frmCAREER_LOC_CD'] = $this->formbox->getSelectBoxText($this->datacontrol->getFile2Array('CAREER_LOCATION.txt'), '������' , '' , $objType = 'array');
				
				//������
				$this->formbox->setId('CAREER_RETIRE_CD');
				$this->formbox->setName('CAREER_RETIRE_CD');
				$this->formbox->setOption('');
				$data['frmCAREER_RETIRE_CD'] = $this->formbox->getSelectBoxText($this->datacontrol->getFile2Array('CAREER_RETIRE_TYPE.txt'), '������' , '' , $objType = 'array');
				
				/* �ε嵥���Ϳ� ���� ����Ʈ �ڽ� */
				foreach ($data['carrRs'] as $key => $carrList)
				{
					$carrIdx = $key + 1;
					
					$this->formbox->setId('CAREER_EMP_TP_CD_' . $carrIdx);
					$this->formbox->setName('CAREER_EMP_TP_CD_' . $carrIdx);
					$this->formbox->setOption('');
					$data['frmCAREER_EMP_TP_CD_' . $carrIdx] = $this->formbox->getSelectBoxText($empTypeRs->result(), '�������' , $carrList->CAREER_EMP_TP_CD  , $objType = 'db');		
						
					$this->formbox->setId('CAREER_CMP_TP_CD_' . $carrIdx);
					$this->formbox->setName('CAREER_CMP_TP_CD_' . $carrIdx);
					$this->formbox->setOption('');
					$data['frmCAREER_CMP_TP_CD_' . $carrIdx] = $this->formbox->getSelectBoxText($this->datacontrol->getFile2Array('CAREER_COMPANY_TYPE.txt'), '�������' , $carrList->CAREER_CMP_TP_CD , $objType = 'array');		
					
					// �������� �������
					$this->formbox->setId('CAREER_STS_CD_' . $carrIdx);
					$this->formbox->setName('CAREER_STS_CD_' . $carrIdx);
					$this->formbox->setOption('');
					$data['frmCAREER_STS_CD_' . $carrIdx] = $this->formbox->getSelectBoxText($this->datacontrol->getFile2Array('CAREER_STATUS.txt'), '��������' , $carrList->CAREER_STS_CD , $objType = 'array');		
					
					// ����
					$this->formbox->setId('CAREER_PSTN_CD_' . $carrIdx);
					$this->formbox->setName('CAREER_PSTN_CD_' . $carrIdx);
					$this->formbox->setOption('');
					
					$data['frmCAREER_PSTN_CD_' . $carrIdx] = $this->formbox->getSelectBoxText($this->datacontrol->getFile2Array('CAREER_PSTN.txt'), '����' , $carrList->CAREER_PSTN_CD , $objType = 'array');		
					
					// ��å
					$this->formbox->setId('CAREER_PSTN_LVL_CD_' . $carrIdx);
					$this->formbox->setName('CAREER_PSTN_LVL_CD_' . $carrIdx);
					$this->formbox->setOption('');
					
					$data['frmCAREER_PSTN_LVL_CD_' . $carrIdx] = $this->formbox->getSelectBoxText($this->datacontrol->getFile2Array('CAREER_PSTN_LEVEL.txt'), '��å' , $carrList->CAREER_PSTN_LVL_CD , $objType = 'array');
					
					// ����� ����־��µ�?
					$this->formbox->setId('CAREER_LOC_CD_' . $carrIdx);
					$this->formbox->setName('CAREER_LOC_CD_' . $carrIdx);
					$this->formbox->setOption('');
					$data['frmCAREER_LOC_CD_' . $carrIdx] = $this->formbox->getSelectBoxText($this->datacontrol->getFile2Array('CAREER_LOCATION.txt'), '������' , $carrList->CAREER_LOC_CD , $objType = 'array');
					
					//������
					$this->formbox->setId('CAREER_RETIRE_CD_' . $carrIdx);
					$this->formbox->setName('CAREER_RETIRE_CD_' . $carrIdx);
					$this->formbox->setOption('');
					$data['frmCAREER_RETIRE_CD_' . $carrIdx] = $this->formbox->getSelectBoxText($this->datacontrol->getFile2Array('CAREER_RETIRE_TYPE.txt'), '������' , $carrList->CAREER_RETIRE_CD , $objType = 'array');
				}
				
			}
			
			// �������� ������ ����
			$data['wrteRs'] = null;
			if ($data['rsmdisplay'][0]->WRITE_USE_YN == 'Y')
			{
				$wrteres = $this->rmf->getApplyUserDataWrite(array($PRJ_IDX,$APPL_IDX,'N'));
				$data['wrteRs'] = $wrteres->result();
			}
			
			// ������� ������ ����
			$data['przeRs'] = null;
			if ($data['rsmdisplay'][0]->PRIZE_USE_YN == 'Y')
			{
				$przres = $this->rmf->getApplyUserDataPrize(array($PRJ_IDX,$APPL_IDX,'N'));
				$data['przeRs'] = $przres->result();
			}
			
			// ���дɷ�2 ������ ����
			$data['lan2Rs'] = null;
			if ($data['rsmdisplay'][0]->LANGUAGE2_USE_YN == 'Y')
			{
				$lan2res = $this->rmf->getApplyUserDataLanguage2(array($PRJ_IDX,$APPL_IDX,'N'));
				$data['lan2Rs'] = $lan2res->result();
				
				/*���� */
				$this->formbox->setId('LANG2_CD');
				$this->formbox->setName('LANG2_CD');
				$this->formbox->setOption('');
				$data['frmLANG2_CD'] = $this->formbox->getSelectBoxText($this->datacontrol->getFile2Array('LANGUAGE_LIST.txt'), '��޼���' , '' , $objType = 'array');		
				
				$this->formbox->setId('LANG2_SPCH_LVL_CD');
				$this->formbox->setName('LANG2_SPCH_LVL_CD');
				$this->formbox->setOption('');
				$data['frmLANG2_SPCH_LVL_CD'] = $this->formbox->getSelectBoxText($this->datacontrol->getFile2Array('LEVEL1.txt'), '��޼���' , '' , $objType = 'array');		
				
				$this->formbox->setId('LANG2_WRT_LVL_CD');
				$this->formbox->setName('LANG2_WRT_LVL_CD');
				$this->formbox->setOption('');
				$data['frmLANG2_WRT_LVL_CD'] = $this->formbox->getSelectBoxText($this->datacontrol->getFile2Array('LEVEL1.txt'), '��޼���' , '' , $objType = 'array');		
				
				$this->formbox->setId('LANG2_CMP_LVL_CD');
				$this->formbox->setName('LANG2_CMP_LVL_CD');
				$this->formbox->setOption('');
				$data['frmLANG2_CMP_LVL_CD'] = $this->formbox->getSelectBoxText($this->datacontrol->getFile2Array('LEVEL1.txt'), '��޼���' , '' , $objType = 'array');		
				
				/* �ε嵥���Ϳ� ���� ����Ʈ �ڽ� */
				foreach ($data['lan2Rs'] as $key => $lan2List)
				{
					$lan2Idx = $key + 1;
					$this->formbox->setId('LANG2_CD_' . $lan2Idx);
					$this->formbox->setName('LANG2_CD_' . $lan2Idx);
					$this->formbox->setOption('');
					$data['frmLANG2_CD_' . $lan2Idx] = $this->formbox->getSelectBoxText($this->datacontrol->getFile2Array('LANGUAGE_LIST.txt'), '��޼���' , $lan2List->LANG2_CD , $objType = 'array');		
					
					$this->formbox->setId('LANG2_SPCH_LVL_CD_' . $lan2Idx);
					$this->formbox->setName('LANG2_SPCH_LVL_CD_' . $lan2Idx);
					$this->formbox->setOption('');
					$data['frmLANG2_SPCH_LVL_CD_' . $lan2Idx] = $this->formbox->getSelectBoxText($this->datacontrol->getFile2Array('LEVEL1.txt'), '��޼���' , $lan2List->LANG2_SPCH_LVL_CD , $objType = 'array');		
					
					$this->formbox->setId('LANG2_WRT_LVL_CD_' . $lan2Idx);
					$this->formbox->setName('LANG2_WRT_LVL_CD_' . $lan2Idx);
					$this->formbox->setOption('');
					$data['frmLANG2_WRT_LVL_CD_' . $lan2Idx] = $this->formbox->getSelectBoxText($this->datacontrol->getFile2Array('LEVEL1.txt'), '��޼���' , $lan2List->LANG2_WRT_LVL_CD , $objType = 'array');		
					
					$this->formbox->setId('LANG2_CMP_LVL_CD_' . $lan2Idx);
					$this->formbox->setName('LANG2_CMP_LVL_CD_' . $lan2Idx);
					$this->formbox->setOption('');
					$data['frmLANG2_CMP_LVL_CD_' . $lan2Idx] = $this->formbox->getSelectBoxText($this->datacontrol->getFile2Array('LEVEL1.txt'), '��޼���' , $lan2List->LANG2_CMP_LVL_CD , $objType = 'array');		
				}
				
			}
			
			// �ڰ����� ������ ����
			$data['licRs'] = null;
			if ($data['rsmdisplay'][0]->LICENSE_USE_YN == 'Y')
			{
				$wrteres = $this->rmf->getApplyUserDataLicense(array($PRJ_IDX,$APPL_IDX,'N'));
				$data['licRs'] = $wrteres->result();
			}
			
			// OA ��� ���� - �����׸��̶� ����Ʈ �θ��� �ƿ� �����͵� ���� �����´�.
			$data['frmComputerDataList'] = null;
			if ($data['rsmdisplay'][0]->PC_USE_YN == 'Y')
			{
				$res = $this->rmf->getComputerList(array($RESUME_IDX,'N','N',$PRJ_IDX,$APPL_IDX,'N'));
				$data['frmComputerDataList'] = $res->result();
				
				foreach ($res->result() as $key => $clistData)
				{
					
					$this->formbox->setId('PC_LVL_CD_' . ($key + 1));
					$this->formbox->setName('PC_LVL_CD_'. ($key + 1));
					$this->formbox->setOption('onchange="SelDataSet(\'PC_LVL_CD_' . ($key + 1) . '\',\'PC_LVL_NM_' . ($key + 1) . '\');"');
					$data['frmPC_LVL_CD_' . ($key + 1)] = $this->formbox->getSelectBoxText($this->datacontrol->getFile2Array('LEVEL1.txt'), '��޼���' , $clistData->LVL_CD , $objType = 'array');		
				}
			}
			
			// �ؿܿ��� �� �ؿܰ���
			$data['srveRs'] = null;
			if ($data['rsmdisplay'][0]->SERVE_USE_YN == 'Y')
			{
				$srveres = $this->rmf->getApplyUserDataServe(array($PRJ_IDX,$APPL_IDX,'N'));
				$data['srveRs'] = $srveres->result();
				//Ȱ������
				/* ���� */
				$this->formbox->setId('SRV_TP_CD');
				$this->formbox->setName('SRV_TP_CD');
				$this->formbox->setOption('');
				$data['frmSRV_TP_CD'] = $this->formbox->getSelectBoxText($this->datacontrol->getFile2Array('SERVE_TYPE.txt'), 'Ȱ�����м���' , '' , $objType = 'array');	
				
				/* �ε嵥���Ϳ� ���� ����Ʈ �ڽ� */
				foreach ($data['srveRs'] as $key => $srveList)
				{
					$srveIdx = $key + 1;
					$this->formbox->setId('SRV_TP_CD_' . $srveIdx);
					$this->formbox->setName('SRV_TP_CD_' . $srveIdx);
					$this->formbox->setOption('');
					$data['frmSRV_TP_CD_' . $srveIdx] = $this->formbox->getSelectBoxText($this->datacontrol->getFile2Array('SERVE_TYPE.txt'), 'Ȱ�����м���' , $srveList->SRV_TP_CD , $objType = 'array');		
						
				}
				
			}
			
			// �������
			$data['techRs'] = null;
			if ($data['rsmdisplay'][0]->TECH_USE_YN == 'Y')
			{
				$techres = $this->rmf->getApplyUserDataTech(array($PRJ_IDX,$APPL_IDX,'N'));
				$data['techRs'] = $techres->result();
			}
			
			// ��������
			$data['educRs'] = null;
			if ($data['rsmdisplay'][0]->EDUCATION_USE_YN == 'Y')
			{
				$educres = $this->rmf->getApplyUserDataEducation(array($PRJ_IDX,$APPL_IDX,'N'));
				$data['educRs'] = $educres->result();
			}
			
			// �ֿ�Ȱ���� ��ȸ����
			$data['trngRs'] = null;
			if ($data['rsmdisplay'][0]->TRAINING_USE_YN == 'Y')
			{
				$trngres = $this->rmf->getApplyUserDataTraining(array($PRJ_IDX,$APPL_IDX,'N'));
				$data['trngRs'] = $trngres->result();
				
				//���� ����
				$this->formbox->setId('TRN_TP_CD');
				$this->formbox->setName('TRN_TP_CD');
				$this->formbox->setOption('');
				$data['frmTRN_TP_CD'] = $this->formbox->getSelectBoxText($this->datacontrol->getFile2Array('TRAINING_TYPE.txt'), '�ؿܰ�������' , '' , $objType = 'array');
				
				/* �ε嵥���Ϳ� ���� ����Ʈ �ڽ� */
				foreach ($data['trngRs'] as $key => $trngList)
				{
					//���� ����
					$trngIdx = $key + 1;
					$this->formbox->setId('TRN_TP_CD_' . $trngIdx);
					$this->formbox->setName('TRN_TP_CD_' . $trngIdx);
					$this->formbox->setOption('');
					$data['frmTRN_TP_CD_' . $trngIdx] = $this->formbox->getSelectBoxText($this->datacontrol->getFile2Array('TRAINING_TYPE.txt'), '�ؿܰ�������' , $trngList->TRN_TP_CD , $objType = 'array');
				}
			}
			$data['frmContent'] = null;
			if ($data['rsmdisplay'][0]->CONTENT_USE_YN == 'Y') 
			{ 
				$res = $this->rmf->getContentList(array($RESUME_IDX,'N',$PRJ_IDX,$APPL_IDX,'N'));	
				$data['frmContent'] = $res->result();
			}
			
			//���Ͼ��ε� ��뿩�� 
			$data['frmFile'] = null;
			if ($data['rsmdisplay'][0]->FILE_USE_YN == 'Y') 
			{ 
				$res = $this->rmf->getFileList(array($RESUME_IDX,'N',$PRJ_IDX,$APPL_IDX,'N'));	
				$data['frmFile'] = $res->result();
			}
			
			
			// ����
			$this->formbox->setId('BOHUN_TP_CD');
			$this->formbox->setName('BOHUN_TP_CD');
			$this->formbox->setOption('');
			$tmpArray = array(array('Y','���'),array('N','����'));
			$data['SELECTBOX_BOHUN_TP_CD'] = $this->formbox->getSelectBoxText($tmpArray, '����' ,$data['BOHUN_TP_CD'] , $objType = 'array');
			
			$this->formbox->setId('BOHUN_SCORE_CD');
			$this->formbox->setName('BOHUN_SCORE_CD');
			$this->formbox->setOption('');
			$tmpArray = array(array('5','5%'),array('10','10%'));
			$data['SELECTBOX_BOHUN_SCORE_CD'] = $this->formbox->getSelectBoxText($tmpArray, '����' ,$data['BOHUN_SCORE_CD'] , $objType = 'array');
			
			// ����ο���
			$this->formbox->setId('PSN_OBSTACLE_TP_CD');
			$this->formbox->setName('PSN_OBSTACLE_TP_CD');
			$this->formbox->setOption('');
			$tmpArray = array(array('Y','�����'),array('N','�������'));
			$data['SELECTBOX_PSN_OBSTACLE_TP_CD'] = $this->formbox->getSelectBox($tmpArray, '����' , $data['PSN_OBSTACLE_TP_CD'] , $objType = 'array');
			
			$this->formbox->setId('PSN_OBSTACLE_LVL_CD');
			$this->formbox->setName('PSN_OBSTACLE_LVL_CD');
			$this->formbox->setOption('');
			
			$data['SELECTBOX_PSN_OBSTACLE_LVL_CD'] = $this->formbox->getSelectBoxText($this->datacontrol->getFile2Array('OBSTACLE_LEVEL.txt'), '��޼���' , $data['PSN_OBSTACLE_LVL_CD'] , $objType = 'array');
			
			// ��ȭ
			
			$this->formbox->setId('TEL1');
			$this->formbox->setName('TEL1');
			$this->formbox->setOption('');
			
			$data['SELECTBOX_TEL'] = $this->formbox->getSelectBoxText($this->datacontrol->getFile2Array('TEL.txt'), '����' , $data['TEL1'] , $objType = 'array');
			
			$this->formbox->setId('HTEL1');
			$this->formbox->setName('HTEL1');
			$this->formbox->setOption('');
			
			$data['SELECTBOX_HTEL'] = $this->formbox->getSelectBoxText($this->datacontrol->getFile2Array('HTEL.txt'), '����' , $data['HTEL1'] , $objType = 'array');
			
			if ($data['rsmdisplay'][0]->ARMY_USE_YN == 'Y')
			{
	 
				$this->formbox->setId('ARMY_TP_CD');
				$this->formbox->setName('ARMY_TP_CD');
				$this->formbox->setOption('');
				
				$data['SELECTBOX_ARMY_TP_CD'] = $this->formbox->getSelectBoxText($this->datacontrol->getFile2Array('ARMY_TYPE.txt'), '����' , $data['ARMY_TP_CD'] , $objType = 'array');
				
				$this->formbox->setId('ARMY_LVL_CD');
				$this->formbox->setName('ARMY_LVL_CD');
				$this->formbox->setOption('');
				
				$data['SELECTBOX_ARMY_LVL_CD'] = $this->formbox->getSelectBoxText($this->datacontrol->getFile2Array('ARMY_LEVEL.txt'), '����' , $data['ARMY_LVL_CD'] , $objType = 'array');
				
				$this->formbox->setId('ARMY_YN_CD');
				$this->formbox->setName('ARMY_YN_CD');
				$this->formbox->setOption('');
				
				$data['SELECTBOX_ARMY_YN_CD'] = $this->formbox->getSelectBoxText($this->datacontrol->getFile2Array('ARMY_YN.txt'), '����' , $data['ARMY_YN_CD'] , $objType = 'array');
				
				$this->formbox->setId('ARMY_FINISH_CD');
				$this->formbox->setName('ARMY_FINISH_CD');
				$this->formbox->setOption('');
				
				$data['SELECTBOX_ARMY_FINISH_CD'] = $this->formbox->getSelectBoxText($this->datacontrol->getFile2Array('ARMY_FINISH.txt'), '����' , $data['ARMY_FINISH_CD'] , $objType = 'array');
				
			}
			
			
			// �߿��Ѿ�� - ������������ �ƴ� �����ڿ��� ������ �� ������ ������ �̰�. 
			// ����� ������ ������ �������� �׸��� �����ɽô�.ajax �� ��������� �׽�Ʈ��
			// ���ϰڴ�.
			$data['lanData'] = null;
			if ($data['rsmdisplay'][0]->LANGUAGE_USE_YN == 'Y')
			{
				$res = $this->rmf->getLanguageList(array($RESUME_IDX,'N','N','LNT','N',$PRJ_IDX,$APPL_IDX,'N'));
				$data['lanData'] = $res->result();
				// view���� 1������ �����ϹǷ� 
				foreach ($data['lanData'] as $key => $lanList)
				{
					$data['frmLAN_LVL_IDX_' . ($key+1)] = '';
					if (preg_match('/^14|15$/', $lanList->SCORE_TP)) // �ڵ尡 ����ڵ��ϰ�� ����Ʈ�� �̾ƿ���
					{
						$subRs = $this->rmf->getLanguageLevelList(array($lanList->LAN_IDX,'N'));
						if ($subRs->num_rows() > 0)
						{
							$this->formbox->setId('LAN_LVL_IDX_' . ($key+1));
							$this->formbox->setName('LAN_LVL_IDX_' . ($key+1));
							$this->formbox->setOption('');
							$data['frmLAN_LVL_IDX_' . ($key+1)] = $this->formbox->getSelectBoxText($subRs->result(), '���' , $lanList->LAN_LVL_IDX , $objType = 'db');
						}
					}
				}
				
			}
			
			
			// �з»��� -- ��� �ִ°��� ���ֺθ��⶧���� �̰� �����ؾ��Ѵ�. ������ ���ϴ� �켱 �����ؼ� �۾�;;;
			if ($data['rsmdisplay'][0]->SCHOOL_USE_YN == 'Y')
			{
				
				$schlres = $this->rmf->getApplyUserDataSchool(array($PRJ_IDX,$APPL_IDX,'N'));
				$data['schlRs'] = $schlres->result();
				
				$data['SCH_SEQ_1'] = null;
				$data['SCH_TP_1'] = null;
				$data['SCH_NM_1'] = null;
				$data['SCH_CD_1'] = null;
				$data['SCH_FGRD_TP_1'] = null;
				$data['SCH_STDT1_1'] = null;
				$data['SCH_STDT2_1'] = null;
				$data['SCH_EDDT1_1'] = null;
				$data['SCH_EDDT2_1'] = null;
				$data['SCH_EDDT3_1'] = null;
				
				if ($schlres->num_rows() > 0)
				{
					foreach ($data['schlRs'][0] as $hkey => $schlHighList)
					{
						//	echo $hkey . '----' . $schlHighList . '<br>';
						$data[$hkey . '_1'] = $schlHighList;	
					}
				}
				
				/*--*/
				//�б����� (�з±���)
				$res = $this->rmf->getCodeList(array('SCT','Y','N'));
				$this->formbox->setId('SCH_TP');
				$this->formbox->setName('SCH_TP');
				$this->formbox->setOption('');
				$data['frmSCH_TP'] = $this->formbox->getSelectBoxText($res->result(), '�з±��м���' , '' , $objType = 'db');
				
				//�迭 - ����
				$res = $this->rmf->getMajorAffiliationList(array('N'));
				$this->formbox->setId('SCH_AFF');
				$this->formbox->setName('SCH_AFF');
				$this->formbox->setOption('');
				$data['frmSCH_AFF'] = $this->formbox->getSelectBoxText($res->result(), '�迭����' , '' , $objType = 'db');
				
				//�迭 - ������
				$res = $this->rmf->getMajorAffiliationList(array('N'));
				$this->formbox->setId('SCH_SUB_AFF');
				$this->formbox->setName('SCH_SUB_AFF');
				$this->formbox->setOption('');
				$data['frmSCH_SUB_AFF'] = $this->formbox->getSelectBoxText($res->result(), '�迭����' , '' , $objType = 'db');
				
				//������
				$res = $this->rmf->getLocationList(array('N'));
				$this->formbox->setId('SCH_LOC');
				$this->formbox->setName('SCH_LOC');
				$this->formbox->setOption('');
				$data['frmSCH_LOC'] = $this->formbox->getSelectBoxText($res->result(), '������' , '' , $objType = 'db');
				
				//��/�߰�
				$res = $this->rmf->getCodeList(array('JUY','Y','N'));
				$this->formbox->setId('SCH_JUYA');
				$this->formbox->setName('SCH_JUYA');
				$this->formbox->setOption('');
				$data['frmSCH_JUYA'] = $this->formbox->getSelectBoxText($res->result(), '��/�߰�' , '' , $objType = 'db');
		
				//����/�б�
				$res = $this->rmf->getCodeList(array('BRC','Y','N'));
				$this->formbox->setId('SCH_BRANCH_TP');
				$this->formbox->setName('SCH_BRANCH_TP');
				$this->formbox->setOption('');
				$data['frmSCH_BRANCH_TP'] = $this->formbox->getSelectBoxText($res->result(), '��������' , '' , $objType = 'db');
				
				//���б��� 
				$res = $this->rmf->getCodeList(array('ET1','Y','N'));
				$this->formbox->setId('SCH_ETTP1');
				$this->formbox->setName('SCH_ETTP1');
				$this->formbox->setOption('');
				$data['frmSCH_ETTP1'] = $this->formbox->getSelectBoxText($res->result(), '���б���' , '' , $objType = 'db');
				
				//�������� 
				$res = $this->rmf->getCodeList(array('ET2','Y','N'));
				$this->formbox->setId('SCH_ETTP2');
				$this->formbox->setName('SCH_ETTP2');
				$this->formbox->setOption('');
				$data['frmSCH_ETTP2'] = $this->formbox->getSelectBoxText($res->result(), '��������' , '' , $objType = 'db');
				
				//���� ������ ����
				$res = $this->rmf->getCodeList(array('MJT','Y','N'));
				$this->formbox->setId('SCH_SUB_MAJOR_TP');
				$this->formbox->setName('SCH_SUB_MAJOR_TP');
				$this->formbox->setOption('');
				$data['frmSCH_SUB_MAJOR_TP'] = $this->formbox->getSelectBoxText($res->result(), '�������з�' , '' , $objType = 'db');
				
				//������� ����
	
				$this->formbox->setId('SCH_MAX_HAKJUM');
				$this->formbox->setName('SCH_MAX_HAKJUM');
				$this->formbox->setOption('');
				$data['frmSCH_MAX_HAKJUM'] = $this->formbox->getSelectBoxText($this->datacontrol->getFile2Array('HAKJUM.txt'), '����' , '' , $objType = 'array');
				
				/* ����б� �׸��� �̸� ���;��ؼ� */
				// �����Ͱ� ������찡 ����� �Ʒ����� ������ �����ͼ� select �ڽ�����鼭 �������� ���������̴�.
					//������
					$res = $this->rmf->getLocationList(array('N'));
					$this->formbox->setId('SCH_LOC_1');
					$this->formbox->setName('SCH_LOC_1');
					$this->formbox->setOption('');
					$data['frmSCH_LOC_1'] = $this->formbox->getSelectBoxText($res->result(), '������' , '' , $objType = 'db');
					
					//��/�߰�
					$res = $this->rmf->getCodeList(array('JUY','Y','N'));
					$this->formbox->setId('SCH_JUYA_1');
					$this->formbox->setName('SCH_JUYA_1');
					$this->formbox->setOption('');
					$data['frmSCH_JUYA_1'] = $this->formbox->getSelectBoxText($res->result(), '��/�߰�' , '' , $objType = 'db');
			
					//����/�б�
					$res = $this->rmf->getCodeList(array('BRC','Y','N'));
					$this->formbox->setId('SCH_BRANCH_TP_1');
					$this->formbox->setName('SCH_BRANCH_TP_1');
					$this->formbox->setOption('');
					$data['frmSCH_BRANCH_TP_1'] = $this->formbox->getSelectBoxText($res->result(), '��������' , '' , $objType = 'db');
					
					//���б��� 
					$res = $this->rmf->getCodeList(array('ET1','Y','N'));
					$this->formbox->setId('SCH_ETTP1_1');
					$this->formbox->setName('SCH_ETTP1_1');
					$this->formbox->setOption('');
					
					//17	ET1 ����
					$tmpEttp1ar = array();
					foreach ($res->result() as $key => $tmpEttp1List) if ($tmpEttp1List->CODE != '17') $tmpEttp1ar[] = array($tmpEttp1List->CODE , $tmpEttp1List->NAME);
				
					$data['frmSCH_ETTP1_1'] = $this->formbox->getSelectBoxText($tmpEttp1ar, '���б���' , '' , $objType = 'array');
					
					//�������� 
					$res = $this->rmf->getCodeList(array('ET2','Y','N'));
					$this->formbox->setId('SCH_ETTP2_1');
					$this->formbox->setName('SCH_ETTP2_1');
					$this->formbox->setOption('');
					$data['frmSCH_ETTP2_1'] = $this->formbox->getSelectBoxText($res->result(), '��������' , '' , $objType = 'db');
					
				/* �ε嵥���Ϳ� ���� ����Ʈ �ڽ� */
				foreach ($data['schlRs'] as $key => $schlList)
				{
					//���� ����
					$schlIdx = $key + 1;
					//�б����� (�з±���)
					$res = $this->rmf->getCodeList(array('SCT','Y','N'));
					$this->formbox->setId('SCH_TP_' . $schlIdx);
					$this->formbox->setName('SCH_TP_' . $schlIdx);
					$this->formbox->setOption('');
					$data['frmSCH_TP_' . $schlIdx] = $this->formbox->getSelectBoxText($res->result(), '�з±��м���' , $schlList->SCH_TP , $objType = 'db');
					
					//�迭 - ����
					$res = $this->rmf->getMajorAffiliationList(array('N'));
					$this->formbox->setId('SCH_AFF_' . $schlIdx);
					$this->formbox->setName('SCH_AFF_' . $schlIdx);
					$this->formbox->setOption('');
					$data['frmSCH_AFF_' . $schlIdx] = $this->formbox->getSelectBoxText($res->result(), '�迭����' , $schlList->SCH_AFF , $objType = 'db');
					
					//�迭 - ������
					$res = $this->rmf->getMajorAffiliationList(array('N'));
					$this->formbox->setId('SCH_SUB_AFF_' . $schlIdx);
					$this->formbox->setName('SCH_SUB_AFF_' . $schlIdx);
					$this->formbox->setOption('');
					$data['frmSCH_SUB_AFF_' . $schlIdx] = $this->formbox->getSelectBoxText($res->result(), '�迭����' , $schlList->SCH_SUB_AFF , $objType = 'db');
					
					//������
					$res = $this->rmf->getLocationList(array('N'));
					$this->formbox->setId('SCH_LOC_' . $schlIdx);
					$this->formbox->setName('SCH_LOC_' . $schlIdx);
					$this->formbox->setOption('');
					$data['frmSCH_LOC_' . $schlIdx] = $this->formbox->getSelectBoxText($res->result(), '������' , $schlList->SCH_LOC , $objType = 'db');
					
					//��/�߰�
					$res = $this->rmf->getCodeList(array('JUY','Y','N'));
					$this->formbox->setId('SCH_JUYA_' . $schlIdx);
					$this->formbox->setName('SCH_JUYA_' . $schlIdx);
					$this->formbox->setOption('');
					$data['frmSCH_JUYA_' . $schlIdx] = $this->formbox->getSelectBoxText($res->result(), '��/�߰�' , $schlList->SCH_JUYA , $objType = 'db');
			
					//����/�б�
					$res = $this->rmf->getCodeList(array('BRC','Y','N'));
					$this->formbox->setId('SCH_BRANCH_TP_' . $schlIdx);
					$this->formbox->setName('SCH_BRANCH_TP_' . $schlIdx);
					$this->formbox->setOption('');
					$data['frmSCH_BRANCH_TP_' . $schlIdx] = $this->formbox->getSelectBoxText($res->result(), '��������' , $schlList->SCH_BRANCH_TP , $objType = 'db');
					
					//���б��� 
					$this->formbox->setId('SCH_ETTP1_' . $schlIdx);
					$this->formbox->setName('SCH_ETTP1_' . $schlIdx);
					$this->formbox->setOption('');
					$res = $this->rmf->getCodeList(array('ET1','Y','N'));
					if ($schlIdx == 1)
					{
						//17	ET1 ����
						$tmpEttp1ar = array();
						foreach ($res->result() as $key => $tmpEttp1List) if ($tmpEttp1List->CODE != '17') $tmpEttp1ar[] = array($tmpEttp1List->CODE , $tmpEttp1List->NAME);
						$data['frmSCH_ETTP1_1'] = $this->formbox->getSelectBoxText($tmpEttp1ar, '���б���' , $schlList->SCH_ETTP1 , $objType = 'array');
					}
					else
					{
						$data['frmSCH_ETTP1_' . $schlIdx] = $this->formbox->getSelectBoxText($res->result(), '���б���' , $schlList->SCH_ETTP1 , $objType = 'db');
					}
					
					//�������� 
					$res = $this->rmf->getCodeList(array('ET2','Y','N'));
					$this->formbox->setId('SCH_ETTP2_' . $schlIdx);
					$this->formbox->setName('SCH_ETTP2_' . $schlIdx);
					$this->formbox->setOption('');
					$data['frmSCH_ETTP2_' . $schlIdx] = $this->formbox->getSelectBoxText($res->result(), '��������' , $schlList->SCH_ETTP2 , $objType = 'db');
					
					//���� ������ ����
					$res = $this->rmf->getCodeList(array('MJT','Y','N'));
					$this->formbox->setId('SCH_SUB_MAJOR_TP_' . $schlIdx);
					$this->formbox->setName('SCH_SUB_MAJOR_TP_' . $schlIdx);
					$this->formbox->setOption('');
					$data['frmSCH_SUB_MAJOR_TP_' . $schlIdx] = $this->formbox->getSelectBoxText($res->result(), '�������з�' , $schlList->SCH_SUB_MAJOR_TP , $objType = 'db');
					
					//������� ����
		
					$this->formbox->setId('SCH_MAX_HAKJUM_' . $schlIdx);
					$this->formbox->setName('SCH_MAX_HAKJUM_' . $schlIdx);
					$this->formbox->setOption('');
					$data['frmSCH_MAX_HAKJUM_' . $schlIdx] = $this->formbox->getSelectBoxText($this->datacontrol->getFile2Array('HAKJUM.txt'), '����' , $schlList->SCH_MAX_HAKJUM , $objType = 'array');
				}
				
			}
			
			
			if ($ADMIN_FLAG != '')
			{
				$this->adminfrontView('front/apply/resumeform_view' , $data);
			}
			else
			{
				$this->frontView('front/apply/resumeform_view' , $data);
			}
			//$this->frontView('front/apply/test_resume_form' , $data);
		}
		
		function applyProcess()
		{
			$this->load->model('front/apply/resumeform_model','rmf',true);
			$this->load->model('admin/step/stepManagement_model','unit',true);
			$PRJ_IDX = $this->input->post('PRJ_IDX');
			$RSM_IDX = $this->input->post('RSM_IDX');
			$APPL_IDX = $this->input->post('APPL_IDX');
			$ADMIN_FLAG = $this->input->post('ADMIN_FLAG');
			$APPLY_NO = $this->input->post('APPLY_NO');
			$data['ADMIN_FLAG'] = $ADMIN_FLAG;
			$data['APPLY_NO'] = $APPLY_NO;
			/*
			//�����ڸ�� üũ�� apply_no�� �̿��ؼ� RECV_DI ���� ��������
			$di_res = $this->rmf->getRecvDiInfo(array($PRJ_IDX,$APPLY_NO));
			if ($di_res->num_rows() == 1)
			{
				$rdata = $di_res->result();
				$RECV_DI = $rdata[0]->AUTH_DI;
			}*/
			
			if ($ADMIN_FLAG != '')
			{
				
				$res = $this->unit->getProjectPassCode(array($PRJ_IDX));
				$rdata = $res->result();
			
				if ( $rdata[0]->PASSWD != base64_decode($ADMIN_FLAG) )
				{
					jsalertmsg('������ ������ �̻��� ���� ���밡�����⿡ �����Ͽ����ϴ�.');
					winclose('on');
					exit;	
				}
			}
			
	
	
			if ($this->ApplyDateCheck($PRJ_IDX) == 'OFF' )
			{
				if ($ADMIN_FLAG != '')
				{
					//�̾�... �ȴ�.
				}
				else
				{
					jsalertmsg('�ش� ä������� ���� ������ �����Ǿ����ϴ�');
					jsredirect('/front/mypage');
					exit;
				}
			}
		
			$res = $this->rmf->getResumeFormDisplayYNList(array($PRJ_IDX,$RSM_IDX,'N'));
			$YNList = $res->result();
			
			// �⺻�Ż����� ���� 
			
			// ��й�ȣ ���� 
			$USER_PW = $this->input->post('USER_PW');
			
			if (trim($USER_PW) != '')
			{
					$this->rmf->getApplyPasswordProcess(array(MD5($USER_PW),$PRJ_IDX,$APPL_IDX,'N'));
			}
			
			
			// �����о� - ���� 
			//$UNIT_IDX = $this->input->post('UNIT_IDX');
			$a = 1;
			$UNIT_IDX_AR = array();
			$unitdelCodeList = array();
			$unitdelCodeList[] = 0;
			$c = 0;
			while ($a > 0)
			{
				if ($this->input->post('UNIT_IDX' . $a) == '') break;
				if ($this->input->post('UNIT_IDX' . $a) != '')
				{
					$unitdelCodeList[] = $this->input->post('UNIT_IDX' . $a);
					$UNIT_IDX_AR[$c]['CODE'] = $this->input->post('UNIT_IDX' . $a);
					$UNIT_IDX_AR[$c]['ORD'] = $this->input->post('UNIT_IDX_ORD' . $a);
					$c ++;
				}
				$a ++;
			}
		
			$this->rmf->getApplyUnitDelProcess(array('Y',$PRJ_IDX,$APPL_IDX,$PRJ_IDX,$APPL_IDX),$unitdelCodeList);
			
			foreach ($UNIT_IDX_AR as $ukey => $unitList ) 
			{
				$this->rmf->getApplyUnitProcess(array($PRJ_IDX,$APPL_IDX,$unitList['CODE'],$unitList['ORD'],$PRJ_IDX,$APPL_IDX,$unitList['CODE'],$unitList['ORD']));
			}
			
			// ����ٹ��� - ���� 
			$a = 1;
			$WRK_LOC_CD_AR = array();
			$wrkdelCodeList = array();
			$wrkdelCodeList[] = 0;
			$c = 0;
			while ($a > 0)
			{
				if ($this->input->post('WRK_LOC_CD' . $a) == '') break;
				if ($this->input->post('WRK_LOC_CD' . $a) != '')
				{
					$wrkdelCodeList[] = $this->input->post('WRK_LOC_CD' . $a);
					$WRK_LOC_CD_AR[$c]['CODE'] = $this->input->post('WRK_LOC_CD' . $a);
					$WRK_LOC_CD_AR[$c]['ORD'] = $this->input->post('WRK_LOC_ORD' . $a);
					$c ++;
				}
				$a ++;
			}
			
			$this->rmf->getApplyLocationDelProcess(array('Y',$PRJ_IDX,$APPL_IDX,$PRJ_IDX,$APPL_IDX),$wrkdelCodeList);
			
			foreach ($WRK_LOC_CD_AR as $lkey => $locList ) 
			{
				$this->rmf->getApplyLocationProcess(array($PRJ_IDX,$APPL_IDX,$locList['CODE'],$locList['ORD'],$PRJ_IDX,$APPL_IDX,$locList['CODE'],$locList['ORD']));
			}
			
			if ($YNList[0]->PERSONAL_USE_YN == 'Y')
			{
				
				
				$postArrayList = array('NAMEKOR','NAMECHA','NAMEENG1','NAMEENG2'
															,'BIRTH_DT1','BIRTH_DT2','BIRTH_DT3','BIRTH_TP'
															,'ZIPCODE1','ZIPCODE2','ADDRESS1','ADDRESS2'
															,'TEL1','TEL2','TEL3','HTEL1','HTEL2','HTEL3'
															,'EMAIL'
															,'MARRY_YN','RELIGION','HOBBY','FORTE'
															,'BOHUN_TP_CD','BOHUN_TP_NM'
															,'BOHUN_SCORE_CD','BOHUN_SCORE_NM','BOHUN_NUM'
															,'PSN_OBSTACLE_YN','PSN_OBSTACLE_TP_CD','PSN_OBSTACLE_TP_NM','PSN_OBSTACLE_LVL_CD','PSN_OBSTACLE_LVL_NM','PSN_OBSTACLE_TP_REASON'
															,'PSN_HEIGHT','PSN_WEIGHT','PSN_LSIGHT','PSN_RSIGHT','PSN_CLRBLND_YN'
															,'PSN_LOWINCOME_YN'
															,'CAREER_TP','CAREER_TERM1','CAREER_TERM2','FOREIGN_CAREER_YN','FOREIGN_CAREER_TERM1','FOREIGN_CAREER_TERM2','EMP_INSUR_TERM1','EMP_INSUR_TERM2'
															,'FMLY_NONE_YN'
															,'PHOTO_YN');
				
				foreach ($postArrayList as $key => $postval) 
				{
					${$postval} = $this->input->post($postval);
					${$postval} = ${$postval} == '' ? null : ${$postval};
				}
				
				$ZIPCODE = ($ZIPCODE1 != '' && $ZIPCODE2 != '' ) ? $ZIPCODE1 . $ZIPCODE2 : null;
				$TEL = ($TEL1 != '' && $TEL2 != '' && $TEL3 != '') ? $TEL1 . '-' . $TEL2 . '-' . $TEL3 : null;
				$HTEL = ($HTEL1 != '' && $HTEL2 != '' && $HTEL3 != '') ? $HTEL1 . '-' . $HTEL2 . '-' . $HTEL3 : null;
				$BIRTH_DT = $BIRTH_DT1 .'-'. $BIRTH_DT2 .'-'. $BIRTH_DT3;
				$this->rmf->getApplyPersonalProcess(array($PRJ_IDX,$APPL_IDX
																								 ,$TEL,$HTEL
																							   ,$NAMEENG1,$NAMEENG2,$NAMECHA
																							   ,$MARRY_YN
																							   ,$ADDRESS1,$ADDRESS2,$ZIPCODE
																							   ,$BIRTH_DT,$BIRTH_TP,$RELIGION,$HOBBY,$FORTE
																							   ,$BOHUN_TP_NM,$BOHUN_TP_CD,$BOHUN_SCORE_CD,$BOHUN_SCORE_NM,$BOHUN_NUM
																							   ,$PSN_OBSTACLE_TP_CD,$PSN_OBSTACLE_TP_NM,$PSN_OBSTACLE_LVL_CD,$PSN_OBSTACLE_LVL_NM,$PSN_OBSTACLE_TP_REASON
																							   ,$PSN_HEIGHT,$PSN_WEIGHT,$PSN_LSIGHT,$PSN_RSIGHT,$PSN_CLRBLND_YN,$PSN_LOWINCOME_YN
																							   ,$PHOTO_YN
																							   ,$PRJ_IDX,$APPL_IDX
																								 ,$TEL,$HTEL
																							   ,$NAMEENG1,$NAMEENG2,$NAMECHA
																							   ,$MARRY_YN
																							   ,$ADDRESS1,$ADDRESS2,$ZIPCODE
																							   ,$BIRTH_DT,$BIRTH_TP,$RELIGION,$HOBBY,$FORTE
																							   ,$BOHUN_TP_NM,$BOHUN_TP_CD,$BOHUN_SCORE_CD,$BOHUN_SCORE_NM,$BOHUN_NUM
																							   ,$PSN_OBSTACLE_TP_CD,$PSN_OBSTACLE_TP_NM,$PSN_OBSTACLE_LVL_CD,$PSN_OBSTACLE_LVL_NM,$PSN_OBSTACLE_TP_REASON
																							   ,$PSN_HEIGHT,$PSN_WEIGHT,$PSN_LSIGHT,$PSN_RSIGHT,$PSN_CLRBLND_YN,$PSN_LOWINCOME_YN
																							   ,$PHOTO_YN));
				
				
				$CAREER_TERM = ( !$CAREER_TERM1 ? 0 : $CAREER_TERM1 * 12 ) + $CAREER_TERM2;
				$FOREIGN_CAREER_TERM = ( !$FOREIGN_CAREER_TERM1 ? 0 : $FOREIGN_CAREER_TERM1 * 12 ) + $FOREIGN_CAREER_TERM2;
				$EMP_INSUR_TERM = ( !$EMP_INSUR_TERM1 ? 0 : $EMP_INSUR_TERM1 * 12 ) + $EMP_INSUR_TERM2;
				
				switch ($YNList[0]->CAREER_USE_YN . '' . $YNList[0]->FAMILY_USE_YN)
				{
					case 'YY' :
						$this->rmf->getApplyBaseProcess(array($EMAIL,$CAREER_TP,$CAREER_TERM,$FOREIGN_CAREER_YN,$FOREIGN_CAREER_TERM,$EMP_INSUR_TERM,$FMLY_NONE_YN,$PRJ_IDX,$APPL_IDX,'N'),$YNList[0]->CAREER_USE_YN,$YNList[0]->FAMILY_USE_YN);
						break;
					
					case 'YN' :
						$this->rmf->getApplyBaseProcess(array($EMAIL,$CAREER_TP,$CAREER_TERM,$FOREIGN_CAREER_YN,$FOREIGN_CAREER_TERM,$EMP_INSUR_TERM,$PRJ_IDX,$APPL_IDX,'N'),$YNList[0]->CAREER_USE_YN,$YNList[0]->FAMILY_USE_YN);
						break;
						
					case 'NY' :
						$this->rmf->getApplyBaseProcess(array($EMAIL,$FMLY_NONE_YN,$PRJ_IDX,$APPL_IDX,'N'),$YNList[0]->CAREER_USE_YN,$YNList[0]->FAMILY_USE_YN);
						break;
							
					default :
						$this->rmf->getApplyBaseProcess(array($EMAIL,$PRJ_IDX,$APPL_IDX,'N'),$YNList[0]->CAREER_USE_YN,$YNList[0]->FAMILY_USE_YN);
						break;
				}
				
			}
			
			// �������� 
			if ($YNList[0]->ARMY_USE_YN == 'Y')
			{
				
				$postArrayList = array('ARMY_YN_NM','ARMY_YN_CD'
														   ,'ARMY_TP_NM','ARMY_TP_CD'
														   ,'ARMY_LVL_NM','ARMY_LVL_CD'
														   ,'ARMY_FINISH_NM','ARMY_FINISH_CD'
														   ,'ARMY_STDT1','ARMY_EDDT1'
														   ,'ARMY_STDT2','ARMY_EDDT2'
														   ,'ARMY_STDT3','ARMY_EDDT3'
														   ,'ARMY_TERM_NM','ARMY_TERM_CD','ARMY_REASON');
				
				foreach ($postArrayList as $key => $postval) 
				{
					${$postval} = $this->input->post($postval);
					${$postval} = ${$postval} == '' ? null : ${$postval};
				}
				
				$ARMY_STDT = ($ARMY_STDT1 != '' && $ARMY_STDT2 != '' && $ARMY_STDT3 != '') ? $ARMY_STDT1 .'-'. $ARMY_STDT2 .'-'. $ARMY_STDT3 : null;
				$ARMY_EDDT = ($ARMY_EDDT1 != '' && $ARMY_EDDT2 != '' && $ARMY_EDDT3 != '') ? $ARMY_EDDT1 .'-'. $ARMY_EDDT2 .'-'. $ARMY_EDDT3 : null;
				
				$this->rmf->getApplyArmyProcess(array($PRJ_IDX,$APPL_IDX
																				 ,$ARMY_YN_NM,$ARMY_YN_CD
																			   ,$ARMY_TP_NM,$ARMY_TP_CD
																			   ,$ARMY_LVL_NM,$ARMY_LVL_CD
																			   ,$ARMY_FINISH_NM,$ARMY_FINISH_CD
																			   ,$ARMY_STDT,$ARMY_EDDT,$ARMY_REASON
																			   ,$ARMY_TERM_NM,$ARMY_TERM_CD
																			   ,$PRJ_IDX,$APPL_IDX
																				 ,$ARMY_YN_NM,$ARMY_YN_CD
																			   ,$ARMY_TP_NM,$ARMY_TP_CD
																			   ,$ARMY_LVL_NM,$ARMY_LVL_CD
																			   ,$ARMY_FINISH_NM,$ARMY_FINISH_CD
																			   ,$ARMY_STDT,$ARMY_EDDT,$ARMY_REASON
																			   ,$ARMY_TERM_NM,$ARMY_TERM_CD));
				
			}
			
			// �������� 
			if ($YNList[0]->FAMILY_USE_YN == 'Y')
			{
				
				$postArrayList = array( 'FMLY_SEQ'
															 ,'FMLY_REL_NM','FMLY_REL_CD'
														   ,'FMLY_NM','FMLY_NAI'
														   ,'FMLY_SCH_NM','FMLY_SCH_CD'
														   ,'FMLY_JOB','FMLY_WRK_NM','FMLY_WRK_PSTN'
														   ,'FMLY_LIVE_YN','FMLY_HELP_YN');
				
				$FAMILY_FORM_COUNT = $this->input->post('FAMILY_FORM_COUNT');
				
				// �߰� �Ȱ� ��ŭ for��
				$b = 1;
				// �Ѱ��̻��� �׸� �����Ͱ� ������ insert�Ѵ�. �ʼ�üũ �۾��� �� ���ܿ��� DB���� ������ �����ͼ� ó�� ( �̰� 2�� �۾��� )
				for ($a = 1 ; $a <= $FAMILY_FORM_COUNT ; $a ++ )
				{
					$blank_flag = null;
					
					foreach ($postArrayList as $key => $postval) 
					{
						if ($this->input->post($postval . '_' . $a) != '') 
						{
							$blank_flag = 'on';
							break;
						}
					}
					
					if ($blank_flag == 'on' )
					{
						foreach ($postArrayList as $key => $postval) 
						{
							//echo $postval . '-----' . $this->input->post($postval . '_' . $a) . '<br>';
							${$postval . '_' . $b} = $this->input->post($postval . '_' . $a);
							${$postval . '_' . $b} = ${$postval . '_' . $b} == '' ? null : ${$postval . '_' . $b};
						}
						$b ++;
					}
				}
			
				// �׸��� �ִ� �Ϳ� ���ؼ� �ٽ� ���������Ȱ����� .
				$fmlySeqList = array();
				$fmlySeqList[] = 0; // ��ü ������ ������쿡 ���� �����߻� ����
				// �������� ó���ϰ� ���� �����۾� ( ������ �����ϴϱ� ���� ��ϵȰ͵� �����ǳ�;;;; )
				for ($c = 1 ; $c < $b ; $c ++ ) if (${'FMLY_SEQ_' . $c} != null ) $fmlySeqList[] = ${'FMLY_SEQ_' . $c};
				$this->rmf->getApplyFamIlyDelProcess(array('Y',$PRJ_IDX,$APPL_IDX,$PRJ_IDX,$APPL_IDX),$fmlySeqList);
				
				for ($c = 1 ; $c < $b ; $c ++ )
				{
					//echo ${'FMLY_REL_NM_' . $c};
					$this->rmf->getApplyFamilyProcess(array($PRJ_IDX,$APPL_IDX
																								 ,${'FMLY_SEQ_' . $c}
																								 ,${'FMLY_REL_NM_' . $c},${'FMLY_REL_CD_' . $c}
																							   ,${'FMLY_NM_' . $c},${'FMLY_NAI_' . $c}
																							   ,${'FMLY_SCH_NM_' . $c},${'FMLY_SCH_CD_' . $c}
																							 	 ,${'FMLY_JOB_' . $c},${'FMLY_WRK_NM_' . $c},${'FMLY_WRK_PSTN_' . $c}
																							   ,${'FMLY_LIVE_YN_' . $c},${'FMLY_HELP_YN_' . $c}
																							   ,$PRJ_IDX,$APPL_IDX
																							   ,$PRJ_IDX,$APPL_IDX
																							   ,${'FMLY_REL_NM_' . $c},${'FMLY_REL_CD_' . $c}
																							   ,${'FMLY_NM_' . $c},${'FMLY_NAI_' . $c}
																							   ,${'FMLY_SCH_NM_' . $c},${'FMLY_SCH_CD_' . $c}
																							 	 ,${'FMLY_JOB_' . $c},${'FMLY_WRK_NM_' . $c},${'FMLY_WRK_PSTN_' . $c}
																							   ,${'FMLY_LIVE_YN_' . $c},${'FMLY_HELP_YN_' . $c}));
																							   
				}
				
				
				
			}
			
			
			// ��»��� 
			if ($YNList[0]->CAREER_USE_YN == 'Y')
			{
				$postArrayList = array(  'CAREER_SEQ'
																,'CAREER_STDT1','CAREER_STDT2'
																,'CAREER_EDDT1','CAREER_EDDT2'
																,'CAREER_STS_NM','CAREER_STS_CD'
																,'CAREER_CMP_NM','CAREER_CMP_CD'
																,'CAREER_CMP_TP_NM','CAREER_CMP_TP_CD'
																,'CAREER_JOB_TP_NM','CAREER_JOB_TP_CD'
																,'CAREER_DEPT_NM'
																,'CAREER_PSTN_NM','CAREER_PSTN_CD'
																,'CAREER_LOC_NM','CAREER_LOC_CD'
																,'CAREER_RETIRE_NM','CAREER_RETIRE_CD'
																,'CAREER_PSTN_LVL_NM','CAREER_PSTN_LVL_CD'
																,'CAREER_EMP_TP_NM','CAREER_EMP_TP_CD'
																,'CAREER_CNTNT');
														   
				$CAREER_FORM_COUNT = $this->input->post('CAREER_FORM_COUNT');
				
				// �߰� �Ȱ� ��ŭ for��
				$b = 1;
				// �Ѱ��̻��� �׸� �����Ͱ� ������ insert�Ѵ�. �ʼ�üũ �۾��� �� ���ܿ��� DB���� ������ �����ͼ� ó�� ( �̰� 2�� �۾��� )
				for ($a = 1 ; $a <= $CAREER_FORM_COUNT ; $a ++ )
				{
					$blank_flag = null;
					
					foreach ($postArrayList as $key => $postval) 
					{
						if ($this->input->post($postval . '_' . $a) != '') 
						{
							$blank_flag = 'on';
							break;
						}
					}
					
					if ($blank_flag == 'on' )
					{
						foreach ($postArrayList as $key => $postval) 
						{
							//echo $postval . '-----' . $this->input->post($postval . '_' . $a) . '<br>';
							${$postval . '_' . $b} = $this->input->post($postval . '_' . $a);
							${$postval . '_' . $b} = ${$postval . '_' . $b} == '' ? null : ${$postval . '_' . $b};
						}
						$b ++;
					}
				}
				
				// �׸��� �ִ� �Ϳ� ���ؼ� �ٽ� ���������Ȱ����� .
				$carrSeqList = array();
				$carrSeqList[] = 0; // ��ü ������ ������쿡 ���� �����߻� ����
				// �������� ó���ϰ� ���� �����۾� ( ������ �����ϴϱ� ���� ��ϵȰ͵� �����ǳ�;;;; )
				for ($c = 1 ; $c < $b ; $c ++ ) if (${'CAREER_SEQ_' . $c} != null ) $carrSeqList[] = ${'CAREER_SEQ_' . $c};
				
				$this->rmf->getApplyCareerDelProcess(array('Y',$PRJ_IDX,$APPL_IDX,$PRJ_IDX,$APPL_IDX),$carrSeqList);
				
				for ($c = 1 ; $c < $b ; $c ++ )
				{
					
					${'CAREER_STDT_' . $c} = (${'CAREER_STDT1_' . $c} != null && ${'CAREER_STDT1_' . $c} != null ) ? ${'CAREER_STDT1_' . $c} .'-'. ${'CAREER_STDT2_' . $c} .'-01' : null;
					${'CAREER_EDDT_' . $c} = (${'CAREER_EDDT1_' . $c} != null && ${'CAREER_EDDT1_' . $c} != null ) ? ${'CAREER_EDDT1_' . $c} .'-'. ${'CAREER_EDDT2_' . $c} .'-01' : null;
					
					$this->rmf->getApplyCareerProcess(array($PRJ_IDX,$APPL_IDX
																								,${'CAREER_SEQ_' . $c}
																								,${'CAREER_STDT_' . $c},${'CAREER_EDDT_' . $c}
																								,${'CAREER_STS_NM_' . $c},${'CAREER_STS_CD_' . $c}
																								,${'CAREER_CMP_NM_' . $c},${'CAREER_CMP_CD_' . $c}
																								,${'CAREER_CMP_TP_NM_' . $c},${'CAREER_CMP_TP_CD_' . $c}
																								,${'CAREER_JOB_TP_NM_' . $c},${'CAREER_JOB_TP_CD_' . $c}
																								,${'CAREER_DEPT_NM_' . $c}
																								,${'CAREER_PSTN_NM_' . $c},${'CAREER_PSTN_CD_' . $c}
																								,${'CAREER_LOC_NM_' . $c},${'CAREER_LOC_CD_' . $c}
																								,${'CAREER_RETIRE_NM_' . $c},${'CAREER_RETIRE_CD_' . $c}
																								,${'CAREER_PSTN_LVL_NM_' . $c},${'CAREER_PSTN_LVL_CD_' . $c}
																								,${'CAREER_EMP_TP_NM_' . $c},${'CAREER_EMP_TP_CD_' . $c}
																								,Html2String(${'CAREER_CNTNT_' . $c})
																								,$PRJ_IDX,$APPL_IDX
																								,$PRJ_IDX,$APPL_IDX
																								,${'CAREER_STDT_' . $c},${'CAREER_EDDT_' . $c}
																								,${'CAREER_STS_NM_' . $c},${'CAREER_STS_CD_' . $c}
																								,${'CAREER_CMP_NM_' . $c},${'CAREER_CMP_CD_' . $c}
																								,${'CAREER_CMP_TP_NM_' . $c},${'CAREER_CMP_TP_CD_' . $c}
																								,${'CAREER_JOB_TP_NM_' . $c},${'CAREER_JOB_TP_CD_' . $c}
																								,${'CAREER_DEPT_NM_' . $c}
																								,${'CAREER_PSTN_NM_' . $c},${'CAREER_PSTN_CD_' . $c}
																								,${'CAREER_LOC_NM_' . $c},${'CAREER_LOC_CD_' . $c}
																								,${'CAREER_RETIRE_NM_' . $c},${'CAREER_RETIRE_CD_' . $c}
																								,${'CAREER_PSTN_LVL_NM_' . $c},${'CAREER_PSTN_LVL_CD_' . $c}
																								,${'CAREER_EMP_TP_NM_' . $c},${'CAREER_EMP_TP_CD_' . $c}
																								,Html2String(${'CAREER_CNTNT_' . $c})));
																							   
				}
				
			}
			
			// ��������
			if ($YNList[0]->WRITE_USE_YN == 'Y')
			{
				$postArrayList = array(  'WRT_SEQ'
																,'WRT_NM','WRT_PB'
																,'WRT_DT1','WRT_DT2','WRT_DT3');
				$WRITE_FORM_COUNT = $this->input->post('WRITE_FORM_COUNT');
				
				
				// �߰� �Ȱ� ��ŭ for��
				$b = 1;
				// �Ѱ��̻��� �׸� �����Ͱ� ������ insert�Ѵ�. �ʼ�üũ �۾��� �� ���ܿ��� DB���� ������ �����ͼ� ó�� ( �̰� 2�� �۾��� )
				for ($a = 1 ; $a <= $WRITE_FORM_COUNT ; $a ++ )
				{
					$blank_flag = null;
					
					foreach ($postArrayList as $key => $postval) 
					{
						if ($this->input->post($postval . '_' . $a) != '') 
						{
							$blank_flag = 'on';
							break;
						}
					}
					
					if ($blank_flag == 'on' )
					{
						foreach ($postArrayList as $key => $postval) 
						{
							//echo $postval . '-----' . $this->input->post($postval . '_' . $a) . '<br>';
							${$postval . '_' . $b} = $this->input->post($postval . '_' . $a);
							${$postval . '_' . $b} = ${$postval . '_' . $b} == '' ? null : ${$postval . '_' . $b};
						}
						$b ++;
					}
				}
				
				// �׸��� �ִ� �Ϳ� ���ؼ� �ٽ� ���������Ȱ����� .
				$wrteSeqList = array();
				$wrteSeqList[] = 0; // ��ü ������ ������쿡 ���� �����߻� ����
				// �������� ó���ϰ� ���� �����۾� ( ������ �����ϴϱ� ���� ��ϵȰ͵� �����ǳ�;;;; )
				for ($c = 1 ; $c < $b ; $c ++ ) if (${'WRT_SEQ_' . $c} != null ) $wrteSeqList[] = ${'WRT_SEQ_' . $c};
				
				$this->rmf->getApplyWriteDelProcess(array('Y',$PRJ_IDX,$APPL_IDX,$PRJ_IDX,$APPL_IDX),$wrteSeqList);
				
				for ($c = 1 ; $c < $b ; $c ++ )
				{
					
					${'WRT_DT_' . $c} = (${'WRT_DT1_' . $c} != null && ${'WRT_DT2_' . $c} != null && ${'WRT_DT3_' . $c} != null ) ? ${'WRT_DT1_' . $c} .'-'. ${'WRT_DT2_' . $c} .'-' . ${'WRT_DT3_' . $c} : null;
					$this->rmf->getApplyWriteProcess(array($PRJ_IDX,$APPL_IDX
																								,${'WRT_SEQ_' . $c}
																								,${'WRT_NM_' . $c},${'WRT_PB_' . $c}
																								,${'WRT_DT_' . $c}
																								,$PRJ_IDX,$APPL_IDX
																								,$PRJ_IDX,$APPL_IDX
																								,${'WRT_NM_' . $c},${'WRT_PB_' . $c}
																								,${'WRT_DT_' . $c}
																								));
																							   
				}
				
				
			}
			
			
			// ���󳻿�
			if ($YNList[0]->PRIZE_USE_YN == 'Y')
			{
				$postArrayList = array(  'PRZ_SEQ'
																,'PRZ_NM','PRZ_PB_NM'
																,'PRZ_DT1','PRZ_DT2','PRZ_DT3');
				$PRIZE_FORM_COUNT = $this->input->post('PRIZE_FORM_COUNT');
				
				// �߰� �Ȱ� ��ŭ for��
				$b = 1;
				// �Ѱ��̻��� �׸� �����Ͱ� ������ insert�Ѵ�. �ʼ�üũ �۾��� �� ���ܿ��� DB���� ������ �����ͼ� ó�� ( �̰� 2�� �۾��� )
				for ($a = 1 ; $a <= $PRIZE_FORM_COUNT ; $a ++ )
				{
					$blank_flag = null;
					
					foreach ($postArrayList as $key => $postval) 
					{
					
						if ($this->input->post($postval . '_' . $a) != '') 
						{
							$blank_flag = 'on';
							break;
						}
					}
					
					if ($blank_flag == 'on' )
					{
						foreach ($postArrayList as $key => $postval) 
						{
							//echo $postval . '-----' . $this->input->post($postval . '_' . $a) . '<br>';
							${$postval . '_' . $b} = $this->input->post($postval . '_' . $a);
							${$postval . '_' . $b} = ${$postval . '_' . $b} == '' ? null : ${$postval . '_' . $b};
						}
						$b ++;
					}
				}
				
				// �׸��� �ִ� �Ϳ� ���ؼ� �ٽ� ���������Ȱ����� .
				$przeSeqList = array();
				$przeSeqList[] = 0; // ��ü ������ ������쿡 ���� �����߻� ����
				// �������� ó���ϰ� ���� �����۾� ( ������ �����ϴϱ� ���� ��ϵȰ͵� �����ǳ�;;;; )
				for ($c = 1 ; $c < $b ; $c ++ ) if (${'PRZ_SEQ_' . $c} != null ) $przeSeqList[] = ${'PRZ_SEQ_' . $c};
				
				$this->rmf->getApplyPrizeDelProcess(array('Y',$PRJ_IDX,$APPL_IDX,$PRJ_IDX,$APPL_IDX),$przeSeqList);
				
				for ($c = 1 ; $c < $b ; $c ++ )
				{
					
					${'PRZ_DT_' . $c} = (${'PRZ_DT1_' . $c} != null && ${'PRZ_DT2_' . $c} != null && ${'PRZ_DT3_' . $c} != null ) ? ${'PRZ_DT1_' . $c} .'-'. ${'PRZ_DT2_' . $c} .'-' . ${'PRZ_DT3_' . $c} : null;
					$this->rmf->getApplyPrizeProcess(array($PRJ_IDX,$APPL_IDX
																								,${'PRZ_SEQ_' . $c}
																								,${'PRZ_NM_' . $c},${'PRZ_PB_NM_' . $c}
																								,${'PRZ_DT_' . $c}
																								,$PRJ_IDX,$APPL_IDX
																								,$PRJ_IDX,$APPL_IDX
																								,${'PRZ_NM_' . $c},${'PRZ_PB_NM_' . $c}
																								,${'PRZ_DT_' . $c}
																								));
																							   
				}
				
				
			}
			
			
			
			
			// ����2����
			if ($YNList[0]->LANGUAGE2_USE_YN == 'Y')
			{

				$postArrayList = array(  'LANG2_SEQ'
																,'LANG2_NM','LANG2_CD'
																,'LANG2_SPCH_LVL_NM','LANG2_SPCH_LVL_CD'
																,'LANG2_WRT_LVL_NM','LANG2_WRT_LVL_CD'
																,'LANG2_CMP_LVL_NM','LANG2_CMP_LVL_CD');
				$LANGUAGE2_FORM_COUNT = $this->input->post('LANGUAGE2_FORM_COUNT');
				
				// �߰� �Ȱ� ��ŭ for��
				$b = 1;
				// �Ѱ��̻��� �׸� �����Ͱ� ������ insert�Ѵ�. �ʼ�üũ �۾��� �� ���ܿ��� DB���� ������ �����ͼ� ó�� ( �̰� 2�� �۾��� )
				for ($a = 1 ; $a <= $LANGUAGE2_FORM_COUNT ; $a ++ )
				{
					$blank_flag = null;
					
					foreach ($postArrayList as $key => $postval) 
					{
					
						if ($this->input->post($postval . '_' . $a) != '') 
						{
							$blank_flag = 'on';
							break;
						}
					}
					
					if ($blank_flag == 'on' )
					{
						foreach ($postArrayList as $key => $postval) 
						{
							//echo $postval . '-----' . $this->input->post($postval . '_' . $a) . '<br>';
							${$postval . '_' . $b} = $this->input->post($postval . '_' . $a);
							${$postval . '_' . $b} = ${$postval . '_' . $b} == '' ? null : ${$postval . '_' . $b};
						}
						$b ++;
					}
				}
				
				// �׸��� �ִ� �Ϳ� ���ؼ� �ٽ� ���������Ȱ����� .
				$lan2SeqList = array();
				$lan2SeqList[] = 0; // ��ü ������ ������쿡 ���� �����߻� ����
				// �������� ó���ϰ� ���� �����۾� ( ������ �����ϴϱ� ���� ��ϵȰ͵� �����ǳ�;;;; )
				for ($c = 1 ; $c < $b ; $c ++ ) if (${'LANG2_SEQ_' . $c} != null ) $lan2SeqList[] = ${'LANG2_SEQ_' . $c};
				
				$this->rmf->getApplyLanguage2DelProcess(array('Y',$PRJ_IDX,$APPL_IDX,$PRJ_IDX,$APPL_IDX),$lan2SeqList);
				
				for ($c = 1 ; $c < $b ; $c ++ )
				{
					
					$this->rmf->getApplyLanguage2Process(array($PRJ_IDX,$APPL_IDX
																										,${'LANG2_SEQ_' . $c}
																										,${'LANG2_NM_' . $c},${'LANG2_CD_' . $c}
																										,${'LANG2_SPCH_LVL_NM_' . $c},${'LANG2_SPCH_LVL_CD_' . $c}
																										,${'LANG2_WRT_LVL_NM_' . $c},${'LANG2_WRT_LVL_CD_' . $c}
																										,${'LANG2_CMP_LVL_NM_' . $c},${'LANG2_CMP_LVL_CD_' . $c}
																										,$PRJ_IDX,$APPL_IDX
																										,$PRJ_IDX,$APPL_IDX
																										,${'LANG2_NM_' . $c},${'LANG2_CD_' . $c}
																										,${'LANG2_SPCH_LVL_NM_' . $c},${'LANG2_SPCH_LVL_CD_' . $c}
																										,${'LANG2_WRT_LVL_NM_' . $c},${'LANG2_WRT_LVL_CD_' . $c}
																										,${'LANG2_CMP_LVL_NM_' . $c},${'LANG2_CMP_LVL_CD_' . $c}
																										));
																							   
				}
				
				
			}
			
			
			
			
			// �ڰ��� ����
			if ($YNList[0]->LICENSE_USE_YN == 'Y')
			{

				$postArrayList = array(  'LIC_SEQ'
																,'LIC_NM','LIC_CD'
																,'LIC_PB_NM'
																,'LIC_DT1','LIC_DT2','LIC_DT3'
																,'LIC_FILE_NM','LIC_FILE_CD'
																,'LIC_NUM');
				$LICENSE_FORM_COUNT = $this->input->post('LICENSE_FORM_COUNT');
				
				// �߰� �Ȱ� ��ŭ for��
				$b = 1;
				// �Ѱ��̻��� �׸� �����Ͱ� ������ insert�Ѵ�. �ʼ�üũ �۾��� �� ���ܿ��� DB���� ������ �����ͼ� ó�� ( �̰� 2�� �۾��� )
				for ($a = 1 ; $a <= $LICENSE_FORM_COUNT ; $a ++ )
				{
					$blank_flag = null;
					
					foreach ($postArrayList as $key => $postval) 
					{
					
						if ($this->input->post($postval . '_' . $a) != '') 
						{
							$blank_flag = 'on';
							break;
						}
					}
					
					if ($blank_flag == 'on' )
					{
						foreach ($postArrayList as $key => $postval) 
						{
							//echo $postval . '-----' . $this->input->post($postval . '_' . $a) . '<br>';
							${$postval . '_' . $b} = $this->input->post($postval . '_' . $a);
							${$postval . '_' . $b} = ${$postval . '_' . $b} == '' ? null : ${$postval . '_' . $b};
						}
						$b ++;
					}
				}
				
				// �׸��� �ִ� �Ϳ� ���ؼ� �ٽ� ���������Ȱ����� .
				$licSeqList = array();
				$licSeqList[] = 0; // ��ü ������ ������쿡 ���� �����߻� ����
				// �������� ó���ϰ� ���� �����۾� ( ������ �����ϴϱ� ���� ��ϵȰ͵� �����ǳ�;;;; )
				for ($c = 1 ; $c < $b ; $c ++ ) if (${'LIC_SEQ_' . $c} != null ) $licSeqList[] = ${'LIC_SEQ_' . $c};
				
				$this->rmf->getApplyLicenseDelProcess(array('Y',$PRJ_IDX,$APPL_IDX,$PRJ_IDX,$APPL_IDX),$licSeqList);
				
				for ($c = 1 ; $c < $b ; $c ++ )
				{
					${'LIC_DT_' . $c} = (${'LIC_DT1_' . $c} != null && ${'LIC_DT2_' . $c} != null && ${'LIC_DT3_' . $c} != null ) ? ${'LIC_DT1_' . $c} .'-'. ${'LIC_DT2_' . $c} .'-' . ${'LIC_DT3_' . $c} : null;
					$this->rmf->getApplyLicenseProcess(array($PRJ_IDX,$APPL_IDX
																										,${'LIC_SEQ_' . $c}
																										,${'LIC_NM_' . $c},${'LIC_CD_' . $c}
																										,${'LIC_PB_NM_' . $c}
																										,${'LIC_DT_' . $c}
																										,${'LIC_FILE_NM_' . $c},${'LIC_FILE_CD_' . $c}
																										,${'LIC_NUM_' . $c}
																										,$PRJ_IDX,$APPL_IDX
																										,$PRJ_IDX,$APPL_IDX
																										,${'LIC_NM_' . $c},${'LIC_CD_' . $c}
																										,${'LIC_PB_NM_' . $c}
																										,${'LIC_DT_' . $c}
																										,${'LIC_FILE_NM_' . $c},${'LIC_FILE_CD_' . $c}
																										,${'LIC_NUM_' . $c}
																										));
																							   
				}
				
				
			}
			
			// ��ǻ�� ��� �ɷ�
			if ($YNList[0]->PC_USE_YN == 'Y')
			{
				
				$postArrayList = array(  'CD_CPU_IDX'
																,'PC_LVL_NM','PC_LVL_CD');
				$COMPUTER_FORM_COUNT = $this->input->post('LICENSE_FORM_COUNT');
			
				// �߰� �Ȱ� ��ŭ for��
				$b = 1;
				// �Ѱ��̻��� �׸� �����Ͱ� ������ insert�Ѵ�. �ʼ�üũ �۾��� �� ���ܿ��� DB���� ������ �����ͼ� ó�� ( �̰� 2�� �۾��� )
				for ($a = 1 ; $a <= $COMPUTER_FORM_COUNT ; $a ++ )
				{
					$blank_flag = null;
					
					foreach ($postArrayList as $key => $postval) 
					{
					
						if ($this->input->post($postval . '_' . $a) != '') 
						{
							$blank_flag = 'on';
							break;
						}
					}
					
					if ($blank_flag == 'on' )
					{
						foreach ($postArrayList as $key => $postval) 
						{
							//echo $postval . '-----' . $this->input->post($postval . '_' . $a) . '<br>';
							${$postval . '_' . $b} = $this->input->post($postval . '_' . $a);
							${$postval . '_' . $b} = ${$postval . '_' . $b} == '' ? null : ${$postval . '_' . $b};
						}
						$b ++;
					}
				}
				
				for ($c = 1 ; $c < $b ; $c ++ )
				{
					$this->rmf->getApplyComputerProcess(array($PRJ_IDX,$APPL_IDX
																										,${'CD_CPU_IDX_' . $c}
																										,${'PC_LVL_NM_' . $c},${'PC_LVL_CD_' . $c}
																										,$PRJ_IDX,$APPL_IDX
																										,${'CD_CPU_IDX_' . $c}
																										,${'PC_LVL_NM_' . $c},${'PC_LVL_CD_' . $c}
																										));
																							   
				}
				
				
			}
			
			
			// Ȱ������ 
			if ($YNList[0]->SERVE_USE_YN == 'Y')
			{

				$postArrayList = array(  'SRV_SEQ'
																,'SRV_STDT1','SRV_STDT2','SRV_EDDT1','SRV_EDDT2'
																,'SRV_TP_NM','SRV_TP_CD'
																,'SRV_ORG_NM'
																,'SRV_CNTNT');
				$SERVE_FORM_COUNT = $this->input->post('SERVE_FORM_COUNT');
				
				// �߰� �Ȱ� ��ŭ for��
				$b = 1;
				// �Ѱ��̻��� �׸� �����Ͱ� ������ insert�Ѵ�. �ʼ�üũ �۾��� �� ���ܿ��� DB���� ������ �����ͼ� ó�� ( �̰� 2�� �۾��� )
				for ($a = 1 ; $a <= $SERVE_FORM_COUNT ; $a ++ )
				{
					$blank_flag = null;
					
					foreach ($postArrayList as $key => $postval) 
					{
					
						if ($this->input->post($postval . '_' . $a) != '') 
						{
							$blank_flag = 'on';
							break;
						}
					}
					
					if ($blank_flag == 'on' )
					{
						foreach ($postArrayList as $key => $postval) 
						{
							//echo $postval . '-----' . $this->input->post($postval . '_' . $a) . '<br>';
							${$postval . '_' . $b} = $this->input->post($postval . '_' . $a);
							${$postval . '_' . $b} = ${$postval . '_' . $b} == '' ? null : ${$postval . '_' . $b};
						}
						$b ++;
					}
				}
				
				// �׸��� �ִ� �Ϳ� ���ؼ� �ٽ� ���������Ȱ����� .
				$srveSeqList = array();
				$srveSeqList[] = 0; // ��ü ������ ������쿡 ���� �����߻� ����
				// �������� ó���ϰ� ���� �����۾� ( ������ �����ϴϱ� ���� ��ϵȰ͵� �����ǳ�;;;; )
				for ($c = 1 ; $c < $b ; $c ++ ) if (${'SRV_SEQ_' . $c} != null ) $srveSeqList[] = ${'SRV_SEQ_' . $c};
				
				$this->rmf->getApplyServeDelProcess(array('Y',$PRJ_IDX,$APPL_IDX,$PRJ_IDX,$APPL_IDX),$srveSeqList);
				
				for ($c = 1 ; $c < $b ; $c ++ )
				{
					${'SRV_STDT_' . $c} = (${'SRV_STDT1_' . $c} != null && ${'SRV_STDT1_' . $c} != null ) ? ${'SRV_STDT1_' . $c} .'-'. ${'SRV_STDT2_' . $c} .'-01' : null;
					${'SRV_EDDT_' . $c} = (${'SRV_EDDT1_' . $c} != null && ${'SRV_EDDT1_' . $c} != null ) ? ${'SRV_EDDT1_' . $c} .'-'. ${'SRV_EDDT2_' . $c} .'-01' : null;
					$this->rmf->getApplyServeProcess(array($PRJ_IDX,$APPL_IDX
																										,${'SRV_SEQ_' . $c}
																										,${'SRV_STDT_' . $c},${'SRV_EDDT_' . $c}
																										,${'SRV_TP_NM_' . $c},${'SRV_TP_CD_' . $c}
																										,${'SRV_ORG_NM_' . $c}
																										,Html2String(${'SRV_CNTNT_' . $c})
																										,$PRJ_IDX,$APPL_IDX
																										,$PRJ_IDX,$APPL_IDX
																										,${'SRV_STDT_' . $c},${'SRV_EDDT_' . $c}
																										,${'SRV_TP_NM_' . $c},${'SRV_TP_CD_' . $c}
																										,${'SRV_ORG_NM_' . $c}
																										,Html2String(${'SRV_CNTNT_' . $c})
																										));
																							   
				}
				
				
			}
			
			// �������  
			if ($YNList[0]->TECH_USE_YN == 'Y')
			{

				$postArrayList = array(  'TCH_SEQ'
																,'TCH_NM','TCH_LVL','TCH_CNTNT');
				$TECH_FORM_COUNT = $this->input->post('TECH_FORM_COUNT');
				
				// �߰� �Ȱ� ��ŭ for��
				$b = 1;
				// �Ѱ��̻��� �׸� �����Ͱ� ������ insert�Ѵ�. �ʼ�üũ �۾��� �� ���ܿ��� DB���� ������ �����ͼ� ó�� ( �̰� 2�� �۾��� )
				for ($a = 1 ; $a <= $TECH_FORM_COUNT ; $a ++ )
				{
					$blank_flag = null;
					
					foreach ($postArrayList as $key => $postval) 
					{
					
						if ($this->input->post($postval . '_' . $a) != '') 
						{
							$blank_flag = 'on';
							break;
						}
					}
					
					if ($blank_flag == 'on' )
					{
						foreach ($postArrayList as $key => $postval) 
						{
							//echo $postval . '-----' . $this->input->post($postval . '_' . $a) . '<br>';
							${$postval . '_' . $b} = $this->input->post($postval . '_' . $a);
							${$postval . '_' . $b} = ${$postval . '_' . $b} == '' ? null : ${$postval . '_' . $b};
						}
						$b ++;
					}
				}
				
				// �׸��� �ִ� �Ϳ� ���ؼ� �ٽ� ���������Ȱ����� .
				$techSeqList = array();
				$techSeqList[] = 0; // ��ü ������ ������쿡 ���� �����߻� ����
				// �������� ó���ϰ� ���� �����۾� ( ������ �����ϴϱ� ���� ��ϵȰ͵� �����ǳ�;;;; )
				for ($c = 1 ; $c < $b ; $c ++ ) if (${'TCH_SEQ_' . $c} != null ) $techSeqList[] = ${'TCH_SEQ_' . $c};
				
				$this->rmf->getApplyTechDelProcess(array('Y',$PRJ_IDX,$APPL_IDX,$PRJ_IDX,$APPL_IDX),$techSeqList);
				
				for ($c = 1 ; $c < $b ; $c ++ )
				{
					$this->rmf->getApplyTechProcess(array($PRJ_IDX,$APPL_IDX
																										,${'TCH_SEQ_' . $c}
																										,${'TCH_NM_' . $c},${'TCH_LVL_' . $c},Html2String(${'TCH_CNTNT_' . $c})
																										,$PRJ_IDX,$APPL_IDX
																										,$PRJ_IDX,$APPL_IDX
																										,${'TCH_NM_' . $c},${'TCH_LVL_' . $c},Html2String(${'TCH_CNTNT_' . $c})
																										));
																							   
				}
				
				
			}
			
			
			// ��������  
			if ($YNList[0]->EDUCATION_USE_YN == 'Y')
			{

				$postArrayList = array(  'EDU_SEQ'
																,'EDU_STDT1','EDU_STDT2','EDU_EDDT1','EDU_EDDT2'
																,'EDU_NM','EDU_ORG_NM','EDU_CNTNT');
				$EDUCATION_FORM_COUNT = $this->input->post('EDUCATION_FORM_COUNT');
				
				// �߰� �Ȱ� ��ŭ for��
				$b = 1;
				// �Ѱ��̻��� �׸� �����Ͱ� ������ insert�Ѵ�. �ʼ�üũ �۾��� �� ���ܿ��� DB���� ������ �����ͼ� ó�� ( �̰� 2�� �۾��� )
				for ($a = 1 ; $a <= $EDUCATION_FORM_COUNT ; $a ++ )
				{
					$blank_flag = null;
					
					foreach ($postArrayList as $key => $postval) 
					{
					
						if ($this->input->post($postval . '_' . $a) != '') 
						{
							$blank_flag = 'on';
							break;
						}
					}
					
					if ($blank_flag == 'on' )
					{
						foreach ($postArrayList as $key => $postval) 
						{
							//echo $postval . '-----' . $this->input->post($postval . '_' . $a) . '<br>';
							${$postval . '_' . $b} = $this->input->post($postval . '_' . $a);
							${$postval . '_' . $b} = ${$postval . '_' . $b} == '' ? null : ${$postval . '_' . $b};
						}
						$b ++;
					}
				}
				
				// �׸��� �ִ� �Ϳ� ���ؼ� �ٽ� ���������Ȱ����� .
				$educSeqList = array();
				$educSeqList[] = 0; // ��ü ������ ������쿡 ���� �����߻� ����
				// �������� ó���ϰ� ���� �����۾� ( ������ �����ϴϱ� ���� ��ϵȰ͵� �����ǳ�;;;; )
				for ($c = 1 ; $c < $b ; $c ++ ) if (${'EDU_SEQ_' . $c} != null ) $educSeqList[] = ${'EDU_SEQ_' . $c};
				
				$this->rmf->getApplyEducationDelProcess(array('Y',$PRJ_IDX,$APPL_IDX,$PRJ_IDX,$APPL_IDX),$educSeqList);
				
				for ($c = 1 ; $c < $b ; $c ++ )
				{
					${'EDU_STDT_' . $c} = (${'EDU_STDT1_' . $c} != null && ${'EDU_STDT1_' . $c} != null ) ? ${'EDU_STDT1_' . $c} .'-'. ${'EDU_STDT2_' . $c} .'-01' : null;
					${'EDU_EDDT_' . $c} = (${'EDU_EDDT1_' . $c} != null && ${'EDU_EDDT1_' . $c} != null ) ? ${'EDU_EDDT1_' . $c} .'-'. ${'EDU_EDDT2_' . $c} .'-01' : null;
					$this->rmf->getApplyEducationProcess(array($PRJ_IDX,$APPL_IDX
																										,${'EDU_SEQ_' . $c}
																										,${'EDU_STDT_' . $c},${'EDU_EDDT_' . $c}
																										,${'EDU_NM_' . $c},${'EDU_ORG_NM_' . $c},Html2String(${'EDU_CNTNT_' . $c})
																										,$PRJ_IDX,$APPL_IDX
																										,$PRJ_IDX,$APPL_IDX
																										,${'EDU_STDT_' . $c},${'EDU_EDDT_' . $c}
																										,${'EDU_NM_' . $c},${'EDU_ORG_NM_' . $c},Html2String(${'EDU_CNTNT_' . $c})
																										));
																							   
				}
				
				
			}
			
			
			// �ؿ�Ȱ��  
			if ($YNList[0]->TRAINING_USE_YN == 'Y')
			{
				
				$postArrayList = array(  'TRN_SEQ'
																,'TRN_STDT1','TRN_STDT2','TRN_EDDT1','TRN_EDDT2'
																,'TRN_TP_NM','TRN_TP_CD'
																,'TRN_ORG_NM','TRN_OBJ_NM','TRN_CNTNT','TRN_CTRY_NM');
				$TRAINING_FORM_COUNT = $this->input->post('TRAINING_FORM_COUNT');
				
				// �߰� �Ȱ� ��ŭ for��
				$b = 1;
				// �Ѱ��̻��� �׸� �����Ͱ� ������ insert�Ѵ�. �ʼ�üũ �۾��� �� ���ܿ��� DB���� ������ �����ͼ� ó�� ( �̰� 2�� �۾��� )
				for ($a = 1 ; $a <= $TRAINING_FORM_COUNT ; $a ++ )
				{
					$blank_flag = null;
					
					foreach ($postArrayList as $key => $postval) 
					{
					
						if ($this->input->post($postval . '_' . $a) != '') 
						{
							$blank_flag = 'on';
							break;
						}
					}
					
					if ($blank_flag == 'on' )
					{
						foreach ($postArrayList as $key => $postval) 
						{
							//echo $postval . '-----' . $this->input->post($postval . '_' . $a) . '<br>';
							${$postval . '_' . $b} = $this->input->post($postval . '_' . $a);
							${$postval . '_' . $b} = ${$postval . '_' . $b} == '' ? null : ${$postval . '_' . $b};
						}
						$b ++;
					}
				}
				
				// �׸��� �ִ� �Ϳ� ���ؼ� �ٽ� ���������Ȱ����� .
				$trngSeqList = array();
				$trngSeqList[] = 0; // ��ü ������ ������쿡 ���� �����߻� ����
				// �������� ó���ϰ� ���� �����۾� ( ������ �����ϴϱ� ���� ��ϵȰ͵� �����ǳ�;;;; )
				for ($c = 1 ; $c < $b ; $c ++ ) if (${'TRN_SEQ_' . $c} != null ) $trngSeqList[] = ${'TRN_SEQ_' . $c};
				
				$this->rmf->getApplyTrainingDelProcess(array('Y',$PRJ_IDX,$APPL_IDX,$PRJ_IDX,$APPL_IDX),$trngSeqList);
				
				for ($c = 1 ; $c < $b ; $c ++ )
				{
					${'TRN_STDT_' . $c} = (${'TRN_STDT1_' . $c} != null && ${'TRN_STDT1_' . $c} != null ) ? ${'TRN_STDT1_' . $c} .'-'. ${'TRN_STDT2_' . $c} .'-01' : null;
					${'TRN_EDDT_' . $c} = (${'TRN_EDDT1_' . $c} != null && ${'TRN_EDDT1_' . $c} != null ) ? ${'TRN_EDDT1_' . $c} .'-'. ${'TRN_EDDT2_' . $c} .'-01' : null;
					$this->rmf->getApplyTrainingProcess(array($PRJ_IDX,$APPL_IDX
																										,${'TRN_SEQ_' . $c}
																										,${'TRN_STDT_' . $c},${'TRN_EDDT_' . $c}
																										,${'TRN_TP_NM_' . $c},${'TRN_TP_CD_' . $c}
																										,${'TRN_ORG_NM_' . $c},${'TRN_OBJ_NM_' . $c},Html2String(${'TRN_CNTNT_' . $c}),${'TRN_CTRY_NM_' . $c}
																										,$PRJ_IDX,$APPL_IDX
																										,$PRJ_IDX,$APPL_IDX
																										,${'TRN_STDT_' . $c},${'TRN_EDDT_' . $c}
																										,${'TRN_TP_NM_' . $c},${'TRN_TP_CD_' . $c}
																										,${'TRN_ORG_NM_' . $c},${'TRN_OBJ_NM_' . $c},Html2String(${'TRN_CNTNT_' . $c}),${'TRN_CTRY_NM_' . $c}
																										));
																							   
				}
				
				
			}
			
			
			
			// ������  
			if ($YNList[0]->CONTENT_USE_YN == 'Y')
			{
				
				$postArrayList = array('RSM_CNTNT_IDX','APPL_CNTNT');
				$CONTENT_FORM_COUNT = $this->input->post('CONTENT_FORM_COUNT');
				
				// �߰� �Ȱ� ��ŭ for��
				$b = 1;
				// �Ѱ��̻��� �׸� �����Ͱ� ������ insert�Ѵ�. �ʼ�üũ �۾��� �� ���ܿ��� DB���� ������ �����ͼ� ó�� ( �̰� 2�� �۾��� )
				for ($a = 1 ; $a <= $CONTENT_FORM_COUNT ; $a ++ )
				{
					$blank_flag = null;
					
					foreach ($postArrayList as $key => $postval) 
					{
					
						if ($this->input->post($postval . '_' . $a) != '') 
						{
							$blank_flag = 'on';
							break;
						}
					}
					
					if ($blank_flag == 'on' )
					{
						foreach ($postArrayList as $key => $postval) 
						{
							//echo $postval . '-----' . $this->input->post($postval . '_' . $a) . '<br>';
							${$postval . '_' . $b} = $this->input->post($postval . '_' . $a);
							${$postval . '_' . $b} = ${$postval . '_' . $b} == '' ? null : ${$postval . '_' . $b};
						}
						$b ++;
					}
				}
				
				for ($c = 1 ; $c < $b ; $c ++ )
				{
					$this->rmf->getApplyContentProcess(array( $PRJ_IDX,$APPL_IDX
																										,${'RSM_CNTNT_IDX_' . $c}
																										,Html2String(${'APPL_CNTNT_' . $c})
																										,$PRJ_IDX,$APPL_IDX
																										,${'RSM_CNTNT_IDX_' . $c},Html2String(${'APPL_CNTNT_' . $c})
																										));
																							   
				}
				
				
			}
			
			
			// ���н���
			if ($YNList[0]->LANGUAGE_USE_YN == 'Y')
			{
				
				$postArrayList = array(  'LAN_IDX'
																,'LANG_IDX'
																,'LAN_SCORE'
																,'LAN_LVL_IDX'
																,'LAN_DT1','LAN_DT2','LAN_DT3'
																,'LAN_NUM');
				$LANGUAGE_FORM_COUNT = $this->input->post('LANGUAGE_FORM_COUNT');
			
				// �߰� �Ȱ� ��ŭ for��
				$b = 1;
				// �Ѱ��̻��� �׸� �����Ͱ� ������ insert�Ѵ�. �ʼ�üũ �۾��� �� ���ܿ��� DB���� ������ �����ͼ� ó�� ( �̰� 2�� �۾��� )
				for ($a = 1 ; $a <= $LANGUAGE_FORM_COUNT ; $a ++ )
				{
					$blank_flag = null;
					
					foreach ($postArrayList as $key => $postval) 
					{
					
						if ($this->input->post($postval . '_' . $a) != '') 
						{
							$blank_flag = 'on';
							break;
						}
					}
					
					if ($blank_flag == 'on' )
					{
						foreach ($postArrayList as $key => $postval) 
						{
							//echo $postval . '-----' . $this->input->post($postval . '_' . $a) . '<br>';
							${$postval . '_' . $b} = $this->input->post($postval . '_' . $a);
							${$postval . '_' . $b} = ${$postval . '_' . $b} == '' ? null : ${$postval . '_' . $b};
						}
						$b ++;
					}
				}
				
				for ($c = 1 ; $c < $b ; $c ++ )
				{
					${'LAN_DT_' . $c} = (${'LAN_DT1_' . $c} != null && ${'LAN_DT2_' . $c} != null && ${'LAN_DT3_' . $c} != null ) ? ${'LAN_DT1_' . $c} .'-'. ${'LAN_DT2_' . $c} .'-' . ${'LAN_DT3_' . $c} : null;
					$this->rmf->getApplyLanguageProcess(array($PRJ_IDX,$APPL_IDX
																									,${'LAN_IDX_' . $c}
																									,${'LAN_SCORE_' . $c},${'LAN_LVL_IDX_' . $c}
																									,${'LAN_DT_' . $c}
																									,${'LAN_NUM_' . $c}
																									,$PRJ_IDX,$APPL_IDX
																									,${'LAN_IDX_' . $c}
																									,${'LANG_IDX_' . $c}
																									,${'LAN_SCORE_' . $c},${'LAN_LVL_IDX_' . $c}
																									,${'LAN_DT_' . $c}
																									,${'LAN_NUM_' . $c}
																									));
																							   
				}
				
				
			}
			
			
			
			// �б� ���� ����!!!!!  
			if ($YNList[0]->SCHOOL_USE_YN == 'Y')
			{
				$SCH_EDDT3_1 = $this->input->post('SCH_EDDT3_1');
				$postArrayList = array(  'SCH_SEQ'
																,'SCH_TP'
																,'SCH_STDT1','SCH_STDT2','SCH_EDDT1','SCH_EDDT2'
																,'SCH_ETTP1','SCH_ETTP2'
																,'SCH_NM','SCH_CD'
																,'SCH_LOC','SCH_JUYA'
																,'SCH_MAJOR_NM','SCH_MAJOR_CD','SCH_AFF'
																,'SCH_SUB_MAJOR_TP'
																,'SCH_SUB_MAJOR_NM','SCH_SUB_MAJOR_CD','SCH_SUB_AFF'
																,'SCH_HAKJUM','SCH_MAX_HAKJUM','SCH_ISU_HAKJUM','SCH_FGRD_TP','SCH_BRANCH_TP');
				$SCHOOL_FORM_COUNT = $this->input->post('SCHOOL_FORM_COUNT');
				
				// �߰� �Ȱ� ��ŭ for��
				$b = 1;
				// �Ѱ��̻��� �׸� �����Ͱ� ������ insert�Ѵ�. �ʼ�üũ �۾��� �� ���ܿ��� DB���� ������ �����ͼ� ó�� ( �̰� 2�� �۾��� )
				for ($a = 1 ; $a <= $SCHOOL_FORM_COUNT ; $a ++ )
				{
					$blank_flag = null;
					
					foreach ($postArrayList as $key => $postval) 
					{
					
						if ($this->input->post($postval . '_' . $a) != '') 
						{
							$blank_flag = 'on';
							break;
						}
					}
					
					if ($blank_flag == 'on' )
					{
						foreach ($postArrayList as $key => $postval) 
						{
							//echo $postval . '-----' . $this->input->post($postval . '_' . $a) . '<br>';
							${$postval . '_' . $b} = $this->input->post($postval . '_' . $a);
							${$postval . '_' . $b} = ${$postval . '_' . $b} == '' ? null : ${$postval . '_' . $b};
						}
						$b ++;
					}
				}
				
				// �׸��� �ִ� �Ϳ� ���ؼ� �ٽ� ���������Ȱ����� .
				$schlSeqList = array();
				$schlSeqList[] = 0; // ��ü ������ ������쿡 ���� �����߻� ����
				// �������� ó���ϰ� ���� �����۾� ( ������ �����ϴϱ� ���� ��ϵȰ͵� �����ǳ�;;;; )
				for ($c = 1 ; $c < $b ; $c ++ ) if (${'SCH_SEQ_' . $c} != null ) $schlSeqList[] = ${'SCH_SEQ_' . $c};
				
				$this->rmf->getApplySchoolDelProcess(array('Y',$PRJ_IDX,$APPL_IDX,$PRJ_IDX,$APPL_IDX),$schlSeqList);
				
				for ($c = 1 ; $c < $b ; $c ++ )
				{
					${'SCH_STDT_' . $c} = (${'SCH_STDT1_' . $c} != null && ${'SCH_STDT1_' . $c} != null ) ? ${'SCH_STDT1_' . $c} .'-'. ${'SCH_STDT2_' . $c} .'-01' : null;
					$EDDT_FLAG = $SCH_EDDT3_1 != '' && $c == 1 ? $SCH_EDDT3_1 : '01';
					
					${'SCH_EDDT_' . $c} = (${'SCH_EDDT1_' . $c} != null && ${'SCH_EDDT1_' . $c} != null ) ? ${'SCH_EDDT1_' . $c} .'-'. ${'SCH_EDDT2_' . $c} .'-' . $EDDT_FLAG : null;
				
					$this->rmf->getApplySchoolProcess(array($PRJ_IDX,$APPL_IDX
																									,${'SCH_SEQ_' . $c}
																									,${'SCH_TP_' . $c}
																									,${'SCH_STDT_' . $c},${'SCH_EDDT_' . $c}
																									,${'SCH_ETTP1_' . $c},${'SCH_ETTP2_' . $c}
																									,${'SCH_NM_' . $c},${'SCH_CD_' . $c}
																									,${'SCH_LOC_' . $c},${'SCH_JUYA_' . $c}
																									,${'SCH_MAJOR_NM_' . $c},${'SCH_MAJOR_CD_' . $c},${'SCH_AFF_' . $c}
																									,${'SCH_SUB_MAJOR_TP_' . $c}
																									,${'SCH_SUB_MAJOR_NM_' . $c},${'SCH_SUB_MAJOR_CD_' . $c},${'SCH_SUB_AFF_' . $c}
																									,${'SCH_HAKJUM_' . $c},${'SCH_MAX_HAKJUM_' . $c},${'SCH_ISU_HAKJUM_' . $c},${'SCH_FGRD_TP_' . $c},${'SCH_BRANCH_TP_' . $c}
																									,$PRJ_IDX,$APPL_IDX
																									,$PRJ_IDX,$APPL_IDX
																									,${'SCH_TP_' . $c}
																									,${'SCH_STDT_' . $c},${'SCH_EDDT_' . $c}
																									,${'SCH_ETTP1_' . $c},${'SCH_ETTP2_' . $c}
																									,${'SCH_NM_' . $c},${'SCH_CD_' . $c}
																									,${'SCH_LOC_' . $c},${'SCH_JUYA_' . $c}
																									,${'SCH_MAJOR_NM_' . $c},${'SCH_MAJOR_CD_' . $c},${'SCH_AFF_' . $c}
																									,${'SCH_SUB_MAJOR_TP_' . $c}
																									,${'SCH_SUB_MAJOR_NM_' . $c},${'SCH_SUB_MAJOR_CD_' . $c},${'SCH_SUB_AFF_' . $c}
																									,${'SCH_HAKJUM_' . $c},${'SCH_MAX_HAKJUM_' . $c},${'SCH_ISU_HAKJUM_' . $c},${'SCH_FGRD_TP_' . $c},${'SCH_BRANCH_TP_' . $c}
																									));
																						   
				}
				
				
			}
			
			
			
			// ���Ͼ��ε�
			// ������  
			if ($YNList[0]->FILE_USE_YN == 'Y')
			{
				$this->load->library('upload');
				
				if ( !$PRJ_IDX || !$APPL_IDX )
				{
					jsalertmsg('���Ͼ��ε忡 ������ ���� ���ε忡 �����߽��ϴ�. �ٽ� �õ����ּ���.');
					jshistoryback();
					exit;
				}
				
				if (!file_exists(APPLY_RESUME_FILE_DIRECTORY . $PRJ_IDX)) mkdir(APPLY_RESUME_FILE_DIRECTORY . $PRJ_IDX);
				
				$res = $this->rmf->getFileList(array($RSM_IDX,'N',$PRJ_IDX,$APPL_IDX,'N'));
				
				$dataFileCount = $res->num_rows();
				$dataFile = $res->result();
			
				if ($dataFileCount > 0 )
				{
					foreach ($dataFile as $key => $flist)
					{
						//echo $flist->FILE_AVL_EXT . '---' . $flist->FILE_MAX_SIZE . '<br>';
						$config['upload_path'] = APPLY_RESUME_FILE_DIRECTORY . $PRJ_IDX;
						$config['allowed_types'] = $flist->FILE_AVL_EXT;
						$config['overwrite'] = TRUE;
						$config['max_size'] = $flist->FILE_MAX_SIZE;
						//$config['date_name'] = TRUE;
						$this->upload->initialize($config);
						$this->upload->setChangeFileName($APPL_IDX . '_' . $flist->RSM_FILE_IDX);
						
						if (!$this->upload->do_upload('RSM_FILE_NM_' . ($key + 1)))
						{
							if ( $flist->FILE_ESN_YN == 'Y' )
							{
								if (!@$_FILES['RSM_FILE_NM_' . ($key + 1)][tmp_name] && !$flist->APPL_FILE_NM )
								{
									jsalertmsg($flist->FILE_TITLE . ' �׸��� �ʼ� �Դϴ�.');
									jshistoryback();
									exit;
								}
							}
							
							if (@$_FILES['RSM_FILE_NM_' . ($key + 1)][tmp_name])
							{
								jsalertmsg($flist->FILE_TITLE . ' �׸��� ���Ͼ��ε尡 ���� �Ͽ����ϴ�. ');
								jshistoryback();
								exit;
							}
							
						}
						else
						{
							// �����ϰ�� ������ �ֱ�
							$uploaddata = $this->upload->data();
							$this->rmf->getApplyFileProcess(array($PRJ_IDX,$APPL_IDX
																									 ,$flist->RSM_FILE_IDX
																									 ,$uploaddata['client_name']
																									 ,$uploaddata['file_name']
																									 ,$PRJ_IDX,$APPL_IDX
																									 ,$flist->RSM_FILE_IDX
																									 ,$uploaddata['client_name']
																									 ,$uploaddata['file_name']));
						}
						
					}
				}
				
				//RSM_FILE_NM_
				
			}
			
			/* ���μ����� �������ϰ� �������� �����ȣ�� ���ô�. */
			$FINAL_SUBMIT = $this->input->post('FINAL_SUBMIT');
			$result_error_msg = null;
			$data['PRJ_IDX'] = $PRJ_IDX;
			if ($FINAL_SUBMIT == 'submit')
			{
				$this->applySubmit($PRJ_IDX , $APPL_IDX, $UNIT_IDX_AR[0]['CODE']);
			}
			else
			{
				
				$this->frontView('front/apply/applySave_form' , $data);
			}
			
		}
		
		function applyFinalSubmit()
		{
			$PRJ_IDX = $this->input->post('PRJ_IDX');
			$APPL_IDX = $this->input->post('APPL_IDX');
			$UNIT_IDX = $this->input->post('UNIT_IDX');
			
			$this->applySubmit($PRJ_IDX , $APPL_IDX, $UNIT_IDX);
		}
		
		private function applySubmit($PRJ_IDX , $APPL_IDX, $UNIT_IDX)
		{
				
				$this->load->model('front/apply/resumeform_model','rmf',true);
				$data['PRJ_IDX'] = $PRJ_IDX;
				$chkres = $this->rmf->getConfirmApplyNo(array($PRJ_IDX,$APPL_IDX,'N'));
				$chkresRs = $chkres->result();
				$result_error_msg = null;
				if ($chkres->num_rows() == 1 && $chkresRs[0]->APPLY_NO == null )
				{
					$fobj = array();
					$fobj['p_prj_idx'] = $PRJ_IDX;
					$fobj['p_unit_idx'] = $UNIT_IDX;
					$fobj['p_appl_idx'] = $APPL_IDX;
					$res = $this->rmf->getApplyNoExec($fobj);	
					if (count($res) == 1)
					{
						if ($res[0]['STEP_EDDT'] != '')
						{
							
						}
						else
						{
							$result_error_msg = 'proc';	
						}
					}
					else
					{
						$result_error_msg = 'proc';	
					}
					
					if ($result_error_msg == 'proc') 
					{
						jsalertmsg('���� ������ �����Ǿ����ϴ�.');
						jsredirect('/front/mypage');
						exit;
					}
					
				}
				else
				{
					// �������~ ������ ���ÿ� ó���߳�;;
					$result_error_msg = 'dup';
				}
				
				$res = $this->rmf->getApplyResultData(array($PRJ_IDX,$APPL_IDX,'N','N','N','N','N','N'));
				$rdata = $res->result();
				
				$data = null;
			
				foreach ($rdata[0] as $rkey => $rlist)
				{
					$data[$rkey] = $rlist;
				}
				
				
				$data['result_error_msg'] = $result_error_msg;
			
				
				$this->frontView('front/apply/applyResult_form' , $data);
				
		}
		
		// �����ȣ ó���� ���������
		function applyResult()
		{
			$data = null;
			
			$NAMEKOR = $this->input->post('NAMEKOR');
			$APPLY_NO = $this->input->post('APPLY_NO');
			$COMP_NM = $this->input->post('COMP_NM');
			$UNIT_NM = $this->input->post('UNIT_NM');
			$EMAIL = $this->input->post('EMAIL');
			$HTEL = $this->input->post('HTEL');
			$result_error_msg = $this->input->post('result_error_msg');

			$data['NAMEKOR'] = $NAMEKOR;
			$data['APPLY_NO'] = $APPLY_NO;
			$data['COMP_NM'] = $COMP_NM;
			$data['UNIT_NM'] = $UNIT_NM;
			$data['EMAIL'] = $EMAIL;
			$data['HTEL'] = $HTEL;
			$data['result_error_msg'] = $result_error_msg;
			
			$this->frontView('front/apply/applyResult_view' , $data);
		}
		
		// ���Ͼ��ε���� ó��
		function FileUploadDeleteProcess()
		{
			$this->load->model('front/apply/resumeform_model','rmf',true);
			$PRJ_IDX = $this->input->post('POPUP_PRJ_IDX');
			$APPL_IDX = $this->input->post('POPUP_APPL_IDX');
			$RSM_FILE_IDX = $this->input->post('popupCode');
			//echo APPLY_RESUME_FILE_DIRECTORY . $PRJ_IDX . '/' . $APPL_IDX . '.';
			$this->rmf->getApplyFileDelete(array($PRJ_IDX,$APPL_IDX,$RSM_FILE_IDX));
		}
		
	}
