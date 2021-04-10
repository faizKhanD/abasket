<?php
	session_start();
	include("../abasket@Master/lib/connectdb.php");
	
	if(isset($_COOKIE['usertoken'])) 
	{	
		
		$count = "SELECT SUM(qty) as total FROM cart where member_id='".$_COOKIE['usertoken']."'";
		$c = mysqli_query($db,$count);
		$srows = mysqli_fetch_assoc($c);
		echo json_encode($srows);				
	}
	elseif(isset($_SESSION['mem_id']))
	{

		$count = "SELECT SUM(qty) as total FROM cart where member_id='".$_SESSION['mem_id']."'";
		$c = mysqli_query($db,$count);
		$srows = mysqli_fetch_assoc($c);
		echo json_encode($srows);

	}
?>