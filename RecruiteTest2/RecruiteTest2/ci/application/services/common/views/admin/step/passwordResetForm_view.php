<script>
	
	function passwordReset()
	{
		$("#form1").attr("action","/admin/stepManagement/applyPasswordResetProcess");
		$("#form1").attr("method","post");
		$("#form1").submit();
	}
	
	
</script>

<h2 class="H2blt">�н����� �ʱ�ȭ</h2>
<form id="form1" name="form1" >
<input type="hidden" id="PRJ_IDX" name="PRJ_IDX" value="<?=$PRJ_IDX?>" />
<input type="hidden" id="APPL_IDX" name="APPL_IDX" value="<?=$APPL_IDX?>" />
��й�ȣ : <input type="text" id="PASSWORD" name="PASSWORD" />
<span class="btn04"><a href="javascript:passwordReset();">������� ����</a></span>
</form>