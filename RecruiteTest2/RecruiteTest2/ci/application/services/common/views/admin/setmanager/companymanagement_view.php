<!-- S: 검색 -->
					<div id="Bd-top-sch">
						<div class="page">
							Total <span class="orange bold"><?=$rowCount?></span> (<strong><?=$cur_page?></strong>/<?=$allPage?> page)
						</div>
						<div class="sch">
							<form id="top-sch" name="top-sch" action="/admin/companyManagement" method="get">
								<fieldset>
									<legend>게시물 검색</legend>
										<label for="sch_item">검색항목</label>
										<?=$SELECTBOX_SCH_TYPE?>
										<label for="sch_key">검색어</label>
										<input type="text" name="SCH_KEY" id="SCH_KEY" value="<?=$SCH_KEY?>" title="검색어입력" />
										<input class="image" type="image" src="/assets/img/btn/btn_search.gif" alt="검색" />
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
							<col width="*" />
							<col width="*" />
							<col width="*" />
							<col width="100px" />	
							<col width="100px" />
							<col width="75px" />
						</colgroup>
						<thead>
							<tr>
								<th scope="col" class="first">번호</th>
								<th scope="col">기업명</th>
								<th scope="col">기업코드</th>
								<th scope="col">전화번호</th>
								<th scope="col">FAX</th>
								<th scope="col">사용자URL</th>
								<th scope="col">관리자URL</th>
								<th scope="col">QNAMAIL</th>
								<th scope="col">프로젝트</th>
								<th scope="col">운영여부</th>
							</tr>
						</thead>
						<tbody>
						<? 
							if ( $cmpListCount > 0 ) { 
						 	foreach ( $cmpList as $key => $data){
						 ?>
							<tr>
								<td><?=$data->ROW_NUM?></td>
								<td><a href="javascript:goLink('/admin/companyManagement/ViewCompanyInfo?company_id=<?=$data->COMP_ID?>');"><?=$data->COMP_NM?></a></td>
								<td><a href='#' onclick="goLink('/admin/companyManagement/ViewCompanyInfo?company_id=<?=$data->COMP_ID?>');"><?=$data->COMP_ID?></a></td>
								<td><?=$data->CMP_TEL?></td>
								<td><?=$data->CMP_FAX?></td>
								<td><a href="http://<?=$data->DOMAIN_ID?>.<?=MAIN_SERVICE_DOMAIN?>" target="_blank">http://<?=$data->DOMAIN_ID?>.<?=MAIN_SERVICE_DOMAIN?></a></td>
								<td><a href="http://<?=$data->DOMAIN_ID?>.<?=MAIN_SERVICE_DOMAIN?>/admin" target="_blank">http://<?=$data->DOMAIN_ID?>.<?=MAIN_SERVICE_DOMAIN?>/admin</a></td>
								<td><?=$data->QNA_MAIL == 'Y' ? '<span class="ico01"><span>가능</span></span>' : '<span class="ico02"><span>불가</span></span>'?></td>
								<td><?=$data->PRJ_MNG == 'Y' ? '<span class="ico01"><span>가능</span></span>' : '<span class="ico02"><span>불가</span></span>'?></td>
								<td><?=$data->SRV_STS == 'Y' ? '<span class="ico01"><span>운영</span></span>' : '<span class="ico02"><span>중지</span></span>'?></td>
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
						<span class="btn01"><a href="javascript:goLink('/admin/companyManagement/RegistCompanyInfo')" >기업 등록</a></span>
					</div>
					