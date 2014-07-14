<? $p_col_size = $ConstData[0]->ROW_SIZE;	 ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="ko" lang="ko">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=euc-kr" />
	<link rel="stylesheet" type="text/css" href="/assets/css/default.css" />
	<title>좌석 배치도</title>

</head>
<body class="bgWhite" onload="print();">

	<div id="Seating-Chart">

		<h1><?=$COMP_NM?></h1>

		<p class="lectern">교탁</p>
		
					<?
					echo '<div id="Seat-box">';
					foreach ($rlist as $key => $slist)
					{
						
						if ($slist->COL_SIZE == 1)
						{
							echo '<ul>';
						}
							echo '<li>';
							echo '<p>' . $slist->COL1 . '</p>';
							echo '<p>' . $slist->COL2 . '</p>';
							echo '</li>';
							
						if ($slist->COL_SIZE == $p_col_size || $slist->ORD == $slist->GUBUN_CNT)
						{
							echo '</ul>';
						}
					
					}
					echo '</div>';
				?>
	</div>

</body>
</html>
