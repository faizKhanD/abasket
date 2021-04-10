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
	
	<section class="breadcrumb-box">
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<ul class="breadcrumb">
						<li><a href="index.php">Home</a></li>
						<li><a href="my-orders.php">My Orders</a></li>
						<li>My Orders</li>
					</ul>
				</div>
			</div>
		</div>
	</section>
	
	<section class="my-account">
		<div class="container">
			<div class="row">
	  

			  <div class="col-sm-3 col-xs-12"><!--left col-->

					

				<ul class="list-group account-list">
					<li class="list-group-item text-muted"><h4><b><?php echo"$_SESSION[mem_name]"?></b></h4></li>
					<li class="list-group-item text-left"><a href="my-account.php">My Profile</a></li>
					<li class="list-group-item text-left"><a href="my-orders.php">My Orders</a></li>
					<li class="list-group-item text-left"><a href="ajax/logout.php">Sign Out</a></li>
				 </ul> 
 
				</div><!--/col-3-->
				<div class="col-sm-9 cart-section">
					<h3>My Orders</h3>
					<hr>
					
					<div class="table-responsive">
						<table id="cart" class="table table-hover table-condensed">
							<thead>
								<tr>
									<th style="width:5%">Order</th>
									<th style="width:20%">Date</th>
									<th style="width:20%">Total</th>
									<th style="width:10%" class="text-center">Status</th>
									<th style="width:10%" class="text-center">View</th>
									<th style="width:5%" class="text-center">Action</th>
								</tr>
							</thead>
							<tbody>
								<?php
									$sql="SELECT `orders`.*, product.name, product.image FROM `orders` LEFT JOIN product ON product.id=`orders`.`p_id` WHERE orders.member_id='".$_SESSION['mem_id']."' order by ord_id desc";
									$order=$db->query($sql);
									if($order->num_rows>0)
									{
										while($order_row = $order->fetch_assoc())
										{
								?>
								<tr>
									<td data-th="Order">SBJ1900<?php echo $order_row['ord_id'];?></td>
									
									<td data-th="Date"><i class="fa fa-calendar"></i> <?php echo date("d-M-Y", strtotime($order_row['date_added']));?></td>
									
									<?php 
										$pr_id = explode(",",$order_row['p_id']);
									?>
									
									<td data-th="Price"><i class="fa fa-rupee"></i> <?php echo $order_row['total_price'];?> for <?php echo count($pr_id);?> item(s)</td>
									<td data-th="Status" class="status-pending text-center"> 
									
										<?php
											if($order_row['ord_status']==0){
												echo"Process";
											}
											elseif($order_row['ord_status']==1){
												echo"Dispatched";
											}
											elseif($order_row['ord_status']==2){
												echo"Shipping";
											}
											elseif($order_row['ord_status']==3){
												echo"Completed";
											}
											elseif($order_row['ord_status']==4){
												echo"Cancelled";
											}
										?>
									
									</td>
									<td data-th="View" class="actions text-center">
										<a href="order-view.php?ord_id=<?php echo"$order_row[ord_id]";?>">
											<button class="btn btn-danger btn-sm"><i class="fa fa-eye"></i></button>
										</a>
									</td>
									<td data-th="Action" class="actions text-center">
										<?php 
										if($order_row['ord_status']=='4' || $order_row['ord_status']=='3')
										{
											echo "Request Send";
										}
										else
										{
											?>
											<input type="hidden" value="<?php echo $order_row['ord_id'];?>" id="order_id" name="order_id">
											<button class="btn btn-danger btn-sm m_status"><i class="fa fa-times"></i></button>
											<?php
										}
										?>
																	
									</td>
								</tr>
								<?php
							}
						}
						?>
							
							</tbody>
						</table>
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
	
	<script>
	$(".m_status").click(function(){
	var order_id=$("#order_id").val();
		$.ajax({
			url:'ajax/set_modify_status.php',
			type:'post',
			data:{'order_id':order_id},
			success:function(data){
				if(data=='1'){
					location.reload();
				}
				
			},
		  })
		})
	</script>


</body>
</html>