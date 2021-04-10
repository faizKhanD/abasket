<?php
session_start();

$pro_id = $_GET['pro_id'];
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

        <?php include 'inc/header.php'?>

        <div class="products">
            <div class="container">
                <div class="row product-list product-detail">

                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <div class="row">
                            <?php
						$pro=$db->query("select * from product where id='$pro_id'");
						if($pro->num_rows>0)
						{
							$rows= $pro->fetch_assoc();
						}
					?>
                                <div class="box">
                                    <form action="ajax/add-to-cart.php" method="POST">
                                        <div class="col-md-12 col-sm-12 col-xs-12">
                                            <div class="box-content">
                                                <h4>
                                                    <a href="#">
                                                        <?php echo"$rows[name]";?>
                                                    </a>
                                                </h4>
                                                <p class="about-product">
                                                    <?php echo"$rows[description]";?>
                                                </p>

                                                <?php
										 $d_sale=$rows['sale_price'];
										 $d_regular=$rows['price'];
										 $d_solve= $d_regular - $d_sale;
										$d_per = ($d_solve / $d_regular) * 100 ;
									?>

                                                    <?php
									if($rows['price']==$rows['sale_price'] || $rows['price']==0)
									{
										?>
                                                        <p class="price" id="feat_price">Rs.
                                                            <?php echo"$rows[sale_price]";?>
                                                        </p>
                                                        <?php
										}
										else
										{
										?>
                                                            <p class="price" id="feat_price">Rs.
                                                                <?php echo"$rows[sale_price]";?> <small>MRP </small> <del>Rs.
												<?php echo"$rows[price]";?>
											</del> <span class="saved-price">
												<?php echo round($d_per) ;?>% off
											</span>
                                                            </p>
                                                            <?php
										}	
									?>
                                                                <p class="price" id="le_price" style="display:none;"></p>
                                            </div>
                                        </div>

                                        <div class="col-md-12 col-sm-12 col-xs-12">

                                            <div class="owl-carousel owl-theme product-slider" id="owl-demo">
                                                <div class="items">
                                                    <div class="img-box">
                                                        <img src="abasket@Master/images/product/<?php echo " $rows[image] ";?>" alt="product img">
                                                    </div>
                                                </div>
                                                <?php
									
									
									$slider_pro=$db->query("SELECT * FROM `product_images` WHERE `product_id`='$pro_id'");
									if($slider_pro->num_rows>0)
									{
										while($slider_rows= $slider_pro->fetch_assoc())
													{
										
								?>
                                                    <div class="items">
                                                        <div class="img-box">
                                                            <img src="abasket@Master/images/product/<?php echo " $slider_rows[image_name] ";?>" alt="gallery img">
                                                        </div>
                                                    </div>

                                                    <?php
													
												}
									}				
											?>


                                            </div>
                                        </div>

                                        <div class="clearfix"></div>
                                        <div class="col-md-12">
                                            <?php 
								$option_detail=$db->query("SELECT `option_detail`.*, option.option FROM `option_detail` inner join option on `option_detail`.option_id=option.id WHERE `p_id`='$pro_id'");
								if($option_detail->num_rows>0)
								{
									
									$option_detail_rows= $option_detail->fetch_assoc();
									
									
							?>
                                            <p class="s-title"><b>
											<?php echo $option_detail_rows['option']?>
										</b></p>

                                            <?php
							
								}
							?>

                                                <select class="form-control" name="deli_weight" onChange="set_option_value(this.value);" required>
										<option value="">Select
											<?php echo $option_detail_rows['option']?>
										</option>
										<?php
										$w=$db->query("SELECT `option_detail`.*, option_value.value FROM `option_detail` inner join option_value on `option_detail`.value_id=option_value.id WHERE `p_id`='$pro_id'");
										if($w->num_rows>0)
										{
											while($w_row= $w->fetch_assoc())
											{
									?>
										<option value="<?php echo" $w_row[id]";?>">
											<?php echo"$w_row[value]";?>
										</option>

										<?php	
										}
										
									}
								?>
									</select>

                                        </div>

                                        <div class="col-md-12">
                                            <p class="s-title b-bottom"><b>Delivery</b></p>
                                            <span>Tomorrow Morning</span>
                                        </div>

                                        <div class="col-md-12">
                                            <input type="hidden" value="<?php echo " $pro_id "?>" name="pro_id">
                                            <input id="p-price" type="hidden" value="" name="detail_id">
                                            <?php
									if(isset($_SESSION["mem_id"]))
									{
										$cart=$db->query("SELECT * from cart where p_id='$pro_id' and member_id='$_SESSION[mem_id]'");
										if($cart->num_rows>0)
										{
											$cart_row = $cart->fetch_assoc();
									?>

                                                <a href="cart.php"><button class="btn btn-sm btn-new add-cart" name="btn-cart"
											type="button"><i class="fa fa-eye"></i> View Cart</button></a>

                                                <?php
										}
										else
										{
									?>

                                                    <button class="btn btn-sm btn-new add-cart" style="display:none;" type="submit" id="viewcart<?php echo" $pro_id ";?>"><i class="fa fa-plus"></i> Add To
										Cart</button>

                                                    <button class="btn btn-sm btn-new add-cart" id="addcart<?php echo" $pro_id ";?>" onclick="addtocart(
										<?php echo" $pro_id ";?>)" type="button"><i class="fa fa-plus"></i> Add To Cart
									</button>

                                                    <?php
										}
									}
									else
									{
								?>

                                                        <button class="btn btn-sm btn-new add-cart" onclick="myFunction()" name="btn-cart" type="button"><i class="fa fa-plus"></i> Add To Cart</button>

                                                        <p id="myAlert"><b>You have to <a data-toggle="modal" data-target="#login">login</a>
											first.</b></p>


                                                        <?php
									}
								?>

                                        </div>

                                    </form>
                                </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>

        <section class="products similar-products">
            <div class="container">
                <div class="row">
                    <div class="col-md-12 col-sm-12 col-xs-12">

                        <h4>Similar Products</h4>

                        <div class="slider owl-carousel owl-theme" id="owl-demo2">
                            <?php
						
							$cat_id=$rows['cat_id'];
							$rel_pro=$db->query("SELECT product.*, option_detail.sale_price as op_sale, option_detail.price as op_price, option_value.value as opt_val from product inner join option_detail on product.id=option_detail.p_id left join option_value on option_detail.value_id=option_value.id where cat_id='$cat_id'");
							
							if($rel_pro->num_rows>0)
							{
								while($rel_rows= $rel_pro->fetch_assoc())
								{
						?>

                                <div class="box items">
                                    <a href="product-detail.php?pro_id=<?php echo" $rel_rows[id] ";?>">
                                        <div class="img-box">
                                            <img src="abasket@Master/images/product/<?php echo" $rel_rows[image] ";?>" alt="category img">
                                        </div>
                                        <div class="box-content">
                                            <p>
                                                <?php echo"$rel_rows[name]";?>
                                            </p>
                                            <select class="form-control" name="deli_weight" onchange="set_option_value(this.value);" required="">
										<option value="">Select </option>
										<option value="28">1 Kg</option>
									</select>
                                            <p class="weight">
                                                <?php echo $rel_rows['opt_val']; ?>
                                            </p>

                                            <?php
										if($rel_rows['op_price']==$rel_rows['op_sale'] || $rel_rows['op_price']==0)
										{
											?>
                                                <p class="price">Rs.
                                                    <?php echo"$rel_rows[op_sale]";?>
                                                </p>
                                                <?php
										}
										else
										{
											?>
                                                    <p class="price">Rs.
                                                        <?php echo"$rel_rows[op_sale]";?><br /><small>MRP </small> <del>Rs.
											<?php echo"$rel_rows[op_price]";?>
										</del>
                                                    </p>
                                                    <?php
										}	
									?>

                                                        <a href="product-detail.php?pro_id=<?php echo" $rel_rows[id] ";?>"><button
											class="btn btn-sm btn-new" type="button">Add to Cart <i
												class="fa fa-arrow-circle-right"></i></button></a>
                                        </div>
                                    </a>
                                </div>
                                <?php
								}
							}
											
						?>

                        </div>


                    </div>
                </div>
            </div>
        </section>


        <?php include 'inc/login-popup.php'?>
        <?php include 'inc/footer.php'?>

        <script src="js/jquery.min.js"></script>
        <script src="js/custom.js"></script>
        <script src="bootstrap/js/bootstrap.min.js"></script>
        <script src="OwlCarousel/dist/owl.carousel.min.js"></script>


        <script>
            $("#owl-demo").owlCarousel({
                items: 1,
            })
        </script>

        <script>
            $("#owl-demo2").owlCarousel({
                items: 4,
                loop: true,
                autoplay: true,
                pagination: false,
                nav: false,
                dots: false,
                responsiveClass: true,
                responsive: {
                    0: {
                        items: 1
                    },
                    300: {
                        items: 2
                    },
                    500: {
                        items: 2
                    },
                    700: {
                        items: 3
                    },
                    1000: {
                        items: 4
                    }

                }
            });
        </script>

        <script>
            $(".navbar-toggle").click(function() {
                $(".menu").animate().css({
                    left: '0px'
                })
            })
            $(".menu .fa-arrow-left").click(function() {
                $(".menu").animate().css({
                    left: '-204px'
                })
            })
        </script>

        <script>
            function set_option_value(id) {
                $.ajax({
                    url: 'ajax/get_option_value.php',
                    type: 'post',
                    data: {
                        'id': id
                    },
                    success: function(data) {
                        if (data != "") {
                            $("#le_price").html(data);
                            $("#le_price").show();
                            $("#feat_price").hide();
                            var d = $("#span_price").text();
                            $("#p-price").val(d);

                        }
                    },
                });
            }
        </script>

        <script>
            function addtocart(e) {
                //alert(e);

                $.ajax({
                    url: 'ajax/add-cart.php?pro_id=' + e,
                    data: '',
                    dataType: '',
                    success: function(data) {
                        //alert(data);
                        if (data == 1) {
                            location.reload();
                        } else if (data == 2) {
                            $('#alert' + e).show();
                        }
                    },
                });
                $('#viewcart' + e).show();
                $('#addcart' + e).hide();
            }
        </script>

    </body>

    </html>