<script>
	
	function goProcess()
	{
		$("#form1").attr("method","post");
		$("#form1").attr("action","/front/apply/apply");
		$("#form1").submit();
	}
	
	function goApplySubmit()
	{
		if (confirm('���������� �Ͻðڽ��ϱ�? ���������� �Ͻø� �������ȳ�;;;'))
		{
			$("#form1").attr("method","post");
			$("#form1").attr("action","/front/apply/applyFinalSubmit");
			$("#form1").submit();
		}
	}
	
</script>
<style type="text/css">
.scrollable { width:100%; height:100%; overflow-y:auto; overflow-x:hidden; clip-rect:(0px, 100%, 100%, 0px);word-break:break-all; }
</style>

<form id="form1" name="form1" >
<input type="hidden" id="PRJ_IDX" name="PRJ_IDX" value="<?=$PRJ_IDX?>" />
<input type="hidden" id="APPL_IDX" name="APPL_IDX" value="<?=$APPL_IDX?>" />
<input type="hidden" id="UNIT_IDX" name="UNIT_IDX" value="<?=$UNIT_IDX?>" />
<input type="hidden" id="RSM_IDX" name="RSM_IDX" value="<?=$RSM_IDX?>" />
</form>

							<!-- S: �����о� -->
							<div class="h3-tit-box mgt30">
								<h3>�����о�</h3>
								<span>��� �����о߸� �����ϼ���</span>
							</div>

							<table class="TbStyle01" summary="�����о�">
								<caption>�����о�</caption>
								  <colgroup>
								  <col width="15%" />
								  <col width="*" />
								  <col width="15%" />
								  <col width="*" />
								  </colgroup>
								  <tbody>
									<tr>
										<th scope="row"><label for="user_kind">�����о�</label> <span class="red">*</span></th>
										<td>
											<?=$SELECTBOX_UNIT_IDX1?>
										</td>
										<th scope="row"><label for="area">����ٹ���</label></th>
										<td>
										<?
											foreach ($WRK_PLACELIST as $key => $wrkList)
											{
												
												echo $wrkList->ORD .'���� : '. $wrkList->NAME . '<br>';
											}
										?>
										</td>
									</tr>
								  </tbody>
							</table>
							
							<!-- E: �����о� -->

							<!-- S: �⺻ �Ż����� -->
							<div class="h3-tit-box mgt30">
								<h3>�⺻ �Ż�����</h3>
								<span>�Ż������� �Է��� �ּ���.</span>
							
							</div>

							<table class="TbStyle01" summary="�⺻ �Ż�����">
								<caption>�⺻ �Ż�����</caption>
								  <colgroup>
								  <col width="15%" />
								  <col width="*" />
								  <col width="12%" />
								  <col width="14%" />
								  <col width="14%" />
								  <col width="10%" />
								  <col width="29%" />
								  </colgroup>
								  <tbody>
									<tr>
										<td colspan="2" rowspan="5" class="pic">
											<div class="pic-box">
												<? if ($PHOTO_YN == 'Y') { ?>
												<img src="<?=$PHOTO_URL?>" width="130" height="150" />
												<? } ?>
											</div>
										</td>
										<th scope="row"><label for="user_name">�̸�</label> <span class="red">*</span></th>
										<td colspan="4">
											
											<?=$NAMEKOR?><span class="space">/</span>
											<label for="user_name">�ѹ�</label> <?=$NAMECHA?>
											<span class="space">/</span>
											<label for="user_name_eng">����</label> <?=$NAMEENG1?>
											<?=$NAMEENG2?>
										</td>
									</tr>
									<tr>
										<th scope="row"><label for="birth_year">�������</label> <span class="red">*</span></th>
										<td colspan="4">
											<?=$BIRTH_DT1?> <label for="birth_year">��</label>
											<?=$BIRTH_DT2?> <label for="birth_month">��</label>
											<?=$BIRTH_DT3?> <label for="birth_day">��</label>
											(
												<?=$BIRTH_TP == 'S' ? ' ��� ' : ''; ?>
											
												<?=$BIRTH_TP == 'L' ? ' ���� ' : ''; ?>
											
											)
										</td>
									</tr>
									<tr>
										<th scope="row"><label for="address">�ּ�</label> <span class="red">*</span></th>
										<td colspan="4">
											<p class="mgb5">
											<?=$ZIPCODE1?> -
											<?=$ZIPCODE2?>
											
											</p>
											<?=$ADDRESS1?> 
											<?=$ADDRESS2?>
										</td>
									</tr>
									<tr>
										<th scope="row"><label for="user_phone_01">��ȭ��ȣ</label> <span class="red">*</span></th>
										<td colspan="2">
											<?=$SELECTBOX_TEL?> -
											<?=$TEL2?> -
											<?=$TEL3?>
										</td>
										<th scope="row"><label for="user_mobile_01">�޴���</label> <span class="red">*</span></th>
										<td>
											<?=$SELECTBOX_HTEL?> -
											<?=$HTEL2?> -
											<?=$HTEL3?>
										</td>
									</tr>
									<tr>
										<th scope="row"><label for="user_mail">�̸���</label> <span class="red">*</span></th>
										<td colspan="4">
											<?=$EMAIL?>
										</td>
									</tr>
									<tr>
										<th scope="row"><label for="marry_no">��ȥ����</label> <span class="red">*</span></th>
										<td colspan="3">
											<?=$MARRY_YN == 'N' ? ' ��ȥ ' : ''; ?>
											
											<?=$MARRY_YN == 'Y' ? ' ��ȥ ' : ''; ?>
										
										</td>
										<th scope="row"><label for="religion">����</label></th>
										<td colspan="2"><?=$RELIGION?></td>
									</tr>
									<tr>
										<th scope="row"><label for="hobby">���</label></th>
										<td colspan="3"><?=$HOBBY?></td>
										<th scope="row"><label for="ability">Ư��</label></th>
										<td colspan="2"><?=$FORTE?></td>
									</tr>
									<tr valign="top">
										<th scope="row"><label for="target">���ƴ��</label> <span class="red">*</span></th>
										<td colspan="3">
											<?=$BOHUN_TP_NM?>
											
											<? if ($BOHUN_SCORE_NM != '' ) { ?>���� : <?=$BOHUN_SCORE_NM?><? } ?>
											<? if ($BOHUN_SCORE_NM != '' ) { ?>��ȣ : <?=$BOHUN_NUM?><? } ?>
											
										</td>
										<th scope="row"><label for="hindrance_01">��ֿ���</label> <span class="red">*</span></th>
										<td  valign="top" colspan="2">
											<?=$PSN_OBSTACLE_TP_NM?>
											
											<? if ($PSN_OBSTACLE_LVL_NM != '') { ?>��ֵ�� : <?=$PSN_OBSTACLE_LVL_NM?><? } ?>
											<? if ($PSN_OBSTACLE_TP_REASON != '') { ?>���� : <?=$PSN_OBSTACLE_TP_REASON?><? } ?>
										
										</td>
									</tr>
									<tr>
										<th scope="row"><label for="user_height">��ü����</label></th>
										<td colspan="3">
											<label for="user_height">����</label> <?=$PSN_HEIGHT?> cm
											<span class="space">/</span>
											<label for="user_weight">ü��</label> <?=$PSN_WEIGHT?> kg
										</td>
										<th scope="row"><label for="eye_left">�÷�(����)</label></th>
										<td colspan="2">
											<label for="eye_left">��</label> <?=$PSN_LSIGHT?>
											<span class="space">/</span>
											<label for="eye_right">��</label> <?=$PSN_RSIGHT?>
											(���Ϳ��� : 
											<?=$PSN_CLRBLND_YN == 'Y' ? ' �� ' : ''; ?>
											
												<?=$PSN_CLRBLND_YN == 'N' ? ' �� ' : ''; ?>
										
											)
										</td>
									</tr>
									<tr>
										<th scope="row"><label for="radio01">���α��ʻ�Ȱ<br />����� �����</label> <span class="red">*</span></th>
										<td colspan="6">
											<?=$PSN_LOWINCOME_YN == 'Y' ? ' �ش� ' : ''; ?>
											<?=$PSN_LOWINCOME_YN == 'N' ? ' ���ش� ' : ''; ?>
											
											<span> �� ���α��ʻ�Ȱ����� �� �Ѻθ����������� ���� ���ҵ���</span>
										</td>
									</tr>
								  </tbody>
							</table>
	
							<!-- E: �⺻ �Ż����� -->



<? 	if ($rsmdisplay[0]->ARMY_USE_YN == 'Y' ) { ?>
							<!-- S: �������� -->
							<div class="h3-tit-box mgt30">
								<h3>��������</h3>
								<span>������ ��� ������ �Ǵ� �����ڿ� ���մϴ�.</span>
							</div>

							<table class="TbStyle01" summary="��������">
								<caption>��������</caption>
								  <colgroup>
								  <col width="15%" />
								  <col width="*" />
								  <col width="12%" />
								  <col width="*" />
								  <col width="10%" />
								  <col width="12%" />
								  <col width="10%" />
								  <col width="10%" />
								  </colgroup>
								  <tbody>
									<tr>
										<th scope="row"><label for="user_army01">���ʿ���</label> <span class="red">*</span></th>
										<td><?=$ARMY_YN_NM?></td>
										<th scope="row"><label for="user_army02">����</label> </th>
										<td><?=$ARMY_TP_NM?></td>
										<th scope="row"><label for="user_army03">���</label> </th>
										<td><?=$ARMY_LVL_NM?></td>
										<th scope="row"><label for="user_army04">���뱸��</label> </th>
										<td><?=$ARMY_FINISH_NM?></td>
									</tr>
									<tr>
										<th scope="row"><label for="user_army05_1">�����Ⱓ</label> </th>
										<td colspan="3">
											<?=$ARMY_STDT1?> <label for="user_army05_1">��</label>
											<?=$ARMY_STDT2?> <label for="user_army05_2">��</label>
											<?=$ARMY_STDT3?> <label for="user_army05_3">��</label> ~ 
											<?=$ARMY_EDDT1?> <label for="user_army05_4">��</label>
											<?=$ARMY_EDDT2?> <label for="user_army05_5">��</label>
											<?=$ARMY_EDDT3?> <label for="user_army05_6">��</label>
										</td>
										<th scope="row"><label for="user_army06">��������</label></th>
										<td colspan="3"><?=$ARMY_REASON?></td>
									</tr>
									
								  </tbody>
							</table>

							<!-- E: �������� -->
<? } ?>



<? 
	/* 
		�������� 
		FAMILY_USE_YN == 'Y'
	*/
	if ($rsmdisplay[0]->FAMILY_USE_YN == 'Y') { 
?>


<!-- S: �������� -->

			<div class="h3-tit-box mgt30">
			<h3>��������</h3>
			<span>���������� ���� ��츸 üũ�ϼ���. �Է»����� �ִ� ��� �ݵ�� �Է��� �ֽñ� �ٶ��ϴ�.</span>
			</div>
			
			<table class="TbStyle01" summary="�������� ����">
			<caption>�������� ����</caption>
			<colgroup>
			<col width="15%" />
			<col width="*" />
			</colgroup>
			<tbody>
			<tr>
			<th scope="row"><label for="family_none">�������� ����</label> <span class="red">*</span></th>
			<td>
			<?=$FMLY_NONE_YN == 'Y' ? ' ���� ' : ''; ?>
		
			</td>
			</tr>
			</tbody>
			</table>
			<table class="TbStyle01" summary="��������">
			<caption>��������</caption>
			<colgroup>
			<col width="15%" />
			<col width="*" />
			<col width="6%" />
			<col width="*" />
			<col width="10%" />
			<col width="*" />
			<col width="10%" />
			<col width="*" />
			<col width="10%" />
			<col width="*" />
			</colgroup>
			<thead>
			<tr>
			<th scope="col">����</th>
			<th scope="col">����</th>
			<th scope="col">����</th>
			<th scope="col">�з�</th>
			<th scope="col">����</th>
			<th scope="col">�����</th>
			<th scope="col">����</th>
			<th scope="col">���ſ���</th>
			<th scope="col">�ξ翩��</th>
			<th scope="col">����</th>
			</tr>
			</thead>
			</table>
			
			<div id="id_fmly_list">
			<?
				foreach ($fmlyRs as $key => $fmlyList)
				{
					$fmlyIdx = $key + 1;
			?>
					<table class="TbStyle01" summary="��������" id="id_fmly_box_set_<?=$fmlyIdx?>">
					<caption>��������</caption>
					<colgroup>
					<col width="15%" />
					<col width="*" />
					<col width="6%" />
					<col width="*" />
					<col width="10%" />
					<col width="*" />
					<col width="10%" />
					<col width="*" />
					<col width="10%" />
					<col width="*" />
					</colgroup>
					<tbody>
					<tr>
					<td class="center">
					
					<?=${'frmFMLY_REL_CD_' . $fmlyIdx}?> <?=$fmlyList->FMLY_REL_NM?> 
					</td>
					<td class="center"><?=$fmlyList->FMLY_NM?></td>
					<td class="center"><?=$fmlyList->FMLY_NAI?></td>
					<td class="center"><?=$fmlyList->FMLY_SCH_NM?></td>
					<td class="center"><?=$fmlyList->FMLY_JOB?></td>
					<td class="center"><?=$fmlyList->FMLY_WRK_NM?></td>
					<td class="center"><?=$fmlyList->FMLY_WRK_PSTN?></td>
					<td class="center">
					<?=${'frmFMLY_LIVE_YN_' . $fmlyIdx}?>
					</td>
					<td class="center">
					<?=${'frmFMLY_HELP_YN_' . $fmlyIdx}?>
					</td>
					<td class="center"></td>
					</tr>
					</tbody>
					</table>
			<?
				}
			?>
			</div>
			
			<!-- E: �������� -->


<?
	}
?>

<? 
	/* 
		�з»��׿� ���õ� �׸��Դϴ�. 
		SCHOOL_USE_YN == 'Y'
	*/
	if ($rsmdisplay[0]->SCHOOL_USE_YN == 'Y') { 
?>



<!-- S: �з»��� -->
							<div class="h3-tit-box mgt30">
								<h3>�з»���</h3>
								
							</div>

							<table class="TbStyle01" summary="�з»���">
								<caption>�з»���</caption>
								  <colgroup>
								  <col width="15%" />
								  <col width="*" />
								  </colgroup>
								  <tbody>
									<tr>
										<th scope="row" colspan="2" class="left">
											
											<div style="text-align:left;float:left">����б�&�������</div>
											<div style="text-align:right">
												<?=$SCH_FGRD_TP_1 == 'Y' ? ' �����з� ' : ''; ?>
												
											</div>
											
										</th>
									</tr>
									<tr>
										<th scope="row"><label for="school_name">�б�����</label></th>
										<td>
											<?=$SCH_TP_1 == '25' ? ' ����б� ' : ''; ?> 
											&nbsp;
											<?=$SCH_TP_1 == '52' ? ' ������� ' : ''; ?>
										</td>
									</tr>
		
									<tr id="id_table_school1" >
										<th scope="row"><label for="school_name"><div id="id_title_school1">�б���</div></label></th>
										<td><?=$SCH_NM_1?></td>
									</tr>
									<tr id="id_table_school2" >
										<th scope="row"><label for="school_name"><div id="id_title_school2"><?=$SCH_TP_1 == '25' ? '���бⰣ' : '�հ�����' ;?></div></label></th>
										<td>
											<? if ($SCH_STDT1_1 != '' ) { ?>
											<?=$SCH_STDT1_1?> <label for="">��</label>
											<?=$SCH_STDT2_1?> <label for="">��</label>
											<?=$frmSCH_ETTP1_1?> ~ 
											<? } ?>
											<?=$SCH_EDDT1_1?> <label for="">��</label>
											<?=$SCH_EDDT2_1?> <label for="">��</label>
											<?=$frmSCH_ETTP2_1?>
											<?=$frmSCH_JUYA_1?> <?=$frmSCH_BRANCH_TP_1?> <?=$frmSCH_LOC_1?></td>
									</tr>
								  </tbody>
							</table>
							
							<div id="id_high_scool_hak" style="display:none">
							<div class="point-txt">
								�� �����з��� ����б� ������ ��� �Ʒ��� �Է��� �ֽø� �˴ϴ�.
							</div>

							<table class="TbStyle01" summary="�����з��� ����б� ������ ���">
								<caption>�����з��� ����б� ������ ���</caption>
								  <colgroup>
								  <col width="15%" />
								  <col width="*" />
								  <col width="15%" />
								  <col width="25%" />
								  <col width="15%" />
								  </colgroup>
								  <thead>
									<tr>
										<th scope="col">�������� <span class="red">*</span></th>
										<td colspan="4">
											<div class="txt-box">
												<ul>
													<li>
														<input type="radio" class="radio" name="" id="standard_01" value="" />
														<label for="standard_01">��ޱ���</label>
													</li>
													<li>
														<input type="radio" class="radio" name="" id="standard_02" value="" />
														<label for="standard_02">��������</label>
													</li>
													<li>
														<input type="radio" class="radio" name="" id="standard_03" value="" />
														<label for="standard_03">��������</label>
													</li>
												</ul>
												<p>�� �����Է¹��(��Ȱ��Ϻ� ����) Ȯ�� �� �Է� ����� ���� ������ �ֽñ� �ٶ��ϴ�.</p>
												<p>�� ���ŵ���� ��� ��Ŀ� ���� ��� �� �Ҽ��� ���ڸ� ���� �Է�</p>
											</div>
										</td>
									</tr>
									<tr>
										<th scope="col">�г�</th>
										<th scope="col">1�б� ��յ��(���)/������</th>
										<th scope="col">1�б� �������</th>
										<th scope="col">2�б� ��յ��(���)/������</th>
										<th scope="col" class="last">2�б� �������</th>
									</tr>
								  </thead>
								  <tbody>
									<tr>
										<th scope="row">1�г�</th>
										<td class="center">
											<input class="b_input" type="text" name="" id="" value="" style="width:50px;" /><span class="space">/</span>
											<input class="b_input" type="text" name="" id="" value="" style="width:50px;" />
										</td>
										<td><input class="b_input" type="text" name="" id="" value="" style="width:70%;" /> ��</td>
										<td class="center">
											<input class="b_input" type="text" name="" id="" value="" style="width:50px;" /><span class="space">/</span>
											<input class="b_input" type="text" name="" id="" value="" style="width:50px;" />
										</td>
										<td><input class="b_input" type="text" name="" id="" value="" style="width:70%;" /> ��</td>
									</tr>
									<tr>
										<th scope="row">2�г�</th>
										<td class="center">
											<input class="b_input" type="text" name="" id="" value="" style="width:50px;" /><span class="space">/</span>
											<input class="b_input" type="text" name="" id="" value="" style="width:50px;" />
										</td>
										<td><input class="b_input" type="text" name="" id="" value="" style="width:70%;" /> ��</td>
										<td class="center">
											<input class="b_input" type="text" name="" id="" value="" style="width:50px;" /><span class="space">/</span>
											<input class="b_input" type="text" name="" id="" value="" style="width:50px;" />
										</td>
										<td><input class="b_input" type="text" name="" id="" value="" style="width:70%;" /> ��</td>
									</tr>
									<tr>
										<th scope="row">3�г�</th>
										<td class="center">
											<input class="b_input" type="text" name="" id="" value="" style="width:50px;" /><span class="space">/</span>
											<input class="b_input" type="text" name="" id="" value="" style="width:50px;" />
										</td>
										<td><input class="b_input" type="text" name="" id="" value="" style="width:70%;" /> ��</td>
										<td class="center">
											<input class="b_input" type="text" name="" id="" value="" style="width:50px;" /><span class="space">/</span>
											<input class="b_input" type="text" name="" id="" value="" style="width:50px;" />
										</td>
										<td><input class="b_input" type="text" name="" id="" value="" style="width:70%;" /> ��</td>
									</tr>
								  </tbody>
							</table>
							</div>
							<div id="id_schl_list">
								<?
									//foreach ($schlRs as $key => $schlList)
									$schlRsCount = count($schlRs);
									if ($schlRsCount >= 2) {
									for ($schKeyIdx = 1; $schKeyIdx < $schlRsCount ; $schKeyIdx++)
									{
										$schlIdx = $schKeyIdx + 1;
								?>
								<table class="TbStyle01" summary="�з»���" id="id_schl_box_set_<?=$schlIdx?>">
								<caption>�з»���</caption>
								  <colgroup>
								  <col width="15%" />
								  <col width="*" />
								  <col width="10%" />
								  </colgroup>
								  <tbody>
								  <tr>
								  	<th scope="row">�з±���</th>
								  	<td colspan="2">
								  		<div style="text-align:left;float:left"><?=${'frmSCH_TP_' . $schlIdx}?></div>
								  		<div style="text-align:right">
											<?=$schlRs[$schKeyIdx]->SCH_FGRD_TP == 'Y' ? ' [�����з�] ' : ''; ?>
											
											</div>
								  	</td>
									</tr>
									<tr>
										<th scope="row"><label for="school_name_02">�б���</label></th>
										<td colspan=2>
											<?=$schlRs[$schKeyIdx]->SCH_NM?>
											
											<?=${'frmSCH_JUYA_' . $schlIdx}?>
											<?=${'frmSCH_BRANCH_TP_' . $schlIdx}?>
											<?=${'frmSCH_LOC_' . $schlIdx}?>
										</td>
										
									</tr>
									<tr>
										<th scope="row"><label for="school_term_01_01">���бⰣ</label></th>
										<td>
											<?=$schlRs[$schKeyIdx]->SCH_STDT1?> <label for="">��</label>
											<?=$schlRs[$schKeyIdx]->SCH_STDT2?> <label for="">��</label>
											<?=${'frmSCH_ETTP1_' . $schlIdx}?> ~ 
											<?=$schlRs[$schKeyIdx]->SCH_EDDT1?> <label for="">��</label>
											<?=$schlRs[$schKeyIdx]->SCH_EDDT2?> <label for="">��</label>
											<?=${'frmSCH_ETTP2_' . $schlIdx}?>
										</td>
										<td rowspan="2" class="center Lline"></td>
									</tr>
									<tr>
										<th scope="row">���� �� ����</th>
										<td>
											
											<ul>
												<li>
											
													<div style="width:50px;float:left">����</div>
													<div style="width:100px;float:left">�迭 �а�(����)</div>
													<?=${'frmSCH_AFF_' . $schlIdx}?>
													<?=$schlRs[$schKeyIdx]->SCH_MAJOR_NM?>
												</li>
												<li>
													<div style="width:50px;float:left"></div>
													<div style="width:60px;float:left">�������</div>
													<?=$schlRs[$schKeyIdx]->SCH_HAKJUM?>
													<span class="space">/</span>
													<?=${'frmSCH_MAX_HAKJUM_' . $schlIdx}?>
													&nbsp;&nbsp;�̼�����
													"<?=$schlRs[$schKeyIdx]->SCH_ISU_HAKJUM?>
												</li>
												<li>
													<div style="width:50px;float:left">������</div>
													<div style="width:100px;float:left">���� ����</div>
													<?=${'frmSCH_SUB_MAJOR_TP_' . $schlIdx}?>
												</li>
												
													
													<div style="width:50px;float:left">������</div>
													<div style="width:100px;float:left">�迭 �а�(����)</div>
													
													<?=${'frmSCH_SUB_AFF_' . $schlIdx}?>
													<?=$schlRs[$schKeyIdx]->SCH_SUB_MAJOR_NM?>
													<?=$schlRs[$schKeyIdx]->SCH_SUB_MAJOR_CD?>
												</li>
											</ul>
												
										</td>
									</tr>
									
								  </tbody>
								</table>
							<? } } ?>
							</div>
							
							<!-- E: �з»��� -->


<!-- �з� ���� ������ -->

<? } ?>

<?
	//��»��� - 
	if ($rsmdisplay[0]->CAREER_USE_YN == 'Y' ) {
?>

<div class="h3-tit-box mgt30">
								<h3>��»���</h3>
								<span>�󼼾��������� 400 �� �̳��� �ڼ��� �ۼ��� �ּ���.</span>
							</div>

							<table class="TbStyle01" summary="��»���">
								<caption>��»���</caption>
								  <colgroup>
								  <col width="15%" />
								  <col width="*" />
								  </colgroup>
								  <tbody>
									<tr>
										<th scope="row" rowspan="2"><label for="family_none">��»���</label> <span class="red">*</span></th>
										<td>
											<?=$CAREER_TP == 'N' ? ' <label for="newcomer">����</label> ' : ''; ?>
											<?=$CAREER_TP == 'C' ? ' <label for="career">���</label> ' : ''; ?>
											<?=$CAREER_TERM1?> <label for="">��</label>
											<?=$CAREER_TERM2?> <label for="">����</label>
											<span class="space">/</span>
											<?=$FOREIGN_CAREER_YN == 'Y' ? ' �ؿܱٹ� ' : ''; ?>
											
											<?=$FOREIGN_CAREER_TERM1?> <label for="">��</label>
											<?=$FOREIGN_CAREER_TERM2?> <label for="">����</label>
										</td>
									</tr>
									<tr>
										<td>
											<label for="family_none"><span>��뺸�谡�ԱⰣ</span></label>
											<?=$EMP_INSUR_TERM1?> <label for="">��</label>
											<?=$EMP_INSUR_TERM2?> <label for="">����</label>
											<span> �� <a href="http://www.ei.go.kr" target="_blank" title="��â��������">http://www.ei.go.kr</a> ���� ��뺸�谡�ԱⰣ�� ��ȸ �� ����</span>
										</td>
									</tr>
								  </tbody>
							</table>

	<table class="TbStyle01 mgt10" summary="��»��� ��">
	<caption>��»��� ��</caption>
	<colgroup>
	<col width="28%" />
	<col width="15%" />
	<col width="*" />
	<col width="10%" />
	</colgroup>
	<thead>
	<tr>
	<th scope="col">�ٹ��Ⱓ</th>
	<th scope="col" colspan="2">�󼼰��</th>
	<th scope="col">����</th>
	</tr>
	</thead>
	</table>
	
	<div id="id_carr_list">
	<?
		foreach ($carrRs as $key => $carrList)
		{
			$carrIdx = $key + 1;
	?>
	<table class="TbStyle01" id="id_carr_box_set_<?=$carrIdx?>">
	<caption>��»��� ��</caption>
  <colgroup>
  <col width="28%" />
  <col width="15%" />
  <col width="*" />
  <col width="10%" />
  </colgroup>
	<tbody>
	<tr>
		<td rowspan="5">
			<?=$carrList->CAREER_STDT1?>�� <?=$carrList->CAREER_STDT2?>�� ~ 
			<?=$carrList->CAREER_EDDT1?>�� <?=$carrList->CAREER_EDDT2?>��
			<br>
			<?=$carrList->CAREER_STS_NM?>
		</td>
		<th scope="row"><label for="company_name">ȸ���</label></th>
		<td><?=$carrList->CAREER_CMP_NM?> <?=$carrList->CAREER_CMP_TP_NM?> <?=$carrList->CAREER_LOC_NM?></td>
		<td rowspan="5" class="center Lline"></td>
	</tr>
	<tr>
		<th>����</th>
		<td><?=$carrList->CAREER_EMP_TP_NM?> <?=$carrList->CAREER_JOB_TP_NM?> <?=$carrList->CAREER_JOB_TP_CD?>
		</td>
	</tr>
	<tr>
		<th>�ٹ��μ�/����</th>
		<td>�μ��� : <?=$carrList->CAREER_DEPT_NM?> <?=$carrList->CAREER_PSTN_NM?></td>
	</tr>
	<tr>
		<th>��������</th>
		<td><div class="scrollable"><?=$carrList->CAREER_CNTNT?></div></td>
	</tr>
	<tr>
		<th>������</th>
		<td><?=$carrList->CAREER_RETIRE_NM?></td>
	</tr></td>
	</tr>
	</tbody>
	</table>
	<? } ?>
	</div>
	
<?
	}
?>

<?
	// ���н���
	if ($rsmdisplay[0]->LANGUAGE_USE_YN == 'Y') {
?>


		<!-- S: ���н��� -->
		<div class="h3-tit-box mgt30">
			<h3>���н���</h3>
			
		</div>



<table class="TbStyle01 mgt10" summary="���н���">
	<caption>���н���</caption>
	  <colgroup>
	  <col width="12%" />
	  <col width="15%" />
	  
	 
	  <col width="*" />
	  
	  <col width="22%" />
	  <col width="20%" />
	  <col width="10%" />
	  </colgroup>
	  <thead>
		<tr>
			<th scope="col">���н����</th>
			<th scope="col">������</th>
			<th scope="col">��������(���)</th>
			<th scope="col">�����</th>
			<th scope="col">��Ϲ�ȣ</th>
			
		
			<th scope="col">����</th>
		</tr>
	  </thead>
	  <tbody>
<? 
	foreach ($lanData as $key => $lanList)
	{
?>
	<tr>
		<td class="center">
			<?=$lanList->LAN_NM?>
			<input type="hidden" name="LAN_IDX_<?=($key+1)?>" id="LAN_IDX_<?=($key+1)?>" value="<?=$lanList->LAN_IDX?>" />
			<input type="hidden" name="LANG_IDX_<?=($key+1)?>" id="LANG_IDX_<?=($key+1)?>" value="<?=$lanList->LANG_IDX?>" />
		</td>
		<td class="center"><?=$lanList->LAN_PB?></td>
		<td class="left">
			<? 
			if (preg_match('/^13|15$/' , $lanList->SCORE_TP)) {
			?>
			<?=$lanList->LAN_SCORE?>
			<? 
			}
			?>
			
			<?=${'frmLAN_LVL_IDX_' . ($key + 1)}?>

		</td>
		<td>
			<?=$lanList->LAN_DT1?> <label for="">��</label>
			<?=$lanList->LAN_DT2?> <label for="">��</label>
			<?=$lanList->LAN_DT3?> <label for="">��</label>
			
		</td>
		<td><?=$lanList->LAN_NUM?></td>
		<td></td>
	</tr>

<?
	}
?>
</tbody>
</table>

<?
	}
?>


<?
	// ����
	if ($rsmdisplay[0]->WRITE_USE_YN == 'Y') {
?>
	
<!-- S: ���� -->
		<div class="h3-tit-box mgt30">
			<h3>��������</h3>
		</div>

	<table class="TbStyle01 mgt10" summary="��������">
	<caption>����</caption>
	  <colgroup>
	  <col width="22%" />
	  <col width="22%" />
	  <col width="*" />
	  <col width="10%" />
	  </colgroup>
	  <thead>
		<tr>
			<th scope="col">������</th>
			<th scope="col">�߻�/����ó</th>
			<th scope="col">����/������</th>
			<th scope="col">����</th>
		</tr>
	  </thead>
	</table>
<div id="id_wrte_list">
<?
	foreach ($wrteRs as $key => $wrteList)
	{
		$wrteIdx = $key + 1;
?>
<table class="TbStyle01" summary="��������" id="id_wrte_box_set_<?=$wrteIdx?>">	
	 <colgroup>
	  <col width="22%" />
	  <col width="22%" />
	  <col width="*" />
	  <col width="10%" />
	  </colgroup>
	  <tbody>
	<tr>
		<td class="center"><?=$wrteList->WRT_NM?></td>
		<td class="center"><?=$wrteList->WRT_PB?></td>
		<td class="center">
				<?=$wrteList->WRT_DT1?> <label for="">��</label> 
				<?=$wrteList->WRT_DT2?> <label for="">��</label> 
				<?=$wrteList->WRT_DT3?> <label for="">��</label> 
		</td>
		<td class="center"></td>
	</tr>
</tbody>
</table>
<?
	}
?>
</div>

<?
	}
?>

<?
	// ���󳻿�
	if ($rsmdisplay[0]->PRIZE_USE_YN == 'Y') {
?>
	
<!-- S: ���󳻿� -->
		<div class="h3-tit-box mgt30">
			<h3>���󳻿�</h3>
		</div>



	<table class="TbStyle01 mgt10" summary="���󳻿�">
	<caption>�����</caption>
	  <colgroup>
	  <col width="22%" />
	  <col width="22%" />
	  <col width="*" />
	  <col width="10%" />
	  </colgroup>
	  <thead>
		<tr>
			<th scope="col">�����</th>
			<th scope="col">�������</th>
			<th scope="col">������</th>
			<th scope="col">����</th>
		</tr>
	  </thead>
	</table>
<div id="id_prze_list">
<?
	foreach ($przeRs as $key => $przeList)
	{
		$przeIdx = $key + 1;
?>
<table class="TbStyle01" summary="���󳻿�" id="id_prze_box_set_<?=$przeIdx?>">	
		 <colgroup>
		  <col width="22%" />
		  <col width="22%" />
		  <col width="*" />
		  <col width="10%" />
		  </colgroup>
		  <tbody>
		<tr>
			<td class="center"><?=$przeList->PRZ_NM?></td>
			<td class="center"><?=$przeList->PRZ_PB_NM?></td>
			<td class="center">
					<?=$przeList->PRZ_DT1?> <label for="">��</label> 
					<?=$przeList->PRZ_DT2?> <label for="">��</label> 
					<?=$przeList->PRZ_DT3?> <label for="">��</label> 
			</td>
			<td class="center"></td>
		</tr>
	</tbody>
	</table>
<?
}
?>
</div>

<?
	}
?>




<?
	// ���ߵ������ ����
	if ($rsmdisplay[0]->LANGUAGE2_USE_YN == 'Y') {
?>
<!-- S: ���дɷ� -->
		<div class="h3-tit-box mgt30">
			<h3>���дɷ�</h3>
			
		</div>



	<table class="TbStyle01 mgt10" summary="���дɷ�">
	<caption>���дɷ�</caption>
	  <colgroup>
	  <col width="22%" />
	  <col width="*" />
	  <col width="*" />
	  <col width="*" />
	  <col width="10%" />
	  </colgroup>
	  <thead>
		<tr>
			<th scope="col">���</th>
			<th scope="col">ȸȭ�ɷ�</th>
			<th scope="col">�۹��ɷ�</th>
			<th scope="col">���شɷ�</th>
			<th scope="col">����</th>
		</tr>
	  </thead>
	</table>
<div id="id_lan2_list">
<?
	foreach ($lan2Rs as $key => $lan2List)
	{
		$lan2Idx = $key + 1;
?>
<table class="TbStyle01" summary="���дɷ�" id="id_lan2_box_set_<?=$lan2Idx?>">	
		 <colgroup>
		  <col width="22%" />
		  <col width="*" />
		  <col width="*" />
		  <col width="*" />
		  <col width="10%" />
		  </colgroup>
		  <tbody>
		<tr>
			<td class="center"><?=$lan2List->LANG2_NM?></td>
			<td class="center"><?=$lan2List->LANG2_SPCH_LVL_NM?></td>
			<td class="center"><?=$lan2List->LANG2_WRT_LVL_NM?></td>
			<td class="center"><?=$lan2List->LANG2_CMP_LVL_NM?></td>
			<td class="center"></td>
		</tr>
	</tbody>
	</table>	
<?
	}
?>
</div>

<?
	}
?>

<?
	if ($rsmdisplay[0]->LICENSE_USE_YN == 'Y') {
?>

<!-- S: �ڰ��� -->
		<div class="h3-tit-box mgt30">
			<h3>�ڰ���</h3>
			
		</div>


	<table class="TbStyle01 mgt10" summary="�ڰ���">
	<caption>�ڰ���</caption>
	  <colgroup>
	  <col width="*" />
	  <col width="*" />
	  <col width="*" />
	  <col width="*" />
	  <col width="10%" />
	  </colgroup>
	  <thead>
		<tr>
			<th scope="col">�ڰ�����</th>
			<th scope="col">����ó</th>
			<th scope="col">�������</th>
			<th scope="col">��Ϲ�ȣ</th>
			<th scope="col">����</th>
		</tr>
	  </thead>
	</table>
	
<div id="id_lics_list">
<?
foreach ($licRs as $key => $licList)
{
	$licIdx = $key + 1;
?>
	<table class="TbStyle01" summary="�ڰݴɷ�" id="id_lics_box_set_<?=$licIdx?>">	
	 <colgroup>
	  <col width="*" />
	  <col width="*" />
		<col width="*" />
	  <col width="*" />
	  <col width="10%" />
	  </colgroup>
		<tbody>
		<tr>
			<td class="center"><?=$licList->LIC_NM?></td>
			<td class="center"><?=$licList->LIC_PB_NM?></td>
			<td class="center">
				<?=$licList->LIC_DT1?> <label for="">��</label> 
				<?=$licList->LIC_DT2?> <label for="">��</label> 
				<?=$licList->LIC_DT3?> <label for="">��</label> 
			</td>
			<td><?=$licList->LIC_NUM?></td>
			<td class="center"></td>
		</tr>
	</tbody>
	</table>
<? } ?>
	</div>

<?
	}
?>


<?
	/* 
		��ǻ�� Ȱ�� �ɷ� 
		frmComputerDataList
	*/
	if ($rsmdisplay[0]->PC_USE_YN == 'Y') { 
?>

<div class="h3-tit-box mgt30">
	<h3>OA�ɷ�</h3>

</div>

<table class="TbStyle01 mgt10" summary="OA�ɷ�">
<caption>OA�ɷ�</caption>
  <colgroup>
 
  
		<? foreach ($frmComputerDataList as $key => $clistData) { ?>
			<col width="*" />
		<? } ?>
	
  
  </colgroup>
  <thead>
	<tr>
		<? foreach ($frmComputerDataList as $key => $clistData) { ?>
			<th scope="col"><?=$clistData->CPU_NM?></th>
		<? } ?>
	</tr>
  </thead>
  <tbody>
	<tr>
		<? foreach ($frmComputerDataList as $key => $clistData) { ?>
			<td align="center">
				<?=$clistData->LVL_NM?>
			</td>
		<? } ?>
	</tr>
  </tbody>
</table>
					
<?
	}
?>

<? 
	/* 
		Ȱ������
		SERVE_USE_YN == 'Y'
	*/
	if ($rsmdisplay[0]->SERVE_USE_YN == 'Y') { 
?>

<div class="h3-tit-box mgt30">
	<h3>�ֿ�Ȱ�� �� ��ȸ����</h3>
	<span>���� / �Ƹ�����Ʈ / ���Ƹ� / �ڿ����� / ��ȸȰ�� / ����Ȱ�� / �������</span>
	
</div>

<table class="TbStyle01 mgt10" summary="�ֿ�Ȱ�� �� ��ȸ����">
	<caption>�ֿ�Ȱ�� �� ��ȸ����</caption>
	  <colgroup>
	  <col width="32%" />
	  <col width="15%" />
	  <col width="*" />
	  <col width="10%" />
	  </colgroup>
	  <thead>
		<tr>
			<th scope="col">Ȱ���Ⱓ</th>
			<th scope="col" colspan="2">��Ȱ��</th>
			<th scope="col">����</th>
		</tr>
	  </thead>
	</table>
<div id="id_srve_list">
<?
foreach ($srveRs as $key => $srveList)
{
	$srveIdx = $key + 1;
?>
	<table class="TbStyle01" summary="�ֿ�Ȱ�� �� ��ȸ����" id="id_srve_box_set_<?=$srveIdx?>">
		 <colgroup>
	  <col width="32%" />
	  <col width="15%" />
	  <col width="*" />
	  <col width="10%" />
	  </colgroup>
		  <tbody>
			<tr>
				<td rowspan="3">
					
					<?=$srveList->SRV_STDT1?> <label for="">��</label>
					<?=$srveList->SRV_STDT2?> <label for="">��</label> ~ 
					<?=$srveList->SRV_EDDT1?> <label for="">��</label>
					<?=$srveList->SRV_EDDT2?> <label for="">��</label>
				</td>
				<th scope="row"><label for="active_kind">Ȱ������</label></th>
				<td>
					<?=$srveList->SRV_TP_NM?>
				</td>
				<td rowspan="4" class="center Lline"></td>
			</tr>
			<tr>
				<th scope="row"><label for="ogani">���/���</label></th>
				<td><?=$srveList->SRV_ORG_NM?></td>
			</tr>
			<tr>
				<th scope="row"><label for="active_content">Ȱ������</label></th>
				<td><?=String2Html($srveList->SRV_CNTNT)?></td>
			</tr>
		  </tbody>
	</table>
<? } ?>	
</div>

<?
	}
?>


<? 
	/* 
		�����������
		TECH_USE_YN == 'Y'
	*/
	if ($rsmdisplay[0]->TECH_USE_YN == 'Y') { 
?>
<div class="h3-tit-box mgt30">
		<h3>������� �� �ɷ�</h3>
	</div>

<table class="TbStyle01 mgt10" summary="������� �� �ɷ�">
<caption>������� �� �ɷ�</caption>
  <colgroup>
  <col width="32%" />
  <col width="15%" />
  <col width="*" />
  <col width="10%" />
  </colgroup>
  <thead>
	<tr>
		<th scope="col">�����ɷ�</th>
		<th scope="col">����</th>
		<th scope="col">�󼼳���</th>
		<th scope="col">����</th>
	</tr>
  </thead>
</table>

<div id="id_tech_list">
<?
foreach ($techRs as $key => $techList)
{
	$techIdx = $key + 1;
?>	
	<table class="TbStyle01" summary="������� �� �ɷ�" id="id_tech_box_set_<?=$techIdx?>">
		<colgroup>
	  <col width="32%" />
	  <col width="15%" />
	  <col width="*" />
	  <col width="10%" />
	  </colgroup>
	<tbody>
	<tr>
		<td><?=$techList->TCH_NM?></td>
		<td><?=$techList->TCH_LVL?></td>
		<td><?=String2Html($techList->TCH_CNTNT)?></td>
		<td rowspan="4" class="center"></td>
	</tr>
  </tbody>
	</table>

<?
}
?>
</div>

<?
	}
?>



<? 
	/* 
		��������
		EDUCATION_USE_YN == 'Y'
	*/
	if ($rsmdisplay[0]->EDUCATION_USE_YN == 'Y') { 
?>
<div class="h3-tit-box mgt30">
	<h3>�����̼� ����</h3>
</div>

<table class="TbStyle01 mgt10" summary="�����̼� ����">
<caption>�����̼� ����</caption>
  <colgroup>
  <col width="32%" />
  <col width="15%" />
  <col width="*" />
  <col width="10%" />
  </colgroup>
  <thead>
	<tr>
		<th scope="col">Ȱ���Ⱓ</th>
		<th scope="col" colspan="2">��Ȱ��</th>
		<th scope="col">����</th>
	</tr>
  </thead>
</table>

<div id="id_educ_list">
<?
foreach ($educRs as $key => $educList)
{
	$educIdx = $key + 1;
?>	
	<table class="TbStyle01" summary="�����̼� ����" id="id_educ_box_set_<?=$educIdx?>">
<caption>�����̼� ����</caption>
  <colgroup>
  <col width="32%" />
  <col width="15%" />
  <col width="*" />
  <col width="10%" />
  </colgroup>
	<tbody>
		<tr>
			<td rowspan="3">
				<?=$educList->EDU_STDT1?> <label for="">��</label>
				<?=$educList->EDU_STDT2?> <label for="">��</label> ~ 
				<?=$educList->EDU_EDDT1?> <label for="">��</label>
				<?=$educList->EDU_EDDT2?> <label for="">��</label>
			</td>
			<th scope="row"><label for="edu_name">������</label></th>
			<td>
				<?=$educList->EDU_NM?>
			</td>
			<td rowspan="4" class="center Lline"></td>
		</tr>
		<tr>
			<th scope="row"><label for="ogani_03">�������</label></th>
			<td>
				<?=$educList->EDU_ORG_NM?>
			</td>
		</tr>
		<tr>
			<th scope="row"><label for="active_content_03">��������</label></th>
			<td><?=String2Html($educList->EDU_CNTNT)?></td>
		</tr>
	  </tbody>
	</table>
<? } ?>
</div>
<?
	}
?>


<? 
	/* 
		�ؿ� ���� 
		TRAINING_USE_YN == 'Y'
	*/
	if ($rsmdisplay[0]->TRAINING_USE_YN == 'Y') { 
?>
<div class="h3-tit-box mgt30">
	<h3>�ؿܿ��� �� �ؿܰ���</h3>
</div>

<table class="TbStyle01 mgt10" summary="�ؿܿ��� �� �ؿܰ���">
<caption>�ؿܿ��� �� �ؿܰ���</caption>
  <colgroup>
  <col width="32%" />
  <col width="15%" />
  <col width="*" />
  <col width="10%" />
  </colgroup>
  <thead>
	<tr>
		<th scope="col">Ȱ���Ⱓ</th>
		<th scope="col" colspan="2">��Ȱ��</th>
		<th scope="col">����</th>
	</tr>
  </thead>
</table>
<div id="id_trng_list">
<?
foreach ($trngRs as $key => $trngList)
{
	$trngIdx = $key + 1;
?>	
	<table class="TbStyle01" summary="�����̼� ����" id="id_trng_box_set_<?=$trngIdx?>">
		<caption></caption>
	  <colgroup>
	  <col width="32%" />
	  <col width="15%" />
	  <col width="*" />
	  <col width="10%" />
	  </colgroup>
		<tbody>
			<tr>
				<td rowspan="4">
					<input type="hidden" id="TRN_SEQ_<?=$trngIdx?>" name="TRN_SEQ_<?=$trngIdx?>" value="<?=$trngList->TRN_SEQ?>" />
					<?=$trngList->TRN_STDT1?> <label for="">��</label>
					<?=$trngList->TRN_STDT2?> <label for="">��</label> ~ 
					<?=$trngList->TRN_EDDT1?> <label for="">��</label>
					<?=$trngList->TRN_EDDT2?> <label for="">��</label>
				</td>
				<th scope="row"><label for="trn_name">���й� ����</label></th>
				<td><?=$trngList->TRN_TP_NM?> ������ : <?=$trngList->TRN_CTRY_NM?>
				</td>
				<td rowspan="5" class="center Lline"></td>
			</tr>
			<tr>
				<th scope="row"><label for="ogani_03">���/��ü</label></th>
				<td>
					<?=$trngList->TRN_ORG_NM?>
				</td>
			</tr>
			<tr>
				<th scope="row"><label for="ogani_03">����</label></th>
				<td>
					<?=$trngList->TRN_OBJ_NM?>
				</td>
			</tr>
			<tr>
				<th scope="row"><label for="active_content_03">Ȱ������</label></th>
				<td><?=String2Html($trngList->TRN_CNTNT)?></td>
			</tr>
		  </tbody>
	</table>
<?
	}
?>
</div>

<?
	}
?>

<? 
	/* 
		CONTENT_USE_YN == 'Y'
	*/
	if ($rsmdisplay[0]->CONTENT_USE_YN == 'Y') { 
?>

<!-- S: �ڱ�Ұ��� -->
<div class="h3-tit-box mgt30">
	<h3>�ڱ�Ұ���</h3>
</div>

<table class="TbStyle01 mgt10" summary="�ڱ�Ұ���">
	<caption>�ڱ�Ұ���</caption>
	  <colgroup>
	  <col width="30%" />
	  <col width="*" />
	  </colgroup>
	  <tbody>
	  <? foreach ($frmContent as $key => $data) { ?>
		<tr>
			<th scope="row" class="th-list">
				<?=$data->CNTNT_TITLE?>
			</th>
			<td><div class="scrollable"><?=nl2br(String2Html($data->APPL_CNTNT))?></div></td>
		</tr>
		<? } ?>
	  </tbody>
</table>

<? } ?>

<? 
	/* 
		CONTENT_USE_YN == 'Y'
	*/
	if ($rsmdisplay[0]->FILE_USE_YN == 'Y') { 
?>

<!-- S: �ڱ�Ұ��� -->
<div class="h3-tit-box mgt30">
	<h3>���Ͼ��ε�</h3>
</div>

<table class="TbStyle01 mgt10" summary="���Ͼ��ε�">
	<caption>���Ͼ��ε�</caption>
	  <colgroup>
	  <col width="30%" />
	  <col width="*" />
	  </colgroup>
	  <tbody>
	  <? foreach ($frmFile as $key => $data) { ?>
		<tr>
			<th scope="row" class="th-list">
				<?=$data->FILE_TITLE?>
			</th>
			<td><?=$data->APPL_FILE_NM?></td>
		</tr>
		<? } ?>
	  </tbody>
</table>

<? } ?>


<? if ($APPLY_CHECK_YN == 'ON') { ?> 
<div class="textC">
	<a href="javascript:goProcess();">[������ ����]</a>
	<? if ($APPL_YN != 'Y' ) { ?><a href="javascript:goApplySubmit();"><img src="<?=$FRONT_IMG_URL?>/img/board/table_btn05.gif" alt="����" /></a><? } ?>
</div>
<? } ?>