function bodyOnLoad()
{
	
}

function CheckFormDate(etcval,code)
{
	var code_ext = '';
	code_ext = '_' + code;
	if (code == '' || code == undefined) code_ext = '';
	
	var F_DATE1 = etcval + '1' + code_ext;
	var F_DATE2 = etcval + '2' + code_ext;
	var F_DATE3 = etcval + '3' + code_ext;
	
	if (CheckDate(etcval,code) == 'error')
	{
		alert('날짜를 확인하세요');
		$("#form1").find("#" + F_DATE1).val('');
		$("#form1").find("#" + F_DATE2).val('');
		if (document.getElementById(F_DATE3)) $("#form1").find("#" + F_DATE3).val('');
		return 'error';
	}
	
}

function CheckDate(etcval,code)
{
	
	//DD_STDT1_1
	//DD_STDT2_1
	//$("#" + etcval + '1' + '_' + code)
	var error_flag = '';
	var code_ext = '';
	code_ext = '_' + code;
	if (code == '' || code == undefined) code_ext = '';
	
	var F_DATE1 = etcval + '1' + code_ext;
	var F_DATE2 = etcval + '2' + code_ext;
	var F_DATE3 = etcval + '3' + code_ext;
	
	var V_DATE3 = '';
	var V_DATE = '';
	// 년/월은 필수 일자는 없을수도 있기때문에 없으면 01
	//alert(document.form1.getElementById(F_DATE1));
	if ($("#form1").find("#" + F_DATE1).val() != '' && !/^\d+$/.test($("#form1").find("#" + F_DATE1).val())) return 'error';
	if ($("#form1").find("#" + F_DATE2).val() != '' && !/^\d+$/.test($("#form1").find("#" + F_DATE2).val())) return 'error';
	
	
	if ($("#form1").find("#" + F_DATE1).length == 0 || $("#form1").find("#" + F_DATE1).length == 0)
	{
		
		return 'error';
	}
	
	V_DATE3 = '01';
	if ($("#form1").find("#" + F_DATE3).length > 0)
	{
		if ($("#form1").find("#" + F_DATE3).val() != '' && !/^\d+$/.test($("#form1").find("#" + F_DATE3).val())) return 'error';
		V_DATE3 = $("#form1").find("#" + F_DATE3).val();
	}
	
	V_DATE = $("#form1").find("#" + F_DATE1).val() + '-' + $("#form1").find("#" + F_DATE2).val() + '-' + V_DATE3;
	
	if ( $("#" + F_DATE1).val() != '' )
	{
		if ( Number($("#form1").find("#" + F_DATE1).val()) <= 1900 || Number($("#form1").find("#" + F_DATE1).val()) >= 2050 )
		{	
			return 'error';
		}
	}

	if (V_DATE.length == 10)
	{

		if (isDate(V_DATE))
		{
			
		}
		else
		{
			return 'error';
		}
		
	}
	
	return true;
	
}

function CheckTermDate(etcval,code)
{
	// 시작일자와 끝일자를 확인하여 잘된건지 안된지 확인
	// ARMY_STDT1 ARMY_EDDT1
	//if (CheckDate(etcval + 'STDT',code);
	//CheckDate(etcval + 'EDDT',code);
	
	if (CheckDate(etcval + '_STDT' , code) && CheckDate(etcval + '_EDDT' , code)) // 날짜가 정상이면
	{
		
		var code_ext = '';
		var SDATE3 = '01';
		var EDATE3 = '01';
		var SDATE = '';
		var EDATE = '';
		code_ext = '_' + code;
		
		if (code == '' || code == undefined) code_ext = '';		
		
		if ($("#form1").find("#" + etcval + '_STDT3' + code_ext).length > 0) SDATE3 = $("#form1").find("#" + etcval + '_STDT3' + code_ext).val();
		SDATE = $("#form1").find("#" + etcval + '_STDT1' + code_ext).val() + '' + $("#form1").find("#" + etcval + '_STDT2' + code_ext).val() + '' + SDATE3;
		
		if ($("#form1").find("#" + etcval + '_EDDT3' + code_ext).length > 0) SDATE3 = $("#" + etcval + '_EDDT3' + code_ext).val();
		EDATE = $("#form1").find("#" + etcval + '_EDDT1' + code_ext).val() + '' + $("#form1").find("#" + etcval + '_EDDT2' + code_ext).val() + '' + SDATE3;
		
		if (SDATE.length == 8 && EDATE.length == 8)
		{
			
			if ( Number(SDATE) < Number(EDATE) )
			{
				// 정상
			}
			else
			{
				alert('시작일자와 종료일자를 확인하세요.');
				$("#form1").find("#" + etcval + '_STDT1' + code_ext).val('');
				$("#form1").find("#" + etcval + '_STDT2' + code_ext).val('');
				$("#form1").find("#" + etcval + '_STDT3' + code_ext).val('');
				$("#form1").find("#" + etcval + '_EDDT1' + code_ext).val('');
				$("#form1").find("#" + etcval + '_EDDT2' + code_ext).val('');
				$("#form1").find("#" + etcval + '_EDDT3' + code_ext).val('');
				return 'error';
			}
		}
	}
	
	
}