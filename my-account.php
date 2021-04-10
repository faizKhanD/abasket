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
						<li><a href="my-account.php">My Account</a></li>
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
				<div class="col-sm-9 col-xs-12">
					<ul class="nav nav-tabs">
						<li class="active"><a data-toggle="tab" href="#profile">My Profile</a></li>
						<li><a data-toggle="tab" href="#changepassword">Change Password</a></li>
						<li><a data-toggle="tab" href="#address">My Address</a></li>
					</ul>

					<?php  
					$member=$db->query("SELECT *  FROM `member` WHERE id='".$_SESSION['mem_id']."'");
					if($member->num_rows>0)
					{
						$member_pro= $member->fetch_assoc();
					}
					?>  
				  <div class="tab-content">
					<div class="tab-pane fade in active" id="profile">
						<h3>My Profile</h3>
						<hr/>
						  <form class="form" action="" method="post" id="updateprofile">
								<div class="form-group">
									<div class="row">  
									  <div class="col-md-6">
										  <label for="first_name"><h4>Name</h4></label>
										  <input type="text" class="form-control" name="first_name" id="update_name" placeholder="first name" value="<?php echo $member_pro['name'];?>">
									  </div>
									</div>
							
								  </div>
								  
				  
							  <div class="form-group">
									<div class="row">
									  <div class="col-md-6">	
										  <label for="phone"><h4>Mobile</h4></label>
										  <input type="text" class="form-control" name="phone" id="update_mobile" placeholder="enter phone" value="<?php echo $member_pro['mobile'];?>">
									  </div>
									  <div class="col-md-6">
										  <label for="email"><h4>Email</h4></label>
										  <input type="email" class="form-control" name="email" id="email" placeholder="you@email.com" readonly value="<?php echo $member_pro['email'];?>">
									  </div>
									</div> 
							  </div>

							  <div class="form-group">
								<div class="row">
									   <div class="col-xs-12">
											<button class="btn btn-md btn-success" name="update" type="submit"><i class="glyphicon glyphicon-ok-sign"></i> Update</button>
										</div>
								</div>
							  </div>
								<p class="pro-alert" style="display:none">profile updated successfully</p> 
								<p class="pro-alert1" style="color:red;display:none">kindly re-check the values</p>
						</form>
					  
					  <hr>
					  
					 </div><!--/tab-pane-->
					 <div class="tab-pane fade" id="changepassword">
					   
					   <h3>Change Password</h3>
					   <hr/>
						  <form class="form" action="" method="post" id="changepasswordform">
							 
							  <div class="form-group">
								  <div class="row">
									  <div class="col-md-6">
										  <label for="password"><h4>Old Password</h4></label>
										  <input type="password" class="form-control" name="old_password" id="old_password" placeholder="password" title="enter your old password.">
									  </div>
									  <div class="col-md-6">
										<label for="password2"><h4>New Password</h4></label>
										  <input type="password" class="form-control" name="new_password" id="new_password" placeholder="password" title="enter your new password">
									  </div>
								   </div>
							  </div>
							
							  <div class="form-group">
								  <div class="row">
									  <div class="col-md-6">
										<label for="password2"><h4>Repeat Password</h4></label>
										  <input type="password" class="form-control" name="verify_password" id="verify_password" placeholder="Repeat Password">
									  </div>
								   </div>
							  </div>
							  <div class="form-group">
									<div class="row">
									   <div class="col-md-12">
											<br>
											<button class="btn btn-md btn-success" type="submit"><i class="glyphicon glyphicon-ok-sign"></i> Change Password</button>
										</div>
									</div>
							  </div>
								<p class="pass-alert" style="display:none">New password updated successfully</p> 
								<p class="pass-alert1" style="color:red;display:none">password didn't match</p> 
								<p class="pass-alert2" style="color:red;display:none">Old password wrong</p> 
								<p class="pass-alert3" style="color:red;display:none">member doesn't exist</p> 
						</form>
					   
					 </div><!--/tab-pane-->
					 <div class="tab-pane fade" id="address">
							
						  <h3>My Address</h3>
						  <hr/>
						  
						  <div class="well">
							<?php  
							$member_add=$db->query("SELECT * FROM `member_address` WHERE member_id='".$_SESSION['mem_id']."'");
							if($member_add->num_rows>0)
							{
								$member_add_row= $member_add->fetch_assoc();
							}
							else
							{
								?>
								<div class="row">
									<div class="col-md-12">
										  <a data-toggle="modal" data-target="#add-address" class="add-address btn-success btn pull-left"><i class="fa fa-plus"></i> Add Address</a>
									</div>
								</div>
								<?php
							}
							?>
							
							
							<div class="address-list">
								<?php  
								$member_add=$db->query("SELECT * FROM `member_address` WHERE member_id='".$_SESSION['mem_id']."'");
								if($member_add->num_rows>0)
								{
									$member_add_row= $member_add->fetch_assoc();
									?>
									<div class="row address-row">
											<div class="col-md-9">
												<p><input checked type="radio" class="add-val" name="address" value="<?php echo $member_add_row['id'];?>"><?php echo $member_add_row['address'].", ".$member_add_row['city'].", ".$member_add_row['state'].", ".$member_add_row['pin']?></p>
											</div>
											
											<div class="col-md-3">
												<ul>
													<li><i class="fa fa-pencil edit-add" data-target="#edit-address" data-toggle="modal"></i></li>
													<li><i class="fa fa-trash" onclick="delete_address('<?php echo $member_add_row['id'];?>')"></i></li>
												</ul>
											</div>
									   </div>
									<?php
									
								}
								?>		
										
							   
							 </div>
							
						  </div>
				
					  </div>
					   
					  </div><!--/tab-pane-->
				  </div><!--/tab-content-->

				</div><!--/col-9-->
			</div><!--/row-->
			
		</div>
	</section>
	
	
	
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
							<p class="address1-alert" style="display:none;">Address updated successfully.</p>
							<p class="address1-alert1" style="display:none;color:red;">Kindly re-check form</p>
							<p class="address1-alert2" style="display:none;color:red;">User not exists</p>
						</form>
				</div>
			</div>
		</div>
	</div>
	
	
	
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
