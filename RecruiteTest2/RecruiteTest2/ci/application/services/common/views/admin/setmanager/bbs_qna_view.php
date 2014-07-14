					<ul class="tabStyle01">
						<?
							if ( $bbsGroupCount > 0 ) { 
						 		foreach ( $bbsGroup as $key => $data){
						 ?>
							<li <?=($data->SELECTED)? 'class="on"' : '' ?>><a href="<?=$data->BBS_URL?>"><?=$data->BBS_NAME?></a></li>
						<?
								}
					 		}
						 ?>
					</ul>

					<!-- S: 검색 -->
					<div id="Bd-top-sch">
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

					<table id="BdList-Type01" summary="제목 링크를 통해서 게시물 상세 내용으로 이동합니다.">
						<caption>목록</caption>
						<colgroup>
							<col width="60px" />
							<col width="*" />
							<col width="10%" />
							<col width="10%" />
							<col width="10%" />
							<col width="10%" />
						</colgroup>
						<thead>
							<tr>
								<th scope="col" class="first">번호</th>
								<th scope="col">제목</th>
								<th scope="col">작성자</th>
								<th scope="col">작성일</th>
								<th scope="col">처리일</th>
								<th scope="col">처리여부</th>				
							</tr>
						</thead>
						<tbody>
							<tr>
								<td>1</td>
								<td class="left"><a href="#"><span class="orange">[2012 상반기 채용]</span> 2012년 상반기 채용 관련 공지 입니다.   </a></td>
								<td>커리어케어</td>
								<td>2012-12-15</td>
								<td>2012-12-15</td>
								<td><span class="ico03"><span>접수</span></span></td>
							</tr>
							<tr>
								<td>1</td>
								<td class="left"><a href="#"><span class="orange">[2012 상반기 채용]</span> 2012년 상반기 채용 관련 공지 입니다.   </a></td>
								<td>커리어케어</td>
								<td>2012-12-15</td>
								<td>2012-12-15</td>
								<td><span class="ico04"><span>처리완료</span></span></td>
							</tr>
							<tr>
								<td colspan="6" class="no-data">해당 데이터가 없습니다.</td>
							</tr>
						</tbody>
					</table>

					<!-- S: 페이징 -->
					<div id="Paging">
						<div id="Page-Index"><?=$paging?></div>
					</div>
					<!--// E: 페이징 -->
					<!--a href="javascript:Test();">Test!</a-->
					<script language="javascript" src="http://common.trns.co.kr/assets/js/json2.js"></script>
					<script language="javascript" src="http://common.trns.co.kr/assets/js/jQuery.XDomainRequest.js"></script>
					<!--script type="text/javascript">
						//document.domain = "trns.co.kr";
						$.support.cors = true;
						function Test() {
							$.ajax({
								url: "http://sendmail.trns.co.kr:18023/MailService.asmx/SendMailByGrouping",//2?mail_idx=1&per_count=3&delay=3000",
								type: "GET",
								data: {mail_idx:1,per_count:3,delay:1000},
								contentType: "application/xml; charset=utf-8",
								dataType: "xml",
								success: function(data){
									//alert(data.text);
									alert($(data).text());
								},
								error: function(jqXHR, textStatus){
									alert(textStatus);
								}
							});
						}
					</script-->