<script language="javascript" src="/assets/js/jquery.validate.js"></script>
<script>
	function bodyOnLoad()
	{

					$("#form1").validate({  
		
					groups: {
						TEL: "TEL1 TEL2 TEL3",
						MOBILE: "MOBILE1 MOBILE2 MOBILE3"
					},
			    rules: {  
						
						MANAGER_ID:{
							required:true,
							minlength:6,
							maxlength:20,
							digitchars:true,
							remote: { 
		        		url : "/admin/chargerManagement/checkManagerId" , 
		        		type : "POST" ,
		        		data : { 
		        				MANAGER_ID:function() { 
		        						return $("#MANAGER_ID").val(); 
		        				} 
		        		}
		        	}
						},
						<? if ($MANAGER_ID != null) { ?>
							MANAGER_PW:{
								required:function(element) { return $("#PWD_CHECK_YN").is(':checked'); },
								minlength:6
							},
							MANAGER_PWRE:{
								required:function(element) { return $("#PWD_CHECK_YN").is(':checked'); },
								minlength:6,
								equalTo: "#MANAGER_PW"
							},
							<? } ?>
							<? if ($MANAGER_ID == null) { ?>
							MANAGER_PW:{
								required:true,
								minlength:6
							},
							MANAGER_PWRE:{
								required:true,
								minlength:6,
								equalTo: "#MANAGER_PW"
							},
							<? } ?>
						MANAGER_NM:{required:true},
						DEPT:{required:true},
						PSTN:{required:true},
						TEL1:{required:true},
						TEL2:{required:true,digits:true,minlength:3},
						TEL3:{required:true,digits:true,minlength:4},
						MOBILE1:{required:true},
						MOBILE2:{required:true,digits:true,minlength:3},
						MOBILE3:{required:true,digits:true,minlength:4},
						EMAIL:{required:true,email:true}
			    },  
			    onkeyup:false,
			    messages: {
			    		
			    		MANAGER_ID:{
			    			required:"아이디를 입력하세요.",
								minlength:"최소 6자 입니다.",
								maxlength:"최대 20자 입니다.",
								digitchars:"숫자,영문만 입력가능합니다.",
								remote:"이미 등록된 아이디입니다."
			    		},
			    		
			    		
			    		MANAGER_NM:"이름을 입력하세요",
							DEPT:"부설를 입력하세요",
							PSTN:"직함을 입력하세요",
							TEL1:"연락처를 입력하세요",
							TEL2:{
								required:"연락처를 입력하세요",
								digits:"숫자만 입력가능합니다.",
								minlength:"최소 3자리이상입니다."
							},
							TEL3:{
								required:"연락처를 입력하세요",
								digits:"숫자만 입력가능합니다.",
								minlength:"최소 4자리입니다."
							},
							MOBILE1:"휴대폰번호를 선택하세요",
							MOBILE2:{
								required:"연락처를 입력하세요",
								digits:"숫자만 입력가능합니다.",
								minlength:"최소 3자리이상입니다."
							},
							MOBILE3:{
								required:"연락처를 입력하세요",
								digits:"숫자만 입력가능합니다.",
								minlength:"최소 4자리입니다."
							},
							EMAIL:{
								required:"이메일을 입력하세요",
								email:"이메일형식을 확인하세요"
							}
			    },
			    submitHandler: function(form) { 
			    	form.submit();
			    }
	   	});  
	  
	  	<? if ($MANAGER_ID != null) { ?>
			$("#MANAGER_PW").attr("disabled",true);
			$("#MANAGER_PWRE").attr("disabled",true);	
			<? } ?>	 	
		
	}
	
	function processForm()
	{
		$("#form1").attr("action","/admin/adminManagement/managerProcess");
		$("#submit_button").click();
		
	}
	
	function checkPassword()
	{
		$("#MANAGER_PW").val('');
		$("#MANAGER_PWRE").val('');
		$("#MANAGER_PW").attr("disabled",true);
		$("#MANAGER_PWRE").attr("disabled",true);
		
		if ($("#PWD_CHECK_YN").is(':checked')) 
		{
			$("#MANAGER_PW").attr("disabled",false);
			$("#MANAGER_PWRE").attr("disabled",false);
		}
	}
	
</script>

<p class="txtR F11 mgb5"><span class="orange ">*</span> 표시부분은 필수입력사항입니다.</p>
<form name="form1" id="form1" method="post">
			<table class="BdView-Type01" summary="관리자 관리">
				<caption>관리자 관리</caption>
				<colgroup>
					<col width="145px" />
					<col width="*" />
				</colgroup>
				<tbody>
					
					<? if ($MANAGER_ID != null) { ?>
					<tr>
						<th scope="row">
							<label for="id"><span class="item" >*</span>ID</label>
						</th>
						
						<td>
							<?=$MANAGER_ID?>
						</td>
					</tr>
					<? } ?>
					<? if ($MANAGER_ID == null) { ?>
					<tr>
						<th scope="row">
							<label for="id"><span class="item">*</span>ID</label>
						</th>
						
						<td>
							<input type="text" name="MANAGER_ID" id="MANAGER_ID" title="ID 를 입력하세요."  style="width:128px;" value="<?=$MANAGER_ID?>" class="required" />
							<label class="error" for="MANAGER_ID" generated="true" style="display:none;color:red;">error message</label>
						</td>
					</tr>
					<? } ?>
					
					<? if ($MANAGER_ID != null) { ?>
					<tr>
						<th scope="row">
							<label for="id">비밀번호 변경</label>
						</th>
						
						<td>
							<input type="checkbox" name="PWD_CHECK_YN" id="PWD_CHECK_YN" value="Y" class="checkbox" onclick="javascript:checkPassword();" />
							비밀번호를 변경하시려면 체크하세요.
						</td>
					</tr>
					<? } ?>
					
					<tr>
						<th scope="row">
							<label for="password"><span class="item">*</span>비밀번호</label>
						</th>
						<td>
							<input type="password" name="MANAGER_PW" id="MANAGER_PW" title="비밀번호 입력" style="width:128px;"  />
							<label class="error" for="MANAGER_PW" generated="true" style="display:none;color:red;">error message</label>
						</td>
					</tr>
					<tr>
						<th scope="row">
							<label for="password_re"><span class="item">*</span>비밀번호 확인</label>
						</th>
						<td>
							<input type="password" name="MANAGER_PWRE" id="MANAGER_PWRE" title="비밀번호 확인 입력하세요." style="width:128px;" />
							<label class="error" for="MANAGER_PWRE" generated="true" style="display:none;color:red;">error message</label>
						</td>
					</tr>
					<tr>
						<th scope="row">
							<label for="manager"><span class="item">*</span>담당자</label>
						</th>
						<td>
							<input type="text" name="MANAGER_NM" id="MANAGER_NM" title="담당자 입력" style="width:128px;" value="<?=$MANAGER_NM?>"  class="required" />
							<label class="error" for="MANAGER_NM" generated="true" style="display:none;color:red;">error message</label>
						</td>
					</tr>
					<tr>
						<th scope="row">
							<label for="division"><span class="item">*</span>부서</label>
						</th>
						<td>
							<input type="text" name="DEPT" id="DEPT" title="부서 입력" style="width:128px;" value="<?=$DEPT?>" />
							<label class="error" for="DEPT" generated="true" style="display:none;color:red;">error message</label>
						</td>
					</tr>
					<tr>
						<th scope="row">
							<label for="position"><span class="item">*</span>직함</label>
						</th>
						<td>
							<input type="text" name="PSTN" id="PSTN" title="직함 입력" style="width:128px;" value="<?=$PSTN?>" />
							<label class="error" for="PSTN" generated="true" style="display:none;color:red;">error message</label>
						</td>
					</tr>
					<tr>
						<th scope="row">
							<label for="phone01"><span class="item">*</span>전화번호</label>
						</th>
						<td>
							<?=$SELECTBOX_TEL?> -
							<input type="text" name="TEL2" id="TEL2" value="<?=$TEL2?>" maxlength="4" title="가운데 입력" style="width:30px;" /> -
							<input type="text" name="TEL3" id="TEL3" value="<?=$TEL3?>" maxlength="4" title="마지막 입력" style="width:30px;" />
							<label class="error" for="TEL" generated="true" style="display:none;color:red;">error message</label>
						</td>
					</tr>
					<tr>
						<th scope="row">
							<label for="mobile01">핸드폰</label>
						</th>
						<td>
							<?=$SELECTBOX_MOBILE?> -
							<input type="text" name="MOBILE2" id="MOBILE2" value="<?=$MOBILE2?>" maxlength="4"  title="가운데 입력" style="width:30px;" /> -
							<input type="text" name="MOBILE3" id="MOBILE3" value="<?=$MOBILE3?>" maxlength="4"  title="마지막 입력" style="width:30px;" />
							<label class="error" for="MOBILE" generated="true" style="display:none;color:red;">error message</label>
						</td>
					</tr>
					<tr>
						<th scope="row">
							<label for="email"><span class="item">*</span>이메일</label>
						</th>
						<td>
							<input type="text" name="EMAIL" id="EMAIL" value="<?=$EMAIL?>" title="이메일 입력" style="width:128px;" />
							<label class="error" for="EMAIL" generated="true" style="display:none;color:red;">error message</label>
						</td>
					</tr>
					<tr>
						<th scope="row">
							<label for="email"><span class="item">*</span>사용 구분</label>
						</th>
						<td>
							<input type="radio" name="USE_YN" id="USE_YN" title="사용 구분" class="radio" value="Y" <?=$USE_YN == 'Y' || $USE_YN == null ? ' checked ' : '';?> />사용
							&nbsp;
							<input type="radio" name="USE_YN" id="USE_YN" title="사용 구분" class="radio" value="N" <?=$USE_YN == 'N' ? ' checked ' : '';?>/>중지
						</td>
					</tr>
				</tbody>
			</table>
		<input type="submit" id="submit_button" style="display:none;">
		<? if ($MANAGER_ID != null) { ?>
		<input type="hidden" name="MANAGER_ID" value="<?=$MANAGER_ID?>">
		<? }?>
		<input type="hidden" name="process_type" value="<?=$MANAGER_ID != null ? 'modify' : 'regist'?>">
			<div class="txtC">
				<span class="btn01"><a href="javascript:processForm();">확인</a></span>
				<span class="btn02"><a href="javascript:window.close();">닫기</a></span>
			</div>
</form>