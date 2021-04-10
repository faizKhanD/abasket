	<!-- Login & Signup -->
	<div id="login" class="modal fade loginsignup" role="dialog">
		<div class="modal-dialog md-modal">
			<!-- Login box-->
			<div class="modal-content" id="loginBox">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<h4 class="modal-title"><img src="images/logo.png" alt="logo" width="140px"></h4>
				</div>
				<div class="modal-body">
					<h3>Welcome Back</h3>
					<p class="sub-title">Enter your email address to register or sign in.</p>
					
					<form action="" method="POST" id="user-loginform">
						<div class="form-group">
							<input type="email" class="form-control" placeholder="Email" id="login-email">
						</div>
						<div class="form-group">
							<input type="password" class="form-control" placeholder="Password" id="login-password">
						</div>
						<a href="#" class="forget-password">FORGOT PASSWORD</a>
						<button type="submit" class="btn btn-default" name="login">Login <i class="fa fa-send"></i></button>
						<p class="login-alert" style="display:none;color:red;">Either email or password is wrong.</p>
						<p class="login-alert1" style="display:none;color:red;">Your account is not activated.</p>
					</form>
				</div>
				<div class="modal-footer">
					<p>Not a member? <span class="signup-btn">Register</span></p>
				</div>
			</div>
			
			<!-- password box-->
			<div class="modal-content" id="forgotPasswordBox">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<h4 class="modal-title"><img src="images/logo.png" alt="logo" width="140px"></h4>
				</div>
				<div class="modal-body">
					<h3>Welcome Back</h3>
					<p class="sub-title">Enter your email address to register or sign in.</p>
					
					<form action="" method="POST" id="user-forgotpass">
						<div class="form-group">
							<input type="email" id="forgot-email" class="form-control" placeholder="Email ">
						</div>
						
						<button type="submit" class="btn btn-default">Send OTP <i class="fa fa-send"></i></button>
						<p class="forgot-alert" style="color:red;"></p>
					</form>
				</div>
				<div class="modal-footer">
					<p>Not a member? <span class="signup-btn">SIGN UP</span></p>
				</div>
			</div>
			<!-- change password-->
			<div class="modal-content" id="changePasswordBox">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<h4 class="modal-title"><img src="images/logo.png" alt="logo" width="140px"></h4>
				</div>
				<div class="modal-body">
					<h3>Welcome Back</h3>
					<p class="sub-title">Set your new password here.</p>
					
					<form action="" method="POST" id="user-forgotpass1">
					    <div class="form-group">
							<input type="text" id="forgot-otp" class="form-control" placeholder="Enter OTP">
						</div>
						<div class="form-group">
							<input type="password" id="forgot-pass" class="form-control" placeholder="New Password ">
						</div>
						<div class="form-group">
							<input type="password" id="forgot-pass1" class="form-control" placeholder="Confirm Password ">
						</div>
						<button type="submit" class="btn btn-default">RESET PASSWORD <i class="fa fa-send"></i></button>
						<p class="forgot1-alert" style="color:red;"></p>
					</form>
				</div>
				<div class="modal-footer">
					<p>Not a member? <span class="signup-btn">SIGN UP</span></p>
				</div>
			</div>
			
			<!--signup box-->
			<div class="modal-content" id="signupBox">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<h4 class="modal-title"><img src="images/logo.png" alt="logo" width="140px"></h4>
				</div>
				<div class="modal-body">
					<h3>Welcome Back</h3>
					<p class="sub-title">First time visiting? Enter your details to join in.</p>
	
					<form action="" method="POST" id="user-register">
						<div class="form-group">
							<input type="text" class="form-control" placeholder="Full Name" id="register-name">
						</div>
						<div class="form-group">
							<input type="email" class="form-control" placeholder="Email" id="register-email">
						</div>
						<div class="form-group">
							<input type="text" class="form-control" placeholder="Mobile" id="register-mobile">
						</div>
						<div class="form-group">
							<input type="password" class="form-control" placeholder="Password" id="register-password1">
						</div>
						<div class="form-group">
							<input type="password" class="form-control" placeholder="Confirm Password" id="register-password2">
						</div>
						<button type="submit" class="btn btn-default" name="register">Register <i class="fa fa-send"></i></button>
						
						<p class="register-alert" style="display:none;">You have been registered successful.</p>
						<p class="register-alert1" style="display:none;color:red;">Kindly re-check form</p>
						<p class="register-alert2" style="display:none;color:red;">Password didn't matched</p>
						<p class="register-alert3" style="display:none;color:red;">E-mail already registered</p>
						
					</form>
				</div>
				<div class="modal-footer">
					<p>Already registered? <span class="signin-btn">LOGIN</span></p>
				</div>
			</div>
		</div>
	</div>
