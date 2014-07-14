<script language="javascript" src="/assets/js/jquery.validate.js"></script>
<script>
	$(document).ready(function(){
		
				$("#form1").validate({  
	
				groups: {
					CMP_NO: "CMP_NO1 CMP_NO2 CMP_NO3",
					CRP_NO: "CRP_NO1 CRP_NO2",
					CMP_TEL: "CMP_TEL1 CMP_TEL2 CMP_TEL3",
					CMP_FAX: "CMP_FAX1 CMP_FAX2 CMP_FAX3"
				},
				
		    rules: {  
			
		        COMP_ID: {
		        	required:true,  
		        	digitchars:true,
		        	minlength:5,
		        	maxlength:15,
		        	remote: { 
		        		url : "/admin/companyManagement/checkCompanyId" , 
		        		type : "POST" ,
		        		data : { 
		        				COMP_ID:function() { 
		        						return $("#COMP_ID").val(); 
		        				} 
		        		}
		        	}
		        },
		        COMP_NM: { required:true },
	        	CMP_NO3: { required:true,digits:true,minlength:5 },
	        	CMP_NO2: { required:true,digits:true,minlength:2 },
		        CMP_NO1: { required:true,digits:true,minlength:3 },
		      	APPLY_SITE_TITLE: { required:true},
		      	APPLY_SITE_TEMPLATE: { required:true},
		        CRP_NO1: { required:true,digits:true},
		        CRP_NO2: { required:true,digits:true},
		        <? if ($COMP_ID == null) { ?>
		        DOMAIN_ID: { 
		        	required:true,
		        	digitchars:true,
		        	minlength:2,
		        	maxlength:20,
		        	remote: { 
		        		url : "/admin/companyManagement/checkCompanyDomain" , 
		        		type : "POST" ,
		        		data : { 
		        				DOMAIN_ID:function() { 
		        						return $("#DOMAIN_ID").val(); 
		        				} 
		        		}
		        	}
		        	},
		        <? }?>
		        CEO_NM: { required:true },
		        
		      	CMP_TEL1: { required:true },
		      	CMP_TEL2: { required:true,digits:true,minlength:3 },
		      	CMP_TEL3: { required:true,digits:true,minlength:4 },
		      	CMP_FAX1: { required:true },
		      	CMP_FAX2: { required:true,digits:true,minlength:3 },
		      	CMP_FAX3: { required:true,digits:true,minlength:4 },
		      	CMP_ADD: { required:true },
		      	CMP_TP: { required:true },
		      	CMP_GUBUN: { required:true }
		    },  
		    onkeyup:false,
		    messages: {
		    		COMP_ID:{
		    			required : "������̵� �Է��ϼ���.(�ּ� 5�ڸ�. �ִ� 15�ڸ� �������ڸ� ����)",
		    			digitchars:"����,������ �����մϴ�.",
		        	minlength:"������̵� �Է��ϼ���.(�ּ� 5�ڸ�. �ִ� 15�ڸ� �������ڸ� ����)",
		        	maxlength:"������̵� �Է��ϼ���.(�ּ� 5�ڸ�. �ִ� 15�ڸ� �������ڸ� ����)",
		    			remote : "�̵̹�ϵ� ���̵� �Դϴ�."
		    		},  
		    		COMP_NM:"������� �Է��ϼ���.",
		    		CMP_NO1:{
		    				required:"����ڵ�Ϲ�ȣ�� �Է��ϼ���",
		    				digits:"���ڸ� �Է°����մϴ�."
		    		},
		    		CMP_NO2:{
		    				required:"����ڵ�Ϲ�ȣ�� �Է��ϼ���",
		    				digits:"���ڸ� �Է°����մϴ�."
		    		},
		    		CMP_NO3:{
		    				required:"����ڵ�Ϲ�ȣ�� �Է��ϼ���",
		    				digits:"���ڸ� �Է°����մϴ�."
		    		},
		    		CRP_NO1:{
		    				required:"���ε�Ϲ�ȣ�� �Է��ϼ���",
		    				digits:"���ڸ� �Է°����մϴ�."
		    		},
		    		CRP_NO2:{
		    				required:"���ε�Ϲ�ȣ�� �Է��ϼ���",
		    				digits:"���ڸ� �Է°����մϴ�."
		    		},
		    		APPLY_SITE_TITLE: {required:"���� ����Ʈ ������ �Է��ϼ���."},
		      	APPLY_SITE_TEMPLATE: { required:"������ ���ø��� �����ϼ���."},
		    		DOMAIN_ID:{
		    				required:"�����θ��� �Է��ϼ���.",
		    				digitchars:"����,������ �����մϴ�.",
		    				maxlength:"�ִ�20�� �Դϴ�.",
		    				minlength:"�ּ�2�� �Դϴ�.",
		    				remote:"�̵̹�ϵ� ������ �Դϴ�."
		    		},
		    		CEO_NM:"��ǥ�ڸ��� �Է��ϼ���",
		    		CMP_TEL1:{
		    				required:"��ǥ��ȣ�� �Է��ϼ���."
		    		},
		    		CMP_TEL2:{
		    				required:"��ǥ��ȣ�� �Է��ϼ���.",
		    				digits:"���ڸ� �Է°����մϴ�.",
		    				minlength:"�ּ�3�ڸ� �Դϴ�."
		    		},
		    		CMP_TEL3:{
		    				required:"��ǥ��ȣ�� �Է��ϼ���.",
		    				digits:"���ڸ� �Է°����մϴ�.",
		    				minlength:"�ּ�4�ڸ� �Դϴ�."
		    		},
		    		CMP_FAX1:{
		    				required:"�ѽ���ȣ�� �����ϼ���."
		    		},
		    		CMP_FAX2:{
		    				required:"�ѽ���ȣ�� �Է��ϼ���.",
		    				digits:"���ڸ� �Է°����մϴ�.",
		    				minlength:"�ּ�3�ڸ� �Դϴ�."
		    		},
		    		CMP_FAX3:{
		    				required:"�ѽ���ȣ�� �Է��ϼ���.",
		    				digits:"���ڸ� �Է°����մϴ�.",
		    				minlength:"�ּ�4�ڸ� �Դϴ�."
		    		},
		    		CMP_ADD:"����� �������� �Է��ϼ���",
		    		CMP_TP:"���¸� �Է��ϼ���",
		    		CMP_GUBUN:"������ �Է��ϼ���"
		    		
		    },
		   
		    submitHandler: function(form) { 

		    	form.submit();

		    }
   	});  
   	
	});
	
	function processForm()
	{
		$("#submit_button").click();
	}
	
	
</script>
<style>
	
	#tmpl_list ul {float:left}
	#tmpl_list li {width:160px;text-align:center}
	
</style>
<form name="form1" id="form1" enctype="multipart/form-data" method="post" action="/admin/companyManagement/companyInfoProcess">
					<!-- S: �ۼ� -->
					<table class="BdView-Type01" summary="�Խù� ����, ��ȣ, �ۼ���, �����, ��ȸ��, ÷������ �� ������ �� �� �ֽ��ϴ�.">
						<caption>�Խñ� �󼼺���</caption>
						<colgroup>
							<col width="110px" />
							<col width="105px" />
							<col width="110px" />
							<col width="*" />
						</colgroup>
						
						<tbody>
							<? if ($COMP_ID == null) { ?>
							<tr>
								<th scope="row" colspan="3">
									<span class="item">*</span>
									<label for="w01">��� ���̵�</label>
								</th>
								<td>
									<input type="text" name="COMP_ID" id="COMP_ID"  value="<?=$COMP_NM?>" style="width:18%;"  />
									<label class="error" for="COMP_ID" generated="true" style="display:none;color:red;">error message</label>
								</td>
							</tr>
							<? } ?>
							<tr>
								<th scope="row" colspan="3">
									<span class="item">*</span>
									<label for="w01">��� ��</label>
								</th>
								<td>
									<input type="text" name="COMP_NM" id="COMP_NM" title="��� ��" value="<?=$COMP_NM?>" style="width:38%;" />
									<label class="error" for="COMP_NM" generated="true" style="display:none;color:red;">error message</label>
								</td>
							</tr>
							<tr>
								<th scope="row" colspan="3">
									<span class="item">*</span>
									<label for="w02">����� ��Ϲ�ȣ</label>
								</th>
								<td>
									<input type="text" name="CMP_NO1" id="CMP_NO1" title="����� ��Ϲ�ȣ �Է��ϼ���" style="width:30px;" maxlength="3" value="<?=$CMP_NO1?>"/>
									-
									<input type="text" name="CMP_NO2" id="CMP_NO2" title="����� ��Ϲ�ȣ �Է��ϼ���" style="width:20px;" maxlength="2" value="<?=$CMP_NO2?>"  />
									-
									<input type="text" name="CMP_NO3" id="CMP_NO3" title="����� ��Ϲ�ȣ �Է��ϼ���" style="width:50px;" maxlength="5" value="<?=$CMP_NO3?>"  />
									<label class="error" for="CMP_NO" generated="true" style="display:none;color:red;">error message</label>
								
								</td>
							</tr>
							<tr>
								<th scope="row" colspan="3">
									<span class="item">*</span>
									<label for="w03">���� ��Ϲ�ȣ</label>
								</th>
								<td>
									<input type="text" name="CRP_NO1" id="CRP_NO1" title="���� ��Ϲ�ȣ �Է�" style="width:60px;" maxlength="6" value="<?=$CRP_NO1?>" />
									-
									<input type="text" name="CRP_NO2" id="CRP_NO2" title="���� ��Ϲ�ȣ �Է�" style="width:70px;" maxlength="7" value="<?=$CRP_NO2?>"  />
									<label class="error" for="CRP_NO" generated="true" style="display:none;color:red;">error message</label>
								</td>
							</tr>
							<tr>
								<th scope="row" colspan="3">
									<span class="item">*</span>
									<label for="w04a">ä�� �ַ�� 2�� ������ �̸�</label>
								</th>
								<td>
									<? if ($COMP_ID == null) { ?>
									<input type="text" name="DOMAIN_ID" id="DOMAIN_ID" title="ä�� �ַ�� 2�� ������ �̸� �Է�" style="width:170px;" value="<?=$DOMAIN_ID?>"  />
									<label  class="error" for="DOMAIN_ID" generated="true" style="display:none;color:red;">error message</label>
									<? } ?>
									
									<? if ($COMP_ID != null) { ?>
									<?=$DOMAIN_ID?> <input type="hidden" id="DOMAIN_ID" name="DOMAIN_ID" value="<?=$DOMAIN_ID?>" />
									<? } ?>
									
								</td>
							</tr>
							<tr>
								<th scope="row" colspan="3">
									<span class="item">*</span>
									<label for="w05a">��ǥ�� ����</label>
								</th>
								<td>
										<input type="text" name="CEO_NM" id="CEO_NM" title="��ǥ�� ���� �Է�" style="width:170px;" value="<?=$CEO_NM?>" />
										<label class="error" for="CEO_NM" generated="true" style="display:none;color:red;">error message</label>
									</td>
							</tr>
							<tr>
								<th scope="row" colspan="3">
									<span class="item">*</span>
									<label for="w06a">��ǥ ��ȣ</label>
								</th>
								<td>
									<?=$SELECTBOX_TEL?>
									-
									<input type="text" name="CMP_TEL2" id="CMP_TEL2" title="��ǥ ��ȣ �Է�" style="width:40px;" value="<?=$TEL2?>" maxlength="4" />
									-
									<input type="text" name="CMP_TEL3" id="CMP_TEL3" title="��ǥ ��ȣ �Է�" style="width:40px;" value="<?=$TEL3?>" maxlength="4" />
									<label class="error" for="CMP_TEL" generated="true" style="display:none;color:red;">error message</label>
								</td>
							</tr>
							<tr>
								<th scope="row" colspan="3">
									<span class="item">*</span>
									<label for="w07">�ѽ� ��ȣ</label>
								</th>
								<td>
									<?=$SELECTBOX_FAX?>
									-
									<input type="text" name="CMP_FAX2" id="CMP_FAX2" title="�ѽ� ��ȣ �Է�" style="width:40px;" value="<?=$FAX2?>" maxlength="4"  />
									-
									<input type="text" name="CMP_FAX3" id="CMP_FAX3" title="�ѽ� ��ȣ �Է�" style="width:40px;" value="<?=$FAX3?>" maxlength="4"  />
									<label class="error" for="CMP_FAX" generated="true" style="display:none;color:red;">error message</label>
								</td>
							</tr>
							<tr>
								<th scope="row" colspan="3">
									<span class="item">*</span>
									<label for="w07">����� ������</label>
								</th>
								<td>
									<input type="text" name="CMP_ADD" id="CMP_ADD" title="����� ������ �Է�" style="width:200px;" value="<?=$CMP_ADD?>" />
									<label class="error" for="CMP_ADD" generated="true" style="display:none;color:red;">error message</label>
								</td>
							</tr>
							<tr>
								<th scope="row" colspan="3">
									<span class="item">*</span>
									<label for="w07">����� ���� - ����</label>
								</th>
								<td>
									<input type="text" name="CMP_TP" id="CMP_TP" title="����� ���� - ���� �� �Է�" style="width:200px;" value="<?=$CMP_TP?>" />
									<label class="error" for="CMP_TP" generated="true" style="display:none;color:red;">error message</label>
								</td>
							</tr>
							<tr>
								<th scope="row" colspan="3">
									<span class="item">*</span>
									<label for="w07">����� ���� - ����</label>
								</th>
								<td>
									<input type="text" name="CMP_GUBUN" id="CMP_GUBUN" title="����� ���� - ���� �� �Է�" style="width:200px;" value="<?=$CMP_GUBUN?>" />
									<label class="error" for="CMP_GUBUN" generated="true" style="display:none;color:red;">error message</label>
								</td>
							</tr>
							<tr>
								<th scope="row" colspan="3">
									<span class="item">*</span>
									<label for="w07">���� ����Ʈ TITLE</label>
								</th>
								<td>
									<input type="text" name="APPLY_SITE_TITLE" id="APPLY_SITE_TITLE" title="���� ����Ʈ ����" style="width:200px;" value="<?=$APPLY_SITE_TITLE?>" />
									<label class="error" for="APPLY_SITE_TITLE" generated="true" style="display:none;color:red;">error message</label>
								</td>
							</tr>
							<tr>
								<th scope="row" colspan="3">
									<span class="item">*</span>
									<label for="w07">���� ����Ʈ ���ø�</label>
								</th>
								<td>
									
									<div id="tmpl_list">
									<ul>
										<li>main:700x340 sub:700x232</li>
										<li><img src="/assets/img/template_thumb/design1.jpg" /></li>
										<li><input class="radio" type="radio" name="APPLY_SITE_TEMPLATE" id="APPLY_SITE_TEMPLATE" title="���� ����Ʈ ���ø�" value="design1" <?=$APPLY_SITE_TEMPLATE == 'design1' ? ' checked ' : '' ?> /></li>
									</ul>
									<ul>
										<li>main:900x420 sub:900x210</li>
										<li><img src="/assets/img/template_thumb/design2.jpg" /></li>
										<li><input class="radio" type="radio" name="APPLY_SITE_TEMPLATE" id="APPLY_SITE_TEMPLATE" title="���� ����Ʈ ���ø�" value="design2" <?=$APPLY_SITE_TEMPLATE == 'design2' ? ' checked ' : '' ?> /></li>
									</ul>
									<ul>
										<li>main:980x440 sub:980x250</li>
										<li><img src="/assets/img/template_thumb/design3.jpg" /></li>
										<li><input class="radio" type="radio" name="APPLY_SITE_TEMPLATE" id="APPLY_SITE_TEMPLATE" title="���� ����Ʈ ���ø�" value="design3" <?=$APPLY_SITE_TEMPLATE == 'design3' ? ' checked ' : '' ?> /></li>
									</ul>
									
									</div>
									
									<label class="error" for="APPLY_SITE_TEMPLATE" generated="true" style="display:none;color:red;">error message</label>
								</td>
							</tr>
							<tr>
								<th scope="row" colspan="3" rowspan="2">
								
									<label for="w07">��� LOGO ���</label>
								</th>
								<td>
									<input type="file" name="LOGO_IMG1" id="LOGO_IMG1" title="��� LOGO �Է�" style="width:38%;"/>

									<img src="<?=$LOGO_IMG1?>" id="id_logo_img1" width="203" height="36" >
								</td>
							</tr>
							<tr>
								
								<td>
									<input type="file" name="LOGO_IMG2" id="LOGO_IMG2" title="��� LOGO �Է�" style="width:38%;" />
									<img src="<?=$LOGO_IMG2?>" id="id_logo_img2" width="203" height="36" >
								</td>
							</tr>
							
							<tr>
								<th scope="row" colspan="3" rowspan="2">
								
									<label for="w07">��������Ʈ TOP�̹���</label>
								</th>
								<td>
									<input type="file" name="TOP_IMG1" id="TOP_IMG1" title="���� �̹���  �Է�" style="width:38%;"/>

									<img src="<?=$FRONT_MAIN_IMG?>" id="id_logo_img1" width="203" height="36" >
								</td>
							</tr>
							<tr>
								
								<td>
									<input type="file" name="TOP_IMG2" id="TOP_IMG2" title="���� �̹��� �Է�" style="width:38%;" />
									<img src="<?=$FRONT_SUB_IMG?>" id="id_logo_img2" width="203" height="36" >
								</td>
							</tr>
							
							<tr>
								<th scope="row" colspan="3">
									<label for="w07">Q&A ���� ���� �ޱ�</label>
								</th>
								<td>
									<input type="radio" name="QNA_MAIL" id="QNA_MAIL" value="Y" class="radio" <? if ($QNA_MAIL == 'Y' OR $QNA_MAIL == null) echo ' checked '; ?> /><label for="w06a" class="mgr5">����</label>
									<input type="radio" name="QNA_MAIL" id="QNA_MAIL" value="N" class="radio" <? if ($QNA_MAIL == 'N') echo ' checked '; ?>  /><label for="w06b">�Ұ���</label>
								</td>
							</tr>
							<tr>
								<th scope="row" colspan="3">
									<label for="w07">� ��Ȳ</label>
								</th>
								<td>
									<input type="radio" name="SRV_STS" id="SRV_STS" value="Y" class="radio" <? if ($SRV_STS == 'Y' OR $QNA_MAIL == null) echo ' checked '; ?>  /><label for="w06a" class="mgr5">����</label>
									<input type="radio" name="SRV_STS" id="SRV_STS" value="N" class="radio" <? if ($SRV_STS == 'N') echo ' checked '; ?>  /><label for="w06b">�Ұ���</label>
								</td>
							</tr>
							<tr>
								<th scope="row" colspan="3">
									<label for="w07">������Ʈ ���� ����</label>
								</th>
								<td>
									<input type="radio" name="PRJ_MNG" id="PRJ_MNG" value="Y" class="radio" <? if ($PRJ_MNG == 'Y' OR $QNA_MAIL == null) echo ' checked '; ?>  /><label for="w06a" class="mgr5">����</label>
									<input type="radio" name="PRJ_MNG" id="PRJ_MNG" value="N" class="radio" <? if ($PRJ_MNG == 'N') echo ' checked '; ?>  /><label for="w06b">�Ұ���</label>
								</td>
							</tr>
							
						</tbody>
					</table>		
					
					<!--// E: �ۼ� -->
					
					<input type="hidden" name="LOGO_IMG1_FILE" id="LOGO_IMG1_FILE" value="<?=$LOGO_IMG1_FILE?>" />
					<input type="hidden" name="LOGO_IMG2_FILE" id="LOGO_IMG2_FILE" value="<?=$LOGO_IMG2_FILE?>" />
					
					<input type="hidden" name="process_type" id="process_type" value="<?=$process_type?>" />
					<? if ($COMP_ID != null) { ?>
					<input type="hidden" name="COMP_ID" id="COMP_ID" value="<?=$COMP_ID?>" />
					<? } ?>
					<input type="submit" id="submit_button" style="display:none">
					<div class="txtC">
						<span class="btn01"><a href="javascript:processForm();">Ȯ��</a></span>
					
						<span class="btn02"><a href="javascript:goLink('<?=$backURL?>')">���ư���</a></span>
					
					</div>
	</form>			