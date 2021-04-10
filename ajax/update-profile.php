<?php
session_start();
include("../abasket@Master/lib/connectdb.php");
	$name=$_REQUEST["update_name"];
	$mobile=$_REQUEST['update_mobile'];
	
	$r=$db->query("update member set name='$name', mobile='$mobile' where id='$_SESSION[mem_id]'");
	if(mysqli_affected_rows($db)>0) 
	{
		echo"1";
	}
	else
	{
		echo"2";
	}
?>
