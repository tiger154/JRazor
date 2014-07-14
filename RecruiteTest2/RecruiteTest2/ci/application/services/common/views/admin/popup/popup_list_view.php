<script>
	
	function goDelete(code)
	{
		if (confirm('삭제하시겠습니까?'))
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
						<caption>목록</caption>
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
								<th scope="col">제목</th>
								<th scope="col">크기</th>
								<th scope="col">오픈기간</th>
								<th scope="col">타입</th>
								<th scope="col">사용여부</th>
								<th scope="col">삭제</th>
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
								<td><?=$data->VIEW_TP == 'W' ? '새창' : '레이어'?></td>
								<td><?=$data->USE_YN == 'Y' ? '<span class="ico01"><span>사용</span></span>' : '<span class="ico02"><span>중지</span></span>';?></td>
								<td><span class="btn04"><a href="javascript:goDelete('<?=$data->POP_IDX?>');">삭제</a></span></td>
							</tr>
					 		<? 
					 	  }
					 	
					 	  } else {
					 	  ?>
							<tr>
								<td colspan="11" class="no-data">해당 데이터가 없습니다.</td>
							</tr>
							<?
							}
							?>
						</tbody>
					</table>
					<BR/>
					<div class="txtR">
						<span class="btn01"><a href="/admin/popupManagement/Form">POPUP 등록</a></span>
					</div>