<script>
	
	function selectedData(p_code1,p_code2,p_title)
	{
		
			opener.DataSet('ZIPCODE1',p_code1);
			opener.DataSet('ZIPCODE2',p_code2);
			opener.DataSet('ADDRESS1',p_title);
			window.close();
		
	}
	
	function goSearch()
	{
		
		if ($.trim($("#searchword").val()) == '')
		{
			alert('명칭을 입력하세요.');
			$("#searchword").val('');
		}
		
		if ($("#searchword").val() != '')
		{
			$("#searchstep").val('result');
			$("#form1").submit();
		}
		
	}
	
	
</script>

<form id="form1" name="form1" action="/front/popup/AddressList" method="post" >
<input type="hidden" id="searchstep" name="searchstep" value="<?=$searchstep?>" />
		<div class="Pop-Content">

			<h3><?=$popupTitle?> 검색</h3>
			<div class="PopSch mgt5 mgb20">				
				
					<fieldset>
						<legend><?=$popupTitle?></legend>		
						<label for="major" class="blind"><?=$popupTitle?>명</label>
						<input  type="text" name="searchword" id="searchword" class="inputS02" value="<?=$searchword?>" title="<?=$popupTitle?>명 입력" style="width:200px;" />
						<a href="javascript:goSearch();"><img src="<?=$POPUP_IMG_URL?>/img/board/btn_search.gif" alt="검색" /></a>
						
					</fieldset>
				
				<p class="tip mgt5 mgl10 tetAlignL">예) 삼성동,사당동</p>
			</div>
			<h3>검색 결과</h3>
			
			
			<table class="TbStyle01" summary="검색결과">
			<caption>검색결과</caption>
			<colgroup>
			<col width="70px" />
			<col width="*" />
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
			<table class="TbStyle01" summary="검색결과">
			<caption>검색결과</caption>
			<colgroup>
			
			<col width="70px" />
			<col width="*" />
			</colgroup>
			<tbody>
			<? foreach($SEARCH_LIST_DATA as $key => $dataList) { ?>
			<tr>
				<td align=""><a href="javascript:selectedData('<?=$dataList->ZIPCODE1?>','<?=$dataList->ZIPCODE2?>','<?=$dataList->FULL_ADDRESS?>');"><?=$dataList->ZIPCODE1?>-<?=$dataList->ZIPCODE2?></a></td>
				<td align=""><a href="javascript:selectedData('<?=$dataList->ZIPCODE1?>','<?=$dataList->ZIPCODE2?>','<?=$dataList->FULL_ADDRESS?>');"><?=$dataList->FULL_ADDRESS?></a></td>
			</tr>
			<? } ?>
			
			<? if (count($SEARCH_LIST_DATA) == 0) { ?>
			<tr>
				<td colspan="<?=count($SEARCH_TITLE_COLUMN_AR)?>" align="center">검색 결과가 없습니다.</td>
			</tr>
			<? } ?>
			
			</tbody>
			</table>
			</div>
			
			
			<div class="tetAlignC mgt15">
				<span class="btn04"><a href="javascript:window.close();">닫기</a></span>
			</div>
		</div>
</form>