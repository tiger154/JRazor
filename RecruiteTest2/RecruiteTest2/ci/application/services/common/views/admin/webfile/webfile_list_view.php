<script>
	
	function goDelete(code)
	{
		if (confirm('�����Ͻðڽ��ϱ�?'))
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
    alert("����Ǿ����ϴ�.");
	}
	
</script>
<form id="form1" name="form1" >
<input type="hidden" id="RETURN_URL" name="RETURN_URL" />
<input type="hidden" id="WEBIDX" name="WEBIDX" />
<input type="hidden" id="ACT_FLAG" name="ACT_FLAG" value="delete" />
</form>
						<table id="BdList-Type01" summary="">
						<caption>���</caption>
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
								<th scope="col">���ϸ�</th>
								<th scope="col">URL</th>
								<th scope="col">����</th>
								<th scope="col">Ȯ��</th>
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
								<td><span class="btn04"><a  href="javascript:clipboard('http://<?=$data->DOMAIN_ID?>.<?=MAIN_SERVICE_DOMAIN?><?=WEBFILE_URL?>/<?=$data->DOMAIN_ID?>/<?=$data->FILE_NM?>');">����</a></span></td>
								<td><span class="btn04"><a target="_blank" href="http://<?=$data->DOMAIN_ID?>.<?=MAIN_SERVICE_DOMAIN?><?=WEBFILE_URL?>/<?=$data->DOMAIN_ID?>/<?=$data->FILE_NM?>">Ȯ��</a></span></td>
							</tr>
					 		<? 
					 	  }
					 	
					 	  } else {
					 	  ?>
							<tr>
								<td colspan="5" class="no-data">�ش� �����Ͱ� �����ϴ�.</td>
							</tr>
							<?
							}
							?>
						</tbody>
					</table>
					<BR/>
					<div class="txtR">
						<span class="btn01"><a href="/admin/webFileManagement/Form">FILE ���</a></span>
					</div>