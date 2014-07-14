<link rel="stylesheet" type="text/css" href="/assets/css/jqueryui.css" />
<link rel="stylesheet" type="text/css" href="/assets/css/uploadify.css" />
<script type="text/javascript" src="/assets/js/jquery-ui.js" charset="utf-8"></script>
<script type="text/javascript" src="/assets/js/jquery.validate.js"></script>
<script type="text/javascript" src="/editor/se/js/HuskyEZCreator.js" charset="utf-8"></script>
<script type="text/javascript" src="/assets/js/uploadify/swfobject.js"></script>
<script type="text/javascript" src= "/assets/js/uploadify/jquery.tmpl.min.js"></script>
<script type="text/javascript" src= "/assets/js/uploadify/jquery.uploadify.js"></script>
<script type="text/javascript" src= "/assets/js/hashtable.js"></script>
<script type="text/javascript">
	var mode = "<?=$MODE?>";
	var fileList = new Hash();
	$(document).ready(function () {
		Uploadify.init("uploadify", "fileQueue","/admin/bbsManagement/Upload/", {
			//'BBS_IDX':$("#BBS_IDX").val(),
			'BBS_GROUP_IDX':$("#BBS_GROUP_IDX").val()
		});

		var BBS_FILES = eval(<?=$BBS_FILES?>);
		for(var i in BBS_FILES) {
			// baseURL : /file/bbs/{bbs_group_idx}
			Uploadify.addFilesQueue("uploadify", BBS_FILES[i], "<?=BBS_FILE_URL.'/'.$BBS_GROUP_IDX?>");
			var objFile = new Object();
			objFile.FLS_IDX = BBS_FILES[i].FLS_IDX;
			objFile.SAVE_FOLD = BBS_FILES[i].SAVE_FOLD;
			objFile.SAVE_NAME = BBS_FILES[i].SAVE_NAME;
			objFile.FILE_NAME = BBS_FILES[i].FILE_NAME;
			objFile.FILE_SIZE = BBS_FILES[i].FILE_SIZE;
			objFile.FILE_EXT = BBS_FILES[i].FILE_EXT;
			objFile.IS_IMAGE = BBS_FILES[i].IS_IMAGE;
			objFile.DEL_YN = BBS_FILES[i].DEL_YN;
			fileList.add("uploadify" + BBS_FILES[i].FLS_IDX, objFile);
		}
	});

	function uploadStart(uploadId, file) {
		if(uploadId == "uploadify") {

		}
	}

	var oEditors = [];
	function bodyOnLoad()
	{
		$("#bbsForm1").validate({
			rules: {
				BBS_TITLE:{required:true}//,
				//BBS_CONTENT:{required:true}
			},  
			onkeyup:false,
			messages: {
				BBS_TITLE:"제목을 입력하세요"//,
				//BBS_CONTENT:"내용을 입력하세요"
			},
			submitHandler: function(form) {
				form.submit();
		    }
	   	});
	}
	function processForm()
	{
		
		oEditors.getById["BBS_CONTENT"].exec("UPDATE_CONTENTS_FIELD", []);
		//var files = fileList.values();
		//for(var obj in files) {
		//	alert(files[obj].FILE_NAME);
		//}
		$('#BBS_FILES').val(JSON.stringify(fileList.values()));
		//alert(JSON.stringify(fileList.values()));
		
		if(mode == 'ANSWER') {
			$("#bbsForm1").attr("action","/admin/bbsManagement/InsertBbsAnswer");
		}
		$("#submit_button").click();
	}

    function uploadSuccess(uploadId, file, data, response) {
		var jsonData = JSON.parse(data);
		if (jsonData.MESSAGE != '1')
		{
			alert(jsonData.MESSAGE);
			$('#' + uploadId).uploadify('cancel', file.id);
			//return;
		} else {
			if(uploadId == "uploadify") {
				
				Uploadify.updateQueueTmpl(file.id, jsonData.SAVE_URL, jsonData.IS_IMAGE);

				var objFile = new Object();
				objFile.FLS_IDX = 0; //FLS_IDX
				objFile.SAVE_FOLD = jsonData.SAVE_FOLD;
				objFile.SAVE_NAME = jsonData.SAVE_NAME;
				objFile.FILE_NAME = file.name;
				objFile.FILE_SIZE = file.size;
				objFile.FILE_EXT = file.type;
				objFile.IS_IMAGE = jsonData.IS_IMAGE;
				objFile.DEL_YN = 'N';
				fileList.add(file.id, objFile);
			}
		}
    }

	function cancelClick(uploadId, fileId) {
		//$(\'#${instanceID}\').uploadify(\'cancel\', \'${fileID}\');
		if(uploadId == "uploadify") {
			$('#' + uploadId).uploadify('cancel', fileId);
			var objFile = fileList.getItem(fileId);
			objFile.DEL_YN = 'Y';
			fileList.setItem(fileId, objFile);
		}
	}

	function uploadError(uploadId, errorCode, errorMsg, errorString) {
		alert(errorCode + errorMsg + errorString);
	}

	function uploadCancel(uploadId, file) {
		if(uploadId == "uploadify") {
			fileList.remove(file.id);
        }
	}
	
    function uploadQueueComplete(uploadId, queueData) {
        if(uploadId == "uploadify")
        {
        }
    }

	
</script>
					

<form name="bbsForm1" id="bbsForm1" enctype="multipart/form-data" method="post" action="/admin/bbsManagement/InsertBbs">
<div style="position: relative; float:right; margin-left: 0px; margin-top: 0px; margin-right: 0px; margin-bottom: 0px; bottom:10px;">
							<label for="project" class="labSty01">프로젝트 선택</label>
							<?=$SELECTBOX_PRJ_IDX?>
						</div>
					<?=$BBSGROUP_LIST?>
					<!-- S: 작성 -->
					<table class="BdView-Type01" summary="쓰기">
						<caption>쓰기</caption>
						<colgroup>
							<col width="145px" />
							<col width="*" />
						</colgroup>
						<tbody>
							<tr>
								<th scope="row">
									<label for="BBS_TITLE">제목</label>
								</th>
								<td>
									<input type="text" name="BBS_TITLE" id="BBS_TITLE" title="제목 입력" style="width:766px;" value="<?=$BBS_TITLE?>" />
									<label class="error" for="BBS_TITLE" generated="true" style="display:none;color:red;">error message</label>
								</td>
							</tr>
							<tr>
								<th scope="row">
									<label for="BBS_CONTENT">내용</label>
								</th>
								<td>
									<textarea id="BBS_CONTENT" name="BBS_CONTENT" rows="1" cols="1" style="width:766px; height:212px; display:none;" title="내용입력"></textarea>
									<label class="error" for="BBS_CONTENT" generated="true" style="display:none;color:red;">error message</label>
									<script type="text/javascript">
									 nhn.husky.EZCreator.createInIFrame({
										 oAppRef: oEditors,
										 htParams : {
									 		bUseToolbar : true,
									 		fOnBeforeUnload : function(){}
									 },
										 elPlaceHolder: "BBS_CONTENT",
										 sSkinURI: "/editor/se/SmartEditor2Skin.html",
										 fCreator: "createSEditor2",
										 fOnAppLoad : function(){
												oEditors.getById["BBS_CONTENT"].exec("PASTE_HTML", [$("#BBS_CONTENT_FOR_CONTENT").val()]);
										 }
									 });
									</script>
								</td>
							</tr>
							<tr>
								<th scope="row">
									<label for="file01">첨부파일</label>
								</th>
								<td>
									<input type="file" name="uploadify" id="uploadify" />
									<div id="fileQueue" style="width:600px;"></div>
								</td>
							</tr>
						</tbody>
					</table>
					<!--// E: 작성 -->
					
					<? if($BBS_IDX > 0) {
					 ?>
						<input type="hidden" name="BBS_IDX" id="BBS_IDX"  value="<?=$BBS_IDX?>" />
					<? }
					 ?>
					<input type="hidden" name="BBS_CONTENT_FOR_CONTENT" id="BBS_CONTENT_FOR_CONTENT"  value="<?=$BBS_CONTENT?>" />
					<input type="hidden" id="bbsType" name="bbsType" value="<?=$bbsType?>" />	
					
					<input type="hidden" name="BBS_GROUP_IDX" id="BBS_GROUP_IDX"  value="<?=$BBS_GROUP_IDX?>" />
					<input type="hidden" name="MANAGER_ID" id="MANAGER_ID"  value="<?=$MANAGER_ID?>" />
					<input type="hidden" name="APPL_IDX" id="APPL_IDX"  value="<?=$APPL_IDX?>" />
					<input type="hidden" name="BBS_FILES" id="BBS_FILES"  value="" />
					
					<div class="txtC">
						<input type="submit" id="submit_button" style="display:none">
						<span class="btn01"><a href="javascript:processForm();">확인</a></span>
						<span class="btn02"><a href="<?=$_SERVER['HTTP_REFERER']?>">돌아가기</a></span>
					</div>
</form>