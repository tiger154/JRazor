<!-- S: 검색 -->
<?
$CI =& get_instance();
$CI->load->library('DataControl');
?>
<script>
	
	function projectProcess(cmp_cd,cmp_nm)
	{
		$("#admin_login_comp_nm").val(cmp_nm);
		$("#admin_login_comp_id").val(cmp_cd);
		$("#AdminLoginCompForm1").attr("action","/admin/login/companyLoginProcess");
		$("#AdminLoginCompForm1").attr("method","post");
		$("#AdminLoginCompForm1").submit();	
	}
</script>
					<div id="Bd-top-sch">
						<div class="btn">
							<span class="btn01"><a href="/admin/projectManagement">전체 기업 프로젝트 현황 보기</a></span>
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
										<input class="image" type="image" src="/assets/img/btn/btn_search.gif" alt="검색" />
								</fieldset>
							</form>
						</div>
					</div>
					<!-- E: 검색 -->

					<!-- S: 게시물리스트 -->
					<div id="CompanyList">
						
						<ul>
							<?
							foreach ($rData as $key => $data)
							{
							?>
							<li>
								<dl>
									<dt><a href="javascript:projectProcess('<?=$data->COMP_ID?>','<?=$data->COMP_NM?>');"><?=$data->COMP_NM?></a></dt>
									<!-- 이미지사이즈 200*100 -->
									<dd class="logo"><a href="javascript:projectProcess('<?=$data->COMP_ID?>','<?=$data->COMP_NM?>');"><img src="<?=$CI->datacontrol->getLogoPath($data->DOMAIN_ID,1)?>" alt="기업로고이미지" width="200" height="100" /></a></dd>
									<dd>진행중인 프로젝트 <?=$data->CNT?> 건 </dd>
									<dd><a href="http://<?=$data->DOMAIN_ID?>.<?=MAIN_SERVICE_DOMAIN?>" target="_blank"><img src="/assets/img/btn/btn_job_page.gif" alt="사용자 채용 접수 페이지 바로가기" /></a></dd>
								</dl>
							</li>
							<?
							}
							?>
						
						</ul>
					</div>
					<!--// E: 게시물리스트 -->

					<!-- S: 페이징 -->
					
					<div id="Paging">
						<div id="Page-Index"><?=$paging?></div>
					</div>
					<!--// E: 페이징 -->