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
		    		PASSWORD:{ 	 required:"��й�ȣ�� �Է��ϼ���."
		    								,minlength:"�ּ� 6�ڸ��Դϴ�."
		    								,maxlength:"�ִ� 20�ڸ��Դϴ�."},
		    		PASSWORD_RE:{	 required:"��й�ȣ�� �Է��ϼ���."
		    									,minlength:"�ּ� 6�ڸ��Դϴ�."
		    									,maxlength:"�ִ� 20�ڸ��Դϴ�."
		    									,equalTo:"��й�ȣ�� ��ġ���� �ʽ��ϴ�."}
		    }
   	});  
	}
	
	
</script> 
<form name="form1" id="form1" method="post">
							<div class="h3-tit-box">
								<h3>��й�ȣ ���</h3>
							</div>

							<ul class="listStyle01">
								<li>��й�ȣ�� �����ϼ���.</li>
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
											<th scope="row"><label for="recruit">���� ��к�ȣ</label></th>
											<td>
												<input class="b_input" type="password" name="PASSWORD"  id="PASSWORD" />
												<label class="error" for="PASSWORD" generated="true" style="display:none;color:red;">error message</label>	
											</td>
										</tr>
										<tr>
											<th scope="row"><label for="user_name">��й�ȣ Ȯ��</label></th>
											<td>
												<input class="b_input" type="password" name="PASSWORD_RE"  id="PASSWORD_RE"/>
												<label class="error" for="PASSWORD_RE" generated="true" style="display:none;color:red;">error message</label>	
											</td>
										</tr>
										<tr>
											
											<td colspan="2" height="100">
												
												�����Ͻ� ä������� �Ի������� ��й�ȣ�� �����ϽǼ� �ֽ��ϴ�.<br>
												
												
											</td>
										</tr>
									  </tbody>
								</table>
								<span class="btm-line"></span>
							</div>

							<div class="textC">
								<input type="image" src="<?=$FRONT_IMG_URL?>/img/board/btn_ok.gif" alt="Ȯ��" />
							</div>

</form>