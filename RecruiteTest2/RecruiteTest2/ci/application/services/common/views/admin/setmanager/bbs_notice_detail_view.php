<script>
	function DeleteBbs() {
		$("#bbsForm1").attr("action", "/admin/bbsManagement/DeleteBbs");
		$("#bbsForm1").submit();
	}
</script>		
					

<form name="bbsForm1" id="bbsForm1" enctype="multipart/form-data" method="post" action="/admin/bbsManagement/insertBbs">
<input type="hidden" id="bbsType" name="bbsType" value="<?=$bbsType?>" />	
		<div style="position: relative; float:right; margin-left: 0px; margin-top: 0px; margin-right: 0px; margin-bottom: 0px; bottom:10px;">
							<label for="project" class="labSty01">������Ʈ ����</label>
							<?=$SELECTBOX_PRJ_IDX?>
						</div>
					<?=$BBSGROUP_LIST?>
	
					<!-- S: �ۼ� -->
					<table class="BdView-Type01" summary="����">
						<caption>����</caption>
						<colgroup>
							<col width="145px" />
							<col width="*" />
						</colgroup>
						<tbody>
							<tr>
								<th scope="row">
									<label for="BBS_TITLE">����</label>
								</th>
								<td>
									<?=$BBS_TITLE?>
								</td>
							</tr>
							<tr>
								<th scope="row">
									<label for="BBS_CONTENT">����</label>
								</th>
								<td>
									<?=$BBS_CONTENT?>
								</td>
							</tr>
							<tr>
								<th scope="row">
									<label for="file01">÷������</label>
								</th>
								<td>
									<ul class="tbLi">
										<?
											if ( $bbsFilesCount > 0 ) { 
												foreach ( $bbsFiles as $key => $data){
										 ?>
											<li><strong><?=$data->ROWNUM?>.</strong> <a href='/admin/bbsManagement/fileDownload?filedate=<?=$data->SAVE_FOLD?>&bbsGidx=<?=$BBS_GROUP_IDX?>&fls_nm=<?=$data->SAVE_NAME?>'><?=$data->FILE_NAME?></a></li>
										<?
												}
											}
										 ?>
									</ul>
								</td>
							</tr>
						</tbody>
					</table>
					<!--// E: �ۼ� -->					

					<div class="txtC">
						<span class="btn01"><a href="/admin/bbsManagement/<?=$bbsType?>AnswerPost?bbs_idx=<?=$BBS_IDX?>&project_id=<?=$PRJ_IDX?>">�亯</a></span>
						<span class="btn01"><a href="/admin/bbsManagement/<?=$bbsType?>EditPost?backPage=<?=$backPage?>&bbs_idx=<?=$BBS_IDX?>&project_id=<?=$PRJ_IDX?>">����</a></span>
						<span class="btn01"><a href="javascript:void(0);" onClick="DeleteBbs();">����</a></span>
						<span class="btn02"><a href="/admin/bbsManagement/Notice?<?=$_SERVER['QUERY_STRING']?>">���ư���</a></span>
					</div>
					<? if($BBS_IDX > 0) {
					 ?>
						<input type="hidden" name="BBS_IDX" id="BBS_IDX"  value="<?=$BBS_IDX?>" />
					<? }
					 ?>
					<input type="hidden" name="BBS_GROUP_IDX" id="BBS_GROUP_IDX"  value="<?=$BBS_GROUP_IDX?>" />
</form>