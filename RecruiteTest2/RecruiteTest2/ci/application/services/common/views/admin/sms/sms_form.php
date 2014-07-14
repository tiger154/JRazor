<script language="javascript" src="/assets/js/jquery.validate.js"></script>
<script>
	
	function bodyOnLoad()
	{
		
		getGubunList($("#SEL_GUBUN").val());
		
		$("#form1").validate({  
				groups:{
					SEND_TEL:"SEND_TEL1 SEND_TEL2 SEND_TEL3"
				},
		    rules: {  
		      SEND_TEL1:{required:true,digits:true,minlength:2,maxlength:3},
		      SEND_TEL2:{required:true,digits:true,minlength:3,maxlength:4},
		      SEND_TEL3:{required:true,digits:true,minlength:4,maxlength:4},
		      CNTNT:{required:true}
		    },  
		    onkeyup:false,
		    messages: {
		    		SEND_TEL1:{
		    				required:"������ ��� ����ó�� Ȯ���ϼ���.",
		    				digits:"���ڸ� �Է��ϼ���",
		    				minlength:"������ ��� ����ó�� Ȯ���ϼ���.",
		    				maxlength:"������ ��� ����ó�� Ȯ���ϼ���."},
		    		SEND_TEL2:{
		    				required:"������ ��� ����ó�� Ȯ���ϼ���.",
		    				digits:"���ڸ� �Է��ϼ���",
		    				minlength:"������ ��� ����ó�� Ȯ���ϼ���.",
		    				maxlength:"������ ��� ����ó�� Ȯ���ϼ���."},
		    		SEND_TEL3:{
		    				required:"������ ��� ����ó�� Ȯ���ϼ���.",
								digits:"���ڸ� �Է��ϼ���",
		    				minlength:"������ ��� ����ó�� Ȯ���ϼ���.",
		    				maxlength:"������ ��� ����ó�� Ȯ���ϼ���."},
						CNTNT:{required:"���� �޼��� ������ �Է��ϼ���."}
		    },
		    submitHandler: function(form) { 
				
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
	
	

</script>
<form name="form1" id="form1" method="post" action="/admin/smsManagement/smsProcess">
<input type="hidden" id="PRJ_IDX" name="PRJ_IDX" value="<?=$PRJ_IDX?>" />
<input type="hidden" id="SEL_GUBUN" name="SEL_GUBUN" value="<?=$GUBUN?>" />
<table class="BdView-Type01" summary="���� �߼�">
				<caption>���� �߼�</caption>
				<colgroup>
					<col width="145px" />
					<col width="*" />
				</colgroup>
				<tbody>
					<tr>
						<th scope="row">������Ʈ</th>
						<td>���� ������Ʈ��</td>
					</tr>
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
					<tr>
						<th scope="row"><label for="m02">������ ��� ����ó</label></th>
						<td>
								<input type="text" name="SEND_TEL1" id="SEND_TEL1" style="width:30px;" value="<?=$CMP_TEL1?>" maxlength="3" /> -
								<input type="text" name="SEND_TEL2" id="SEND_TEL2" style="width:40px;" value="<?=$CMP_TEL2?>" maxlength="4" /> -
								<input type="text" name="SEND_TEL3" id="SEND_TEL3" style="width:40px;" value="<?=$CMP_TEL3?>" maxlength="4" /> 
								<label class="error" for="SEND_TEL" generated="true" style="display:none;color:red;">error message</label>	
						</td>
					</tr>
					<tr>
						<th scope="row"><label for="m05">���� �޽��� ����</label></th>
						<td>
							<textarea id="CNTNT" name="CNTNT" rows="1" cols="1" style="width:260px;height:100px;" title="�����Է�" onclick="fncCheckByte('CNTNT', 'txtBytes_GoodsDesc', 80);" onKeyUp="fncCheckByte('CNTNT', 'txtBytes_GoodsDesc', 80);"></textarea>
							<label class="error" for="CNTNT" generated="true" style="display:none;color:red;">error message</label>	
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