	<!-- Main navbar -->
	<div class="navbar navbar-inverse">
		<div class="navbar-header">
			<a class="navbar-brand logo-text" href="manage_product.php">Abasket</a>

			<ul class="nav navbar-nav pull-right visible-xs-block">
				<li><a data-toggle="collapse" data-target="#navbar-mobile"><i class="icon-tree5"></i></a></li>
			</ul>
		</div>

		<div class="navbar-collapse collapse" id="navbar-mobile">
			<ul class="nav navbar-nav navbar-right">
				<li class="dropdown dropdown-user">
					<a class="dropdown-toggle" data-toggle="dropdown">
						<img src="assets/images/demo/users/face11.jpg" alt="">
						<span>
                        <?php  echo @$_SESSION['admin_name']?></span>
						<i class="caret"></i>
					</a>

					<ul class="dropdown-menu dropdown-menu-right">
						<li><a href="logout.php"><i class="icon-switch2"></i> Logout</a></li>
					</ul>
				</li>
			</ul>
		</div>
	</div>
	<!-- /main navbar -->


	<!-- Second navbar -->
	<div class="navbar navbar-default" id="navbar-second">
		<ul class="nav navbar-nav no-border visible-xs-block">
			<li><a class="text-center collapsed" data-toggle="collapse" data-target="#navbar-second-toggle"><i class="icon-menu7"></i></a></li>
		</ul>

		<div class="navbar-collapse collapse" id="navbar-second-toggle">
			<ul class="nav navbar-nav" style="margin-left: 5px;">
				<!--<li class="active"><a href="home.php"><i class="icon-display4 position-left"></i> Dashboard</a></li>-->
                 
				<li class="dropdown">
					<a href="manage_category.php" aria-expanded="false">
						<i class="icon-box position-left"></i> Category 
					</a>
				</li>
				<!--<li>
					<a href="manage_sub_category.php" aria-expanded="false">
					<i class="icon-box position-left"></i> Sub-Category
					</a>
				</li>
				<li>
					<a href="manage_sub1_category.php" aria-expanded="false">
					<i class="icon-box position-left"></i> Sub1-Category
					</a>
				</li>-->
				 
                <li class="dropdown">
				   <a class="dropdown-toggle" data-toggle="dropdown">
					<i class="icon-popout"></i> Product<i class="caret"></i>
					</a>
					<ul class="dropdown-menu dropdown-menu-right">
						<li>
							<a href="manage_product.php" aria-expanded="false">
								<i class="icon-box position-left"></i> Add Product 
							</a>
						</li>
						
						<li>
							<a href="manage_option.php" aria-expanded="false">
								<i class="icon-box position-left"></i> Product Option 
							</a>
						</li>
						
					 </ul>
				</li>    
						
				<li class="dropdown">
				   <a class="dropdown-toggle" data-toggle="dropdown">
					<i class="icon-popout"></i> Customer<i class="caret"></i>
					</a>
					<ul class="dropdown-menu dropdown-menu-right">
						<li><a href="manage_customer.php" aria-expanded="false">
						<i class="icon-popout"></i> Profile</a></li>
					 </ul>
				</li> 
				<li>
					<a href="banner.php" aria-expanded="false">
					<i class="icon-box position-left"></i> Manage Slider
					</a>
				</li>
				<li>
					<a href="add_delivery.php" aria-expanded="false">
					<i class="icon-box position-left"></i> Manage Delivery Charges
					</a>
				</li>
				<li>
					<a href="add_banner_text.php" aria-expanded="false">
					<i class="icon-box position-left"></i> Manage Banner Text
					</a>
				</li>
				<li>
					<a href="add_timeSlot.php" aria-expanded="false">
					<i class="icon-box position-left"></i> Manage Time-Slot
					</a>
				</li>
				
				<li>
					<a href="orders.php" aria-expanded="false">
					<i class="icon-box position-left"></i> Manage Order
					</a>
				</li>
				
				
					 
               
 			</ul>
		</div>
	</div>
	<!-- /second navbar -->

<style>
	
.logo-text {
    font-size: 30px;
    font-family: cursive;
    font-weight: 600;
}
	
</style>
