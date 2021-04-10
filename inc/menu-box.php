<div class="menuBox search-box">
	<div class="container-fluid">
		<div class="row">
			<div class="col-md-12 ">
				<form action="search-result.php" method="post" class="hideDesktop">
					<input type="text" placeholder="Search your products..." name="search" class="form-control">
					<input type="submit" name="btn-ser" class="btn-search" value="&#xf002;">
				</form>

				<ul class="desktop-menu">
					<li><a href="index.php"><b><i class="fa fa-home"></i> Home</b></a></li>
						<?php
							
							$cat_o=$db->query("select * from category");
							if($cat_o->num_rows>0)
								{
									while($cato_rows= $cat_o->fetch_assoc())
									{
						?>
					<li><a href="product-listing.php?c_id=<?php echo $cato_rows['id'];?>"><?php echo $cato_rows['name']; ?></a></li>
					<?php  
							}
						}
										
					?>
					
				</ul>
			</div>
		</div>
	</div>
</div>