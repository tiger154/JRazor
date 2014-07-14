<script language="javascript" src="/assets/js/jquery.validate.js"></script>
<script>
	
	function checkAgree()
	{	
		$("#submit_button").click();
		/*
		if (!$("#s01_1").attr('checked')) 
		{
			alert('이용약관에 동의하셔야 합니다.');
		} 
		else if (!$("#s02_1").attr('checked')) 
		{
			alert('개인정보 수집에 동의하셔야 합니다.');
		}
		else if ($("#password_tem").val() == '' ) 
		{
			alert('임시비밀번호를 입력하세요');
		}		
		else if ($("#password").val() == '' ) 
		{
			alert('변경하실 비밀번호를 입력하세요.');
		}
		else if ($("#password_re").val() == '' ) 
		{
			alert('변경하실 비밀번호를 확인란에 입력하세요.');
		}
		else if ( $("#mobile01:selected").val() == '' || $("#mobile02").val() == '' || $("#mobile03").val() == '' )
		{
			alert('휴대폰번호를 입력하세요.');
		}
		else if ($("#password").val() != $("#password_re").val() ) 
		{
			alert('변경할 비밀번호와 비밀번호 확인이 다릅니다.');
		}	
		else if ($("#password_tem").val() == $("#password").val() ) 
		{
			alert('임시비밀번호와 변경할 비밀번호가 같습니다.');
		}
		else
		{
			document.agrFrom.submit();
		}
		*/
	}
	
	function bodyOnLoad()
	{
		// Added by won , 25, Feb, 2013
		jQuery.validator.addMethod("notEqual", function(value, element, param) {
		 return this.optional(element) || value != $(param).val();
		}, "This has to be different...");

		$("#agrFrom").validate({  
				groups:{
					mobile:"mobile01 mobile02 mobile03"
				},
		    rules: {  
		      password_tem:{required:true,minlength:5,maxlength:20},
		      password:{required:true,minlength:5,maxlength:20,notEqual:"#password_tem"},
		      password_re:{required:true,minlength:5,maxlength:20,equalTo:"#password"},
		      mobile01:{required:true},
		      mobile02:{required:true,digits:true,minlength:3},
		      mobile03:{required:true,digits:true,minlength:4},
		      s01_1:{required:true},
		      s02_1:{required:true}
		    },  
		    onkeyup:false,
		    messages: {
		    		s01_1:"동의 체크 후 이용 가능하십니다.",
		    		s02_1:"동의 체크 후 이용 가능하십니다.",
		    		password_tem:{
		    				required:"임시비밀번호를 입력하세요",
		    				minlength:"최소 5자이상입니다.",
		    				maxlength:"최대 20자입니다."},
		    		password:{
		    				required:"비밀번호를 입력하세요",
		    				minlength:"최소 5자이상입니다.",
		    				maxlength:"최대 20자입니다.",
							notEqual:"임시비밀번호와 비밀번호를 다르게 입력하세요."},
		    		password_re:{
		    				required:"비밀번호를 다시확인하세요.",
		    				minlength:"최소 5자이상입니다.",
		    				maxlength:"최대 20자입니다.",
		    				equalTo:"비밀번호가 다릅니다. 다시입력하세요."},
		    		mobile:"휴대폰번호를 입력하세요.",
		    		mobile01:{required:"휴대폰번호를 선택하세요."},
		    		mobile02:{
		    				required:"휴대폰 번호를 입력하세요.",
		    				digits:"숫자만 입력하세요",
		    				minlength:"3자리이 이상입니다."},
		    		mobile03:{
		    				required:"휴대폰 번호를 입력하세요.",
		    				digits:"숫자만 입력하세요",
		    				minlength:"4자리입니다."}
		    },
		    submitHandler: function(form) { 

	    	form.submit();

	    	}
   	});  
	}

</script>
					
					
					<h2 class="H2blt">이용약관</h2>
					<form id="agrFrom" name="agrFrom" action="/admin/agreement/agreeProcess" method="post">
					<div class="terms-box">
					<?=$admin_agreement?>
					</div>

					<div class="txtC mgb10">
						<input type="checkbox" name="s01_1" id="s01_1" value="1" class="checkbox" /><label for="s01_1" class="mgr5">동의 합니다.</label>
						<!--input type="radio" name="s01_1" id="s01_1" value="2" class="radio" /><label for="s01_2">동의하지 않습니다.</label-->
						<label class="error" for="s01_1" generated="true" style="display:none;color:red;">error message</label>	
					</div>

					<h2 class="H2blt">개인정보 수집 및 이용에 대한 안내</h2>
					<div class="terms-box">
					<?=$admin_information?>
					</div>

					<div class="txtC mgb10">
						<input type="checkbox" name="s02_1" id="s02_1" value="1" class="checkbox" /><label for="s02_1" class="mgr5">동의 합니다</label>
						<!--input type="radio" name="s02_1" id="s02_1" value="2" class="radio" /><label for="s02_2">동의하지 않습니다.</label-->
						<label class="error" for="s02_1" generated="true" style="display:none;color:red;">error message</label>	
					</div>

					<h2 class="H2blt">회원 정보 확인 및 변경</h2>
					<table class="BdView-Type01" summary="게시물 제목, 번호, 작성자, 등록일, 조회수, 첨부파일 및 내용을 볼 수 있습니다.">
						<caption>게시글 상세보기</caption>
						<colgroup>
							<col width="115px" />
							<col width="*" />
							<col width="115px" />
							<col width="*" />
							<col width="115px" />
							<col width="*" />
						</colgroup>
						<tbody>
							<tr>
								<th scope="row">
									<label for="name">이름</label>
								</th>
								<td><?=$LoginNm?></td>
								<th scope="row" class="bdLine">
									<label for="password_tem">임시비밀번호</label>
								</th>
								<td colspan="3">
									<input type="password" name="password_tem" id="password_tem" title="임시비밀번호 입력" style="width:140px;" />
									<label class="error" for="password_tem" generated="true" style="display:none;color:red;">error message</label>	
								</td>
							</tr>
							<tr>
								<th scope="row">
									<label for="password">비밀번호</label>
								</th>
								<td>
									<input type="password" name="password" id="password" style="width:140px;" />
									<label class="error" for="password" generated="true" style="display:none;color:red;">error message</label>	
								</td>
								<th scope="row" class="bdLine">
									<label for="password_re">비밀번호 확인</label>
								</th>
								<td>
									<input type="password" name="password_re" id="password_re" title="비밀번호 확인 입력" style="width:140px;"  />
									<label class="error" for="password_re" generated="true" style="display:none;color:red;">error message</label>	
								</td>
								<th scope="row" class="bdLine">
									<label for="mobile01">핸드폰</label>
								</th>
								<td>
									<?=$SELECTBOX_mobile01?> -
									<input type="text" name="mobile02" id="mobile02" title="가운데 입력" style="width:50px;" maxlength="4" /> -
									<input type="text" name="mobile03" id="mobile03" title="마지막 입력" style="width:50px;" maxlength="4" />
									<label class="error" for="mobile" generated="true" style="display:none;color:red;">error message</label>	
								</td>
							</tr>
						</tbody>
					</table>
					<input type="submit" id="submit_button" style="display:none;">
					<div class="txtC mgb10">
						<span class="btn01"><a href="javascript:checkAgree();">확인</a></span>
					</div>
				</form>