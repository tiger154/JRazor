
<table class="BdView-Type01" summary="게시물 제목, 번호, 작성자, 등록일, 조회수, 첨부파일 및 내용을 볼 수 있습니다.">
	<script>
		
		function bodyOnload()
		{
			
			
		}
		
		function processForm()
		{
			if ($("#EX_FILE_UPLOAD").val() == '')
			{
				alert('파일을 선택하세요.');
			}
			else
			{
				$("#SUBMIT_BUTTON").click();
			}
		}
		
	</script>
	
	<form name="form1" id="form1" enctype="multipart/form-data" method="post" action="/admin/stepManagement/dataUploadProcess">
	<input type="hidden" name="PRJ_IDX" id="PRJ_IDX" value="<?=$PRJ_IDX?>">
	<input type="hidden" name="STEP_IDX" id="STEP_IDX" value="<?=$STEP_IDX?>">
						<caption></caption>
						<colgroup>
							<col width="10px" />
							<col width="105px" />
							<col width="10px" />
							<col width="*" />
						</colgroup>
						<tbody>
							<tr>
								<th scope="row" colspan="3">
									<label for="w01">엑셀파일</label>
								</th>
								<td><input type="file" name="EX_FILE_UPLOAD" id="EX_FILE_UPLOAD" style="width:98%;"></td>
							</tr>
							</tbody>
					</table>			
	<div class="txtC">
				<span class="btn01"><a href="javascript:processForm();">등록하기</a></span>
				<span class="btn02"><a href="javascript:window.close();">닫기</a></span>
				<input type="submit" id="SUBMIT_BUTTON" style="display:none" />
			</div>
		</form>