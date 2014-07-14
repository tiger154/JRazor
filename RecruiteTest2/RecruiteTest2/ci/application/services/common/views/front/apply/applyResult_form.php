<script>
	
	function bodyOnLoad()
	{
		$("#form1").attr("action","/front/apply/applyResult");
		$("#form1").attr("method","post");
		$("#form1").submit();
	}
	
</script>
<form id="form1" name="form1">

<input type="hidden" id="PRJ_IDX" name="PRJ_IDX" value="<?=$PRJ_IDX?>" />
<input type="hidden" id="NAMEKOR" name="NAMEKOR" value="<?=$NAMEKOR?>" />
<input type="hidden" id="APPLY_NO" name="APPLY_NO" value="<?=$APPLY_NO?>" />
<input type="hidden" id="COMP_NM" name="COMP_NM" value="<?=$COMP_NM?>" />
<input type="hidden" id="UNIT_NM" name="UNIT_NM" value="<?=$UNIT_NM?>" />
<input type="hidden" id="EMAIL" name="EMAIL" value="<?=$EMAIL?>" />
<input type="hidden" id="HTEL" name="HTEL" value="<?=$HTEL?>" />
<input type="hidden" id="result_error_msg" name="result_error_msg" value="<?=$result_error_msg?>" />
</form>