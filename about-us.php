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
					<h3>About Us</h3>
						<hr/>
					<p>   is your online store of all fresh Fruits & Vegetables. Our goal is clear, we wish to save our valuable customer’s  time, money and petrol. We also take care of our products as we provide quality fresh fruits and vegetables directly delivered to our customers doorstep. </p>
					
					<p>abasket.co.in   do not entertain any third party involvement, so we directly deal with framers in order to provide you the best and fresh products directly to your doorstep. By doing this, framers & customers gets direct benefit and all mediators get eliminated. </p>
				
					<p>Our delivery methods are well defined and we deliver products to our customer in two time slots. The delivery timing may differ sometime based on location to location. We are in a continuously developing our delivery systems and will be keeping all posted.</p>
					
					<p>Our efficient & bulk procurement, state-of-the-art storage & handling, and unmatched logistics enable us to pass on the price and quality advantage to our customers.</p>
					
					<h4><i>“For us our customers are our God who fulfil the needs of many farmers and employees Everyday”</i></h4>
				
	<p style="  float: right;"><strong>Sincerely,<br>
	abasket.co.in  Staffs</strong>
</p>
					
					<!--<h3>Delivery Detail</h3>
						<hr/>
					
					<h4>Delivery Timing</h4>
					<ul>
						<li><p>Delivery time everyday  <b>10:00 AM to 7:00 PM</b> </p></li>
						<li><p>If order placed <b>before 3:00 PM</b> product will be delivered at the same day.</p></li>
					</ul>
					
					<h4>Delivery Charges</h4>
					<table class="table table-responsive">
					<thead>
					  <tr>
						<th>City</th>
						<th>Order Value</th>
						<th>Charges</th>
					  </tr>
					</thead>
					<tbody>
						<tr>
							<td rowspan="4" style="text-align:center; border-right: 1px solid #dddddd; vertical-align: middle;">Churcha<br/>and<br/>Baikunthpur</td>
							<td><i class="fa fa-rupee"></i> 500</td>
							<td><i class="fa fa-rupee"></i> 99</td>
						</tr>
						<tr>
							<td><i class="fa fa-rupee"></i> 500 - 1000</td>
							<td><i class="fa fa-rupee"></i> 89</td>
						</tr>
						<tr>
							<td><i class="fa fa-rupee"></i> 1000-3000</td>
							<td><i class="fa fa-rupee"></i> 49</td>
						</tr>
						<tr>
							<td><i class="fa fa-rupee"></i> 3000</td>
							<td><i class="fa fa-rupee"></i> Free</td>
						</tr>
						</tbody>
				  </table>
					
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
