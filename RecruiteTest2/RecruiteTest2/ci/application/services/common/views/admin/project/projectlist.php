<!-- S: �˻� -->
<script>

	function goDelete(prj_idx)
	{
		if (confirm('���� �Ͻðڽ��ϱ�?'))
		{
			$("#PRJ_IDX").val(prj_idx);
			$("#form1").attr("method","post");
			$("#form1").attr("action","/admin/projectManagement/deleteProcess");
			$("#form1").submit();
		}
	}
	
</script>
<form id="form1" name="form1" >
<input type="hidden" id="PRJ_IDX" name="PRJ_IDX" />
</form>
					<div id="Bd-top-sch">
						<div class="sch">
							<form id="top-sch" name="top-sch" action="/admin/projectManagement/projectList" method="get">
								
								<fieldset>
									<legend>�Խù� �˻�</legend>
										<label for="sch_item">�˻��׸�</label>
										<select name="sch_item" id="sch_item" >
											<option value="">������Ʈ��</option>
										</select>
										<label for="sch_key">�˻���</label>
										<input type="text" name="sch_prj_nm" id="sch_prj_nm" title="�˻����Է�" value="<?=$sch_prj_nm?>" />
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
							<col width="*" />
							<col width="*" />
							<col width="*" />
							<col width="80px" />
							<col width="95px" />
							<col width="95px" />
							<col width="95px" />
							<col width="95px" />
							<col width="95px" />
							<col width="80px" />
						</colgroup>
						<thead>
							<tr>
								<th scope="col" class="first">��ȣ</th>
								<th scope="col">�����</th>
								<th scope="col">������Ʈ��</th>
								<th scope="col">���� ����</th>
								<th scope="col">����</th>
								<th scope="col">����<br />����</th>
								<th scope="col">���ǻ���<br />����</th>
								<th scope="col">�����о� ��<br />�ڰݿ�� ����</th>
								<th scope="col">���� ����<br />����</th>
								<th scope="col">�Խ���<br />����</th>
								<th scope="col">����</th>
							</tr>
						</thead>
						<tbody>
							<? 
							if ( $prjdataCount > 0 ) { 
							foreach ( $prjdata as $key => $data){
							?>
							<tr>
								<td><?=$data->ROW_NUM?></td>
								<td><a href="javascript:goLink('/admin/projectManagement/projectView?project_id=<?=$data->PRJ_IDX?>')"><?=$data->COMP_NM?></a></td>
								<td><a href="javascript:goLink('/admin/projectManagement/projectView?project_id=<?=$data->PRJ_IDX?>')"><?=$data->PRJ_NM?></a></td>
								<td><?=$data->PRJ_STDT?> ~ <?=$data->PRJ_EDDT?></td>
								<td><strong><font color="brown"><?=$data->PRJ_STS == 'O' ? '����' : '����';?></font></strong></td>
								<td><span class="btn04"><a href="javascript:goLink('/admin/projectManagement/projectView?project_id=<?=$data->PRJ_IDX?>')">View</a></span></td>
								<td><span class="btn04"><a href="javascript:goLink('/admin/resumeComment/resumeSubList?project_id=<?=$data->PRJ_IDX?>')">View</a></span></td>
								<td><?=$data->UNIT_CNT == 0 ? '<strong><font color="red">��</font></strong>' : '';?>
									<span class="btn04"><a href="javascript:goLink('/admin/stepManagement/unitAuthList?project_id=<?=$data->PRJ_IDX?>')">View</a></span>
									<?=$data->UNIT_CNT == 0 ? '<strong><font color="red">��</font></strong>' : '';?>
								</td>
								<td><span class="btn04"><a href="javascript:goLink('/admin/stepManagement?project_id=<?=$data->PRJ_IDX?>')">View</a></span></td>
								<td><span class="btn04"><a href="javascript:goLink('/admin/bbsManagement/QnA?project_id=<?=$data->PRJ_IDX?>');">View <span class="color">(<?=number_format($data->BBS_CNT)?>)</span></a></span></td>
								<td><span class="btn04"><a href="javascript:goDelete('<?=$data->PRJ_IDX?>');">����</a></span></td>
							</tr>
						<? 
							}
							} else {
						 ?>
							<tr>
								<td colspan="11" class="no-data">�ش� �����Ͱ� �����ϴ�.</td>
							</tr>
						<? } ?>
						</tbody>
					</table>
					<!--// E: �Խù�����Ʈ -->

					<!-- S: ����¡ -->
					<div id="Paging">
						<div id="Page-Index"><?=$paging?></div>
					</div>
					<!--// E: ����¡ -->

					<div class="txtR">
						<span class="btn01"><a href="javascript:goLink('/admin/projectManagement/projectRegist')">������Ʈ ���</a></span>
					</div>