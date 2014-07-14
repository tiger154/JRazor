<!-- S: 검색 -->
<script>

	function goDelete(prj_idx)
	{
		if (confirm('삭제 하시겠습니까?'))
		{
			$("#PRJ_IDX").val(prj_idx);
			$("#form1").attr("method","post");
			$("#form1").attr("action","/admin/projectManagement/deleteProcess");
			$("#form1").submit();
		}
	}
	
</script>
<form id="form1" name="form1" >
<input type="hidden" id="PRJ_IDX" name="PRJ_IDX" />
</form>
					<div id="Bd-top-sch">
						<div class="sch">
							<form id="top-sch" name="top-sch" action="/admin/projectManagement/projectList" method="get">
								
								<fieldset>
									<legend>게시물 검색</legend>
										<label for="sch_item">검색항목</label>
										<select name="sch_item" id="sch_item" >
											<option value="">프로젝트명</option>
										</select>
										<label for="sch_key">검색어</label>
										<input type="text" name="sch_prj_nm" id="sch_prj_nm" title="검색어입력" value="<?=$sch_prj_nm?>" />
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
							<col width="*" />
							<col width="*" />
							<col width="*" />
							<col width="80px" />
							<col width="95px" />
							<col width="95px" />
							<col width="95px" />
							<col width="95px" />
							<col width="95px" />
							<col width="80px" />
						</colgroup>
						<thead>
							<tr>
								<th scope="col" class="first">번호</th>
								<th scope="col">기업명</th>
								<th scope="col">프로젝트명</th>
								<th scope="col">공고 일정</th>
								<th scope="col">상태</th>
								<th scope="col">공고<br />관리</th>
								<th scope="col">유의사항<br />관리</th>
								<th scope="col">지원분야 및<br />자격요건 관리</th>
								<th scope="col">전형 진행<br />관리</th>
								<th scope="col">게시판<br />관리</th>
								<th scope="col">삭제</th>
							</tr>
						</thead>
						<tbody>
							<? 
							if ( $prjdataCount > 0 ) { 
							foreach ( $prjdata as $key => $data){
							?>
							<tr>
								<td><?=$data->ROW_NUM?></td>
								<td><a href="javascript:goLink('/admin/projectManagement/projectView?project_id=<?=$data->PRJ_IDX?>')"><?=$data->COMP_NM?></a></td>
								<td><a href="javascript:goLink('/admin/projectManagement/projectView?project_id=<?=$data->PRJ_IDX?>')"><?=$data->PRJ_NM?></a></td>
								<td><?=$data->PRJ_STDT?> ~ <?=$data->PRJ_EDDT?></td>
								<td><strong><font color="brown"><?=$data->PRJ_STS == 'O' ? '열림' : '닫힘';?></font></strong></td>
								<td><span class="btn04"><a href="javascript:goLink('/admin/projectManagement/projectView?project_id=<?=$data->PRJ_IDX?>')">View</a></span></td>
								<td><span class="btn04"><a href="javascript:goLink('/admin/resumeComment/resumeSubList?project_id=<?=$data->PRJ_IDX?>')">View</a></span></td>
								<td><?=$data->UNIT_CNT == 0 ? '<strong><font color="red">▶</font></strong>' : '';?>
									<span class="btn04"><a href="javascript:goLink('/admin/stepManagement/unitAuthList?project_id=<?=$data->PRJ_IDX?>')">View</a></span>
									<?=$data->UNIT_CNT == 0 ? '<strong><font color="red">◀</font></strong>' : '';?>
								</td>
								<td><span class="btn04"><a href="javascript:goLink('/admin/stepManagement?project_id=<?=$data->PRJ_IDX?>')">View</a></span></td>
								<td><span class="btn04"><a href="javascript:goLink('/admin/bbsManagement/QnA?project_id=<?=$data->PRJ_IDX?>');">View <span class="color">(<?=number_format($data->BBS_CNT)?>)</span></a></span></td>
								<td><span class="btn04"><a href="javascript:goDelete('<?=$data->PRJ_IDX?>');">삭제</a></span></td>
							</tr>
						<? 
							}
							} else {
						 ?>
							<tr>
								<td colspan="11" class="no-data">해당 데이터가 없습니다.</td>
							</tr>
						<? } ?>
						</tbody>
					</table>
					<!--// E: 게시물리스트 -->

					<!-- S: 페이징 -->
					<div id="Paging">
						<div id="Page-Index"><?=$paging?></div>
					</div>
					<!--// E: 페이징 -->

					<div class="txtR">
						<span class="btn01"><a href="javascript:goLink('/admin/projectManagement/projectRegist')">프로젝트 등록</a></span>
					</div>