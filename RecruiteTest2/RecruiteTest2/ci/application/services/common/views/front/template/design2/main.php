<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="ko" lang="ko">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=euc-kr" />
	<script language="javascript" src="/assets/js/jquery-1.8.3.js"></script>
	<script language="javascript" src="/assets/js/front/common.js"></script>
	<script language="javascript" src="/assets/js/common.js"></script>
	<?=$MENU_SCRIPT?>
	<link rel="stylesheet" type="text/css" href="/assets/front/common/css/common.css" />
	<link rel="stylesheet" type="text/css" href="/assets/front/design2/css/default.css" />
	<title><?=$frontdesignTitle?></title>
	<!--[if IE 6]>
	 <script type="text/javascript" src="/assets/front/design2/js/DD_belatedPNG_0.0.8a-min.js"></script>
	 <script type="text/javascript">
	  DD_belatedPNG.fix('.png24');
	 </script>
	<![endif]-->
</head>
<body onload="bodyOnLoad();">
<form name="sslLoginForm" id="sslLoginForm">
<input type="hidden" id="loginMainDomain" name="loginMainDomain" value="<?=MAIN_SERVICE_DOMAIN?>" />
<input type="hidden" id="loginSubDomain" name="loginSubDomain" value="<?=SSL_SUB_DOMAIN?>" />
</form>
	
	<div id="<? if ($FRONT_INDEX_FLAG == 'on') { ?>Main-<? } ?>Wrapper">

		<!-- S: ���ټ���� �ٷΰ���޴� -->
		<div id="skipNavigation">
			<ul>
				<li><a href="#Header">���θ޴� �ٷΰ���</a></li>
				<li><a href="#AsideLeft">����޴� �ٷΰ���</a></li>
				<li><a href="#Article">���� �ٷΰ���</a></li>
			</ul>
		</div>
		<hr />
		<!--// E: ���ټ���� �ٷΰ���޴� -->

		<!--S: Top -->
		<div id="Header">

			<div id="Hgroup">
				<h1><a href="javascript:goMenu('index')"><img class="png24" src="<?=$MAIN_LOGO?>"  /></a></h1>
			</div>

			<!-- S: Navi -->
			<div id="Tm-nav">
				<ul>
					<li><a href="javascript:goMenu('projectlist');"><img src="/assets/front/design2/img/top/tm01_<?=$MENU_STATUS['projectlist']?>.gif" alt="ä�����" /></a></li>
					<li><a href="javascript:goMenu('notice');"><img src="/assets/front/design2/img/top/tm02_<?=$MENU_STATUS['notice']?>.gif" alt="��������" /></a></li>
					<li><a href="javascript:goMenu('faq');"><img src="/assets/front/design2/img/top/tm03_<?=$MENU_STATUS['faq']?>.gif" alt="FAQ" /></a></li>
					<li><a href="javascript:goMenu('qna');"><img src="/assets/front/design2/img/top/tm04_<?=$MENU_STATUS['qna']?>.gif" alt="�����ϱ�" /></a></li>
					<li><a href="javascript:goMenu('myPage');"><img src="/assets/front/design2/img/top/tm05_<?=$MENU_STATUS['myPage']?>.gif" alt="�Ի����� Ȯ�� �� ����" /></a></li>
					<li><a href="javascript:goMenu('pass');"><img src="/assets/front/design2/img/top/tm06_<?=$MENU_STATUS['pass']?>.gif" alt="�հ��� ��ǥ" /></a></li>
					<!--li><a href="javascript:goMenu('projectlist');"><img src="/assets/front/design2/img/top/tm07_off.gif" alt="ȸ��Ұ�" /></a></li-->
				</ul>
			</div>
			<!--// E: Navi -->

		</div>
		<hr />
		<!--//E: Top -->

		<div id="Section">

			<!-- S: Visual  -->
			<div id="Visual">
				<img src="<?=$FRONT_TOP_IMG_URL?>" alt="Searching People Who - Make Differences" />
			</div>
			<hr />
			<!--//E: Visual -->

			<!-- S: Left  -->
			<div id="AsideLeft">
				<div><img src="/assets/front/design2/img/left/lmt.gif" alt="ä��ȳ�" /></div>
				<ul>
					<li><a href="javascript:goMenu('projectlist');"><img src="/assets/front/design2/img/left/lm01_<?=$MENU_STATUS['projectlist']?>.gif" alt="ä�����" /></a></li>
					<li><a href="javascript:goMenu('notice');"><img src="/assets/front/design2/img/left/lm02_<?=$MENU_STATUS['notice']?>.gif" alt="��������" /></a></li>
					<li><a href="javascript:goMenu('faq');"><img src="/assets/front/design2/img/left/lm03_<?=$MENU_STATUS['faq']?>.gif" alt="FAQ" /></a></li>
					<li><a href="javascript:goMenu('qna');"><img src="/assets/front/design2/img/left/lm04_<?=$MENU_STATUS['qna']?>.gif" alt="�����ϱ�" /></a></li>
					<li><a href="javascript:goMenu('myPage');"><img src="/assets/front/design2/img/left/lm05_<?=$MENU_STATUS['myPage']?>.gif" alt="�Ի����� Ȯ�� �� ����" /></a></li>
					<li><a href="javascript:goMenu('pass');"><img src="/assets/front/design2/img/left/lm06_<?=$MENU_STATUS['pass']?>.gif" alt="�հ��� ��ǥ" /></a></li>
					<!--li><a href="javascript:goMenu('projectlist');"><img src="/assets/front/design2/img/left/lm07_off.gif" alt="ȸ��Ұ�" /></a></li-->
				</ul>
			</div>
			<hr />
			<!--// E: Left  -->

			<!-- S: Article  -->
			<div id="Article">

				<!-- S: Title -->
				<div id="Title-box">
					
					<h2><img src="/assets/front/design2/img/title/<?=$MENU_BARIMG?>" alt="�Ի����� Ȯ�� �� ����" /></h2>
					<? if ($FRONT_INDEX_FLAG == 'off') { ?><p><?=$MENU_NAVIGATION?></p><? } ?>
				</div>
				<!-- E: Title -->

				<div id="Content-box">
				<!-- S: Content -->
				<?=$LAYOUT_MAIN?>
					
				<!--// E: Content -->
				</div>

			</div>
			<hr />
			<!--// E: Article  -->

		</div>

		<!--S: Footer -->
		<div id="Footer">
			<div id="Fgroup">
				<div class="logo"><img src="/assets/front/design2/img/bottom/b_logo.gif" alt="CAREERCARE" /></div>
				<ul class="util">
					<li><a href="javascript:goMenu('contentp');"><img src="/assets/front/design2/img/bottom/b_util01.gif" alt="����������޹�ħ" /></a></li>
					<li><a href="javascript:goMenu('contentm');"><img src="/assets/front/design2/img/bottom/b_util02.gif" alt="��������ó����ħ" /></a></li>
					<li><a href="javascript:goMenu('contente');"><img src="/assets/front/design2/img/bottom/b_util03.gif" alt="�̸����ּ� ���ܼ����ź�" /></a></li>
				</ul>
				<div class="info">
					<img src="/assets/front/design2/img/bottom/copy.gif" alt="COPYRIGHT �� CAREERCARE ALL RIGHTS RESERVED" />
				</div>
			</div>
		</div>
		<!--// E: Footer  -->

	</div>

</body>
</html>
