				<!-- S: 작성 -->
					<table class="BdView-Type01" summary="게시물 제목, 번호, 작성자, 등록일, 조회수, 첨부파일 및 내용을 볼 수 있습니다.">
						<caption>게시글 상세보기</caption>
						<colgroup>
							<col width="110px" />
							<col width="105px" />
							<col width="110px" />
							<col width="*" />
						</colgroup>
						<tbody>
							<tr>
								<th scope="row" colspan="3">기업 명</th>
								<td><?=$cmpInfo[0]->COMP_NM?></td>
							</tr>
							<tr>
								<th scope="row" colspan="3">사용자 채용 URL</th>
								<td><a href="http://<?=$cmpInfo[0]->DOMAIN_ID?>.<?=MAIN_SERVICE_DOMAIN?>" target="_blank">http://<?=$cmpInfo[0]->DOMAIN_ID?>.<?=MAIN_SERVICE_DOMAIN?></a></td>
							</tr>
							<tr>
								<th scope="row" colspan="3">관리자 채용 URL</th>
								<td><a href="http://<?=$cmpInfo[0]->DOMAIN_ID?>.<?=MAIN_SERVICE_DOMAIN?>/admin" target="_blank">http://<?=$cmpInfo[0]->DOMAIN_ID?>.<?=MAIN_SERVICE_DOMAIN?>/admin</a></td>
							</tr>
							<tr>
								<th scope="row" colspan="3">사업자 등록번호</th>
								<td><?=$cmpInfo[0]->CMP_NO?></td>
							</tr>
							<tr>
								<th scope="row" colspan="3">대표자 정보</th>
								<td><?=$cmpInfo[0]->CEO_NM?></td>
							</tr>
							<tr>
								<th scope="row" colspan="3">대표 번호</th>
								<td><?=$cmpInfo[0]->CMP_TEL?></td>
							</tr>
							<tr>
								<th scope="row" colspan="3">팩스 번호</th>
								<td><?=$cmpInfo[0]->CMP_FAX?></td>
							</tr>
							<tr>
								<th scope="row" colspan="3">사업장 소재지</th>
								<td><?=$cmpInfo[0]->CMP_ADD?></td>
							</tr>
							<tr>
								<th scope="row" colspan="3">사업의 종류 - 업태</th>
								<td><?=$cmpInfo[0]->CMP_TP?></td>
							</tr>
							<tr>
								<th scope="row" colspan="3">사업의 종류 - 종목</th>
								<td><?=$cmpInfo[0]->CMP_GUBUN?></td>
							</tr>
							<tr>
								<th scope="row" colspan="3">
									
									<label for="w07">접수 사이트 TITLE</label>
								</th>
								<td>
									<?=$APPLY_SITE_TITLE?>
								
								</td>
							</tr>
							<tr>
								<th scope="row" colspan="3">
									
									<label for="w07">접수 사이트 템플릿</label>
								</th>
								<td>
									<img src="/assets/img/template_thumb/<?=$APPLY_SITE_TEMPLATE?>.jpg" />
									
								</td>
							</tr>
							<tr>
								<th scope="row" colspan="3">기업 LOGO 1.</th>
								<td><img src="<?=$LOGO_IMG1?>" width="203" height="36" /></td>
							</tr>
							<tr>
								<th scope="row" colspan="3">기업 LOGO 2.</th>
								<td><img src="<?=$LOGO_IMG2?>" width="203" height="36" /></td>
							</tr>
							<tr>
								<th scope="row" colspan="3">메인이미지</th>
								<td><img src="<?=$FRONT_MAIN_IMG?>" /></td>
							</tr>
							<tr>
								<th scope="row" colspan="3">서브이미지</th>
								<td><img src="<?=$FRONT_SUB_IMG?>" /></td>
							</tr>
							<tr>
								<th scope="row" colspan="3">등록일</th>
								<td><?=$cmpInfo[0]->REG_DT?></td>
							</tr>
							<tr>
								<th scope="row" colspan="3">Q&A 접수 메일 받기</th>
								<td><?=$cmpInfo[0]->QNA_MAIL == 'Y' ? '가능' : '불가능'?></td>
							</tr>
							<tr>
								<th scope="row" colspan="3">운영 현황</th>
								<td><?=$cmpInfo[0]->SRV_STS == 'Y' ? '운영' : '중지'?></td>
							</tr>
							<tr>
								<th scope="row" colspan="3">프로젝트 생성 가능</th>
								<td><?=$cmpInfo[0]->PRJ_MNG == 'Y' ? '가능' : '불가능'?></td>
							</tr>
							
						</tbody>
					</table>					
					<!--// E: 작성 -->

					<div class="txtC">
						<span class="btn01"><a href="javascript:goLink('/admin/companyManagement/ModifyCompanyInfo?company_id=<?=$cmpInfo[0]->COMP_ID?>');">수정</a></span>
						<span class="btn02"><a href="javascript:goLink('/admin/companyManagement?dd=d');">돌아가기</a></span>
					</div>
					
					
					<!-- S: 타이틀-->
				<div id="Title-box">
					<h1>기업 담당자</h1>
					
				</div>
				<!--// E: 타이틀-->

					

					<!-- S: 게시물리스트 -->
					<table id="BdList-Type01" summary="제목 링크를 통해서 게시물 상세 내용으로 이동합니다.">
						<caption>목록</caption>
						<colgroup>
							<col width="60px" />
							<col width="*" />
							<col width="*" />
							<col width="*" />
							<col width="*" />
							<col width="*" />
							<col width="*" />
							<col width="*" />
							<col width="*" />	
							<col width="*" />
							<col width="95px" />
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
								<th scope="col">휴대폰</th>
								<th scope="col">이메일</th>
								<th scope="col">등록일</th>
								<th scope="col">사용여부</th>
							</tr>
						</thead>
						<tbody>
						<? 
							if ( $mngInfoCount > 0 ) { 
						 	foreach ( $mngInfo as $key => $data){
						 ?>
							<tr>
								<td><?=($key+1)?></td>
								<td><?=$data->MANAGER_TP?></td>
								<td><?=$data->MANAGER_ID?></td>
								<td><?=$data->MANAGER_NM?></td>
								<td><?=$data->DEPT?></td>
								<td><?=$data->PSTN?></td>
								<td><?=$data->MOBILE?></td>
								<td><?=$data->MOBILE?></td>
								<td><?=$data->EMAIL?></td>
								<td><?=$data->REG_DT?></td>
								<td><?=$data->USE_YN == 'Y' ? '<span class="ico01"><span>가능</span></span>' : '<span class="ico02"><span>불가</span></span>'?></td>
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
					
					<br>
			
			
					<div class="txtR">
						<span class="btn01"><a href="javascript:goLink('/admin/chargerManagement');">기업 담당자 관리 바로 가기</a></span>
					</div>