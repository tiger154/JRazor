<script>
	
	function bodyOnLoad()
	{
		window.resizeTo(650,$("#mainContent").height() + 50);
	}
	
	
</script>

					<h2 class="H2blt"><?=$APPLY_NO?></h2>
					<table id="BdList-Type01" summary="���">
						<caption>���</caption>
						<colgroup>
							
							<col width="50px" />
							<col width="*" />
							<col width="*" />
							<col width="*" />
							
							<col width="*" />
						</colgroup>
						<thead>
							<tr>
								<th scope="col" class="first">No</th>
								<th scope="col">ó����</th>	
								<th scope="col">���������</th>
								<th scope="col">�߻�����</th>
								<th scope="col">�߻�������</th>
							</tr>
						</thead>
						<tbody>
							<? foreach ($rdata as $key => $clist) { ?>
							<tr>	
								<td><?=$clist->ROW_IDX?></td>
								<td><?=$clist->MANAGER_NM?>(<?=$clist->MANAGER_ID?>)</td>
								
								<td><?=$clist->STEP_NM?></td>
								<td><?=$clist->LOG_DT?></td>
								<td><?=$clist->LOG_IP?></td>
							</tr>
							<? } ?>
						</tbody>
					</table>