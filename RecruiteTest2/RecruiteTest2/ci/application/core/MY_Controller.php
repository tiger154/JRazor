<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * CodeIgniter
 *
 * An open source application development framework for PHP 5.1.6 or newer
 *
 * @package		CodeIgniter
 * @author		ExpressionEngine Dev Team
 * @copyright	Copyright (c) 2008 - 2011, EllisLab, Inc.
 * @license		http://codeigniter.com/user_guide/license.html
 * @link		http://codeigniter.com
 * @since		Version 1.0
 * @filesource
 */

// ------------------------------------------------------------------------

/**
 * CodeIgniter Application Controller Class
 *
 * This class object is the super class that every library in
 * CodeIgniter will be assigned to.
 *
 * @package		CodeIgniter
 * @subpackage	Libraries
 * @category	Libraries
 * @author		ExpressionEngine Dev Team
 * @link		http://codeigniter.com/user_guide/general/controllers.html
 */
class MY_Controller extends CI_Controller {

		protected $cm_admin_layout = null;
		protected $cm_admin_data = null;
		protected $cm_front_layout = null;
		protected $cm_front_img_path = null;
		protected $cm_admin_by_pass_login = false;
		protected $cm_admin_by_pass_agr = false;
		protected $_current_path = null;
		protected $_adminMenuDisplayMenuAr = array();
	
	
		function __construct()
		{
			$this->_current_path = $_SERVER['PATH_INFO'];
			
			parent::__construct();
			// -- 클래스 명으로 로그인체크를 해보세 ;;;;echo '11111->' . get_called_class();
			
			if ($this->uri->segment(1) == 'admin')
			{
				$this->authadmin->loginCheck();
			}
			
		}
		
		
		protected function loadMenu()
		{
			
			$this->load->library('DataControl'); 
			/* 메뉴작업 */
			$_current_level = $this->authadmin->getUserLevel();	
			
			$_current_menu = null;
			$_current_loc = null;
			$_current_display_menu_cd = null;
			
			$menuListData = null;
			$menuListData .= '<ul id="Tm">';
			
			$xmlStr = file_get_contents($this->datacontrol->getFileLocation('AdminMenu.xml'));
			$xmlObj = simplexml_load_string($xmlStr);
			
			$_tmpx = 1;
			foreach ($xmlObj as $key => $mlist)
			{
				
				$menuListData .= '<li><a id="mm0' . $_tmpx . '" class="" href="' . $mlist['dir'] . '">' . iconv('UTF-8','EUC-KR',$mlist['name'])  . '</a>';						
				$menuListData .= '<ul id="sm0' . $_tmpx . '" class="">';
					
					$_check_pmenu = iconv('UTF-8','EUC-KR',$mlist['name']);
					
					foreach ($mlist as $skey => $slist) 
					{
						$dirNm = null;
						$linktype = null;
						$linkString = null;
						foreach ($slist as $dkey => $dirlist)
						{
							if ($this->_current_path == $dirlist) 
							{
								$_current_menu = $dirlist['name'] != '' ? iconv('UTF-8','EUC-KR',$dirlist['name']) : iconv('UTF-8','EUC-KR',$slist['name']);
								$_current_loc = 'Home &gt; '. $_check_pmenu .' &gt; <strong>'. iconv('UTF-8','EUC-KR',$slist['name']) . '</strong>' ;
								$_current_loc .= $dirlist['name'] != '' ? ' &gt; ' . iconv('UTF-8','EUC-KR',$dirlist['name']) : '';
								$_current_display_menu_cd = $_tmpx; //echo($_current_menu);
								//echo($this->uri->segment(3));
							}
							
							
							if ($dirlist['match'] == 'on') 
							{
								$dirNm = $dirlist;
								if ( $dirlist['pop'] == 'on' )
								{
									$linktype = 'javascript:goLink(\'' . $dirlist . '\',\'pop\',\'' . $dirlist['opt'] . '\');';
								}
								else
								{
									$linktype = $dirNm;
								}
							}
							// 들어온 메뉴와 관리자 권한이 매칭이 되지 않으면 작동
//							echo $_current_path . '----' . $dirlist .'-----'.$_current_level .'----' . $dirlist['level'] . '----' . preg_match('/' . $_current_level . '/',$dirlist['level']) . '<br>';
//							exit;
							if ($this->_current_path == $dirlist && $dirlist['level'] != '' && !preg_match('/' . $_current_level . '/',$dirlist['level']) )
							{
								
								redirect($mlist['dir']);
								exit;
							}
							
							
							if ($slist['display'] == 'on')
							{
								if ($dirlist['level'] == '' )
								{
									$linkString = '<li><a class="" href="'. $linktype . '">' . iconv('UTF-8','EUC-KR',$slist['name']) . '</a></li>';
								}
								
								if ($dirlist['level'] != '' && preg_match('/' . $_current_level.'/',$dirlist['level']))
								{
									$linkString = '<li><a class="" href="'. $linktype . '">' . iconv('UTF-8','EUC-KR',$slist['name']) . '</a></li>';
								}
							}
							
						}
						
						//$menuListData .='<li><a class="" href="'. $linktype . '">' . iconv('UTF-8','EUC-KR',$slist['name']) . '</a></li>';
						$menuListData .= $linkString;
					}	
					$_check_pmenu = null;					
					
				$menuListData .= '</ul>';
				$menuListData .= '</li>';
				$_tmpx++;
			}
			
			$menuListData .= '</ul>';
			
			$this->cm_admin_data['menuListData'] = $menuListData;
			$this->cm_admin_data['current_display_menu_cd'] = $_current_display_menu_cd;
			$this->cm_admin_data['currentMenuNm'] = $_current_menu;
			$this->cm_admin_data['currentLocation'] = $_current_loc;
	
		}
		
		protected function checkByPassLogin()
		{
			$this->cm_admin_by_pass_login = true;
		}
		
		protected function checkByPassAgreement()
		{
			$this->cm_admin_by_pass_agr = true;
		}
		
		//관리자 메인 
		protected function loadView($view_name, $data)
		{
			
			$login_check = $this->authadmin->loginCheck();
			$agr_check = $this->authadmin->agreementCheck();
			
			
			
			if (!$login_check && $this->cm_admin_by_pass_login == false) redirect('/admin/login');
			if (!$agr_check && $this->cm_admin_by_pass_agr == false) redirect('/admin/agreement');
			
			$this->loadMenu();
			
			$this->cm_admin_data['ADMIN_SELECTFORM'] = null;
			$this->cm_admin_data['ADMIN_SELECTBOX'] = null;
			
			if ($this->authadmin->getUserLevel() == 'A') 
			{
				$this->load->library('DataControl'); 
				$this->load->library('FormBox'); 
				
				$this->formbox->setId('admin_company_list_id');
				$this->formbox->setName('admin_company_list_id');
				$this->formbox->setOption('onChange="goCompanyLogin();"');
				
				$this->load->model('admin/admincompanymenu_model','admMenu',true);
				$res = $this->admMenu->getCompanyList(array('N'));
				
				$bypass_url_ar = array('/admin/agreement');
				$bypass_flag = strlen(array_search($this->_current_path,$bypass_url_ar));
				
				
				
				$this->cm_admin_data['ADMIN_SELECTFORM'] = '<form name="AdminLoginCompForm1" id="AdminLoginCompForm1">
																											<input type="hidden" name="admin_login_comp_id" id="admin_login_comp_id">
																											<input type="hidden" name="admin_login_comp_nm" id="admin_login_comp_nm">
																											<input type="hidden" name="backUrl" value="' . $_SERVER['REQUEST_URI']. '">
																										</form>';
				
				$this->cm_admin_data['ADMIN_SELECTBOX'] = '' . $this->formbox->getSelectBox($res->result(), '선택' , $this->authadmin->getCompanyId(), $objType = 'db') . '
																										<a href="/admin/companyManagement/ViewCompanyInfo?company_id=' . $this->authadmin->getCompanyId() . '"><img src="/assets/img/btn/btn_co_detail.gif" alt="기업 상세 정보 보기"/></a>
																										<a target="_blank" href="/front/"><img src="/assets/img/btn/btn_jobs_received.gif" alt="사용자 채용 접수 페이지 바로가기"/></a>
																										';
				if ( $bypass_flag > 0 )
				{
					$this->cm_admin_data['ADMIN_SELECTFORM'] = null;
					$this->cm_admin_data['ADMIN_SELECTBOX'] = null;
				}
			}
			
			$this->cm_admin_data['loginCompanyName'] = $this->authadmin->getCompanyNm();
			$this->cm_admin_data['loginName'] = $this->authadmin->getUserNm();
			$this->loadMenu();
			$this->cm_admin_layout['LAYOUT_TOP'] = $this->load->view('admin/topmenu',$this->cm_admin_data,true);
			$this->cm_admin_layout['LAYOUT_NAVIGATOR'] = $this->load->view('admin/navigator',$this->cm_admin_data,true);
			$this->cm_admin_layout['LAYOUT_BOTTOM'] = $this->load->view('admin/bottom',$this->cm_admin_data,true);
			$this->cm_admin_layout['LAYOUT_MAIN'] = $this->load->view($view_name,$data,true);
			$this->load->view('admin/main',$this->cm_admin_layout);
			
			//echo $res->num_rows();
			
		}
		
		//관리자 팝업
		protected function popView($view_name, $data)
		{
			$login_check = $this->authadmin->loginCheck();
			$agr_check = $this->authadmin->agreementCheck();
			
			if (!$login_check && $this->cm_admin_by_pass_login == false) exit;
			if (!$agr_check && $this->cm_admin_by_pass_agr == false) exit;
			
			$this->loadMenu();
			
			$this->cm_admin_layout['LAYOUT_MAIN'] = $this->load->view($view_name,$data,true);
			$this->cm_admin_layout['currentMenuNm'] = $this->cm_admin_data['currentMenuNm'];
			
			$this->load->view('admin/popmain',$this->cm_admin_layout);
			
		}

		//사용자 메인
		
		protected function adminfrontView($view_name, $data)
		{
			$data['FRONT_IMG_URL'] = '/assets/front/design1';
			$this->cm_front_layout['LAYOUT_MAIN'] = $this->load->view($view_name,$data,true);
			$this->load->view('front/apply/applyResume_view',$this->cm_front_layout);
		}
		
		protected function frontView($view_name, $data)
		{
			
			$this->load->library('DataControl'); 
			
			
			$this->cm_front_layout = null;
			
			//echo $this->datacontrol->getFileLocation('front_setup.xml');
			
			$xmlStr = file_get_contents($this->datacontrol->getFileLocation('front_setup.xml'));
			$xmlObj = simplexml_load_string($xmlStr);
			
			// 템플릿 directory 와 코드 
			$design_type = $xmlObj->{'template'};
			
			$design_main_img_url = $this->datacontrol->getFrontImagePath(HOSTID , 'main');
			$design_sub_img_url = $this->datacontrol->getFrontImagePath(HOSTID , 'sub');
			
			// 타이틀
			$design_title = $xmlObj->{'title'};
			$this->cm_front_layout['frontdesignTitle'] = iconv('UTF-8','EUC-KR',$design_title);
			
			// 메뉴 관련 스트립트 생성 현재 선택메뉴에 대한 이미지 변경 타이틀이 있어서 .... 
			// 그냥xml로 처리해서 파라미터를 넘겨서 처리하는 형태로 ..
			// 함수명은 goMenu(code) 을 넣은형태
			// 이거슨 공통화로 하고 메뉴가 추가될때 xml에서 처리하는 형태 각 디자인템플릿에 메뉴에 스크립트를 심는형태
		
			$xmlStr2 = file_get_contents($this->datacontrol->getFileLocation('FrontMenu.xml'));
			$xmlObj2 = simplexml_load_string($xmlStr2);
			
			//var_dump($xmlObj2);
			
			$menuStr = null;
			$menuStr .= '<script>
									 function goMenu(code,etcvalue)
									 {
									 	 if (etcvalue == undefined) etcvalue = "";
									 	 var menuStr = "";
										 switch (code)
										 {' . "\n";
			
			$menuNavi = '홈 &gt; ';
			$_currMenu = null;
			$menuImgStatus = array();
			$_current_jscode = null;
			$_current_img = null;
			$_current_index_flag = null;
			foreach ($xmlObj2 as $key => $mlist)
			{
				//$mlist['name']
				//$mlist['jscode']
				
										 
				// 해당 메뉴의 dir리스트 
				
				///$menuNavi .= $menuNavi;
				
				foreach ($mlist as $dkey => $dirlist)
				{
					// default on 인것만 메뉴랑 연결한다.
					
						// script case 추가
						$c_dir = $dirlist['jscode'] != null ? $dirlist['jscode'] : $mlist['jscode'];
						$menuStr .= 'case "' . $c_dir . '" : ' . "\n";
						
						//만약에 ssl 이면 ssl 서버로 이동(login 도메인으로
						
						//if ($dirlist['ssl'] == 'on' )
						//{
						//	$menuStr .= 'menuStr = "https://' . SSL_SUB_DOMAIN . '.' . MAIN_SERVICE_DOAMIN . $dirlist . '";' . "\n";
						//}
						//else
						//{
						//$menuStr .= 'menuStr = "' . $dirlist . '";' . "\n";
						//}
						
						$menuStr .= 'menuStr = "' . $dirlist . '";' . "\n";
						
						$menuStr .= ' break;' . "\n";
				
					
					$menuImgStatus['' . $mlist['jscode'] . ''] = 'off';
					
					// 현재 메뉴와 XML을 매칭하여 매칭하면 네비게이션과 이미지와 버튼 활성처리를위한 변수 스트링 작성
					
					if ($this->_current_path == $dirlist) 
					{
						
						$_current_img = $mlist['jscode'] == 'index' ? $design_main_img_url : $design_sub_img_url; 
						$_current_index_flag = $mlist['jscode'] == 'index' ? 'on' : 'off'; 
						$_currMenu['MENUBARIMG'] = $mlist['menuBarImg'];
						$_currMenu['MENUNAVI'] = $menuNavi . ' <span>' . iconv('UTF-8','EUC-KR',$mlist['name']) . '</span>';
						//echo $mlist['jscode'] . '<br>';
						
						$_current_jscode = $mlist['jscode'];
						
						//$menuImgStatus['' . $mlist['jscode'] . ''];
					
					}
					
					//echo $dirlist . '-----' . $menuImgStatus['' . $mlist['jscode'] . ''] . '-----' . $mlist['jscode'] . '<br>';
					
				}
				
			}
			
			$menuImgStatus['' . $_current_jscode . ''] = 'on';
			$menuStr .= '} ';
			$menuStr .= 'location.href=menuStr + etcvalue;' . "\n";
			$menuStr .= '}' . "\n";
			
			$menuStr .= '</script>' . "\n";
				
			//echo $design_type;
			//echo '<br>';
			//echo $design_type['view_path'];
			$this->cm_front_layout['MAIN_LOGO'] = $this->datacontrol->getLogoPath(HOSTID,1);
			$this->cm_front_layout['MENU_SCRIPT'] = $menuStr;
			$this->cm_front_layout['MENU_NAVIGATION'] = $_currMenu['MENUNAVI'];
			$this->cm_front_layout['MENU_BARIMG'] = $_currMenu['MENUBARIMG'];
			$this->cm_front_layout['MENU_STATUS'] = $menuImgStatus;
			
			$data['FRONT_IMG_URL'] = '/assets/front/' . $design_type;
			
			$this->cm_front_layout['FRONT_TOP_IMG_URL'] = $_current_img;
			$this->cm_front_layout['FRONT_INDEX_FLAG'] = $_current_index_flag;
			
			$this->cm_front_layout['LAYOUT_MAIN'] = $this->load->view($view_name,$data,true);
			
			$template_view_path = 'front/template/' . $design_type . '/main';
			
			$this->load->view($template_view_path,$this->cm_front_layout);
		}
		
		protected function frontPopView($view_name, $data)
		{
				$data['POPUP_IMG_URL'] = '/assets/front/popup';
				// 템플릿 directory 와 코드 
				
				$popupTitle = $this->input->get('popupTitle');
				$popupTitle = !$popupTitle ? $this->input->post('popupTitle') : $popupTitle;
				$popupTitle = !$popupTitle ? '검색' : $popupTitle . ' 검색';
				
				$this->cm_front_layout['POPUP_TITLE'] = $popupTitle;
				
				$this->cm_front_layout['LAYOUT_MAIN'] = $this->load->view($view_name,$data,true);
				
				$this->load->view('front/popup_main' ,$this->cm_front_layout);
		}

}
