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
			
			
				<div class="col-sm-12 col-xs-12">
					<h3>Return and Refund Policy:-</h3>
						<hr/>
					<p>We are committed towards your satisfaction and we will try our best to provide you the best vegetables and fruits. As we deal with raw and ripe item so there is chances of being item perishable/damaged sometimes so if you find any major problem in our delivered item call us we will satisfy you with our best service and efforts. </p>
						<p style="margin-bottom: 200px;" class="hideMobile"></p>
										
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
