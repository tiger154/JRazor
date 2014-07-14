<!-- S: �˻� -->
<link rel="stylesheet" type="text/css" href="/assets/css/jqueryui.css" />
<script type="text/javascript" src="/assets/js/jquery-ui.js" charset="utf-8"></script>
<script>
	
	function bodyOnLoad()
	{
		for (var a = 0 ; a < <?=$stepCount?> ; a ++)
		{
			$("#STEP_STDT1_" + a).datepicker({dateFormat:'yy-mm-dd'});
			$("#STEP_EDDT1_" + a).datepicker({dateFormat:'yy-mm-dd'});
		}
		
		
	}
	
	function stepDelete()
	{
		
		var codeList = '';
		var delCount = 0;
		for (var a = 0 ; a < <?=$stepCount?> ; a ++)
		{
			if ($("#DEL_YN_" + a).is(':checked')) 
			{
				codeList += ',' + $("#STEP_IDX_" + a).val();
				delCount ++;
			}
		}
		//alert(codeList);
		//$("#form1").submit();
		if (delCount == 0)
		{
			alert('������ ������ �����ϼ���');
		}
		
		if (delCount > 0)
		{
			$("#P_TYPE").val("delete");
			$("#STEP_IDX_LIST").val(codeList);
			$("#form1").submit();
		}
	}
	
	function stepModify(code)
	{
		$("#P_TYPE").val("modify");
		
		
		
		////alert($("#STEP_STDT1_" + code).val() + '---' + $("#STEP_STDT2_" + code).val() + '---' + $("#STEP_STDT3_" + code).val());
		if (!$("#STEP_NM_" + code).val()) { alert('�������� �Է��ϼ���'); }
		else if (!$("#STEP_STDT1_" + code).val() || !$("#STEP_STDT2_" + code).val() || !$("#STEP_STDT3_" + code).val()) { alert('�ش� ������ ���۱Ⱓ�� �����ϼ���'); }
		else if (!$("#STEP_EDDT1_" + code).val() || !$("#STEP_EDDT2_" + code).val() || !$("#STEP_EDDT3_" + code).val()) { alert('�ش� ������ ����Ⱓ�� �����ϼ���'); }
		else { 
			
			$("#STEP_NM").val($("#STEP_NM_" + code).val());
			$("#STEP_IDX").val($("#STEP_IDX_" + code).val());
			$("#STEP_STDT1").val($("#STEP_STDT1_" + code).val());
			$("#STEP_STDT2").val($("#STEP_STDT2_" + code).val());
			$("#STEP_STDT3").val($("#STEP_STDT3_" + code).val());
			$("#STEP_EDDT1").val($("#STEP_EDDT1_" + code).val());
			$("#STEP_EDDT2").val($("#STEP_EDDT2_" + code).val());
			$("#STEP_EDDT3").val($("#STEP_EDDT3_" + code).val());
			
			if ($("#DEL_YN_" + code).is(':checked')) $("#DEL_YN").val('Y');
			
			$("#form1").submit();
			
		}
			
	}
	
	function stepRegist()
	{
		$("#P_TYPE").val("regist");
		$("#form1").submit();
	}
	
	function changeProject(obj)
	{
		goLink('/admin/stepManagement?project_id=' + obj.value);
	}
	
</script>
						<div class="btn_box">
						<div class="lefBox">
						
						
						</div>
						<div class="rigBox">
						<form id="top-sch" name="top-sch" action="#" method="post">
						<strong>���� ä�����</strong> : <?=$SELECTBOX1?>
						</form>
						</div>
						</div>
					
					<!-- E: �˻� -->

					<!-- S: �Խù�����Ʈ -->
					<table id="BdList-Type01" summary="���� ��ũ�� ���ؼ� �Խù� �� �������� �̵��մϴ�.">
						<caption>���</caption>
						<colgroup>
							<col width="60px" />
							<col width="120px" />
							<col width="*" />
							<col width="100px" />
							<col width="95px" />
							<col width="95px" />
						</colgroup>
						<thead>
							<tr>
								<th scope="col" class="first">����</th>
								<th scope="col">������</th>
								<th scope="col">���� �Ⱓ</th>
								<th scope="col">�ο�</th>
								<th scope="col">��� �� ��ǥ</th>
								<th scope="col">����</th>
							</tr>
						</thead>
						<tbody>
							<? 
							if ( $stepCount > 0 ) { 
							foreach ( $stepdata as $key => $data){
							?>
							<tr>
								<td><input type="checkbox" name="DEL_YN_<?=$key?>" id="DEL_YN_<?=$key?>" value="Y" class="checkbox"  /></td>
								<td><input type="text" name="STEP_NM_<?=$key?>" id="STEP_NM_<?=$key?>" title="���� ��" style="width:100px;" value="<?=trim($data->STEP_NM)?>" /></td>
								<td>
									<input type="hidden" name="STEP_IDX_<?=$key?>" id="STEP_IDX_<?=$key?>" value="<?=$data->STEP_IDX?>" />
									<input type="text" name="STEP_STDT1_<?=$key?>" id="STEP_STDT1_<?=$key?>" title="���� �Խ� �Ⱓ �Է�" readonly style="width:100px;" value="<?=$data->STEP_STDT1?>" />
									<!--a href="#"><img src="/assets/img/common/ico_calendar.gif" alt="�޷�"/></a-->
									<?=${'SELECT_BOX1_HOUR_' . $key}?>��
									<?=${'SELECT_BOX1_MIN_' . $key}?>��
									
									~
									
									<input type="text" name="STEP_EDDT1_<?=$key?>" id="STEP_EDDT1_<?=$key?>" title="���� �Խ� �Ⱓ �Է�" readonly style="width:100px;" value="<?=$data->STEP_EDDT1?>" />
									<!--a href="#"><img src="/assets/img/common/ico_calendar.gif" alt="�޷�"/></a-->
									<?=${'SELECT_BOX2_HOUR_' . $key}?>��
									<?=${'SELECT_BOX2_MIN_' . $key}?>��
									
								</td>
								<td><?=$data->CNT?> ��</td>
								<td><? if ($key > 0) { ?><span class="btn03"><a href="javascript:goLink('/admin/stepManagement/dataList?project_id=<?=$PRJ_IDX?>&step_id=<?=$data->STEP_IDX?>');">�ٷΰ���</a></span><? } ?></td>
								<td><span class="btn04"><a href="javascript:stepModify(<?=$key?>);">����</a></span></td>
							</tr>
						<? 
							}
							} else {
						 ?>
							<tr>
								<td colspan="6" class="no-data">�ش� �����Ͱ� �����ϴ�.</td>
							</tr>
						<? } ?>
						</tbody>
					</table>
					<!--// E: �Խù�����Ʈ -->
<br>
			<table id="BdList-Type01" summary="���� ��ũ�� ���ؼ� �Խù� �� �������� �̵��մϴ�." style="border:0px;">
				<colgroup>
							<col width="*" />
							<col width="*" />
						</colgroup>
				<tbody>
				<tr>
					<td style="border:0px;text-align:left"><span class="btn02"><a href="javascript:stepDelete();">���� ����</a></span></td>
					<td style="border:0px;text-align:right"><span class="btn01"><a href="javascript:stepRegist();">���� �ܰ� �߰�</a></span></td>
				</tr>
			</tbody>
		</table>
<form name="form1" id="form1" method="post" action="/admin/stepManagement/stepProcess" style="display:none;">
	
	
	
<input type="hidden" name="P_TYPE" id="P_TYPE" />
<input type="hidden" name="PRJ_IDX" id="PRJ_IDX" value="<?=$PRJ_IDX?>" />
<input type="hidden" name="STEP_NM" id="STEP_NM" />	
<input type="hidden" name="STEP_IDX" id="STEP_IDX" />	
<input type="hidden" name="STEP_STDT1" id="STEP_STDT1" />	
<input type="hidden" name="STEP_STDT2" id="STEP_STDT2" />	
<input type="hidden" name="STEP_STDT3" id="STEP_STDT3" />	
<input type="hidden" name="STEP_EDDT1" id="STEP_EDDT1" />	
<input type="hidden" name="STEP_EDDT2" id="STEP_EDDT2" />	
<input type="hidden" name="STEP_EDDT3" id="STEP_EDDT3" />	
<input type="hidden" name="STEP_IDX_LIST" id="STEP_IDX_LIST" />	
</form>