<!-- S: �˻� -->
					<div id="Bd-top-sch">
						<div class="page">
							Total <span class="orange bold"><?=$rowCount?></span> (<strong><?=$per_page?></strong>/<?=$allPage?> page)
						</div>
						<div class="sch">
						
						</div>
					</div>
					<!-- E: �˻� -->

					<!-- S: �Խù�����Ʈ -->
					<table id="BdList-Type01" summary="���� ��ũ�� ���ؼ� �Խù� �� �������� �̵��մϴ�.">
						<caption>���</caption>
						<colgroup>
							<col width="60px" />
							<col width="60px" />
							<col width="10%" />
							<col width="10%" />
							<col width="10%" />
							<col width="80px" />
							<col width="10%" />
							<col width="10%" />
							<col width="*" />	
							<col width="80px" />
							<col width="75px" />
						</colgroup>
						<thead>
							<tr>
								<th scope="col" class="first">����</th>
								<th scope="col" >��ȣ</th>
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
							if ( $rowCount > 0 ) { 
						 	foreach ( $adminList as $key => $data){
						 ?>
							<tr>
								<td><input id="MANAGER_LIST<?=$key?>" name="MANAGER_LIST<?=$key?>" class="checkbox" type="checkbox" value="<?=$data->MANAGER_ID?>" /></td>
								<td><?=$data->ROW_NUM?></td>
								<td><?=$data->MANAGER_ID?></td>
								<td><a onclick="javascript:goLink('/admin/adminManagement/modifyManager?manager_id=<?=$data->MANAGER_ID?>','pop','width=520 height=536')" style="cursor:hand;"><?=$data->MANAGER_NM?></a></td>
								<td><?=$data->DEPT?></td>
								<td><?=$data->PSTN?></td>
								<td><?=$data->TEL?></td>
								<td><?=$data->MOBILE?></td>
								<td><?=$data->EMAIL?></td>
								<td><?=$data->REG_DT?></td>
								<td><?=$data->USE_YN == 'Y' ? '<span class="ico01"><span>���</span></span>' : '<span class="ico02"><span>����</span></span>' ?></td>
							</tr>
					 		<? 
					 	  }
					 	
					 	  } else {
					 	  ?>
							<tr>
								<td colspan="10" class="no-data">�ش� �����Ͱ� �����ϴ�.</td>
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
					    <span class="btn01"><a href="javascript:delCheckedManager()" >���� ��������(��������)</a></span>
						&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						<span class="btn01"><a href="javascript:goLink('/admin/adminManagement/registManager','pop','width=520 height=508')" >�ְ� ������ ���� �߱�</a></span>
					</div>
					

					<script>
					    // define gloval vars						
						var sourceArr = new Array;
						$(document).ready(function() {   
							$('input:checkbox').change( function() {
									var id = $(this).attr('id');
									var isChecked = $(this).is(':checked');
									if(isChecked){
										sourceArr.splice(sourceArr.length,1,id);
									}									
								}
							);
						});

						function delCheckedManager(){
							alert('���� ���� ����:��������\n Checked Value : '+sourceArr);		
							//Ajax Process 

						}
					</script>