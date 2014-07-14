<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="ko" lang="ko">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=euc-kr" />
	<script language="javascript" src="/assets/js/jquery-1.8.3.js"></script>
	<script language="javascript" src="/assets/js/front/menu.js"></script>
	<link rel="stylesheet" type="text/css" href="/assets/front/design1/css/default.css" />
	<link rel="stylesheet" type="text/css" href="/assets/css/common.css" />
	<title><?=$POPUP_TITLE?></title>
	<!--[if IE 6]>
	 <script type="text/javascript" src="./assets/js/DD_belatedPNG_0.0.8a-min.js"></script>
	 <script type="text/javascript">
	  DD_belatedPNG.fix('.png24, .WBg, #Section');
	 </script>
	<![endif]-->
	<style>
		
		.terms-box {
	position: relative;
	height:200px;
	overflow-y: scroll;
	overflow-x: hidden;
	margin-bottom:10px;
	border:1px solid #e1e1e1;
	padding:0px;
}

.terms-box h3 {
	margin-bottom:0Px;
	color:#4b4b4b;
}
		
	</style>
	<script>
		
		function bodyOnLoad()
		{
		}
		
	</script>
</head>
<body onload="bodyOnLoad();">
		<div class="Popup" style="width:99%;">
		<h2><div id="id_popupTitle"><?=$POPUP_TITLE?></div></h2>
		<?=$LAYOUT_MAIN?>
			<a class="close" href="javascript:window.close();"><img src="<?=$POPUP_IMG_URL?>/img/common/pop_close.gif" alt="닫기" /></a>
	</div>

</body>
</html>
