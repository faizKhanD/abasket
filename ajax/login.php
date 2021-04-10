<?php 
session_start();
include("../abasket@Master/lib/connectdb.php");
$user=$_REQUEST['user'];
$password=md5($_REQUEST['password']);  
$sel="SELECT * FROM member WHERE email='$user' AND password='$password'";
$query=$db->query($sel);
if($query->num_rows>0)
{
	$result= $query->fetch_assoc();
	if($result['status']==1)
	{
		$_SESSION["mem_email"] = $result['email'];
		$_SESSION["mem_name"] = $result['name'];
		$_SESSION["mem_id"]= $result['id'];
		$newmemid=$_SESSION["mem_id"];
		$updatedId=$_COOKIE['usertoken'];
		$sucess=$db->query("UPDATE `cart` SET `member_id`=$newmemid WHERE member_id= $updatedId");
			setcookie('usertoken', null, time() - 3600, "/");
		
		echo "1";
	}
	else
	{
		echo"3";
	}
 }
 else{
	 	 
 echo "2";	 
	 }


	
?>