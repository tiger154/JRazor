
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="ko" lang="ko">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=euc-kr" />
	<link rel="stylesheet" type="text/css" href="/assets/css/default.css" />
	<link rel="stylesheet" type="text/css" href="/assets/css/login.css" />
	<script language="javascript" src="/assets/js/jquery-1.8.3.min.js"></script>
	<script language="javascript" src="/assets/js/jquery.easyui.min.js"></script>
	<script language="javascript" src="/assets/js/common.js"></script>
	<script>
		$(document).ready( function() {
			$('#id').focus();
		});
		function checkLogin()
		{
				
				//** ID Validate : start **//
				if ( $('#id').val() == '' ) 
				{ 					
					alert('���̵� �Է��ϼ���');
					$('#id').focus();
					return false;
				}				

				if ($('#id').val() != '' && !$('#id').val().match(/^[A-Z|a-z]+$/))
				{
//					alert('������ �Է°����մϴ�.');					
//					$('#id').focus();
//					return false;
				}
				//** ID Validate : end**//
				
				if ( $('#pw').val() == '' )
				{
					alert('��й�ȣ�� �Է��ϼ���');
					$('#pw').focus();
					return false;
				}

				//** Businesses num Validate : Start **//
				if ($('#reg01').val() == '' ){
					alert('����ڵ�Ϲ�ȣ�� �Է��ϼ���.');
					$('#reg01').focus();
					return false;
				}
				if (!$('#reg01').val().match(/^[0-9]+$/)){
					alert('���ڸ� �Է°����մϴ�.');					
					$('#reg01').focus();
					return false;
				}
				
				if($('#reg02').val() == '' ){
					alert('����ڵ�Ϲ�ȣ�� �Է��ϼ���.');
					$('#reg02').focus();
					return false;
				}
				if(!$('#reg02').val().match(/^[0-9]+$/)){
					alert('���ڸ� �Է°����մϴ�.');					
					$('#reg02').focus();
					return false;
				}

				if ($('#reg03').val() == '' ){
					alert('����ڵ�Ϲ�ȣ�� �Է��ϼ���.');
					$('#reg03').focus();
					return false;
				}
				if(!$('#reg03').val().match(/^[0-9]+$/)){
					alert('���ڸ� �Է°����մϴ�.');					
					$('#reg03').focus();
					return false;
				}
		 
				//** Businesses num Validate : End **//

				<? if (DEVELOPER_FLAG == 'OFF' ) { ?>
				
				
				
				<? } ?>
					
		}
		
	</script>
	
	<title>CAREERCARE Admin</title>
</head>
<body>
	<div id="LY-Wrapper">

		<div id="Fix-Width">

			<!-- S: Login -->
			<div id="LY-Login">

				<div id="Login-box">
					<div class="logo"><img src="/assets/img/login/login_logo.gif" alt="CAREERCARE"/></div>
					<div class="box">
						<form id="Login-From" name="Login-From" action="<?=SSL_LOGIN_DOMAIN?>/admin/login/loginProcess" method="post" onsubmit="return checkLogin()">
							<input type="hidden" id="LOGIN_HOST_ID" name="LOGIN_HOST_ID" value="<?=HOSTID?>"/>
							<fieldset>
								<legend>���̵�/��й�ȣ �α���</legend>
								<dl>
									<dt><label for="id"><img src="/assets/img/login/login_id.gif" alt="���̵�"/></label></dt>
									<dd><input type="text" id="id" name="id" title="���̵� �Է�" style="width:183px;" /></dd>
									<dt><label for="pw"><img src="/assets/img/login/login_pw.gif" alt="��й�ȣ"/></label></dt>
									<dd><input type="password" id="pw" name="pw" title="��й�ȣ �Է�" style="width:183px;" /></dd>
									<dt><label for="reg01"><img src="/assets/img/login/login_reg.gif" alt="����� ��Ϲ�ȣ"/></label></dt>
									<dd>
										<input type="text" id="reg01" maxlength="3" name="reg01" title="����� ��� �չ�ȣ" style="width:50px;" /> -
										<input type="text" id="reg02" maxlength="2" name="reg02" title="����� ��� �߰���ȣ" style="width:50px;" /> -
										<input type="text" id="reg03" maxlength="5" name="reg03" title="����� ��� ��������ȣ" style="width:50px;" />
									</dd>
								</dl>
								<input class="image" type="image" src="/assets/img/login/login_btn.gif" alt="�α���" />
							</fieldset>
						</form>
						<p class="tip"><img src="/assets/img/login/login_tip.gif" alt="���� ������ �н��ϼ��� ��� ������ ����ó�� ���� ��Ź �帳�ϴ�.   Ŀ�����ɾ� ä�������� ������� 02)2286-3815"/></p>
					</div>
				</div>			

			</div>
			<hr />
			<!--// E: Login -->

			<!-- S: Bottom -->
			<div id="LY-Bottom">
				<img src="/assets/img/b_logo.gif" alt="CAREERCARE"/>
				COPYRIGHT(c) CAREERCARE ALL RIGHTS RESERVED
			</div>
			<!--// E: Bottom -->

		</div>

	</div>

</body>
</html>
