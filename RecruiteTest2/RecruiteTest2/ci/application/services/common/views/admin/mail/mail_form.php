<script type="text/javascript" src="/editor/se/js/HuskyEZCreator.js" charset="utf-8"></script>
<script language="javascript" src="/assets/js/jquery.validate.js"></script>
<script>
	var oEditors = [];
	function bodyOnLoad()
	{
		//alert($("#GUBUN_USED"));
		getGubunList($("#SEL_GUBUN").val());
		
		$("#form1").validate({  
				
		    rules: {  
		      
		      MAIL_TITLE:{required:true},
		      FRM_CNTNT:{required:true}
		    },  
		    onkeyup:false,
		    messages: {
		      	MAIL_TITLE:{required:"������ Ȯ���ϼ���."},
		      	FRM_CNTNT:{required:"������ Ȯ���ϼ���."}
		    },
		    submitHandler: function(form) { 
				
				oEditors.getById["FRM_CNTNT"].exec("UPDATE_CONTENTS_FIELD", []);
	    	form.submit();

	    	}
   	});  
		
		
	}
	
	function getCountList()
	{
		
		var PRJ_IDX = $("#PRJ_IDX").val();
		var STEP_IDX = $("#STEP_IDX option:selected").val();
		var UNIT_IDX = $("#UNIT_IDX option:selected").val();
		var GUBUN = $("#GUBUN option:selected").val();
		
		$.ajax({
	    url: "/admin/smsManagement/getCountList",
	    type: "post",
	    data: "PRJ_IDX=" + PRJ_IDX + "&STEP_IDX=" + STEP_IDX + "&UNIT_IDX=" + UNIT_IDX + "&GUBUN=" + GUBUN,
	    success: function(response, textStatus, jqXHR){
	       ///alert(response);
	       $("#showCount").html(response  + ' ��');
	       	
	    },
	    error: function(jqXHR, textStatus, errorThrown){
	        //console.log("The following error occured: "+textStatus, errorThrown);
	        ///alert(textStatus);
	        
	    },
	    // callback handler that will be called on completion
	    // which means, either on success or error
	    complete: function(){
	    	  // enable the inputs
	    }
			});
		
	}
	
	function getGubunList(obj)
	{
		
		var PRJ_IDX = $("#PRJ_IDX").val();
		var STEP_IDX = $("#STEP_IDX").val();
		
		$.ajax({
	    url: "/admin/smsManagement/getGubunList?PRJ_IDX=" + PRJ_IDX + "&STEP_IDX=" + STEP_IDX,
	    type: "get",
	    dataType:'json',
	    //data: serializedData,
	    success: function(response, textStatus, jqXHR){
	       
	       $("#GUBUN").empty();
	       $("#GUBUN").append('<option value="">��ǥ��</option>');	
	       
	       for (var a = 0 ; a < response.length ; a ++ )
	       {
	       	$("#GUBUN").append('<option value="' + response[a]['GUBUN_CODE'] + '">' + response[a]['GUBUN_NAME'] + '</option>');	
	       }
	       
	       if (obj.value != '')
	       {
	       	$("#GUBUN").val(obj);
	       }
	       
	       
	    },
	    error: function(jqXHR, textStatus, errorThrown){
	        //console.log("The following error occured: "+textStatus, errorThrown);
	        
	    },
	    // callback handler that will be called on completion
	    // which means, either on success or error
	    complete: function(){
	    	  // enable the inputs
	    	  getCountList();
	    }
			});
	}
	
	function goProcess()
	{
		$("#SUBMIT_BUTTON").click();
	}
	
	function pasteGubun(code)
	{
		$("#GUBUN_USED").val($("#GUBUN_USED").val() + '|' + code);
		oEditors.getById["FRM_CNTNT"].exec("PASTE_HTML", ['[$' + code + ']']);
	}

</script>
<form name="form1" id="form1" method="post" action="/admin/mailManagement/mailProcess">
<input type="hidden" id="GUBUN_USED" name="GUBUN_USED" />	
<input type="hidden" id="PRJ_IDX" name="PRJ_IDX" value="<?=$PRJ_IDX?>" />
<input type="hidden" id="SEL_GUBUN" name="SEL_GUBUN" value="<?=$GUBUN?>" />
	<input type="hidden" name="FRM_CNTNT_FOR_DATA" id="FRM_CNTNT_FOR_DATA" value="" />	
<table class="BdView-Type01" summary="���� �߼�">
				<caption>���� �߼�</caption>
				<colgroup>
					<col width="145px" />
					<col width="*" />
				</colgroup>
				<tbody>
					<tr>
						<th scope="row">
							<label for="m01a">���� �� �о�</label>
						</th>
						<td>
							<?=$SELECTBOX_UNIT_IDX?>
							<?=$SELECTBOX_STEP_IDX?>
							<select name="GUBUN" id="GUBUN" onchange="javascript:getCountList();">
								<option value="">��ǥ�� </option>
							</select>
						</td>
					</tr>
					<tr>
						<th scope="row">�߼� �����</th>
						<td><div id="showCount"></div></td>
					</tr>
					
					<!--tr>
						<th scope="row"><label for="m02">�߼��ڸ�</label></th>
						<td>
								<input type="text" name="SEND_NAME" id="SEND_NAME" value="<?=$COMP_NM?>" style="width:300px;" />
								<label class="error" for="SEND_NAME" generated="true" style="display:none;color:red;">error message</label>	
						</td>
					</tr-->
					
					<!--tr>
						<th scope="row">�߼��� �ּ�</th>
						<td>
								<input  type="text" id="SEND_MAIL" name="SEND_MAIL" value="<?=$EMAIL?>" />
								<label class="error" for="SEND_MAIL" generated="true" style="display:none;color:red;">error message</label>	
							</td>
					</tr-->
					
					<tr>
						<th scope="row"><label for="m02">��������</label></th>
						<td>
								<input type="text" name="MAIL_TITLE" id="MAIL_TITLE" style="width:300px;" />
								<label class="error" for="MAIL_TITLE" generated="true" style="display:none;color:red;">error message</label>	
						</td>
					</tr>
					<tr>
						<th scope="row"><label for="m05">���ϳ���</label></th>
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
						
							<textarea id="FRM_CNTNT" name="FRM_CNTNT" rows="1" cols="1" style="width:450px;height:300px; display:none;"  ></textarea>
									
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
			<p class="mgt-18 mgb10"><div id="txtBytes_GoodsDesc"></div></p>

			<input type="submit" id="SUBMIT_BUTTON" style="display:none;"/>
			<div class="txtC">
				<span class="btn01"><a href="javascript:goProcess();">�߼�</a></span>
				<span class="btn02"><a href="javascript:window.close();">�ݱ�</a></span>
			</div>
</form>