<script language="javascript" src="/assets/js/jquery.validate.js"></script>
<script>
	
	window.name ="Parent_window";
	
	
	function fnPopup(){
		
		window.open('', 'popupChk', 'width=500, height=461, top=100, left=100, fullscreen=no, menubar=no, status=no, toolbar=no, titlebar=yes, location=no, scrollbar=no');
		document.form_chk.action = "https://check.namecheck.co.kr/checkplus_new_model4/checkplus.cb";
		document.form_chk.target = "popupChk";
		document.form_chk.submit();
	}

	function goProcess()
	{
		$.ajax({
    url: "/front/login/UserAuthConfirmFlag",
    type: "get",
    dataType:'json',
    //data: serializedData,
    success: function(response, textStatus, jqXHR){
    	
    	$("#RECV_FLAG").val(response.RECV_FLAG);
     	$("#RECV_DI").val(response.RECV_DI);
     	$("#RECV_CI").val(response.RECV_CI);
     	$("#RECV_FOREIGN_TP").val(response.RECV_FOREIGN_TP);
     	$("#RECV_GENDER").val(response.RECV_GENDER);
     	$("#RECV_BIRTH_DT").val(response.RECV_BIRTH_DT);
     	$("#RECV_NAME").val(response.RECV_NAME);
     	
    },
    error: function(jqXHR, textStatus, errorThrown){
        //console.log("The following error occured: "+textStatus, errorThrown);
        
    },
    // callback handler that will be called on completion
    // which means, either on success or error
    complete: function(){
    	
    	if ($("#RECV_DI").val() != '' && $("#agree").is(':checked') == true && !$("#RECV_FLAG").val() )
    	{
	    	$("#form1").attr("method","post");
	    	$("#form1").attr("action","<?=SSL_LOGIN_DOMAIN?>/front/login/UserAuthSSLConfirmProcess");
	    	$("#form1").submit();
    	}
    	else
    	{
    		alert('취급위탁 동의및 본인확인을 하셔야 합니다.');
    	}
    	
    }
		});
	}
	
</script>
<style>
	.terms-box {
position: relative;
	height:240px;
	overflow-y: scroll;
	margin-bottom:10px;
	border:1px solid #e1e1e1;
	padding:15px;
}

.terms-box h3 {
	margin-bottom:10px;
	color:#4b4b4b;
}
	
</style>
<form id="form_chk" name="form_chk">
<!-- auth s -->
<input type="hidden" name="m" value="checkplusSerivce">						<!-- 필수 데이타로, 누락하시면 안됩니다. -->
<input type="hidden" name="EncodeData" value="<?=$enc_data?>">		<!-- 위에서 업체정보를 암호화 한 데이타입니다. -->
<input type="hidden" name="param_r1" value="<?=$PRJ_IDX?>">
<input type="hidden" name="param_r2" value="<?=HOSTID?>">
<input type="hidden" name="param_r3" value="">
<!-- auth e -->
</form>

<form id="form1" name="form1">
<input type="hidden"  name="projectListIdx" value="<?=$PRJ_IDX?>">
<input type="hidden" name="domainListIdx" value="<?=HOSTID?>">

<input type="text" id="RECV_DI" name="RECV_DI" class="required" style="display:none;" />
<input type="hidden" id="RECV_CI" name="RECV_CI" />
<input type="hidden" id="RECV_FOREIGN_TP" name="RECV_FOREIGN_TP" />
<input type="hidden" id="RECV_GENDER" name="RECV_GENDER" />
<input type="hidden" id="RECV_BIRTH_DT" name="RECV_BIRTH_DT" />
<input type="hidden" id="RECV_NAME" name="RECV_NAME" />
<input type="hidden" id="RECV_FLAG" name="RECV_FLAG" />

							<div class="textarea-box">
								<div class="terms-box">
								<?=$front_agreement?>
								</div>
								
							</div>
							<p>
								<div class="textC">
								<input type="checkbox" class="checkbox" id="agree" name="agree" value="Y"  />
								<label for="agree">상기 개인정보 취급 위탁에 동의합니다.</label>
								
								</div>
								<hr/>
							</p>
<label class="error" for="agree" generated="true" style="display:none;color:red;">error message</label>	

<br><br>
									<a href="javascript:fnPopup();">[본인인증하기]</a>
									<label class="error" for="RECV_DI" generated="true" style="display:none;color:red;">error message</label>	
								
							
							<p class="mgt10"><img src="<?=$FRONT_IMG_URL?>/img/board/txt01.gif" alt="고객님의 개인정보는 항상 암호화되어 처리되고, 본인인증으로만 사용되며, 보관하지 않습니다." /></p>

							<div class="textC">
								<a href="javascript:goProcess();"><img src="<?=$FRONT_IMG_URL?>/img/board/btn_enter.gif" alt="입사지원 시작" /></a>
							</div>
</form>