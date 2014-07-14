<script language="javascript" src="/assets/js/jquery.validate.js"></script>
<script>
	
	function bodyOnLoad()
	{
		
		$("#form1").validate({  
				groups:{
					HTEL:"HTEL1 HTEL2 HTEL3"
					},
		    rules: {
		    		
		    		HTEL1:{required:true},
		    		HTEL2:{required:true,minlength:3,maxlength:4,digits:true},
		    		HTEL3:{required:true,minlength:4,maxlength:4,digits:true},
		    		PROJECT_LIST:{required:true},
		    		USERNAME:{required:true},
		    		USER_PW:{required:true}
		    },  
		  	onkeyup:false,
		    messages: {
		    
		    		HTEL1:{required:"전화번호를 확인하세요"},
		    		HTEL2:{required:"전화번호를 확인하세요",minlength:"전화번호를 확인하세요",maxlength:"전화번호를 확인하세요",digits:"전화번호를 확인하세요"},
		    		HTEL3:{required:"전화번호를 확인하세요",minlength:"전화번호를 확인하세요",maxlength:"전화번호를 확인하세요",digits:"전화번호를 확인하세요"},
		    		PROJECT_LIST:{required:"채용공고를 선택하세요"},
		    		USERNAME:{required:"이름을 입력하세요"},
		    		USER_PW:{required:"비밀번호를 입력하세요."}
		    }
   	});  
	}
	
	
</script>
<form name="form1" id="form1" action="<?=$loginURL?>" method="post">
<input type="hidden" id="DOMAIN_ID" name="DOMAIN_ID" value="<?=$DOMAIN_ID?>" />
<input type="hidden" id="RETURN_URL" name="RETURN_URL" value="<?=$RETURN_URL?>" />
	<div class="h3-tit-box">
								<h3>입사지원 여부 확인 방법</h3>
							</div>

							<ul class="listStyle01">
								<li>본인이 지원하신 채용공고를 선택해 주세요.</li>
								<li>성명, 핸드폰 번호, 비밀번호 입력 후 확인을 누르시면 입사지원 여부를 확인하실 수 있습니다.<br />
									<span class="red">(비밀번호는 영문 대소문자를 구분합니다.)</span></li>
								<li>입사지원 접수 마감 후에는 입사지원 확인 및 수정이 불가능 합니다.</li>
							</ul>

							<div class="border-box01">
								<table class="TbStyle01" summary="입사지원 여부 확인">
									<caption>입사지원 여부 확인</caption>
									  <colgroup>
									  <col width="65px" />
									  <col width="*" />
									  </colgroup>
									  <tbody>
										<tr>
											<th scope="row"><label for="recruit">채용공고</label></th>
											<td>
												<?=$SELECTBOX_PROJECT_LIST?>
												<label class="error" for="PROJECT_LIST" generated="true" style="display:none;color:red;">error message</label>	
											</td>
										</tr>
										<tr>
											<th scope="row"><label for="user_name">성 명</label></th>
											<td>
												<input class="b_input" type="text" name="USERNAME" id="USERNAME" value="" style="width:100px;" title="성명입력" />
												<label class="error" for="USERNAME" generated="true" style="display:none;color:red;">error message</label>	
											</td>
										</tr>
										<tr>
											<th scope="row"><label for="user_phone_01">핸드폰</label></th>
											<td>
												<?=$SELECTBOX_HTEL?> -
												<input class="b_input" type="text" name="HTEL2" id="HTEL2" maxlength="4" value="" style="width:40px;" /> -
												<input class="b_input" type="text" name="HTEL3" id="HTEL3" maxlength="4" value="" style="width:40px;" />
												<label class="error" for="HTEL" generated="true" style="display:none;color:red;">error message</label>	
											</td>
										</tr>
										<tr>
											<th scope="row" class="last"><label for="USER_PW">비밀번호</label></th>
											<td class="last">
												<input class="b_input" type="password" name="USER_PW" id="USER_PW" style="width:100px;" value="" title="비밀번호입력" />
												<a href="javascript:goMenu('schpass');"><img src="<?=$FRONT_IMG_URL?>/img/board/btn_pwfind.gif" alt="비밀번호 찾기" /></a>
												<label class="error" for="USER_PW" generated="true" style="display:none;color:red;">error message</label>	
											</td>
										</tr>
									  </tbody>
								</table>
								<span class="btm-line"></span>
							</div>

							<div class="textC">
								<input type="image" src="<?=$FRONT_IMG_URL?>/img/board/btn_ok.gif" alt="확인" />
							</div>

							<p class="link-txt mgt20">※ 비밀번호 분실 시 [<a href="javascript:goMenu('schpass');" class="bold">비밀번호 찾기</a>] 서비스를 이용해서 비밀번호 확인이 가능 하십니다.</p>
</form>