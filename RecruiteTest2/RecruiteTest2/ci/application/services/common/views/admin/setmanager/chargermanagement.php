<!-- S: 검색 -->
<script language="javascript" src="/assets/js/jquery.validate.js"></script>
<script>
	
	function bodyOnLoad()
	{
		
		$("#top-sch").validate({  
				groups:{SCH_MSG:"SCH_KEY SCH_TYPE"},
		    rules: {  
		      SCH_KEY:{required:function(element) { if ($("#SCH_TYPE option:selected").val() != '' ) return true; else return false; } },
		      SCH_TYPE:{required:function(element) { if ($("#SCH_KEY").val() != '' ) return true; else return false; } }
		    },  
		    onkeyup:false,
		    messages: {
		    		SCH_KEY:{required:"검색어를 입력하세요."},
		    		SCH_TYPE:{required:"검색구분을 선택하세요."}
		    },
		    submitHandler: function(form) { 
				
	    	form.submit();

	    	}
   	});  
		
	}
	
</script>
					<div id="Bd-top-sch">
						<div class="page">
							Total <span class="orange bold"><?=number_format($rowCount)?></span> (<strong><?=$cur_page?></strong>/<?=$allPage?> page)
						</div>
						<div class="sch">
							<form id="top-sch" name="top-sch" action="/admin/chargerManagement" method="get" >
								<fieldset>
									<legend>게시물 검색</legend>
										
										
										<?=$SELECTBOX_SCH_TYPE?>
										
										<input type="text" name="SCH_KEY" id="SCH_KEY" value="<?=$SCH_KEY?>" title="검색어입력" />
										<input class="image" type="image" src="../assets/img/btn/btn_search.gif" alt="검색" />
								</fieldset>
								
							</form>
						</div>
					</div>
					<!-- E: 검색 -->

					<!-- S: 게시물리스트 -->
					<table id="BdList-Type01" summary="제목 링크를 통해서 게시물 상세 내용으로 이동합니다.">
						<caption>목록</caption>
						<colgroup>
							<col width="60px" />
							<col width="10%" />
							<col width="10%" />
							<col width="10%" />
							<col width="80px" />
							<col width="10%" />
							<col width="10%" />
							<col width="*" />	
							<col width="*" />	
							<col width="80px" />
							<col width="75px" />
						</colgroup>
						<thead>
							<tr>
								<th scope="col" class="first">번호</th>
								<th scope="col">구분</th>
								<th scope="col">ID</th>
								<th scope="col">담당자</th>
								<th scope="col">부서</th>
								<th scope="col">직함</th>
								<th scope="col">전화번호</th>
								<th scope="col">핸드폰</th>
								<th scope="col">이메일</th>
								<th scope="col">등록일</th>
								<th scope="col">사용여부</th>
							</tr>
						</thead>
						<tbody>
						<? 
							if ( $mngInfoCount > 0 ) { 
						 	foreach ( $adminList as $key => $data){
						 ?>
							<tr>
								<td><?=$data->ROW_NUM?></td>
								<td><?=$data->MANAGER_TP?></td>
								<td><?=$data->MANAGER_ID?></td>
								<td><a onclick="javascript:goLink('/admin/chargerManagement/modifyManager?manager_id=<?=$data->MANAGER_ID?>','pop','width=520 height=572')" style="cursor:hand;"><?=$data->MANAGER_NM?></a></td>
								<td><?=$data->DEPT?></td>
								<td><?=$data->PSTN?></td>
								<td><?=$data->TEL?></td>
								<td><?=$data->MOBILE?></td>
								<td><?=$data->EMAIL?></td>
								<td><?=$data->REG_DT?></td>
								<td><?=$data->USE_YN == 'Y' ? '<span class="ico01"><span>사용</span></span>' : '<span class="ico02"><span>중지</span></span>';?></td>
							</tr>
					 		<? 
					 	  }
					 	
					 	  } else {
					 	  ?>
							<tr>
								<td colspan="11" class="no-data">해당 데이터가 없습니다.</td>
							</tr>
							<?
							}
							?>
						</tbody>
					</table>
					<!--// E: 게시물리스트 -->

					

					<!-- S: 페이징 -->
					<div id="Paging">
						<div id="Page-Index"><?=$paging?></div>
							
						
					</div>
					<!--// E: 페이징 -->

					<div class="txtR">
						<span class="btn01"><a href="javascript:goLink('/admin/chargerManagement/registManager','pop','width=520 height=548')">계정 발급</a></span>
					</div>
					