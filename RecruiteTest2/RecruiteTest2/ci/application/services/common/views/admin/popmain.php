<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="ko" lang="ko">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=euc-kr" />
	<link rel="stylesheet" type="text/css" href="/assets/css/default.css" />
	<script language="javascript" src="/assets/js/jquery-1.8.3.min.js"></script>
	<script language="javascript" src="/assets/js/jquery.easyui.min.js"></script>
	<script language="javascript" src="/assets/js/common.js"></script>
	<script language="javascript" src="/assets/js/menu.js"></script>
	
	<script>
		
		function OnLoad()
		{
	
		}

	</script>
	<title><?=$currentMenuNm?></title>
</head>
<body class="bgWhite" onload="bodyOnLoad()&OnLoad()">

	<div id="mainContent" class="LY-Pop" style="width:100%;">
		<div class="Pop-Title">
			<h2><?=$currentMenuNm?></h2>
		</div>
		<div class="Pop-Content">
		<?=$LAYOUT_MAIN?>
		</div>
		<div class="Pop-close"><a href="#"><img src="/assets/img/common/pop_close.gif" alt="닫기" /></a></div>
	</div>
		</body>
</html>
