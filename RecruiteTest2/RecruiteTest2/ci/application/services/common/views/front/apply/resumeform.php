<script language="javascript" src="/assets/js/jquery-ui.js"></script>
<link rel="stylesheet" type="text/css" href="/assets/css/jqueryui.css" />
<script language="javascript" src="/assets/js/jquery.validate.js"></script>
<script>
	
	/* 추가버트는 있는것들 한방에 작업하기 */
	
	//1. 변수 선언
	
	// 공통사항 
	var commonMainNameAr = new Array('가족사항','해외연수및 해외경험','교육사항','보유기술 사항','주요활동및 사회경험','자격증','어학능력','수상내역','저술내역','경력사항','학력사항');
	var commonMainCodeAr = new Array('fmly','trng','educ','tech','srve','lics','lan2','prze','wrte','carr','schl');
	
	for (vini = 0 ; vini < commonMainCodeAr.length ; vini ++ ) eval('var ' + commonMainCodeAr[vini] + 'MaxCount = 0;');
	for (vini = 0 ; vini < commonMainCodeAr.length ; vini ++ ) eval('var ' + commonMainCodeAr[vini] + 'List = 0;');
	for (vini = 0 ; vini < commonMainCodeAr.length ; vini ++ ) eval('var ' + commonMainCodeAr[vini] + 'formListAr = null;');
	
	// 가족사항 : fmly
	
	<? if ($rsmdisplay[0]->FAMILY_USE_YN == 'Y') { ?>
	//fmlyRs
	fmlyMaxCount = <?=$rsmdisplay[0]->FAMILY_FORM_CNT;?>;
	fmlyList = <?=count($fmlyRs) > 0 ? count($fmlyRs) + 1 : 1;?>;
	fmlyformListAr = {'FMLY_SEQ':'코드',
												'FMLY_REL_CD':'가족관계',
												'FMLY_REL_NM':'가족관계',
												'FMLY_NM':'이름',
												'FMLY_NAI':'나이',
												'FMLY_SCH_NM':'학력',
												'FMLY_SCH_CD':'학력',
												'FMLY_JOB':'직업',
												'FMLY_WRK_NM':'직장명',
												'FMLY_WRK_PSTN':'직위',
												'FMLY_LIVE_YN':'동거여부',
												'FMLY_HELP_YN':'부양여부',
												'FMLY_DEL':'삭제'};
	<? } ?>
	// 해외연수 및 해외경험
	<? if ($rsmdisplay[0]->TRAINING_USE_YN == 'Y') { ?>
	trngMaxCount = <?=$rsmdisplay[0]->TRAINING_FORM_CNT;?>;
	trngList = <?=count($trngRs) > 0 ? count($trngRs) + 1 : 1;?>;
	trngformListAr = {'TRN_STDT1':'시작 기간[년]',
												'TRN_STDT2':'시작 기간[월]',
												'TRN_EDDT1':'종료 기간[년]',
												'TRN_EDDT2':'종료 기간[월]',
												'TRN_TP_CD':'구분',
												'TRN_TP_NM':'구분',
												'TRN_CTRY_NM':'국가명',
												'TRN_ORG_NM':'기관/단체명',
												'TRN_OBJ_NM':'목적',
												'TRN_CNTNT':'활동내용',
												'TRNG_DEL':'삭제'};
	<? } ?>
	// 교육사항  
	<? if ($rsmdisplay[0]->EDUCATION_USE_YN == 'Y') { ?>
	educMaxCount = <?=$rsmdisplay[0]->EDUCATION_FORM_CNT;?>;
	educList = <?=count($educRs) > 0 ? count($educRs) + 1 : 1;?>;
	educformListAr = {'EDU_STDT1':'시작 기간[년]',
												'EDU_STDT2':'시작 기간[월]',
												'EDU_EDDT1':'종료 기간[년]',
												'EDU_EDDT2':'종료 기간[월]',
												'EDU_NM':'교육명',
												'EDU_ORG_NM':'기관/단체명',
												'EDU_CNTNT':'내용',
												'EDUC_DEL':'삭제'};
	
	<? } ?>
	// 보유기술 및 능력
	
	<? if ($rsmdisplay[0]->TECH_USE_YN == 'Y') { ?>
	techMaxCount = <?=$rsmdisplay[0]->TECH_FORM_CNT;?>;
	techList = <?=count($techRs) > 0 ? count($techRs) + 1 : 1;?>;
	techformListAr = {'TCH_SEQ':'코드',
												'TCH_NM':'보유능력',
												'TCH_LVL':'수준',
												'TCH_CNTNT':'내용',
												'TECH_DEL':'삭제'};
	
	<? } ?>
	// 주요활동및 사회경험
	<? if ($rsmdisplay[0]->SERVE_USE_YN == 'Y') { ?>
	srveMaxCount = <?=$rsmdisplay[0]->SERVE_FORM_CNT;?>;
	srveList = <?=count($srveRs) > 0 ? count($srveRs) + 1 : 1;?>;
	srveformListAr = {'SRV_STDT1':'시작 기간[년]',
												'SRV_STDT2':'시작 기간[월]',
												'SRV_EDDT1':'종료 기간[년]',
												'SRV_EDDT2':'종료 기간[월]',
												'SRV_TP_CD':'활동구분',
												'SRV_TP_NM':'활동구분',
												'SRV_ORG_NM':'기관',
												'SRV_CNTNT':'활동내용',
												'SRVE_DEL':'삭제'};
	<? } ?>
	
	// 자격증
	<? if ($rsmdisplay[0]->LICENSE_USE_YN == 'Y') { ?>
	licsMaxCount = <?=$rsmdisplay[0]->LICENSE_FORM_CNT;?>;	
	licsList = <?=count($licRs) > 0 ? count($licRs) + 1 : 1;?>;
	licsformListAr = {'LIC_NM':'자격증',
												'LIC_CD':'자격증',
												'LIC_NUM':'자격 번호',
												'LIC_PB_NM':'발행처/발급기관',
												'LIC_DT1':'취득일자',
												'LIC_DT2':'취득일자',
												'LIC_DT3':'취득일자',
												'LICS_DEL':'삭제',
												'BTN_SEARCH_LICENSE':'검색버튼'};
	<? } ?>
	// 어학능력 - 그냥 옵션 기능
	<? if ($rsmdisplay[0]->LANGUAGE2_USE_YN == 'Y') { ?>
	lan2MaxCount = <?=$rsmdisplay[0]->LANGUAGE2_FORM_CNT;?>;	
	lan2List = <?=count($lan2Rs) > 0 ? count($lan2Rs) + 1 : 1;?>;
	lan2formListAr = {'LANG2_SEQ':'코드',
												'LANG2_CD':'어학',
												'LANG2_NM':'어학',
												'LANG2_SPCH_LVL_CD':'말하기능력',
												'LANG2_SPCH_LVL_NM':'말하기능력',
												'LANG2_WRT_LVL_CD':'쓰기능력',
												'LANG2_WRT_LVL_NM':'쓰기능력',
												'LANG2_CMP_LVL_CD':'독해능력',
												'LANG2_CMP_LVL_NM':'독해능력',
												'LAN2_DEL':'삭제'};
												
	<? } ?>								
	// 상받다
	<? if ($rsmdisplay[0]->PRIZE_USE_YN == 'Y') { ?>
	przeMaxCount = <?=$rsmdisplay[0]->PRIZE_FORM_CNT;?>;	
	przeList = <?=count($przeRs) > 0 ? count($przeRs) + 1 : 1;?>;
	przeformListAr = {'PRZ_SEQ':'코드',
												'PRZ_DT1':'수상일자',
												'PRZ_DT2':'수상일자',
												'PRZ_DT3':'수상일자',
												'PRZ_NM':'수상명',
												'PRZ_PB_NM':'발행/재게처',
												'PRZE_DEL':'삭제'};
	<? } ?>											
	// 글쓰다
	<? if ($rsmdisplay[0]->WRITE_USE_YN == 'Y') { ?>
	wrteMaxCount = <?=$rsmdisplay[0]->WRITE_FORM_CNT;?>;		
	wrteList = <?=count($wrteRs) > 0 ? count($wrteRs) + 1 : 1;?>;
	wrteformListAr = {'WRT_SEQ':'코드',
												'WRT_DT1':'발행일자',
												'WRT_DT2':'발행일자',
												'WRT_DT3':'발행일자',
												'WRT_NM':'저술명',
												'WRT_PB':'발행/게재처',
												'WRTE_DEL':'삭제'};
	<? } ?>
	// 경력사항 
	<? if ($rsmdisplay[0]->CAREER_USE_YN == 'Y') { ?>
	carrMaxCount = <?=$rsmdisplay[0]->CAREER_FORM_CNT;?>;			
	carrList = <?=count($carrRs) > 0 ? count($carrRs) + 1 : 1;?>;
	carrformListAr = {'CAREER_SEQ':'코드',
												'CAREER_STDT1':'시작기간[년]',
												'CAREER_STDT2':'시작기간[월]',
												'CAREER_EDDT1':'종료기간[년]',
												'CAREER_EDDT2':'종료기간[월]',
												'CAREER_STS_CD':'현재상태',
												'CAREER_STS_NM':'현재상태',
												'CAREER_CMP_NM':'회사명',
												'CAREER_CMP_CD':'회사명',
												'CAREER_CMP_TP_CD':'기업형태',
												'CAREER_CMP_TP_NM':'기업형태',
												'CAREER_JOB_TP_CD':'직종',
												'CAREER_JOB_TP_NM':'직종명',
												'CAREER_DEPT_NM':'부서',
												'CAREER_RETIRE_CD':'퇴사사유',
												'CAREER_RETIRE_NM':'퇴사사유',
												'CAREER_LOC_CD':'회사 소재지',
												'CAREER_LOC_NM':'회사 소재지',
												'CAREER_PSTN_CD':'직급',
												'CAREER_PSTN_NM':'직급',
												'CAREER_PSTN_LVL_CD':'직책',
												'CAREER_PSTN_LVL_NM':'직책',
												'CAREER_EMP_TP_CD':'고용형태',
												'CAREER_EMP_TP_NM':'고용형태',
												'CAREER_CNTNT':'업무내용',
												'CARR_DEL':'삭제',
												'BTN_SEARCH_JOBTYPE':'직종검색'};
	
	<? } ?>
	
	<? if ($rsmdisplay[0]->SCHOOL_USE_YN == 'Y') { ?>
	// 고등학교 입력이 미리 있어서 2부터시작
	schlMaxCount = <?=$rsmdisplay[0]->SCHOOL_FORM_CNT;?>;			
	schlList = <?=count($schlRs) > 0 ? count($schlRs) + 1 : 2;?>;	
	schlformListAr = 				 { 'SCH_SEQ':'코드'
																,'SCH_CD':'학교코드'
																,'SCH_TP':'학력구분'
																,'SCH_FGRD_TP':'최종학력구분'
																,'SCH_NM':'학교명'
																,'SCH_JUYA':'주야'
																,'SCH_BRANCH_TP':'본교구분'
																,'SCH_LOC':'소재지'
																,'SCH_STDT1':'입학일'
																,'SCH_STDT2':'입학일'
																,'SCH_EDDT1':'졸업일'
																,'SCH_EDDT2':'졸업일'
																,'SCH_ETTP1':'입학구분'
																,'SCH_ETTP2':'졸업구분'
																,'SCH_MAJOR_NM':'전공명'
																,'SCH_MAJOR_CD':'전공코드'
																,'SCH_AFF':'계열'
																,'SCH_SUB_MAJOR_NM':'부전공명'
																,'SCH_SUB_MAJOR_CD':'부전공코드'
																,'SCH_SUB_AFF':'부전공계열'
																,'SCH_SUB_MAJOR_TP':'부전공구분'
																,'SCH_HAKJUM':'학점'
																,'SCH_ISU_HAKJUM':'이수학점'
																,'SCH_MAX_HAKJUM':'만점'
																,'SCHL_DEL':'삭제'
																,'BTN_SEARCH_SCHOOL':'버튼1'
																,'BTN_SEARCH_MAJOR':'버튼2'
																,'BTN_SEARCH_SUB_MAJOR':'버튼3'};
	<? } ?>
	
	// 기본적으로 한개이상은 항목이 보여지는 작업
	function bodyOnLoadAutoBoxOpen()
	{
		// 온로드에서 각 버튼 이벤트 등록
		for (var a = 0 ; a < commonMainCodeAr.length ; a ++)
		{
			var currentIdx = eval(commonMainCodeAr[a] + 'List');
				
			//1보다 크다는 말은 이미 등록된 데이터가 있다네
			//가족사항에서 가족사항이 없을경우 처리
			if (currentIdx > 0)
			{
				if (commonMainCodeAr[a] == 'fmly')
				{
					if (!$("#FMLY_NONE_YN").is(':checked')) addFormData(commonMainCodeAr[a],'onload');
				}
				else
				{
					if (currentIdx == 1) 
					{
						addFormData(commonMainCodeAr[a],'onload');
					}
				}
			}
			
		}
	}
	
	function bodyOnLoadEvent()
	{
		// 온로드에서 각 버튼 이벤트 등록
		for (var a = 0 ; a < commonMainCodeAr.length ; a ++)
		{
			var currentIdx = eval(commonMainCodeAr[a] + 'List');
				
			//1보다 크다는 말은 이미 등록된 데이터가 있다네
			if (currentIdx > 1)
			{
			
				for (var m = 1 ; m < currentIdx; m ++)
				{
					DatatFormAddEventOfDel(commonMainCodeAr[a],m);
					DatatFormAddEvent(commonMainCodeAr[a],m);
				}
			}
			
		}
		
		// 자기소개서에 바이트 표시
		var x = 1 ;
		while (x > 0)
		{
			if (!document.getElementById('APPL_CNTNT_' + x)) break;
			
			$("#APPL_CNTNT_" + x).click();
			x ++;
		}
	}
	
	// 기본항목 체크하는곳 (개인신상정보)
	function persoanlCheckBoxConfirm()
	{
			if ($("#PHOTO_YN").val() != 'Y' )
			{
				alert('사진을 등록하세요');
				return 'error';
			}
	}
	
	// 최종 저장할때 열려있는 항목 전부 체크하기
	function onSubmitCheckForm()
	{
		var dataAr = new Array();
		var dataCount = 0;
		var first_value = '';
		var mainCode = '';
		
		var blank_flag = '';
		var exist_flag = '';
		var val_flag = '';
		var menu_flag = '';
		for (var m = 0 ; m < commonMainCodeAr.length ; m ++)
		{
			mainCode = commonMainCodeAr[m];
			
			dataAr = eval(mainCode + 'formListAr');
			dataCount = eval(mainCode + 'List');
			dataCount ++;
			first_value = '';
			
			for (var dataCode in dataAr) 
			{ 
				first_value = dataCode;
				break; 
			}
			
			for (var x = 1 ; x <= dataCount; x++ )
			{
				if ($("#" + first_value + '_' + x).length > 0)
				{	
					blank_flag = '';
					exist_flag = '';
					val_flag = '';
					menu_flag = '';
					for (var dataCode in dataAr)
					{
						if ( !dataCode.match(/SEQ|CD|DEL$/) && !dataCode.match(/^BTN/) && !dataCode.match(/^SCH_FGRD_TP$/) ) // array 에 등록된 폼에서 코드같은거 버튼 시퀀스 제외하고 다 검사하기
						{
							if (x == 1) // 전부 비우던지 다 넣던지.
							{
								if (mainCode != 'schl')
								{
									if ( $.trim($("#" + dataCode + '_' + x).val()) == '' ) 
									{
										blank_flag = dataAr[dataCode];
										val_flag = dataCode + '_' + x;
										menu_flag = commonMainNameAr[m];
									}
									
									if ( $.trim($("#" + dataCode + '_' + x).val()) != '' ) 
									{
										exist_flag = dataAr[dataCode];	
									}
								}
								
							}
							
							if (x > 1) // 다 넣던지 삭제를 하던지
							{
								//alert($("#" + dataCode + '_' + x).val() + '------' + dataCode + '_' + x);
								if (exceptionCheckForm(mainCode,x) == 'error')
								{
									alert(commonMainNameAr[m] + ' 항목을 확인하세요. [부전공계열및 학과]\n입력하지 않으실경우는 삭제하세요');
									$("#" + 'SCH_SUB_AFF' + '_' + x).focus();
									return 'error';
								}
								
								if (commonMainCodeAr[m] == 'schl' && dataCode.match(/^SCH_SUB_AFF|SCH_SUB_MAJOR_NM$/))
								{
								}	
								else
								{
									if ( $.trim($("#" + dataCode + '_' + x).val()) == ''  ) 
									{
										alert(commonMainNameAr[m] + ' 항목을 확인하세요. [' + dataAr[dataCode] + ']' + '\n입력하지 않으실경우는 삭제하세요');
										$("#" + dataCode + '_' + x).focus();
										return 'error';
									}
								}
							}
						}
					}
					
					if (blank_flag != '' && exist_flag != '')
					{
						alert(menu_flag + ' 항목을 확인하세요.[' + blank_flag + ']');
						if ( $("#" + val_flag).attr('type') == 'hidden' )
						{
							$("#" + val_flag.replace('_NM','_CD')).focus();
						}	
						else
						{
							$("#" + val_flag).focus();
						}
						return 'error';
					}
					
				}
			}
			
		}
		return true;
	}
	
	// 위 서브밋에서 처리하면서 넣기 복잡한놈들 개별처리하려고 빼놓은 함수.
	function exceptionCheckForm(mainCode,code)
	{
		// 학력에서 부전공부분 처리
		if (mainCode == 'schl')
		{
			if ($("#SCH_SUB_MAJOR_TP_" + code).val() != '35' && $("#SCH_SUB_MAJOR_TP_" + code).val() != '')
			{
				if ( $("#SCH_SUB_AFF_" + code).val() == '' || $("#SCH_SUB_MAJOR_NM_" + code).val() == '' || $("#SCH_SUB_MAJOR_CD_" + code).val() == '' )
				{
					return 'error';
				}	
			}
		}
		return true;
	}
	
	function DataFormValidationCreate(mainCode,code)
	{
		/***** jquery validate 를 이용한 폼체크 그냥 ;;;; 안쓸란다;;;
		var dataAr = new Array();
	
		dataAr = eval(mainCode + 'formListAr');
		
		for (var dataCode in dataAr)
		{
		//alert($('#' + dataCode + '_' + code).type());
			//유효성 체크하지 않을것들
		
			if ( !dataCode.match(/SEQ|CD|DEL$/) )
			{
				$('#' + dataCode + '_' + code).rules('add' , {
					required:true,
					messages:{required:dataAr[dataCode] + '을(를) 확인하세요.'}
				});	
				
				$("#form1").validate().groups[dataCode + '_' + code] = mainCode.toUpperCase() + '_GRP_MSG_' + code;
			}
			
		}
		*/
		var dataAr = new Array();
		var dataCount = 0;
		dataAr = eval(mainCode + 'formListAr');
		dataCount = eval(mainCode + 'List ++');
		var first_value = '';
		
		for (var dataCode in dataAr) 
		{ 
			first_value = dataCode;
			break; 
		}
		
		var x = 1;
		if (mainCode == 'schl') x = 2;
		for ( x = x ; x <= dataCount; x++ )
		{
			if ($("#" + first_value + '_' + x).length > 0)
			{	
				
				if (exceptionCheckForm(mainCode,x) == 'error')
				{
					alert(commonMainNameAr[m] + ' 항목을 확인하세요. [부전공계열및 학과]\n입력하지 않으실경우는 삭제하세요');
					$("#" + 'SCH_SUB_AFF' + '_' + x).focus();
					return 'error';
				}
				
				for (var dataCode in dataAr)
				{
					
					if ( !dataCode.match(/SEQ|CD|DEL|SCH_SUB_AFF|SCH_SUB_MAJOR_NM$/) && !dataCode.match(/^BTN/) ) // array 에 등록된 폼에서 코드같은거 버튼 시퀀스 제외하고 다 검사하기
					{
						if ($.trim($("#" + dataCode + '_' + x).val()) == '')
						{
							return 'error';
							break;
						}
					}
				}
			}
		}
		return true;
	}
	
	function DataFormCreate(mainCode,code)
	{
		
		var dataAr = new Array();
		dataAr = eval(mainCode + 'formListAr');
		
		$("#id_" + mainCode + "_list").append('<label id="' + mainCode.toUpperCase() + '_ERROR_MESSAGE_' + code + '" class="error" for="' + mainCode.toUpperCase() + '_GRP_MSG_' + code + '" generated="true" style="display:none;color:red;" />');
		$("#id_" + mainCode + "_list").append($("#id_" + mainCode + "_sample").html());
		
		$("#id_" + mainCode + "_list").find("#id_" + mainCode + "_box_set").attr('id',"id_" + mainCode + "_box_set" + "_" + code);
		
		$("#id_" + mainCode + "_list").find("#id_" + mainCode + "_box_set").attr('id',"id_" + mainCode + "_box_set" + "_" + code);
		
		if (mainCode == 'schl') //학력사항안에 감출게 있어서 ;;; 부전공
		{
			$("#id_" + mainCode + "_list").find("#id_" + mainCode + "_box_set_" + code).find("#id_sub_major_form").attr('id',"id_sub_major_form" + "_" + code);
		}
		
		for (var dataCode in dataAr)
		{	
			$("#id_" + mainCode + "_list").find("#id_" + mainCode + "_box_set" + "_" + code).find("#" + dataCode).attr('id',dataCode + '_' + code);
		  $("#id_" + mainCode + "_list").find("#id_" + mainCode + "_box_set" + "_" + code).find("#" + dataCode + "_" + code).attr("name",dataCode + '_' + code);
		}
		
		DatatFormAddEventOfDel(mainCode,code);
		DatatFormAddEvent(mainCode,code);

	}
	
	//항목에 검색이 있으면 버튼에 이벤트 추가하기 
	//var commonMainCodeAr = new Array('fmly','trng','educ','tech','srve','lics','lan2','prze','wrte','carr','cari');
	function DatatFormAddEventOfDel(mainCode,code)
	{
		if (code == 1) $("#" + mainCode.toUpperCase() + "_DEL_" + code).hide();
		if (code > 1)
		{
			$("#" + mainCode.toUpperCase() + "_DEL_" + code).click( function(){ deleteFormReset(mainCode,code);  });
			$("#" + mainCode.toUpperCase() + "_DEL_" + code).attr("style","cursor:hand;");
		}
	}
	
	function DatatFormAddEvent(mainCode,code)
	{
		// 귀찬타;;; 그냥 수동으로 추가합시다.
		switch (mainCode)
		{
			
			
			case 'prze' :
				$("#PRZ_DT1_" + code).blur( function(){ CheckFormDate('PRZ_DT',code); });
				$("#PRZ_DT2_" + code).blur( function(){ setNum2str(this); CheckFormDate('PRZ_DT',code); });
				$("#PRZ_DT3_" + code).blur( function(){ setNum2str(this); CheckFormDate('PRZ_DT',code); });
				break;
			
			case 'wrte' :
				$("#WRT_DT1_" + code).blur( function(){ CheckFormDate('WRT_DT',code); });
				$("#WRT_DT2_" + code).blur( function(){ setNum2str(this); CheckFormDate('WRT_DT',code); });
				$("#WRT_DT3_" + code).blur( function(){ setNum2str(this); CheckFormDate('WRT_DT',code); });
				break;
				
			case 'lics' :
				$("#BTN_SEARCH_LICENSE_" + code).click( function(){ searchPop('자격증','license',code,'LIC','Y','L','width=500 height=550'); } );
				$("#BTN_SEARCH_LICENSE_" + code).attr("style","cursor:hand;");
				$("#LIC_DT1_" + code).blur( function(){ CheckFormDate('LIC_DT',code); });
				$("#LIC_DT2_" + code).blur( function(){ setNum2str(this); CheckFormDate('LIC_DT',code); });
				$("#LIC_DT3_" + code).blur( function(){ setNum2str(this); CheckFormDate('LIC_DT',code); });
				break;
					
			case 'fmly' :
				$("#FMLY_SCH_CD_" + code).change(function() { SelDataSet("FMLY_SCH_CD_" + code,"FMLY_SCH_NM_" + code); });
				$("#FMLY_REL_CD_" + code).change(function() { SelDataSet("FMLY_REL_CD_" + code,"FMLY_REL_NM_" + code); });
				$("#FMLY_NAI_" + code).blur( function(){ CheckData(this,'digits'); });
				break;
			
			case 'carr' :
				//CAREER_JOB_TP_NM
				$("#BTN_SEARCH_JOBTYPE_" + code).click( function(){ searchJoBType(code); } );
				$("#BTN_SEARCH_JOBTYPE_" + code).attr("style","cursor:hand;");
				
				$("#CAREER_STS_CD_" + code).change(function() { SelDataSet("CAREER_STS_CD_" + code,"CAREER_STS_NM_" + code); });
				$("#CAREER_CMP_TP_CD_" + code).change(function() { SelDataSet("CAREER_CMP_TP_CD_" + code,"CAREER_CMP_TP_NM_" + code); });
				$("#CAREER_LOC_CD_" + code).change(function() { SelDataSet("CAREER_LOC_CD_" + code,"CAREER_LOC_NM_" + code); });
				$("#CAREER_EMP_TP_CD_" + code).change(function() { SelDataSet("CAREER_EMP_TP_CD_" + code,"CAREER_EMP_TP_NM_" + code); });
				
				$("#CAREER_PSTN_CD_" + code).change(function() { SelDataSet("CAREER_PSTN_CD_" + code,"CAREER_PSTN_NM_" + code); });
				$("#CAREER_PSTN_LVL_CD_" + code).change(function() { SelDataSet("CAREER_PSTN_LVL_CD_" + code,"CAREER_PSTN_LVL_NM_" + code); });
				$("#CAREER_RETIRE_CD_" + code).change(function() { SelDataSet("CAREER_RETIRE_CD_" + code,"CAREER_RETIRE_NM_" + code); });
				
				$("#CAREER_STDT1_" + code).blur( function(){ CheckFormDate('CAREER_STDT',code); CheckTermDate('CAREER',code); } );
				$("#CAREER_EDDT1_" + code).blur( function(){ CheckFormDate('CAREER_EDDT',code); CheckTermDate('CAREER',code); } );
				$("#CAREER_STDT2_" + code).blur( function(){ setNum2str(this); CheckFormDate('CAREER_STDT',code); CheckTermDate('CAREER',code); } );
				$("#CAREER_EDDT2_" + code).blur( function(){ setNum2str(this); CheckFormDate('CAREER_EDDT',code); CheckTermDate('CAREER',code); } );
				
				break;
				
			case 'lan2' :
				$("#LANG2_CD_" + code).change(function() { SelDataSet("LANG2_CD_" + code,"LANG2_NM_" + code); });
				$("#LANG2_SPCH_LVL_CD_" + code).change(function() { SelDataSet("LANG2_SPCH_LVL_CD_" + code,"LANG2_SPCH_LVL_NM_" + code); });
				$("#LANG2_WRT_LVL_CD_" + code).change(function() { SelDataSet("LANG2_WRT_LVL_CD_" + code,"LANG2_WRT_LVL_NM_" + code); });
				$("#LANG2_CMP_LVL_CD_" + code).change(function() { SelDataSet("LANG2_CMP_LVL_CD_" + code,"LANG2_CMP_LVL_NM_" + code); });
				break;
			
			case 'educ' :
				$("#EDU_STDT1_" + code).blur( function(){ CheckFormDate('EDU_STDT',code); CheckTermDate('EDU',code); } );
				$("#EDU_EDDT1_" + code).blur( function(){ CheckFormDate('EDU_EDDT',code); CheckTermDate('EDU',code); } );
				$("#EDU_STDT2_" + code).blur( function(){ setNum2str(this); CheckFormDate('EDU_STDT',code); CheckTermDate('EDU',code); } );
				$("#EDU_EDDT2_" + code).blur( function(){ setNum2str(this); CheckFormDate('EDU_EDDT',code); CheckTermDate('EDU',code); } );
				break;
			
			case 'srve' :
				$("#SRV_TP_CD_" + code).change(function() { SelDataSet("SRV_TP_CD_" + code,"SRV_TP_NM_" + code); });
				$("#SRV_STDT1_" + code).blur( function(){ CheckFormDate('SRV_STDT',code); CheckTermDate('SRV',code); } );
				$("#SRV_EDDT1_" + code).blur( function(){ CheckFormDate('SRV_EDDT',code); CheckTermDate('SRV',code); } );
				$("#SRV_STDT2_" + code).blur( function(){ setNum2str(this); CheckFormDate('SRV_STDT',code); CheckTermDate('SRV',code); } );
				$("#SRV_EDDT2_" + code).blur( function(){ setNum2str(this); CheckFormDate('SRV_EDDT',code); CheckTermDate('SRV',code); } );
				break;
			
			case 'trng' :
				$("#TRN_TP_CD_" + code).change(function() { SelDataSet("TRN_TP_CD_" + code,"TRN_TP_NM_" + code); });
				$("#TRN_STDT1_" + code).blur( function(){ CheckFormDate('TRN_STDT',code); CheckTermDate('TRN',code); } );
				$("#TRN_EDDT1_" + code).blur( function(){ CheckFormDate('TRN_EDDT',code); CheckTermDate('TRN',code); } );
				$("#TRN_STDT2_" + code).blur( function(){ setNum2str(this); CheckFormDate('TRN_STDT',code); CheckTermDate('TRN',code); } );
				$("#TRN_EDDT2_" + code).blur( function(){ setNum2str(this); CheckFormDate('TRN_EDDT',code); CheckTermDate('TRN',code); } );
				break;
			
			case 'schl' :
				$("#SCH_ISU_HAKJUM_" + code).blur( function(){ CheckData(this,'digits'); });
				$("#SCH_STDT1_" + code).blur( function(){ CheckFormDate('SCH_STDT',code); CheckTermDate('SCH',code); } );
				$("#SCH_EDDT1_" + code).blur( function(){ CheckFormDate('SCH_EDDT',code); CheckTermDate('SCH',code); } );
				$("#SCH_STDT2_" + code).blur( function(){ setNum2str(this); CheckFormDate('SCH_STDT',code); CheckTermDate('SCH',code); } );
				$("#SCH_EDDT2_" + code).blur( function(){ setNum2str(this); CheckFormDate('SCH_EDDT',code); CheckTermDate('SCH',code); } );
			
				$("#BTN_SEARCH_SCHOOL_" + code).click( function(){ searchPopSch('학교','school',$("#SCH_TP_" + code + " option:selected").val(),code,'SCH','N','L','width=500 height=550'); } );
				$("#BTN_SEARCH_SCHOOL_" + code).attr("style","cursor:hand;");
				
				$("#BTN_SEARCH_MAJOR_" + code).click( function(){ searchPop('전공','major',code,'SCH_MAJOR','Y','L','width=500 height=550'); } );
				$("#BTN_SEARCH_MAJOR_" + code).attr("style","cursor:hand;");
				
				$("#BTN_SEARCH_SUB_MAJOR_" + code).click( function(){ searchPop('부전공','major',code,'SCH_SUB_MAJOR','Y','L','width=500 height=550'); } );
				$("#BTN_SEARCH_SUB_MAJOR_" + code).attr("style","cursor:hand;");
				
				$("#SCH_TP_" + code).change( function() { clearSchNm(code); });
				$("#SCH_FGRD_TP_" + code).click( function() { schCheckBoxConfirm(code); });
				$("#SCH_SUB_MAJOR_TP_" + code).change( function(){ schCheckSubMajor(code); });
				
				$("#SCH_HAKJUM_" + code).blur( function() { checkScore(code); } );
				$("#SCH_MAX_HAKJUM_" + code).change( function() { checkScore(code); } );
				break;	
			
		}
	}
	
	function searchJoBType(code)
	{
		window.open('','add_pop','width=500 height=550');
		$("#popupTitle").val('직종');
		$("#popupCode").val('');
		$("#popupIndex").val(code);
		$("#popupAccCode").val('CAREER_JOB_TP');
		$("#popupDisplayType").val('');
		$("#popupEtcUseYn").val('');
		$("#popupSchCode").val('');
		$("#popupform1").attr("target","add_pop");
		$("#popupform1").attr("method","post");
		$("#popupform1").attr("action","/front/popup/JobTypeList");
		$("#popupform1").submit();
	}
	
	function searchAddress()
	{
		window.open('','add_pop','width=500 height=550');
		$("#popupTitle").val('주소');
		$("#popupCode").val('');
		$("#popupIndex").val('');
		$("#popupAccCode").val('');
		$("#popupDisplayType").val('');
		$("#popupEtcUseYn").val('');
		$("#popupSchCode").val('');
		$("#popupform1").attr("target","add_pop");
		$("#popupform1").attr("method","post");
		$("#popupform1").attr("action","/front/popup/AddressList");
		$("#popupform1").submit();
	}
	
	function searchPopSch(p_title,p_code,p_gubun,p_index,p_acc_cd,p_etc_use_yn,p_list_type,p_opt)
	{
	
		if (p_gubun == '')
		{
			alert('학력구분선택을 먼저 하세요');
		}
		else
		{
			window.open('','sch_pop',p_opt);
			$("#popupTitle").val(p_title);
			$("#popupCode").val(p_code);
			$("#popupIndex").val(p_index);
			$("#popupAccCode").val(p_acc_cd);
			$("#popupSchCode").val(p_gubun);
			$("#popupDisplayType").val(p_list_type);
			$("#popupEtcUseYn").val(p_etc_use_yn);
			
			$("#popupform1").attr("target","sch_pop");
			$("#popupform1").attr("method","post");
			$("#popupform1").attr("action","/front/popup/SearchList");
			$("#popupform1").submit();
		}
	}
	
	function searchPhotoUpload()
	{
		window.open('','sch_pop','width=362 height=183');
		$("#POPUP_APPL_IDX").val($("#APPL_IDX").val());
		$("#POPUP_PRJ_IDX").val($("#PRJ_IDX").val());
		$("#popupform1").attr("target","sch_pop");
		$("#popupform1").attr("method","post");
		$("#popupform1").attr("action","/front/popup/PhotoUpload");
		$("#popupform1").submit();
	}
	
	function PhotoDelete()
	{
		$("#POPUP_APPL_IDX").val($("#APPL_IDX").val());
		$("#POPUP_PRJ_IDX").val($("#PRJ_IDX").val());
		$("#id_photo_image").attr("src","<?=$FRONT_IMG_URL?>/img/board/no_pic.gif");
		$("#PHOTO_YN").val('N');
		
		var serializedData = $("#popupform1").serialize();
		//dataType:'json',
		$.ajax({
    url: "/front/popup/PhotoUploadDeleteProcess",
    type: "post",
    data: serializedData,
    success: function(response, textStatus, jqXHR){
				
    },
    error: function(jqXHR, textStatus, errorThrown){
    		alert(textStatus);
        //console.log("The following error occured: "+textStatus, errorThrown);
    },
    complete: function(){
    	
    ///alert('삭제 완료!');	
    }
    	
		});
		alert('삭제 되었습니다.');
	}
	
	function searchPop(p_title,p_code,p_index,p_acc_cd,p_etc_use_yn,p_list_type,p_opt)
	{
		window.open('','sch_pop',p_opt);
		$("#popupTitle").val(p_title);
		$("#popupCode").val(p_code);
		$("#popupIndex").val(p_index);
		$("#popupAccCode").val(p_acc_cd);
		$("#popupDisplayType").val(p_list_type);
		$("#popupEtcUseYn").val(p_etc_use_yn);
		$("#popupSchCode").val('');
		$("#popupform1").attr("target","sch_pop");
		$("#popupform1").attr("method","post");
		$("#popupform1").attr("action","/front/popup/SearchList");
		$("#popupform1").submit();
		//alert(p_title + '--' + p_code + '---' + p_etc_cd);
	}
	
	function DataFormClear(mainCode,code)
	{
		
		var dataAr = new Array();
		dataAr = eval(mainCode + 'formListAr');
		for (var dataCode in dataAr)
		{
			$("#" + dataCode + '_' + code).attr('checked',false);
			$("#" + dataCode + '_' + code).val('');
		}
		
	}
	
	function deleteFormReset(mainCode,code) 
	{
		DataFormClear(mainCode,code);
		$("#" + mainCode.toUpperCase() + "_ERROR_MESSAGE_" + code).remove();
		$("#id_" + mainCode + "_box_set_" + code).remove();
	}
	
	function addFormData(mainCode,onloadflag)
	{
		var error_flag = '';
		if (onloadflag != 'onload')
		{
			//id_schl_box_set
			//fmlyListfmlyMaxCount
			var cur_num = eval(mainCode + 'List');
			var max_num = eval(mainCode + 'MaxCount');
			
			var x = 1;
			//id_fmly_box_set
			for (var a = 1 ;a <= cur_num ; a ++)
			{
				if ($("#form1").find("#id_" + mainCode + "_box_set_" + a).length > 0) x++;
			}
			
			if (x > max_num)
			{
				alert(max_num + "개 까지 입력가능합니다.");
				error_flag = 'error';
			}
			
			if (DataFormValidationCreate(mainCode,eval(mainCode + 'List')) == 'error' )
			{	
				alert('해당 항목을 전부 입력하고 추가를 하셔야합니다.');
				error_flag = 'error';
			}
		}
		
		if (error_flag == '')
		{
			DataFormCreate(mainCode,eval(mainCode + 'List'));	
			eval(mainCode + 'List ++');
		}
	}
	
	var flag_final_tp = '';
	
	function bodyOnLoad()
	{
		
		
		//CARR_GRP_MSG_1:"CAREER_STDT1 CAREER_STDT2"
		
		$("#form1").validate({  
				groups:{
						PSN_MSG:"NAMECHA NAMEENG1 NAMEENG2 BIRTH_TP ZIPCODE ADDRESS1 ADDRESS2 TEL1 TEL2 TEL3 HTEL1 HTEL2 HTEL3 MARRY_YN EMAIL RELIGION HOBBY FORTE BOHUN_TP_CD BOHUN_SCORE_CD BOHUN_NUM PSN_OBSTACLE_TP_CD PSN_OBSTACLE_LVL_CD PSN_OBSTACLE_TP_REASON PSN_HEIGHT PSN_WEIGHT PSN_LSIGHT PSN_RSIGHT PSN_CLRBLND_YN PSN_LOWINCOME_YN"
					},
		    rules: {
		    		<? if ($ADMIN_FLAG == '') { ?>USER_PW:{required:true,minlength:6,maxlength:20}, <? } ?>
		    		UNIT_IDX1:{required:true},
		    		NAMECHA:{required:true},
		    		NAMEENG1:{required:true,charseng:true},
		    		NAMEENG2:{required:true,charseng:true},
		    		BIRTH_TP:{required:true},
		    		ZIPCODE:{required:true},
		    		ADDRESS1:{required:true},
		    		ADDRESS2:{required:true},
		    		TEL1:{required:true},
		    		TEL2:{required:true,digits:true,minlength:3,maxlength:4},
		    		TEL3:{required:true,digits:true,minlength:4,maxlength:4},
		    		HTEL1:{required:true},
		    		HTEL2:{required:true,digits:true,minlength:3,maxlength:4},
		    		HTEL3:{required:true,digits:true,minlength:4,maxlength:4},
		    		MARRY_YN:{required:true},
		    		EMAIL:{required:true,email:true},
		    		BOHUN_TP_CD:{required:true},
		    		BOHUN_SCORE_CD:{required:function(element) { return $("#BOHUN_TP_CD option:selected").val() == 'Y' ? true : false; }},
		    		BOHUN_NUM:{required:function(element) { return $("#BOHUN_TP_CD option:selected").val() == 'Y' ? true : false; }},
		    		PSN_OBSTACLE_TP_CD:{required:true},
		    		PSN_OBSTACLE_LVL_CD:{required:function(element) { return $("#PSN_OBSTACLE_TP_CD").val() == 'Y' ? true : false; }},
		    		PSN_OBSTACLE_TP_REASON:{required:function(element) { return $("#PSN_OBSTACLE_TP_CD").val() == 'Y' ? true : false; }},
		    		RELIGION:{maxlength:50},
		    		HOBBY:{maxlength:50},
		    		PSN_HEIGHT:{digits:true,min:70,max:350},
		    		PSN_WEIGHT:{digits:true,min:20,max:300},
		    		PSN_LSIGHT:{digitsforfloatforeye:true},
		    		PSN_RSIGHT:{digitsforfloatforeye:true}
		    	
		    },  
		  	onkeyup:false,
		    messages: {
		    
		    		USER_PW:{required:"비밀번호를 입력하세요",minlength:"최소 6자리입니다.",maxlength:"최대 20자입니다."},
		    		
		    		UNIT_IDX1:{required:"지원분야를 확인하세요"},
		    		NAMECHA:{required:"한문명을 확인하세요"},
		    		NAMEENG1:{required:"영문명을 확인하세요.",charseng:"영문명을 확인하세요."},
		    		NAMEENG2:{required:"영문명을 확인하세요.",charseng:"영문명을 확인하세요."},
		    		BIRTH_TP:{required:"양/음력을 선택하세요"},
		    		ZIPCODE:{required:"우편번호를 확인하세요."},
		    		ADDRESS1:{required:"주소를 확인하세요."},
		    		ADDRESS2:{required:"주소를 확인하세요."},
		    		TEL1:{required:"전화번호를 확인하세요."},
		    		TEL2:{required:"전화번호를 확인하세요.",digits:"전화번호를 확인하세요.",minlength:"전화번호를 확인하세요.",maxlength:"전화번호를 확인하세요."},
		    		TEL3:{required:"전화번호를 확인하세요.",digits:"전화번호를 확인하세요.",minlength:"전화번호를 확인하세요.",maxlength:"전화번호를 확인하세요."},
		    		HTEL1:{required:"휴대폰번호를 확인하세요."},
		    		HTEL2:{required:"휴대폰번호를 확인하세요.",digits:"휴대폰번호를 확인하세요.",minlength:"휴대폰번호를 확인하세요.",maxlength:"휴대폰번호를 확인하세요."},
		    		HTEL3:{required:"휴대폰번호를 확인하세요.",digits:"휴대폰번호를 확인하세요.",minlength:"휴대폰번호를 확인하세요.",maxlength:"휴대폰번호를 확인하세요."},
		    		MARRY_YN:{required:"결혼여부를 확인하세요."},
		    		EMAIL:{required:"이메일을 확인하세요.",email:"이메일을 확인하세요."},
		    		BOHUN_TP_CD:{required:"보훈대상 여부를 선택하세요"},
		    		BOHUN_SCORE_CD:{required:"보훈번호및 가점을 확인하세요."},
		    		BOHUN_NUM:{required:"보훈번호및 가점을 확인하세요."},
		    		PSN_OBSTACLE_TP_CD:{required:"장애등급및 사유를 확인하세요."},
		    		PSN_OBSTACLE_LVL_CD:{required:"장애등급및 사유를 확인하세요."},
		    		PSN_OBSTACLE_TP_REASON:{required:"장애사유를 선택하세요."},
		    		RELIGION:{maxlength:"종교입력은 최대 25자입니다."},
		    		HOBBY:{maxlength:"취미입력은 최대 25자입니다."},
		    		PSN_HEIGHT:{digits:"신장을 확인하세요.",min:"신장을 확인하세요.",max:"신장을 확인하세요."},
		    		PSN_WEIGHT:{digits:"체중을 확인하세요.",min:"체중을 확인하세요.",max:"체중을 확인하세요."},
		    		PSN_LSIGHT:{digitsforfloatforeye:"시력을 확인하세요."},
		    		PSN_RSIGHT:{digitsforfloatforeye:"시력을 확인하세요."}
		    },
		    
		    submitHandler: function(form) { 
		    	
		    	// 최종 submit 할때. --> 오픈된 항목 전부 체크하기
		    	if (persoanlCheckBoxConfirm() == 'error' )
		    	{
		    		
		    	}
		    	else if (onSubmitCheckForm() == 'error')
		    	{
	    		}
	    		else if (armyCheckBoxConfirm() == 'error') // 병역사항 체크 
	    		{
	    			alert('병역사항을 확인하세요.');
	    		}
	    		else if (schCheckBoxConfirm() == 'error') // 최종학력선택시 2개이상하면 뒤진당. // 고딩체크등등 
	    		{
	    		}
	    		else if (lan2CheckBoxConfirm() == 'error') // 어학능력 체크
	    		{
	    			alert('선택하신 어학능력 항목이 중복되었습니다.');
	    		}
	    		else if (fmlyCheckBoxConfirm() == 'error') // 가족사항 체크 부분
	    		{
	    			alert('가족사항을 확인하세요.\n가족이 없을경우에는 가족사항여부에 가족없음 항목에 체크를 하시기 바랍니다.');
	    		}
	    		else if (cntntCheckBoxConfirm() == 'error') // 자기소개서 필수체크
	    		{
	    			
	    		}
	    		else
	    		{
	    			form.submit();
	    		}
	    	}
   	});  
   	
		
		
		/*
		셀렉트박스 데이타셋 함수 적용
		*/
		//DataSet('BOHUN_TP_NM',$("#BOHUN_TP_CD option:selected").text());
		
		$("#BOHUN_TP_CD").change(function() { SelDataSet('BOHUN_TP_CD','BOHUN_TP_NM'); showBohunList(); });
		$("#PSN_OBSTACLE_TP_CD").change(function() { SelDataSet('PSN_OBSTACLE_TP_CD','PSN_OBSTACLE_TP_NM'); showObstacleList(); });
		$("#BOHUN_SCORE_CD").change(function() { SelDataSet('BOHUN_SCORE_CD','BOHUN_SCORE_NM'); });
		$("#PSN_OBSTACLE_LVL_CD").change(function() { SelDataSet('PSN_OBSTACLE_LVL_CD','PSN_OBSTACLE_LVL_NM'); });
		
		
		// selectbox 처리용
		$("#ARMY_YN_CD").change( function() { SelDataSet('ARMY_YN_CD','ARMY_YN_NM')&CheckArmy(); });
		$("#ARMY_TP_CD").change( function() { SelDataSet('ARMY_TP_CD','ARMY_TP_NM'); });
		$("#ARMY_LVL_CD").change( function() { SelDataSet('ARMY_LVL_CD','ARMY_LVL_NM'); });
		$("#ARMY_FINISH_CD").change( function() { SelDataSet('ARMY_FINISH_CD','ARMY_FINISH_NM'); });
		
		// 로드데이터에 대한 이벤트
		bodyOnLoadEvent();
		getWorkPlaceList('UNIT_IDX1');
		bodyOnLoadAutoBoxOpen();
		
		<? if ($rsmdisplay[0]->ARMY_USE_YN == 'Y') { ?>
		CheckArmy('onload');
		<? } ?>
		
		<? if ($rsmdisplay[0]->PERSONAL_USE_YN == 'Y') { ?>
		if ($("#PSN_OBSTACLE_TP_CD").val() == 'Y') $("#id_OBSTACLELIST").show();
		if ($("#BOHUN_TP_CD").val() == 'Y') $("#id_BOHUNLIST").show();	
		if ($("#PHOTO_YN").val() == 'Y') $("#id_photo_image").attr("src","<?=$PHOTO_URL?>");
		<? } ?>
		
		<? if ($rsmdisplay[0]->FAMILY_USE_YN == 'Y') { ?>
		//가족사항 처리항목
		fmlyAllDel('onload');
		<? } ?>
		
		<? if ($rsmdisplay[0]->SCHOOL_USE_YN == 'Y') { ?>
		if ($(':radio[name="SCH_TP_1"]:checked').val() == '25' ) selSchoolType('highschool');
		if ($(':radio[name="SCH_TP_1"]:checked').val() == '52' ) selSchoolType('blackgosi');
		bodyOnLoadforSchSubMajor();
		checkHakView('onload');
		<? } ?>
		
		$(document).bind("contextmenu", function(e) {
    //return false;
		});
		
		$(function() {    
			$( "#dialog" ).dialog({      
					autoOpen: false 
			});     
			
			$( "#opener" ).click(function() {      $( "#dialog" ).dialog( "open" );    });  
		});
		
	}
	
	function openComment(code)
	{
		$("#dialog").html($("#dialog_for_" + code).html());
		$("#dialog").dialog( "open" ); 
	}
	
	function showObstacleList()
	{
		$("#id_OBSTACLELIST").hide();
		$("#PSN_OBSTACLE_LVL_CD").val('');
		DataSet('PSN_OBSTACLE_LVL_NM','');
		DataSet('PSN_OBSTACLE_TP_REASON','');
		
		if ($("#PSN_OBSTACLE_TP_CD").val() == 'Y') $("#id_OBSTACLELIST").show();
	}
	
	function showBohunList()
	{
		$("#id_BOHUNLIST").hide();
		$("#BOHUN_SCORE_CD").val('');
		DataSet('BOHUN_SCORE_NM','');
		DataSet('BOHUN_NUM','');
		
		if ($("#BOHUN_TP_CD").val() == 'Y') $("#id_BOHUNLIST").show();
		
	}
	
	function formContentClear(obj,code)
	{
		if (obj == 'LAN')
		{
			$("#LAN_SCORE_" + code).val('');
			$("#LAN_LVL_IDX_" + code).val('');
			$("#LAN_NUM_" + code).val('');
			$("#LAN_DT1_" + code).val('');
			$("#LAN_DT2_" + code).val('');
			$("#LAN_DT3_" + code).val('');
		}
	}
	
	function chkWorkPlace()
	{
		var arr = new Array();
		var a = 1;
		var b = 0;
		while (a >= 0)
		{
			if (!document.getElementById('WRK_LOC_CD' + a)) break;
			
			if ($("#WRK_LOC_CD" + a + " option:selected").val() != '' )
			{
				arr[b] = $("#WRK_LOC_CD" + a + " option:selected").val();
				b++;
			}
			a++;
		}
		
		if (has_duplicates(arr))
		{
			alert('희망근무지가 중복되었습니다.');
			
			a = 1;
		
			while (a >= 0)
			{
				if (!document.getElementById('WRK_LOC_CD' + a)) break;
				$("#WRK_LOC_CD" + a).val('');
				a++;
			}
			
		}
	}
	
	function getWorkPlaceList(objid)
	{
		
		$("#SN_PRJ_IDX").val($("#PRJ_IDX").val());
		$("#SN_RSM_IDX").val($("#RSM_IDX").val());
		$("#SN_APPL_IDX").val($("#APPL_IDX").val());
		$("#SN_UNIT_IDX").val($("#" + objid + " option:selected").val());
		
		var serializedData = $("#form2").serialize();
		$.ajax({
    url: "/front/apply/workPlaceList",
    type: "post",
    dataType:'json',
    data: serializedData,
    success: function(response, textStatus, jqXHR){
				
				// 근무지수
				//alert(response[0][2]);
				$("#ID_WRKPLACE").empty();
				if ($.trim(response) != '')
				{
					var aloc = 1;
					var sel_val = '';
					if ($("#" + objid + " option:selected").val() != '' )
					{
						for (var a = 0 ;a < response[0][2] ; a ++ )
						{
							$("#ID_WRKPLACE").append('<p>');
							$("#ID_WRKPLACE").append(aloc + '지망 : ');
							$("#ID_WRKPLACE").append('<select id="WRK_LOC_CD' + aloc + '" name="WRK_LOC_CD' + aloc + '" onchange="chkWorkPlace();"><option value="">선택하세요</option></select>');
							$("#ID_WRKPLACE").append('<input type="hidden" id="WRK_LOC_ORD' + aloc + '" name="WRK_LOC_ORD' + aloc + '" value="' + aloc + '" />');
							$("#ID_WRKPLACE").append('</p>');
							
							for (var b = 0; b < response.length ; b ++)
							{
								sel_val = '';
								if (response[a][0] == response[b][3]) sel_val = ' selected ';
								$("#WRK_LOC_CD" + aloc).append('<option value="' + response[b][0] + '" ' + sel_val + ' >' + response[b][1] + '</option>');
							}
							
							//$("#WRK_LOC_CD" + aloc).val(response[a][3]);
							aloc++;
						}
						
					}
					
				}
	       	
    },
    error: function(jqXHR, textStatus, errorThrown){
        //console.log("The following error occured: "+textStatus, errorThrown);
    },
    complete: function(){}
		});
	}

	function goTempSave(idObj)
	{
		$("#form1").attr("method","post");
		$("#form1").attr("action","/front/apply/applyProcess");
		$("#form1").submit();
		//$("#" + idObj).click();
	}
	
	function goProcess()
	{
		$("#CAREER_FORM_COUNT").val(carrList);
		$("#FAMILY_FORM_COUNT").val(fmlyList);
		$("#WRITE_FORM_COUNT").val(wrteList);
		$("#PRIZE_FORM_COUNT").val(przeList);
		$("#LANGUAGE2_FORM_COUNT").val(lan2List);
		$("#LICENSE_FORM_COUNT").val(licsList);
		$("#SERVE_FORM_COUNT").val(srveList);
		$("#TECH_FORM_COUNT").val(techList);
		$("#EDUCATION_FORM_COUNT").val(educList);
		$("#TRAINING_FORM_COUNT").val(trngList);
		$("#SCHOOL_FORM_COUNT").val(schlList);
		$("#FINAL_SUBMIT").val('');
		$("#form1").attr("method","post");
		$("#form1").attr("action","/front/apply/applyProcess");
		$("#form1").submit();
	}
	
	function goApplySubmit()
	{
		if (confirm('최종제출을 하시겠습니까? 최종제출을 하시면 문구기억안남;;;'))
		{
			$("#CAREER_FORM_COUNT").val(carrList);
			$("#FAMILY_FORM_COUNT").val(fmlyList);
			$("#WRITE_FORM_COUNT").val(wrteList);
			$("#PRIZE_FORM_COUNT").val(przeList);
			$("#LANGUAGE2_FORM_COUNT").val(lan2List);
			$("#LICENSE_FORM_COUNT").val(licsList);
			$("#SERVE_FORM_COUNT").val(srveList);
			$("#TECH_FORM_COUNT").val(techList);
			$("#EDUCATION_FORM_COUNT").val(educList);
			$("#TRAINING_FORM_COUNT").val(trngList);
			$("#SCHOOL_FORM_COUNT").val(schlList);
			$("#FINAL_SUBMIT").val('submit');
			$("#form1").attr("method","post");
			$("#form1").attr("action","/front/apply/applyProcess");
			$("#form1").submit();
		}
		
	}
	
	
	// 각옵션별 기능함수
	
	// 학력 -- 온로드용 (부전공보여주기) - 초기화하면안대서리.썅
	function bodyOnLoadforSchSubMajor()
	{
		for (var a = 1 ;a <= schlList; a ++)
		{
			if (document.getElementById('SCH_SUB_MAJOR_TP_' + a))
			{
				if ( $("#SCH_SUB_MAJOR_TP_" + a + " option:selected").val() != '' && $("#SCH_SUB_MAJOR_TP_" + a + " option:selected").val() !=  '35' ) 
				{
					$("#id_sub_major_form_" + a).show();
				}
			}
		}
	}
	
	// 취득학점 처리
	function checkScore(code)
	{
		
		var v_sch_hakjum = $("#SCH_HAKJUM_" + code).val();
		var v_sch_max_hakjum = $("#SCH_MAX_HAKJUM_" + code + " option:selected").val();
		
		if (v_sch_hakjum != '' && v_sch_max_hakjum != '')
		{
			if ( v_sch_max_hakjum == '100' )
			{
				if ( v_sch_hakjum.match(/^[0-9]+$/) )
				{
					if ( Number(v_sch_hakjum) > 0 && Number(v_sch_hakjum) <= 100 )
					{
					}
					else
					{
						alert('취득학점을 확인하세요.[100점 까지만 입력가능합니다.]');
						$("#SCH_HAKJUM_" + code).val('');
						return 'error';
					}
				}
				else
				{
					alert('취득학점을 확인하세요.');
					$("#SCH_HAKJUM_" + code).val('');
					return 'error';
				}
					
			}
			else
			{
				if ( v_sch_hakjum.match(/^[0-9]+\.[0-9]{2}$/) )
				{
				}
				else
				{
					alert('취득학점을 확인하세요.[소숫점 둘째자리까지 입력하세요. 예)3.14]');
					$("#SCH_HAKJUM_" + code).val('');
					return 'error';
				}
				
			}
			
			if (Number(v_sch_hakjum) > Number(v_sch_max_hakjum) )
			{
				alert('취득학점을 확인하세요.');
				$("#SCH_HAKJUM_" + code).val('');
				$("#SCH_MAX_HAKJUM_" + code).val('');
				return 'error';
			}
		}
	}
	
	// 부전공 구분 액션
	
	function schCheckSubMajor(code)
	{
		
		//$("#SCH_SUB_MAJOR_TP" + code).change( function(){ schCheckSubMajor(code); });
		$("#id_sub_major_form_" + code).hide();
		$("#SCH_SUB_AFF_" + code).val('');
		$("#SCH_SUB_MAJOR_NM_" + code).val('');
		$("#SCH_SUB_MAJOR_CD_" + code).val('');
		
		if ($("#SCH_SUB_MAJOR_TP_" + code + " option:selected").val() != '' && $("#SCH_SUB_MAJOR_TP_" + code + " option:selected").val() != '35')
		{
			$("#id_sub_major_form_" + code).show();
		}
		
	}
	
	// 최종학력체크는 한곳만 가능하네요.
	function schCheckBoxConfirm(code)
	{
		
		//폼에 생성된 모든 학력사항을 확인하여 체크박스가 2개이상 체크되었는지 확인.
		var checkedCount = 0;
		//학력사항이 활성인지부터 확인후
		
		//-------------------------------------------------------------
			// 여기부턴 고딩필수
			//SCH_FGRD_TP_1
			
			if ($("#form1").find(':radio[name="SCH_TP_1"]:checked').val() == undefined)
			{
				alert('고등학교 또는 검정고시를 선택하세요.');
				return 'error';
			}
			
			// 고등학교 - 
			if ($("#form1").find(':radio[name="SCH_TP_1"]:checked').val() == '25' ) 
			{
				if ($("#SCH_CD_1").val() == '' || $("#SCH_JUYA_1").val() == '' || $("#SCH_BRANCH_TP_1").val() == '' || $("#SCH_LOC_1").val() == '' || $("#SCH_STDT1_1").val() == '' || $("#SCH_STDT2_1").val() == '' || $("#SCH_EDDT1_1").val() == '' || $("#SCH_EDDT2_1").val() == '' || $("#SCH_ETTP1_1").val() == '' || $("#SCH_ETTP2_1").val() == '' )
				{
					alert('고등학교 항목을 확인하세요.');
					return 'error';
				}
			}
			
			// 검정고시 - 
			if ( $(':radio[name="SCH_TP_1"]:checked').val() == '52' ) 
			{
				if ($("#SCH_EDDT1_1").val() == '' || $("#SCH_EDDT2_1").val() == '' || $("#SCH_EDDT3_1").val() == '' || $("#SCH_LOC_1").val() == '')
				{
					alert('검정고시 항목을 확인하세요.');
					return 'error';
				}
			}
		
		
		if (schlList > 1)
		{
			for (var a = 1 ;a <= schlList; a ++)
			{
				if (document.getElementById('SCH_FGRD_TP_' + a))
				{
					if ($("#SCH_FGRD_TP_" + a).is(':checked')) // 체크가 되었으면 카운트 증가
					{
						checkedCount++;
					}
				}
			}
			
			if (checkedCount > 1 || ( a > 1 && checkedCount == 0 ) )
			{
				alert('최종학력은 1개만 선택이 가능합니다.\n선택하지 않으셨다면 1개만 선택하세요.');
				if (code != undefined && code != '') $("#SCH_FGRD_TP_" + code).attr("checked",false);
				
				return 'error';
				
			}
			
		}
		return true;
	}
	
	// 고딩과 검딩 선택시 클리어
	function clearSchBox1()
	{
		$("#SCH_NM_1").val('');
		$("#SCH_CD_1").val('');
		$("#SCH_JUYA_1").val('');
		$("#SCH_BRANCH_TP_1").val('');
		$("#SCH_LOC_1").val('');
		$("#SCH_STDT1_1").val('');
		$("#SCH_STDT2_1").val('');
		
		$("#SCH_EDDT1_1").val('');
		$("#SCH_EDDT2_1").val('');
		$("#SCH_EDDT3_1").val('');
		
		$("#SCH_ETTP1_1").val('');
		$("#SCH_ETTP2_1").val('');
		
	}
	
	// 학력구분 선택시 학교명 클리어
	function clearSchNm(code)
	{
		$("#SCH_NM_" + code).val('');
		$("#SCH_CD_" + code).val('');
	}
	// 학생부 보이기
	function checkHakView(code)
	{
		//학생부작업 --- 결정안나씀 썅!
		if (code != 'onload')
		{
			if ($.trim($("#id_schl_list").html()) != '')
			{
				if (confirm('최종학력을 고등학교로 선택하셨습니다.\n입력하신 고등학교 이후 학력사항은 삭제 됩니다. 계속하시겠습니까?'))
				{
					$("#id_schl_list").empty();
				}	
				else
				{
					$("#SCH_FGRD_TP_1").attr("checked",false);
				}
			}
		}
		//$("#id_high_scool_hak").hide();
		$("#id_schooladd").show();
		
		
		if ($("#SCH_FGRD_TP_1").is(':checked') == true)
		{
			//$("#id_high_scool_hak").show();
			$("#id_schooladd").hide();
		}
	}
	
	// 검정고시와 학교선택
	function selSchoolType(code)
	{
	
		$("#id_table_school1").show();
		$("#id_table_school2").show();
		
		if (code == 'highschool')
		{
			$("#id_title_school1").html('학교명');
			$("#id_title_school2").html('재학기간');
		}
		
		if (code == 'blackgosi')
		{
			$("#id_title_school1").html('시험장소');
			$("#id_title_school2").html('합격일자');
		}
		
		$("#id_display_sch1").html($("#id_sch_type1_" + code).html());
		$("#id_display_sch2").html($("#id_sch_type2_" + code).html());
		
	}
	
	// 가족이 없으면 가족데이터 삭제 처리
	function fmlyAllDel(onload_flag)
	{
		$("#BTN_FMLY_ADD").attr('style','display:black');
		
		if ($("#FMLY_NONE_YN").is(':checked') == true)
		{
			///alert('===' + $("#id_fmly_list").html() + '===');
			// 가족사항에 폼이 있으면 경고!
			if (onload_flag != 'onload')
			{
				if ($.trim($("#id_fmly_list").html()) != '')
				{
					if(confirm('입력된 가족사항 항목또는 입력하시는 항목이 삭제됩니다. 계속하시겠습니까?'))
					{
						$("#id_fmly_list").empty();
						$("#BTN_FMLY_ADD").attr('style','display:none');
					}
					else
					{
						$("#FMLY_NONE_YN").prop('checked',false);
					}
				}
			}
			
			if ($.trim($("#id_fmly_list").html()) == '' ) $("#BTN_FMLY_ADD").attr('style','display:none');
			
		}
		
	}
	
	function fmlyCheckBoxConfirm()
	{
		//가족이 있던지 없을 체크하던지 둘중에 하나는 해라이~
		//$("#FMLY_NONE_YN").is(':checked')
		var checkedCount = 0;
		var firstValue = '';
		if (fmlyList > 1) //가족항목이 활성일때
		{
		
			for (var a = 1 ;a <= fmlyList; a ++)
			{
				if ($("#FMLY_REL_CD_" + a).length > 0)
				{
					checkedCount ++;
					//firstValue = $("#FMLY_REL_CD_" + a).val()
					if (checkedCount > 2) break;
				}
			}
			
			if (checkedCount == 0 && $("#FMLY_NONE_YN").is(':checked') == false)
			{
				return 'error';
			}
			
		}
		
		
		
		return true;
	}
	
	// --------------------- 병역사항 체크
	function armyCheckBoxConfirm()
	{
		/*
			Y = '필'
			N = '미필'
			E = '면제'
		*/
		if ($("#ARMY_YN_CD").length > 0 ) // 항목이 있을경우 
		{
		
			var checkArray = {	'ARMY_TP_CD':'군별',
													'ARMY_LVL_CD':'계급',
													'ARMY_FINISH_CD':'제대구분',
													'ARMY_STDT1':'병역기간',
													'ARMY_STDT2':'병역기간',
													'ARMY_STDT3':'병역기간',
													'ARMY_EDDT1':'병역기간',
													'ARMY_EDDT2':'병역기간',
													'ARMY_EDDT3':'병역기간',
													'ARMY_REASON':'면제사유'};
			var army_check_yn = $("#ARMY_YN_CD option:selected").val(); 									
			
			if (army_check_yn == '') return 'error';
	
			if (army_check_yn.match(/^Y|E$/))
			{
			
				for (var checkList in checkArray)
				{
					if ( 
								(army_check_yn == 'Y' && !checkList.match(/^ARMY_REASON$/)) || 
								(army_check_yn == 'E' && checkList.match(/^ARMY_REASON$/)) 
					  )
					{
						if ($("#" + checkList).val() == '')
						{
							return 'error';
						}
					}
				}
				
			}
			
			
		}
	}
	
	// --------------------- 어학능력
	function lan2CheckBoxConfirm()
	{
		var checkArr = new Array();
		var ca = 0;
		for (var a = 1 ;a <= lan2List; a ++)
		{
			if ($("#LANG2_CD_" + a).length > 0)
			{
				if ($("#LANG2_CD_" + a + " option:selected").val() != '')
				{
					 checkArr[ca] = $("#LANG2_CD_" + a + " option:selected").val();
					 ca ++;
				}
			}
		}
		if (has_duplicates(checkArr)) return 'error';
		
		return true;
	}
	
	// --------------------- 군대 작업
	
	function CheckArmy(code)
	{
		var ARMY_YN = $("#ARMY_YN_CD option:selected").val();
		DisableArmyForm();
		if (code != 'onload') ClearArmyForm();
		switch (ARMY_YN)
		{
			case 'Y' :
				$("#ARMY_TP_CD").attr('disabled',false);
				$("#ARMY_TP_NM").attr('disabled',false);
				$("#ARMY_LVL_NM").attr('disabled',false);
				$("#ARMY_LVL_CD").attr('disabled',false);
				$("#ARMY_FINISH_NM").attr('disabled',false);
				$("#ARMY_FINISH_CD").attr('disabled',false);
				$("#ARMY_STDT1").attr('disabled',false);
				$("#ARMY_STDT2").attr('disabled',false);
				$("#ARMY_STDT3").attr('disabled',false);
				$("#ARMY_EDDT1").attr('disabled',false);
				$("#ARMY_EDDT2").attr('disabled',false);
				$("#ARMY_EDDT3").attr('disabled',false);
				break;
			
			case 'N' :
				break;
				
			case 'E' :
				$("#ARMY_REASON").attr('disabled',false);
				break;
		}
	}
	
	function DisableArmyForm()
	{
		$("#ARMY_TP_CD").attr('disabled',true);
		$("#ARMY_TP_NM").attr('disabled',true);
		$("#ARMY_LVL_NM").attr('disabled',true);
		$("#ARMY_LVL_CD").attr('disabled',true);
		$("#ARMY_FINISH_NM").attr('disabled',true);
		$("#ARMY_FINISH_CD").attr('disabled',true);
		$("#ARMY_STDT1").attr('disabled',true);
		$("#ARMY_STDT2").attr('disabled',true);
		$("#ARMY_STDT3").attr('disabled',true);
		$("#ARMY_EDDT1").attr('disabled',true);
		$("#ARMY_EDDT2").attr('disabled',true);
		$("#ARMY_EDDT3").attr('disabled',true);
		$("#ARMY_REASON").attr('disabled',true);
	}
	
	function ClearArmyForm()
	{
		$("#ARMY_TP_CD").val('');
		$("#ARMY_TP_NM").val('');
		$("#ARMY_LVL_NM").val('');
		$("#ARMY_LVL_CD").val('');
		$("#ARMY_FINISH_NM").val('');
		$("#ARMY_FINISH_CD").val('');
		$("#ARMY_STDT1").val('');
		$("#ARMY_STDT2").val('');
		$("#ARMY_STDT3").val('');
		$("#ARMY_EDDT1").val('');
		$("#ARMY_EDDT2").val('');
		$("#ARMY_EDDT3").val('');
		$("#ARMY_REASON").val('');
		
	}
	
	function delFileList(code,seq)
	{
			
			$("#POPUP_APPL_IDX").val($("#APPL_IDX").val());
			$("#POPUP_PRJ_IDX").val($("#PRJ_IDX").val());
			$("#popupCode").val(code);
			
			var serializedData = $("#popupform1").serialize();
			//dataType:'json',
			$.ajax({
	    url: "/front/apply/FileUploadDeleteProcess",
	    type: "post",
	    data: serializedData,
	    success: function(response, textStatus, jqXHR){
					
	    },
	    error: function(jqXHR, textStatus, errorThrown){
	    		//alert(textStatus);
	        //console.log("The following error occured: "+textStatus, errorThrown);
	    },
	    complete: function(){
	    	
	    ///alert('삭제 완료!');	
	    }
	    	
			});
			
			$("#RSM_FILE_MSG_" + seq).empty();
			alert('삭제 되었습니다.');
		
	}
	
</script>

<div class="info-box">
<?=$front_resume_top?>
</div>

<!-- S: 비밀번호 설정 -->

<form name="form2" id="form2">
<input type="hidden" id="SN_PRJ_IDX" name="SN_PRJ_IDX" />
<input type="hidden" id="SN_RSM_IDX" name="SN_RSM_IDX" />
<input type="hidden" id="SN_APPL_IDX" name="SN_APPL_IDX" />
<input type="hidden" id="SN_UNIT_IDX" name="SN_UNIT_IDX" />
</form>
<form name="form1" id="form1" enctype="multipart/form-data">
<input type="hidden" id="ADMIN_FLAG" name="ADMIN_FLAG" value="<?=$ADMIN_FLAG?>" />
<input type="hidden" ID="FINAL_SUBMIT" name="FINAL_SUBMIT" />

<input type="hidden" ID="PRJ_IDX" name="PRJ_IDX" value="<?=$PRJ_IDX?>" />
<input type="hidden" ID="RSM_IDX" name="RSM_IDX" value="<?=$RSM_IDX?>" />
<input type="hidden" ID="APPL_IDX" name="APPL_IDX" value="<?=$APPL_IDX?>" />
<input type="hidden" id="APPLY_NO" name="APPLY_NO" value="<?=$APPLY_NO?>" />
<input type="hidden" id="FAMILY_FORM_COUNT" name="FAMILY_FORM_COUNT" />
<input type="hidden" id="CAREER_FORM_COUNT" name="CAREER_FORM_COUNT" />
<input type="hidden" id="WRITE_FORM_COUNT" name="WRITE_FORM_COUNT" />
<input type="hidden" id="PRIZE_FORM_COUNT" name="PRIZE_FORM_COUNT" />
<input type="hidden" id="LANGUAGE2_FORM_COUNT" name="LANGUAGE2_FORM_COUNT" />
<input type="hidden" id="LICENSE_FORM_COUNT" name="LICENSE_FORM_COUNT" />
<input type="hidden" id="COMPUTER_FORM_COUNT" name="COMPUTER_FORM_COUNT" value="<?=count($frmComputerDataList)?>" />
<input type="hidden" id="SERVE_FORM_COUNT" name="SERVE_FORM_COUNT" />
<input type="hidden" id="TECH_FORM_COUNT" name="TECH_FORM_COUNT" />
<input type="hidden" id="EDUCATION_FORM_COUNT" name="EDUCATION_FORM_COUNT" />
<input type="hidden" id="TRAINING_FORM_COUNT" name="TRAINING_FORM_COUNT" />
<input type="hidden" id="CONTENT_FORM_COUNT" name="CONTENT_FORM_COUNT" value="<?=count($frmContent)?>" />
<input type="hidden" id="FILE_FORM_COUNT" name="FILE_FORM_COUNT" value="<?=count($frmFile)?>" />
<input type="hidden" id="LANGUAGE_FORM_COUNT" name="LANGUAGE_FORM_COUNT" value="<?=count($lanData)?>" />
<input type="hidden" id="SCHOOL_FORM_COUNT" name="SCHOOL_FORM_COUNT" />
<input type="hidden" id="TEMP_SAVE_YN" name="TEMP_SAVE_YN" />


<input type="hidden" id="PHOTO_URL" id="PHOTO_URL" value="<?=$PHOTO_URL?>" />
<div id="dialog" title="유의사항" style="display:none"></div>
							
							<div class="h3-tit-box">
								<h3>비밀번호 설정</h3>
								<span>비밀번호는 영문 대소문자를 구분하며 최소 6자리 이상 입력해 주셔야 합니다.</span>
								<a href="javascript:openComment('password');" class="btn"><img src="<?=$FRONT_IMG_URL?>/img/board/table_btn01.gif" alt="작성 시 유의사항" /></a>
							</div>
							
							

							<table class="TbStyle01" summary="비밀번호 설정">
								<caption>비밀번호 설정</caption>
								  <colgroup>
								  <col width="15%" />
								  <col width="*" />
								  </colgroup>
								  <tbody>
									<tr>
										<th scope="row"><label for="user_pw">비밀번호</label> <span class="red">*</span></th>
										<td>
											<input class="b_input" type="password" name="USER_PW" id="USER_PW" value="" title="비밀번호입력" />
											<label class="error" for="USER_PW" generated="true" style="display:none;color:red;">error message</label>	
											<span> ※ 입사지원서 확인 및 수정,  합격자 발표에 사용 됩니다.</span>
										</td>
									</tr>
								  </tbody>
							</table>

							<!--div class="textR">
								<a href="javascript:goTempSave();"><img src="<?=$FRONT_IMG_URL?>/img/board/table_btn02.gif" alt="비밀번호 적용" /></a>
							</div-->
							<!-- E: 비밀번호 설정 -->

							<!-- S: 지원분야 -->
							<div class="h3-tit-box mgt30">
								<h3>지원분야</h3>
								<span>희망 지원분야를 선택하세요</span>
								<a href="javascript:openComment('unit');" class="btn"><img src="<?=$FRONT_IMG_URL?>/img/board/table_btn01.gif" alt="작성 시 유의사항" /></a>
							</div>
							<label class="error" for="UNIT_IDX_ORD1" generated="true" style="display:none;color:red;">error message</label>	
							<table class="TbStyle01" summary="지원분야">
								<caption>지원분야</caption>
								  <colgroup>
								  <col width="15%" />
								  <col width="*" />
								  <col width="15%" />
								  <col width="*" />
								  </colgroup>
								  <tbody>
									<tr>
										<th scope="row"><label for="user_kind">지원분야</label> <span class="red">*</span></th>
										<td>
											<input type="hidden" id="UNIT_IDX_ORD1" name="UNIT_IDX_ORD1" value="1" />
											<?=$SELECTBOX_UNIT_IDX1?>
										</td>
										<th scope="row"><label for="area">희망근무지</label></th>
										<td>
											<div id="ID_WRKPLACE"></div>
										</td>
									</tr>
								  </tbody>
							</table>
							<!--div class="textR">
								<label class="error" for="UNIT_IDX1" generated="true" style="display:none;color:red;">error message</label>	
								<a href="javascript:goTempSave('SUBMIT_BUTTON');"><img src="<?=$FRONT_IMG_URL?>/img/board/table_btn03.gif" alt="중간 저장" /></a>
							</div-->
							<!-- E: 지원분야 -->

							<!-- S: 기본 신상정보 -->
							<div class="h3-tit-box mgt30">
								<h3>기본 신상정보</h3>
								<span>신상정보를 입력해 주세요.</span>
								<a href="javascript:openComment('personal');" class="btn"><img src="<?=$FRONT_IMG_URL?>/img/board/table_btn01.gif" alt="작성 시 유의사항" /></a>
							</div>

							<table class="TbStyle01" summary="기본 신상정보">
								<caption>기본 신상정보</caption>
								  <colgroup>
								  <col width="15%" />
								  <col width="*" />
								  <col width="12%" />
								  <col width="14%" />
								  <col width="14%" />
								  <col width="10%" />
								  <col width="29%" />
								  </colgroup>
								  <tbody>
									<tr>
										<td colspan="2" rowspan="5" class="pic">
										
											<div class="pic-box">
												<img src="<?=$FRONT_IMG_URL?>/img/board/no_pic.gif" alt="사진을 등록해주세요" id="id_photo_image" width="130" height="150" />
												<p>
													
													<input type="hidden" id="PHOTO_YN" name="PHOTO_YN" value="<?=$PHOTO_YN?>" />
													<a href="javascript:searchPhotoUpload();"><img src="<?=$FRONT_IMG_URL?>/img/board/btn_pic_app.gif" alt="등록/수정" /></a>
													<a href="javascript:PhotoDelete();"><img src="<?=$FRONT_IMG_URL?>/img/board/btn_del.gif" alt="삭제" /></a>
												</p>
											</div>
										
										</td>
										<th scope="row"><label for="user_name">이름</label> <span class="red">*</span></th>
										<td colspan="4">
											<input type="hidden" name="NAMEKOR" id="NAMEKOR" value="<?=$NAMEKOR?>"  />
											<?=$NAMEKOR?><span class="space">/</span>
											
											<label for="user_name">한문</label> <input class="b_input" type="text" name="NAMECHA" id="NAMECHA" value="<?=$NAMECHA?>" style="width:100px;" maxlength="10" />
											<span class="space">/</span>
											
											<label for="user_name_eng">영문</label> <input class="b_input" type="text" name="NAMEENG1" id="NAMEENG1" value="<?=$NAMEENG1?>" style="width:50px;" maxlength="50" onblur="javascript:CheckData(this,'engdigits');" />
											<input class="b_input" type="text" name="NAMEENG2" id="NAMEENG2" value="<?=$NAMEENG2?>" style="width:120px;" maxlength="50"  onblur="javascript:CheckData(this,'engdigits');"  />
										</td>
									</tr>
									<tr>
										<th scope="row"><label for="birth_year">생년월일</label> <span class="red">*</span></th>
										<td colspan="4">
											<input class="b_input" type="text" name="BIRTH_DT1" id="BIRTH_DT1" value="<?=$BIRTH_DT1?>" style="width:25px;border:0px;" readonly  /> <label for="birth_year">년</label>
											<input class="b_input" type="text" name="BIRTH_DT2" id="BIRTH_DT2" value="<?=$BIRTH_DT2?>" style="width:15px;border:0px;" readonly /> <label for="birth_month">월</label>
											<input class="b_input" type="text" name="BIRTH_DT3" id="BIRTH_DT3" value="<?=$BIRTH_DT3?>" style="width:15px;border:0px;" readonly /> <label for="birth_day">일</label>
											(
												<input type="radio" class="radio" name="BIRTH_TP" id="BIRTH_TP" value="S" <?=$BIRTH_TP == 'S' ? ' checked ' : ''; ?> />
												<label for="lunar">양력</label>
												<input type="radio" class="radio" name="BIRTH_TP" id="BIRTH_TP" value="L" <?=$BIRTH_TP == 'L' ? ' checked ' : ''; ?> />
												<label for="solar">음력</label>
											)
										</td>
									</tr>
									<tr>
										<th scope="row"><label for="address">주소</label> <span class="red">*</span></th>
										<td colspan="4">
											<p class="mgb5">
											<input class="b_input" type="text" name="ZIPCODE1" id="ZIPCODE1" value="<?=$ZIPCODE1?>" style="width:30px;" readonly     />-
											<input class="b_input" type="text" name="ZIPCODE2" id="ZIPCODE2" value="<?=$ZIPCODE2?>" style="width:30px;" readonly   />
											<a href="javascript:searchAddress();"><img src="<?=$FRONT_IMG_URL?>/img/board/btn_address.gif" alt="주소 검색" style="cursor:hand;" /></a>
											</p>
											<input class="b_input" type="text" name="ADDRESS1" id="ADDRESS1" value="<?=$ADDRESS1?>" style="width:100px;" readonly  />
											<input class="b_input" type="text" name="ADDRESS2" id="ADDRESS2" value="<?=$ADDRESS2?>" style="width:250px;" maxlength="50" />
										</td>
									</tr>
									<tr>
										<th scope="row"><label for="user_phone_01">전화번호</label> <span class="red">*</span></th>
										<td colspan="2">
											<?=$SELECTBOX_TEL?> -
											<input class="b_input" type="text" name="TEL2" id="TEL2" value="<?=$TEL2?>" maxlength="4" style="width:45px;" /> -
											<input class="b_input" type="text" name="TEL3" id="TEL3" value="<?=$TEL3?>" maxlength="4" style="width:45px;" />
										</td>
										<th scope="row"><label for="user_mobile_01">휴대폰</label> <span class="red">*</span></th>
										<td>
											<?=$SELECTBOX_HTEL?> -
											<input class="b_input" type="text" name="HTEL2" id="HTEL2" value="<?=$HTEL2?>" maxlength="4" style="width:45px;" /> -
											<input class="b_input" type="text" name="HTEL3" id="HTEL3" value="<?=$HTEL3?>" maxlength="4" style="width:45px;" />
										</td>
									</tr>
									<tr>
										<th scope="row"><label for="user_mail">이메일</label> <span class="red">*</span></th>
										<td colspan="4">
											<input class="b_input" type="text" name="EMAIL" id="EMAIL" value="<?=$EMAIL?>" style="width:95%;" maxlength="80" />
										</td>
									</tr>
									<tr>
										<th scope="row"><label for="marry_no">결혼여부</label> <span class="red">*</span></th>
										<td colspan="3">
											<input type="radio" class="radio" name="MARRY_YN" id="MARRY_YN" value="Y" <?=$MARRY_YN == 'N' ? ' checked ' : ''; ?> />
											<label for="marry_no">미혼</label>
											<input type="radio" class="radio" name="MARRY_YN" id="MARRY_YN" value="N" <?=$MARRY_YN == 'Y' ? ' checked ' : ''; ?> />
											<label for="marry">기혼</label>
										</td>
										<th scope="row"><label for="religion">종교</label> <span class="red">*</span></th>
										<td colspan="2">
											<input class="b_input" type="text" name="RELIGION" id="RELIGION" value="<?=$RELIGION?>" style="width:95%;" maxlength="50" />
										</td>
									</tr>
									<tr>
										<th scope="row"><label for="hobby">취미</label> <span class="red">*</span></th>
										<td colspan="3">
											<input class="b_input" type="text" name="HOBBY" id="HOBBY" value="<?=$HOBBY?>" style="width:95%;" maxlength="50" />
										</td>
										<th scope="row"><label for="ability">특기</label> <span class="red">*</span></th>
										<td colspan="2">
											<input class="b_input" type="text" name="FORTE" id="FORTE" value="<?=$FORTE?>" style="width:95%;" maxlength="50" />
										</td>
									</tr>
									<tr valign="top">
										<th scope="row"><label for="target">보훈대상</label> <span class="red">*</span></th>
										<td colspan="3">
											<?=$SELECTBOX_BOHUN_TP_CD?><input type="hidden" id="BOHUN_TP_NM" name="BOHUN_TP_NM" value="<?=$BOHUN_TP_NM?>" />
											<div id="id_BOHUNLIST" style="display:none;" >
											가점 : <?=$SELECTBOX_BOHUN_SCORE_CD?><input type="hidden" id="BOHUN_SCORE_NM" name="BOHUN_SCORE_NM" value="<?=$BOHUN_SCORE_NM?>" />
											번호 : <input class="b_input" type="text" id="BOHUN_NUM" name="BOHUN_NUM" style="width:78px;" value="<?=$BOHUN_NUM?>" maxlength="25" />
											</div>
										</td>
										<th scope="row"><label for="hindrance_01">장애여부</label> <span class="red">*</span></th>
										<td  valign="top" colspan="2">
											<?=$SELECTBOX_PSN_OBSTACLE_TP_CD?><input type="hidden" id="PSN_OBSTACLE_TP_NM" name="PSN_OBSTACLE_TP_NM" value="<?=$PSN_OBSTACLE_TP_NM?>" />
											<div id="id_OBSTACLELIST" style="display:none;" >
											장애등급 : <?=$SELECTBOX_PSN_OBSTACLE_LVL_CD?><input type="hidden" id="PSN_OBSTACLE_LVL_NM" name="PSN_OBSTACLE_LVL_NM" value="<?=$PSN_OBSTACLE_LVL_NM?>" />
											사유 : <input class="b_input" type="text" name="PSN_OBSTACLE_TP_REASON" id="PSN_OBSTACLE_TP_REASON" value="<?=$PSN_OBSTACLE_TP_REASON?>" style="width:80px;" maxlength="50" />
											</div>
										</td>
									</tr>
									<tr>
										<th scope="row"><label for="user_height">신체조건</label></th>
										<td colspan="3">
											<label for="user_height">신장</label> <input class="b_input" type="text" name="PSN_HEIGHT" id="PSN_HEIGHT" value="<?=$PSN_HEIGHT?>" style="width:40px;" maxlength="3" /> cm
											<span class="space">/</span>
											<label for="user_weight">체중</label> <input class="b_input" type="text" name="PSN_WEIGHT" id="PSN_WEIGHT" value="<?=$PSN_WEIGHT?>" style="width:40px;" maxlength="3" /> kg
										</td>
										<th scope="row"><label for="eye_left">시력(교정)</label></th>
										<td colspan="2">
											<label for="eye_left">좌</label> <input class="b_input" type="text" name="PSN_LSIGHT" id="PSN_LSIGHT" value="<?=$PSN_LSIGHT?>" style="width:20px;" maxlength="3" />
											<span class="space">/</span>
											<label for="eye_right">우</label> <input class="b_input" type="text" name="PSN_RSIGHT" id="PSN_RSIGHT" value="<?=$PSN_RSIGHT?>" style="width:20px;" maxlength="3" />
											(색맹여부 : 
											<input type="radio" class="radio" name="PSN_CLRBLND_YN" id="PSN_CLRBLND_YN" value="Y" <?=$PSN_CLRBLND_YN == 'Y' ? ' checked ' : ''; ?> />
												<label for="yes">유</label>
												<input type="radio" class="radio" name="PSN_CLRBLND_YN" id="PSN_CLRBLND_YN" value="N" <?=$PSN_CLRBLND_YN == 'N' ? ' checked ' : ''; ?> />
												<label for="no">무</label>
											)
										</td>
									</tr>
									<tr>
										<th scope="row"><label for="radio01">국민기초생활<br />보장법 대상자</label> <span class="red">*</span></th>
										<td colspan="6">
											<input type="radio" class="radio" name="PSN_LOWINCOME_YN" id="PSN_LOWINCOME_YN" value="Y" <?=$PSN_LOWINCOME_YN == 'Y' ? ' checked ' : ''; ?> />
											<label for="radio01">해당</label>
											<input type="radio" class="radio" name="PSN_LOWINCOME_YN" id="PSN_LOWINCOME_YN" value="N" <?=$PSN_LOWINCOME_YN == 'N' ? ' checked ' : ''; ?> />
											<label for="radio02">비해당</label>
											<span class="space"></span>
											<span> ※ 국민기초생활보장법 및 한부모가족지원법에 따른 저소득층</span>
										</td>
									</tr>
								  </tbody>
							</table>
							<label class="error" for="PSN_MSG" generated="true" style="display:none;color:red;">error message</label>	
				
							<!--div class="textR">
								
								<a href="javascript:goTempSave('SUBMIT_BUTTON');"><img src="<?=$FRONT_IMG_URL?>/img/board/table_btn03.gif" alt="중간 저장" /></a>
							</div-->
							<!-- E: 기본 신상정보 -->



<? 	if ($rsmdisplay[0]->ARMY_USE_YN == 'Y' ) { ?>
							<!-- S: 병역사항 -->
							<div class="h3-tit-box mgt30">
								<h3>병역사항</h3>
								<span>남자의 경우 병역필 또는 면제자에 한합니다.</span>
								<a href="javascript:openComment('army');" class="btn"><img src="<?=$FRONT_IMG_URL?>/img/board/table_btn01.gif" alt="작성 시 유의사항" /></a>
							</div>

							<table class="TbStyle01" summary="병역사항">
								<caption>병역사항</caption>
								  <colgroup>
								  <col width="15%" />
								  <col width="*" />
								  <col width="12%" />
								  <col width="*" />
								  <col width="10%" />
								  <col width="12%" />
								  <col width="10%" />
								  <col width="10%" />
								  </colgroup>
								  <tbody>
									<tr>
										<th scope="row"><label for="user_army01">군필여부</label> <span class="red">*</span></th>
										<td>
											<?=$SELECTBOX_ARMY_YN_CD?>
											<input type="hidden" name="ARMY_YN_NM" id="ARMY_YN_NM" value="<?=$ARMY_YN_NM?>" />
										</td>
										<th scope="row"><label for="user_army02">군별</label> </th>
										<td>
											<?=$SELECTBOX_ARMY_TP_CD?>
											<input type="hidden" name="ARMY_TP_NM" id="ARMY_TP_NM" value="<?=$ARMY_TP_NM?>" />
										</td>
										<th scope="row"><label for="user_army03">계급</label> </th>
										<td>
											<?=$SELECTBOX_ARMY_LVL_CD?>
											<input type="hidden" name="ARMY_LVL_NM" id="ARMY_LVL_NM" value="<?=$ARMY_LVL_NM?>" />
										</td>
										<th scope="row"><label for="user_army04">제대구분</label> </th>
										<td>
											<?=$SELECTBOX_ARMY_FINISH_CD?>
											<input type="hidden" name="ARMY_FINISH_NM" id="ARMY_FINISH_NM" value="<?=$ARMY_FINISH_NM?>" />
										</td>
									</tr>
									<tr>
										<th scope="row"><label for="user_army05_1">병역기간</label> </th>
										<td colspan="3">
											<input class="b_input" type="text" name="ARMY_STDT1" id="ARMY_STDT1" value="<?=$ARMY_STDT1?>" style="width:30px;" maxlength="4" onblur="CheckFormDate('ARMY_STDT','')&CheckTermDate('ARMY','');" /> <label for="user_army05_1">년</label>
											<input class="b_input" type="text" name="ARMY_STDT2" id="ARMY_STDT2" value="<?=$ARMY_STDT2?>" style="width:20px;" maxlength="2" onblur="javascript:setNum2str(this)&CheckFormDate('ARMY_STDT','')&CheckTermDate('ARMY','');" /> <label for="user_army05_2">월</label>
											<input class="b_input" type="text" name="ARMY_STDT3" id="ARMY_STDT3" value="<?=$ARMY_STDT3?>" style="width:20px;" maxlength="2" onblur="javascript:setNum2str(this)&CheckFormDate('ARMY_STDT','')&CheckTermDate('ARMY','');" /> <label for="user_army05_3">일</label> ~ 
											<input class="b_input" type="text" name="ARMY_EDDT1" id="ARMY_EDDT1" value="<?=$ARMY_EDDT1?>" style="width:30px;" maxlength="4" onblur="CheckFormDate('ARMY_EDDT','')&CheckTermDate('ARMY','');" /> <label for="user_army05_4">년</label>
											<input class="b_input" type="text" name="ARMY_EDDT2" id="ARMY_EDDT2" value="<?=$ARMY_EDDT2?>" style="width:20px;" maxlength="2" onblur="javascript:setNum2str(this)&CheckFormDate('ARMY_EDDT','')&CheckTermDate('ARMY','');" /> <label for="user_army05_5">월</label>
											<input class="b_input" type="text" name="ARMY_EDDT3" id="ARMY_EDDT3" value="<?=$ARMY_EDDT3?>" style="width:20px;" maxlength="2" onblur="javascript:setNum2str(this)&CheckFormDate('ARMY_EDDT','')&CheckTermDate('ARMY','');" /> <label for="user_army05_6">일</label>
										</td>
										<th scope="row"><label for="user_army06">면제사유</label></th>
										<td colspan="3">
											<input class="b_input" type="text" name="ARMY_REASON" id="ARMY_REASON" value="<?=$ARMY_REASON?>" style="width:200px;" title="면제사유입력" maxlength="50" />
										</td>
									</tr>
									
								  </tbody>
							</table>

							<div class="textR">
								<a href="javascript:goProcess();"><img src="<?=$FRONT_IMG_URL?>/img/board/table_btn03.gif" alt="중간 저장" /></a>
							</div>
							<!-- E: 병역사항 -->
<? } ?>



<? 
	/* 
		가족사항 
		FAMILY_USE_YN == 'Y'
	*/
	if ($rsmdisplay[0]->FAMILY_USE_YN == 'Y') { 
?>


<!-- S: 가족사항 -->

			<div class="h3-tit-box mgt30">
			<h3>가족사항</h3>
			<span>가족사항이 없을 경우만 체크하세요. 입력사항이 있는 경우 반드시 입력해 주시기 바랍니다.</span>
			<a href="javascript:openComment('family');" class="btn"><img src="<?=$FRONT_IMG_URL?>/img/board/table_btn01.gif" alt="작성 시 유의사항" /></a>
			</div>
			
			<table class="TbStyle01" summary="가족사항 여부">
			<caption>가족사항 여부</caption>
			<colgroup>
			<col width="15%" />
			<col width="*" />
			</colgroup>
			<tbody>
			<tr>
			<th scope="row"><label for="family_none">가족사항 여부</label> <span class="red">*</span></th>
			<td>
			<input type="checkbox" class="checkbox" name="FMLY_NONE_YN" id="FMLY_NONE_YN" value="Y" <?=$FMLY_NONE_YN == 'Y' ? ' checked ' : ''; ?> onclick="fmlyAllDel();" />
			<label for="family_none"><span>가족사항 없음</span></label>
			</td>
			</tr>
			</tbody>
			</table>
			<table class="TbStyle01" summary="가족사항">
			<caption>가족사항</caption>
			<colgroup>
			<col width="15%" />
			<col width="*" />
			<col width="6%" />
			<col width="*" />
			<col width="10%" />
			<col width="*" />
			<col width="10%" />
			<col width="*" />
			<col width="10%" />
			<col width="*" />
			</colgroup>
			<thead>
			<tr>
			<th scope="col">관계</th>
			<th scope="col">성명</th>
			<th scope="col">연령</th>
			<th scope="col">학력</th>
			<th scope="col">직업</th>
			<th scope="col">직장명</th>
			<th scope="col">직위</th>
			<th scope="col">동거여부</th>
			<th scope="col">부양여부</th>
			<th scope="col">삭제</th>
			</tr>
			</thead>
			</table>
			
			<div id="id_fmly_list">
			
			</div>
			
			<div class="textR">
			<a href="javascript:goProcess();"><img src="<?=$FRONT_IMG_URL?>/img/board/table_btn03.gif" alt="중간 저장" /></a>
			<a href="javascript:addFormData('fmly');"><img src="<?=$FRONT_IMG_URL?>/img/board/btn_add.gif" alt="추가" id="BTN_FMLY_ADD" /></a>
			</div>
			<!-- E: 가족사항 -->


<?
	}
?>






<? 
	/* 
		학력사항에 관련된 항목입니다. 
		SCHOOL_USE_YN == 'Y'
	*/
	if ($rsmdisplay[0]->SCHOOL_USE_YN == 'Y') { 
?>



<!-- S: 학력사항 -->
							<div class="h3-tit-box mgt30">
								<h3>학력사항</h3>
								<a href="javascript:openComment('school');" class="btn"><img src="<?=$FRONT_IMG_URL?>/img/board/table_btn01.gif" alt="작성 시 유의사항" /></a>
							</div>

							<table class="TbStyle01" summary="학력사항">
								<caption>학력사항</caption>
								  <colgroup>
								  <col width="15%" />
								  <col width="*" />
								  </colgroup>
								  <tbody>
									<tr>
										<th scope="row" colspan="2" class="left">
											
											<div style="text-align:left;float:left">고등학교&검정고시</div>
											<div style="text-align:right">
												<input type="checkbox" class="checkbox" name="SCH_FGRD_TP_1" id="SCH_FGRD_TP_1" value="Y" <?=$SCH_FGRD_TP_1 == 'Y' ? ' checked ' : ''; ?> onclick="javascript:checkHakView()" />
												<label for="last_academic">최종학력일 경우 체크</label>
											</div>
											
										</th>
									</tr>
									<tr>
										<th scope="row"><label for="school_name">학교구분</label></th>
										<td>
											<input type="radio" onclick="javascript:selSchoolType('highschool')&clearSchBox1();" class="radio" id="SCH_TP_1" name="SCH_TP_1" value="25" <?=$SCH_TP_1 == '25' ? ' checked ' : ''; ?>  />고등학교
											&nbsp;
											<input type="radio" onclick="javascript:selSchoolType('blackgosi')&clearSchBox1();" class="radio" id="SCH_TP_1" name="SCH_TP_1" value="52" <?=$SCH_TP_1 == '52' ? ' checked ' : ''; ?>  />검정고시
										</td>
									</tr>
									<tr id="id_table_school1" style="display:none">
										<th scope="row"><label for="school_name"><div id="id_title_school1">학교명</div></label></th>
										<td><div id="id_display_sch1"></div></td>
									</tr>
									<tr id="id_table_school2" style="display:none">
										<th scope="row"><label for="school_name"><div id="id_title_school2">재학기간</div></label></th>
										<td><div id="id_display_sch2"></div></td>
									</tr>
								  </tbody>
							</table>
							
							<div id="id_high_scool_hak" style="display:none">
							<div class="point-txt">
								※ 최종학력이 고등학교 졸업일 경우 아래를 입력해 주시면 됩니다.
							</div>

							<table class="TbStyle01" summary="최종학력이 고등학교 졸업일 경우">
								<caption>최종학력이 고등학교 졸업일 경우</caption>
								  <colgroup>
								  <col width="15%" />
								  <col width="*" />
								  <col width="15%" />
								  <col width="25%" />
								  <col width="15%" />
								  </colgroup>
								  <thead>
									<tr>
										<th scope="col">성적구분 <span class="red">*</span></th>
										<td colspan="4">
											<div class="txt-box">
												<ul>
													<li>
														<input type="radio" class="radio" name="" id="standard_01" value="" />
														<label for="standard_01">등급기준</label>
													</li>
													<li>
														<input type="radio" class="radio" name="" id="standard_02" value="" />
														<label for="standard_02">석차기준</label>
													</li>
													<li>
														<input type="radio" class="radio" name="" id="standard_03" value="" />
														<label for="standard_03">점수기준</label>
													</li>
												</ul>
												<p>※ 성적입력방법(생활기록부 참조) 확인 후 입력 방법에 따라 선택해 주시기 바랍니다.</p>
												<p>※ 내신등급의 경우 산식에 의한 계산 후 소수점 두자리 까지 입력</p>
											</div>
										</td>
									</tr>
									<tr>
										<th scope="col">학년</th>
										<th scope="col">1학기 평균등급(등수)/재적수</th>
										<th scope="col">1학기 평균점수</th>
										<th scope="col">2학기 평균등급(등수)/재적수</th>
										<th scope="col" class="last">2학기 평균점수</th>
									</tr>
								  </thead>
								  <tbody>
									<tr>
										<th scope="row">1학년</th>
										<td class="center">
											<input class="b_input" type="text" name="" id="" value="" style="width:50px;" /><span class="space">/</span>
											<input class="b_input" type="text" name="" id="" value="" style="width:50px;" />
										</td>
										<td><input class="b_input" type="text" name="" id="" value="" style="width:70%;" /> 점</td>
										<td class="center">
											<input class="b_input" type="text" name="" id="" value="" style="width:50px;" /><span class="space">/</span>
											<input class="b_input" type="text" name="" id="" value="" style="width:50px;" />
										</td>
										<td><input class="b_input" type="text" name="" id="" value="" style="width:70%;" /> 점</td>
									</tr>
									<tr>
										<th scope="row">2학년</th>
										<td class="center">
											<input class="b_input" type="text" name="" id="" value="" style="width:50px;" /><span class="space">/</span>
											<input class="b_input" type="text" name="" id="" value="" style="width:50px;" />
										</td>
										<td><input class="b_input" type="text" name="" id="" value="" style="width:70%;" /> 점</td>
										<td class="center">
											<input class="b_input" type="text" name="" id="" value="" style="width:50px;" /><span class="space">/</span>
											<input class="b_input" type="text" name="" id="" value="" style="width:50px;" />
										</td>
										<td><input class="b_input" type="text" name="" id="" value="" style="width:70%;" /> 점</td>
									</tr>
									<tr>
										<th scope="row">3학년</th>
										<td class="center">
											<input class="b_input" type="text" name="" id="" value="" style="width:50px;" /><span class="space">/</span>
											<input class="b_input" type="text" name="" id="" value="" style="width:50px;" />
										</td>
										<td><input class="b_input" type="text" name="" id="" value="" style="width:70%;" /> 점</td>
										<td class="center">
											<input class="b_input" type="text" name="" id="" value="" style="width:50px;" /><span class="space">/</span>
											<input class="b_input" type="text" name="" id="" value="" style="width:50px;" />
										</td>
										<td><input class="b_input" type="text" name="" id="" value="" style="width:70%;" /> 점</td>
									</tr>
								  </tbody>
							</table>
							</div>
							<div id="id_schl_list">
								<?
									//foreach ($schlRs as $key => $schlList)
									$schlRsCount = count($schlRs);
									if ($schlRsCount >= 2) {
									for ($schKeyIdx = 1; $schKeyIdx < $schlRsCount ; $schKeyIdx++)
									{
										$schlIdx = $schKeyIdx + 1;
								?>
								<table class="TbStyle01" summary="학력사항" id="id_schl_box_set_<?=$schlIdx?>">
								<caption>학력사항</caption>
								  <colgroup>
								  <col width="15%" />
								  <col width="*" />
								  <col width="10%" />
								  </colgroup>
								  <tbody>
								  <tr>
								  	<th scope="row">학력구분</th>
								  	<td colspan="2">
								  		<div style="text-align:left;float:left"><?=${'frmSCH_TP_' . $schlIdx}?> 학력구분 먼저 선택하세요.</div>
								  		<div style="text-align:right">
											<input type="checkbox" class="checkbox" name="SCH_FGRD_TP_<?=$schlIdx?>" id="SCH_FGRD_TP_<?=$schlIdx?>" value="Y" <?=$schlRs[$schKeyIdx]->SCH_FGRD_TP == 'Y' ? ' checked ' : ''; ?> />
											<label for="last_academic">최종학력일 경우 체크</label>
											</div>
								  	</td>
									</tr>
									<tr>
										<th scope="row"><label for="school_name_02">학교명</label></th>
										<td colspan=2>
											<input type="hidden" name="SCH_SEQ_<?=$schlIdx?>" id="SCH_SEQ_<?=$schlIdx?>" value="<?=$schlRs[$schKeyIdx]->SCH_SEQ?>" />
											<input class="b_input" type="text" name="SCH_NM_<?=$schlIdx?>" id="SCH_NM_<?=$schlIdx?>" value="<?=$schlRs[$schKeyIdx]->SCH_NM?>" title="학교명입력" readonly />
											<input type="hidden" size="10" id="SCH_CD_<?=$schlIdx?>" name="SCH_CD_<?=$schlIdx?>" value="<?=$schlRs[$schKeyIdx]->SCH_CD?>">
											<img src="<?=$FRONT_IMG_URL?>/img/board/btn_search.gif" alt="검색" id="BTN_SEARCH_SCHOOL_<?=$schlIdx?>" name="BTN_SEARCH_SCHOOL_<?=$schlIdx?>" />
											<?=${'frmSCH_JUYA_' . $schlIdx}?>
											<?=${'frmSCH_BRANCH_TP_' . $schlIdx}?>
											<?=${'frmSCH_LOC_' . $schlIdx}?>
										</td>
										
									</tr>
									<tr>
										<th scope="row"><label for="school_term_01_01">재학기간</label></th>
										<td>
											<input class="b_input" type="text" name="SCH_STDT1_<?=$schlIdx?>" id="SCH_STDT1_<?=$schlIdx?>" value="<?=$schlRs[$schKeyIdx]->SCH_STDT1?>" style="width:30px;" maxlength="4" /> <label for="">년</label>
											<input class="b_input" type="text" name="SCH_STDT2_<?=$schlIdx?>" id="SCH_STDT2_<?=$schlIdx?>" value="<?=$schlRs[$schKeyIdx]->SCH_STDT2?>" style="width:20px;" maxlength="2" /> <label for="">월</label>
											<?=${'frmSCH_ETTP1_' . $schlIdx}?> ~ 
											<input class="b_input" type="text" name="SCH_EDDT1_<?=$schlIdx?>" id="SCH_EDDT1_<?=$schlIdx?>" value="<?=$schlRs[$schKeyIdx]->SCH_EDDT1?>" style="width:30px;" maxlength="4" /> <label for="">년</label>
											<input class="b_input" type="text" name="SCH_EDDT2_<?=$schlIdx?>" id="SCH_EDDT2_<?=$schlIdx?>" value="<?=$schlRs[$schKeyIdx]->SCH_EDDT2?>" style="width:20px;" maxlength="2" /> <label for="">월</label>
											<?=${'frmSCH_ETTP2_' . $schlIdx}?>
										</td>
										<td rowspan="2" class="center Lline"><img id="SCHL_DEL_<?=$schlIdx?>" name="SCHL_DEL_<?=$schlIdx?>" src="<?=$FRONT_IMG_URL?>/img/board/btn_del.gif"  alt="삭제"  /></td>
									</tr>
									<tr>
										<th scope="row">전공 및 학점</th>
										<td>
											
											<ul>
												<li>
											
													<div style="width:50px;float:left">전공</div>
													<div style="width:100px;float:left">계열 학과(전공)</div>
													<?=${'frmSCH_AFF_' . $schlIdx}?>
													
													<input type="hidden" size="10" id="SCH_MAJOR_CD_<?=$schlIdx?>" name="SCH_MAJOR_CD_<?=$schlIdx?>" value="<?=$schlRs[$schKeyIdx]->SCH_MAJOR_CD?>" />
													<input class="b_input" type="text" name="SCH_MAJOR_NM_<?=$schlIdx?>" id="SCH_MAJOR_NM_<?=$schlIdx?>" value="<?=$schlRs[$schKeyIdx]->SCH_MAJOR_NM?>" title="전공학과입력" readonly />
													<img src="<?=$FRONT_IMG_URL?>/img/board/btn_search.gif" alt="검색" id="BTN_SEARCH_MAJOR_<?=$schlIdx?>" name="BTN_SEARCH_MAJOR_<?=$schlIdx?>" />
												</li>
												<li>
													<div style="width:50px;float:left"></div>
													<div style="width:60px;float:left">취득학점</div>
													<input class="b_input" type="text" name="SCH_HAKJUM_<?=$schlIdx?>" id="SCH_HAKJUM_<?=$schlIdx?>" value="<?=$schlRs[$schKeyIdx]->SCH_HAKJUM?>" style="width:30px" maxlength="4" title="취득학점입력"  />
													<span class="space">/</span>
													<?=${'frmSCH_MAX_HAKJUM_' . $schlIdx}?>
													&nbsp;&nbsp;이수학점
													<input class="b_input" type="text" name="SCH_ISU_HAKJUM_<?=$schlIdx?>" id="SCH_ISU_HAKJUM_<?=$schlIdx?>" value="<?=$schlRs[$schKeyIdx]->SCH_ISU_HAKJUM?>" maxlength="4" style="width:40px;" title="이수학점입력" />
												</li>
												<li>
													<div style="width:50px;float:left">부전공</div>
													<div style="width:100px;float:left">구분 선택</div>
													<?=${'frmSCH_SUB_MAJOR_TP_' . $schlIdx}?>
												</li>
												<li id="id_sub_major_form_<?=$schlIdx?>" style="display:none">
													
													<div style="width:50px;float:left">부전공</div>
													<div style="width:100px;float:left">계열 학과(전공)</div>
													
													<?=${'frmSCH_SUB_AFF_' . $schlIdx}?>
													<input class="b_input" type="text" name="SCH_SUB_MAJOR_NM_<?=$schlIdx?>" id="SCH_SUB_MAJOR_NM_<?=$schlIdx?>" value="<?=$schlRs[$schKeyIdx]->SCH_SUB_MAJOR_NM?>" title="부/복수 전공 학과입력" readonly />
													<input type="hidden" size="10" id="SCH_SUB_MAJOR_CD_<?=$schlIdx?>" name="SCH_SUB_MAJOR_CD_<?=$schlIdx?>" value="<?=$schlRs[$schKeyIdx]->SCH_SUB_MAJOR_CD?>" />
													<img src="<?=$FRONT_IMG_URL?>/img/board/btn_search.gif" alt="검색" id="BTN_SEARCH_SUB_MAJOR_<?=$schlIdx?>" name="BTN_SEARCH_SUB_MAJOR_<?=$schlIdx?>" />
												</li>
											</ul>
												
										</td>
									</tr>
									
								  </tbody>
								</table>
							<? } } ?>
							</div>
							
							<div class="textR">
							<a href="javascript:goProcess();"><img src="<?=$FRONT_IMG_URL?>/img/board/table_btn03.gif" alt="중간 저장" /></a>
							<a href="javascript:addFormData('schl');"><img src="<?=$FRONT_IMG_URL?>/img/board/btn_add.gif" alt="추가" id="id_schooladd" /></a>
							</div>
							
							<!-- E: 학력사항 -->


<!-- 학력 사항 디자인 -->

<? } ?>

<?
	//경력사항 - 
	if ($rsmdisplay[0]->CAREER_USE_YN == 'Y' ) {
?>

<div class="h3-tit-box mgt30">
								<h3>경력사항</h3>
								<span>상세업무내용은 400 자 이내로 자세히 작성해 주세요.</span>
								<a href="javascript:openComment('career');" class="btn"><img src="<?=$FRONT_IMG_URL?>/img/board/table_btn01.gif" alt="작성 시 유의사항" /></a>
							</div>

							<table class="TbStyle01" summary="경력사항">
								<caption>경력사항</caption>
								  <colgroup>
								  <col width="15%" />
								  <col width="*" />
								  </colgroup>
								  <tbody>
									<tr>
										<th scope="row" rowspan="2"><label for="family_none">경력사항</label> </th>
										<td>
											<input type="radio" class="radio" name="CAREER_TP" id="CAREER_TP" value="N" <?=$CAREER_TP == 'N' ? ' checked ' : ''; ?> />
											<label for="newcomer">신입</label>
											<input type="radio" class="radio" name="CAREER_TP" id="CAREER_TP" value="C" <?=$CAREER_TP == 'C' ? ' checked ' : ''; ?> />
											<label for="career">경력</label>
											<input class="b_input" type="text" name="CAREER_TERM1" id="CAREER_TERM1" value="<?=$CAREER_TERM1?>" style="width:20px;" maxlength=2 onblur="CheckData(this,'digits');" /> <label for="">년</label>
											<input class="b_input" type="text" name="CAREER_TERM2" id="CAREER_TERM2" value="<?=$CAREER_TERM2?>" style="width:20px;" maxlength=2 onblur="CheckData(this,'digits');" /> <label for="">개월</label>
											<span class="space">/</span>
											<input type="checkbox" class="checkbox" name="FOREIGN_CAREER_YN" id="FOREIGN_CAREER_YN" value="Y" <?=$FOREIGN_CAREER_YN == 'Y' ? ' checked ' : ''; ?> />
											<label for="overseas">해외근무</label>
											<input class="b_input" type="text" name="FOREIGN_CAREER_TERM1" id="FOREIGN_CAREER_TERM1" maxlength=2 value="<?=$FOREIGN_CAREER_TERM1?>" style="width:20px;" onblur="CheckData(this,'digits');" /> <label for="">년</label>
											<input class="b_input" type="text" name="FOREIGN_CAREER_TERM2" id="FOREIGN_CAREER_TERM2" maxlength=2 value="<?=$FOREIGN_CAREER_TERM2?>" style="width:20px;" onblur="CheckData(this,'digits');" /> <label for="">개월</label>
										</td>
									</tr>
									<tr>
										<td>
											<label for="family_none"><span>고용보험가입기간</span></label>
											<input class="b_input" type="text" name="EMP_INSUR_TERM1" id="EMP_INSUR_TERM1" value="<?=$EMP_INSUR_TERM1?>" style="width:20px;" maxlength=2 onblur="CheckData(this,'digits');" /> <label for="">년</label>
											<input class="b_input" type="text" name="EMP_INSUR_TERM2" id="EMP_INSUR_TERM2" value="<?=$EMP_INSUR_TERM2?>" style="width:20px;" maxlength=2 onblur="CheckData(this,'digits');" /> <label for="">개월</label>
											<span> ※ <a href="http://www.ei.go.kr" target="_blank" title="새창에서열림">http://www.ei.go.kr</a> 에서 고용보험가입기간을 조회 후 선택</span>
										</td>
									</tr>
								  </tbody>
							</table>

	<table class="TbStyle01 mgt10" summary="경력사항 상세">
	<caption>경력사항 상세</caption>
	<colgroup>
	<col width="28%" />
	<col width="15%" />
	<col width="*" />
	<col width="10%" />
	</colgroup>
	<thead>
	<tr>
	<th scope="col">근무기간</th>
	<th scope="col" colspan="2">상세경력</th>
	<th scope="col">삭제</th>
	</tr>
	</thead>
	</table>
	
	<div id="id_carr_list">
	<?
		foreach ($carrRs as $key => $carrList)
		{
			$carrIdx = $key + 1;
	?>
	<table class="TbStyle01" id="id_carr_box_set_<?=$carrIdx?>">
	<caption>경력사항 상세</caption>
  <colgroup>
  <col width="28%" />
  <col width="15%" />
  <col width="*" />
  <col width="10%" />
  </colgroup>
	<tbody>
	<tr>
		<td rowspan="5">
			<input type="hidden" id="CAREER_SEQ_<?=$carrIdx?>" name="CAREER_SEQ_<?=$carrIdx?>" value="<?=$carrList->CAREER_SEQ?>"   />
			<input class="b_input" type="text" name="CAREER_STDT1_<?=$carrIdx?>" id="CAREER_STDT1_<?=$carrIdx?>" SIZE="4" maxlength="4" value="<?=$carrList->CAREER_STDT1?>" />년 <input class="b_input" type="text" value="<?=$carrList->CAREER_STDT2?>" name="CAREER_STDT2_<?=$carrIdx?>" id="CAREER_STDT2_<?=$carrIdx?>" maxlength="2"  SIZE="2"  />월 ~ 
			<input class="b_input" type="text" name="CAREER_EDDT1_<?=$carrIdx?>" id="CAREER_EDDT1_<?=$carrIdx?>" SIZE="4" maxlength="4" value="<?=$carrList->CAREER_EDDT1?>" />년 <input class="b_input" type="text" value="<?=$carrList->CAREER_EDDT2?>" name="CAREER_EDDT2_<?=$carrIdx?>" id="CAREER_EDDT2_<?=$carrIdx?>" maxlength="2"  SIZE="2"  />월
			<br>
			<?=${'frmCAREER_STS_CD_' . $carrIdx}?><input type="hidden" id="CAREER_STS_NM_<?=$carrIdx?>" name="CAREER_STS_NM_<?=$carrIdx?>" value="<?=$carrList->CAREER_STS_NM?>" />
		</td>
		<th scope="row"><label for="company_name">회사명</label></th>
		<td><input class="b_input" type="text" id="CAREER_CMP_NM_<?=$carrIdx?>" name="CAREER_CMP_NM_<?=$carrIdx?>" value="<?=$carrList->CAREER_CMP_NM?>" maxlength="50" style="width:85px;" /> <?=${'frmCAREER_CMP_TP_CD_' . $carrIdx}?><input type="hidden" id="CAREER_CMP_TP_NM_<?=$carrIdx?>" name="CAREER_CMP_TP_NM_<?=$carrIdx?>" value="<?=$carrList->CAREER_CMP_TP_NM?>" /> <?=${'frmCAREER_LOC_CD_' . $carrIdx}?><input type="hidden" id="CAREER_LOC_NM_<?=$carrIdx?>" name="CAREER_LOC_NM_<?=$carrIdx?>" value="<?=$carrList->CAREER_LOC_NM?>" /></td>
		<td rowspan="5" class="center Lline"><img id="CARR_DEL_<?=$carrIdx?>" name="CARR_DEL_<?=$carrIdx?>" src="<?=$FRONT_IMG_URL?>/img/board/btn_del.gif"  alt="삭제"  /></td>
	</tr>
	<tr>
		<th>직종</th>
		<td><?=${'frmCAREER_EMP_TP_CD_' . $carrIdx}?><input type="hidden" id="CAREER_EMP_TP_NM_<?=$carrIdx?>" name="CAREER_EMP_TP_NM_<?=$carrIdx?>" value="<?=$carrList->CAREER_EMP_TP_NM?>" /> <input class="b_input" type="text" name="CAREER_JOB_TP_NM_<?=$carrIdx?>" id="CAREER_JOB_TP_NM_<?=$carrIdx?>" value="<?=$carrList->CAREER_JOB_TP_NM?>"  style="width:120px;" readonly /><input type="hidden" name="CAREER_JOB_TP_CD_<?=$carrIdx?>" id="CAREER_JOB_TP_CD_<?=$carrIdx?>" value="<?=$carrList->CAREER_JOB_TP_CD?>" /> 
			<img id="BTN_SEARCH_JOBTYPE_<?=$carrIdx?>" name="BTN_SEARCH_JOBTYPE_<?=$carrIdx?>" src="<?=$FRONT_IMG_URL?>/img/board/btn_search.gif" alt="검색" />
		</td>
	</tr>
	<tr>
		<th>근무부서/직위</th>
		<td>부서명 : <input class="b_input" type="text"  name="CAREER_DEPT_NM_<?=$carrIdx?>" id="CAREER_DEPT_NM_<?=$carrIdx?>" value="<?=$carrList->CAREER_DEPT_NM?>" style="width:140px;" maxlength="50" /> <?=${'frmCAREER_PSTN_CD_' . $carrIdx}?><input type="hidden" id="CAREER_PSTN_NM_<?=$carrIdx?>" value="<?=$carrList->CAREER_PSTN_NM?>" name="CAREER_PSTN_NM_<?=$carrIdx?>" /> <?=${'frmCAREER_PSTN_LVL_CD_' . $carrIdx}?><input type="hidden" id="CAREER_PSTN_LVL_NM_<?=$carrIdx?>" name="CAREER_PSTN_LVL_NM_<?=$carrIdx?>" value="<?=$carrList->CAREER_PSTN_LVL_NM?>" /></td>
	</tr>
	<tr>
		<th>업무내용</th>
		<td><textarea class="b_input" type="text" name="CAREER_CNTNT_<?=$carrIdx?>" id="CAREER_CNTNT_<?=$carrIdx?>" style="width:95%;" /><?=$carrList->CAREER_CNTNT?></textarea></td>
	</tr>
	<tr>
		<th>퇴사사유</th>
		<td><?=${'frmCAREER_RETIRE_CD_' . $carrIdx}?><input type="hidden" name="CAREER_RETIRE_NM_<?=$carrIdx?>" id="CAREER_RETIRE_NM_<?=$carrIdx?>" value="<?=$carrList->CAREER_RETIRE_NM?>" style="width:140px;" /> </td>
	</tr></td>
	</tr>
	</tbody>
	</table>
	<? } ?>
	</div>
	
	<div class="textR">
		<a href="javascript:goProcess();"><img src="<?=$FRONT_IMG_URL?>/img/board/table_btn03.gif" alt="중간 저장" /></a>
		<a href="javascript:addFormData('carr');"><img src="<?=$FRONT_IMG_URL?>/img/board/btn_add.gif" alt="추가" /></a>
	</div>

		
			

<?
	}
?>

<?
	// 어학시험
	if ($rsmdisplay[0]->LANGUAGE_USE_YN == 'Y') {
?>


		<!-- S: 어학시험 -->
		<div class="h3-tit-box mgt30">
			<h3>어학시험</h3>
			<a href="javascript:openComment('language');" class="btn"><img src="<?=$FRONT_IMG_URL?>/img/board/table_btn01.gif" alt="작성 시 유의사항" /></a>
		</div>



<table class="TbStyle01" summary="어학시험">
	<caption>어학시험</caption>
	  <colgroup>
	  <col width="12%" />
	  <col width="15%" />
	  
	 
	  <col width="*" />
	  
	  <col width="22%" />
	  <col width="20%" />
	  <col width="10%" />
	  </colgroup>
	  <thead>
		<tr>
			<th scope="col">어학시험명</th>
			<th scope="col">시행기관</th>
			<th scope="col">시험점수(등급)</th>
			<th scope="col">취득일</th>
			<th scope="col">등록번호</th>
			
		
			<th scope="col">삭제</th>
		</tr>
	  </thead>
	  <tbody>
<? 
	foreach ($lanData as $key => $lanList)
	{
?>
	<tr>
		<td class="center">
			<?=$lanList->LAN_NM?>
			<input type="hidden" name="LAN_IDX_<?=($key+1)?>" id="LAN_IDX_<?=($key+1)?>" value="<?=$lanList->LAN_IDX?>" />
			<input type="hidden" name="LANG_IDX_<?=($key+1)?>" id="LANG_IDX_<?=($key+1)?>" value="<?=$lanList->LANG_IDX?>" />
		</td>
		<td class="center"><?=$lanList->LAN_PB?></td>
		<td class="left">
			<? 
			if (preg_match('/^13|15$/' , $lanList->SCORE_TP)) {
			?>
				<input type="text" id="LAN_SCORE_<?=($key+1)?>" name="LAN_SCORE_<?=($key+1)?>" value="<?=$lanList->LAN_SCORE?>" style="width:40px" onblur="javascript:CheckData(this,'digits');" />
			<? 
			}
			?>
			
			<?=${'frmLAN_LVL_IDX_' . ($key + 1)}?>
			<? 
				/*
					TABLE : tbl_code 
					GB : LNT
					
					15 : 점수, 등급
					14 : 등급
					13 : 점수
					if ($lanList->CD_IDX == '11') 
				*/
				
			?>
		</td>
		<td>
			<input class="b_input"  type="text" id="LAN_DT1_<?=($key+1)?>" name="LAN_DT1_<?=($key+1)?>" value="<?=$lanList->LAN_DT1?>" onblur="javascript:CheckFormDate('LAN_DT',<?=($key+1)?>);" maxlength="4" style="width:30px;"> <label for="">년</label>
			<input class="b_input"  type="text" id="LAN_DT2_<?=($key+1)?>" name="LAN_DT2_<?=($key+1)?>" value="<?=$lanList->LAN_DT2?>" onblur="javascript:setNum2str(this)&CheckFormDate('LAN_DT',<?=($key+1)?>);" maxlength="2" style="width:20px;"> <label for="">월</label>
			<input class="b_input"  type="text" id="LAN_DT3_<?=($key+1)?>" name="LAN_DT3_<?=($key+1)?>" value="<?=$lanList->LAN_DT3?>" onblur="javascript:setNum2str(this)&CheckFormDate('LAN_DT',<?=($key+1)?>);" maxlength="2" style="width:20px;"> <label for="">일</label>
			
		</td>
		<td><input class="b_input"  type="text" id="LAN_NUM_<?=($key+1)?>" style="width:100px;" name="LAN_NUM_<?=($key+1)?>" value="<?=$lanList->LAN_NUM?>" maxlength="25" /></td>
		<td><img id="LAN_DEL" name="LAN_DEL" src="<?=$FRONT_IMG_URL?>/img/board/btn_del.gif"  alt="삭제" onclick="formContentClear('LAN','<?=($key+1)?>');" style="cursor:hand;" /></td>
	</tr>

<?
	}
?>
</tbody>
</table>

<div class="textR">
<a href="javascript:goProcess();"><img src="<?=$FRONT_IMG_URL?>/img/board/table_btn03.gif" alt="중간 저장" /></a>
</div>

<?
	}
?>


<?
	// 저술
	if ($rsmdisplay[0]->WRITE_USE_YN == 'Y') {
?>
	
<!-- S: 저술 -->
		<div class="h3-tit-box mgt30">
			<h3>저술내역</h3>
			<a href="javascript:openComment('write');" class="btn"><img src="<?=$FRONT_IMG_URL?>/img/board/table_btn01.gif" alt="작성 시 유의사항" /></a>
		</div>



	<table class="TbStyle01 mgt10" summary="저술내역">
	<caption>저술</caption>
	  <colgroup>
	  <col width="22%" />
	  <col width="22%" />
	  <col width="*" />
	  <col width="10%" />
	  </colgroup>
	  <thead>
		<tr>
			<th scope="col">저술명</th>
			<th scope="col">발생/게재처</th>
			<th scope="col">발행/게재일</th>
			<th scope="col">삭제</th>
		</tr>
	  </thead>
	</table>
<div id="id_wrte_list">
<?
	foreach ($wrteRs as $key => $wrteList)
	{
		$wrteIdx = $key + 1;
?>
<table class="TbStyle01" summary="저술내역" id="id_wrte_box_set_<?=$wrteIdx?>">	
	 <colgroup>
	  <col width="22%" />
	  <col width="22%" />
	  <col width="*" />
	  <col width="10%" />
	  </colgroup>
	  <tbody>
	<tr>
		<td class="center"><input class="b_input" type="text" value="<?=$wrteList->WRT_NM?>" name="WRT_NM_<?=$wrteIdx?>" maxlength="50" id="WRT_NM_<?=$wrteIdx?>" /><input type="hidden" id="WRT_SEQ_<?=$wrteIdx?>" name="WRT_SEQ_<?=$wrteIdx?>" value="<?=$wrteList->WRT_SEQ?>" /></td>
		<td class="center"><input class="b_input" type="text" value="<?=$wrteList->WRT_PB?>" name="WRT_PB_<?=$wrteIdx?>" maxlength="50" id="WRT_PB_<?=$wrteIdx?>" /></td>
		<td class="center">
				<input class="b_input" type="text" value="<?=$wrteList->WRT_DT1?>" name="WRT_DT1_<?=$wrteIdx?>" id="WRT_DT1_<?=$wrteIdx?>" style="width:30px;" maxlength="4" />  <label for="">년</label> 
				<input class="b_input" type="text" value="<?=$wrteList->WRT_DT2?>" name="WRT_DT2_<?=$wrteIdx?>" id="WRT_DT2_<?=$wrteIdx?>" style="width:20px;" maxlength="2"  />  <label for="">월</label> 
				<input class="b_input" type="text" value="<?=$wrteList->WRT_DT3?>" name="WRT_DT3_<?=$wrteIdx?>" id="WRT_DT3_<?=$wrteIdx?>" style="width:20px;" maxlength="2"  />  <label for="">일</label> 
		</td>
		<td class="center"><img id="WRTE_DEL_<?=$wrteIdx?>" name="WRTE_DEL_<?=$wrteIdx?>" src="<?=$FRONT_IMG_URL?>/img/board/btn_del.gif"  alt="삭제"  /></td>
	</tr>
</tbody>
</table>
<?
	}
?>
</div>

<div class="textR">
	<a href="javascript:goProcess();"><img src="<?=$FRONT_IMG_URL?>/img/board/table_btn03.gif" alt="중간 저장" /></a>
	<a href="javascript:addFormData('wrte');"><img src="<?=$FRONT_IMG_URL?>/img/board/btn_add.gif" alt="추가" /></a>
</div>

		




<?
	}
?>

<?
	// 수상내역
	if ($rsmdisplay[0]->PRIZE_USE_YN == 'Y') {
?>
	
<!-- S: 수상내역 -->
		<div class="h3-tit-box mgt30">
			<h3>수상내역</h3>
			<a href="javascript:openComment('prize');" class="btn"><img src="<?=$FRONT_IMG_URL?>/img/board/table_btn01.gif" alt="작성 시 유의사항" /></a>
		</div>



	<table class="TbStyle01 mgt10" summary="수상내역">
	<caption>수상명</caption>
	  <colgroup>
	  <col width="22%" />
	  <col width="22%" />
	  <col width="*" />
	  <col width="10%" />
	  </colgroup>
	  <thead>
		<tr>
			<th scope="col">수상명</th>
			<th scope="col">수여기관</th>
			<th scope="col">수상일</th>
			<th scope="col">삭제</th>
		</tr>
	  </thead>
	</table>
<div id="id_prze_list">
<?
	foreach ($przeRs as $key => $przeList)
	{
		$przeIdx = $key + 1;
?>
<table class="TbStyle01" summary="수상내역" id="id_prze_box_set_<?=$przeIdx?>">	
		 <colgroup>
		  <col width="22%" />
		  <col width="22%" />
		  <col width="*" />
		  <col width="10%" />
		  </colgroup>
		  <tbody>
		<tr>
			<td class="center"><input class="b_input" type="text" value="<?=$przeList->PRZ_NM?>" name="PRZ_NM_<?=$przeIdx?>" maxlength="50" id="PRZ_NM_<?=$przeIdx?>"  /><input type="hidden" id="PRZ_SEQ_<?=$przeIdx?>" name="PRZ_SEQ_<?=$przeIdx?>" value="<?=$przeList->PRZ_SEQ?>" /></td>
			<td class="center"><input class="b_input" type="text" value="<?=$przeList->PRZ_PB_NM?>" name="PRZ_PB_NM_<?=$przeIdx?>" id="PRZ_PB_NM_<?=$przeIdx?>" maxlength="50" /></td>
			<td class="center">
					<input class="b_input" type="text" value="<?=$przeList->PRZ_DT1?>" name="PRZ_DT1_<?=$przeIdx?>" id="PRZ_DT1_<?=$przeIdx?>" style="width:30px;" maxlength="4" />  <label for="">년</label> 
					<input class="b_input" type="text" value="<?=$przeList->PRZ_DT2?>" name="PRZ_DT2_<?=$przeIdx?>" id="PRZ_DT2_<?=$przeIdx?>" style="width:20px;" maxlength="2"  />  <label for="">월</label> 
					<input class="b_input" type="text" value="<?=$przeList->PRZ_DT3?>" name="PRZ_DT3_<?=$przeIdx?>" id="PRZ_DT3_<?=$przeIdx?>" style="width:20px;" maxlength="2"  />  <label for="">일</label> 
			</td>
			<td class="center"><img id="PRZE_DEL_<?=$przeIdx?>" name="PRZE_DEL_<?=$przeIdx?>" src="<?=$FRONT_IMG_URL?>/img/board/btn_del.gif"  alt="삭제"  /></td>
		</tr>
	</tbody>
	</table>
<?
}
?>
</div>

<div class="textR">
	<a href="javascript:goProcess();"><img src="<?=$FRONT_IMG_URL?>/img/board/table_btn03.gif" alt="중간 저장" /></a>
	<a href="javascript:addFormData('prze');"><img src="<?=$FRONT_IMG_URL?>/img/board/btn_add.gif" alt="추가" /></a>
</div>
		


<?
	}
?>




<?
	// 쓰잘데기없는 어학
	if ($rsmdisplay[0]->LANGUAGE2_USE_YN == 'Y') {
?>
<!-- S: 어학능력 -->
		<div class="h3-tit-box mgt30">
			<h3>어학능력</h3>
			<a href="javascript:openComment('language2');" class="btn"><img src="<?=$FRONT_IMG_URL?>/img/board/table_btn01.gif" alt="작성 시 유의사항" /></a>
		</div>



	<table class="TbStyle01 mgt10" summary="어학능력">
	<caption>어학능력</caption>
	  <colgroup>
	  <col width="22%" />
	  <col width="*" />
	  <col width="*" />
	  <col width="*" />
	  <col width="10%" />
	  </colgroup>
	  <thead>
		<tr>
			<th scope="col">언어</th>
			<th scope="col">회화능력</th>
			<th scope="col">작문능력</th>
			<th scope="col">독해능력</th>
			<th scope="col">삭제</th>
		</tr>
	  </thead>
	</table>
<div id="id_lan2_list">
<?
	foreach ($lan2Rs as $key => $lan2List)
	{
		$lan2Idx = $key + 1;
?>
<table class="TbStyle01" summary="어학능력" id="id_lan2_box_set_<?=$lan2Idx?>">	
		 <colgroup>
		  <col width="22%" />
		  <col width="*" />
		  <col width="*" />
		  <col width="*" />
		  <col width="10%" />
		  </colgroup>
		  <tbody>
		<tr>
			<td class="center"><?=${'frmLANG2_CD_' . $lan2Idx}?><input type="hidden" name="LANG2_NM_<?=$lan2Idx?>" id="LANG2_NM_<?=$lan2Idx?>" value="<?=$lan2List->LANG2_NM?>" /><input type="hidden" id="LANG2_SEQ_<?=$lan2Idx?>" name="LANG2_SEQ_<?=$lan2Idx?>" value="<?=$lan2List->LANG2_SEQ?>" /></td>
			<td class="center"><?=${'frmLANG2_SPCH_LVL_CD_' . $lan2Idx}?><input type="hidden" name="LANG2_SPCH_LVL_NM_<?=$lan2Idx?>" id="LANG2_SPCH_LVL_NM_<?=$lan2Idx?>" value="<?=$lan2List->LANG2_SPCH_LVL_NM?>" /></td>
			<td class="center"><?=${'frmLANG2_WRT_LVL_CD_' . $lan2Idx}?><input type="hidden" name="LANG2_WRT_LVL_NM_<?=$lan2Idx?>" id="LANG2_WRT_LVL_NM_<?=$lan2Idx?>" value="<?=$lan2List->LANG2_WRT_LVL_NM?>"  /></td>
			<td class="center"><?=${'frmLANG2_CMP_LVL_CD_' . $lan2Idx}?><input type="hidden" name="LANG2_CMP_LVL_NM_<?=$lan2Idx?>" id="LANG2_CMP_LVL_NM_<?=$lan2Idx?>" value="<?=$lan2List->LANG2_CMP_LVL_NM?>"  /></td>
			<td class="center"><img id="LAN2_DEL_<?=$lan2Idx?>" name="LAN2_DEL_<?=$lan2Idx?>" src="<?=$FRONT_IMG_URL?>/img/board/btn_del.gif"  alt="삭제"  /></td>
		</tr>
	</tbody>
	</table>	
<?
	}
?>
</div>

<div class="textR">
	<a href="javascript:goProcess();"><img src="<?=$FRONT_IMG_URL?>/img/board/table_btn03.gif" alt="중간 저장" /></a>
	<a href="javascript:addFormData('lan2');"><img src="<?=$FRONT_IMG_URL?>/img/board/btn_add.gif" alt="추가" /></a>
</div>



<?
	}
?>

<?
	if ($rsmdisplay[0]->LICENSE_USE_YN == 'Y') {
?>

<!-- S: 자격증 -->
		<div class="h3-tit-box mgt30">
			<h3>자격증</h3>
			<a href="javascript:openComment('license');" class="btn"><img src="<?=$FRONT_IMG_URL?>/img/board/table_btn01.gif" alt="작성 시 유의사항" /></a>
		</div>


	<table class="TbStyle01 mgt10" summary="자격증">
	<caption>자격증</caption>
	  <colgroup>
	  <col width="*" />
	  <col width="*" />
	  <col width="*" />
	  <col width="*" />
	  <col width="10%" />
	  </colgroup>
	  <thead>
		<tr>
			<th scope="col">자격증명</th>
			<th scope="col">발행처</th>
			<th scope="col">취득일자</th>
			<th scope="col">등록번호</th>
			<th scope="col">삭제</th>
		</tr>
	  </thead>
	</table>
	
<div id="id_lics_list">
<?
foreach ($licRs as $key => $licList)
{
	$licIdx = $key + 1;
?>
	<table class="TbStyle01" summary="자격능력" id="id_lics_box_set_<?=$licIdx?>">	
	 <colgroup>
	  <col width="*" />
	  <col width="*" />
		<col width="*" />
	  <col width="*" />
	  <col width="10%" />
	  </colgroup>
		<tbody>
		<tr>
			<td class="center">
				<input type="hidden" id="LIC_SEQ_<?=$licIdx?>" name="LIC_SEQ_<?=$licIdx?>" value="<?=$licList->LIC_SEQ?>" />
				<input class="b_input" type="text" name="LIC_NM_<?=$licIdx?>" id="LIC_NM_<?=$licIdx?>" value="<?=$licList->LIC_NM?>" readonly style="width:100px;" />
				<input type="hidden" name="LIC_CD_<?=$licIdx?>" id="LIC_CD_<?=$licIdx?>" value="<?=$licList->LIC_CD?>" />
				<img id="BTN_SEARCH_LICENSE_<?=$licIdx?>" name="BTN_SEARCH_LICENSE_<?=$licIdx?>" src="<?=$FRONT_IMG_URL?>/img/board/btn_search.gif" alt="검색" />
			</td>
			<td class="center"><input class="b_input" type="text" name="LIC_PB_NM_<?=$licIdx?>" id="LIC_PB_NM_<?=$licIdx?>" value="<?=$licList->LIC_PB_NM?>" maxlength="50" /></td>
			<td class="center">
				<input class="b_input" type="text" id="LIC_DT1_<?=$licIdx?>" name="LIC_DT1_<?=$licIdx?>" value="<?=$licList->LIC_DT1?>" style="width:30px;" maxlength="4" />  <label for="">년</label> 
				<input class="b_input" type="text" id="LIC_DT2_<?=$licIdx?>" name="LIC_DT2_<?=$licIdx?>" value="<?=$licList->LIC_DT2?>" style="width:20px;" maxlength="2"  />  <label for="">월</label> 
				<input class="b_input" type="text" id="LIC_DT3_<?=$licIdx?>" name="LIC_DT3_<?=$licIdx?>" value="<?=$licList->LIC_DT3?>" style="width:20px;" maxlength="2"  />  <label for="">일</label> 
			</td>
			<td><input class="b_input" type="text" id="LIC_NUM_<?=$licIdx?>" name="LIC_NUM_<?=$licIdx?>" value="<?=$licList->LIC_NUM?>" style="width:90%;" maxlength="25" /></td>
			<td class="center"><img id="LICS_DEL_<?=$licIdx?>" name="LICS_DEL_<?=$licIdx?>" src="<?=$FRONT_IMG_URL?>/img/board/btn_del.gif"  alt="삭제"  /></td>
		</tr>
	</tbody>
	</table>
<? } ?>
	</div>

<div class="textR">
	<a href="javascript:goProcess();"><img src="<?=$FRONT_IMG_URL?>/img/board/table_btn03.gif" alt="중간 저장" /></a>
	<a href="javascript:addFormData('lics');"><img src="<?=$FRONT_IMG_URL?>/img/board/btn_add.gif" alt="추가" /></a>
</div>



<?
	}
?>


<?
	/* 
		컴퓨터 활용 능력 
		frmComputerDataList
	*/
	if ($rsmdisplay[0]->PC_USE_YN == 'Y') { 
?>

<div class="h3-tit-box mgt30">
	<h3>OA능력</h3>
	<a href="javascript:openComment('computer');" class="btn"><img src="<?=$FRONT_IMG_URL?>/img/board/table_btn01.gif" alt="작성 시 유의사항" /></a>
</div>

<table class="TbStyle01 mgt10" summary="OA능력">
<caption>OA능력</caption>
  <colgroup>
 
  
		<? foreach ($frmComputerDataList as $key => $clistData) { ?>
			<col width="*" />
		<? } ?>
	
  
  </colgroup>
  <thead>
	<tr>
		<? foreach ($frmComputerDataList as $key => $clistData) { ?>
			<th scope="col"><?=$clistData->CPU_NM?></th>
		<? } ?>
	</tr>
  </thead>
  <tbody>
	<tr>
		<? foreach ($frmComputerDataList as $key => $clistData) { ?>
			<td align="center"><?=${'frmPC_LVL_CD_' . ($key + 1)}?>
				<input type="hidden" id="PC_LVL_NM_<?=($key + 1)?>" name="PC_LVL_NM_<?=($key + 1)?>" value="<?=$clistData->LVL_NM?>" />
				<input type="hidden" id="CD_CPU_IDX_<?=($key + 1)?>" name="CD_CPU_IDX_<?=($key + 1)?>" value="<?=$clistData->CD_CPU_IDX?>" />
			</td>
		<? } ?>
	</tr>
  </tbody>
</table>

<div class="textR">
<a href="javascript:goProcess();"><img src="<?=$FRONT_IMG_URL?>/img/board/table_btn03.gif" alt="중간 저장" /></a>
</div>
							
<?
	}
?>

<? 
	/* 
		활동사항
		SERVE_USE_YN == 'Y'
	*/
	if ($rsmdisplay[0]->SERVE_USE_YN == 'Y') { 
?>

<div class="h3-tit-box mgt30">
	<h3>주요활동 및 사회경험</h3>
	<span>인턴 / 아르바이트 / 동아리 / 자원봉사 / 사회활동 / 교내활동 / 수행과제</span>
	<a href="javascript:openComment('serve');" class="btn"><img src="<?=$FRONT_IMG_URL?>/img/board/table_btn01.gif" alt="작성 시 유의사항" /></a>
</div>

<table class="TbStyle01 mgt10" summary="주요활동 및 사회경험">
	<caption>주요활동 및 사회경험</caption>
	  <colgroup>
	  <col width="32%" />
	  <col width="15%" />
	  <col width="*" />
	  <col width="10%" />
	  </colgroup>
	  <thead>
		<tr>
			<th scope="col">활동기간</th>
			<th scope="col" colspan="2">상세활동</th>
			<th scope="col">삭제</th>
		</tr>
	  </thead>
	</table>
<div id="id_srve_list">
<?
foreach ($srveRs as $key => $srveList)
{
	$srveIdx = $key + 1;
?>
	<table class="TbStyle01" summary="주요활동 및 사회경험" id="id_srve_box_set_<?=$srveIdx?>">
		 <colgroup>
	  <col width="32%" />
	  <col width="15%" />
	  <col width="*" />
	  <col width="10%" />
	  </colgroup>
		  <tbody>
			<tr>
				<td rowspan="3">
					<input type="hidden" id="SRV_SEQ_<?=$srveIdx?>" name="SRV_SEQ_<?=$srveIdx?>" value="<?=$srveList->SRV_SEQ?>" />
					<input class="b_input" type="text" value="<?=$srveList->SRV_STDT1?>" name="SRV_STDT1_<?=$srveIdx?>" id="SRV_STDT1_<?=$srveIdx?>" value="" style="width:30px;" maxlength="4" /> <label for="">년</label>
					<input class="b_input" type="text" value="<?=$srveList->SRV_STDT2?>" name="SRV_STDT2_<?=$srveIdx?>" id="SRV_STDT2_<?=$srveIdx?>" value="" style="width:20px;" maxlength="2"  /> <label for="">월</label> ~ 
					<input class="b_input" type="text" value="<?=$srveList->SRV_EDDT1?>" name="SRV_EDDT1_<?=$srveIdx?>" id="SRV_EDDT1_<?=$srveIdx?>" value="" style="width:30px;" maxlength="4" /> <label for="">년</label>
					<input class="b_input" type="text" value="<?=$srveList->SRV_EDDT2?>" name="SRV_EDDT2_<?=$srveIdx?>" id="SRV_EDDT2_<?=$srveIdx?>" value="" style="width:20px;" maxlength="2"  /> <label for="">월</label>
				</td>
				<th scope="row"><label for="active_kind">활동구분</label></th>
				<td>
					<?=${'frmSRV_TP_CD_' . $srveIdx}?><input type="hidden" id="SRV_TP_NM_<?=$srveIdx?>" name="SRV_TP_NM_<?=$srveIdx?>" value="<?=$srveList->SRV_TP_NM?>"  />
				</td>
				<td rowspan="4" class="center Lline"><img id="SRVE_DEL_<?=$srveIdx?>" name="SRVE_DEL_<?=$srveIdx?>" src="<?=$FRONT_IMG_URL?>/img/board/btn_del.gif"  alt="삭제"  /></td>
			</tr>
			<tr>
				<th scope="row"><label for="ogani">기관/장소</label></th>
				<td>
					<input class="b_input" type="text" name="SRV_ORG_NM_<?=$srveIdx?>" id="SRV_ORG_NM_<?=$srveIdx?>" value="<?=$srveList->SRV_ORG_NM?>" style="width:95%;" title="기관/장소입력" maxlength="50" />
				</td>
			</tr>
			<tr>
				<th scope="row"><label for="active_content">활동내용</label></th>
				<td><textarea name="SRV_CNTNT_<?=$srveIdx?>" rows="" cols="" id="SRV_CNTNT_<?=$srveIdx?>" style="width:95%;"><?=$srveList->SRV_CNTNT?></textarea></td>
			</tr>
		  </tbody>
	</table>
<? } ?>	
</div>

<div class="textR">
<a href="javascript:goProcess();"><img src="<?=$FRONT_IMG_URL?>/img/board/table_btn03.gif" alt="중간 저장" /></a>
<a href="javascript:addFormData('srve');"><img src="<?=$FRONT_IMG_URL?>/img/board/btn_add.gif" alt="추가" /></a>
</div>


<?
	}
?>


<? 
	/* 
		보유기술사항
		TECH_USE_YN == 'Y'
	*/
	if ($rsmdisplay[0]->TECH_USE_YN == 'Y') { 
?>
<div class="h3-tit-box mgt30">
		<h3>보유기술 및 능력</h3>
		<a href="javascript:openComment('tech');" class="btn"><img src="<?=$FRONT_IMG_URL?>/img/board/table_btn01.gif" alt="작성 시 유의사항" /></a>
	</div>

<table class="TbStyle01 mgt10" summary="보유기술 및 능력">
<caption>보유기술 및 능력</caption>
  <colgroup>
  <col width="32%" />
  <col width="15%" />
  <col width="*" />
  <col width="10%" />
  </colgroup>
  <thead>
	<tr>
		<th scope="col">보유능력</th>
		<th scope="col">수준</th>
		<th scope="col">상세내용</th>
		<th scope="col">삭제</th>
	</tr>
  </thead>
</table>

<div id="id_tech_list">
<?
foreach ($techRs as $key => $techList)
{
	$techIdx = $key + 1;
?>	
	<table class="TbStyle01" summary="보유기술 및 능력" id="id_tech_box_set_<?=$techIdx?>">
		<colgroup>
	  <col width="32%" />
	  <col width="15%" />
	  <col width="*" />
	  <col width="10%" />
	  </colgroup>
	<tbody>
	<tr>
		<td><input class="b_input" type="text" name="TCH_NM_<?=$techIdx?>" id="TCH_NM_<?=$techIdx?>" value="<?=$techList->TCH_NM?>" style="width:95%;" title="" maxlength="50" />
			<input type="hidden" id="TCH_SEQ_<?=$techIdx?>" name="TCH_SEQ_<?=$techIdx?>" value="<?=$techList->TCH_SEQ?>" /> 
			</td>
		<td><input class="b_input" type="text" name="TCH_LVL_<?=$techIdx?>" id="TCH_LVL_<?=$techIdx?>" value="<?=$techList->TCH_LVL?>" style="width:95%;" title="" maxlength="50" /></td>
		<td><textarea name="TCH_CNTNT_<?=$techIdx?>" rows="" cols="" id="TCH_CNTNT_<?=$techIdx?>" style="width:95%;"><?=$techList->TCH_CNTNT?></textarea></td>
		<td rowspan="4" class="center"><img id="TECH_DEL_<?=$techIdx?>" name="TECH_DEL_<?=$techIdx?>" src="<?=$FRONT_IMG_URL?>/img/board/btn_del.gif"  alt="삭제"  /></td>
	</tr>
  </tbody>
	</table>

<?
}
?>
</div>
<div class="textR">
<a href="javascript:goProcess();"><img src="<?=$FRONT_IMG_URL?>/img/board/table_btn03.gif" alt="중간 저장" /></a>
<a href="javascript:addFormData('tech');"><img src="<?=$FRONT_IMG_URL?>/img/board/btn_add.gif" alt="추가" /></a>
</div>
			

<?
	}
?>



<? 
	/* 
		교육사항
		EDUCATION_USE_YN == 'Y'
	*/
	if ($rsmdisplay[0]->EDUCATION_USE_YN == 'Y') { 
?>
<div class="h3-tit-box mgt30">
	<h3>교육이수 내역</h3>
	<a href="javascript:openComment('education');" class="btn"><img src="<?=$FRONT_IMG_URL?>/img/board/table_btn01.gif" alt="작성 시 유의사항" /></a>
</div>

<table class="TbStyle01 mgt10" summary="교육이수 내역">
<caption>교육이수 내역</caption>
  <colgroup>
  <col width="32%" />
  <col width="15%" />
  <col width="*" />
  <col width="10%" />
  </colgroup>
  <thead>
	<tr>
		<th scope="col">활동기간</th>
		<th scope="col" colspan="2">상세활동</th>
		<th scope="col">삭제</th>
	</tr>
  </thead>
</table>

<div id="id_educ_list">
<?
foreach ($educRs as $key => $educList)
{
	$educIdx = $key + 1;
?>	
	<table class="TbStyle01" summary="교육이수 내역" id="id_educ_box_set_<?=$educIdx?>">
<caption>교육이수 내역</caption>
  <colgroup>
  <col width="32%" />
  <col width="15%" />
  <col width="*" />
  <col width="10%" />
  </colgroup>
	<tbody>
		<tr>
			<td rowspan="3">
				
				<input type="hidden" id="EDU_SEQ_<?=$educIdx?>" name="EDU_SEQ_<?=$educIdx?>" value="<?=$educList->EDU_SEQ?>" />
				<input class="b_input" type="text" name="EDU_STDT1_<?=$educIdx?>" id="EDU_STDT1_<?=$educIdx?>" value="<?=$educList->EDU_STDT1?>" maxlength="4" style="width:30px;" /> <label for="">년</label>
				<input class="b_input" type="text" name="EDU_STDT2_<?=$educIdx?>" id="EDU_STDT2_<?=$educIdx?>" value="<?=$educList->EDU_STDT2?>" maxlength="2" style="width:20px;"  /> <label for="">월</label> ~ 
				<input class="b_input" type="text" name="EDU_EDDT1_<?=$educIdx?>" id="EDU_EDDT1_<?=$educIdx?>" value="<?=$educList->EDU_EDDT1?>" maxlength="4" style="width:30px;" /> <label for="">년</label>
				<input class="b_input" type="text" name="EDU_EDDT2_<?=$educIdx?>" id="EDU_EDDT2_<?=$educIdx?>" value="<?=$educList->EDU_EDDT2?>" maxlength="2" style="width:20px;"  /> <label for="">월</label>
			</td>
			<th scope="row"><label for="edu_name">교육명</label></th>
			<td>
				<input class="b_input" type="text" name="EDU_NM_<?=$educIdx?>" id="EDU_NM_<?=$educIdx?>" value="<?=$educList->EDU_NM?>" style="width:95%;" title="교육명입력" maxlength="50" />
			</td>
			<td rowspan="4" class="center Lline"><img id="EDUC_DEL_<?=$educIdx?>" name="EDUC_DEL_<?=$educIdx?>" src="<?=$FRONT_IMG_URL?>/img/board/btn_del.gif"  alt="삭제"  /></td>
		</tr>
		<tr>
			<th scope="row"><label for="ogani_03">교육기관</label></th>
			<td>
				<input class="b_input" type="text" name="EDU_ORG_NM_<?=$educIdx?>" id="EDU_ORG_NM_<?=$educIdx?>" value="<?=$educList->EDU_ORG_NM?>" style="width:95%;" maxlength="50" title="교육기관입력" />
			</td>
		</tr>
		<tr>
			<th scope="row"><label for="active_content_03">교육내용</label></th>
			<td><textarea name="EDU_CNTNT_<?=$educIdx?>" rows="" cols="" id="EDU_CNTNT_<?=$educIdx?>" style="width:95%;"><?=$educList->EDU_CNTNT?></textarea></td>
		</tr>
	  </tbody>
	</table>
<? } ?>
</div>
<div class="textR">
	<a href="javascript:goProcess();"><img src="<?=$FRONT_IMG_URL?>/img/board/table_btn03.gif" alt="중간 저장" /></a>
	<a href="javascript:addFormData('educ');"><img src="<?=$FRONT_IMG_URL?>/img/board/btn_add.gif" alt="추가" /></a>
</div>

<?
	}
?>


<? 
	/* 
		해외 경험 
		TRAINING_USE_YN == 'Y'
	*/
	if ($rsmdisplay[0]->TRAINING_USE_YN == 'Y') { 
?>
<div class="h3-tit-box mgt30">
	<h3>해외연수 및 해외경험</h3>
	<a href="javascript:openComment('trip');" class="btn"><img src="<?=$FRONT_IMG_URL?>/img/board/table_btn01.gif" alt="작성 시 유의사항" /></a>
</div>

<table class="TbStyle01 mgt10" summary="해외연수 및 해외경험">
<caption>해외연수 및 해외경험</caption>
  <colgroup>
  <col width="32%" />
  <col width="15%" />
  <col width="*" />
  <col width="10%" />
  </colgroup>
  <thead>
	<tr>
		<th scope="col">활동기간</th>
		<th scope="col" colspan="2">상세활동</th>
		<th scope="col">삭제</th>
	</tr>
  </thead>
</table>
<div id="id_trng_list">
<?
foreach ($trngRs as $key => $trngList)
{
	$trngIdx = $key + 1;
?>	
	<table class="TbStyle01" summary="교육이수 내역" id="id_trng_box_set_<?=$trngIdx?>">
		<caption></caption>
	  <colgroup>
	  <col width="32%" />
	  <col width="15%" />
	  <col width="*" />
	  <col width="10%" />
	  </colgroup>
		<tbody>
			<tr>
				<td rowspan="4">
					<input type="hidden" id="TRN_SEQ_<?=$trngIdx?>" name="TRN_SEQ_<?=$trngIdx?>" value="<?=$trngList->TRN_SEQ?>" />
					<input class="b_input" type="text" name="TRN_STDT1_<?=$trngIdx?>" id="TRN_STDT1_<?=$trngIdx?>" value="<?=$trngList->TRN_STDT1?>" maxlength="4" style="width:30px;" /> <label for="">년</label>
					<input class="b_input" type="text" name="TRN_STDT2_<?=$trngIdx?>" id="TRN_STDT2_<?=$trngIdx?>" value="<?=$trngList->TRN_STDT2?>" maxlength="2" style="width:20px;" /> <label for="">월</label> ~ 
					<input class="b_input" type="text" name="TRN_EDDT1_<?=$trngIdx?>" id="TRN_EDDT1_<?=$trngIdx?>" value="<?=$trngList->TRN_EDDT1?>" maxlength="4" style="width:30px;" /> <label for="">년</label>
					<input class="b_input" type="text" name="TRN_EDDT2_<?=$trngIdx?>" id="TRN_EDDT2_<?=$trngIdx?>" value="<?=$trngList->TRN_EDDT2?>" maxlength="2" style="width:20px;" /> <label for="">월</label>
				</td>
				<th scope="row"><label for="trn_name">구분및 국가</label></th>
				<td><?=${'frmTRN_TP_CD_' . $trngIdx}?><input type="hidden" id="TRN_TP_NM_<?=$trngIdx?>" maxlength="50" name="TRN_TP_NM_<?=$trngIdx?>" value="<?=$trngList->TRN_TP_NM?>" /> 국가명 : <input class="b_input" type="text" name="TRN_CTRY_NM_<?=$trngIdx?>" id="TRN_CTRY_NM_<?=$trngIdx?>" value="<?=$trngList->TRN_CTRY_NM?>" style="width:100px;" title="교육명입력" />
				</td>
				<td rowspan="5" class="center Lline"><img id="TRNG_DEL_<?=$trngIdx?>" name="TRNG_DEL_<?=$trngIdx?>" src="<?=$FRONT_IMG_URL?>/img/board/btn_del.gif"  alt="삭제"  /></td>
			</tr>
			<tr>
				<th scope="row"><label for="ogani_03">기관/단체</label></th>
				<td>
					<input class="b_input" type="text" name="TRN_ORG_NM_<?=$trngIdx?>" id="TRN_ORG_NM_<?=$trngIdx?>" maxlength="50" value="<?=$trngList->TRN_ORG_NM?>" style="width:95%;" title="" />
				</td>
			</tr>
			<tr>
				<th scope="row"><label for="ogani_03">목적</label></th>
				<td>
					<input class="b_input" type="text" name="TRN_OBJ_NM_<?=$trngIdx?>" id="TRN_OBJ_NM_<?=$trngIdx?>" maxlength="50" value="<?=$trngList->TRN_OBJ_NM?>" style="width:95%;" title="" />
				</td>
			</tr>
			<tr>
				<th scope="row"><label for="active_content_03">활동내용</label></th>
				<td><textarea name="TRN_CNTNT_<?=$trngIdx?>" rows="" cols="" id="TRN_CNTNT_<?=$trngIdx?>" style="width:95%;"><?=$trngList->TRN_CNTNT?></textarea></td>
			</tr>
		  </tbody>
	</table>
<?
	}
?>
</div>
<div class="textR">
<a href="javascript:goProcess();"><img src="<?=$FRONT_IMG_URL?>/img/board/table_btn03.gif" alt="중간 저장" /></a>
<a href="javascript:addFormData('trng');"><img src="<?=$FRONT_IMG_URL?>/img/board/btn_add.gif" alt="추가" /></a>
</div>

<?
	}
?>


<? 
	/* 
		CONTENT_USE_YN == 'Y'
	*/
	if ($rsmdisplay[0]->CONTENT_USE_YN == 'Y') { 
?>

<!-- S: 자기소개서 -->
<div class="h3-tit-box mgt30">
	<h3>자기소개서</h3>
	
	<a href="javascript:openComment('contents');" class="btn"><img src="<?=$FRONT_IMG_URL?>/img/board/table_btn01.gif" alt="작성 시 유의사항" /></a>
</div>
<script>
	
	function cntntCheckBoxConfirm()
	{
		var x = 1;
		while (x > 0)
		{
			if ($("#RSM_CNTNT_IDX_" + x).length == 0) break;
			if ($("#RSM_CNTNT_FLAG_ESN_YN_" + x).val() == 'Y' )
			{
				///alert($("#RSM_CNTNT_FLAG_MIN_LEN_" + x).val() + '----' + $("#APPL_CNTNT_" + x).val().length + '----');
				if ( Number($("#RSM_CNTNT_FLAG_MIN_LEN_" + x).val()) > Number($("#APPL_CNTNT_" + x).val().length) )
				{
					alert('[' + $("#RSM_CNTNT_FLAG_TITLE_" + x).val() + '] 최소 ' + $("#RSM_CNTNT_FLAG_MIN_LEN_" + x).val() + '자 이상입니다. ');
					return 'error';
				}
			}
			x++;
		}
		
	}
	
</script>
<table class="TbStyle01 mgt10" summary="자기소개서">
	<caption>자기소개서</caption>
	  <colgroup>
	  <col width="30%" />
	  <col width="*" />
	  </colgroup>
	  <tbody>
	  <? foreach ($frmContent as $key => $data) { ?>
		<tr>
			<th scope="row" class="th-list">
				<?=$data->CNTNT_ESN_YN == 'Y' ? '<span class="red">*</span>' : ''?> <?=$data->CNTNT_TITLE?>
			</th>
			<td>
				<input type="hidden" id="RSM_CNTNT_FLAG_TITLE_<?=($key+1)?>" name="RSM_CNTNT_FLAG_TITLE_<?=($key+1)?>" value="<?=$data->CNTNT_TITLE?>" />
				<input type="hidden" id="RSM_CNTNT_FLAG_ESN_YN_<?=($key+1)?>" name="RSM_CNTNT_FLAG_ESN_YN_<?=($key+1)?>" value="<?=$data->CNTNT_ESN_YN?>" />
				<input type="hidden" id="RSM_CNTNT_FLAG_MIN_LEN_<?=($key+1)?>" name="RSM_CNTNT_FLAG_MIN_LEN_<?=($key+1)?>" value="<?=$data->CNTNT_MIN_LEN?>" />
				<input type="hidden" id="RSM_CNTNT_IDX_<?=($key+1)?>" name="RSM_CNTNT_IDX_<?=($key+1)?>" value="<?=$data->RSM_CNTNT_IDX?>" />
				<textarea name="APPL_CNTNT_<?=($key+1)?>" rows="" cols="" id="APPL_CNTNT_<?=($key+1)?>" style="width:95%;height:100px;" onclick="fncCheckByte('APPL_CNTNT_<?=($key+1)?>', 'txtBytes_GoodsDesc_<?=($key+1)?>', <?=$data->CNTNT_LEN?>);" onKeyUp="fncCheckByte('APPL_CNTNT_<?=($key+1)?>', 'txtBytes_GoodsDesc_<?=($key+1)?>', <?=$data->CNTNT_LEN?>);"><?=$data->APPL_CNTNT?></textarea>
				<div style="float:left"><?=$data->CNTNT_COMMENT?></div>
				<div style="text-align:right"><div id="txtBytes_GoodsDesc_<?=($key+1)?>">0 / <?=$data->CNTNT_LEN?> Bytes</div></div>
		
			</td>
		</tr>
		<? } ?>
	  </tbody>
</table>

<div class="textR">
	<a href="javascript:goProcess();"><img src="<?=$FRONT_IMG_URL?>/img/board/table_btn03.gif" alt="중간 저장" /></a>
</div>


<? } ?>



<? 
	/* 
		CONTENT_USE_YN == 'Y'
	*/
	if ($rsmdisplay[0]->FILE_USE_YN == 'Y') { 
?>

<!-- S: 자기소개서 -->
<div class="h3-tit-box mgt30">
	<h3>파일업로드</h3>
	
	<a href="javascript:openComment('file');" class="btn"><img src="<?=$FRONT_IMG_URL?>/img/board/table_btn01.gif" alt="작성 시 유의사항" /></a>
</div>
<script>
	
	function cntntCheckBoxConfirm()
	{
		var x = 1;
		while (x > 0)
		{
			if ($("#RSM_CNTNT_IDX_" + x).length == 0) break;
			if ($("#RSM_CNTNT_FLAG_ESN_YN_" + x).val() == 'Y' )
			{
				///alert($("#RSM_CNTNT_FLAG_MIN_LEN_" + x).val() + '----' + $("#APPL_CNTNT_" + x).val().length + '----');
				if ( Number($("#RSM_CNTNT_FLAG_MIN_LEN_" + x).val()) > Number($("#APPL_CNTNT_" + x).val().length) )
				{
					alert('[' + $("#RSM_CNTNT_FLAG_TITLE_" + x).val() + '] 최소 ' + $("#RSM_CNTNT_FLAG_MIN_LEN_" + x).val() + '자 이상입니다. ');
					return 'error';
				}
			}
			x++;
		}
		
	}
	
</script>
<table class="TbStyle01 mgt10" summary="자기소개서">
	<caption>파일업로드</caption>
	  <colgroup>
	  <col width="30%" />
	  <col width="*" />
	  </colgroup>
	  <tbody>
	  <? foreach ($frmFile as $key => $data) { ?>
		<tr>
			<th scope="row" class="th-list">
				<?=$data->FILE_ESN_YN == 'Y' ? '<span class="red">*</span>' : ''?> <?=$data->FILE_TITLE?>
			</th>
			<td>
				<input type="hidden" id="RSM_FILE_FLAG_TITLE_<?=($key+1)?>" name="RSM_FILE_FLAG_TITLE_<?=($key+1)?>" value="<?=$data->FILE_TITLE?>" />
				<input type="hidden" id="RSM_FILE_FLAG_ESN_YN_<?=($key+1)?>" name="RSM_FILE_FLAG_ESN_YN_<?=($key+1)?>" value="<?=$data->FILE_ESN_YN?>" />
				<input type="hidden" id="RSM_FILE_IDX_<?=($key+1)?>" name="RSM_FILE_IDX_<?=($key+1)?>" value="<?=$data->RSM_FILE_IDX?>" />
				<input type="file" id="RSM_FILE_NM_<?=($key+1)?>" name="RSM_FILE_NM_<?=($key+1)?>" style="float:left" /> 
				<p><?=$data->FILE_COMMENT?></p>
				<p>( 파일크기 제한 : <?=$data->FILE_MAX_SIZE?> KB )<br>허용확장자 : ( <?=$data->FILE_AVL_EXT?> )</p>
				
				<? if ($data->APPL_FILE_NM != '' ) { ?><div id="RSM_FILE_MSG_<?=($key+1)?>" >[ <?=$data->APPL_FILE_NM?> ] <img id="FILE_DEL_<?=($key+1)?>" name="FILE_DEL_<?=($key+1)?>" src="<?=$FRONT_IMG_URL?>/img/board/btn_del.gif"  alt="삭제" onclick="javascript:delFileList('<?=$data->RSM_FILE_IDX?>',<?=($key+1)?>);" style="cursor:hand;"  /> </div><? } ?>
			</td>
		</tr>
		<? } ?>
	  </tbody>
</table>

<div class="textR">
	<a href="javascript:goProcess();"><img src="<?=$FRONT_IMG_URL?>/img/board/table_btn03.gif" alt="중간 저장" /></a>
</div>


<? } ?>




<p class="point-txt">※ 본인은 지원사상의 모든 기재사항은 사실과 다름이 없음을 증명하며, 차후 지원서 상의 내용의 허위로 판명되어 합격 또는 입사가 취소되더라도 이의를 제기하지 않을 것을 서약 합니다.</p>
<input type="submit" id="SUBMIT_BUTTON" value="가자임마" style="display:none">
<div class="textC">
	<a href="javascript:goProcess();">[지원서 저장]</a>
	<? if ($APPL_YN != 'Y' ) { ?><a href="javascript:goApplySubmit();"><img src="<?=$FRONT_IMG_URL?>/img/board/table_btn05.gif" alt="제출" /></a><? } ?>
</div>

<div class="box-red">
								제출을 완료 하시더라도 서류 접수 기간 내에는 입사지원서 수정이 가능 하며, 제출이 아닌 임시 저장으로 서류 기간이 마감 될 경우에는 입사지원 완료로 인정이 되지 않습니다. 반드시 입사지원서 제출 후 수험범호 발급을 완료하셔야 정상 입사지원이 됩니다.
							</div>

</form>

<form id="popupform1" name="popupform1">
<input type="hidden" id="POPUP_APPL_IDX" name="POPUP_APPL_IDX" />	
<input type="hidden" id="POPUP_PRJ_IDX" name="POPUP_PRJ_IDX" />	
<input type="hidden" id="popupTitle" name="popupTitle" />
<input type="hidden" id="popupCode" name="popupCode" />
<input type="hidden" id="popupIndex" name="popupIndex" />
<input type="hidden" id="popupDisplayType" name="popupDisplayType" />
<input type="hidden" id="popupAccCode" name="popupAccCode" />
<input type="hidden" id="popupSchCode" name="popupSchCode" />
<input type="hidden" id="popupEtcUseYn" name="popupEtcUseYn" />
</form>

<? if ($rsmdisplay[0]->FAMILY_USE_YN == 'Y') { ?>
<div id="id_fmly_sample" style="display:none">

			<table class="TbStyle01" summary="가족사항" id="id_fmly_box_set">
			<caption>가족사항</caption>
			<colgroup>
			<col width="15%" />
			<col width="*" />
			<col width="6%" />
			<col width="*" />
			<col width="10%" />
			<col width="*" />
			<col width="10%" />
			<col width="*" />
			<col width="10%" />
			<col width="*" />
			</colgroup>
			<tbody>
			<tr>
			<td class="center">
				
			<input type="hidden" name="FMLY_SEQ" id="FMLY_SEQ" value="" />	
			<?=$frmFMLY_REL_CD?><input type="hidden" name="FMLY_REL_NM" id="FMLY_REL_NM" value="" />
			</td>
			<td class="center"><input class="b_input" type="text" name="FMLY_NM" id="FMLY_NM" maxlength="25" value="" style="width:90%;" title="" /></td>
			<td class="center"><input class="b_input" type="text" name="FMLY_NAI" id="FMLY_NAI" value="" style="width:90%;" title="" maxlength="3"  /></td>
			<td class="center">
			<?=$frmFMLY_SCH_CD?><input type="hidden" name="FMLY_SCH_NM" id="FMLY_SCH_NM" value="" />
			</td>
			<td class="center"><input class="b_input" type="text" name="FMLY_JOB" maxlength="50" id="FMLY_JOB" value="" style="width:90%;" title="" /></td>
			<td class="center"><input class="b_input" type="text" name="FMLY_WRK_NM" maxlength="50" id="FMLY_WRK_NM" value="" style="width:90%;" title="" /></td>
			<td class="center"><input class="b_input" type="text" name="FMLY_WRK_PSTN" maxlength="50" id="FMLY_WRK_PSTN" value="" style="width:90%;" title="" /></td>
			<td class="center">
			<?=$frmFMLY_LIVE_YN?>
			</td>
			<td class="center">
			<?=$frmFMLY_HELP_YN?>
			</td>
			<td class="center"><img id="FMLY_DEL" name="FMLY_DEL" src="<?=$FRONT_IMG_URL?>/img/board/btn_del.gif"  alt="삭제"  /></td>
			</tr>
			</tbody>
			</table>

</div>
<? } ?>



<? if ($rsmdisplay[0]->CAREER_USE_YN == 'Y') { ?>
<div id="id_carr_sample" style="display:none">
	<table class="TbStyle01 mgt10" id="id_carr_box_set">
	<caption>경력사항 상세</caption>
  <colgroup>
  <col width="28%" />
  <col width="15%" />
  <col width="*" />
  <col width="10%" />
  </colgroup>
	<tbody>
	<tr>
		<td rowspan="5">
			<input type="hidden" id="CAREER_SEQ" name="CAREER_SEQ" />
			<input class="b_input" type="text" name="CAREER_STDT1" id="CAREER_STDT1" SIZE="4" maxlength="4" />년 <input class="b_input" type="text" name="CAREER_STDT2" id="CAREER_STDT2" maxlength="2"  SIZE="2"  />월 ~ 
			<input class="b_input" type="text" name="CAREER_EDDT1" id="CAREER_EDDT1" SIZE="4" maxlength="4" />년 <input class="b_input" type="text" name="CAREER_EDDT2" id="CAREER_EDDT2" maxlength="2"  SIZE="2"  />월
			<br>
			<?=$frmCAREER_STS_CD?><input type="hidden" id="CAREER_STS_NM" name="CAREER_STS_NM" />
		</td>
		<th scope="row"><label for="company_name">회사명</label></th>
		<td><input class="b_input" type="text" id="CAREER_CMP_NM" name="CAREER_CMP_NM" style="width:85px;" maxlength="50" /> <?=$frmCAREER_CMP_TP_CD?><input type="hidden" id="CAREER_CMP_TP_NM" name="CAREER_CMP_TP_NM" /> <?=$frmCAREER_LOC_CD?><input type="hidden" id="CAREER_LOC_NM" name="CAREER_LOC_NM" /></td>
		<td rowspan="5" class="center Lline"><img id="CARR_DEL" name="CARR_DEL" src="<?=$FRONT_IMG_URL?>/img/board/btn_del.gif"  alt="삭제"  /></td>
	</tr>
	<tr>
		<th>직종</th>
		<td><?=$frmCAREER_EMP_TP_CD?><input type="hidden" id="CAREER_EMP_TP_NM" name="CAREER_EMP_TP_NM" /> <input class="b_input" type="text" name="CAREER_JOB_TP_NM" id="CAREER_JOB_TP_NM"  style="width:120px;" readonly /><input type="hidden" name="CAREER_JOB_TP_CD" id="CAREER_JOB_TP_CD" /> 
			<img id="BTN_SEARCH_JOBTYPE" name="BTN_SEARCH_JOBTYPE" src="<?=$FRONT_IMG_URL?>/img/board/btn_search.gif" alt="검색" />
		</td>
	</tr>
	<tr>
		<th>근무부서/직위</th>
		<td>부서명 : <input class="b_input" type="text" name="CAREER_DEPT_NM" id="CAREER_DEPT_NM" style="width:140px;"  maxlength="50" /> <?=$frmCAREER_PSTN_CD?><input type="hidden" id="CAREER_PSTN_NM" name="CAREER_PSTN_NM" /> <?=$frmCAREER_PSTN_LVL_CD?><input type="hidden" id="CAREER_PSTN_LVL_NM" name="CAREER_PSTN_LVL_NM" /></td>
	</tr>
	<tr>
		<th>업무내용</th>
		<td><textarea class="b_input" type="text" name="CAREER_CNTNT" id="CAREER_CNTNT" style="width:95%;" /></textarea></td>
	</tr>
	<tr>
		<th>퇴사사유</th>
		<td><?=$frmCAREER_RETIRE_CD?><input type="hidden" name="CAREER_RETIRE_NM" id="CAREER_RETIRE_NM" /> </td>
	</tr>
	</tbody>
	</table>
</div>	
<? } ?>

<? if ($rsmdisplay[0]->WRITE_USE_YN == 'Y') { ?>
<div id="id_wrte_sample" style="display:none">
	<table class="TbStyle01 mgt10" summary="저술내역" id="id_wrte_box_set">	
		 <colgroup>
		  <col width="22%" />
		  <col width="22%" />
		  <col width="*" />
		  <col width="10%" />
		  </colgroup>
		  <tbody>
		<tr>
			<td class="center"><input class="b_input" type="text" name="WRT_NM" maxlength="50" id="WRT_NM"/><input type="hidden" id="WRT_SEQ" name="WRT_SEQ" /></td>
			<td class="center"><input class="b_input" type="text" name="WRT_PB" maxlength="50" id="WRT_PB" /></td>
			<td class="center">
					<input class="b_input" type="text" name="WRT_DT1" id="WRT_DT1" style="width:30px;" maxlength="4" />  <label for="">년</label> 
					<input class="b_input" type="text" name="WRT_DT2" id="WRT_DT2" style="width:20px;" maxlength="2"  />  <label for="">월</label> 
					<input class="b_input" type="text" name="WRT_DT3" id="WRT_DT3" style="width:20px;" maxlength="2"  />  <label for="">일</label> 
			</td>
			<td class="center"><img id="WRTE_DEL" name="WRTE_DEL" src="<?=$FRONT_IMG_URL?>/img/board/btn_del.gif"  alt="삭제"  /></td>
		</tr>
	</tbody>
	</table>
</div>	
<? } ?>

<? if ($rsmdisplay[0]->PRIZE_USE_YN == 'Y') { ?>
<div id="id_prze_sample" style="display:none">
	
	<table class="TbStyle01 mgt10" summary="수상내역" id="id_prze_box_set">	
		 <colgroup>
		  <col width="22%" />
		  <col width="22%" />
		  <col width="*" />
		  <col width="10%" />
		  </colgroup>
		  <tbody>
		<tr>
			<td class="center"><input class="b_input" type="text" name="PRZ_NM" id="PRZ_NM" maxlength="50" /><input type="hidden" id="PRZ_SEQ" name="PRZ_SEQ" /></td>
			<td class="center"><input class="b_input" type="text" name="PRZ_PB_NM" id="PRZ_PB_NM" maxlength="50" /></td>
			<td class="center">
					<input class="b_input" type="text" name="PRZ_DT1" id="PRZ_DT1" style="width:30px;" maxlength="4" />  <label for="">년</label> 
					<input class="b_input" type="text" name="PRZ_DT2" id="PRZ_DT2" style="width:20px;" maxlength="2"  />  <label for="">월</label> 
					<input class="b_input" type="text" name="PRZ_DT3" id="PRZ_DT3" style="width:20px;" maxlength="2"  />  <label for="">일</label> 
			</td>
			<td class="center"><img id="PRZE_DEL" name="PRZE_DEL" src="<?=$FRONT_IMG_URL?>/img/board/btn_del.gif"  alt="삭제"  /></td>
		</tr>
	</tbody>
	</table>
	
</div>	
<? } ?>

<? if ($rsmdisplay[0]->LANGUAGE2_USE_YN == 'Y') { ?>
<div id="id_lan2_sample" style="display:none">
	
	<table class="TbStyle01 mgt10" summary="어학능력" id="id_lan2_box_set">	
		 <colgroup>
		  <col width="22%" />
		  <col width="*" />
		  <col width="*" />
		  <col width="*" />
		  <col width="10%" />
		  </colgroup>
		  <tbody>
		<tr>
			<td class="center"><?=$frmLANG2_CD?><input type="hidden" name="LANG2_NM" id="LANG2_NM" /><input type="hidden" id="LANG2_SEQ" name="LANG2_SEQ" /></td>
			<td class="center"><?=$frmLANG2_SPCH_LVL_CD?><input type="hidden" name="LANG2_SPCH_LVL_NM" id="LANG2_SPCH_LVL_NM" /></td>
			<td class="center"><?=$frmLANG2_WRT_LVL_CD?><input type="hidden" name="LANG2_WRT_LVL_NM" id="LANG2_WRT_LVL_NM" /></td>
			<td class="center"><?=$frmLANG2_CMP_LVL_CD?><input type="hidden" name="LANG2_CMP_LVL_NM" id="LANG2_CMP_LVL_NM" /></td>
			<td class="center"><img id="LAN2_DEL" name="LAN2_DEL" src="<?=$FRONT_IMG_URL?>/img/board/btn_del.gif"  alt="삭제"  /></td>
		</tr>
	</tbody>
	</table>
	
</div>	
<? } ?>

<? if ($rsmdisplay[0]->LICENSE_USE_YN == 'Y') { ?>
<div id="id_lics_sample" style="display:none">
	
	<table class="TbStyle01 mgt10" summary="자격능력" id="id_lics_box_set">	
	 <colgroup>
	  <col width="*" />
	  <col width="*" />
		<col width="*" />
	  <col width="*" />
	  <col width="10%" />
	  </colgroup>
		<tbody>
		<tr>
			<td class="center">
				<input type="hidden" id="LIC_SEQ" name="LIC_SEQ" />
				<input class="b_input" type="text" name="LIC_NM" id="LIC_NM" readonly style="width:100px;" />
				<input type="hidden" name="LIC_CD" id="LIC_CD" />
				<img id="BTN_SEARCH_LICENSE" name="BTN_SEARCH_LICENSE" src="<?=$FRONT_IMG_URL?>/img/board/btn_search.gif" alt="검색" />
			</td>
			<td class="center"><input class="b_input" type="text" name="LIC_PB_NM" id="LIC_PB_NM" maxlength="50" /></td>
			<td class="center">
				<input class="b_input" type="text" id="LIC_DT1" name="LIC_DT1" style="width:30px;" maxlength="4" />  <label for="">년</label> 
				<input class="b_input" type="text" id="LIC_DT2" name="LIC_DT2" style="width:20px;" maxlength="2"  />  <label for="">월</label> 
				<input class="b_input" type="text" id="LIC_DT3" name="LIC_DT3" style="width:20px;" maxlength="2"   />  <label for="">일</label> 
			</td>
			<td><input class="b_input" type="text" id="LIC_NUM" name="LIC_NUM" style="width:90%;" maxlength="25" /></td>
			<td class="center"><img id="LICS_DEL" name="LICS_DEL" src="<?=$FRONT_IMG_URL?>/img/board/btn_del.gif"  alt="삭제"  /></td>
		</tr>
	</tbody>
	</table>
	
</div>	
<? } ?>

<? if ($rsmdisplay[0]->SERVE_USE_YN == 'Y') { ?>
<div id="id_srve_sample" style="display:none">
	
	<table class="TbStyle01 mgt10" summary="주요활동 및 사회경험" id="id_srve_box_set">
		 <colgroup>
	  <col width="32%" />
	  <col width="15%" />
	  <col width="*" />
	  <col width="10%" />
	  </colgroup>
		  <tbody>
			<tr>
				<td rowspan="3">
					<input type="hidden" id="SRV_SEQ" name="SRV_SEQ" />
					<input class="b_input" type="text" name="SRV_STDT1" id="SRV_STDT1" value="" style="width:30px;" maxlength="4" /> <label for="">년</label>
					<input class="b_input" type="text" name="SRV_STDT2" id="SRV_STDT2" value="" style="width:20px;" maxlength="2" /> <label for="">월</label> ~ 
					<input class="b_input" type="text" name="SRV_EDDT1" id="SRV_EDDT1" value="" style="width:30px;" maxlength="4" /> <label for="">년</label>
					<input class="b_input" type="text" name="SRV_EDDT2" id="SRV_EDDT2" value="" style="width:20px;" maxlength="2" /> <label for="">월</label>
				</td>
				<th scope="row"><label for="active_kind">활동구분</label></th>
				<td>
					<?=$frmSRV_TP_CD?><input type="hidden" id="SRV_TP_NM" name="SRV_TP_NM" />
				</td>
				<td rowspan="4" class="center Lline"><img id="SRVE_DEL" name="SRVE_DEL" src="<?=$FRONT_IMG_URL?>/img/board/btn_del.gif"  alt="삭제"  /></td>
			</tr>
			<tr>
				<th scope="row"><label for="ogani">기관/장소</label></th>
				<td>
					<input class="b_input" type="text" name="SRV_ORG_NM" id="SRV_ORG_NM"  maxlength="50" value="" maxlength="50" style="width:95%;" title="기관/장소입력" />
				</td>
			</tr>
			<tr>
				<th scope="row"><label for="active_content">활동내용</label></th>
				<td><textarea name="SRV_CNTNT" rows="" cols="" id="SRV_CNTNT" style="width:95%;"></textarea></td>
			</tr>
		  </tbody>
	</table>
	
</div>			
<? } ?>

<? if ($rsmdisplay[0]->TECH_USE_YN == 'Y') { ?>
<div id="id_tech_sample" style="display:none">
	
	<table class="TbStyle01 mgt10" summary="보유기술 및 능력" id="id_tech_box_set">
		<colgroup>
	  <col width="32%" />
	  <col width="15%" />
	  <col width="*" />
	  <col width="10%" />
	  </colgroup>
	<tbody>
	<tr>
		<td><input class="b_input" type="text" name="TCH_NM" maxlength="50" id="TCH_NM" style="width:95%;" title="교육기관입력" /><input type="hidden" id="TCH_SEQ" name="TCH_SEQ" /> </td>
		<td><input class="b_input" type="text" name="TCH_LVL" maxlength="50" id="TCH_LVL" style="width:95%;" title="교육기관입력" /></td>
		<td><textarea name="TCH_CNTNT" rows="" cols="" id="TCH_CNTNT" style="width:95%;"></textarea></td>
		<td rowspan="4" class="center"><img id="TECH_DEL" name="TECH_DEL" src="<?=$FRONT_IMG_URL?>/img/board/btn_del.gif"  alt="삭제"  /></td>
	</tr>
  </tbody>
	</table>

</div>		
<? } ?>	

<? if ($rsmdisplay[0]->EDUCATION_USE_YN == 'Y') { ?>
<div id="id_educ_sample" style="display:none">
	
<table class="TbStyle01 mgt10" summary="교육이수 내역" id="id_educ_box_set">
<caption>교육이수 내역</caption>
  <colgroup>
  <col width="32%" />
  <col width="15%" />
  <col width="*" />
  <col width="10%" />
  </colgroup>
	<tbody>
		<tr>
			<td rowspan="3">
				
				<input type="hidden" id="EDU_SEQ" name="EDU_SEQ" />
				<input class="b_input" type="text" name="EDU_STDT1" id="EDU_STDT1" value="" style="width:30px;" maxlength="4" /> <label for="">년</label>
				<input class="b_input" type="text" name="EDU_STDT2" id="EDU_STDT2" value="" style="width:20px;" maxlength="2" /> <label for="">월</label> ~ 
				<input class="b_input" type="text" name="EDU_EDDT1" id="EDU_EDDT1" value="" style="width:30px;" maxlength="4" /> <label for="">년</label>
				<input class="b_input" type="text" name="EDU_EDDT2" id="EDU_EDDT2" value="" style="width:20px;" maxlength="2" /> <label for="">월</label>
			</td>
			<th scope="row"><label for="edu_name">교육명</label></th>
			<td>
				<input class="b_input" type="text" name="EDU_NM" id="EDU_NM" value="" style="width:95%;" title="교육명입력" maxlength="50" />
			</td>
			<td rowspan="4" class="center Lline"><img id="EDUC_DEL" name="EDUC_DEL" src="<?=$FRONT_IMG_URL?>/img/board/btn_del.gif"  alt="삭제"   /></td>
		</tr>
		<tr>
			<th scope="row"><label for="ogani_03">교육기관</label></th>
			<td>
				<input class="b_input" type="text" name="EDU_ORG_NM" id="EDU_ORG_NM" value="" style="width:95%;" title="교육기관입력" maxlength="50" />
			</td>
		</tr>
		<tr>
			<th scope="row"><label for="active_content_03">교육내용</label></th>
			<td><textarea name="EDU_CNTNT" rows="" cols="" id="EDU_CNTNT" style="width:95%;"></textarea></td>
		</tr>
	  </tbody>
	</table>
	
</div>			
<? } ?>	

<? if ($rsmdisplay[0]->TRAINING_USE_YN == 'Y') { ?>
<div id="id_trng_sample" style="display:none">
	
	<table class="TbStyle01 mgt10" summary="교육이수 내역" id="id_trng_box_set">
	<caption></caption>
  <colgroup>
  <col width="32%" />
  <col width="15%" />
  <col width="*" />
  <col width="10%" />
  </colgroup>
	<tbody>
		<tr>
			<td rowspan="4">
				<input type="hidden" id="TRN_SEQ" name="TRN_SEQ" />
				<input class="b_input" type="text" name="TRN_STDT1" id="TRN_STDT1" value="" style="width:30px;" maxlength="4" /> <label for="">년</label>
				<input class="b_input" type="text" name="TRN_STDT2" id="TRN_STDT2" value="" style="width:20px;" maxlength="2" /> <label for="">월</label> ~ 
				<input class="b_input" type="text" name="TRN_EDDT1" id="TRN_EDDT1" value="" style="width:30px;" maxlength="4" /> <label for="">년</label>
				<input class="b_input" type="text" name="TRN_EDDT2" id="TRN_EDDT2" value="" style="width:20px;" maxlength="2" /> <label for="">월</label>
			</td>
			<th scope="row"><label for="trn_name">구분및 국가</label></th>
			<td><?=$frmTRN_TP_CD?><input type="hidden" id="TRN_TP_NM" name="TRN_TP_NM" /> 국가명 : <input class="b_input" type="text" name="TRN_CTRY_NM" id="TRN_CTRY_NM" value="" maxlength="50" style="width:100px;" title="교육명입력" />
			</td>
			<td rowspan="5" class="center Lline"><img id="TRNG_DEL" name="TRNG_DEL" src="<?=$FRONT_IMG_URL?>/img/board/btn_del.gif"  alt="삭제"  /></td>
		</tr>
		<tr>
			<th scope="row"><label for="ogani_03">기관/단체</label></th>
			<td>
				<input class="b_input" type="text" name="TRN_ORG_NM" id="TRN_ORG_NM" value="" style="width:95%;" title="" maxlength="50" />
			</td>
		</tr>
		<tr>
			<th scope="row"><label for="ogani_03">목적</label></th>
			<td>
				<input class="b_input" type="text" name="TRN_OBJ_NM" id="TRN_OBJ_NM" value="" style="width:95%;" title="" maxlength="50" />
			</td>
		</tr>
		<tr>
			<th scope="row"><label for="active_content_03">활동내용</label></th>
			<td><textarea name="TRN_CNTNT" rows="" cols="" id="TRN_CNTNT" style="width:95%;"></textarea></td>
		</tr>
	  </tbody>
	</table>
	
</div>	
<? } ?>


<? if ($rsmdisplay[0]->SCHOOL_USE_YN == 'Y') { ?>
<div id="id_schl_sample" style="display:none">
	
	<table class="TbStyle01 mgt10" summary="학력사항" id="id_schl_box_set">
	<caption>학력사항</caption>
	  <colgroup>
	  <col width="15%" />
	  <col width="*" />
	  <col width="10%" />
	  </colgroup>
	  <tbody>
	  <tr>
	  	<th scope="row">학력구분</th>
	  	<td colspan="2">
	  		<div style="text-align:left;float:left"><?=$frmSCH_TP?> 학력구분 먼저 선택하세요.</div>
	  		<div style="text-align:right">
				<input type="checkbox" class="checkbox" name="SCH_FGRD_TP" id="SCH_FGRD_TP" value="Y" />
				<label for="last_academic">최종학력일 경우 체크</label>
				</div>
	  	</td>
		</tr>
		<tr>
			<th scope="row"><label for="school_name_02">학교명</label></th>
			<td colspan=2>
				<input type="hidden" name="SCH_SEQ" id="SCH_SEQ" />
				<input class="b_input" type="text" name="SCH_NM" id="SCH_NM" value="" title="학교명입력" readonly />
				<input type="hidden" size="10" id="SCH_CD" name="SCH_CD">
				<img src="<?=$FRONT_IMG_URL?>/img/board/btn_search.gif" alt="검색" id="BTN_SEARCH_SCHOOL" name="BTN_SEARCH_SCHOOL" />
				<?=$frmSCH_JUYA?>
				<?=$frmSCH_BRANCH_TP?>
				<?=$frmSCH_LOC?>
			</td>
			
		</tr>
		<tr>
			<th scope="row"><label for="school_term_01_01">재학기간</label></th>
			<td>
				<input class="b_input" type="text" name="SCH_STDT1" id="SCH_STDT1" value="" style="width:30px;" maxlength="4" /> <label for="">년</label>
				<input class="b_input" type="text" name="SCH_STDT2" id="SCH_STDT2" value="" style="width:20px;" maxlength="2"  /> <label for="">월</label>
				<?=$frmSCH_ETTP1?> ~ 
				<input class="b_input" type="text" name="SCH_EDDT1" id="SCH_EDDT1" value="" style="width:30px;" maxlength="4" /> <label for="">년</label>
				<input class="b_input" type="text" name="SCH_EDDT2" id="SCH_EDDT2" value="" style="width:20px;" maxlength="2"  /> <label for="">월</label>
				<?=$frmSCH_ETTP2?>
			</td>
			<td rowspan="2" class="center Lline"><img id="SCHL_DEL" name="SCHL_DEL" src="<?=$FRONT_IMG_URL?>/img/board/btn_del.gif"  alt="삭제"  /></td>
		</tr>
		<tr>
			<th scope="row">전공 및 학점</th>
			<td>
				
				<ul>
					<li>
				
						<div style="width:50px;float:left">전공</div>
						<div style="width:100px;float:left">계열 학과(전공)</div>
						<?=$frmSCH_AFF?>
						
						<input type="hidden" size="10" id="SCH_MAJOR_CD" name="SCH_MAJOR_CD">
						<input class="b_input" type="text" name="SCH_MAJOR_NM" id="SCH_MAJOR_NM" value="" title="전공학과입력" readonly />
						<img src="<?=$FRONT_IMG_URL?>/img/board/btn_search.gif" alt="검색" id="BTN_SEARCH_MAJOR" name="BTN_SEARCH_MAJOR" />
					</li>
					<li>
						<div style="width:50px;float:left"></div>
						<div style="width:60px;float:left">취득학점</div>
						<input class="b_input" type="text" name="SCH_HAKJUM" id="SCH_HAKJUM" value="" style="width:30px" title="취득학점입력"  />
						<span class="space">/</span>
						<?=$frmSCH_MAX_HAKJUM?>
						&nbsp;&nbsp;이수학점
						<input class="b_input" type="text" name="SCH_ISU_HAKJUM" id="SCH_ISU_HAKJUM" value="" style="width:40px;" title="이수학점입력" />
					</li>
					<li>
						<div style="width:50px;float:left">부전공</div>
						<div style="width:100px;float:left">구분 선택</div>
						<?=$frmSCH_SUB_MAJOR_TP?>
					</li>
					<li id="id_sub_major_form" style="display:none">
						
						<div style="width:50px;float:left">부전공</div>
						<div style="width:100px;float:left">계열 학과(전공)</div>
						
						<?=$frmSCH_SUB_AFF?>
						<input class="b_input" type="text" name="SCH_SUB_MAJOR_NM" id="SCH_SUB_MAJOR_NM" value="" title="부/복수 전공 학과입력" readonly />
						<input type="hidden" size="10" id="SCH_SUB_MAJOR_CD" name="SCH_SUB_MAJOR_CD">
						<img src="<?=$FRONT_IMG_URL?>/img/board/btn_search.gif" alt="검색" id="BTN_SEARCH_SUB_MAJOR" name="BTN_SEARCH_SUB_MAJOR" />
					</li>
				</ul>
					
			</td>
		</tr>
		
	  </tbody>
	</table>

</div>


		<!-- 고등학교 항목 -->
		<div id="id_sch_type1_highschool" style="display:none">
		<input type="hidden" id="SCH_SEQ_1" name="SCH_SEQ_1" value="<?=$SCH_SEQ_1?>" />
		<input class="b_input" type="text" name="SCH_NM_1" id="SCH_NM_1" value="<?=$SCH_NM_1?>" readonly />
		<input type="hidden" size="10" id="SCH_CD_1" name="SCH_CD_1" value="<?=$SCH_CD_1?>">
		<img src="<?=$FRONT_IMG_URL?>/img/board/btn_search.gif" alt="검색" onclick="javascript:searchPopSch('학교','school',25,1,'SCH','Y','L','width=500 height=550');" style="cursor:hand;" />

		<?=$frmSCH_JUYA_1?>
		<?=$frmSCH_BRANCH_TP_1?>
		<?=$frmSCH_LOC_1?>
		</div>
	
		<div id="id_sch_type2_highschool" style="display:none">
		<input class="b_input" type="text" name="SCH_STDT1_1" id="SCH_STDT1_1" value="<?=$SCH_STDT1_1?>" style="width:30px;" maxlength="4" onblur="CheckFormDate('SCH_STDT','1')&CheckTermDate('SCH','1');" /> <label for="">년</label>
		<input class="b_input" type="text" name="SCH_STDT2_1" id="SCH_STDT2_1" value="<?=$SCH_STDT2_1?>" style="width:20px;" maxlength="2" onblur="javascript:setNum2str(this)&CheckFormDate('SCH_STDT','1')&CheckTermDate('SCH','1');" /> <label for="">월</label>
		<?=$frmSCH_ETTP1_1?> ~ 
		
		<input class="b_input" type="text" name="SCH_EDDT1_1" id="SCH_EDDT1_1" value="<?=$SCH_EDDT1_1?>" style="width:30px;" maxlength="4" onblur="CheckFormDate('SCH_EDDT','1')&CheckTermDate('SCH','1');" /> <label for="">년</label>
		<input class="b_input" type="text" name="SCH_EDDT2_1" id="SCH_EDDT2_1" value="<?=$SCH_EDDT2_1?>" style="width:20px;" maxlength="2" onblur="javascript:setNum2str(this)&CheckFormDate('SCH_EDDT','1')&CheckTermDate('SCH','1');" /> <label for="">월</label>
		<?=$frmSCH_ETTP2_1?>
		</div>
	
		<!-- 검정고시 항목 -->
		<div id="id_sch_type1_blackgosi" style="display:none">
		<input type="hidden" id="SCH_SEQ_1" name="SCH_SEQ_1" value="<?=$SCH_SEQ_1?>" />
		<input class="b_input" type="hidden" name="SCH_NM_1" id="SCH_NM_1" value="검정고시" title="학교명입력" readonly />
		<input type="hidden" size="10" id="SCH_CD_1" name="SCH_CD_1" value="13">
		<input type="hidden" id="SCH_JUYA_1" name="SCH_JUYA_1" value="" />
		<input type="hidden" id="BRANCH_TP_1" name="BRANCH_TP_1" value="" />
		<?=$frmSCH_LOC_1?>
		</div>
		
		<div id="id_sch_type2_blackgosi" style="display:none">
		<input class="b_input" type="text" name="SCH_EDDT1_1" id="SCH_EDDT1_1" value="<?=$SCH_EDDT1_1?>" style="width:30px;" maxlength="4" onblur="CheckFormDate('SCH_EDDT','1');"  /> <label for="">년</label>
		<input class="b_input" type="text" name="SCH_EDDT2_1" id="SCH_EDDT2_1" value="<?=$SCH_EDDT2_1?>" style="width:20px;" maxlength="2" onblur="javascript:setNum2str(this)&CheckFormDate('SCH_EDDT','1');" /> <label for="">월</label>
		<input class="b_input" type="text" name="SCH_EDDT3_1" id="SCH_EDDT3_1" value="<?=$SCH_EDDT3_1?>" style="width:20px;" maxlength="2" onblur="javascript:setNum2str(this)&CheckFormDate('SCH_EDDT','1');" /> <label for="">일</label>
		<input type="hidden" id="SCH_ETTP2_1" name="SCH_ETTP2_1" value="19" />
		</div>

<? } ?>

<? foreach ($cmtData as $key => $cmtList) { ?>	
	<div id="dialog_for_<?=$cmtList->DFC_CD?>" style="display:none">
	<?=String2Html($cmtList->DFC_CNTNT)?>
	</div>
<? } ?>

