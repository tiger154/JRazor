<script>
	
	function bodyOnLoad()
	{
		$("#form1").attr("action","/front/apply/applyView");
		$("#form1").attr("method","post");
		$("#form1").submit();
	}
	
</script>
<form name="form1" id="form1" >
<input type="hidden" id="PRJ_IDX" name="PRJ_IDX" value="<?=$PRJ_IDX?>" />
<input type="hidden" id="ADMIN_FLAG" name="ADMIN_FLAG" value="<?=$ADMIN_FLAG?>" />
<input type="hidden" id="APPLY_NO" name="APPLY_NO" value="<?=$APPLY_NO?>" />
</form>