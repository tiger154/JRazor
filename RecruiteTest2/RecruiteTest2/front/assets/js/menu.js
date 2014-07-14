function goLogOut()
{
	location.replace('/admin/login/logoutProcess');
}

function goLink(arg,tp,opt,opt_nm)
{
	if ( tp == 'pop' )
	{
		
		if (opt_nm != undefined && opt_nm != '')
		{
			window.open(arg,opt_nm,opt);
		}
		else
		{
			window.open(arg,'open_pops',opt);
		}
		
	} 
	else 
	{
			location.href = arg;
	}
}

function menuOnLoad(code)
{
	
	//$('#mm01').attr("class","");
	for (var x = 1; x <= 7 ; x ++ )
	{
		$('#mm0' + x).mouseover(function(event) {   
			$(this).attr("class","on");
			$('#sm' + $(this).attr("id").substr(2,2)).attr("class","on");
		});	
		
		$('#sm0' + x).mouseover(function(event) {   
			$('#mm' + $(this).attr("id").substr(2,2)).attr("class","on");
			$(this).attr("class","on");
		});
		
		
	  $('#mm0' + x).mouseout(function(event) { 
	  	$(this).attr("class","");
	  	$('#sm' + $(this).attr("id").substr(2,2)).attr("class","");
	  });
	  
	  $('#sm0' + x).mouseout(function(event) {   
			$('#mm' + $(this).attr("id").substr(2,2)).attr("class","");
			$(this).attr("class","");
		});
		
		
		
	}
	
	//$('#mm0' + code).attr("class","on");
	//$('#sm0' + code).attr("class","on");
	
	
}

// 최고관리자 사용 로그인
function goCompanyLogin()
{
	if ($("#admin_company_list_id option:selected").val() != '') 
	{
		$("#admin_login_comp_nm").val($("#admin_company_list_id option:selected").text());
		$("#admin_login_comp_id").val($("#admin_company_list_id option:selected").val());
		
		$("#AdminLoginCompForm1").attr("action","/admin/login/companyLoginProcess");
		$("#AdminLoginCompForm1").attr("method","post");
		$("#AdminLoginCompForm1").submit();	
	}
} 

function bodyOnLoad()
{
}