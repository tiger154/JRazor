<!-- S: 검색 -->
<script>
	
	function goNoPassConfirm(apply_no)
	{
		$("#APPLY_NO").val(apply_no);
		$("#form1").attr("target","blank");
		$("#form1").attr("method","post");
		$("#form1").attr("action","/front/pass");
		$("#form1").submit();
	}
	
</script>
<form id="form1" name="form1">
<input type="hidden" id="DOMAIN_ID" name="DOMAIN_ID" value="<?=$DOMAIN_ID?>" />
<input type="hidden" id="code" name="code" value="<?=$code?>" />
<input type="hidden" id="APPLY_NO" name="APPLY_NO" />
<input type="hidden" id="PRJ_IDX" name="PRJ_IDX" value="<?=$PRJ_IDX?>" />
<input type="hidden" id="STEP_IDX" name="STEP_IDX" value="<?=$STEP_IDX?>" />
</form>			
					<!-- E: 검색 -->

					<!-- S: 게시물리스트 -->
					<table id="BdList-Type01" summary="제목 링크를 통해서 게시물 상세 내용으로 이동합니다.">
						<caption>목록</caption>
						<colgroup>
							<col width="*" />
							<col width="*" />
			
							<? foreach ($titleList as $titleNm) echo '<col width="*" />'; ?>
							<col width="*" />
						</colgroup>
						<thead>
							<tr>
								<th scope="col" class="first">수험번호</th>
								<th scope="col">이름</th>
							
							<? foreach ($titleList as $titleNm) echo '<th scope="col">' . $titleNm . '</th>'; ?>
							<th scope="col">발표 결과</th>
							</tr>
						</thead>
						<tbody>
							<? 
							foreach ( $dataList as $key => $data){
	
							?>
							<tr>
								<td><?=$data->APPLY_NO?></td>
								<td><?=$data->APPLY_NM?></td>
								<? 
								foreach ($titleList as $key => $titleNm) 
								{
									echo '<td>' . $data->{'ETCDATA' . ($key + 1)} . '</td>'; 
								}
								?>
								<td><span class="btn04"><a href="javascript:goNoPassConfirm('<?=$data->APPLY_NO?>');">확인</a></span></td>
							</tr>
						<? 
							}
							
						 ?>
						
						</tbody>
					</table>
					<!--// E: 게시물리스트 -->

		</table>
				