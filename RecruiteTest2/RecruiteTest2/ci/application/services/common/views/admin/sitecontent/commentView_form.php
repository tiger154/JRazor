<!-- S: 작성 -->
<link rel="stylesheet" type="text/css" href="/assets/css/jqueryui.css" />
<script language="javascript" src="/assets/js/jquery.validate.js"></script>
<script type="text/javascript" src="/editor/se/js/HuskyEZCreator.js" charset="utf-8"></script>
<script type="text/javascript" src="/assets/js/jquery-ui.js" charset="utf-8"></script>
<script>

	var oEditors = [];
	
	function commentProcess()
	{

		oEditors.getById["DFC_CNTNT"].exec("UPDATE_CONTENTS_FIELD", []);
		$("#form1").attr("method","post");
		$("#form1").attr("action","/admin/siteContent/commentProcess");
		$("#form1").submit();
	}
	
</script>
<h2 class="H2blt"><?=$DFC_NM?></h2>
<form id="form1" name="form11" >
<input type="hidden" id="DFC_CD" name="DFC_CD" value="<?=$DFC_CD?>" />
<input type="hidden" id="DFC_CNTNT_FOR_CONTENT" name="DFC_CNTNT_FOR_CONTENT" value="<?=$DFC_CNTNT?>" />
<textarea id="DFC_CNTNT" name="DFC_CNTNT" rows="1" cols="1" style="width:100%; height:212px; display:none;" ></textarea>
<script type="text/javascript">
 
 nhn.husky.EZCreator.createInIFrame({
 oAppRef: oEditors,
 elPlaceHolder: "DFC_CNTNT",
 sSkinURI: "/editor/se/SmartEditor2Skin.html",
 htParams : {
 		bUseToolbar : true,
 		fOnBeforeUnload : function(){}
 },
 fCreator: "createSEditor2",
 fOnAppLoad : function(){
		oEditors.getById["DFC_CNTNT"].exec("PASTE_HTML", [$("#DFC_CNTNT_FOR_CONTENT").val()]);
 }
 });
</script>

<br><br>

					<div class="txtC">
						<span class="btn01"><a href="javascript:commentProcess();">확인</a></span>
						<span class="btn02"><a href="javascript:goLink('/admin/siteContent')">돌아가기</a></span>
					</div>

</form>