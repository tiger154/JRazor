<?php
    //**************************************************************************************************************
    //NICE신용평가정보 Copyright(c) KOREA INFOMATION SERVICE INC. ALL RIGHTS RESERVED
    //
    //서비스명 :  체크플러스 - 본인인증 서비스
    //페이지명 :  체크플러스 - 결과 페이지
    
    //보안을 위해 제공해드리는 샘플페이지는 서비스 적용 후 서버에서 삭제해 주시기 바랍니다. 
    //**************************************************************************************************************
    
		session_start();
	
    $sitecode = "G2858";				// NICE로부터 부여받은 사이트 코드
    $sitepasswd = "IAOIBLSGG7YG";			// NICE로부터 부여받은 사이트 패스워드
    $cb_encode_path = "/wwwRoot/api/CPClient";		// NICE로부터 받은 암호화 프로그램의 위치 (절대경로+모듈명)
		
		//////////////////////////////////////////////// 문자열 점검///////////////////////////////////////////////
    if(preg_match("/[#\&\\+\-%@=V\\\:;,\.\'\"\^`~\_|\!\/\?\*$#<>()\[\]\{\}]/i", $sitecode, $match)) exit;
    if(preg_match("/[#\&\\+\-%@=\\\:;,\.\'\"\^`~\_|\!\/\?\*$#<>()\[\]\{\}]/i", $sitepasswd, $match)) exit;
		///////////////////////////////////////////////////////////////////////////////////////////////////////////
		
    $enc_data = $_POST["EncodeData"];		// 암호화된 결과 데이타
    
    $sReserved1 = $_POST['param_r1'];
		$sReserved2 = $_POST['param_r2'];
		$sReserved3 = $_POST['param_r3'];

    if ($enc_data != "") {
				//echo "$cb_encode_path DEC $sitecode $sitepasswd $enc_data";
				//echo '<br>';
        $plaindata = exec("$cb_encode_path DEC $sitecode $sitepasswd $enc_data");		// 암호화된 결과 데이터의 복호화
        //echo "[plaindata]  " . $plaindata . "<br>";
        
        
        
				$returnMsg = null;
				
        if ($plaindata == -1){
            $returnMsg  = "암/복호화 시스템 오류";
        }else if ($plaindata == -4){
            $returnMsg  = "복호화 처리 오류";
        }else if ($plaindata == -5){
            $returnMsg  = "HASH값 불일치 - 복호화 데이터는 리턴됨";
        }else if ($plaindata == -6){
            $returnMsg  = "복호화 데이터 오류";
        }else if ($plaindata == -9){
            $returnMsg  = "입력값 오류";
        }else if ($plaindata == -12){
            $returnMsg  = "사이트 비밀번호 오류";
        }else{
        
        }  
        
        $ciphertime = exec("$cb_encode_path CTS $sitecode $sitepasswd $enc_data");	// 암호화된 결과 데이터 검증 (복호화한 시간획득)
    		
        $requestnumber = GetValue($plaindata , "REQ_SEQ");
        $responsenumber = GetValue($plaindata , "RES_SEQ");
        $authtype = GetValue($plaindata , "AUTH_TYPE");
        $name = GetValue($plaindata , "NAME");
        $birthdate = GetValue($plaindata , "BIRTHDATE");
        $gender = GetValue($plaindata , "GENDER");
        $nationalinfo = GetValue($plaindata , "NATIONALINFO");	//내/외국인정보(개발가이드 참조)
        $dupinfo = GetValue($plaindata , "DI");
        $conninfo = GetValue($plaindata , "CI");
        
        if(strcmp($_SESSION["REQ_SEQ"], $requestnumber) != 0)
        {
        	echo "세션값이 다릅니다. 올바른 경로로 접근하시기 바랍니다.<br>";
            $requestnumber = "";
            $responsenumber = "";
            $authtype = "";
            $name = "";
        		$birthdate = "";
        		$gender = "";
        		$nationalinfo = "";
        		$dupinfo = "";
        		$conninfo = "";
        }
        
    }
?>

<?
    function GetValue($str , $name)
    {
    		
    		//echo $str .'---------' . $name . '<br>';
        $pos1 = 0;  //length의 시작 위치
        $pos2 = 0;  //:의 위치

        while( $pos1 <= strlen($str) )
        {
            $pos2 = strpos($str , ":" , $pos1);
            $len  = substr($str , $pos1 , $pos2 - $pos1);
            $key  = @substr($str , $pos2 + 1 , $len);
            $pos1 = $pos2 + $len + 1;
            if( $key == $name )
            {
                $pos2 = strpos( $str , ":" , $pos1);
                $len = substr($str , $pos1 , $pos2 - $pos1);
                $value = substr($str , $pos2 + 1 , $len);
                return $value;
            }
            else
            {
                // 다르면 스킵한다.
                $pos2 = strpos( $str , ":" , $pos1);
                $len = substr($str , $pos1 , $pos2 - $pos1);
                $pos1 = $pos2 + $len + 1;
            }
        }
    }
?>

<html>
<head>
    <title>NICE신용평가정보 - CheckPlus 본인인증 테스트</title>
</head>
<body>
    <center>
    <p><p><p><p>
    본인인증이 완료 되었습니다.<br>
    <table border=1>
        <tr>
            <td>복호화한 시간</td>
            <td><?= $ciphertime ?> (YYMMDDHHMMSS)</td>
        </tr>
        <tr>
            <td>요청 번호</td>
            <td><?= $requestnumber ?></td>
        </tr>            
        <tr>
            <td>나신평응답 번호</td>
            <td><?= $responsenumber ?></td>
        </tr>            
        <tr>
            <td>인증수단</td>
            <td><?= $authtype ?></td>
        </tr>
                <tr>
            <td>성명</td>
            <td><?= $name ?></td>
        </tr>
                <tr>
            <td>생년월일</td>
            <td><?= $birthdate ?></td>
        </tr>
                <tr>
            <td>성별</td>
            <td><?= $gender ?></td>
        </tr>
                <tr>
            <td>내/외국인정보</td>
            <td><?= $nationalinfo ?></td>
        </tr>
                <tr>
            <td>DI(64 byte)</td>
            <td><?= $dupinfo ?></td>
        </tr>
                <tr>
            <td>CI(88 byte)</td>
            <td><?= $conninfo ?></td>
        </tr>
        <tr>
          <td>RESERVED1</td>
          <td><?= $sReserved1 ?></td>
	      </tr>
	      <tr>
	          <td>RESERVED2</td>
	          <td><?= $sReserved2 ?></td>
	      </tr>
	      <tr>
	          <td>RESERVED3</td>
	          <td><?= $sReserved3 ?></td>
	      </tr>
    </table>
    </center>
</body>
</html>
