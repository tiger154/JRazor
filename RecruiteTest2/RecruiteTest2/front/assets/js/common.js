function isDate(txtDate)
{
  var currVal = txtDate;
  if(currVal == '')
    return false;
  
  
  //Declare Regex  
  var rxDatePattern = /^(\d{4})(\/|-)(\d{1,2})(\/|-)(\d{1,2})$/; 
  var dtArray = currVal.match(rxDatePattern); // is format OK?

  if (dtArray == null)
     return false;

  dtMonth = dtArray[3];
  dtDay= dtArray[5];
  dtYear = dtArray[1];

  if (dtMonth < 1 || dtMonth > 12)
      return false;
  else if (dtDay < 1 || dtDay> 31)
      return false;
  else if ((dtMonth==4 || dtMonth==6 || dtMonth==9 || dtMonth==11) && dtDay ==31)
      return false;
  else if (dtMonth == 2)
  {
     var isleap = (dtYear % 4 == 0 && (dtYear % 100 != 0 || dtYear % 400 == 0));
     if (dtDay> 29 || (dtDay ==29 && !isleap))
          return false;
  }
  return true;
}
//숫자 2자리에 맞게 뿌릴려고 만든함수
function setNum2str(obj)
{
	var setval = obj.value;
	if (obj.value != '' )
	{
		if ( Number(obj.value) < 10 )
		{
			setval = '0' + Number(obj.value);
		}
		$("#" + obj.id).val(setval);
	}
}

function DataSet(code,arg)
{

	if ( document.getElementById(code) )
	{
		$("#" + code).val(arg);
	}
	
}

function SelDataSet(code1,code2)
{
//	alert(code1 + '-------' + code2);
	if ( document.getElementById(code1) && document.getElementById(code2)  )
	{
		
		$("#" + code2).val('');
		if ($('#' + code1 + ' option:selected').val() != '')
		{
			//alert($('#' + code1 + ' option:selected').val());
			//alert($('#' + code1 + ' option:selected').text());
			$("#" + code2).val($('#' + code1 + ' option:selected').text());
		}
	}
}

function has_duplicates(arr) {

    var x = {}, len = arr.length;
    for (var i = 0; i < len; i++) {
        if (x[arr[i]] === true) {
             return true;
        }
        x[arr[i]] = true;
    }
    return false;

}


function fncCheckByte(objID, objTargetID, intMaxBytes)
	{    
	   var len = 0, j;    
	   var strCurrentText = document.getElementById(objID).value;


	   for (i = 0, j = strCurrentText.length; i < j; i++, len++) 
	   {
	       if ((strCurrentText.charCodeAt(i) < 0) || (strCurrentText.charCodeAt(i) > 127))
	       {      
	           len = len + 1;     
	       }    
	       
	       if (len >= intMaxBytes) 
	       {      
	           alert(intMaxBytes + "Bytes 까지 입력가능합니다.");
	           document.getElementById(objID).value = strCurrentText.substring(0, i);
	           //document.getElementById(objID).readOnly = true;
	           document.getElementById(objID).blur();
	           return;
	       }
	       //document.getElementById(objTargetID).value = len + 1;
	       $("#" + objTargetID).html( Number(len + 1 ) + ' / ' + intMaxBytes + ' Bytes');
	   }
	}
	
	function CheckData(obj,check_type)
	{
		if (check_type == 'digits')
		{
			if (obj.value != '' && !obj.value.match(/^[0-9]+$/))
			{
				alert('숫자만 입력가능합니다.');
				obj.value = '';
				obj.focus();
				return 'error';
			}
		}
		
		if (check_type == 'float')
		{
			
			if (obj.value != '' && !obj.value.match(/^[0-9]+\.[0-9]+$/))
			{
				alert('소숫점형태만 입력가능합니다.');
				obj.value = '';
				obj.focus();
				return 'error';
			}
		}
		
		
		if (check_type == 'eng')
		{
				//alert(obj.value);
			if (obj.value != '' && !obj.value.match(/^[A-Z|a-z]+$/))
			{
				alert('영문만 입력가능합니다.');
				obj.value = '';
				obj.focus();
				return 'error';
			}
		}
		
		if (check_type == 'engdigits')
		{
			if (obj.value != '' && !obj.value.match(/^[A-Z|a-z|0-9]+$/))
			{
				alert('영문숫자만 입력가능합니다.');
				obj.value = '';
				obj.focus();
				return 'error';
			}
		}
		
	}
	
	function goPopup(code,stdt,eddt,p_width,p_height,flag)
	{
		if (notice_getCookie( "winPopup" + code) != "done" )
		{
			if (flag == 'W')
			{
				$.popup({'url':'/front/popup?code=' + code,'type':'browser','name':'win_pop_' + code,'width':p_width+'px','height':p_height+'px','left':'50px','top':'50px','scrollbars':'no','center':false});
			}
			
			if (flag == 'L')
			{
				$.popup({'url':'/front/popup?code=' + code,'type':'layer','name':'win_pop_' + code,'width':p_width+'px','height':p_height+'px','left':'50px','top':'50px','center':false});
			}
		}
	}
	
	function closePopup(code)
	{
		$(".win_pop_" + code).hide();
	}
	
	function notice_getCookie( name ){
		
		var nameOfCookie = name + "=";
		var x = 0;
		while ( x <= document.cookie.length )
		{
			var y = (x+nameOfCookie.length);
			if ( document.cookie.substring( x, y ) == nameOfCookie ) {
			if ( (endOfCookie=document.cookie.indexOf( ";", y )) == -1 )
			endOfCookie = document.cookie.length;
			return unescape( document.cookie.substring( y, endOfCookie ) );
			}
			x = document.cookie.indexOf( " ", x ) + 1;
			if ( x == 0 )
			break;
		}
		return "";
		
	}
	 