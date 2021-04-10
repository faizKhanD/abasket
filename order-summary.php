<?php
	session_start();
	include('abasket@Master/lib/connectdb.php');
if ($_POST) {
	$razorpay_payment_id = $_POST['razorpay_payment_id'];
	if(isset($razorpay_payment_id))
	{
		$r=$db->query("SELECT `cart`.*,product.*, member_address.address, member_address.city, member_address.state, member_address.pin, option_detail.price,option_detail.sale_price as op_sale,option_value.value as opt_val, option_value.id as val_id FROM `cart`LEFT JOIN product ON product.id=cart.p_id
				LEFT JOIN option_detail ON option_detail.id=cart.option_detail
				LEFT JOIN member_address ON member_address.member_id=cart.member_id
				LEFT JOIN option_value ON option_value.id=option_detail.value_id WHERE cart.member_id='".$_SESSION['mem_id']."'");
		
		if($r->num_rows>0)
		{
			
			$pro_id=array();
			$price=array();
			$qty=array();
			$total_p=array();
			while($rows= $r->fetch_assoc())
			{
				
				$pro_id[]=$rows['p_id'];
				$qty[]=$rows['qty'];
				$cust_id=$rows['member_id'];
				$val_id[]=$rows['val_id'];
				$price=$rows['op_sale'];
				
				$add=$rows['address'];
				$city=$rows['city'];
				$state=$rows['state'];
				$pin=$rows['pin'];
				
				
				$price1[]=$rows['op_sale'];
    				
					$total=$rows['qty']*$price;
					
					$total_p[]=$total;
					
			}
			$to=0;
			foreach($total_p as $i=>$tota){
				$to = $to + $tota; 
			}
			 $to = $to + 20;
			
			$pro_id =  implode(",",$pro_id);
			
			$price1 =  implode(",",$price1);
			$val_id = implode(",",$val_id);
			$qty = implode(",",$qty);
			
			$total_p =  implode(",",$total_p);
			
			
						$order=$db->query("INSERT INTO `orders`(`ord_id`, `member_id`, `address`, `city`, `state`, `pin`, `p_id`, `qty`, `p_price`, `value_id`, `total_price`, `payment`, `ord_status`, `date_added`) VALUES ('','$cust_id','$add','$city','$state','$pin','$pro_id','$qty','$price1','$val_id','$to',1,0,NOW())");
		            
					
					if(mysqli_affected_rows($db))
						{
							
								$to_u = "$_SESSION[mem_email]";
									
								$subject = 'Sabjee Bazar - Order Successfully Placed'; 
            
								$random_hash = md5(date('r', time())); 
								
								$headers = "From: info@sabjeebazar.com \r\nReply-To: info@sabjeebazar.com";
								
								$headers .= "MIME-Version: 1.0\r\n";
								
								$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
								
								$message = '<html>
											<body>';
								
								$message .= '<table width="600" border="0" cellpadding="2" cellspacing="2">' ;
										 
								$message .= '<tr>
												<td><b>Hi!</b> ,</td>
											</tr>';
								 $message .= '<tr>
									<td><br/>You order has been placed successfully.</td></tr>' ;
								 
								$message .= '<tr>
									<td><br/>
									<b>Order ID:</b> SBJ1900'.mysqli_insert_id($db).' <br/>
									<b>Order Date:</b> '.date("d-m-Y").' <br/>
									<b>Payment Method:</b> Cash On Delivery <br/>
									<b>Payable Amount:</b> Rs. '.$to.' <br/>
									</td></tr>' ;
								
								 $message .= '<tr>
												<td><br/>Your order will be delivered to you soon! <br/>
												</td><br />
												</tr>';
								 $message .= '<tr>
									<td><br/>Thanks, <br/> <b>Sabjee Bazar</b></td></tr>' ;
								
								
								$message .= '</table>';
								
								$message .= "</body></html>";
								
								$mail_sent = @mail( $to_u, $subject, $message, $headers );
								$mail_sent = @mail( 'info@sabjeebazar.com', $subject, $message, $headers );
								
						}
						else
						{
							echo"Error";
						}
			
			$r1=$db->query("delete from cart where member_id='$_SESSION[mem_id]'");
			if(mysqli_affected_rows($db))
			{
				//header("Location: ../order-summary.php"); 
			}
		}
	}
	
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
						<h5>Order Summary</h5>
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
							WHERE orders.member_id ='".$_SESSION['mem_id']."' ORDER BY ord_id DESC limit 1");

							if($order->num_rows>0)
							{
								$orows= $order->fetch_assoc();
							}
						?>
							<div class="col-md-12 col-sm-12 col-xs-12">
								<div class="box-content ord-summary-div">
									<p><b>Order# :</b> CF1900<?php echo "$orows[ord_id]";?></p>
									<p><b>Order Date :</b> <?php echo date("d-M-Y", strtotime($orows['date_added']));?></p>
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
									<p><b>Delivery Charges: </b><i class="fa fa-rupee"></i> <?php echo $charges;?></p>
									<p><b>Payable Amt : </b><i class="fa fa-rupee"></i> <?php echo "$orows[total_price]";?></p>
									<p><b>Payment Methods : </b>
									<?php  if($orows['payment']==0){echo" Cash On Delivery";}else{echo"Online Payment";}?>
									</p>
								</div>
							</div>
							<div class="col-md-12 col-sm-12 col-xs-12 cont-shop-div">
								<button type="button" onclick="window.location='index.php'" class="btn">Continue Shopping</button>
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