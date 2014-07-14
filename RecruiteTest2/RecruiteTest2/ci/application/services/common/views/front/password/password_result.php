<script language="javascript" src="/assets/js/jquery.validate.js"></script>
<script>
	
	function bodyOnLoad()
	{
		
		$("#form1").validate({  
				
		    rules: {
		    		PASSWORD:{required:true,minlength:6,maxlength:20},
		    		PASSWORD_RE:{required:true,minlength:6,maxlength:20,equalTo:"#PASSWORD"}
		    },  
		  	onkeyup:false,
		    messages: {
		    		PASSWORD:{ 	 required:"비밀번호를 입력하세요."
		    								,minlength:"최소 6자리입니다."
		    								,maxlength:"최대 20자리입니다."},
		    		PASSWORD_RE:{	 required:"비밀번호를 입력하세요."
		    									,minlength:"최소 6자리입니다."
		    									,maxlength:"최대 20자리입니다."
		    									,equalTo:"비밀번호가 일치하지 않습니다."}
		    }
   	});  
	}
	
	
</script> 
<form name="form1" id="form1" method="post">
							<div class="h3-tit-box">
								<h3>비밀번호 결과</h3>
							</div>

							<ul class="listStyle01">
								<li>비밀번호를 변경하세요.</li>
							</ul>

							<div class="border-box02">
								<table class="TbStyle01" summary="">
									<caption></caption>
									  <colgroup>
									   <col width="105px" />
									  <col width="*" />
									  </colgroup>
									  <tbody>
										<tr>
											<th scope="row"><label for="recruit">변경 비밀빈호</label></th>
											<td>
												<input class="b_input" type="password" name="PASSWORD"  id="PASSWORD" />
												<label class="error" for="PASSWORD" generated="true" style="display:none;color:red;">error message</label>	
											</td>
										</tr>
										<tr>
											<th scope="row"><label for="user_name">비밀번호 확인</label></th>
											<td>
												<input class="b_input" type="password" name="PASSWORD_RE"  id="PASSWORD_RE"/>
												<label class="error" for="PASSWORD_RE" generated="true" style="display:none;color:red;">error message</label>	
											</td>
										</tr>
										<tr>
											
											<td colspan="2" height="100">
												
												선택하신 채용공고의 입사지원서 비밀번호를 변경하실수 있습니다.<br>
												
												
											</td>
										</tr>
									  </tbody>
								</table>
								<span class="btm-line"></span>
							</div>

							<div class="textC">
								<input type="image" src="<?=$FRONT_IMG_URL?>/img/board/btn_ok.gif" alt="확인" />
							</div>

</form>