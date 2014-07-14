<?
	class Popup extends MY_Controller
	{
		
		// ù������ �˾�
		function Index()
		{	
			$code = $this->input->get('code');
			
			$this->load->library('DataControl'); 
			
			$xmlStr = file_get_contents($this->datacontrol->getFileLocation('popup.xml'));
			$xmlObj = simplexml_load_string($xmlStr);
			
			//var_dump($xmlObj);
			$now_date = date('YmdHis');
			//echo $now_date;
			$data = null;
			
			$data['code'] = $code;
			$data['POPUP_TITLE'] = null;
			$data['CNTNT'] = null;
			foreach ($xmlObj as $key => $pList)
			{
				if ($now_date >= $pList->stdt && $now_date <= $pList->eddt && $code == $pList->code)
				{
					$data['POPUP_TITLE'] = iconv('UTF-8','EUC-KR',$pList->title);
					$data['CNTNT'] = String2Html(iconv('UTF-8','EUC-KR',$pList->content));
					break;
				}
			}
			
			$this->load->view('front/popup/window_popup_view' , $data);
		}
		// ���� ��� �˻�â �ϳ��� ���ô�.
		
		function SearchList()
		{
			$data = null;

			// popup �ڵ� 
			// �θ����������� �Ѿ���� ������
			$popupCode = $this->input->post('popupCode'); //�˻�����
			$popupIndex = $this->input->post('popupIndex');  // �˻���ư �ε��� (���Ϻ��� ���鶧��)
			$popupAccCode = $this->input->post('popupAccCode'); // �˻���� ������ ����
			$popupEtcUseYn = $this->input->post('popupEtcUseYn'); // ��Ÿ �Է��� ������� ������ 
			$popupDisplayType = $this->input->post('popupDisplayType'); // �˻� ��� ( �˻����ϰ� �ٷ� ���������� �˻��ϰ� ������ ���� ) - L ����Ʈ���� ������ �˻��� �� , S ó������� �ȳ����� �˻��� ����
			$searchstep = $this->input->post('searchstep');
			$popupSchCode = $this->input->post('popupSchCode'); //�б����ý� ����ϴ� �ڵ� �ڵ忡���� SCH �ڵ带 �־��ش�.
			
			$searchstep = !$searchstep ? 'form' : $searchstep;
			$popupTitle = null;
			$popupTitle = !$popupTitle ? $this->input->post('popupTitle') : $popupTitle;
			$popupTitle = !$popupTitle ? '' : $popupTitle;
			
			$searchword = $this->input->post('searchword'); // �˻���
			$searchstep = $this->input->post('searchstep'); // ������ ���� ����
			
			
			$this->load->model('front/popup/popup_model','pop',true);
			$res = null;
			$data['SEARCH_TITLE_LIST_AR'] = array();
			$data['SEARCH_LIST_DATA'] = array();
			
			
			switch ($popupCode)
			{
				case 'license' : // �ڰ��� - DB
					
					$data['SEARCH_TITLE_LIST_AR'] = array($searchstep == 'etc' ? '�ڰ��� ����' : '�ڰ�����');
					$data['SEARCH_TITLE_COLUMN_AR'] = array('NAME');
					
					if ($searchstep == 'etc')
					{
						$res = $this->pop->getLicenseList(array('LIC','ETC','N','N','Y'),'etc');
						$data['SEARCH_LIST_DATA'] = $res->result();	
					}
					else
					{
						if ($popupDisplayType == 'L' || ( $popupDisplayType == 'S' && $searchstep == 'result' ) )
						{
							$contents = $searchword != '' ? '%' . $searchword . '%' : '';
							$res = $this->pop->getLicenseList(array('LIC',$contents,'N','N','Y'),'search');
							$data['SEARCH_LIST_DATA'] = $res->result();	
						}
					}
					break;
					
				case 'school' :
					
					$sct_idx1 = 0;
				
					switch ($popupSchCode)
					{
						case '25' :
							$sct_idx1 = $searchstep == 'etc' && $popupEtcUseYn == 'Y' ? 49 : 7;
							break;
							
						case '26' :
							$sct_idx1 = $searchstep == 'etc' && $popupEtcUseYn == 'Y' ? 50 : 8;
							break;
							
						case '27' :
						case '28' :
						case '29' :
							$sct_idx1 = $searchstep == 'etc' && $popupEtcUseYn == 'Y' ? 51 : 9;
							break;
					}
					
					//echo $sct_idx1 . '---' . $sct_idx2 . '----' . $popupSchCode . '<br>';
					
				
					$data['SEARCH_TITLE_LIST_AR'] = array($searchstep == 'etc' ? '�б� ����' : '�б���');
					$data['SEARCH_TITLE_COLUMN_AR'] = array('NAME');
					
					if ($searchstep == 'etc')
					{
						$res = $this->pop->getSchoolList(array('SCH',$sct_idx1,'ETC','N','N','Y'),'etc');
						$data['SEARCH_LIST_DATA'] = $res->result();	
					}
					else
					{
						if ($popupDisplayType == 'L' || ( $popupDisplayType == 'S' && $searchstep == 'result' ) )
						{
							$contents = $searchword != '' ? '%' . $searchword . '%' : '';
							$res = $this->pop->getSchoolList(array('SCH',$sct_idx1,$contents,'N','N','Y'),'search');
							$data['SEARCH_LIST_DATA'] = $res->result();	
						}
					}
					break;
				
				case 'major' :
					
					$data['SEARCH_TITLE_LIST_AR'] = array($searchstep == 'etc' ? '���� ����' : '������');
					$data['SEARCH_TITLE_COLUMN_AR'] = array('NAME');
					
					if ($searchstep == 'etc')
					{
						$res = $this->pop->getMajorList(array('MJR','ETC','N','N','Y'),'etc');
						$data['SEARCH_LIST_DATA'] = $res->result();	
					}
					else
					{
						if ($popupDisplayType == 'L' || ( $popupDisplayType == 'S' && $searchstep == 'result' ) )
						{
							$contents = $searchword != '' ? '%' . $searchword . '%' : '';
							
							$res = $this->pop->getMajorList(array('MJR',$contents,'N','N','Y'),'search');
							$data['SEARCH_LIST_DATA'] = $res->result();	
						}
					}
					break;	
			
			}
			
			$data['etcCodeVarNM'] = $popupAccCode . '_NM_' . $popupIndex;
			$data['etcCodeVarCD'] = $popupAccCode . '_CD_' . $popupIndex;

			$data['popupSchCode'] = $popupSchCode;
			$data['searchword'] = $searchword;
			$data['popupCode'] = $popupCode;
			$data['popupTitle'] = $popupTitle;
			$data['popupIndex'] = $popupIndex;
			$data['popupAccCode'] = $popupAccCode;
			$data['popupEtcUseYn'] = $popupEtcUseYn;
			$data['popupDisplayType'] = $popupDisplayType;
			$data['searchstep'] = $searchstep;
			
			$this->frontPopView('front/popup/search_form' , $data);
		}
		
		
		// ���θ� �ּ� �۾��Ұ� 
		function AddressList()
		{
			$popupTitle = '�ּ�';
			$searchword = $this->input->post('searchword'); // �˻���
			$this->load->model('front/popup/popup_model','pop',true);
			
			$searchword = $this->input->post('searchword'); // �˻���
			$searchstep = $this->input->post('searchstep'); // ������ ���� ����
			
			$contents = $searchword != '' ? $searchword . '%' : '';
			$data['searchstep'] = $searchstep;
			$data['searchword'] = $searchword;
			$data['SEARCH_TITLE_LIST_AR'] = array('�����ȣ','�ּ�');
			$data['SEARCH_TITLE_COLUMN_AR'] = array('ZIPCODE','FULL_ADDRESS');
			$data['popupTitle'] = $popupTitle;
			$data['SEARCH_LIST_DATA'] = array();
			if ($searchstep == 'result')
			{
				$res = $this->pop->getAddressList(array($contents,$contents,$contents));
				$data['SEARCH_LIST_DATA'] = $res->result();	
			}
			
			$this->frontPopView('front/popup/address_form' , $data);
			
		}
		
		// ���� �� 
		function JobTypeList()
		{
			$this->load->model('front/popup/popup_model','pop',true);
			$popupTitle = '����';
			$JOB_IDX = $this->input->post('JOB_IDX');
			$popupIndex = $this->input->post('popupIndex'); 
			$popupAccCode = $this->input->post('popupAccCode');
			
			$data = null;
			$data['popupIndex'] = $popupIndex;
			$data['popupAccCode'] = $popupAccCode;
			$data['etcCodeVarCD'] = $popupAccCode . '_CD_' . $popupIndex;
			$data['etcCodeVarNM'] = $popupAccCode . '_NM_' . $popupIndex;
			
			$data['popupTitle'] = $popupTitle;
			$data['JOB_IDX'] = $JOB_IDX;
			
			$res = $this->pop->getJobTypeMainList(array('N'));
			$data['jobTypeMainList'] = $res->result();
			
			$res = $this->pop->getJobTypeSubList(array($JOB_IDX,'N'));
			$data['jobTypeSubList'] = $res->result();
			
			$this->frontPopView('front/popup/jobtype_form' , $data);
		}
		
		
		// ���� ���ε� --
		function PhotoUpload()
		{
				$data = null;		
				$PRJ_IDX = $this->input->post('POPUP_PRJ_IDX');
				$APPL_IDX = $this->input->post('POPUP_APPL_IDX');
	
				$data['PRJ_IDX'] = $PRJ_IDX;
				$data['APPL_IDX'] = $APPL_IDX;
				$this->frontPopView('front/popup/photoupload_form' , $data);
		}
		
		function PhotoUploadProcess()
		{
			
			$this->load->library('upload');
			/*
			define('APPLY_PHOTO_DIRECTORY','/wwwRoot/front/photo/');
  		define('APPLY_PHOTO_URL','/photo';
			*/
			$APPL_IDX = $this->input->post('APPL_IDX');
			$PRJ_IDX = $this->input->post('PRJ_IDX');
			if (!file_exists(APPLY_PHOTO_DIRECTORY . $PRJ_IDX)) mkdir(APPLY_PHOTO_DIRECTORY . $PRJ_IDX);
			$config['upload_path'] = APPLY_PHOTO_DIRECTORY . $PRJ_IDX;
			$config['allowed_types'] = 'gif|jpg';
			$config['overwrite'] = TRUE;
			$config['max_size'] = '2048';
			//$config['date_name'] = TRUE;
			$this->upload->initialize($config);
			$this->upload->setChangeFileName($APPL_IDX . '.jpg');
			$this->upload->setChangeFileExt('.jpg');
			if (!$this->upload->do_upload('PHOTO'))
			{
				jsalertmsg('�̹����� ���ε� ���� �ʾҽ��ϴ�.\n�ٽ� �õ����ּ���.');
				jshistoryback();
				exit;
			}
			else
			{
				$data = null;
				$data['PHOTO_URL'] = APPLY_PHOTO_URL . '/' . $PRJ_IDX . '/' . $APPL_IDX . '.jpg';
				$this->frontPopView('front/popup/photoupload_success_form' , $data);
			}
			
	}
	
	function PhotoUploadDeleteProcess()
	{
		$PRJ_IDX = $this->input->post('POPUP_PRJ_IDX');
		$APPL_IDX = $this->input->post('POPUP_APPL_IDX');
		//echo APPLY_PHOTO_DIRECTORY . $PRJ_IDX . '/' . $APPL_IDX . '.jpg';
		if ($PRJ_IDX > 0 && $APPL_IDX > 0 )
		{
			if (file_exists(APPLY_PHOTO_DIRECTORY . $PRJ_IDX . '/' . $APPL_IDX . '.jpg')) 
			{
				unlink(APPLY_PHOTO_DIRECTORY . $PRJ_IDX . '/' . $APPL_IDX . '.jpg');
			}
		}
		
	}
}