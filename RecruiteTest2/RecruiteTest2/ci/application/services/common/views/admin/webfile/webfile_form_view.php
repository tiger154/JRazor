<link rel="stylesheet" type="text/css" href="/assets/css/jqueryui.css" />
<script language="javascript" src="/assets/js/jquery.validate.js"></script>
<script type="text/javascript" src="/assets/js/jquery-ui.js" charset="utf-8"></script>
<script>
	
	$(document).ready(function(){
		
				$("#form1").validate({  
			
		    rules: {  			
		        FILE_NM: { required:true }
		    },  
		    onkeyup:false,
		    messages: {
		    		FILE_NM:{required : "파일을 등록하세요."}
		    },
		   
		    submitHandler: function(form) { 

		    	form.submit();

		    }
   	});  
   	
	});
	
	function processForm()
	{
	
		
		$("#ACT_FLAG").val('insert');
		$("#RETURN_URL").val('/admin/webFileManagement/');
		$("#form1").attr("action","/admin/webFileManagement/Process");
		$("#form1").attr("method","post");
		$("#submit_button").click();
		
	}
	
	function bodyOnLoad()
	{
		
	}
	
</script>

<form name="form1" id="form1" enctype="multipart/form-data" method="post"  action="/admin/popupManagement/Process">
<input type="hidden" id="ACT_FLAG" name="ACT_FLAG" />
<input type="hidden" id="RETURN_URL" name="RETURN_URL" />

<input type="hidden" id="WEBIDX" name="WEBIDX" value="<?=$WEBIDX?>" />
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
									<label for="w01">파일</label>
								</th>
								<td>
									<input type="file" name="FILE_NM" id="FILE_NM" title="기업 명"  style="width:48%;" />
									<label class="error" for="FILE_NM" generated="true" style="display:none;color:red;">error message</label>
								</td>
							</tr>
							
						</tbody>
					</table>		
					
					<!--// E: 작성 -->
					
					<input type="submit" id="submit_button" style="display:none">
					<div class="txtC">
						<span class="btn01"><a href="javascript:processForm();">확인</a></span>
					
						<span class="btn02"><a href="javascript:goLink('/admin/webFileManagement')">돌아가기</a></span>
					
					</div>
	</form>			