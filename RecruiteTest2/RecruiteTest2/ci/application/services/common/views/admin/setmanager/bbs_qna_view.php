					<ul class="tabStyle01">
						<?
							if ( $bbsGroupCount > 0 ) { 
						 		foreach ( $bbsGroup as $key => $data){
						 ?>
							<li <?=($data->SELECTED)? 'class="on"' : '' ?>><a href="<?=$data->BBS_URL?>"><?=$data->BBS_NAME?></a></li>
						<?
								}
					 		}
						 ?>
					</ul>

					<!-- S: �˻� -->
					<div id="Bd-top-sch">
						<div class="sch">
							<form id="top-sch" name="top-sch" action="#" method="post">
								<fieldset>
									<legend>�Խù� �˻�</legend>
										<label for="sch_item">�˻��׸�</label>
										<select name="sch_item" id="sch_item" >
											<option value="">�����</option>
										</select>
										<label for="sch_key">�˻���</label>
										<input type="text" name="sch_key" id="sch_key" title="�˻����Է�" />
										<input class="image" type="image" src="../assets/img/btn/btn_search.gif" alt="�˻�" />
								</fieldset>
							</form>
						</div>
					</div>
					<!-- E: �˻� -->

					<table id="BdList-Type01" summary="���� ��ũ�� ���ؼ� �Խù� �� �������� �̵��մϴ�.">
						<caption>���</caption>
						<colgroup>
							<col width="60px" />
							<col width="*" />
							<col width="10%" />
							<col width="10%" />
							<col width="10%" />
							<col width="10%" />
						</colgroup>
						<thead>
							<tr>
								<th scope="col" class="first">��ȣ</th>
								<th scope="col">����</th>
								<th scope="col">�ۼ���</th>
								<th scope="col">�ۼ���</th>
								<th scope="col">ó����</th>
								<th scope="col">ó������</th>				
							</tr>
						</thead>
						<tbody>
							<tr>
								<td>1</td>
								<td class="left"><a href="#"><span class="orange">[2012 ��ݱ� ä��]</span> 2012�� ��ݱ� ä�� ���� ���� �Դϴ�.   </a></td>
								<td>Ŀ�����ɾ�</td>
								<td>2012-12-15</td>
								<td>2012-12-15</td>
								<td><span class="ico03"><span>����</span></span></td>
							</tr>
							<tr>
								<td>1</td>
								<td class="left"><a href="#"><span class="orange">[2012 ��ݱ� ä��]</span> 2012�� ��ݱ� ä�� ���� ���� �Դϴ�.   </a></td>
								<td>Ŀ�����ɾ�</td>
								<td>2012-12-15</td>
								<td>2012-12-15</td>
								<td><span class="ico04"><span>ó���Ϸ�</span></span></td>
							</tr>
							<tr>
								<td colspan="6" class="no-data">�ش� �����Ͱ� �����ϴ�.</td>
							</tr>
						</tbody>
					</table>

					<!-- S: ����¡ -->
					<div id="Paging">
						<div id="Page-Index"><?=$paging?></div>
					</div>
					<!--// E: ����¡ -->
					<!--a href="javascript:Test();">Test!</a-->
					<script language="javascript" src="http://common.trns.co.kr/assets/js/json2.js"></script>
					<script language="javascript" src="http://common.trns.co.kr/assets/js/jQuery.XDomainRequest.js"></script>
					<!--script type="text/javascript">
						//document.domain = "trns.co.kr";
						$.support.cors = true;
						function Test() {
							$.ajax({
								url: "http://sendmail.trns.co.kr:18023/MailService.asmx/SendMailByGrouping",//2?mail_idx=1&per_count=3&delay=3000",
								type: "GET",
								data: {mail_idx:1,per_count:3,delay:1000},
								contentType: "application/xml; charset=utf-8",
								dataType: "xml",
								success: function(data){
									//alert(data.text);
									alert($(data).text());
								},
								error: function(jqXHR, textStatus){
									alert(textStatus);
								}
							});
						}
					</script-->