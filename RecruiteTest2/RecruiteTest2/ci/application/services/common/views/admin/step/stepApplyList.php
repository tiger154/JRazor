<script language="javascript" src="/assets/js/jquery.validate.js"></script>
<script>
	
	function bodyOnLoad()
	{
		
		$("#form1").validate({  
				groups:{SCH_ERR_MSG:"CAREER_SYEAR CAREER_EYEAR NAI_ST NAI_ED"},
		    rules: {
		    	CAREER_SYEAR:{digits:true},
		    	CAREER_EYEAR:{digits:true},
		    	NAI_ST:{digits:true},
		    	NAI_ED:{digits:true}
		    },  
		    onkeyup:false,
		    messages: {
		    	CAREER_SYEAR:{digits:"[��³��]���ڸ� �Է��ϼ���"},
		    	CAREER_EYEAR:{digits:"[��³��]���ڸ� �Է��ϼ���"},
		    	NAI_ST:{digits:"[����]���ڸ� �Է��ϼ���"},
		    	NAI_ED:{digits:"[����]���ڸ� �Է��ϼ���"}
		    },
		    submitHandler: function(form) { 
				
	    	form.submit();

	    	}
   	});  
	}
	
	function changeProject(obj)
	{
		$("#PRJ_IDX").val(obj.value);
		$("#form1").submit();
	}
	
	function PageNumClick(page)
	{
		
		$("#form1").attr("method","post");
		$("#form1").submit();
	}
	
	function actStep(code)
	{
		$("#STEP_IDX").val(code);
		$("#form1").submit();
	}
	
	function actApplyMoveStep()
	{
		//alert($("#APP_LIST").val());
		var app_list = '';
		var x = 0;
		for(var a = 0 ;a < <?=count($appList)?> ; a ++)
		{
			if ($("#APP_LIST" + a).is(":checked"))
			{
				app_list += $("#APP_LIST" + a).val() + '|';
				x++;
			}
		}
		if (x > 0)
		{
			if ($("#SCH_STEP_IDX option:selected").val() == $("#STEP_IDX").val())
			{
				alert('���� ������ �̵��� ������ �����ϴ�.');
			}
			else
			{
				$("#APPLY_LIST").val(app_list);
				$("#TARGET_STEP_IDX").val($("#SCH_STEP_IDX option:selected").val());
				//$("#form1").attr("action","/admin/stepManagement/applyStepUpdateProcess");
				//$("#form1").submit();
				
				var serializedData = $("#form1").serialize();
				
				$.ajax({
        url: "/admin/stepManagement/applyStepUpdateProcess",
        type: "post",
        data: serializedData,
        success: function(response, textStatus, jqXHR){
            // log a message to the console
            //console.log("Hooray, it worked!");
           // alert(response);
            if (response == 'OK')
            {
            	alert('�̵��Ǿ����ϴ�.');
            	//$("#form1").attr("action","/admin/stepManagement/applyList");
            	$("#form1").submit();
            }
        },
        error: function(jqXHR, textStatus, errorThrown){
            //console.log("The following error occured: "+textStatus, errorThrown);
        },
        // callback handler that will be called on completion
        // which means, either on success or error
        complete: function(){
        	  // enable the inputs
        }
				});


				
			}
		}
		else
		{
			alert('�̵��� �����ڸ� �����ϼ���');
		}
	}
	
	function goProcess(code)
	{
		$("#EXCEL_FLAG").val(code);
		$("#SUBMIT_BUTTON").click();
	}
	
	function goView(apply_no) // ������ ����
	{
		$("#SPRJ_IDX").val($("#PRJ_IDX").val());
		$("#APPLY_NO").val(apply_no);
		$("#form2").attr("action","/front/apply/applyView");
		$("#form2").attr("method","post");
		$("#form2").attr("target","blank");
		$("#form2").submit();
	}
	
	function goModify(apply_no) // ������ ����
	{
		$("#SPRJ_IDX").val($("#PRJ_IDX").val());
		$("#APPLY_NO").val(apply_no);
		$("#form2").attr("action","/front/apply");
		$("#form2").attr("method","post");
		$("#form2").attr("target","blank");
		$("#form2").submit();
	}
	
	function goHistory(apply_no) // �̷�����
	{
		//getApplyStepHistory($arg)
		goLink('','pop','width=650 height=500 resizable=yes scrollbars=yes status=yes');
		$("#form2").attr('target','open_pops');
		$("#SPRJ_IDX").val($("#PRJ_IDX").val());
		$("#APPLY_NO").val(apply_no);
		$("#form2").attr("action","/admin/stepManagement/applyStepHistory");
		$("#form2").attr("method","post");
		
		$("#form2").submit();
	}
	
	function goPassword(APPL_IDX) // �н������ʱ�ȭ
	{
		
		//getApplyStepHistory($arg)
		goLink('','pop','width=350 height=137 resizable=yes scrollbars=yes status=yes');
		$("#form2").attr('target','open_pops');
		$("#SPRJ_IDX").val($("#PRJ_IDX").val());
		$("#APPL_IDX").val(APPL_IDX);
		$("#form2").attr("action","/admin/stepManagement/applyPasswordReset");
		$("#form2").attr("method","post");
		
		$("#form2").submit();
		
	}
	
	var checked_flag = 1;
	
	function selChecked()
	{
		
		var x = 0;
		if ( checked_flag == 1 )
		{
			while (x > -1)
			{
				if ( $("#APP_LIST" + x).length == 0 ) break;
				$("#APP_LIST" + x).attr("checked",true);
				x++;
			}
			checked_flag = 0;
			
		}
		else
		{
			while (x > -1)
			{
				if ( $("#APP_LIST" + x).length == 0 ) break;
				$("#APP_LIST" + x).attr("checked",false);
				x++;
			}
			checked_flag = 1;
			
		}
	}
	
</script>
<style>
	
	#Sch-box {width:100%;}
	#Sch-box th {text-align:left;}
	#Sch-box td {text-align:left;}
	
	
</style>
<form name="form2" id="form2" method="post" >
	
<input type="hidden" id="APPL_IDX" name="APPL_IDX" />
<input type="hidden" id="APPLY_NO" name="APPLY_NO" />
<input type="hidden" id="SPRJ_IDX" name="SPRJ_IDX" />
<input type="hidden" id="ADMIN_FLAG" name="ADMIN_FLAG" value="<?=$code?>" />
</form>
<form name="form1" id="form1" method="post" action="/admin/stepManagement/applyList">
<input type="hidden" name="TARGET_STEP_IDX" id="TARGET_STEP_IDX" />
<input type="hidden" name="APPLY_LIST" id="APPLY_LIST" />	
<input type="hidden" name="STEP_IDX" id="STEP_IDX" value="<?=$STEP_IDX?>" />
<input type="hidden" id="EXCEL_FLAG" name="EXCEL_FLAG" value="">
					<div id="Sch-box">
						<table summary="������ ���� ����">
							
							<colgroup>
								<col width="20px" />
								<col width="90px" />
								<col width="*" />
								
								<col width="20px" />
								<col width="90px" />
								<col width="*" />
								
								<col width="20px" />
								<col width="90px" />
								<col width="*" />
								
							</colgroup>
							<tbody>
								<tr>
									<td></td>	
									<th scope="row"><label for="w01">ä�����</label></th>
									<td><?=$SELECTBOX_PRJ_IDX?></td>
									
									<td></td>	
									<th scope="row"><label for="w02">�����о�</label></th>
									<td><?=$SELECTBOX_UNIT_IDX?></td>
									
									<td></td>	
									<th scope="row"><label for="w03a">��ϼ�</label></th>
									<td>���������� <?=$SELECTBOX_SCH_LIST_COUNT?> ����</td>
									
								</tr>
							
								<!-- �⺻ �������� -->
								<? if ($rsmDataUseYn[0]->PERSONAL_USE_YN == 'Y') { ?>
								<tr>
									<td></td>
									<th scope="row"><label for="w01">����</label></th>
									<td><input type="text" name="NAMEKOR" id="NAMEKOR" title="���� �Է�" style="width:120px;" value="<?=$NAMEKOR?>" /></td>
										
									<td></td>	
									<th scope="row"><label for="w02">����</label></th>
									<td><input type="text" style="width:30px" id="S_NAI" name="S_NAI" value="<?=$S_NAI?>" /> ~ <input type="text" style="width:30px" id="E_NAI" name="E_NAI" value="<?=$E_NAI?>" /></td>									
									
									<td></td>	
									<th scope="row"><label for="w03a">����</label></th>
									<td>
										<input type="radio" name="SEX_CD" id="SEX_CD" value="" class="radio" <?=$SEX_CD == '' ? ' checked ' : ''; ?> />��ü
										<input type="radio" name="SEX_CD" id="SEX_CD" value="M" class="radio" <?=$SEX_CD == 'M' ? ' checked ' : ''; ?> />����
										<input type="radio" name="SEX_CD" id="SEX_CD" value="F" class="radio" <?=$SEX_CD == 'F' ? ' checked ' : ''; ?> />����
									</td>
									
								</tr>
								<? } ?>
								
								<? if ($rsmDataUseYn[0]->SCHOOL_USE_YN == 'Y') { ?>
								<!-- �з»��� -->
								<tr>
									<td></td>
									<th scope="row"><label for="w04a">�����з�</label></th>
									<td>
										<?=$SELECTBOX_SCH_TP?>
										<input id="SCH_FGRD_TP" name="SCH_FGRD_TP" class="checkbox" type="checkbox" value="Y" <?=$SCH_FGRD_TP == 'Y' ? ' checked ' : ''; ?> />
										
									</td>
									
									<td></td>
									<th scope="row"><label for="w05a">����</label></th>
									<td>
											<input type="text" name="SCH_MAJOR_NM" id="SCH_MAJOR_NM" title="�б��� �Է�" style="width:92%;" value="<?=$SCH_MAJOR_NM?>" />
									</td>
									
									<td></td>
									<th scope="row"><label for="w06">�б���</label></th>
									<td>
										<input type="text" name="SCH_NM" id="SCH_NM" title="�б��� �Է�" style="width:92%;"  value="<?=$SCH_NM?>" />
									</td>
								</tr>
								
								
								<? } ?>
								<? if ($rsmDataUseYn[0]->CAREER_USE_YN == 'Y') { ?>
								
								<tr>
									<td></td>
									<th scope="row"><label for="w07">���</label></th>
									<td>
										<input type="radio" name="CAREER_TP" id="CAREER_TP" value="" class="radio" <?=$CAREER_TP == '' ? ' checked ' : ''; ?> />��ü
										<input type="radio" name="CAREER_TP" id="CAREER_TP" value="N" class="radio" <?=$CAREER_TP == 'N' ? ' checked ' : ''; ?>/>����
										<input type="radio" name="CAREER_TP" id="CAREER_TP" value="C" class="radio" <?=$CAREER_TP == 'C' ? ' checked ' : ''; ?> />���
									</td>
									
									<td></td>
									<th scope="row"><label for="w09a">��³��</label></th>
									<td>
										<input type="text" name="S_CAREER_SUM" id="S_CAREER_SUM" title="��³�� �Է�" style="width:30px;" value="<?=$S_CAREER_SUM?>" /> �� �̻� ~
										<input type="text" name="E_CAREER_SUM" id="E_CAREER_SUM" title="��³�� �Է�" style="width:30px;" value="<?=$E_CAREER_SUM?>" /> �� ����
									</td>
									
									<td></td>
									<th scope="row"><label for="w08a">ȸ���</label></th>
									<td>
										<input type="text" name="CAREER_CMP_NM" id="CAREER_CMP_NM" title="ȸ��� �Է�" style="width:92%;" value="<?=$CAREER_CMP_NM?>" />
									</td>
									
								</tr>
								<? } ?>
								<? if ($rsmDataUseYn[0]->LANGUAGE_USE_YN == 'Y') { ?>
								<tr>
									<TD></TD>
									<th scope="row"><label for="w12">���н���</label></th>
									<td>
										<?=$SELECTBOX_LAN_IDX?>
									</td>
									
									<TD></TD>
									<th scope="row"></th>
									<td></td>
									
									<TD></TD>
									<th scope="row"></th>
									<td></td>
								</tr>
								<? } ?>
								
							</tbody>
						</table>
						<div class="txtC mgt10">
							<label class="error" for="SCH_ERR_MSG" generated="true" style="display:none;color:red;">error message</label>	
						</div>	
						<div class="txtC mgt10">
							<input type="submit" id="SUBMIT_BUTTON" style="display:none;" />
							<span class="btn02"><a href="#">�����ʱ�ȭ</a></span>
							<span class="btn01"><a href="javascript:goProcess('SEARCH');">�˻�</a></span>
						</div>						
					</div>

					<!-- S: �˻� -->
					<div id="Bd-top-sch">
						<div class="page">
							�˻���� �� :<span class="orange bold mgr10"><?=number_format($rowCount)?> ��</span>
							<span class="btn04"><a href="javascript:goProcess('excel');">�����ٿ�ε�</a></span>
						</div>
						<div class="sch">
							<span class="btn04"><a href="javascript:selChecked();">��ü ����</a></span>
							<span class="btn04"><a href="#">�μ�</a></span>
							<span class="btn04"><a href="#">���� �߼�</a></span>
							<span class="btn04"><a href="#">SMS �߼�</a></span>
						</div>
					</div>
					<!-- E: �˻� -->
</form>

					<ul class="tabStyle02">
						<li <? if (!$STEP_IDX) echo 'class="on"'; ?>><a href="javascript:actStep('');">��������ü</a></li>
						<? foreach ($stepData as $key => $data) { ?>
						<li <? if ($STEP_IDX == $data->CODE) echo 'class="on"'; ?>><a href="javascript:actStep(<?=$data->CODE?>);"><?=$data->NAME?></a></li>
					  <? } ?>
					</ul>

					<table id="BdList-Type01" summary="���">
						<caption>���</caption>
						<colgroup>
							<col width="60px" />
							<col width="12%" />
							<col width="10%" />
							<col width="10%" />
							<col width="10%" />
							<col width="5%" />
							<col width="5%" />
							<col width="5%" />
							<col width="*" />
							<col width="*" />
							<col width="*" />
							<col width="*" />
							<col width="*" />
							<col width="*" />
						</colgroup>
						<thead>
							<tr>
								<th scope="col" class="first">����</th>
								<th scope="col">�����о�(����)</th>
								<th scope="col">������ȣ</th>
								<th scope="col">��������</th>
								<th scope="col">����</th>
								<th scope="col">����</th>
								<th scope="col">����</th>
								<? if ($rsmDataUseYn[0]->CAREER_USE_YN == 'Y') { ?>
								<th scope="col">���</th>
								<? } ?>
								<? if ($rsmDataUseYn[0]->SCHOOL_USE_YN == 'Y') { ?>
								<th scope="col">�����б�</th>
								<th scope="col">����</th>
								<? } ?>
								<th scope="col">����</th>
								<th scope="col">����</th>
								<th scope="col">�̷�</th>
								<th scope="col">�ʱ�</th>
							</tr>
						</thead>
						<tbody>
						<? if (count($appList) > 0 ) { ?>
						<? foreach ($appList as $key => $data) { ?>
							<tr>
								<td><input id="APP_LIST<?=$key?>" name="APP_LIST<?=$key?>" class="checkbox" type="checkbox" value="<?=$data->APPLY_NO?>" /></td>
								<td><?=$data->UNIT_NM?> <?=$data->WRK_PLC_NM != '' ? '( ' . $data->WRK_PLC_NM . ' )' : ''; ?></td>
								<td><?=$data->APPLY_NO?></td>
								<td><?=$data->APPL_DT?></td>
								<td><?=$data->NAMEKOR?></td>
								<td><?=$data->SEX_NM?></td>
								<td><?=$data->NAI?></td>
								<? if ($rsmDataUseYn[0]->CAREER_USE_YN == 'Y') { ?>
								<td><?=$data->CAREER_SUM_YEAR?>�� <?=$data->CAREER_SUM_MONTH?>����</td>
								<? } ?>
								<? if ($rsmDataUseYn[0]->SCHOOL_USE_YN == 'Y') { ?>
								<td><?=$data->SCH_NM?></td>
								<td><?=$data->SCH_MAJOR_NM?></td>
								<? } ?>
								<td><span class="btn04"><a href="javascript:goView('<?=$data->APPLY_NO?>');">����</a></span></td>
								<td><span class="btn04"><a href="javascript:goModify('<?=$data->APPLY_NO?>');">����</a></span></td>
								<td><span class="btn04"><a href="javascript:goHistory('<?=$data->APPLY_NO?>');">�̷�</a></span></td>
								<td><span class="btn04"><a href="javascript:goPassword('<?=$data->APPL_IDX?>');">�ʱ�</a></span></td>
							</tr>
							<? 
							} 
							} else {
							?>
							<tr>
								<td colspan="14" class="no-data">�ش� �����Ͱ� �����ϴ�.</td>
							</tr>
							<? } ?>
						</tbody>
					</table>

					<div class="txtR mgt10">
						
						<label for="sch_item" class="labSty01">������ �����ڸ�</label>
						<?=$SELECTBOX_STEP?>
						<span class="btn04"><a href="javascript:actApplyMoveStep();">�̵�</a></span>
					</div>

					<!-- S: ����¡ -->
					<div id="Paging">
						<div id="Page-Index">
						<?=$paging?>
						</div>
					</div>
					<!--// E: ����¡ -->