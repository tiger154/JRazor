<script type="text/javascript" src="/editor/se/js/HuskyEZCreator.js" charset="utf-8"></script>
<script>
	
	var oEditors = [];
	
	function bodyOnLoad()
	{
		
	}
	
	function pasteGubun(code)
	{
	//	oEditors.getById["FRM_CNTNT"].exec("UPDATE_CONTENTS_FIELD", []);
	oEditors.getById["FRM_CNTNT"].exec("PASTE_HTML", ['[$' + code + ']']);
	}
	
	function processForm()
	{
		oEditors.getById["FRM_CNTNT"].exec("UPDATE_CONTENTS_FIELD", []);
		
		$("#form1").attr("action","/admin/stepManagement/dataFormProcess");
		$("#form1").submit();
	}
	
</script>
<form name="form1" id="form1" method="post">
	<input type="hidden" name="FRM_CNTNT_FOR_DATA" id="FRM_CNTNT_FOR_DATA" value="<?=$FRM_CNTNT?>" />	
	<input type="hidden" name="PRJ_IDX" id="PRJ_IDX" value="<?=$PRJ_IDX?>" />
	<input type="hidden" name="STEP_IDX" id="STEP_IDX" value="<?=$STEP_IDX?>" />
	<input type="hidden" name="GUBUN" id="GUBUN" value="<?=$GUBUN?>" />
	<input type="hidden" name="FORM_ID" id="FORM_ID" value="<?=$FORM_ID?>" />
<table class="BdView-Type01" summary="�Խù� ����, ��ȣ, �ۼ���, �����, ��ȸ��, ÷������ �� ������ �� �� �ֽ��ϴ�.">

	

						<caption>�Խñ� �󼼺���</caption>
					
						<tbody>
							<tr>
								<td>
								
								<font color=red>
								* ���ε��� ������ �׸���Դϴ�. 
								<br>
								* �Ʒ� �׸��� Ŭ���Ͻø� �ش����... ����� ���� ������ �����ؼ� �ּ���.-_-;;;
								</font>
								<table>
								<tbody>
								<tr>
								<?
								
									foreach ($ETCVARLIST as $key => $resData)
									{
										echo '<td><span class="btn04"><a href="javascript:pasteGubun(\'' . $resData . '\');">' . $resData . '</a></span></td>';
									}
								?>
								</tr>
								
								</tbody>
								</table>
								<br>
								<textarea id="FRM_CNTNT" name="FRM_CNTNT" rows="1" cols="1" style="width:100%;height:300px; display:none;"  ></textarea>
									
									<script type="text/javascript">
									 
									 nhn.husky.EZCreator.createInIFrame({
									 oAppRef: oEditors,
									 elPlaceHolder: "FRM_CNTNT",
									 sSkinURI: "/editor/se/SmartEditor2Skin.html",
										htParams : {
										 		bUseToolbar : true,
										 		fOnBeforeUnload : function(){}
										 },
									 fCreator: "createSEditor2",
									 fOnAppLoad : function(){
											oEditors.getById["FRM_CNTNT"].exec("PASTE_HTML", [$("#FRM_CNTNT_FOR_DATA").val()]);
									 }
									 });
									</script>	
									
								</td>
							</tr>
							</tbody>
					</table>			
	<div class="txtC">
				<span class="btn01"><a href="javascript:processForm();">����ϱ�</a></span>
				<span class="btn02"><a href="javascript:window.close();">�ݱ�</a></span>
			</div>
		</form>