<!-- S: �˻� -->
					<div id="Bd-top-sch">
						<div class="page">
							Total <span class="orange bold"><?=$rowCount?></span> (<strong><?=$cur_page?></strong>/<?=$allPage?> page)
						</div>
						<div class="sch">
							<form id="top-sch" name="top-sch" action="/admin/companyManagement" method="get">
								<fieldset>
									<legend>�Խù� �˻�</legend>
										<label for="sch_item">�˻��׸�</label>
										<?=$SELECTBOX_SCH_TYPE?>
										<label for="sch_key">�˻���</label>
										<input type="text" name="SCH_KEY" id="SCH_KEY" value="<?=$SCH_KEY?>" title="�˻����Է�" />
										<input class="image" type="image" src="/assets/img/btn/btn_search.gif" alt="�˻�" />
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
							<col width="*" />
							<col width="*" />
							<col width="*" />
							<col width="100px" />	
							<col width="100px" />
							<col width="75px" />
						</colgroup>
						<thead>
							<tr>
								<th scope="col" class="first">��ȣ</th>
								<th scope="col">�����</th>
								<th scope="col">����ڵ�</th>
								<th scope="col">��ȭ��ȣ</th>
								<th scope="col">FAX</th>
								<th scope="col">�����URL</th>
								<th scope="col">������URL</th>
								<th scope="col">QNAMAIL</th>
								<th scope="col">������Ʈ</th>
								<th scope="col">�����</th>
							</tr>
						</thead>
						<tbody>
						<? 
							if ( $cmpListCount > 0 ) { 
						 	foreach ( $cmpList as $key => $data){
						 ?>
							<tr>
								<td><?=$data->ROW_NUM?></td>
								<td><a href="javascript:goLink('/admin/companyManagement/ViewCompanyInfo?company_id=<?=$data->COMP_ID?>');"><?=$data->COMP_NM?></a></td>
								<td><a href='#' onclick="goLink('/admin/companyManagement/ViewCompanyInfo?company_id=<?=$data->COMP_ID?>');"><?=$data->COMP_ID?></a></td>
								<td><?=$data->CMP_TEL?></td>
								<td><?=$data->CMP_FAX?></td>
								<td><a href="http://<?=$data->DOMAIN_ID?>.<?=MAIN_SERVICE_DOMAIN?>" target="_blank">http://<?=$data->DOMAIN_ID?>.<?=MAIN_SERVICE_DOMAIN?></a></td>
								<td><a href="http://<?=$data->DOMAIN_ID?>.<?=MAIN_SERVICE_DOMAIN?>/admin" target="_blank">http://<?=$data->DOMAIN_ID?>.<?=MAIN_SERVICE_DOMAIN?>/admin</a></td>
								<td><?=$data->QNA_MAIL == 'Y' ? '<span class="ico01"><span>����</span></span>' : '<span class="ico02"><span>�Ұ�</span></span>'?></td>
								<td><?=$data->PRJ_MNG == 'Y' ? '<span class="ico01"><span>����</span></span>' : '<span class="ico02"><span>�Ұ�</span></span>'?></td>
								<td><?=$data->SRV_STS == 'Y' ? '<span class="ico01"><span>�</span></span>' : '<span class="ico02"><span>����</span></span>'?></td>
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
						<span class="btn01"><a href="javascript:goLink('/admin/companyManagement/RegistCompanyInfo')" >��� ���</a></span>
					</div>
					