<?
	$p_col_size = $ConstData[0]->ROW_SIZE;	
	switch ($MENU_FLAG)
	{
		case 'seat' :
			$seg_nm = 'seatPrint';
			break;
			
		case 'list' :
			$seg_nm = 'myoungbuPrint';
			break;
		
		case 'tag' :
			$seg_nm = 'namePrint';
			break;
		
	}
	
?>
<script>
	
	function goPrint(title_nm)
	{
		$("#GUBUN_TITLE").val(title_nm);
		goLink('','pop','width=950 height=500 resizable=yes scrollbars=yes status=yes','open_pops2');
		$("#form1").attr('target','open_pops2');
		$("#form1").attr("action","/admin/reportService/<?=$seg_nm?>");
		$("#form1").attr("method","post");
		$("#form1").submit();
	}
	
</script>
<style>
	ul li { width:<?=$p_col_size * 100?>px; }
	ul li span { float:left;width:100px;height:15px; }
</style>
<form id="form1" name="form1" >
<input type="hidden" id="PRJ_IDX" name="PRJ_IDX" value="<?=$PRJ_IDX?>" />
<input type="hidden" id="MENU_FLAG" name="MENU_FLAG" value="<?=$MENU_FLAG?>" />
<input type="hidden" id="COL_SIZE" name="COL_SIZE" value="<?=$p_col_size?>" />
<input type="hidden" id="GUBUN_TITLE" name="GUBUN_TITLE" />
</form>
<table id="BdList-Type01" class="mgb15" summary="명부 출력">
				<caption>명부 출력</caption>
				<colgroup>
					<col width="15%" />
					<col width="*" />
					<col width="10%" />
					<col width="10%" />
				</colgroup>
				<thead>
					<tr>
						<th scope="col" class="first">고사장명</th>
						<th scope="col">수험번호 리스트</th>
						<th scope="col">고사장별<br>인원수</th>
						<th scope="col">출력</th>				
					</tr>
				</thead>
				<tbody>
				<?
					
					foreach ($rdata as $key => $rlist)
					{
						
						if ($rlist->ORD == 1)
						{
							echo '<tr>
										<td>' . $rlist->TITLE_GUBUN . '</td>
										<td><div id="Seat-box2">';
						}
						
							if ($rlist->COL_SIZE == 1) echo '<ul>';
							echo '<li>' . $rlist->APPLY_NO . '</li>';
							if ($rlist->COL_SIZE == $p_col_size || $rlist->ORD == $rlist->GUBUN_CNT ) echo '</ul>'; 
							
						if ($rlist->ORD == $rlist->GUBUN_CNT)
						{
							echo '</div></td>
										<td>' . $rlist->GUBUN_CNT . '</td>
										<td><span class="btn04"><a href="javascript:goPrint(\'' . base64_encode($rlist->TITLE_GUBUN) . '\');">인쇄</a></span></td></tr>';
						}
					
					}
				?>	
				
				
				</tbody>
			</table>

			<div class="txtC">
				<span class="btn02"><a href="javascript:window.close();">닫기</a></span>
			</div>