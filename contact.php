<?php
session_start();
include("abasket@Master/lib/connectdb.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title>Abasket</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">

	<link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
	
	<link href="OwlCarousel/dist/assets/owl.carousel.min.css" rel="stylesheet">
	<link href="OwlCarousel/dist/assets/owl.theme.default.min.css" rel="stylesheet">
	<link href="font-awesome/css/font-awesome.min.css" rel="stylesheet">
	<link href="css/style.css" rel="stylesheet">

</head>
<body>

	<!--header-->
	
	<?php include 'inc/header.php'?>
	
	<section class="my-account">
		<div class="container">
			<div class="row">
			
			
				<div class="col-sm-12 col-xs-12"><!--left col-->

					<h3>Contact Info</h3>
						<hr/>
						
					<div class="row">	
						<div class="col-md-12">
							
							<p style="margin-bottom:30px;">Feel free to contact us if you feel any query. You can mail us also at info@abasket.com</p>
							
							
							<h4>Address</h4>
							<p><i class="fa fa-map-marker"></i> &nbsp abasket.co.in  <br>
Puri High street mall<br>
sector 81,
Faridabad<br>
</p>
							
							<hr>
						
						</div>
						<div class="col-md-12">
							<h4>Email</h4>
							<p><i class="fa fa-envelope"></i> info@abasket.com</p>
							<hr>
						</div>	
						<div class="col-md-12">
							<h4>Customer care no.</h4>
							<p><i class="fa fa-phone"></i> +91 98736 47653</p>
						</div>	
					
						 
					</div>
 
				</div><!--/col-3-->
				<!--<div class="col-sm-7 col-xs-12">
					<h3>Contact Form</h3>
						<hr/>
				  <div class="tab-content">
					<div class="contact">
						  <form class="form" action="" method="post" id="registrationForm">
								<div class="form-group">
									<div class="row">  
									  <div class="col-md-6">
										  <label for="first_name"><h4>First name</h4></label>
										  <input type="text" class="form-control" name="first_name" id="first_name" placeholder="first name" title="enter your first name if any.">
									  </div>
									  
									  	<div class="col-md-6">
										<label for="last_name"><h4>Last name</h4></label>
										  <input type="text" class="form-control" name="last_name" id="last_name" placeholder="last name" title="enter your last name if any.">
									  </div> 
									</div>
							
								</div>
								  
					
								<div class="form-group">
									<div class="row">
									  <div class="col-md-6">	
										  <label for="phone"><h4>Phone</h4></label>
										  <input type="text" class="form-control" name="phone" id="phone" placeholder="enter phone" title="enter your phone number if any.">
									  </div>
									  <div class="col-md-6">
										  <label for="email"><h4>Email</h4></label>
										  <input type="email" class="form-control" name="email" id="email" placeholder="you@email.com" title="enter your email.">
									  </div>
									</div> 
							  </div>
							  
							  <div class="form-group">
									<div class="row">
									  <div class="col-md-12">	
										  <label for="phone"><h4>Comment</h4></label>
										  <textarea class="form-control" name="comment" rows="5" placeholder="Your comment here"></textarea>
									  </div>
									</div> 
							  </div>

							  <div class="form-group">
								<div class="row">
									   <div class="col-xs-12">
											<button class="btn btn-md btn-success" name="update" type="submit"><i class="glyphicon glyphicon-ok-sign"></i> Submit</button>
										</div>
								</div>
							  </div>
						</form>
					  
					  <hr>
					  
					 </div><!--/tab-pane-->
					 
				  </div><!--/tab-content-->

				</div><!--/col-9-->
			</div><!--/row-->
			
		</div>
	</section>
	
	
	
	
	
	<!--footer-->
	
	<?php include 'inc/login-popup.php'?>
	<?php include 'inc/footer.php'?>
	
	<script src="js/jquery.min.js"></script>
	<script src="js/custom.js"></script>
	<script src="bootstrap/js/bootstrap.min.js"></script>
	<script src="OwlCarousel/dist/owl.carousel.min.js"></script>

	
	<script>
		$("#owl-demo").owlCarousel({
			autoplay:true,
			loop:true,
			items:1,
			pagination:false,
			navigation:false,
		})
		
	</script>
	
	<script>
		$(".navbar-toggle").click(function(){
			$(".menu").animate().css({left:'0px'})
		})
		$(".menu .fa-arrow-left").click(function(){
			$(".menu").animate().css({left:'-204px'})
		})
	</script>

</body>
</html>