<!-- S: 작성 -->
<script language="javascript" src="/assets/js/jquery.autoheight.js"></script>

<script>
	
	function bodyOnLoad()
	{
    $("<iframe scrolling='no' />").attr("src", "/admin/projectManagement/projectViewForContent?project_id=<?=$PRJ_IDX?>&DISPLAY_CODE=SUMMARY").attr("frameborder", 0).attr("width", "100%").attr("height", "0px").appendTo("#iframe-container1");
    $('iframe').iframeAutoHeight({heightOffset: 40});    
    $("<iframe scrolling='no' />").attr("src", "/admin/projectManagement/projectViewForContent?project_id=<?=$PRJ_IDX?>&DISPLAY_CODE=CNTNT").attr("frameborder", 0).attr("width", "100%").attr("height", "0px").appendTo("#iframe-container2");
    $('iframe').iframeAutoHeight({heightOffset: 40});    
	}
	
	function moveApply(code)
	{
		$("#STEP_IDX").val(code);
		$("#form1").attr("action","/admin/stepManagement/applyList");
		$("#form1").attr("method","post");
		$("#form1").submit();
	}
	
</script>
<form name="form1" id="form1">
<input type="hidden" name="PRJ_IDX" id="PRJ_IDX" value="<?=$PRJ_IDX?>" />
<input type="hidden" name="STEP_IDX" id="STEP_IDX" />
</form>

<table id="BdList-Type01" class="mgb30" summary="목록">
						<caption>목록</caption>
						<colgroup>
							<?
							foreach ($stepData as $key => $sData)
							{
							?>
								<col width="*" />
							<? 
							}
							?>
							
						</colgroup>
						<thead>
							<tr>
							<?
							foreach ($stepData as $key => $sData)
							{
							?>
								<th scope="col" class="first"><a href="javascript:moveApply(<?=$sData->STEP_IDX?>);"><?=$sData->STEP_NM?></a></th>
							<? 
							}
							?>
							</tr>
						</thead>
						<tbody>
							<tr>
							<?
							foreach ($stepData as $key => $sData)
							{
							?>
								<td><a href="javascript:moveApply(<?=$sData->STEP_IDX?>);"><?=number_format($sData->CNT)?> 명</a></td>
							<? 
							}
							?>
							</tr>
						</tbody>
					</table>

					<table class="BdView-Type01" summary="게시물 제목, 번호, 작성자, 등록일, 조회수, 첨부파일 및 내용을 볼 수 있습니다.">
						<caption>게시글 상세보기</caption>
						<colgroup>
							<col width="110px" />
							<col width="105px" />
							<col width="110px" />
							<col width="*" />
						</colgroup>
						<tbody>
							<tr>
								<th scope="row" colspan="3">프로젝트 명</th>
								<td>
									<?=$PRJ_NM?>
									<span class="btn04 mgl5"><a target="_blank" href="http://<?=$DOMAIN_ID?>.<?=MAIN_SERVICE_DOMAIN?>">사용자 페이지 채용 공고 확인하기</a></span>
								</td>
							</tr>
							<tr>
								<th scope="row" colspan="3">프로젝트 설명 요약</th>
								<td><div id="iframe-container1"  ></div></td>
							</tr>
							<tr>
								<th scope="row" colspan="3">공고 게시 기간</th>
								<td><?=$PRJ_STDT1?> <?=$PRJ_STDT2?>:<?=$PRJ_STDT3?> ~ <?=$PRJ_EDDT1?> <?=$PRJ_EDDT2?>:<?=$PRJ_EDDT3?></td>
							</tr>
							<tr>
								<th scope="row" colspan="3">프로젝트 상태</th>
								<td><?=$PRJ_STS == 'C' ? '닫힘' : '열림'?></td>
							</tr>
							<tr>
								<th scope="row" colspan="3">공고내용</th>
								<td><div id="iframe-container2"  ></div></td>
							</tr>
							<tr>
								<th scope="row" colspan="3">지원항목관리</th>
								<td>
									
							
									<table  id="BdList-Type01" class="mgb30">
									<colgroup>
										<col width="*" />
										<col width="*" />
										<col width="*" />
										<col width="*" />
										<col width="*" />
									</colgroup>
								
									<thead>
									<tr>
										<th scope="col">개인신상정보</th>
										<th scope="col">가족사항</th>
										<th scope="col">학력사항</th>
										<th scope="col">경력사항</th>
										<th scope="col">어학시험항목</th>
									</tr>
									</thead>
									<tbody>
										<tr>
											<td><?=$PERSONAL_USE_YN?></td>
											<td><?=$FAMILY_USE_YN?></td>
											<td><?=$SCHOOL_USE_YN?></td>
											<td><?=$CAREER_USE_YN?></td>
											<td><?=$LANGUAGE_USE_YN?></td>
										</tr>
									</tbody>
								
									<thead>
									<tr>
										<th scope="col">자격증항목</th>
										<th scope="col">군대사항</th>
										<th scope="col">해외경험사항</th>
										<th scope="col">봉사활동사항</th>
										<th scope="col">수상경력</th>
									</tr>
									</thead>
									<tbody>
										<tr>
											<td><?=$LICENSE_USE_YN?></td>
											<td><?=$ARMY_USE_YN?></td>
											<td><?=$TRAINING_USE_YN?></td>
											<td><?=$SERVE_USE_YN?></td>
											<td><?=$PRIZE_USE_YN?></td>
										</tr>
									</tbody>
									
									<thead>
									<tr>
										<th scope="col">PC활용능력</th>
										<th scope="col">각종상세내용</th>
										<th scope="col">첨부파일</th>
										<th scope="col">교육사항</th>
										<th scope="col">보유기술</th>
									</tr>
									</thead>
									<tbody>
										<tr>
											<td><?=$PC_USE_YN?></td>
											<td><?=$CONTENT_USE_YN?></td>
											<td><?=$FILE_USE_YN?></td>
											<td><?=$EDUCATION_USE_YN?></td>
											<td><?=$TECH_USE_YN?></td>
										</tr>
									</tbody>
								
									<thead>
									<tr>
										<th scope="col">언어사항</th>
										<th scope="col">저술내용</th>
										<th scope="col"></th>
										<th scope="col"></th>
										<th scope="col"></th>
									</tr>
									</thead>
									<tbody>
										<tr>
											<td><?=$LANGUAGE2_USE_YN?></td>
											<td><?=$WRITE_USE_YN?></td>
											<td></td>
											<td></td>
											<td></td>
										</tr>
									</tbody>
									
									</table>
								</td>
							</tr>
						

						</tbody>
					</table>					
					<!--// E: 작성 -->

					<div class="txtC">
						<span class="btn01"><a href="javascript:goLink('/admin/projectManagement/projectModify?project_id=<?=$PRJ_IDX?>');">수정</a></span>
						<span class="btn02"><a href="javascript:goLink('/admin/projectManagement/projectList');">돌아가기</a></span>
					</div>