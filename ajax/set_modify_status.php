<?php
session_start();

include('../abasket@Master/lib/connectdb.php');
date_default_timezone_set("Asia/Kolkata");
$order_id=$_REQUEST['order_id'];

$r=$db->query("UPDATE `orders` SET ord_status='4' WHERE ord_id='".$order_id."'");	
//$update="UPDATE `order` SET order_status='".$status."' WHERE order_id='".$order_id."'";
if(mysqli_affected_rows($db)>0)
{
	echo "1";
}

?>