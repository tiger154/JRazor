<script language="javascript" src="/assets/js/jquery.autoheight.js"></script>
<script>
	
	function bodyOnLoad()
	{
		$("<iframe scrolling='no' />").attr("src", "/front/recruit/projectViewAjax?PRJ_IDX=<?=$PRJ_IDX?>").attr("frameborder", 0).attr("width", "100%").attr("height", "0px").appendTo("#iframe-container1");
    $('iframe').iframeAutoHeight({heightOffset: 40});    
    
    <?=$popupJsFile?>
    
	}
	
</script>

<? 
if ($projectListCount > 1) { 
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
<?
	} 
?>
	  </tbody>
</table>
<?

	}
?>
<div id="iframe-container1"  ></div>

<div class="textC">
<? if ($APPLY_CHECK_YN == 'ON') { ?><a href="javascript:goMenu('userAuthLogin','?projectListIdx=<?=$PRJ_IDX?>');"><img src="<?=$FRONT_IMG_URL?>/img/board/btn_enter.gif" alt="입사지원 시작" /><? } ?></a>
<a href="javascript:goMenu('myPage');"><img src="<?=$FRONT_IMG_URL?>/img/board/btn_enter_modify.gif" alt="입사지원 확인 및 수정" /></a>
</div>

