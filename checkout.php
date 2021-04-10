<?php
session_start();
include("abasket@Master/lib/connectdb.php");
if(isset($_SESSION['mem_id'])){
	$db->query("SELECT * FROM cart where member_id='".$_SESSION['mem_id']."'");
	if(mysqli_affected_rows($db)>0){

	}else{
		header('Location: index.php');
	}
}else{
	header('Location: index.php');
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
	
	<div class="products mycart checkout">
		<div class="container">
		
			<div class="row">
				<div class="col-md-12">
					<div class="title">
						<h5>Checkout</h5>
					</div>
				</div>
			</div>
			<form method="POST" action="ajax/place-order.php">
					
			<h4>Shipping Address  
				<?php  
					$member_add=$db->query("SELECT * FROM `member_address` WHERE member_id='".$_SESSION['mem_id']."'");
					if($member_add->num_rows>0)
					{
						$member_add_row= $member_add->fetch_assoc();
					}
					else
					{
				?>
			
				<a data-toggle="modal" id="checkAdd" data-target="#add-address" class="add-address btn-sm btn-success btn pull-right"><i class="fa fa-plus"></i> Add Address</a>
				
				<?php
					}
					?>
			</h4>
			
			<div class="row product-list">
				<div class="col-sm-12 col-xs-12">
					<div class="address-list">
					
					<?php
						$cat_o=$db->query("select * from member_address where member_id ='".$_SESSION['mem_id']."' Order by id DESC");
						if($cat_o->num_rows>0)
							{
								while($cato_rows= $cat_o->fetch_assoc())
								{
					?>
					  <div class="row">
							<div class="col-md-9 address-detail">
								<p><input type="radio" checked name="address" value="<?php echo $cato_rows['id']; ?>"> <?php echo"$cato_rows[address], "."$cato_rows[city], "."$cato_rows[state] - "."$cato_rows[pin]";?></p>
							</div>
							
							<div class="col-md-3">
								<ul>
									<li><i class="fa fa-pencil" data-target="#edit-address" data-toggle="modal"></i></li>
									<li><i class="fa fa-trash" onclick="delete_address('<?php echo $cato_rows['id'];?>')"></i></li>
								</ul>
							</div>
							<input type="hidden" id="add_id" name="add_id" value="<?php echo $cato_rows['id'];?>">
					   </div>
					   <?php 			
								} 
							}
						?>
					   </div>
				</div>
			</div>
			
			<h4>Payment Method</h4>
			<div class="row product-list  payment-method" style="margin-top: 15px;">
				<div class="col-sm-4 col-xs-12">
					<div class="form-group">
						<p><input type="radio" value="0" checked name="pay-method"> Cash On Delivery</p>
						<!--<p><input type="radio" value="1"  name="pay-method"> Online Payment</p>-->
					</div>
				</div>
			</div>
			
			<?php
				$r=$db->query("SELECT `cart`.*, option_detail.sale_price as op_sale FROM `cart` LEFT JOIN option_detail ON option_detail.id=cart.option_detail WHERE cart.member_id='".$_SESSION['mem_id']."'");
				if($r->num_rows>0)
				{
					$total=0;
					while($rows= $r->fetch_assoc())
					{
						$qty=$rows['qty'];
						$price=$rows['op_sale'];
						$total=$total+($qty*$price);
					}
				?>
				<div class="row footer-checkout">
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
				<p><b>Delivery Charges: </b><span class="free"><i class="fa fa-rupee"></i> <?php echo $charges; ?></span></p>
				<?php
					if(isset($_SESSION['mem_id'])){
					$count = "SELECT count(*) as total FROM cart where member_id='".$_SESSION['mem_id']."'";
					$c = mysqli_query($db,$count);
					$srows = mysqli_fetch_assoc($c);
						if($srows['total']!=0)
						{
				?>
					<p><b>Total: </b><span class="free"><i class="fa fa-rupee"></i> <?php echo $total+$charges ;?></span></p>
					
				<?php
						}
						
					}		
				?>
				
				</div>
				
				
				<!--new -->
								<div class="col-md-12 col-xs-12">
			            	
				<div class="row">
					<div class="col-md-12">
						<div class="form-group">
							<label for="">Delivery Timing</label>
							<select required="" name="time_slot" id="" class="form-control">
								<option value="">Select Time-Slot</option>
								<?php
								$option_value=$db->query("select * from time_slot order by id desc");
								if($option_value->num_rows>0)
								{
									while($option_value_rows= $option_value->fetch_assoc())
									{
										?><option value="<?php echo $option_value_rows['slot'];?>"><?php echo $option_value_rows['slot'];?></option><?php
									}
								}
								?>
								
							</select>
						</div>
					</div>
					<div class="col-md-12">
						<label for="">Add Comments</label>
						<div class="form-group">
							<textarea name="comment" id="" class="form-control" rows="5"></textarea>
						</div>
					</div>
				</div>
			
				
				</div>
				
				
				
				
				<!--new -->
				<div class="col-md-12 col-xs-12">
					<button class="btn btn-new" id="submitOrder" type="submit" name="submit">Place Order</button><p id="add-err"></p>
				</div>
			</div>
				<?php
				}
				else
				{
					echo "1";
				}
			?>
			</form>
			
		</div>
	</div>
	
	
		<!--add address-->
	<div id="add-address" class="modal fade add-address-box" role="dialog">
		<div class="modal-dialog md-modal">
			
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<h4 class="modal-title"><h3>Add Address</h3></h4>
				</div>
				<div class="modal-body">
				
					<form class="form" action="" method="post" id="addmyaddress">
						  <div class="form-group">
							  <div class="row">
								  <div class="col-md-6">
								  <input type="hidden" id="user_id" value="<?php echo $_SESSION['mem_id'];?>">
									  <label for="phone"><h4>Full Address</h4></label>
									  <input type="text" class="form-control" name="address" id="full_address" placeholder="Enter full address">
								  </div>
								   <div class="col-md-6">
									  <label for="phone"><h4>Enter City</h4></label>
									  <input type="text" class="form-control" name="city" id="city" placeholder="Enter full city">
								  </div>
							  </div>
						  </div>
						
						  <div class="form-group">
							   <div class="row">
								  <div class="col-md-6">
									  <label for="phone"><h4>State</h4></label>
									  <select class="form-control" id="id_state" name="state">
											<option value="">Select State</option>
											<option value="Andaman and Nicobar Islands">Andaman and Nicobar Islands</option>
											<option value="Andhra Pradesh">Andhra Pradesh</option>
											<option value="Arunachal Pradesh">Arunachal Pradesh</option>
											<option value="Assam">Assam</option>
											<option value="Bihar">Bihar</option>
											<option value="Chandigarh">Chandigarh</option>
											<option value="Chhattisgarh">Chhattisgarh</option>
											<option value="Dadra and Nagar Haveli">Dadra and Nagar Haveli</option>
											<option value="Daman and Diu">Daman and Diu</option>
											<option value="Delhi">Delhi</option>
											<option value="Goa">Goa</option>
											<option value="Gujarat">Gujarat</option>
											<option value="Haryana">Haryana</option>
											<option value="Himachal Pradesh">Himachal Pradesh</option>
											<option value="Jammu and Kashmir">Jammu and Kashmir</option>
											<option value="Jharkhand">Jharkhand</option>
											<option value="Karnataka">Karnataka</option>
											<option value="Kerala">Kerala</option>
											<option value="Lakshadweep">Lakshadweep</option>
											<option value="Madhya Pradesh">Madhya Pradesh</option>
											<option value="Maharashtra">Maharashtra</option>
											<option value="Manipur">Manipur</option>
											<option value="Meghalaya">Meghalaya</option>
											<option value="Mizoram">Mizoram</option>
											<option value="Nagaland">Nagaland</option>
											<option value="Orissa">Orissa</option>
											<option value="Pondicherry">Pondicherry</option>
											<option value="Punjab">Punjab</option>
											<option value="Rajasthan">Rajasthan</option>
											<option value="Sikkim">Sikkim</option>
											<option value="Tamil Nadu">Tamil Nadu</option>
											<option value="Tripura">Tripura</option>
											<option value="Uttaranchal">Uttaranchal</option>
											<option value="Uttar Pradesh">Uttar Pradesh</option>
											<option value="West Bengal">West Bengal</option>
										</select>
								  </div>
								  
								   <div class="col-md-6">
									  <label for="phone"><h4>Enter PIN</h4></label>
									  <input type="text" class="form-control" name="pin" id="pin" placeholder="Enter your pin">
								  </div>
								</div>
						  </div>
						  
						  <div class="form-group">
							  <div class="row">
								   <div class="col-md-12">
										<br>
										<button class="btn btn-md btn-success" type="submit"><i class="glyphicon glyphicon-plus"></i> Add Address</button>
									</div>
							   </div> 
						  </div>
							<p class="address-alert" style="display:none;">Address updated successfully.</p>
							<p class="address-alert1" style="display:none;color:red;">Kindly re-check form</p>
							<p class="address-alert2" style="display:none;color:red;">User not exists</p>
					</form>
				</div>
			</div>
		</div>
	</div>
		
		
		<!--edit address-->
	
		<div id="edit-address" class="modal fade edit-address-box" role="dialog">
		<div class="modal-dialog md-modal">
			
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<h4 class="modal-title"><h3>Edit Address</h3></h4>
				</div>
				<div class="modal-body">
				
					<form class="form" action="action" method="post" id="editmyaddress">
						  <div class="form-group">
							  <div class="row">
							  <input type="hidden" id="add_id" value="">
								  <div class="col-md-6">
									  <label for="phone"><h4>Full Address</h4></label>
									  <input type="text" class="form-control" name="address" id="full_addresss" placeholder="Enter full address">
								  </div>
								   <div class="col-md-6">
									  <label for="phone"><h4>Enter City</h4></label>
									  <input type="text" class="form-control" name="city" id="citys" placeholder="Enter full city">
								  </div>
							  </div>
						  </div>
						
						  <div class="form-group">
							   <div class="row">
								  <div class="col-md-6">
									  <label for="phone"><h4>State</h4></label>
									  <select class="form-control" id="id_states" name="state">
											<option value="">Select State</option>
											<option value="Andaman and Nicobar Islands">Andaman and Nicobar Islands</option>
											<option value="Andhra Pradesh">Andhra Pradesh</option>
											<option value="Arunachal Pradesh">Arunachal Pradesh</option>
											<option value="Assam">Assam</option>
											<option value="Bihar">Bihar</option>
											<option value="Chandigarh">Chandigarh</option>
											<option value="Chhattisgarh">Chhattisgarh</option>
											<option value="Dadra and Nagar Haveli">Dadra and Nagar Haveli</option>
											<option value="Daman and Diu">Daman and Diu</option>
											<option value="Delhi">Delhi</option>
											<option value="Goa">Goa</option>
											<option value="Gujarat">Gujarat</option>
											<option value="Haryana">Haryana</option>
											<option value="Himachal Pradesh">Himachal Pradesh</option>
											<option value="Jammu and Kashmir">Jammu and Kashmir</option>
											<option value="Jharkhand">Jharkhand</option>
											<option value="Karnataka">Karnataka</option>
											<option value="Kerala">Kerala</option>
											<option value="Lakshadweep">Lakshadweep</option>
											<option value="Madhya Pradesh">Madhya Pradesh</option>
											<option value="Maharashtra">Maharashtra</option>
											<option value="Manipur">Manipur</option>
											<option value="Meghalaya">Meghalaya</option>
											<option value="Mizoram">Mizoram</option>
											<option value="Nagaland">Nagaland</option>
											<option value="Orissa">Orissa</option>
											<option value="Pondicherry">Pondicherry</option>
											<option value="Punjab">Punjab</option>
											<option value="Rajasthan">Rajasthan</option>
											<option value="Sikkim">Sikkim</option>
											<option value="Tamil Nadu">Tamil Nadu</option>
											<option value="Tripura">Tripura</option>
											<option value="Uttaranchal">Uttaranchal</option>
											<option value="Uttar Pradesh">Uttar Pradesh</option>
											<option value="West Bengal">West Bengal</option>
										</select>
								  </div>
								  
								   <div class="col-md-6">
									  <label for="phone"><h4>Enter PIN</h4></label>
									  <input type="text" class="form-control" name="pin" id="pins" placeholder="Enter your pin">
								  </div>
								</div>
						  </div>
						  
						  <div class="form-group">
							  <div class="row">
								   <div class="col-md-12">
										<br>
										<button class="btn btn-md btn-success" type="submit"><i class="glyphicon glyphicon-plus"></i> Edit Address</button>
									</div>
							   </div> 
						  </div>
							<p class="address1-alert" style="display:none;">Address Updated Successfully.</p>
							<p class="address1-alert1" style="display:none;color:red;">Kindly re-check form</p>
							<p class="address1-alert2" style="display:none;color:red;">User not exists</p>
						</form>
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

<script>
	$(".address-detail input").click(function(){
		var a = $(this).val();
		$('#address_id').val(a);
	})
	$(document).ready(function(){
		var add = $(".address-detail input:checked").val();
		$('#address_id').val(add);
	})
	
	if($('#checkAdd').length){
		$("#submitOrder").attr("disabled", true);
		$("#add-err").text('Add address');
	}else{
		
	}
</script>

</body>
</html>