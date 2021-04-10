<?php
include('../lib/connectdb.php');

$id=$_REQUEST['id'];
$user=$db->query("DELETE FROM `member` WHERE id=$id");

if($user==TRUE){
	header("Location: ../manage_customer.php"); 
}
?>