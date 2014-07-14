<?
$CI =& get_instance();
$CI->load->library('DataControl');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="ko" lang="ko">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=euc-kr" />
	<link rel="stylesheet" type="text/css" href="/assets/css/default.css" />
	<title>명찰 출력</title>
</head>
<body class="bgWhite" onload="print();">

	<div id="Name-tag">

		<ul class="list">
		<? 
		$pageLine = 8;
		foreach ($rlist as $key => $slist)
		{
		?>
			<li>
				<dl>
					<dt><?=$slist->COL1?></dt>
					<dd class="photo"><div><img src="<?=APPLY_PHOTO_URL?>/<?=$PRJ_IDX?>/<?=$slist->APPL_IDX?>.jpg" alt="증명사진"/></div></dd>
					<dd><?=$slist->COL2?></dd>
					<dd><?=$slist->COL3?></dd>
					<dd class="logo"><img src="<?=$CI->datacontrol->getLogoPath($DOMAIN_ID,1)?>" alt="LOGO"/></dd>
				</dl>
			</li>
		<?
		}
		?>
		</ul>
	</div>

</body>
</html>
