<?php
if(!isset($_SESSION['mem_id'])){
	if(!isset($_COOKIE['usertoken'])){
		$token = time();
		setcookie('usertoken',$token, time() + (86400 * 30), "/");
	}	
}
?>
<header class="header_moveble navigation-background">
		<nav class="navbar">
			<div class="container">

				<div class="row navbar-header custHeader">
					<div class="col-md-3 col-xs-2">
						<button type="button" class="navbar-toggle hideDesktop" data-toggle="collapse" data-target="#myNavbar">
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span> 
						</button>
						<a class="navbar-brand" href="index.php"><img src="images/logo.png" alt="logo" style=" width:170px;"></a>
					</div>
					<div class="col-md-6 hideMobile">
						<div class="search-box">
							<form action="search-result.php" method="post">
								<input type="text" placeholder="Search your products..." name="search" class="form-control">
								<input type="submit" name="btn-ser" class="btn-search" value="&#xf002;">
							</form>
						</div>
					</div>
					
					<div class="col-md-3 col-xs-10 pad_mobile_o">
						<ul class="account-section">
							<!--<li>
								<a data-toggle="modal" data-target="#search-by-ciy">
							<i class="fa fa-map-marker"></i>	Location
								</a>
							</li>-->



							<li class="dropdown">
								
							<?php
							if(isset($_SESSION['mem_id']))
							{
								?>
								<a href="#" data-toggle="dropdown"><?php echo $_SESSION["mem_name"];?> <i class="fa fa-user"></i></a>
								<ul class="dropdown-menu" role="menu">
									<li><a href="my-account.php">My Account</a></li>
									<li><a href="my-orders.php">My Orders</a></li>
									<li><a href="ajax/logout.php">Sign Out</a></li>
								</ul>
								<?php
							}
							else
							{
								?><a data-toggle="modal" data-target="#login"><i class="fa fa-sign-in"></i>	Login</a><?php
							}
							?>
							</li>
							
							<?php
								

								
									 if(isset($_COOKIE['usertoken'])){
							
									$count = "SELECT SUM(qty) as total FROM cart where member_id='".$_COOKIE['usertoken']."'";
									$c = mysqli_query($db,$count);
									$srows = mysqli_fetch_assoc($c); 
									
										?>
										<li><a href="cart.php">
										<i class="fa fa-shopping-cart"></i> 
										<span class="badge" id="total_cnt"><?php echo $srows['total']; ?></span>
										</a></li>
										<?php
									}
									elseif(isset($_SESSION['mem_id'])){

										$count = "SELECT SUM(qty) as total FROM cart where member_id='".$_SESSION['mem_id']."'";
										$c = mysqli_query($db,$count);
										$srows = mysqli_fetch_assoc($c);  
										?>
										<li><a href="cart.php">
										<i class="fa fa-shopping-cart"></i> 
										<span class="badge" id="total_cnt"><?php echo"$srows[total]";?></span>
										</a></li>
										<?php	

									}
								?>
							
						</ul>
					</div>
				</div>

				
			</div>
		</nav>
		
	
		
		<?php include 'inc/menu-box.php'?>
		
		
		<div class="menu">
			
			<span class="fa fa-arrow-left"></span>
		
			<ul>
				<li class="bg-white"><a href="index.php"><img src="images/logo.png" alt="logo" width="100%"></a></li>
				<?php
					
					$mcat_o=$db->query("select * from category");
					if($mcat_o->num_rows>0)
						{
							while($mcato_rows= $mcat_o->fetch_assoc())
							{
				?>
				<li><a href="product-listing.php?c_id=<?php echo $mcato_rows['id'];?>"><?php echo $mcato_rows['name']; ?></a></li>
				<?php  
						}
					}
									
				?>
			</ul>
		</nav>
		
		
	</header>
	
	
	
		<!-- Login & Signup -->
	<div id="search-by-ciy" class="modal fade search-by-ciy" role="dialog">
		<div class="modal-dialog md-modal">
			<!-- Login box-->
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<h4 class="modal-title"><b>Delivery Details</b></h4>
				</div>
				<div class="modal-body">
					<div class="srch-del">
						<p class="sub-title">Delivery Area: &nbsp Jamshedpur </p>
						<!--<ul>	
							<li><a href="#"><b> Jamshedpur</b></a></li>
						</ul>-->
					</div>
					
					<div class="srch-del">
						<p class="sub-title">Delivery Timing</p>
						<ul>	
							<li><i class="fa fa-certificate"></i> Booking time <b>8:00 AM to 5:00 PM</b></li>
							<li><i class="fa fa-certificate"></i> Delivery time <b>2:00 PM to 6:00 PM</b></li>
						</ul>
					</div>
					
					<!--<div class="srch-del">
						<p class="sub-title">Delivery Charges</p>
						<table class="table table-responsive">
							<thead>
							  <tr>
								<th>City</th>
								<th>Order Value</th>
								<th>Charges</th>
							  </tr>
							</thead>
							<tbody>
							  <tr>
								<td rowspan="4" style="text-align:center; border-right: 1px solid #dddddd; vertical-align: middle;">Churcha<br/>and<br/>Baikunthpur</td>
								<td><i class="fa fa-rupee"></i> 500</td>
								<td><i class="fa fa-rupee"></i> 99</td>
							  </tr>
							  <tr>
								<td><i class="fa fa-rupee"></i> 500 - 1000</td>
								<td><i class="fa fa-rupee"></i> 89</td>
							  </tr>
							  <tr>
								<td><i class="fa fa-rupee"></i> 1000-3000</td>
								<td><i class="fa fa-rupee"></i> 49</td>
							  </tr>
							   <tr>
								<td><i class="fa fa-rupee"></i> 3000</td>
								<td><i class="fa fa-rupee"></i> Free</td>
							  </tr>
							</tbody>
						  </table>
					</div>-->
					
					<div class="clearfix"></div>
					
				</div>
			</div>
		</div>
	</div>