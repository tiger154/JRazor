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
							<tr>
								<th scope="row" colspan="3">��� ��</th>
								<td><?=$cmpInfo[0]->COMP_NM?></td>
							</tr>
							<tr>
								<th scope="row" colspan="3">����� ä�� URL</th>
								<td><a href="http://<?=$cmpInfo[0]->DOMAIN_ID?>.<?=MAIN_SERVICE_DOMAIN?>" target="_blank">http://<?=$cmpInfo[0]->DOMAIN_ID?>.<?=MAIN_SERVICE_DOMAIN?></a></td>
							</tr>
							<tr>
								<th scope="row" colspan="3">������ ä�� URL</th>
								<td><a href="http://<?=$cmpInfo[0]->DOMAIN_ID?>.<?=MAIN_SERVICE_DOMAIN?>/admin" target="_blank">http://<?=$cmpInfo[0]->DOMAIN_ID?>.<?=MAIN_SERVICE_DOMAIN?>/admin</a></td>
							</tr>
							<tr>
								<th scope="row" colspan="3">����� ��Ϲ�ȣ</th>
								<td><?=$cmpInfo[0]->CMP_NO?></td>
							</tr>
							<tr>
								<th scope="row" colspan="3">��ǥ�� ����</th>
								<td><?=$cmpInfo[0]->CEO_NM?></td>
							</tr>
							<tr>
								<th scope="row" colspan="3">��ǥ ��ȣ</th>
								<td><?=$cmpInfo[0]->CMP_TEL?></td>
							</tr>
							<tr>
								<th scope="row" colspan="3">�ѽ� ��ȣ</th>
								<td><?=$cmpInfo[0]->CMP_FAX?></td>
							</tr>
							<tr>
								<th scope="row" colspan="3">����� ������</th>
								<td><?=$cmpInfo[0]->CMP_ADD?></td>
							</tr>
							<tr>
								<th scope="row" colspan="3">����� ���� - ����</th>
								<td><?=$cmpInfo[0]->CMP_TP?></td>
							</tr>
							<tr>
								<th scope="row" colspan="3">����� ���� - ����</th>
								<td><?=$cmpInfo[0]->CMP_GUBUN?></td>
							</tr>
							<tr>
								<th scope="row" colspan="3">
									
									<label for="w07">���� ����Ʈ TITLE</label>
								</th>
								<td>
									<?=$APPLY_SITE_TITLE?>
								
								</td>
							</tr>
							<tr>
								<th scope="row" colspan="3">
									
									<label for="w07">���� ����Ʈ ���ø�</label>
								</th>
								<td>
									<img src="/assets/img/template_thumb/<?=$APPLY_SITE_TEMPLATE?>.jpg" />
									
								</td>
							</tr>
							<tr>
								<th scope="row" colspan="3">��� LOGO 1.</th>
								<td><img src="<?=$LOGO_IMG1?>" width="203" height="36" /></td>
							</tr>
							<tr>
								<th scope="row" colspan="3">��� LOGO 2.</th>
								<td><img src="<?=$LOGO_IMG2?>" width="203" height="36" /></td>
							</tr>
							<tr>
								<th scope="row" colspan="3">�����̹���</th>
								<td><img src="<?=$FRONT_MAIN_IMG?>" /></td>
							</tr>
							<tr>
								<th scope="row" colspan="3">�����̹���</th>
								<td><img src="<?=$FRONT_SUB_IMG?>" /></td>
							</tr>
							<tr>
								<th scope="row" colspan="3">�����</th>
								<td><?=$cmpInfo[0]->REG_DT?></td>
							</tr>
							<tr>
								<th scope="row" colspan="3">Q&A ���� ���� �ޱ�</th>
								<td><?=$cmpInfo[0]->QNA_MAIL == 'Y' ? '����' : '�Ұ���'?></td>
							</tr>
							<tr>
								<th scope="row" colspan="3">� ��Ȳ</th>
								<td><?=$cmpInfo[0]->SRV_STS == 'Y' ? '�' : '����'?></td>
							</tr>
							<tr>
								<th scope="row" colspan="3">������Ʈ ���� ����</th>
								<td><?=$cmpInfo[0]->PRJ_MNG == 'Y' ? '����' : '�Ұ���'?></td>
							</tr>
							
						</tbody>
					</table>					
					<!--// E: �ۼ� -->

					<div class="txtC">
						<span class="btn01"><a href="javascript:goLink('/admin/companyManagement/ModifyCompanyInfo?company_id=<?=$cmpInfo[0]->COMP_ID?>');">����</a></span>
						<span class="btn02"><a href="javascript:goLink('/admin/companyManagement?dd=d');">���ư���</a></span>
					</div>
					
					
					<!-- S: Ÿ��Ʋ-->
				<div id="Title-box">
					<h1>��� �����</h1>
					
				</div>
				<!--// E: Ÿ��Ʋ-->

					

					<!-- S: �Խù�����Ʈ -->
					<table id="BdList-Type01" summary="���� ��ũ�� ���ؼ� �Խù� �� �������� �̵��մϴ�.">
						<caption>���</caption>
						<colgroup>
							<col width="60px" />
							<col width="*" />
							<col width="*" />
							<col width="*" />
							<col width="*" />
							<col width="*" />
							<col width="*" />
							<col width="*" />
							<col width="*" />	
							<col width="*" />
							<col width="95px" />
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
								<th scope="col">�޴���</th>
								<th scope="col">�̸���</th>
								<th scope="col">�����</th>
								<th scope="col">��뿩��</th>
							</tr>
						</thead>
						<tbody>
						<? 
							if ( $mngInfoCount > 0 ) { 
						 	foreach ( $mngInfo as $key => $data){
						 ?>
							<tr>
								<td><?=($key+1)?></td>
								<td><?=$data->MANAGER_TP?></td>
								<td><?=$data->MANAGER_ID?></td>
								<td><?=$data->MANAGER_NM?></td>
								<td><?=$data->DEPT?></td>
								<td><?=$data->PSTN?></td>
								<td><?=$data->MOBILE?></td>
								<td><?=$data->MOBILE?></td>
								<td><?=$data->EMAIL?></td>
								<td><?=$data->REG_DT?></td>
								<td><?=$data->USE_YN == 'Y' ? '<span class="ico01"><span>����</span></span>' : '<span class="ico02"><span>�Ұ�</span></span>'?></td>
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
					
					<br>
			
			
					<div class="txtR">
						<span class="btn01"><a href="javascript:goLink('/admin/chargerManagement');">��� ����� ���� �ٷ� ����</a></span>
					</div>