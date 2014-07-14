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
		    
		    		HTEL1:{required:"��ȭ��ȣ�� Ȯ���ϼ���"},
		    		HTEL2:{required:"��ȭ��ȣ�� Ȯ���ϼ���",minlength:"��ȭ��ȣ�� Ȯ���ϼ���",maxlength:"��ȭ��ȣ�� Ȯ���ϼ���",digits:"��ȭ��ȣ�� Ȯ���ϼ���"},
		    		HTEL3:{required:"��ȭ��ȣ�� Ȯ���ϼ���",minlength:"��ȭ��ȣ�� Ȯ���ϼ���",maxlength:"��ȭ��ȣ�� Ȯ���ϼ���",digits:"��ȭ��ȣ�� Ȯ���ϼ���"},
		    		PROJECT_LIST:{required:"ä����� �����ϼ���"},
		    		USERNAME:{required:"�̸��� �Է��ϼ���"},
		    		USER_PW:{required:"��й�ȣ�� �Է��ϼ���."}
		    }
   	});  
	}
	
	
</script>
<form name="form1" id="form1" action="<?=$loginURL?>" method="post">
<input type="hidden" id="DOMAIN_ID" name="DOMAIN_ID" value="<?=$DOMAIN_ID?>" />
<input type="hidden" id="RETURN_URL" name="RETURN_URL" value="<?=$RETURN_URL?>" />
	<div class="h3-tit-box">
								<h3>�Ի����� ���� Ȯ�� ���</h3>
							</div>

							<ul class="listStyle01">
								<li>������ �����Ͻ� ä����� ������ �ּ���.</li>
								<li>����, �ڵ��� ��ȣ, ��й�ȣ �Է� �� Ȯ���� �����ø� �Ի����� ���θ� Ȯ���Ͻ� �� �ֽ��ϴ�.<br />
									<span class="red">(��й�ȣ�� ���� ��ҹ��ڸ� �����մϴ�.)</span></li>
								<li>�Ի����� ���� ���� �Ŀ��� �Ի����� Ȯ�� �� ������ �Ұ��� �մϴ�.</li>
							</ul>

							<div class="border-box01">
								<table class="TbStyle01" summary="�Ի����� ���� Ȯ��">
									<caption>�Ի����� ���� Ȯ��</caption>
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
											<th scope="row"><label for="user_name">�� ��</label></th>
											<td>
												<input class="b_input" type="text" name="USERNAME" id="USERNAME" value="" style="width:100px;" title="�����Է�" />
												<label class="error" for="USERNAME" generated="true" style="display:none;color:red;">error message</label>	
											</td>
										</tr>
										<tr>
											<th scope="row"><label for="user_phone_01">�ڵ���</label></th>
											<td>
												<?=$SELECTBOX_HTEL?> -
												<input class="b_input" type="text" name="HTEL2" id="HTEL2" maxlength="4" value="" style="width:40px;" /> -
												<input class="b_input" type="text" name="HTEL3" id="HTEL3" maxlength="4" value="" style="width:40px;" />
												<label class="error" for="HTEL" generated="true" style="display:none;color:red;">error message</label>	
											</td>
										</tr>
										<tr>
											<th scope="row" class="last"><label for="USER_PW">��й�ȣ</label></th>
											<td class="last">
												<input class="b_input" type="password" name="USER_PW" id="USER_PW" style="width:100px;" value="" title="��й�ȣ�Է�" />
												<a href="javascript:goMenu('schpass');"><img src="<?=$FRONT_IMG_URL?>/img/board/btn_pwfind.gif" alt="��й�ȣ ã��" /></a>
												<label class="error" for="USER_PW" generated="true" style="display:none;color:red;">error message</label>	
											</td>
										</tr>
									  </tbody>
								</table>
								<span class="btm-line"></span>
							</div>

							<div class="textC">
								<input type="image" src="<?=$FRONT_IMG_URL?>/img/board/btn_ok.gif" alt="Ȯ��" />
							</div>

							<p class="link-txt mgt20">�� ��й�ȣ �н� �� [<a href="javascript:goMenu('schpass');" class="bold">��й�ȣ ã��</a>] ���񽺸� �̿��ؼ� ��й�ȣ Ȯ���� ���� �Ͻʴϴ�.</p>
</form>