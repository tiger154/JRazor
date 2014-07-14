<?
	class Apply extends MY_Controller
	{
		
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
		
		function Index()
		{
			
			$this->load->model('front/apply/resumeform_model','rmf',true);
			$this->load->model('admin/step/stepManagement_model','unit',true);
			
			// library
			
			$this->load->library('DataControl'); 
			$this->load->library('AuthFront');
			$this->load->library('FormBox'); 
			
			// 이력서 상단 컨텐츠 
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
			// 관리자 모드 일경우 (체크한번 해주시고)
			if ($ADMIN_FLAG != '')
			{
				$PRJ_IDX = $this->input->post('SPRJ_IDX');
				$APPLY_NO = $this->input->post('APPLY_NO');
				$data['APPLY_NO'] = $APPLY_NO;	
				$res = $this->unit->getProjectPassCode(array($PRJ_IDX));
				$rdata = $res->result();
				if ( $rdata[0]->PASSWD != base64_decode($ADMIN_FLAG) )
				{
					jsalertmsg('관리자 정보에 이상이 생겨 내용가져오기에 실패하였습니다.');
					winclose('on');
					exit;	
				}
				//관리자모드 체크후 apply_no를 이용해서 RECV_DI 값을 가져오기
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
					// 전 관리자에 왔어요	
				}
				else
				{
					jsalertmsg('해당 채용공고의 서류 접수가 마감되었습니다');
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
			// 자기소개 - 텍스트 컨텐츠
			
			// 추후에 다중 모집분야 작업이 있을예정 - 그러면 디피되는 형태도 그에 맞게 바뀌어야함. 손댈게 좀 생기는.
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
			$data['SELECTBOX_UNIT_IDX1'] = $this->formbox->getSelectBox($unitObj, '지원분야 선택' , $myUnitCd , $objType = 'array');
			
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
			
			// 이력서 대분류 항목을 보여주는 여부
			$res = $this->rmf->getResumeFormDisplayYNList(array($PRJ_IDX,$RESUME_IDX,'N'));
			$data['rsmdisplay'] = $res->result();
			
			
			// 가족사항 변수및 select box 설정
			$data['fmlyRs'] = null;
			if ($data['rsmdisplay'][0]->FAMILY_USE_YN == 'Y')
			{
				$fmlyres = $this->rmf->getApplyUserDataFamily(array($PRJ_IDX,$APPL_IDX,'N'));
				$data['fmlyRs'] = $fmlyres->result();
				
				// 가족사항
				/* 이건 샘플에서 사용할용도 이므로 걍 둬라 */
				$this->formbox->setId('FMLY_REL_CD');
				$this->formbox->setName('FMLY_REL_CD');
				$this->formbox->setOption('');
				$data['frmFMLY_REL_CD'] = $this->formbox->getSelectBox($this->datacontrol->getFile2Array('FAMILY_REL.txt'), '선택' , '' , $objType = 'array');	
				
				$this->formbox->setId('FMLY_SCH_CD');
				$this->formbox->setName('FMLY_SCH_CD');
				$this->formbox->setOption('');
				$data['frmFMLY_SCH_CD'] = $this->formbox->getSelectBox($this->datacontrol->getFile2Array('FAMILY_SCH.txt'), '선택' , '' , $objType = 'array');	
				
				$this->formbox->setId('FMLY_LIVE_YN');
				$this->formbox->setName('FMLY_LIVE_YN');
				$this->formbox->setOption('');
				$data['frmFMLY_LIVE_YN'] = $this->formbox->getSelectBox(array(array('Y','Y'),array('N','N')), '선택' , '' , $objType = 'array');	
				
				$this->formbox->setId('FMLY_HELP_YN');
				$this->formbox->setName('FMLY_HELP_YN');
				$this->formbox->setOption('');
				$data['frmFMLY_HELP_YN'] = $this->formbox->getSelectBox(array(array('Y','Y'),array('N','N')), '선택' , '' , $objType = 'array');	
				
				/* 로드데이터에 따른 셀렉트 박스 */
				foreach ($data['fmlyRs'] as $key => $fmlyList)
				{
					$fmlyIdx = $key + 1;
					$this->formbox->setId('FMLY_REL_CD_' . $fmlyIdx);
					$this->formbox->setName('FMLY_REL_CD_' . $fmlyIdx);
					$this->formbox->setOption('');
					$data['frmFMLY_REL_CD_' . $fmlyIdx] = $this->formbox->getSelectBox($this->datacontrol->getFile2Array('FAMILY_REL.txt'), '선택' , $fmlyList->FMLY_REL_CD , $objType = 'array');	
					
					$this->formbox->setId('FMLY_SCH_CD_' . $fmlyIdx);
					$this->formbox->setName('FMLY_SCH_CD_' . $fmlyIdx);
					$this->formbox->setOption('');
					$data['frmFMLY_SCH_CD_' . $fmlyIdx] = $this->formbox->getSelectBox($this->datacontrol->getFile2Array('FAMILY_SCH.txt'), '선택' , $fmlyList->FMLY_SCH_CD , $objType = 'array');	
					
					$this->formbox->setId('FMLY_LIVE_YN_' . $fmlyIdx);
					$this->formbox->setName('FMLY_LIVE_YN_' . $fmlyIdx);
					$this->formbox->setOption('');
					$data['frmFMLY_LIVE_YN_' . $fmlyIdx] = $this->formbox->getSelectBox(array(array('Y','Y'),array('N','N')), '선택' , $fmlyList->FMLY_LIVE_YN , $objType = 'array');	
					
					$this->formbox->setId('FMLY_HELP_YN_' . $fmlyIdx);
					$this->formbox->setName('FMLY_HELP_YN_' . $fmlyIdx);
					$this->formbox->setOption('');
					$data['frmFMLY_HELP_YN_' . $fmlyIdx] = $this->formbox->getSelectBox(array(array('Y','Y'),array('N','N')), '선택' , $fmlyList->FMLY_HELP_YN , $objType = 'array');
				}
				
			}
			
			// 경력사항 변수및 select box 설정
			$data['carrRs'] = null;
			if ($data['rsmdisplay'][0]->CAREER_USE_YN == 'Y')
			{
				$carrres = $this->rmf->getApplyUserDataCareer(array($PRJ_IDX,$APPL_IDX,'N'));
				$data['carrRs'] = $carrres->result();
				
				//셋업
				$crSubres = $this->rmf->getCareerSetList(array($RESUME_IDX,'N'));
				$data['careerDisplayType'] = $crSubres->result();
				
				$empTypeRs = $this->rmf->getCareerEmployTypeList(array('CIT',NULL,NULL,'N','N'));
				
				
				
				// 경력사항
				/* 이건 샘플 */
				// 기업형태 ( 큰놈인지 작은놈인지 )
				$this->formbox->setId('CAREER_EMP_TP_CD');
				$this->formbox->setName('CAREER_EMP_TP_CD');
				$this->formbox->setOption('');
				$data['frmCAREER_EMP_TP_CD'] = $this->formbox->getSelectBox($empTypeRs->result(), '고용형태' , '' , $objType = 'db');		
				
				$this->formbox->setId('CAREER_CMP_TP_CD');
				$this->formbox->setName('CAREER_CMP_TP_CD');
				$this->formbox->setOption('');
				$data['frmCAREER_CMP_TP_CD'] = $this->formbox->getSelectBox($this->datacontrol->getFile2Array('CAREER_COMPANY_TYPE.txt'), '기업형태' , '' , $objType = 'array');		
				
				// 재직인지 퇴사인지
				$this->formbox->setId('CAREER_STS_CD');
				$this->formbox->setName('CAREER_STS_CD');
				$this->formbox->setOption('');
				$data['frmCAREER_STS_CD'] = $this->formbox->getSelectBox($this->datacontrol->getFile2Array('CAREER_STATUS.txt'), '재직여부' , '' , $objType = 'array');		
				
				// 직위
				$this->formbox->setId('CAREER_PSTN_CD');
				$this->formbox->setName('CAREER_PSTN_CD');
				$this->formbox->setOption('');
				$data['frmCAREER_PSTN_CD'] = $this->formbox->getSelectBox($this->datacontrol->getFile2Array('CAREER_PSTN.txt'), '직위' , '' , $objType = 'array');		
				
				// 직책
				$this->formbox->setId('CAREER_PSTN_LVL_CD');
				$this->formbox->setName('CAREER_PSTN_LVL_CD');
				$this->formbox->setOption('');
				$data['frmCAREER_PSTN_LVL_CD'] = $this->formbox->getSelectBox($this->datacontrol->getFile2Array('CAREER_PSTN_LEVEL.txt'), '직책' , '' , $objType = 'array');
				
				// 기업이 어디있었는데?
				$this->formbox->setId('CAREER_LOC_CD');
				$this->formbox->setName('CAREER_LOC_CD');
				$this->formbox->setOption('');
				$data['frmCAREER_LOC_CD'] = $this->formbox->getSelectBox($this->datacontrol->getFile2Array('CAREER_LOCATION.txt'), '소재지' , '' , $objType = 'array');
				
				//퇴사사유
				$this->formbox->setId('CAREER_RETIRE_CD');
				$this->formbox->setName('CAREER_RETIRE_CD');
				$this->formbox->setOption('');
				$data['frmCAREER_RETIRE_CD'] = $this->formbox->getSelectBox($this->datacontrol->getFile2Array('CAREER_RETIRE_TYPE.txt'), '퇴사사유' , '' , $objType = 'array');
				
				/* 로드데이터에 따른 셀렉트 박스 */
				foreach ($data['carrRs'] as $key => $carrList)
				{
					$carrIdx = $key + 1;
					
					$this->formbox->setId('CAREER_EMP_TP_CD_' . $carrIdx);
					$this->formbox->setName('CAREER_EMP_TP_CD_' . $carrIdx);
					$this->formbox->setOption('');
					$data['frmCAREER_EMP_TP_CD_' . $carrIdx] = $this->formbox->getSelectBox($empTypeRs->result(), '고용형태' , $carrList->CAREER_EMP_TP_CD  , $objType = 'db');		
						
					$this->formbox->setId('CAREER_CMP_TP_CD_' . $carrIdx);
					$this->formbox->setName('CAREER_CMP_TP_CD_' . $carrIdx);
					$this->formbox->setOption('');
					$data['frmCAREER_CMP_TP_CD_' . $carrIdx] = $this->formbox->getSelectBox($this->datacontrol->getFile2Array('CAREER_COMPANY_TYPE.txt'), '기업형태' , $carrList->CAREER_CMP_TP_CD , $objType = 'array');		
					
					// 재직인지 퇴사인지
					$this->formbox->setId('CAREER_STS_CD_' . $carrIdx);
					$this->formbox->setName('CAREER_STS_CD_' . $carrIdx);
					$this->formbox->setOption('');
					$data['frmCAREER_STS_CD_' . $carrIdx] = $this->formbox->getSelectBox($this->datacontrol->getFile2Array('CAREER_STATUS.txt'), '재직여부' , $carrList->CAREER_STS_CD , $objType = 'array');		
					
					// 직위
					$this->formbox->setId('CAREER_PSTN_CD_' . $carrIdx);
					$this->formbox->setName('CAREER_PSTN_CD_' . $carrIdx);
					$this->formbox->setOption('');
					
					$data['frmCAREER_PSTN_CD_' . $carrIdx] = $this->formbox->getSelectBox($this->datacontrol->getFile2Array('CAREER_PSTN.txt'), '직위' , $carrList->CAREER_PSTN_CD , $objType = 'array');		
					
					// 직책
					$this->formbox->setId('CAREER_PSTN_LVL_CD_' . $carrIdx);
					$this->formbox->setName('CAREER_PSTN_LVL_CD_' . $carrIdx);
					$this->formbox->setOption('');
					
					$data['frmCAREER_PSTN_LVL_CD_' . $carrIdx] = $this->formbox->getSelectBox($this->datacontrol->getFile2Array('CAREER_PSTN_LEVEL.txt'), '직책' , $carrList->CAREER_PSTN_LVL_CD , $objType = 'array');
					
					// 기업이 어디있었는데?
					$this->formbox->setId('CAREER_LOC_CD_' . $carrIdx);
					$this->formbox->setName('CAREER_LOC_CD_' . $carrIdx);
					$this->formbox->setOption('');
					$data['frmCAREER_LOC_CD_' . $carrIdx] = $this->formbox->getSelectBox($this->datacontrol->getFile2Array('CAREER_LOCATION.txt'), '소재지' , $carrList->CAREER_LOC_CD , $objType = 'array');
					
					//퇴사사유
					$this->formbox->setId('CAREER_RETIRE_CD_' . $carrIdx);
					$this->formbox->setName('CAREER_RETIRE_CD_' . $carrIdx);
					$this->formbox->setOption('');
					$data['frmCAREER_RETIRE_CD_' . $carrIdx] = $this->formbox->getSelectBox($this->datacontrol->getFile2Array('CAREER_RETIRE_TYPE.txt'), '퇴사사유' , $carrList->CAREER_RETIRE_CD , $objType = 'array');
				}
				
			}
			
			// 저술사항 변수및 설정
			$data['wrteRs'] = null;
			if ($data['rsmdisplay'][0]->WRITE_USE_YN == 'Y')
			{
				$wrteres = $this->rmf->getApplyUserDataWrite(array($PRJ_IDX,$APPL_IDX,'N'));
				$data['wrteRs'] = $wrteres->result();
			}
			
			//파일업로드 사용여부 
			$data['frmFile'] = null;
			if ($data['rsmdisplay'][0]->FILE_USE_YN == 'Y') 
			{ 
				$res = $this->rmf->getFileList(array($RESUME_IDX,'N',$PRJ_IDX,$APPL_IDX,'N'));	
				$data['frmFile'] = $res->result();
			}
			
			// 수상사항 변수및 설정
			$data['przeRs'] = null;
			if ($data['rsmdisplay'][0]->PRIZE_USE_YN == 'Y')
			{
				$przres = $this->rmf->getApplyUserDataPrize(array($PRJ_IDX,$APPL_IDX,'N'));
				$data['przeRs'] = $przres->result();
			}
			
			// 어학능력2 변수및 설정
			$data['lan2Rs'] = null;
			if ($data['rsmdisplay'][0]->LANGUAGE2_USE_YN == 'Y')
			{
				$lan2res = $this->rmf->getApplyUserDataLanguage2(array($PRJ_IDX,$APPL_IDX,'N'));
				$data['lan2Rs'] = $lan2res->result();
				
				/*샘플 */
				$this->formbox->setId('LANG2_CD');
				$this->formbox->setName('LANG2_CD');
				$this->formbox->setOption('');
				$data['frmLANG2_CD'] = $this->formbox->getSelectBox($this->datacontrol->getFile2Array('LANGUAGE_LIST.txt'), '등급선택' , '' , $objType = 'array');		
				
				$this->formbox->setId('LANG2_SPCH_LVL_CD');
				$this->formbox->setName('LANG2_SPCH_LVL_CD');
				$this->formbox->setOption('');
				$data['frmLANG2_SPCH_LVL_CD'] = $this->formbox->getSelectBox($this->datacontrol->getFile2Array('LEVEL1.txt'), '등급선택' , '' , $objType = 'array');		
				
				$this->formbox->setId('LANG2_WRT_LVL_CD');
				$this->formbox->setName('LANG2_WRT_LVL_CD');
				$this->formbox->setOption('');
				$data['frmLANG2_WRT_LVL_CD'] = $this->formbox->getSelectBox($this->datacontrol->getFile2Array('LEVEL1.txt'), '등급선택' , '' , $objType = 'array');		
				
				$this->formbox->setId('LANG2_CMP_LVL_CD');
				$this->formbox->setName('LANG2_CMP_LVL_CD');
				$this->formbox->setOption('');
				$data['frmLANG2_CMP_LVL_CD'] = $this->formbox->getSelectBox($this->datacontrol->getFile2Array('LEVEL1.txt'), '등급선택' , '' , $objType = 'array');		
				
				/* 로드데이터에 따른 셀렉트 박스 */
				foreach ($data['lan2Rs'] as $key => $lan2List)
				{
					$lan2Idx = $key + 1;
					$this->formbox->setId('LANG2_CD_' . $lan2Idx);
					$this->formbox->setName('LANG2_CD_' . $lan2Idx);
					$this->formbox->setOption('');
					$data['frmLANG2_CD_' . $lan2Idx] = $this->formbox->getSelectBox($this->datacontrol->getFile2Array('LANGUAGE_LIST.txt'), '등급선택' , $lan2List->LANG2_CD , $objType = 'array');		
					
					$this->formbox->setId('LANG2_SPCH_LVL_CD_' . $lan2Idx);
					$this->formbox->setName('LANG2_SPCH_LVL_CD_' . $lan2Idx);
					$this->formbox->setOption('');
					$data['frmLANG2_SPCH_LVL_CD_' . $lan2Idx] = $this->formbox->getSelectBox($this->datacontrol->getFile2Array('LEVEL1.txt'), '등급선택' , $lan2List->LANG2_SPCH_LVL_CD , $objType = 'array');		
					
					$this->formbox->setId('LANG2_WRT_LVL_CD_' . $lan2Idx);
					$this->formbox->setName('LANG2_WRT_LVL_CD_' . $lan2Idx);
					$this->formbox->setOption('');
					$data['frmLANG2_WRT_LVL_CD_' . $lan2Idx] = $this->formbox->getSelectBox($this->datacontrol->getFile2Array('LEVEL1.txt'), '등급선택' , $lan2List->LANG2_WRT_LVL_CD , $objType = 'array');		
					
					$this->formbox->setId('LANG2_CMP_LVL_CD_' . $lan2Idx);
					$this->formbox->setName('LANG2_CMP_LVL_CD_' . $lan2Idx);
					$this->formbox->setOption('');
					$data['frmLANG2_CMP_LVL_CD_' . $lan2Idx] = $this->formbox->getSelectBox($this->datacontrol->getFile2Array('LEVEL1.txt'), '등급선택' , $lan2List->LANG2_CMP_LVL_CD , $objType = 'array');		
				}
				
			}
			
			// 자격증항 변수및 설정
			$data['licRs'] = null;
			if ($data['rsmdisplay'][0]->LICENSE_USE_YN == 'Y')
			{
				$wrteres = $this->rmf->getApplyUserDataLicense(array($PRJ_IDX,$APPL_IDX,'N'));
				$data['licRs'] = $wrteres->result();
			}
			
			// OA 사용 변수 - 고정항목이라서 리스트 부를때 아예 데이터도 같이 가져온다.
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
					$data['frmPC_LVL_CD_' . ($key + 1)] = $this->formbox->getSelectBox($this->datacontrol->getFile2Array('LEVEL1.txt'), '등급선택' , $clistData->LVL_CD , $objType = 'array');		
				}
			}
			
			// 해외연수 및 해외경험
			$data['srveRs'] = null;
			if ($data['rsmdisplay'][0]->SERVE_USE_YN == 'Y')
			{
				$srveres = $this->rmf->getApplyUserDataServe(array($PRJ_IDX,$APPL_IDX,'N'));
				$data['srveRs'] = $srveres->result();
				//활동구분
				/* 샘플 */
				$this->formbox->setId('SRV_TP_CD');
				$this->formbox->setName('SRV_TP_CD');
				$this->formbox->setOption('');
				$data['frmSRV_TP_CD'] = $this->formbox->getSelectBox($this->datacontrol->getFile2Array('SERVE_TYPE.txt'), '활동구분선택' , '' , $objType = 'array');	
				
				/* 로드데이터에 따른 셀렉트 박스 */
				foreach ($data['srveRs'] as $key => $srveList)
				{
					$srveIdx = $key + 1;
					$this->formbox->setId('SRV_TP_CD_' . $srveIdx);
					$this->formbox->setName('SRV_TP_CD_' . $srveIdx);
					$this->formbox->setOption('');
					$data['frmSRV_TP_CD_' . $srveIdx] = $this->formbox->getSelectBox($this->datacontrol->getFile2Array('SERVE_TYPE.txt'), '활동구분선택' , $srveList->SRV_TP_CD , $objType = 'array');		
						
				}
				
			}
			
			// 보유기술
			$data['techRs'] = null;
			if ($data['rsmdisplay'][0]->TECH_USE_YN == 'Y')
			{
				$techres = $this->rmf->getApplyUserDataTech(array($PRJ_IDX,$APPL_IDX,'N'));
				$data['techRs'] = $techres->result();
			}
			
			// 교육사항
			$data['educRs'] = null;
			if ($data['rsmdisplay'][0]->EDUCATION_USE_YN == 'Y')
			{
				$educres = $this->rmf->getApplyUserDataEducation(array($PRJ_IDX,$APPL_IDX,'N'));
				$data['educRs'] = $educres->result();
			}
			
			// 주요활동및 사회경험
			$data['trngRs'] = null;
			if ($data['rsmdisplay'][0]->TRAINING_USE_YN == 'Y')
			{
				$trngres = $this->rmf->getApplyUserDataTraining(array($PRJ_IDX,$APPL_IDX,'N'));
				$data['trngRs'] = $trngres->result();
				
				//연수 구분
				$this->formbox->setId('TRN_TP_CD');
				$this->formbox->setName('TRN_TP_CD');
				$this->formbox->setOption('');
				$data['frmTRN_TP_CD'] = $this->formbox->getSelectBox($this->datacontrol->getFile2Array('TRAINING_TYPE.txt'), '해외경험종류' , '' , $objType = 'array');
				
				/* 로드데이터에 따른 셀렉트 박스 */
				foreach ($data['trngRs'] as $key => $trngList)
				{
					//연수 구분
					$trngIdx = $key + 1;
					$this->formbox->setId('TRN_TP_CD_' . $trngIdx);
					$this->formbox->setName('TRN_TP_CD_' . $trngIdx);
					$this->formbox->setOption('');
					$data['frmTRN_TP_CD_' . $trngIdx] = $this->formbox->getSelectBox($this->datacontrol->getFile2Array('TRAINING_TYPE.txt'), '해외경험종류' , $trngList->TRN_TP_CD , $objType = 'array');
				}
			}
			$data['frmContent'] = null;
			if ($data['rsmdisplay'][0]->CONTENT_USE_YN == 'Y') 
			{ 
				$res = $this->rmf->getContentList(array($RESUME_IDX,'N',$PRJ_IDX,$APPL_IDX,'N'));	
				$data['frmContent'] = $res->result();
			}
			
			
			// 보훈
			$this->formbox->setId('BOHUN_TP_CD');
			$this->formbox->setName('BOHUN_TP_CD');
			$this->formbox->setOption('');
			$tmpArray = array(array('Y','대상'),array('N','비대상'));
			$data['SELECTBOX_BOHUN_TP_CD'] = $this->formbox->getSelectBox($tmpArray, '선택' ,$data['BOHUN_TP_CD'] , $objType = 'array');
			
			$this->formbox->setId('BOHUN_SCORE_CD');
			$this->formbox->setName('BOHUN_SCORE_CD');
			$this->formbox->setOption('');
			$tmpArray = array(array('5','5%'),array('10','10%'));
			$data['SELECTBOX_BOHUN_SCORE_CD'] = $this->formbox->getSelectBox($tmpArray, '선택' ,$data['BOHUN_SCORE_CD'] , $objType = 'array');
			
			// 장애인여부
			$this->formbox->setId('PSN_OBSTACLE_TP_CD');
			$this->formbox->setName('PSN_OBSTACLE_TP_CD');
			$this->formbox->setOption('');
			$tmpArray = array(array('Y','장애인'),array('N','비장애인'));
			$data['SELECTBOX_PSN_OBSTACLE_TP_CD'] = $this->formbox->getSelectBox($tmpArray, '선택' , $data['PSN_OBSTACLE_TP_CD'] , $objType = 'array');
			
			$this->formbox->setId('PSN_OBSTACLE_LVL_CD');
			$this->formbox->setName('PSN_OBSTACLE_LVL_CD');
			$this->formbox->setOption('');
			
			$data['SELECTBOX_PSN_OBSTACLE_LVL_CD'] = $this->formbox->getSelectBox($this->datacontrol->getFile2Array('OBSTACLE_LEVEL.txt'), '등급선택' , $data['PSN_OBSTACLE_LVL_CD'] , $objType = 'array');
			
			// 전화
			
			$this->formbox->setId('TEL1');
			$this->formbox->setName('TEL1');
			$this->formbox->setOption('');
			
			$data['SELECTBOX_TEL'] = $this->formbox->getSelectBox($this->datacontrol->getFile2Array('TEL.txt'), '선택' , $data['TEL1'] , $objType = 'array');
			
			$this->formbox->setId('HTEL1');
			$this->formbox->setName('HTEL1');
			$this->formbox->setOption('');
			
			$data['SELECTBOX_HTEL'] = $this->formbox->getSelectBox($this->datacontrol->getFile2Array('HTEL.txt'), '선택' , $data['HTEL1'] , $objType = 'array');
			
			if ($data['rsmdisplay'][0]->ARMY_USE_YN == 'Y')
			{
	 
				$this->formbox->setId('ARMY_TP_CD');
				$this->formbox->setName('ARMY_TP_CD');
				$this->formbox->setOption('');
				
				$data['SELECTBOX_ARMY_TP_CD'] = $this->formbox->getSelectBox($this->datacontrol->getFile2Array('ARMY_TYPE.txt'), '선택' , $data['ARMY_TP_CD'] , $objType = 'array');
				
				$this->formbox->setId('ARMY_LVL_CD');
				$this->formbox->setName('ARMY_LVL_CD');
				$this->formbox->setOption('');
				
				$data['SELECTBOX_ARMY_LVL_CD'] = $this->formbox->getSelectBox($this->datacontrol->getFile2Array('ARMY_LEVEL.txt'), '선택' , $data['ARMY_LVL_CD'] , $objType = 'array');
				
				$this->formbox->setId('ARMY_YN_CD');
				$this->formbox->setName('ARMY_YN_CD');
				$this->formbox->setOption('');
				
				$data['SELECTBOX_ARMY_YN_CD'] = $this->formbox->getSelectBox($this->datacontrol->getFile2Array('ARMY_YN.txt'), '선택' , $data['ARMY_YN_CD'] , $objType = 'array');
				
				$this->formbox->setId('ARMY_FINISH_CD');
				$this->formbox->setName('ARMY_FINISH_CD');
				$this->formbox->setOption('');
				
				$data['SELECTBOX_ARMY_FINISH_CD'] = $this->formbox->getSelectBox($this->datacontrol->getFile2Array('ARMY_FINISH.txt'), '선택' , $data['ARMY_FINISH_CD'] , $objType = 'array');
				
			}
			
			
			// 중요한언어 - 무제한증가가 아님 관리자에서 설정한 언어가 나오고 가리자 이건. 
			// 서브로 쿼리를 돌려서 디테일을 항목을 가져옵시다.ajax 를 쓰고싶은데 테스트를
			// 못하겠다.
			$data['lanData'] = null;
			if ($data['rsmdisplay'][0]->LANGUAGE_USE_YN == 'Y')
			{
				$res = $this->rmf->getLanguageList(array($RESUME_IDX,'N','N','LNT','N',$PRJ_IDX,$APPL_IDX,'N'));
				$data['lanData'] = $res->result();
				// view에서 1번부터 시작하므로 
				foreach ($data['lanData'] as $key => $lanList)
				{
					$data['frmLAN_LVL_IDX_' . ($key+1)] = '';
					if (preg_match('/^14|15$/', $lanList->SCORE_TP)) // 코드가 등급코드일경우 리스트를 뽑아오기
					{
						$subRs = $this->rmf->getLanguageLevelList(array($lanList->LAN_IDX,'N'));
						if ($subRs->num_rows() > 0)
						{
							$this->formbox->setId('LAN_LVL_IDX_' . ($key+1));
							$this->formbox->setName('LAN_LVL_IDX_' . ($key+1));
							$this->formbox->setOption('');
							$data['frmLAN_LVL_IDX_' . ($key+1)] = $this->formbox->getSelectBox($subRs->result(), '등급' , $lanList->LAN_LVL_IDX , $objType = 'db');
						}
					}
				}
				
			}
			
			
			// 학력사항 -- 디비에 있는것을 자주부르기때문에 이거 수정해야한다. 지금은 급하니 우선 복사해서 작업;;;
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
				//학교구분 (학력구분)
				$res = $this->rmf->getCodeList(array('SCT','Y','N'));
				$this->formbox->setId('SCH_TP');
				$this->formbox->setName('SCH_TP');
				$this->formbox->setOption('');
				$data['frmSCH_TP'] = $this->formbox->getSelectBox($res->result(), '학력구분선택' , '' , $objType = 'db');
				
				//계열 - 전공
				$res = $this->rmf->getMajorAffiliationList(array('N'));
				$this->formbox->setId('SCH_AFF');
				$this->formbox->setName('SCH_AFF');
				$this->formbox->setOption('');
				$data['frmSCH_AFF'] = $this->formbox->getSelectBox($res->result(), '계열선택' , '' , $objType = 'db');
				
				//계열 - 부전공
				$res = $this->rmf->getMajorAffiliationList(array('N'));
				$this->formbox->setId('SCH_SUB_AFF');
				$this->formbox->setName('SCH_SUB_AFF');
				$this->formbox->setOption('');
				$data['frmSCH_SUB_AFF'] = $this->formbox->getSelectBox($res->result(), '계열선택' , '' , $objType = 'db');
				
				//소재지
				$res = $this->rmf->getLocationList(array('N'));
				$this->formbox->setId('SCH_LOC');
				$this->formbox->setName('SCH_LOC');
				$this->formbox->setOption('');
				$data['frmSCH_LOC'] = $this->formbox->getSelectBox($res->result(), '소재지' , '' , $objType = 'db');
				
				//주/야간
				$res = $this->rmf->getCodeList(array('JUY','Y','N'));
				$this->formbox->setId('SCH_JUYA');
				$this->formbox->setName('SCH_JUYA');
				$this->formbox->setOption('');
				$data['frmSCH_JUYA'] = $this->formbox->getSelectBox($res->result(), '주/야간' , '' , $objType = 'db');
		
				//본교/분교
				$res = $this->rmf->getCodeList(array('BRC','Y','N'));
				$this->formbox->setId('SCH_BRANCH_TP');
				$this->formbox->setName('SCH_BRANCH_TP');
				$this->formbox->setOption('');
				$data['frmSCH_BRANCH_TP'] = $this->formbox->getSelectBox($res->result(), '본교구분' , '' , $objType = 'db');
				
				//입학구분 
				$res = $this->rmf->getCodeList(array('ET1','Y','N'));
				$this->formbox->setId('SCH_ETTP1');
				$this->formbox->setName('SCH_ETTP1');
				$this->formbox->setOption('');
				$data['frmSCH_ETTP1'] = $this->formbox->getSelectBox($res->result(), '입학구분' , '' , $objType = 'db');
				
				//졸업구분 
				$res = $this->rmf->getCodeList(array('ET2','Y','N'));
				$this->formbox->setId('SCH_ETTP2');
				$this->formbox->setName('SCH_ETTP2');
				$this->formbox->setOption('');
				$data['frmSCH_ETTP2'] = $this->formbox->getSelectBox($res->result(), '졸업구분' , '' , $objType = 'db');
				
				//전공 부전공 구분
				$res = $this->rmf->getCodeList(array('MJT','Y','N'));
				$this->formbox->setId('SCH_SUB_MAJOR_TP');
				$this->formbox->setName('SCH_SUB_MAJOR_TP');
				$this->formbox->setOption('');
				$data['frmSCH_SUB_MAJOR_TP'] = $this->formbox->getSelectBox($res->result(), '부전공분류' , '' , $objType = 'db');
				
				//취득학점 점수
	
				$this->formbox->setId('SCH_MAX_HAKJUM');
				$this->formbox->setName('SCH_MAX_HAKJUM');
				$this->formbox->setOption('');
				$data['frmSCH_MAX_HAKJUM'] = $this->formbox->getSelectBox($this->datacontrol->getFile2Array('HAKJUM.txt'), '선택' , '' , $objType = 'array');
				
				/* 고등학교 항목은 미리 나와야해서 */
				// 데이터가 있을경우가 생기면 아래에서 데이터 가져와서 select 박스만들면서 변수들이 덮어질것이다.
					//소재지
					$res = $this->rmf->getLocationList(array('N'));
					$this->formbox->setId('SCH_LOC_1');
					$this->formbox->setName('SCH_LOC_1');
					$this->formbox->setOption('');
					$data['frmSCH_LOC_1'] = $this->formbox->getSelectBox($res->result(), '소재지' , '' , $objType = 'db');
					
					//주/야간
					$res = $this->rmf->getCodeList(array('JUY','Y','N'));
					$this->formbox->setId('SCH_JUYA_1');
					$this->formbox->setName('SCH_JUYA_1');
					$this->formbox->setOption('');
					$data['frmSCH_JUYA_1'] = $this->formbox->getSelectBox($res->result(), '주/야간' , '' , $objType = 'db');
			
					//본교/분교
					$res = $this->rmf->getCodeList(array('BRC','Y','N'));
					$this->formbox->setId('SCH_BRANCH_TP_1');
					$this->formbox->setName('SCH_BRANCH_TP_1');
					$this->formbox->setOption('');
					$data['frmSCH_BRANCH_TP_1'] = $this->formbox->getSelectBox($res->result(), '본교구분' , '' , $objType = 'db');
					
					//입학구분 
					$res = $this->rmf->getCodeList(array('ET1','Y','N'));
					$this->formbox->setId('SCH_ETTP1_1');
					$this->formbox->setName('SCH_ETTP1_1');
					$this->formbox->setOption('');
					
					//17	ET1 빼기
					$tmpEttp1ar = array();
					foreach ($res->result() as $key => $tmpEttp1List) if ($tmpEttp1List->CODE != '17') $tmpEttp1ar[] = array($tmpEttp1List->CODE , $tmpEttp1List->NAME);
				
					$data['frmSCH_ETTP1_1'] = $this->formbox->getSelectBox($tmpEttp1ar, '입학구분' , '' , $objType = 'array');
					
					//졸업구분 
					$res = $this->rmf->getCodeList(array('ET2','Y','N'));
					$this->formbox->setId('SCH_ETTP2_1');
					$this->formbox->setName('SCH_ETTP2_1');
					$this->formbox->setOption('');
					$data['frmSCH_ETTP2_1'] = $this->formbox->getSelectBox($res->result(), '졸업구분' , '' , $objType = 'db');
					
				/* 로드데이터에 따른 셀렉트 박스 */
				foreach ($data['schlRs'] as $key => $schlList)
				{
					//연수 구분
					$schlIdx = $key + 1;
					//학교구분 (학력구분)
					$res = $this->rmf->getCodeList(array('SCT','Y','N'));
					$this->formbox->setId('SCH_TP_' . $schlIdx);
					$this->formbox->setName('SCH_TP_' . $schlIdx);
					$this->formbox->setOption('');
					$data['frmSCH_TP_' . $schlIdx] = $this->formbox->getSelectBox($res->result(), '학력구분선택' , $schlList->SCH_TP , $objType = 'db');
					
					//계열 - 전공
					$res = $this->rmf->getMajorAffiliationList(array('N'));
					$this->formbox->setId('SCH_AFF_' . $schlIdx);
					$this->formbox->setName('SCH_AFF_' . $schlIdx);
					$this->formbox->setOption('');
					$data['frmSCH_AFF_' . $schlIdx] = $this->formbox->getSelectBox($res->result(), '계열선택' , $schlList->SCH_AFF , $objType = 'db');
					
					//계열 - 부전공
					$res = $this->rmf->getMajorAffiliationList(array('N'));
					$this->formbox->setId('SCH_SUB_AFF_' . $schlIdx);
					$this->formbox->setName('SCH_SUB_AFF_' . $schlIdx);
					$this->formbox->setOption('');
					$data['frmSCH_SUB_AFF_' . $schlIdx] = $this->formbox->getSelectBox($res->result(), '계열선택' , $schlList->SCH_SUB_AFF , $objType = 'db');
					
					//소재지
					$res = $this->rmf->getLocationList(array('N'));
					$this->formbox->setId('SCH_LOC_' . $schlIdx);
					$this->formbox->setName('SCH_LOC_' . $schlIdx);
					$this->formbox->setOption('');
					$data['frmSCH_LOC_' . $schlIdx] = $this->formbox->getSelectBox($res->result(), '소재지' , $schlList->SCH_LOC , $objType = 'db');
					
					//주/야간
					$res = $this->rmf->getCodeList(array('JUY','Y','N'));
					$this->formbox->setId('SCH_JUYA_' . $schlIdx);
					$this->formbox->setName('SCH_JUYA_' . $schlIdx);
					$this->formbox->setOption('');
					$data['frmSCH_JUYA_' . $schlIdx] = $this->formbox->getSelectBox($res->result(), '주/야간' , $schlList->SCH_JUYA , $objType = 'db');
			
					//본교/분교
					$res = $this->rmf->getCodeList(array('BRC','Y','N'));
					$this->formbox->setId('SCH_BRANCH_TP_' . $schlIdx);
					$this->formbox->setName('SCH_BRANCH_TP_' . $schlIdx);
					$this->formbox->setOption('');
					$data['frmSCH_BRANCH_TP_' . $schlIdx] = $this->formbox->getSelectBox($res->result(), '본교구분' , $schlList->SCH_BRANCH_TP , $objType = 'db');
					
					//입학구분 
					$this->formbox->setId('SCH_ETTP1_' . $schlIdx);
					$this->formbox->setName('SCH_ETTP1_' . $schlIdx);
					$this->formbox->setOption('');
					$res = $this->rmf->getCodeList(array('ET1','Y','N'));
					if ($schlIdx == 1)
					{
						//17	ET1 빼기
						$tmpEttp1ar = array();
						foreach ($res->result() as $key => $tmpEttp1List) if ($tmpEttp1List->CODE != '17') $tmpEttp1ar[] = array($tmpEttp1List->CODE , $tmpEttp1List->NAME);
						$data['frmSCH_ETTP1_1'] = $this->formbox->getSelectBox($tmpEttp1ar, '입학구분' , $schlList->SCH_ETTP1 , $objType = 'array');
					}
					else
					{
						$data['frmSCH_ETTP1_' . $schlIdx] = $this->formbox->getSelectBox($res->result(), '입학구분' , $schlList->SCH_ETTP1 , $objType = 'db');
					}
					
					//졸업구분 
					$res = $this->rmf->getCodeList(array('ET2','Y','N'));
					$this->formbox->setId('SCH_ETTP2_' . $schlIdx);
					$this->formbox->setName('SCH_ETTP2_' . $schlIdx);
					$this->formbox->setOption('');
					$data['frmSCH_ETTP2_' . $schlIdx] = $this->formbox->getSelectBox($res->result(), '졸업구분' , $schlList->SCH_ETTP2 , $objType = 'db');
					
					//전공 부전공 구분
					$res = $this->rmf->getCodeList(array('MJT','Y','N'));
					$this->formbox->setId('SCH_SUB_MAJOR_TP_' . $schlIdx);
					$this->formbox->setName('SCH_SUB_MAJOR_TP_' . $schlIdx);
					$this->formbox->setOption('');
					$data['frmSCH_SUB_MAJOR_TP_' . $schlIdx] = $this->formbox->getSelectBox($res->result(), '부전공분류' , $schlList->SCH_SUB_MAJOR_TP , $objType = 'db');
					
					//취득학점 점수
		
					$this->formbox->setId('SCH_MAX_HAKJUM_' . $schlIdx);
					$this->formbox->setName('SCH_MAX_HAKJUM_' . $schlIdx);
					$this->formbox->setOption('');
					$data['frmSCH_MAX_HAKJUM_' . $schlIdx] = $this->formbox->getSelectBox($this->datacontrol->getFile2Array('HAKJUM.txt'), '선택' , $schlList->SCH_MAX_HAKJUM , $objType = 'array');
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
		
		// 희망근무지 ajax 
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
		
		
		// 지원서 저장후 화면
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
					jsalertmsg('관리자 정보에 이상이 생겨 내용가져오기에 실패하였습니다.');
					winclose('on');
					exit;	
				}
				//관리자모드 체크후 apply_no를 이용해서 RECV_DI 값을 가져오기
			
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
			// 자기소개 - 텍스트 컨텐츠
			
			
			
			// 추후에 다중 모집분야 작업이 있을예정 - 그러면 디피되는 형태도 그에 맞게 바뀌어야함. 손댈게 좀 생기는.
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
			
			// 희망근무지 리스트
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
			
			$data['SELECTBOX_UNIT_IDX1'] = $this->formbox->getSelectBoxText($unitObj, '지원분야 선택' , $myUnitCd , $objType = 'array');
			
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
			
			// 이력서 대분류 항목을 보여주는 여부
			$res = $this->rmf->getResumeFormDisplayYNList(array($PRJ_IDX,$RESUME_IDX,'N'));
			$data['rsmdisplay'] = $res->result();
			
			$data['PHOTO_URL'] = APPLY_PHOTO_URL .'/'. $PRJ_IDX .'/'. $APPL_IDX .'.jpg';
			
			// 가족사항 변수및 select box 설정
			$data['fmlyRs'] = null;
			if ($data['rsmdisplay'][0]->FAMILY_USE_YN == 'Y')
			{
				$fmlyres = $this->rmf->getApplyUserDataFamily(array($PRJ_IDX,$APPL_IDX,'N'));
				$data['fmlyRs'] = $fmlyres->result();
				
				// 가족사항
				/* 이건 샘플에서 사용할용도 이므로 걍 둬라 */
				$this->formbox->setId('FMLY_REL_CD');
				$this->formbox->setName('FMLY_REL_CD');
				$this->formbox->setOption('');
				$data['frmFMLY_REL_CD'] = $this->formbox->getSelectBoxText($this->datacontrol->getFile2Array('FAMILY_REL.txt'), '선택' , '' , $objType = 'array');	
				
				$this->formbox->setId('FMLY_SCH_CD');
				$this->formbox->setName('FMLY_SCH_CD');
				$this->formbox->setOption('');
				$data['frmFMLY_SCH_CD'] = $this->formbox->getSelectBoxText($this->datacontrol->getFile2Array('FAMILY_SCH.txt'), '선택' , '' , $objType = 'array');	
				
				$this->formbox->setId('FMLY_LIVE_YN');
				$this->formbox->setName('FMLY_LIVE_YN');
				$this->formbox->setOption('');
				$data['frmFMLY_LIVE_YN'] = $this->formbox->getSelectBoxText(array(array('Y','Y'),array('N','N')), '선택' , '' , $objType = 'array');	
				
				$this->formbox->setId('FMLY_HELP_YN');
				$this->formbox->setName('FMLY_HELP_YN');
				$this->formbox->setOption('');
				$data['frmFMLY_HELP_YN'] = $this->formbox->getSelectBoxText(array(array('Y','Y'),array('N','N')), '선택' , '' , $objType = 'array');	
				
				/* 로드데이터에 따른 셀렉트 박스 */
				foreach ($data['fmlyRs'] as $key => $fmlyList)
				{
					$fmlyIdx = $key + 1;
					$this->formbox->setId('FMLY_REL_CD_' . $fmlyIdx);
					$this->formbox->setName('FMLY_REL_CD_' . $fmlyIdx);
					$this->formbox->setOption('');
					$data['frmFMLY_REL_CD_' . $fmlyIdx] = $this->formbox->getSelectBoxText($this->datacontrol->getFile2Array('FAMILY_REL.txt'), '선택' , $fmlyList->FMLY_REL_CD , $objType = 'array');	
					
					$this->formbox->setId('FMLY_SCH_CD_' . $fmlyIdx);
					$this->formbox->setName('FMLY_SCH_CD_' . $fmlyIdx);
					$this->formbox->setOption('');
					$data['frmFMLY_SCH_CD_' . $fmlyIdx] = $this->formbox->getSelectBoxText($this->datacontrol->getFile2Array('FAMILY_SCH.txt'), '선택' , $fmlyList->FMLY_SCH_CD , $objType = 'array');	
					
					$this->formbox->setId('FMLY_LIVE_YN_' . $fmlyIdx);
					$this->formbox->setName('FMLY_LIVE_YN_' . $fmlyIdx);
					$this->formbox->setOption('');
					$data['frmFMLY_LIVE_YN_' . $fmlyIdx] = $this->formbox->getSelectBoxText(array(array('Y','Y'),array('N','N')), '선택' , $fmlyList->FMLY_LIVE_YN , $objType = 'array');	
					
					$this->formbox->setId('FMLY_HELP_YN_' . $fmlyIdx);
					$this->formbox->setName('FMLY_HELP_YN_' . $fmlyIdx);
					$this->formbox->setOption('');
					$data['frmFMLY_HELP_YN_' . $fmlyIdx] = $this->formbox->getSelectBoxText(array(array('Y','Y'),array('N','N')), '선택' , $fmlyList->FMLY_HELP_YN , $objType = 'array');
				}
				
			}
			
			// 경력사항 변수및 select box 설정
			$data['carrRs'] = null;
			if ($data['rsmdisplay'][0]->CAREER_USE_YN == 'Y')
			{
				$carrres = $this->rmf->getApplyUserDataCareer(array($PRJ_IDX,$APPL_IDX,'N'));
				$data['carrRs'] = $carrres->result();
				
				//셋업
				$crSubres = $this->rmf->getCareerSetList(array($RESUME_IDX,'N'));
				$data['careerDisplayType'] = $crSubres->result();
				
				$empTypeRs = $this->rmf->getCareerEmployTypeList(array('CIT',NULL,NULL,'N','N'));
				
				
				
				// 경력사항
				/* 이건 샘플 */
				// 기업형태 ( 큰놈인지 작은놈인지 )
				$this->formbox->setId('CAREER_EMP_TP_CD');
				$this->formbox->setName('CAREER_EMP_TP_CD');
				$this->formbox->setOption('');
				$data['frmCAREER_EMP_TP_CD'] = $this->formbox->getSelectBoxText($empTypeRs->result(), '고용형태' , '' , $objType = 'db');		
				
				$this->formbox->setId('CAREER_CMP_TP_CD');
				$this->formbox->setName('CAREER_CMP_TP_CD');
				$this->formbox->setOption('');
				$data['frmCAREER_CMP_TP_CD'] = $this->formbox->getSelectBoxText($this->datacontrol->getFile2Array('CAREER_COMPANY_TYPE.txt'), '기업형태' , '' , $objType = 'array');		
				
				// 재직인지 퇴사인지
				$this->formbox->setId('CAREER_STS_CD');
				$this->formbox->setName('CAREER_STS_CD');
				$this->formbox->setOption('');
				$data['frmCAREER_STS_CD'] = $this->formbox->getSelectBoxText($this->datacontrol->getFile2Array('CAREER_STATUS.txt'), '재직여부' , '' , $objType = 'array');		
				
				// 직위
				$this->formbox->setId('CAREER_PSTN_CD');
				$this->formbox->setName('CAREER_PSTN_CD');
				$this->formbox->setOption('');
				$data['frmCAREER_PSTN_CD'] = $this->formbox->getSelectBoxText($this->datacontrol->getFile2Array('CAREER_PSTN.txt'), '직위' , '' , $objType = 'array');		
				
				// 직책
				$this->formbox->setId('CAREER_PSTN_LVL_CD');
				$this->formbox->setName('CAREER_PSTN_LVL_CD');
				$this->formbox->setOption('');
				$data['frmCAREER_PSTN_LVL_CD'] = $this->formbox->getSelectBoxText($this->datacontrol->getFile2Array('CAREER_PSTN_LEVEL.txt'), '직책' , '' , $objType = 'array');
				
				// 기업이 어디있었는데?
				$this->formbox->setId('CAREER_LOC_CD');
				$this->formbox->setName('CAREER_LOC_CD');
				$this->formbox->setOption('');
				$data['frmCAREER_LOC_CD'] = $this->formbox->getSelectBoxText($this->datacontrol->getFile2Array('CAREER_LOCATION.txt'), '소재지' , '' , $objType = 'array');
				
				//퇴사사유
				$this->formbox->setId('CAREER_RETIRE_CD');
				$this->formbox->setName('CAREER_RETIRE_CD');
				$this->formbox->setOption('');
				$data['frmCAREER_RETIRE_CD'] = $this->formbox->getSelectBoxText($this->datacontrol->getFile2Array('CAREER_RETIRE_TYPE.txt'), '퇴사사유' , '' , $objType = 'array');
				
				/* 로드데이터에 따른 셀렉트 박스 */
				foreach ($data['carrRs'] as $key => $carrList)
				{
					$carrIdx = $key + 1;
					
					$this->formbox->setId('CAREER_EMP_TP_CD_' . $carrIdx);
					$this->formbox->setName('CAREER_EMP_TP_CD_' . $carrIdx);
					$this->formbox->setOption('');
					$data['frmCAREER_EMP_TP_CD_' . $carrIdx] = $this->formbox->getSelectBoxText($empTypeRs->result(), '고용형태' , $carrList->CAREER_EMP_TP_CD  , $objType = 'db');		
						
					$this->formbox->setId('CAREER_CMP_TP_CD_' . $carrIdx);
					$this->formbox->setName('CAREER_CMP_TP_CD_' . $carrIdx);
					$this->formbox->setOption('');
					$data['frmCAREER_CMP_TP_CD_' . $carrIdx] = $this->formbox->getSelectBoxText($this->datacontrol->getFile2Array('CAREER_COMPANY_TYPE.txt'), '기업형태' , $carrList->CAREER_CMP_TP_CD , $objType = 'array');		
					
					// 재직인지 퇴사인지
					$this->formbox->setId('CAREER_STS_CD_' . $carrIdx);
					$this->formbox->setName('CAREER_STS_CD_' . $carrIdx);
					$this->formbox->setOption('');
					$data['frmCAREER_STS_CD_' . $carrIdx] = $this->formbox->getSelectBoxText($this->datacontrol->getFile2Array('CAREER_STATUS.txt'), '재직여부' , $carrList->CAREER_STS_CD , $objType = 'array');		
					
					// 직위
					$this->formbox->setId('CAREER_PSTN_CD_' . $carrIdx);
					$this->formbox->setName('CAREER_PSTN_CD_' . $carrIdx);
					$this->formbox->setOption('');
					
					$data['frmCAREER_PSTN_CD_' . $carrIdx] = $this->formbox->getSelectBoxText($this->datacontrol->getFile2Array('CAREER_PSTN.txt'), '직위' , $carrList->CAREER_PSTN_CD , $objType = 'array');		
					
					// 직책
					$this->formbox->setId('CAREER_PSTN_LVL_CD_' . $carrIdx);
					$this->formbox->setName('CAREER_PSTN_LVL_CD_' . $carrIdx);
					$this->formbox->setOption('');
					
					$data['frmCAREER_PSTN_LVL_CD_' . $carrIdx] = $this->formbox->getSelectBoxText($this->datacontrol->getFile2Array('CAREER_PSTN_LEVEL.txt'), '직책' , $carrList->CAREER_PSTN_LVL_CD , $objType = 'array');
					
					// 기업이 어디있었는데?
					$this->formbox->setId('CAREER_LOC_CD_' . $carrIdx);
					$this->formbox->setName('CAREER_LOC_CD_' . $carrIdx);
					$this->formbox->setOption('');
					$data['frmCAREER_LOC_CD_' . $carrIdx] = $this->formbox->getSelectBoxText($this->datacontrol->getFile2Array('CAREER_LOCATION.txt'), '소재지' , $carrList->CAREER_LOC_CD , $objType = 'array');
					
					//퇴사사유
					$this->formbox->setId('CAREER_RETIRE_CD_' . $carrIdx);
					$this->formbox->setName('CAREER_RETIRE_CD_' . $carrIdx);
					$this->formbox->setOption('');
					$data['frmCAREER_RETIRE_CD_' . $carrIdx] = $this->formbox->getSelectBoxText($this->datacontrol->getFile2Array('CAREER_RETIRE_TYPE.txt'), '퇴사사유' , $carrList->CAREER_RETIRE_CD , $objType = 'array');
				}
				
			}
			
			// 저술사항 변수및 설정
			$data['wrteRs'] = null;
			if ($data['rsmdisplay'][0]->WRITE_USE_YN == 'Y')
			{
				$wrteres = $this->rmf->getApplyUserDataWrite(array($PRJ_IDX,$APPL_IDX,'N'));
				$data['wrteRs'] = $wrteres->result();
			}
			
			// 수상사항 변수및 설정
			$data['przeRs'] = null;
			if ($data['rsmdisplay'][0]->PRIZE_USE_YN == 'Y')
			{
				$przres = $this->rmf->getApplyUserDataPrize(array($PRJ_IDX,$APPL_IDX,'N'));
				$data['przeRs'] = $przres->result();
			}
			
			// 어학능력2 변수및 설정
			$data['lan2Rs'] = null;
			if ($data['rsmdisplay'][0]->LANGUAGE2_USE_YN == 'Y')
			{
				$lan2res = $this->rmf->getApplyUserDataLanguage2(array($PRJ_IDX,$APPL_IDX,'N'));
				$data['lan2Rs'] = $lan2res->result();
				
				/*샘플 */
				$this->formbox->setId('LANG2_CD');
				$this->formbox->setName('LANG2_CD');
				$this->formbox->setOption('');
				$data['frmLANG2_CD'] = $this->formbox->getSelectBoxText($this->datacontrol->getFile2Array('LANGUAGE_LIST.txt'), '등급선택' , '' , $objType = 'array');		
				
				$this->formbox->setId('LANG2_SPCH_LVL_CD');
				$this->formbox->setName('LANG2_SPCH_LVL_CD');
				$this->formbox->setOption('');
				$data['frmLANG2_SPCH_LVL_CD'] = $this->formbox->getSelectBoxText($this->datacontrol->getFile2Array('LEVEL1.txt'), '등급선택' , '' , $objType = 'array');		
				
				$this->formbox->setId('LANG2_WRT_LVL_CD');
				$this->formbox->setName('LANG2_WRT_LVL_CD');
				$this->formbox->setOption('');
				$data['frmLANG2_WRT_LVL_CD'] = $this->formbox->getSelectBoxText($this->datacontrol->getFile2Array('LEVEL1.txt'), '등급선택' , '' , $objType = 'array');		
				
				$this->formbox->setId('LANG2_CMP_LVL_CD');
				$this->formbox->setName('LANG2_CMP_LVL_CD');
				$this->formbox->setOption('');
				$data['frmLANG2_CMP_LVL_CD'] = $this->formbox->getSelectBoxText($this->datacontrol->getFile2Array('LEVEL1.txt'), '등급선택' , '' , $objType = 'array');		
				
				/* 로드데이터에 따른 셀렉트 박스 */
				foreach ($data['lan2Rs'] as $key => $lan2List)
				{
					$lan2Idx = $key + 1;
					$this->formbox->setId('LANG2_CD_' . $lan2Idx);
					$this->formbox->setName('LANG2_CD_' . $lan2Idx);
					$this->formbox->setOption('');
					$data['frmLANG2_CD_' . $lan2Idx] = $this->formbox->getSelectBoxText($this->datacontrol->getFile2Array('LANGUAGE_LIST.txt'), '등급선택' , $lan2List->LANG2_CD , $objType = 'array');		
					
					$this->formbox->setId('LANG2_SPCH_LVL_CD_' . $lan2Idx);
					$this->formbox->setName('LANG2_SPCH_LVL_CD_' . $lan2Idx);
					$this->formbox->setOption('');
					$data['frmLANG2_SPCH_LVL_CD_' . $lan2Idx] = $this->formbox->getSelectBoxText($this->datacontrol->getFile2Array('LEVEL1.txt'), '등급선택' , $lan2List->LANG2_SPCH_LVL_CD , $objType = 'array');		
					
					$this->formbox->setId('LANG2_WRT_LVL_CD_' . $lan2Idx);
					$this->formbox->setName('LANG2_WRT_LVL_CD_' . $lan2Idx);
					$this->formbox->setOption('');
					$data['frmLANG2_WRT_LVL_CD_' . $lan2Idx] = $this->formbox->getSelectBoxText($this->datacontrol->getFile2Array('LEVEL1.txt'), '등급선택' , $lan2List->LANG2_WRT_LVL_CD , $objType = 'array');		
					
					$this->formbox->setId('LANG2_CMP_LVL_CD_' . $lan2Idx);
					$this->formbox->setName('LANG2_CMP_LVL_CD_' . $lan2Idx);
					$this->formbox->setOption('');
					$data['frmLANG2_CMP_LVL_CD_' . $lan2Idx] = $this->formbox->getSelectBoxText($this->datacontrol->getFile2Array('LEVEL1.txt'), '등급선택' , $lan2List->LANG2_CMP_LVL_CD , $objType = 'array');		
				}
				
			}
			
			// 자격증항 변수및 설정
			$data['licRs'] = null;
			if ($data['rsmdisplay'][0]->LICENSE_USE_YN == 'Y')
			{
				$wrteres = $this->rmf->getApplyUserDataLicense(array($PRJ_IDX,$APPL_IDX,'N'));
				$data['licRs'] = $wrteres->result();
			}
			
			// OA 사용 변수 - 고정항목이라서 리스트 부를때 아예 데이터도 같이 가져온다.
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
					$data['frmPC_LVL_CD_' . ($key + 1)] = $this->formbox->getSelectBoxText($this->datacontrol->getFile2Array('LEVEL1.txt'), '등급선택' , $clistData->LVL_CD , $objType = 'array');		
				}
			}
			
			// 해외연수 및 해외경험
			$data['srveRs'] = null;
			if ($data['rsmdisplay'][0]->SERVE_USE_YN == 'Y')
			{
				$srveres = $this->rmf->getApplyUserDataServe(array($PRJ_IDX,$APPL_IDX,'N'));
				$data['srveRs'] = $srveres->result();
				//활동구분
				/* 샘플 */
				$this->formbox->setId('SRV_TP_CD');
				$this->formbox->setName('SRV_TP_CD');
				$this->formbox->setOption('');
				$data['frmSRV_TP_CD'] = $this->formbox->getSelectBoxText($this->datacontrol->getFile2Array('SERVE_TYPE.txt'), '활동구분선택' , '' , $objType = 'array');	
				
				/* 로드데이터에 따른 셀렉트 박스 */
				foreach ($data['srveRs'] as $key => $srveList)
				{
					$srveIdx = $key + 1;
					$this->formbox->setId('SRV_TP_CD_' . $srveIdx);
					$this->formbox->setName('SRV_TP_CD_' . $srveIdx);
					$this->formbox->setOption('');
					$data['frmSRV_TP_CD_' . $srveIdx] = $this->formbox->getSelectBoxText($this->datacontrol->getFile2Array('SERVE_TYPE.txt'), '활동구분선택' , $srveList->SRV_TP_CD , $objType = 'array');		
						
				}
				
			}
			
			// 보유기술
			$data['techRs'] = null;
			if ($data['rsmdisplay'][0]->TECH_USE_YN == 'Y')
			{
				$techres = $this->rmf->getApplyUserDataTech(array($PRJ_IDX,$APPL_IDX,'N'));
				$data['techRs'] = $techres->result();
			}
			
			// 교육사항
			$data['educRs'] = null;
			if ($data['rsmdisplay'][0]->EDUCATION_USE_YN == 'Y')
			{
				$educres = $this->rmf->getApplyUserDataEducation(array($PRJ_IDX,$APPL_IDX,'N'));
				$data['educRs'] = $educres->result();
			}
			
			// 주요활동및 사회경험
			$data['trngRs'] = null;
			if ($data['rsmdisplay'][0]->TRAINING_USE_YN == 'Y')
			{
				$trngres = $this->rmf->getApplyUserDataTraining(array($PRJ_IDX,$APPL_IDX,'N'));
				$data['trngRs'] = $trngres->result();
				
				//연수 구분
				$this->formbox->setId('TRN_TP_CD');
				$this->formbox->setName('TRN_TP_CD');
				$this->formbox->setOption('');
				$data['frmTRN_TP_CD'] = $this->formbox->getSelectBoxText($this->datacontrol->getFile2Array('TRAINING_TYPE.txt'), '해외경험종류' , '' , $objType = 'array');
				
				/* 로드데이터에 따른 셀렉트 박스 */
				foreach ($data['trngRs'] as $key => $trngList)
				{
					//연수 구분
					$trngIdx = $key + 1;
					$this->formbox->setId('TRN_TP_CD_' . $trngIdx);
					$this->formbox->setName('TRN_TP_CD_' . $trngIdx);
					$this->formbox->setOption('');
					$data['frmTRN_TP_CD_' . $trngIdx] = $this->formbox->getSelectBoxText($this->datacontrol->getFile2Array('TRAINING_TYPE.txt'), '해외경험종류' , $trngList->TRN_TP_CD , $objType = 'array');
				}
			}
			$data['frmContent'] = null;
			if ($data['rsmdisplay'][0]->CONTENT_USE_YN == 'Y') 
			{ 
				$res = $this->rmf->getContentList(array($RESUME_IDX,'N',$PRJ_IDX,$APPL_IDX,'N'));	
				$data['frmContent'] = $res->result();
			}
			
			//파일업로드 사용여부 
			$data['frmFile'] = null;
			if ($data['rsmdisplay'][0]->FILE_USE_YN == 'Y') 
			{ 
				$res = $this->rmf->getFileList(array($RESUME_IDX,'N',$PRJ_IDX,$APPL_IDX,'N'));	
				$data['frmFile'] = $res->result();
			}
			
			
			// 보훈
			$this->formbox->setId('BOHUN_TP_CD');
			$this->formbox->setName('BOHUN_TP_CD');
			$this->formbox->setOption('');
			$tmpArray = array(array('Y','대상'),array('N','비대상'));
			$data['SELECTBOX_BOHUN_TP_CD'] = $this->formbox->getSelectBoxText($tmpArray, '선택' ,$data['BOHUN_TP_CD'] , $objType = 'array');
			
			$this->formbox->setId('BOHUN_SCORE_CD');
			$this->formbox->setName('BOHUN_SCORE_CD');
			$this->formbox->setOption('');
			$tmpArray = array(array('5','5%'),array('10','10%'));
			$data['SELECTBOX_BOHUN_SCORE_CD'] = $this->formbox->getSelectBoxText($tmpArray, '선택' ,$data['BOHUN_SCORE_CD'] , $objType = 'array');
			
			// 장애인여부
			$this->formbox->setId('PSN_OBSTACLE_TP_CD');
			$this->formbox->setName('PSN_OBSTACLE_TP_CD');
			$this->formbox->setOption('');
			$tmpArray = array(array('Y','장애인'),array('N','비장애인'));
			$data['SELECTBOX_PSN_OBSTACLE_TP_CD'] = $this->formbox->getSelectBox($tmpArray, '선택' , $data['PSN_OBSTACLE_TP_CD'] , $objType = 'array');
			
			$this->formbox->setId('PSN_OBSTACLE_LVL_CD');
			$this->formbox->setName('PSN_OBSTACLE_LVL_CD');
			$this->formbox->setOption('');
			
			$data['SELECTBOX_PSN_OBSTACLE_LVL_CD'] = $this->formbox->getSelectBoxText($this->datacontrol->getFile2Array('OBSTACLE_LEVEL.txt'), '등급선택' , $data['PSN_OBSTACLE_LVL_CD'] , $objType = 'array');
			
			// 전화
			
			$this->formbox->setId('TEL1');
			$this->formbox->setName('TEL1');
			$this->formbox->setOption('');
			
			$data['SELECTBOX_TEL'] = $this->formbox->getSelectBoxText($this->datacontrol->getFile2Array('TEL.txt'), '선택' , $data['TEL1'] , $objType = 'array');
			
			$this->formbox->setId('HTEL1');
			$this->formbox->setName('HTEL1');
			$this->formbox->setOption('');
			
			$data['SELECTBOX_HTEL'] = $this->formbox->getSelectBoxText($this->datacontrol->getFile2Array('HTEL.txt'), '선택' , $data['HTEL1'] , $objType = 'array');
			
			if ($data['rsmdisplay'][0]->ARMY_USE_YN == 'Y')
			{
	 
				$this->formbox->setId('ARMY_TP_CD');
				$this->formbox->setName('ARMY_TP_CD');
				$this->formbox->setOption('');
				
				$data['SELECTBOX_ARMY_TP_CD'] = $this->formbox->getSelectBoxText($this->datacontrol->getFile2Array('ARMY_TYPE.txt'), '선택' , $data['ARMY_TP_CD'] , $objType = 'array');
				
				$this->formbox->setId('ARMY_LVL_CD');
				$this->formbox->setName('ARMY_LVL_CD');
				$this->formbox->setOption('');
				
				$data['SELECTBOX_ARMY_LVL_CD'] = $this->formbox->getSelectBoxText($this->datacontrol->getFile2Array('ARMY_LEVEL.txt'), '선택' , $data['ARMY_LVL_CD'] , $objType = 'array');
				
				$this->formbox->setId('ARMY_YN_CD');
				$this->formbox->setName('ARMY_YN_CD');
				$this->formbox->setOption('');
				
				$data['SELECTBOX_ARMY_YN_CD'] = $this->formbox->getSelectBoxText($this->datacontrol->getFile2Array('ARMY_YN.txt'), '선택' , $data['ARMY_YN_CD'] , $objType = 'array');
				
				$this->formbox->setId('ARMY_FINISH_CD');
				$this->formbox->setName('ARMY_FINISH_CD');
				$this->formbox->setOption('');
				
				$data['SELECTBOX_ARMY_FINISH_CD'] = $this->formbox->getSelectBoxText($this->datacontrol->getFile2Array('ARMY_FINISH.txt'), '선택' , $data['ARMY_FINISH_CD'] , $objType = 'array');
				
			}
			
			
			// 중요한언어 - 무제한증가가 아님 관리자에서 설정한 언어가 나오고 가리자 이건. 
			// 서브로 쿼리를 돌려서 디테일을 항목을 가져옵시다.ajax 를 쓰고싶은데 테스트를
			// 못하겠다.
			$data['lanData'] = null;
			if ($data['rsmdisplay'][0]->LANGUAGE_USE_YN == 'Y')
			{
				$res = $this->rmf->getLanguageList(array($RESUME_IDX,'N','N','LNT','N',$PRJ_IDX,$APPL_IDX,'N'));
				$data['lanData'] = $res->result();
				// view에서 1번부터 시작하므로 
				foreach ($data['lanData'] as $key => $lanList)
				{
					$data['frmLAN_LVL_IDX_' . ($key+1)] = '';
					if (preg_match('/^14|15$/', $lanList->SCORE_TP)) // 코드가 등급코드일경우 리스트를 뽑아오기
					{
						$subRs = $this->rmf->getLanguageLevelList(array($lanList->LAN_IDX,'N'));
						if ($subRs->num_rows() > 0)
						{
							$this->formbox->setId('LAN_LVL_IDX_' . ($key+1));
							$this->formbox->setName('LAN_LVL_IDX_' . ($key+1));
							$this->formbox->setOption('');
							$data['frmLAN_LVL_IDX_' . ($key+1)] = $this->formbox->getSelectBoxText($subRs->result(), '등급' , $lanList->LAN_LVL_IDX , $objType = 'db');
						}
					}
				}
				
			}
			
			
			// 학력사항 -- 디비에 있는것을 자주부르기때문에 이거 수정해야한다. 지금은 급하니 우선 복사해서 작업;;;
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
				//학교구분 (학력구분)
				$res = $this->rmf->getCodeList(array('SCT','Y','N'));
				$this->formbox->setId('SCH_TP');
				$this->formbox->setName('SCH_TP');
				$this->formbox->setOption('');
				$data['frmSCH_TP'] = $this->formbox->getSelectBoxText($res->result(), '학력구분선택' , '' , $objType = 'db');
				
				//계열 - 전공
				$res = $this->rmf->getMajorAffiliationList(array('N'));
				$this->formbox->setId('SCH_AFF');
				$this->formbox->setName('SCH_AFF');
				$this->formbox->setOption('');
				$data['frmSCH_AFF'] = $this->formbox->getSelectBoxText($res->result(), '계열선택' , '' , $objType = 'db');
				
				//계열 - 부전공
				$res = $this->rmf->getMajorAffiliationList(array('N'));
				$this->formbox->setId('SCH_SUB_AFF');
				$this->formbox->setName('SCH_SUB_AFF');
				$this->formbox->setOption('');
				$data['frmSCH_SUB_AFF'] = $this->formbox->getSelectBoxText($res->result(), '계열선택' , '' , $objType = 'db');
				
				//소재지
				$res = $this->rmf->getLocationList(array('N'));
				$this->formbox->setId('SCH_LOC');
				$this->formbox->setName('SCH_LOC');
				$this->formbox->setOption('');
				$data['frmSCH_LOC'] = $this->formbox->getSelectBoxText($res->result(), '소재지' , '' , $objType = 'db');
				
				//주/야간
				$res = $this->rmf->getCodeList(array('JUY','Y','N'));
				$this->formbox->setId('SCH_JUYA');
				$this->formbox->setName('SCH_JUYA');
				$this->formbox->setOption('');
				$data['frmSCH_JUYA'] = $this->formbox->getSelectBoxText($res->result(), '주/야간' , '' , $objType = 'db');
		
				//본교/분교
				$res = $this->rmf->getCodeList(array('BRC','Y','N'));
				$this->formbox->setId('SCH_BRANCH_TP');
				$this->formbox->setName('SCH_BRANCH_TP');
				$this->formbox->setOption('');
				$data['frmSCH_BRANCH_TP'] = $this->formbox->getSelectBoxText($res->result(), '본교구분' , '' , $objType = 'db');
				
				//입학구분 
				$res = $this->rmf->getCodeList(array('ET1','Y','N'));
				$this->formbox->setId('SCH_ETTP1');
				$this->formbox->setName('SCH_ETTP1');
				$this->formbox->setOption('');
				$data['frmSCH_ETTP1'] = $this->formbox->getSelectBoxText($res->result(), '입학구분' , '' , $objType = 'db');
				
				//졸업구분 
				$res = $this->rmf->getCodeList(array('ET2','Y','N'));
				$this->formbox->setId('SCH_ETTP2');
				$this->formbox->setName('SCH_ETTP2');
				$this->formbox->setOption('');
				$data['frmSCH_ETTP2'] = $this->formbox->getSelectBoxText($res->result(), '졸업구분' , '' , $objType = 'db');
				
				//전공 부전공 구분
				$res = $this->rmf->getCodeList(array('MJT','Y','N'));
				$this->formbox->setId('SCH_SUB_MAJOR_TP');
				$this->formbox->setName('SCH_SUB_MAJOR_TP');
				$this->formbox->setOption('');
				$data['frmSCH_SUB_MAJOR_TP'] = $this->formbox->getSelectBoxText($res->result(), '부전공분류' , '' , $objType = 'db');
				
				//취득학점 점수
	
				$this->formbox->setId('SCH_MAX_HAKJUM');
				$this->formbox->setName('SCH_MAX_HAKJUM');
				$this->formbox->setOption('');
				$data['frmSCH_MAX_HAKJUM'] = $this->formbox->getSelectBoxText($this->datacontrol->getFile2Array('HAKJUM.txt'), '선택' , '' , $objType = 'array');
				
				/* 고등학교 항목은 미리 나와야해서 */
				// 데이터가 있을경우가 생기면 아래에서 데이터 가져와서 select 박스만들면서 변수들이 덮어질것이다.
					//소재지
					$res = $this->rmf->getLocationList(array('N'));
					$this->formbox->setId('SCH_LOC_1');
					$this->formbox->setName('SCH_LOC_1');
					$this->formbox->setOption('');
					$data['frmSCH_LOC_1'] = $this->formbox->getSelectBoxText($res->result(), '소재지' , '' , $objType = 'db');
					
					//주/야간
					$res = $this->rmf->getCodeList(array('JUY','Y','N'));
					$this->formbox->setId('SCH_JUYA_1');
					$this->formbox->setName('SCH_JUYA_1');
					$this->formbox->setOption('');
					$data['frmSCH_JUYA_1'] = $this->formbox->getSelectBoxText($res->result(), '주/야간' , '' , $objType = 'db');
			
					//본교/분교
					$res = $this->rmf->getCodeList(array('BRC','Y','N'));
					$this->formbox->setId('SCH_BRANCH_TP_1');
					$this->formbox->setName('SCH_BRANCH_TP_1');
					$this->formbox->setOption('');
					$data['frmSCH_BRANCH_TP_1'] = $this->formbox->getSelectBoxText($res->result(), '본교구분' , '' , $objType = 'db');
					
					//입학구분 
					$res = $this->rmf->getCodeList(array('ET1','Y','N'));
					$this->formbox->setId('SCH_ETTP1_1');
					$this->formbox->setName('SCH_ETTP1_1');
					$this->formbox->setOption('');
					
					//17	ET1 빼기
					$tmpEttp1ar = array();
					foreach ($res->result() as $key => $tmpEttp1List) if ($tmpEttp1List->CODE != '17') $tmpEttp1ar[] = array($tmpEttp1List->CODE , $tmpEttp1List->NAME);
				
					$data['frmSCH_ETTP1_1'] = $this->formbox->getSelectBoxText($tmpEttp1ar, '입학구분' , '' , $objType = 'array');
					
					//졸업구분 
					$res = $this->rmf->getCodeList(array('ET2','Y','N'));
					$this->formbox->setId('SCH_ETTP2_1');
					$this->formbox->setName('SCH_ETTP2_1');
					$this->formbox->setOption('');
					$data['frmSCH_ETTP2_1'] = $this->formbox->getSelectBoxText($res->result(), '졸업구분' , '' , $objType = 'db');
					
				/* 로드데이터에 따른 셀렉트 박스 */
				foreach ($data['schlRs'] as $key => $schlList)
				{
					//연수 구분
					$schlIdx = $key + 1;
					//학교구분 (학력구분)
					$res = $this->rmf->getCodeList(array('SCT','Y','N'));
					$this->formbox->setId('SCH_TP_' . $schlIdx);
					$this->formbox->setName('SCH_TP_' . $schlIdx);
					$this->formbox->setOption('');
					$data['frmSCH_TP_' . $schlIdx] = $this->formbox->getSelectBoxText($res->result(), '학력구분선택' , $schlList->SCH_TP , $objType = 'db');
					
					//계열 - 전공
					$res = $this->rmf->getMajorAffiliationList(array('N'));
					$this->formbox->setId('SCH_AFF_' . $schlIdx);
					$this->formbox->setName('SCH_AFF_' . $schlIdx);
					$this->formbox->setOption('');
					$data['frmSCH_AFF_' . $schlIdx] = $this->formbox->getSelectBoxText($res->result(), '계열선택' , $schlList->SCH_AFF , $objType = 'db');
					
					//계열 - 부전공
					$res = $this->rmf->getMajorAffiliationList(array('N'));
					$this->formbox->setId('SCH_SUB_AFF_' . $schlIdx);
					$this->formbox->setName('SCH_SUB_AFF_' . $schlIdx);
					$this->formbox->setOption('');
					$data['frmSCH_SUB_AFF_' . $schlIdx] = $this->formbox->getSelectBoxText($res->result(), '계열선택' , $schlList->SCH_SUB_AFF , $objType = 'db');
					
					//소재지
					$res = $this->rmf->getLocationList(array('N'));
					$this->formbox->setId('SCH_LOC_' . $schlIdx);
					$this->formbox->setName('SCH_LOC_' . $schlIdx);
					$this->formbox->setOption('');
					$data['frmSCH_LOC_' . $schlIdx] = $this->formbox->getSelectBoxText($res->result(), '소재지' , $schlList->SCH_LOC , $objType = 'db');
					
					//주/야간
					$res = $this->rmf->getCodeList(array('JUY','Y','N'));
					$this->formbox->setId('SCH_JUYA_' . $schlIdx);
					$this->formbox->setName('SCH_JUYA_' . $schlIdx);
					$this->formbox->setOption('');
					$data['frmSCH_JUYA_' . $schlIdx] = $this->formbox->getSelectBoxText($res->result(), '주/야간' , $schlList->SCH_JUYA , $objType = 'db');
			
					//본교/분교
					$res = $this->rmf->getCodeList(array('BRC','Y','N'));
					$this->formbox->setId('SCH_BRANCH_TP_' . $schlIdx);
					$this->formbox->setName('SCH_BRANCH_TP_' . $schlIdx);
					$this->formbox->setOption('');
					$data['frmSCH_BRANCH_TP_' . $schlIdx] = $this->formbox->getSelectBoxText($res->result(), '본교구분' , $schlList->SCH_BRANCH_TP , $objType = 'db');
					
					//입학구분 
					$this->formbox->setId('SCH_ETTP1_' . $schlIdx);
					$this->formbox->setName('SCH_ETTP1_' . $schlIdx);
					$this->formbox->setOption('');
					$res = $this->rmf->getCodeList(array('ET1','Y','N'));
					if ($schlIdx == 1)
					{
						//17	ET1 빼기
						$tmpEttp1ar = array();
						foreach ($res->result() as $key => $tmpEttp1List) if ($tmpEttp1List->CODE != '17') $tmpEttp1ar[] = array($tmpEttp1List->CODE , $tmpEttp1List->NAME);
						$data['frmSCH_ETTP1_1'] = $this->formbox->getSelectBoxText($tmpEttp1ar, '입학구분' , $schlList->SCH_ETTP1 , $objType = 'array');
					}
					else
					{
						$data['frmSCH_ETTP1_' . $schlIdx] = $this->formbox->getSelectBoxText($res->result(), '입학구분' , $schlList->SCH_ETTP1 , $objType = 'db');
					}
					
					//졸업구분 
					$res = $this->rmf->getCodeList(array('ET2','Y','N'));
					$this->formbox->setId('SCH_ETTP2_' . $schlIdx);
					$this->formbox->setName('SCH_ETTP2_' . $schlIdx);
					$this->formbox->setOption('');
					$data['frmSCH_ETTP2_' . $schlIdx] = $this->formbox->getSelectBoxText($res->result(), '졸업구분' , $schlList->SCH_ETTP2 , $objType = 'db');
					
					//전공 부전공 구분
					$res = $this->rmf->getCodeList(array('MJT','Y','N'));
					$this->formbox->setId('SCH_SUB_MAJOR_TP_' . $schlIdx);
					$this->formbox->setName('SCH_SUB_MAJOR_TP_' . $schlIdx);
					$this->formbox->setOption('');
					$data['frmSCH_SUB_MAJOR_TP_' . $schlIdx] = $this->formbox->getSelectBoxText($res->result(), '부전공분류' , $schlList->SCH_SUB_MAJOR_TP , $objType = 'db');
					
					//취득학점 점수
		
					$this->formbox->setId('SCH_MAX_HAKJUM_' . $schlIdx);
					$this->formbox->setName('SCH_MAX_HAKJUM_' . $schlIdx);
					$this->formbox->setOption('');
					$data['frmSCH_MAX_HAKJUM_' . $schlIdx] = $this->formbox->getSelectBoxText($this->datacontrol->getFile2Array('HAKJUM.txt'), '선택' , $schlList->SCH_MAX_HAKJUM , $objType = 'array');
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
			//관리자모드 체크후 apply_no를 이용해서 RECV_DI 값을 가져오기
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
					jsalertmsg('관리자 정보에 이상이 생겨 내용가져오기에 실패하였습니다.');
					winclose('on');
					exit;	
				}
			}
			
	
	
			if ($this->ApplyDateCheck($PRJ_IDX) == 'OFF' )
			{
				if ($ADMIN_FLAG != '')
				{
					//이야... 된다.
				}
				else
				{
					jsalertmsg('해당 채용공고의 서류 접수가 마감되었습니다');
					jsredirect('/front/mypage');
					exit;
				}
			}
		
			$res = $this->rmf->getResumeFormDisplayYNList(array($PRJ_IDX,$RSM_IDX,'N'));
			$YNList = $res->result();
			
			// 기본신상정보 변수 
			
			// 비밀번호 저장 
			$USER_PW = $this->input->post('USER_PW');
			
			if (trim($USER_PW) != '')
			{
					$this->rmf->getApplyPasswordProcess(array(MD5($USER_PW),$PRJ_IDX,$APPL_IDX,'N'));
			}
			
			
			// 모집분야 - 저장 
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
			
			// 희망근무지 - 저장 
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
			
			// 병역사항 
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
			
			// 가족사항 
			if ($YNList[0]->FAMILY_USE_YN == 'Y')
			{
				
				$postArrayList = array( 'FMLY_SEQ'
															 ,'FMLY_REL_NM','FMLY_REL_CD'
														   ,'FMLY_NM','FMLY_NAI'
														   ,'FMLY_SCH_NM','FMLY_SCH_CD'
														   ,'FMLY_JOB','FMLY_WRK_NM','FMLY_WRK_PSTN'
														   ,'FMLY_LIVE_YN','FMLY_HELP_YN');
				
				$FAMILY_FORM_COUNT = $this->input->post('FAMILY_FORM_COUNT');
				
				// 추가 된것 만큼 for문
				$b = 1;
				// 한개이상의 항목에 데이터가 있으면 insert한다. 필수체크 작업은 이 윗단에서 DB에서 설정을 가져와서 처리 ( 이건 2차 작업때 )
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
			
				// 항목이 있는 것에 대해서 다시 변수가공된것으로 .
				$fmlySeqList = array();
				$fmlySeqList[] = 0; // 전체 삭제가 있을경우에 쿼리 오류발생 방지
				// 삭제부터 처리하고 나서 머지작업 ( 머지를 먼저하니까 새로 등록된것도 삭제되넹;;;; )
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
			
			
			// 경력사항 
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
				
				// 추가 된것 만큼 for문
				$b = 1;
				// 한개이상의 항목에 데이터가 있으면 insert한다. 필수체크 작업은 이 윗단에서 DB에서 설정을 가져와서 처리 ( 이건 2차 작업때 )
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
				
				// 항목이 있는 것에 대해서 다시 변수가공된것으로 .
				$carrSeqList = array();
				$carrSeqList[] = 0; // 전체 삭제가 있을경우에 쿼리 오류발생 방지
				// 삭제부터 처리하고 나서 머지작업 ( 머지를 먼저하니까 새로 등록된것도 삭제되넹;;;; )
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
			
			// 저술내역
			if ($YNList[0]->WRITE_USE_YN == 'Y')
			{
				$postArrayList = array(  'WRT_SEQ'
																,'WRT_NM','WRT_PB'
																,'WRT_DT1','WRT_DT2','WRT_DT3');
				$WRITE_FORM_COUNT = $this->input->post('WRITE_FORM_COUNT');
				
				
				// 추가 된것 만큼 for문
				$b = 1;
				// 한개이상의 항목에 데이터가 있으면 insert한다. 필수체크 작업은 이 윗단에서 DB에서 설정을 가져와서 처리 ( 이건 2차 작업때 )
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
				
				// 항목이 있는 것에 대해서 다시 변수가공된것으로 .
				$wrteSeqList = array();
				$wrteSeqList[] = 0; // 전체 삭제가 있을경우에 쿼리 오류발생 방지
				// 삭제부터 처리하고 나서 머지작업 ( 머지를 먼저하니까 새로 등록된것도 삭제되넹;;;; )
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
			
			
			// 수상내역
			if ($YNList[0]->PRIZE_USE_YN == 'Y')
			{
				$postArrayList = array(  'PRZ_SEQ'
																,'PRZ_NM','PRZ_PB_NM'
																,'PRZ_DT1','PRZ_DT2','PRZ_DT3');
				$PRIZE_FORM_COUNT = $this->input->post('PRIZE_FORM_COUNT');
				
				// 추가 된것 만큼 for문
				$b = 1;
				// 한개이상의 항목에 데이터가 있으면 insert한다. 필수체크 작업은 이 윗단에서 DB에서 설정을 가져와서 처리 ( 이건 2차 작업때 )
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
				
				// 항목이 있는 것에 대해서 다시 변수가공된것으로 .
				$przeSeqList = array();
				$przeSeqList[] = 0; // 전체 삭제가 있을경우에 쿼리 오류발생 방지
				// 삭제부터 처리하고 나서 머지작업 ( 머지를 먼저하니까 새로 등록된것도 삭제되넹;;;; )
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
			
			
			
			
			// 어학2내역
			if ($YNList[0]->LANGUAGE2_USE_YN == 'Y')
			{

				$postArrayList = array(  'LANG2_SEQ'
																,'LANG2_NM','LANG2_CD'
																,'LANG2_SPCH_LVL_NM','LANG2_SPCH_LVL_CD'
																,'LANG2_WRT_LVL_NM','LANG2_WRT_LVL_CD'
																,'LANG2_CMP_LVL_NM','LANG2_CMP_LVL_CD');
				$LANGUAGE2_FORM_COUNT = $this->input->post('LANGUAGE2_FORM_COUNT');
				
				// 추가 된것 만큼 for문
				$b = 1;
				// 한개이상의 항목에 데이터가 있으면 insert한다. 필수체크 작업은 이 윗단에서 DB에서 설정을 가져와서 처리 ( 이건 2차 작업때 )
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
				
				// 항목이 있는 것에 대해서 다시 변수가공된것으로 .
				$lan2SeqList = array();
				$lan2SeqList[] = 0; // 전체 삭제가 있을경우에 쿼리 오류발생 방지
				// 삭제부터 처리하고 나서 머지작업 ( 머지를 먼저하니까 새로 등록된것도 삭제되넹;;;; )
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
			
			
			
			
			// 자격증 내역
			if ($YNList[0]->LICENSE_USE_YN == 'Y')
			{

				$postArrayList = array(  'LIC_SEQ'
																,'LIC_NM','LIC_CD'
																,'LIC_PB_NM'
																,'LIC_DT1','LIC_DT2','LIC_DT3'
																,'LIC_FILE_NM','LIC_FILE_CD'
																,'LIC_NUM');
				$LICENSE_FORM_COUNT = $this->input->post('LICENSE_FORM_COUNT');
				
				// 추가 된것 만큼 for문
				$b = 1;
				// 한개이상의 항목에 데이터가 있으면 insert한다. 필수체크 작업은 이 윗단에서 DB에서 설정을 가져와서 처리 ( 이건 2차 작업때 )
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
				
				// 항목이 있는 것에 대해서 다시 변수가공된것으로 .
				$licSeqList = array();
				$licSeqList[] = 0; // 전체 삭제가 있을경우에 쿼리 오류발생 방지
				// 삭제부터 처리하고 나서 머지작업 ( 머지를 먼저하니까 새로 등록된것도 삭제되넹;;;; )
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
			
			// 컴퓨터 사용 능력
			if ($YNList[0]->PC_USE_YN == 'Y')
			{
				
				$postArrayList = array(  'CD_CPU_IDX'
																,'PC_LVL_NM','PC_LVL_CD');
				$COMPUTER_FORM_COUNT = $this->input->post('LICENSE_FORM_COUNT');
			
				// 추가 된것 만큼 for문
				$b = 1;
				// 한개이상의 항목에 데이터가 있으면 insert한다. 필수체크 작업은 이 윗단에서 DB에서 설정을 가져와서 처리 ( 이건 2차 작업때 )
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
			
			
			// 활동사항 
			if ($YNList[0]->SERVE_USE_YN == 'Y')
			{

				$postArrayList = array(  'SRV_SEQ'
																,'SRV_STDT1','SRV_STDT2','SRV_EDDT1','SRV_EDDT2'
																,'SRV_TP_NM','SRV_TP_CD'
																,'SRV_ORG_NM'
																,'SRV_CNTNT');
				$SERVE_FORM_COUNT = $this->input->post('SERVE_FORM_COUNT');
				
				// 추가 된것 만큼 for문
				$b = 1;
				// 한개이상의 항목에 데이터가 있으면 insert한다. 필수체크 작업은 이 윗단에서 DB에서 설정을 가져와서 처리 ( 이건 2차 작업때 )
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
				
				// 항목이 있는 것에 대해서 다시 변수가공된것으로 .
				$srveSeqList = array();
				$srveSeqList[] = 0; // 전체 삭제가 있을경우에 쿼리 오류발생 방지
				// 삭제부터 처리하고 나서 머지작업 ( 머지를 먼저하니까 새로 등록된것도 삭제되넹;;;; )
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
			
			// 보유기술  
			if ($YNList[0]->TECH_USE_YN == 'Y')
			{

				$postArrayList = array(  'TCH_SEQ'
																,'TCH_NM','TCH_LVL','TCH_CNTNT');
				$TECH_FORM_COUNT = $this->input->post('TECH_FORM_COUNT');
				
				// 추가 된것 만큼 for문
				$b = 1;
				// 한개이상의 항목에 데이터가 있으면 insert한다. 필수체크 작업은 이 윗단에서 DB에서 설정을 가져와서 처리 ( 이건 2차 작업때 )
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
				
				// 항목이 있는 것에 대해서 다시 변수가공된것으로 .
				$techSeqList = array();
				$techSeqList[] = 0; // 전체 삭제가 있을경우에 쿼리 오류발생 방지
				// 삭제부터 처리하고 나서 머지작업 ( 머지를 먼저하니까 새로 등록된것도 삭제되넹;;;; )
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
			
			
			// 교육사항  
			if ($YNList[0]->EDUCATION_USE_YN == 'Y')
			{

				$postArrayList = array(  'EDU_SEQ'
																,'EDU_STDT1','EDU_STDT2','EDU_EDDT1','EDU_EDDT2'
																,'EDU_NM','EDU_ORG_NM','EDU_CNTNT');
				$EDUCATION_FORM_COUNT = $this->input->post('EDUCATION_FORM_COUNT');
				
				// 추가 된것 만큼 for문
				$b = 1;
				// 한개이상의 항목에 데이터가 있으면 insert한다. 필수체크 작업은 이 윗단에서 DB에서 설정을 가져와서 처리 ( 이건 2차 작업때 )
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
				
				// 항목이 있는 것에 대해서 다시 변수가공된것으로 .
				$educSeqList = array();
				$educSeqList[] = 0; // 전체 삭제가 있을경우에 쿼리 오류발생 방지
				// 삭제부터 처리하고 나서 머지작업 ( 머지를 먼저하니까 새로 등록된것도 삭제되넹;;;; )
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
			
			
			// 해외활동  
			if ($YNList[0]->TRAINING_USE_YN == 'Y')
			{
				
				$postArrayList = array(  'TRN_SEQ'
																,'TRN_STDT1','TRN_STDT2','TRN_EDDT1','TRN_EDDT2'
																,'TRN_TP_NM','TRN_TP_CD'
																,'TRN_ORG_NM','TRN_OBJ_NM','TRN_CNTNT','TRN_CTRY_NM');
				$TRAINING_FORM_COUNT = $this->input->post('TRAINING_FORM_COUNT');
				
				// 추가 된것 만큼 for문
				$b = 1;
				// 한개이상의 항목에 데이터가 있으면 insert한다. 필수체크 작업은 이 윗단에서 DB에서 설정을 가져와서 처리 ( 이건 2차 작업때 )
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
				
				// 항목이 있는 것에 대해서 다시 변수가공된것으로 .
				$trngSeqList = array();
				$trngSeqList[] = 0; // 전체 삭제가 있을경우에 쿼리 오류발생 방지
				// 삭제부터 처리하고 나서 머지작업 ( 머지를 먼저하니까 새로 등록된것도 삭제되넹;;;; )
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
			
			
			
			// 컨텐츠  
			if ($YNList[0]->CONTENT_USE_YN == 'Y')
			{
				
				$postArrayList = array('RSM_CNTNT_IDX','APPL_CNTNT');
				$CONTENT_FORM_COUNT = $this->input->post('CONTENT_FORM_COUNT');
				
				// 추가 된것 만큼 for문
				$b = 1;
				// 한개이상의 항목에 데이터가 있으면 insert한다. 필수체크 작업은 이 윗단에서 DB에서 설정을 가져와서 처리 ( 이건 2차 작업때 )
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
			
			
			// 어학시험
			if ($YNList[0]->LANGUAGE_USE_YN == 'Y')
			{
				
				$postArrayList = array(  'LAN_IDX'
																,'LANG_IDX'
																,'LAN_SCORE'
																,'LAN_LVL_IDX'
																,'LAN_DT1','LAN_DT2','LAN_DT3'
																,'LAN_NUM');
				$LANGUAGE_FORM_COUNT = $this->input->post('LANGUAGE_FORM_COUNT');
			
				// 추가 된것 만큼 for문
				$b = 1;
				// 한개이상의 항목에 데이터가 있으면 insert한다. 필수체크 작업은 이 윗단에서 DB에서 설정을 가져와서 처리 ( 이건 2차 작업때 )
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
			
			
			
			// 학교 졸라 복잡!!!!!  
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
				
				// 추가 된것 만큼 for문
				$b = 1;
				// 한개이상의 항목에 데이터가 있으면 insert한다. 필수체크 작업은 이 윗단에서 DB에서 설정을 가져와서 처리 ( 이건 2차 작업때 )
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
				
				// 항목이 있는 것에 대해서 다시 변수가공된것으로 .
				$schlSeqList = array();
				$schlSeqList[] = 0; // 전체 삭제가 있을경우에 쿼리 오류발생 방지
				// 삭제부터 처리하고 나서 머지작업 ( 머지를 먼저하니까 새로 등록된것도 삭제되넹;;;; )
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
			
			
			
			// 파일업로드
			// 컨텐츠  
			if ($YNList[0]->FILE_USE_YN == 'Y')
			{
				$this->load->library('upload');
				
				if ( !$PRJ_IDX || !$APPL_IDX )
				{
					jsalertmsg('파일업로드에 문제가 생겨 업로드에 실패했습니다. 다시 시도해주세요.');
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
									jsalertmsg($flist->FILE_TITLE . ' 항목은 필수 입니다.');
									jshistoryback();
									exit;
								}
							}
							
							if (@$_FILES['RSM_FILE_NM_' . ($key + 1)][tmp_name])
							{
								jsalertmsg($flist->FILE_TITLE . ' 항목의 파일업로드가 실패 하였습니다. ');
								jshistoryback();
								exit;
							}
							
						}
						else
						{
							// 정상일경우 데이터 넣기
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
			
			/* 프로세스를 다진행하고 마지막에 수험번호를 땁시다. */
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
						jsalertmsg('서류 접수가 마감되었습니다.');
						jsredirect('/front/mypage');
						exit;
					}
					
				}
				else
				{
					// 어떤새리야~ 페이지 동시에 처리했나;;
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
		
		// 수험번호 처리후 결과페이지
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
		
		// 파일업로드삭제 처리
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
