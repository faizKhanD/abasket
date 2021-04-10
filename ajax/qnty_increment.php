<?php
	session_start();
	include("../abasket@Master/lib/connectdb.php");
	
	if(isset($_REQUEST['cart_id'])){
		$cart_id=$_REQUEST['cart_id'];
		$qty=$_REQUEST['quantity'];
		$data=$db->query("UPDATE `cart` SET `qty`=$qty WHERE cart_id= $cart_id");	
	}


?>