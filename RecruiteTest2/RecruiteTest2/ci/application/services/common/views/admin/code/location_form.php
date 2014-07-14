<script language="javascript" src="/assets/js/jquery.validate.js"></script>
<script>
	
	function bodyOnLoad()
	{
			
			$("#button_cancel_show").attr("style","display:none");
			$("#form1").attr("method","post");
			$("#form1").attr("action","/admin/codeManagement/majorLocationManagerProcess");
			$("#form1").validate({  
					groups: {
						COMMONGRP: "LOC_NM"
					},
			    rules: {  
			      LOC_NM:{required:true}
			    },  
			    onkeyup:false,
			    messages: {
			    		COMMONGRP:"빈항목을 채워주세요.",
			    		LOC_NM:"<?=$codeTitle?>명을 입력하세요."
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
		$("#LOC_IDX").val(code);
		
		$.ajax({
    url: "/admin/codeManagement/majorLocationManagerData?LOC_IDX=" + $("#LOC_IDX").val(),
    type: "get",
    dataType:'json',
    //data: serializedData,
    success: function(response, textStatus, jqXHR){
    
     $("#LOC_NM").val(response['LOC_NM']);
     
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
		$("#LOC_IDX").val('');
	
		$("#LOC_NM").val('');
		$("#button_cancel_show").attr("style","display:none");
	}
	
	function deleteProcess(code)
	{
		$("#P_TYPE").val('delete');
		$("#LOC_IDX").val(code);
		$("#submit_button").click();
	}
	
</script>
		<h2 class="H2blt"><?=$codeTitle?> 등록/수정</h2>
<form id="form1" name="form1">
<input type="hidden" name="P_TYPE" id="P_TYPE" />
<input type="hidden" name="LOC_IDX" id="LOC_IDX" />
<input type="hidden" name="h_sch_loc_nm" id="h_sch_loc_nm" value="<?=$sch_loc_nm?>" />
<input type="hidden" name="h_per_page" id="h_per_page" value="<?=$per_page?>" />
					<div id="Sch-box">
						<div class="mgb10">
							<label for="s01">구분</label>
						
							<label for="s02" class="mgl15"><?=$codeTitle?> 명</label>
							<input type="text" name="LOC_NM" id="LOC_NM" style="width:100px;"  class="required"  />
						</div>
						<label class="error" for="COMMONGRP" generated="true" style="display:none;color:red;">error message</label>
						
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
							<form id="top-sch" name="top-sch" method="get" action="/admin/codeManagement/majorLocationManagerList">
								
								<fieldset>
									
									<legend>게시물 검색</legend>
									
										<label for="sch_item">검색항목</label>
										
										&nbsp;<?=$codeTitle?>명
										<label for="sch_key">검색어</label>
										<input type="text" name="sch_loc_nm" id="sch_loc_nm" title="검색어입력" style="width:100px" value="<?=$sch_loc_nm?>"/>
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
							<col width="*" />
						

							<col width="10%" />
							<col width="80px" />
							<col width="80px" />
						</colgroup>
						<thead>
							<tr>
								<th scope="col" class="first">번호</th>
								
								<th scope="col"><?=$codeTitle?> 명</th>
		
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
							
								<td><?=$data->LOC_NM?></td>
								
								<td><?=$data->REG_DT?></td>
								<td><span class="btn03"><a href="javascript:modifyProcess('<?=$data->LOC_IDX?>');">수정</a></span></td>
								<td><span class="btn04"><a href="javascript:deleteProcess('<?=$data->LOC_IDX?>');">삭제</a></span></td>
							</tr>
						<?} 
							
							} 
							else 
							{ ?>
							<tr>
								<td colspan="5" class="no-data">해당 데이터가 없습니다.</td>
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