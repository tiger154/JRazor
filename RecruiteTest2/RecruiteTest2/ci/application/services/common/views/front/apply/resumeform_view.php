<script>
	
	function goProcess()
	{
		$("#form1").attr("method","post");
		$("#form1").attr("action","/front/apply/apply");
		$("#form1").submit();
	}
	
	function goApplySubmit()
	{
		if (confirm('최종제출을 하시겠습니까? 최종제출을 하시면 문구기억안남;;;'))
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

							<!-- S: 지원분야 -->
							<div class="h3-tit-box mgt30">
								<h3>지원분야</h3>
								<span>희망 지원분야를 선택하세요</span>
							</div>

							<table class="TbStyle01" summary="지원분야">
								<caption>지원분야</caption>
								  <colgroup>
								  <col width="15%" />
								  <col width="*" />
								  <col width="15%" />
								  <col width="*" />
								  </colgroup>
								  <tbody>
									<tr>
										<th scope="row"><label for="user_kind">지원분야</label> <span class="red">*</span></th>
										<td>
											<?=$SELECTBOX_UNIT_IDX1?>
										</td>
										<th scope="row"><label for="area">희망근무지</label></th>
										<td>
										<?
											foreach ($WRK_PLACELIST as $key => $wrkList)
											{
												
												echo $wrkList->ORD .'지망 : '. $wrkList->NAME . '<br>';
											}
										?>
										</td>
									</tr>
								  </tbody>
							</table>
							
							<!-- E: 지원분야 -->

							<!-- S: 기본 신상정보 -->
							<div class="h3-tit-box mgt30">
								<h3>기본 신상정보</h3>
								<span>신상정보를 입력해 주세요.</span>
							
							</div>

							<table class="TbStyle01" summary="기본 신상정보">
								<caption>기본 신상정보</caption>
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
										<th scope="row"><label for="user_name">이름</label> <span class="red">*</span></th>
										<td colspan="4">
											
											<?=$NAMEKOR?><span class="space">/</span>
											<label for="user_name">한문</label> <?=$NAMECHA?>
											<span class="space">/</span>
											<label for="user_name_eng">영문</label> <?=$NAMEENG1?>
											<?=$NAMEENG2?>
										</td>
									</tr>
									<tr>
										<th scope="row"><label for="birth_year">생년월일</label> <span class="red">*</span></th>
										<td colspan="4">
											<?=$BIRTH_DT1?> <label for="birth_year">년</label>
											<?=$BIRTH_DT2?> <label for="birth_month">월</label>
											<?=$BIRTH_DT3?> <label for="birth_day">일</label>
											(
												<?=$BIRTH_TP == 'S' ? ' 양력 ' : ''; ?>
											
												<?=$BIRTH_TP == 'L' ? ' 음력 ' : ''; ?>
											
											)
										</td>
									</tr>
									<tr>
										<th scope="row"><label for="address">주소</label> <span class="red">*</span></th>
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
										<th scope="row"><label for="user_phone_01">전화번호</label> <span class="red">*</span></th>
										<td colspan="2">
											<?=$SELECTBOX_TEL?> -
											<?=$TEL2?> -
											<?=$TEL3?>
										</td>
										<th scope="row"><label for="user_mobile_01">휴대폰</label> <span class="red">*</span></th>
										<td>
											<?=$SELECTBOX_HTEL?> -
											<?=$HTEL2?> -
											<?=$HTEL3?>
										</td>
									</tr>
									<tr>
										<th scope="row"><label for="user_mail">이메일</label> <span class="red">*</span></th>
										<td colspan="4">
											<?=$EMAIL?>
										</td>
									</tr>
									<tr>
										<th scope="row"><label for="marry_no">결혼여부</label> <span class="red">*</span></th>
										<td colspan="3">
											<?=$MARRY_YN == 'N' ? ' 미혼 ' : ''; ?>
											
											<?=$MARRY_YN == 'Y' ? ' 기혼 ' : ''; ?>
										
										</td>
										<th scope="row"><label for="religion">종교</label></th>
										<td colspan="2"><?=$RELIGION?></td>
									</tr>
									<tr>
										<th scope="row"><label for="hobby">취미</label></th>
										<td colspan="3"><?=$HOBBY?></td>
										<th scope="row"><label for="ability">특기</label></th>
										<td colspan="2"><?=$FORTE?></td>
									</tr>
									<tr valign="top">
										<th scope="row"><label for="target">보훈대상</label> <span class="red">*</span></th>
										<td colspan="3">
											<?=$BOHUN_TP_NM?>
											
											<? if ($BOHUN_SCORE_NM != '' ) { ?>가점 : <?=$BOHUN_SCORE_NM?><? } ?>
											<? if ($BOHUN_SCORE_NM != '' ) { ?>번호 : <?=$BOHUN_NUM?><? } ?>
											
										</td>
										<th scope="row"><label for="hindrance_01">장애여부</label> <span class="red">*</span></th>
										<td  valign="top" colspan="2">
											<?=$PSN_OBSTACLE_TP_NM?>
											
											<? if ($PSN_OBSTACLE_LVL_NM != '') { ?>장애등급 : <?=$PSN_OBSTACLE_LVL_NM?><? } ?>
											<? if ($PSN_OBSTACLE_TP_REASON != '') { ?>사유 : <?=$PSN_OBSTACLE_TP_REASON?><? } ?>
										
										</td>
									</tr>
									<tr>
										<th scope="row"><label for="user_height">신체조건</label></th>
										<td colspan="3">
											<label for="user_height">신장</label> <?=$PSN_HEIGHT?> cm
											<span class="space">/</span>
											<label for="user_weight">체중</label> <?=$PSN_WEIGHT?> kg
										</td>
										<th scope="row"><label for="eye_left">시력(교정)</label></th>
										<td colspan="2">
											<label for="eye_left">좌</label> <?=$PSN_LSIGHT?>
											<span class="space">/</span>
											<label for="eye_right">우</label> <?=$PSN_RSIGHT?>
											(색맹여부 : 
											<?=$PSN_CLRBLND_YN == 'Y' ? ' 유 ' : ''; ?>
											
												<?=$PSN_CLRBLND_YN == 'N' ? ' 무 ' : ''; ?>
										
											)
										</td>
									</tr>
									<tr>
										<th scope="row"><label for="radio01">국민기초생활<br />보장법 대상자</label> <span class="red">*</span></th>
										<td colspan="6">
											<?=$PSN_LOWINCOME_YN == 'Y' ? ' 해당 ' : ''; ?>
											<?=$PSN_LOWINCOME_YN == 'N' ? ' 비해당 ' : ''; ?>
											
											<span> ※ 국민기초생활보장법 및 한부모가족지원법에 따른 저소득층</span>
										</td>
									</tr>
								  </tbody>
							</table>
	
							<!-- E: 기본 신상정보 -->



<? 	if ($rsmdisplay[0]->ARMY_USE_YN == 'Y' ) { ?>
							<!-- S: 병역사항 -->
							<div class="h3-tit-box mgt30">
								<h3>병역사항</h3>
								<span>남자의 경우 병역필 또는 면제자에 한합니다.</span>
							</div>

							<table class="TbStyle01" summary="병역사항">
								<caption>병역사항</caption>
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
										<th scope="row"><label for="user_army01">군필여부</label> <span class="red">*</span></th>
										<td><?=$ARMY_YN_NM?></td>
										<th scope="row"><label for="user_army02">군별</label> </th>
										<td><?=$ARMY_TP_NM?></td>
										<th scope="row"><label for="user_army03">계급</label> </th>
										<td><?=$ARMY_LVL_NM?></td>
										<th scope="row"><label for="user_army04">제대구분</label> </th>
										<td><?=$ARMY_FINISH_NM?></td>
									</tr>
									<tr>
										<th scope="row"><label for="user_army05_1">병역기간</label> </th>
										<td colspan="3">
											<?=$ARMY_STDT1?> <label for="user_army05_1">년</label>
											<?=$ARMY_STDT2?> <label for="user_army05_2">월</label>
											<?=$ARMY_STDT3?> <label for="user_army05_3">일</label> ~ 
											<?=$ARMY_EDDT1?> <label for="user_army05_4">년</label>
											<?=$ARMY_EDDT2?> <label for="user_army05_5">월</label>
											<?=$ARMY_EDDT3?> <label for="user_army05_6">일</label>
										</td>
										<th scope="row"><label for="user_army06">면제사유</label></th>
										<td colspan="3"><?=$ARMY_REASON?></td>
									</tr>
									
								  </tbody>
							</table>

							<!-- E: 병역사항 -->
<? } ?>



<? 
	/* 
		가족사항 
		FAMILY_USE_YN == 'Y'
	*/
	if ($rsmdisplay[0]->FAMILY_USE_YN == 'Y') { 
?>


<!-- S: 가족사항 -->

			<div class="h3-tit-box mgt30">
			<h3>가족사항</h3>
			<span>가족사항이 없을 경우만 체크하세요. 입력사항이 있는 경우 반드시 입력해 주시기 바랍니다.</span>
			</div>
			
			<table class="TbStyle01" summary="가족사항 여부">
			<caption>가족사항 여부</caption>
			<colgroup>
			<col width="15%" />
			<col width="*" />
			</colgroup>
			<tbody>
			<tr>
			<th scope="row"><label for="family_none">가족사항 여부</label> <span class="red">*</span></th>
			<td>
			<?=$FMLY_NONE_YN == 'Y' ? ' 없음 ' : ''; ?>
		
			</td>
			</tr>
			</tbody>
			</table>
			<table class="TbStyle01" summary="가족사항">
			<caption>가족사항</caption>
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
			<th scope="col">관계</th>
			<th scope="col">성명</th>
			<th scope="col">연령</th>
			<th scope="col">학력</th>
			<th scope="col">직업</th>
			<th scope="col">직장명</th>
			<th scope="col">직위</th>
			<th scope="col">동거여부</th>
			<th scope="col">부양여부</th>
			<th scope="col">삭제</th>
			</tr>
			</thead>
			</table>
			
			<div id="id_fmly_list">
			<?
				foreach ($fmlyRs as $key => $fmlyList)
				{
					$fmlyIdx = $key + 1;
			?>
					<table class="TbStyle01" summary="가족사항" id="id_fmly_box_set_<?=$fmlyIdx?>">
					<caption>가족사항</caption>
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
			
			<!-- E: 가족사항 -->


<?
	}
?>

<? 
	/* 
		학력사항에 관련된 항목입니다. 
		SCHOOL_USE_YN == 'Y'
	*/
	if ($rsmdisplay[0]->SCHOOL_USE_YN == 'Y') { 
?>



<!-- S: 학력사항 -->
							<div class="h3-tit-box mgt30">
								<h3>학력사항</h3>
								
							</div>

							<table class="TbStyle01" summary="학력사항">
								<caption>학력사항</caption>
								  <colgroup>
								  <col width="15%" />
								  <col width="*" />
								  </colgroup>
								  <tbody>
									<tr>
										<th scope="row" colspan="2" class="left">
											
											<div style="text-align:left;float:left">고등학교&검정고시</div>
											<div style="text-align:right">
												<?=$SCH_FGRD_TP_1 == 'Y' ? ' 최종학력 ' : ''; ?>
												
											</div>
											
										</th>
									</tr>
									<tr>
										<th scope="row"><label for="school_name">학교구분</label></th>
										<td>
											<?=$SCH_TP_1 == '25' ? ' 고등학교 ' : ''; ?> 
											&nbsp;
											<?=$SCH_TP_1 == '52' ? ' 검정고시 ' : ''; ?>
										</td>
									</tr>
		
									<tr id="id_table_school1" >
										<th scope="row"><label for="school_name"><div id="id_title_school1">학교명</div></label></th>
										<td><?=$SCH_NM_1?></td>
									</tr>
									<tr id="id_table_school2" >
										<th scope="row"><label for="school_name"><div id="id_title_school2"><?=$SCH_TP_1 == '25' ? '재학기간' : '합격일자' ;?></div></label></th>
										<td>
											<? if ($SCH_STDT1_1 != '' ) { ?>
											<?=$SCH_STDT1_1?> <label for="">년</label>
											<?=$SCH_STDT2_1?> <label for="">월</label>
											<?=$frmSCH_ETTP1_1?> ~ 
											<? } ?>
											<?=$SCH_EDDT1_1?> <label for="">년</label>
											<?=$SCH_EDDT2_1?> <label for="">월</label>
											<?=$frmSCH_ETTP2_1?>
											<?=$frmSCH_JUYA_1?> <?=$frmSCH_BRANCH_TP_1?> <?=$frmSCH_LOC_1?></td>
									</tr>
								  </tbody>
							</table>
							
							<div id="id_high_scool_hak" style="display:none">
							<div class="point-txt">
								※ 최종학력이 고등학교 졸업일 경우 아래를 입력해 주시면 됩니다.
							</div>

							<table class="TbStyle01" summary="최종학력이 고등학교 졸업일 경우">
								<caption>최종학력이 고등학교 졸업일 경우</caption>
								  <colgroup>
								  <col width="15%" />
								  <col width="*" />
								  <col width="15%" />
								  <col width="25%" />
								  <col width="15%" />
								  </colgroup>
								  <thead>
									<tr>
										<th scope="col">성적구분 <span class="red">*</span></th>
										<td colspan="4">
											<div class="txt-box">
												<ul>
													<li>
														<input type="radio" class="radio" name="" id="standard_01" value="" />
														<label for="standard_01">등급기준</label>
													</li>
													<li>
														<input type="radio" class="radio" name="" id="standard_02" value="" />
														<label for="standard_02">석차기준</label>
													</li>
													<li>
														<input type="radio" class="radio" name="" id="standard_03" value="" />
														<label for="standard_03">점수기준</label>
													</li>
												</ul>
												<p>※ 성적입력방법(생활기록부 참조) 확인 후 입력 방법에 따라 선택해 주시기 바랍니다.</p>
												<p>※ 내신등급의 경우 산식에 의한 계산 후 소수점 두자리 까지 입력</p>
											</div>
										</td>
									</tr>
									<tr>
										<th scope="col">학년</th>
										<th scope="col">1학기 평균등급(등수)/재적수</th>
										<th scope="col">1학기 평균점수</th>
										<th scope="col">2학기 평균등급(등수)/재적수</th>
										<th scope="col" class="last">2학기 평균점수</th>
									</tr>
								  </thead>
								  <tbody>
									<tr>
										<th scope="row">1학년</th>
										<td class="center">
											<input class="b_input" type="text" name="" id="" value="" style="width:50px;" /><span class="space">/</span>
											<input class="b_input" type="text" name="" id="" value="" style="width:50px;" />
										</td>
										<td><input class="b_input" type="text" name="" id="" value="" style="width:70%;" /> 점</td>
										<td class="center">
											<input class="b_input" type="text" name="" id="" value="" style="width:50px;" /><span class="space">/</span>
											<input class="b_input" type="text" name="" id="" value="" style="width:50px;" />
										</td>
										<td><input class="b_input" type="text" name="" id="" value="" style="width:70%;" /> 점</td>
									</tr>
									<tr>
										<th scope="row">2학년</th>
										<td class="center">
											<input class="b_input" type="text" name="" id="" value="" style="width:50px;" /><span class="space">/</span>
											<input class="b_input" type="text" name="" id="" value="" style="width:50px;" />
										</td>
										<td><input class="b_input" type="text" name="" id="" value="" style="width:70%;" /> 점</td>
										<td class="center">
											<input class="b_input" type="text" name="" id="" value="" style="width:50px;" /><span class="space">/</span>
											<input class="b_input" type="text" name="" id="" value="" style="width:50px;" />
										</td>
										<td><input class="b_input" type="text" name="" id="" value="" style="width:70%;" /> 점</td>
									</tr>
									<tr>
										<th scope="row">3학년</th>
										<td class="center">
											<input class="b_input" type="text" name="" id="" value="" style="width:50px;" /><span class="space">/</span>
											<input class="b_input" type="text" name="" id="" value="" style="width:50px;" />
										</td>
										<td><input class="b_input" type="text" name="" id="" value="" style="width:70%;" /> 점</td>
										<td class="center">
											<input class="b_input" type="text" name="" id="" value="" style="width:50px;" /><span class="space">/</span>
											<input class="b_input" type="text" name="" id="" value="" style="width:50px;" />
										</td>
										<td><input class="b_input" type="text" name="" id="" value="" style="width:70%;" /> 점</td>
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
								<table class="TbStyle01" summary="학력사항" id="id_schl_box_set_<?=$schlIdx?>">
								<caption>학력사항</caption>
								  <colgroup>
								  <col width="15%" />
								  <col width="*" />
								  <col width="10%" />
								  </colgroup>
								  <tbody>
								  <tr>
								  	<th scope="row">학력구분</th>
								  	<td colspan="2">
								  		<div style="text-align:left;float:left"><?=${'frmSCH_TP_' . $schlIdx}?></div>
								  		<div style="text-align:right">
											<?=$schlRs[$schKeyIdx]->SCH_FGRD_TP == 'Y' ? ' [최종학력] ' : ''; ?>
											
											</div>
								  	</td>
									</tr>
									<tr>
										<th scope="row"><label for="school_name_02">학교명</label></th>
										<td colspan=2>
											<?=$schlRs[$schKeyIdx]->SCH_NM?>
											
											<?=${'frmSCH_JUYA_' . $schlIdx}?>
											<?=${'frmSCH_BRANCH_TP_' . $schlIdx}?>
											<?=${'frmSCH_LOC_' . $schlIdx}?>
										</td>
										
									</tr>
									<tr>
										<th scope="row"><label for="school_term_01_01">재학기간</label></th>
										<td>
											<?=$schlRs[$schKeyIdx]->SCH_STDT1?> <label for="">년</label>
											<?=$schlRs[$schKeyIdx]->SCH_STDT2?> <label for="">월</label>
											<?=${'frmSCH_ETTP1_' . $schlIdx}?> ~ 
											<?=$schlRs[$schKeyIdx]->SCH_EDDT1?> <label for="">년</label>
											<?=$schlRs[$schKeyIdx]->SCH_EDDT2?> <label for="">월</label>
											<?=${'frmSCH_ETTP2_' . $schlIdx}?>
										</td>
										<td rowspan="2" class="center Lline"></td>
									</tr>
									<tr>
										<th scope="row">전공 및 학점</th>
										<td>
											
											<ul>
												<li>
											
													<div style="width:50px;float:left">전공</div>
													<div style="width:100px;float:left">계열 학과(전공)</div>
													<?=${'frmSCH_AFF_' . $schlIdx}?>
													<?=$schlRs[$schKeyIdx]->SCH_MAJOR_NM?>
												</li>
												<li>
													<div style="width:50px;float:left"></div>
													<div style="width:60px;float:left">취득학점</div>
													<?=$schlRs[$schKeyIdx]->SCH_HAKJUM?>
													<span class="space">/</span>
													<?=${'frmSCH_MAX_HAKJUM_' . $schlIdx}?>
													&nbsp;&nbsp;이수학점
													"<?=$schlRs[$schKeyIdx]->SCH_ISU_HAKJUM?>
												</li>
												<li>
													<div style="width:50px;float:left">부전공</div>
													<div style="width:100px;float:left">구분 선택</div>
													<?=${'frmSCH_SUB_MAJOR_TP_' . $schlIdx}?>
												</li>
												
													
													<div style="width:50px;float:left">부전공</div>
													<div style="width:100px;float:left">계열 학과(전공)</div>
													
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
							
							<!-- E: 학력사항 -->


<!-- 학력 사항 디자인 -->

<? } ?>

<?
	//경력사항 - 
	if ($rsmdisplay[0]->CAREER_USE_YN == 'Y' ) {
?>

<div class="h3-tit-box mgt30">
								<h3>경력사항</h3>
								<span>상세업무내용은 400 자 이내로 자세히 작성해 주세요.</span>
							</div>

							<table class="TbStyle01" summary="경력사항">
								<caption>경력사항</caption>
								  <colgroup>
								  <col width="15%" />
								  <col width="*" />
								  </colgroup>
								  <tbody>
									<tr>
										<th scope="row" rowspan="2"><label for="family_none">경력사항</label> <span class="red">*</span></th>
										<td>
											<?=$CAREER_TP == 'N' ? ' <label for="newcomer">신입</label> ' : ''; ?>
											<?=$CAREER_TP == 'C' ? ' <label for="career">경력</label> ' : ''; ?>
											<?=$CAREER_TERM1?> <label for="">년</label>
											<?=$CAREER_TERM2?> <label for="">개월</label>
											<span class="space">/</span>
											<?=$FOREIGN_CAREER_YN == 'Y' ? ' 해외근무 ' : ''; ?>
											
											<?=$FOREIGN_CAREER_TERM1?> <label for="">년</label>
											<?=$FOREIGN_CAREER_TERM2?> <label for="">개월</label>
										</td>
									</tr>
									<tr>
										<td>
											<label for="family_none"><span>고용보험가입기간</span></label>
											<?=$EMP_INSUR_TERM1?> <label for="">년</label>
											<?=$EMP_INSUR_TERM2?> <label for="">개월</label>
											<span> ※ <a href="http://www.ei.go.kr" target="_blank" title="새창에서열림">http://www.ei.go.kr</a> 에서 고용보험가입기간을 조회 후 선택</span>
										</td>
									</tr>
								  </tbody>
							</table>

	<table class="TbStyle01 mgt10" summary="경력사항 상세">
	<caption>경력사항 상세</caption>
	<colgroup>
	<col width="28%" />
	<col width="15%" />
	<col width="*" />
	<col width="10%" />
	</colgroup>
	<thead>
	<tr>
	<th scope="col">근무기간</th>
	<th scope="col" colspan="2">상세경력</th>
	<th scope="col">삭제</th>
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
	<caption>경력사항 상세</caption>
  <colgroup>
  <col width="28%" />
  <col width="15%" />
  <col width="*" />
  <col width="10%" />
  </colgroup>
	<tbody>
	<tr>
		<td rowspan="5">
			<?=$carrList->CAREER_STDT1?>년 <?=$carrList->CAREER_STDT2?>월 ~ 
			<?=$carrList->CAREER_EDDT1?>년 <?=$carrList->CAREER_EDDT2?>월
			<br>
			<?=$carrList->CAREER_STS_NM?>
		</td>
		<th scope="row"><label for="company_name">회사명</label></th>
		<td><?=$carrList->CAREER_CMP_NM?> <?=$carrList->CAREER_CMP_TP_NM?> <?=$carrList->CAREER_LOC_NM?></td>
		<td rowspan="5" class="center Lline"></td>
	</tr>
	<tr>
		<th>직종</th>
		<td><?=$carrList->CAREER_EMP_TP_NM?> <?=$carrList->CAREER_JOB_TP_NM?> <?=$carrList->CAREER_JOB_TP_CD?>
		</td>
	</tr>
	<tr>
		<th>근무부서/직위</th>
		<td>부서명 : <?=$carrList->CAREER_DEPT_NM?> <?=$carrList->CAREER_PSTN_NM?></td>
	</tr>
	<tr>
		<th>업무내용</th>
		<td><div class="scrollable"><?=$carrList->CAREER_CNTNT?></div></td>
	</tr>
	<tr>
		<th>퇴사사유</th>
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
	// 어학시험
	if ($rsmdisplay[0]->LANGUAGE_USE_YN == 'Y') {
?>


		<!-- S: 어학시험 -->
		<div class="h3-tit-box mgt30">
			<h3>어학시험</h3>
			
		</div>



<table class="TbStyle01 mgt10" summary="어학시험">
	<caption>어학시험</caption>
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
			<th scope="col">어학시험명</th>
			<th scope="col">시행기관</th>
			<th scope="col">시험점수(등급)</th>
			<th scope="col">취득일</th>
			<th scope="col">등록번호</th>
			
		
			<th scope="col">삭제</th>
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
			<?=$lanList->LAN_DT1?> <label for="">년</label>
			<?=$lanList->LAN_DT2?> <label for="">월</label>
			<?=$lanList->LAN_DT3?> <label for="">일</label>
			
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
	// 저술
	if ($rsmdisplay[0]->WRITE_USE_YN == 'Y') {
?>
	
<!-- S: 저술 -->
		<div class="h3-tit-box mgt30">
			<h3>저술내역</h3>
		</div>

	<table class="TbStyle01 mgt10" summary="저술내역">
	<caption>저술</caption>
	  <colgroup>
	  <col width="22%" />
	  <col width="22%" />
	  <col width="*" />
	  <col width="10%" />
	  </colgroup>
	  <thead>
		<tr>
			<th scope="col">저술명</th>
			<th scope="col">발생/게재처</th>
			<th scope="col">발행/게재일</th>
			<th scope="col">삭제</th>
		</tr>
	  </thead>
	</table>
<div id="id_wrte_list">
<?
	foreach ($wrteRs as $key => $wrteList)
	{
		$wrteIdx = $key + 1;
?>
<table class="TbStyle01" summary="저술내역" id="id_wrte_box_set_<?=$wrteIdx?>">	
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
				<?=$wrteList->WRT_DT1?> <label for="">년</label> 
				<?=$wrteList->WRT_DT2?> <label for="">월</label> 
				<?=$wrteList->WRT_DT3?> <label for="">일</label> 
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
	// 수상내역
	if ($rsmdisplay[0]->PRIZE_USE_YN == 'Y') {
?>
	
<!-- S: 수상내역 -->
		<div class="h3-tit-box mgt30">
			<h3>수상내역</h3>
		</div>



	<table class="TbStyle01 mgt10" summary="수상내역">
	<caption>수상명</caption>
	  <colgroup>
	  <col width="22%" />
	  <col width="22%" />
	  <col width="*" />
	  <col width="10%" />
	  </colgroup>
	  <thead>
		<tr>
			<th scope="col">수상명</th>
			<th scope="col">수여기관</th>
			<th scope="col">수상일</th>
			<th scope="col">삭제</th>
		</tr>
	  </thead>
	</table>
<div id="id_prze_list">
<?
	foreach ($przeRs as $key => $przeList)
	{
		$przeIdx = $key + 1;
?>
<table class="TbStyle01" summary="수상내역" id="id_prze_box_set_<?=$przeIdx?>">	
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
					<?=$przeList->PRZ_DT1?> <label for="">년</label> 
					<?=$przeList->PRZ_DT2?> <label for="">월</label> 
					<?=$przeList->PRZ_DT3?> <label for="">일</label> 
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
	// 쓰잘데기없는 어학
	if ($rsmdisplay[0]->LANGUAGE2_USE_YN == 'Y') {
?>
<!-- S: 어학능력 -->
		<div class="h3-tit-box mgt30">
			<h3>어학능력</h3>
			
		</div>



	<table class="TbStyle01 mgt10" summary="어학능력">
	<caption>어학능력</caption>
	  <colgroup>
	  <col width="22%" />
	  <col width="*" />
	  <col width="*" />
	  <col width="*" />
	  <col width="10%" />
	  </colgroup>
	  <thead>
		<tr>
			<th scope="col">언어</th>
			<th scope="col">회화능력</th>
			<th scope="col">작문능력</th>
			<th scope="col">독해능력</th>
			<th scope="col">삭제</th>
		</tr>
	  </thead>
	</table>
<div id="id_lan2_list">
<?
	foreach ($lan2Rs as $key => $lan2List)
	{
		$lan2Idx = $key + 1;
?>
<table class="TbStyle01" summary="어학능력" id="id_lan2_box_set_<?=$lan2Idx?>">	
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

<!-- S: 자격증 -->
		<div class="h3-tit-box mgt30">
			<h3>자격증</h3>
			
		</div>


	<table class="TbStyle01 mgt10" summary="자격증">
	<caption>자격증</caption>
	  <colgroup>
	  <col width="*" />
	  <col width="*" />
	  <col width="*" />
	  <col width="*" />
	  <col width="10%" />
	  </colgroup>
	  <thead>
		<tr>
			<th scope="col">자격증명</th>
			<th scope="col">발행처</th>
			<th scope="col">취득일자</th>
			<th scope="col">등록번호</th>
			<th scope="col">삭제</th>
		</tr>
	  </thead>
	</table>
	
<div id="id_lics_list">
<?
foreach ($licRs as $key => $licList)
{
	$licIdx = $key + 1;
?>
	<table class="TbStyle01" summary="자격능력" id="id_lics_box_set_<?=$licIdx?>">	
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
				<?=$licList->LIC_DT1?> <label for="">년</label> 
				<?=$licList->LIC_DT2?> <label for="">월</label> 
				<?=$licList->LIC_DT3?> <label for="">일</label> 
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
		컴퓨터 활용 능력 
		frmComputerDataList
	*/
	if ($rsmdisplay[0]->PC_USE_YN == 'Y') { 
?>

<div class="h3-tit-box mgt30">
	<h3>OA능력</h3>

</div>

<table class="TbStyle01 mgt10" summary="OA능력">
<caption>OA능력</caption>
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
		활동사항
		SERVE_USE_YN == 'Y'
	*/
	if ($rsmdisplay[0]->SERVE_USE_YN == 'Y') { 
?>

<div class="h3-tit-box mgt30">
	<h3>주요활동 및 사회경험</h3>
	<span>인턴 / 아르바이트 / 동아리 / 자원봉사 / 사회활동 / 교내활동 / 수행과제</span>
	
</div>

<table class="TbStyle01 mgt10" summary="주요활동 및 사회경험">
	<caption>주요활동 및 사회경험</caption>
	  <colgroup>
	  <col width="32%" />
	  <col width="15%" />
	  <col width="*" />
	  <col width="10%" />
	  </colgroup>
	  <thead>
		<tr>
			<th scope="col">활동기간</th>
			<th scope="col" colspan="2">상세활동</th>
			<th scope="col">삭제</th>
		</tr>
	  </thead>
	</table>
<div id="id_srve_list">
<?
foreach ($srveRs as $key => $srveList)
{
	$srveIdx = $key + 1;
?>
	<table class="TbStyle01" summary="주요활동 및 사회경험" id="id_srve_box_set_<?=$srveIdx?>">
		 <colgroup>
	  <col width="32%" />
	  <col width="15%" />
	  <col width="*" />
	  <col width="10%" />
	  </colgroup>
		  <tbody>
			<tr>
				<td rowspan="3">
					
					<?=$srveList->SRV_STDT1?> <label for="">년</label>
					<?=$srveList->SRV_STDT2?> <label for="">월</label> ~ 
					<?=$srveList->SRV_EDDT1?> <label for="">년</label>
					<?=$srveList->SRV_EDDT2?> <label for="">월</label>
				</td>
				<th scope="row"><label for="active_kind">활동구분</label></th>
				<td>
					<?=$srveList->SRV_TP_NM?>
				</td>
				<td rowspan="4" class="center Lline"></td>
			</tr>
			<tr>
				<th scope="row"><label for="ogani">기관/장소</label></th>
				<td><?=$srveList->SRV_ORG_NM?></td>
			</tr>
			<tr>
				<th scope="row"><label for="active_content">활동내용</label></th>
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
		보유기술사항
		TECH_USE_YN == 'Y'
	*/
	if ($rsmdisplay[0]->TECH_USE_YN == 'Y') { 
?>
<div class="h3-tit-box mgt30">
		<h3>보유기술 및 능력</h3>
	</div>

<table class="TbStyle01 mgt10" summary="보유기술 및 능력">
<caption>보유기술 및 능력</caption>
  <colgroup>
  <col width="32%" />
  <col width="15%" />
  <col width="*" />
  <col width="10%" />
  </colgroup>
  <thead>
	<tr>
		<th scope="col">보유능력</th>
		<th scope="col">수준</th>
		<th scope="col">상세내용</th>
		<th scope="col">삭제</th>
	</tr>
  </thead>
</table>

<div id="id_tech_list">
<?
foreach ($techRs as $key => $techList)
{
	$techIdx = $key + 1;
?>	
	<table class="TbStyle01" summary="보유기술 및 능력" id="id_tech_box_set_<?=$techIdx?>">
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
		교육사항
		EDUCATION_USE_YN == 'Y'
	*/
	if ($rsmdisplay[0]->EDUCATION_USE_YN == 'Y') { 
?>
<div class="h3-tit-box mgt30">
	<h3>교육이수 내역</h3>
</div>

<table class="TbStyle01 mgt10" summary="교육이수 내역">
<caption>교육이수 내역</caption>
  <colgroup>
  <col width="32%" />
  <col width="15%" />
  <col width="*" />
  <col width="10%" />
  </colgroup>
  <thead>
	<tr>
		<th scope="col">활동기간</th>
		<th scope="col" colspan="2">상세활동</th>
		<th scope="col">삭제</th>
	</tr>
  </thead>
</table>

<div id="id_educ_list">
<?
foreach ($educRs as $key => $educList)
{
	$educIdx = $key + 1;
?>	
	<table class="TbStyle01" summary="교육이수 내역" id="id_educ_box_set_<?=$educIdx?>">
<caption>교육이수 내역</caption>
  <colgroup>
  <col width="32%" />
  <col width="15%" />
  <col width="*" />
  <col width="10%" />
  </colgroup>
	<tbody>
		<tr>
			<td rowspan="3">
				<?=$educList->EDU_STDT1?> <label for="">년</label>
				<?=$educList->EDU_STDT2?> <label for="">월</label> ~ 
				<?=$educList->EDU_EDDT1?> <label for="">년</label>
				<?=$educList->EDU_EDDT2?> <label for="">월</label>
			</td>
			<th scope="row"><label for="edu_name">교육명</label></th>
			<td>
				<?=$educList->EDU_NM?>
			</td>
			<td rowspan="4" class="center Lline"></td>
		</tr>
		<tr>
			<th scope="row"><label for="ogani_03">교육기관</label></th>
			<td>
				<?=$educList->EDU_ORG_NM?>
			</td>
		</tr>
		<tr>
			<th scope="row"><label for="active_content_03">교육내용</label></th>
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
		해외 경험 
		TRAINING_USE_YN == 'Y'
	*/
	if ($rsmdisplay[0]->TRAINING_USE_YN == 'Y') { 
?>
<div class="h3-tit-box mgt30">
	<h3>해외연수 및 해외경험</h3>
</div>

<table class="TbStyle01 mgt10" summary="해외연수 및 해외경험">
<caption>해외연수 및 해외경험</caption>
  <colgroup>
  <col width="32%" />
  <col width="15%" />
  <col width="*" />
  <col width="10%" />
  </colgroup>
  <thead>
	<tr>
		<th scope="col">활동기간</th>
		<th scope="col" colspan="2">상세활동</th>
		<th scope="col">삭제</th>
	</tr>
  </thead>
</table>
<div id="id_trng_list">
<?
foreach ($trngRs as $key => $trngList)
{
	$trngIdx = $key + 1;
?>	
	<table class="TbStyle01" summary="교육이수 내역" id="id_trng_box_set_<?=$trngIdx?>">
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
					<?=$trngList->TRN_STDT1?> <label for="">년</label>
					<?=$trngList->TRN_STDT2?> <label for="">월</label> ~ 
					<?=$trngList->TRN_EDDT1?> <label for="">년</label>
					<?=$trngList->TRN_EDDT2?> <label for="">월</label>
				</td>
				<th scope="row"><label for="trn_name">구분및 국가</label></th>
				<td><?=$trngList->TRN_TP_NM?> 국가명 : <?=$trngList->TRN_CTRY_NM?>
				</td>
				<td rowspan="5" class="center Lline"></td>
			</tr>
			<tr>
				<th scope="row"><label for="ogani_03">기관/단체</label></th>
				<td>
					<?=$trngList->TRN_ORG_NM?>
				</td>
			</tr>
			<tr>
				<th scope="row"><label for="ogani_03">목적</label></th>
				<td>
					<?=$trngList->TRN_OBJ_NM?>
				</td>
			</tr>
			<tr>
				<th scope="row"><label for="active_content_03">활동내용</label></th>
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

<!-- S: 자기소개서 -->
<div class="h3-tit-box mgt30">
	<h3>자기소개서</h3>
</div>

<table class="TbStyle01 mgt10" summary="자기소개서">
	<caption>자기소개서</caption>
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

<!-- S: 자기소개서 -->
<div class="h3-tit-box mgt30">
	<h3>파일업로드</h3>
</div>

<table class="TbStyle01 mgt10" summary="파일업로드">
	<caption>파일업로드</caption>
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
	<a href="javascript:goProcess();">[지원서 수정]</a>
	<? if ($APPL_YN != 'Y' ) { ?><a href="javascript:goApplySubmit();"><img src="<?=$FRONT_IMG_URL?>/img/board/table_btn05.gif" alt="제출" /></a><? } ?>
</div>
<? } ?>