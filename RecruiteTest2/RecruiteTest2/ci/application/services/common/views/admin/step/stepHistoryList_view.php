<script>
	
	function bodyOnLoad()
	{
		window.resizeTo(650,$("#mainContent").height() + 50);
	}
	
	
</script>

					<h2 class="H2blt"><?=$APPLY_NO?></h2>
					<table id="BdList-Type01" summary="목록">
						<caption>목록</caption>
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
								<th scope="col">처리자</th>	
								<th scope="col">변경된전형</th>
								<th scope="col">발생일자</th>
								<th scope="col">발생아이피</th>
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