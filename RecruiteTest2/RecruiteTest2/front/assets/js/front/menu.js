function goMenu(code,etcval)
{

	var menu_path = '';
	var ssl_flag = '';
	switch (code)
	{
		case 'projectlist' :
			menu_path = '/front/recruit';
			break;
		
		case 'apply' :
			menu_path = '/front/apply';
			break;
		
		case 'userAuth' :
			ssl_flag = 'on';
			menu_path = '/front/login/UserAuthConfirm';
			break;
		
		case 'applyLogin' :
			ssl_flag = 'on';
			menu_path = '/front/login/UserLogin';
			break;
		
		case 'passLogin' :
			ssl_flag = 'on';
			menu_path = '/front/login/PassLogin';
			break;
		
		default :
			menu_path = '/front/recruit';
			break;		
	}
	
	var m_domain = $("#loginMainDomain").val();
	var s_domain = $("#loginSubDomain").val();
	
	
	if (etcval != undefined) menu_path = menu_path + '?q=' + etcval;
	
	if (ssl_flag == 'on' )
	{
		location.href = 'https://' + s_domain + '.' + m_domain + menu_path;
	}
	else
	{
		location.href = menu_path;
	}
	
}

function bodyOnLoad()
{
	
}