<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="ko" lang="ko">
<head>

	<meta http-equiv="Content-Type" content="text/html; charset=euc-kr" />
	<link rel="stylesheet" type="text/css" href="/assets/css/default.css" />
	<script language="javascript" src="/assets/js/jquery-1.8.3.js"></script>
	<script language="javascript" src="/assets/js/common.js"></script>
	<script language="javascript" src="/assets/js/menu.js"></script>
	<title>CAREERCARE Admin</title>
</head>
<body onload="menuOnLoad(<?=$current_display_menu_cd?>)&bodyOnLoad();">
	<div id="LY-Wrapper">

		<!-- 접근성향상 바로가기메뉴 -->
		<div id="skipNavigation">
			<ul>
				<li><a href="#LY-Top">메인메뉴 바로가기</a></li>
				<li><a href="#LY-Middle">본문 바로가기</a></li>
			</ul>
		</div>
		<hr />

		<div id="Fix-Width">
			
			<!-- S: Top -->
			<div id="LY-Top">
			<?=$LAYOUT_TOP?>
			</div>
			<hr />
			<!--// E: Top -->

			<!-- S: Middle -->
			<div id="LY-Middle">

				<!-- S: 타이틀-->
				<div id="Title-box">
				<?=$LAYOUT_NAVIGATOR?>
				</div>
				<!--// E: 타이틀-->

				<!-- S: 콘텐츠-->
				<div id="Content-box">
						
						<?=$LAYOUT_MAIN?>

				</div>
				<!--// E: 콘텐츠-->

			</div>
			<hr />
			<!--// E: Middle -->

			<!-- S: Bottom -->
			<?=$LAYOUT_BOTTOM?>
			<!--// E: Bottom -->

		</div>

	</div>

</body>
</html>
