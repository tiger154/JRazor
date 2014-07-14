<script>
	
	function bodyOnLoad()
	{
		$("#id_popupTitle").html('사진 등록');
	}
	
</script>


	<div class="PopSch mgt5 mgb20">				
	
	<form id="form1" name="form1" action="/front/popup/PhotoUploadProcess" method="post" enctype="multipart/form-data">
	<input type="hidden" id="PRJ_IDX" name="PRJ_IDX" value="<?=$PRJ_IDX?>" />
	<input type="hidden" id="APPL_IDX" name="APPL_IDX" value="<?=$APPL_IDX?>" />
	<fieldset>
	<legend>사진 등록</legend>		
	<label for="p01" class="blind">파일 검색</label>
	<input type="file" name="PHOTO" id="PHOTO" class="inputS02" title="파일 입력" style="width:240px;" />
	</fieldset>
	
	
	<p class="tip mgt5">예) 3cm x 4cm, 150 kb 이하, jpg 및 gif 만 가능</p>
	</div>
	<div class="tetAlignC mgt15">
	<input type="image" class="image" src="<?=$POPUP_IMG_URL?>/img/board/btn_ok2.gif" alt="확인" />
	</div>
	
	<br>
	
	</form>