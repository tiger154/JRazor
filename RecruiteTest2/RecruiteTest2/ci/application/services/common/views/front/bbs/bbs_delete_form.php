<script type="text/javascript" src="/assets/js/jquery.validate.js"></script>
<style>
	
	/*=================================================================================
 	* Board View Type
	 =================================================================================*/
	.BdView-Type01 {
		width:100%;
		table-layout: fixed;
		border-top:1px solid #6f6f6f;
		margin:0 0 20px 0;
	}
	
	.BdView-Type01 caption {	display:none;}
	
	.BdView-Type01 thead tr th {
		color:#fff;
		background:#84a1bc;
		border-left:1px solid #dcdcdc;
		padding:9px 0 6px 0;
	}
	
	.BdView-Type01 thead tr th.first {
		border-left:none;
	}
	
	.BdView-Type01 tbody tr th {
		color:#4b4b4b;
		padding:9px 0 6px 0;
		border:1px solid #dcdcdc;
		border-top:0px;
		border-left:0px;
		text-align:left;
		background:#f6f6f6;
		text-indent:15px;
	}
	
	.BdView-Type01 tbody tr td {
		padding:9px 0 6px 10px;
		border-bottom:1px solid #dcdcdc;
		border-left:1px solid #dcdcdc;
	}
	
	.BdView-Type01 tbody tr td img {	vertical-align: middle;}
	
	.BdView-Type01 tbody tr th.bdLine {	border-left:1px solid #dcdcdc;}
	
	.BdView-Type01 tbody tr th.center {	text-align:center; text-indent:0px;}
	.BdView-Type01 tbody tr td.left {	text-align:left;}
	.BdView-Type01 tbody tr td.center {	text-align:center; padding:9px 0 6px 0;}
	
	.BdView-Type01 tbody tr.colorB th {	background:#e8eef4;}
	
	.BdView-Type01 tbody tr.colorB td {	background:#f1f7fd;}
	
	.item { color:#ff5400; margin:0 3px 0 0;}
	.tbLi li { margin:0 0 5px 0;}
	
</style>
<script>
	
	function bodyOnLoad()
	{
		$("#form1").validate({
			rules: {
				PASSWD:{required:true,minlength:4}
			},  
			onkeyup:false,
			messages: {
				PASSWD:{required:"비밀번호를 입력하세요",minlength:"비밀번호는 최소 4자리입니다."}
			},
			submitHandler: function(form) {
				form.submit();
		    }
	   	});
	}
	
	function processForm()
	{
		$("#form1").attr("action","/front/bbs/DeleteBbs");
		$("#form1").attr("method","post");
		$("#SUBMIT_BUTTON").click();
	}
	
	
</script>
<form id="form1" name="form1">
<input type="submit" id="SUBMIT_BUTTON" style="display:none;" />
<input type="hidden" id="PRJ_IDX" name="PRJ_IDX" value="<?=$PRJ_IDX?>" />
<input type="hidden" id="BBS_IDX" name="BBS_IDX" value="<?=$BBS_IDX?>" />
<input type="hidden" id="bbsType" name="bbsType" value="<?=$bbsType?>" />
<table class="BdView-Type01" >
<caption></caption>
<colgroup>
	<col width="95px" />
	<col width="*" />
</colgroup>
<tbody>
	<tr>
		<th scope="row">
			<label for="BBS_TITLE">비밀번호</label>
		</th>
		<td>
			<input type="password" id="PASSWD" name="PASSWD" />
			<label class="error" for="PASSWD" generated="true" style="display:none;color:red;">error message</label>
		</td>
	</tr>
</table>
<span class="btn05"><a href="javascript:processForm();">확인</a></span>

</form>