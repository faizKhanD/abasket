
<?php
session_start();
include("../abasket@Master/lib/connectdb.php");

$cart_id=$_REQUEST['cart_id'];
$qty=$_REQUEST['qty'];
if($qty==0){
	$r=$db->query("delete from cart where cart_id='$cart_id' ");
	if(mysqli_affected_rows($db))
	{
		if(isset($_COOKIE['usertoken'])){
			$r=$db->query("SELECT `cart`.*,product.name,product.image,option_detail.price,option_detail.sale_price as op_sale,option_value.value as opt_val FROM `cart`
			LEFT JOIN product ON product.id=cart.p_id
			LEFT JOIN option_detail ON option_detail.id=cart.option_detail
			LEFT JOIN option_value ON option_value.id=option_detail.value_id WHERE cart.member_id='".$_COOKIE['usertoken']."'");
		}
		elseif(isset($_SESSION['mem_id'])){
			$r=$db->query("SELECT `cart`.*,product.name,product.image,option_detail.price,option_detail.sale_price as op_sale,option_value.value as opt_val FROM `cart`
			LEFT JOIN product ON product.id=cart.p_id
			LEFT JOIN option_detail ON option_detail.id=cart.option_detail
			LEFT JOIN option_value ON option_value.id=option_detail.value_id WHERE cart.member_id='".$_SESSION['mem_id']."'");
		}
		// end query
		$total=0;
		while($rows= $r->fetch_assoc()){
				$qty=$rows['qty'];
				$price=$rows['op_sale'];
				$total=$total+($qty*$price);
		}
		$delivery_charge=$db->query("SELECT * FROM `delivery_charge`");
								if($delivery_charge->num_rows>0)
								{
									$del_rows= $delivery_charge->fetch_assoc();
									$charges=$del_rows['charges'];
								}else{
									$charges=0;
								}
		$total=$total+$charges;
			echo json_encode(array(
			"statusCode"=>200,
			"totalcost"=>$total
		));
	}else{
		echo json_encode(array(
			"statusCode"=>201
			
		));
	}
}else{
	$r=$db->query("UPDATE `cart` SET `qty`='$qty' WHERE `cart_id`='$cart_id'");
	if(mysqli_affected_rows($db))
	{
		$cart=$db->query("SELECT `cart`.*,product.name,product.image,option_detail.price,option_detail.sale_price as op_sale,option_value.value as opt_val FROM `cart`
		LEFT JOIN product ON product.id=cart.p_id
		LEFT JOIN option_detail ON option_detail.id=cart.option_detail
		LEFT JOIN option_value ON option_value.id=option_detail.value_id WHERE cart.cart_id='".$_REQUEST['cart_id']."'");
		$cartrows= $cart->fetch_assoc();

		$qty=$cartrows['qty'];
		$price=$cartrows['op_sale'];
		$up_pri=$qty*$price;

		if(isset($_COOKIE['usertoken'])){
			$r=$db->query("SELECT `cart`.*,product.name,product.image,option_detail.price,option_detail.sale_price as op_sale,option_value.value as opt_val FROM `cart`
			LEFT JOIN product ON product.id=cart.p_id
			LEFT JOIN option_detail ON option_detail.id=cart.option_detail
			LEFT JOIN option_value ON option_value.id=option_detail.value_id WHERE cart.member_id='".$_COOKIE['usertoken']."'");
		}
		elseif(isset($_SESSION['mem_id'])){
			$r=$db->query("SELECT `cart`.*,product.name,product.image,option_detail.price,option_detail.sale_price as op_sale,option_value.value as opt_val FROM `cart`
			LEFT JOIN product ON product.id=cart.p_id
			LEFT JOIN option_detail ON option_detail.id=cart.option_detail
			LEFT JOIN option_value ON option_value.id=option_detail.value_id WHERE cart.member_id='".$_SESSION['mem_id']."'");
		}
		// end query
		$total=0;
		while($rows= $r->fetch_assoc()){
				$qty=$rows['qty'];
				$price=$rows['op_sale'];
				$total=$total+($qty*$price);
		}
		$delivery_charge=$db->query("SELECT * FROM `delivery_charge`");
			if($delivery_charge->num_rows>0)
			{
				$del_rows= $delivery_charge->fetch_assoc();
				$charges=$del_rows['charges'];
			}else{
				$charges=0;
			}
		$total=$total+$charges;
			echo json_encode(array(
			"statusCode"=>200,
			"totalcost"=>$total,
			"value"=>$up_pri
		));
	}else{
		echo json_encode(array(
			"statusCode"=>201
			
		));
	}	
}

		
		
		
?>