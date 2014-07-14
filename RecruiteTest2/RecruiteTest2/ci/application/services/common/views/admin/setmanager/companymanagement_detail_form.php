<script language="javascript" src="/assets/js/jquery.validate.js"></script>
<script>
	$(document).ready(function(){
		
				$("#form1").validate({  
	
				groups: {
					CMP_NO: "CMP_NO1 CMP_NO2 CMP_NO3",
					CRP_NO: "CRP_NO1 CRP_NO2",
					CMP_TEL: "CMP_TEL1 CMP_TEL2 CMP_TEL3",
					CMP_FAX: "CMP_FAX1 CMP_FAX2 CMP_FAX3"
				},
				
		    rules: {  
			
		        COMP_ID: {
		        	required:true,  
		        	digitchars:true,
		        	minlength:5,
		        	maxlength:15,
		        	remote: { 
		        		url : "/admin/companyManagement/checkCompanyId" , 
		        		type : "POST" ,
		        		data : { 
		        				COMP_ID:function() { 
		        						return $("#COMP_ID").val(); 
		        				} 
		        		}
		        	}
		        },
		        COMP_NM: { required:true },
	        	CMP_NO3: { required:true,digits:true,minlength:5 },
	        	CMP_NO2: { required:true,digits:true,minlength:2 },
		        CMP_NO1: { required:true,digits:true,minlength:3 },
		      	APPLY_SITE_TITLE: { required:true},
		      	APPLY_SITE_TEMPLATE: { required:true},
		        CRP_NO1: { required:true,digits:true},
		        CRP_NO2: { required:true,digits:true},
		        <? if ($COMP_ID == null) { ?>
		        DOMAIN_ID: { 
		        	required:true,
		        	digitchars:true,
		        	minlength:2,
		        	maxlength:20,
		        	remote: { 
		        		url : "/admin/companyManagement/checkCompanyDomain" , 
		        		type : "POST" ,
		        		data : { 
		        				DOMAIN_ID:function() { 
		        						return $("#DOMAIN_ID").val(); 
		        				} 
		        		}
		        	}
		        	},
		        <? }?>
		        CEO_NM: { required:true },
		        
		      	CMP_TEL1: { required:true },
		      	CMP_TEL2: { required:true,digits:true,minlength:3 },
		      	CMP_TEL3: { required:true,digits:true,minlength:4 },
		      	CMP_FAX1: { required:true },
		      	CMP_FAX2: { required:true,digits:true,minlength:3 },
		      	CMP_FAX3: { required:true,digits:true,minlength:4 },
		      	CMP_ADD: { required:true },
		      	CMP_TP: { required:true },
		      	CMP_GUBUN: { required:true }
		    },  
		    onkeyup:false,
		    messages: {
		    		COMP_ID:{
		    			required : "기업아이디를 입력하세요.(최소 5자리. 최대 15자리 영문숫자만 가능)",
		    			digitchars:"숫자,영문만 가능합니다.",
		        	minlength:"기업아이디를 입력하세요.(최소 5자리. 최대 15자리 영문숫자만 가능)",
		        	maxlength:"기업아이디를 입력하세요.(최소 5자리. 최대 15자리 영문숫자만 가능)",
		    			remote : "이미등록된 아이디 입니다."
		    		},  
		    		COMP_NM:"기업명을 입력하세요.",
		    		CMP_NO1:{
		    				required:"사업자등록번호를 입력하세요",
		    				digits:"숫자만 입력가능합니다."
		    		},
		    		CMP_NO2:{
		    				required:"사업자등록번호를 입력하세요",
		    				digits:"숫자만 입력가능합니다."
		    		},
		    		CMP_NO3:{
		    				required:"사업자등록번호를 입력하세요",
		    				digits:"숫자만 입력가능합니다."
		    		},
		    		CRP_NO1:{
		    				required:"법인등록번호를 입력하세요",
		    				digits:"숫자만 입력가능합니다."
		    		},
		    		CRP_NO2:{
		    				required:"법인등록번호를 입력하세요",
		    				digits:"숫자만 입력가능합니다."
		    		},
		    		APPLY_SITE_TITLE: {required:"접수 사이트 제목을 입력하세요."},
		      	APPLY_SITE_TEMPLATE: { required:"디자인 템플릿을 선택하세요."},
		    		DOMAIN_ID:{
		    				required:"도메인명을 입력하세요.",
		    				digitchars:"숫자,영문만 가능합니다.",
		    				maxlength:"최대20자 입니다.",
		    				minlength:"최소2자 입니다.",
		    				remote:"이미등록된 도메인 입니다."
		    		},
		    		CEO_NM:"대표자명을 입력하세요",
		    		CMP_TEL1:{
		    				required:"대표번호를 입력하세요."
		    		},
		    		CMP_TEL2:{
		    				required:"대표번호를 입력하세요.",
		    				digits:"숫자만 입력가능합니다.",
		    				minlength:"최소3자리 입니다."
		    		},
		    		CMP_TEL3:{
		    				required:"대표번호를 입력하세요.",
		    				digits:"숫자만 입력가능합니다.",
		    				minlength:"최소4자리 입니다."
		    		},
		    		CMP_FAX1:{
		    				required:"팩스번호를 선택하세요."
		    		},
		    		CMP_FAX2:{
		    				required:"팩스번호를 입력하세요.",
		    				digits:"숫자만 입력가능합니다.",
		    				minlength:"최소3자리 입니다."
		    		},
		    		CMP_FAX3:{
		    				required:"팩스번호를 입력하세요.",
		    				digits:"숫자만 입력가능합니다.",
		    				minlength:"최소4자리 입니다."
		    		},
		    		CMP_ADD:"사업장 소재지를 입력하세요",
		    		CMP_TP:"업태를 입력하세요",
		    		CMP_GUBUN:"업종을 입력하세요"
		    		
		    },
		   
		    submitHandler: function(form) { 

		    	form.submit();

		    }
   	});  
   	
	});
	
	function processForm()
	{
		$("#submit_button").click();
	}
	
	
</script>
<style>
	
	#tmpl_list ul {float:left}
	#tmpl_list li {width:160px;text-align:center}
	
</style>
<form name="form1" id="form1" enctype="multipart/form-data" method="post" action="/admin/companyManagement/companyInfoProcess">
					<!-- S: 작성 -->
					<table class="BdView-Type01" summary="게시물 제목, 번호, 작성자, 등록일, 조회수, 첨부파일 및 내용을 볼 수 있습니다.">
						<caption>게시글 상세보기</caption>
						<colgroup>
							<col width="110px" />
							<col width="105px" />
							<col width="110px" />
							<col width="*" />
						</colgroup>
						
						<tbody>
							<? if ($COMP_ID == null) { ?>
							<tr>
								<th scope="row" colspan="3">
									<span class="item">*</span>
									<label for="w01">기업 아이디</label>
								</th>
								<td>
									<input type="text" name="COMP_ID" id="COMP_ID"  value="<?=$COMP_NM?>" style="width:18%;"  />
									<label class="error" for="COMP_ID" generated="true" style="display:none;color:red;">error message</label>
								</td>
							</tr>
							<? } ?>
							<tr>
								<th scope="row" colspan="3">
									<span class="item">*</span>
									<label for="w01">기업 명</label>
								</th>
								<td>
									<input type="text" name="COMP_NM" id="COMP_NM" title="기업 명" value="<?=$COMP_NM?>" style="width:38%;" />
									<label class="error" for="COMP_NM" generated="true" style="display:none;color:red;">error message</label>
								</td>
							</tr>
							<tr>
								<th scope="row" colspan="3">
									<span class="item">*</span>
									<label for="w02">사업자 등록번호</label>
								</th>
								<td>
									<input type="text" name="CMP_NO1" id="CMP_NO1" title="사업자 등록번호 입력하세요" style="width:30px;" maxlength="3" value="<?=$CMP_NO1?>"/>
									-
									<input type="text" name="CMP_NO2" id="CMP_NO2" title="사업자 등록번호 입력하세요" style="width:20px;" maxlength="2" value="<?=$CMP_NO2?>"  />
									-
									<input type="text" name="CMP_NO3" id="CMP_NO3" title="사업자 등록번호 입력하세요" style="width:50px;" maxlength="5" value="<?=$CMP_NO3?>"  />
									<label class="error" for="CMP_NO" generated="true" style="display:none;color:red;">error message</label>
								
								</td>
							</tr>
							<tr>
								<th scope="row" colspan="3">
									<span class="item">*</span>
									<label for="w03">법인 등록번호</label>
								</th>
								<td>
									<input type="text" name="CRP_NO1" id="CRP_NO1" title="법인 등록번호 입력" style="width:60px;" maxlength="6" value="<?=$CRP_NO1?>" />
									-
									<input type="text" name="CRP_NO2" id="CRP_NO2" title="법인 등록번호 입력" style="width:70px;" maxlength="7" value="<?=$CRP_NO2?>"  />
									<label class="error" for="CRP_NO" generated="true" style="display:none;color:red;">error message</label>
								</td>
							</tr>
							<tr>
								<th scope="row" colspan="3">
									<span class="item">*</span>
									<label for="w04a">채용 솔루션 2차 도메인 이름</label>
								</th>
								<td>
									<? if ($COMP_ID == null) { ?>
									<input type="text" name="DOMAIN_ID" id="DOMAIN_ID" title="채용 솔루션 2차 도메인 이름 입력" style="width:170px;" value="<?=$DOMAIN_ID?>"  />
									<label  class="error" for="DOMAIN_ID" generated="true" style="display:none;color:red;">error message</label>
									<? } ?>
									
									<? if ($COMP_ID != null) { ?>
									<?=$DOMAIN_ID?> <input type="hidden" id="DOMAIN_ID" name="DOMAIN_ID" value="<?=$DOMAIN_ID?>" />
									<? } ?>
									
								</td>
							</tr>
							<tr>
								<th scope="row" colspan="3">
									<span class="item">*</span>
									<label for="w05a">대표자 정보</label>
								</th>
								<td>
										<input type="text" name="CEO_NM" id="CEO_NM" title="대표자 정보 입력" style="width:170px;" value="<?=$CEO_NM?>" />
										<label class="error" for="CEO_NM" generated="true" style="display:none;color:red;">error message</label>
									</td>
							</tr>
							<tr>
								<th scope="row" colspan="3">
									<span class="item">*</span>
									<label for="w06a">대표 번호</label>
								</th>
								<td>
									<?=$SELECTBOX_TEL?>
									-
									<input type="text" name="CMP_TEL2" id="CMP_TEL2" title="대표 번호 입력" style="width:40px;" value="<?=$TEL2?>" maxlength="4" />
									-
									<input type="text" name="CMP_TEL3" id="CMP_TEL3" title="대표 번호 입력" style="width:40px;" value="<?=$TEL3?>" maxlength="4" />
									<label class="error" for="CMP_TEL" generated="true" style="display:none;color:red;">error message</label>
								</td>
							</tr>
							<tr>
								<th scope="row" colspan="3">
									<span class="item">*</span>
									<label for="w07">팩스 번호</label>
								</th>
								<td>
									<?=$SELECTBOX_FAX?>
									-
									<input type="text" name="CMP_FAX2" id="CMP_FAX2" title="팩스 번호 입력" style="width:40px;" value="<?=$FAX2?>" maxlength="4"  />
									-
									<input type="text" name="CMP_FAX3" id="CMP_FAX3" title="팩스 번호 입력" style="width:40px;" value="<?=$FAX3?>" maxlength="4"  />
									<label class="error" for="CMP_FAX" generated="true" style="display:none;color:red;">error message</label>
								</td>
							</tr>
							<tr>
								<th scope="row" colspan="3">
									<span class="item">*</span>
									<label for="w07">사업장 소재지</label>
								</th>
								<td>
									<input type="text" name="CMP_ADD" id="CMP_ADD" title="사업장 소재지 입력" style="width:200px;" value="<?=$CMP_ADD?>" />
									<label class="error" for="CMP_ADD" generated="true" style="display:none;color:red;">error message</label>
								</td>
							</tr>
							<tr>
								<th scope="row" colspan="3">
									<span class="item">*</span>
									<label for="w07">사업의 종류 - 업태</label>
								</th>
								<td>
									<input type="text" name="CMP_TP" id="CMP_TP" title="사업의 종류 - 업태 명 입력" style="width:200px;" value="<?=$CMP_TP?>" />
									<label class="error" for="CMP_TP" generated="true" style="display:none;color:red;">error message</label>
								</td>
							</tr>
							<tr>
								<th scope="row" colspan="3">
									<span class="item">*</span>
									<label for="w07">사업의 종류 - 업종</label>
								</th>
								<td>
									<input type="text" name="CMP_GUBUN" id="CMP_GUBUN" title="사업의 종류 - 업종 명 입력" style="width:200px;" value="<?=$CMP_GUBUN?>" />
									<label class="error" for="CMP_GUBUN" generated="true" style="display:none;color:red;">error message</label>
								</td>
							</tr>
							<tr>
								<th scope="row" colspan="3">
									<span class="item">*</span>
									<label for="w07">접수 사이트 TITLE</label>
								</th>
								<td>
									<input type="text" name="APPLY_SITE_TITLE" id="APPLY_SITE_TITLE" title="접수 사이트 제목" style="width:200px;" value="<?=$APPLY_SITE_TITLE?>" />
									<label class="error" for="APPLY_SITE_TITLE" generated="true" style="display:none;color:red;">error message</label>
								</td>
							</tr>
							<tr>
								<th scope="row" colspan="3">
									<span class="item">*</span>
									<label for="w07">접수 사이트 템플릿</label>
								</th>
								<td>
									
									<div id="tmpl_list">
									<ul>
										<li>main:700x340 sub:700x232</li>
										<li><img src="/assets/img/template_thumb/design1.jpg" /></li>
										<li><input class="radio" type="radio" name="APPLY_SITE_TEMPLATE" id="APPLY_SITE_TEMPLATE" title="접수 사이트 템플릿" value="design1" <?=$APPLY_SITE_TEMPLATE == 'design1' ? ' checked ' : '' ?> /></li>
									</ul>
									<ul>
										<li>main:900x420 sub:900x210</li>
										<li><img src="/assets/img/template_thumb/design2.jpg" /></li>
										<li><input class="radio" type="radio" name="APPLY_SITE_TEMPLATE" id="APPLY_SITE_TEMPLATE" title="접수 사이트 템플릿" value="design2" <?=$APPLY_SITE_TEMPLATE == 'design2' ? ' checked ' : '' ?> /></li>
									</ul>
									<ul>
										<li>main:980x440 sub:980x250</li>
										<li><img src="/assets/img/template_thumb/design3.jpg" /></li>
										<li><input class="radio" type="radio" name="APPLY_SITE_TEMPLATE" id="APPLY_SITE_TEMPLATE" title="접수 사이트 템플릿" value="design3" <?=$APPLY_SITE_TEMPLATE == 'design3' ? ' checked ' : '' ?> /></li>
									</ul>
									
									</div>
									
									<label class="error" for="APPLY_SITE_TEMPLATE" generated="true" style="display:none;color:red;">error message</label>
								</td>
							</tr>
							<tr>
								<th scope="row" colspan="3" rowspan="2">
								
									<label for="w07">기업 LOGO 등록</label>
								</th>
								<td>
									<input type="file" name="LOGO_IMG1" id="LOGO_IMG1" title="기업 LOGO 입력" style="width:38%;"/>

									<img src="<?=$LOGO_IMG1?>" id="id_logo_img1" width="203" height="36" >
								</td>
							</tr>
							<tr>
								
								<td>
									<input type="file" name="LOGO_IMG2" id="LOGO_IMG2" title="기업 LOGO 입력" style="width:38%;" />
									<img src="<?=$LOGO_IMG2?>" id="id_logo_img2" width="203" height="36" >
								</td>
							</tr>
							
							<tr>
								<th scope="row" colspan="3" rowspan="2">
								
									<label for="w07">접수사이트 TOP이미지</label>
								</th>
								<td>
									<input type="file" name="TOP_IMG1" id="TOP_IMG1" title="메인 이미지  입력" style="width:38%;"/>

									<img src="<?=$FRONT_MAIN_IMG?>" id="id_logo_img1" width="203" height="36" >
								</td>
							</tr>
							<tr>
								
								<td>
									<input type="file" name="TOP_IMG2" id="TOP_IMG2" title="서브 이미지 입력" style="width:38%;" />
									<img src="<?=$FRONT_SUB_IMG?>" id="id_logo_img2" width="203" height="36" >
								</td>
							</tr>
							
							<tr>
								<th scope="row" colspan="3">
									<label for="w07">Q&A 접수 메일 받기</label>
								</th>
								<td>
									<input type="radio" name="QNA_MAIL" id="QNA_MAIL" value="Y" class="radio" <? if ($QNA_MAIL == 'Y' OR $QNA_MAIL == null) echo ' checked '; ?> /><label for="w06a" class="mgr5">가능</label>
									<input type="radio" name="QNA_MAIL" id="QNA_MAIL" value="N" class="radio" <? if ($QNA_MAIL == 'N') echo ' checked '; ?>  /><label for="w06b">불가능</label>
								</td>
							</tr>
							<tr>
								<th scope="row" colspan="3">
									<label for="w07">운영 현황</label>
								</th>
								<td>
									<input type="radio" name="SRV_STS" id="SRV_STS" value="Y" class="radio" <? if ($SRV_STS == 'Y' OR $QNA_MAIL == null) echo ' checked '; ?>  /><label for="w06a" class="mgr5">가능</label>
									<input type="radio" name="SRV_STS" id="SRV_STS" value="N" class="radio" <? if ($SRV_STS == 'N') echo ' checked '; ?>  /><label for="w06b">불가능</label>
								</td>
							</tr>
							<tr>
								<th scope="row" colspan="3">
									<label for="w07">프로젝트 생성 가능</label>
								</th>
								<td>
									<input type="radio" name="PRJ_MNG" id="PRJ_MNG" value="Y" class="radio" <? if ($PRJ_MNG == 'Y' OR $QNA_MAIL == null) echo ' checked '; ?>  /><label for="w06a" class="mgr5">가능</label>
									<input type="radio" name="PRJ_MNG" id="PRJ_MNG" value="N" class="radio" <? if ($PRJ_MNG == 'N') echo ' checked '; ?>  /><label for="w06b">불가능</label>
								</td>
							</tr>
							
						</tbody>
					</table>		
					
					<!--// E: 작성 -->
					
					<input type="hidden" name="LOGO_IMG1_FILE" id="LOGO_IMG1_FILE" value="<?=$LOGO_IMG1_FILE?>" />
					<input type="hidden" name="LOGO_IMG2_FILE" id="LOGO_IMG2_FILE" value="<?=$LOGO_IMG2_FILE?>" />
					
					<input type="hidden" name="process_type" id="process_type" value="<?=$process_type?>" />
					<? if ($COMP_ID != null) { ?>
					<input type="hidden" name="COMP_ID" id="COMP_ID" value="<?=$COMP_ID?>" />
					<? } ?>
					<input type="submit" id="submit_button" style="display:none">
					<div class="txtC">
						<span class="btn01"><a href="javascript:processForm();">확인</a></span>
					
						<span class="btn02"><a href="javascript:goLink('<?=$backURL?>')">돌아가기</a></span>
					
					</div>
	</form>			