<?php
    //**************************************************************************************************************
    //NICE�ſ������� Copyright(c) KOREA INFOMATION SERVICE INC. ALL RIGHTS RESERVED
    //
    //���񽺸� :  üũ�÷��� - �������� ����
    //�������� :  üũ�÷��� - ���� ȣ�� ������
    
    //������ ���� �����ص帮�� ������������ ���� ���� �� �������� ������ �ֽñ� �ٶ��ϴ�. 
    //**************************************************************************************************************
    
    session_start();
    
    $sitecode = "G2858";				// NICE�κ��� �ο����� ����Ʈ �ڵ�
    $sitepasswd = "IAOIBLSGG7YG";			// NICE�κ��� �ο����� ����Ʈ �н�����
    
    $cb_encode_path = "/wwwRoot/api/CPClient";		// NICE�κ��� ���� ��ȣȭ ���α׷��� ��ġ (������+����)
    
    $authtype = "C";      	// ������ �⺻ ����ȭ��, X: ����������, M: �ڵ���, C: ī��
    $reqseq = "REQ_0123456789";     // ��û ��ȣ, �̴� ����/�����Ŀ� ���� ������ �ǵ����ְ� �ǹǷ�
                                    // ��ü���� �����ϰ� �����Ͽ� ���ų�, �Ʒ��� ���� �����Ѵ�.
		$reqseq_str = "$cb_encode_path SEQ $sitecode";
    $reqseq = exec($reqseq_str);
    
    // CheckPlus(��������) ó�� ��, ��� ����Ÿ�� ���� �ޱ����� ���������� ���� http���� �Է��մϴ�.
    $returnurl = "http://login.trns.co.kr/front/recruit/AuthConfirmResult";	// ������ �̵��� URL
    $errorurl = "http://login.trns.co.kr/front/recruit/AuthConfirmResult";		// ���н� �̵��� URL

		//////////////////////////////////////////////// ���ڿ� ����///////////////////////////////////////////////
    if(preg_match("/[#\&\\+\-%@=V\\\:;,\.\'\"\^`~\_|\!\/\?\*$#<>()\[\]\{\}]/i", $sitecode, $match)) exit;
    if(preg_match("/[#\&\\+\-%@=\\\:;,\.\'\"\^`~\_|\!\/\?\*$#<>()\[\]\{\}]/i", $sitepasswd, $match)) exit;
    if(preg_match("/[#\&\\+\-%@=V\\\:;,\.\'\"\^`~\_|\!\/\?\*$#<>()\[\]\{\}]/i", $authtype, $match)) exit;
    if(preg_match("/[#\&\%@=\;,\'\"\^`~\|\!\?\*$#<>()\[\]\{\}]/i", $returnurl , $match)) exit;
    if(preg_match("/[#\&\%@=\;,\'\"\^`~\|\!\?\*$#<>()\[\]\{\}]/i", $errorurl , $match)) exit;
		///////////////////////////////////////////////////////////////////////////////////////////////////////////
	
    // reqseq���� ������������ �� ��� ������ ���Ͽ� ���ǿ� ��Ƶд�.
    
    $_SESSION["REQ_SEQ"] = $reqseq;

    // �Էµ� plain ����Ÿ�� �����.
    $plaindata =  "7:REQ_SEQ" . strlen($reqseq) . ":" . $reqseq .
			    			  "8:SITECODE" . strlen($sitecode) . ":" . $sitecode .
			    			  "9:AUTH_TYPE" . strlen($authtype) . ":". $authtype .
			    			  "7:RTN_URL" . strlen($returnurl) . ":" . $returnurl .
			    			  "7:ERR_URL" . strlen($errorurl) . ":" . $errorurl ;
    
    $enc_data = exec("$cb_encode_path ENC $sitecode $sitepasswd $plaindata");
		$returnMsg = null;
    if( $enc_data == -1 )
    { 
        $returnMsg = "��/��ȣȭ �ý��� �����Դϴ�.";
        $enc_data = "";
    }
    else if( $enc_data== -2 )
    {
        $returnMsg = "��ȣȭ ó�� �����Դϴ�.";
        $enc_data = "";
    }
    else if( $enc_data== -3 )
    {
        $returnMsg = "��ȣȭ ������ ���� �Դϴ�.";
        $enc_data = "";
    }
    else if( $enc_data== -9 )
    {
        $returnMsg = "�Է°� ���� �Դϴ�.";
        $enc_data = "";
    }
?>


<html>
<head>
	<title>NICE�ſ������� - CheckPlus �������� �׽�Ʈ</title>
	
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
	��ü���� ��ȣȭ ����Ÿ : [<?= $enc_data ?>]<br><br>

	<!-- �������� ���� �˾��� ȣ���ϱ� ���ؼ��� ������ ���� form�� �ʿ��մϴ�. -->
	<form name="form_chk" method="post">
		<input type="hidden" name="m" value="checkplusSerivce">						<!-- �ʼ� ����Ÿ��, �����Ͻø� �ȵ˴ϴ�. -->
		<input type="hidden" name="EncodeData" value="<?= $enc_data ?>">		<!-- ������ ��ü������ ��ȣȭ �� ����Ÿ�Դϴ�. -->
	    
	    <!-- ��ü���� ����ޱ� ���ϴ� ����Ÿ�� �����ϱ� ���� ����� �� ������, ������� ����� �ش� ���� �״�� �۽��մϴ�.
	    	 �ش� �Ķ���ʹ� �߰��Ͻ� �� �����ϴ�. -->
		<input type="hidden" name="param_r1" value="google">
		<input type="hidden" name="param_r2" value="google">
		<input type="hidden" name="param_r3" value="godata">
	    
		<a href="javascript:fnPopup();"> CheckPlus �������� Click</a>
	</form>
</body>
</html>