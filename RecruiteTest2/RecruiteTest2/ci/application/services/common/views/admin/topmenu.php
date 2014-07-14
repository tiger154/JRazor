				<div id="Top-Logo"><a href="/admin/projectManagement"><img src="/assets/img/logo.gif" alt="CAREERCARE"/></a></div>

				<!--  로그인 : 기업정보 -->
				<div id="Login-company">
					<span><?=$loginCompanyName?></span>
					<a href="#"><img src="/assets/img/btn/btn_on.gif" alt="on"/></a>
					<a href="javascript:goLogOut();"><img src="/assets/img/btn/btn_logout.gif" alt="Log out"/></a>
					
				</div>
				<!--//  로그인 : 기업정보 -->

				<!--  로그인 : 사용자 -->
				<div id="Login-user">
					<div class="user"><?=$loginName?>님이 로그인 하셨습니다.</div>	
					<div class="super">
					<?=$ADMIN_SELECTFORM?>
					<?=$ADMIN_SELECTBOX?>
					</div>
				</div>
				<!--//  로그인 : 사용자 -->
				<!-- 탑메뉴 -->

				<?=$menuListData?>
				<!--// 탑메뉴 -->

		