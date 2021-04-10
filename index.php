<?php
session_start();
error_reporting(0);
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

	<?php include 'inc/header.php'?>
	
	
	<section class="slider-sec">
		<div class="container-fluid">
			<div class="slider owl-carousel owl-theme" id="owl-demo">

						 <?php $sel_party="SELECT * FROM `main_banner`";

						 		$qry=mysqli_query($db,$sel_party) or die(mysql_error());

								while($res=mysqli_fetch_assoc($qry)){?>
				<div class="items">
					<img src="images/main-banner/<?php echo $res['mainbn_img']; ?>" alt="banner" width="100%">
				</div>

				<?php } ?>
				<!--<div class="items">
					<img src="images/bt-1.jpg" alt="banner" width="100%">
				</div>-->
			</div>
		</div>
	</section>
 	<?php 
	$banner_info=$db->query("SELECT * FROM `banner_info`");
	if($banner_info->num_rows>0)
	{
		$banner_rows= $banner_info->fetch_assoc();
		?>
<section>
	<div class="marquee">
		<div class="track">
		  <div class="content"><?php echo $banner_rows['text']; ?></div>
		</div>
	  </div>
</section>
		<?php
	}
	?>

	<div class="categories">
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<div class="title">
						<h5>What would you like to order today?</h5>
					</div>
				</div>
			</div>
			<div class="row category-list">
				<?php
					
					$cat_o=$db->query("select * from category");
					if($cat_o->num_rows>0)
						{
							while($cato_rows= $cat_o->fetch_assoc())
							{
				?>
			
				<div class="col-md-4 col-md-4 col-xs-4">
					<div class="box">
						<a href="product-listing.php?c_id=<?php echo $cato_rows['id'];?>">
							<div class="img-box">
								<img src="abasket@Master/images/category/<?php echo $cato_rows['image']; ?>" alt="category img">
							</div>
							<div class="box-content">
								<p><?php echo $cato_rows['name']; ?></p>
							</div>
						</a>
					</div>
				</div>
				
				<?php  
					}
				}
								
			?>
				
			</div>
		</div>
	</div>
	
	<div class="shop-now">
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<a href="#"><img src="images/ads1.jpg" alt="show now" width="100%"></a>
				</div>
			</div>
		</div>
	</div>
	


	<?php include 'inc/top-product.php'?>
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
<script>
function set_option_value(id,product){
	$.ajax({
	url:'ajax/get_option_value.php',
	type:'post',
	data:{'id':id,'product':product},
		success:function(data){
			if(data!=""){
				$("#changeprice"+product).html(data);
			}
		},
	});
}
</script>


<script>
var incrementPlus;
var incrementMinus;

var buttonPlus  = $(".cart-qty-plus");
var buttonMinus = $(".cart-qty-minus");

var incrementPlus = buttonPlus.click(function() {
	
	var $n = $(this)
		.parent(".button-container")
		.parent(".button_increment")
		.find(".qty");
	$n.val(Number($n.val())+1 );
});

var incrementMinus = buttonMinus.click(function() {
		var $n = $(this)
		.parent(".button-container")
		.parent(".button_increment")
		.find(".qty");
	var amount = Number($n.val());
	if (amount > 0) {
		$n.val(amount-1);
	}
});
</script>



</html>