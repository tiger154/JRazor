<script>
	
	function goDelete(code)
	{
		if (confirm('삭제하시겠습니까?'))
		{
			$("#RETURN_URL").val('/admin/webFileManagement');
			$("#WEBIDX").val(code);
			$("#form1").attr('method','post');
			$("#form1").attr('action','/admin/webFileManagement/Process');
			$("#form1").submit();
		}
	}
	
	function goModify(code)
	{
		$("#RETURN_URL").val('');
		$("#ACT_FLAG").val('modify');
		$("#WEBIDX").val(code);
		$("#form1").attr('method','post');
		$("#form1").attr('action','/admin/webFileManagement/Form');
		$("#form1").submit();
	}
	
	function clipboard(arg)
	{
		window.clipboardData.setData('Text',arg);
    alert("복사되었습니다.");
	}
	
</script>
<form id="form1" name="form1" >
<input type="hidden" id="RETURN_URL" name="RETURN_URL" />
<input type="hidden" id="WEBIDX" name="WEBIDX" />
<input type="hidden" id="ACT_FLAG" name="ACT_FLAG" value="delete" />
</form>
						<table id="BdList-Type01" summary="">
						<caption>목록</caption>
						<colgroup>
							<col width="60px" />
							<col width="300px" />
							<col width="*" />
							<col width="90px" />
							<col width="90px" />
						</colgroup>
						<thead>
							<tr>
								<th scope="col" class="first">No</th>
								<th scope="col">파일명</th>
								<th scope="col">URL</th>
								<th scope="col">복사</th>
								<th scope="col">확인</th>
							</tr>
						</thead>
						<tbody>
						<? 
							if ( $num_rows > 0 ) { 
						 	foreach ( $rdata as $key => $data){
						 ?>
							<tr>
								<td><?=$data->ORD?></td>
								<td><a href="javascript:goModify('<?=$data->WEBIDX?>');"><?=$data->FILE_NM?></a></td>
								<td>http://<?=$data->DOMAIN_ID?>.<?=MAIN_SERVICE_DOMAIN?><?=WEBFILE_URL?>/<?=$data->DOMAIN_ID?>/<?=$data->FILE_NM?></td>
								<td><span class="btn04"><a  href="javascript:clipboard('http://<?=$data->DOMAIN_ID?>.<?=MAIN_SERVICE_DOMAIN?><?=WEBFILE_URL?>/<?=$data->DOMAIN_ID?>/<?=$data->FILE_NM?>');">복사</a></span></td>
								<td><span class="btn04"><a target="_blank" href="http://<?=$data->DOMAIN_ID?>.<?=MAIN_SERVICE_DOMAIN?><?=WEBFILE_URL?>/<?=$data->DOMAIN_ID?>/<?=$data->FILE_NM?>">확인</a></span></td>
							</tr>
					 		<? 
					 	  }
					 	
					 	  } else {
					 	  ?>
							<tr>
								<td colspan="5" class="no-data">해당 데이터가 없습니다.</td>
							</tr>
							<?
							}
							?>
						</tbody>
					</table>
					<BR/>
					<div class="txtR">
						<span class="btn01"><a href="/admin/webFileManagement/Form">FILE 등록</a></span>
					</div>