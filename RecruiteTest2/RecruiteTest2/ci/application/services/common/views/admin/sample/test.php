	<!-- S: 검색 -->
					<div id="Bd-top-sch">
						<div class="btn">
							<span class="btn01"><a href="#">전체 기업 프로젝트 현황 보기<?=$loginid?></a></span>
						</div>
						<div class="sch">
							<form id="top-sch" name="top-sch" action="#" method="post">
								<fieldset>
									<legend>게시물 검색</legend>
										<label for="sch_item">검색항목</label>
										<select name="sch_item" id="sch_item" >
											<option value="">기업명</option>
										</select>
										<label for="sch_key">검색어</label>
										<input type="text" name="sch_key" id="sch_key" title="검색어입력" />
										<input class="image" type="image" src="../assets/img/btn/btn_search.gif" alt="검색" />
								</fieldset>
							</form>
						</div>
					</div>
					<!-- E: 검색 -->

					<!-- S: 게시물리스트 -->
					<div id="CompanyList">
						<ul>
							<li>
								<dl>
									<dt><a href="#">㈜커리어케어</a></dt>
									<!-- 이미지사이즈 200*100 -->
									<dd class="logo"><a href="#"><img src="../assets/img/content/sum_company.gif" alt="기업로고이미지" /></a></dd>
									<dd>진행중인 프로젝트 1 건 (3)</dd>
									<dd><a href="#"><img src="../assets/img/btn/btn_job_page.gif" alt="사용자 채용 접수 페이지 바로가기" /></a></dd>
								</dl>
							</li>
							<li>
								<dl>
									<dt><a href="#">㈜커리어케어</a></dt>
									<!-- 이미지사이즈 200*100 -->
									<dd class="logo"><a href="#"><img src="../assets/img/content/sum_company.gif" alt="기업로고이미지" /></a></dd>
									<dd>진행중인 프로젝트 1 건 (3)</dd>
									<dd><a href="#"><img src="../assets/img/btn/btn_job_page.gif" alt="사용자 채용 접수 페이지 바로가기" /></a></dd>
								</dl>
							</li>
							<li>
								<dl>
									<dt><a href="#">㈜커리어케어</a></dt>
									<!-- 이미지사이즈 200*100 -->
									<dd class="logo"><a href="#"><img src="../assets/img/content/sum_company.gif" alt="기업로고이미지" /></a></dd>
									<dd>진행중인 프로젝트 1 건 (3)</dd>
									<dd><a href="#"><img src="../assets/img/btn/btn_job_page.gif" alt="사용자 채용 접수 페이지 바로가기" /></a></dd>
								</dl>
							</li>
							<li>
								<dl>
									<dt><a href="#">㈜커리어케어</a></dt>
									<!-- 이미지사이즈 200*100 -->
									<dd class="logo"><a href="#"><img src="../assets/img/content/sum_company.gif" alt="기업로고이미지" /></a></dd>
									<dd>진행중인 프로젝트 1 건 (3)</dd>
									<dd><a href="#"><img src="../assets/img/btn/btn_job_page.gif" alt="사용자 채용 접수 페이지 바로가기" /></a></dd>
								</dl>
							</li>
							<li>
								<dl>
									<dt><a href="#">㈜커리어케어</a></dt>
									<!-- 이미지사이즈 200*100 -->
									<dd class="logo"><a href="#"><img src="../assets/img/content/sum_company.gif" alt="기업로고이미지" /></a></dd>
									<dd>진행중인 프로젝트 1 건 (3)</dd>
									<dd><a href="#"><img src="../assets/img/btn/btn_job_page.gif" alt="사용자 채용 접수 페이지 바로가기" /></a></dd>
								</dl>
							</li>
							<li>
								<dl>
									<dt><a href="#">㈜커리어케어</a></dt>
									<!-- 이미지사이즈 200*100 -->
									<dd class="logo"><a href="#"><img src="../assets/img/content/sum_company.gif" alt="기업로고이미지" /></a></dd>
									<dd>진행중인 프로젝트 1 건 (3)</dd>
									<dd><a href="#"><img src="../assets/img/btn/btn_job_page.gif" alt="사용자 채용 접수 페이지 바로가기" /></a></dd>
								</dl>
							</li>
							<li>
								<dl>
									<dt><a href="#">㈜커리어케어</a></dt>
									<!-- 이미지사이즈 200*100 -->
									<dd class="logo"><a href="#"><img src="../assets/img/content/sum_company.gif" alt="기업로고이미지" /></a></dd>
									<dd>진행중인 프로젝트 1 건 (3)</dd>
									<dd><a href="#"><img src="../assets/img/btn/btn_job_page.gif" alt="사용자 채용 접수 페이지 바로가기" /></a></dd>
								</dl>
							</li>
							<li>
								<dl>
									<dt><a href="#">㈜커리어케어</a></dt>
									<!-- 이미지사이즈 200*100 -->
									<dd class="logo"><a href="#"><img src="../assets/img/content/sum_company.gif" alt="기업로고이미지" /></a></dd>
									<dd>진행중인 프로젝트 1 건 (3)</dd>
									<dd><a href="#"><img src="../assets/img/btn/btn_job_page.gif" alt="사용자 채용 접수 페이지 바로가기" /></a></dd>
								</dl>
							</li>
						</ul>
					</div>
					<!--// E: 게시물리스트 -->
<?=var_dump($res)?>
					<!-- S: 페이징 -->
					<div id="Paging">
						<div id="Page-Index">
							<a href="#"><img src="../assets/img/btn/btn_list_first.gif" alt="맨처음 페이지이동" /></a><a href="#"><img src="../assets/img/btn/btn_list_prev.gif" alt="이전 5개 페이지이동" /></a>
							<span>
								<a href="#" class="on">1</a>	
								<a href="#">2</a>	
								<a href="#">3</a>	
								<a href="#">4</a>	
								<a href="#">5</a>	
								<a href="#">6</a>	
								<a href="#">7</a>
								<a href="#">8</a>
								<a href="#">9</a>
								<a href="#">10</a>
							</span>
							<a href="#"><img src="../assets/img/btn/btn_list_next.gif" alt="다음5개 페이지이동" /></a><a href="#"><img src="../assets/img/btn/btn_list_last.gif" alt="마지막 페이지이동" /></a>
						</div>
					</div>
					<!--// E: 페이징 -->