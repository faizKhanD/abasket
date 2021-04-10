<?php
session_start();
include("abasket@Master/lib/connectdb.php");

	if(isset($_GET['c_id']))
	{
		$cat_id=$_GET['c_id'];
		$sql1 = "SELECT * FROM sub_category where cat_id='$cat_id'";
	}

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
	
	
	<section class="slider-sec subCat">
		<div class="container">
			<div class="slider owl-carousel owl-theme" id="owl-demo">
				<div class="items">
					<img src="images/ads1.jpg" alt="banner" width="100%">
				</div>
			</div>
		</div>
	</section>
	
	<div class="categories sub-categories">
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<div class="title">
						<!--<h5>Shop by Sub Category</h5>-->
						<h5>
						<?php
							if(isset($_GET['c_id']))
							{
								$sql5 = "SELECT * FROM category where id='$_REQUEST[c_id]'";
								$run = mysqli_query($db,$sql5);
								if($run->num_rows>0)
								{
									$crow3 = mysqli_fetch_assoc($run);
									echo $crow3['name'];
								}
							}
							
						?>
						</h5>
					</div>
				</div>
			</div>
			<div class="row category-list">
				
				<?php
					$run1 = mysqli_query($db,$sql1);
					if($run1->num_rows>0)
					{
						while( $crows = mysqli_fetch_assoc($run1) )
						{
				?>
				
				<div class="col-md-4 col-md-4 col-xs-4">
					<div class="box">
						<a href="sub-1-category.php?sub_id=<?php echo $crows['id'];?>">
							<div class="img-box">
								<img src="abasket@Master/images/sub-category/<?php echo $crows['image']?>" alt="category img">
							</div>
							<div class="box-content">
								<p><?php echo $crows['name']?></p>
							</div>
						</a>
					</div>
				</div>
				
				<?php	
						}
					}
				else
					{
					?>
						
							<div class="col-md-12 col-md-12 col-xs-12 text-center">
								<div class="box">
									
										<div class="img-box">
											<img src="images/stop-symbol.png" alt="Nothing Found">
										</div>
										<div class="box-content">
											<h5>Whoops!<br/><br/>No Category Found.</h5><br/>
										</div>
									
								</div>
							</div>
						
				
						
						<?php
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
</html>
