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
		$("#form1").attr("action","/admin/resumeComment/commentSubProcess");
		$("#form1").submit();
	}
	
	function bodyOnLoad()
	{
		if ($("#SEL_DFC_CD option:selected").val() != '' )
		{
			$("#CUSTOM_DFC_CD").val('');
			$("#CUSTOM_DFC_NM").val('');
		}
	}
	
	function selDfcCd()
	{
		$("#DFC_CD").val($("#SEL_DFC_CD option:selected").val());
		$("#DFC_NM").val($("#SEL_DFC_CD option:selected").text());
	}
	
</script>
<h2 class="H2blt"></h2>
<form id="form1" name="form11" >
기본 유의사항 항목 : <?=$SELECTBOX_SEL_DFC_CD?>
<br>

<br>코드명 : <input type="text" id="CUSTOM_DFC_CD" name="CUSTOM_DFC_CD" value="<?=$CUSTOM_DFC_CD?>" />
<br>항목명 : <input type="text" id="CUSTOM_DFC_NM" name="CUSTOM_DFC_NM" value="<?=$CUSTOM_DFC_NM?>" />

<input type="hidden" id="DFC_CD" name="DFC_CD" value="<?=$DFC_CD?>" />
<input type="hidden" id="DFC_NM" name="DFC_NM" value="<?=$DFC_NM?>" />

(본기능은 이력서에 새로운항목이 생겨서 별도 작업이 필요할때 사용합니다. - 개발자와 협의후 추가하세요.)
<input type="hidden" id="RSM_IDX" name="RSM_IDX" value="<?=$RSM_IDX?>" />
<input type="hidden" id="PRJ_IDX" name="PRJ_IDX" value="<?=$PRJ_IDX?>" />
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

					<div class="txtC">
						<span class="btn01"><a href="javascript:commentProcess();">확인</a></span>
						<span class="btn02"><a href="javascript:goLink('/admin/resumeComment/resumeSubList?project_id=<?=$PRJ_IDX?>')">돌아가기</a></span>
					</div>

</form>