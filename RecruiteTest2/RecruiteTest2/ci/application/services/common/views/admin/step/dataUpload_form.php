
<table class="BdView-Type01" summary="�Խù� ����, ��ȣ, �ۼ���, �����, ��ȸ��, ÷������ �� ������ �� �� �ֽ��ϴ�.">
	<script>
		
		function bodyOnload()
		{
			
			
		}
		
		function processForm()
		{
			if ($("#EX_FILE_UPLOAD").val() == '')
			{
				alert('������ �����ϼ���.');
			}
			else
			{
				$("#SUBMIT_BUTTON").click();
			}
		}
		
	</script>
	
	<form name="form1" id="form1" enctype="multipart/form-data" method="post" action="/admin/stepManagement/dataUploadProcess">
	<input type="hidden" name="PRJ_IDX" id="PRJ_IDX" value="<?=$PRJ_IDX?>">
	<input type="hidden" name="STEP_IDX" id="STEP_IDX" value="<?=$STEP_IDX?>">
						<caption></caption>
						<colgroup>
							<col width="10px" />
							<col width="105px" />
							<col width="10px" />
							<col width="*" />
						</colgroup>
						<tbody>
							<tr>
								<th scope="row" colspan="3">
									<label for="w01">��������</label>
								</th>
								<td><input type="file" name="EX_FILE_UPLOAD" id="EX_FILE_UPLOAD" style="width:98%;"></td>
							</tr>
							</tbody>
					</table>			
	<div class="txtC">
				<span class="btn01"><a href="javascript:processForm();">����ϱ�</a></span>
				<span class="btn02"><a href="javascript:window.close();">�ݱ�</a></span>
				<input type="submit" id="SUBMIT_BUTTON" style="display:none" />
			</div>
		</form>