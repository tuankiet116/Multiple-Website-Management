<div class="header" style="background: linear-gradient( 90deg ,rgb(46, 122, 242),rgba(0,65,179,1));">
	<table cellpadding="0" cellspacing="0" width="100%">
		<tr>
			<!-- <td style="width: 200px">
				<a target="_blank" href="/">
					<img src="resource/images/logoepu.svg" height="50px">
				</a>
			</td> -->
			<td>
				<i id="sidenav-hide" class="fas fa-bars" onclick="hideNav()"></i>
			</td>
			<td style="text-transform: uppercase; font-size: 16px; text-align: left; padding-left: 80px; font-family: 'Roboto';">Hệ thống chấm công nhân viên</td>
			<td style="width:46px">
				<div class="userAvatar">
					<img src="../../../images/user-icon3.png" alt="user avatar">
				</div>
			</td>
			<td style="width: 120px">
				<div class="adminControl active">
					<span> <?= $loginName ?> </span>
				</div>
			</td>
			<td style="padding-right: 20px">
				<i class="fas fa-caret-down dropdown"></i>
				<div class="sub-container">
					<table>
						<tr>
							<td>
								<a href="resource/profile/myprofile.php" id="profile_myprofile" class="tab setting" rel="Thông tin tài khoản" onclick="return false;">
									<i class="fas fa-info-circle sub-icon"></i>
									Tài khoản
								</a>
							</td>
						</tr>
						<tr>
							<td>
								<?
									//kiem tra xem neu la o tren localhost thi moi co quyen cau hinh
									$url = $_SERVER['SERVER_NAME'];
									if($isAdmin == 1 || $url == "localhost"){
								?>
								<a href="resource/configadmin/configmodule.php" id="configadmin_configmodule" class="tab setting" rel="Website Setting" onclick="return false;">
									<i class="fas fa-cog"></i>
									Cài đặt
								</a>
								<?
									}
								?>
							</td>
						</tr>
						<tr>
							<td>
								<a class="setting" href="resource/logout.php">
									<i class="fas fa-sign-out-alt"></i>
									Đăng xuất
								</a>
							</td>
						</tr>
					</table>
				</div>
				<div class="sub-close"></div>
			</td>
		</tr>
	</table>
</div>