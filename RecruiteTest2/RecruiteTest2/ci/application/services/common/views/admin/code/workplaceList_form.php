<script language="javascript" src="/assets/js/jquery.validate.js"></script>
<script>
	
	function bodyOnLoad()
	{
			
			$("#button_cancel_show").attr("style","display:none");
			$("#form1").attr("method","post");
			$("#form1").attr("action","/admin/codeManagement/workplaceManagerProcess");
			$("#form1").validate({  
					
			    rules: {  
			      WRK_PLC_NM:{required:true}
			    },  
			    onkeyup:false,
			    messages: {
			    		WRK_PLC_NM:"근무지를 입력하세요."
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
		$("#WP_IDX").val(code);
		
		$.ajax({
    url: "/admin/codeManagement/workplaceManagerData?WP_IDX=" + $("#WP_IDX").val(),
    type: "get",
    dataType:'json',
    //data: serializedData,
    success: function(response, textStatus, jqXHR){
    
     $("#WRK_PLC_NM").val(response['WRK_PLC_NM']);
 
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
		$("#WP_IDX").val('');
		$("#WRK_PLC_NM").val('');
		$("#button_cancel_show").attr("style","display:none");
	}
	
	function deleteProcess(code)
	{
		$("#P_TYPE").val('delete');
		$("#WRK_PLC_NM").val(code);
		$("#submit_button").click();
	}
	
</script>
		<h2 class="H2blt"><?=$codeTitle?> 등록/수정</h2>
<form id="form1" name="form1">
<input type="hidden" name="P_TYPE" id="P_TYPE" />
<input type="hidden" name="WP_IDX" id="WP_IDX" />
<input type="hidden" name="h_sch_wrk_plc_nm" id="h_sch_wrk_plc_nm" value="<?=$sch_wrk_plc_nm?>" />
<input type="hidden" name="h_per_page" id="h_per_page" value="<?=$per_page?>" />
					<div id="Sch-box">
						<div class="mgb10">
							<label for="s02" class="mgl15">근무지 명</label>
							<input type="text" name="WRK_PLC_NM" id="WRK_PLC_NM" style="width:100px;"  class="required"  />
						</div>
						<label class="error" for="WRK_PLC_NM" generated="true" style="display:none;color:red;">error message</label>
						
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
							<form id="top-sch" name="top-sch" method="get" action="/admin/codeManagement/workplaceManagerList">
								
								<fieldset>
									
									<legend>게시물 검색</legend>
									
										<label for="sch_item">검색항목</label>
										
										&nbsp;<?=$codeTitle?>명
										<label for="sch_key">검색어</label>
										<input type="text" name="sch_wrk_plc_nm" id="sch_wrk_plc_nm" title="검색어입력" style="width:100px" value="<?=$sch_wrk_plc_nm?>"/>
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
							
								<td><?=$data->WRK_PLC_NM?></td>
								
								<td><?=$data->REG_DT?></td>
								<td><span class="btn03"><a href="javascript:modifyProcess('<?=$data->WP_IDX?>');">수정</a></span></td>
								<td><span class="btn04"><a href="javascript:deleteProcess('<?=$data->WP_IDX?>');">삭제</a></span></td>
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