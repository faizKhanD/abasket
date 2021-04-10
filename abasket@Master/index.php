<!DOCTYPE html>
<html lang="en">

<!-- Added by HTTrack -->
<meta http-equiv="content-type" content="text/html;charset=UTF-8" /><!-- /Added by HTTrack -->

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Abasket -Admin Login</title>

	<?php  include('include/__js_css.php'); ?>
	<!-- Theme JS files -->
	<script type="text/javascript" src="assets/js/core/app.js"></script>
	<!-- /theme JS files -->

</head>

<body class="login-container">

	<!-- Main navbar -->
	<div class="navbar navbar-inverse">
		<div class="navbar-header">
			<a class="navbar-brand" href="index.php"><img style="width:130px;" src="../images/logo.png" alt=""></a>

			<ul class="nav navbar-nav pull-right visible-xs-block">
				<li><a data-toggle="collapse" data-target="#navbar-mobile"><i class="icon-tree5"></i></a></li>
			</ul>
		</div>

	</div>
	<!-- /main navbar -->


	<!-- Page container -->
	<div class="page-container">

		<!-- Page content -->
		<div class="page-content">

			<!-- Main content -->
			<div class="content-wrapper">

				<!-- Simple login form -->
				<form action="#" id="loginform">
					<div class="panel panel-body login-form">
						<div class="text-center">
							<div class="icon-object border-slate-300 text-slate-300"><i class="icon-reading"></i></div>
							<h5 class="content-group">Login to your account <small class="display-block">Enter your
									credentials below</small></h5>
						</div>

						<div class="form-group has-feedback has-feedback-left">
							<input type="text" class="form-control" id="user" placeholder="Username" required>
							<div class="form-control-feedback">
								<i class="icon-user text-muted"></i>
							</div>
						</div>

						<div class="form-group has-feedback has-feedback-left">
							<input type="password" class="form-control" id="password" placeholder="Password" required>
							<div class="form-control-feedback">
								<i class="icon-lock2 text-muted"></i>
							</div>
						</div>
						<div class="form-group">
							<button type="submit" class="btn btn-primary btn-block">Sign in <i
									class="icon-circle-right2 position-right"></i></button>
						</div>

						<!--<div class="text-center">
							<a href="login_password_recover.html">Forgot password?</a>
						</div>-->
						<div class="loader" style="display:none;"><img src="images/loader.gif" width="50">Signing in
							please wait...</div>
						<br /><br />
						<div class="alert alert-danger alert-dismissible" style="display:none;"> Either user Name or
							Password Wrong!!
						</div>
				</form>
				<!-- /simple login form -->

			</div>
			<!-- /main content -->

		</div>
		<!-- /page content -->

	</div>
	<!-- /page container -->


	<!-- Footer -->
	<?php include('include/__footer.php');?>
	<!-- /footer -->

</body>

</html>
<script>
	$("#loginform").submit(function (e) {
		
		var user = $("#user").val();
		var password = $("#password").val();

		$(".loader").show();
		$.ajax({
			url: 'ajax/login.php',
			type: 'post',
			data: { 'user': user, 'password': password },
			success: function (data) {
				//alert(data);
				if (data == 1) {
					$(".loader").hide();
					$(location).attr('href', 'manage_product.php');
					console.log();
				}
				else {
					$(".loader").hide();
					$(".alert").show();
					setInterval(function () {
						$(".alert").hide();
					}, 8000);
					console.log();

				}
			},
		});
		e.preventDefault(); // avoid to execute the actual submit of the form.
	});
</script>