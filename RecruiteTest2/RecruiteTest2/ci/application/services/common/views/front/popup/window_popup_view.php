<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="ko" lang="ko">
<head>
	<title><?=$POPUP_TITLE?></title>
	<meta http-equiv="Content-Type" content="text/html; charset=euc-kr" />
	<script language="javascript" src="/assets/js/jquery-1.8.3.js"></script>
	<script language="javascript" src="/assets/js/front/common.js"></script>
	<script language="javascript" src="/assets/js/common.js"></script>
	<link rel="stylesheet" type="text/css" href="/assets/front/common/css/common.css" />
	
	<style type="text/css">	
	body {background-color:#ffffff;}
	#layerBox {height:100%position:relative;}
	#layerInner {position:absolute; bottom:0px;right:0px;font-size:12px;background-color:#cccccc;width:100%;text-align:right}
	</style>
<script>
	
	function notice_setCookie( name, value, expiredays )
	{
		var todayDate = new Date();
		todayDate.setDate( todayDate.getDate() + expiredays );
		document.cookie = name + "=" + escape( value ) + "; path=/; expires=" + todayDate.toGMTString() + ";"
	} 
	
	function notice_closeWin() 
	{ 
		
		if ($("#Notice").is(':checked'))
		{
			notice_setCookie( "winPopup<?=$code?>", "done" , 1); // 1=하룻동안 공지창 열지 않음
		}
		parent.closePopup('<?=$code?>');
		window.close(); 
	}
	
</script>
</head>
<body>

<?=$CNTNT?>

<div id=-"layerBox">
<div id="layerInner">
1일동안 열지 않습니다. <input onclick="notice_closeWin()" id="Notice" name="Notice" type="checkbox">
</div>
</div>
	
</body>
</html>