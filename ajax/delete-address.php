<?php
session_start();
include("../abasket@Master/lib/connectdb.php");
	$add_id=$_REQUEST["add_id"];
	$r=$db->query("DELETE FROM `member_address` WHERE `id`='$add_id'");
	if(mysqli_affected_rows($db)>0) 
	{
		echo"1";
	}
	else
	{
		echo"2";
	}
?>
