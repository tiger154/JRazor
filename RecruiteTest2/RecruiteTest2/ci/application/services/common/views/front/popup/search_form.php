<script>
	
	function selectedData(p_code,p_title,p_etccode)
	{
		
		if (p_etccode != '')
		{
			if ( $("#searchstep").val() == 'etc' ) // ��Ÿ �Է½��ܿ��� Ŭ���� �ڰ����� �Է����� ���;���
			{
				showEtcName(p_code);
			}
			else 
			{
				goEtcData();
			}
		}
		else
		{
			opener.DataSet('<?=$etcCodeVarCD?>',p_code);
			opener.DataSet('<?=$etcCodeVarNM?>',p_title);
			window.close();
		}
	}
	
	function goSearch()
	{
		
		if ($.trim($("#searchword").val()) == '')
		{
			alert('��Ī�� �Է��ϼ���.');
			$("#searchword").val('');
		}
		
		if ($("#searchword").val() != '')
		{
			$("#searchstep").val('result');
			$("#form1").submit();
		}
		
	}
	
	function goEtcData()
	{
	
		$("#searchstep").val('etc');
		$("#form1").submit();
	}
	
	function showEtcName(p_code)
	{
		$("#etcCode").val(p_code);
		$("#id_showTextForm").show();
	}
	
	function registEtcData()
	{
		opener.DataSet('<?=$etcCodeVarCD?>',$("#etcCode").val());
		opener.DataSet('<?=$etcCodeVarNM?>',$("#etcName").val());
		window.close();
	}
	
</script>

<form id="form1" name="form1" action="/front/popup/SearchList" method="post" >
<input type="hidden" id="popupCode" name="popupCode" value="<?=$popupCode?>" />
<input type="hidden" id="popupTitle" name="popupTitle" value="<?=$popupTitle?>" />
<input type="hidden" id="popupIndex" name="popupIndex" value="<?=$popupIndex?>" />
<input type="hidden" id="popupAccCode" name="popupAccCode" value="<?=$popupAccCode?>" />
<input type="hidden" id="popupSchCode" name="popupSchCode" value="<?=$popupSchCode?>" />
<input type="hidden" id="popupEtcUseYn" name="popupEtcUseYn" value="<?=$popupEtcUseYn?>" />
<input type="hidden" id="popupDisplayType" name="popupDisplayType" value="<?=$popupDisplayType?>" />
<input type="hidden" id="popupEtcUseYn" name="popupEtcUseYn" value="<?=$popupEtcUseYn?>" />
<input type="hidden" id="searchstep" name="searchstep" value="<?=$searchstep?>" />
		<div class="Pop-Content">

			<h3><?=$popupTitle?> �˻�</h3>
			<div class="PopSch mgt5 mgb20">				
				
					<fieldset>
						<legend><?=$popupTitle?></legend>		
						<label for="major" class="blind"><?=$popupTitle?>��</label>
						<input  type="text" name="searchword" id="searchword" class="inputS02" value="<?=$searchword?>" title="<?=$popupTitle?>�� �Է�" style="width:200px;" />
						<a href="javascript:goSearch();"><img src="<?=$POPUP_IMG_URL?>/img/board/btn_search.gif" alt="�˻�" /></a>
						
					</fieldset>
				
				<p class="tip mgt5 mgl10 tetAlignL">��) ��ǻ�Ͱ��а�</p>
			</div>
			<h3>�˻� ���</h3>
			
			<div class="tetAlignC">
			<? if ($popupEtcUseYn == 'Y' && $searchstep == 'etc') { ?> <font color="red">��Ÿ <?=$popupTitle?> ������(��) �����ϼ���.</font> <? } ?>
			
			<div id="id_showTextForm" style="display:none">
			<?=$popupTitle?>�� <input type="text" id="etcName" name="etcName"><input type="hidden" id="etcCode" name="etcCode"> <span class="btn04"><a href="javascript:registEtcData();">Ȯ��</a></span>
			</div>
			
			</div>	
			<table class="TbStyle01" summary="�˻����">
			<caption>�˻����</caption>
			<colgroup>
			<? foreach($SEARCH_TITLE_LIST_AR as $key => $titleList) { ?>
			<col width="*" />
			<? } ?>
			</colgroup>
			<thead>
			<tr>
			<? foreach($SEARCH_TITLE_LIST_AR as $key => $titleList) { ?>
			<th scope="col"><?=$titleList?></th>
			<? } ?>
			</tr>
			</thead>
			</table>
			
			
			<div class="terms-box">
			<table class="TbStyle01" summary="�˻����">
			<caption>�˻����</caption>
			<colgroup>
			<? foreach($SEARCH_TITLE_LIST_AR as $key => $titleList) { ?>
			<col width="*" />
			<? } ?>
			</colgroup>
			<tbody>
			<? foreach($SEARCH_LIST_DATA as $key => $dataList) { ?>
			<tr>
				<? foreach ($SEARCH_TITLE_COLUMN_AR as $ckey => $columnList) { ?>
				<td align="center"><a href="javascript:selectedData('<?=$dataList->CODE?>','<?=$dataList->NAME?>','<?=$dataList->ETCFLAG?>');"><?=$dataList->{$columnList}?></a></td>
				<? } ?>
			</tr>
			<? } ?>
			
			<? if (count($SEARCH_LIST_DATA) == 0) { ?>
			<tr>
				<td colspan="<?=count($SEARCH_TITLE_COLUMN_AR)?>" align="center">�˻� ����� �����ϴ�.</td>
			</tr>
			<? } ?>
			
			</tbody>
			</table>
			</div>
			
			<div class="tetAlignC">
			<? if ($popupEtcUseYn == 'Y' ) { ?>
			<!-- ��Ÿ �Է� ���ɿ� ���� �۾� S -->
			<font color="red">�˻��� �����ʰų� ���ϴ� ����� ������ ���� �Է����ּ���.</font><br/>
			<span class="btn04"><a href="javascript:goEtcData();"><?=$popupTitle?> ���� �Է��ϱ�</a></span>
			<!-- ��Ÿ �Է� ���ɿ� ���� �۾� E -->
			<? } ?>
			
			<? if ($popupEtcUseYn == 'N' ) { ?>
			<!-- 
			�� �����ϰ�� ->> Q&A��â���� 
			-->
			���࿡ ������???
			<? } ?>
			</div>
			
			<div class="tetAlignC mgt15">
				<span class="btn04"><a href="javascript:window.close();">�ݱ�</a></span>
			</div>
		</div>
</form>