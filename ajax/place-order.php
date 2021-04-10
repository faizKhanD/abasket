<?php
session_start();
include("../abasket@Master/lib/connectdb.php");

if(isset($_POST['submit']))
{
	
	
	$add_id = $_REQUEST['add_id'];
	
	//echo"$add_id";exit;
	$payment=$_POST['pay-method'];


	if($payment==0)
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
			$delivery_charge=$db->query("SELECT * FROM `delivery_charge`");
			if($delivery_charge->num_rows>0)
			{
				$del_rows= $delivery_charge->fetch_assoc();
				$charges=$del_rows['charges'];
			}else{
				$charges=0;
			}
			 $to = $to + $charges;
			
			$pro_id =  implode(",",$pro_id);
			
			$price1 =  implode(",",$price1);
			$val_id = implode(",",$val_id);
			$qty = implode(",",$qty);
			
				$total_p =  implode(",",$total_p);
			
			
						$order=$db->query("INSERT INTO `orders`( `member_id`, `address`, `city`, `state`, `pin`, `time_slot`, `comment`, `p_id`, `qty`, `p_price`, `value_id`, `total_price`, `payment`, `ord_status`, `date_added`) VALUES ('$cust_id','$add','$city','$state','$pin','".$_REQUEST['time_slot']."','".$_REQUEST['comment']."','$pro_id','$qty','$price1','$val_id','$to','$payment',0,NOW())");
		            
						
					if(mysqli_affected_rows($db))
						{
								
							
								$to_u = "$_SESSION[mem_email]";
									
								$subject = 'cityfunnels - Order Successfully Placed'; 
            
								$random_hash = md5(date('r', time())); 
								
								$headers = "From: info@cityfunnels.com \r\nReply-To: info@cityfunnels.com";
								
								$headers .= "MIME-Version: 1.0\r\n";
								
								$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
								
								$message = '<!DOCTYPE html>
<html lang="en">

<head>
    <meta name="viewport" content="width=device-width">
    <link rel="stylesheet" href="css/style.css">
    <link
        href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,400;0,600;0,700;0,800;1,300;1,400;1,600;1,700&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="fontawesome.css">
	<style>
body{
    padding: 0px;
    margin: 0px;
    font-family: "Open Sans", sans-serif;
}
.heading_main{
    /* float: left; */
    width: 50%;
}
.order_id_ar{
    /* float: left; */
    width: 50%;
    text-align: right;
    padding-top: 6px;
}
.top_heading{
    
display: flex;
    
background: #f7bf01;
    
padding: 10px 10px;
    
color: #fff;
}
.product_img img{
    width: 100%;
}
#wrapper{
    width: 60%;
    margin: auto;
}
.product_img{
    width: 33%;
    /* float: left; */
    padding: 19px;
}
.roduct_details_coneten {
   
/* float: left; */
   
padding: 15px 15px;
   
background: #ebebeb;
   
display: flex;
   
/* display: inline-table; */
   
width: 100%;
}
.roduct_details_coneten_main{
    width: 58%;
}
.heading_main h2{
    margin: 0px;
}
.order_id_ar p{
    margin: 0px;
}
.product_detais_area{
    
display: flex;
    
border-top: 2px solid #bcb6b6;
    
padding: 15px 0px;
}
.user_area p span{
    
font-size: 22px;
    
color: #f7bf01;
    
font-weight: 600;
}
.user_area p{
    
font-size: 12px;
    
font-weight: 600;
}
.user_msg{
    display: flex;
}
.user_area{
    width: 80%;

}
.ordder_date {
    width: 20%;
    text-align: right;
}
.ordder_date p{
    
font-size: 12px;
}
.user_profle_sec{
    display: flex;
}
.addres{
    width: 33.333%;
}
.addres h3{

margin: 0;
}
.addres p{
    
font-size: 13px;
    
font-weight: 600;
}
.user_profle_sec{
    
background: #ebebeb;
    
padding: 20px;
}
.item{
    width: 60%;
    display: block;
    clear: both;
    display: inline-table;
}
.qty{width: 20%;display: inline-table;}

.price{
    width: 20%;
    display: inline-table;
}
.roduct_details_coneten h4{
text-transform: uppercase;
font-size: 12px;
margin: 0px;
}
.total_area{
    display: flex;
    list-style: none;
    padding: 14px 0px;
}
.total_area ul{
    list-style: none;
    margin: 0px;
    padding: 0px;
}
.total_headin li{

font-size: 12px;

font-weight: 600;

text-transform: uppercase;

padding: 3px 10px;

text-align: right;
}
.total_value li{

font-size: 12px;

font-weight: 600;

text-transform: uppercase;

padding: 3px 10px;

text-align: left;
}
.main_bg p{

background: #f7bf01;

padding: 10px;
}
.main_bg{
    
padding: 0px!important;
}
.para_area p{

font-size: 12px;

font-weight: 600;

/* padding: 10px 0px; */
}
.para_area{
    
background: #ebebeb;
    
display: block;
    
padding: 10px 20px;
    
margin-top: 10px;
}

@media (max-width: 767px){


    #wrapper{
        width: 95%;
        margin-top: 10px;
    }
    .heading_main h2{
        
font-size: 13px;
    }
    .order_id_ar p{
        
font-size: 10px;
    }
    .order_id_ar{
        padding-top: 0px;
    }
    .roduct_details_coneten{
        width: auto;
    }
.roduct_details_coneten p{
    
font-size: 12px;
}


.user_area p span{
    
font-size: 12px;
}
.user_area {
    width: 70%;
}
.ordder_date{
    width: 30%;
    clear: both;
    display: block;
}

}	
	</style>
</head>
<body class="cnt-home">
    <div id="wrapper">
        <div class="top_heading">
            <div class="heading_main">
                <h2>Details of Your Orders</h2>
            </div>
            <div class="order_id_ar">
                <p><b>Order Id :</b> CF1900'.mysqli_insert_id($db).' </p>
            </div>
        </div>
        <div class="product_dtl">
            <div class="user_msg">
                <div class="user_area">
                    <p>
                        <span> Hii '.$_SESSION["mem_name"].'</span>
                        Thank you for shopping with <a href="https://cityfunnels.com/">cityfunnels.com</a>
                    </p>
                </div>
                <div class="ordder_date">
                    <p>
                        <b>Date:</b> '.date("d-M-Y").'
                    </p>
                </div>
            </div>
            <div class="user_profle_sec">
                <div class="addres">
                    <h3 class="headeing_pro">Delivery Address</h3>
                    <p>'.$add.','.$city.'-'.$pin.','.$state.'</p>
                </div>
                <div class="addres">
                    <h3 class="headeing_pro">Timing</h3>
                    <p>Expected to ship: 24 hours</p>
                </div>
                <div class="addres">
                    <h3 class="headeing_pro">Payment option</h3>
                    <p>Cash on delivery</p>
                </div>
            </div>
            <div class="para_area">
                <p>If you have an account in our website, you can check processing the order on the customer‛s panel.</p>
                <p>If you wish to cancel this order then please submit your request here.</p>
                <p>For any further assistance, you can call/Whatsapp us at <a href="tel:91 98736 47653">91 98736 47653</a> OR drop us an email to <a href="mailto:info@CityFunnels.com">info@CityFunnels.com</a></p>
            </div>
            <h3 class="pro_details">Product Details</h3>';

      	$pro_array = explode(",",$pro_id);
		$price_array = explode(",",$price1);
		$qty_array = explode(",",$qty);
		$c = array_combine($pro_array, $qty_array);
		
	$i=0;
	foreach($c as $key => $value)
	{	
		$pr=$db->query("SELECT * FROM `product` WHERE id='".$key."'");
		if($pr->num_rows>0)
		{
			$pr_row= $pr->fetch_assoc();
			$message .= '<div class="product_detais_area">
               
                <div class="roduct_details_coneten_main">
                    <div class="roduct_details_coneten">
                        <div class="item">
                            <h4>Item</h4>
                            <p>'.$pr_row['name'].'</p>
                        </div>
                        <div class="qty">
                            <h4>QTY</h4>
                            <p>
                                '.$value.'
                            </p>
                        </div>
                        <div class="price">
                            <h4>Price</h4>
                            <p>
                                <i class="fa fa-inr" aria-hidden="true"></i> '.$price_array[$i]*$value.'
                            </p>
                        </div>
                    </div>
                </div>
            </div>';
		}
		$i++;
		
	}        
    
    $message .= '<div class="total_area" style="disply:flex;">
                <div class="total_headin">
                <p>     Subtotal : <i class="fa fa-inr" aria-hidden="true"></i> '.$to-$charges.' </p>
                   
                        
                       
                            <p>Shipping Cost : <i class="fa fa-inr" aria-hidden="true"></i> '.$charges.'</p>
                    
                 
                           <p>Total : <i class="fa fa-inr" aria-hidden="true"></i> '.$to.'</p>
                        
                   
                </div>
               
            </div>
        </div>
    </div>
</body>
</html>';																
								$mail_sent = @mail( $to_u, $subject, $message, $headers );
								$mail_sent = @mail( 'info@cityfunnels.com', $subject, $message, $headers );
								
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

	
	
	
}
?>