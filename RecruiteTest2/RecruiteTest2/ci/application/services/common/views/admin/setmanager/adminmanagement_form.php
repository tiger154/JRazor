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
			    			required:"���̵� �Է��ϼ���.",
								minlength:"�ּ� 6�� �Դϴ�.",
								maxlength:"�ִ� 20�� �Դϴ�.",
								digitchars:"����,������ �Է°����մϴ�.",
								remote:"�̹� ��ϵ� ���̵��Դϴ�."
			    		},
			    		
			    		
			    		MANAGER_NM:"�̸��� �Է��ϼ���",
							DEPT:"�μ��� �Է��ϼ���",
							PSTN:"������ �Է��ϼ���",
							TEL1:"����ó�� �Է��ϼ���",
							TEL2:{
								required:"����ó�� �Է��ϼ���",
								digits:"���ڸ� �Է°����մϴ�.",
								minlength:"�ּ� 3�ڸ��̻��Դϴ�."
							},
							TEL3:{
								required:"����ó�� �Է��ϼ���",
								digits:"���ڸ� �Է°����մϴ�.",
								minlength:"�ּ� 4�ڸ��Դϴ�."
							},
							MOBILE1:"�޴�����ȣ�� �����ϼ���",
							MOBILE2:{
								required:"����ó�� �Է��ϼ���",
								digits:"���ڸ� �Է°����մϴ�.",
								minlength:"�ּ� 3�ڸ��̻��Դϴ�."
							},
							MOBILE3:{
								required:"����ó�� �Է��ϼ���",
								digits:"���ڸ� �Է°����մϴ�.",
								minlength:"�ּ� 4�ڸ��Դϴ�."
							},
							EMAIL:{
								required:"�̸����� �Է��ϼ���",
								email:"�̸��������� Ȯ���ϼ���"
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

<p class="txtR F11 mgb5"><span class="orange ">*</span> ǥ�úκ��� �ʼ��Է»����Դϴ�.</p>
<form name="form1" id="form1" method="post">
			<table class="BdView-Type01" summary="������ ����">
				<caption>������ ����</caption>
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
							<input type="text" name="MANAGER_ID" id="MANAGER_ID" title="ID �� �Է��ϼ���."  style="width:128px;" value="<?=$MANAGER_ID?>" class="required" />
							<label class="error" for="MANAGER_ID" generated="true" style="display:none;color:red;">error message</label>
						</td>
					</tr>
					<? } ?>
					
					<? if ($MANAGER_ID != null) { ?>
					<tr>
						<th scope="row">
							<label for="id">��й�ȣ ����</label>
						</th>
						
						<td>
							<input type="checkbox" name="PWD_CHECK_YN" id="PWD_CHECK_YN" value="Y" class="checkbox" onclick="javascript:checkPassword();" />
							��й�ȣ�� �����Ͻ÷��� üũ�ϼ���.
						</td>
					</tr>
					<? } ?>
					
					<tr>
						<th scope="row">
							<label for="password"><span class="item">*</span>��й�ȣ</label>
						</th>
						<td>
							<input type="password" name="MANAGER_PW" id="MANAGER_PW" title="��й�ȣ �Է�" style="width:128px;"  />
							<label class="error" for="MANAGER_PW" generated="true" style="display:none;color:red;">error message</label>
						</td>
					</tr>
					<tr>
						<th scope="row">
							<label for="password_re"><span class="item">*</span>��й�ȣ Ȯ��</label>
						</th>
						<td>
							<input type="password" name="MANAGER_PWRE" id="MANAGER_PWRE" title="��й�ȣ Ȯ�� �Է��ϼ���." style="width:128px;" />
							<label class="error" for="MANAGER_PWRE" generated="true" style="display:none;color:red;">error message</label>
						</td>
					</tr>
					<tr>
						<th scope="row">
							<label for="manager"><span class="item">*</span>�����</label>
						</th>
						<td>
							<input type="text" name="MANAGER_NM" id="MANAGER_NM" title="����� �Է�" style="width:128px;" value="<?=$MANAGER_NM?>"  class="required" />
							<label class="error" for="MANAGER_NM" generated="true" style="display:none;color:red;">error message</label>
						</td>
					</tr>
					<tr>
						<th scope="row">
							<label for="division"><span class="item">*</span>�μ�</label>
						</th>
						<td>
							<input type="text" name="DEPT" id="DEPT" title="�μ� �Է�" style="width:128px;" value="<?=$DEPT?>" />
							<label class="error" for="DEPT" generated="true" style="display:none;color:red;">error message</label>
						</td>
					</tr>
					<tr>
						<th scope="row">
							<label for="position"><span class="item">*</span>����</label>
						</th>
						<td>
							<input type="text" name="PSTN" id="PSTN" title="���� �Է�" style="width:128px;" value="<?=$PSTN?>" />
							<label class="error" for="PSTN" generated="true" style="display:none;color:red;">error message</label>
						</td>
					</tr>
					<tr>
						<th scope="row">
							<label for="phone01"><span class="item">*</span>��ȭ��ȣ</label>
						</th>
						<td>
							<?=$SELECTBOX_TEL?> -
							<input type="text" name="TEL2" id="TEL2" value="<?=$TEL2?>" maxlength="4" title="��� �Է�" style="width:30px;" /> -
							<input type="text" name="TEL3" id="TEL3" value="<?=$TEL3?>" maxlength="4" title="������ �Է�" style="width:30px;" />
							<label class="error" for="TEL" generated="true" style="display:none;color:red;">error message</label>
						</td>
					</tr>
					<tr>
						<th scope="row">
							<label for="mobile01">�ڵ���</label>
						</th>
						<td>
							<?=$SELECTBOX_MOBILE?> -
							<input type="text" name="MOBILE2" id="MOBILE2" value="<?=$MOBILE2?>" maxlength="4"  title="��� �Է�" style="width:30px;" /> -
							<input type="text" name="MOBILE3" id="MOBILE3" value="<?=$MOBILE3?>" maxlength="4"  title="������ �Է�" style="width:30px;" />
							<label class="error" for="MOBILE" generated="true" style="display:none;color:red;">error message</label>
						</td>
					</tr>
					<tr>
						<th scope="row">
							<label for="email"><span class="item">*</span>�̸���</label>
						</th>
						<td>
							<input type="text" name="EMAIL" id="EMAIL" value="<?=$EMAIL?>" title="�̸��� �Է�" style="width:128px;" />
							<label class="error" for="EMAIL" generated="true" style="display:none;color:red;">error message</label>
						</td>
					</tr>
					<tr>
						<th scope="row">
							<label for="email"><span class="item">*</span>��� ����</label>
						</th>
						<td>
							<input type="radio" name="USE_YN" id="USE_YN" title="��� ����" class="radio" value="Y" <?=$USE_YN == 'Y' || $USE_YN == null ? ' checked ' : '';?> />���
							&nbsp;
							<input type="radio" name="USE_YN" id="USE_YN" title="��� ����" class="radio" value="N" <?=$USE_YN == 'N' ? ' checked ' : '';?>/>����
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
				<span class="btn01"><a href="javascript:processForm();">Ȯ��</a></span>
				<span class="btn02"><a href="javascript:window.close();">�ݱ�</a></span>
			</div>
</form>