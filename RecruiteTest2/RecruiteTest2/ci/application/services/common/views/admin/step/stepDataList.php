<!-- S: 검색 -->
<script>
	
	function bodyOnLoad()
	{
		$("#SCH_PRJ_IDX").val($("#PRJ_IDX").val());
	}
	
	function openDataView(code,gubun)
	{
		goLink('','pop','width=650 height=500 resizable=yes scrollbars=yes');
		$("#GUBUN").val(gubun);
		$("#form1").attr('target','open_pops');
		$("#form1").attr('action','/admin/stepManagement/dataView?form_id=' + code);
		$("#form1").submit();
		
	}
	
	function openDataFormView(code,gubun)
	{
		
		goLink('','pop','width=650 height=500 resizable=yes scrollbars=yes');
		$("#GUBUN").val(gubun);
		$("#form1").attr('method','post');
		$("#form1").attr('target','open_pops');
		$("#form1").attr('action','/admin/stepManagement/dataFormView?form_id=' + code);
		$("#form1").submit();
		
	}
	
	function openSendMailForm(code,gubun)
	{
		goLink('','pop','width=790 height=480 resizable=yes scrollbars=yes');
		$("#GUBUN").val(gubun);
		$("#form1").attr('method','post');
		$("#form1").attr('target','open_pops');
		$("#form1").attr('action','/admin/mailManagement?form_id=' + code);
		$("#form1").submit();
	}
	
	function openSendSmsForm(code,gubun)
	{
		goLink('','pop','width=650 height=380 resizable=yes scrollbars=yes');
		$("#GUBUN").val(gubun);
		$("#form1").attr('method','post');
		$("#form1").attr('target','open_pops');
		$("#form1").attr('action','/admin/smsManagement?form_id=' + code);
		$("#form1").submit();
	}
	
	function changeProject(obj)
	{
		goLink('/admin/stepManagement/dataList?project_id=' + obj.value);
	}
	
	function changeStep(obj)
	{
		goLink('/admin/stepManagement/dataList?project_id=' + $("#SCH_PRJ_IDX option:selected").val() + '&step_id=' + obj.value);
	}
</script>
					<div class="btn_box">
						<div class="lefBox">
						
						</div>
						<div class="rigBox">
						<form id="top-sch" name="top-sch" action="#" method="post">
						<strong>현재 채용공고</strong> : <?=$SELECTBOX1?>
						<strong>현재 전형</strong> : <?=$SELECTBOX2?>
						</form>
						</div>
						</div>
					
					<!-- E: 검색 -->
<br>
					<!-- S: 게시물리스트 -->
					<table id="BdList-Type01" summary="제목 링크를 통해서 게시물 상세 내용으로 이동합니다.">
						<caption>목록</caption>
						<colgroup>
							<col width="*" />
							<col width="*" />
							<col width="*" />
							<col width="*" />
							<col width="*" />
							<col width="*" />
							<col width="*" />
							<col width="*" />
							<col width="*" />
						</colgroup>
						<thead>
							<tr>
								<th scope="col" class="first">구분</th>
								<th scope="col">인원</th>
								<th scope="col">발표 폼 설정</th>
								<th scope="col">발표 명단 확인</th>
								<th scope="col">발표명단 관리</th>
								<th scope="col">명단 다운</th>
								<th scope="col">메일</th>
								<th scope="col">SMS</th>
								<th scope="col">관리</th>
							</tr>
						</thead>
						<tbody>
							<? 
							$ETCVAR = null;
							foreach ( $stepdata as $key => $data){
							if ($key == 0 ) $ETCVAR = $data->ETCVAR;
							?>
							<tr>
								<td><?=$data->GUBUN?></td>
								<td><?=number_format($data->CNT)?> 명</td>
								
								<td><span class="btn03"><a href="javascript:openDataFormView('<?=$data->STEP_DATA_FRM_IDX?>','<?=base64_encode($data->GUBUN)?>');">확인</a></span></td>
								<td><span class="btn03"><a href="javascript:openDataView('<?=$data->STEP_DATA_FRM_IDX?>','<?=base64_encode($data->GUBUN)?>');">설정</a></span></td>
								<? if ($key == 0) { ?>
								<td rowspan="<?=$stepCount?>"><span class="btn03"><a href="javascript:goLink('/admin/stepManagement/dataUpload?project_id=<?=$PRJ_IDX?>&step_id=<?=$STEP_IDX?>','pop','width=400 height=172')">확인</a></span></td>
								<td rowspan="<?=$stepCount?>"><span class="btn03"><a href="javascript:goLink('/admin/stepManagement/dataList?step_id=<?=$data->STEP_DATA_FRM_IDX?>');">확인</a></span></td>
								<? } ?>
								<td><span class="btn03"><a href="javascript:openSendMailForm('<?=$data->STEP_DATA_FRM_IDX?>','<?=base64_encode($data->GUBUN)?>');">발송</a></span></td>
								<td><span class="btn04"><a href="javascript:openSendSmsForm('<?=$data->STEP_DATA_FRM_IDX?>','<?=base64_encode($data->GUBUN)?>');">발송</a></span></td>
								<? if ($key == 0) { ?>
								<td rowspan="<?=$stepCount?>"><span class="btn03"><a href="javascript:goLink('/admin/stepManagement/dataList?step_id=<?=$data->STEP_DATA_FRM_IDX?>');">확인</a></span></td>
								<? } ?>
							</tr>
							<? 
							}
							?>
						</tbody>
					</table>
					
					<form name="form1" id="form1" method="post">
						<input type="hidden" name="GUBUN" id="GUBUN">
						<input type="hidden" name="PRJ_IDX" id="PRJ_IDX" value="<?=$PRJ_IDX?>">
						<input type="hidden" name="STEP_IDX" id="STEP_IDX" value="<?=$STEP_IDX?>">
						<input type="hidden" name="ETCVAR" id="ETCVAR" value="<?=base64_encode($ETCVAR)?>">
					</form>
					<!--// E: 게시물리스트 -->
<br>
				<div class="txtC">
						<span class="btn01"><a href="javascript:goLink('/admin/stepManagement/dataUpload?project_id=<?=$PRJ_IDX?>&step_id=<?=$STEP_IDX?>','pop','width=400 height=172')">엑셀 데이터 등록</a></span>
					</div>
		</table>
				