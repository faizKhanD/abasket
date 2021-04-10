<?php
session_start();
include('../abasket@Master/lib/connectdb.php');
$price=$db->query("SELECT * FROM `option_detail` WHERE `id`='".$_REQUEST['id']."'");
if($price->num_rows>0){
	$price_rows= $price->fetch_assoc();
}

$option=$db->query("SELECT * FROM `option_value` WHERE `id`='".$price_rows['value_id']."'");
if($option->num_rows>0){
	$option_rows= $option->fetch_assoc();
}

$msg = '
		<p class="price">₹ '.$price_rows['sale_price'].' <del>₹ '.$price_rows['price'].'</del> </p>
		';
		



echo $msg;


?>
