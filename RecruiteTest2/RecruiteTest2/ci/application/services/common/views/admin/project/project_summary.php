<!-- S: �˻� -->
<?
$CI =& get_instance();
$CI->load->library('DataControl');
?>
<script>
	
	function projectProcess(cmp_cd,cmp_nm)
	{
		$("#admin_login_comp_nm").val(cmp_nm);
		$("#admin_login_comp_id").val(cmp_cd);
		$("#AdminLoginCompForm1").attr("action","/admin/login/companyLoginProcess");
		$("#AdminLoginCompForm1").attr("method","post");
		$("#AdminLoginCompForm1").submit();	
	}
</script>
					<div id="Bd-top-sch">
						<div class="btn">
							<span class="btn01"><a href="/admin/projectManagement">��ü ��� ������Ʈ ��Ȳ ����</a></span>
						</div>
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
										<input class="image" type="image" src="/assets/img/btn/btn_search.gif" alt="�˻�" />
								</fieldset>
							</form>
						</div>
					</div>
					<!-- E: �˻� -->

					<!-- S: �Խù�����Ʈ -->
					<div id="CompanyList">
						
						<ul>
							<?
							foreach ($rData as $key => $data)
							{
							?>
							<li>
								<dl>
									<dt><a href="javascript:projectProcess('<?=$data->COMP_ID?>','<?=$data->COMP_NM?>');"><?=$data->COMP_NM?></a></dt>
									<!-- �̹��������� 200*100 -->
									<dd class="logo"><a href="javascript:projectProcess('<?=$data->COMP_ID?>','<?=$data->COMP_NM?>');"><img src="<?=$CI->datacontrol->getLogoPath($data->DOMAIN_ID,1)?>" alt="����ΰ��̹���" width="200" height="100" /></a></dd>
									<dd>�������� ������Ʈ <?=$data->CNT?> �� </dd>
									<dd><a href="http://<?=$data->DOMAIN_ID?>.<?=MAIN_SERVICE_DOMAIN?>" target="_blank"><img src="/assets/img/btn/btn_job_page.gif" alt="����� ä�� ���� ������ �ٷΰ���" /></a></dd>
								</dl>
							</li>
							<?
							}
							?>
						
						</ul>
					</div>
					<!--// E: �Խù�����Ʈ -->

					<!-- S: ����¡ -->
					
					<div id="Paging">
						<div id="Page-Index"><?=$paging?></div>
					</div>
					<!--// E: ����¡ -->