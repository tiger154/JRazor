<script>
	
	function selectedData(p_code,p_title,p_etccode)
	{
		
		if (p_etccode != '')
		{
			if ( $("#searchstep").val() == 'etc' ) // 기타 입력스텝에서 클릭시 자격증명 입력폼이 나와야함
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
			alert('명칭을 입력하세요.');
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

			<h3><?=$popupTitle?> 검색</h3>
			<div class="PopSch mgt5 mgb20">				
				
					<fieldset>
						<legend><?=$popupTitle?></legend>		
						<label for="major" class="blind"><?=$popupTitle?>명</label>
						<input  type="text" name="searchword" id="searchword" class="inputS02" value="<?=$searchword?>" title="<?=$popupTitle?>명 입력" style="width:200px;" />
						<a href="javascript:goSearch();"><img src="<?=$POPUP_IMG_URL?>/img/board/btn_search.gif" alt="검색" /></a>
						
					</fieldset>
				
				<p class="tip mgt5 mgl10 tetAlignL">예) 컴퓨터공학과</p>
			</div>
			<h3>검색 결과</h3>
			
			<div class="tetAlignC">
			<? if ($popupEtcUseYn == 'Y' && $searchstep == 'etc') { ?> <font color="red">기타 <?=$popupTitle?> 구분을(를) 선택하세요.</font> <? } ?>
			
			<div id="id_showTextForm" style="display:none">
			<?=$popupTitle?>명 <input type="text" id="etcName" name="etcName"><input type="hidden" id="etcCode" name="etcCode"> <span class="btn04"><a href="javascript:registEtcData();">확인</a></span>
			</div>
			
			</div>	
			<table class="TbStyle01" summary="검색결과">
			<caption>검색결과</caption>
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
			<table class="TbStyle01" summary="검색결과">
			<caption>검색결과</caption>
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
				<td colspan="<?=count($SEARCH_TITLE_COLUMN_AR)?>" align="center">검색 결과가 없습니다.</td>
			</tr>
			<? } ?>
			
			</tbody>
			</table>
			</div>
			
			<div class="tetAlignC">
			<? if ($popupEtcUseYn == 'Y' ) { ?>
			<!-- 기타 입력 가능에 따른 작업 S -->
			<font color="red">검색이 되지않거나 원하는 목록이 없으면 직접 입력해주세요.</font><br/>
			<span class="btn04"><a href="javascript:goEtcData();"><?=$popupTitle?> 직접 입력하기</a></span>
			<!-- 기타 입력 가능에 따른 작업 E -->
			<? } ?>
			
			<? if ($popupEtcUseYn == 'N' ) { ?>
			<!-- 
			이 스텝일경우 ->> Q&A새창으로 
			-->
			만약에 없으면???
			<? } ?>
			</div>
			
			<div class="tetAlignC mgt15">
				<span class="btn04"><a href="javascript:window.close();">닫기</a></span>
			</div>
		</div>
</form>