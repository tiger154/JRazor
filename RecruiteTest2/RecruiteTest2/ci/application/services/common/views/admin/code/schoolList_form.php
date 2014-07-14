<script language="javascript" src="/assets/js/jquery.validate.js"></script>
<script>
	
	function bodyOnLoad()
	{
			
			$("#button_cancel_show").attr("style","display:none");
			$("#form1").attr("method","post");
			$("#form1").attr("action","/admin/codeManagement/schoolManagerProcess");
			$("#form1").validate({  
					groups: {
						COMMONGRP: "SCH_NM CD_IDX"
					},
			    rules: {  
			      SCH_NM:{required:true},
			      CD_IDX:{required:true}
			    },  
			    onkeyup:false,
			    messages: {
			    		COMMONGRP:"���׸��� ä���ּ���.",
			    		SCH_NM:"<?=$codeTitle?>���� �Է��ϼ���.",
			    		CD_IDX:"������ �����ϼ���."
			    },
			    submitHandler: function(form) { 

		    	form.submit();

		    	}
	   	});  
	}
	function Process(mode)
	{
		if ($("#P_TYPE").val() == '') $("#P_TYPE").val('regist');		
		$("#submit_button").click();
	}
	
	function modifyProcess(code)
	{
		$("#button_cancel_show").attr("style","");
		$("#P_TYPE").val('modify');
		$("#SCH_IDX").val(code);
		
		$.ajax({
    url: "/admin/codeManagement/schoolManagerData?SCH_IDX=" + $("#SCH_IDX").val(),
    type: "get",
    dataType:'json',
    //data: serializedData,
    success: function(response, textStatus, jqXHR){
    
     $("#SCH_NM").val(response['SCH_NM']);
     $("#CD_IDX").val(response['CD_IDX']);
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
	
	function cancel()
	{
		$("#P_TYPE").val('');
		$("#SCH_IDX").val('');
		$("#CD_IDX").val('');
		$("#SCH_NM").val('');
		$("#button_cancel_show").attr("style","display:none");
	}
	
	function deleteProcess(code)
	{
		$("#P_TYPE").val('delete');
		$("#SCH_IDX").val(code);
		$("#submit_button").click();
	}
	
</script>
		<h2 class="H2blt"><?=$codeTitle?> ���/����</h2>
<form id="form1" name="form1">
<input type="hidden" name="P_TYPE" id="P_TYPE" />
<input type="hidden" name="SCH_IDX" id="SCH_IDX" />
<input type="hidden" name="h_sch_gubun" id="h_sch_gubun" value="<?=$sch_gubun?>" />
<input type="hidden" name="h_sch_sch_nm" id="h_sch_sch_nm" value="<?=$sch_sch_nm?>" />
<input type="hidden" name="h_per_page" id="h_per_page" value="<?=$per_page?>" />
					<div id="Sch-box">
						<div class="mgb10">
							<label for="s01">����</label>
							<?=$SELECTBOX_CD_IDX?>
							<label for="s02" class="mgl15"><?=$codeTitle?> ��</label>
							<input type="text" name="SCH_NM" id="SCH_NM" style="width:100px;"  class="required"  />
						</div>
						<label class="error" for="COMMONGRP" generated="true" style="display:none;color:red;">error message</label>
						
						<p class="F11 mgb10 orange">�� ���� ����� ��� ����������� ���� ��Ź �帳�ϴ�.</p>
						
						<div class="txtC">
							<span class="btn01"><a id="id_btn_text" href="javascript:Process();">Ȯ��</a></span>
							<span class="btn02" id="button_cancel_show"><a href="javascript:cancel();">���</a></span>
						</div>			
						
					</div>
					
					<input type="submit" style="display:none" id="submit_button" name="submit_button" />
</form>

	
						
					<h2 class="H2blt"><?=$codeTitle?> ���</h2>
					<!-- S: �˻� -->
					<div id="Bd-top-sch">
						<div class="page">
							Total <span class="orange bold"><?=$rowCount?></span> (<strong><?=$per_page?></strong>/<?=$allPage?> page)
						</div>
						<div class="sch">
							<form id="top-sch" name="top-sch" method="get" action="/admin/codeManagement/schoolManagerList">
								
								<fieldset>
									
									<legend>�Խù� �˻�</legend>
									
										<label for="sch_item">�˻��׸�</label>
										<?=$gubunList?>
										&nbsp;<?=$codeTitle?>��
										<label for="sch_key">�˻���</label>
										<input type="text" name="sch_sch_nm" id="sch_sch_nm" title="�˻����Է�" style="width:100px" value="<?=$sch_sch_nm?>"/>
										<input class="image" type="image" src="/assets/img/btn/btn_search.gif" alt="�˻�" />
								</fieldset>
							</form>
						</div>
					</div>
					<!-- E: �˻� -->

					<table id="BdList-Type01" summary="���">
						<caption>���</caption>
						<colgroup>
							<col width="60px" />
							<col width="15%" />
							<col width="*" />

							<col width="10%" />
							<col width="80px" />
							<col width="80px" />
						</colgroup>
						<thead>
							<tr>
								<th scope="col" class="first">��ȣ</th>
								<th scope="col">����</th>
								<th scope="col"><?=$codeTitle?> ��</th>
		
								<th scope="col">�����</th>
								<th scope="col">����</th>
								<th scope="col">����</th>				
							</tr>
						</thead>
						<tbody>
						<? 
							if ( count($rdata) > 0 ) { 
							foreach ($rdata as $key => $data) { 
						?>
							<tr>
								<td><?=$data->ROW_NUM?></td>
								<td><?=$data->CD_NM?></td>
								<td><?=$data->SCH_NM?></td>
								
								<td><?=$data->REG_DT?></td>
								<td><span class="btn03"><a href="javascript:modifyProcess('<?=$data->SCH_IDX?>');">����</a></span></td>
								<td><span class="btn04"><a href="javascript:deleteProcess('<?=$data->SCH_IDX?>');">����</a></span></td>
							</tr>
						<?} 
							
							} 
							else 
							{ ?>
							<tr>
								<td colspan="6" class="no-data">�ش� �����Ͱ� �����ϴ�.</td>
							</tr>
						<? } ?>
						</tbody>
					</table>

					<!-- S: ����¡ -->
					<div id="Paging">
						<div id="Page-Index">
							<?=$paging?>
						</div>
					</div>
					<!--// E: ����¡ -->