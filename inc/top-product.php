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

			<!--products-->

			<?php
						
						$top_p=$db->query("SELECT * from product WHERE is_featured = '1' AND status='1'");
						if($top_p->num_rows>0)
							{
							$i=1;
								while($top_rows= $top_p->fetch_assoc())
								{		
						?>


			<div class="col-md-3 col-sm-3 col-xs-12">
				<div class="row">
					<div class="box">
						<div class="col-md-12 col-sm-12 col-xs-6">
							<div class="img-box">
								<a href="#"><img src="abasket@Master/images/product/<?php echo $top_rows['image']; ?>"
										alt="category img"></a>

								<?php
							$price=$db->query("SELECT * FROM `option_detail` WHERE `sale_price`= (SELECT MIN(`sale_price`) FROM  option_detail WHERE p_id='".$top_rows['id']."') AND p_id='".$top_rows['id']."'");
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
									<input type="hidden" value="0" name="cat" id="catid<?php echo $top_rows['id'];  ?>">
									<input type="hidden" value="<?php echo $top_rows['id'];?>" name="pro_id"
										id="pro_id<?php echo $top_rows['id'];  ?>">
									<p class="p-name"><?php echo $top_rows['name']; ?></p>
									<?php
							$option=$db->query("SELECT * FROM `option_value` WHERE `id`='".$price_rows['value_id']."'");
							if($option->num_rows>0){
								$option_rows= $option->fetch_assoc();
							}
							?>
									<select class="form-control" id="detail_id<?php echo $top_rows['id'];?>"
										name="detail_id"
										onchange="set_option_value(this.value,<?php echo $top_rows['id'];?>);"
										required="">
									
										<?php
								$value=$db->query("SELECT option_detail.*, option_value.value FROM `option_detail` LEFT JOIN option_value ON option_detail.value_id=option_value.id WHERE option_detail.p_id='".$top_rows['id']."' AND option_detail.option_id='".$price_rows['option_id']."'");
								if($value->num_rows>0){
									while($value_rows= $value->fetch_assoc()){
										?>
										<option value="<?php echo $value_rows['id'];?>" selected>
											<?php echo $value_rows['value'];?></option>
										<!--<li onClick="change_price('<?php echo $rows['id'];?>','<?php echo $value_rows['id'];?>');"><a href="#"><?php echo $value_rows['value'];?></a></li>-->
										<?php
									}
								}
								?>

									</select>


									<div class="row">

										<div class="col-md-6 col-sm-6 col-xs-12"
											id="changeprice<?php echo $top_rows['id'];?>">
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
												
												$cart=$db->query("SELECT * from cart where p_id='".$top_rows['id']."' and member_id='".$_COOKIE['usertoken']."'");
												if($cart->num_rows>0)
												{
												 $cart_row = $cart->fetch_assoc();
													?>
												<div class="dflx" id="dynamicbtn<?php echo $top_rows['id'];?>">
													<span class="btn-qty minus-btn btn_increment_dec"
														onclick="updateC(<?php echo"$cart_row[cart_id]";?>,'1',<?php echo $top_rows['id'];?>)">-</span>
													<span class="qty">
														<input type="text" class="form-control" name="qua_name"
															id="updatecart<?php echo"$cart_row[cart_id]";?>"
															value="<?php echo"$cart_row[qty]";?>">
													</span>
													<span class="btn-qty plus-btn btn_increment_dec"
														onclick="updateC(<?php echo"$cart_row[cart_id]";?>,'2',<?php echo $top_rows['id'];?>)">+</span>
												</div>
												<button style="display:none;" class="btn btn-sm btn-new "
													id="log<?php echo $top_rows['id'];?>" type="button" name="btn-cart"
													onclick=addToCart(<?php echo $top_rows['id']; ?>);><i class="fa fa-plus"></i> Add To Cart
												</button>
												<?php
												}else{
												?>
												<div class="dflx" style="display:none;"
													id="dynamicbtn<?php echo $top_rows['id'];?>">
													
												</div>
												<button class="btn btn-sm btn-new "
													id="log<?php echo $top_rows['id'];?>" type="button" name="btn-cart"
													onclick=addToCart(<?php echo $top_rows['id']; ?>);><i class="fa fa-plus"></i> Add To Cart
												</button>
												<?php
												}
											?>
											</div>
											<?php
											}else{
												?>
											<div class="button_increment">

												<?php
												
												$cart=$db->query("SELECT * from cart where p_id='".$top_rows['id']."' and member_id='".$_SESSION['mem_id']."'");
												if($cart->num_rows>0)
												{
												 $cart_row = $cart->fetch_assoc();
													?>
												<div class="dflx" id="dynamicbtn<?php echo $top_rows['id'];?>">
													<span class="btn-qty minus-btn btn_increment_dec"
														onclick="updateC(<?php echo"$cart_row[cart_id]";?>,'1',<?php echo $top_rows['id'];?>)">-</span>
													<span class="qty">
														<input type="text" class="form-control" name="qua_name"
															id="updatecart<?php echo"$cart_row[cart_id]";?>"
															value="<?php echo"$cart_row[qty]";?>">
													</span>
													<span class="btn-qty plus-btn btn_increment_dec"
														onclick="updateC(<?php echo"$cart_row[cart_id]";?>,'2',<?php echo $top_rows['id'];?>)">+</span>
												</div>
												<button style="display:none;" class="btn btn-sm btn-new " id="log<?php echo $top_rows['id'];?>" type="button" name="btn-cart" onclick=addToCart(<?php echo $top_rows['id']; ?>);><i class="fa fa-plus"></i> Add To Cart
												</button>
												<?php
												}
												
												else
												{
													?>
												<div class="dflx" style="display:none;"
													id="dynamicbtn<?php echo $top_rows['id'];?>">
													
												</div>
												<button class="btn btn-sm btn-new "
													id="log<?php echo $top_rows['id'];?>" type="button" name="btn-cart"
													onclick=addToCart(<?php echo $top_rows['id']; ?>);><i
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
				?>
		</div>
	</div>
</div>
<!-- <script>
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
</script> -->
<script>
	function addToCart(e) {
		debugger
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
		//e.preventDefault(); // avoid to execute the actual submit of the form.
	}
</script>