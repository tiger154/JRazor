<script language="javascript" src="/assets/js/popup.js" ></script>
<script>
	function bodyOnLoad() {
	<?=$popupJsFile?>
	}
	
</script>
<? 
if ($projectListCount > 1 || $projectListCount == 0) { 
?>
<table class="BdList" summary="ä����� ����̸� ������� Ŭ���Ͻø� ��ȭ���� ���� �� �ֽ��ϴ�.">
	<caption>ä����� ���</caption>
	  <colgroup>
	  <col width="10%" />
	  <col width="*" />
	  <col width="250px" />
	  </colgroup>
	  <thead>
		<tr>
			<th scope="col" class="first">��ȣ</th>
			<th scope="col">�����</th>
			<th scope="col" class="last">�����Ⱓ</th>
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
			<td colspan="3" class="noData">ä������ ���� �����ϴ�.</td>
		</tr>
<? }
	 } 
 ?>


	  </tbody>
</table>
<?

	}
?>
