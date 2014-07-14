<script type="text/javascript" src="/assets/js/bbs.js"></script>
<script type="text/javascript" src="/assets/js/jquery.easyui.min.js"></script>
<form id="form1" name="form1" >
<input type="hidden" id="pageUrl" name="pageUrl" value="<?=$pageUrl?>" />
<input type="hidden" id="bbsType" name="bbsType" value="<?=$bbsType?>" />	
</form>
						<div style="position: relative; float:right; margin-left: 0px; margin-top: 0px; margin-right: 0px; margin-bottom: 0px; bottom:10px;">
							<label for="project" class="labSty01">프로젝트 선택</label>
							<?=$SELECTBOX_PRJ_IDX?>
						</div>
					<?=$BBSGROUP_LIST?>
					<!-- S: 검색 -->
					<div id="Bd-top-sch">
						<div class="sch">
							<!--form id="top-sch" name="top-sch" action="#" method="post">
								<fieldset>
									
									<legend>게시물 검색</legend>
										<label for="sch_item">검색항목</label>
										<select name="sch_item" id="sch_item" >
											<option value="">기업명</option>
										</select>
										<label for="sch_key">검색어</label>
										<input type="text" name="sch_key" id="sch_key" title="검색어입력" />
										<input class="image" type="image" src="/assets/img/btn/btn_search.gif" alt="검색" />
								</fieldset>
							</form-->
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
						</colgroup>
						<thead>
							<tr>
								<th scope="col" class="first">번호</th>
								<th scope="col">제목</th>
								<th scope="col">작성자</th>
								<th scope="col">작성일</th>
								<th scope="col">조회</th>				
							</tr>
						</thead>
						<tbody>
						<? 
							if ( $bbsListCount > 0 ) { 
						 		foreach ( $bbsList as $key => $data){
						 ?>
							<tr>
								<td><?=($data->TOTAL_COUNT - $data->ROWNUM + 1)?></td>
								<td class="left">
									<? if($data->STEP > 0) {
									 ?>
										<? for($x = 1 ; $x <= $data->STEP ; $x ++) { echo '&nbsp;&nbsp;&nbsp;'; }?>
										<img src="/assets/img/btn/reply_icon.gif" align="absmiddle" border="0">
									<? } 
									 ?>
									<a href="/admin/bbsManagement/<?=$bbsType?>Detail?backPage=<?=$curPage?>&bbs_idx=<?=$data->BBS_IDX?>&project_id=<?=$PRJ_IDX?>">
									<span class="orange"><?=($PRJ_IDX == 0)? '['.$data->PRJ_NM.']' : ''?> </span><?=$data->BBS_TITLE?></a></td>
								<td><?=$data->WRITER_NM?></td>
								<td><?=$data->REG_DT?></td>
								<td><?=$data->HIT?></td>
							</tr>
						<?
					 			} 
						  } else {
					 	 ?>
							<tr>
								<td colspan="5" class="no-data">해당 데이터가 없습니다.</td>
							</tr>
						<?
						  }
					     ?>
						</tbody>
					</table>
					
					
					<!-- S: 페이징 -->
					<div id="Paging">
						<div id="Page-Index"><?=$paging?></div>
					</div>
					<!--// E: 페이징 -->

					<div class="txtR">
						<span class="btn01"><a href="/admin/bbsManagement/<?=$bbsType?>NewPost?backPage=<?=$curPage?>&project_id=<?=$PRJ_IDX?>">글작성</a></span>
					</div>