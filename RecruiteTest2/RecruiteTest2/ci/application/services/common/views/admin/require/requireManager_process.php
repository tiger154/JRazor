<script>
	function bodyOnLoad()
	{
		$("#form1").attr("action","/admin/requireManagement");
		$("#form1").attr("method","post");
		$("#form1").submit();
	}
</script>
<form name="form1" id="form1">
<input type="hidden" name="PRJ_IDX" id="PRJ_IDX" value="<?=$PRJ_IDX?>" />
<input type="hidden" name="RSM_IDX" id="RSM_IDX" value="<?=$RSM_IDX?>" />
<input type="hidden" name="UNIT_IDX" id="UNIT_IDX" value="<?=$UNIT_IDX?>" />
</form>