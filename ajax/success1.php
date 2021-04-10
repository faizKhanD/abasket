<?php
session_start();
include("../abasket@Master/lib/connectdb.php");
		$var1 = $_GET['payment_id'];
		$var2 = $_GET['payment_request_id'];

//echo ;exit;
		//echo $var2;
		echo '<br>';
		//echo $var1;

		$ch = curl_init();

		curl_setopt($ch, CURLOPT_URL, 'https://www.instamojo.com/api/1.1/payment-requests/'.$var2);
		//curl_setopt($ch, CURLOPT_URL, 'https://test.instamojo.com/api/1.1/payment-requests/'.$var2);

		curl_setopt($ch, CURLOPT_HEADER, FALSE);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
		curl_setopt($ch, CURLOPT_FOLLOWLOCATION, TRUE);

		//curl_setopt($ch, CURLOPT_HTTPHEADER,array("X-Api-Key:test_b32bd7f30fca3ab753c4d5944d0","X-Auth-Token:test_076a04f480a9d7b617159668496"));
		curl_setopt($ch, CURLOPT_HTTPHEADER,array("X-Api-Key:a5e8dff6470c411446bb38933786b28f", "X-Auth-Token:9707184463fb8c192d8930e4c4025c4f"));

		$response = curl_exec($ch);
		curl_close($ch); 

		$myArray = array(json_decode($response, true));

		//echo $response;
		//echo '<br>';exit;

		//echo '<br>';
		//print_r($myArray);
		//echo '<br>';

		$payment_id = $myArray[0]["payment_request"]["payments"][0]["payment_id"];
		$amount = $myArray[0]["payment_request"]["payments"][0]["amount"];
		$buyer_name = $myArray[0]["payment_request"]["payments"][0]["buyer_name"];
		$address = $myArray[0]["payment_request"]["payments"][0]["address"];
		$buyer_email = $myArray[0]["payment_request"]["payments"][0]["buyer_email"];
		$status = $myArray[0]["payment_request"]["payments"][0]["status"];
                 //The status that confirms your Payment. Credit = Successful transaction, Failed = Failed transaction. 
		
		if($status == "Credit")
		{
			$add_id=$_SESSION['add_id'];
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
				// $to = $to + 25;

				$pro_id =  implode(",",$pro_id);

				$price1 =  implode(",",$price1);
				$val_id = implode(",",$val_id);
				$qty = implode(",",$qty);

				$total_p =  implode(",",$total_p);


							$order=$db->query("INSERT INTO `orders`(`ord_id`, `member_id`, `address`, `city`, `state`, `pin`, `p_id`, `qty`, `p_price`, `value_id`, `total_price`, `payment`, `ord_status`, `date_added`) VALUES ('','$cust_id','$add','$city','$state','$pin','$pro_id','$qty','$price1','$val_id','$to','1',0,NOW())");


						if(mysqli_affected_rows($db))
							{

									$to_u = "$_SESSION[mem_email]";

									$subject = 'SabjeeBazar - Order Successfully Placed'; 

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
										<b>Payment Method:</b> Online Pay <br/>
										<b>Payable Amount:</b> Rs. '.$to.' <br/>
										</td></tr>' ;

									 $message .= '<tr>
													<td><br/>Your order will be delivered to you soon! <br/>
													</td><br />
													</tr>';
									 $message .= '<tr>
										<td><br/>Thanks, <br/> <b>Sabjeebazar</b></td></tr>' ;


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
					header("Location: ../order-summary.php"); 
				}
			}
			
		}
		else
		{
			//echo "<br>Status: ".$status;
			header("Location: ../orderSuccess.php"); 
		}
?>