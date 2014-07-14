<script>
	
	function passwordReset()
	{
		$("#form1").attr("action","/admin/stepManagement/applyPasswordResetProcess");
		$("#form1").attr("method","post");
		$("#form1").submit();
	}
	
	
</script>

<h2 class="H2blt">패스워드 초기화</h2>
<form id="form1" name="form1" >
<input type="hidden" id="PRJ_IDX" name="PRJ_IDX" value="<?=$PRJ_IDX?>" />
<input type="hidden" id="APPL_IDX" name="APPL_IDX" value="<?=$APPL_IDX?>" />
비밀번호 : <input type="text" id="PASSWORD" name="PASSWORD" />
<span class="btn04"><a href="javascript:passwordReset();">비번변경 적용</a></span>
</form>