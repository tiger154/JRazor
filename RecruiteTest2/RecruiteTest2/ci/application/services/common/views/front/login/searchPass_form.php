<script language="javascript" src="/assets/js/jquery.validate.js"></script>
<script>
	
	window.name ="Parent_window";
	
	function authLoginCheck()
	{
		$.ajax({
    url: "/front/login/UserAuthConfirmFlag",
    type: "get",
    dataType:'json',
    //data: serializedData,
    success: function(response, textStatus, jqXHR){
    	
    	if ( response.RECV_DI != '' )
    	{
     		$("#NAMECHECK").val('on');
     	}
     
    },
    error: function(jqXHR, textStatus, errorThrown){
        //console.log("The following error occured: "+textStatus, errorThrown);
        
    },
    // callback handler that will be called on completion
    // which means, either on success or error
    complete: function(){
    	
    	if ($("#PROJECT_LIST").val() == '')
    	{
    		alert('ä����� �����ϼ���');
    		return false;
    	}
    	
    	if ($("#PROJECT_LIST").val() != '' && $("#NAMECHECK").val() != '' )
    	{
	    	$("#form1").attr("method","post");
	    	$("#form1").attr("action","<?=SSL_LOGIN_DOMAIN?>/front/login/UserAuthSSLConfirmProcess");
	    	$("#form1").submit();
    	}
    	else
    	{
    		alert('����Ȯ���� �ϼž� �մϴ�.');
    	}
    	
    }
		});
	}
		
	
	function bodyOnLoad()
	{
		
		$("#form1").validate({  
				
		    rules: {
		    		PROJECT_LIST:{required:true}
		    },  
		  	onkeyup:false,
		    messages: {
		    		PROJECT_LIST:{required:"ä����� �����ϼ���"}
		    },
		    submitHandler: function(form) {
		    	
            if ($("#NAMECHECK").val() == '' )
            {
            	alert('���������� �ϼ���');
            	return false;
            }
            form.submit();
        }
   	});  
	}
	
	function fnPopup(){
		
		//alert($("#PROJECT_LIST option:selected").val());
		$("#param_r3").val($("#PROJECT_LIST option:selected").val());
		window.open('', 'popupChk', 'width=500, height=461, top=100, left=100, fullscreen=no, menubar=no, status=no, toolbar=no, titlebar=yes, location=no, scrollbar=no');
		document.form_chk.action = "https://check.namecheck.co.kr/checkplus_new_model4/checkplus.cb";
		document.form_chk.target = "popupChk";
		document.form_chk.submit();
	}
	
	
</script> 
<form id="form_chk" name="form_chk">
<!-- auth s -->
<input type="hidden" name="m" value="checkplusSerivce">						<!-- �ʼ� ����Ÿ��, �����Ͻø� �ȵ˴ϴ�. -->
<input type="hidden" name="EncodeData" value="<?=$enc_data?>">		<!-- ������ ��ü������ ��ȣȭ �� ����Ÿ�Դϴ�. -->
<input type="hidden" name="param_r1" value="">
<input type="hidden" name="param_r2" value="<?=HOSTID?>">
<input type="hidden" id="param_r3" name="param_r3" value="">
<!-- auth e -->
</form>
<form name="form1" id="form1" action="<?=$loginURL?>" method="post">
<input type="hidden" id="DOMAIN_ID" name="DOMAIN_ID" value="<?=$DOMAIN_ID?>" />
<input type="hidden" id="RETURN_URL" name="RETURN_URL" value="<?=$RETURN_URL?>" />
							<div class="h3-tit-box">
								<h3>��й�ȣ ã��</h3>
							</div>

							<ul class="listStyle01">
								<li>ä����� ������ �ּ���.</li>
								<li>����Ȯ���� ���ؼ� ��й�ȣ�� �����Ҽ��ֽ��ϴ�.
									</li>
							</ul>

							<div class="border-box02">
								<table class="TbStyle01" summary="�հ� ���� Ȯ�� ���">
									<caption>�հ� ���� Ȯ�� ���</caption>
									  <colgroup>
									   <col width="65px" />
									  <col width="*" />
									  </colgroup>
									  <tbody>
										<tr>
											<th scope="row"><label for="recruit">ä�����</label></th>
											<td>
												<?=$SELECTBOX_PROJECT_LIST?>
												<label class="error" for="PROJECT_LIST" generated="true" style="display:none;color:red;">error message</label>	
											</td>
										</tr>
										<tr>
											<th scope="row"><label for="user_name">�������� </label></th>
											<td>
												<input class="b_input" type="hidden" name="NAMECHECK"  id="NAMECHECK"  />
												<a href="javascript:fnPopup();">[���������ϱ�]</a>
												<label class="error" for="NAMECHECK" generated="true" style="display:none;color:red;">error message</label>	
											</td>
										</tr>
										<tr>
											
											<td colspan="2" height="100">
												
												�����Ͻ� ä������� ��й�ȣ�� �����ϽǼ� �ֽ��ϴ�.<br>
												
												
											</td>
										</tr>
									  </tbody>
								</table>
								<span class="btm-line"></span>
							</div>

							<div class="textC">
								<img src="<?=$FRONT_IMG_URL?>/img/board/btn_ok.gif" alt="Ȯ��" onclick="javascript:authLoginCheck();" />
							</div>

</form>