<!-- S: �ۼ� -->
<link rel="stylesheet" type="text/css" href="/assets/css/jqueryui.css" />
<script language="javascript" src="/assets/js/jquery.validate.js"></script>
<script type="text/javascript" src="/editor/se/js/HuskyEZCreator.js" charset="utf-8"></script>
<script type="text/javascript" src="/assets/js/jquery-ui.js" charset="utf-8"></script>
<script language="javascript" src="/assets/js/bbs.js" ></script>
<script>
	
	var oEditors = [];
	
	var formContentsAr = new Array('CNTNT','FILE');
	
	var CNTNTListCount = <?=$CNTNT_count > 0 ? $CNTNT_count + 1 : 1; ?>;
	var CNTNTListAr = 	 {'RSM_CNTNT_IDX':'�����ڵ�',
												'ORD_NO':'����',
												'CNTNT_TITLE':'����',
												'CNTNT_COMMENT':'�ΰ�����',
												'CNTNT_LEN':'�ִ����',
												'CNTNT_MIN_LEN':'�ּұ���',
												'CNTNT_ESN_YN':'�ʼ�����',
												'CNTNT_DEL':'����'};
												
	var FILEListCount = <?=$FILE_count > 0 ? $FILE_count + 1 : 1; ?>;
	var FILEListAr = 	 	 {'RSM_FILE_IDX':'�����ڵ�',
												'ORD_NO':'����',
												'FILE_TITLE':'����',
												'FILE_COMMENT':'�ΰ�����',
												'FILE_MAX_SIZE':'�ִ����',
												'FILE_AVL_EXT':'�ּұ���',
												'FILE_ESN_YN':'�ʼ�����',
												'FILE_DEL':'����'};
	
	
	var LANGUAGEListAr = {'LAN_IDX':'����ڵ�',
											'ESN_YN':'�ʼ�����'};
	
										
	
	
	function bodyOnLoad()
	{
	
			$("#PRJ_STDT1").datepicker({dateFormat:'yy-mm-dd'});
		  $("#PRJ_EDDT1").datepicker({dateFormat:'yy-mm-dd'});
			
			$("#form1").validate({  
					groups: {
						PRJ_DATE: "PRJ_STDT1 PRJ_STDT2 PRJ_STDT3 PRJ_EDDT1 PRJ_EDDT2 PRJ_EDDT3"
					},
			    rules: {  
			      PRJ_NM:{required:true},
			      PRJ_STDT1:{required:true},
			      PRJ_STDT2:{required:true},
			      PRJ_STDT3:{required:true},
			      PRJ_EDDT1:{required:true},
			      PRJ_EDDT2:{required:true},
			      PRJ_EDDT3:{required:true}
			    },  
			    onkeyup:false,
			    messages: {
			    		PRJ_NM:"������Ʈ���� �Է��ϼ���",
			    		PRJ_DATE:"������Ʈ�Ⱓ�� �Է��ϼ���",
			    		PRJ_STDT1:"�Ⱓ�� �����ϼ���",
			    		PRJ_STDT2:"�Ⱓ�� �����ϼ���",
			    		PRJ_STDT3:"�Ⱓ�� �����ϼ���",
			    		PRJ_EDDT1:"�Ⱓ�� �����ϼ���",
			    		PRJ_EDDT2:"�Ⱓ�� �����ϼ���",
			    		PRJ_EDDT3:"�Ⱓ�� �����ϼ���"
			    },
			    submitHandler: function(form) { 
					
					$("#CNTNT_listCount").val(CNTNTListCount);
					$("#FILE_listCount").val(FILEListCount);
		    	form.submit();

		    	}
	   	});  
			
			bodyOnLoadEvent();
			
	}
		
	function projectProcess()
	{
		
		oEditors.getById["PRJ_SUMMARY"].exec("UPDATE_CONTENTS_FIELD", []);
		oEditors.getById["PRJ_CNTNT"].exec("UPDATE_CONTENTS_FIELD", []);
	
		$("#form1").attr("action","/admin/projectManagement/projectProcess");
		$("#form1").attr("method","post");
		$("#submit_button").click();
		
	}
	
	function CheckPersonal()
	{
		if (!$("#PERSONAL_USE_YN").is(':checked')) 
		{
			alert('�Ż������� �̷¼��� �����ϴ� �⺻�׸��Դϴ�.');
			$("#PERSONAL_USE_YN").attr('checked',true);
		}
	}
	
	function bodyOnLoadEvent()
	{ 
		//����
		for (var a = 0 ; a < formContentsAr.length ;a ++ )
		{
			//�� �׸� ���� �̺�Ʈ 
			for (var b = 1 ; b <= eval(formContentsAr[a] + "ListCount") ; b++)
			{
				 btnEvent(formContentsAr[a],b);
			}
		}
	}
	
	function btnEvent(code,seq)
	{
		if($("#form1").find("#" + code + "_content_list").find("#" + code + "_box_" + seq).find("#" + code + "_DEL_" + seq).length > 0)
		$("#form1").find("#" + code + "_content_list").find("#" + code + "_box_" + seq).find("#" + code + "_DEL_" + seq).click( function(){ delDataForm(code,seq); });
	}
	
	function addDataForm(code)
	{
		var x = eval(code + "ListCount");
		$("#" + code + "_content_list").append($("#" + code + "_contents_box").html());
		$("#form1").find("#" + code + "_content_list").find("#" + code + "_box").attr("id" , code + "_box_" + x); // ������ �ڽ� �ڵ庯�� 
		
		for ( var formList in eval(code + "ListAr") ) 
		{
			$("#form1").find("#" + code + "_content_list").find("#" + code + "_box_" + x).find("#" + formList).attr("name" ,formList + "_" + x);
			$("#form1").find("#" + code + "_content_list").find("#" + code + "_box_" + x).find("#" + formList).attr("id" ,formList + "_" + x);
		}
		//��ư �̺�Ʈ
		btnEvent(code,x);
		
		eval(code + "ListCount ++;");
	}
	
	function delDataForm(code,seq)
	{
		$("#form1").find("#" + code + "_content_list").find("#" + code + "_box_" + seq).remove();
	}
	
	function CheckEsn(code,seq,ccode)
	{
		// ���ڽ��� üũ�� �ȴ��~
		if (!$("#" + code + "_" + seq).is(':checked')) $("#" + ccode + "_" + seq).attr("checked",false);
	}

</script>
<form name="form1" id="form1">
<input type="hidden" id="CNTNT_listCount" name="CNTNT_listCount" />
<input type="hidden" id="FILE_listCount" name="FILE_listCount" />
<input type="hidden" id="LANGUAGE_listCount" name="LANGUAGE_listCount" value="<?=$LANGUAGE_count?>" />
<input type="hidden" id="COMPUTER_listCount" name="COMPUTER_listCount" value="<?=$COMPUTER_count?>" />


					<table class="BdView-Type01" summary="�Խù� ����, ��ȣ, �ۼ���, �����, ��ȸ��, ÷������ �� ������ �� �� �ֽ��ϴ�.">
						<caption>�Խñ� �󼼺���</caption>
						<colgroup>
							<col width="110px" />
							<col width="105px" />
							<col width="110px" />
							<col width="*" />
						</colgroup>
						<tbody>
							<tr>
								<th scope="row" colspan="3">
									<label for="w01">���</label>
								</th>
								<td><?=$COMP_NM?></td>
							</tr>
							<tr>
								<th scope="row" colspan="3">
									<span class="item">*</span>
									<label for="w02">������Ʈ ��</label>
								</th>
								<td>
									<input type="text" name="PRJ_NM" id="PRJ_NM" title="������Ʈ �� �Է�" style="width:200px;" value="<?=$PRJ_NM?>" class="required" />
									<label class="error" for="PRJ_NM" generated="true" style="display:none;color:red;">error message</label>
								</td>
							</tr>
							<tr>
								<th scope="row" colspan="3">
									<label for="w03">������Ʈ ���� ���</label>
								</th>
								<td>
									<textarea id="PRJ_SUMMARY" name="PRJ_SUMMARY" rows="1" cols="1" style="width:766px; height:212px; display:none;" title="������Ʈ ���� ����Է�" ></textarea>
									<script type="text/javascript">
									 
									 nhn.husky.EZCreator.createInIFrame({
									 oAppRef: oEditors,
									 elPlaceHolder: "PRJ_SUMMARY",
									 sSkinURI: "/editor/se/SmartEditor2Skin.html",
									 htParams : {
									 		bUseToolbar : true,
									 		fOnBeforeUnload : function(){}
									 },
									 fCreator: "createSEditor2",
									 fOnAppLoad : function(){
											oEditors.getById["PRJ_SUMMARY"].exec("PASTE_HTML", [$("#PRJ_SUMMARY_FOR_CONTENT").val()]);
									 }
									 });
									</script>

								</td>
							</tr>
							<tr>
								<th scope="row" colspan="3">
									<span class="item">*</span>
									<label for="w04a">���� �Խ� �Ⱓ</label>
								</th>
								<td>
									<input type="text" name="PRJ_STDT1" id="PRJ_STDT1" title="���� �Խ� �Ⱓ �Է�" style="width:100px;" value="<?=$PRJ_STDT1?>" readonly class="required" />
									<!--a href="#"><img src="/assets/img/common/ico_calendar.gif" alt="�޷�"/></a-->
									<?=$SELECTBOX_STDT_HOUR?>
									�� 
									<?=$SELECTBOX_STDT_MIN?>
									��
									~
									<input type="text" name="PRJ_EDDT1" id="PRJ_EDDT1" title="���� �Խ� �Ⱓ �Է�" style="width:100px;" value="<?=$PRJ_EDDT1?>" readonly class="required" />
									<!--a href="#"><img src="/assets/img/common/ico_calendar.gif" alt="�޷�"/></a-->
									<?=$SELECTBOX_EDDT_HOUR?>
									��
									<?=$SELECTBOX_EDDT_MIN?>
									��
									<label class="error" for="PRJ_DATE" generated="true" style="display:none;color:red;">error message</label>
								</td>
							</tr>
						
							<tr>
								<th scope="row" colspan="3">
									<label for="w06a">������Ʈ ����</label>
								</th>
								<td>
									<input type="radio" name="PRJ_STS" id="PRJ_STS" value="O" class="radio" <?=$PRJ_STS == 'O' ? ' checked ' :''?> /><label for="w06a" class="mgr5">����</label>
									<input type="radio" name="PRJ_STS" id="PRJ_STS" value="C" class="radio" <?=$PRJ_STS == 'C' || $PRJ_STS == null ? ' checked ' :''?>/><label for="w06b">�ݱ�</label>
								</td>
							</tr>
							<tr>
								<th scope="row" colspan="3">
									<label for="w07">������</label>
								</th>
								<td>
									<textarea id="PRJ_CNTNT" name="PRJ_CNTNT" rows="1" cols="1" style="width:766px; height:212px; display:none;" title="������ �Է�"></textarea>
									<script type="text/javascript">
									 
									 nhn.husky.EZCreator.createInIFrame({
									 oAppRef: oEditors,
									 elPlaceHolder: "PRJ_CNTNT",
									 htParams : {
									 		bUseToolbar : true,
									 		fOnBeforeUnload : function(){ 
                     		//alert("onbeforeunload call"); 
		                }
									 },
									 sSkinURI: "/editor/se/SmartEditor2Skin.html",
									 fCreator: "createSEditor2",
									 fOnAppLoad : function(){
											oEditors.getById["PRJ_CNTNT"].exec("PASTE_HTML", [$("#PRJ_CNTNT_FOR_CONTENT").val()]);
									 }
									 });
									</script>
								</td>
							</tr>
							
							
							
							<tr>
								<th scope="row" colspan="3">
									<label for="w07">���� ����</label> <input type="checkbox" name="LANGUAGE_USE_YN" id="LANGUAGE_USE_YN" value="Y" class="checkbox" <?=$LANGUAGE_USE_YN == 'Y' ? ' checked ':'';?> />  
								</th>
								<td>
									
									<table  id="BdList-Type01" class="mgb30">
									<colgroup>
										<col width="*" />
										<col width="60px" />
										<col width="60px" />
										<col width="60px" />
									</colgroup>
									<thead>
									<tr>
										<th scope="col">����׸�</th>
										<th scope="col">����</th>
										<th scope="col">�ʼ�</th>
										<th scope="col">���</th>
									</tr>
									</thead>
									<tbody>
									<?
										foreach ($LANGUAGE_data as $key => $cntntList) { 
									?>
									<tr>
										<td><?=$cntntList->LAN_NM?></td>
										<td><input type="text" id="LAN_ORD_<?=($key + 1)?>" name="LAN_ORD_<?=($key + 1)?>" value="<?=$cntntList->ORD?>" style="width:20px;" maxlength="2" onblur="javascript:CheckData(this,'digits');" /></td>
										<td><input class="checkbox" type="checkbox" name="LAN_ESN_YN_<?=($key + 1)?>" id="LAN_ESN_YN_<?=($key + 1)?>" value="Y" <?=$cntntList->LAN_ESN_YN == 'Y' ? ' checked ' : ''?>  /></td>
										<td><input class="checkbox" type="checkbox" onclick="javascript:CheckEsn('SEL_LAN_IDX',<?=($key + 1)?>,'LAN_ESN_YN');" name="LAN_IDX_<?=($key + 1)?>" id="LAN_IDX_<?=($key + 1)?>" value="<?=$cntntList->LAN_IDX?>" <?=$cntntList->SEL_LAN_IDX == $cntntList->LAN_IDX  ? ' checked ' : ''?>  /></td>
									</tr>
									<?
										}
									?>
									</tbody>
									</table>
									
								</td>
							</tr>
							
							
							
							<tr>
								<th scope="row" colspan="3">
									<label for="w07">PCȰ��ɷ�</label> <input type="checkbox" name="PC_USE_YN" id="PC_USE_YN" value="Y" class="checkbox" <?=$PC_USE_YN == 'Y' ? ' checked ':'';?> />  
								</th>
								<td>
									
									<table  id="BdList-Type01" class="mgb30">
									<colgroup>
										<col width="*" />
										<col width="60px" />
										<col width="60px" />
									</colgroup>
									<thead>
									<tr>
										<th scope="col">����׸�</th>
										<th scope="col">�ʼ�</th>
										<th scope="col">���</th>
									</tr>
									</thead>
									<tbody>
									<?
										foreach ($COMPUTER_data as $key => $cntntList) { 
									?>
									<tr>
										<td><?=$cntntList->CPU_NM?></td>
										<td><input class="checkbox" type="checkbox" name="CPU_ESN_YN_<?=($key + 1)?>" id="CPU_ESN_YN_<?=($key + 1)?>" value="Y" <?=$cntntList->CPU_ESN_YN == 'Y' ? ' checked ' : ''?>  /></td>
										<td><input class="checkbox" type="checkbox" onclick="javascript:CheckEsn('SEL_CD_CPU_IDX',<?=($key + 1)?>,'CPU_ESN_YN');" name="CD_CPU_IDX_<?=($key + 1)?>" id="CD_CPU_IDX_<?=($key + 1)?>" value="<?=$cntntList->CD_CPU_IDX?>" <?=$cntntList->SEL_CD_CPU_IDX == $cntntList->CD_CPU_IDX  ? ' checked ' : ''?>  /></td>
									</tr>
									<?
										}
									?>
									</tbody>
									</table>
									
								</td>
							</tr>
							
							<tr>
								<th scope="row" colspan="3">
									<label for="w07">���Ͼ��ε�</label> <input type="checkbox" name="FILE_USE_YN" id="FILE_USE_YN" value="Y" class="checkbox" <?=$FILE_USE_YN == 'Y' ? ' checked ':'';?> /> 
								</th>
								<td>
									
									<table  id="BdList-Type01" class="mgb30">
									<colgroup>
										<col width="60px" />
										<col width="*" />
										<col width="*" />
										<col width="100px" />
										<col width="100px" />
										<col width="60px" />
										<col width="100px" />
									</colgroup>
									<thead>
									<tr>
										<th scope="col">����</th>
										<th scope="col">����</th>
										<th scope="col">�ΰ�����</th>
										<th scope="col">�ִ�����ũ��</th>
										<th scope="col">���Ȯ����</th>
										<th scope="col">�ʼ�</th>
										<th scope="col">����</th>
									</tr>
									</thead>
									<tbody id="FILE_content_list">
										
										<? 
										if ( $FILE_count > 0) { 
										foreach ($FILE_data as $key => $cntntList) { 
										?>
										<tr id="FILE_box_<?=($key + 1)?>">
												<td><input type="hidden" name="RSM_FILE_IDX_<?=($key + 1)?>" id="RSM_FILE_IDX_<?=($key + 1)?>" value="<?=$cntntList->RSM_FILE_IDX?>" />
												<input type="text" name="ORD_NO_<?=($key + 1)?>" id="ORD_NO_<?=($key + 1)?>" style="width:20px;" maxlength="2" onblur="javascript:CheckData(this,'digits');" value="<?=$cntntList->RSM_FILE_IDX?>" /></td>
												<td><input type="text" name="FILE_TITLE_<?=($key + 1)?>" id="FILE_TITLE_<?=($key + 1)?>" style="width:90%" maxlength="100" value="<?=$cntntList->FILE_TITLE?>" /></td>
												<td><input type="text" name="FILE_COMMENT_<?=($key + 1)?>" id="FILE_COMMENT_<?=($key + 1)?>" style="width:90%"  maxlength="300" value="<?=$cntntList->FILE_COMMENT?>" /></td>
												<td><input type="text" name="FILE_MAX_SIZE_<?=($key + 1)?>" id="FILE_MAX_SIZE_<?=($key + 1)?>" style="width:30px" maxlength="4" onblur="javascript:CheckData(this,'digits');" value="<?=$cntntList->FILE_MAX_SIZE?>" /> KB</td>
												<td><input type="text" name="FILE_AVL_EXT_<?=($key + 1)?>" id="FILE_AVL_EXT_<?=($key + 1)?>" style="width:90%" value="<?=$cntntList->FILE_AVL_EXT?>" /></td>
												<td><input class="checkbox" type="checkbox" name="FILE_ESN_YN_<?=($key + 1)?>" id="FILE_ESN_YN_<?=($key + 1)?>" value="Y" <?=$cntntList->FILE_ESN_YN == 'Y' ? ' checked ' : ''?>  /></td>
												<td><img src="/assets/img/btn/btn_del.gif" id="FILE_DEL_<?=($key + 1)?>" name="FILE_DEL_<?=($key + 1)?>" style="cursor:hand;" ></td>
										</tr>
										<? } } ?>
									</tbody>
									</table>
									<span class="btn04"><a href="javascript:addDataForm('FILE');">�׸��߰� <span class="color bold">+</span></a></span>
									
											
								</td>
							</tr>
							
							<tr>
								<th scope="row" colspan="3">
									<label for="w07">�󼼳���</label> <input type="checkbox" name="CONTENT_USE_YN" id="CONTENT_USE_YN" value="Y" class="checkbox" <?=$CONTENT_USE_YN == 'Y' ? ' checked ':'';?> />
								</th>
								<td>
								
									<table  id="BdList-Type01" class="mgb30">
									<colgroup>
										<col width="60px" />
										<col width="*" />
										<col width="*" />
										<col width="100px" />
										<col width="100px" />
										<col width="60px" />
										<col width="100px" />
									</colgroup>
									<thead>
									<tr>
										<th scope="col">����</th>
										<th scope="col">����</th>
										<th scope="col">�ΰ�����</th>
										<th scope="col">�ּұ���</th>
										<th scope="col">�ִ����</th>
										<th scope="col">�ʼ�</th>
										<th scope="col">����</th>
									</tr>
									</thead>
									<tbody id="CNTNT_content_list">
										<? 
										if ( $CNTNT_count > 0) { 
										foreach ($CNTNT_data as $key => $cntntList) { 
										?>
										<tr id="CNTNT_box_<?=($key + 1)?>">
												<td><input type="hidden" name="RSM_CNTNT_IDX_<?=($key + 1)?>" id="RSM_CNTNT_IDX_<?=($key + 1)?>" value="<?=$cntntList->RSM_CNTNT_IDX?>"  />
												<input type="text" name="ORD_NO_<?=($key + 1)?>" id="ORD_NO_<?=($key + 1)?>" style="width:20px;" maxlength="2" value="<?=$cntntList->ORD_NO?>" onblur="javascript:CheckData(this,'digits');" /></td>
												<td><input type="text" name="CNTNT_TITLE_<?=($key + 1)?>" id="CNTNT_TITLE_<?=($key + 1)?>" style="width:90%" maxlength="100" value="<?=$cntntList->CNTNT_TITLE?>" /></td>
												<td><input type="text" name="CNTNT_COMMENT_<?=($key + 1)?>" id="CNTNT_COMMENT_<?=($key + 1)?>" style="width:90%"  maxlength="300" value="<?=$cntntList->CNTNT_COMMENT?>" /></td>
												<td><input type="text" name="CNTNT_MIN_LEN_<?=($key + 1)?>" id="CNTNT_MIN_LEN_<?=($key + 1)?>" style="width:90%" maxlength="4" value="<?=$cntntList->CNTNT_MIN_LEN?>" onblur="javascript:CheckData(this,'digits');" /></td>
												<td><input type="text" name="CNTNT_LEN_<?=($key + 1)?>" id="CNTNT_LEN_<?=($key + 1)?>" style="width:90%" maxlength="4" value="<?=$cntntList->CNTNT_LEN?>" onblur="javascript:CheckData(this,'digits');" /></td>
												<td><input class="checkbox" type="checkbox" name="CNTNT_ESN_YN_<?=($key + 1)?>" id="CNTNT_ESN_YN_<?=($key + 1)?>" value="Y" <?=$cntntList->CNTNT_ESN_YN == 'Y' ? ' checked ' : ''?> /></td>
												<td><img src="/assets/img/btn/btn_del.gif" id="CNTNT_DEL_<?=($key + 1)?>" name="CNTNT_DEL_<?=($key + 1)?>" style="cursor:hand;" ></td>
										</tr>
										<? } } ?>
									</tbody>
									</table>
									<span class="btn04"><a href="javascript:addDataForm('CNTNT');">�׸��߰� <span class="color bold">+</span></a></span>
								</td>
							</tr>
							
							<tr>
								<th scope="row" colspan="3">
									<label for="w07">�����׸����</label>
								</th>
								<td>
									
									<table  id="BdList-Type01" class="mgb30">
									<colgroup>
										<col width="*" />
										<col width="*" />
										<col width="*" />
										<col width="*" />
										<col width="*" />
									</colgroup>
								
									<thead>
									<tr>
										<th scope="col">�Ż����� <input type="checkbox" name="PERSONAL_USE_YN" id="PERSONAL_USE_YN" value="Y" class="checkbox" <?=$PERSONAL_USE_YN == 'Y' ? ' checked ':'checked';?>  onclick="javascript:CheckPersonal();" /></th>
										<th scope="col">�������� <input type="checkbox" name="FAMILY_USE_YN" id="FAMILY_USE_YN" value="Y" class="checkbox" <?=$FAMILY_USE_YN == 'Y' ? ' checked ':'';?> /></th>
										<th scope="col">�з»��� <input type="checkbox" name="SCHOOL_USE_YN" id="SCHOOL_USE_YN" value="Y" class="checkbox" <?=$SCHOOL_USE_YN == 'Y' ? ' checked ':'';?> /></th>
										<th scope="col">��»��� <input type="checkbox" name="CAREER_USE_YN" id="CAREER_USE_YN" value="Y" class="checkbox" <?=$CAREER_USE_YN == 'Y' ? ' checked ':'';?> /></th>
										<th scope="col"> </th>
									</tr>
									</thead>
									<tbody>
										<tr>
											<td></td>
											<td>�ִ� : <input type="text" id="FAMILY_FORM_CNT" name="FAMILY_FORM_CNT" value="<?=$FAMILY_FORM_CNT?>" style="width:20px;" maxlength="2" onblur="javascript:CheckData(this,'digits');" />��</td>
											<td>�ִ� : <input type="text" id="SCHOOL_FORM_CNT" name="SCHOOL_FORM_CNT" value="<?=$SCHOOL_FORM_CNT?>" style="width:20px;" maxlength="2" onblur="javascript:CheckData(this,'digits');" />��</td>
											<td>�ִ� : <input type="text" id="CAREER_FORM_CNT" name="CAREER_FORM_CNT" value="<?=$CAREER_FORM_CNT?>" style="width:20px;" maxlength="2" onblur="javascript:CheckData(this,'digits');" />��</td>
											<td></td>
										</tr>
									</tbody>
								
									<thead>
									<tr>
										<th scope="col">�ڰ����׸� <input type="checkbox" name="LICENSE_USE_YN" id="LICENSE_USE_YN" value="Y" class="checkbox" <?=$LICENSE_USE_YN == 'Y' ? ' checked ':'';?> /></th>
										<th scope="col">������� <input type="checkbox" name="ARMY_USE_YN" id="ARMY_USE_YN" value="Y" class="checkbox" <?=$ARMY_USE_YN == 'Y' ? ' checked ':'';?> /></th>
										<th scope="col">�ؿܰ������ <input type="checkbox" name="TRAINING_USE_YN" id="TRAINING_USE_YN" value="Y" class="checkbox" <?=$TRAINING_USE_YN == 'Y' ? ' checked ':'';?> /></th>
										<th scope="col">����Ȱ������ <input type="checkbox" name="SERVE_USE_YN" id="SERVE_USE_YN" value="Y" class="checkbox" <?=$SERVE_USE_YN == 'Y' ? ' checked ':'';?> /></th>
										<th scope="col">������ <input type="checkbox" name="PRIZE_USE_YN" id="PRIZE_USE_YN" value="Y" class="checkbox" <?=$PRIZE_USE_YN == 'Y' ? ' checked ':'';?> /></th>
									</tr>
									</thead>
									<tbody>
										<tr>
											<td>�ִ� : <input type="text" id="LICENSE_FORM_CNT" name="LICENSE_FORM_CNT" value="<?=$LICENSE_FORM_CNT?>" style="width:20px;" maxlength="2" onblur="javascript:CheckData(this,'digits');" />��</td>
											<td></td>
											<td>�ִ� : <input type="text" id="TRAINING_FORM_CNT" name="TRAINING_FORM_CNT" value="<?=$TRAINING_FORM_CNT?>" style="width:20px;" maxlength="2" onblur="javascript:CheckData(this,'digits');" />��</td>
											<td>�ִ� : <input type="text" id="SERVE_FORM_CNT" name="SERVE_FORM_CNT" value="<?=$SERVE_FORM_CNT?>" style="width:20px;" maxlength="2" onblur="javascript:CheckData(this,'digits');" />��</td>
											<td>�ִ� : <input type="text" id="PRIZE_FORM_CNT" name="PRIZE_FORM_CNT" value="<?=$PRIZE_FORM_CNT?>" style="width:20px;" maxlength="2" onblur="javascript:CheckData(this,'digits');" />��</td>
										</tr>
									</tbody>
									
									<thead>
									<tr>
										<th scope="col"></th>
										<th scope="col">�������� <input type="checkbox" name="WRITE_USE_YN" id="WRITE_USE_YN" value="Y" class="checkbox" <?=$WRITE_USE_YN == 'Y' ? ' checked ':'';?> /></th>
										<th scope="col">������ <input type="checkbox" name="LANGUAGE2_USE_YN" id="LANGUAGE2_USE_YN" value="Y" class="checkbox" <?=$LANGUAGE2_USE_YN == 'Y' ? ' checked ':'';?> style="width:20px;" maxlength="2" onblur="javascript:CheckData(this,'digits');" /></th>
										<th scope="col">�������� <input type="checkbox" name="EDUCATION_USE_YN" id="EDUCATION_USE_YN" value="Y" class="checkbox" <?=$EDUCATION_USE_YN == 'Y' ? ' checked ':'';?> /></th>
										<th scope="col">������� <input type="checkbox" name="TECH_USE_YN" id="TECH_USE_YN" value="Y" class="checkbox" <?=$TECH_USE_YN == 'Y' ? ' checked ':'';?> /></th>
									</tr>
									</thead>
									<tbody>
										<tr>
											<td></td>
											<td>�ִ� : <input type="text" id="WRITE_FORM_CNT" name="WRITE_FORM_CNT" value="<?=$WRITE_FORM_CNT?>" style="width:20px;" maxlength="2" onblur="javascript:CheckData(this,'digits');" />��</td>
											<td>�ִ� : <input type="text" id="LANGUAGE2_FORM_CNT" name="LANGUAGE2_FORM_CNT" value="<?=$LANGUAGE2_FORM_CNT?>" style="width:20px;" maxlength="2" onblur="javascript:CheckData(this,'digits');" />��</td>
											<td>�ִ� : <input type="text" id="EDUCATION_FORM_CNT" name="EDUCATION_FORM_CNT" value="<?=$EDUCATION_FORM_CNT?>" style="width:20px;" maxlength="2" onblur="javascript:CheckData(this,'digits');" />��</td>
											<td>�ִ� : <input type="text" id="TECH_FORM_CNT" name="TECH_FORM_CNT" value="<?=$TECH_FORM_CNT?>" style="width:20px;" maxlength="2" onblur="javascript:CheckData(this,'digits');" />��</td>
										</tr>
									</tbody>
								
									</table>
							
								</td>
							</tr>
							
						</tbody>
					</table>					
					<!--// E: �ۼ� -->
					<? if ($PRJ_IDX != null) { ?>
					<input type="hidden" name="PRJ_IDX" id="PRJ_IDX" value="<?=$PRJ_IDX?>" />
					<? }?>
					<input type="hidden" name="P_TYPE" id="P_TYPE" value="<?=$P_TYPE?>" />
					<input type="hidden" name="COMP_ID" id="COMP_ID" value="<?=$COMP_ID?>" />
					
					<input type="hidden" name="PRJ_SUMMARY_FOR_CONTENT" id="PRJ_SUMMARY_FOR_CONTENT" value="<?=$PRJ_SUMMARY?>" />
					<input type="hidden" name="PRJ_CNTNT_FOR_CONTENT" id="PRJ_CNTNT_FOR_CONTENT"  value="<?=$PRJ_CNTNT?>" />
					<input type="submit" style="display:none;" id="submit_button">
					
					<div class="txtC">
						<span class="btn01"><a href="javascript:projectProcess();">Ȯ��</a></span>
						<span class="btn02"><a href="javascript:goLink('<?=$P_BACK_URL?>')">���ư���</a></span>
					</div>
</form>

<div id="CNTNT_contents_box" style="display:none">
	<tr id="CNTNT_box">
			<td><input type="hidden" name="RSM_CNTNT_IDX" id="RSM_CNTNT_IDX" value=""  />
			<input type="text" name="ORD_NO" id="ORD_NO" style="width:20px;" maxlength="2" onblur="javascript:CheckData(this,'digits');" /></td>
			<td><input type="text" name="CNTNT_TITLE" id="CNTNT_TITLE" style="width:90%" maxlength="100" /></td>
			<td><input type="text" name="CNTNT_COMMENT" id="CNTNT_COMMENT" style="width:90%"  maxlength="300" /></td>
			<td><input type="text" name="CNTNT_MIN_LEN" id="CNTNT_MIN_LEN" style="width:90%" maxlength="4" onblur="javascript:CheckData(this,'digits');" /></td>
			<td><input type="text" name="CNTNT_LEN" id="CNTNT_LEN" style="width:90%" maxlength="4" onblur="javascript:CheckData(this,'digits');" /></td>
			<td><input class="checkbox" type="checkbox" name="CNTNT_ESN_YN" id="CNTNT_ESN_YN" value="Y"  /></td>
			<td><img src="/assets/img/btn/btn_del.gif" id="CNTNT_DEL" name="CNTNT_DEL" style="cursor:hand;" ></td>
	</tr>
</div>

<div id="FILE_contents_box" style="display:none">
	<tr id="FILE_box">
			<td><input type="hidden" name="RSM_FILE_IDX" id="RSM_FILE_IDX" value=""  />
			<input type="text" name="ORD_NO" id="ORD_NO" style="width:20px;" maxlength="2" onblur="javascript:CheckData(this,'digits');" /></td>
			<td><input type="text" name="FILE_TITLE" id="FILE_TITLE" style="width:90%" maxlength="100" /></td>
			<td><input type="text" name="FILE_COMMENT" id="FILE_COMMENT" style="width:90%"  maxlength="300" /></td>
			<td><input type="text" name="FILE_MAX_SIZE" id="FILE_MAX_SIZE" style="width:30px" maxlength="4" onblur="javascript:CheckData(this,'digits');" /> KB</td>
			<td><input type="text" name="FILE_AVL_EXT" id="FILE_AVL_EXT" style="width:90%" /></td>
			<td><input class="checkbox" type="checkbox" name="FILE_ESN_YN" id="FILE_ESN_YN" value="Y"  /></td>
			<td><img src="/assets/img/btn/btn_del.gif" id="FILE_DEL" name="FILE_DEL" style="cursor:hand;" ></td>
	</tr>
</div>

