<script language="javascript" src="/assets/js/jquery.validate.js"></script>
<script>
	
	function bodyOnLoad()
	{
			
			$("#button_cancel_show").attr("style","display:none");
			$("#form1").attr("method","post");
			$("#form1").attr("action","/admin/codeManagement/languageManagerProcess");
			$("#form1").validate({  
					groups: {
						COMMONGRP: "LAN_NM CD_IDX SCORE_TP"
					},
			    rules: {  
			      LAN_NM:{required:true},
			      CD_IDX:{required:true},
			      SCORE_TP:{required:true}
			    },  
			    onkeyup:false,
			    messages: {
			    		COMMONGRP:"빈항목을 채워주세요.",
			    		SCORE_TP:"점수,등급방식을 선택하세요",
			    		LAN_NM:"<?=$codeTitle?>명을 입력하세요.",
			    		CD_IDX:"구분을 선택하세요."
			    },
			    submitHandler: function(form) { 

		    	form.submit();

		    	}
	   	});  
	}
	function Process(mode)
	{
		if ($("#P_TYPE").val() == '') $("#P_TYPE").val('regist');		
		$("#submit_button").click();
	}
	
	function modifyProcess(code)
	{
		$("#button_cancel_show").attr("style","");
		$("#P_TYPE").val('modify');
		$("#LAN_IDX").val(code);
		
		$.ajax({
    url: "/admin/codeManagement/languageManagerData?LAN_IDX=" + $("#LAN_IDX").val(),
    type: "get",
    dataType:'json',
    //data: serializedData,
    success: function(response, textStatus, jqXHR){
     $("#LAN_NM").val(response['LAN_NM']);
     $("#LAN_PB").val(response['LAN_PB']);
     $("#CD_IDX").val(response['CD_IDX']);
     $("#SCORE_TP").val(response['SCORE_TP']);
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
	
	function cancel()
	{
		$("#P_TYPE").val('');
		$("#LAN_IDX").val('');
		$("#CD_IDX").val('');
		$("#LAN_NM").val('');
		$("#LAN_PB").val('');
		$("#button_cancel_show").attr("style","display:none");
	}
	
	function deleteProcess(code)
	{
		$("#P_TYPE").val('delete');
		$("#LAN_IDX").val(code);
		$("#submit_button").click();
	}
	
</script>
		<h2 class="H2blt"><?=$codeTitle?> 등록/수정</h2>
<form id="form1" name="form1">
<input type="hidden" name="P_TYPE" id="P_TYPE" />
<input type="hidden" name="LAN_IDX" id="LAN_IDX" />
<input type="hidden" name="h_sch_gubun" id="h_sch_gubun" value="<?=$sch_gubun?>" />
<input type="hidden" name="h_sch_lan_nm" id="h_sch_lan_nm" value="<?=$sch_lan_nm?>" />
<input type="hidden" name="h_per_page" id="h_per_page" value="<?=$per_page?>" />
					<div id="Sch-box">
						<div class="mgb10">
							<label for="s01">구분</label>
							<?=$SELECTBOX_CD_IDX?>
							<?=$SELECTBOX_SCORE_TP?>
							<label for="s02" class="mgl15"><?=$codeTitle?> 명</label>
							<input type="text" name="LAN_NM" id="LAN_NM" style="width:100px;"  class="required"  />
							<label for="s02" class="mgl15">발행</label>
							<input type="text" name="LAN_PB" id="LAN_PB" style="width:100px;"  />
						</div>
						<label class="error" for="COMMONGRP" generated="true" style="display:none;color:red;">error message</label>
						
						<p class="F11 mgb10 orange">※ 구분 등록의 경우 정보기술팀에 문의 부탁 드립니다.</p>
						
						<div class="txtC">
							<span class="btn01"><a id="id_btn_text" href="javascript:Process();">확인</a></span>
							<span class="btn02" id="button_cancel_show"><a href="javascript:cancel();">취소</a></span>
						</div>			
						
					</div>
					
					<input type="submit" style="display:none" id="submit_button" name="submit_button" />
</form>

	
						
					<h2 class="H2blt"><?=$codeTitle?> 목록</h2>
					<!-- S: 검색 -->
					<div id="Bd-top-sch">
						<div class="page">
							Total <span class="orange bold"><?=$rowCount?></span> (<strong><?=$per_page?></strong>/<?=$allPage?> page)
						</div>
						<div class="sch">
							<form id="top-sch" name="top-sch" method="get" action="/admin/codeManagement/languageManagerList">
								
								<fieldset>
									
									<legend>게시물 검색</legend>
									
										<label for="sch_item">검색항목</label>
										<?=$gubunList?>
										&nbsp;<?=$codeTitle?>명
										<label for="sch_key">검색어</label>
										<input type="text" name="sch_lan_nm" id="sch_lan_nm" title="검색어입력" style="width:100px" value="<?=$sch_lan_nm?>"/>
										<input class="image" type="image" src="/assets/img/btn/btn_search.gif" alt="검색" />
								</fieldset>
							</form>
						</div>
					</div>
					<!-- E: 검색 -->

					<table id="BdList-Type01" summary="목록">
						<caption>목록</caption>
						<colgroup>
							<col width="60px" />
							<col width="15%" />
							<col width="15%" />
							<col width="*" />
							<col width="*" />
							<col width="10%" />
							<col width="80px" />
							<col width="80px" />
						</colgroup>
						<thead>
							<tr>
								<th scope="col" class="first">번호</th>
								<th scope="col">구분</th>
								<th scope="col">점수/등급</th>
								<th scope="col"><?=$codeTitle?> 명</th>
								<th scope="col">발행처</th>
								<th scope="col">등록일</th>
								<th scope="col">수정</th>
								<th scope="col">삭제</th>				
							</tr>
						</thead>
						<tbody>
						<? 
							if ( count($rdata) > 0 ) { 
							foreach ($rdata as $key => $data) { 
						?>
							<tr>
								<td><?=$data->ROW_NUM?></td>
								<td><?=$data->CD_NM?></td>
								<td><?=$data->SCORE_TP?></td>
								<td><?=$data->LAN_NM?></td>
								<td><?=$data->LAN_PB?></td>
								<td><?=$data->REG_DT?></td>
								<td><span class="btn03"><a href="javascript:modifyProcess('<?=$data->LAN_IDX?>');">수정</a></span></td>
								<td><span class="btn04"><a href="javascript:deleteProcess('<?=$data->LAN_IDX?>');">삭제</a></span></td>
							</tr>
						<?} 
							
							} 
							else 
							{ ?>
							<tr>
								<td colspan="7" class="no-data">해당 데이터가 없습니다.</td>
							</tr>
						<? } ?>
						</tbody>
					</table>

					<!-- S: 페이징 -->
					<div id="Paging">
						<div id="Page-Index">
							<?=$paging?>
						</div>
					</div>
					<!--// E: 페이징 -->