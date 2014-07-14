<script language="javascript" src="/assets/js/jquery-ui.js"></script>
<script language="javascript" src="/assets/js/dropdown/jquery.multiselect.filter.min.js"></script>
<script language="javascript" src="/assets/js/dropdown/jquery.multiselect.min.js"></script>
<link rel="stylesheet" type="text/css" href="/assets/css/jquery.multiselect.css" />
<link rel="stylesheet" type="text/css" href="/assets/css/jquery.multiselect.filter.css" />
<link rel="stylesheet" type="text/css" href="/assets/css/jqueryui.css" />
<script language="javascript" src="/assets/js/jquery.validate.js"></script>
<script>
	
	var el = null;
	
	function bodyOnLoad()
	{
		ableFormSet(true);
		
		el = $("#WORK_PLACE_LIST").multiselect({
							click: function(event, ui){
								setWorkPlaceAddMaxRule($("#WORK_PLACE_LIST").multiselect('getChecked').length);
							}
		}),
		selected = $('#selected'),
		newItem = $('#newItem');
  	
  	setUnitLoad();
			
		$("#form1").validate({  
				groups:{
					APPLYNO_ERROR:"APPL_TP APPL_LEN APPL_PREFIX APPL_SUFFIX NEW_CURRENT_SEQ"
				},
		    rules: {  
		      APPL_TP:{required:true},
		      APPL_LEN:{required:true,digits:true,min:1},
		      APPL_PREFIX:{digitchars:true},
		      APPL_SUFFIX:{digitchars:true},
		      NEW_CURRENT_SEQ:{digits:true},
		      APPLY_CNT:{required:true,digits:true,min:1},
		      WRK_PLC_CNT:{digits:true}
		    },  
		    onkeyup:false,
		    messages: {
		    		APPLY_CNT:{
		    				required:"ä���ο��� �Է��ϼ���.",
		    				digits:"���ڸ� �Է��ϼ���",
		    				min:"1�̻� �Է°����մϴ�."},
		    		APPL_TP:"�����ȣ ���� ����� �����ϼ���.",
		    		APPL_LEN:{
		    				required:"�����ȣ ������ ���̸� �Է��ϼ���.",
		    				digits:"���ڸ� �Է��ϼ���",
		    				min:"1�̻� �Է°����մϴ�."},
		    		APPL_PREFIX:"����,���ڸ� �����մϴ�.",
		    		APPL_SUFFIX:"����,���ڸ� �����մϴ�.",
		    		NEW_CURRENT_SEQ:"���ڸ� �Է°����մϴ�.",
		    		WRK_PLC_CNT:"���ڸ� �Է°����մϴ�."
		    },
		    submitHandler: function(form) { 
				
	    	form.submit();

	    	}
   	});  
		
  	
	}
	
	
	// ���� ��з� �ε�
	function setUnitLoad()
	{
		getUnitListData('');
		
		$("#UNIT_LEVEL1").empty().append('<option value="">�����ϼ���.</option>');
		$("#UNIT_LEVEL2").empty().append('<option value="">�����ϼ���.</option>');
		$("#UNIT_LEVEL3").empty().append('<option value="">�����ϼ���.</option>');
		
		var modifyCode = Number($("#CODELIST_1").val());
		
		$.ajax({
    url: "/admin/stepManagement/unitLevelList?PRJ_IDX=" + $("#PRJ_IDX").val(),
    type: "get",
    dataType:'json',
    //data: serializedData,
    success: function(response, textStatus, jqXHR){
     
     		var chk_a = 0;
     		var chk_b = 0;
       	for (var a = 0 ; a < response.length ; a ++)
       	{
       		$("#UNIT_LEVEL1").append('<option value="' + response[a][0] + '|' + response[a][2] + '">' + response[a][1] + '</option>');     		
       		if (response[a][0] == modifyCode)
       		{
       			chk_a = a + 1;
       			chk_b = response[a][2];
       		}
       	}
       	
       	// 1. modifyCode 
       	
       	if (modifyCode && Number(modifyCode) > 0)
       	{
       		$("#UNIT_LEVEL1 option:eq(" + chk_a + ")").attr('selected','selected');
       	}
       	
       	//if (chk_b == 0) getUnitListData($("#UNIT_LEVEL1 option:selected").val());
       	
       	//����Ŭ���� ��з��� ������ ������ onchange �Լ� ����
       	if (modifyCode > 0)
       	{
       		setUnitLevel1($("#UNIT_LEVEL1 option:selected").val());
       	}
       	
    },
    error: function(jqXHR, textStatus, errorThrown){
        //console.log("The following error occured: "+textStatus, errorThrown);
        
    },
    // callback handler that will be called on completion
    // which means, either on success or error
    complete: function(){
    	  // enable the inputs
    }
		});
		
		
	}
	
	//��з� ���ý� �ߺз� �ε�
	function setUnitLevel1(selectedCode)
	{	
		// select form clear
		var PUNIT_IDX = null;
		var UNIT_IDX = null;
		$("#UNIT_LEVEL2").empty().append('<option value="">�����ϼ���.</option>');	
		$("#UNIT_LEVEL3").empty().append('<option value="">�����ϼ���.</option>');	
		getUnitListData($("#UNIT_LEVEL1 option:selected").val());
		var tmp_PUNIT_IDX = $("#UNIT_LEVEL1 option:selected").val().split('|'); //�����ڵ�
		
		PUNIT_IDX = tmp_PUNIT_IDX[0];
		
		//������������ �ڵ尡 ������?
		var modifyValue = $("#CODELIST_2").val();
		
		//������ �������� �����ڵ尡 ������ �ִٰ� �Ҷ��� �Ʒ�ajax�� ����
		if ($("#UNIT_LEVEL1 option:selected").val() != '' && Number(tmp_PUNIT_IDX[1]) > 0)
		{
			$.ajax({
	    url: "/admin/stepManagement/unitLevelList?PRJ_IDX=" + $("#PRJ_IDX").val() + "&PUNIT_IDX=" + PUNIT_IDX,
	    type: "get",
	    dataType:'json',
	    //data: serializedData,
	    success: function(response, textStatus, jqXHR){
	       
	       	var chk_a = 0;
	       	var chk_b = 0;
	       	for (var a = 0 ; a < response.length ; a ++)
	       	{
	       		$("#UNIT_LEVEL2").append('<option value="' + response[a][0] + '|' + response[a][2] + '">' + response[a][1] + '</option>');
	       		if (response[a][0] == modifyValue)
	       		{
	       			chk_a = a + 1;
	       			chk_b = response[a][2];
	       		}
	       	}
	       	///setUnitLevel2($("#UNIT_LEVEL2 option:selected").val());
	       	if (modifyValue && Number(modifyValue) > 0 )
	       	{
	       		$("#UNIT_LEVEL2 option:eq(" + chk_a + ")").attr('selected','selected');
	       		setUnitLevel2();
	       	}
	    },
	    error: function(jqXHR, textStatus, errorThrown){
	        //console.log("The following error occured: "+textStatus, errorThrown);
	        
	    },
	    // callback handler that will be called on completion
	    // which means, either on success or error
	    complete: function(){
	    	  // enable the inputs
	    }
			});
		}		
		
	}
	
	function setUnitLevel2(selectedCode)
	{
		// select form clear
		var PUNIT_IDX = null;
		var UNIT_IDX = null;
		$("#UNIT_LEVEL3").empty().append('<option value="">�����ϼ���.</option>');	
		
		getUnitListData($("#UNIT_LEVEL2 option:selected").val());
		
		var tmp_PUNIT_IDX = $("#UNIT_LEVEL2 option:selected").val().split('|'); //�����ڵ�
		
		PUNIT_IDX = tmp_PUNIT_IDX[0];
		
		//������������ �ڵ尡 ������?
		var modifyValue = $("#CODELIST_3").val();
	
		if ($("#UNIT_LEVEL2 option:selected").val() != '' && Number(tmp_PUNIT_IDX[1]) > 0)
		{
			$.ajax({
	    url: "/admin/stepManagement/unitLevelList?PRJ_IDX=" + $("#PRJ_IDX").val() + "&PUNIT_IDX=" + PUNIT_IDX,
	    type: "get",
	    dataType:'json',
	    //data: serializedData,
	    success: function(response, textStatus, jqXHR){
					var chk_a = 0;
					var chk_b = 0;
	       	for (var a = 0 ; a < response.length ; a ++)
	       	{
	       		$("#UNIT_LEVEL3").append('<option value="' + response[a][0] + '|' + response[a][2] + '">' + response[a][1] + '</option>');
	       		if (response[a][0] == modifyValue)
	       		{
	       			chk_a = a + 1;
	       			chk_b = response[a][2];
	       		}
	       	}
	       	
	       	if (modifyValue && Number(modifyValue) > 0 )
	       	{
	       		$("#UNIT_LEVEL3 option:eq(" + chk_a + ")").attr('selected','selected');
	       		setUnitLevel3();
	       	}
	       
	    },
	    error: function(jqXHR, textStatus, errorThrown){
	        //console.log("The following error occured: "+textStatus, errorThrown);
	    },
	    // callback handler that will be called on completion
	    // which means, either on success or error
	    complete: function(){
	    	  // enable the inputs
	    }
			});
		}
	}
	
	function setUnitLevel3(selectedCode)
	{
		getUnitListData($("#UNIT_LEVEL3 option:selected").val());
	
	}
	
	//�������� ������ leaf ������Ȯ���� ���� ���� ���� �������� �κ�
	function getUnitListData(code)
	{
		clearFormSet();
		ableFormSet(true);
		var obj_ar = code.split('|');
		//�պκ� : �ڵ� 
		//�޺κ� : ���� ���� 
		if (obj_ar[1] == 0) //���� ������ �ϰ�츸 �����͸� ��������
		{
			ableFormSet(false);
			//alert(code);
			
			$("#UNIT_IDX").val(obj_ar[0]);
			
			$.ajax({
	    url: "/admin/stepManagement/unitAuthInfo?PRJ_IDX=" + $("#PRJ_IDX").val() + '&UNIT_IDX=' + $("#UNIT_IDX").val() + '&RSM_IDX=' + $("#RSM_IDX").val(),
	    type: "get",
	    dataType:'json',
	    //data: serializedData,
	    success: function(response, textStatus, jqXHR){
			
				if (response.length > 0)
				{
					
					$("#WRK_PLC_CNT").val(response[0]['WRK_PLC_CNT']);
					$("#APPLY_CNT").val(response[0]['APPLY_CNT']);
  				getAuthMemberList(obj_ar[0]);
  			}
  	
  			getWorkPlaceList(obj_ar[0]);
  			
	    },
	    error: function(jqXHR, textStatus, errorThrown){
	    
	        //console.log("The following error occured: "+textStatus, errorThrown);
	    },
	    // callback handler that will be called on completion
	    // which means, either on success or error
	    complete: function(){
	    	  // enable the inputs
	    }
			});
		}
		
	}
	
	function getAuthMemberList(UNIT_IDX)
	{
		
		$.ajax({
	    url: "/admin/stepManagement/managerAuthList?PRJ_IDX=" + $("#PRJ_IDX").val() + '&UNIT_IDX=' + UNIT_IDX,
	    type: "get",
	    dataType:'json',
	    //data: serializedData,
	    success: function(response, textStatus, jqXHR){
					
					clearManager();
					//�����о� ������ ����
					for (var a = 0; a < $("#UNIT_MANAGER_COUNT").val() ; a ++) // �������� - ���̵� ���� 
					{
						for (var aa = 0; aa < $("#MANAGER_LIST1_" + a + " option").length ; aa ++) // select box ��
						{
							for (var x = 0 ; x < response.length ; x ++)
							{
								if ($("#MANAGER_LIST1_" + a + " option:eq(" + aa + ")").val() == response[x]['MANAGER_ID'])
								{
									$("#MANAGER_LIST1_" + a).val(response[x]['MANAGER_ID']);
									if (response[x]['MANAGER_ID'] != '')
									{
										$("#HIDDEN_MANAGER_LIST1_" + a).val(response[x]['MANAGER_ID']);
										if (response[x]['APPLY_MNG'] == 'Y') $("#AUTH_APPLY_MNG1_" + a).prop('checked',true);
										if (response[x]['APPLY_VW'] == 'Y') $("#AUTH_APPLY_VW1_" + a).prop('checked',true);
										if (response[x]['MAIL_MNG'] == 'Y') $("#AUTH_MAIL1_" + a).prop('checked',true);
										if (response[x]['SMS_MNG'] == 'Y') $("#AUTH_SMS1_" + a).prop('checked',true);
									}
									
									response[x]['MANAGER_ID'] = '';
									//alert(response[x]['MANAGER_ID']);
									break;
								}
							}
							if ($("#MANAGER_LIST1_" + a +" option:selected").index() > 0) break;
						}
						
					}
					
			
					//�ɻ����� ������ ����
					for (var b = 0; b < $("#CHECK_MANAGER_COUNT").val() ; b ++)
					{
						for (var aa = 0; aa < $("#MANAGER_LIST2_" + b + " option").length ; aa ++) // select box ��
						{
							for (var x = 0 ; x < response.length ; x ++)
							{
								if ($("#MANAGER_LIST2_" + b + " option:eq(" + aa + ")").val() == response[x]['MANAGER_ID'])
								{
									
									$("#MANAGER_LIST2_" + b).val(response[x]['MANAGER_ID']);
									if (response[x]['MANAGER_ID'] != '')
									{
									
										$("#HIDDEN_MANAGER_LIST2_" + b).val(response[x]['MANAGER_ID']);
										if (response[x]['APPLY_MNG'] == 'Y') $("#AUTH_APPLY_MNG2_" + b).prop('checked',true);
										if (response[x]['APPLY_VW'] == 'Y') $("#AUTH_APPLY_VW2_" + b).prop('checked',true);
										if (response[x]['MAIL_MNG'] == 'Y') $("#AUTH_MAIL2_" + b).prop('checked',true);
										if (response[x]['SMS_MNG'] == 'Y') $("#AUTH_SMS2_" + b).prop('checked',true);
									}
									response[x]['MANAGER_ID'] = '';
									//alert(response[x]['MANAGER_ID']);
									break;
								}
							}
							if ($("#MANAGER_LIST2_" + b + " option:selected").index() > 0) break;
						}
					}
				
	    },
	    error: function(jqXHR, textStatus, errorThrown){
	        //console.log("The following error occured: "+textStatus, errorThrown);
	    },
	    // callback handler that will be called on completion
	    // which means, either on success or error
	    complete: function(){
	    	  // enable the inputs
	    }
			});
	}
	
	//����ٹ��� - 
	function getWorkPlaceList(UNIT_IDX)
	{
	
		$.ajax({
    url: "/admin/stepManagement/workPlaceList?PRJ_IDX=" + $("#PRJ_IDX").val() + '&UNIT_IDX=' + UNIT_IDX,
    type: "post",
    dataType:'json',
    //data: serializedData,
    success: function(response, textStatus, jqXHR){
				
				$("#WORK_PLACE_LIST").empty();
       	for (var a = 0 ; a < response.length ; a ++)
       	{		
       	
					var v = newItem.val(), opt = $('<option />', {
						value: response[a][0],
						text: response[a][2]
					});
				
				
					if(UNIT_IDX == response[a][1]){
						opt.attr('selected','selected');
					}
					
					opt.appendTo( el );	
					
       	}
       	el.multiselect('refresh');
       	setWorkPlaceAddMaxRule(el.multiselect('getChecked').length);
       	getApplyNoRequireList(UNIT_IDX);
       	
    },
    error: function(jqXHR, textStatus, errorThrown){
        //console.log("The following error occured: "+textStatus, errorThrown);
    },
    complete: function(){}
		});
	}
	
	//�����ȣ ü�踦 �������� �κ�
	function getApplyNoRequireList(UNIT_IDX)
	{
			$.ajax({
	    url: "/admin/stepManagement/applyNoSetList?PRJ_IDX=" + $("#PRJ_IDX").val() + '&UNIT_IDX=' + UNIT_IDX,
	    type: "post",
	    dataType:'json',
	    //data: serializedData,
	    success: function(response, textStatus, jqXHR){
					//alert(response[0]['APPL_TP']);
					//[{"APPL_PREFIX":"ZZZ","APPL_SUFFIX":"","APPL_TP":"U","APPL_LEN":7}]
					//alert('--->' + response + '<---');
					if (response != '')
					{
						$("#APPL_PREFIX").val(response[0]['APPL_PREFIX']);
						$("#APPL_SUFFIX").val(response[0]['APPL_SUFFIX']);
						$("#APPL_TP").val(response[0]['APPL_TP']);
						$("#APPL_LEN").val(response[0]['APPL_LEN']);
						
						/* ���� */
						$("#SEQ_NM").val(response[0]['SEQ_NM']);
						$("#CURRENT_SEQ").val(response[0]['SEQ_NO']);
						$("#SEQ_YN").val(response[0]['SEQ_YN']);
					}
	       	
	    },
	    error: function(jqXHR, textStatus, errorThrown){
	        //console.log("The following error occured: "+textStatus, errorThrown);
	    },
	    complete: function(){}
			});
	}
	
	//�������� ����� Ŭ���� 
	function clearManager()
	{
		for (var a = 0; a < $("#UNIT_MANAGER_COUNT").val() ; a ++)
		{
			
			$("#MANAGER_LIST1_" + a).val('');
			$("#HIDDEN_MANAGER_LIST1_" + a).val('');
			$("#AUTH_APPLY_MNG1_" + a).prop('checked',false);
			$("#AUTH_APPLY_VW1_" + a).prop('checked',false);
			$("#AUTH_MAIL1_" + a).prop('checked',false);
			$("#AUTH_SMS1_" + a).prop('checked',false);
		}
		
		for (var b = 0; b < $("#CHECK_MANAGER_COUNT").val() ; b ++)
		{
			$("#MANAGER_LIST2_" + b).val('');
			$("#HIDDEN_MANAGER_LIST2_" + b).val('');
			$("#AUTH_APPLY_MNG2_" + b).prop('checked',false);
			$("#AUTH_APPLY_VW2_" + b).prop('checked',false);
			$("#AUTH_MAIL2_" + b).prop('checked',false);
			$("#AUTH_SMS2_" + b).prop('checked',false);
		}
	}
	
	function clearFormSet()
	{
		$("#WORK_PLACE_LIST").empty();
		el.multiselect('refresh');
		
		$("#UNIT_IDX").val('');
		$("#APPLY_CNT").val('');
		$("#WRK_PLC_CNT").val('');
		
		$("#APPL_PREFIX").val('');
		$("#APPL_LEN").val('');
		$("#APPL_SUFFIX").val('');
		$("#APPL_TP").val('');
		$("#SEQ_RESET").prop('checked',false);
		$("#CURRENT_SEQ").val('');
		$("#SEQ_NM").val('');
		$("#SEQ_YN").val('');
		
		clearManager();
		
	}
	
	//��Ȱ�� Ȱ�� ó��
	function ableFormSet(flag)
	{
			$("#APPLY_CNT").prop('disabled',flag);
			$("#WRK_PLC_CNT").prop('disabled',flag);
			
			$("#APPL_PREFIX").prop('disabled',flag);
			$("#APPL_SUFFIX").prop('disabled',flag);
			$("#APPL_LEN").prop('disabled',flag);
			$("#APPL_TP").prop('disabled',flag);
			
			for (var a = 0; a < $("#UNIT_MANAGER_COUNT").val() ; a ++)
			{
				$("#MANAGER_LIST1_" + a).prop('disabled',flag);
				$("#AUTH_APPLY_MNG1_" + a).prop('disabled',flag);
				$("#AUTH_APPLY_VW1_" + a).prop('disabled',flag);
				$("#AUTH_MAIL1_" + a).prop('disabled',flag);
				$("#AUTH_SMS1_" + a).prop('disabled',flag);
			}
		
			for (var b = 0; b < $("#CHECK_MANAGER_COUNT").val() ; b ++)
			{
				$("#MANAGER_LIST2_" + b).prop('disabled',flag);
				$("#AUTH_APPLY_MNG2_" + b).prop('disabled',flag);
				$("#AUTH_APPLY_VW2_" + b).prop('disabled',flag);
				$("#AUTH_MAIL2_" + b).prop('disabled',flag);
				$("#AUTH_SMS2_" + b).prop('disabled',flag);
			}
	}
	
	
	//ó��
	function processUnitForm()
	{
		
		
		var pl_count = 0;
	
		if ($("#WORK_PLACE_LIST").multiselect("widget").find(':checkbox'))
		{
			pl_count = $("#WORK_PLACE_LIST").multiselect("widget").find(':checkbox').size();
		}
		//WORK_PLACE_LIST_FOR_DELETE
		var str = '';
		for (var z = 0;z < pl_count ; z ++ )
		{
			if ($("#WORK_PLACE_LIST").multiselect("widget").find(':checkbox:eq(' + z + ')').is(':checked') == false)
			{
				str = str + '|' + $("#WORK_PLACE_LIST").multiselect("widget").find(':checkbox:eq(' + z + ')').val();
				
			}
		}
		
		$("#WORK_PLACE_LIST_FOR_DELETE").val(str);
		
		var selAr = new Array();
		var x = 0;
		for (var a = 0; a < $("#UNIT_MANAGER_COUNT").val() ; a ++) // �������� - ���̵� ���� 
		{
			selAr[x] = $("#MANAGER_LIST1_" + a + " option:selected").val();
			x ++;
		}
		
		for (var a = 0; a < $("#CHECK_MANAGER_COUNT").val() ; a ++) // �������� - ���̵� ���� 
		{
			selAr[x] = $("#MANAGER_LIST2_" + a + " option:selected").val();
			x ++;
		}
		
		/*
		var msg = selAr.sort(function(a,b) {
			if (a == b) {
				 return 0;
			}
			return (a > b)?1:-1;
		});
		alert(msg);
		*/
		
		//�Ǵ��� �ָŸ�ȣ������ �׳� ä���ο� disable�� üũ
		
		if ($("#APPLY_CNT").prop("disabled") == true || $("#APPL_PREFIX").prop("disabled") == true || $("#APPL_LEN").prop("disabled") == true ) 
		{
			alert('���� �о߸� ���� �����ϼ���.');
		} 
		else
		{
			//alert($("UNIT_IDX").val());
			$("#form1").attr('target','');
			$("#form1").attr("action","/admin/stepManagement/unitAuthProcess");
			$("#form1").attr("method","post");
			$("#form1").submit();
			
		}
	}
	
	// ������ �����о� ����
	function unitModify(UNIT_IDX, code)
	{
		var tmpCodeAr = code.split('|');
		$("#UNIT_IDX").val(UNIT_IDX);
		$("#CODELIST").val(code);
		
		$("#CODELIST_1").val(tmpCodeAr[0]);
		$("#CODELIST_2").val(tmpCodeAr[1]);
		$("#CODELIST_3").val(tmpCodeAr[2]);
		
		setUnitLoad();
	}
	
	
	//�����ȣ �κ� ó��
	function onReset()
	{
		$("#NEW_CURRENT_SEQ").val('');
		$("#NEW_CURRENT_SEQ").prop("disabled",true);

		if ($("#SEQ_RESET").is(":checked") == true)
		{
			alert('üũ�Ͻø� �����ȣ �������� ���� �����˴ϴ�.');
			$("#NEW_CURRENT_SEQ").prop("disabled",false);
		}
	}
	
	// �ڰݿ�� �̵�
	function requireMangement(UNIT_IDX, code)
	{
		/// ��ϵ� �����о߰� ������ �ڰݿ�� �ȴ�!��!
		
		// �ڰݿ�� ��ư �۷��� ū�� �������� �˻�.
		var er_flag = '';
		if (UNIT_IDX == '' && code == '')
		{
			//CHECKED_BOX_
			var x = 1;
			while(x > 0)
			{
				if (!document.getElementById('CHECKED_BOX_' + x)) break;
				x++;
			}
			if (x == 1)
			{
				alert('�����о߸� ���� ����Ͽ� �ּ���');
				er_flag = 'err';
			}
			
		}
		
		if ( er_flag == '')
		{
			
			//setUnitLevel1
			$("#UNIT_LEVEL1").val('');
			setUnitLevel1('');
			
			goLink('','pop','width=950 height=500 resizable=yes scrollbars=yes status=yes');
			$("#UNIT_IDX").val(UNIT_IDX);
			$("#form1").attr('target','open_pops');
			$("#form1").attr("action","/admin/requireManagement");
			$("#form1").attr("method","post");
			$("#form1").submit();
		}
	}
	
	// ����ٹ����� ���߰�.
	function setWorkPlaceAddMaxRule(cnt)
	{
			//alert(cnt);
			$("#WRK_PLC_CNT").rules('remove');
			$("#WRK_PLC_CNT").rules('add' , {
				required:true,
				digits:true,
				min:0,
				max:cnt,
				messages:{
						required:"����ٹ��� �����׸���� �Է��ϼ���.",
						digits:"���ڸ� �Է°����մϴ�.",
						min:"�ּ� 0 �Դϴ�.",
						max:"����ٹ����� ������ �� �̻��� �Ұ����մϴ�."
				}
			});	
	}
	
	// �����о� ����
	function deleteUnitList()
	{
		$("#DEL_UNIT_LIST").val('');
		var x = 1;
		var valstr = '';
		while(x > 0)
		{
			if ($("#CHECKED_BOX_" + x).is(':checked'))
			{
				valstr = valstr + '|' + $("#CHECKED_VALUE_" + x).val();
			}
			if (!document.getElementById("CHECKED_BOX_" + x))
			{
				break;
			}
			x++;
		}
		if (valstr == '')
		{
			alert('������ �����о߸� �����ϼ���');
		}
		
		if (valstr != '')
		{
		
			$("#DEL_UNIT_LIST").val(valstr);
			
			$("#form2").attr("action","/admin/stepManagement/unitAuthProcessForDelete");
			$("#form2").attr("method","post");
			$("#form2").submit();
		}
	}
	
</script>

<form name="form1" id="form1">
<input type="hidden" id="WORK_PLACE_LIST_MAX" />
<input type="hidden" id="PRJ_IDX" name="PRJ_IDX" value="<?=$PRJ_IDX?>">
<input type="hidden" id="RSM_IDX" name="RSM_IDX" value="<?=$RSM_IDX?>">
<input type="hidden" id="CODELIST" name="CODELIST" />
<input type="hidden" id="CODELIST_1" name="CODELIST_1" />
<input type="hidden" id="CODELIST_2" name="CODELIST_2" />
<input type="hidden" id="CODELIST_3" name="CODELIST_3" />
<input type="hidden" id="UNIT_IDX" name="UNIT_IDX">
<input type="hidden" id="UNIT_MANAGER_COUNT" name="UNIT_MANAGER_COUNT" value="<?=$unit_manager_count?>" />
<input type="hidden" id="CHECK_MANAGER_COUNT" name="CHECK_MANAGER_COUNT" value="<?=$check_manager_count?>" />
<input type="hidden" id="WORK_PLACE_LIST_FOR_DELETE" name="WORK_PLACE_LIST_FOR_DELETE">
					<h2 class="H2blt">�����о� ��� �� ����</h2>
					<table class="BdView-Type01" summary="�����о� ��� �� ������ �� �� �ֽ��ϴ�.">
						<caption>�����о� ��� �� ����</caption>
						<colgroup>
							<col width="130px" />
							<col width="*" />
							<col width="130px" />
							<col width="*" />
						</colgroup>
						<tbody>
							<tr>
								<th scope="row">
									<label for="w01a">���� �о�</label>
								</th>
								<td colspan="3">
									<label for="w01a" class="labSty01">��з�</label>
									<? // $SELECTBOX_UNIT_LEVEL1?>
									<select name="UNIT_LEVEL1" id="UNIT_LEVEL1" onchange="setUnitLevel1(this.value);">
										 <option value="">�����ϼ���.</option>
									</select>
									<!--span class="btn04"><a href="javascript:">�߰� <span class="color bold">+</span></a></span-->
									
									<label for="w01b" class="labSty01 mgl30">�ߺз�</label>
									<select name="UNIT_LEVEL2" id="UNIT_LEVEL2" onchange="setUnitLevel2(this.value);">
										 <option value="">�����ϼ���.</option>
									</select>
									<!--span class="btn04"><a href="#">�߰� <span class="color bold">+</span></a></span-->

									<label for="w01c" class="labSty01 mgl30">�Һз�</label>
									<select name="UNIT_LEVEL3" id="UNIT_LEVEL3"  onchange="setUnitLevel3(this.value);">
										 <option value="">�����ϼ���.</option>
									</select>
									<span class="btn04"><a href="javascript:goLink('/admin/stepManagement/unitManager?project_id=<?=$PRJ_IDX?>','pop','width=600 height=253')">���� <span class="color bold">+</span></a></span>
								</td>
							</tr>
							<tr>
								<th scope="row">
									<label for="w02">ä���ο�</label>
								</th>
								<td>
									<input type="text" name="APPLY_CNT" id="APPLY_CNT" title="ä���ο� �Է�" style="width:80px;" /> ��
									<label class="error" for="APPLY_CNT" generated="true" style="display:none;color:red;">error message</label>	
								</td>
								<th scope="row" class="bdLine">
									<label for="w03a">����ٹ���</label>
								</th>
								<td>
									<select name="WORK_PLACE_LIST[]" id="WORK_PLACE_LIST" multiple="multiple">
								</select>
								���ü� : <input type="text" id="WRK_PLC_CNT" name="WRK_PLC_CNT" style="width:30px">
								<label class="error" for="WRK_PLC_CNT" generated="true" style="display:none;color:red;">error message</label>
								</td>
							</tr>
							<tr>
								<th scope="row">
									<label for="jua01">�����ȣ ü��</label>
								</th>
								<td colspan="3">
									
								���ڸ� <input type="text" name="APPL_PREFIX" id="APPL_PREFIX" maxlength="5" style="width:50px"> &nbsp;
								���� �ڸ��� <input type="text" name="APPL_LEN" id="APPL_LEN" style="width:20px" maxlength="2"> &nbsp;
								���ڸ� <input type="text" name="APPL_SUFFIX" id="APPL_SUFFIX" maxlength="5" style="width:50px"> &nbsp;
								
								<select name="APPL_TP" id="APPL_TP">
									<option value="">�����ȣ�������</option>
									<option value="P">���� ä����� ����</option>
									<option value="U">�����оߺ�</option>
								</select>
								�����ȣ����:<input type="checkbox" name="SEQ_RESET" id="SEQ_RESET" value="Y" onclick="javascript:onReset();" class="checkbox"> ���ʵ�Ͻ� �� üũ�Ұ�.
								<label class="error" for="APPLYNO_ERROR" generated="true" style="display:none;color:red;">error message</label>	
								
								<br>
								
								���� ����:<input type="text" name="CURRENT_SEQ" id="CURRENT_SEQ" style="width:50px;border:0px;" readonly  > &nbsp;
								��������:<input type="text" name="SEQ_NM" id="SEQ_NM" style="width:150px;border:0px;" readonly  > &nbsp;
								����������:<input type="text" name="SEQ_YN" id="SEQ_YN" style="width:30px;border:0px;" readonly  > &nbsp;
								
								
								<!--
								���� �ʱ�ȭ <input type="text" name="NEW_CURRENT_SEQ" id="NEW_CURRENT_SEQ" style="width:50px" disabled > &nbsp;
								<br/><label class="error" for="APPLYNO_MSG" generated="true" style="display:none;color:red;">error message</label>
								-->
								
								
							
								</td>
							 </tr>
							<tr>
								<th scope="row">
									<label for="rec01">�����оߴ����</label>
								</th>
								<td colspan="3">
								<?
								if ($unit_manager_count > 0)
								{
								?>
									<ul class="tbLi">
									<? for ($a = 0 ;$a < $unit_manager_count; $a ++ ) { ?>
										<li>
											<input type="hidden" name="HIDDEN_MANAGER_LIST1_<?=$a?>" id="HIDDEN_MANAGER_LIST1_<?=$a?>" />
											<?=${'SELECTBOX_MANAGER_LIST1_' . $a}?>
											<input id="AUTH_APPLY_MNG1_<?=$a?>" name="AUTH_APPLY_MNG1_<?=$a?>" class="checkbox" type="checkbox" value="Y" />
											<label for="rea02">������ ����</label>
											<input id="AUTH_APPLY_VW1_<?=$a?>" name="AUTH_APPLY_VW1_<?=$a?>" class="checkbox" type="checkbox" value="Y" />
											<label for="rea03">������ ����</label>
											<!--input id="rea04" name="rea04" class="checkbox" type="checkbox" />
											<label for="rea04">������ ��</label-->
											<input id="AUTH_MAIL1_<?=$a?>" name="AUTH_MAIL1_<?=$a?>" class="checkbox" type="checkbox" value="Y" />
											<label for="AUTH_MAIL">���� ����</label>
											<input id="AUTH_SMS1_<?=$a?>" name="AUTH_SMS1_<?=$a?>" class="checkbox" type="checkbox" value="Y" />
											<label for="AUTH_SMS">SMS ����</label>
										</li>
									<? } ?>
									</ul>
								<?
								}
								
								if ($unit_manager_count == 0)
								{
									echo '��ϵ� �����о� ����ڰ� �����ϴ�';
								}
								?>
								</td>
							</tr>
							<tr>
								<th scope="row">
									<label for="jua01">�ɻ�����</label>
								</th>
								<td colspan="3">
								<?
								if ($check_manager_count > 0)
								{
								?>
									<ul class="tbLi">
										<? for ($a = 0 ;$a < $check_manager_count; $a ++ ) { ?>
										<li>
											<input type="hidden" name="HIDDEN_MANAGER_LIST2_<?=$a?>" id="HIDDEN_MANAGER_LIST2_<?=$a?>" />
											<?=${'SELECTBOX_MANAGER_LIST2_' . $a}?>
											<input id="AUTH_APPLY_MNG2_<?=$a?>" name="AUTH_APPLY_MNG2_<?=$a?>" class="checkbox" type="checkbox" value="Y" />
											<label for="jua02">������ ����</label>
											<input id="AUTH_APPLY_VW2_<?=$a?>" name="AUTH_APPLY_VW2_<?=$a?>" class="checkbox" type="checkbox" value="Y" />
											<label for="jua03">������ ����</label>
											<!--input id="jua04" name="jua04" class="checkbox" type="checkbox" />
											<label for="jua04">������ ��</label-->
											<input id="AUTH_MAIL2_<?=$a?>" name="AUTH_MAIL2_<?=$a?>" class="checkbox" type="checkbox" value="Y" />
											<label for="jua05">���� ����</label>
											<input id="AUTH_SMS2_<?=$a?>" name="AUTH_SMS2_<?=$a?>" class="checkbox" type="checkbox" value="Y"/>
											<label for="jua06">SMS ����</label>
										</li>
										<? } ?>
									</ul>
								<?
								}
								
								if ($check_manager_count == 0) 
								{
									echo '��ϵ� �ɻ������� �����ϴ�.';
								}
								?>
								</td>
							</tr>
							
						</tbody>
					</table>
<input type="submit" id="REGIST_SUBMIT" style="display:none;">
					<div class="txtC mgb25">
						<span class="btn01"><a href="javascript:processUnitForm();">���� �� ���</a></span>
					</div>
</form>
					<h2 class="H2blt">�����о� ���</h2>
					<table id="BdList-Type01" class="mgb20" summary="�����о� ���">
						<caption>�����о� ���</caption>
						<colgroup>
							<col width="60px" />
						<col width="*" />
							<col width="100px" />
							<col width="*" />
							<col width="95px" />
							<col width="*" />
							<col width="*" />
							<col width="95px" />
							<col width="95px" />
						</colgroup>
						<thead>
							<tr>
								<th scope="col" class="first">����</th>
							
								<th scope="col">�����о�</th>
								<th scope="col">ä���ο�</th>
								<th scope="col">����ٹ���</th>
								<th scope="col">������</th>
								<th scope="col">�����о� �����</th>
								<th scope="col">�ɻ�����</th>
								<th scope="col">��������</th>
								<th scope="col">�ڰݿ�ǰ���</th>
							</tr>
						</thead>
						<tbody>
						<? foreach ($rdata as $key => $data) { ?>
							<tr>
								<td><input id="CHECKED_BOX_<?=($key+1)?>" name="CHECKED_BOX_<?=($key+1)?>" class="checkbox" type="checkbox" />
										<input type="hidden" id="CHECKED_VALUE_<?=($key+1)?>" name="CHECKED_VALUE_<?=($key+1)?>" value="<?=$data->CODELIST?>" />
								</td>
								<td><?=$data->PATH?></td>
								<td><?=number_format($data->APPLY_CNT)?></td>
								<td><?=$data->PLACE?></td>
								<td><?=$data->WRK_PLC_CNT?></td>
								<td><?=$data->MANAGER1?></td>
								<td><?=$data->MANAGER2?></td>
								<td><span class="btn04"><a href="javascript:unitModify('<?=$data->UNIT_IDX?>','<?=$data->CODELIST?>');">����</a></span></td>
								<td><span class="ico05"><a href="javascript:requireMangement('<?=$data->UNIT_IDX?>','<?=$data->CODELIST?>');"><span>����</span></a></span></td>
							</tr>
						<? } ?>
							
							<? if ($udataCount == 0) { ?>
							<tr>
								<td colspan="9" class="no-data">�����о߰� �����ϴ�.</td>
							</tr>
							<? } ?>
						</tbody>
					</table>
	<form name="form2" id="form2">
	<input type="hidden" id="P_PRJ_IDX" name="P_PRJ_IDX" value="<?=$PRJ_IDX?>">
	<input type="hidden" id="DEL_UNIT_LIST" name="DEL_UNIT_LIST" />
	</form>

					<div class="btn_box">
						<div class="lefBox">
							<span class="btn01"><a href="javascript:deleteUnitList();">�����о� ����</a></span>
						</div>
						<div class="rigBox">
							<span class="btn01"><a href="javascript:requireMangement('','');">�ڰݿ�� ����</a></span>
						</div>
					</div>