<!-- S: �˻� -->
<script language="javascript" src="/assets/js/jquery.validate.js"></script>
<script>
	
	function bodyOnLoad()
	{
		
		$("#top-sch").validate({  
				groups:{SCH_MSG:"SCH_KEY SCH_TYPE"},
		    rules: {  
		      SCH_KEY:{required:function(element) { if ($("#SCH_TYPE option:selected").val() != '' ) return true; else return false; } },
		      SCH_TYPE:{required:function(element) { if ($("#SCH_KEY").val() != '' ) return true; else return false; } }
		    },  
		    onkeyup:false,
		    messages: {
		    		SCH_KEY:{required:"�˻�� �Է��ϼ���."},
		    		SCH_TYPE:{required:"�˻������� �����ϼ���."}
		    },
		    submitHandler: function(form) { 
				
	    	form.submit();

	    	}
   	});  
		
	}
	
</script>
					<div id="Bd-top-sch">
						<div class="page">
							Total <span class="orange bold"><?=number_format($rowCount)?></span> (<strong><?=$cur_page?></strong>/<?=$allPage?> page)
						</div>
						<div class="sch">
							<form id="top-sch" name="top-sch" action="/admin/chargerManagement" method="get" >
								<fieldset>
									<legend>�Խù� �˻�</legend>
										
										
										<?=$SELECTBOX_SCH_TYPE?>
										
										<input type="text" name="SCH_KEY" id="SCH_KEY" value="<?=$SCH_KEY?>" title="�˻����Է�" />
										<input class="image" type="image" src="../assets/img/btn/btn_search.gif" alt="�˻�" />
								</fieldset>
								
							</form>
						</div>
					</div>
					<!-- E: �˻� -->

					<!-- S: �Խù�����Ʈ -->
					<table id="BdList-Type01" summary="���� ��ũ�� ���ؼ� �Խù� �� �������� �̵��մϴ�.">
						<caption>���</caption>
						<colgroup>
							<col width="60px" />
							<col width="10%" />
							<col width="10%" />
							<col width="10%" />
							<col width="80px" />
							<col width="10%" />
							<col width="10%" />
							<col width="*" />	
							<col width="*" />	
							<col width="80px" />
							<col width="75px" />
						</colgroup>
						<thead>
							<tr>
								<th scope="col" class="first">��ȣ</th>
								<th scope="col">����</th>
								<th scope="col">ID</th>
								<th scope="col">�����</th>
								<th scope="col">�μ�</th>
								<th scope="col">����</th>
								<th scope="col">��ȭ��ȣ</th>
								<th scope="col">�ڵ���</th>
								<th scope="col">�̸���</th>
								<th scope="col">�����</th>
								<th scope="col">��뿩��</th>
							</tr>
						</thead>
						<tbody>
						<? 
							if ( $mngInfoCount > 0 ) { 
						 	foreach ( $adminList as $key => $data){
						 ?>
							<tr>
								<td><?=$data->ROW_NUM?></td>
								<td><?=$data->MANAGER_TP?></td>
								<td><?=$data->MANAGER_ID?></td>
								<td><a onclick="javascript:goLink('/admin/chargerManagement/modifyManager?manager_id=<?=$data->MANAGER_ID?>','pop','width=520 height=572')" style="cursor:hand;"><?=$data->MANAGER_NM?></a></td>
								<td><?=$data->DEPT?></td>
								<td><?=$data->PSTN?></td>
								<td><?=$data->TEL?></td>
								<td><?=$data->MOBILE?></td>
								<td><?=$data->EMAIL?></td>
								<td><?=$data->REG_DT?></td>
								<td><?=$data->USE_YN == 'Y' ? '<span class="ico01"><span>���</span></span>' : '<span class="ico02"><span>����</span></span>';?></td>
							</tr>
					 		<? 
					 	  }
					 	
					 	  } else {
					 	  ?>
							<tr>
								<td colspan="11" class="no-data">�ش� �����Ͱ� �����ϴ�.</td>
							</tr>
							<?
							}
							?>
						</tbody>
					</table>
					<!--// E: �Խù�����Ʈ -->

					

					<!-- S: ����¡ -->
					<div id="Paging">
						<div id="Page-Index"><?=$paging?></div>
							
						
					</div>
					<!--// E: ����¡ -->

					<div class="txtR">
						<span class="btn01"><a href="javascript:goLink('/admin/chargerManagement/registManager','pop','width=520 height=548')">���� �߱�</a></span>
					</div>
					