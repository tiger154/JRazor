<script>
	
	function bodyOnLoad()
	{
		$("#id_popupTitle").html('���� ���');
		alert('���ε� �Ǿ����ϴ�.');
		
		window.opener.$("#PHOTO_YN").val('Y');
		
		window.opener.$("#id_photo_image").attr("src","<?=$PHOTO_URL?>");
		window.opener.$("#id_photo_image").attr("width","130");
		window.opener.$("#id_photo_image").attr("height","150");
		window.close();
	}
	
</script>
