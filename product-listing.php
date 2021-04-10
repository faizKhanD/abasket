<?php
session_start();
error_reporting(0);
include("abasket@Master/lib/connectdb.php");

if(isset($_REQUEST['c_id'])){
	$cat_id=$_REQUEST['c_id'];
	$sql1 = "SELECT * from product where cat_id='$cat_id' AND status='1'";
}else{
	header('location: index.php');
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
	
	<div class="products">
		<div class="container">
		
			<div class="row">
				<div class="col-md-12">
					<div class="title">
						<h5>Our Products</h5>
					</div>
				</div>
			</div>
			<div class="breadcrumb-box">
				<div class="container">
					<div class="row">
						<div class="col-md-12">
							<ul class="breadcrumb">
							
							<?php
								if(isset($_REQUEST['c_id']))
								{
									$sql5 = "SELECT * FROM category where id='".$_REQUEST['c_id']."'";
									$run = mysqli_query($db,$sql5);
									if($run->num_rows>0)
									{
										$crow3 = mysqli_fetch_assoc($run);
										?>
										<li><a href="index.php">Home</a></li>
										<li><?php echo $crow3['name'];?></li>
										<?php
										
									}
								}
							?>
								
							</ul>
						</div>
					</div>
				</div>
			</div>
		
			<div class="row product-list">
				<!--products-->
				<?php
					$run1 = $db->query($sql1);
					if($run1->num_rows>0)
					{
						$i=1;
						while( $crows = mysqli_fetch_assoc($run1) )
						{
				?>
				
				
				<div class="col-md-3 col-sm-3 col-xs-12">
					<div class="row">
						<div class="box">
							<div class="col-md-12 col-sm-12 col-xs-6">
								<div class="img-box">
									<a href="#"><img src="abasket@Master/images/product/<?php echo $crows['image']; ?>"
											alt="category img"></a>
	
									<?php
								$price=$db->query("SELECT * FROM `option_detail` WHERE `sale_price`= (SELECT MIN(`sale_price`) FROM  option_detail WHERE p_id='".$crows['id']."') AND p_id='".$crows['id']."'");
								if($price->num_rows>0){
									$price_rows= $price->fetch_assoc();
								}
								?>
	
									<span
										class="price-off"><?php echo ceil(100-($price_rows['sale_price']/$price_rows['price'])*100); ?>%</span>
								</div>
							</div>
	
	
							<form id="addToCart" method="POST" onsubmit="event.preventDefault();">
								<div class="col-md-12 col-sm-12 col-xs-6">
									<div class="box-content">
										<input type="hidden" value="0" name="cat" id="catid<?php echo $crows['id'];  ?>">
										<input type="hidden" value="<?php echo $crows['id'];?>" name="pro_id"
											id="pro_id<?php echo $crows['id'];  ?>">
										<p class="p-name"><?php echo $crows['name']; ?></p>
										<?php
								$option=$db->query("SELECT * FROM `option_value` WHERE `id`='".$price_rows['value_id']."'");
								if($option->num_rows>0){
									$option_rows= $option->fetch_assoc();
								}
								?>
										<select class="form-control" id="detail_id<?php echo $crows['id'];?>"
											name="detail_id"
											onchange="set_option_value(this.value,<?php echo $crows['id'];?>);"
											required="">
											<?php
									$value=$db->query("SELECT option_detail.*, option_value.value FROM `option_detail` LEFT JOIN option_value ON option_detail.value_id=option_value.id WHERE option_detail.p_id='".$crows['id']."' AND option_detail.option_id='".$price_rows['option_id']."'");
									if($value->num_rows>0){
										while($value_rows= $value->fetch_assoc()){
											?>
											<option selected="" value="<?php echo $value_rows['id'];?>">
												<?php echo $value_rows['value'];?></option>
											<!--<li onClick="change_price('<?php echo $rows['id'];?>','<?php echo $value_rows['id'];?>');"><a href="#"><?php echo $value_rows['value'];?></a></li>-->
											<?php
										}
									}
									?>
	
										</select>
	
	
										<div class="row">
	
											<div class="col-md-6 col-sm-6 col-xs-12"
												id="changeprice<?php echo $crows['id'];?>">
												<p class="price">₹ <?php echo $price_rows['sale_price'];?> <del>₹
														<?php echo $price_rows['price'];?></del> </p>
											</div>
	
											<div class="col-md-6 col-sm-6 col-xs-12 ">
												<?php
													if(isset($_COOKIE['usertoken']))
													{
														?>
												<div class="button_increment">
	
													<?php
													
													$cart=$db->query("SELECT * from cart where p_id='".$crows['id']."' and member_id='".$_COOKIE['usertoken']."'");
													if($cart->num_rows>0)
													{
													 $cart_row = $cart->fetch_assoc();
														?>
													<div class="dflx" id="dynamicbtn<?php echo $crows['id'];?>">
														<span class="btn-qty minus-btn btn_increment_dec"
															onclick="updateC(<?php echo"$cart_row[cart_id]";?>,'1',<?php echo $crows['id'];?>)">-</span>
														<span class="qty">
															<input type="text" class="form-control" name="qua_name"
																id="updatecart<?php echo"$cart_row[cart_id]";?>"
																value="<?php echo"$cart_row[qty]";?>">
														</span>
														<span class="btn-qty plus-btn btn_increment_dec"
															onclick="updateC(<?php echo"$cart_row[cart_id]";?>,'2',<?php echo $crows['id'];?>)">+</span>
													</div>
													<button style="display:none;" class="btn btn-sm btn-new "
														id="log<?php echo $crows['id'];?>" type="button" name="btn-cart"
														onclick=addToCart(<?php echo $crows['id']; ?>);><i
															class="fa fa-plus"></i> Add To Cart</button>
													<?php
													}
													
													else
													{
														?>
													<div class="dflx" style="display:none;"
														id="dynamicbtn<?php echo $crows['id'];?>">
														
													</div>
													<button class="btn btn-sm btn-new "
														id="log<?php echo $crows['id'];?>" type="button" name="btn-cart"
														onclick=addToCart(<?php echo $crows['id']; ?>);><i
															class="fa fa-plus"></i> Add To Cart</button>
													<?php
													}
												
												
											?>
												</div>
												<?php
													}else{
														?>
												<div class="button_increment">
	
													<?php
													
													$cart=$db->query("SELECT * from cart where p_id='".$crows['id']."' and member_id='".$_SESSION['mem_id']."'");
													if($cart->num_rows>0)
													{
													 $cart_row = $cart->fetch_assoc();
														?>
													<div class="dflx" id="dynamicbtn<?php echo $crows['id'];?>">
														<span class="btn-qty minus-btn btn_increment_dec"
															onclick="updateC(<?php echo"$cart_row[cart_id]";?>,'1',<?php echo $crows['id'];?>)">-</span>
														<span class="qty">
															<input type="text" class="form-control" name="qua_name"
																id="updatecart<?php echo"$cart_row[cart_id]";?>"
																value="<?php echo"$cart_row[qty]";?>">
														</span>
														<span class="btn-qty plus-btn btn_increment_dec"
															onclick="updateC(<?php echo"$cart_row[cart_id]";?>,'2',<?php echo $crows['id'];?>)">+</span>
													</div>
													<button style="display:none;" class="btn btn-sm btn-new "
														id="log<?php echo $crows['id'];?>" type="button" name="btn-cart"
														onclick=addToCart(<?php echo $crows['id']; ?>);><i
															class="fa fa-plus"></i> Add To Cart</button>
													<?php
													}else{
														?>
													<div class="dflx" style="display:none;"
														id="dynamicbtn<?php echo $crows['id'];?>">
														
													</div>
													<button class="btn btn-sm btn-new "
														id="log<?php echo $crows['id'];?>" type="button" name="btn-cart"
														onclick=addToCart(<?php echo $crows['id']; ?>);><i
															class="fa fa-plus"></i> Add To Cart</button>
													<?php
													}
											?>
												</div>
												<?php
												}
											?>
											</div>
										</div>
									</div>
								</div>
							</form>
						</div>
					</div>
				</div>
				<?php	
							if($i%4==0){
									?><div class="clearfix"></div><?php
								}
								$i++;
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
										<div class="box-content"><br/>
											<h5>Whoops!<br/><br/>No Product Found.</h5><br/>
										</div>
									
								</div>
							</div>
						
				
						
						<?php
					}
				?>
				
				
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
	<script>
			function addtocart(e){
			   //alert(e);
			  
			  $.ajax({
				  url: 'ajax/add-to-cart.php?pro_id='+e,
				  data: '',
				  dataType: '',
				  success: function(data){
            		 //alert(data);
            		if(data==1)
            		{ 
            		 	location.reload();
            			}
					  else if(data==2)
							  {
							  	$('#alert'+e).show();
							  }
            		},
				});
				$('#viewcart'+e).show();
				$('#addcart'+e).hide();	
			}
	</script>
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
	function updatequntity(u) {
		
		var qty = $("#changequantity").val();
		$.ajax({
			url: 'ajax/qnty_increment.php',
			type: 'post',
			data: { 'cart_id': u, 'quantity': qty },
			success: function (data) {
				if (data == 1) {
					alert("update successfully");
					cartcount();

				}
				else {
					alert("failde to update");
				}

			},
		});
	}
</script>
<script>
	function addToCart(e) {
		var cat = $("#catid" + e).val();
		var pro_id = $("#pro_id" + e).val();
		var detail_id = $("#detail_id" + e).val();
		if(detail_id==""){
			document.getElementById("detail_id"+e).focus();
			return true;
		}
		else{
			$.ajax({
			url: 'ajax/add-to-cart.php',
			type: 'post',
			data: { 'cat': cat, 'pro_id': pro_id, 'detail_id': detail_id },
			success: function (data) {
				if (data) {
					$("#log" + e).hide();
					$("#dynamicbtn" + e).show();
					$("#dynamicbtn" + e).html(data);
					cartcount();
				}
				else {
					$("#log" + e).hide();
					$("#dynamicbtn" + e).show();
				}
			},
		});
		}
		e.preventDefault(); // avoid to execute the actual submit of the form.
	}
</script>
</html>