	
	var schTypelistAr = new Array(1,1,1,1);
	
	var schformListAr = new Array( 'SCH_CD','SCH_NM'
																,'SCH_JUYA'
																,'SCH_BRANCH_TP','SCH_LOC'
																,'SCH_STDT1','SCH_STDT2'
																,'SCH_EDDT1','SCH_EDDT2'
																,'SCH_ETTP1','SCH_ETTP2'
																,'SCH_MAJOR_NM','SCH_MAJOR_CD'
																,'SCH_SUB_MAJOR_NM','SCH_SUB_MAJOR_CD'
																,'SCH_SUB_MAJOR_TP'
																,'SCH_HAKJUM','SCH_ISU_HAKJUM','SCH_MAX_HAKJUM'
																,'SCH_AFF','SCH_SUB_AFF'
																,'SCH_DEL'
																,'SCH_IDX'
																,'BTN_SEARCH_SCHOOL'
																,'BTN_SEARCH_MAJOR'
																,'BTN_SEARCH_SUB_MAJOR');
																//,'SCH_FGRD_TP'
	var schformMsgAr = new Array('학교','학교'
															,'주/야간'
															,'본/분교 구분','소재지'
															,'입학일자[년도]','입학일자[월]'
															,'졸업일자[년도]','졸업일자[월]'
															,'입학구분','졸업구분'
															,'전공명','전공'
															,'부전공명','부전공'
															,'부전공구분'
															,'취득학점','이수학점','취득학점구분'
															,'전공계열','부전공계열'
															,'삭제'
															,'코드'
															,'학교검색'
															,'전공검색'
															,'부전공검색');
															//,'최종학력구분'
	
	function bodyOnLoadforSchool()
	{
		sch_html = $("#id_school_sample").html();
		SchDataFormCreate(0,0);
		$("#SCH_DEL_0_0").attr("style","display:none");
	}
	
	function SchDataFormLoad(code,subcode,sch_idx)
	{
		addSchData(code);
	
		$.ajax({
	    url: "/admin/stepManagement/unitLevelList?PRJ_IDX=" + $("#PRJ_IDX").val(),
	    type: "get",
	    dataType:'json',
	    //data: serializedData,
	    success: function(response, textStatus, jqXHR){
	     	
	    },
	    error: function(jqXHR, textStatus, errorThrown){
	        //console.log("The following error occured: "+textStatus, errorThrown);
	        
	    },
	    // callback handler that will be called on completion
	    // which means, either on success or error
	    complete: function(){
	    	  // enable the inputs
	    }
		});
	}
	
	// validation 체크 추가 
	function SchDataFormValidationCreate(code,subcode)
	{
		
		for (var a = 0 ;a < schformListAr.length ; a ++)
		{
			//유효성 체크하지 않을것들
			if ( !schformListAr[a].match(/BTN_SEARCH|SCH_IDX|SCH_DEL|SCH_MAJOR_CD|SCH_SUB_MAJOR_NM|SCH_SUB_MAJOR_CD|SCH_SUB_AFF/) )
			{
				
				//숫자만 입력해야할것들
				if ( schformListAr[a].match(/SCH_HAKJUM|SCH_ISU_HAKJUM|SCH_STDT1|SCH_STDT2|SCH_EDDT1|SCH_EDDT2/) )
				{
					switch(schformListAr[a])
					{
						case 'SCH_HAKJUM' :
							$("#" + schformListAr[a] + '_' + code + '_' + subcode).rules('add' , {
								required:true,
								digitsforfloat:true,
								messages:{
										digitsforfloat:"소숫점 둘째자리까지 입력하세요. 예)3.45",
										required:schformMsgAr[a] + '을(를) 확인하세요.'
								}
							});	
							break;
						case 'SCH_STDT1' :
						case 'SCH_EDDT1' :
							$("#" + schformListAr[a] + '_' + code + '_' + subcode).rules('add' , {
								required:true,
								digits:true,
								max: 2020,
								min: 1940,
								messages:{
										max:"년도를 확인하세요.",
										min:"년도를 확인하세요.",
										digits:"숫자만 입력하세요",
										required:"년도를 확인하세요."
								}
							});	
							break;
						
						case 'SCH_STDT2' :
						case 'SCH_EDDT2' :
							$("#" + schformListAr[a] + '_' + code + '_' + subcode).rules('add' , {
								required:true,
								digits:true,
								max: 12,
								min: 1,
								messages:{
										max:"월을 확인하세요.",
										min:"월를 확인하세요.",
										digits:"숫자만 입력하세요",
										required:"월을 확인하세요."
								}
							});		
							break;
						
						default :
						$("#" + schformListAr[a] + '_' + code + '_' + subcode).rules('add' , {
							required:true,
							digits:true,
							messages:{
								
									digits:"숫자만 입력하세요",
									required:schformMsgAr[a] + '을(를) 확인하세요.'
							}
						});	
							break;
					}
					
				}
				else
				{
					$("#" + schformListAr[a] + '_' + code + '_' + subcode).rules('add' , {
						required:true,
						messages:{
								required:schformMsgAr[a] + '을(를) 확인하세요.'
						}
					});	
				}
				
				
				$("#form1").validate().groups[schformListAr[a] + '_' + code + '_' + subcode] = 'SCH_GRP_MSG_' + code + '_' + subcode;
				
				
			}
		}
		
	}
	
	function SchDataFormValidation(code,subcode)
	{
		
	}
	
	function SchDataFormDisabled(code,subcode)
	{
		
		for (var a = 0 ;a < schformListAr.length ; a ++)
		{
			if (schformListAr[a] != 'SCH_DEL')
			{
				if (schformListAr[a] == 'SCH_FGRD_TP') $("#" + schformListAr[a] + '_' + code + '_' + subcode).attr('checked',false);
				else $("#" + schformListAr[a] + '_' + code + '_' + subcode).attr('disabled',true);
			}
		}
	}
	
	function SchDataFormClear(code,subcode)
	{
		for (var a = 0 ;a < schformListAr.length ; a ++)
		{
			if (schformListAr[a] != 'SCH_DEL')
			{
				if (schformListAr[a] == 'SCH_FGRD_TP') $("#" + schformListAr[a] + '_' + code + '_' + subcode).attr('checked',false);
				else $("#" + schformListAr[a] + '_' + code + '_' + subcode).val('');
			}
		}
	}
	
	function SchDataFormCreate(code,subcode)
	{
			
			
			
			//$("#" + schformListAr[a]).attr('id',schformListAr[a] + '_' + code + '_' + subcode);
			
			// append
			$("#id_school_list_" + code).append('<label id="SCH_ERROR_MESSAGE_' + code + '_' + subcode + '" class="error" for="SCH_GRP_MSG_' + code + '_' + subcode + '" generated="true" style="display:none;color:red;"></label>');
			$("#id_school_list_" + code).append($("#id_school_sample").html());
			
			// form id change
			$("#id_school_list_" + code).find("#id_sch_box_set").attr('id','id_sch_box_set' + '_' + code + '_' + subcode);
			$("#id_school_list_" + code).find("#id_sub_major_form").attr('id','id_sub_major_form' + '_' + code + '_' + subcode);
			
			// form value id change 
			for (var a = 0 ;a < schformListAr.length ; a ++)
			{
				//$("#id_school_list_" + code).find("#id_" + mainCode + "_box_set" + "_" + code).find("#" + dataCode).
				$("#id_school_list_" + code).find("#" + schformListAr[a]).attr('name',schformListAr[a] + '_' + code + '_' + subcode);
				$("#id_school_list_" + code).find("#" + schformListAr[a]).attr('id',schformListAr[a] + '_' + code + '_' + subcode);
			}
			
			// button event
			$("#id_school_list_" + code).find("#SCH_DEL" + '_' + code + '_' + subcode).click(function() { deleteSch(code,subcode); } );
			
			//$("#id_school_sample").html(sch_html);
			SchDatatFormAddEvent(code,subcode);
			//수정폼일경우
				
	}
	
		function SchDatatFormAddEvent(code,subcode)
	{
		// 귀찬타;;; 그냥 수동으로 추가합시다.
		
				$("#BTN_SEARCH_SCHOOL_" + code + "_" + subcode).click( function(){ searchPop('학교','school',code + "_" + subcode,'SCH','N','L','width=500 height=550'); } );
				$("#BTN_SEARCH_SCHOOL_" + code + "_" + subcode).attr("style","cursor:hand;");
				
				$("#BTN_SEARCH_MAJOR_" + code + "_" + subcode).click( function(){ searchPop('전공','major',code + "_" + subcode,'SCH_MAJOR','Y','L','width=500 height=550'); } );
				$("#BTN_SEARCH_MAJOR_" + code + "_" + subcode).attr("style","cursor:hand;");
				
				$("#BTN_SEARCH_SUB_MAJOR_" + code + "_" + subcode).click( function(){ searchPop('부전공','major',code + "_" + subcode,'SCH_SUB_MAJOR','Y','L','width=500 height=550'); } );
				$("#BTN_SEARCH_SUB_MAJOR_" + code + "_" + subcode).attr("style","cursor:hand;");
		
	}
	
	
	function deleteSch(code,subcode)
	{
		SchDataFormClear(code,subcode);
		$("#SCH_ERROR_MESSAGE_" + code + "_" + subcode).remove();
		$("#id_sch_box_set_" + code + "_" + subcode).remove();
		
	}
	
	function addSchData(tp)
	{
		//학교입력폼 생성
		//alert(schTypelistAr[tp - 1]);
		var err = null;
		if (schTypelistAr[tp - 1] >= 0 )
		{
			 //err = SchDataFormValidation(tp,schTypelistAr[tp - 1] -1);
		}
		
		//if (err == null)
		//{
			SchDataFormCreate(tp,schTypelistAr[tp - 1]);
			//SchDataFormValidationCreate(tp,schTypelistAr[tp - 1]);
			schTypelistAr[tp - 1] = schTypelistAr[tp - 1] + 1;
			
		//}
	}
	
	function setSubMajorType(obj)
	{
		//35 - 해당없는 코드 tbl_code - MJT - 35 
		var sch_loc_val = obj.id.replace('SCH_SUB_MAJOR_TP','');
		var selValue = $("#SCH_SUB_MAJOR_TP" + sch_loc_val + " option:selected").val();
		
		
		$("#id_sub_major_form" + sch_loc_val).attr("style","display:none");
		$("#SCH_SUB_MAJOR_CD" + sch_loc_val).val('');
		$("#SCH_SUB_MAJOR_NM" + sch_loc_val).val('');
		$("#SCH_SUB_AFF" + sch_loc_val).val('');
		
		if ( selValue != '' && selValue != '35' )
		{
			$("#id_sub_major_form" + sch_loc_val).attr("style","display:block");	
		}
		
	}
	
	function checkScore(obj)
	{
		//alert(obj.id);
		var sch_loc_val = obj.id.replace('SCH_HAKJUM','').replace('SCH_MAX_HAKJUM','');
		$("#SCH_HAKJUM" + sch_loc_val).val();
		$("#SCH_MAX_HAKJUM" + sch_loc_val).val();
		if ($("#SCH_HAKJUM" + sch_loc_val).val() != '' && $("#SCH_MAX_HAKJUM" + sch_loc_val).val() != '')
		{
			if (Number($("#SCH_HAKJUM" + sch_loc_val).val()) > Number($("#SCH_MAX_HAKJUM" + sch_loc_val).val()) )
			{
				alert('취득학점을 확인하세요.');
				$("#SCH_HAKJUM" + sch_loc_val).val('');
				$("#SCH_MAX_HAKJUM" + sch_loc_val).val('');
			}
		}
	}
	
	function setAllSchConfirm()
	{
		//현재오픈되어있는 학력사항 전체를 봐야할때 --SCH_FGRD_TP 최종학력은 전체 학력사항중에 1개만.
		
		var SCH_FGRD_TP
		var chkCount = 0;
		for(var a = 0; a < 5; a ++)
		{
			//나머지 체크
			if (a > 0)
			{
				if ($("#SCH_FGRD_TP_" + a +'_' + schTypelistAr[a]).is(':checked')) chkCount++;
			}
			// 고딩체크	
			if (a == 0)
			{
				if ($("#SCH_FGRD_TP_" + a +'_' + 0).is(':checked')) chkCount++;
			}
		}
		
		if (chkCount > 1)
		{
			alert('최종학력은 1개만 선택가능합니다.');
		}
		
	}
	