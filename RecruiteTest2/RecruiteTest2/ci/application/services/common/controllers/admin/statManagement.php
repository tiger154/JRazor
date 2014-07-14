<?
	class StatManagement extends MY_Controller
	{
		private $v_prj_idx;
		
		function Index()
		{
			redirect('/admin/statManagement/statUnitList');
		}
		
		private function getMenuList()
		{
			
		}
		
		private function getTopStatList()
		{
			$data = null;
			$data['SELECTBOX_PRJ_IDX'] = $this->getProjectList();
			$PRJ_IDX = $this->input->post('PRJ_IDX');
			$STEP_IDX = $this->input->post('STEP_IDX');
			$PRJ_IDX = $PRJ_IDX == '' ? $this->v_prj_idx : $PRJ_IDX;
			$data['PRJ_IDX'] = $PRJ_IDX;
			$data['STEP_IDX'] = $STEP_IDX;
			$PRJ_IDX = $PRJ_IDX == '' ? $this->v_prj_idx : $PRJ_IDX;
			$this->load->model('admin/stat/statmanagement_model','stat',true);
			$res = $this->stat->getStatStepList(array($PRJ_IDX,$PRJ_IDX,$PRJ_IDX,$PRJ_IDX));
			return $res->result();
		}
		
		private function getProjectList()
		{
			$PRJ_IDX = $this->input->post('PRJ_IDX');
			$this->load->library('FormBox'); 
			$COMP_ID = $this->authadmin->getCompanyId();
			$this->load->model('admin/project/projectManager_model','prjlist',true);
			$res = $this->prjlist->getSimpleProjectList(array($COMP_ID,'N'));
			$rdata = null;
			$rdata = $res->result();
			
			if ($res->num_rows() == 0)
			{
				jsalertmsg('채용공고가 없습니다.');
				jshistoryback();
				exit;
			}
			
			if (!$PRJ_IDX && $rdata[0]->CODE != '' ) $PRJ_IDX = $rdata[0]->CODE;
			
			$this->v_prj_idx = $PRJ_IDX;
			
			$this->formbox->setId('PRJ_IDX');
			$this->formbox->setName('PRJ_IDX');
			$this->formbox->setOption('onchange="javascript:goProcess();"');
			return $this->formbox->getSelectBox($res->result(),'선택하세요',$PRJ_IDX);
			
		}
		
		function statUnitList()
		{
			$data = null;
			$data['SELECTBOX_PRJ_IDX'] = $this->getProjectList();
			$PRJ_IDX = $this->input->post('PRJ_IDX');
			$STEP_IDX = $this->input->post('STEP_IDX');
			$PRJ_IDX = $PRJ_IDX == '' ? $this->v_prj_idx : $PRJ_IDX;
			$data['PRJ_IDX'] = $PRJ_IDX;
			$data['STEP_IDX'] = $STEP_IDX;
			$COMP_ID = $this->authadmin->getCompanyId();
			$this->load->model('admin/step/stepManagement_model','unit',true);
			$this->load->model('admin/stat/statmanagement_model','stat',true);
			$unitRs = $this->unit->getUnitLeafNodeList(array($PRJ_IDX,'N',$PRJ_IDX,'N'));
			$unitArrayList = array();
			$unitArrayNmList = array();
			$unitArrayNmList[] = '날짜';
			foreach ($unitRs->result() as $key => $unitList)
			{
				$unitArrayList[] = $unitList->UNIT_IDX;
				$unitArrayNmList[] = $unitList->UNIT_NM;
			}
			
			$res = $this->stat->getStatUnitList($unitArrayList,$PRJ_IDX);
			
			$data['stepData'] = $this->getTopStatList();
			$data['TABLE_RESULT'] = $this->setTableList($res->result(),$unitArrayNmList);
			$this->loadView('admin/stat/statlist_view' , $data);
		}
		
		function statSexList()
		{
			$data = null;
			$data['SELECTBOX_PRJ_IDX'] = $this->getProjectList();
			$PRJ_IDX = $this->input->post('PRJ_IDX');
			$STEP_IDX = $this->input->post('STEP_IDX');
			$PRJ_IDX = $PRJ_IDX == '' ? $this->v_prj_idx : $PRJ_IDX;
			$data['PRJ_IDX'] = $PRJ_IDX;
			$data['STEP_IDX'] = $STEP_IDX;
			
			$this->load->model('admin/stat/statmanagement_model','stat',true);
			$arrayNmList = array('일자','남자','여자');
			$arrayList = array('M','F');
			$res = $this->stat->getStatQueryList($PRJ_IDX,'TBL_APPLY_PERSONAL','SEX_CD','CONVERT(VARCHAR(10),APPL_DT,121)',$arrayList);
			$data['stepData'] = $this->getTopStatList();
			$data['TABLE_RESULT'] = $this->setTableList($res->result(),$arrayNmList);
			$this->loadView('admin/stat/statlist_view' , $data);
		}
		
		private function setTableList($resultSet , $titleArray)
		{
			$tbl = '
				<table id="BdList-Type01" summary="목록">
						<caption>목록</caption>
						<colgroup>';
						foreach($titleArray as $coltitle)
						{
							$tbl .= '<col width="*" />';
						}
						$tbl .= '</colgroup><thead><tr>';
						foreach($titleArray as $title)
						{
							$tbl .= '<th scope="col">' . $title . '</th>';
						}
			$tbl .= '</tr>
						</thead>
						<tbody>';
						
						foreach ($resultSet as $key => $rlist)
						{
							$tbl .= '<tr>';
							foreach($rlist as $subkey => $mdata)
							{
								$tbl .= '<td class="bold">' . $mdata . '</td>';
							}
							$tbl .= '</tr>';
						}
					$tbl .= '
						</tbody>
					</table>';
					return $tbl;
		}
	}