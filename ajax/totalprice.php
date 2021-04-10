<?php
	session_start();
	include("../abasket@Master/lib/connectdb.php");
	
	if(isset($_COOKIE['usertoken'])) 
	{	
		$cart_id=$_REQUEST['cart_id'];
		$r=$db->query("SELECT `cart`.*,product.name,product.image,option_detail.price,option_detail.sale_price as op_sale,option_value.value as opt_val FROM `cart`
				LEFT JOIN product ON product.id=cart.p_id
				LEFT JOIN option_detail ON option_detail.id=cart.option_detail
				LEFT JOIN option_value ON option_value.id=option_detail.value_id WHERE cart.p_id='".$cart_id."'");
				

		

				while($rows= $r->fetch_assoc()){
					
					$qty=$rows['qty'];
					$price=$rows['op_sale'];
					$up_pri=$qty*$price;
				}

				
		
			echo json_encode($rows['qty']);
		
						
	}
	else{
		$cart_id=$_REQUEST['cart_id'];
		$r=$db->query("SELECT `cart`.*,product.name,product.image,option_detail.price,option_detail.sale_price as op_sale,option_value.value as opt_val FROM `cart`
				LEFT JOIN product ON product.id=cart.p_id
				LEFT JOIN option_detail ON option_detail.id=cart.option_detail
				LEFT JOIN option_value ON option_value.id=option_detail.value_id WHERE cart.p_id='".$cart_id."'");
				

		

				while($rows= $r->fetch_assoc()){
					
					$qty=$rows['qty'];
					$price=$rows['op_sale'];
					$up_pri=$qty*$price;
				}

				
		
			echo json_encode($rows['qty']);
	}


	



?>