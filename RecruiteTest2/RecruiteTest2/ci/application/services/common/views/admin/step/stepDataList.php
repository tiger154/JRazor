<!-- S: �˻� -->
<script>
	
	function bodyOnLoad()
	{
		$("#SCH_PRJ_IDX").val($("#PRJ_IDX").val());
	}
	
	function openDataView(code,gubun)
	{
		goLink('','pop','width=650 height=500 resizable=yes scrollbars=yes');
		$("#GUBUN").val(gubun);
		$("#form1").attr('target','open_pops');
		$("#form1").attr('action','/admin/stepManagement/dataView?form_id=' + code);
		$("#form1").submit();
		
	}
	
	function openDataFormView(code,gubun)
	{
		
		goLink('','pop','width=650 height=500 resizable=yes scrollbars=yes');
		$("#GUBUN").val(gubun);
		$("#form1").attr('method','post');
		$("#form1").attr('target','open_pops');
		$("#form1").attr('action','/admin/stepManagement/dataFormView?form_id=' + code);
		$("#form1").submit();
		
	}
	
	function openSendMailForm(code,gubun)
	{
		goLink('','pop','width=790 height=480 resizable=yes scrollbars=yes');
		$("#GUBUN").val(gubun);
		$("#form1").attr('method','post');
		$("#form1").attr('target','open_pops');
		$("#form1").attr('action','/admin/mailManagement?form_id=' + code);
		$("#form1").submit();
	}
	
	function openSendSmsForm(code,gubun)
	{
		goLink('','pop','width=650 height=380 resizable=yes scrollbars=yes');
		$("#GUBUN").val(gubun);
		$("#form1").attr('method','post');
		$("#form1").attr('target','open_pops');
		$("#form1").attr('action','/admin/smsManagement?form_id=' + code);
		$("#form1").submit();
	}
	
	function changeProject(obj)
	{
		goLink('/admin/stepManagement/dataList?project_id=' + obj.value);
	}
	
	function changeStep(obj)
	{
		goLink('/admin/stepManagement/dataList?project_id=' + $("#SCH_PRJ_IDX option:selected").val() + '&step_id=' + obj.value);
	}
</script>
					<div class="btn_box">
						<div class="lefBox">
						
						</div>
						<div class="rigBox">
						<form id="top-sch" name="top-sch" action="#" method="post">
						<strong>���� ä�����</strong> : <?=$SELECTBOX1?>
						<strong>���� ����</strong> : <?=$SELECTBOX2?>
						</form>
						</div>
						</div>
					
					<!-- E: �˻� -->
<br>
					<!-- S: �Խù�����Ʈ -->
					<table id="BdList-Type01" summary="���� ��ũ�� ���ؼ� �Խù� �� �������� �̵��մϴ�.">
						<caption>���</caption>
						<colgroup>
							<col width="*" />
							<col width="*" />
							<col width="*" />
							<col width="*" />
							<col width="*" />
							<col width="*" />
							<col width="*" />
							<col width="*" />
							<col width="*" />
						</colgroup>
						<thead>
							<tr>
								<th scope="col" class="first">����</th>
								<th scope="col">�ο�</th>
								<th scope="col">��ǥ �� ����</th>
								<th scope="col">��ǥ ��� Ȯ��</th>
								<th scope="col">��ǥ��� ����</th>
								<th scope="col">��� �ٿ�</th>
								<th scope="col">����</th>
								<th scope="col">SMS</th>
								<th scope="col">����</th>
							</tr>
						</thead>
						<tbody>
							<? 
							$ETCVAR = null;
							foreach ( $stepdata as $key => $data){
							if ($key == 0 ) $ETCVAR = $data->ETCVAR;
							?>
							<tr>
								<td><?=$data->GUBUN?></td>
								<td><?=number_format($data->CNT)?> ��</td>
								
								<td><span class="btn03"><a href="javascript:openDataFormView('<?=$data->STEP_DATA_FRM_IDX?>','<?=base64_encode($data->GUBUN)?>');">Ȯ��</a></span></td>
								<td><span class="btn03"><a href="javascript:openDataView('<?=$data->STEP_DATA_FRM_IDX?>','<?=base64_encode($data->GUBUN)?>');">����</a></span></td>
								<? if ($key == 0) { ?>
								<td rowspan="<?=$stepCount?>"><span class="btn03"><a href="javascript:goLink('/admin/stepManagement/dataUpload?project_id=<?=$PRJ_IDX?>&step_id=<?=$STEP_IDX?>','pop','width=400 height=172')">Ȯ��</a></span></td>
								<td rowspan="<?=$stepCount?>"><span class="btn03"><a href="javascript:goLink('/admin/stepManagement/dataList?step_id=<?=$data->STEP_DATA_FRM_IDX?>');">Ȯ��</a></span></td>
								<? } ?>
								<td><span class="btn03"><a href="javascript:openSendMailForm('<?=$data->STEP_DATA_FRM_IDX?>','<?=base64_encode($data->GUBUN)?>');">�߼�</a></span></td>
								<td><span class="btn04"><a href="javascript:openSendSmsForm('<?=$data->STEP_DATA_FRM_IDX?>','<?=base64_encode($data->GUBUN)?>');">�߼�</a></span></td>
								<? if ($key == 0) { ?>
								<td rowspan="<?=$stepCount?>"><span class="btn03"><a href="javascript:goLink('/admin/stepManagement/dataList?step_id=<?=$data->STEP_DATA_FRM_IDX?>');">Ȯ��</a></span></td>
								<? } ?>
							</tr>
							<? 
							}
							?>
						</tbody>
					</table>
					
					<form name="form1" id="form1" method="post">
						<input type="hidden" name="GUBUN" id="GUBUN">
						<input type="hidden" name="PRJ_IDX" id="PRJ_IDX" value="<?=$PRJ_IDX?>">
						<input type="hidden" name="STEP_IDX" id="STEP_IDX" value="<?=$STEP_IDX?>">
						<input type="hidden" name="ETCVAR" id="ETCVAR" value="<?=base64_encode($ETCVAR)?>">
					</form>
					<!--// E: �Խù�����Ʈ -->
<br>
				<div class="txtC">
						<span class="btn01"><a href="javascript:goLink('/admin/stepManagement/dataUpload?project_id=<?=$PRJ_IDX?>&step_id=<?=$STEP_IDX?>','pop','width=400 height=172')">���� ������ ���</a></span>
					</div>
		</table>
				