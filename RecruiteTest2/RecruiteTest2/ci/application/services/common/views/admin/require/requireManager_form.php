<script language="javascript" src="/assets/js/jquery.validate.js"></script>
<script language="javascript" src="/assets/js/jquery-ui.js"></script>
<script language="javascript" src="/assets/js/dropdown/jquery.multiselect.filter.min.js"></script>
<script language="javascript" src="/assets/js/dropdown/jquery.multiselect.min.js"></script>
<link rel="stylesheet" type="text/css" href="/assets/css/jquery.multiselect.css" />
<link rel="stylesheet" type="text/css" href="/assets/css/jquery.multiselect.filter.css" />
<link rel="stylesheet" type="text/css" href="/assets/css/jqueryui.css" />
<script>
	var el = null;
	
	function bodyOnLoad()
	{
		$("#form1").validate({  
				groups:{
					
						PERSONAL_NAI:"PSNR_NAI_STDT1 PSNR_NAI_STDT2 PSNR_NAI_STDT3 PSNR_NAI_EDDT1 PSNR_NAI_EDDT2 PSNR_NAI_EDDT3",
						SCHOOL_DT:"SCHL_STDT1 SCHL_STDT2 SCT_CD",
						SCHOOL_SCORE:"SCHL_SCORE",
						ARMY_GRP:"ARMY_STDT1 ARMY_STDT2 ARMY_STDT3"
				},
		    rules: {
		    	UNIT_IDX:{required:true},
		    	PSNR_NAI_STDT1:{digits:true,min:1900,max:2020,required:function(element){ if ( $("#PSNR_NAI_STDT1").val() != '' || $("#PSNR_NAI_STDT2").val() != '' || $("#PSNR_NAI_STDT3").val() != '' ) return true; else return false; }},
		    	PSNR_NAI_STDT2:{digits:true,min:1,max:12,required:function(element){ if ( $("#PSNR_NAI_STDT1").val() != '' || $("#PSNR_NAI_STDT2").val() != '' || $("#PSNR_NAI_STDT3").val() != '' ) return true; else return false; }},
		    	PSNR_NAI_STDT3:{digits:true,min:1,max:31,required:function(element){ if ( $("#PSNR_NAI_STDT1").val() != '' || $("#PSNR_NAI_STDT2").val() != '' || $("#PSNR_NAI_STDT3").val() != '' ) return true; else return false; }},
		    	PSNR_NAI_EDDT1:{digits:true,min:1900,max:2020,required:function(element){ if ( $("#PSNR_NAI_EDDT1").val() != '' || $("#PSNR_NAI_EDDT2").val() != '' || $("#PSNR_NAI_EDDT3").val() != '' ) return true; else return false; }},
		    	PSNR_NAI_EDDT2:{digits:true,min:1,max:12,required:function(element){ if ( $("#PSNR_NAI_EDDT1").val() != '' || $("#PSNR_NAI_EDDT2").val() != '' || $("#PSNR_NAI_EDDT3").val() != '' ) return true; else return false; }},
		    	PSNR_NAI_EDDT3:{digits:true,min:1,max:31,required:function(element){ if ( $("#PSNR_NAI_EDDT1").val() != '' || $("#PSNR_NAI_EDDT2").val() != '' || $("#PSNR_NAI_EDDT3").val() != '' ) return true; else return false; }},
		    	SCHL_STDT1:{digits:true,min:1900,max:2020,required:function(element){ if ( $("#SCHL_STDT1").val() != '' || $("#SCHL_STDT2").val() != '' ) return true; else return false; }},
		    	SCHL_STDT2:{digits:true,min:1,max:12,required:function(element){ if ( $("#SCHL_STDT1").val() != '' || $("#SCHL_STDT2").val() != ''  ) return true; else return false; }},
		    	SCHL_SCORE:{digitsforfloat:true,max:4.5},
		    	ARMY_STDT1:{digits:true,min:1900,max:2020,required:function(element){ if ( $("#ARMY_STDT1").val() != '' || $("#ARMY_STDT2").val() != '' || $("#ARMY_STDT3").val() != '' ) return true; else return false; }},
		    	ARMY_STDT2:{digits:true,min:1,max:12,required:function(element){ if ( $("#ARMY_STDT1").val() != '' || $("#ARMY_STDT2").val() != '' || $("#ARMY_STDT3").val() != '' ) return true; else return false; }},
		    	ARMY_STDT3:{digits:true,min:1,max:31,required:function(element){ if ( $("#ARMY_STDT1").val() != '' || $("#ARMY_STDT2").val() != '' || $("#ARMY_STDT3").val() != '' ) return true; else return false; }}
		    },  
		    onkeyup:false,
		    messages: {
		    	UNIT_IDX:{required:"�����о߸� �����ϼ���"},
		    	PSNR_NAI_STDT1:{digits:"���ڸ��Է��ϼ���",min:"�⵵�� Ȯ���ϼ���",max:"�⵵�� Ȯ���ϼ���",required:"���ؿ��� ���� �Ⱓ�� Ȯ���ϼ���."},
		    	PSNR_NAI_STDT2:{digits:"���ڸ��Է��ϼ���",min:"���� Ȯ���ϼ���",max:"���� Ȯ���ϼ���",required:"���ؿ��� ���� �Ⱓ�� Ȯ���ϼ���."},
		    	PSNR_NAI_STDT3:{digits:"���ڸ��Է��ϼ���",min:"���� Ȯ���ϼ���",max:"���� Ȯ���ϼ���",required:"���ؿ��� ���� �Ⱓ�� Ȯ���ϼ���."}, 
		    	PSNR_NAI_EDDT1:{digits:"���ڸ��Է��ϼ���",min:"�⵵�� Ȯ���ϼ���",max:"�⵵�� Ȯ���ϼ���",required:"���ؿ��� ���� �Ⱓ�� Ȯ���ϼ���."},
		    	PSNR_NAI_EDDT2:{digits:"���ڸ��Է��ϼ���",min:"���� Ȯ���ϼ���",max:"���� Ȯ���ϼ���",required:"���ؿ��� ���� �Ⱓ�� Ȯ���ϼ���."}, 
		    	PSNR_NAI_EDDT3:{digits:"���ڸ��Է��ϼ���",min:"���� Ȯ���ϼ���",max:"���� Ȯ���ϼ���",required:"���ؿ��� ���� �Ⱓ�� Ȯ���ϼ���."},
		    	SCHL_STDT1:{digits:"���ڸ��Է��ϼ���",min:"�⵵�� Ȯ���ϼ���",max:"�⵵�� Ȯ���ϼ���",required:"�����з� �Ⱓ�� Ȯ���ϼ���."},
		    	SCHL_STDT2:{digits:"���ڸ��Է��ϼ���",min:"���� Ȯ���ϼ���",max:"���� Ȯ���ϼ���",required:"�����з� �Ⱓ�� Ȯ���ϼ���."},
		    	SCHL_SCORE:{digitsforfloat:"�Ҽ��� ��°�ڸ����� �Է��ϼ���. ��)3.45",max:"4.5���� ���������� �Է��Ҽ������ϴ�."},
		    	ARMY_STDT1:{digits:"���ڸ��Է��ϼ���",min:"�⵵�� Ȯ���ϼ���",max:"�⵵�� Ȯ���ϼ���",required:"���� �Ⱓ�� Ȯ���ϼ���."},
		    	ARMY_STDT2:{digits:"���ڸ��Է��ϼ���",min:"���� Ȯ���ϼ���",max:"���� Ȯ���ϼ���",required:"���� �Ⱓ�� Ȯ���ϼ���."},
		    	ARMY_STDT3:{digits:"���ڸ��Է��ϼ���",min:"���� Ȯ���ϼ���",max:"���� Ȯ���ϼ���",required:"���� �Ⱓ�� Ȯ���ϼ���."}
		    },
		    submitHandler: function(form) {  
				
	    	form.submit();
	    	
	    	}
   	});  
   	
   	// ������κ� ��ȿ���˻�
   	bodyOnLoadLanguage();	
   	
   	el = $("#SELECTED_UNIT_LIST").multiselect();
		//selected = $('#selected'),
		//newItem = $('#newItem');
   	
   	//alert(isDate('2010-05-01'));
   	//alert(isDate('2010-13-01'));
   	multiUnitList();
	}
	
	function bodyOnLoadLanguage()
	{
		<?
		// validate �� ����~ for���� x������ ;;;;;;; �ʹ����ν��ؼ� �۵��� ���Ѵ�. �ù�.
		if ($rsmDataUseYn[0]->LANGUAGE_USE_YN == 'Y') {
		foreach ($rsmDataLanguage as $key => $lanList)
		{
		?>
			
			$("#LAN_STDT1_<?=($key+1)?>").rules('add' , {digits:true,min:1900,max:2020,
																					required:function(element){ if ( $("#LAN_STDT1_<?=($key+1)?>").val() != '' || $("#LAN_STDT2_<?=($key+1)?>").val() != '' || $("#LAN_STDT3_<?=($key+1)?>").val() != '' ) return true; else return false; },
																					messages:{digits:"���ڸ� �Է°����մϴ�.",min:"�⵵�� Ȯ���ϼ���.",max:"�⵵�� Ȯ���ϼ���.",required:"����� ���۱Ⱓ�� Ȯ���ϼ���."}});	
			$("#LAN_STDT2_<?=($key+1)?>").rules('add' , {digits:true,min:1,max:12,
																					required:function(element){ if ( $("#LAN_STDT1_<?=($key+1)?>").val() != '' || $("#LAN_STDT2_<?=($key+1)?>").val() != '' || $("#LAN_STDT3_<?=($key+1)?>").val() != '' ) return true; else return false; },
																					messages:{digits:"���ڸ� �Է°����մϴ�.",min:"���� Ȯ���ϼ���.",max:"���� Ȯ���ϼ���.",required:"����� ���۱Ⱓ�� Ȯ���ϼ���."}});	
			$("#LAN_STDT3_<?=($key+1)?>").rules('add' , {digits:true,min:1,max:31,
																					required:function(element){ if ( $("#LAN_STDT1_<?=($key+1)?>").val() != '' || $("#LAN_STDT2_<?=($key+1)?>").val() != '' || $("#LAN_STDT3_<?=($key+1)?>").val() != '' ) return true; else return false; },
																					messages:{digits:"���ڸ� �Է°����մϴ�.",min:"���� Ȯ���ϼ���.",max:"���� Ȯ���ϼ���.",required:"����� ���۱Ⱓ�� Ȯ���ϼ���."}});	
			
			$("#LAN_EDDT1_<?=($key+1)?>").rules('add' , {digits:true,min:1900,max:2020,
																					required:function(element){ if ( $("#LAN_EDDT1_<?=($key+1)?>").val() != '' || $("#LAN_EDDT2_<?=($key+1)?>").val() != '' || $("#LAN_EDDT3_<?=($key+1)?>").val() != '' ) return true; else return false; },
																					messages:{digits:"���ڸ� �Է°����մϴ�.",min:"�⵵�� Ȯ���ϼ���.",max:"�⵵�� Ȯ���ϼ���.",required:"����� ����Ⱓ�� Ȯ���ϼ���."}});	
			$("#LAN_EDDT2_<?=($key+1)?>").rules('add' , {digits:true,min:1,max:12,
																					required:function(element){ if ( $("#LAN_EDDT1_<?=($key+1)?>").val() != '' || $("#LAN_EDDT2_<?=($key+1)?>").val() != '' || $("#LAN_EDDT3_<?=($key+1)?>").val() != '' ) return true; else return false; },
																					messages:{digits:"���ڸ� �Է°����մϴ�.",min:"���� Ȯ���ϼ���.",max:"���� Ȯ���ϼ���.",required:"����� ����Ⱓ�� Ȯ���ϼ���."}});	
			$("#LAN_EDDT3_<?=($key+1)?>").rules('add' , {digits:true,min:1,max:31,
																					required:function(element){ if ( $("#LAN_EDDT1_<?=($key+1)?>").val() != '' || $("#LAN_EDDT2_<?=($key+1)?>").val() != '' || $("#LAN_EDDT3_<?=($key+1)?>").val() != '' ) return true; else return false; },
																					messages:{digits:"���ڸ� �Է°����մϴ�.",min:"���� Ȯ���ϼ���.",max:"���� Ȯ���ϼ���.",required:"����� ����Ⱓ�� Ȯ���ϼ���."}});	

			//�����Է��׸��� ������			
			if (document.getElementById("SCORE_TP_<?=($key+1)?>"))
			{
				$("#SCORE_TP_<?=($key+1)?>").rules('add' , {digits:true,min:1,messages:{digits:"���ڸ� �Է°����մϴ�.",min:"������ Ȯ���ϼ���."}});	
				$("#form1").validate().groups["SCORE_TP_<?=($key+1)?>"] = 'LAN_GRP_MSG_<?=($key+1)?>';
			}
			
			$("#form1").validate().groups["LAN_STDT1_<?=($key+1)?>"] = 'LAN_GRP_MSG_<?=($key+1)?>';
			$("#form1").validate().groups["LAN_STDT2_<?=($key+1)?>"] = 'LAN_GRP_MSG_<?=($key+1)?>';
			$("#form1").validate().groups["LAN_STDT3_<?=($key+1)?>"] = 'LAN_GRP_MSG_<?=($key+1)?>';
			
			$("#form1").validate().groups["LAN_EDDT1_<?=($key+1)?>"] = 'LAN_GRP_MSG_<?=($key+1)?>';
			$("#form1").validate().groups["LAN_EDDT2_<?=($key+1)?>"] = 'LAN_GRP_MSG_<?=($key+1)?>';
			$("#form1").validate().groups["LAN_EDDT3_<?=($key+1)?>"] = 'LAN_GRP_MSG_<?=($key+1)?>';
		
			//x++;
		<?
		}
		}
		?>
			
	}
	
	function checkDateSet(code)
	{
		//��糯¥�� �Է��ϰ� �Ǹ� 
		if ( $("#" + code + "1").val() != '' && $("#" + code + "2").val() != '' && $("#" + code + "3").val() != '' )
		{
			
			if (!isDate($("#" + code + "1").val() + '-' + $("#" + code + "2").val() + '-' + $("#" + code + "3").val()))
			{
				
				alert('��¥ ������ ���� �ʽ��ϴ�.');
				$("#" + code + "1").val('');
				$("#" + code + "2").val('');
				$("#" + code + "3").val('');
				$("#" + code + "1").val('').focus();
				
			}
			
		}
	}
	
	function checkDateLanSet(code,seq)
	{
		//��糯¥�� �Է��ϰ� �Ǹ� 
		if ( $("#" + code + "1" + '_' + seq).val() != '' && $("#" + code + "2" + '_' + seq).val() != '' && $("#" + code + "3" + '_' + seq).val() != '' )
		{
			
			if (!isDate($("#" + code + "1" + '_' + seq).val() + '-' + $("#" + code + "2" + '_' + seq).val() + '-' + $("#" + code + "3" + '_' + seq).val()))
			{
				
				alert('��¥ ������ ���� �ʽ��ϴ�.');
				$("#" + code + "1" + '_' + seq).val('');
				$("#" + code + "2" + '_' + seq).val('');
				$("#" + code + "3" + '_' + seq).val('');
				$("#" + code + "1" + '_' + seq).val('').focus();
				
			}
			
		}
	}
	
	function goProcess()
	{
		$("#form1").attr("action","/admin/requireManagement/requireProcess");
		$("#form1").attr("method","post");
		$("#SUBMIT_BUTTON").click();
	}
	
	function selectUnitList(obj)
	{
		$("#form1").attr("action","/admin/requireManagement");
		$("#form1").attr("method","post");
		$("#form1").submit();
	}
	
	//�ش� �ڰݿ�ǰ� ������ �����о߰��õ����͸� ���� ��Ƽ������ üũ���ִ�.
	//
	function multiUnitList()
	{
			var selvalue = $("#SAME_UNIT_LIST").val();
			var selvalueAr = selvalue.split('|');
			
			$("#SELECTED_UNIT_LIST").val(selvalueAr);
			$("#SELECTED_UNIT_LIST").multiselect('refresh');
	}
	
</script>

<form id="form1" name="form1" >
	<div class="btn_box">
						<div class="lefBox">
						���� �����о� : <?=$SELECTBOX_UNIT_IDX?>
						<label class="error" for="UNIT_IDX" generated="true" style="display:none;color:red;">error message</label>
						</div>
						<div class="rigBox">
						���� �ڰݿ�ǰ� ������ �����о� : <?=$SELECTBOX_SELECTED_UNIT_LIST?>
						</div>
					</div>

<input type="hidden" name="PRJ_IDX" id="PRJ_IDX" value="<?=$PRJ_IDX?>" />
<input type="hidden" name="RSM_IDX" id="RSM_IDX" value="<?=$RSM_IDX?>" />

<input type="hidden" name="SAME_UNIT_LIST" id="SAME_UNIT_LIST" value="<?=$SAME_UNIT_LIST?>" />

<table class="BdView-Type01" summary="�ڰݿ�� ����">
<caption>�ڰݿ�� ����</caption>
<colgroup>
<col width="110px" />
<col width="*" />

</colgroup>
					<thead>
					<tr>
						<th class="first">����</th>
						<th>�ڰݿ��</th>
					</tr>
					</thead>
				<tbody>

<? 
/* �⺻ �Ż������� �̿��Ҷ� ������ �κ� */
if ($rsmDataUseYn[0]->PERSONAL_USE_YN == 'Y' ) { 
?>					
					<tr>
						<th scope="row">
							<label for="w03a">���ؿ���</label>
						</th>
						<td>
							<input type="text" name="PSNR_NAI_STDT1" id="PSNR_NAI_STDT1" maxlength="4" style="width:30px;" value="<?=$PSNR_NAI_STDT1?>" onblur="javascript:checkDateSet('PSNR_NAI_STDT');" /> �� 
							<input type="text" name="PSNR_NAI_STDT2" id="PSNR_NAI_STDT2" maxlength="2" style="width:20px;" value="<?=$PSNR_NAI_STDT2?>" onblur="javascript:setNum2str(this)&checkDateSet('PSNR_NAI_STDT');" /> �� 
							<input type="text" name="PSNR_NAI_STDT3" id="PSNR_NAI_STDT3" maxlength="2" style="width:20px;" value="<?=$PSNR_NAI_STDT3?>" onblur="javascript:setNum2str(this)&checkDateSet('PSNR_NAI_STDT');" /> �� 
							<strong>����</strong>
							~ 
							<input type="text" name="PSNR_NAI_EDDT1" id="PSNR_NAI_EDDT1" maxlength="4" style="width:30px;" value="<?=$PSNR_NAI_EDDT1?>" onblur="javascript:checkDateSet('PSNR_NAI_EDDT');" /> �� 
							<input type="text" name="PSNR_NAI_EDDT2" id="PSNR_NAI_EDDT2" maxlength="2" style="width:20px;" value="<?=$PSNR_NAI_EDDT2?>" onblur="javascript:setNum2str(this)&checkDateSet('PSNR_NAI_EDDT');" /> �� 
							<input type="text" name="PSNR_NAI_EDDT3" id="PSNR_NAI_EDDT3" maxlength="2" style="width:20px;" value="<?=$PSNR_NAI_EDDT3?>" onblur="javascript:setNum2str(this)&checkDateSet('PSNR_NAI_EDDT');" /> �� 
							<strong>����</strong>
							
							�����
							<label class="error" for="PERSONAL_NAI" generated="true" style="display:none;color:red;">error message</label>	
						</td>
						
					</tr>
<? } ?>						

<? 
/* �з»����� ����Ұ�� ������ �κ� */
if ($rsmDataUseYn[0]->SCHOOL_USE_YN == 'Y' ) { 
?>
		<tr>
			<th scope="row">
			<label for="w01a">�����з�</label>
			</th>
			<td>
			<input type="text" name="SCHL_STDT1" id="SCHL_STDT1" value="<?=$SCHL_STDT1?>" maxlength="4" style="width:30px;" /> ��
			<input type="text" name="SCHL_STDT2" id="SCHL_STDT2" value="<?=$SCHL_STDT2?>" maxlength="2" style="width:20px;" onblur="javascript:setNum2str(this);" /> �� ���� <span class="orange F11 mgr10">(�ش������)</span>
			<?=$SELECTBOX_SCT_CD?>
			����(����) �̻� <span class="F11">(�з��Ǵ��� ������ �ǹǷ� �ݵ�� �Է�)</span>
			<label class="error" for="SCHOOL_DT" generated="true" style="display:none;color:red;">error message</label>
			</td>
		</tr>
		
		<tr>
			<th scope="row">
			<label for="w02a">��������</label>
			</th>
			<td>
			<?=$SELECTBOX_SCHL_SCORE_TP?>
			(��)��
			<input type="text" name="SCHL_SCORE" id="SCHL_SCORE" title="���� �Է�" value="<?=$SCHL_SCORE?>" style="width:30px;" />
			/4.5 (���ظ���) �̻�
			<label class="error" for="SCHOOL_SCORE" generated="true" style="display:none;color:red;">error message</label>
			</td>
		
		</tr>
		
<? } ?>						

<? 
/* �����׸��� ����Ұ�� ������ �κ� */
if ($rsmDataUseYn[0]->ARMY_USE_YN == 'Y' ) { 
?>
			
				
					<tr>
						<th scope="row">
							<label for="w06a">���غ���</label>
						</th>
						<td>
							������ ����, 
							<input type="text" name="ARMY_STDT1" id="ARMY_STDT1" maxlength="4" style="width:30px;" value="<?=$ARMY_STDT1?>"  onblur="javascript:checkDateSet('ARMY_STDT');" /> �� 
							<input type="text" name="ARMY_STDT2" id="ARMY_STDT2" maxlength="2" style="width:20px;" value="<?=$ARMY_STDT2?>"  onblur="javascript:setNum2str(this)&checkDateSet('ARMY_STDT');" /> �� 
							<input type="text" name="ARMY_STDT3" id="ARMY_STDT3" maxlength="2" style="width:20px;" value="<?=$ARMY_STDT3?>"  onblur="javascript:setNum2str(this)&checkDateSet('ARMY_STDT');" /> �� 
							���� �����ڴ� �ڰݹ̴� <span class="orange F11">(�ش����� ����)</span>
							<label class="error" for="ARMY_GRP" generated="true" style="display:none;color:red;">error message</label>
						</td>
						
					</tr>
<?
}
?>
				</tbody>
			</table>

<? 
/* ������ ����Ұ�� ������ �κ� */
if ($rsmDataUseYn[0]->LANGUAGE_USE_YN == 'Y' ) { 
?>
			<input type="hidden" id="LANGUAGE_LIST_COUNT" name="LANGUAGE_LIST_COUNT" value="<?=count($rsmDataLanguage)?>" />
			<table class="BdView-Type01" summary="�ڰݿ�� ����">
				<caption>�ڰݿ�� ����</caption>
				<colgroup>
					<col width="60px" />
					<col width="120px" />
					<col width="160px" />
					<col width="*" />
					
				</colgroup>
				<thead>
					<tr>
						<th class="first">����</th>
						<th>�����</th>
						<th>����</th>
						<th>����� (�ش����� ����) ���� ����</th>
						
					</tr>
				</thead>
				<tbody>
				<?
					foreach ($rsmDataLanguage as $key => $lanList)
					{
				?>
					<tr>
						<th scope="row"><label for="s01a"><?=$lanList->LANG_TP_NM?></label></th>
						<td><span class="bold"><?=$lanList->LAN_NM?></span></td>
						<td><?=${'SELECTBOX_LAN_LVL_IDX_' . ($key + 1)}?>
								<? if (preg_match('/^13|15$/' , $lanList->SCORE_TP)) { ?>
								<input type="text" size="5" id="SCORE_TP_<?=($key+1)?>" name="SCORE_TP_<?=($key+1)?>" value="<?=${'SCORE_TP_' . ($key+1)}?>"  />
								<? } ?>�̻�
						<td>
							<input type="hidden" name="LAN_IDX_<?=($key+1)?>" id="LAN_IDX_<?=($key+1)?>" value="<?=$lanList->LAN_IDX?>" />
							<input type="text" name="LAN_STDT1_<?=($key+1)?>" id="LAN_STDT1_<?=($key+1)?>" value="<?=${'LAN_STDT1_' . ($key+1)}?>" maxlength="4" style="width:30px;" onblur="javascript:checkDateLanSet('LAN_STDT','<?=($key+1)?>');" /> �� 
							<input type="text" name="LAN_STDT2_<?=($key+1)?>" id="LAN_STDT2_<?=($key+1)?>" value="<?=${'LAN_STDT2_' . ($key+1)}?>" maxlength="2" style="width:20px;" onblur="javascript:setNum2str(this)&checkDateLanSet('LAN_STDT','<?=($key+1)?>');" /> �� 
							<input type="text" name="LAN_STDT3_<?=($key+1)?>" id="LAN_STDT3_<?=($key+1)?>" value="<?=${'LAN_STDT3_' . ($key+1)}?>" maxlength="2" style="width:20px;" onblur="javascript:setNum2str(this)&checkDateLanSet('LAN_STDT','<?=($key+1)?>');" /> �� <strong>����</strong> ~ 
							<input type="text" name="LAN_EDDT1_<?=($key+1)?>" id="LAN_EDDT1_<?=($key+1)?>" value="<?=${'LAN_EDDT1_' . ($key+1)}?>" maxlength="4" style="width:30px;" onblur="javascript:checkDateLanSet('LAN_EDDT','<?=($key+1)?>');" /> �� 
							<input type="text" name="LAN_EDDT2_<?=($key+1)?>" id="LAN_EDDT2_<?=($key+1)?>" value="<?=${'LAN_EDDT2_' . ($key+1)}?>" maxlength="2" style="width:20px;" onblur="javascript:setNum2str(this)&checkDateLanSet('LAN_EDDT','<?=($key+1)?>');" /> �� 
							<input type="text" name="LAN_EDDT3_<?=($key+1)?>" id="LAN_EDDT3_<?=($key+1)?>" value="<?=${'LAN_EDDT3_' . ($key+1)}?>" maxlength="2" style="width:20px;" onblur="javascript:setNum2str(this)&checkDateLanSet('LAN_EDDT','<?=($key+1)?>');" /> �� <strong>����</strong>
							<label class="error" for="LAN_GRP_MSG_<?=($key+1)?>" generated="true" style="display:none;color:red;">error message</label>
						</td>

					</tr>
				<?
					}
				?>
				</tbody>
			</table>
<?
}
?>
			<div class="txtC">
				<span class="btn01"><a href="javascript:goProcess();">Ȯ��</a></span>
				<span class="btn02"><a href="javascript:window.close();">�ݱ�</a></span>
			</div>
<input type="submit" id="SUBMIT_BUTTON" style="display:none"/>
</form>