
<script>
	
	function goModify()
	{
		$("#ACT_FLAG").val('modify');
		$("#form1").attr('method','post');
		$("#form1").attr('action','/admin/popupManagement/Form');
		$("#form1").submit();
	}
	
</script>

<form name="form1" id="form1">
<input type="hidden" id="ACT_FLAG" name="ACT_FLAG" />
<input type="hidden" id="RETURN_URL" name="RETURN_URL" />
<input type="hidden" id="POP_IDX" name="POP_IDX" value="<?=$POP_IDX?>" />
					<!-- S: �ۼ� -->
					<table class="BdView-Type01" summary="�Խù� ����, ��ȣ, �ۼ���, �����, ��ȸ��, ÷������ �� ������ �� �� �ֽ��ϴ�.">
						<caption>�Խñ� �󼼺���</caption>
						<colgroup>
							<col width="50px" />
							<col width="50px" />
							<col width="50px" />
							<col width="*" />
						</colgroup>
						
						<tbody>
							<tr>
								<th scope="row" colspan="3">
									<span class="item">*</span>
									<label for="w01">����</label>
								</th>
								<td>
									<?=$POPUP_TITLE?>
								</td>
							</tr>
							<tr>
								<th scope="row" colspan="3">
									<span class="item">*</span>
									<label for="w01">ũ��</label>
								</th>
								<td>
									<?=$POP_WIDTH?> x <?=$POP_HEIGHT?>
								</td>
							</tr>
							<tr>
								<th scope="row" colspan="3">
									<span class="item">*</span>
									<label for="w02">���±Ⱓ</label>
								</th>
								<td>
									<?=$OPN_STDT1?>
									<?=$OPN_STDT2?>��
									<?=$OPN_STDT3?>��
									 ~ 
									<?=$OPN_EDDT1?>
									<?=$OPN_EDDT2?>��
									<?=$OPN_EDDT3?>��
									
								</td>
							</tr>
							<tr>
								<th scope="row" colspan="3">
									<span class="item">*</span>
									<label for="w01">Ÿ��</label>
								</th>
								<td>
									<?=$VIEW_TP == 'W' ? '��â' : '���̾�'?>
								</td>
							</tr>
							<tr>
								<th scope="row" colspan="3">
									<span class="item">*</span>
									<label for="w03">����</label>
								</th>
								<td>
									<?=$CNTNT?>
									</script>
								</td>
							</tr>
							<tr>
								<th scope="row" colspan="3">
									<span class="item">*</span>
									<label for="w04a">��뿩��</label>
								</th>
								<td>
								<?=$USE_YN == 'Y' ? ' ��� ' : '  �̻�� ' ?> 
								</td>
							</tr>
							
						</tbody>
					</table>		
					
					<!--// E: �ۼ� -->
					
					<div class="txtC">
						<span class="btn01"><a href="javascript:goModify();">����</a></span>
					
						<span class="btn02"><a href="javascript:goLink('/admin/popupManagement')">���ư���</a></span>
					
					</div>
	</form>			