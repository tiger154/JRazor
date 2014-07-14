<script language="javascript" src="/assets/js/popup.js" ></script>
<script>
	function bodyOnLoad() {
	<?=$popupJsFile?>
	}
	
</script>
<? 
if ($projectListCount > 1 || $projectListCount == 0) { 
?>
<table class="BdList" summary="채용공고 목록이며 공고명을 클릭하시면 상세화면을 보실 수 있습니다.">
	<caption>채용공고 목록</caption>
	  <colgroup>
	  <col width="10%" />
	  <col width="*" />
	  <col width="250px" />
	  </colgroup>
	  <thead>
		<tr>
			<th scope="col" class="first">번호</th>
			<th scope="col">공고명</th>
			<th scope="col" class="last">접수기간</th>
		</tr>
	  </thead>
	  <tbody>
		
<?
	foreach ($projectList as $key => $plist) {
?>
	<tr>
			<td><?=$plist->ROW_IDX?></td>
			<td class="left"><a href="javascript:goMenu('projectview','?projectListIdx=<?=$plist->PRJ_IDX?>');"><?=$plist->PRJ_NM?></a></td>
			<td><?=$plist->PRJ_STDT?> ~ <?=$plist->PRJ_EDDT?></td>
		</tr>
<? if ($projectListCount == 0) { ?>
	<tr>
			<td colspan="3" class="noData">채용중인 공고가 없습니다.</td>
		</tr>
<? }
	 } 
 ?>


	  </tbody>
</table>
<?

	}
?>
