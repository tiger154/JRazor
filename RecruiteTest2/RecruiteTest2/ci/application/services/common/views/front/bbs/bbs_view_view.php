<script>
	
	function goBack()
	{
		history.back();
	}
	
	function changeProject()
	{
		location.replace('/front/bbs/' + $("#bbsType").val() + '?project_id=' + $("#PRJ_IDX option:selected").val());
	}
	
	function goModify()
	{
		//NoticeEditPost?backPage=1&bbs_idx=132&project_id=30
	}
	
</script>
<form id="form1" name="form1">
<input type="hidden" id="bbsType" name="bbsType" value="<?=$bbsType?>" />
</form>
<style>
	
	/*=================================================================================
 	* Board View Type
	 =================================================================================*/
	.BdView-Type01 {
		width:100%;
		table-layout: fixed;
		border-top:1px solid #6f6f6f;
		margin:0 0 20px 0;
	}
	
	.BdView-Type01 caption {	display:none;}
	
	.BdView-Type01 thead tr th {
		color:#fff;
		background:#84a1bc;
		border-left:1px solid #dcdcdc;
		padding:9px 0 6px 0;
	}
	
	.BdView-Type01 thead tr th.first {
		border-left:none;
	}
	
	.BdView-Type01 tbody tr th {
		color:#4b4b4b;
		padding:9px 0 6px 0;
		border:1px solid #dcdcdc;
		border-top:0px;
		border-left:0px;
		text-align:left;
		background:#f6f6f6;
		text-indent:15px;
	}
	
	.BdView-Type01 tbody tr td {
		padding:9px 0 6px 10px;
		border-bottom:1px solid #dcdcdc;
		border-left:1px solid #dcdcdc;
	}
	
	.BdView-Type01 tbody tr td img {	vertical-align: middle;}
	
	.BdView-Type01 tbody tr th.bdLine {	border-left:1px solid #dcdcdc;}
	
	.BdView-Type01 tbody tr th.center {	text-align:center; text-indent:0px;}
	.BdView-Type01 tbody tr td.left {	text-align:left;}
	.BdView-Type01 tbody tr td.center {	text-align:center; padding:9px 0 6px 0;}
	
	.BdView-Type01 tbody tr.colorB th {	background:#e8eef4;}
	
	.BdView-Type01 tbody tr.colorB td {	background:#f1f7fd;}
	
	.item { color:#ff5400; margin:0 3px 0 0;}
	.tbLi li { margin:0 0 5px 0;}
	
</style>	

<div class="textR">
								<?=$SELECTBOX_PRJ_IDX?>
								</div><br/>
							
							<div class="TopListBox">
								<table class="TopList" summary="채용공고 목록이며 공고명을 클릭하시면 상세화면을 보실 수 있습니다.">
									<caption>채용공고 목록</caption>
									  <colgroup>
									  <col width="8%" />
									  <col width="*" />
									  <col width="15%" />
									  </colgroup>
									  <thead>
										<tr>
											<th scope="col" class="first">번호</th>
											<th scope="col">제목</th>
											<th scope="col" class="last">작성일자</th>
										</tr>
									  </thead>
									  <tbody>
									 
										<tr>
											<td><?=$BBS_IDX?></td>
											<td class="left"><?=$BBS_TITLE?></td>
											<td><?=$REG_DT?></td>
										</tr>
										<tr>
											<td colspan="3"  class="left"><?=$BBS_CONTENT?></td>
										</tr>
									  </tbody>
								</table>
							</div>
							<div class="tetAlignR">
							<span class="btn05"><a href="/front/bbs/<?=$bbsType?>EditPost?backPage=<?=$backPage?>&bbs_idx=<?=$BBS_IDX?>&project_id=<?=$PRJ_IDX?>">수정하기</a></span>
							<span class="btn05"><a href="/front/bbs/<?=$bbsType?>DeleteFormPost?backPage=<?=$backPage?>&bbs_idx=<?=$BBS_IDX?>&project_id=<?=$PRJ_IDX?>">삭제하기</a></span>
							</div>
							<div class="tetAlignC">
								<span class="btn04"><a href="javascript:goBack();">글 목록</a></span>
							</div>
							
							<br/><br/>
							<? if ( $bbsFilesCount > 0 ) {  ?>
							<dl id="FaqList">
								
								<dd class="open">
									
									<ul>
										<?
												foreach ( $bbsFiles as $key => $data){
										 ?>
											<li><strong><?=$data->ROWNUM?>.</strong> <a href='/front/bbs/fileDownload?filedate=<?=$data->SAVE_FOLD?>&bbsGidx=<?=$BBS_GROUP_IDX?>&fls_nm=<?=$data->SAVE_NAME?>'><?=$data->FILE_NAME?></a></li>
										<?
												}
										 ?>
									</ul>
								</dd>
								
							</dl>
							<? } ?>

							