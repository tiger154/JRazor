<script>
	function bodyOnLoad()
	{
		$("#form1").attr("action","<?=$redirect_url?>");
		$("#form1").attr("method","post");
		$("#form1").submit();
	}
</script>
<form id="form1" name="form1">
<input type="hidden" name="PRJ_IDX" id="PRJ_IDX" value="<?=$PRJ_IDX?>"/>
<input type="hidden" name="RECV_DI" id="RECV_DI" value="<?=$RECV_DI?>"/>
</form>
