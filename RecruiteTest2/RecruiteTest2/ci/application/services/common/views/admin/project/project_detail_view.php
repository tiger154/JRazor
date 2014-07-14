<!-- S: �ۼ� -->
<script language="javascript" src="/assets/js/jquery.autoheight.js"></script>

<script>
	
	function bodyOnLoad()
	{
    $("<iframe scrolling='no' />").attr("src", "/admin/projectManagement/projectViewForContent?project_id=<?=$PRJ_IDX?>&DISPLAY_CODE=SUMMARY").attr("frameborder", 0).attr("width", "100%").attr("height", "0px").appendTo("#iframe-container1");
    $('iframe').iframeAutoHeight({heightOffset: 40});    
    $("<iframe scrolling='no' />").attr("src", "/admin/projectManagement/projectViewForContent?project_id=<?=$PRJ_IDX?>&DISPLAY_CODE=CNTNT").attr("frameborder", 0).attr("width", "100%").attr("height", "0px").appendTo("#iframe-container2");
    $('iframe').iframeAutoHeight({heightOffset: 40});    
	}
	
	function moveApply(code)
	{
		$("#STEP_IDX").val(code);
		$("#form1").attr("action","/admin/stepManagement/applyList");
		$("#form1").attr("method","post");
		$("#form1").submit();
	}
	
</script>
<form name="form1" id="form1">
<input type="hidden" name="PRJ_IDX" id="PRJ_IDX" value="<?=$PRJ_IDX?>" />
<input type="hidden" name="STEP_IDX" id="STEP_IDX" />
</form>

<table id="BdList-Type01" class="mgb30" summary="���">
						<caption>���</caption>
						<colgroup>
							<?
							foreach ($stepData as $key => $sData)
							{
							?>
								<col width="*" />
							<? 
							}
							?>
							
						</colgroup>
						<thead>
							<tr>
							<?
							foreach ($stepData as $key => $sData)
							{
							?>
								<th scope="col" class="first"><a href="javascript:moveApply(<?=$sData->STEP_IDX?>);"><?=$sData->STEP_NM?></a></th>
							<? 
							}
							?>
							</tr>
						</thead>
						<tbody>
							<tr>
							<?
							foreach ($stepData as $key => $sData)
							{
							?>
								<td><a href="javascript:moveApply(<?=$sData->STEP_IDX?>);"><?=number_format($sData->CNT)?> ��</a></td>
							<? 
							}
							?>
							</tr>
						</tbody>
					</table>

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
								<th scope="row" colspan="3">������Ʈ ��</th>
								<td>
									<?=$PRJ_NM?>
									<span class="btn04 mgl5"><a target="_blank" href="http://<?=$DOMAIN_ID?>.<?=MAIN_SERVICE_DOMAIN?>">����� ������ ä�� ���� Ȯ���ϱ�</a></span>
								</td>
							</tr>
							<tr>
								<th scope="row" colspan="3">������Ʈ ���� ���</th>
								<td><div id="iframe-container1"  ></div></td>
							</tr>
							<tr>
								<th scope="row" colspan="3">���� �Խ� �Ⱓ</th>
								<td><?=$PRJ_STDT1?> <?=$PRJ_STDT2?>:<?=$PRJ_STDT3?> ~ <?=$PRJ_EDDT1?> <?=$PRJ_EDDT2?>:<?=$PRJ_EDDT3?></td>
							</tr>
							<tr>
								<th scope="row" colspan="3">������Ʈ ����</th>
								<td><?=$PRJ_STS == 'C' ? '����' : '����'?></td>
							</tr>
							<tr>
								<th scope="row" colspan="3">������</th>
								<td><div id="iframe-container2"  ></div></td>
							</tr>
							<tr>
								<th scope="row" colspan="3">�����׸����</th>
								<td>
									
							
									<table  id="BdList-Type01" class="mgb30">
									<colgroup>
										<col width="*" />
										<col width="*" />
										<col width="*" />
										<col width="*" />
										<col width="*" />
									</colgroup>
								
									<thead>
									<tr>
										<th scope="col">���νŻ�����</th>
										<th scope="col">��������</th>
										<th scope="col">�з»���</th>
										<th scope="col">��»���</th>
										<th scope="col">���н����׸�</th>
									</tr>
									</thead>
									<tbody>
										<tr>
											<td><?=$PERSONAL_USE_YN?></td>
											<td><?=$FAMILY_USE_YN?></td>
											<td><?=$SCHOOL_USE_YN?></td>
											<td><?=$CAREER_USE_YN?></td>
											<td><?=$LANGUAGE_USE_YN?></td>
										</tr>
									</tbody>
								
									<thead>
									<tr>
										<th scope="col">�ڰ����׸�</th>
										<th scope="col">�������</th>
										<th scope="col">�ؿܰ������</th>
										<th scope="col">����Ȱ������</th>
										<th scope="col">������</th>
									</tr>
									</thead>
									<tbody>
										<tr>
											<td><?=$LICENSE_USE_YN?></td>
											<td><?=$ARMY_USE_YN?></td>
											<td><?=$TRAINING_USE_YN?></td>
											<td><?=$SERVE_USE_YN?></td>
											<td><?=$PRIZE_USE_YN?></td>
										</tr>
									</tbody>
									
									<thead>
									<tr>
										<th scope="col">PCȰ��ɷ�</th>
										<th scope="col">�����󼼳���</th>
										<th scope="col">÷������</th>
										<th scope="col">��������</th>
										<th scope="col">�������</th>
									</tr>
									</thead>
									<tbody>
										<tr>
											<td><?=$PC_USE_YN?></td>
											<td><?=$CONTENT_USE_YN?></td>
											<td><?=$FILE_USE_YN?></td>
											<td><?=$EDUCATION_USE_YN?></td>
											<td><?=$TECH_USE_YN?></td>
										</tr>
									</tbody>
								
									<thead>
									<tr>
										<th scope="col">������</th>
										<th scope="col">��������</th>
										<th scope="col"></th>
										<th scope="col"></th>
										<th scope="col"></th>
									</tr>
									</thead>
									<tbody>
										<tr>
											<td><?=$LANGUAGE2_USE_YN?></td>
											<td><?=$WRITE_USE_YN?></td>
											<td></td>
											<td></td>
											<td></td>
										</tr>
									</tbody>
									
									</table>
								</td>
							</tr>
						

						</tbody>
					</table>					
					<!--// E: �ۼ� -->

					<div class="txtC">
						<span class="btn01"><a href="javascript:goLink('/admin/projectManagement/projectModify?project_id=<?=$PRJ_IDX?>');">����</a></span>
						<span class="btn02"><a href="javascript:goLink('/admin/projectManagement/projectList');">���ư���</a></span>
					</div>