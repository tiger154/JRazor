
<script>
	
	function goModify()
	{
		$("#ACT_FLAG").val('modify');
		$("#form1").attr('method','post');
		$("#form1").attr('action','/admin/popupManagement/Form');
		$("#form1").submit();
	}
	
</script>

<form name="form1" id="form1">
<input type="hidden" id="ACT_FLAG" name="ACT_FLAG" />
<input type="hidden" id="RETURN_URL" name="RETURN_URL" />
<input type="hidden" id="POP_IDX" name="POP_IDX" value="<?=$POP_IDX?>" />
					<!-- S: 작성 -->
					<table class="BdView-Type01" summary="게시물 제목, 번호, 작성자, 등록일, 조회수, 첨부파일 및 내용을 볼 수 있습니다.">
						<caption>게시글 상세보기</caption>
						<colgroup>
							<col width="50px" />
							<col width="50px" />
							<col width="50px" />
							<col width="*" />
						</colgroup>
						
						<tbody>
							<tr>
								<th scope="row" colspan="3">
									<span class="item">*</span>
									<label for="w01">제목</label>
								</th>
								<td>
									<?=$POPUP_TITLE?>
								</td>
							</tr>
							<tr>
								<th scope="row" colspan="3">
									<span class="item">*</span>
									<label for="w01">크기</label>
								</th>
								<td>
									<?=$POP_WIDTH?> x <?=$POP_HEIGHT?>
								</td>
							</tr>
							<tr>
								<th scope="row" colspan="3">
									<span class="item">*</span>
									<label for="w02">오픈기간</label>
								</th>
								<td>
									<?=$OPN_STDT1?>
									<?=$OPN_STDT2?>시
									<?=$OPN_STDT3?>분
									 ~ 
									<?=$OPN_EDDT1?>
									<?=$OPN_EDDT2?>시
									<?=$OPN_EDDT3?>분
									
								</td>
							</tr>
							<tr>
								<th scope="row" colspan="3">
									<span class="item">*</span>
									<label for="w01">타입</label>
								</th>
								<td>
									<?=$VIEW_TP == 'W' ? '새창' : '레이어'?>
								</td>
							</tr>
							<tr>
								<th scope="row" colspan="3">
									<span class="item">*</span>
									<label for="w03">내용</label>
								</th>
								<td>
									<?=$CNTNT?>
									</script>
								</td>
							</tr>
							<tr>
								<th scope="row" colspan="3">
									<span class="item">*</span>
									<label for="w04a">사용여부</label>
								</th>
								<td>
								<?=$USE_YN == 'Y' ? ' 사용 ' : '  미사용 ' ?> 
								</td>
							</tr>
							
						</tbody>
					</table>		
					
					<!--// E: 작성 -->
					
					<div class="txtC">
						<span class="btn01"><a href="javascript:goModify();">수정</a></span>
					
						<span class="btn02"><a href="javascript:goLink('/admin/popupManagement')">돌아가기</a></span>
					
					</div>
	</form>			