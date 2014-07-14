
<script>

	function modifyProcess(code)
	{
		$("#code").val(code);
		$("#form1").attr("method","post");
		$("#form1").attr("action","/admin/resumeComment/commentView");
		$("#form1").submit();
	}
	
</script>
<form id="form1" name="form1" >
<input type="hidden" id="code" name="code" />
</form>
						<h2 class="H2blt">유의사항 기본사항 목록</h2>
						
						<table id="BdList-Type01" summary="목록">
						<caption>목록</caption>
						<colgroup>
							<col width="80px" />
							<col width="*" />
						
							<col width="80px" />

						</colgroup>
						<thead>
							<tr>
								<th scope="col" class="first">항목명</th>
								
								<th scope="col">유의사항내용</th>
		
								<th scope="col">수정</th>
							</tr>
						</thead>
						<tbody>
						<?
							foreach ($cmtList as $key => $clist) {
						?>
							<tr>
								<td><?=$clist->DFC_NM?></td>
							
								<td><?=String2Html($clist->DFC_CNTNT)?></td>
								
		
								<td><span class="btn03"><a href="javascript:modifyProcess('<?=$clist->DFC_CD?>');">수정</a></span></td>
							</tr>
						<?
							}
						?>
						</tbody>
					</table>