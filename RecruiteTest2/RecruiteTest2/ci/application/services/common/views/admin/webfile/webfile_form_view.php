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
		    		FILE_NM:{required : "������ ����ϼ���."}
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
					<!-- S: �ۼ� -->
					<table class="BdView-Type01" summary="�Խù� ����, ��ȣ, �ۼ���, �����, ��ȸ��, ÷������ �� ������ �� �� �ֽ��ϴ�.">
						<caption>�Խñ� �󼼺���</caption>
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
									<label for="w01">����</label>
								</th>
								<td>
									<input type="file" name="FILE_NM" id="FILE_NM" title="��� ��"  style="width:48%;" />
									<label class="error" for="FILE_NM" generated="true" style="display:none;color:red;">error message</label>
								</td>
							</tr>
							
						</tbody>
					</table>		
					
					<!--// E: �ۼ� -->
					
					<input type="submit" id="submit_button" style="display:none">
					<div class="txtC">
						<span class="btn01"><a href="javascript:processForm();">Ȯ��</a></span>
					
						<span class="btn02"><a href="javascript:goLink('/admin/webFileManagement')">���ư���</a></span>
					
					</div>
	</form>			