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
					<h3>FAQ's</h3>
						<hr/>
					
					<div class="panel-group" id="accordion">
						<div class="panel panel-default">
						  <div class="panel-heading">
							<h4 class="panel-title">
							  <a data-toggle="collapse" data-parent="#accordion" href="#collapse1">What are the modes of payment?</a>
							</h4>
						  </div>
						  <div id="collapse1" class="panel-collapse collapse">
							<div class="panel-body">You can pay for your order on Sabjee Bazar.com using the following modes of payment: 
								<ul>
									<li>Cash on delivery</li>
									<li>Credit and debit cards (VISA / Mastercard / Rupay).</li>
									<li>Sodexo passes on delivery (only for food items)</li>
								</ul> 
							</div>
						  </div>
						</div>
						<div class="panel panel-default">
						  <div class="panel-heading">
							<h4 class="panel-title">
							  <a data-toggle="collapse" data-parent="#accordion" href="#collapse2">Is VAT added to the invoice?</a>
							</h4>
						  </div>
						  <div id="collapse2" class="panel-collapse collapse">
							<div class="panel-body">There is no VAT. However, GST will be applicable as per Government Regulizations.</div>
						  </div>
						</div>
						<div class="panel panel-default">
						  <div class="panel-heading">
							<h4 class="panel-title">
							  <a data-toggle="collapse" data-parent="#accordion" href="#collapse3">Is it safe to use my credit/ debit card on Sabjee Bazar.com ?</a>
							</h4>
						  </div>
						  <div id="collapse3" class="panel-collapse collapse">
							<div class="panel-body">Yes it is absolutely safe to use your card on Sabjee Bazar.com. A recent directive from RBI makes it mandatory to have an additional authentication pass code verified by VISA (VBV) or MSC (Master Secure Code) which has to be entered by online shoppers while paying online using visa or master credit card. It means extra security for customers, thus making online shopping safer.
</div>
						  </div>
						</div>
						<div class="panel panel-default">
						  <div class="panel-heading">
							<h4 class="panel-title">
							  <a data-toggle="collapse" data-parent="#accordion" href="#collapse4">What is the meaning of cash on delivery?</a>
							</h4>
						  </div>
						  <div id="collapse4" class="panel-collapse collapse">
							<div class="panel-body">Cash on delivery means that you can pay for your order at the time of order delivery at your doorstep.</div>
						  </div>
						</div>
						<div class="panel panel-default">
						  <div class="panel-heading">
							<h4 class="panel-title">
							  <a data-toggle="collapse" data-parent="#accordion" href="#collapse5">If I pay by credit card how do I get the amount back for items not delivered?</a>
							</h4>
						  </div>
						  <div id="collapse5" class="panel-collapse collapse">
							<div class="panel-body">If we are not able to delivery all the products in your order and you have already paid for them online, the balance amount will be refunded to your Sabjee Bazar account as store credit and you can use it at any time against your future orders. Should you want it to be credited to your bank account please contact our customer support team and we will refund it back on to your card.</div>
						  </div>
						</div>
						<div class="panel panel-default">
						  <div class="panel-heading">
							<h4 class="panel-title">
							  <a data-toggle="collapse" data-parent="#accordion" href="#collapse6">Where do I enter the coupon code?</a>
							</h4>
						  </div>
						  <div id="collapse6" class="panel-collapse collapse">
							<div class="panel-body">Once you are done selecting your products and click on checkout you will be prompted to select delivery slot and payment method. On the payment method page there is a box where you can enter any evoucher/ coupon code that you have. The amount will automatically be deducted from your invoice. </div>
						  </div>
						</div>
						
					  </div> 
					
					
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
