<!-- S: 검색 -->
					<div id="Bd-top-sch">
						<div class="page">
							Total <span class="orange bold"><?=$rowCount?></span> (<strong><?=$per_page?></strong>/<?=$allPage?> page)
						</div>
						<div class="sch">
						
						</div>
					</div>
					<!-- E: 검색 -->

					<!-- S: 게시물리스트 -->
					<table id="BdList-Type01" summary="제목 링크를 통해서 게시물 상세 내용으로 이동합니다.">
						<caption>목록</caption>
						<colgroup>
							<col width="60px" />
							<col width="60px" />
							<col width="10%" />
							<col width="10%" />
							<col width="10%" />
							<col width="80px" />
							<col width="10%" />
							<col width="10%" />
							<col width="*" />	
							<col width="80px" />
							<col width="75px" />
						</colgroup>
						<thead>
							<tr>
								<th scope="col" class="first">선택</th>
								<th scope="col" >번호</th>
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
							if ( $rowCount > 0 ) { 
						 	foreach ( $adminList as $key => $data){
						 ?>
							<tr>
								<td><input id="MANAGER_LIST<?=$key?>" name="MANAGER_LIST<?=$key?>" class="checkbox" type="checkbox" value="<?=$data->MANAGER_ID?>" /></td>
								<td><?=$data->ROW_NUM?></td>
								<td><?=$data->MANAGER_ID?></td>
								<td><a onclick="javascript:goLink('/admin/adminManagement/modifyManager?manager_id=<?=$data->MANAGER_ID?>','pop','width=520 height=536')" style="cursor:hand;"><?=$data->MANAGER_NM?></a></td>
								<td><?=$data->DEPT?></td>
								<td><?=$data->PSTN?></td>
								<td><?=$data->TEL?></td>
								<td><?=$data->MOBILE?></td>
								<td><?=$data->EMAIL?></td>
								<td><?=$data->REG_DT?></td>
								<td><?=$data->USE_YN == 'Y' ? '<span class="ico01"><span>사용</span></span>' : '<span class="ico02"><span>중지</span></span>' ?></td>
							</tr>
					 		<? 
					 	  }
					 	
					 	  } else {
					 	  ?>
							<tr>
								<td colspan="10" class="no-data">해당 데이터가 없습니다.</td>
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
					    <span class="btn01"><a href="javascript:delCheckedManager()" >선택 계정삭제(구현예정)</a></span>
						&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						<span class="btn01"><a href="javascript:goLink('/admin/adminManagement/registManager','pop','width=520 height=508')" >최고 관리자 계정 발급</a></span>
					</div>
					

					<script>
					    // define gloval vars						
						var sourceArr = new Array;
						$(document).ready(function() {   
							$('input:checkbox').change( function() {
									var id = $(this).attr('id');
									var isChecked = $(this).is(':checked');
									if(isChecked){
										sourceArr.splice(sourceArr.length,1,id);
									}									
								}
							);
						});

						function delCheckedManager(){
							alert('선택 계정 삭제:구현예정\n Checked Value : '+sourceArr);		
							//Ajax Process 

						}
					</script>