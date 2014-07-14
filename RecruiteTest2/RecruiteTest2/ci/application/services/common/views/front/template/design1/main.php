<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="ko" lang="ko">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=euc-kr" />
	<script language="javascript" src="/assets/js/jquery-1.8.3.js"></script>
	<script language="javascript" src="/assets/js/front/common.js"></script>
	<script language="javascript" src="/assets/js/common.js"></script>
	
	<?=$MENU_SCRIPT?>
	123
	<link rel="stylesheet" type="text/css" href="/assets/front/common/css/common.css" />
	<link rel="stylesheet" type="text/css" href="/assets/front/design1/css/default.css" />
	<title><?=$frontdesignTitle?></title>
	<!--[if IE 6]>
	 <script type="text/javascript" src="/assets/front/design1/js/DD_belatedPNG_0.0.8a-min.js"></script>
	 <script type="text/javascript">
	  DD_belatedPNG.fix('.png24, .WBg, #Section');
	 </script>
	<![endif]-->
</head>
<body onload="bodyOnLoad();">
<form name="sslLoginForm" id="sslLoginForm">
<input type="hidden" id="loginMainDomain" name="loginMainDomain" value="<?=MAIN_SERVICE_DOMAIN?>" />
<input type="hidden" id="loginSubDomain" name="loginSubDomain" value="<?=SSL_SUB_DOMAIN?>" />
</form>
	<div class="WBg">
		<div id="<? if ($FRONT_INDEX_FLAG == 'on') { ?>Main-<? } ?>Wrapper">	

			<!-- S: ���ټ���� �ٷΰ���޴� -->
			<div id="skipNavigation">
				<ul>
					<li><a href="#Aside">�޴� �ٷΰ���</a></li>
					<li><a href="#Article">���� �ٷΰ���</a></li>
				</ul>
			</div>
			<hr />
			<!--// E: ���ټ���� �ٷΰ���޴� -->

			<!--S: Top -->
			<div id="Header">
				<h1><a href="javascript:goMenu('index')"><img class="png24" src="<?=$MAIN_LOGO?>"  /></a></h1>
			</div>
			<hr />
			<!--//E: Top -->

			<div id="Section">
				<div id="atBox">
				
					<!-- S: Left  -->
					<div id="Aside">
						<div><img src="/assets/front/design1/img/left/lmt.gif" alt="ä��ȳ�" /></div>
						<ul>
							<li><a href="javascript:goMenu('projectlist');"><img src="/assets/front/design1/img/left/lm01_<?=$MENU_STATUS['projectlist']?>.gif" alt="ä�����" /></a></li>
							<li><a href="javascript:goMenu('notice');"><img src="/assets/front/design1/img/left/lm02_<?=$MENU_STATUS['notice']?>.gif" alt="��������" /></a></li>
							<li><a href="javascript:goMenu('faq');"><img src="/assets/front/design1/img/left/lm03_<?=$MENU_STATUS['faq']?>.gif" alt="FAQ" /></a></li>
							<li><a href="javascript:goMenu('qna');"><img src="/assets/front/design1/img/left/lm04_<?=$MENU_STATUS['qna']?>.gif" alt="�����ϱ�" /></a></li>
							<li><a href="javascript:goMenu('myPage');"><img src="/assets/front/design1/img/left/lm05_<?=$MENU_STATUS['myPage']?>.gif" alt="�Ի����� Ȯ�� �� ����" /></a></li>
							<li><a href="javascript:goMenu('pass');"><img src="/assets/front/design1/img/left/lm06_<?=$MENU_STATUS['pass']?>.gif" alt="�հ��� ��ǥ" /></a></li>
							<!--li><a href="javascript:goMenu('intro');"><img src="/assets/front/design1/img/left/lm07_<?=$MENU_STATUS['intro']?>.gif" alt="ȸ��Ұ�" /></a></li-->
						</ul>
					</div>
					<hr />
					<!--// E: Left  -->

					<div id="Article">

						<!-- S: Visual  -->						
						<div id="Visual">
							<img src="<?=$FRONT_TOP_IMG_URL?>"  />
						</div>
						<hr />
						<!--//E: Visual -->

						<!-- S: Title -->
						<div id="Title-box">
							<h2><img src="/assets/front/design1/img/title/<?=$MENU_BARIMG?>" alt="ä�����" /></h2>
							<? if ($FRONT_INDEX_FLAG == 'off') { ?><p><?=$MENU_NAVIGATION?></p><? } ?>
						</div>
						<!-- E: Title -->

						<div id="Content-box">
						<!-- S: Content -->

						<?=$LAYOUT_MAIN?>

						<!--// E: Content -->
						</div>				

					</div>

				</div>
			</div>
			<hr />

			<!--S: Footer -->
			<div id="Footer">
				<div id="Fgroup">
					<p class="mgb10"><img src="/assets/front/design1/img/bottom/tel.gif" alt="���� : 02-2286-3811" /></p>

					<!-- S: popup -->
					<!--div id="Popup">
						<ul class="num">							
							<li class="on">										
								<a href="#"><img src="/assets/front/design1/img/bottom/popup_on.gif" alt="01" /></a>
								<p><a href="#"><img src="/assets/front/design1/img/bottom/popup_img.gif" alt="Ŀ�����ɾ� ���� ä��" /></a></p>
							</li>	
							<li class="">										
								<a href="#"><img src="/assets/front/design1/img/bottom/popup_off.gif" alt="02" /></a>
								<p><a href="#"><img src="/assets/front/design1/img/bottom/popup_img.gif" alt="Ŀ�����ɾ� ���� ä��" /></a></p>
							</li>	
							<li class="">										
								<a href="#"><img src="/assets/front/design1/img/bottom/popup_off.gif" alt="03" /></a>
								<p><a href="#"><img src="/assets/front/design1/img/bottom/popup_img.gif" alt="Ŀ�����ɾ� ���� ä��" /></a></p>
							</li>	
						</ul>
					</div-->
					<!--// E: popup -->

					<ul class="util">
						<li><a href="javascript:goMenu('contentp');"><img class="png24" src="/assets/front/design1/img/bottom/b_util01.png" alt="����������޹�ħ" /></a></li>
						<li><a href="javascript:goMenu('contentm');"><img class="png24" src="/assets/front/design1/img/bottom/b_util02.png" alt="��������ó����ħ" /></a></li>
						<li><a href="javascript:goMenu('contente');"><img class="png24" src="/assets/front/design1/img/bottom/b_util03.png" alt="�̸����ּ� ���ܼ����ź�" /></a></li>
					</ul>

					<div class="info">
						<img class="png24" src="/assets/front/design1/img/bottom/copy.png" alt="COPYRIGHT �� CAREERCARE ALL RIGHTS RESERVED" />
					</div>

				</div>
			</div>
			<!--// E: Footer  -->

		</div>
	</div>

</body>
</html>
