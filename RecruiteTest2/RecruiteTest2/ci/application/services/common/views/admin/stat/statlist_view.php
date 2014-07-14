<script>
	
	function goUnitMenu(url)
	{
		$("#form1").attr("method","post");
		$("#form1").attr("action",url);
		$("#form1").submit();
	}
	
	function goProcess(code)
	{
		if (code != undefined) $("#STEP_IDX").val(code);
		$("#form1").attr("method","post");
		$("#form1").attr("action","/admin/statManagement/statUnitList");
		$("#form1").submit();
	}
	
</script>

<form id="form1" name="form1" >
<div class="btn_box">
<div class="lefBox">
<div class="rigBox">
<strong>현재 채용공고</strong> : <?=$SELECTBOX_PRJ_IDX?>
</div>
</div>
</div>
<input type="hidden" id="STEP_IDX" name="STEP_IDX" value="<?=$STEP_IDX?>" />
</form>

<table id="BdList-Type01" class="mgb30" summary="목록">
						<caption>목록</caption>
						<colgroup>
						
							<? foreach ($stepData as $key => $sData) { ?>
								<col width="*" />
							<? } ?>
							
						</colgroup>
						<thead>
							<tr>
							<? foreach ($stepData as $key => $sData) { ?>
								<th scope="col" class="first"><?=$sData->STEP_NM?></th>
							<? } ?>
							</tr>
						</thead>
						<tbody>
							<tr>
							<? foreach ($stepData as $key => $sData) { ?>
								<td><a href="javascript:goProcess('<?=$sData->STEP_IDX?>');" ><?=number_format($sData->CNT)?> 명</a></td>
							<? } ?>
							</tr>
						</tbody>
					</table>

					<!-- S: 검색 -->
					<div id="Bd-top-sch" style="display:none">
						<
						<div class="page">
							<span class="btn04"><a href="#">엑셀다운로드</a></span>
						</div>
						
						<div class="sch">
							<span class="btn04"><a href="#">그래프 보기</a></span>
						</div>
					</div>
					<!-- E: 검색 -->

					<ul class="tabStyle02">
						<li><a href="javascript:goUnitMenu('/admin/statManagement/statUnitList');">모집분야별</a></li>
						<li><a href="javascript:goUnitMenu('/admin/statManagement/statSexList');">성별</a></li>
						<li><a href="#">최종학력별</a></li>
					</ul>

					<?=$TABLE_RESULT?>