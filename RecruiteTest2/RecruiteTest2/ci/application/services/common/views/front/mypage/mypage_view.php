<style>
 /* Style04 */
.btn04, .btn04 *{
	display:inline-block;
	background:url(../../assets/img/bg/btn_bg04.gif) no-repeat right top;
	height:21px;
	font-size:12px;
	text-decoration:none !important;
	text-align:center;
	vertical-align: middle;
}

.btn04 a, .btn04 a *{
	display:inline-block;
	background:url(../../assets/img/bg/btn_bg04.gif) no-repeat left top;
	height:16px;
	line-height:12px;
	font-size:12px;
	color:#4b4b4b !important; 
	text-decoration:none !important; 
	padding: 5px 10px 0 10px;
	vertical-align: top;
}

.btn04 a span, .btn04 a span *{
	width:auto;
	color:#ff5400 !important; 
	background:none;
	padding: 0 0 0 0; 
	height:0 !important; 
	vertical-align: top;
}
</style>
<script>
	
	function goApplyModify(code)
	{
		$("#PRJ_IDX").val(code);
		$("#form1").attr("action","/front/apply");
		$("#form1").attr("method","post");
		$("#form1").submit();
	}
	
	function goApplyView(code)
	{
		$("#PRJ_IDX").val(code);
		$("#form1").attr("action","/front/apply/applyView");
		$("#form1").attr("method","post");
		$("#form1").submit();
	}
	
</script>
<form name="form1" id="form1" >
<input type="hidden" id="PRJ_IDX" name="PRJ_IDX"  />
</form>
							<div class="h3-tit-box">
								<h3>�Ի����� ��Ȳ</h3>
							</div>

							<ul class="listStyle01">
								<li><span class="bold"><?=$NAMEKOR?></span> ���� �Ի����� ��Ȳ �Դϴ�.</li>
								<li class="red">�Ի��������� ���� ���� ���Ŀ��� ������ �Ұ��� �մϴ�.</li>
							</ul>

							<div class="border-box">
								
									  <? foreach ($rdata as $key => $appList) { ?>
									  <br>
									  ����� : <strong><?=$appList->PRJ_NM?></strong>
										<table class="TbStyle01 mgt10" summary="�Ի����� ��Ȳ">
										<caption>�Ի����� ��Ȳ</caption>
										
									  
										<colgroup>
										<col width="*" />
										<col width="*" />
										<col width="*" />
										<col width="*" />
										<col width="*" />
										<col width="60px" />
										<col width="60px" />
										</colgroup>
										<thead>
										<tr>
											<th rowspan="2" scope="col">�о�</th>
											<th rowspan="2" scope="col">�����ȣ</th>
											<th rowspan="2" scope="col">������</th>
											<th rowspan="2" scope="col">��������</th>
											<th rowspan="2" scope="col">�������</th>
											<th scope="col" colspan="2">������ ����</th>
										</tr>
										<tr>
											<th scope="row">Ȯ��</th>
											<th scope="row">����</th>
										</tr>
										</thead>
										<tbody>
										<tr>
											<td><?=$appList->UNIT_NM?></td>
											<td><strong><font color="red"><?=$appList->APPLY_NO?></font></stront></td>
											<td><?=$appList->APPL_DT?></td>
											<td align="center"><?=$appList->APPL_YN == 'Y' ? '�����Ϸ�' : '<strong><font color="red">������</font></strong>' ?></td>
											<td align="center"><?=$appList->STEP_NM?> <?=$appList->STS == 'Y' ? '������' : '����' ?></td>
											<td><span class="btn04"><a href="javascript:goApplyView('<?=$appList->PRJ_IDX?>');">Ȯ��</span></td>
											<td><span class="btn04"><? if ($appList->APPLY_STS == 'Y') { ?><a href="javascript:goApplyModify('<?=$appList->PRJ_IDX?>');">����</span><? } ?></td>
											
										</tr>
										</tbody>
										</table>
										
										<? } ?>
										<!--tr>
											<th scope="row" class="last">��й�ȣ ����</th>
											<td colspan="3" class="last"><a href="#"><img src="<?=$FRONT_IMG_URL?>/img/board/btn_change.gif" alt="����" /></a></td>
										</tr-->
									  
								<span class="btm-line"></span>
							</div>
