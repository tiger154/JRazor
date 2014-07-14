<style>
 /* Style04 */
.btn04, .btn04 *{
	display:inline-block;
	background:url(../../assets/img/bg/btn_bg04.gif) no-repeat right top;
	height:21px;
	font-size:12px;
	text-decoration:none !important;
	text-align:center;
	vertical-align: middle;
}

.btn04 a, .btn04 a *{
	display:inline-block;
	background:url(../../assets/img/bg/btn_bg04.gif) no-repeat left top;
	height:16px;
	line-height:12px;
	font-size:12px;
	color:#4b4b4b !important; 
	text-decoration:none !important; 
	padding: 5px 10px 0 10px;
	vertical-align: top;
}

.btn04 a span, .btn04 a span *{
	width:auto;
	color:#ff5400 !important; 
	background:none;
	padding: 0 0 0 0; 
	height:0 !important; 
	vertical-align: top;
}
</style>
<script>
	
	function goApplyModify(code)
	{
		$("#PRJ_IDX").val(code);
		$("#form1").attr("action","/front/apply");
		$("#form1").attr("method","post");
		$("#form1").submit();
	}
	
	function goApplyView(code)
	{
		$("#PRJ_IDX").val(code);
		$("#form1").attr("action","/front/apply/applyView");
		$("#form1").attr("method","post");
		$("#form1").submit();
	}
	
</script>
<form name="form1" id="form1" >
<input type="hidden" id="PRJ_IDX" name="PRJ_IDX"  />
</form>
							<div class="h3-tit-box">
								<h3>입사지원 현황</h3>
							</div>

							<ul class="listStyle01">
								<li><span class="bold"><?=$NAMEKOR?></span> 님의 입사지원 현황 입니다.</li>
								<li class="red">입사지원서는 접수 마감 이후에는 수정이 불가능 합니다.</li>
							</ul>

							<div class="border-box">
								
									  <? foreach ($rdata as $key => $appList) { ?>
									  <br>
									  공고명 : <strong><?=$appList->PRJ_NM?></strong>
										<table class="TbStyle01 mgt10" summary="입사지원 현황">
										<caption>입사지원 현황</caption>
										
									  
										<colgroup>
										<col width="*" />
										<col width="*" />
										<col width="*" />
										<col width="*" />
										<col width="*" />
										<col width="60px" />
										<col width="60px" />
										</colgroup>
										<thead>
										<tr>
											<th rowspan="2" scope="col">분야</th>
											<th rowspan="2" scope="col">수험번호</th>
											<th rowspan="2" scope="col">제출일</th>
											<th rowspan="2" scope="col">접수여부</th>
											<th rowspan="2" scope="col">공고상태</th>
											<th scope="col" colspan="2">지원서 관리</th>
										</tr>
										<tr>
											<th scope="row">확인</th>
											<th scope="row">수정</th>
										</tr>
										</thead>
										<tbody>
										<tr>
											<td><?=$appList->UNIT_NM?></td>
											<td><strong><font color="red"><?=$appList->APPLY_NO?></font></stront></td>
											<td><?=$appList->APPL_DT?></td>
											<td align="center"><?=$appList->APPL_YN == 'Y' ? '접수완료' : '<strong><font color="red">미제출</font></strong>' ?></td>
											<td align="center"><?=$appList->STEP_NM?> <?=$appList->STS == 'Y' ? '진행중' : '마감' ?></td>
											<td><span class="btn04"><a href="javascript:goApplyView('<?=$appList->PRJ_IDX?>');">확인</span></td>
											<td><span class="btn04"><? if ($appList->APPLY_STS == 'Y') { ?><a href="javascript:goApplyModify('<?=$appList->PRJ_IDX?>');">수정</span><? } ?></td>
											
										</tr>
										</tbody>
										</table>
										
										<? } ?>
										<!--tr>
											<th scope="row" class="last">비밀번호 관리</th>
											<td colspan="3" class="last"><a href="#"><img src="<?=$FRONT_IMG_URL?>/img/board/btn_change.gif" alt="변경" /></a></td>
										</tr-->
									  
								<span class="btm-line"></span>
							</div>
