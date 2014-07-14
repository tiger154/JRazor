<script> 
	
	function bodyOnLoad()
	{
			setUnitTopLevel();
	}
	
	function registUnitAjax()
	{
		$.ajax({
    url: "/admin/stepManagement/unitLevelList?PRJ_IDX=" + $("#PRJ_IDX").val() + "&PUNIT_IDX=" + $("#UNIT_LEVEL1 option:selected").val(),
    type: "get",
    dataType:'json',
    //data: serializedData,
    success: function(response, textStatus, jqXHR){
       
       	for (var a = 0 ; a < response.length ; a ++)
       	{
       		$("#UNIT_LEVEL2").append('<option value="' + response[a][0] + '">' + response[a][1] + '</option>');
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
	
	function modifyUnit()
	{
		$("#form1").attr("action","/admin/stepManagement/unitModify");
		//$("#UNIT_NM").val($("#FORM_UNIT_NM").val());
		$("#form1").submit();
	}
	
	function registUnit()
	{
		//if ($("#P_TYPE").val())
		
		$("#form1").attr("action","/admin/stepManagement/unitRegist");
		$("#UNIT_NM").val($("#FORM_UNIT_NM").val());
		
		$("#form1").submit();
	}
	
	function cancelUnit()
	{
		$("#FORM_UNIT_NM").val("");
		$("#button_text").text("���");
		$("#UNIT_IDX").val('');
		$("#PUNIT_IDX").val('');
		$("#UNIT_NM").val('');
		$("#P_TYPE").val('regist');
	}
	
	function setUnitTopLevel()
	{
		init();
		$("#UNIT_LEVEL1").empty().append('<option value="">�����ϼ���.</option>');
		$("#UNIT_LEVEL2").empty().append('<option value="">�����ϼ���.</option>');
		$("#UNIT_LEVEL3").empty().append('<option value="">�����ϼ���.</option>');
		$.ajax({
    url: "/admin/stepManagement/unitLevelList?PRJ_IDX=" + $("#PRJ_IDX").val(),
    type: "get",
    dataType:'json',
    success: function(response, textStatus, jqXHR){
    		//alert(response.length);
       	for (var a = 0 ; a < response.length ; a ++)
       	{
       		$("#UNIT_LEVEL1").append('<option value="' + response[a][0] + '">' + response[a][1] + '</option>');
       	}
    },
    error: function(jqXHR, textStatus, errorThrown){},
    complete: function(){}
		});
	}
	
	function selUnitLevel1(obj)
	{
		init();
		$("#UNIT_LEVEL2").empty().append('<option value="">�����ϼ���.</option>');
		$("#UNIT_LEVEL3").empty().append('<option value="">�����ϼ���.</option>');
		$.ajax({
    url: "/admin/stepManagement/unitLevelList?PRJ_IDX=" + $("#PRJ_IDX").val() + "&PUNIT_IDX=" + $("#UNIT_LEVEL1 option:selected").val(),
    type: "get",
    dataType:'json',
    success: function(response, textStatus, jqXHR){
       	for (var a = 0 ; a < response.length ; a ++)
       	{
       		$("#UNIT_LEVEL2").append('<option value="' + response[a][0] + '">' + response[a][1] + '</option>');
       	}
    },
    error: function(jqXHR, textStatus, errorThrown){},
    complete: function(){}
		});
	}
	
	function setUnitLevel2(obj)
	{
		init();
		$("#UNIT_LEVEL3").empty().append('<option value="">�����ϼ���.</option>');
		
		$.ajax({
    url: "/admin/stepManagement/unitLevelList?PRJ_IDX=" + $("#PRJ_IDX").val() + "&PUNIT_IDX=" + $("#UNIT_LEVEL2 option:selected").val(),
    type: "get",
    dataType:'json',    
    success: function(response, textStatus, jqXHR){
       	for (var a = 0 ; a < response.length ; a ++)
       	{
       		$("#UNIT_LEVEL3").append('<option value="' + response[a][0] + '">' + response[a][1] + '</option>');
       	}
    },
    error: function(jqXHR, textStatus, errorThrown){},
    complete: function(){}
		});
	}
	
	function processUnit(lvl)
	{
		//��� or ���� 
		
		var p_type = '';
		if ($('#UNIT_LEVEL' + lvl + '_TYPE1:checked').is(':checked')) p_type = 'regist';
		if ($('#UNIT_LEVEL' + lvl + '_TYPE2:checked').is(':checked')) p_type = 'modify';
		if ($('#UNIT_LEVEL' + lvl + '_TYPE3:checked').is(':checked')) p_type = 'delete';
		
		$("#P_TYPE").val(p_type);
		$("#UNIT_NM").val($('#UNIT_LEVEL' + lvl + '_NM').val());
		$("#PUNIT_IDX").val('');
		
		if (lvl > 1) 
		{
			$("#PUNIT_IDX").val($('#UNIT_LEVEL' + (lvl-1) + ' option:selected').val());
		}
		
		if (p_type == 'regist') $("#form1").attr("action","/admin/stepManagement/unitRegist");
		if (p_type == 'modify') $("#form1").attr("action","/admin/stepManagement/unitModify");
		if (p_type == 'delete') $("#form1").attr("action","/admin/stepManagement/unitDelete");
		
		if ($("#UNIT_NM").val() == '' && p_type.match(/regist/))
		{
			alert('����� �з����� �Է��ϼ���');
		}
		else
		{
			$("#form1").submit();
		}
	}
	
	function init()
	{
		$('#UNIT_NM').val('');
		$('#UNIT_IDX').val('');
		for (var a = 1 ; a < 4 ; a ++ )
		{
			$("#UNIT_LEVEL" + a + "_TYPE1").prop('checked' , true);
			$("#UNIT_LEVEL" + a + "_NM").val('');
			$("#UNIT_LEVEL" + a + "_NM").attr("disabled" , false);
		}
	}
	
	function clearSet(lvl,code)
	{
		$('#UNIT_LEVEL' + lvl + '_NM').val('');
		$('#UNIT_IDX').val('');
		$("#UNIT_LEVEL" + lvl + "_NM").attr("disabled" , false);
		
		if ($('#UNIT_LEVEL' + lvl + ' option:selected').val() == '' && code == 'm')
		{
			alert('������ �з��� ���� �����ϼ���');
			$("#UNIT_LEVEL" + lvl + "_TYPE1").click();
		}
		
		if ($('#UNIT_LEVEL' + lvl + ' option:selected').val() != '' && code == 'm')
		{
			$('#UNIT_LEVEL' + lvl + '_NM').val($('#UNIT_LEVEL' + lvl + ' option:selected').text());
			$('#UNIT_IDX').val($('#UNIT_LEVEL' + lvl + ' option:selected').val());
		}
		
		if ($('#UNIT_LEVEL' + lvl + ' option:selected').val() == '' && code == 'd')
		{
			alert('������ �з��� ���� �����ϼ���');
		}
		
		if ($('#UNIT_LEVEL' + lvl + ' option:selected').val() != '' && code == 'd')
		{
			$("#UNIT_LEVEL" + lvl + "_NM").attr("disabled" , true);
			$('#UNIT_IDX').val($('#UNIT_LEVEL' + lvl + ' option:selected').val());
		}
		
	}
	
	function winClose()
	{
		opener.location.reload();
		window.close();
	}
	
</script>
<form name="form1" id="form1" method="post">
	<input type="hidden" name="PRJ_IDX" id="PRJ_IDX" value="<?=$PRJ_IDX?>" />
	<input type="hidden" name="P_TYPE" id="P_TYPE" value="regist" />
	<input type="hidden" name="UNIT_IDX" id="UNIT_IDX" />
	<input type="hidden" name="UNIT_NM" id="UNIT_NM" />
	<input type="hidden" name="PUNIT_IDX" id="PUNIT_IDX" />
</form>

<table class="BdView-Type01" summary="�Խù� ����, ��ȣ, �ۼ���, �����, ��ȸ��, ÷������ �� ������ �� �� �ֽ��ϴ�.">
<caption>�Խñ� �󼼺���</caption>
<colgroup>
	<col width="60px" />
	<col width="*" />
	<col width="320px" />

</colgroup>
<tbody>
<tr>
	<td>��з�</td>
	<td><?=$SELECTBOX_UNIT_LEVEL1?></td>
	<td><input type="radio" id="UNIT_LEVEL1_TYPE1" name="UNIT_LEVEL1_TYPE" value="regist" onclick="javascript:clearSet(1,'r');" checked  >���
			<input type="radio" id="UNIT_LEVEL1_TYPE2" name="UNIT_LEVEL1_TYPE" value="modify" onclick="javascript:clearSet(1,'m');">����
			<input type="radio" id="UNIT_LEVEL1_TYPE3" name="UNIT_LEVEL1_TYPE" value="delete" onclick="javascript:clearSet(1,'d');">����
			<input type="text" id="UNIT_LEVEL1_NM" style="width:100px">
			<a href="javascript:processUnit(1);"><span class="ico06"><span>Ȯ��</span></span></a>
			</td>
</tr>
<tr>
	<td>�ߺз�</td>
	<td><select name="UNIT_LEVEL2" id="UNIT_LEVEL2" onchange="setUnitLevel2(this);">
	 			<option value="">�����ϼ���.</option>
			</select></td>
	<td><input type="radio" id="UNIT_LEVEL2_TYPE1" name="UNIT_LEVEL2_TYPE" value="regist" onclick="javascript:clearSet(2,'r');" checked>���
			<input type="radio" id="UNIT_LEVEL2_TYPE2" name="UNIT_LEVEL2_TYPE" value="modify" onclick="javascript:clearSet(2,'m');">����
			<input type="radio" id="UNIT_LEVEL2_TYPE3" name="UNIT_LEVEL2_TYPE" value="delete" onclick="javascript:clearSet(2,'d');">����
			<input type="text" id="UNIT_LEVEL2_NM" style="width:100px">
			<a href="javascript:processUnit(2);"><span class="ico06"><span>Ȯ��</span></span></a>
			</td>
	
</tr>
<tr>
	<td>�Һз�</td>
	<td><select name="UNIT_LEVEL3" id="UNIT_LEVEL3" >
			 <option value="">�����ϼ���.</option>
		</select></td>
	<td><input type="radio" id="UNIT_LEVEL3_TYPE1" name="UNIT_LEVEL3_TYPE" value="regist" onclick="javascript:clearSet(3,'r');" checked>���
			<input type="radio" id="UNIT_LEVEL3_TYPE2" name="UNIT_LEVEL3_TYPE" value="modify" onclick="javascript:clearSet(3,'m');">����
			<input type="radio" id="UNIT_LEVEL3_TYPE3" name="UNIT_LEVEL3_TYPE" value="delete" onclick="javascript:clearSet(3,'d');">����
			<input type="text" id="UNIT_LEVEL3_NM" style="width:100px">
			<a href="javascript:processUnit(3);"><span class="ico06"><span>Ȯ��</span></span></a>
			</td>
</tr>
</tbody>
</table>

<div class="txtC">
	<span class="btn01"><a href="javascript:winClose();">�ݱ�</a></span>
</div>