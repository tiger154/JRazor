<!-- S: 작성 -->
<script language="javascript" src="/assets/js/jquery.validate.js"></script>
<script>

	function bodyOnLoad()
	{

		$("#form1").validate({  
					groups:{COLROW:"COL_SIZE ROW_SIZE"},
			    rules: {  
			      COL_SIZE:{required:true,digits:true},
			      ROW_SIZE:{required:true,digits:true},
			      EXCEL_FILE:{required:true}
			    },  
			    onkeyup:false,
			    messages: {
			    		COL_SIZE:{required:"행열구분을 입력하세요.",
			    							digits:"숫자만 입력하세요"},
			    		ROW_SIZE:{required:"행열구분을 입력하세요.",
			    							digits:"숫자만 입력하세요"},
							EXCEL_FILE:{required:"파일을 업로드하세요"}
			    }
	   	});  
	   	
	 }
	 
	function goList()
	{
			$("#P_PRJ_IDX").val($("#PRJ_IDX").val());
			goLink('','pop','width=950 height=500 resizable=yes scrollbars=yes status=yes');
			$("#form2").attr('target','open_pops');
			$("#form2").attr("action","/admin/reportService/reportList");
			$("#form2").attr("method","post");
			$("#form2").submit();
			
	}
	 
	function goProcess()
	{
		$("#form1").attr("action","/admin/reportService/reportProcess");
		$("#form1").attr("method","post");
		$("#form1").submit();
	}
	
</script>
<form id="form2" name="form2" >
<input type="hidden" id="MENU_FLAG" name="MENU_FLAG" value="list" />
<input type="hidden" id="P_PRJ_IDX" name="P_PRJ_IDX" />
</form>
				<form id="form1" name="form1" enctype="multipart/form-data">
					<p class="txtR F11 mgb5"><span class="orange ">*</span> 필수 선택 값</p>
					<table class="BdView-Type01" summary="게시물 제목, 번호, 작성자, 등록일, 조회수, 첨부파일 및 내용을 볼 수 있습니다.">
						<caption>게시글 상세보기</caption>
						<colgroup>
							<col width="180px" />
							<col width="*" />
						</colgroup>
						<tbody>
							<tr>
								<th scope="row">
									<label for="w01"><span class="item">*</span>프로젝트 구분</label>
								</th>
								<td>
									<?=$SELECTBOX_PRJ_IDX?>
									<p class="F11 mgt5 orange">※ 명부 출력 연동을 위한 프로젝트를 선택하여 주세요.</p>
								</td>
							</tr>
							<tr>
								<th scope="row">
									<label for="w02a"><span class="item">*</span>행 x 열 구분</label>
								</th>
								<td>
									<input type="text" name="COL_SIZE" id="COL_SIZE" title="행 입력" style="width:25px;" maxlength="2" /> x
									<input type="text" name="ROW_SIZE" id="ROW_SIZE" title="열 입력" style="width:25px;" maxlength="2" />
									<label class="error" for="COLROW" generated="true" style="display:none;color:red;">error message</label>	
								</td>
							</tr>
							<tr>
								<th scope="row">
									<label for="w03a"><span class="item">*</span>정렬 기준</label>
								</th>
								<td>
									<?=$SELECTBOX_SORT_TP?>
									<input id="REVERSE_YN" name="REVERSE_YN" class="checkbox" type="checkbox" value="Y" />
									<label for="w03b" class="F11">역순 필요 시 체크하세요.</label>
								</td>
							</tr>
							<tr>
								<th scope="row">
									<label for="w04a"><span class="item">*</span>구성 항목</label>
								</th>
								<td>
									<div class="mgb10">
										<input id="PHOTO_YN" name="PHOTO_YN" class="checkbox" type="checkbox" value="Y" />
										<label for="w04a" class="F11">사진</label>
									</div>
									1. <?=$SELECTBOX_DISPLAY_TP1?> &nbsp;
									2. <?=$SELECTBOX_DISPLAY_TP2?> &nbsp;
									3. <?=$SELECTBOX_DISPLAY_TP3?> &nbsp;
								</td>
							</tr>
							<tr>
								<th scope="row">
									<label for="w05a"><span class="item">*</span>명부 파일 업로드</label>
								</th>
								<td>
									<input type="file" name="EXCEL_FILE" id="EXCEL_FILE" title="명부 파일 업로드" style="width:300px;" /> 엑셀파일만 업로드 됩니다.
									<label class="error" for="EXCEL_FILE" generated="true" style="display:none;color:red;">error message</label>	
								</td>
							</tr>
						</tbody>
					</table>
					<!--// E: 작성 -->

					<p class="orange mgb15">※ 업로드를 하시면 기존에 업로드된 대상자는 삭제되고 새로 등록됩니다.</p>
					<p class="orange mgb15">※ 명부 파일 샘플 DOWN (최대 400명 까지 명부 출력이 가능합니다.)</p>

					<div class="txtC">
						<span class="btn01"><a href="javascript:goList();">명부 데이터</a></span>
						<span class="btn01"><a href="javascript:goProcess();">등록</a></span>
					</div>
					</form>