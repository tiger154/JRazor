<?
	class StepManagement extends MY_Controller
	{
	
		function Index()
		{
			
			$this->load->library('DataControl'); 
			$this->load->library('FormBox'); 
			
			$P_PRJ_IDX = $this->input->get('project_id');
			
			$COMP_ID = $this->authadmin->getCompanyId();
			$this->load->model('admin/project/projectManager_model','prjlist',true);
			$res1 = $this->prjlist->getSimpleProjectList(array($COMP_ID,'N'));
			
			$data['prjList'] = $res1->result();
			$this->load->library('FormBox');
			$this->formbox->setId('SCH_PRJ_IDX');
			$this->formbox->setName('SCH_PRJ_IDX');
			$this->formbox->setOption('onChange="javascript:changeProject(this);"');
			$rdata = $res1->result();
			if (!$P_PRJ_IDX && $rdata[0]->CODE != '') $P_PRJ_IDX = $rdata[0]->CODE;
			
			$data['SELECTBOX1'] = $this->formbox->getSelectBox($res1->result(),'�����ϼ���',$P_PRJ_IDX);
			
			
			
			
			
			$this->load->model('admin/step/stepManagement_model','stepmodel',true);
			$res = $this->stepmodel->getStepList(array($P_PRJ_IDX,'N'));
			
			$data['PRJ_IDX'] = $P_PRJ_IDX;
			$data['stepCount'] = $res->num_rows();
			$data['stepdata'] = $res->result();
			
			
			// �ð� / �� ������ selectbox ���� 
			
			foreach ($data['stepdata'] as $key => $seldata)
			{
				$this->formbox->setId('STEP_STDT2_' . $key);
				$this->formbox->setName('STEP_STDT2_' . $key);
				$this->formbox->setOption('style="width:54px;"');
				$data['SELECT_BOX1_HOUR_' . $key] = $this->formbox->getSelectBox($this->datacontrol->getFile2Array('HOUR.txt'), '����' , $seldata->STEP_STDT2 , $objType = 'array');
				
				$this->formbox->setId('STEP_STDT3_' . $key);
				$this->formbox->setName('STEP_STDT3_' . $key);
				$this->formbox->setOption('style="width:54px;"');
				$data['SELECT_BOX1_MIN_' . $key] = $this->formbox->getSelectBox($this->datacontrol->getFile2Array('MIN.txt'), '����' , $seldata->STEP_STDT3 , $objType = 'array');
				
				$this->formbox->setId('STEP_EDDT2_' . $key);
				$this->formbox->setName('STEP_EDDT2_' . $key);
				$this->formbox->setOption('style="width:54px;"');
				$data['SELECT_BOX2_HOUR_' . $key] = $this->formbox->getSelectBox($this->datacontrol->getFile2Array('HOUR.txt'), '����' , $seldata->STEP_EDDT2 , $objType = 'array');
				
				$this->formbox->setId('STEP_EDDT3_' . $key);
				$this->formbox->setName('STEP_EDDT3_' . $key);
				$this->formbox->setOption('style="width:54px;"');
				$data['SELECT_BOX2_MIN_' . $key] = $this->formbox->getSelectBox($this->datacontrol->getFile2Array('MIN.txt'), '����' , $seldata->STEP_EDDT3 , $objType = 'array');
				
			}
			
			$this->loadView('admin/step/stepList' , $data);
		}
		
		//��� ��ǥ������
		function dataList()
		{
			$P_PRJ_IDX = $this->input->get('project_id');
			$P_STEP_IDX = $this->input->get('step_id');
			$COMP_ID = $this->authadmin->getCompanyId();
			
			$data['PRJ_IDX'] = $P_PRJ_IDX;
			$data['STEP_IDX'] = $P_STEP_IDX;
			
			//����Ʈ �ڽ� - ������Ʈ
			$this->load->model('admin/project/projectManager_model','prjlist',true);
			$res1 = $this->prjlist->getSimpleProjectList(array($COMP_ID,'N'));
			
			$this->load->library('FormBox');
			
			
			
			$this->formbox->setId('SCH_PRJ_IDX');
			$this->formbox->setName('SCH_PRJ_IDX');
			$this->formbox->setOption('onChange="javascript:changeProject(this);"');
			$data['SELECTBOX1'] = $this->formbox->getSelectBox($res1->result(),'�����ϼ���',$P_PRJ_IDX);
			$rdata = null;
			$rdata = $res1->result();
			
			if (!$P_PRJ_IDX && $rdata[0]->CODE != '' ) 
			{
				$P_PRJ_IDX = $rdata[0]->CODE;
				$data['PRJ_IDX'] = $P_PRJ_IDX;
			}
			
			$rdata = null;
			//����Ʈ �ڽ� - ����
			$this->load->model('admin/step/stepManagement_model','steplist',true);
			$res2 = $this->steplist->getSimpleStepList(array($P_PRJ_IDX,'N'));
			
			$this->formbox->setId('SCH_STEP_IDX');
			$this->formbox->setName('SCH_STEP_IDX');
			$this->formbox->setOption('onChange="javascript:changeStep(this);"');
			
			$rdata = $res2->result();
			//var_dump($rdata);
			if (!$P_STEP_IDX && $rdata[0]->CODE != '' )
			{
				 $P_STEP_IDX = $rdata[0]->CODE;
				 $data['STEP_IDX'] = $P_STEP_IDX;
			}
			
			$data['SELECTBOX2'] = $this->formbox->getSelectBox($res2->result(),'�����ϼ���',$P_STEP_IDX);
			
			$this->load->model('admin/step/stepManagement_model','stepmodel',true);
			$res = $this->stepmodel->getDataList(array($P_PRJ_IDX,$P_STEP_IDX,'N'));
			
			$data['stepCount'] = $res->num_rows();
			$data['stepdata'] = $res->result();
			$this->loadView('admin/step/stepDataList' , $data);
		}
		
		function dataUpload()
		{
			
			$P_PRJ_IDX = $this->input->get('project_id');
			$P_STEP_IDX = $this->input->get('step_id');
			$data['PRJ_IDX'] = $P_PRJ_IDX;
			$data['STEP_IDX'] = $P_STEP_IDX;
			//$this->excel->getActiveSheet()->setTitle('test worksheet');
			//$this->excel->load('/wwwRoot/file/common/uploadtest.xlsx');
			
			//print_r($objWorksheet);

			//$this->PHPExcel->
			
			$this->popView('admin/step/dataUpload_form' , $data);
	//		$objet2 = new PHPExcel_Reader_Excel5();
	//$excel2 = $objet2->load('rap2.xlsx');


		}
		
		function dataUploadProcess()
		{
			
			$file_type = $_FILES['EX_FILE_UPLOAD']['type'];
			$P_PRJ_IDX = $this->input->post('PRJ_IDX');
			$P_STEP_IDX = $this->input->post('STEP_IDX');
			$this->load->library('excel');
			
			$this->excel->setLoadFile($_FILES['EX_FILE_UPLOAD']);
			$excel_data = $this->excel->getExcel2Array($_FILES['EX_FILE_UPLOAD']);
			if ($excel_data == false)
			{
				jsalertmsg('���������� �ƴմϴ�. �ٽ� Ȯ���ϼ���.');
				jshistoryback();
				//redirect('/admin/stepManagement/dataUpload?project_id=' . $P_PRJ_IDX . '&step_id=' . $P_STEP_IDX);
				exit;
			}
			$this->load->model('admin/step/stepManagement_model','stepmodel',true);
			$this->stepmodel->getDataDelete(array($P_PRJ_IDX,$P_STEP_IDX));
			
			$etcvar_ar = array();
			
			
			foreach ($excel_data as $key => $data)
			{
					
					$etcdata_ar = array();
					
					if ($key == 1 ) 
					{
						$x = 0;
						foreach ($data as $key => $etcdata) 
						{
							if ($x >= 3) 
							{
								$etcvar_ar[] = iconv('UTF-8','EUC-KR',$etcdata);
							}
							$x++;
						}
					}
					
					if ($key > 1)
					{
						$x = 0;
						foreach ($data as $key => $etcdata)
						{
							// 4��° ĭ���� ��Ÿ ������ ��ġ�� �κ� 
							if ($x >= 3)
							{
								$etcdata_ar[] = iconv('UTF-8','EUC-KR',$etcdata);
							}
							$x++;
						}		
					
						$this->stepmodel->getDataInsert(array($P_PRJ_IDX,$P_STEP_IDX,iconv('UTF-8','EUC-KR',$data['A']),iconv('UTF-8','EUC-KR',$data['B']),iconv('UTF-8','EUC-KR',$data['C']),'@@@'.implode('@@@',$etcvar_ar).'@@@','@@@'.implode('@@@',$etcdata_ar).'@@@'));
					}
					
			}
			
			$result_data = $this->stepmodel->getCreateForm($P_PRJ_IDX,$P_STEP_IDX);
		
			winclose();
		}
		
		function dataView()
		{
			$this->load->library('DataControl');
			$PRJ_IDX = $this->input->post('PRJ_IDX');
			$STEP_IDX = $this->input->post('STEP_IDX');
			$GUBUN = base64_decode($this->input->post('GUBUN'));
			
			$ETCVAR = base64_decode($this->input->post('ETCVAR'));
			$etclist = $this->datacontrol->getEtcList($ETCVAR);
			
			//echo $ETCVAR;
			$query_str = null;
			foreach ($etclist as $key => $etcdata)
			{
				$query_str .= ',DBO.FN_ETCDATA(ETC1VAR,ETC1VALUE,\'' . $etcdata . '\') ETCDATA' . ($key + 1);
			}
			
			$this->load->model('admin/step/stepManagement_model','stepmodel',true);
			$result_data = $this->stepmodel->getDataViewList($query_str,array($PRJ_IDX,$STEP_IDX,$GUBUN));
			
			$pwdRs = $this->stepmodel->getProjectPassCode(array($PRJ_IDX));
			$rdata = $pwdRs->result();
			
			$data['code'] = base64_encode($rdata[0]->PASSWD);
			$data['PRJ_IDX'] = $PRJ_IDX;
			$data['DOMAIN_ID'] = HOSTID;
			$data['STEP_IDX'] = $STEP_IDX;
			$data['dataList'] = $result_data->result();
			$data['titleList'] = $etclist;
			$data['SERVICE_URL'] = 'http://' . HOSTID .'.'. MAIN_SERVICE_DOMAIN;
			
			$this->popView('admin/step/stepDataView' , $data);
			
		}
		
		function dataFormView()
		{
			
			$this->load->library('DataControl'); 
			
			$FORM_ID = $this->input->get('form_id');
			$GUBUN = base64_decode($this->input->post('GUBUN'));
			$PRJ_IDX = $this->input->post('PRJ_IDX');
			$STEP_IDX = $this->input->post('STEP_IDX');
			
			$this->load->model('admin/step/stepManagement_model','stepmodel',true);

			$res = $this->stepmodel->getEtcVarList(array($PRJ_IDX,$STEP_IDX,$GUBUN));
			$rowCount = $res->num_rows();
			$rdata = null;
			
			$data['FRM_CNTNT'] = '';
			
			$data['GUBUN'] = base64_encode($GUBUN);
			$data['PRJ_IDX'] = $PRJ_IDX;
			$data['STEP_IDX'] = $STEP_IDX;
			$data['FORM_ID'] = $FORM_ID;
			
			if ($rowCount > 0)
			{
				$rdata = $res->result();
				$data['ETCVARLIST'] = $this->datacontrol->getEtcList($rdata[0]->ETC1VAR);
				$data['FRM_CNTNT'] = $rdata[0]->FRM_CNTNT;
			}
			
			$this->popView('admin/step/stepDataFormView' , $data);
		}
		
		function dataFormProcess()
		{
			$FORM_ID = $this->input->post('FORM_ID');
			$PRJ_IDX = $this->input->post('PRJ_IDX');
			$STEP_IDX = $this->input->post('STEP_IDX');
			$GUBUN = base64_decode($this->input->post('GUBUN'));
			$FRM_CNTNT = Html2String($this->input->post('FRM_CNTNT'));
			
			$this->load->model('admin/step/stepManagement_model','stepmodel',true);
			$this->stepmodel->getStepFormProcess(array($FRM_CNTNT,$PRJ_IDX,$STEP_IDX,$GUBUN,$FORM_ID,'N'));
			
			winclose();
			
		}
		
		// ���� ��Ϲ� ����
		function stepProcess()
		{
			$P_TYPE = $this->input->post('P_TYPE');
			$PRJ_IDX = $this->input->post('PRJ_IDX');
			
			if ($P_TYPE == 'regist')
			{
				$this->load->model('admin/step/stepManagement_model','stepmodel',true);
				$this->stepmodel->getStepRegist(array($PRJ_IDX,' '));
				
			}
			
			if ($P_TYPE == 'modify') 
			{
				
				$STEP_IDX = $this->input->post('STEP_IDX');		
				$STEP_NM = $this->input->post('STEP_NM');
				
				$STEP_STDT1 = $this->input->post('STEP_STDT1');
				$STEP_STDT2 = $this->input->post('STEP_STDT2');
				$STEP_STDT3 = $this->input->post('STEP_STDT3');
				
				$STEP_EDDT1 = $this->input->post('STEP_EDDT1');
				$STEP_EDDT2 = $this->input->post('STEP_EDDT2');
				$STEP_EDDT3 = $this->input->post('STEP_EDDT3');
				
				$STEP_STDT = $STEP_STDT1 .' '. $STEP_STDT2 .':'. $STEP_STDT3.':00';
				$STEP_EDDT = $STEP_EDDT1 .' '. $STEP_EDDT2 .':'. $STEP_EDDT3.':00';
			
				$this->load->model('admin/step/stepManagement_model','stepmodel',true);
				
				$this->stepmodel->getStepModify(array($STEP_NM,$STEP_STDT,$STEP_EDDT,$PRJ_IDX,$STEP_IDX));
			
			}
		
			if ($P_TYPE == 'delete')
			{
				$STEP_IDX_LIST = $this->input->post('STEP_IDX_LIST');
		
				$STEP_IDX_LIST = substr($STEP_IDX_LIST,1,strlen($STEP_IDX_LIST));
		//			echo $STEP_IDX_LIST;
			//	exit;
			//array('P_PRJ_IDX' => $arg1, 'p_step_idx' => $arg2
			
				$this->load->model('admin/step/stepManagement_model','stepmodel',true);
				$obj = array();
				$obj['P_PRJ_IDX'] = $PRJ_IDX;
				$obj['P_STEP_IDX_LIST'] = $STEP_IDX_LIST;
				
				$this->stepmodel->getStepDelete($obj);
			}
			
			redirect('/admin/stepManagement?project_id=' . $PRJ_IDX);
			
		}
		
		
		
		function applyList()
		{
			$this->load->library('DataControl'); 
			$this->load->library('FormBox'); 
			$this->load->library('pagination');	
			$this->load->model('admin/require/requiremanagement_model','reqmdl',true);
			$this->load->model('admin/step/stepManagement_model','steplist',true);
			
			$data = null;
			
			$COMP_ID = $this->authadmin->getCompanyId();
			$PRJ_IDX = $this->input->post('PRJ_IDX');
			$STEP_IDX = $this->input->post('STEP_IDX');
			$SCH_LIST_COUNT = $this->input->post('SCH_LIST_COUNT');
			$UNIT_IDX = $this->input->post('UNIT_IDX');
			
			$EXCEL_FLAG = $this->input->post('EXCEL_FLAG');
			
			$NAMEKOR = $this->input->post('NAMEKOR');
			$S_NAI = $this->input->post('S_NAI');
			$E_NAI = $this->input->post('E_NAI');
			$SEX_CD = $this->input->post('SEX_CD');
			$CAREER_TP = $this->input->post('CAREER_TP');
			$CAREER_CMP_NM = $this->input->post('CAREER_CMP_NM');
			$S_CAREER_SUM = $this->input->post('S_CAREER_SUM');
			$E_CAREER_SUM = $this->input->post('E_CAREER_SUM');
			$LAN_IDX = $this->input->post('LAN_IDX');
			$SCH_NM = $this->input->post('SCH_NM');
			$SCH_MAJOR_NM = $this->input->post('SCH_MAJOR_NM');
			$SCH_TP = $this->input->post('SCH_TP');
			$SCH_FGRD_TP = $this->input->post('SCH_FGRD_TP');
			
			$data['NAMEKOR'] = $NAMEKOR;
			$data['S_NAI'] = $S_NAI;
			$data['E_NAI'] = $E_NAI;
			$data['SEX_CD'] = $SEX_CD;
			$data['CAREER_TP'] = $CAREER_TP;
			$data['CAREER_CMP_NM'] = $CAREER_CMP_NM;
			$data['S_CAREER_SUM'] = $S_CAREER_SUM;
			$data['E_CAREER_SUM'] = $E_CAREER_SUM;
			$data['LAN_IDX'] = $LAN_IDX;
			$data['SCH_NM'] = $SCH_NM;
			$data['SCH_MAJOR_NM'] = $SCH_MAJOR_NM;
			
			$data['SCH_TP'] = $SCH_TP;
			$data['SCH_FGRD_TP'] = $SCH_FGRD_TP;
			
			$SCH_LIST_COUNT = !$SCH_LIST_COUNT ? 10 : $SCH_LIST_COUNT;
			
			$data['STEP_IDX'] = $STEP_IDX;
			
			$data['code'] = null;
			$res = $this->steplist->getProjectPassCode(array($PRJ_IDX));
			if ($res->num_rows() > 0 )
			{
				$rdata = $res->result();
				$data['code'] = base64_encode($rdata[0]->PASSWD);
			}
						
			//����Ʈ �ڽ� - ������Ʈ
			$this->load->model('admin/project/projectManager_model','prjlist',true);
			$res = $this->prjlist->getSimpleProjectList(array($COMP_ID,'N'));
			$rdata = null;
			$rdata = $res->result();
			
			if ($res->num_rows() == 0)
			{
				jsalertmsg('ä����� �����ϴ�.');
				jshistoryback();
				exit;
			}
			
			if (!$PRJ_IDX && $rdata[0]->CODE != '' ) $PRJ_IDX = $rdata[0]->CODE;
			
			$data['PRJ_IDX'] = $PRJ_IDX;
			
			// �����о� ����Ʈ
			/* ���� �����о� ����Ʈ�� */
			$unitRs = $this->steplist->getUnitLeafNodeList(array($PRJ_IDX,'N',$PRJ_IDX,'N'));
			$unitObj = array();
			foreach ($unitRs->result() as $key => $unitList)
			{
				$unitObj[] = array($unitList->UNIT_IDX,$unitList->PATH);
			}
			
			$this->formbox->setId('UNIT_IDX');
			$this->formbox->setName('UNIT_IDX');
			$this->formbox->setOption('');
			$data['SELECTBOX_UNIT_IDX'] = $this->formbox->getSelectBox($unitObj, '�����о� ����' , $UNIT_IDX , $objType = 'array');
			
			$this->formbox->setId('PRJ_IDX');
			$this->formbox->setName('PRJ_IDX');
			$this->formbox->setOption('');
			$data['SELECTBOX_PRJ_IDX'] = $this->formbox->getSelectBox($res->result(),'�����ϼ���',$PRJ_IDX);
			
			//���ڵ��
			$listCountAr = array();
			$listCountAr[] = array(10,'10 ��');
			$listCountAr[] = array(20,'20 ��');
			$listCountAr[] = array(30,'30 ��');
			$listCountAr[] = array(50,'50 ��');
			$listCountAr[] = array(100,'100 ��');
			
			$this->formbox->setId('SCH_LIST_COUNT');
			$this->formbox->setName('SCH_LIST_COUNT');
			$this->formbox->setOption('');
			$data['SELECTBOX_SCH_LIST_COUNT'] = $this->formbox->getSelectBox($listCountAr,'����',$SCH_LIST_COUNT,'array');
			
			$list = $this->pagination->setProperty('per_page',$SCH_LIST_COUNT);
			
			
			$rdata = null;
			//����Ʈ �ڽ� - ����
			
			$res = $this->steplist->getSimpleStepList(array($PRJ_IDX,'N'));
			
			$this->formbox->setId('SCH_STEP_IDX');
			$this->formbox->setName('SCH_STEP_IDX');
			$this->formbox->setOption('');
			
			$data['SELECTBOX_STEP'] = $this->formbox->getSelectBox($res->result(),'�����ϼ���','');
			$data['stepData'] = $res->result();
			$res = null;
			
			$per_page = $this->input->get('per_page');
			$per_page = !$per_page ? 1 : $per_page;
			$list = $this->pagination->getProperty('per_page');
			
			$this->load->model('admin/step/stepManagement_model','aplist',true);
			//echo $PRJ_IDX . '---' . $UNIT_IDX . '<br>';
			$res = $this->reqmdl->getResumeCodeList(array($PRJ_IDX,!$UNIT_IDX ? '' : $UNIT_IDX,'N'));
			$rsmCodeRs = $res->result();
			
			if ($res->num_rows() > 0)
			{
			
			}
			else
			{
				jsalertmsg('�̷¼� ����� �����ϴ�. �ý��۰������� �����ϼ���. [ERR011]');
				jshistoryback();
				exit;
			}
			
			$data['RSM_IDX'] = $rsmCodeRs[0]->RSM_IDX;
			$RSM_IDX = $rsmCodeRs[0]->RSM_IDX;
			
			/* personal ���� */
			$res = $this->reqmdl->getResumeFormList(array($COMP_ID,$PRJ_IDX,$RSM_IDX,'N'));
			$data['rsmDataUseYn'] = $res->result();
		
			$appres = $this->aplist->getApplyList(  $data['rsmDataUseYn']
																						 ,$COMP_ID
										    										 ,$PRJ_IDX
										    										 ,$UNIT_IDX
										    										 ,$STEP_IDX
										    										 ,$NAMEKOR != '' ? '%' . $NAMEKOR . '%' : ''
										    										 ,$S_NAI
										    										 ,$E_NAI
										    										 ,$SEX_CD
										    										 ,$SCH_NM != '' ? '%' . $SCH_NM . '%' : ''
										    										 ,$SCH_TP
										    										 ,$SCH_FGRD_TP
										    										 ,$CAREER_TP
										    										 ,$CAREER_CMP_NM != '' ? '%' . $CAREER_CMP_NM . '%' : ''
										    										 ,$S_CAREER_SUM != '' ? $S_CAREER_SUM * 12 : ''
										    										 ,$E_CAREER_SUM != '' ? $E_CAREER_SUM * 12 : ''
										    										 ,$LAN_IDX
										    										 ,$list * ($per_page - 1) + 1
										    										 ,$per_page * $list
										    										 ,$EXCEL_FLAG);

			//$res = $this->aplist->getApplyList(array($PRJ_IDX,$STEP_IDX,'N',$list * ($per_page - 1) + 1 ,$per_page * $list));
			
			$data['appList'] = $appres->result();
			$data['rowCount'] = $appres->num_rows() > 0 ? $data['appList'][0]->ALL_LIST_COUNT : 0;
			
			if ($EXCEL_FLAG == 'excel')
			{
				header("Content-Type: application/vnd.ms-excel");
				header("Content-Disposition: attachment; filename=\"excel.xls\"");
				header("Cache-Control: max-age=0");
				///$this->load->library('excel');
				
				//$objPHPExcel = $this->excel->createSheet();
				$excel = '<table border=1>';
				foreach ($data['appList'] as $key => $xlist)
				{
					$excel .= '<tr>';
					foreach ($xlist as $skey => $clist)
					{
						//$objPHPExcel->setCellValueByColumnAndRow($skey,$key,$clist);
						$excel .= '<td>' . $clist . '</td>';
					}
					$excel .= '<tr>';
					
				}
				
				$excel .= '</table>';
				echo $excel;
				//$xcel->setActiveSheetIndex(0);
				
				
				exit;
				
			}
			
			$paging['total_rows'] = $data['rowCount'];
			$paging['base_url'] = '/admin/stepManagement/applyList?q=';
			
			$this->pagination->initialize($paging); 
			
			$data['paging'] = $this->pagination->create_links();
			$data['cur_page'] = $per_page;			
			
			
			
			if ($data['rsmDataUseYn'][0]->PERSONAL_USE_YN == 'Y')
			{
					
			}
			
			if ($data['rsmDataUseYn'][0]->SCHOOL_USE_YN == 'Y')
			{
				//�����з�
				$res = $this->reqmdl->getCodeList(array('SCT','Y','N'));
				$this->formbox->setId('SCH_TP');
				$this->formbox->setName('SCH_TP');
				$this->formbox->setOption('');
				$data['SELECTBOX_SCH_TP'] = $this->formbox->getSelectBox($res->result(), '�з¼���' , $SCH_TP , $objType = 'db');
			}
			
			if ($data['rsmDataUseYn'][0]->LANGUAGE_USE_YN == 'Y')
			{
				$LanRes = $this->steplist->getResumeFormSetList(array($RSM_IDX,'N','N'));
				$lanObj = array();
				foreach ($LanRes->result() as $key => $lanList)
				{
					$lanObj[$key]->{'CODE'} = $lanList->LAN_IDX;
					$lanObj[$key]->{'NAME'} = $lanList->LAN_NM;
				}
				$this->formbox->setId('LAN_IDX');
				$this->formbox->setName('LAN_IDX');
				$this->formbox->setOption('');
				$data['SELECTBOX_LAN_IDX'] = $this->formbox->getSelectBox($lanObj, '���н��輱��' , $LAN_IDX , $objType = 'db');
				
			}
			
			$this->loadView('admin/step/stepApplyList' , $data);
		}
		
		function applyStepUpdateProcess()
		{
			$PRJ_IDX = $this->input->post('PRJ_IDX');
			$STEP_IDX = $this->input->post('STEP_IDX');
			$TARGET_STEP_IDX = $this->input->post('TARGET_STEP_IDX');
			$APPLY_LIST = $this->input->post('APPLY_LIST');
			
			//$APPLY_LIST = substr($APPLY_LIST,1,strlen($APPLY_LIST));
			$this->load->model('admin/step/stepManagement_model','aplist',true);
			$obj = array();
			
			$obj['P_PRJ_IDX'] = $PRJ_IDX;
			$obj['P_TARGET_STEP_IDX'] = $TARGET_STEP_IDX;
			$obj['P_APPLY_LIST'] = $APPLY_LIST;
			$obj['P_MANAGER_ID'] = $this->authadmin->getUserId();
			$obj['P_IP'] = $_SERVER['REMOTE_ADDR'];
			
			$res = $this->aplist->getMoveStep($obj);
			
			echo $res == true ? 'OK' : 'ERROR';
			//var_dump($obj);
			
		}
		
		// �����о߹� �ڰ� ��� 
		
		function unitRegist()
		{
			$PRJ_IDX = $this->input->post('PRJ_IDX');
			$UNIT_NM = $this->input->post('UNIT_NM');
			$PUNIT_IDX = $this->input->post('PUNIT_IDX');
			
			if (!$PUNIT_IDX) $PUNIT_IDX = NULL;
			$this->load->model('admin/step/stepManagement_model','unit',true);
			$res = $this->unit->getUnitRegist(array($PRJ_IDX,$UNIT_NM,$PUNIT_IDX));
			//if ($res == '1')
			//{
			//echo 'OK';
			//}
			redirect('/admin/stepManagement/unitManager?project_id=' . $PRJ_IDX);
		}
		
		// �����о߹� �ڰݿ�� ����
		function unitAuthList()
		{
			$this->load->library('FormBox');
			$this->load->model('admin/step/stepManagement_model','unit',true);
			
			$data = null;
			$COMP_ID = $this->authadmin->getCompanyId();
			$PRJ_IDX = $this->input->get('project_id');
			$RSM_IDX = null;
			
			// �̷¼� �ڵ� �������� ���� -- ����� ���α׷��� �׷��� �׷��� �̷¼��� ������ �Ⱥ��� �׳� ������Ʈ�� ������ - �̷¼��� ���´�.
			$res = $this->unit->getResumeIndex(array($COMP_ID,$PRJ_IDX,'N'));
			$rsm_idx = $res->result();
			if ($res->num_rows() == 1)
			{
				$RSM_IDX = $rsm_idx[0]->RSM_IDX;
			}
			else
			{
				jsalertmsg('�̷¼� ��ĵ����͸� �ҷ����� �������� ������ �߻��Ͽ����ϴ�. �����ڵ�:[ERR006]');
				exit;
			}
			
			$res = $this->unit->getUnitTopList(array($PRJ_IDX,'N'));
			
			$this->formbox->setId('UNIT_LEVEL1');
			$this->formbox->setName('UNIT_LEVEL1');
			$this->formbox->setOption('onChange="selUnitLevel1(this);"');
			$data['SELECTBOX_UNIT_LEVEL1'] = $this->formbox->getSelectBox($res->result() ,'�����ϼ���.','');
			
			$data['PRJ_IDX'] = $PRJ_IDX;
			$data['RSM_IDX'] = $RSM_IDX;
			//getWorkPlaceList
			//$this->formbox->setId('WORK_PLACE_LIST');
			//$this->formbox->setName('WORK_PLACE_LIST');
			//$this->formbox->setOption('multiple="multiple"');
			//$res = $this->unit->getWorkPlaceList(array($COMP_ID,'N'));
			//$data['SELECTBOX_WORK_PLACE'] = $this->formbox->getSelectBox($res->result() , null,'');
			//$res = null;
			//getWorkManagerList
			
			// �����оߴ����, �ɻ�����
			$unit_manager = array();
			$check_manager = array();
			$res = $this->unit->getWorkManagerList(array($COMP_ID,'Y','N'));
			$rdata = $res->result();
			
			foreach ($rdata as $key => $listdata)
			{
				if ($listdata->MANAGER_TP == 'U') $unit_manager[] = array($listdata->MANAGER_ID, $listdata->MANAGER_NM);
				if ($listdata->MANAGER_TP == 'C') $check_manager[] = array($listdata->MANAGER_ID, $listdata->MANAGER_NM);	
			}
			
			
			$data['unit_manager_count'] = count($unit_manager);
			for ($x = 0;$x < $data['unit_manager_count'] ; $x ++)
			{
				$this->formbox->setId('MANAGER_LIST1_' . $x);
				$this->formbox->setName('MANAGER_LIST1_' . $x);
				$this->formbox->setOption('');
			  $data['SELECTBOX_MANAGER_LIST1_' . $x] = $this->formbox->getSelectBox($unit_manager ,'�����ϼ���.' ,'','array');
			}
		  
			
			$data['check_manager_count'] = count($check_manager);
			for ($x = 0;$x < $data['check_manager_count'] ; $x ++)
			{
				$this->formbox->setId('MANAGER_LIST2_' . $x);
				$this->formbox->setName('MANAGER_LIST2_' . $x);
				$this->formbox->setOption('');
				$data['SELECTBOX_MANAGER_LIST2_' . $x] = $this->formbox->getSelectBox($check_manager ,'�����ϼ���.' ,'','array');
			}
			
			//������� �����о� ���
			$rs = $this->unit->getUnitLeafNodeList(array($PRJ_IDX,'N',$PRJ_IDX,'N'));
			//$rs = $this->unit->getUnitLeafNodeList(array($PRJ_IDX,$PRJ_IDX,$COMP_ID,$PRJ_IDX,$COMP_ID,$PRJ_IDX));
			$udata = $rs->result();
			$data['udataCount'] = $rs->num_rows();
			//echo $data['udataCount'];
			
			//var_dump($data['udata']);
			
			// �������� ����Ʈ
			$unitList = array();

			
			$x = 0;
			$subrs = null;
			foreach ($udata as $key => $unitdata)
			{
				
				$subrs1 = $this->unit->getUnitLeafNodeManagerList(array($COMP_ID,$PRJ_IDX,$unitdata->UNIT_IDX));		
				$subrs2 = $this->unit->getUnitLeafNodePlaceList(array($COMP_ID,$PRJ_IDX,$unitdata->UNIT_IDX));		
				
				//����� ����Ʈ
				$managerList_m = array();
				$managerList_c = array();
				
				foreach ($subrs1->result() as $key1 => $subdata1)
				{
					if ($subdata1->MANAGER_TP == 'U') $managerList_m[] = $subdata1->MANAGER_NM;
					if ($subdata1->MANAGER_TP == 'C') $managerList_c[] = $subdata1->MANAGER_NM;
				}
				
				//����
				$placeList = array();
				$WRK_PLC_CNT = null;
				foreach ($subrs2->result() as $key2 => $subdata2)
				{
					$placeList[] = $subdata2->WRK_PLC_NM;
					$WRK_PLC_CNT = $subdata2->WRK_PLC_CNT;
				}
				
				$unitList[$x]->{'UNIT_IDX'} = $unitdata->UNIT_IDX;
				$unitList[$x]->{'PATH'} = $unitdata->PATH;
				$unitList[$x]->{'APPLY_CNT'} = $unitdata->APPLY_CNT;
				$unitList[$x]->{'MANAGER1'} = implode(',',$managerList_m);
				$unitList[$x]->{'MANAGER2'} = implode(',',$managerList_c);
				$unitList[$x]->{'PLACE'} = implode(',',$placeList);
				$unitList[$x]->{'WRK_PLC_CNT'} = $WRK_PLC_CNT;
				$unitList[$x]->{'CODELIST'} = $unitdata->CODELIST;
				//array(,$unitdata->PATH,$unitdata->APPLY_CNT,implode(',',$managerList_m),implode(',',$managerList_c),implode(',',$placeList));
				$x++;
			}
			$data['rdata'] = $unitList;
			$this->loadView('admin/step/stepUnitAuth_view' , $data);
		}
		
		// ����ٹ��� ajax 
		function workPlaceList()
		{
			$this->load->library('Json');
			$this->load->model('admin/step/stepManagement_model','unit',true);
			
			$PRJ_IDX = $this->input->get('PRJ_IDX');
			$UNIT_IDX = $this->input->get('UNIT_IDX');
			//$RSM_IDX = $this->input->get('RSM_IDX');
			$COMP_ID = $this->authadmin->getCompanyId();
			
			//$RSM_IDX = 1;
			$res = $this->unit->getWorkPlaceList(array($PRJ_IDX,$UNIT_IDX,'N',$COMP_ID,'N'));
			
			$rdata = $res->result();
			$ar = array();
			foreach ($rdata as $key => $listdata)
			{
				$ar[] = array($listdata->CODE,$listdata->UNIT_IDX,iconv('EUC-KR','UTF-8',$listdata->NAME));
			}
			header("Content-Type: text/html; charset=UTF-8");
			echo $this->json->getArray2Json($ar);
		}
		
		// applyNoSetList -- �����ȣ ü�� AJAX //[{"APPL_PREFIX":"ZZZ","APPL_SUFFIX":"","APPL_TP":"U","APPL_LEN":7}]
		function applyNoSetList()
		{
			
			$this->load->library('Json');
			$this->load->model('admin/step/stepManagement_model','unit',true);
			
			$PRJ_IDX = $this->input->get('PRJ_IDX');
			$UNIT_IDX = $this->input->get('UNIT_IDX');
			
			$res = $this->unit->getApplyNoList(array($PRJ_IDX,$UNIT_IDX,'N'));
			header("Cache-Control: no-cache");
			header("Pragma: no-cache");
			header("Content-Type: text/html; charset=UTF-8");
			echo $this->json->getArray2Json($res->result());
			
		}
		
		
		function unitTreeLevelList() // dep
		{
			$id = $this->input->post('id');
			$this->load->library('Json');
			$PRJ_IDX = $this->input->get('PRJ_IDX');
			$PRJ_IDX = 1;
			$id = !$id ? NULL : $id;
			$this->load->model('admin/step/stepManagement_model','unit',true);
			$res = $this->unit->getUnitTreeList(array($PRJ_IDX,$PRJ_IDX,$id,'N'));
			$rdata = $res->result();
		
			$ar = array();
			foreach ($rdata as $key => $code)
			{
					//$ar[] = array($code->CODE , urlencode($code->NAME));
					$node = array();
					$node['id'] = $code->CODE;
					$node['text'] = iconv('EUC-KR','UTF-8',$code->NAME);
					$node['state'] = ! $code->CNT > 0 ? 'open' : 'closed';
					$ar[] = $node;
					//$ar[] = array($code->CODE ,iconv('EUC-KR','UTF-8',$code->NAME));
			}
			
			//echo $this->json->getObj2Json($rdata);
			header("Cache-Control: no-cache");
			header("Pragma: no-cache");
			header("Content-Type: text/html; charset=UTF-8");
			echo $this->json->getArray2Json($ar);
		}
		
		function unitLevelList()
		{
			$this->load->library('Json');
			
			$PRJ_IDX = $this->input->get('PRJ_IDX');
			$PUNIT_IDX = $this->input->get('PUNIT_IDX');
			if (!$PUNIT_IDX) $PUNIT_IDX = NULL;
			$this->load->model('admin/step/stepManagement_model','unit1',true);
			$res = $this->unit1->getUnitLevelList(array($PRJ_IDX,$PUNIT_IDX,'N'));
			$rdata = $res->result();
		
			$ar = array();
			foreach ($rdata as $key => $code)
			{
					//$ar[] = array($code->CODE , urlencode($code->NAME));
					$ar[] = array($code->CODE ,iconv('EUC-KR','UTF-8',$code->NAME),$code->CNT);
			}
			
			//echo $this->json->getObj2Json($rdata);
			header("Cache-Control: no-cache");
			header("Pragma: no-cache");
			header("Content-Type: text/html; charset=UTF-8");
			echo $this->json->getArray2Json($ar);
			//unitLevelList
			///var_dump($rdata);
		}
		
		function unitDelete()
		{
			$PRJ_IDX = $this->input->post('PRJ_IDX');
			$UNIT_IDX = $this->input->post('UNIT_IDX');
		
			$this->load->model('admin/step/stepManagement_model','unit',true);
			$this->unit->getUnitDelete(array('Y',$PRJ_IDX,$UNIT_IDX));
			redirect('/admin/stepManagement/unitManager?project_id=' . $PRJ_IDX);
		}
		
		function unitModify()
		{
			$UNIT_IDX = $this->input->post('UNIT_IDX');
			$PRJ_IDX = $this->input->post('PRJ_IDX');
			$UNIT_NM = $this->input->post('UNIT_NM');
		
			$this->load->model('admin/step/stepManagement_model','unit',true);
			$this->unit->getUnitModify(array($UNIT_NM,$PRJ_IDX,$UNIT_IDX));
			redirect('/admin/stepManagement/unitManager?project_id=' . $PRJ_IDX);
		}
		
		function unitManager()
		{
			
			$PRJ_IDX = $this->input->get('project_id');
			$data = null;
			$data['PRJ_IDX'] = $PRJ_IDX;
			
			$this->load->library('FormBox');
			$this->load->model('admin/step/stepManagement_model','unit',true);
			$res = $this->unit->getUnitTopList(array($PRJ_IDX,'N'));
			
			$this->formbox->setId('UNIT_LEVEL1');
			$this->formbox->setName('UNIT_LEVEL1');
			$this->formbox->setOption('onChange="selUnitLevel1(this);"');
			$data['SELECTBOX_UNIT_LEVEL1'] = $this->formbox->getSelectBox($res->result() ,'�����ϼ���.','');
			
			$this->popView('admin/step/unitmanager_view' , $data);
		}
		
		function unitAuthInfo()
		{
			$this->load->library('Json');
			$this->load->model('admin/step/stepManagement_model','unit',true);
			
			$PRJ_IDX = $this->input->get('PRJ_IDX');
			$RSM_IDX = $this->input->get('RSM_IDX');
			$UNIT_IDX = $this->input->get('UNIT_IDX');
			
			$res = $this->unit->getUnitAuthList(array($PRJ_IDX,$UNIT_IDX,$RSM_IDX,'N','N'));
			$rdata = $res->result();
			
			header("Cache-Control: no-cache");
			header("Pragma: no-cache");
			header("Content-Type: text/html; charset=UTF-8");
			echo $this->json->getObj2Json($rdata);
			
		}
		
		function managerAuthList()
		{
			$this->load->library('Json');
			$this->load->model('admin/step/stepManagement_model','unit',true);
			
			$PRJ_IDX = $this->input->get('PRJ_IDX');			
			$UNIT_IDX = $this->input->get('UNIT_IDX');
			//$PRJ_IDX = 1;
			
			//$UNIT_IDX = 41;
			$res = $this->unit->getManagerAuthList(array($PRJ_IDX,$UNIT_IDX,'N'));
			$rdata = $res->result();
			
			header("Cache-Control: no-cache");
			header("Pragma: no-cache");
			header("Content-Type: text/html; charset=UTF-8");
			echo $this->json->getObj2Json($rdata);
			
		}
		
		//�����о߹� �ڰݿ�� ���� - ���� - ���/����
		function unitAuthProcess()
		{
			$PRJ_IDX = $this->input->post('PRJ_IDX');
			$RSM_IDX = $this->input->post('RSM_IDX');
			$UNIT_IDX = $this->input->post('UNIT_IDX');
			
			$APPLY_CNT = $this->input->post('APPLY_CNT');
			
			$WORK_PLACE_LIST = $this->input->post('WORK_PLACE_LIST');
			$WRK_PLC_CNT = $this->input->post('WRK_PLC_CNT');
			$UNIT_MANAGER_COUNT = $this->input->post('UNIT_MANAGER_COUNT');
			$CHECK_MANAGER_COUNT = $this->input->post('CHECK_MANAGER_COUNT');
			$WORK_PLACE_LIST_FOR_DELETE = $this->input->post('WORK_PLACE_LIST_FOR_DELETE');
			
			$APPL_PREFIX = $this->input->post('APPL_PREFIX');
			$APPL_SUFFIX = $this->input->post('APPL_SUFFIX');
			$APPL_LEN = $this->input->post('APPL_LEN');
			$APPL_TP = $this->input->post('APPL_TP');
			$SEQ_RESET = $this->input->post('SEQ_RESET');
			$managerList = array();
			$managerDeleteList = array();
			
			// �����о߹� �ɻ����� ó�� 
			for ($a = 0;$a < $UNIT_MANAGER_COUNT ; $a ++ )
			{

				if ($this->input->post('MANAGER_LIST1_' . $a) != '')
				$managerList[] = array($this->input->post('MANAGER_LIST1_' . $a),
															 $this->input->post('AUTH_APPLY_MNG1_' . $a) == 'Y' ? 'Y' : 'N',	
															 $this->input->post('AUTH_APPLY_VW1_' . $a) == 'Y' ? 'Y' : 'N',	
															 $this->input->post('AUTH_MAIL1_' . $a) == 'Y' ? 'Y' : 'N',	
															 $this->input->post('AUTH_SMS1_' . $a) == 'Y' ? 'Y' : 'N');
				
				if ($this->input->post('MANAGER_LIST1_' . $a) == '' && $this->input->post('HIDDEN_MANAGER_LIST1_' . $a) != '' )
				$managerDeleteList[] = $this->input->post('HIDDEN_MANAGER_LIST1_' . $a);
			}
			
			for ($a = 0;$a < $CHECK_MANAGER_COUNT ; $a ++ )
			{
				if ($this->input->post('MANAGER_LIST2_' . $a) != '')
				$managerList[] = array($this->input->post('MANAGER_LIST2_' . $a),
															 $this->input->post('AUTH_APPLY_MNG2_' . $a) == 'Y' ? 'Y' : 'N',	
															 $this->input->post('AUTH_APPLY_VW2_' . $a) == 'Y' ? 'Y' : 'N',	
															 $this->input->post('AUTH_MAIL2_' . $a) == 'Y' ? 'Y' : 'N',	
															 $this->input->post('AUTH_SMS2_' . $a) == 'Y' ? 'Y' : 'N');
															 
				if ($this->input->post('MANAGER_LIST2_' . $a) == '' && $this->input->post('HIDDEN_MANAGER_LIST2_' . $a) != '' )
				$managerDeleteList[] = $this->input->post('HIDDEN_MANAGER_LIST2_' . $a);
			}
			
			
			$this->load->model('admin/step/stepManagement_model','unit',true);
			
			
			
			
			// ������
			foreach ($managerList as $key => $managerData)
			{
				$this->unit->getUpdateManagerAuth(array($PRJ_IDX,$UNIT_IDX,$managerData[0],
																								$managerData[1],$managerData[2],$managerData[3],$managerData[4],
																								$PRJ_IDX,$UNIT_IDX,$managerData[0],$managerData[1],$managerData[2],$managerData[3],$managerData[4]));
				
			}
			
			// ���� �� ��� 
			foreach ($managerDeleteList as $key1 => $delData)
			{
				//echo $delData . '<br>';
				$this->unit->getDeleteManagerAuth(array($PRJ_IDX , $UNIT_IDX , $delData));
			}
			
		 	// ä���ο� ������Ʈ
		 	$this->unit->getUpdateUnitApplyCount(array($APPLY_CNT,$PRJ_IDX ,$UNIT_IDX,'N'));
			
			$this->unit->getUpdatePlaceCount(array($PRJ_IDX,$UNIT_IDX,$RSM_IDX,$WRK_PLC_CNT > 0 ? 'Y' : 'N',$WRK_PLC_CNT,'N',$UNIT_IDX,$RSM_IDX,$PRJ_IDX,$WRK_PLC_CNT > 0 ? 'Y' : 'N',$WRK_PLC_CNT));
			
			//�ٹ��� ������ �ݺ�
			
			
			foreach ($WORK_PLACE_LIST as $key2 => $plist)
			{
				$this->unit->getUpdatePlaceList(array($PRJ_IDX,$UNIT_IDX,$plist,'N',$UNIT_IDX,$PRJ_IDX,$plist,'N'));
			}
			
			$place_delete_list = explode('|', $WORK_PLACE_LIST_FOR_DELETE);
			foreach ($place_delete_list as $key2 => $dlist)
			{
				if (trim($dlist) != '') 
				{
					//echo $dlist . '���� <br>';
					$this->unit->getUpdatePlaceList(array($PRJ_IDX,$UNIT_IDX,$dlist,'Y',$UNIT_IDX,$PRJ_IDX,$dlist,'Y'));
				}
			}
			
			
			
			// �����ȣ ���μ��� 
			$objApplyNo = array();
			$objApplyNo['p_prj_idx'] = $PRJ_IDX;
			$objApplyNo['p_unit_idx'] = $UNIT_IDX;
			$objApplyNo['p_appl_prefix'] = $APPL_PREFIX;
			$objApplyNo['p_appl_suffix'] = $APPL_SUFFIX;
			$objApplyNo['p_appl_tp'] = $APPL_TP;
			$objApplyNo['p_appl_len'] = $APPL_LEN;
			$objApplyNo['p_flag'] = $SEQ_RESET;
			
			$this->unit->getApplyNoProcess($objApplyNo);
			
			redirect('/admin/stepManagement/unitAuthList?project_id=' . $PRJ_IDX);
			
		}
		
		//delete 
		function unitAuthProcessForDelete()
		{
			$this->load->model('admin/step/stepManagement_model','unit',true);
			$PRJ_IDX = $this->input->post('P_PRJ_IDX');
			$DEL_UNIT_LIST = $this->input->post('DEL_UNIT_LIST');
			$DEL_UNIT_LIST = substr($DEL_UNIT_LIST,1,strlen($DEL_UNIT_LIST));
			
			$obj['P_PRJ_IDX'] = $PRJ_IDX;
			$obj['P_UNIT_IDX_LIST'] = $DEL_UNIT_LIST;
			print_r($obj);
			exit;
			$res = $this->unit->getConfirmUnitDelete(array($PRJ_IDX,'N'));
			$cres = $res->result();
			
			// ���� ������ ���� ��¥�� ��ġ�°� �ϳ��� ������ �ϴ� ���� ���ϰ� ����
			if ($cres[0]->STEP_COUNT > 0)
			{
				jsalertmsg('�ش� ä������� ������ �������ڿ� ��Ĩ�ϴ�. \n������ �Ͻ÷��� �ý��۰����ڿ��� �����Ͽ� �ּ���. �����ڵ�[ERR007]');
				jshistoryback();
				exit;
			}
			
			$this->unit->getUnitRequireDelete($obj);
			
			redirect('/admin/stepManagement/unitAuthList?project_id=' . $PRJ_IDX);
		}
		
		function applyStepHistory()
		{
			//applyStepHistory()
			$data = null;
			$PRJ_IDX = $this->input->post('SPRJ_IDX');
			$APPLY_NO = $this->input->post('APPLY_NO');
			$this->load->model('admin/step/stepManagement_model','unit',true);
			$res = $this->unit->getApplyStepHistory(array($PRJ_IDX,$APPLY_NO));
			$data['rdataCount'] = $res->num_rows();
			$data['rdata'] = $res->result();
			$data['APPLY_NO'] = $APPLY_NO;
			
			$this->popView('admin/step/stepHistoryList_view' , $data);
		}
		
		function applyPasswordReset()
		{
			$data = null;
			$PRJ_IDX = $this->input->post('SPRJ_IDX');
			$APPL_IDX = $this->input->post('APPL_IDX');
			$data['APPL_IDX'] = $APPL_IDX;
			$data['PRJ_IDX'] = $PRJ_IDX;
			$this->popView('admin/step/passwordResetForm_view' , $data);
		} 
		
		function applyPasswordResetProcess()
		{
			$this->load->model('admin/step/stepManagement_model','unit',true);
			$PRJ_IDX = $this->input->post('PRJ_IDX');
			$APPL_IDX = $this->input->post('APPL_IDX');
			$PASSWORD = $this->input->post('PASSWORD');
		
			$res = $this->unit->getApplyPasswordUpdate(array(md5($PASSWORD),$PRJ_IDX,$APPL_IDX));
			
			jsalertmsg('����Ǿ����ϴ�.');
			winclose('on');
			exit;
		}
	
	}
	