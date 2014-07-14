<!-- S: �ۼ� -->
<script language="javascript" src="/assets/js/jquery.validate.js"></script>
<script>

	function bodyOnLoad()
	{

		$("#form1").validate({  
					groups:{COLROW:"COL_SIZE ROW_SIZE"},
			    rules: {  
			      COL_SIZE:{required:true,digits:true},
			      ROW_SIZE:{required:true,digits:true},
			      EXCEL_FILE:{required:true}
			    },  
			    onkeyup:false,
			    messages: {
			    		COL_SIZE:{required:"�࿭������ �Է��ϼ���.",
			    							digits:"���ڸ� �Է��ϼ���"},
			    		ROW_SIZE:{required:"�࿭������ �Է��ϼ���.",
			    							digits:"���ڸ� �Է��ϼ���"},
							EXCEL_FILE:{required:"������ ���ε��ϼ���"}
			    }
	   	});  
	   	
	 }
	 
	function goList()
	{
			$("#P_PRJ_IDX").val($("#PRJ_IDX").val());
			goLink('','pop','width=950 height=500 resizable=yes scrollbars=yes status=yes');
			$("#form2").attr('target','open_pops');
			$("#form2").attr("action","/admin/reportService/reportList");
			$("#form2").attr("method","post");
			$("#form2").submit();
			
	}
	 
	function goProcess()
	{
		$("#form1").attr("action","/admin/reportService/reportProcess");
		$("#form1").attr("method","post");
		$("#form1").submit();
	}
	
</script>
<form id="form2" name="form2" >
<input type="hidden" id="MENU_FLAG" name="MENU_FLAG" value="list" />
<input type="hidden" id="P_PRJ_IDX" name="P_PRJ_IDX" />
</form>
				<form id="form1" name="form1" enctype="multipart/form-data">
					<p class="txtR F11 mgb5"><span class="orange ">*</span> �ʼ� ���� ��</p>
					<table class="BdView-Type01" summary="�Խù� ����, ��ȣ, �ۼ���, �����, ��ȸ��, ÷������ �� ������ �� �� �ֽ��ϴ�.">
						<caption>�Խñ� �󼼺���</caption>
						<colgroup>
							<col width="180px" />
							<col width="*" />
						</colgroup>
						<tbody>
							<tr>
								<th scope="row">
									<label for="w01"><span class="item">*</span>������Ʈ ����</label>
								</th>
								<td>
									<?=$SELECTBOX_PRJ_IDX?>
									<p class="F11 mgt5 orange">�� ��� ��� ������ ���� ������Ʈ�� �����Ͽ� �ּ���.</p>
								</td>
							</tr>
							<tr>
								<th scope="row">
									<label for="w02a"><span class="item">*</span>�� x �� ����</label>
								</th>
								<td>
									<input type="text" name="COL_SIZE" id="COL_SIZE" title="�� �Է�" style="width:25px;" maxlength="2" /> x
									<input type="text" name="ROW_SIZE" id="ROW_SIZE" title="�� �Է�" style="width:25px;" maxlength="2" />
									<label class="error" for="COLROW" generated="true" style="display:none;color:red;">error message</label>	
								</td>
							</tr>
							<tr>
								<th scope="row">
									<label for="w03a"><span class="item">*</span>���� ����</label>
								</th>
								<td>
									<?=$SELECTBOX_SORT_TP?>
									<input id="REVERSE_YN" name="REVERSE_YN" class="checkbox" type="checkbox" value="Y" />
									<label for="w03b" class="F11">���� �ʿ� �� üũ�ϼ���.</label>
								</td>
							</tr>
							<tr>
								<th scope="row">
									<label for="w04a"><span class="item">*</span>���� �׸�</label>
								</th>
								<td>
									<div class="mgb10">
										<input id="PHOTO_YN" name="PHOTO_YN" class="checkbox" type="checkbox" value="Y" />
										<label for="w04a" class="F11">����</label>
									</div>
									1. <?=$SELECTBOX_DISPLAY_TP1?> &nbsp;
									2. <?=$SELECTBOX_DISPLAY_TP2?> &nbsp;
									3. <?=$SELECTBOX_DISPLAY_TP3?> &nbsp;
								</td>
							</tr>
							<tr>
								<th scope="row">
									<label for="w05a"><span class="item">*</span>��� ���� ���ε�</label>
								</th>
								<td>
									<input type="file" name="EXCEL_FILE" id="EXCEL_FILE" title="��� ���� ���ε�" style="width:300px;" /> �������ϸ� ���ε� �˴ϴ�.
									<label class="error" for="EXCEL_FILE" generated="true" style="display:none;color:red;">error message</label>	
								</td>
							</tr>
						</tbody>
					</table>
					<!--// E: �ۼ� -->

					<p class="orange mgb15">�� ���ε带 �Ͻø� ������ ���ε�� ����ڴ� �����ǰ� ���� ��ϵ˴ϴ�.</p>
					<p class="orange mgb15">�� ��� ���� ���� DOWN (�ִ� 400�� ���� ��� ����� �����մϴ�.)</p>

					<div class="txtC">
						<span class="btn01"><a href="javascript:goList();">��� ������</a></span>
						<span class="btn01"><a href="javascript:goProcess();">���</a></span>
					</div>
					</form>