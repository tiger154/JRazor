<? 
	// css 박스 사이즈 142 
	
	$p_row_size = $ConstData[0]->ROW_SIZE;	 
	$p_col_size = $ConstData[0]->COL_SIZE;	 
	$width_size = 146 * $p_col_size;
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="ko" lang="ko">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=euc-kr" />
	<link rel="stylesheet" type="text/css" href="/assets/css/default.css" />
	<title>명부 출력</title>
	
</head>
<body class="bgWhite" onload="print();">

	<div id="List-output" style="width:<?=$width_size?>px">

		<h1><?=$COMP_NM?></h1>
		<h2><?=$GUBUN_TITLE?></h2>
		
		<?
					echo '<div id="Seat-box3">';
					foreach ($rlist as $key => $slist)
					{
						
						if ($slist->COL_SIZE == 1) echo '<ul>';
					
							echo '<li>';
							echo '<span><p><img src="' . APPLY_PHOTO_URL .'/'. $PRJ_IDX .'/'. $slist->APPL_IDX .'.jpg" alt="증명사진"/></p></span>';
							echo '<span><p>' . $slist->COL1 . '</p><p>' . $slist->COL2 . '</p><p>' . $slist->COL3 . '</p></span>';
							echo '</li>';
							
						if ($slist->COL_SIZE == $p_row_size || $slist->ORD == $slist->GUBUN_CNT)
						{
							echo '</ul>';
						}
					
					}
					echo '</div>';
				?>	
		<br>
		<!--div id="Seat-1box">
		<? foreach ($rlist as $key => $applyList) { ?>
		<ul>
			<li>
				<dl>
					<dt><?=$applyList->COL1?></dt>
					<dd class="photo"><div><img src="<?=APPLY_PHOTO_URL .'/'. $PRJ_IDX .'/'. $applyList->APPL_IDX .'.jpg';?>" alt="증명사진"/></div></dd>
					<dd><?=$applyList->COL2?></dd>
					<dd><?=$applyList->COL3?></dd>
				</dl>
			</li>
		</ul>
		<? } ?>
		</div-->
		
		<div class="bottom">
			<div class="lefBox">
				<div class="all">총 인원 <span><?=$rlist[0]->GUBUN_CNT?> 명</span></div>
				<div class="take">응시<span> 명</span></div>
				<div class="absent">결시<span> 명</span></div>
			</div>
			<div class="rigBox">
				감독관 확인
				<span>(인)</span>
			</div>
		</div>

	</div>

</body>
</html>
