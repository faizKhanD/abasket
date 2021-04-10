<?php
	session_start();
	include('abasket@Master/lib/connectdb.php');
	
	
	
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

	<div class="products mycart">
		<div class="container">

			<div class="row">
				<div class="col-md-12">
					

					<div class="title">
						<h5>My Cart </h5>
					</div>
				
				</div>
			</div>
			<?php
			if(isset($_COOKIE['usertoken'])){
				$r=$db->query("SELECT `cart`.*,product.name,product.image,option_detail.price,option_detail.sale_price as op_sale,option_value.value as opt_val FROM `cart`
				LEFT JOIN product ON product.id=cart.p_id
				LEFT JOIN option_detail ON option_detail.id=cart.option_detail
				LEFT JOIN option_value ON option_value.id=option_detail.value_id WHERE cart.member_id='".$_COOKIE['usertoken']."'");
			if($r->num_rows>0)
				{
			?>
			<div class="row product-list">
				<!--products-->
				<?php
					$total=0;
					while($rows= $r->fetch_assoc())
					{
						$pro_id=$rows['p_id'];
						$qty=$rows['qty'];
						$price=$rows['op_sale'];
						$total=$total+($qty*$price);
						$up_pri=$qty*$price;
				
				?>
				<div id="cartData<?php echo $rows['cart_id'];?>" class="col-md-6 col-sm-6 col-xs-12">
					<div class="row" style=" margin-right: 5px;">
						<div class="box">
							<div class="col-md-5 col-sm-5 col-xs-6">
								<div class="img-box">
									<a href="#"><img
											src="abasket@Master/images/product/<?php echo"$rows[image]";?>"
											alt="category img"></a>
								</div>
							</div>

							<div class="col-md-7 col-sm-7 col-xs-6">
								<div class="box-content">
									<p class="p-name"><a
											href="product-detail.php?pro_id=<?php echo"$rows[p_id]";?>"><?php echo"$rows[name]";?></a>
									</p>
									<p class="weight"><?php echo"$rows[opt_val]";?></p>
									<div class="row">
										<div class="col-md-6 col-sm-8 col-xs-8">
											<p class="price" id="price<?php echo $rows['cart_id'];?>">Rs. <?php echo"$up_pri";?></p>
										</div>
										<div class="col-md-6 col-sm-8 col-xs-8">
											<div class="col-md-12 col-sm-12 col-xs-12">
												<button class="btn btn-sm btn-new"
													onclick="remove(<?php echo"$rows[cart_id]";?>)" type="button"
													style="margin-bottom: 10px;"><i class="fa fa-trash"></i>
													Delete</button>
											</div>

											<div class="product-count">
												<span class="btn-qty minus-btn"
													onclick="updateC(<?php echo"$rows[cart_id]";?>,'1')">-</span>
												<span class="qty">
													<input type="text" name="qua_name"
														id="updatecart<?php echo"$rows[cart_id]";?>"
														value="<?php echo"$rows[qty]";?>" disabled>

														<input type="hidden" id="hd<?php echo $rows['cart_id']; ?>" value="<?php echo $rows['p_id']; ?>">
												</span>
												<span class="btn-qty plus-btn"
													onclick="updateC(<?php echo"$rows[cart_id]";?>,'2')">+</span>
											</div>

										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<?php
							}	
						?>

			</div>
			<?php
				}


				else
				{
					?>
			<div class="col-md-12 col-md-12 col-xs-12 text-center">
				<div class="box">
					<div class="img-box">
						<img src="images/no-cart.png" alt="Nothing Found">
					</div><br />
					<div class="box-content">
						<h5>Your Cart is Empty<br /><br />Browse through the store and buy.</h5>
					</div>
				</div>
			</div>
			<div class="col-md-12 col-sm-12 col-xs-12 cont-shop-div">
				<button type="button" onclick="window.location='index.php'" class="btn">Go To Shop</button>
			</div>
			<?php
				}
				$count = "SELECT count(*) as total FROM cart where member_id='".$_COOKIE['usertoken']."'";
				$c = mysqli_query($db,$count);
				$srows = mysqli_fetch_assoc($c);
					if($srows['total']!=0)
					{
			?>
			<div class="row">
				<div class="col-md-6 col-xs-12 footer-checkout">
					<div class="col-md-12 col-xs-12">
					<?php

					$delivery_charge=$db->query("SELECT * FROM `delivery_charge`");
								if($delivery_charge->num_rows>0)
								{
									$del_rows= $delivery_charge->fetch_assoc();
									$charges=$del_rows['charges'];
								}else{
									$charges=0;
								}
								?>
						<p><b>Delivery Charges: </b><span class="free"><i class="fa fa-rupee"></i> <?php if(isset($del_rows['charges'])){echo $del_rows['charges'];}else{echo "0";}?></span></p>
						<p><b>Total: </b><span class="free"  id="totalcost"> <i
									class="fa fa-rupee"></i>&nbsp<?php echo $total+$charges;?></span></p>
					</div>
					<div class="col-md-12 col-xs-12 class=" dropdown"">
						<button type="button" data-toggle="modal" data-target="#login"
							class="btn btn-new">Checkout</button>
					</div>
				</div>
			</div>
			<?php
						}

				
			}
			elseif(isset($_SESSION['mem_id'])){

				$r=$db->query("SELECT `cart`.*,product.name,product.image,option_detail.price,option_detail.sale_price as op_sale,option_value.value as opt_val FROM `cart`
				LEFT JOIN product ON product.id=cart.p_id
				LEFT JOIN option_detail ON option_detail.id=cart.option_detail
				LEFT JOIN option_value ON option_value.id=option_detail.value_id WHERE cart.member_id='".$_SESSION['mem_id']."'");
				
				

			if($r->num_rows>0)
				{
			?>
			<div class="row product-list">
				<!--products-->
				<?php
					$total=0;
					while($rows= $r->fetch_assoc())
					{
						$pro_id=$rows['p_id'];
						$qty=$rows['qty'];
						$price=$rows['op_sale'];
						$total=$total+($qty*$price);
						$up_pri=$qty*$price;
				
				
				?>
				<div id="cartData<?php echo $rows['cart_id'];?>" class="col-md-6 col-sm-6 col-xs-12">
					<div class="row" style=" margin-right: 5px;">
						<div class="box">
							<div class="col-md-5 col-sm-5 col-xs-6">
								<div class="img-box">
									
									<a href="#"><img
											src="abasket@Master/images/product/<?php echo"$rows[image]";?>"
											alt="category img"></a>
											
								</div>
							</div>

							<div class="col-md-7 col-sm-7 col-xs-6">
								<div class="box-content">
									<p class="p-name"><a
											href="product-detail.php?pro_id=<?php echo"$rows[p_id]";?>"><?php echo"$rows[name]";?></a>
									</p>
									<p class="weight"><?php echo"$rows[opt_val]";?></p>
									<div class="row">
										<div class="col-md-6 col-sm-8 col-xs-8">
											<p class="price" id="price<?php echo $rows['cart_id'];?>">Rs. <?php echo"$up_pri";?></p>
										</div>
										<div class="col-md-6 col-sm-8 col-xs-8">
											<div class="col-md-12 col-sm-12 col-xs-12">
												<button class="btn btn-sm btn-new"
													onclick="remove(<?php echo"$rows[cart_id]";?>)" type="button"
													style="margin-bottom: 10px;"><i class="fa fa-trash"></i>
													Delete</button></div>

											<div class="product-count">
												<span class="btn-qty minus-btn"
													onclick="updateC(<?php echo"$rows[cart_id]";?>,'1')">-</span>
												<span class="qty">
													<input type="text" name="qua_name"
														id="updatecart<?php echo"$rows[cart_id]";?>"
														value="<?php echo"$rows[qty]";?>" disabled>

														<input type="hidden" id="hd<?php echo $rows['cart_id']; ?>" value="<?php echo $rows['p_id']; ?>">
												</span>
												<span class="btn-qty plus-btn"
													onclick="updateC(<?php echo"$rows[cart_id]";?>,'2')">+</span>
											</div>

										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<?php
							}
							
						?>

			</div>
				<?php
				}


				else
				{
					?>
			<div class="col-md-12 col-md-12 col-xs-12 text-center">
				<div class="box">
					<div class="img-box">
						<img src="images/no-cart.png" alt="Nothing Found">
					</div><br />
					<div class="box-content">
						<h5>Your Cart is Empty<br /><br />Browse through the store and buy.</h5>
					</div>
				</div>
			</div>
			<div class="col-md-12 col-sm-12 col-xs-12 cont-shop-div">
				<button type="button" onclick="window.location='index.php'" class="btn">Go To Shop</button>
			</div>
			<?php
				}
				$count = "SELECT count(*) as total FROM cart where member_id='".$_SESSION['mem_id']."'";
				$c = mysqli_query($db,$count);
				$srows = mysqli_fetch_assoc($c);
					if($srows['total']!=0)
					{
			?>
			<div class="row">
				<div class="col-md-6 col-xs-12 footer-checkout">
					<div class="col-md-12 col-xs-12">
					<?php

					$delivery_charge=$db->query("SELECT * FROM `delivery_charge`");
								if($delivery_charge->num_rows>0)
								{
									$del_rows= $delivery_charge->fetch_assoc();
									$charges=$del_rows['charges'];
								}else{
									$charges=0;
								}
								?>
						<p><b>Delivery Charges: </b><span class="free"><i class="fa fa-rupee"></i> <?php if(isset($del_rows['charges'])){echo $del_rows['charges'];}else{echo "0";}?></span></p>
						<p><b>Total: </b><span class="free"  id="totalcost"> <i
									class="fa fa-rupee"></i>&nbsp<?php echo $total+$charges;?></span></p>
					</div>
					<div class="col-md-12 col-xs-12">
						<button type="button" onclick="window.location='checkout.php'"
							class="btn btn-new">Checkout</button>
					</div>
				</div>
			</div>
			<?php
						}

			}


			?>

			<?php
				if(isset($_SESSION['mem_id'])){
				
						
					}		
				?>

		</div>
	</div>


	<!-- more option  -->
	<div id="timing" class="modal fade" role="dialog" data-keyboard="false" data-backdrop="static">
		<div class="modal-dialog">
	  
		  <!-- Modal content-->
		  <div class="modal-content">
			<div class="modal-header">
			  <button type="button" class="close" data-dismiss="modal">&times;</button>
			  <h4 class="modal-title">More Option</h4>
			</div>
			<div class="modal-body">
				<div class="row">
					<div class="col-md-12">
						<div class="form-group">
							<label for="">Delivery Timing</label>
							<select name="" id="" class="form-control">
								<option value="">10am to 12am</option>
							</select>
						</div>
					</div>
					<div class="col-md-12">
						<label for="">Add Comments</label>
						<div class="form-group">
							<textarea name="" id="" class="form-control" rows="5"></textarea>
						</div>
					</div>
				</div>
			</div>
			<div class="modal-footer">
			  <!-- <button type="button" class="btn btn-default" data-dismiss="modal">Submit</button> -->
				<button class="btn btn-new">Submit</button>
			</div>
		  </div>
	  
		</div>
	  </div>
	<!-- more option end  -->

	<?php include 'inc/login-popup.php'?>
	<?php include 'inc/footer.php'?>

	<script src="js/jquery.min.js"></script>
	<script src="js/custom.js"></script>
	<script src="bootstrap/js/bootstrap.min.js"></script>
	<script src="OwlCarousel/dist/owl.carousel.min.js"></script>


	<script>
		$("#owl-demo").owlCarousel({
			autoplay: true,
			loop: true,
			items: 1,
			pagination: false,
			navigation: false,
		})

	</script>

	<script>
		$(".navbar-toggle").click(function () {
			$(".menu").animate().css({ left: '0px' })
		})
		$(".menu .fa-arrow-left").click(function () {
			$(".menu").animate().css({ left: '-204px' })
		})
	</script>
	<script>
		function remove(e) {
			
			$.ajax({
				url: 'ajax/remove-cart.php',
				type: 'post',
				data: { 'cart_id': e },
				success: function (data) {
					if (data == 1) {
						location.reload();
					}
					else if (data == 2) {
						location.reload();
					}
					else{
						location.reload();
					}
					

				},
			});


		}
	</script>
</body>

</html>