<script>
	
	function goDelete(code)
	{
		if (confirm('�����Ͻðڽ��ϱ�?'))
		{
			$("#RETURN_URL").val('/admin/popupManagement');
			$("#POP_IDX").val(code);
			$("#form1").attr('method','post');
			$("#form1").attr('action','/admin/popupManagement/Process');
			$("#form1").submit();
		}
	}
	
	function goView(code)
	{
		$("#RETURN_URL").val('');
		$("#ACT_FLAG").val('');
		$("#POP_IDX").val(code);
		$("#form1").attr('method','post');
		$("#form1").attr('action','/admin/popupManagement/View');
		$("#form1").submit();
	}
	
</script>
<form id="form1" name="form1" >
<input type="hidden" id="RETURN_URL" name="RETURN_URL" />
<input type="hidden" id="POP_IDX" name="POP_IDX" />
<input type="hidden" id="ACT_FLAG" name="ACT_FLAG" value="delete" />
</form>
						<table id="BdList-Type01" summary="">
						<caption>���</caption>
						<colgroup>
							<col width="60px" />
							<col width="*" />
							<col width="100px" />
							<col width="250px" />
							<col width="80px" />
							<col width="80px" />
							<col width="80px" />
						</colgroup>
						<thead>
							<tr>
								<th scope="col" class="first">No</th>
								<th scope="col">����</th>
								<th scope="col">ũ��</th>
								<th scope="col">���±Ⱓ</th>
								<th scope="col">Ÿ��</th>
								<th scope="col">��뿩��</th>
								<th scope="col">����</th>
							</tr>
						</thead>
						<tbody>
						<? 
							if ( $num_rows > 0 ) { 
						 	foreach ( $rdata as $key => $data){
						 ?>
							<tr>
								<td><?=$data->ORD?></td>
								<td><a href="javascript:goView('<?=$data->POP_IDX?>');"><?=$data->POPUP_TITLE?></a></td>
								<td><?=$data->POP_WIDTH?> x <?=$data->POP_HEIGHT?></td>
								<td><?=$data->OPN_STDT?> ~ <?=$data->OPN_EDDT?></td>
								<td><?=$data->VIEW_TP == 'W' ? '��â' : '���̾�'?></td>
								<td><?=$data->USE_YN == 'Y' ? '<span class="ico01"><span>���</span></span>' : '<span class="ico02"><span>����</span></span>';?></td>
								<td><span class="btn04"><a href="javascript:goDelete('<?=$data->POP_IDX?>');">����</a></span></td>
							</tr>
					 		<? 
					 	  }
					 	
					 	  } else {
					 	  ?>
							<tr>
								<td colspan="11" class="no-data">�ش� �����Ͱ� �����ϴ�.</td>
							</tr>
							<?
							}
							?>
						</tbody>
					</table>
					<BR/>
					<div class="txtR">
						<span class="btn01"><a href="/admin/popupManagement/Form">POPUP ���</a></span>
					</div>