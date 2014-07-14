<script language="javascript" src="/assets/js/jquery.validate.js"></script>
<script language="javascript" src="/assets/js/jquery-ui.js"></script>
<script language="javascript" src="/assets/js/dropdown/jquery.multiselect.filter.min.js"></script>
<script language="javascript" src="/assets/js/dropdown/jquery.multiselect.min.js"></script>
<link rel="stylesheet" type="text/css" href="/assets/css/jquery.multiselect.css" />
<link rel="stylesheet" type="text/css" href="/assets/css/jquery.multiselect.filter.css" />
<link rel="stylesheet" type="text/css" href="/assets/css/jqueryui.css" />
<script>
	var el = null;
	
	function bodyOnLoad()
	{
		$("#form1").validate({  
				groups:{
					
						PERSONAL_NAI:"PSNR_NAI_STDT1 PSNR_NAI_STDT2 PSNR_NAI_STDT3 PSNR_NAI_EDDT1 PSNR_NAI_EDDT2 PSNR_NAI_EDDT3",
						SCHOOL_DT:"SCHL_STDT1 SCHL_STDT2 SCT_CD",
						SCHOOL_SCORE:"SCHL_SCORE",
						ARMY_GRP:"ARMY_STDT1 ARMY_STDT2 ARMY_STDT3"
				},
		    rules: {
		    	UNIT_IDX:{required:true},
		    	PSNR_NAI_STDT1:{digits:true,min:1900,max:2020,required:function(element){ if ( $("#PSNR_NAI_STDT1").val() != '' || $("#PSNR_NAI_STDT2").val() != '' || $("#PSNR_NAI_STDT3").val() != '' ) return true; else return false; }},
		    	PSNR_NAI_STDT2:{digits:true,min:1,max:12,required:function(element){ if ( $("#PSNR_NAI_STDT1").val() != '' || $("#PSNR_NAI_STDT2").val() != '' || $("#PSNR_NAI_STDT3").val() != '' ) return true; else return false; }},
		    	PSNR_NAI_STDT3:{digits:true,min:1,max:31,required:function(element){ if ( $("#PSNR_NAI_STDT1").val() != '' || $("#PSNR_NAI_STDT2").val() != '' || $("#PSNR_NAI_STDT3").val() != '' ) return true; else return false; }},
		    	PSNR_NAI_EDDT1:{digits:true,min:1900,max:2020,required:function(element){ if ( $("#PSNR_NAI_EDDT1").val() != '' || $("#PSNR_NAI_EDDT2").val() != '' || $("#PSNR_NAI_EDDT3").val() != '' ) return true; else return false; }},
		    	PSNR_NAI_EDDT2:{digits:true,min:1,max:12,required:function(element){ if ( $("#PSNR_NAI_EDDT1").val() != '' || $("#PSNR_NAI_EDDT2").val() != '' || $("#PSNR_NAI_EDDT3").val() != '' ) return true; else return false; }},
		    	PSNR_NAI_EDDT3:{digits:true,min:1,max:31,required:function(element){ if ( $("#PSNR_NAI_EDDT1").val() != '' || $("#PSNR_NAI_EDDT2").val() != '' || $("#PSNR_NAI_EDDT3").val() != '' ) return true; else return false; }},
		    	SCHL_STDT1:{digits:true,min:1900,max:2020,required:function(element){ if ( $("#SCHL_STDT1").val() != '' || $("#SCHL_STDT2").val() != '' ) return true; else return false; }},
		    	SCHL_STDT2:{digits:true,min:1,max:12,required:function(element){ if ( $("#SCHL_STDT1").val() != '' || $("#SCHL_STDT2").val() != ''  ) return true; else return false; }},
		    	SCHL_SCORE:{digitsforfloat:true,max:4.5},
		    	ARMY_STDT1:{digits:true,min:1900,max:2020,required:function(element){ if ( $("#ARMY_STDT1").val() != '' || $("#ARMY_STDT2").val() != '' || $("#ARMY_STDT3").val() != '' ) return true; else return false; }},
		    	ARMY_STDT2:{digits:true,min:1,max:12,required:function(element){ if ( $("#ARMY_STDT1").val() != '' || $("#ARMY_STDT2").val() != '' || $("#ARMY_STDT3").val() != '' ) return true; else return false; }},
		    	ARMY_STDT3:{digits:true,min:1,max:31,required:function(element){ if ( $("#ARMY_STDT1").val() != '' || $("#ARMY_STDT2").val() != '' || $("#ARMY_STDT3").val() != '' ) return true; else return false; }}
		    },  
		    onkeyup:false,
		    messages: {
		    	UNIT_IDX:{required:"모집분야를 선택하세요"},
		    	PSNR_NAI_STDT1:{digits:"숫자만입력하세요",min:"년도를 확인하세요",max:"년도를 확인하세요",required:"기준연령 이후 기간을 확인하세요."},
		    	PSNR_NAI_STDT2:{digits:"숫자만입력하세요",min:"월을 확인하세요",max:"월을 확인하세요",required:"기준연령 이후 기간을 확인하세요."},
		    	PSNR_NAI_STDT3:{digits:"숫자만입력하세요",min:"일을 확인하세요",max:"일을 확인하세요",required:"기준연령 이후 기간을 확인하세요."}, 
		    	PSNR_NAI_EDDT1:{digits:"숫자만입력하세요",min:"년도를 확인하세요",max:"년도를 확인하세요",required:"기준연령 이전 기간을 확인하세요."},
		    	PSNR_NAI_EDDT2:{digits:"숫자만입력하세요",min:"월을 확인하세요",max:"월을 확인하세요",required:"기준연령 이전 기간을 확인하세요."}, 
		    	PSNR_NAI_EDDT3:{digits:"숫자만입력하세요",min:"일을 확인하세요",max:"일을 확인하세요",required:"기준연령 이전 기간을 확인하세요."},
		    	SCHL_STDT1:{digits:"숫자만입력하세요",min:"년도를 확인하세요",max:"년도를 확인하세요",required:"기준학력 기간을 확인하세요."},
		    	SCHL_STDT2:{digits:"숫자만입력하세요",min:"월을 확인하세요",max:"월을 확인하세요",required:"기준학력 기간을 확인하세요."},
		    	SCHL_SCORE:{digitsforfloat:"소숫점 둘째자리까지 입력하세요. 예)3.45",max:"4.5보다 높은점수는 입력할수없습니다."},
		    	ARMY_STDT1:{digits:"숫자만입력하세요",min:"년도를 확인하세요",max:"년도를 확인하세요",required:"병역 기간을 확인하세요."},
		    	ARMY_STDT2:{digits:"숫자만입력하세요",min:"월을 확인하세요",max:"월을 확인하세요",required:"병역 기간을 확인하세요."},
		    	ARMY_STDT3:{digits:"숫자만입력하세요",min:"일을 확인하세요",max:"일을 확인하세요",required:"병역 기간을 확인하세요."}
		    },
		    submitHandler: function(form) {  
				
	    	form.submit();
	    	
	    	}
   	});  
   	
   	// 언어시험부분 유효성검사
   	bodyOnLoadLanguage();	
   	
   	el = $("#SELECTED_UNIT_LIST").multiselect();
		//selected = $('#selected'),
		//newItem = $('#newItem');
   	
   	//alert(isDate('2010-05-01'));
   	//alert(isDate('2010-13-01'));
   	multiUnitList();
	}
	
	function bodyOnLoadLanguage()
	{
		<?
		// validate 가 씨바~ for문에 x변수를 ;;;;;;; 너무잘인식해서 작동을 안한다. 시바.
		if ($rsmDataUseYn[0]->LANGUAGE_USE_YN == 'Y') {
		foreach ($rsmDataLanguage as $key => $lanList)
		{
		?>
			
			$("#LAN_STDT1_<?=($key+1)?>").rules('add' , {digits:true,min:1900,max:2020,
																					required:function(element){ if ( $("#LAN_STDT1_<?=($key+1)?>").val() != '' || $("#LAN_STDT2_<?=($key+1)?>").val() != '' || $("#LAN_STDT3_<?=($key+1)?>").val() != '' ) return true; else return false; },
																					messages:{digits:"숫자만 입력가능합니다.",min:"년도를 확인하세요.",max:"년도를 확인하세요.",required:"취득일 시작기간을 확인하세요."}});	
			$("#LAN_STDT2_<?=($key+1)?>").rules('add' , {digits:true,min:1,max:12,
																					required:function(element){ if ( $("#LAN_STDT1_<?=($key+1)?>").val() != '' || $("#LAN_STDT2_<?=($key+1)?>").val() != '' || $("#LAN_STDT3_<?=($key+1)?>").val() != '' ) return true; else return false; },
																					messages:{digits:"숫자만 입력가능합니다.",min:"월을 확인하세요.",max:"월을 확인하세요.",required:"취득일 시작기간을 확인하세요."}});	
			$("#LAN_STDT3_<?=($key+1)?>").rules('add' , {digits:true,min:1,max:31,
																					required:function(element){ if ( $("#LAN_STDT1_<?=($key+1)?>").val() != '' || $("#LAN_STDT2_<?=($key+1)?>").val() != '' || $("#LAN_STDT3_<?=($key+1)?>").val() != '' ) return true; else return false; },
																					messages:{digits:"숫자만 입력가능합니다.",min:"일을 확인하세요.",max:"일을 확인하세요.",required:"취득일 시작기간을 확인하세요."}});	
			
			$("#LAN_EDDT1_<?=($key+1)?>").rules('add' , {digits:true,min:1900,max:2020,
																					required:function(element){ if ( $("#LAN_EDDT1_<?=($key+1)?>").val() != '' || $("#LAN_EDDT2_<?=($key+1)?>").val() != '' || $("#LAN_EDDT3_<?=($key+1)?>").val() != '' ) return true; else return false; },
																					messages:{digits:"숫자만 입력가능합니다.",min:"년도를 확인하세요.",max:"년도를 확인하세요.",required:"취득일 종료기간을 확인하세요."}});	
			$("#LAN_EDDT2_<?=($key+1)?>").rules('add' , {digits:true,min:1,max:12,
																					required:function(element){ if ( $("#LAN_EDDT1_<?=($key+1)?>").val() != '' || $("#LAN_EDDT2_<?=($key+1)?>").val() != '' || $("#LAN_EDDT3_<?=($key+1)?>").val() != '' ) return true; else return false; },
																					messages:{digits:"숫자만 입력가능합니다.",min:"월을 확인하세요.",max:"월을 확인하세요.",required:"취득일 종료기간을 확인하세요."}});	
			$("#LAN_EDDT3_<?=($key+1)?>").rules('add' , {digits:true,min:1,max:31,
																					required:function(element){ if ( $("#LAN_EDDT1_<?=($key+1)?>").val() != '' || $("#LAN_EDDT2_<?=($key+1)?>").val() != '' || $("#LAN_EDDT3_<?=($key+1)?>").val() != '' ) return true; else return false; },
																					messages:{digits:"숫자만 입력가능합니다.",min:"일을 확인하세요.",max:"일을 확인하세요.",required:"취득일 종료기간을 확인하세요."}});	

			//점수입력항목이 있으면			
			if (document.getElementById("SCORE_TP_<?=($key+1)?>"))
			{
				$("#SCORE_TP_<?=($key+1)?>").rules('add' , {digits:true,min:1,messages:{digits:"숫자만 입력가능합니다.",min:"점수를 확인하세요."}});	
				$("#form1").validate().groups["SCORE_TP_<?=($key+1)?>"] = 'LAN_GRP_MSG_<?=($key+1)?>';
			}
			
			$("#form1").validate().groups["LAN_STDT1_<?=($key+1)?>"] = 'LAN_GRP_MSG_<?=($key+1)?>';
			$("#form1").validate().groups["LAN_STDT2_<?=($key+1)?>"] = 'LAN_GRP_MSG_<?=($key+1)?>';
			$("#form1").validate().groups["LAN_STDT3_<?=($key+1)?>"] = 'LAN_GRP_MSG_<?=($key+1)?>';
			
			$("#form1").validate().groups["LAN_EDDT1_<?=($key+1)?>"] = 'LAN_GRP_MSG_<?=($key+1)?>';
			$("#form1").validate().groups["LAN_EDDT2_<?=($key+1)?>"] = 'LAN_GRP_MSG_<?=($key+1)?>';
			$("#form1").validate().groups["LAN_EDDT3_<?=($key+1)?>"] = 'LAN_GRP_MSG_<?=($key+1)?>';
		
			//x++;
		<?
		}
		}
		?>
			
	}
	
	function checkDateSet(code)
	{
		//모든날짜를 입력하게 되면 
		if ( $("#" + code + "1").val() != '' && $("#" + code + "2").val() != '' && $("#" + code + "3").val() != '' )
		{
			
			if (!isDate($("#" + code + "1").val() + '-' + $("#" + code + "2").val() + '-' + $("#" + code + "3").val()))
			{
				
				alert('날짜 형식이 맞지 않습니다.');
				$("#" + code + "1").val('');
				$("#" + code + "2").val('');
				$("#" + code + "3").val('');
				$("#" + code + "1").val('').focus();
				
			}
			
		}
	}
	
	function checkDateLanSet(code,seq)
	{
		//모든날짜를 입력하게 되면 
		if ( $("#" + code + "1" + '_' + seq).val() != '' && $("#" + code + "2" + '_' + seq).val() != '' && $("#" + code + "3" + '_' + seq).val() != '' )
		{
			
			if (!isDate($("#" + code + "1" + '_' + seq).val() + '-' + $("#" + code + "2" + '_' + seq).val() + '-' + $("#" + code + "3" + '_' + seq).val()))
			{
				
				alert('날짜 형식이 맞지 않습니다.');
				$("#" + code + "1" + '_' + seq).val('');
				$("#" + code + "2" + '_' + seq).val('');
				$("#" + code + "3" + '_' + seq).val('');
				$("#" + code + "1" + '_' + seq).val('').focus();
				
			}
			
		}
	}
	
	function goProcess()
	{
		$("#form1").attr("action","/admin/requireManagement/requireProcess");
		$("#form1").attr("method","post");
		$("#SUBMIT_BUTTON").click();
	}
	
	function selectUnitList(obj)
	{
		$("#form1").attr("action","/admin/requireManagement");
		$("#form1").attr("method","post");
		$("#form1").submit();
	}
	
	//해당 자격요건과 동일한 모집분야관련데이터를 위한 멀티셀렉터 체크해주는.
	//
	function multiUnitList()
	{
			var selvalue = $("#SAME_UNIT_LIST").val();
			var selvalueAr = selvalue.split('|');
			
			$("#SELECTED_UNIT_LIST").val(selvalueAr);
			$("#SELECTED_UNIT_LIST").multiselect('refresh');
	}
	
</script>

<form id="form1" name="form1" >
	<div class="btn_box">
						<div class="lefBox">
						현재 모집분야 : <?=$SELECTBOX_UNIT_IDX?>
						<label class="error" for="UNIT_IDX" generated="true" style="display:none;color:red;">error message</label>
						</div>
						<div class="rigBox">
						현재 자격요건과 동일한 모집분야 : <?=$SELECTBOX_SELECTED_UNIT_LIST?>
						</div>
					</div>

<input type="hidden" name="PRJ_IDX" id="PRJ_IDX" value="<?=$PRJ_IDX?>" />
<input type="hidden" name="RSM_IDX" id="RSM_IDX" value="<?=$RSM_IDX?>" />

<input type="hidden" name="SAME_UNIT_LIST" id="SAME_UNIT_LIST" value="<?=$SAME_UNIT_LIST?>" />

<table class="BdView-Type01" summary="자격요건 관리">
<caption>자격요건 관리</caption>
<colgroup>
<col width="110px" />
<col width="*" />

</colgroup>
					<thead>
					<tr>
						<th class="first">구분</th>
						<th>자격요건</th>
					</tr>
					</thead>
				<tbody>

<? 
/* 기본 신상정보를 이용할때 나오는 부분 */
if ($rsmDataUseYn[0]->PERSONAL_USE_YN == 'Y' ) { 
?>					
					<tr>
						<th scope="row">
							<label for="w03a">기준연령</label>
						</th>
						<td>
							<input type="text" name="PSNR_NAI_STDT1" id="PSNR_NAI_STDT1" maxlength="4" style="width:30px;" value="<?=$PSNR_NAI_STDT1?>" onblur="javascript:checkDateSet('PSNR_NAI_STDT');" /> 년 
							<input type="text" name="PSNR_NAI_STDT2" id="PSNR_NAI_STDT2" maxlength="2" style="width:20px;" value="<?=$PSNR_NAI_STDT2?>" onblur="javascript:setNum2str(this)&checkDateSet('PSNR_NAI_STDT');" /> 월 
							<input type="text" name="PSNR_NAI_STDT3" id="PSNR_NAI_STDT3" maxlength="2" style="width:20px;" value="<?=$PSNR_NAI_STDT3?>" onblur="javascript:setNum2str(this)&checkDateSet('PSNR_NAI_STDT');" /> 일 
							<strong>이후</strong>
							~ 
							<input type="text" name="PSNR_NAI_EDDT1" id="PSNR_NAI_EDDT1" maxlength="4" style="width:30px;" value="<?=$PSNR_NAI_EDDT1?>" onblur="javascript:checkDateSet('PSNR_NAI_EDDT');" /> 년 
							<input type="text" name="PSNR_NAI_EDDT2" id="PSNR_NAI_EDDT2" maxlength="2" style="width:20px;" value="<?=$PSNR_NAI_EDDT2?>" onblur="javascript:setNum2str(this)&checkDateSet('PSNR_NAI_EDDT');" /> 월 
							<input type="text" name="PSNR_NAI_EDDT3" id="PSNR_NAI_EDDT3" maxlength="2" style="width:20px;" value="<?=$PSNR_NAI_EDDT3?>" onblur="javascript:setNum2str(this)&checkDateSet('PSNR_NAI_EDDT');" /> 일 
							<strong>이전</strong>
							
							출생자
							<label class="error" for="PERSONAL_NAI" generated="true" style="display:none;color:red;">error message</label>	
						</td>
						
					</tr>
<? } ?>						

<? 
/* 학력사항을 사용할경우 나오는 부분 */
if ($rsmDataUseYn[0]->SCHOOL_USE_YN == 'Y' ) { 
?>
		<tr>
			<th scope="row">
			<label for="w01a">기준학력</label>
			</th>
			<td>
			<input type="text" name="SCHL_STDT1" id="SCHL_STDT1" value="<?=$SCHL_STDT1?>" maxlength="4" style="width:30px;" /> 년
			<input type="text" name="SCHL_STDT2" id="SCHL_STDT2" value="<?=$SCHL_STDT2?>" maxlength="2" style="width:20px;" onblur="javascript:setNum2str(this);" /> 월 이전 <span class="orange F11 mgr10">(해당월포함)</span>
			<?=$SELECTBOX_SCT_CD?>
			졸업(예정) 이상 <span class="F11">(학력판단의 기준이 되므로 반드시 입력)</span>
			<label class="error" for="SCHOOL_DT" generated="true" style="display:none;color:red;">error message</label>
			</td>
		</tr>
		
		<tr>
			<th scope="row">
			<label for="w02a">기준학점</label>
			</th>
			<td>
			<?=$SELECTBOX_SCHL_SCORE_TP?>
			(으)로
			<input type="text" name="SCHL_SCORE" id="SCHL_SCORE" title="학점 입력" value="<?=$SCHL_SCORE?>" style="width:30px;" />
			/4.5 (기준만점) 이상
			<label class="error" for="SCHOOL_SCORE" generated="true" style="display:none;color:red;">error message</label>
			</td>
		
		</tr>
		
<? } ?>						

<? 
/* 군대항목을 사용할경우 나오는 부분 */
if ($rsmDataUseYn[0]->ARMY_USE_YN == 'Y' ) { 
?>
			
				
					<tr>
						<th scope="row">
							<label for="w06a">기준병역</label>
						</th>
						<td>
							미필자 포함, 
							<input type="text" name="ARMY_STDT1" id="ARMY_STDT1" maxlength="4" style="width:30px;" value="<?=$ARMY_STDT1?>"  onblur="javascript:checkDateSet('ARMY_STDT');" /> 년 
							<input type="text" name="ARMY_STDT2" id="ARMY_STDT2" maxlength="2" style="width:20px;" value="<?=$ARMY_STDT2?>"  onblur="javascript:setNum2str(this)&checkDateSet('ARMY_STDT');" /> 월 
							<input type="text" name="ARMY_STDT3" id="ARMY_STDT3" maxlength="2" style="width:20px;" value="<?=$ARMY_STDT3?>"  onblur="javascript:setNum2str(this)&checkDateSet('ARMY_STDT');" /> 일 
							이후 제대자는 자격미달 <span class="orange F11">(해당년월일 포함)</span>
							<label class="error" for="ARMY_GRP" generated="true" style="display:none;color:red;">error message</label>
						</td>
						
					</tr>
<?
}
?>
				</tbody>
			</table>

<? 
/* 언어시험 사용할경우 나오는 부분 */
if ($rsmDataUseYn[0]->LANGUAGE_USE_YN == 'Y' ) { 
?>
			<input type="hidden" id="LANGUAGE_LIST_COUNT" name="LANGUAGE_LIST_COUNT" value="<?=count($rsmDataLanguage)?>" />
			<table class="BdView-Type01" summary="자격요건 관리">
				<caption>자격요건 관리</caption>
				<colgroup>
					<col width="60px" />
					<col width="120px" />
					<col width="160px" />
					<col width="*" />
					
				</colgroup>
				<thead>
					<tr>
						<th class="first">종류</th>
						<th>시험명</th>
						<th>점수</th>
						<th>취득일 (해당년월일 포함) 이전 이후</th>
						
					</tr>
				</thead>
				<tbody>
				<?
					foreach ($rsmDataLanguage as $key => $lanList)
					{
				?>
					<tr>
						<th scope="row"><label for="s01a"><?=$lanList->LANG_TP_NM?></label></th>
						<td><span class="bold"><?=$lanList->LAN_NM?></span></td>
						<td><?=${'SELECTBOX_LAN_LVL_IDX_' . ($key + 1)}?>
								<? if (preg_match('/^13|15$/' , $lanList->SCORE_TP)) { ?>
								<input type="text" size="5" id="SCORE_TP_<?=($key+1)?>" name="SCORE_TP_<?=($key+1)?>" value="<?=${'SCORE_TP_' . ($key+1)}?>"  />
								<? } ?>이상
						<td>
							<input type="hidden" name="LAN_IDX_<?=($key+1)?>" id="LAN_IDX_<?=($key+1)?>" value="<?=$lanList->LAN_IDX?>" />
							<input type="text" name="LAN_STDT1_<?=($key+1)?>" id="LAN_STDT1_<?=($key+1)?>" value="<?=${'LAN_STDT1_' . ($key+1)}?>" maxlength="4" style="width:30px;" onblur="javascript:checkDateLanSet('LAN_STDT','<?=($key+1)?>');" /> 년 
							<input type="text" name="LAN_STDT2_<?=($key+1)?>" id="LAN_STDT2_<?=($key+1)?>" value="<?=${'LAN_STDT2_' . ($key+1)}?>" maxlength="2" style="width:20px;" onblur="javascript:setNum2str(this)&checkDateLanSet('LAN_STDT','<?=($key+1)?>');" /> 월 
							<input type="text" name="LAN_STDT3_<?=($key+1)?>" id="LAN_STDT3_<?=($key+1)?>" value="<?=${'LAN_STDT3_' . ($key+1)}?>" maxlength="2" style="width:20px;" onblur="javascript:setNum2str(this)&checkDateLanSet('LAN_STDT','<?=($key+1)?>');" /> 일 <strong>이후</strong> ~ 
							<input type="text" name="LAN_EDDT1_<?=($key+1)?>" id="LAN_EDDT1_<?=($key+1)?>" value="<?=${'LAN_EDDT1_' . ($key+1)}?>" maxlength="4" style="width:30px;" onblur="javascript:checkDateLanSet('LAN_EDDT','<?=($key+1)?>');" /> 년 
							<input type="text" name="LAN_EDDT2_<?=($key+1)?>" id="LAN_EDDT2_<?=($key+1)?>" value="<?=${'LAN_EDDT2_' . ($key+1)}?>" maxlength="2" style="width:20px;" onblur="javascript:setNum2str(this)&checkDateLanSet('LAN_EDDT','<?=($key+1)?>');" /> 월 
							<input type="text" name="LAN_EDDT3_<?=($key+1)?>" id="LAN_EDDT3_<?=($key+1)?>" value="<?=${'LAN_EDDT3_' . ($key+1)}?>" maxlength="2" style="width:20px;" onblur="javascript:setNum2str(this)&checkDateLanSet('LAN_EDDT','<?=($key+1)?>');" /> 일 <strong>이전</strong>
							<label class="error" for="LAN_GRP_MSG_<?=($key+1)?>" generated="true" style="display:none;color:red;">error message</label>
						</td>

					</tr>
				<?
					}
				?>
				</tbody>
			</table>
<?
}
?>
			<div class="txtC">
				<span class="btn01"><a href="javascript:goProcess();">확인</a></span>
				<span class="btn02"><a href="javascript:window.close();">닫기</a></span>
			</div>
<input type="submit" id="SUBMIT_BUTTON" style="display:none"/>
</form>