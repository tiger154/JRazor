<?
	class ReportService extends MY_Controller
	{
		function __construct()
		{
			parent::__construct();
		}
		
		private function setProjectList()
		{
			$PRJ_IDX = null;
			$this->load->library('FormBox'); 
			$COMP_ID = $this->authadmin->getCompanyId();
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
			
			$this->v_prj_idx = $PRJ_IDX;
			
			$this->formbox->setId('PRJ_IDX');
			$this->formbox->setName('PRJ_IDX');
			$this->formbox->setOption('onchange="javascript:goProcess();"');
			return $this->formbox->getSelectBox($res->result(),'�����ϼ���',$PRJ_IDX);
		}
		
		private function setSortList()
		{
			// TABLE �÷����� �ְ� SORT�ռ�.
			$this->load->library('FormBox'); 
			
			$obj = array();
			$obj[0][1] = '��������';
			$obj[0][0] = 'APPL_DT';
			
			$obj[1][1] = '�����ȣ';
			$obj[1][0] = 'GRPA.APPLY_NO';
			
			$obj[2][1] = '�̸�';
			$obj[2][0] = 'NAMEKOR';
			
			$this->formbox->setId('SORT_TP');
			$this->formbox->setName('SORT_TP');
			$this->formbox->setOption('');
			return $this->formbox->getSelectBox($obj,'�����ϼ���','',$objType = 'array');
		}
		
		private function setDisplayTypeList($arg)
		{
			// TABLE �÷����� ��~��~ ��~��
			$obj = array();
			$obj[0][1] = '�����ȣ';
			$obj[0][0] = 'GRPA.APPLY_NO';
			
			$obj[1][1] = '�̸�';
			$obj[1][0] = 'NAMEKOR';
			
			$obj[2][1] = '�о�';
			$obj[2][0] = 'UNIT_NM';
			
			$obj[3][1] = '����';
			$obj[3][0] = 'SEX_NM';
			$this->formbox->setId('DISPLAY_TP' . $arg);
			$this->formbox->setName('DISPLAY_TP' . $arg);
			$this->formbox->setOption('');
			return $this->formbox->getSelectBox($obj,'�����ϼ���','',$objType = 'array');
			
		}
		
		// ��ΰ���
		function listManagement()
		{
			$data = null;
			// - ������Ʈ����Ʈ��
			///admin/reportService/listManagement

			$data['SELECTBOX_SORT_TP'] = $this->setSortList();
			
			$data['SELECTBOX_DISPLAY_TP1'] = $this->setDisplayTypeList(1);
			$data['SELECTBOX_DISPLAY_TP2'] = $this->setDisplayTypeList(2);
			$data['SELECTBOX_DISPLAY_TP3'] = $this->setDisplayTypeList(3);
			
			$data['SELECTBOX_PRJ_IDX'] = $this->setProjectList();
			$this->loadView('admin/report/list_manage_form' , $data);
		}
		
		// ��������
		function nameTagManagement()
		{
			$data = null;
			// - ������Ʈ����Ʈ��
			///admin/reportService/listManagement

			$data['SELECTBOX_SORT_TP'] = $this->setSortList();
			
			$data['SELECTBOX_DISPLAY_TP1'] = $this->setDisplayTypeList(1);
			$data['SELECTBOX_DISPLAY_TP2'] = $this->setDisplayTypeList(2);
			$data['SELECTBOX_DISPLAY_TP3'] = $this->setDisplayTypeList(3);
			
			$data['SELECTBOX_PRJ_IDX'] = $this->setProjectList();
			$this->loadView('admin/report/tag_manage_form' , $data);
		}
		
		// �¼���ġ��
		function seatManagement()
		{
			$data = null;
			// - ������Ʈ����Ʈ��
			///admin/reportService/listManagement

			$data['SELECTBOX_SORT_TP'] = $this->setSortList();
			
			$data['SELECTBOX_DISPLAY_TP1'] = $this->setDisplayTypeList(1);
			$data['SELECTBOX_DISPLAY_TP2'] = $this->setDisplayTypeList(2);
			$data['SELECTBOX_DISPLAY_TP3'] = $this->setDisplayTypeList(3);
			
			$data['SELECTBOX_PRJ_IDX'] = $this->setProjectList();
			$this->loadView('admin/report/seat_manage_form' , $data);
		}
		
		
		// ��ε� ���� ������μ���
		function reportProcess()
		{
			$this->load->library('excel');
			$MANAGER_ID 	= $this->authadmin->getUserId();
			$PRJ_IDX 			= $this->input->post('PRJ_IDX');
			$COL_SIZE 		= $this->input->post('COL_SIZE');
			$ROW_SIZE 		= $this->input->post('ROW_SIZE');
			$SORT_TP 			= $this->input->post('SORT_TP');
			$PHOTO_YN 		= $this->input->post('PHOTO_YN');
			$COLUMN_1		 	= $this->input->post('DISPLAY_TP1');
			$COLUMN_2 		= $this->input->post('DISPLAY_TP2');
			$COLUMN_3 		= $this->input->post('DISPLAY_TP3');
			$REVERSE_YN	  = $this->input->post('REVERSE_YN');
			$file_type = $_FILES['EXCEL_FILE']['type'];
			
			$this->excel->setLoadFile($_FILES['EXCEL_FILE']);
			$excel_data = $this->excel->getExcel2Array($_FILES['EXCEL_FILE']);
			
			if ($excel_data == false)
			{
				jsalertmsg('���������� �ƴմϴ�. �ٽ� Ȯ���ϼ���.');
				jshistoryback();
				exit;
			}
			
			$gubun_title_ar = array();
			$applyno_ar = array();
			
			foreach ($excel_data as $key => $data)
			{
					if ($key > 1) // �������� �н�
					{
						$x = 0;
						
						foreach ($data as $key => $etcdata)
						{
							// 4��° ĭ���� ��Ÿ ������ ��ġ�� �κ� 
							if ($x == 0) $gubun_title_ar[] = iconv('UTF-8','EUC-KR',$etcdata);
							if ($x == 1) $applyno_ar[] = iconv('UTF-8','EUC-KR',$etcdata);
							$x++;
						
						}	
							
					}
					
			}
			
			///$gubun_title_ar[0] . '---' . $applyno_ar[0];
			
			//var_dump($gubun_title_ar);
			
			//var_dump($applyno_ar);
			$this->load->model('admin/report/reportservice_model','rpt',true);
			
			$this->rpt->reportDataDelete(array($PRJ_IDX));
			$this->rpt->reportDelete(array($PRJ_IDX));
			$insertIdx = $this->rpt->reportRegist(array($PRJ_IDX,$MANAGER_ID,$COL_SIZE,$ROW_SIZE,$REVERSE_YN,$PHOTO_YN,$COLUMN_1,$COLUMN_2,$COLUMN_3,'N',$SORT_TP));	
			
			//echo $insertIdx;
			foreach ($gubun_title_ar as $key => $title) $this->rpt->reportData(array($insertIdx,$title,$applyno_ar[$key]));
			
			jsalertmsg('��ϵǾ����ϴ�.\n��ε����͸� Ȯ���Ͻø� ��ϵ� �����͸� Ȯ���Ͻ� �� �ֽ��ϴ�.');
			jshistoryback();
		
		}
		
		function reportList()
		{
			$data = null;
			$PRJ_IDX = $this->input->post('P_PRJ_IDX');
			$MENU_FLAG =$this->input->post('MENU_FLAG');
			
			$data['PRJ_IDX'] = $PRJ_IDX;
			$data['MENU_FLAG'] = $MENU_FLAG;
			$this->load->model('admin/report/reportservice_model','rpt',true);
			
			$resCs = $this->rpt->getReportConstraint(array($PRJ_IDX));
			
			if ($resCs->num_rows() == 1)
			{
				$data['ConstData'] = $resCs->result();
				//var_dump($data['ConstData']);
			}
			else
			{
				jsalertmsg('�����Ͱ� �����ϴ�. [ERR010-1]');
				winclose('on');
				exit;
			}
			
			$ROW_SIZE = $data['ConstData'][0]->ROW_SIZE;
			$GUBUN_TITLE = null;
			$COLUMN_LIST1 = $data['ConstData'][0]->COLUMN_LIST1;
			$COLUMN_LIST2 = $data['ConstData'][0]->COLUMN_LIST2;
			$COLUMN_LIST3 = $data['ConstData'][0]->COLUMN_LIST3;
		
			$REVERSE_YN = $data['ConstData'][0]->REVERSE_YN;
			$SORT_TP = $data['ConstData'][0]->SORT_TP;
			
			$resData = $this->rpt->commonReportList($PRJ_IDX,$ROW_SIZE,$GUBUN_TITLE,$COLUMN_LIST1,$COLUMN_LIST2,$COLUMN_LIST3,$SORT_TP,$REVERSE_YN);
			
			if ($resData->num_rows() > 1)
			{
				$data['rdata'] = $resData->result();
			}
			else if ($resData->num_rows() == 0)
			{
				jsalertmsg('��ϵ� �����Ͱ� �����ϴ�.');
				winclose('on');
				exit;
			}
			else
			{
				jsalertmsg('�����Ϳ� �̻��� ���� ��� ���� �մϴ�. �����ڿ��� �������ּ���. [ERR010]');
				winclose('on');
				exit;
			}
			
			$this->popView('admin/report/commonReportList_view' , $data);
		}
		
		
		
		
		function myoungbuPrint()
		{
			$this->load->model('admin/report/reportservice_model','rpt',true);
			$PRJ_IDX = $this->input->post('PRJ_IDX');
			$GUBUN_TITLE = $this->input->post('GUBUN_TITLE');
			$COL_SIZE = $this->input->post('COL_SIZE');
			$COMP_NM = $this->authadmin->getCompanyNm();
			$data = null;
			
			$data['PRJ_IDX'] = $PRJ_IDX;
			$data['GUBUN_TITLE'] = base64_decode($GUBUN_TITLE);
			$data['COMP_NM'] = $COMP_NM;
			
			$resCs = $this->rpt->getReportConstraint(array($PRJ_IDX));
			
			if ($resCs->num_rows() == 1)
			{
				$data['ConstData'] = $resCs->result();
			}
			else
			{
				jsalertmsg('�����Ͱ� �����ϴ�. [ERR010-1]');
				winclose('on');
				exit;
			}
			
			$ROW_SIZE = $data['ConstData'][0]->ROW_SIZE;
			$GUBUN_TITLE = base64_decode($GUBUN_TITLE);
			$COLUMN_LIST1 = $data['ConstData'][0]->COLUMN_LIST1;
			$COLUMN_LIST2 = $data['ConstData'][0]->COLUMN_LIST2;
			$COLUMN_LIST3 = $data['ConstData'][0]->COLUMN_LIST3;
			$REVERSE_YN = $data['ConstData'][0]->REVERSE_YN;
			$SORT_TP = $data['ConstData'][0]->SORT_TP;
			
			$resData = $this->rpt->commonReportList($PRJ_IDX,$ROW_SIZE,$GUBUN_TITLE,$COLUMN_LIST1,$COLUMN_LIST2,$COLUMN_LIST3,$SORT_TP,$REVERSE_YN);
			//$resData = $this->rpt->myoungbuList(array($COL_SIZE,$COL_SIZE,$COL_SIZE,$PRJ_IDX,$PRJ_IDX,base64_decode($GUBUN_TITLE)));
			if ($resData->num_rows() > 0)
			{
				$data['rlist'] = $resData->result();
				$data['COL_SIZE'] = $COL_SIZE;
				$this->load->view('admin/report/MyoungBuPrintView_view' , $data);
			}
			else
			{
				jsalertmsg('�����Ͱ� �����ϴ�. �ٽ� Ȯ���ϼ���.');
				winclose('on');
				exit;
			}
			
		}
		
		
		function seatPrint()
		{
			$this->load->model('admin/report/reportservice_model','rpt',true);
			$PRJ_IDX = $this->input->post('PRJ_IDX');
			$GUBUN_TITLE = $this->input->post('GUBUN_TITLE');
			$COL_SIZE = $this->input->post('COL_SIZE');
			$COMP_NM = $this->authadmin->getCompanyNm();
			$data = null;
			
			$data['PRJ_IDX'] = $PRJ_IDX;
			$data['GUBUN_TITLE'] = base64_decode($GUBUN_TITLE);
			$data['COMP_NM'] = $COMP_NM;
			
			$resCs = $this->rpt->getReportConstraint(array($PRJ_IDX));
			
			if ($resCs->num_rows() == 1)
			{
				$data['ConstData'] = $resCs->result();
			}
			else
			{
				jsalertmsg('�����Ͱ� �����ϴ�. [ERR010-1]');
				winclose('on');
				exit;
			}
			
			$ROW_SIZE = $data['ConstData'][0]->ROW_SIZE;
			$GUBUN_TITLE = base64_decode($GUBUN_TITLE);
			$COLUMN_LIST1 = 'NAMEKOR';
			$COLUMN_LIST2 = 'GRPA.APPLY_NO';
			$COLUMN_LIST3 = $data['ConstData'][0]->COLUMN_LIST3;
			$REVERSE_YN = $data['ConstData'][0]->REVERSE_YN;
			$SORT_TP = $data['ConstData'][0]->SORT_TP;
			
			$resData = $this->rpt->commonReportList($PRJ_IDX,$ROW_SIZE,$GUBUN_TITLE,$COLUMN_LIST1,$COLUMN_LIST2,$COLUMN_LIST3,$SORT_TP,$REVERSE_YN);
			
			if ($resData->num_rows() > 0)
			{
				$data['rlist'] = $resData->result();
				$data['COL_SIZE'] = $COL_SIZE;
				$this->load->view('admin/report/SeatPrintList_view' , $data);
			}
			else
			{
				jsalertmsg('�����Ͱ� �����ϴ�. �ٽ� Ȯ���ϼ���.');
				winclose('on');
				exit;
			}
			
		}
		
		
		
		
		function namePrint()
		{
			$this->load->model('admin/report/reportservice_model','rpt',true);
			$PRJ_IDX = $this->input->post('PRJ_IDX');
			$GUBUN_TITLE = $this->input->post('GUBUN_TITLE');
			$COL_SIZE = $this->input->post('COL_SIZE');
			$COMP_NM = $this->authadmin->getCompanyNm();
			$DOMAIN_ID = $this->authadmin->getDomainId();
			$data = null;
			
			$data['PRJ_IDX'] = $PRJ_IDX;
			$data['GUBUN_TITLE'] = base64_decode($GUBUN_TITLE);
			$data['COMP_NM'] = $COMP_NM;
			$data['DOMAIN_ID'] = $DOMAIN_ID;
			$resCs = $this->rpt->getReportConstraint(array($PRJ_IDX));
			
			if ($resCs->num_rows() == 1)
			{
				$data['ConstData'] = $resCs->result();
			}
			else
			{
				jsalertmsg('�����Ͱ� �����ϴ�. [ERR010-1]');
				winclose('on');
				exit;
			}
			
			$ROW_SIZE = $data['ConstData'][0]->ROW_SIZE;
			$GUBUN_TITLE = base64_decode($GUBUN_TITLE);
			$COLUMN_LIST1 = 'NAMEKOR';
			$COLUMN_LIST2 = 'GRPA.APPLY_NO';
			$COLUMN_LIST3 = $data['ConstData'][0]->COLUMN_LIST3;
			$REVERSE_YN = $data['ConstData'][0]->REVERSE_YN;
			$SORT_TP = $data['ConstData'][0]->SORT_TP;
			
			$resData = $this->rpt->commonReportList($PRJ_IDX,$ROW_SIZE,$GUBUN_TITLE,$COLUMN_LIST1,$COLUMN_LIST2,$COLUMN_LIST3,$SORT_TP,$REVERSE_YN);
			
			if ($resData->num_rows() > 0)
			{
				$data['rlist'] = $resData->result();
				$data['COL_SIZE'] = $COL_SIZE;
				$this->load->view('admin/report/tagPrintView_view' , $data);
			}
			else
			{
				jsalertmsg('�����Ͱ� �����ϴ�. �ٽ� Ȯ���ϼ���.');
				winclose('on');
				exit;
			}
			
		}
		
		
		
		
		
	}