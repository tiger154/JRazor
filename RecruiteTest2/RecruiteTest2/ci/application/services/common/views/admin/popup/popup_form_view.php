<link rel="stylesheet" type="text/css" href="/assets/css/jqueryui.css" />
<script language="javascript" src="/assets/js/jquery.validate.js"></script>
<script type="text/javascript" src="/editor/se/js/HuskyEZCreator.js" charset="utf-8"></script>
<script type="text/javascript" src="/assets/js/jquery-ui.js" charset="utf-8"></script>
<script>
	
	var oEditors = [];
	
	$(document).ready(function(){
		
				$("#form1").validate({  
				groups: {
						OPN_DT: "OPN_STDT1 OPN_STDT2 OPN_STDT3 OPN_EDDT1 OPN_EDDT2 OPN_EDDT3",
						POP_SIZE : "POP_WIDTH POP_HEIGHT"
					},
		    rules: {  			
		        POPUP_TITLE: { required:true },
	        		OPN_STDT1: { required:true },
	        		OPN_STDT2: { required:true,digits:true,min:1,max:23},
	        		OPN_STDT3: { required:true,digits:true,min:1,max:59},
	        		OPN_EDDT1: { required:true },
	        		OPN_EDDT2: { required:true,digits:true,min:1,max:23},
	        		OPN_EDDT3: { required:true,digits:true,min:1,max:59},
	        		POP_WIDTH: { required:true,digits:true,min:100,max:1000},
	        		POP_HEIGHT: { required:true,digits:true,min:100,max:1000}
		    },  
		    onkeyup:false,
		    messages: {
		    		POPUP_TITLE:{required : "�˾�ü���� �Է��ϼ���."},  
		    			OPN_STDT1:{required : "�Ⱓ�� Ȯ���ϼ���."},
		    			OPN_STDT2:{required : "�Ⱓ�� Ȯ���ϼ���.",digits:"���ڸ� �Է°����մϴ�.",min:"�ð��� 1���� 23���� �Է°����մϴ�.",max:"�ð��� 1���� 23���� �Է°����մϴ�."},
		    			OPN_STDT3:{required : "�Ⱓ�� Ȯ���ϼ���.",digits:"���ڸ� �Է°����մϴ�.",min:"���� 1���� 59���� �Է°����մϴ�.",max:"�ð��� 1���� 59���� �Է°����մϴ�."},
		    			OPN_EDDT1:{required : "�Ⱓ�� Ȯ���ϼ���."},
		    			OPN_EDDT2:{required : "�Ⱓ�� Ȯ���ϼ���.",digits:"���ڸ� �Է°����մϴ�.",min:"�ð��� 1���� 23���� �Է°����մϴ�.",max:"�ð��� 1���� 23���� �Է°����մϴ�."},
		    			OPN_EDDT3:{required : "�Ⱓ�� Ȯ���ϼ���.",digits:"���ڸ� �Է°����մϴ�.",min:"���� 1���� 59���� �Է°����մϴ�.",max:"�ð��� 1���� 59���� �Է°����մϴ�."},
		    			POP_WIDTH:{required : "ũ�⸦ �Է��ϼ���[����]",digits:"���ڸ� �Է°����մϴ�.",min:"ũ��� 100���� 1000�����Դϴ�.",max:"ũ��� 100���� 1000�����Դϴ�."},
		    			POP_HEIGHT:{required : "ũ�⸦ �Է��ϼ���[����]",digits:"���ڸ� �Է°����մϴ�.",min:"ũ��� 100���� 1000�����Դϴ�.",max:"ũ��� 100���� 1000�����Դϴ�."}
		    },
		   
		    submitHandler: function(form) { 

		    	form.submit();

		    }
   	});  
   	
	});
	
	function processForm()
	{
	
		oEditors.getById["CNTNT"].exec("UPDATE_CONTENTS_FIELD", []);
		$("#ACT_FLAG").val('insert');
		$("#RETURN_URL").val('/admin/popupManagement/');
		$("#form1").attr("action","/admin/popupManagement/Process");
		$("#form1").attr("method","post");
		$("#submit_button").click();
		
	}
	
	function bodyOnLoad()
	{
		$("#OPN_STDT1").datepicker({dateFormat:'yy-mm-dd'});
		$("#OPN_EDDT1").datepicker({dateFormat:'yy-mm-dd'});
	}
	
</script>

<form name="form1" id="form1" method="post" action="/admin/popupManagement/Process">
<input type="hidden" id="ACT_FLAG" name="ACT_FLAG" />
<input type="hidden" id="RETURN_URL" name="RETURN_URL" />
<input type="hidden" id="CNTNT_FOR_CONTENT" name="CNTNT_FOR_CONTENT" value="<?=$CNTNT?>" />
<input type="hidden" id="POP_IDX" name="POP_IDX" value="<?=$POP_IDX?>" />
					<!-- S: �ۼ� -->
					<table class="BdView-Type01" summary="�Խù� ����, ��ȣ, �ۼ���, �����, ��ȸ��, ÷������ �� ������ �� �� �ֽ��ϴ�.">
						<caption>�Խñ� �󼼺���</caption>
						<colgroup>
							<col width="50px" />
							<col width="50px" />
							<col width="50px" />
							<col width="*" />
						</colgroup>
						
						<tbody>
							<tr>
								<th scope="row" colspan="3">
									<span class="item">*</span>
									<label for="w01">����</label>
								</th>
								<td>
									<input type="text" name="POPUP_TITLE" id="POPUP_TITLE" title="��� ��" value="<?=$POPUP_TITLE?>" style="width:48%;" />
									<label class="error" for="POPUP_TITLE" generated="true" style="display:none;color:red;">error message</label>
								</td>
							</tr>
							<tr>
								<th scope="row" colspan="3">
									<span class="item">*</span>
									<label for="w01">ũ��</label>
								</th>
								<td>
									����<input type="text" name="POP_WIDTH" id="POP_WIDTH"  value="<?=$POP_WIDTH?>" style="width:40px" maxlength="4" /> px
									,   
									����<input type="text" name="POP_HEIGHT" id="POP_HEIGHT"  value="<?=$POP_HEIGHT?>" style="width:40px" maxlength="4" /> px
									<label class="error" for="POP_SIZE" generated="true" style="display:none;color:red;">error message</label>
								</td>
							</tr>
							<tr>
								<th scope="row" colspan="3">
									<span class="item">*</span>
									<label for="w02">���±Ⱓ</label>
								</th>
								<td>
									<input type="text" name="OPN_STDT1" id="OPN_STDT1" title="" style="width:62px;" value="<?=$OPN_STDT1?>" readonly />
									<input type="text" name="OPN_STDT2" id="OPN_STDT2" title="" style="width:20px;" maxlength="2" value="<?=$OPN_STDT2?>"  />��
									<input type="text" name="OPN_STDT3" id="OPN_STDT3" title="" style="width:20px;" maxlength="2" value="<?=$OPN_STDT3?>"  />��
									 ~ 
									<input type="text" name="OPN_EDDT1" id="OPN_EDDT1" title="" style="width:62px;" value="<?=$OPN_EDDT1?>" readonly />
									<input type="text" name="OPN_EDDT2" id="OPN_EDDT2" title="" style="width:20px;" maxlength="2" value="<?=$OPN_EDDT2?>"  />��
									<input type="text" name="OPN_EDDT3" id="OPN_EDDT3" title="" style="width:20px;" maxlength="2" value="<?=$OPN_EDDT3?>"  />��
									
									<label class="error" for="OPN_DT" generated="true" style="display:none;color:red;">error message</label>
								
								</td>
							</tr>
							<tr>
								<th scope="row" colspan="3">
									<span class="item">*</span>
									<label for="w04a">Ÿ��</label>
								</th>
								<td>
								<input type="radio" class="radio" id="VIEW_TP1" name="VIEW_TP" value="W" <?=$VIEW_TP == 'W' ? ' checked ' : '' ?>  />��â &nbsp; 
								<input type="radio" class="radio" id="VIEW_TP2" name="VIEW_TP" value="L" <?=$VIEW_TP == 'L' ? ' checked ' : '' ?>  />���̾�  
								</td>
							</tr>
							<tr>
								<th scope="row" colspan="3">
									<span class="item">*</span>
									<label for="w03">����</label>
								</th>
								<td>
									<textarea id="CNTNT" name="CNTNT" rows="1" cols="1" style="width:766px; height:312px; display:none;" title="������ �Է�"></textarea>
									<script type="text/javascript">
									 
									 nhn.husky.EZCreator.createInIFrame({
									 oAppRef: oEditors,
									 elPlaceHolder: "CNTNT",
									 htParams : {
									 		bUseToolbar : true,
									 		fOnBeforeUnload : function(){ 
                     		//alert("onbeforeunload call"); 
		                }
									 },
									 sSkinURI: "/editor/se/SmartEditor2Skin.html",
									 fCreator: "createSEditor2",
									 fOnAppLoad : function(){
											oEditors.getById["CNTNT"].exec("PASTE_HTML", [$("#CNTNT_FOR_CONTENT").val()]);
									 }
									 });
									</script>
								</td>
							</tr>
							<tr>
								<th scope="row" colspan="3">
									<span class="item">*</span>
									<label for="w04a">��뿩��</label>
								</th>
								<td>
								<input type="radio" class="radio" id="USE_YN1" name="USE_YN" value="Y" <?=$USE_YN == 'Y' ? ' checked ' : '' ?>  />��� &nbsp; 
								<input type="radio" class="radio" id="USE_YN2" name="USE_YN" value="N" <?=$USE_YN == 'N' ? ' checked ' : '' ?>  />�̻�� 
								</td>
							</tr>
							
						</tbody>
					</table>		
					
					<!--// E: �ۼ� -->
					
					<input type="submit" id="submit_button" style="display:none">
					<div class="txtC">
						<span class="btn01"><a href="javascript:processForm();">Ȯ��</a></span>
					
						<span class="btn02"><a href="javascript:goLink('/admin/popupManagement')">���ư���</a></span>
					
					</div>
	</form>			