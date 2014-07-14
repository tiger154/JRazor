<?php
    //**************************************************************************************************************
    //NICE신용평가정보 Copyright(c) KOREA INFOMATION SERVICE INC. ALL RIGHTS RESERVED
    //
    //서비스명 :  체크플러스 - 본인인증 서비스
    //페이지명 :  체크플러스 - 메인 호출 페이지
    
    //보안을 위해 제공해드리는 샘플페이지는 서비스 적용 후 서버에서 삭제해 주시기 바랍니다. 
    //**************************************************************************************************************
    
    session_start();
    
    $sitecode = "G2858";				// NICE로부터 부여받은 사이트 코드
    $sitepasswd = "IAOIBLSGG7YG";			// NICE로부터 부여받은 사이트 패스워드
    
    $cb_encode_path = "/wwwRoot/api/CPClient";		// NICE로부터 받은 암호화 프로그램의 위치 (절대경로+모듈명)
    
    $authtype = "C";      	// 없으면 기본 선택화면, X: 공인인증서, M: 핸드폰, C: 카드
    $reqseq = "REQ_0123456789";     // 요청 번호, 이는 성공/실패후에 같은 값으로 되돌려주게 되므로
                                    // 업체에서 적절하게 변경하여 쓰거나, 아래와 같이 생성한다.
		$reqseq_str = "$cb_encode_path SEQ $sitecode";
    $reqseq = exec($reqseq_str);
    
    // CheckPlus(본인인증) 처리 후, 결과 데이타를 리턴 받기위해 다음예제와 같이 http부터 입력합니다.
    $returnurl = "http://login.trns.co.kr/front/recruit/AuthConfirmResult";	// 성공시 이동될 URL
    $errorurl = "http://login.trns.co.kr/front/recruit/AuthConfirmResult";		// 실패시 이동될 URL

		//////////////////////////////////////////////// 문자열 점검///////////////////////////////////////////////
    if(preg_match("/[#\&\\+\-%@=V\\\:;,\.\'\"\^`~\_|\!\/\?\*$#<>()\[\]\{\}]/i", $sitecode, $match)) exit;
    if(preg_match("/[#\&\\+\-%@=\\\:;,\.\'\"\^`~\_|\!\/\?\*$#<>()\[\]\{\}]/i", $sitepasswd, $match)) exit;
    if(preg_match("/[#\&\\+\-%@=V\\\:;,\.\'\"\^`~\_|\!\/\?\*$#<>()\[\]\{\}]/i", $authtype, $match)) exit;
    if(preg_match("/[#\&\%@=\;,\'\"\^`~\|\!\?\*$#<>()\[\]\{\}]/i", $returnurl , $match)) exit;
    if(preg_match("/[#\&\%@=\;,\'\"\^`~\|\!\?\*$#<>()\[\]\{\}]/i", $errorurl , $match)) exit;
		///////////////////////////////////////////////////////////////////////////////////////////////////////////
	
    // reqseq값은 성공페이지로 갈 경우 검증을 위하여 세션에 담아둔다.
    
    $_SESSION["REQ_SEQ"] = $reqseq;

    // 입력될 plain 데이타를 만든다.
    $plaindata =  "7:REQ_SEQ" . strlen($reqseq) . ":" . $reqseq .
			    			  "8:SITECODE" . strlen($sitecode) . ":" . $sitecode .
			    			  "9:AUTH_TYPE" . strlen($authtype) . ":". $authtype .
			    			  "7:RTN_URL" . strlen($returnurl) . ":" . $returnurl .
			    			  "7:ERR_URL" . strlen($errorurl) . ":" . $errorurl ;
    
    $enc_data = exec("$cb_encode_path ENC $sitecode $sitepasswd $plaindata");
		$returnMsg = null;
    if( $enc_data == -1 )
    { 
        $returnMsg = "암/복호화 시스템 오류입니다.";
        $enc_data = "";
    }
    else if( $enc_data== -2 )
    {
        $returnMsg = "암호화 처리 오류입니다.";
        $enc_data = "";
    }
    else if( $enc_data== -3 )
    {
        $returnMsg = "암호화 데이터 오류 입니다.";
        $enc_data = "";
    }
    else if( $enc_data== -9 )
    {
        $returnMsg = "입력값 오류 입니다.";
        $enc_data = "";
    }
?>


<html>
<head>
	<title>NICE신용평가정보 - CheckPlus 본인인증 테스트</title>
	
	<script language='javascript'>
	window.name ="Parent_window";
	
	function fnPopup(){
		window.open('', 'popupChk', 'width=500, height=461, top=100, left=100, fullscreen=no, menubar=no, status=no, toolbar=no, titlebar=yes, location=no, scrollbar=no');
		document.form_chk.action = "https://check.namecheck.co.kr/checkplus_new_model4/checkplus.cb";
		document.form_chk.target = "popupChk";
		document.form_chk.submit();
	}
	</script>
</head>
<body>
	<?= $returnMsg ?><br><br>
	업체정보 암호화 데이타 : [<?= $enc_data ?>]<br><br>

	<!-- 본인인증 서비스 팝업을 호출하기 위해서는 다음과 같은 form이 필요합니다. -->
	<form name="form_chk" method="post">
		<input type="hidden" name="m" value="checkplusSerivce">						<!-- 필수 데이타로, 누락하시면 안됩니다. -->
		<input type="hidden" name="EncodeData" value="<?= $enc_data ?>">		<!-- 위에서 업체정보를 암호화 한 데이타입니다. -->
	    
	    <!-- 업체에서 응답받기 원하는 데이타를 설정하기 위해 사용할 수 있으며, 인증결과 응답시 해당 값을 그대로 송신합니다.
	    	 해당 파라미터는 추가하실 수 없습니다. -->
		<input type="hidden" name="param_r1" value="google">
		<input type="hidden" name="param_r2" value="google">
		<input type="hidden" name="param_r3" value="godata">
	    
		<a href="javascript:fnPopup();"> CheckPlus 본인인증 Click</a>
	</form>
</body>
</html>