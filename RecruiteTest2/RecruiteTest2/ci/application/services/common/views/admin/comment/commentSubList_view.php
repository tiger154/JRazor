
<script>

	function registProcess()
	{
		$("#code").val('');
		$("#form1").attr("method","post");
		$("#form1").attr("action","/admin/resumeComment/commentSubView");
		$("#form1").submit();
	}

	function modifyProcess(code)
	{
		$("#code").val(code);
		$("#form1").attr("method","post");
		$("#form1").attr("action","/admin/resumeComment/commentSubView");
		$("#form1").submit();
	}
	
</script>
<form id="form1" name="form1" >
<input type="hidden" id="RSM_IDX" name="RSM_IDX" value="<?=$RSM_IDX?>" />
<input type="hidden" id="PRJ_IDX" name="PRJ_IDX" value="<?=$PRJ_IDX?>" />	
<input type="hidden" id="code" name="code" />
</form>
						<h2 class="H2blt">���ǻ��� ��� </h2>
						
						<table id="BdList-Type01" summary="���">
						<caption>���</caption>
						<colgroup>
							<col width="80px" />
							<col width="*" />
						
							<col width="80px" />

						</colgroup>
						<thead>
							<tr>
								<th scope="col" class="first">�׸��</th>
								
								<th scope="col">���ǻ��׳���</th>
		
								<th scope="col">����</th>
							</tr>
						</thead>
						<tbody>
						<?
							if ( $cmtListCount > 0 ) { 
							foreach ($cmtList as $key => $clist) {
						?>
							<tr>
								<td><?=$clist->DFC_NM?></td>
							
								<td><?=String2Html($clist->DFC_CNTNT)?></td>
								
		
								<td><span class="btn03"><a href="javascript:modifyProcess('<?=$clist->DFC_CD?>');">����</a></span></td>
							</tr>
						<?
							}
						}
						?>
						</tbody>
					</table>
					<br>
					<div class="txtR">
						<span class="btn01"><a href="javascript:registProcess();">���ǻ��� ���</a></span>
					</div>