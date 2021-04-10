<?php
	session_start();
	$od_id = $_GET['ord_id'];
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
	
	<div class="products">
		<div class="container">
		
			<div class="row">
				<div class="col-md-12">
					
					<div class="title">
						<h5>Order History</h5>
					</div>
					
				</div>
			</div>
			
			<div class="row product-list">
				<!--products-->
				
				<div class="col-md-12 col-sm-12 col-xs-12">
					<div class="row">
						<div class="box">
						<?php
							
							$order=$db->query("SELECT `orders`.*, member.* FROM `orders`
							LEFT JOIN member on orders.member_id=member.id 
							WHERE orders.member_id ='".$_SESSION['mem_id']."' AND ord_id='$od_id'");

							if($order->num_rows>0)
							{
								$orows= $order->fetch_assoc();
							}
						?>
							<div class="col-md-12 col-sm-12 col-xs-12">
								<div class="box-content ord-summary-div">
									<p><b>Order# :</b> CF1900<?php echo "$od_id";?></p>
									<p><b>Order Date :</b> <?php echo date("d-M-Y", strtotime($orows['date_added']));?></p>
									<p><b>Order Status :</b> 
										<?php
										if($orows['ord_status']==0){
											echo"Process";
										}
										elseif($orows['ord_status']==1){
											echo"Dispatched";
										}
										elseif($orows['ord_status']==2){
											echo"Shipping";
										}
										elseif($orows['ord_status']==3){
											echo"Completed";
										}
										elseif($orows['ord_status']==4){
											echo"Cancelled";
										}
										?>
									</p>
									<hr/>
									<p><b>Name : </b><?php echo "$orows[name]";?></p>
									<p><b>Contact : </b><?php echo "$orows[mobile]";?></p>
									<p><b>Email ID : </b><?php echo "$orows[email]";?></p>
									<p><b>Shipping Address : </b><?php echo"$orows[address], "."$orows[city], "."$orows[state] - "."$orows[pin]";?></p>
									<hr/>
									
									<?php 
										$pr_id = explode(",",$orows['p_id']);
									?>
									
									<p><b>Total Product(s) : </b><?php echo count($pr_id);?></p>
									<p><b>Payable Amt : </b><i class="fa fa-rupee"></i> <?php echo "$orows[total_price]";?></p>
									<p><b>Payment Methods : </b>
									<?php  if($orows['payment']==0){echo" Cash On Delivery";}else{echo"Online Payment";}?>
									</p>
								</div>
							</div>
							
							<div class="col-md-12 col-sm-12 col-xs-12 add-pad">
								<div class="table-responsive">
									<table id="cart" class="table table-hover table-condensed">
										<thead>
											<tr>
												<th style="width:5%">Image</th>
												<th style="width:20%">Name</th>
												<th style="width:20%">Unit</th>
												<th style="width:20%">Price</th>
												<th style="width:20%">Total Price</th>
												
											</tr>
										</thead>
										<tbody>
											<?php
												$sql="SELECT `orders`.*,product.name, option_value.value as opt_val FROM `orders` LEFT JOIN product ON product.id=orders.p_id LEFT JOIN option_value ON option_value.id=orders.value_id WHERE ord_id='$od_id'";
												$order=$db->query($sql);
												if($order->num_rows>0)
												{
													$order_row = $order->fetch_assoc()
													
												?>
											<?php
													$pro_array = explode(",",$order_row['p_id']);
													$price_array = explode(",",$order_row['p_price']);
													$qty_array = explode(",",$order_row['qty']);
													$val_array = explode(",",$order_row['opt_val']);
													$c = array_combine($pro_array, $qty_array);
														
													$i=0;
													foreach($c as $key => $value)
													{	
														$pr=$db->query("SELECT * FROM `product` WHERE id='".$key."'");
														if($pr->num_rows>0)
														{
															$pr_row= $pr->fetch_assoc();
												?>
											<tr>
												
												
												<td data-th="Image">
												<a href="product-detail.php?pro_id=<?php echo $pr_row['id'];?>">
													<img width="100%" src="abasket@Master/images/product/<?php echo $pr_row['image'];?>">
												</a>
												</td>
												
												<td data-th="Name"> <?php echo $pr_row['name'].' x '.$value; ?></td>
												
												<td data-th="Unit"> <?php echo $order_row['opt_val']; ?></td>
												
												<td data-th="Unit Price"><i class="fa fa-rupee"></i> <?php echo $price_array[$i]; ?></td>
												
												<td data-th="Price"><i class="fa fa-rupee"></i> <?php echo $price_array[$i]*$value; ?></td>
												
												
												
											</tr>
											<?php
													}
													$i++;

													}

												?>
											<?php
												
												}
												?>
										
										</tbody>
									</table>
								</div>
							</div>
														
						</div>
					</div>
				</div>
				
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
