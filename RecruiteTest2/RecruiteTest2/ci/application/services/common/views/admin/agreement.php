<script language="javascript" src="/assets/js/jquery.validate.js"></script>
<script>
	
	function checkAgree()
	{	
		$("#submit_button").click();
		/*
		if (!$("#s01_1").attr('checked')) 
		{
			alert('�̿����� �����ϼž� �մϴ�.');
		} 
		else if (!$("#s02_1").attr('checked')) 
		{
			alert('�������� ������ �����ϼž� �մϴ�.');
		}
		else if ($("#password_tem").val() == '' ) 
		{
			alert('�ӽú�й�ȣ�� �Է��ϼ���');
		}		
		else if ($("#password").val() == '' ) 
		{
			alert('�����Ͻ� ��й�ȣ�� �Է��ϼ���.');
		}
		else if ($("#password_re").val() == '' ) 
		{
			alert('�����Ͻ� ��й�ȣ�� Ȯ�ζ��� �Է��ϼ���.');
		}
		else if ( $("#mobile01:selected").val() == '' || $("#mobile02").val() == '' || $("#mobile03").val() == '' )
		{
			alert('�޴�����ȣ�� �Է��ϼ���.');
		}
		else if ($("#password").val() != $("#password_re").val() ) 
		{
			alert('������ ��й�ȣ�� ��й�ȣ Ȯ���� �ٸ��ϴ�.');
		}	
		else if ($("#password_tem").val() == $("#password").val() ) 
		{
			alert('�ӽú�й�ȣ�� ������ ��й�ȣ�� �����ϴ�.');
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
		    		s01_1:"���� üũ �� �̿� �����Ͻʴϴ�.",
		    		s02_1:"���� üũ �� �̿� �����Ͻʴϴ�.",
		    		password_tem:{
		    				required:"�ӽú�й�ȣ�� �Է��ϼ���",
		    				minlength:"�ּ� 5���̻��Դϴ�.",
		    				maxlength:"�ִ� 20���Դϴ�."},
		    		password:{
		    				required:"��й�ȣ�� �Է��ϼ���",
		    				minlength:"�ּ� 5���̻��Դϴ�.",
		    				maxlength:"�ִ� 20���Դϴ�.",
							notEqual:"�ӽú�й�ȣ�� ��й�ȣ�� �ٸ��� �Է��ϼ���."},
		    		password_re:{
		    				required:"��й�ȣ�� �ٽ�Ȯ���ϼ���.",
		    				minlength:"�ּ� 5���̻��Դϴ�.",
		    				maxlength:"�ִ� 20���Դϴ�.",
		    				equalTo:"��й�ȣ�� �ٸ��ϴ�. �ٽ��Է��ϼ���."},
		    		mobile:"�޴�����ȣ�� �Է��ϼ���.",
		    		mobile01:{required:"�޴�����ȣ�� �����ϼ���."},
		    		mobile02:{
		    				required:"�޴��� ��ȣ�� �Է��ϼ���.",
		    				digits:"���ڸ� �Է��ϼ���",
		    				minlength:"3�ڸ��� �̻��Դϴ�."},
		    		mobile03:{
		    				required:"�޴��� ��ȣ�� �Է��ϼ���.",
		    				digits:"���ڸ� �Է��ϼ���",
		    				minlength:"4�ڸ��Դϴ�."}
		    },
		    submitHandler: function(form) { 

	    	form.submit();

	    	}
   	});  
	}

</script>
					
					
					<h2 class="H2blt">�̿���</h2>
					<form id="agrFrom" name="agrFrom" action="/admin/agreement/agreeProcess" method="post">
					<div class="terms-box">
					<?=$admin_agreement?>
					</div>

					<div class="txtC mgb10">
						<input type="checkbox" name="s01_1" id="s01_1" value="1" class="checkbox" /><label for="s01_1" class="mgr5">���� �մϴ�.</label>
						<!--input type="radio" name="s01_1" id="s01_1" value="2" class="radio" /><label for="s01_2">�������� �ʽ��ϴ�.</label-->
						<label class="error" for="s01_1" generated="true" style="display:none;color:red;">error message</label>	
					</div>

					<h2 class="H2blt">�������� ���� �� �̿뿡 ���� �ȳ�</h2>
					<div class="terms-box">
					<?=$admin_information?>
					</div>

					<div class="txtC mgb10">
						<input type="checkbox" name="s02_1" id="s02_1" value="1" class="checkbox" /><label for="s02_1" class="mgr5">���� �մϴ�</label>
						<!--input type="radio" name="s02_1" id="s02_1" value="2" class="radio" /><label for="s02_2">�������� �ʽ��ϴ�.</label-->
						<label class="error" for="s02_1" generated="true" style="display:none;color:red;">error message</label>	
					</div>

					<h2 class="H2blt">ȸ�� ���� Ȯ�� �� ����</h2>
					<table class="BdView-Type01" summary="�Խù� ����, ��ȣ, �ۼ���, �����, ��ȸ��, ÷������ �� ������ �� �� �ֽ��ϴ�.">
						<caption>�Խñ� �󼼺���</caption>
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
									<label for="name">�̸�</label>
								</th>
								<td><?=$LoginNm?></td>
								<th scope="row" class="bdLine">
									<label for="password_tem">�ӽú�й�ȣ</label>
								</th>
								<td colspan="3">
									<input type="password" name="password_tem" id="password_tem" title="�ӽú�й�ȣ �Է�" style="width:140px;" />
									<label class="error" for="password_tem" generated="true" style="display:none;color:red;">error message</label>	
								</td>
							</tr>
							<tr>
								<th scope="row">
									<label for="password">��й�ȣ</label>
								</th>
								<td>
									<input type="password" name="password" id="password" style="width:140px;" />
									<label class="error" for="password" generated="true" style="display:none;color:red;">error message</label>	
								</td>
								<th scope="row" class="bdLine">
									<label for="password_re">��й�ȣ Ȯ��</label>
								</th>
								<td>
									<input type="password" name="password_re" id="password_re" title="��й�ȣ Ȯ�� �Է�" style="width:140px;"  />
									<label class="error" for="password_re" generated="true" style="display:none;color:red;">error message</label>	
								</td>
								<th scope="row" class="bdLine">
									<label for="mobile01">�ڵ���</label>
								</th>
								<td>
									<?=$SELECTBOX_mobile01?> -
									<input type="text" name="mobile02" id="mobile02" title="��� �Է�" style="width:50px;" maxlength="4" /> -
									<input type="text" name="mobile03" id="mobile03" title="������ �Է�" style="width:50px;" maxlength="4" />
									<label class="error" for="mobile" generated="true" style="display:none;color:red;">error message</label>	
								</td>
							</tr>
						</tbody>
					</table>
					<input type="submit" id="submit_button" style="display:none;">
					<div class="txtC mgb10">
						<span class="btn01"><a href="javascript:checkAgree();">Ȯ��</a></span>
					</div>
				</form>