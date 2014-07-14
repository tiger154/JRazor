<script language="javascript" src="/assets/js/jquery.validate.js"></script>
<script>
	
	function bodyOnLoad()
	{
		
		$("#form1").validate({  
				groups:{SCH_ERR_MSG:"CAREER_SYEAR CAREER_EYEAR NAI_ST NAI_ED"},
		    rules: {
		    	CAREER_SYEAR:{digits:true},
		    	CAREER_EYEAR:{digits:true},
		    	NAI_ST:{digits:true},
		    	NAI_ED:{digits:true}
		    },  
		    onkeyup:false,
		    messages: {
		    	CAREER_SYEAR:{digits:"[경력년수]숫자만 입력하세요"},
		    	CAREER_EYEAR:{digits:"[경력년수]숫자만 입력하세요"},
		    	NAI_ST:{digits:"[나이]숫자만 입력하세요"},
		    	NAI_ED:{digits:"[나이]숫자만 입력하세요"}
		    },
		    submitHandler: function(form) { 
				
	    	form.submit();

	    	}
   	});  
	}
	
	function changeProject(obj)
	{
		$("#PRJ_IDX").val(obj.value);
		$("#form1").submit();
	}
	
	function PageNumClick(page)
	{
		
		$("#form1").attr("method","post");
		$("#form1").submit();
	}
	
	function actStep(code)
	{
		$("#STEP_IDX").val(code);
		$("#form1").submit();
	}
	
	function actApplyMoveStep()
	{
		//alert($("#APP_LIST").val());
		var app_list = '';
		var x = 0;
		for(var a = 0 ;a < <?=count($appList)?> ; a ++)
		{
			if ($("#APP_LIST" + a).is(":checked"))
			{
				app_list += $("#APP_LIST" + a).val() + '|';
				x++;
			}
		}
		if (x > 0)
		{
			if ($("#SCH_STEP_IDX option:selected").val() == $("#STEP_IDX").val())
			{
				alert('현재 전형과 이동할 전형이 같습니다.');
			}
			else
			{
				$("#APPLY_LIST").val(app_list);
				$("#TARGET_STEP_IDX").val($("#SCH_STEP_IDX option:selected").val());
				//$("#form1").attr("action","/admin/stepManagement/applyStepUpdateProcess");
				//$("#form1").submit();
				
				var serializedData = $("#form1").serialize();
				
				$.ajax({
        url: "/admin/stepManagement/applyStepUpdateProcess",
        type: "post",
        data: serializedData,
        success: function(response, textStatus, jqXHR){
            // log a message to the console
            //console.log("Hooray, it worked!");
           // alert(response);
            if (response == 'OK')
            {
            	alert('이동되었습니다.');
            	//$("#form1").attr("action","/admin/stepManagement/applyList");
            	$("#form1").submit();
            }
        },
        error: function(jqXHR, textStatus, errorThrown){
            //console.log("The following error occured: "+textStatus, errorThrown);
        },
        // callback handler that will be called on completion
        // which means, either on success or error
        complete: function(){
        	  // enable the inputs
        }
				});


				
			}
		}
		else
		{
			alert('이동할 지원자를 선택하세요');
		}
	}
	
	function goProcess(code)
	{
		$("#EXCEL_FLAG").val(code);
		$("#SUBMIT_BUTTON").click();
	}
	
	function goView(apply_no) // 지원서 보기
	{
		$("#SPRJ_IDX").val($("#PRJ_IDX").val());
		$("#APPLY_NO").val(apply_no);
		$("#form2").attr("action","/front/apply/applyView");
		$("#form2").attr("method","post");
		$("#form2").attr("target","blank");
		$("#form2").submit();
	}
	
	function goModify(apply_no) // 지원서 수정
	{
		$("#SPRJ_IDX").val($("#PRJ_IDX").val());
		$("#APPLY_NO").val(apply_no);
		$("#form2").attr("action","/front/apply");
		$("#form2").attr("method","post");
		$("#form2").attr("target","blank");
		$("#form2").submit();
	}
	
	function goHistory(apply_no) // 이력정보
	{
		//getApplyStepHistory($arg)
		goLink('','pop','width=650 height=500 resizable=yes scrollbars=yes status=yes');
		$("#form2").attr('target','open_pops');
		$("#SPRJ_IDX").val($("#PRJ_IDX").val());
		$("#APPLY_NO").val(apply_no);
		$("#form2").attr("action","/admin/stepManagement/applyStepHistory");
		$("#form2").attr("method","post");
		
		$("#form2").submit();
	}
	
	function goPassword(APPL_IDX) // 패스워드초기화
	{
		
		//getApplyStepHistory($arg)
		goLink('','pop','width=350 height=137 resizable=yes scrollbars=yes status=yes');
		$("#form2").attr('target','open_pops');
		$("#SPRJ_IDX").val($("#PRJ_IDX").val());
		$("#APPL_IDX").val(APPL_IDX);
		$("#form2").attr("action","/admin/stepManagement/applyPasswordReset");
		$("#form2").attr("method","post");
		
		$("#form2").submit();
		
	}
	
	var checked_flag = 1;
	
	function selChecked()
	{
		
		var x = 0;
		if ( checked_flag == 1 )
		{
			while (x > -1)
			{
				if ( $("#APP_LIST" + x).length == 0 ) break;
				$("#APP_LIST" + x).attr("checked",true);
				x++;
			}
			checked_flag = 0;
			
		}
		else
		{
			while (x > -1)
			{
				if ( $("#APP_LIST" + x).length == 0 ) break;
				$("#APP_LIST" + x).attr("checked",false);
				x++;
			}
			checked_flag = 1;
			
		}
	}
	
</script>
<style>
	
	#Sch-box {width:100%;}
	#Sch-box th {text-align:left;}
	#Sch-box td {text-align:left;}
	
	
</style>
<form name="form2" id="form2" method="post" >
	
<input type="hidden" id="APPL_IDX" name="APPL_IDX" />
<input type="hidden" id="APPLY_NO" name="APPLY_NO" />
<input type="hidden" id="SPRJ_IDX" name="SPRJ_IDX" />
<input type="hidden" id="ADMIN_FLAG" name="ADMIN_FLAG" value="<?=$code?>" />
</form>
<form name="form1" id="form1" method="post" action="/admin/stepManagement/applyList">
<input type="hidden" name="TARGET_STEP_IDX" id="TARGET_STEP_IDX" />
<input type="hidden" name="APPLY_LIST" id="APPLY_LIST" />	
<input type="hidden" name="STEP_IDX" id="STEP_IDX" value="<?=$STEP_IDX?>" />
<input type="hidden" id="EXCEL_FLAG" name="EXCEL_FLAG" value="">
					<div id="Sch-box">
						<table summary="지원자 정보 관리">
							
							<colgroup>
								<col width="20px" />
								<col width="90px" />
								<col width="*" />
								
								<col width="20px" />
								<col width="90px" />
								<col width="*" />
								
								<col width="20px" />
								<col width="90px" />
								<col width="*" />
								
							</colgroup>
							<tbody>
								<tr>
									<td></td>	
									<th scope="row"><label for="w01">채용공고</label></th>
									<td><?=$SELECTBOX_PRJ_IDX?></td>
									
									<td></td>	
									<th scope="row"><label for="w02">지원분야</label></th>
									<td><?=$SELECTBOX_UNIT_IDX?></td>
									
									<td></td>	
									<th scope="row"><label for="w03a">목록수</label></th>
									<td>한페이지당 <?=$SELECTBOX_SCH_LIST_COUNT?> 개씩</td>
									
								</tr>
							
								<!-- 기본 인적사항 -->
								<? if ($rsmDataUseYn[0]->PERSONAL_USE_YN == 'Y') { ?>
								<tr>
									<td></td>
									<th scope="row"><label for="w01">성명</label></th>
									<td><input type="text" name="NAMEKOR" id="NAMEKOR" title="성명 입력" style="width:120px;" value="<?=$NAMEKOR?>" /></td>
										
									<td></td>	
									<th scope="row"><label for="w02">나이</label></th>
									<td><input type="text" style="width:30px" id="S_NAI" name="S_NAI" value="<?=$S_NAI?>" /> ~ <input type="text" style="width:30px" id="E_NAI" name="E_NAI" value="<?=$E_NAI?>" /></td>									
									
									<td></td>	
									<th scope="row"><label for="w03a">성별</label></th>
									<td>
										<input type="radio" name="SEX_CD" id="SEX_CD" value="" class="radio" <?=$SEX_CD == '' ? ' checked ' : ''; ?> />전체
										<input type="radio" name="SEX_CD" id="SEX_CD" value="M" class="radio" <?=$SEX_CD == 'M' ? ' checked ' : ''; ?> />남자
										<input type="radio" name="SEX_CD" id="SEX_CD" value="F" class="radio" <?=$SEX_CD == 'F' ? ' checked ' : ''; ?> />여자
									</td>
									
								</tr>
								<? } ?>
								
								<? if ($rsmDataUseYn[0]->SCHOOL_USE_YN == 'Y') { ?>
								<!-- 학력사항 -->
								<tr>
									<td></td>
									<th scope="row"><label for="w04a">최종학력</label></th>
									<td>
										<?=$SELECTBOX_SCH_TP?>
										<input id="SCH_FGRD_TP" name="SCH_FGRD_TP" class="checkbox" type="checkbox" value="Y" <?=$SCH_FGRD_TP == 'Y' ? ' checked ' : ''; ?> />
										
									</td>
									
									<td></td>
									<th scope="row"><label for="w05a">전공</label></th>
									<td>
											<input type="text" name="SCH_MAJOR_NM" id="SCH_MAJOR_NM" title="학교명 입력" style="width:92%;" value="<?=$SCH_MAJOR_NM?>" />
									</td>
									
									<td></td>
									<th scope="row"><label for="w06">학교명</label></th>
									<td>
										<input type="text" name="SCH_NM" id="SCH_NM" title="학교명 입력" style="width:92%;"  value="<?=$SCH_NM?>" />
									</td>
								</tr>
								
								
								<? } ?>
								<? if ($rsmDataUseYn[0]->CAREER_USE_YN == 'Y') { ?>
								
								<tr>
									<td></td>
									<th scope="row"><label for="w07">경력</label></th>
									<td>
										<input type="radio" name="CAREER_TP" id="CAREER_TP" value="" class="radio" <?=$CAREER_TP == '' ? ' checked ' : ''; ?> />전체
										<input type="radio" name="CAREER_TP" id="CAREER_TP" value="N" class="radio" <?=$CAREER_TP == 'N' ? ' checked ' : ''; ?>/>신입
										<input type="radio" name="CAREER_TP" id="CAREER_TP" value="C" class="radio" <?=$CAREER_TP == 'C' ? ' checked ' : ''; ?> />경력
									</td>
									
									<td></td>
									<th scope="row"><label for="w09a">경력년수</label></th>
									<td>
										<input type="text" name="S_CAREER_SUM" id="S_CAREER_SUM" title="경력년수 입력" style="width:30px;" value="<?=$S_CAREER_SUM?>" /> 년 이상 ~
										<input type="text" name="E_CAREER_SUM" id="E_CAREER_SUM" title="경력년수 입력" style="width:30px;" value="<?=$E_CAREER_SUM?>" /> 년 이하
									</td>
									
									<td></td>
									<th scope="row"><label for="w08a">회사명</label></th>
									<td>
										<input type="text" name="CAREER_CMP_NM" id="CAREER_CMP_NM" title="회사명 입력" style="width:92%;" value="<?=$CAREER_CMP_NM?>" />
									</td>
									
								</tr>
								<? } ?>
								<? if ($rsmDataUseYn[0]->LANGUAGE_USE_YN == 'Y') { ?>
								<tr>
									<TD></TD>
									<th scope="row"><label for="w12">어학시험</label></th>
									<td>
										<?=$SELECTBOX_LAN_IDX?>
									</td>
									
									<TD></TD>
									<th scope="row"></th>
									<td></td>
									
									<TD></TD>
									<th scope="row"></th>
									<td></td>
								</tr>
								<? } ?>
								
							</tbody>
						</table>
						<div class="txtC mgt10">
							<label class="error" for="SCH_ERR_MSG" generated="true" style="display:none;color:red;">error message</label>	
						</div>	
						<div class="txtC mgt10">
							<input type="submit" id="SUBMIT_BUTTON" style="display:none;" />
							<span class="btn02"><a href="#">조건초기화</a></span>
							<span class="btn01"><a href="javascript:goProcess('SEARCH');">검색</a></span>
						</div>						
					</div>

					<!-- S: 검색 -->
					<div id="Bd-top-sch">
						<div class="page">
							검색결과 수 :<span class="orange bold mgr10"><?=number_format($rowCount)?> 명</span>
							<span class="btn04"><a href="javascript:goProcess('excel');">엑셀다운로드</a></span>
						</div>
						<div class="sch">
							<span class="btn04"><a href="javascript:selChecked();">전체 선택</a></span>
							<span class="btn04"><a href="#">인쇄</a></span>
							<span class="btn04"><a href="#">메일 발송</a></span>
							<span class="btn04"><a href="#">SMS 발송</a></span>
						</div>
					</div>
					<!-- E: 검색 -->
</form>

					<ul class="tabStyle02">
						<li <? if (!$STEP_IDX) echo 'class="on"'; ?>><a href="javascript:actStep('');">지원자전체</a></li>
						<? foreach ($stepData as $key => $data) { ?>
						<li <? if ($STEP_IDX == $data->CODE) echo 'class="on"'; ?>><a href="javascript:actStep(<?=$data->CODE?>);"><?=$data->NAME?></a></li>
					  <? } ?>
					</ul>

					<table id="BdList-Type01" summary="목록">
						<caption>목록</caption>
						<colgroup>
							<col width="60px" />
							<col width="12%" />
							<col width="10%" />
							<col width="10%" />
							<col width="10%" />
							<col width="5%" />
							<col width="5%" />
							<col width="5%" />
							<col width="*" />
							<col width="*" />
							<col width="*" />
							<col width="*" />
							<col width="*" />
							<col width="*" />
						</colgroup>
						<thead>
							<tr>
								<th scope="col" class="first">선택</th>
								<th scope="col">지원분야(지역)</th>
								<th scope="col">접수번호</th>
								<th scope="col">지원일자</th>
								<th scope="col">성명</th>
								<th scope="col">성별</th>
								<th scope="col">나이</th>
								<? if ($rsmDataUseYn[0]->CAREER_USE_YN == 'Y') { ?>
								<th scope="col">경력</th>
								<? } ?>
								<? if ($rsmDataUseYn[0]->SCHOOL_USE_YN == 'Y') { ?>
								<th scope="col">최종학교</th>
								<th scope="col">전공</th>
								<? } ?>
								<th scope="col">보기</th>
								<th scope="col">수정</th>
								<th scope="col">이력</th>
								<th scope="col">초기</th>
							</tr>
						</thead>
						<tbody>
						<? if (count($appList) > 0 ) { ?>
						<? foreach ($appList as $key => $data) { ?>
							<tr>
								<td><input id="APP_LIST<?=$key?>" name="APP_LIST<?=$key?>" class="checkbox" type="checkbox" value="<?=$data->APPLY_NO?>" /></td>
								<td><?=$data->UNIT_NM?> <?=$data->WRK_PLC_NM != '' ? '( ' . $data->WRK_PLC_NM . ' )' : ''; ?></td>
								<td><?=$data->APPLY_NO?></td>
								<td><?=$data->APPL_DT?></td>
								<td><?=$data->NAMEKOR?></td>
								<td><?=$data->SEX_NM?></td>
								<td><?=$data->NAI?></td>
								<? if ($rsmDataUseYn[0]->CAREER_USE_YN == 'Y') { ?>
								<td><?=$data->CAREER_SUM_YEAR?>년 <?=$data->CAREER_SUM_MONTH?>개월</td>
								<? } ?>
								<? if ($rsmDataUseYn[0]->SCHOOL_USE_YN == 'Y') { ?>
								<td><?=$data->SCH_NM?></td>
								<td><?=$data->SCH_MAJOR_NM?></td>
								<? } ?>
								<td><span class="btn04"><a href="javascript:goView('<?=$data->APPLY_NO?>');">보기</a></span></td>
								<td><span class="btn04"><a href="javascript:goModify('<?=$data->APPLY_NO?>');">수정</a></span></td>
								<td><span class="btn04"><a href="javascript:goHistory('<?=$data->APPLY_NO?>');">이력</a></span></td>
								<td><span class="btn04"><a href="javascript:goPassword('<?=$data->APPL_IDX?>');">초기</a></span></td>
							</tr>
							<? 
							} 
							} else {
							?>
							<tr>
								<td colspan="14" class="no-data">해당 데이터가 없습니다.</td>
							</tr>
							<? } ?>
						</tbody>
					</table>

					<div class="txtR mgt10">
						
						<label for="sch_item" class="labSty01">선택한 지원자를</label>
						<?=$SELECTBOX_STEP?>
						<span class="btn04"><a href="javascript:actApplyMoveStep();">이동</a></span>
					</div>

					<!-- S: 페이징 -->
					<div id="Paging">
						<div id="Page-Index">
						<?=$paging?>
						</div>
					</div>
					<!--// E: 페이징 -->