<script>
	
	function goJobList(code)
	{
		$("#JOB_IDX").val(code);
		$("#form1").submit();
	}
	
	function selectedData(p_code,p_name)
	{
		opener.DataSet('<?=$etcCodeVarCD?>',p_code);
		opener.DataSet('<?=$etcCodeVarNM?>',p_name);
		window.close();
	}
	
</script>
<form id="form1" name="form1" action="/front/popup/JobTypeList" method="post" >
<input type="hidden" id="JOB_IDX" name="JOB_IDX" value="<?=$JOB_IDX?>" />
<input type="hidden" id="popupIndex" name="popupIndex" value="<?=$popupIndex?>" />
<input type="hidden" id="popupAccCode" name="popupAccCode" value="<?=$popupAccCode?>" />

		<div class="Pop-Content">

			<h3><?=$popupTitle?> ����Ʈ</h3>
			
			�з� : 
			<? 
			foreach ($jobTypeMainList as $key => $jobMlist)
			{
			?>
				<a href="javascript:goJobList(<?=$jobMlist->JOB_IDX?>);"><?=$jobMlist->JOB_NM?></a>
			<?
			}
			?>
			
			<h3>�˻� ���</h3>
			
			<div class="tetAlignC">
		
			<div id="id_showTextForm" style="display:none">
			<?=$popupTitle?>�� <input type="text" id="etcName" name="etcName"><input type="hidden" id="etcCode" name="etcCode"> <span class="btn04"><a href="javascript:registEtcData();">Ȯ��</a></span>
			</div>
			
			
			
			</div>	
			<table class="TbStyle01" summary="�˻����">
			<caption>�˻����</caption>
			<colgroup>
			<col width="*" />
			</colgroup>
			<thead>
			<tr>
				<th scope="col">���� ���</th>
			</tr>
			</thead>
			</table>
			
			<div class="terms-box">
			<table class="TbStyle01" summary="�˻����">
			<caption>�˻����</caption>
			<colgroup>
			
			<col width="*" />
			
			</colgroup>
			<tbody>
			<? foreach($jobTypeSubList as $key => $subList) { ?>
			<tr>
				<td align="center"><a href="javascript:selectedData('<?=$subList->JOB_IDX?>','<?=$subList->JOB_NM?>');"><?=$subList->JOB_NM?></a></td>
			</tr>
			<? } ?>
			
			</tbody>
			</table>
			</div>
			
			
			
			<div class="tetAlignC mgt15">
				<span class="btn04"><a href="javascript:window.close();">�ݱ�</a></span>
			</div>
		</div>
</form>