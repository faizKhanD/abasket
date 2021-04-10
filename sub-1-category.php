<?php
session_start();
include("abasket@Master/lib/connectdb.php");

	if(isset($_GET['sub_id']))
	{
		$s_id=$_GET['sub_id'];
		$sql1 = "SELECT * FROM sub1_category where sub_id='$s_id'";
		$run1 = mysqli_query($db,$sql1);
		if($run1->num_rows>0)
		{
			
		}
		else{
			header("Location: product-listing.php?sub_id=$s_id");
		}
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
	
	
	<section class="slider-sec">
		<div class="container">
			<div class="slider owl-carousel owl-theme" id="owl-demo">
				<div class="items">
					<img src="images/banner1.jpg" alt="banner" width="100%">
				</div>
				<div class="items">
					<img src="images/banner2.jpg" alt="banner" width="100%">
				</div>
			</div>
		</div>
	</section>
	
	<div class="categories sub-categories">
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<div class="title">
						<!--<h5>Shop by Super Sub Category</h5>-->
						<h5>
						<?php
							if(isset($_GET['sub_id']))
							{
								$sql5 = "SELECT * FROM sub_category where id='$_REQUEST[sub_id]'";
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
						<a href="product-listing.php?sup_id=<?php echo $crows['id'];?>">
							<div class="img-box">
								<img src="abasket@Master/images/sub1-category/<?php echo $crows['image']?>" alt="category img">
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
					<a href="#"><img src="images/banner3.jpg" alt="show now" width="100%"></a>
				</div>
			</div>
		</div>
	</div>
	
	<div class="products">
		<div class="container">
		
			<div class="row">
				<div class="col-md-12">
					<div class="title">
						<h5>Top Products</h5>
					</div>
				</div>
			</div>
		
			<div class="row product-list">
				<form action="" method="POST">
				<!--products-->
				
				<?php
					
					$top_p=$db->query("SELECT product.*, option_detail.sale_price as op_sale, option_detail.price as op_price, option_value.value as opt_val from product inner join option_detail on product.id=option_detail.p_id left join option_value on option_detail.value_id=option_value.id WHERE is_featured = '1' LIMIT 6");
					if($top_p->num_rows>0)
						{
							while($top_rows= $top_p->fetch_assoc())
							{
							
				?>
			
				
				<div class="col-md-3 col-sm-3 col-xs-12">
					<div class="row">
						<div class="box">
							<div class="col-md-4 col-sm-4 col-xs-4">
								<div class="img-box">
									<a href="product-detail.php?pro_id=<?php echo $top_rows['id'];?>"><img src="abasket@Master/images/product/<?php echo $top_rows['image']; ?>" alt="category img"></a>
									
									<?php
										 $d_sale=$top_rows['op_sale'];
										 $d_regular=$top_rows['op_price'];
										 $d_solve= $d_regular - $d_sale;
										$d_per = ($d_solve / $d_regular) * 100 ;
									?>
									
									<span class="price-off"><?php echo round($d_per) ;?>%</span>
								</div>
							</div>
							
							<div class="col-md-8 col-sm-8 col-xs-8">
								<div class="box-content">
									<p class="p-name"><a href="product-detail.php?pro_id=<?php echo $top_rows['id'];?>"><?php echo $top_rows['name']; ?></a></p>
									<p class="weight"> <?php echo $top_rows['opt_val']; ?></p>
									<div class="row">
										<div class="col-md-6 col-sm-6 col-xs-6">
											<p class="price">₹ <?php echo $top_rows['op_sale']; ?><br/><del>₹ <?php echo $top_rows['op_price']; ?></del> </p>
										</div>
										<div class="col-md-6 col-sm-6 col-xs-6">
											<a href="product-detail.php?pro_id=<?php echo"$top_rows[id]";?>"><button class="btn btn-sm btn-new" type="button">Check <i class="fa fa-arrow-circle-right"></i></button></a>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
	
				<?php  
					}
				}
								
			?>
				</form>

				<div class="clearfix"></div>
				<!--<div class="col-md-3 col-sm-3 col-xs-12 pull-right">
					<div class="row">
						<div class="box">
							<div class="col-md-12">
								<a href="product-listing.php" class="view-more">View More <i class="fa fa-angle-double-right"></i></a>
							</div>
						</div>
					</div>
				</div>
				-->
				
			</div>
		</div>
	</div>
	

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
