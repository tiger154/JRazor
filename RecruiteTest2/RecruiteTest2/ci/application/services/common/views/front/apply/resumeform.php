<script language="javascript" src="/assets/js/jquery-ui.js"></script>
<link rel="stylesheet" type="text/css" href="/assets/css/jqueryui.css" />
<script language="javascript" src="/assets/js/jquery.validate.js"></script>
<script>
	
	/* �߰���Ʈ�� �ִ°͵� �ѹ濡 �۾��ϱ� */
	
	//1. ���� ����
	
	// ������� 
	var commonMainNameAr = new Array('��������','�ؿܿ����� �ؿܰ���','��������','������� ����','�ֿ�Ȱ���� ��ȸ����','�ڰ���','���дɷ�','���󳻿�','��������','��»���','�з»���');
	var commonMainCodeAr = new Array('fmly','trng','educ','tech','srve','lics','lan2','prze','wrte','carr','schl');
	
	for (vini = 0 ; vini < commonMainCodeAr.length ; vini ++ ) eval('var ' + commonMainCodeAr[vini] + 'MaxCount = 0;');
	for (vini = 0 ; vini < commonMainCodeAr.length ; vini ++ ) eval('var ' + commonMainCodeAr[vini] + 'List = 0;');
	for (vini = 0 ; vini < commonMainCodeAr.length ; vini ++ ) eval('var ' + commonMainCodeAr[vini] + 'formListAr = null;');
	
	// �������� : fmly
	
	<? if ($rsmdisplay[0]->FAMILY_USE_YN == 'Y') { ?>
	//fmlyRs
	fmlyMaxCount = <?=$rsmdisplay[0]->FAMILY_FORM_CNT;?>;
	fmlyList = <?=count($fmlyRs) > 0 ? count($fmlyRs) + 1 : 1;?>;
	fmlyformListAr = {'FMLY_SEQ':'�ڵ�',
												'FMLY_REL_CD':'��������',
												'FMLY_REL_NM':'��������',
												'FMLY_NM':'�̸�',
												'FMLY_NAI':'����',
												'FMLY_SCH_NM':'�з�',
												'FMLY_SCH_CD':'�з�',
												'FMLY_JOB':'����',
												'FMLY_WRK_NM':'�����',
												'FMLY_WRK_PSTN':'����',
												'FMLY_LIVE_YN':'���ſ���',
												'FMLY_HELP_YN':'�ξ翩��',
												'FMLY_DEL':'����'};
	<? } ?>
	// �ؿܿ��� �� �ؿܰ���
	<? if ($rsmdisplay[0]->TRAINING_USE_YN == 'Y') { ?>
	trngMaxCount = <?=$rsmdisplay[0]->TRAINING_FORM_CNT;?>;
	trngList = <?=count($trngRs) > 0 ? count($trngRs) + 1 : 1;?>;
	trngformListAr = {'TRN_STDT1':'���� �Ⱓ[��]',
												'TRN_STDT2':'���� �Ⱓ[��]',
												'TRN_EDDT1':'���� �Ⱓ[��]',
												'TRN_EDDT2':'���� �Ⱓ[��]',
												'TRN_TP_CD':'����',
												'TRN_TP_NM':'����',
												'TRN_CTRY_NM':'������',
												'TRN_ORG_NM':'���/��ü��',
												'TRN_OBJ_NM':'����',
												'TRN_CNTNT':'Ȱ������',
												'TRNG_DEL':'����'};
	<? } ?>
	// ��������  
	<? if ($rsmdisplay[0]->EDUCATION_USE_YN == 'Y') { ?>
	educMaxCount = <?=$rsmdisplay[0]->EDUCATION_FORM_CNT;?>;
	educList = <?=count($educRs) > 0 ? count($educRs) + 1 : 1;?>;
	educformListAr = {'EDU_STDT1':'���� �Ⱓ[��]',
												'EDU_STDT2':'���� �Ⱓ[��]',
												'EDU_EDDT1':'���� �Ⱓ[��]',
												'EDU_EDDT2':'���� �Ⱓ[��]',
												'EDU_NM':'������',
												'EDU_ORG_NM':'���/��ü��',
												'EDU_CNTNT':'����',
												'EDUC_DEL':'����'};
	
	<? } ?>
	// ������� �� �ɷ�
	
	<? if ($rsmdisplay[0]->TECH_USE_YN == 'Y') { ?>
	techMaxCount = <?=$rsmdisplay[0]->TECH_FORM_CNT;?>;
	techList = <?=count($techRs) > 0 ? count($techRs) + 1 : 1;?>;
	techformListAr = {'TCH_SEQ':'�ڵ�',
												'TCH_NM':'�����ɷ�',
												'TCH_LVL':'����',
												'TCH_CNTNT':'����',
												'TECH_DEL':'����'};
	
	<? } ?>
	// �ֿ�Ȱ���� ��ȸ����
	<? if ($rsmdisplay[0]->SERVE_USE_YN == 'Y') { ?>
	srveMaxCount = <?=$rsmdisplay[0]->SERVE_FORM_CNT;?>;
	srveList = <?=count($srveRs) > 0 ? count($srveRs) + 1 : 1;?>;
	srveformListAr = {'SRV_STDT1':'���� �Ⱓ[��]',
												'SRV_STDT2':'���� �Ⱓ[��]',
												'SRV_EDDT1':'���� �Ⱓ[��]',
												'SRV_EDDT2':'���� �Ⱓ[��]',
												'SRV_TP_CD':'Ȱ������',
												'SRV_TP_NM':'Ȱ������',
												'SRV_ORG_NM':'���',
												'SRV_CNTNT':'Ȱ������',
												'SRVE_DEL':'����'};
	<? } ?>
	
	// �ڰ���
	<? if ($rsmdisplay[0]->LICENSE_USE_YN == 'Y') { ?>
	licsMaxCount = <?=$rsmdisplay[0]->LICENSE_FORM_CNT;?>;	
	licsList = <?=count($licRs) > 0 ? count($licRs) + 1 : 1;?>;
	licsformListAr = {'LIC_NM':'�ڰ���',
												'LIC_CD':'�ڰ���',
												'LIC_NUM':'�ڰ� ��ȣ',
												'LIC_PB_NM':'����ó/�߱ޱ��',
												'LIC_DT1':'�������',
												'LIC_DT2':'�������',
												'LIC_DT3':'�������',
												'LICS_DEL':'����',
												'BTN_SEARCH_LICENSE':'�˻���ư'};
	<? } ?>
	// ���дɷ� - �׳� �ɼ� ���
	<? if ($rsmdisplay[0]->LANGUAGE2_USE_YN == 'Y') { ?>
	lan2MaxCount = <?=$rsmdisplay[0]->LANGUAGE2_FORM_CNT;?>;	
	lan2List = <?=count($lan2Rs) > 0 ? count($lan2Rs) + 1 : 1;?>;
	lan2formListAr = {'LANG2_SEQ':'�ڵ�',
												'LANG2_CD':'����',
												'LANG2_NM':'����',
												'LANG2_SPCH_LVL_CD':'���ϱ�ɷ�',
												'LANG2_SPCH_LVL_NM':'���ϱ�ɷ�',
												'LANG2_WRT_LVL_CD':'����ɷ�',
												'LANG2_WRT_LVL_NM':'����ɷ�',
												'LANG2_CMP_LVL_CD':'���شɷ�',
												'LANG2_CMP_LVL_NM':'���شɷ�',
												'LAN2_DEL':'����'};
												
	<? } ?>								
	// ��޴�
	<? if ($rsmdisplay[0]->PRIZE_USE_YN == 'Y') { ?>
	przeMaxCount = <?=$rsmdisplay[0]->PRIZE_FORM_CNT;?>;	
	przeList = <?=count($przeRs) > 0 ? count($przeRs) + 1 : 1;?>;
	przeformListAr = {'PRZ_SEQ':'�ڵ�',
												'PRZ_DT1':'��������',
												'PRZ_DT2':'��������',
												'PRZ_DT3':'��������',
												'PRZ_NM':'�����',
												'PRZ_PB_NM':'����/���ó',
												'PRZE_DEL':'����'};
	<? } ?>											
	// �۾���
	<? if ($rsmdisplay[0]->WRITE_USE_YN == 'Y') { ?>
	wrteMaxCount = <?=$rsmdisplay[0]->WRITE_FORM_CNT;?>;		
	wrteList = <?=count($wrteRs) > 0 ? count($wrteRs) + 1 : 1;?>;
	wrteformListAr = {'WRT_SEQ':'�ڵ�',
												'WRT_DT1':'��������',
												'WRT_DT2':'��������',
												'WRT_DT3':'��������',
												'WRT_NM':'������',
												'WRT_PB':'����/����ó',
												'WRTE_DEL':'����'};
	<? } ?>
	// ��»��� 
	<? if ($rsmdisplay[0]->CAREER_USE_YN == 'Y') { ?>
	carrMaxCount = <?=$rsmdisplay[0]->CAREER_FORM_CNT;?>;			
	carrList = <?=count($carrRs) > 0 ? count($carrRs) + 1 : 1;?>;
	carrformListAr = {'CAREER_SEQ':'�ڵ�',
												'CAREER_STDT1':'���۱Ⱓ[��]',
												'CAREER_STDT2':'���۱Ⱓ[��]',
												'CAREER_EDDT1':'����Ⱓ[��]',
												'CAREER_EDDT2':'����Ⱓ[��]',
												'CAREER_STS_CD':'�������',
												'CAREER_STS_NM':'�������',
												'CAREER_CMP_NM':'ȸ���',
												'CAREER_CMP_CD':'ȸ���',
												'CAREER_CMP_TP_CD':'�������',
												'CAREER_CMP_TP_NM':'�������',
												'CAREER_JOB_TP_CD':'����',
												'CAREER_JOB_TP_NM':'������',
												'CAREER_DEPT_NM':'�μ�',
												'CAREER_RETIRE_CD':'������',
												'CAREER_RETIRE_NM':'������',
												'CAREER_LOC_CD':'ȸ�� ������',
												'CAREER_LOC_NM':'ȸ�� ������',
												'CAREER_PSTN_CD':'����',
												'CAREER_PSTN_NM':'����',
												'CAREER_PSTN_LVL_CD':'��å',
												'CAREER_PSTN_LVL_NM':'��å',
												'CAREER_EMP_TP_CD':'�������',
												'CAREER_EMP_TP_NM':'�������',
												'CAREER_CNTNT':'��������',
												'CARR_DEL':'����',
												'BTN_SEARCH_JOBTYPE':'�����˻�'};
	
	<? } ?>
	
	<? if ($rsmdisplay[0]->SCHOOL_USE_YN == 'Y') { ?>
	// ����б� �Է��� �̸� �־ 2���ͽ���
	schlMaxCount = <?=$rsmdisplay[0]->SCHOOL_FORM_CNT;?>;			
	schlList = <?=count($schlRs) > 0 ? count($schlRs) + 1 : 2;?>;	
	schlformListAr = 				 { 'SCH_SEQ':'�ڵ�'
																,'SCH_CD':'�б��ڵ�'
																,'SCH_TP':'�з±���'
																,'SCH_FGRD_TP':'�����з±���'
																,'SCH_NM':'�б���'
																,'SCH_JUYA':'�־�'
																,'SCH_BRANCH_TP':'��������'
																,'SCH_LOC':'������'
																,'SCH_STDT1':'������'
																,'SCH_STDT2':'������'
																,'SCH_EDDT1':'������'
																,'SCH_EDDT2':'������'
																,'SCH_ETTP1':'���б���'
																,'SCH_ETTP2':'��������'
																,'SCH_MAJOR_NM':'������'
																,'SCH_MAJOR_CD':'�����ڵ�'
																,'SCH_AFF':'�迭'
																,'SCH_SUB_MAJOR_NM':'��������'
																,'SCH_SUB_MAJOR_CD':'�������ڵ�'
																,'SCH_SUB_AFF':'�������迭'
																,'SCH_SUB_MAJOR_TP':'����������'
																,'SCH_HAKJUM':'����'
																,'SCH_ISU_HAKJUM':'�̼�����'
																,'SCH_MAX_HAKJUM':'����'
																,'SCHL_DEL':'����'
																,'BTN_SEARCH_SCHOOL':'��ư1'
																,'BTN_SEARCH_MAJOR':'��ư2'
																,'BTN_SEARCH_SUB_MAJOR':'��ư3'};
	<? } ?>
	
	// �⺻������ �Ѱ��̻��� �׸��� �������� �۾�
	function bodyOnLoadAutoBoxOpen()
	{
		// �·ε忡�� �� ��ư �̺�Ʈ ���
		for (var a = 0 ; a < commonMainCodeAr.length ; a ++)
		{
			var currentIdx = eval(commonMainCodeAr[a] + 'List');
				
			//1���� ũ�ٴ� ���� �̹� ��ϵ� �����Ͱ� �ִٳ�
			//�������׿��� ���������� ������� ó��
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
		// �·ε忡�� �� ��ư �̺�Ʈ ���
		for (var a = 0 ; a < commonMainCodeAr.length ; a ++)
		{
			var currentIdx = eval(commonMainCodeAr[a] + 'List');
				
			//1���� ũ�ٴ� ���� �̹� ��ϵ� �����Ͱ� �ִٳ�
			if (currentIdx > 1)
			{
			
				for (var m = 1 ; m < currentIdx; m ++)
				{
					DatatFormAddEventOfDel(commonMainCodeAr[a],m);
					DatatFormAddEvent(commonMainCodeAr[a],m);
				}
			}
			
		}
		
		// �ڱ�Ұ����� ����Ʈ ǥ��
		var x = 1 ;
		while (x > 0)
		{
			if (!document.getElementById('APPL_CNTNT_' + x)) break;
			
			$("#APPL_CNTNT_" + x).click();
			x ++;
		}
	}
	
	// �⺻�׸� üũ�ϴ°� (���νŻ�����)
	function persoanlCheckBoxConfirm()
	{
			if ($("#PHOTO_YN").val() != 'Y' )
			{
				alert('������ ����ϼ���');
				return 'error';
			}
	}
	
	// ���� �����Ҷ� �����ִ� �׸� ���� üũ�ϱ�
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
						if ( !dataCode.match(/SEQ|CD|DEL$/) && !dataCode.match(/^BTN/) && !dataCode.match(/^SCH_FGRD_TP$/) ) // array �� ��ϵ� ������ �ڵ尰���� ��ư ������ �����ϰ� �� �˻��ϱ�
						{
							if (x == 1) // ���� ������ �� �ִ���.
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
							
							if (x > 1) // �� �ִ��� ������ �ϴ���
							{
								//alert($("#" + dataCode + '_' + x).val() + '------' + dataCode + '_' + x);
								if (exceptionCheckForm(mainCode,x) == 'error')
								{
									alert(commonMainNameAr[m] + ' �׸��� Ȯ���ϼ���. [�������迭�� �а�]\n�Է����� �����ǰ��� �����ϼ���');
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
										alert(commonMainNameAr[m] + ' �׸��� Ȯ���ϼ���. [' + dataAr[dataCode] + ']' + '\n�Է����� �����ǰ��� �����ϼ���');
										$("#" + dataCode + '_' + x).focus();
										return 'error';
									}
								}
							}
						}
					}
					
					if (blank_flag != '' && exist_flag != '')
					{
						alert(menu_flag + ' �׸��� Ȯ���ϼ���.[' + blank_flag + ']');
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
	
	// �� ����Կ��� ó���ϸ鼭 �ֱ� �����ѳ�� ����ó���Ϸ��� ������ �Լ�.
	function exceptionCheckForm(mainCode,code)
	{
		// �з¿��� �������κ� ó��
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
		/***** jquery validate �� �̿��� ��üũ �׳� ;;;; �Ⱦ�����;;;
		var dataAr = new Array();
	
		dataAr = eval(mainCode + 'formListAr');
		
		for (var dataCode in dataAr)
		{
		//alert($('#' + dataCode + '_' + code).type());
			//��ȿ�� üũ���� �����͵�
		
			if ( !dataCode.match(/SEQ|CD|DEL$/) )
			{
				$('#' + dataCode + '_' + code).rules('add' , {
					required:true,
					messages:{required:dataAr[dataCode] + '��(��) Ȯ���ϼ���.'}
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
					alert(commonMainNameAr[m] + ' �׸��� Ȯ���ϼ���. [�������迭�� �а�]\n�Է����� �����ǰ��� �����ϼ���');
					$("#" + 'SCH_SUB_AFF' + '_' + x).focus();
					return 'error';
				}
				
				for (var dataCode in dataAr)
				{
					
					if ( !dataCode.match(/SEQ|CD|DEL|SCH_SUB_AFF|SCH_SUB_MAJOR_NM$/) && !dataCode.match(/^BTN/) ) // array �� ��ϵ� ������ �ڵ尰���� ��ư ������ �����ϰ� �� �˻��ϱ�
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
		
		if (mainCode == 'schl') //�з»��׾ȿ� ����� �־ ;;; ������
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
	
	//�׸� �˻��� ������ ��ư�� �̺�Ʈ �߰��ϱ� 
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
		// ����Ÿ;;; �׳� �������� �߰��սô�.
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
				$("#BTN_SEARCH_LICENSE_" + code).click( function(){ searchPop('�ڰ���','license',code,'LIC','Y','L','width=500 height=550'); } );
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
			
				$("#BTN_SEARCH_SCHOOL_" + code).click( function(){ searchPopSch('�б�','school',$("#SCH_TP_" + code + " option:selected").val(),code,'SCH','N','L','width=500 height=550'); } );
				$("#BTN_SEARCH_SCHOOL_" + code).attr("style","cursor:hand;");
				
				$("#BTN_SEARCH_MAJOR_" + code).click( function(){ searchPop('����','major',code,'SCH_MAJOR','Y','L','width=500 height=550'); } );
				$("#BTN_SEARCH_MAJOR_" + code).attr("style","cursor:hand;");
				
				$("#BTN_SEARCH_SUB_MAJOR_" + code).click( function(){ searchPop('������','major',code,'SCH_SUB_MAJOR','Y','L','width=500 height=550'); } );
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
		$("#popupTitle").val('����');
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
		$("#popupTitle").val('�ּ�');
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
			alert('�з±��м����� ���� �ϼ���');
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
    	
    ///alert('���� �Ϸ�!');	
    }
    	
		});
		alert('���� �Ǿ����ϴ�.');
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
				alert(max_num + "�� ���� �Է°����մϴ�.");
				error_flag = 'error';
			}
			
			if (DataFormValidationCreate(mainCode,eval(mainCode + 'List')) == 'error' )
			{	
				alert('�ش� �׸��� ���� �Է��ϰ� �߰��� �ϼž��մϴ�.');
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
		    
		    		USER_PW:{required:"��й�ȣ�� �Է��ϼ���",minlength:"�ּ� 6�ڸ��Դϴ�.",maxlength:"�ִ� 20���Դϴ�."},
		    		
		    		UNIT_IDX1:{required:"�����о߸� Ȯ���ϼ���"},
		    		NAMECHA:{required:"�ѹ����� Ȯ���ϼ���"},
		    		NAMEENG1:{required:"�������� Ȯ���ϼ���.",charseng:"�������� Ȯ���ϼ���."},
		    		NAMEENG2:{required:"�������� Ȯ���ϼ���.",charseng:"�������� Ȯ���ϼ���."},
		    		BIRTH_TP:{required:"��/������ �����ϼ���"},
		    		ZIPCODE:{required:"�����ȣ�� Ȯ���ϼ���."},
		    		ADDRESS1:{required:"�ּҸ� Ȯ���ϼ���."},
		    		ADDRESS2:{required:"�ּҸ� Ȯ���ϼ���."},
		    		TEL1:{required:"��ȭ��ȣ�� Ȯ���ϼ���."},
		    		TEL2:{required:"��ȭ��ȣ�� Ȯ���ϼ���.",digits:"��ȭ��ȣ�� Ȯ���ϼ���.",minlength:"��ȭ��ȣ�� Ȯ���ϼ���.",maxlength:"��ȭ��ȣ�� Ȯ���ϼ���."},
		    		TEL3:{required:"��ȭ��ȣ�� Ȯ���ϼ���.",digits:"��ȭ��ȣ�� Ȯ���ϼ���.",minlength:"��ȭ��ȣ�� Ȯ���ϼ���.",maxlength:"��ȭ��ȣ�� Ȯ���ϼ���."},
		    		HTEL1:{required:"�޴�����ȣ�� Ȯ���ϼ���."},
		    		HTEL2:{required:"�޴�����ȣ�� Ȯ���ϼ���.",digits:"�޴�����ȣ�� Ȯ���ϼ���.",minlength:"�޴�����ȣ�� Ȯ���ϼ���.",maxlength:"�޴�����ȣ�� Ȯ���ϼ���."},
		    		HTEL3:{required:"�޴�����ȣ�� Ȯ���ϼ���.",digits:"�޴�����ȣ�� Ȯ���ϼ���.",minlength:"�޴�����ȣ�� Ȯ���ϼ���.",maxlength:"�޴�����ȣ�� Ȯ���ϼ���."},
		    		MARRY_YN:{required:"��ȥ���θ� Ȯ���ϼ���."},
		    		EMAIL:{required:"�̸����� Ȯ���ϼ���.",email:"�̸����� Ȯ���ϼ���."},
		    		BOHUN_TP_CD:{required:"���ƴ�� ���θ� �����ϼ���"},
		    		BOHUN_SCORE_CD:{required:"���ƹ�ȣ�� ������ Ȯ���ϼ���."},
		    		BOHUN_NUM:{required:"���ƹ�ȣ�� ������ Ȯ���ϼ���."},
		    		PSN_OBSTACLE_TP_CD:{required:"��ֵ�޹� ������ Ȯ���ϼ���."},
		    		PSN_OBSTACLE_LVL_CD:{required:"��ֵ�޹� ������ Ȯ���ϼ���."},
		    		PSN_OBSTACLE_TP_REASON:{required:"��ֻ����� �����ϼ���."},
		    		RELIGION:{maxlength:"�����Է��� �ִ� 25���Դϴ�."},
		    		HOBBY:{maxlength:"����Է��� �ִ� 25���Դϴ�."},
		    		PSN_HEIGHT:{digits:"������ Ȯ���ϼ���.",min:"������ Ȯ���ϼ���.",max:"������ Ȯ���ϼ���."},
		    		PSN_WEIGHT:{digits:"ü���� Ȯ���ϼ���.",min:"ü���� Ȯ���ϼ���.",max:"ü���� Ȯ���ϼ���."},
		    		PSN_LSIGHT:{digitsforfloatforeye:"�÷��� Ȯ���ϼ���."},
		    		PSN_RSIGHT:{digitsforfloatforeye:"�÷��� Ȯ���ϼ���."}
		    },
		    
		    submitHandler: function(form) { 
		    	
		    	// ���� submit �Ҷ�. --> ���µ� �׸� ���� üũ�ϱ�
		    	if (persoanlCheckBoxConfirm() == 'error' )
		    	{
		    		
		    	}
		    	else if (onSubmitCheckForm() == 'error')
		    	{
	    		}
	    		else if (armyCheckBoxConfirm() == 'error') // �������� üũ 
	    		{
	    			alert('���������� Ȯ���ϼ���.');
	    		}
	    		else if (schCheckBoxConfirm() == 'error') // �����з¼��ý� 2���̻��ϸ� ������. // ���üũ��� 
	    		{
	    		}
	    		else if (lan2CheckBoxConfirm() == 'error') // ���дɷ� üũ
	    		{
	    			alert('�����Ͻ� ���дɷ� �׸��� �ߺ��Ǿ����ϴ�.');
	    		}
	    		else if (fmlyCheckBoxConfirm() == 'error') // �������� üũ �κ�
	    		{
	    			alert('���������� Ȯ���ϼ���.\n������ ������쿡�� �������׿��ο� �������� �׸� üũ�� �Ͻñ� �ٶ��ϴ�.');
	    		}
	    		else if (cntntCheckBoxConfirm() == 'error') // �ڱ�Ұ��� �ʼ�üũ
	    		{
	    			
	    		}
	    		else
	    		{
	    			form.submit();
	    		}
	    	}
   	});  
   	
		
		
		/*
		����Ʈ�ڽ� ����Ÿ�� �Լ� ����
		*/
		//DataSet('BOHUN_TP_NM',$("#BOHUN_TP_CD option:selected").text());
		
		$("#BOHUN_TP_CD").change(function() { SelDataSet('BOHUN_TP_CD','BOHUN_TP_NM'); showBohunList(); });
		$("#PSN_OBSTACLE_TP_CD").change(function() { SelDataSet('PSN_OBSTACLE_TP_CD','PSN_OBSTACLE_TP_NM'); showObstacleList(); });
		$("#BOHUN_SCORE_CD").change(function() { SelDataSet('BOHUN_SCORE_CD','BOHUN_SCORE_NM'); });
		$("#PSN_OBSTACLE_LVL_CD").change(function() { SelDataSet('PSN_OBSTACLE_LVL_CD','PSN_OBSTACLE_LVL_NM'); });
		
		
		// selectbox ó����
		$("#ARMY_YN_CD").change( function() { SelDataSet('ARMY_YN_CD','ARMY_YN_NM')&CheckArmy(); });
		$("#ARMY_TP_CD").change( function() { SelDataSet('ARMY_TP_CD','ARMY_TP_NM'); });
		$("#ARMY_LVL_CD").change( function() { SelDataSet('ARMY_LVL_CD','ARMY_LVL_NM'); });
		$("#ARMY_FINISH_CD").change( function() { SelDataSet('ARMY_FINISH_CD','ARMY_FINISH_NM'); });
		
		// �ε嵥���Ϳ� ���� �̺�Ʈ
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
		//�������� ó���׸�
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
			alert('����ٹ����� �ߺ��Ǿ����ϴ�.');
			
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
				
				// �ٹ�����
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
							$("#ID_WRKPLACE").append(aloc + '���� : ');
							$("#ID_WRKPLACE").append('<select id="WRK_LOC_CD' + aloc + '" name="WRK_LOC_CD' + aloc + '" onchange="chkWorkPlace();"><option value="">�����ϼ���</option></select>');
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
		if (confirm('���������� �Ͻðڽ��ϱ�? ���������� �Ͻø� �������ȳ�;;;'))
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
	
	
	// ���ɼǺ� ����Լ�
	
	// �з� -- �·ε�� (�����������ֱ�) - �ʱ�ȭ�ϸ�ȴ뼭��.��
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
	
	// ������� ó��
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
						alert('��������� Ȯ���ϼ���.[100�� ������ �Է°����մϴ�.]');
						$("#SCH_HAKJUM_" + code).val('');
						return 'error';
					}
				}
				else
				{
					alert('��������� Ȯ���ϼ���.');
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
					alert('��������� Ȯ���ϼ���.[�Ҽ��� ��°�ڸ����� �Է��ϼ���. ��)3.14]');
					$("#SCH_HAKJUM_" + code).val('');
					return 'error';
				}
				
			}
			
			if (Number(v_sch_hakjum) > Number(v_sch_max_hakjum) )
			{
				alert('��������� Ȯ���ϼ���.');
				$("#SCH_HAKJUM_" + code).val('');
				$("#SCH_MAX_HAKJUM_" + code).val('');
				return 'error';
			}
		}
	}
	
	// ������ ���� �׼�
	
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
	
	// �����з�üũ�� �Ѱ��� �����ϳ׿�.
	function schCheckBoxConfirm(code)
	{
		
		//���� ������ ��� �з»����� Ȯ���Ͽ� üũ�ڽ��� 2���̻� üũ�Ǿ����� Ȯ��.
		var checkedCount = 0;
		//�з»����� Ȱ���������� Ȯ����
		
		//-------------------------------------------------------------
			// ������� ����ʼ�
			//SCH_FGRD_TP_1
			
			if ($("#form1").find(':radio[name="SCH_TP_1"]:checked').val() == undefined)
			{
				alert('����б� �Ǵ� ������ø� �����ϼ���.');
				return 'error';
			}
			
			// ����б� - 
			if ($("#form1").find(':radio[name="SCH_TP_1"]:checked').val() == '25' ) 
			{
				if ($("#SCH_CD_1").val() == '' || $("#SCH_JUYA_1").val() == '' || $("#SCH_BRANCH_TP_1").val() == '' || $("#SCH_LOC_1").val() == '' || $("#SCH_STDT1_1").val() == '' || $("#SCH_STDT2_1").val() == '' || $("#SCH_EDDT1_1").val() == '' || $("#SCH_EDDT2_1").val() == '' || $("#SCH_ETTP1_1").val() == '' || $("#SCH_ETTP2_1").val() == '' )
				{
					alert('����б� �׸��� Ȯ���ϼ���.');
					return 'error';
				}
			}
			
			// ������� - 
			if ( $(':radio[name="SCH_TP_1"]:checked').val() == '52' ) 
			{
				if ($("#SCH_EDDT1_1").val() == '' || $("#SCH_EDDT2_1").val() == '' || $("#SCH_EDDT3_1").val() == '' || $("#SCH_LOC_1").val() == '')
				{
					alert('������� �׸��� Ȯ���ϼ���.');
					return 'error';
				}
			}
		
		
		if (schlList > 1)
		{
			for (var a = 1 ;a <= schlList; a ++)
			{
				if (document.getElementById('SCH_FGRD_TP_' + a))
				{
					if ($("#SCH_FGRD_TP_" + a).is(':checked')) // üũ�� �Ǿ����� ī��Ʈ ����
					{
						checkedCount++;
					}
				}
			}
			
			if (checkedCount > 1 || ( a > 1 && checkedCount == 0 ) )
			{
				alert('�����з��� 1���� ������ �����մϴ�.\n�������� �����̴ٸ� 1���� �����ϼ���.');
				if (code != undefined && code != '') $("#SCH_FGRD_TP_" + code).attr("checked",false);
				
				return 'error';
				
			}
			
		}
		return true;
	}
	
	// ����� �˵� ���ý� Ŭ����
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
	
	// �з±��� ���ý� �б��� Ŭ����
	function clearSchNm(code)
	{
		$("#SCH_NM_" + code).val('');
		$("#SCH_CD_" + code).val('');
	}
	// �л��� ���̱�
	function checkHakView(code)
	{
		//�л����۾� --- �����ȳ��� ��!
		if (code != 'onload')
		{
			if ($.trim($("#id_schl_list").html()) != '')
			{
				if (confirm('�����з��� ����б��� �����ϼ̽��ϴ�.\n�Է��Ͻ� ����б� ���� �з»����� ���� �˴ϴ�. ����Ͻðڽ��ϱ�?'))
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
	
	// ������ÿ� �б�����
	function selSchoolType(code)
	{
	
		$("#id_table_school1").show();
		$("#id_table_school2").show();
		
		if (code == 'highschool')
		{
			$("#id_title_school1").html('�б���');
			$("#id_title_school2").html('���бⰣ');
		}
		
		if (code == 'blackgosi')
		{
			$("#id_title_school1").html('�������');
			$("#id_title_school2").html('�հ�����');
		}
		
		$("#id_display_sch1").html($("#id_sch_type1_" + code).html());
		$("#id_display_sch2").html($("#id_sch_type2_" + code).html());
		
	}
	
	// ������ ������ ���������� ���� ó��
	function fmlyAllDel(onload_flag)
	{
		$("#BTN_FMLY_ADD").attr('style','display:black');
		
		if ($("#FMLY_NONE_YN").is(':checked') == true)
		{
			///alert('===' + $("#id_fmly_list").html() + '===');
			// �������׿� ���� ������ ���!
			if (onload_flag != 'onload')
			{
				if ($.trim($("#id_fmly_list").html()) != '')
				{
					if(confirm('�Էµ� �������� �׸�Ǵ� �Է��Ͻô� �׸��� �����˴ϴ�. ����Ͻðڽ��ϱ�?'))
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
		//������ �ִ��� ���� üũ�ϴ��� ���߿� �ϳ��� �ض���~
		//$("#FMLY_NONE_YN").is(':checked')
		var checkedCount = 0;
		var firstValue = '';
		if (fmlyList > 1) //�����׸��� Ȱ���϶�
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
	
	// --------------------- �������� üũ
	function armyCheckBoxConfirm()
	{
		/*
			Y = '��'
			N = '����'
			E = '����'
		*/
		if ($("#ARMY_YN_CD").length > 0 ) // �׸��� ������� 
		{
		
			var checkArray = {	'ARMY_TP_CD':'����',
													'ARMY_LVL_CD':'���',
													'ARMY_FINISH_CD':'���뱸��',
													'ARMY_STDT1':'�����Ⱓ',
													'ARMY_STDT2':'�����Ⱓ',
													'ARMY_STDT3':'�����Ⱓ',
													'ARMY_EDDT1':'�����Ⱓ',
													'ARMY_EDDT2':'�����Ⱓ',
													'ARMY_EDDT3':'�����Ⱓ',
													'ARMY_REASON':'��������'};
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
	
	// --------------------- ���дɷ�
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
	
	// --------------------- ���� �۾�
	
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
	    	
	    ///alert('���� �Ϸ�!');	
	    }
	    	
			});
			
			$("#RSM_FILE_MSG_" + seq).empty();
			alert('���� �Ǿ����ϴ�.');
		
	}
	
</script>

<div class="info-box">
<?=$front_resume_top?>
</div>

<!-- S: ��й�ȣ ���� -->

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
<div id="dialog" title="���ǻ���" style="display:none"></div>
							
							<div class="h3-tit-box">
								<h3>��й�ȣ ����</h3>
								<span>��й�ȣ�� ���� ��ҹ��ڸ� �����ϸ� �ּ� 6�ڸ� �̻� �Է��� �ּž� �մϴ�.</span>
								<a href="javascript:openComment('password');" class="btn"><img src="<?=$FRONT_IMG_URL?>/img/board/table_btn01.gif" alt="�ۼ� �� ���ǻ���" /></a>
							</div>
							
							

							<table class="TbStyle01" summary="��й�ȣ ����">
								<caption>��й�ȣ ����</caption>
								  <colgroup>
								  <col width="15%" />
								  <col width="*" />
								  </colgroup>
								  <tbody>
									<tr>
										<th scope="row"><label for="user_pw">��й�ȣ</label> <span class="red">*</span></th>
										<td>
											<input class="b_input" type="password" name="USER_PW" id="USER_PW" value="" title="��й�ȣ�Է�" />
											<label class="error" for="USER_PW" generated="true" style="display:none;color:red;">error message</label>	
											<span> �� �Ի������� Ȯ�� �� ����,  �հ��� ��ǥ�� ��� �˴ϴ�.</span>
										</td>
									</tr>
								  </tbody>
							</table>

							<!--div class="textR">
								<a href="javascript:goTempSave();"><img src="<?=$FRONT_IMG_URL?>/img/board/table_btn02.gif" alt="��й�ȣ ����" /></a>
							</div-->
							<!-- E: ��й�ȣ ���� -->

							<!-- S: �����о� -->
							<div class="h3-tit-box mgt30">
								<h3>�����о�</h3>
								<span>��� �����о߸� �����ϼ���</span>
								<a href="javascript:openComment('unit');" class="btn"><img src="<?=$FRONT_IMG_URL?>/img/board/table_btn01.gif" alt="�ۼ� �� ���ǻ���" /></a>
							</div>
							<label class="error" for="UNIT_IDX_ORD1" generated="true" style="display:none;color:red;">error message</label>	
							<table class="TbStyle01" summary="�����о�">
								<caption>�����о�</caption>
								  <colgroup>
								  <col width="15%" />
								  <col width="*" />
								  <col width="15%" />
								  <col width="*" />
								  </colgroup>
								  <tbody>
									<tr>
										<th scope="row"><label for="user_kind">�����о�</label> <span class="red">*</span></th>
										<td>
											<input type="hidden" id="UNIT_IDX_ORD1" name="UNIT_IDX_ORD1" value="1" />
											<?=$SELECTBOX_UNIT_IDX1?>
										</td>
										<th scope="row"><label for="area">����ٹ���</label></th>
										<td>
											<div id="ID_WRKPLACE"></div>
										</td>
									</tr>
								  </tbody>
							</table>
							<!--div class="textR">
								<label class="error" for="UNIT_IDX1" generated="true" style="display:none;color:red;">error message</label>	
								<a href="javascript:goTempSave('SUBMIT_BUTTON');"><img src="<?=$FRONT_IMG_URL?>/img/board/table_btn03.gif" alt="�߰� ����" /></a>
							</div-->
							<!-- E: �����о� -->

							<!-- S: �⺻ �Ż����� -->
							<div class="h3-tit-box mgt30">
								<h3>�⺻ �Ż�����</h3>
								<span>�Ż������� �Է��� �ּ���.</span>
								<a href="javascript:openComment('personal');" class="btn"><img src="<?=$FRONT_IMG_URL?>/img/board/table_btn01.gif" alt="�ۼ� �� ���ǻ���" /></a>
							</div>

							<table class="TbStyle01" summary="�⺻ �Ż�����">
								<caption>�⺻ �Ż�����</caption>
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
												<img src="<?=$FRONT_IMG_URL?>/img/board/no_pic.gif" alt="������ ������ּ���" id="id_photo_image" width="130" height="150" />
												<p>
													
													<input type="hidden" id="PHOTO_YN" name="PHOTO_YN" value="<?=$PHOTO_YN?>" />
													<a href="javascript:searchPhotoUpload();"><img src="<?=$FRONT_IMG_URL?>/img/board/btn_pic_app.gif" alt="���/����" /></a>
													<a href="javascript:PhotoDelete();"><img src="<?=$FRONT_IMG_URL?>/img/board/btn_del.gif" alt="����" /></a>
												</p>
											</div>
										
										</td>
										<th scope="row"><label for="user_name">�̸�</label> <span class="red">*</span></th>
										<td colspan="4">
											<input type="hidden" name="NAMEKOR" id="NAMEKOR" value="<?=$NAMEKOR?>"  />
											<?=$NAMEKOR?><span class="space">/</span>
											
											<label for="user_name">�ѹ�</label> <input class="b_input" type="text" name="NAMECHA" id="NAMECHA" value="<?=$NAMECHA?>" style="width:100px;" maxlength="10" />
											<span class="space">/</span>
											
											<label for="user_name_eng">����</label> <input class="b_input" type="text" name="NAMEENG1" id="NAMEENG1" value="<?=$NAMEENG1?>" style="width:50px;" maxlength="50" onblur="javascript:CheckData(this,'engdigits');" />
											<input class="b_input" type="text" name="NAMEENG2" id="NAMEENG2" value="<?=$NAMEENG2?>" style="width:120px;" maxlength="50"  onblur="javascript:CheckData(this,'engdigits');"  />
										</td>
									</tr>
									<tr>
										<th scope="row"><label for="birth_year">�������</label> <span class="red">*</span></th>
										<td colspan="4">
											<input class="b_input" type="text" name="BIRTH_DT1" id="BIRTH_DT1" value="<?=$BIRTH_DT1?>" style="width:25px;border:0px;" readonly  /> <label for="birth_year">��</label>
											<input class="b_input" type="text" name="BIRTH_DT2" id="BIRTH_DT2" value="<?=$BIRTH_DT2?>" style="width:15px;border:0px;" readonly /> <label for="birth_month">��</label>
											<input class="b_input" type="text" name="BIRTH_DT3" id="BIRTH_DT3" value="<?=$BIRTH_DT3?>" style="width:15px;border:0px;" readonly /> <label for="birth_day">��</label>
											(
												<input type="radio" class="radio" name="BIRTH_TP" id="BIRTH_TP" value="S" <?=$BIRTH_TP == 'S' ? ' checked ' : ''; ?> />
												<label for="lunar">���</label>
												<input type="radio" class="radio" name="BIRTH_TP" id="BIRTH_TP" value="L" <?=$BIRTH_TP == 'L' ? ' checked ' : ''; ?> />
												<label for="solar">����</label>
											)
										</td>
									</tr>
									<tr>
										<th scope="row"><label for="address">�ּ�</label> <span class="red">*</span></th>
										<td colspan="4">
											<p class="mgb5">
											<input class="b_input" type="text" name="ZIPCODE1" id="ZIPCODE1" value="<?=$ZIPCODE1?>" style="width:30px;" readonly     />-
											<input class="b_input" type="text" name="ZIPCODE2" id="ZIPCODE2" value="<?=$ZIPCODE2?>" style="width:30px;" readonly   />
											<a href="javascript:searchAddress();"><img src="<?=$FRONT_IMG_URL?>/img/board/btn_address.gif" alt="�ּ� �˻�" style="cursor:hand;" /></a>
											</p>
											<input class="b_input" type="text" name="ADDRESS1" id="ADDRESS1" value="<?=$ADDRESS1?>" style="width:100px;" readonly  />
											<input class="b_input" type="text" name="ADDRESS2" id="ADDRESS2" value="<?=$ADDRESS2?>" style="width:250px;" maxlength="50" />
										</td>
									</tr>
									<tr>
										<th scope="row"><label for="user_phone_01">��ȭ��ȣ</label> <span class="red">*</span></th>
										<td colspan="2">
											<?=$SELECTBOX_TEL?> -
											<input class="b_input" type="text" name="TEL2" id="TEL2" value="<?=$TEL2?>" maxlength="4" style="width:45px;" /> -
											<input class="b_input" type="text" name="TEL3" id="TEL3" value="<?=$TEL3?>" maxlength="4" style="width:45px;" />
										</td>
										<th scope="row"><label for="user_mobile_01">�޴���</label> <span class="red">*</span></th>
										<td>
											<?=$SELECTBOX_HTEL?> -
											<input class="b_input" type="text" name="HTEL2" id="HTEL2" value="<?=$HTEL2?>" maxlength="4" style="width:45px;" /> -
											<input class="b_input" type="text" name="HTEL3" id="HTEL3" value="<?=$HTEL3?>" maxlength="4" style="width:45px;" />
										</td>
									</tr>
									<tr>
										<th scope="row"><label for="user_mail">�̸���</label> <span class="red">*</span></th>
										<td colspan="4">
											<input class="b_input" type="text" name="EMAIL" id="EMAIL" value="<?=$EMAIL?>" style="width:95%;" maxlength="80" />
										</td>
									</tr>
									<tr>
										<th scope="row"><label for="marry_no">��ȥ����</label> <span class="red">*</span></th>
										<td colspan="3">
											<input type="radio" class="radio" name="MARRY_YN" id="MARRY_YN" value="Y" <?=$MARRY_YN == 'N' ? ' checked ' : ''; ?> />
											<label for="marry_no">��ȥ</label>
											<input type="radio" class="radio" name="MARRY_YN" id="MARRY_YN" value="N" <?=$MARRY_YN == 'Y' ? ' checked ' : ''; ?> />
											<label for="marry">��ȥ</label>
										</td>
										<th scope="row"><label for="religion">����</label> <span class="red">*</span></th>
										<td colspan="2">
											<input class="b_input" type="text" name="RELIGION" id="RELIGION" value="<?=$RELIGION?>" style="width:95%;" maxlength="50" />
										</td>
									</tr>
									<tr>
										<th scope="row"><label for="hobby">���</label> <span class="red">*</span></th>
										<td colspan="3">
											<input class="b_input" type="text" name="HOBBY" id="HOBBY" value="<?=$HOBBY?>" style="width:95%;" maxlength="50" />
										</td>
										<th scope="row"><label for="ability">Ư��</label> <span class="red">*</span></th>
										<td colspan="2">
											<input class="b_input" type="text" name="FORTE" id="FORTE" value="<?=$FORTE?>" style="width:95%;" maxlength="50" />
										</td>
									</tr>
									<tr valign="top">
										<th scope="row"><label for="target">���ƴ��</label> <span class="red">*</span></th>
										<td colspan="3">
											<?=$SELECTBOX_BOHUN_TP_CD?><input type="hidden" id="BOHUN_TP_NM" name="BOHUN_TP_NM" value="<?=$BOHUN_TP_NM?>" />
											<div id="id_BOHUNLIST" style="display:none;" >
											���� : <?=$SELECTBOX_BOHUN_SCORE_CD?><input type="hidden" id="BOHUN_SCORE_NM" name="BOHUN_SCORE_NM" value="<?=$BOHUN_SCORE_NM?>" />
											��ȣ : <input class="b_input" type="text" id="BOHUN_NUM" name="BOHUN_NUM" style="width:78px;" value="<?=$BOHUN_NUM?>" maxlength="25" />
											</div>
										</td>
										<th scope="row"><label for="hindrance_01">��ֿ���</label> <span class="red">*</span></th>
										<td  valign="top" colspan="2">
											<?=$SELECTBOX_PSN_OBSTACLE_TP_CD?><input type="hidden" id="PSN_OBSTACLE_TP_NM" name="PSN_OBSTACLE_TP_NM" value="<?=$PSN_OBSTACLE_TP_NM?>" />
											<div id="id_OBSTACLELIST" style="display:none;" >
											��ֵ�� : <?=$SELECTBOX_PSN_OBSTACLE_LVL_CD?><input type="hidden" id="PSN_OBSTACLE_LVL_NM" name="PSN_OBSTACLE_LVL_NM" value="<?=$PSN_OBSTACLE_LVL_NM?>" />
											���� : <input class="b_input" type="text" name="PSN_OBSTACLE_TP_REASON" id="PSN_OBSTACLE_TP_REASON" value="<?=$PSN_OBSTACLE_TP_REASON?>" style="width:80px;" maxlength="50" />
											</div>
										</td>
									</tr>
									<tr>
										<th scope="row"><label for="user_height">��ü����</label></th>
										<td colspan="3">
											<label for="user_height">����</label> <input class="b_input" type="text" name="PSN_HEIGHT" id="PSN_HEIGHT" value="<?=$PSN_HEIGHT?>" style="width:40px;" maxlength="3" /> cm
											<span class="space">/</span>
											<label for="user_weight">ü��</label> <input class="b_input" type="text" name="PSN_WEIGHT" id="PSN_WEIGHT" value="<?=$PSN_WEIGHT?>" style="width:40px;" maxlength="3" /> kg
										</td>
										<th scope="row"><label for="eye_left">�÷�(����)</label></th>
										<td colspan="2">
											<label for="eye_left">��</label> <input class="b_input" type="text" name="PSN_LSIGHT" id="PSN_LSIGHT" value="<?=$PSN_LSIGHT?>" style="width:20px;" maxlength="3" />
											<span class="space">/</span>
											<label for="eye_right">��</label> <input class="b_input" type="text" name="PSN_RSIGHT" id="PSN_RSIGHT" value="<?=$PSN_RSIGHT?>" style="width:20px;" maxlength="3" />
											(���Ϳ��� : 
											<input type="radio" class="radio" name="PSN_CLRBLND_YN" id="PSN_CLRBLND_YN" value="Y" <?=$PSN_CLRBLND_YN == 'Y' ? ' checked ' : ''; ?> />
												<label for="yes">��</label>
												<input type="radio" class="radio" name="PSN_CLRBLND_YN" id="PSN_CLRBLND_YN" value="N" <?=$PSN_CLRBLND_YN == 'N' ? ' checked ' : ''; ?> />
												<label for="no">��</label>
											)
										</td>
									</tr>
									<tr>
										<th scope="row"><label for="radio01">���α��ʻ�Ȱ<br />����� �����</label> <span class="red">*</span></th>
										<td colspan="6">
											<input type="radio" class="radio" name="PSN_LOWINCOME_YN" id="PSN_LOWINCOME_YN" value="Y" <?=$PSN_LOWINCOME_YN == 'Y' ? ' checked ' : ''; ?> />
											<label for="radio01">�ش�</label>
											<input type="radio" class="radio" name="PSN_LOWINCOME_YN" id="PSN_LOWINCOME_YN" value="N" <?=$PSN_LOWINCOME_YN == 'N' ? ' checked ' : ''; ?> />
											<label for="radio02">���ش�</label>
											<span class="space"></span>
											<span> �� ���α��ʻ�Ȱ����� �� �Ѻθ����������� ���� ���ҵ���</span>
										</td>
									</tr>
								  </tbody>
							</table>
							<label class="error" for="PSN_MSG" generated="true" style="display:none;color:red;">error message</label>	
				
							<!--div class="textR">
								
								<a href="javascript:goTempSave('SUBMIT_BUTTON');"><img src="<?=$FRONT_IMG_URL?>/img/board/table_btn03.gif" alt="�߰� ����" /></a>
							</div-->
							<!-- E: �⺻ �Ż����� -->



<? 	if ($rsmdisplay[0]->ARMY_USE_YN == 'Y' ) { ?>
							<!-- S: �������� -->
							<div class="h3-tit-box mgt30">
								<h3>��������</h3>
								<span>������ ��� ������ �Ǵ� �����ڿ� ���մϴ�.</span>
								<a href="javascript:openComment('army');" class="btn"><img src="<?=$FRONT_IMG_URL?>/img/board/table_btn01.gif" alt="�ۼ� �� ���ǻ���" /></a>
							</div>

							<table class="TbStyle01" summary="��������">
								<caption>��������</caption>
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
										<th scope="row"><label for="user_army01">���ʿ���</label> <span class="red">*</span></th>
										<td>
											<?=$SELECTBOX_ARMY_YN_CD?>
											<input type="hidden" name="ARMY_YN_NM" id="ARMY_YN_NM" value="<?=$ARMY_YN_NM?>" />
										</td>
										<th scope="row"><label for="user_army02">����</label> </th>
										<td>
											<?=$SELECTBOX_ARMY_TP_CD?>
											<input type="hidden" name="ARMY_TP_NM" id="ARMY_TP_NM" value="<?=$ARMY_TP_NM?>" />
										</td>
										<th scope="row"><label for="user_army03">���</label> </th>
										<td>
											<?=$SELECTBOX_ARMY_LVL_CD?>
											<input type="hidden" name="ARMY_LVL_NM" id="ARMY_LVL_NM" value="<?=$ARMY_LVL_NM?>" />
										</td>
										<th scope="row"><label for="user_army04">���뱸��</label> </th>
										<td>
											<?=$SELECTBOX_ARMY_FINISH_CD?>
											<input type="hidden" name="ARMY_FINISH_NM" id="ARMY_FINISH_NM" value="<?=$ARMY_FINISH_NM?>" />
										</td>
									</tr>
									<tr>
										<th scope="row"><label for="user_army05_1">�����Ⱓ</label> </th>
										<td colspan="3">
											<input class="b_input" type="text" name="ARMY_STDT1" id="ARMY_STDT1" value="<?=$ARMY_STDT1?>" style="width:30px;" maxlength="4" onblur="CheckFormDate('ARMY_STDT','')&CheckTermDate('ARMY','');" /> <label for="user_army05_1">��</label>
											<input class="b_input" type="text" name="ARMY_STDT2" id="ARMY_STDT2" value="<?=$ARMY_STDT2?>" style="width:20px;" maxlength="2" onblur="javascript:setNum2str(this)&CheckFormDate('ARMY_STDT','')&CheckTermDate('ARMY','');" /> <label for="user_army05_2">��</label>
											<input class="b_input" type="text" name="ARMY_STDT3" id="ARMY_STDT3" value="<?=$ARMY_STDT3?>" style="width:20px;" maxlength="2" onblur="javascript:setNum2str(this)&CheckFormDate('ARMY_STDT','')&CheckTermDate('ARMY','');" /> <label for="user_army05_3">��</label> ~ 
											<input class="b_input" type="text" name="ARMY_EDDT1" id="ARMY_EDDT1" value="<?=$ARMY_EDDT1?>" style="width:30px;" maxlength="4" onblur="CheckFormDate('ARMY_EDDT','')&CheckTermDate('ARMY','');" /> <label for="user_army05_4">��</label>
											<input class="b_input" type="text" name="ARMY_EDDT2" id="ARMY_EDDT2" value="<?=$ARMY_EDDT2?>" style="width:20px;" maxlength="2" onblur="javascript:setNum2str(this)&CheckFormDate('ARMY_EDDT','')&CheckTermDate('ARMY','');" /> <label for="user_army05_5">��</label>
											<input class="b_input" type="text" name="ARMY_EDDT3" id="ARMY_EDDT3" value="<?=$ARMY_EDDT3?>" style="width:20px;" maxlength="2" onblur="javascript:setNum2str(this)&CheckFormDate('ARMY_EDDT','')&CheckTermDate('ARMY','');" /> <label for="user_army05_6">��</label>
										</td>
										<th scope="row"><label for="user_army06">��������</label></th>
										<td colspan="3">
											<input class="b_input" type="text" name="ARMY_REASON" id="ARMY_REASON" value="<?=$ARMY_REASON?>" style="width:200px;" title="���������Է�" maxlength="50" />
										</td>
									</tr>
									
								  </tbody>
							</table>

							<div class="textR">
								<a href="javascript:goProcess();"><img src="<?=$FRONT_IMG_URL?>/img/board/table_btn03.gif" alt="�߰� ����" /></a>
							</div>
							<!-- E: �������� -->
<? } ?>



<? 
	/* 
		�������� 
		FAMILY_USE_YN == 'Y'
	*/
	if ($rsmdisplay[0]->FAMILY_USE_YN == 'Y') { 
?>


<!-- S: �������� -->

			<div class="h3-tit-box mgt30">
			<h3>��������</h3>
			<span>���������� ���� ��츸 üũ�ϼ���. �Է»����� �ִ� ��� �ݵ�� �Է��� �ֽñ� �ٶ��ϴ�.</span>
			<a href="javascript:openComment('family');" class="btn"><img src="<?=$FRONT_IMG_URL?>/img/board/table_btn01.gif" alt="�ۼ� �� ���ǻ���" /></a>
			</div>
			
			<table class="TbStyle01" summary="�������� ����">
			<caption>�������� ����</caption>
			<colgroup>
			<col width="15%" />
			<col width="*" />
			</colgroup>
			<tbody>
			<tr>
			<th scope="row"><label for="family_none">�������� ����</label> <span class="red">*</span></th>
			<td>
			<input type="checkbox" class="checkbox" name="FMLY_NONE_YN" id="FMLY_NONE_YN" value="Y" <?=$FMLY_NONE_YN == 'Y' ? ' checked ' : ''; ?> onclick="fmlyAllDel();" />
			<label for="family_none"><span>�������� ����</span></label>
			</td>
			</tr>
			</tbody>
			</table>
			<table class="TbStyle01" summary="��������">
			<caption>��������</caption>
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
			<th scope="col">����</th>
			<th scope="col">����</th>
			<th scope="col">����</th>
			<th scope="col">�з�</th>
			<th scope="col">����</th>
			<th scope="col">�����</th>
			<th scope="col">����</th>
			<th scope="col">���ſ���</th>
			<th scope="col">�ξ翩��</th>
			<th scope="col">����</th>
			</tr>
			</thead>
			</table>
			
			<div id="id_fmly_list">
			
			</div>
			
			<div class="textR">
			<a href="javascript:goProcess();"><img src="<?=$FRONT_IMG_URL?>/img/board/table_btn03.gif" alt="�߰� ����" /></a>
			<a href="javascript:addFormData('fmly');"><img src="<?=$FRONT_IMG_URL?>/img/board/btn_add.gif" alt="�߰�" id="BTN_FMLY_ADD" /></a>
			</div>
			<!-- E: �������� -->


<?
	}
?>






<? 
	/* 
		�з»��׿� ���õ� �׸��Դϴ�. 
		SCHOOL_USE_YN == 'Y'
	*/
	if ($rsmdisplay[0]->SCHOOL_USE_YN == 'Y') { 
?>



<!-- S: �з»��� -->
							<div class="h3-tit-box mgt30">
								<h3>�з»���</h3>
								<a href="javascript:openComment('school');" class="btn"><img src="<?=$FRONT_IMG_URL?>/img/board/table_btn01.gif" alt="�ۼ� �� ���ǻ���" /></a>
							</div>

							<table class="TbStyle01" summary="�з»���">
								<caption>�з»���</caption>
								  <colgroup>
								  <col width="15%" />
								  <col width="*" />
								  </colgroup>
								  <tbody>
									<tr>
										<th scope="row" colspan="2" class="left">
											
											<div style="text-align:left;float:left">����б�&�������</div>
											<div style="text-align:right">
												<input type="checkbox" class="checkbox" name="SCH_FGRD_TP_1" id="SCH_FGRD_TP_1" value="Y" <?=$SCH_FGRD_TP_1 == 'Y' ? ' checked ' : ''; ?> onclick="javascript:checkHakView()" />
												<label for="last_academic">�����з��� ��� üũ</label>
											</div>
											
										</th>
									</tr>
									<tr>
										<th scope="row"><label for="school_name">�б�����</label></th>
										<td>
											<input type="radio" onclick="javascript:selSchoolType('highschool')&clearSchBox1();" class="radio" id="SCH_TP_1" name="SCH_TP_1" value="25" <?=$SCH_TP_1 == '25' ? ' checked ' : ''; ?>  />����б�
											&nbsp;
											<input type="radio" onclick="javascript:selSchoolType('blackgosi')&clearSchBox1();" class="radio" id="SCH_TP_1" name="SCH_TP_1" value="52" <?=$SCH_TP_1 == '52' ? ' checked ' : ''; ?>  />�������
										</td>
									</tr>
									<tr id="id_table_school1" style="display:none">
										<th scope="row"><label for="school_name"><div id="id_title_school1">�б���</div></label></th>
										<td><div id="id_display_sch1"></div></td>
									</tr>
									<tr id="id_table_school2" style="display:none">
										<th scope="row"><label for="school_name"><div id="id_title_school2">���бⰣ</div></label></th>
										<td><div id="id_display_sch2"></div></td>
									</tr>
								  </tbody>
							</table>
							
							<div id="id_high_scool_hak" style="display:none">
							<div class="point-txt">
								�� �����з��� ����б� ������ ��� �Ʒ��� �Է��� �ֽø� �˴ϴ�.
							</div>

							<table class="TbStyle01" summary="�����з��� ����б� ������ ���">
								<caption>�����з��� ����б� ������ ���</caption>
								  <colgroup>
								  <col width="15%" />
								  <col width="*" />
								  <col width="15%" />
								  <col width="25%" />
								  <col width="15%" />
								  </colgroup>
								  <thead>
									<tr>
										<th scope="col">�������� <span class="red">*</span></th>
										<td colspan="4">
											<div class="txt-box">
												<ul>
													<li>
														<input type="radio" class="radio" name="" id="standard_01" value="" />
														<label for="standard_01">��ޱ���</label>
													</li>
													<li>
														<input type="radio" class="radio" name="" id="standard_02" value="" />
														<label for="standard_02">��������</label>
													</li>
													<li>
														<input type="radio" class="radio" name="" id="standard_03" value="" />
														<label for="standard_03">��������</label>
													</li>
												</ul>
												<p>�� �����Է¹��(��Ȱ��Ϻ� ����) Ȯ�� �� �Է� ����� ���� ������ �ֽñ� �ٶ��ϴ�.</p>
												<p>�� ���ŵ���� ��� ��Ŀ� ���� ��� �� �Ҽ��� ���ڸ� ���� �Է�</p>
											</div>
										</td>
									</tr>
									<tr>
										<th scope="col">�г�</th>
										<th scope="col">1�б� ��յ��(���)/������</th>
										<th scope="col">1�б� �������</th>
										<th scope="col">2�б� ��յ��(���)/������</th>
										<th scope="col" class="last">2�б� �������</th>
									</tr>
								  </thead>
								  <tbody>
									<tr>
										<th scope="row">1�г�</th>
										<td class="center">
											<input class="b_input" type="text" name="" id="" value="" style="width:50px;" /><span class="space">/</span>
											<input class="b_input" type="text" name="" id="" value="" style="width:50px;" />
										</td>
										<td><input class="b_input" type="text" name="" id="" value="" style="width:70%;" /> ��</td>
										<td class="center">
											<input class="b_input" type="text" name="" id="" value="" style="width:50px;" /><span class="space">/</span>
											<input class="b_input" type="text" name="" id="" value="" style="width:50px;" />
										</td>
										<td><input class="b_input" type="text" name="" id="" value="" style="width:70%;" /> ��</td>
									</tr>
									<tr>
										<th scope="row">2�г�</th>
										<td class="center">
											<input class="b_input" type="text" name="" id="" value="" style="width:50px;" /><span class="space">/</span>
											<input class="b_input" type="text" name="" id="" value="" style="width:50px;" />
										</td>
										<td><input class="b_input" type="text" name="" id="" value="" style="width:70%;" /> ��</td>
										<td class="center">
											<input class="b_input" type="text" name="" id="" value="" style="width:50px;" /><span class="space">/</span>
											<input class="b_input" type="text" name="" id="" value="" style="width:50px;" />
										</td>
										<td><input class="b_input" type="text" name="" id="" value="" style="width:70%;" /> ��</td>
									</tr>
									<tr>
										<th scope="row">3�г�</th>
										<td class="center">
											<input class="b_input" type="text" name="" id="" value="" style="width:50px;" /><span class="space">/</span>
											<input class="b_input" type="text" name="" id="" value="" style="width:50px;" />
										</td>
										<td><input class="b_input" type="text" name="" id="" value="" style="width:70%;" /> ��</td>
										<td class="center">
											<input class="b_input" type="text" name="" id="" value="" style="width:50px;" /><span class="space">/</span>
											<input class="b_input" type="text" name="" id="" value="" style="width:50px;" />
										</td>
										<td><input class="b_input" type="text" name="" id="" value="" style="width:70%;" /> ��</td>
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
								<table class="TbStyle01" summary="�з»���" id="id_schl_box_set_<?=$schlIdx?>">
								<caption>�з»���</caption>
								  <colgroup>
								  <col width="15%" />
								  <col width="*" />
								  <col width="10%" />
								  </colgroup>
								  <tbody>
								  <tr>
								  	<th scope="row">�з±���</th>
								  	<td colspan="2">
								  		<div style="text-align:left;float:left"><?=${'frmSCH_TP_' . $schlIdx}?> �з±��� ���� �����ϼ���.</div>
								  		<div style="text-align:right">
											<input type="checkbox" class="checkbox" name="SCH_FGRD_TP_<?=$schlIdx?>" id="SCH_FGRD_TP_<?=$schlIdx?>" value="Y" <?=$schlRs[$schKeyIdx]->SCH_FGRD_TP == 'Y' ? ' checked ' : ''; ?> />
											<label for="last_academic">�����з��� ��� üũ</label>
											</div>
								  	</td>
									</tr>
									<tr>
										<th scope="row"><label for="school_name_02">�б���</label></th>
										<td colspan=2>
											<input type="hidden" name="SCH_SEQ_<?=$schlIdx?>" id="SCH_SEQ_<?=$schlIdx?>" value="<?=$schlRs[$schKeyIdx]->SCH_SEQ?>" />
											<input class="b_input" type="text" name="SCH_NM_<?=$schlIdx?>" id="SCH_NM_<?=$schlIdx?>" value="<?=$schlRs[$schKeyIdx]->SCH_NM?>" title="�б����Է�" readonly />
											<input type="hidden" size="10" id="SCH_CD_<?=$schlIdx?>" name="SCH_CD_<?=$schlIdx?>" value="<?=$schlRs[$schKeyIdx]->SCH_CD?>">
											<img src="<?=$FRONT_IMG_URL?>/img/board/btn_search.gif" alt="�˻�" id="BTN_SEARCH_SCHOOL_<?=$schlIdx?>" name="BTN_SEARCH_SCHOOL_<?=$schlIdx?>" />
											<?=${'frmSCH_JUYA_' . $schlIdx}?>
											<?=${'frmSCH_BRANCH_TP_' . $schlIdx}?>
											<?=${'frmSCH_LOC_' . $schlIdx}?>
										</td>
										
									</tr>
									<tr>
										<th scope="row"><label for="school_term_01_01">���бⰣ</label></th>
										<td>
											<input class="b_input" type="text" name="SCH_STDT1_<?=$schlIdx?>" id="SCH_STDT1_<?=$schlIdx?>" value="<?=$schlRs[$schKeyIdx]->SCH_STDT1?>" style="width:30px;" maxlength="4" /> <label for="">��</label>
											<input class="b_input" type="text" name="SCH_STDT2_<?=$schlIdx?>" id="SCH_STDT2_<?=$schlIdx?>" value="<?=$schlRs[$schKeyIdx]->SCH_STDT2?>" style="width:20px;" maxlength="2" /> <label for="">��</label>
											<?=${'frmSCH_ETTP1_' . $schlIdx}?> ~ 
											<input class="b_input" type="text" name="SCH_EDDT1_<?=$schlIdx?>" id="SCH_EDDT1_<?=$schlIdx?>" value="<?=$schlRs[$schKeyIdx]->SCH_EDDT1?>" style="width:30px;" maxlength="4" /> <label for="">��</label>
											<input class="b_input" type="text" name="SCH_EDDT2_<?=$schlIdx?>" id="SCH_EDDT2_<?=$schlIdx?>" value="<?=$schlRs[$schKeyIdx]->SCH_EDDT2?>" style="width:20px;" maxlength="2" /> <label for="">��</label>
											<?=${'frmSCH_ETTP2_' . $schlIdx}?>
										</td>
										<td rowspan="2" class="center Lline"><img id="SCHL_DEL_<?=$schlIdx?>" name="SCHL_DEL_<?=$schlIdx?>" src="<?=$FRONT_IMG_URL?>/img/board/btn_del.gif"  alt="����"  /></td>
									</tr>
									<tr>
										<th scope="row">���� �� ����</th>
										<td>
											
											<ul>
												<li>
											
													<div style="width:50px;float:left">����</div>
													<div style="width:100px;float:left">�迭 �а�(����)</div>
													<?=${'frmSCH_AFF_' . $schlIdx}?>
													
													<input type="hidden" size="10" id="SCH_MAJOR_CD_<?=$schlIdx?>" name="SCH_MAJOR_CD_<?=$schlIdx?>" value="<?=$schlRs[$schKeyIdx]->SCH_MAJOR_CD?>" />
													<input class="b_input" type="text" name="SCH_MAJOR_NM_<?=$schlIdx?>" id="SCH_MAJOR_NM_<?=$schlIdx?>" value="<?=$schlRs[$schKeyIdx]->SCH_MAJOR_NM?>" title="�����а��Է�" readonly />
													<img src="<?=$FRONT_IMG_URL?>/img/board/btn_search.gif" alt="�˻�" id="BTN_SEARCH_MAJOR_<?=$schlIdx?>" name="BTN_SEARCH_MAJOR_<?=$schlIdx?>" />
												</li>
												<li>
													<div style="width:50px;float:left"></div>
													<div style="width:60px;float:left">�������</div>
													<input class="b_input" type="text" name="SCH_HAKJUM_<?=$schlIdx?>" id="SCH_HAKJUM_<?=$schlIdx?>" value="<?=$schlRs[$schKeyIdx]->SCH_HAKJUM?>" style="width:30px" maxlength="4" title="��������Է�"  />
													<span class="space">/</span>
													<?=${'frmSCH_MAX_HAKJUM_' . $schlIdx}?>
													&nbsp;&nbsp;�̼�����
													<input class="b_input" type="text" name="SCH_ISU_HAKJUM_<?=$schlIdx?>" id="SCH_ISU_HAKJUM_<?=$schlIdx?>" value="<?=$schlRs[$schKeyIdx]->SCH_ISU_HAKJUM?>" maxlength="4" style="width:40px;" title="�̼������Է�" />
												</li>
												<li>
													<div style="width:50px;float:left">������</div>
													<div style="width:100px;float:left">���� ����</div>
													<?=${'frmSCH_SUB_MAJOR_TP_' . $schlIdx}?>
												</li>
												<li id="id_sub_major_form_<?=$schlIdx?>" style="display:none">
													
													<div style="width:50px;float:left">������</div>
													<div style="width:100px;float:left">�迭 �а�(����)</div>
													
													<?=${'frmSCH_SUB_AFF_' . $schlIdx}?>
													<input class="b_input" type="text" name="SCH_SUB_MAJOR_NM_<?=$schlIdx?>" id="SCH_SUB_MAJOR_NM_<?=$schlIdx?>" value="<?=$schlRs[$schKeyIdx]->SCH_SUB_MAJOR_NM?>" title="��/���� ���� �а��Է�" readonly />
													<input type="hidden" size="10" id="SCH_SUB_MAJOR_CD_<?=$schlIdx?>" name="SCH_SUB_MAJOR_CD_<?=$schlIdx?>" value="<?=$schlRs[$schKeyIdx]->SCH_SUB_MAJOR_CD?>" />
													<img src="<?=$FRONT_IMG_URL?>/img/board/btn_search.gif" alt="�˻�" id="BTN_SEARCH_SUB_MAJOR_<?=$schlIdx?>" name="BTN_SEARCH_SUB_MAJOR_<?=$schlIdx?>" />
												</li>
											</ul>
												
										</td>
									</tr>
									
								  </tbody>
								</table>
							<? } } ?>
							</div>
							
							<div class="textR">
							<a href="javascript:goProcess();"><img src="<?=$FRONT_IMG_URL?>/img/board/table_btn03.gif" alt="�߰� ����" /></a>
							<a href="javascript:addFormData('schl');"><img src="<?=$FRONT_IMG_URL?>/img/board/btn_add.gif" alt="�߰�" id="id_schooladd" /></a>
							</div>
							
							<!-- E: �з»��� -->


<!-- �з� ���� ������ -->

<? } ?>

<?
	//��»��� - 
	if ($rsmdisplay[0]->CAREER_USE_YN == 'Y' ) {
?>

<div class="h3-tit-box mgt30">
								<h3>��»���</h3>
								<span>�󼼾��������� 400 �� �̳��� �ڼ��� �ۼ��� �ּ���.</span>
								<a href="javascript:openComment('career');" class="btn"><img src="<?=$FRONT_IMG_URL?>/img/board/table_btn01.gif" alt="�ۼ� �� ���ǻ���" /></a>
							</div>

							<table class="TbStyle01" summary="��»���">
								<caption>��»���</caption>
								  <colgroup>
								  <col width="15%" />
								  <col width="*" />
								  </colgroup>
								  <tbody>
									<tr>
										<th scope="row" rowspan="2"><label for="family_none">��»���</label> </th>
										<td>
											<input type="radio" class="radio" name="CAREER_TP" id="CAREER_TP" value="N" <?=$CAREER_TP == 'N' ? ' checked ' : ''; ?> />
											<label for="newcomer">����</label>
											<input type="radio" class="radio" name="CAREER_TP" id="CAREER_TP" value="C" <?=$CAREER_TP == 'C' ? ' checked ' : ''; ?> />
											<label for="career">���</label>
											<input class="b_input" type="text" name="CAREER_TERM1" id="CAREER_TERM1" value="<?=$CAREER_TERM1?>" style="width:20px;" maxlength=2 onblur="CheckData(this,'digits');" /> <label for="">��</label>
											<input class="b_input" type="text" name="CAREER_TERM2" id="CAREER_TERM2" value="<?=$CAREER_TERM2?>" style="width:20px;" maxlength=2 onblur="CheckData(this,'digits');" /> <label for="">����</label>
											<span class="space">/</span>
											<input type="checkbox" class="checkbox" name="FOREIGN_CAREER_YN" id="FOREIGN_CAREER_YN" value="Y" <?=$FOREIGN_CAREER_YN == 'Y' ? ' checked ' : ''; ?> />
											<label for="overseas">�ؿܱٹ�</label>
											<input class="b_input" type="text" name="FOREIGN_CAREER_TERM1" id="FOREIGN_CAREER_TERM1" maxlength=2 value="<?=$FOREIGN_CAREER_TERM1?>" style="width:20px;" onblur="CheckData(this,'digits');" /> <label for="">��</label>
											<input class="b_input" type="text" name="FOREIGN_CAREER_TERM2" id="FOREIGN_CAREER_TERM2" maxlength=2 value="<?=$FOREIGN_CAREER_TERM2?>" style="width:20px;" onblur="CheckData(this,'digits');" /> <label for="">����</label>
										</td>
									</tr>
									<tr>
										<td>
											<label for="family_none"><span>��뺸�谡�ԱⰣ</span></label>
											<input class="b_input" type="text" name="EMP_INSUR_TERM1" id="EMP_INSUR_TERM1" value="<?=$EMP_INSUR_TERM1?>" style="width:20px;" maxlength=2 onblur="CheckData(this,'digits');" /> <label for="">��</label>
											<input class="b_input" type="text" name="EMP_INSUR_TERM2" id="EMP_INSUR_TERM2" value="<?=$EMP_INSUR_TERM2?>" style="width:20px;" maxlength=2 onblur="CheckData(this,'digits');" /> <label for="">����</label>
											<span> �� <a href="http://www.ei.go.kr" target="_blank" title="��â��������">http://www.ei.go.kr</a> ���� ��뺸�谡�ԱⰣ�� ��ȸ �� ����</span>
										</td>
									</tr>
								  </tbody>
							</table>

	<table class="TbStyle01 mgt10" summary="��»��� ��">
	<caption>��»��� ��</caption>
	<colgroup>
	<col width="28%" />
	<col width="15%" />
	<col width="*" />
	<col width="10%" />
	</colgroup>
	<thead>
	<tr>
	<th scope="col">�ٹ��Ⱓ</th>
	<th scope="col" colspan="2">�󼼰��</th>
	<th scope="col">����</th>
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
	<caption>��»��� ��</caption>
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
			<input class="b_input" type="text" name="CAREER_STDT1_<?=$carrIdx?>" id="CAREER_STDT1_<?=$carrIdx?>" SIZE="4" maxlength="4" value="<?=$carrList->CAREER_STDT1?>" />�� <input class="b_input" type="text" value="<?=$carrList->CAREER_STDT2?>" name="CAREER_STDT2_<?=$carrIdx?>" id="CAREER_STDT2_<?=$carrIdx?>" maxlength="2"  SIZE="2"  />�� ~ 
			<input class="b_input" type="text" name="CAREER_EDDT1_<?=$carrIdx?>" id="CAREER_EDDT1_<?=$carrIdx?>" SIZE="4" maxlength="4" value="<?=$carrList->CAREER_EDDT1?>" />�� <input class="b_input" type="text" value="<?=$carrList->CAREER_EDDT2?>" name="CAREER_EDDT2_<?=$carrIdx?>" id="CAREER_EDDT2_<?=$carrIdx?>" maxlength="2"  SIZE="2"  />��
			<br>
			<?=${'frmCAREER_STS_CD_' . $carrIdx}?><input type="hidden" id="CAREER_STS_NM_<?=$carrIdx?>" name="CAREER_STS_NM_<?=$carrIdx?>" value="<?=$carrList->CAREER_STS_NM?>" />
		</td>
		<th scope="row"><label for="company_name">ȸ���</label></th>
		<td><input class="b_input" type="text" id="CAREER_CMP_NM_<?=$carrIdx?>" name="CAREER_CMP_NM_<?=$carrIdx?>" value="<?=$carrList->CAREER_CMP_NM?>" maxlength="50" style="width:85px;" /> <?=${'frmCAREER_CMP_TP_CD_' . $carrIdx}?><input type="hidden" id="CAREER_CMP_TP_NM_<?=$carrIdx?>" name="CAREER_CMP_TP_NM_<?=$carrIdx?>" value="<?=$carrList->CAREER_CMP_TP_NM?>" /> <?=${'frmCAREER_LOC_CD_' . $carrIdx}?><input type="hidden" id="CAREER_LOC_NM_<?=$carrIdx?>" name="CAREER_LOC_NM_<?=$carrIdx?>" value="<?=$carrList->CAREER_LOC_NM?>" /></td>
		<td rowspan="5" class="center Lline"><img id="CARR_DEL_<?=$carrIdx?>" name="CARR_DEL_<?=$carrIdx?>" src="<?=$FRONT_IMG_URL?>/img/board/btn_del.gif"  alt="����"  /></td>
	</tr>
	<tr>
		<th>����</th>
		<td><?=${'frmCAREER_EMP_TP_CD_' . $carrIdx}?><input type="hidden" id="CAREER_EMP_TP_NM_<?=$carrIdx?>" name="CAREER_EMP_TP_NM_<?=$carrIdx?>" value="<?=$carrList->CAREER_EMP_TP_NM?>" /> <input class="b_input" type="text" name="CAREER_JOB_TP_NM_<?=$carrIdx?>" id="CAREER_JOB_TP_NM_<?=$carrIdx?>" value="<?=$carrList->CAREER_JOB_TP_NM?>"  style="width:120px;" readonly /><input type="hidden" name="CAREER_JOB_TP_CD_<?=$carrIdx?>" id="CAREER_JOB_TP_CD_<?=$carrIdx?>" value="<?=$carrList->CAREER_JOB_TP_CD?>" /> 
			<img id="BTN_SEARCH_JOBTYPE_<?=$carrIdx?>" name="BTN_SEARCH_JOBTYPE_<?=$carrIdx?>" src="<?=$FRONT_IMG_URL?>/img/board/btn_search.gif" alt="�˻�" />
		</td>
	</tr>
	<tr>
		<th>�ٹ��μ�/����</th>
		<td>�μ��� : <input class="b_input" type="text"  name="CAREER_DEPT_NM_<?=$carrIdx?>" id="CAREER_DEPT_NM_<?=$carrIdx?>" value="<?=$carrList->CAREER_DEPT_NM?>" style="width:140px;" maxlength="50" /> <?=${'frmCAREER_PSTN_CD_' . $carrIdx}?><input type="hidden" id="CAREER_PSTN_NM_<?=$carrIdx?>" value="<?=$carrList->CAREER_PSTN_NM?>" name="CAREER_PSTN_NM_<?=$carrIdx?>" /> <?=${'frmCAREER_PSTN_LVL_CD_' . $carrIdx}?><input type="hidden" id="CAREER_PSTN_LVL_NM_<?=$carrIdx?>" name="CAREER_PSTN_LVL_NM_<?=$carrIdx?>" value="<?=$carrList->CAREER_PSTN_LVL_NM?>" /></td>
	</tr>
	<tr>
		<th>��������</th>
		<td><textarea class="b_input" type="text" name="CAREER_CNTNT_<?=$carrIdx?>" id="CAREER_CNTNT_<?=$carrIdx?>" style="width:95%;" /><?=$carrList->CAREER_CNTNT?></textarea></td>
	</tr>
	<tr>
		<th>������</th>
		<td><?=${'frmCAREER_RETIRE_CD_' . $carrIdx}?><input type="hidden" name="CAREER_RETIRE_NM_<?=$carrIdx?>" id="CAREER_RETIRE_NM_<?=$carrIdx?>" value="<?=$carrList->CAREER_RETIRE_NM?>" style="width:140px;" /> </td>
	</tr></td>
	</tr>
	</tbody>
	</table>
	<? } ?>
	</div>
	
	<div class="textR">
		<a href="javascript:goProcess();"><img src="<?=$FRONT_IMG_URL?>/img/board/table_btn03.gif" alt="�߰� ����" /></a>
		<a href="javascript:addFormData('carr');"><img src="<?=$FRONT_IMG_URL?>/img/board/btn_add.gif" alt="�߰�" /></a>
	</div>

		
			

<?
	}
?>

<?
	// ���н���
	if ($rsmdisplay[0]->LANGUAGE_USE_YN == 'Y') {
?>


		<!-- S: ���н��� -->
		<div class="h3-tit-box mgt30">
			<h3>���н���</h3>
			<a href="javascript:openComment('language');" class="btn"><img src="<?=$FRONT_IMG_URL?>/img/board/table_btn01.gif" alt="�ۼ� �� ���ǻ���" /></a>
		</div>



<table class="TbStyle01" summary="���н���">
	<caption>���н���</caption>
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
			<th scope="col">���н����</th>
			<th scope="col">������</th>
			<th scope="col">��������(���)</th>
			<th scope="col">�����</th>
			<th scope="col">��Ϲ�ȣ</th>
			
		
			<th scope="col">����</th>
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
					
					15 : ����, ���
					14 : ���
					13 : ����
					if ($lanList->CD_IDX == '11') 
				*/
				
			?>
		</td>
		<td>
			<input class="b_input"  type="text" id="LAN_DT1_<?=($key+1)?>" name="LAN_DT1_<?=($key+1)?>" value="<?=$lanList->LAN_DT1?>" onblur="javascript:CheckFormDate('LAN_DT',<?=($key+1)?>);" maxlength="4" style="width:30px;"> <label for="">��</label>
			<input class="b_input"  type="text" id="LAN_DT2_<?=($key+1)?>" name="LAN_DT2_<?=($key+1)?>" value="<?=$lanList->LAN_DT2?>" onblur="javascript:setNum2str(this)&CheckFormDate('LAN_DT',<?=($key+1)?>);" maxlength="2" style="width:20px;"> <label for="">��</label>
			<input class="b_input"  type="text" id="LAN_DT3_<?=($key+1)?>" name="LAN_DT3_<?=($key+1)?>" value="<?=$lanList->LAN_DT3?>" onblur="javascript:setNum2str(this)&CheckFormDate('LAN_DT',<?=($key+1)?>);" maxlength="2" style="width:20px;"> <label for="">��</label>
			
		</td>
		<td><input class="b_input"  type="text" id="LAN_NUM_<?=($key+1)?>" style="width:100px;" name="LAN_NUM_<?=($key+1)?>" value="<?=$lanList->LAN_NUM?>" maxlength="25" /></td>
		<td><img id="LAN_DEL" name="LAN_DEL" src="<?=$FRONT_IMG_URL?>/img/board/btn_del.gif"  alt="����" onclick="formContentClear('LAN','<?=($key+1)?>');" style="cursor:hand;" /></td>
	</tr>

<?
	}
?>
</tbody>
</table>

<div class="textR">
<a href="javascript:goProcess();"><img src="<?=$FRONT_IMG_URL?>/img/board/table_btn03.gif" alt="�߰� ����" /></a>
</div>

<?
	}
?>


<?
	// ����
	if ($rsmdisplay[0]->WRITE_USE_YN == 'Y') {
?>
	
<!-- S: ���� -->
		<div class="h3-tit-box mgt30">
			<h3>��������</h3>
			<a href="javascript:openComment('write');" class="btn"><img src="<?=$FRONT_IMG_URL?>/img/board/table_btn01.gif" alt="�ۼ� �� ���ǻ���" /></a>
		</div>



	<table class="TbStyle01 mgt10" summary="��������">
	<caption>����</caption>
	  <colgroup>
	  <col width="22%" />
	  <col width="22%" />
	  <col width="*" />
	  <col width="10%" />
	  </colgroup>
	  <thead>
		<tr>
			<th scope="col">������</th>
			<th scope="col">�߻�/����ó</th>
			<th scope="col">����/������</th>
			<th scope="col">����</th>
		</tr>
	  </thead>
	</table>
<div id="id_wrte_list">
<?
	foreach ($wrteRs as $key => $wrteList)
	{
		$wrteIdx = $key + 1;
?>
<table class="TbStyle01" summary="��������" id="id_wrte_box_set_<?=$wrteIdx?>">	
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
				<input class="b_input" type="text" value="<?=$wrteList->WRT_DT1?>" name="WRT_DT1_<?=$wrteIdx?>" id="WRT_DT1_<?=$wrteIdx?>" style="width:30px;" maxlength="4" />  <label for="">��</label> 
				<input class="b_input" type="text" value="<?=$wrteList->WRT_DT2?>" name="WRT_DT2_<?=$wrteIdx?>" id="WRT_DT2_<?=$wrteIdx?>" style="width:20px;" maxlength="2"  />  <label for="">��</label> 
				<input class="b_input" type="text" value="<?=$wrteList->WRT_DT3?>" name="WRT_DT3_<?=$wrteIdx?>" id="WRT_DT3_<?=$wrteIdx?>" style="width:20px;" maxlength="2"  />  <label for="">��</label> 
		</td>
		<td class="center"><img id="WRTE_DEL_<?=$wrteIdx?>" name="WRTE_DEL_<?=$wrteIdx?>" src="<?=$FRONT_IMG_URL?>/img/board/btn_del.gif"  alt="����"  /></td>
	</tr>
</tbody>
</table>
<?
	}
?>
</div>

<div class="textR">
	<a href="javascript:goProcess();"><img src="<?=$FRONT_IMG_URL?>/img/board/table_btn03.gif" alt="�߰� ����" /></a>
	<a href="javascript:addFormData('wrte');"><img src="<?=$FRONT_IMG_URL?>/img/board/btn_add.gif" alt="�߰�" /></a>
</div>

		




<?
	}
?>

<?
	// ���󳻿�
	if ($rsmdisplay[0]->PRIZE_USE_YN == 'Y') {
?>
	
<!-- S: ���󳻿� -->
		<div class="h3-tit-box mgt30">
			<h3>���󳻿�</h3>
			<a href="javascript:openComment('prize');" class="btn"><img src="<?=$FRONT_IMG_URL?>/img/board/table_btn01.gif" alt="�ۼ� �� ���ǻ���" /></a>
		</div>



	<table class="TbStyle01 mgt10" summary="���󳻿�">
	<caption>�����</caption>
	  <colgroup>
	  <col width="22%" />
	  <col width="22%" />
	  <col width="*" />
	  <col width="10%" />
	  </colgroup>
	  <thead>
		<tr>
			<th scope="col">�����</th>
			<th scope="col">�������</th>
			<th scope="col">������</th>
			<th scope="col">����</th>
		</tr>
	  </thead>
	</table>
<div id="id_prze_list">
<?
	foreach ($przeRs as $key => $przeList)
	{
		$przeIdx = $key + 1;
?>
<table class="TbStyle01" summary="���󳻿�" id="id_prze_box_set_<?=$przeIdx?>">	
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
					<input class="b_input" type="text" value="<?=$przeList->PRZ_DT1?>" name="PRZ_DT1_<?=$przeIdx?>" id="PRZ_DT1_<?=$przeIdx?>" style="width:30px;" maxlength="4" />  <label for="">��</label> 
					<input class="b_input" type="text" value="<?=$przeList->PRZ_DT2?>" name="PRZ_DT2_<?=$przeIdx?>" id="PRZ_DT2_<?=$przeIdx?>" style="width:20px;" maxlength="2"  />  <label for="">��</label> 
					<input class="b_input" type="text" value="<?=$przeList->PRZ_DT3?>" name="PRZ_DT3_<?=$przeIdx?>" id="PRZ_DT3_<?=$przeIdx?>" style="width:20px;" maxlength="2"  />  <label for="">��</label> 
			</td>
			<td class="center"><img id="PRZE_DEL_<?=$przeIdx?>" name="PRZE_DEL_<?=$przeIdx?>" src="<?=$FRONT_IMG_URL?>/img/board/btn_del.gif"  alt="����"  /></td>
		</tr>
	</tbody>
	</table>
<?
}
?>
</div>

<div class="textR">
	<a href="javascript:goProcess();"><img src="<?=$FRONT_IMG_URL?>/img/board/table_btn03.gif" alt="�߰� ����" /></a>
	<a href="javascript:addFormData('prze');"><img src="<?=$FRONT_IMG_URL?>/img/board/btn_add.gif" alt="�߰�" /></a>
</div>
		


<?
	}
?>




<?
	// ���ߵ������ ����
	if ($rsmdisplay[0]->LANGUAGE2_USE_YN == 'Y') {
?>
<!-- S: ���дɷ� -->
		<div class="h3-tit-box mgt30">
			<h3>���дɷ�</h3>
			<a href="javascript:openComment('language2');" class="btn"><img src="<?=$FRONT_IMG_URL?>/img/board/table_btn01.gif" alt="�ۼ� �� ���ǻ���" /></a>
		</div>



	<table class="TbStyle01 mgt10" summary="���дɷ�">
	<caption>���дɷ�</caption>
	  <colgroup>
	  <col width="22%" />
	  <col width="*" />
	  <col width="*" />
	  <col width="*" />
	  <col width="10%" />
	  </colgroup>
	  <thead>
		<tr>
			<th scope="col">���</th>
			<th scope="col">ȸȭ�ɷ�</th>
			<th scope="col">�۹��ɷ�</th>
			<th scope="col">���شɷ�</th>
			<th scope="col">����</th>
		</tr>
	  </thead>
	</table>
<div id="id_lan2_list">
<?
	foreach ($lan2Rs as $key => $lan2List)
	{
		$lan2Idx = $key + 1;
?>
<table class="TbStyle01" summary="���дɷ�" id="id_lan2_box_set_<?=$lan2Idx?>">	
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
			<td class="center"><img id="LAN2_DEL_<?=$lan2Idx?>" name="LAN2_DEL_<?=$lan2Idx?>" src="<?=$FRONT_IMG_URL?>/img/board/btn_del.gif"  alt="����"  /></td>
		</tr>
	</tbody>
	</table>	
<?
	}
?>
</div>

<div class="textR">
	<a href="javascript:goProcess();"><img src="<?=$FRONT_IMG_URL?>/img/board/table_btn03.gif" alt="�߰� ����" /></a>
	<a href="javascript:addFormData('lan2');"><img src="<?=$FRONT_IMG_URL?>/img/board/btn_add.gif" alt="�߰�" /></a>
</div>



<?
	}
?>

<?
	if ($rsmdisplay[0]->LICENSE_USE_YN == 'Y') {
?>

<!-- S: �ڰ��� -->
		<div class="h3-tit-box mgt30">
			<h3>�ڰ���</h3>
			<a href="javascript:openComment('license');" class="btn"><img src="<?=$FRONT_IMG_URL?>/img/board/table_btn01.gif" alt="�ۼ� �� ���ǻ���" /></a>
		</div>


	<table class="TbStyle01 mgt10" summary="�ڰ���">
	<caption>�ڰ���</caption>
	  <colgroup>
	  <col width="*" />
	  <col width="*" />
	  <col width="*" />
	  <col width="*" />
	  <col width="10%" />
	  </colgroup>
	  <thead>
		<tr>
			<th scope="col">�ڰ�����</th>
			<th scope="col">����ó</th>
			<th scope="col">�������</th>
			<th scope="col">��Ϲ�ȣ</th>
			<th scope="col">����</th>
		</tr>
	  </thead>
	</table>
	
<div id="id_lics_list">
<?
foreach ($licRs as $key => $licList)
{
	$licIdx = $key + 1;
?>
	<table class="TbStyle01" summary="�ڰݴɷ�" id="id_lics_box_set_<?=$licIdx?>">	
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
				<img id="BTN_SEARCH_LICENSE_<?=$licIdx?>" name="BTN_SEARCH_LICENSE_<?=$licIdx?>" src="<?=$FRONT_IMG_URL?>/img/board/btn_search.gif" alt="�˻�" />
			</td>
			<td class="center"><input class="b_input" type="text" name="LIC_PB_NM_<?=$licIdx?>" id="LIC_PB_NM_<?=$licIdx?>" value="<?=$licList->LIC_PB_NM?>" maxlength="50" /></td>
			<td class="center">
				<input class="b_input" type="text" id="LIC_DT1_<?=$licIdx?>" name="LIC_DT1_<?=$licIdx?>" value="<?=$licList->LIC_DT1?>" style="width:30px;" maxlength="4" />  <label for="">��</label> 
				<input class="b_input" type="text" id="LIC_DT2_<?=$licIdx?>" name="LIC_DT2_<?=$licIdx?>" value="<?=$licList->LIC_DT2?>" style="width:20px;" maxlength="2"  />  <label for="">��</label> 
				<input class="b_input" type="text" id="LIC_DT3_<?=$licIdx?>" name="LIC_DT3_<?=$licIdx?>" value="<?=$licList->LIC_DT3?>" style="width:20px;" maxlength="2"  />  <label for="">��</label> 
			</td>
			<td><input class="b_input" type="text" id="LIC_NUM_<?=$licIdx?>" name="LIC_NUM_<?=$licIdx?>" value="<?=$licList->LIC_NUM?>" style="width:90%;" maxlength="25" /></td>
			<td class="center"><img id="LICS_DEL_<?=$licIdx?>" name="LICS_DEL_<?=$licIdx?>" src="<?=$FRONT_IMG_URL?>/img/board/btn_del.gif"  alt="����"  /></td>
		</tr>
	</tbody>
	</table>
<? } ?>
	</div>

<div class="textR">
	<a href="javascript:goProcess();"><img src="<?=$FRONT_IMG_URL?>/img/board/table_btn03.gif" alt="�߰� ����" /></a>
	<a href="javascript:addFormData('lics');"><img src="<?=$FRONT_IMG_URL?>/img/board/btn_add.gif" alt="�߰�" /></a>
</div>



<?
	}
?>


<?
	/* 
		��ǻ�� Ȱ�� �ɷ� 
		frmComputerDataList
	*/
	if ($rsmdisplay[0]->PC_USE_YN == 'Y') { 
?>

<div class="h3-tit-box mgt30">
	<h3>OA�ɷ�</h3>
	<a href="javascript:openComment('computer');" class="btn"><img src="<?=$FRONT_IMG_URL?>/img/board/table_btn01.gif" alt="�ۼ� �� ���ǻ���" /></a>
</div>

<table class="TbStyle01 mgt10" summary="OA�ɷ�">
<caption>OA�ɷ�</caption>
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
<a href="javascript:goProcess();"><img src="<?=$FRONT_IMG_URL?>/img/board/table_btn03.gif" alt="�߰� ����" /></a>
</div>
							
<?
	}
?>

<? 
	/* 
		Ȱ������
		SERVE_USE_YN == 'Y'
	*/
	if ($rsmdisplay[0]->SERVE_USE_YN == 'Y') { 
?>

<div class="h3-tit-box mgt30">
	<h3>�ֿ�Ȱ�� �� ��ȸ����</h3>
	<span>���� / �Ƹ�����Ʈ / ���Ƹ� / �ڿ����� / ��ȸȰ�� / ����Ȱ�� / �������</span>
	<a href="javascript:openComment('serve');" class="btn"><img src="<?=$FRONT_IMG_URL?>/img/board/table_btn01.gif" alt="�ۼ� �� ���ǻ���" /></a>
</div>

<table class="TbStyle01 mgt10" summary="�ֿ�Ȱ�� �� ��ȸ����">
	<caption>�ֿ�Ȱ�� �� ��ȸ����</caption>
	  <colgroup>
	  <col width="32%" />
	  <col width="15%" />
	  <col width="*" />
	  <col width="10%" />
	  </colgroup>
	  <thead>
		<tr>
			<th scope="col">Ȱ���Ⱓ</th>
			<th scope="col" colspan="2">��Ȱ��</th>
			<th scope="col">����</th>
		</tr>
	  </thead>
	</table>
<div id="id_srve_list">
<?
foreach ($srveRs as $key => $srveList)
{
	$srveIdx = $key + 1;
?>
	<table class="TbStyle01" summary="�ֿ�Ȱ�� �� ��ȸ����" id="id_srve_box_set_<?=$srveIdx?>">
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
					<input class="b_input" type="text" value="<?=$srveList->SRV_STDT1?>" name="SRV_STDT1_<?=$srveIdx?>" id="SRV_STDT1_<?=$srveIdx?>" value="" style="width:30px;" maxlength="4" /> <label for="">��</label>
					<input class="b_input" type="text" value="<?=$srveList->SRV_STDT2?>" name="SRV_STDT2_<?=$srveIdx?>" id="SRV_STDT2_<?=$srveIdx?>" value="" style="width:20px;" maxlength="2"  /> <label for="">��</label> ~ 
					<input class="b_input" type="text" value="<?=$srveList->SRV_EDDT1?>" name="SRV_EDDT1_<?=$srveIdx?>" id="SRV_EDDT1_<?=$srveIdx?>" value="" style="width:30px;" maxlength="4" /> <label for="">��</label>
					<input class="b_input" type="text" value="<?=$srveList->SRV_EDDT2?>" name="SRV_EDDT2_<?=$srveIdx?>" id="SRV_EDDT2_<?=$srveIdx?>" value="" style="width:20px;" maxlength="2"  /> <label for="">��</label>
				</td>
				<th scope="row"><label for="active_kind">Ȱ������</label></th>
				<td>
					<?=${'frmSRV_TP_CD_' . $srveIdx}?><input type="hidden" id="SRV_TP_NM_<?=$srveIdx?>" name="SRV_TP_NM_<?=$srveIdx?>" value="<?=$srveList->SRV_TP_NM?>"  />
				</td>
				<td rowspan="4" class="center Lline"><img id="SRVE_DEL_<?=$srveIdx?>" name="SRVE_DEL_<?=$srveIdx?>" src="<?=$FRONT_IMG_URL?>/img/board/btn_del.gif"  alt="����"  /></td>
			</tr>
			<tr>
				<th scope="row"><label for="ogani">���/���</label></th>
				<td>
					<input class="b_input" type="text" name="SRV_ORG_NM_<?=$srveIdx?>" id="SRV_ORG_NM_<?=$srveIdx?>" value="<?=$srveList->SRV_ORG_NM?>" style="width:95%;" title="���/����Է�" maxlength="50" />
				</td>
			</tr>
			<tr>
				<th scope="row"><label for="active_content">Ȱ������</label></th>
				<td><textarea name="SRV_CNTNT_<?=$srveIdx?>" rows="" cols="" id="SRV_CNTNT_<?=$srveIdx?>" style="width:95%;"><?=$srveList->SRV_CNTNT?></textarea></td>
			</tr>
		  </tbody>
	</table>
<? } ?>	
</div>

<div class="textR">
<a href="javascript:goProcess();"><img src="<?=$FRONT_IMG_URL?>/img/board/table_btn03.gif" alt="�߰� ����" /></a>
<a href="javascript:addFormData('srve');"><img src="<?=$FRONT_IMG_URL?>/img/board/btn_add.gif" alt="�߰�" /></a>
</div>


<?
	}
?>


<? 
	/* 
		�����������
		TECH_USE_YN == 'Y'
	*/
	if ($rsmdisplay[0]->TECH_USE_YN == 'Y') { 
?>
<div class="h3-tit-box mgt30">
		<h3>������� �� �ɷ�</h3>
		<a href="javascript:openComment('tech');" class="btn"><img src="<?=$FRONT_IMG_URL?>/img/board/table_btn01.gif" alt="�ۼ� �� ���ǻ���" /></a>
	</div>

<table class="TbStyle01 mgt10" summary="������� �� �ɷ�">
<caption>������� �� �ɷ�</caption>
  <colgroup>
  <col width="32%" />
  <col width="15%" />
  <col width="*" />
  <col width="10%" />
  </colgroup>
  <thead>
	<tr>
		<th scope="col">�����ɷ�</th>
		<th scope="col">����</th>
		<th scope="col">�󼼳���</th>
		<th scope="col">����</th>
	</tr>
  </thead>
</table>

<div id="id_tech_list">
<?
foreach ($techRs as $key => $techList)
{
	$techIdx = $key + 1;
?>	
	<table class="TbStyle01" summary="������� �� �ɷ�" id="id_tech_box_set_<?=$techIdx?>">
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
		<td rowspan="4" class="center"><img id="TECH_DEL_<?=$techIdx?>" name="TECH_DEL_<?=$techIdx?>" src="<?=$FRONT_IMG_URL?>/img/board/btn_del.gif"  alt="����"  /></td>
	</tr>
  </tbody>
	</table>

<?
}
?>
</div>
<div class="textR">
<a href="javascript:goProcess();"><img src="<?=$FRONT_IMG_URL?>/img/board/table_btn03.gif" alt="�߰� ����" /></a>
<a href="javascript:addFormData('tech');"><img src="<?=$FRONT_IMG_URL?>/img/board/btn_add.gif" alt="�߰�" /></a>
</div>
			

<?
	}
?>



<? 
	/* 
		��������
		EDUCATION_USE_YN == 'Y'
	*/
	if ($rsmdisplay[0]->EDUCATION_USE_YN == 'Y') { 
?>
<div class="h3-tit-box mgt30">
	<h3>�����̼� ����</h3>
	<a href="javascript:openComment('education');" class="btn"><img src="<?=$FRONT_IMG_URL?>/img/board/table_btn01.gif" alt="�ۼ� �� ���ǻ���" /></a>
</div>

<table class="TbStyle01 mgt10" summary="�����̼� ����">
<caption>�����̼� ����</caption>
  <colgroup>
  <col width="32%" />
  <col width="15%" />
  <col width="*" />
  <col width="10%" />
  </colgroup>
  <thead>
	<tr>
		<th scope="col">Ȱ���Ⱓ</th>
		<th scope="col" colspan="2">��Ȱ��</th>
		<th scope="col">����</th>
	</tr>
  </thead>
</table>

<div id="id_educ_list">
<?
foreach ($educRs as $key => $educList)
{
	$educIdx = $key + 1;
?>	
	<table class="TbStyle01" summary="�����̼� ����" id="id_educ_box_set_<?=$educIdx?>">
<caption>�����̼� ����</caption>
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
				<input class="b_input" type="text" name="EDU_STDT1_<?=$educIdx?>" id="EDU_STDT1_<?=$educIdx?>" value="<?=$educList->EDU_STDT1?>" maxlength="4" style="width:30px;" /> <label for="">��</label>
				<input class="b_input" type="text" name="EDU_STDT2_<?=$educIdx?>" id="EDU_STDT2_<?=$educIdx?>" value="<?=$educList->EDU_STDT2?>" maxlength="2" style="width:20px;"  /> <label for="">��</label> ~ 
				<input class="b_input" type="text" name="EDU_EDDT1_<?=$educIdx?>" id="EDU_EDDT1_<?=$educIdx?>" value="<?=$educList->EDU_EDDT1?>" maxlength="4" style="width:30px;" /> <label for="">��</label>
				<input class="b_input" type="text" name="EDU_EDDT2_<?=$educIdx?>" id="EDU_EDDT2_<?=$educIdx?>" value="<?=$educList->EDU_EDDT2?>" maxlength="2" style="width:20px;"  /> <label for="">��</label>
			</td>
			<th scope="row"><label for="edu_name">������</label></th>
			<td>
				<input class="b_input" type="text" name="EDU_NM_<?=$educIdx?>" id="EDU_NM_<?=$educIdx?>" value="<?=$educList->EDU_NM?>" style="width:95%;" title="�������Է�" maxlength="50" />
			</td>
			<td rowspan="4" class="center Lline"><img id="EDUC_DEL_<?=$educIdx?>" name="EDUC_DEL_<?=$educIdx?>" src="<?=$FRONT_IMG_URL?>/img/board/btn_del.gif"  alt="����"  /></td>
		</tr>
		<tr>
			<th scope="row"><label for="ogani_03">�������</label></th>
			<td>
				<input class="b_input" type="text" name="EDU_ORG_NM_<?=$educIdx?>" id="EDU_ORG_NM_<?=$educIdx?>" value="<?=$educList->EDU_ORG_NM?>" style="width:95%;" maxlength="50" title="��������Է�" />
			</td>
		</tr>
		<tr>
			<th scope="row"><label for="active_content_03">��������</label></th>
			<td><textarea name="EDU_CNTNT_<?=$educIdx?>" rows="" cols="" id="EDU_CNTNT_<?=$educIdx?>" style="width:95%;"><?=$educList->EDU_CNTNT?></textarea></td>
		</tr>
	  </tbody>
	</table>
<? } ?>
</div>
<div class="textR">
	<a href="javascript:goProcess();"><img src="<?=$FRONT_IMG_URL?>/img/board/table_btn03.gif" alt="�߰� ����" /></a>
	<a href="javascript:addFormData('educ');"><img src="<?=$FRONT_IMG_URL?>/img/board/btn_add.gif" alt="�߰�" /></a>
</div>

<?
	}
?>


<? 
	/* 
		�ؿ� ���� 
		TRAINING_USE_YN == 'Y'
	*/
	if ($rsmdisplay[0]->TRAINING_USE_YN == 'Y') { 
?>
<div class="h3-tit-box mgt30">
	<h3>�ؿܿ��� �� �ؿܰ���</h3>
	<a href="javascript:openComment('trip');" class="btn"><img src="<?=$FRONT_IMG_URL?>/img/board/table_btn01.gif" alt="�ۼ� �� ���ǻ���" /></a>
</div>

<table class="TbStyle01 mgt10" summary="�ؿܿ��� �� �ؿܰ���">
<caption>�ؿܿ��� �� �ؿܰ���</caption>
  <colgroup>
  <col width="32%" />
  <col width="15%" />
  <col width="*" />
  <col width="10%" />
  </colgroup>
  <thead>
	<tr>
		<th scope="col">Ȱ���Ⱓ</th>
		<th scope="col" colspan="2">��Ȱ��</th>
		<th scope="col">����</th>
	</tr>
  </thead>
</table>
<div id="id_trng_list">
<?
foreach ($trngRs as $key => $trngList)
{
	$trngIdx = $key + 1;
?>	
	<table class="TbStyle01" summary="�����̼� ����" id="id_trng_box_set_<?=$trngIdx?>">
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
					<input class="b_input" type="text" name="TRN_STDT1_<?=$trngIdx?>" id="TRN_STDT1_<?=$trngIdx?>" value="<?=$trngList->TRN_STDT1?>" maxlength="4" style="width:30px;" /> <label for="">��</label>
					<input class="b_input" type="text" name="TRN_STDT2_<?=$trngIdx?>" id="TRN_STDT2_<?=$trngIdx?>" value="<?=$trngList->TRN_STDT2?>" maxlength="2" style="width:20px;" /> <label for="">��</label> ~ 
					<input class="b_input" type="text" name="TRN_EDDT1_<?=$trngIdx?>" id="TRN_EDDT1_<?=$trngIdx?>" value="<?=$trngList->TRN_EDDT1?>" maxlength="4" style="width:30px;" /> <label for="">��</label>
					<input class="b_input" type="text" name="TRN_EDDT2_<?=$trngIdx?>" id="TRN_EDDT2_<?=$trngIdx?>" value="<?=$trngList->TRN_EDDT2?>" maxlength="2" style="width:20px;" /> <label for="">��</label>
				</td>
				<th scope="row"><label for="trn_name">���й� ����</label></th>
				<td><?=${'frmTRN_TP_CD_' . $trngIdx}?><input type="hidden" id="TRN_TP_NM_<?=$trngIdx?>" maxlength="50" name="TRN_TP_NM_<?=$trngIdx?>" value="<?=$trngList->TRN_TP_NM?>" /> ������ : <input class="b_input" type="text" name="TRN_CTRY_NM_<?=$trngIdx?>" id="TRN_CTRY_NM_<?=$trngIdx?>" value="<?=$trngList->TRN_CTRY_NM?>" style="width:100px;" title="�������Է�" />
				</td>
				<td rowspan="5" class="center Lline"><img id="TRNG_DEL_<?=$trngIdx?>" name="TRNG_DEL_<?=$trngIdx?>" src="<?=$FRONT_IMG_URL?>/img/board/btn_del.gif"  alt="����"  /></td>
			</tr>
			<tr>
				<th scope="row"><label for="ogani_03">���/��ü</label></th>
				<td>
					<input class="b_input" type="text" name="TRN_ORG_NM_<?=$trngIdx?>" id="TRN_ORG_NM_<?=$trngIdx?>" maxlength="50" value="<?=$trngList->TRN_ORG_NM?>" style="width:95%;" title="" />
				</td>
			</tr>
			<tr>
				<th scope="row"><label for="ogani_03">����</label></th>
				<td>
					<input class="b_input" type="text" name="TRN_OBJ_NM_<?=$trngIdx?>" id="TRN_OBJ_NM_<?=$trngIdx?>" maxlength="50" value="<?=$trngList->TRN_OBJ_NM?>" style="width:95%;" title="" />
				</td>
			</tr>
			<tr>
				<th scope="row"><label for="active_content_03">Ȱ������</label></th>
				<td><textarea name="TRN_CNTNT_<?=$trngIdx?>" rows="" cols="" id="TRN_CNTNT_<?=$trngIdx?>" style="width:95%;"><?=$trngList->TRN_CNTNT?></textarea></td>
			</tr>
		  </tbody>
	</table>
<?
	}
?>
</div>
<div class="textR">
<a href="javascript:goProcess();"><img src="<?=$FRONT_IMG_URL?>/img/board/table_btn03.gif" alt="�߰� ����" /></a>
<a href="javascript:addFormData('trng');"><img src="<?=$FRONT_IMG_URL?>/img/board/btn_add.gif" alt="�߰�" /></a>
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

<!-- S: �ڱ�Ұ��� -->
<div class="h3-tit-box mgt30">
	<h3>�ڱ�Ұ���</h3>
	
	<a href="javascript:openComment('contents');" class="btn"><img src="<?=$FRONT_IMG_URL?>/img/board/table_btn01.gif" alt="�ۼ� �� ���ǻ���" /></a>
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
					alert('[' + $("#RSM_CNTNT_FLAG_TITLE_" + x).val() + '] �ּ� ' + $("#RSM_CNTNT_FLAG_MIN_LEN_" + x).val() + '�� �̻��Դϴ�. ');
					return 'error';
				}
			}
			x++;
		}
		
	}
	
</script>
<table class="TbStyle01 mgt10" summary="�ڱ�Ұ���">
	<caption>�ڱ�Ұ���</caption>
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
	<a href="javascript:goProcess();"><img src="<?=$FRONT_IMG_URL?>/img/board/table_btn03.gif" alt="�߰� ����" /></a>
</div>


<? } ?>



<? 
	/* 
		CONTENT_USE_YN == 'Y'
	*/
	if ($rsmdisplay[0]->FILE_USE_YN == 'Y') { 
?>

<!-- S: �ڱ�Ұ��� -->
<div class="h3-tit-box mgt30">
	<h3>���Ͼ��ε�</h3>
	
	<a href="javascript:openComment('file');" class="btn"><img src="<?=$FRONT_IMG_URL?>/img/board/table_btn01.gif" alt="�ۼ� �� ���ǻ���" /></a>
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
					alert('[' + $("#RSM_CNTNT_FLAG_TITLE_" + x).val() + '] �ּ� ' + $("#RSM_CNTNT_FLAG_MIN_LEN_" + x).val() + '�� �̻��Դϴ�. ');
					return 'error';
				}
			}
			x++;
		}
		
	}
	
</script>
<table class="TbStyle01 mgt10" summary="�ڱ�Ұ���">
	<caption>���Ͼ��ε�</caption>
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
				<p>( ����ũ�� ���� : <?=$data->FILE_MAX_SIZE?> KB )<br>���Ȯ���� : ( <?=$data->FILE_AVL_EXT?> )</p>
				
				<? if ($data->APPL_FILE_NM != '' ) { ?><div id="RSM_FILE_MSG_<?=($key+1)?>" >[ <?=$data->APPL_FILE_NM?> ] <img id="FILE_DEL_<?=($key+1)?>" name="FILE_DEL_<?=($key+1)?>" src="<?=$FRONT_IMG_URL?>/img/board/btn_del.gif"  alt="����" onclick="javascript:delFileList('<?=$data->RSM_FILE_IDX?>',<?=($key+1)?>);" style="cursor:hand;"  /> </div><? } ?>
			</td>
		</tr>
		<? } ?>
	  </tbody>
</table>

<div class="textR">
	<a href="javascript:goProcess();"><img src="<?=$FRONT_IMG_URL?>/img/board/table_btn03.gif" alt="�߰� ����" /></a>
</div>


<? } ?>




<p class="point-txt">�� ������ ��������� ��� ��������� ��ǰ� �ٸ��� ������ �����ϸ�, ���� ������ ���� ������ ������ �Ǹ�Ǿ� �հ� �Ǵ� �Ի簡 ��ҵǴ��� ���Ǹ� �������� ���� ���� ���� �մϴ�.</p>
<input type="submit" id="SUBMIT_BUTTON" value="�����Ӹ�" style="display:none">
<div class="textC">
	<a href="javascript:goProcess();">[������ ����]</a>
	<? if ($APPL_YN != 'Y' ) { ?><a href="javascript:goApplySubmit();"><img src="<?=$FRONT_IMG_URL?>/img/board/table_btn05.gif" alt="����" /></a><? } ?>
</div>

<div class="box-red">
								������ �Ϸ� �Ͻô��� ���� ���� �Ⱓ ������ �Ի������� ������ ���� �ϸ�, ������ �ƴ� �ӽ� �������� ���� �Ⱓ�� ���� �� ��쿡�� �Ի����� �Ϸ�� ������ ���� �ʽ��ϴ�. �ݵ�� �Ի������� ���� �� �����ȣ �߱��� �Ϸ��ϼž� ���� �Ի������� �˴ϴ�.
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

			<table class="TbStyle01" summary="��������" id="id_fmly_box_set">
			<caption>��������</caption>
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
			<td class="center"><img id="FMLY_DEL" name="FMLY_DEL" src="<?=$FRONT_IMG_URL?>/img/board/btn_del.gif"  alt="����"  /></td>
			</tr>
			</tbody>
			</table>

</div>
<? } ?>



<? if ($rsmdisplay[0]->CAREER_USE_YN == 'Y') { ?>
<div id="id_carr_sample" style="display:none">
	<table class="TbStyle01 mgt10" id="id_carr_box_set">
	<caption>��»��� ��</caption>
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
			<input class="b_input" type="text" name="CAREER_STDT1" id="CAREER_STDT1" SIZE="4" maxlength="4" />�� <input class="b_input" type="text" name="CAREER_STDT2" id="CAREER_STDT2" maxlength="2"  SIZE="2"  />�� ~ 
			<input class="b_input" type="text" name="CAREER_EDDT1" id="CAREER_EDDT1" SIZE="4" maxlength="4" />�� <input class="b_input" type="text" name="CAREER_EDDT2" id="CAREER_EDDT2" maxlength="2"  SIZE="2"  />��
			<br>
			<?=$frmCAREER_STS_CD?><input type="hidden" id="CAREER_STS_NM" name="CAREER_STS_NM" />
		</td>
		<th scope="row"><label for="company_name">ȸ���</label></th>
		<td><input class="b_input" type="text" id="CAREER_CMP_NM" name="CAREER_CMP_NM" style="width:85px;" maxlength="50" /> <?=$frmCAREER_CMP_TP_CD?><input type="hidden" id="CAREER_CMP_TP_NM" name="CAREER_CMP_TP_NM" /> <?=$frmCAREER_LOC_CD?><input type="hidden" id="CAREER_LOC_NM" name="CAREER_LOC_NM" /></td>
		<td rowspan="5" class="center Lline"><img id="CARR_DEL" name="CARR_DEL" src="<?=$FRONT_IMG_URL?>/img/board/btn_del.gif"  alt="����"  /></td>
	</tr>
	<tr>
		<th>����</th>
		<td><?=$frmCAREER_EMP_TP_CD?><input type="hidden" id="CAREER_EMP_TP_NM" name="CAREER_EMP_TP_NM" /> <input class="b_input" type="text" name="CAREER_JOB_TP_NM" id="CAREER_JOB_TP_NM"  style="width:120px;" readonly /><input type="hidden" name="CAREER_JOB_TP_CD" id="CAREER_JOB_TP_CD" /> 
			<img id="BTN_SEARCH_JOBTYPE" name="BTN_SEARCH_JOBTYPE" src="<?=$FRONT_IMG_URL?>/img/board/btn_search.gif" alt="�˻�" />
		</td>
	</tr>
	<tr>
		<th>�ٹ��μ�/����</th>
		<td>�μ��� : <input class="b_input" type="text" name="CAREER_DEPT_NM" id="CAREER_DEPT_NM" style="width:140px;"  maxlength="50" /> <?=$frmCAREER_PSTN_CD?><input type="hidden" id="CAREER_PSTN_NM" name="CAREER_PSTN_NM" /> <?=$frmCAREER_PSTN_LVL_CD?><input type="hidden" id="CAREER_PSTN_LVL_NM" name="CAREER_PSTN_LVL_NM" /></td>
	</tr>
	<tr>
		<th>��������</th>
		<td><textarea class="b_input" type="text" name="CAREER_CNTNT" id="CAREER_CNTNT" style="width:95%;" /></textarea></td>
	</tr>
	<tr>
		<th>������</th>
		<td><?=$frmCAREER_RETIRE_CD?><input type="hidden" name="CAREER_RETIRE_NM" id="CAREER_RETIRE_NM" /> </td>
	</tr>
	</tbody>
	</table>
</div>	
<? } ?>

<? if ($rsmdisplay[0]->WRITE_USE_YN == 'Y') { ?>
<div id="id_wrte_sample" style="display:none">
	<table class="TbStyle01 mgt10" summary="��������" id="id_wrte_box_set">	
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
					<input class="b_input" type="text" name="WRT_DT1" id="WRT_DT1" style="width:30px;" maxlength="4" />  <label for="">��</label> 
					<input class="b_input" type="text" name="WRT_DT2" id="WRT_DT2" style="width:20px;" maxlength="2"  />  <label for="">��</label> 
					<input class="b_input" type="text" name="WRT_DT3" id="WRT_DT3" style="width:20px;" maxlength="2"  />  <label for="">��</label> 
			</td>
			<td class="center"><img id="WRTE_DEL" name="WRTE_DEL" src="<?=$FRONT_IMG_URL?>/img/board/btn_del.gif"  alt="����"  /></td>
		</tr>
	</tbody>
	</table>
</div>	
<? } ?>

<? if ($rsmdisplay[0]->PRIZE_USE_YN == 'Y') { ?>
<div id="id_prze_sample" style="display:none">
	
	<table class="TbStyle01 mgt10" summary="���󳻿�" id="id_prze_box_set">	
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
					<input class="b_input" type="text" name="PRZ_DT1" id="PRZ_DT1" style="width:30px;" maxlength="4" />  <label for="">��</label> 
					<input class="b_input" type="text" name="PRZ_DT2" id="PRZ_DT2" style="width:20px;" maxlength="2"  />  <label for="">��</label> 
					<input class="b_input" type="text" name="PRZ_DT3" id="PRZ_DT3" style="width:20px;" maxlength="2"  />  <label for="">��</label> 
			</td>
			<td class="center"><img id="PRZE_DEL" name="PRZE_DEL" src="<?=$FRONT_IMG_URL?>/img/board/btn_del.gif"  alt="����"  /></td>
		</tr>
	</tbody>
	</table>
	
</div>	
<? } ?>

<? if ($rsmdisplay[0]->LANGUAGE2_USE_YN == 'Y') { ?>
<div id="id_lan2_sample" style="display:none">
	
	<table class="TbStyle01 mgt10" summary="���дɷ�" id="id_lan2_box_set">	
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
			<td class="center"><img id="LAN2_DEL" name="LAN2_DEL" src="<?=$FRONT_IMG_URL?>/img/board/btn_del.gif"  alt="����"  /></td>
		</tr>
	</tbody>
	</table>
	
</div>	
<? } ?>

<? if ($rsmdisplay[0]->LICENSE_USE_YN == 'Y') { ?>
<div id="id_lics_sample" style="display:none">
	
	<table class="TbStyle01 mgt10" summary="�ڰݴɷ�" id="id_lics_box_set">	
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
				<img id="BTN_SEARCH_LICENSE" name="BTN_SEARCH_LICENSE" src="<?=$FRONT_IMG_URL?>/img/board/btn_search.gif" alt="�˻�" />
			</td>
			<td class="center"><input class="b_input" type="text" name="LIC_PB_NM" id="LIC_PB_NM" maxlength="50" /></td>
			<td class="center">
				<input class="b_input" type="text" id="LIC_DT1" name="LIC_DT1" style="width:30px;" maxlength="4" />  <label for="">��</label> 
				<input class="b_input" type="text" id="LIC_DT2" name="LIC_DT2" style="width:20px;" maxlength="2"  />  <label for="">��</label> 
				<input class="b_input" type="text" id="LIC_DT3" name="LIC_DT3" style="width:20px;" maxlength="2"   />  <label for="">��</label> 
			</td>
			<td><input class="b_input" type="text" id="LIC_NUM" name="LIC_NUM" style="width:90%;" maxlength="25" /></td>
			<td class="center"><img id="LICS_DEL" name="LICS_DEL" src="<?=$FRONT_IMG_URL?>/img/board/btn_del.gif"  alt="����"  /></td>
		</tr>
	</tbody>
	</table>
	
</div>	
<? } ?>

<? if ($rsmdisplay[0]->SERVE_USE_YN == 'Y') { ?>
<div id="id_srve_sample" style="display:none">
	
	<table class="TbStyle01 mgt10" summary="�ֿ�Ȱ�� �� ��ȸ����" id="id_srve_box_set">
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
					<input class="b_input" type="text" name="SRV_STDT1" id="SRV_STDT1" value="" style="width:30px;" maxlength="4" /> <label for="">��</label>
					<input class="b_input" type="text" name="SRV_STDT2" id="SRV_STDT2" value="" style="width:20px;" maxlength="2" /> <label for="">��</label> ~ 
					<input class="b_input" type="text" name="SRV_EDDT1" id="SRV_EDDT1" value="" style="width:30px;" maxlength="4" /> <label for="">��</label>
					<input class="b_input" type="text" name="SRV_EDDT2" id="SRV_EDDT2" value="" style="width:20px;" maxlength="2" /> <label for="">��</label>
				</td>
				<th scope="row"><label for="active_kind">Ȱ������</label></th>
				<td>
					<?=$frmSRV_TP_CD?><input type="hidden" id="SRV_TP_NM" name="SRV_TP_NM" />
				</td>
				<td rowspan="4" class="center Lline"><img id="SRVE_DEL" name="SRVE_DEL" src="<?=$FRONT_IMG_URL?>/img/board/btn_del.gif"  alt="����"  /></td>
			</tr>
			<tr>
				<th scope="row"><label for="ogani">���/���</label></th>
				<td>
					<input class="b_input" type="text" name="SRV_ORG_NM" id="SRV_ORG_NM"  maxlength="50" value="" maxlength="50" style="width:95%;" title="���/����Է�" />
				</td>
			</tr>
			<tr>
				<th scope="row"><label for="active_content">Ȱ������</label></th>
				<td><textarea name="SRV_CNTNT" rows="" cols="" id="SRV_CNTNT" style="width:95%;"></textarea></td>
			</tr>
		  </tbody>
	</table>
	
</div>			
<? } ?>

<? if ($rsmdisplay[0]->TECH_USE_YN == 'Y') { ?>
<div id="id_tech_sample" style="display:none">
	
	<table class="TbStyle01 mgt10" summary="������� �� �ɷ�" id="id_tech_box_set">
		<colgroup>
	  <col width="32%" />
	  <col width="15%" />
	  <col width="*" />
	  <col width="10%" />
	  </colgroup>
	<tbody>
	<tr>
		<td><input class="b_input" type="text" name="TCH_NM" maxlength="50" id="TCH_NM" style="width:95%;" title="��������Է�" /><input type="hidden" id="TCH_SEQ" name="TCH_SEQ" /> </td>
		<td><input class="b_input" type="text" name="TCH_LVL" maxlength="50" id="TCH_LVL" style="width:95%;" title="��������Է�" /></td>
		<td><textarea name="TCH_CNTNT" rows="" cols="" id="TCH_CNTNT" style="width:95%;"></textarea></td>
		<td rowspan="4" class="center"><img id="TECH_DEL" name="TECH_DEL" src="<?=$FRONT_IMG_URL?>/img/board/btn_del.gif"  alt="����"  /></td>
	</tr>
  </tbody>
	</table>

</div>		
<? } ?>	

<? if ($rsmdisplay[0]->EDUCATION_USE_YN == 'Y') { ?>
<div id="id_educ_sample" style="display:none">
	
<table class="TbStyle01 mgt10" summary="�����̼� ����" id="id_educ_box_set">
<caption>�����̼� ����</caption>
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
				<input class="b_input" type="text" name="EDU_STDT1" id="EDU_STDT1" value="" style="width:30px;" maxlength="4" /> <label for="">��</label>
				<input class="b_input" type="text" name="EDU_STDT2" id="EDU_STDT2" value="" style="width:20px;" maxlength="2" /> <label for="">��</label> ~ 
				<input class="b_input" type="text" name="EDU_EDDT1" id="EDU_EDDT1" value="" style="width:30px;" maxlength="4" /> <label for="">��</label>
				<input class="b_input" type="text" name="EDU_EDDT2" id="EDU_EDDT2" value="" style="width:20px;" maxlength="2" /> <label for="">��</label>
			</td>
			<th scope="row"><label for="edu_name">������</label></th>
			<td>
				<input class="b_input" type="text" name="EDU_NM" id="EDU_NM" value="" style="width:95%;" title="�������Է�" maxlength="50" />
			</td>
			<td rowspan="4" class="center Lline"><img id="EDUC_DEL" name="EDUC_DEL" src="<?=$FRONT_IMG_URL?>/img/board/btn_del.gif"  alt="����"   /></td>
		</tr>
		<tr>
			<th scope="row"><label for="ogani_03">�������</label></th>
			<td>
				<input class="b_input" type="text" name="EDU_ORG_NM" id="EDU_ORG_NM" value="" style="width:95%;" title="��������Է�" maxlength="50" />
			</td>
		</tr>
		<tr>
			<th scope="row"><label for="active_content_03">��������</label></th>
			<td><textarea name="EDU_CNTNT" rows="" cols="" id="EDU_CNTNT" style="width:95%;"></textarea></td>
		</tr>
	  </tbody>
	</table>
	
</div>			
<? } ?>	

<? if ($rsmdisplay[0]->TRAINING_USE_YN == 'Y') { ?>
<div id="id_trng_sample" style="display:none">
	
	<table class="TbStyle01 mgt10" summary="�����̼� ����" id="id_trng_box_set">
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
				<input class="b_input" type="text" name="TRN_STDT1" id="TRN_STDT1" value="" style="width:30px;" maxlength="4" /> <label for="">��</label>
				<input class="b_input" type="text" name="TRN_STDT2" id="TRN_STDT2" value="" style="width:20px;" maxlength="2" /> <label for="">��</label> ~ 
				<input class="b_input" type="text" name="TRN_EDDT1" id="TRN_EDDT1" value="" style="width:30px;" maxlength="4" /> <label for="">��</label>
				<input class="b_input" type="text" name="TRN_EDDT2" id="TRN_EDDT2" value="" style="width:20px;" maxlength="2" /> <label for="">��</label>
			</td>
			<th scope="row"><label for="trn_name">���й� ����</label></th>
			<td><?=$frmTRN_TP_CD?><input type="hidden" id="TRN_TP_NM" name="TRN_TP_NM" /> ������ : <input class="b_input" type="text" name="TRN_CTRY_NM" id="TRN_CTRY_NM" value="" maxlength="50" style="width:100px;" title="�������Է�" />
			</td>
			<td rowspan="5" class="center Lline"><img id="TRNG_DEL" name="TRNG_DEL" src="<?=$FRONT_IMG_URL?>/img/board/btn_del.gif"  alt="����"  /></td>
		</tr>
		<tr>
			<th scope="row"><label for="ogani_03">���/��ü</label></th>
			<td>
				<input class="b_input" type="text" name="TRN_ORG_NM" id="TRN_ORG_NM" value="" style="width:95%;" title="" maxlength="50" />
			</td>
		</tr>
		<tr>
			<th scope="row"><label for="ogani_03">����</label></th>
			<td>
				<input class="b_input" type="text" name="TRN_OBJ_NM" id="TRN_OBJ_NM" value="" style="width:95%;" title="" maxlength="50" />
			</td>
		</tr>
		<tr>
			<th scope="row"><label for="active_content_03">Ȱ������</label></th>
			<td><textarea name="TRN_CNTNT" rows="" cols="" id="TRN_CNTNT" style="width:95%;"></textarea></td>
		</tr>
	  </tbody>
	</table>
	
</div>	
<? } ?>


<? if ($rsmdisplay[0]->SCHOOL_USE_YN == 'Y') { ?>
<div id="id_schl_sample" style="display:none">
	
	<table class="TbStyle01 mgt10" summary="�з»���" id="id_schl_box_set">
	<caption>�з»���</caption>
	  <colgroup>
	  <col width="15%" />
	  <col width="*" />
	  <col width="10%" />
	  </colgroup>
	  <tbody>
	  <tr>
	  	<th scope="row">�з±���</th>
	  	<td colspan="2">
	  		<div style="text-align:left;float:left"><?=$frmSCH_TP?> �з±��� ���� �����ϼ���.</div>
	  		<div style="text-align:right">
				<input type="checkbox" class="checkbox" name="SCH_FGRD_TP" id="SCH_FGRD_TP" value="Y" />
				<label for="last_academic">�����з��� ��� üũ</label>
				</div>
	  	</td>
		</tr>
		<tr>
			<th scope="row"><label for="school_name_02">�б���</label></th>
			<td colspan=2>
				<input type="hidden" name="SCH_SEQ" id="SCH_SEQ" />
				<input class="b_input" type="text" name="SCH_NM" id="SCH_NM" value="" title="�б����Է�" readonly />
				<input type="hidden" size="10" id="SCH_CD" name="SCH_CD">
				<img src="<?=$FRONT_IMG_URL?>/img/board/btn_search.gif" alt="�˻�" id="BTN_SEARCH_SCHOOL" name="BTN_SEARCH_SCHOOL" />
				<?=$frmSCH_JUYA?>
				<?=$frmSCH_BRANCH_TP?>
				<?=$frmSCH_LOC?>
			</td>
			
		</tr>
		<tr>
			<th scope="row"><label for="school_term_01_01">���бⰣ</label></th>
			<td>
				<input class="b_input" type="text" name="SCH_STDT1" id="SCH_STDT1" value="" style="width:30px;" maxlength="4" /> <label for="">��</label>
				<input class="b_input" type="text" name="SCH_STDT2" id="SCH_STDT2" value="" style="width:20px;" maxlength="2"  /> <label for="">��</label>
				<?=$frmSCH_ETTP1?> ~ 
				<input class="b_input" type="text" name="SCH_EDDT1" id="SCH_EDDT1" value="" style="width:30px;" maxlength="4" /> <label for="">��</label>
				<input class="b_input" type="text" name="SCH_EDDT2" id="SCH_EDDT2" value="" style="width:20px;" maxlength="2"  /> <label for="">��</label>
				<?=$frmSCH_ETTP2?>
			</td>
			<td rowspan="2" class="center Lline"><img id="SCHL_DEL" name="SCHL_DEL" src="<?=$FRONT_IMG_URL?>/img/board/btn_del.gif"  alt="����"  /></td>
		</tr>
		<tr>
			<th scope="row">���� �� ����</th>
			<td>
				
				<ul>
					<li>
				
						<div style="width:50px;float:left">����</div>
						<div style="width:100px;float:left">�迭 �а�(����)</div>
						<?=$frmSCH_AFF?>
						
						<input type="hidden" size="10" id="SCH_MAJOR_CD" name="SCH_MAJOR_CD">
						<input class="b_input" type="text" name="SCH_MAJOR_NM" id="SCH_MAJOR_NM" value="" title="�����а��Է�" readonly />
						<img src="<?=$FRONT_IMG_URL?>/img/board/btn_search.gif" alt="�˻�" id="BTN_SEARCH_MAJOR" name="BTN_SEARCH_MAJOR" />
					</li>
					<li>
						<div style="width:50px;float:left"></div>
						<div style="width:60px;float:left">�������</div>
						<input class="b_input" type="text" name="SCH_HAKJUM" id="SCH_HAKJUM" value="" style="width:30px" title="��������Է�"  />
						<span class="space">/</span>
						<?=$frmSCH_MAX_HAKJUM?>
						&nbsp;&nbsp;�̼�����
						<input class="b_input" type="text" name="SCH_ISU_HAKJUM" id="SCH_ISU_HAKJUM" value="" style="width:40px;" title="�̼������Է�" />
					</li>
					<li>
						<div style="width:50px;float:left">������</div>
						<div style="width:100px;float:left">���� ����</div>
						<?=$frmSCH_SUB_MAJOR_TP?>
					</li>
					<li id="id_sub_major_form" style="display:none">
						
						<div style="width:50px;float:left">������</div>
						<div style="width:100px;float:left">�迭 �а�(����)</div>
						
						<?=$frmSCH_SUB_AFF?>
						<input class="b_input" type="text" name="SCH_SUB_MAJOR_NM" id="SCH_SUB_MAJOR_NM" value="" title="��/���� ���� �а��Է�" readonly />
						<input type="hidden" size="10" id="SCH_SUB_MAJOR_CD" name="SCH_SUB_MAJOR_CD">
						<img src="<?=$FRONT_IMG_URL?>/img/board/btn_search.gif" alt="�˻�" id="BTN_SEARCH_SUB_MAJOR" name="BTN_SEARCH_SUB_MAJOR" />
					</li>
				</ul>
					
			</td>
		</tr>
		
	  </tbody>
	</table>

</div>


		<!-- ����б� �׸� -->
		<div id="id_sch_type1_highschool" style="display:none">
		<input type="hidden" id="SCH_SEQ_1" name="SCH_SEQ_1" value="<?=$SCH_SEQ_1?>" />
		<input class="b_input" type="text" name="SCH_NM_1" id="SCH_NM_1" value="<?=$SCH_NM_1?>" readonly />
		<input type="hidden" size="10" id="SCH_CD_1" name="SCH_CD_1" value="<?=$SCH_CD_1?>">
		<img src="<?=$FRONT_IMG_URL?>/img/board/btn_search.gif" alt="�˻�" onclick="javascript:searchPopSch('�б�','school',25,1,'SCH','Y','L','width=500 height=550');" style="cursor:hand;" />

		<?=$frmSCH_JUYA_1?>
		<?=$frmSCH_BRANCH_TP_1?>
		<?=$frmSCH_LOC_1?>
		</div>
	
		<div id="id_sch_type2_highschool" style="display:none">
		<input class="b_input" type="text" name="SCH_STDT1_1" id="SCH_STDT1_1" value="<?=$SCH_STDT1_1?>" style="width:30px;" maxlength="4" onblur="CheckFormDate('SCH_STDT','1')&CheckTermDate('SCH','1');" /> <label for="">��</label>
		<input class="b_input" type="text" name="SCH_STDT2_1" id="SCH_STDT2_1" value="<?=$SCH_STDT2_1?>" style="width:20px;" maxlength="2" onblur="javascript:setNum2str(this)&CheckFormDate('SCH_STDT','1')&CheckTermDate('SCH','1');" /> <label for="">��</label>
		<?=$frmSCH_ETTP1_1?> ~ 
		
		<input class="b_input" type="text" name="SCH_EDDT1_1" id="SCH_EDDT1_1" value="<?=$SCH_EDDT1_1?>" style="width:30px;" maxlength="4" onblur="CheckFormDate('SCH_EDDT','1')&CheckTermDate('SCH','1');" /> <label for="">��</label>
		<input class="b_input" type="text" name="SCH_EDDT2_1" id="SCH_EDDT2_1" value="<?=$SCH_EDDT2_1?>" style="width:20px;" maxlength="2" onblur="javascript:setNum2str(this)&CheckFormDate('SCH_EDDT','1')&CheckTermDate('SCH','1');" /> <label for="">��</label>
		<?=$frmSCH_ETTP2_1?>
		</div>
	
		<!-- ������� �׸� -->
		<div id="id_sch_type1_blackgosi" style="display:none">
		<input type="hidden" id="SCH_SEQ_1" name="SCH_SEQ_1" value="<?=$SCH_SEQ_1?>" />
		<input class="b_input" type="hidden" name="SCH_NM_1" id="SCH_NM_1" value="�������" title="�б����Է�" readonly />
		<input type="hidden" size="10" id="SCH_CD_1" name="SCH_CD_1" value="13">
		<input type="hidden" id="SCH_JUYA_1" name="SCH_JUYA_1" value="" />
		<input type="hidden" id="BRANCH_TP_1" name="BRANCH_TP_1" value="" />
		<?=$frmSCH_LOC_1?>
		</div>
		
		<div id="id_sch_type2_blackgosi" style="display:none">
		<input class="b_input" type="text" name="SCH_EDDT1_1" id="SCH_EDDT1_1" value="<?=$SCH_EDDT1_1?>" style="width:30px;" maxlength="4" onblur="CheckFormDate('SCH_EDDT','1');"  /> <label for="">��</label>
		<input class="b_input" type="text" name="SCH_EDDT2_1" id="SCH_EDDT2_1" value="<?=$SCH_EDDT2_1?>" style="width:20px;" maxlength="2" onblur="javascript:setNum2str(this)&CheckFormDate('SCH_EDDT','1');" /> <label for="">��</label>
		<input class="b_input" type="text" name="SCH_EDDT3_1" id="SCH_EDDT3_1" value="<?=$SCH_EDDT3_1?>" style="width:20px;" maxlength="2" onblur="javascript:setNum2str(this)&CheckFormDate('SCH_EDDT','1');" /> <label for="">��</label>
		<input type="hidden" id="SCH_ETTP2_1" name="SCH_ETTP2_1" value="19" />
		</div>

<? } ?>

<? foreach ($cmtData as $key => $cmtList) { ?>	
	<div id="dialog_for_<?=$cmtList->DFC_CD?>" style="display:none">
	<?=String2Html($cmtList->DFC_CNTNT)?>
	</div>
<? } ?>

