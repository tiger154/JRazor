<script type="text/javascript" src="/assets/js/bbs.js"></script>
<script type="text/javascript" src="/assets/js/jquery.easyui.min.js"></script>
<form id="form1" name="form1" >
<input type="hidden" id="pageUrl" name="pageUrl" value="<?=$pageUrl?>" />
<input type="hidden" id="bbsType" name="bbsType" value="<?=$bbsType?>" />	
</form>
						<div style="position: relative; float:right; margin-left: 0px; margin-top: 0px; margin-right: 0px; margin-bottom: 0px; bottom:10px;">
							<label for="project" class="labSty01">������Ʈ ����</label>
							<?=$SELECTBOX_PRJ_IDX?>
						</div>
					<?=$BBSGROUP_LIST?>
					<!-- S: �˻� -->
					<div id="Bd-top-sch">
						<div class="sch">
							<!--form id="top-sch" name="top-sch" action="#" method="post">
								<fieldset>
									
									<legend>�Խù� �˻�</legend>
										<label for="sch_item">�˻��׸�</label>
										<select name="sch_item" id="sch_item" >
											<option value="">�����</option>
										</select>
										<label for="sch_key">�˻���</label>
										<input type="text" name="sch_key" id="sch_key" title="�˻����Է�" />
										<input class="image" type="image" src="/assets/img/btn/btn_search.gif" alt="�˻�" />
								</fieldset>
							</form-->
						</div>
					</div>
					<!-- E: �˻� -->

					<table id="BdList-Type01" summary="���� ��ũ�� ���ؼ� �Խù� �� �������� �̵��մϴ�.">
						<caption>���</caption>
						<colgroup>
							<col width="60px" />
							<col width="*" />
							<col width="10%" />
							<col width="10%" />
							<col width="10%" />
						</colgroup>
						<thead>
							<tr>
								<th scope="col" class="first">��ȣ</th>
								<th scope="col">����</th>
								<th scope="col">�ۼ���</th>
								<th scope="col">�ۼ���</th>
								<th scope="col">��ȸ</th>				
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
								<td colspan="5" class="no-data">�ش� �����Ͱ� �����ϴ�.</td>
							</tr>
						<?
						  }
					     ?>
						</tbody>
					</table>
					
					
					<!-- S: ����¡ -->
					<div id="Paging">
						<div id="Page-Index"><?=$paging?></div>
					</div>
					<!--// E: ����¡ -->

					<div class="txtR">
						<span class="btn01"><a href="/admin/bbsManagement/<?=$bbsType?>NewPost?backPage=<?=$curPage?>&project_id=<?=$PRJ_IDX?>">���ۼ�</a></span>
					</div>