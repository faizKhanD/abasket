<?php
session_start();
include("../abasket@Master/lib/connectdb.php");
	$password=md5($_REQUEST["old_password"]);
	$password1=md5($_REQUEST["new_password"]);
	$password2=md5($_REQUEST["verify_password"]);
	$sql="select * from member where id='".$_SESSION['mem_id']."'";
	$member=$db->query($sql);
	if($member->num_rows>0)
	{
		$member_row = $member->fetch_assoc();
		if($member_row['password']==$password)
		{
			if($password1==$password2)
			{
				$r=$db->query("update member set password='$password1' where id='$_SESSION[mem_id]'");
	
				echo"1";
			}
			else
			{
				echo"2";
			}
		}
		else
		{
			echo"3";
		}
	}
	else
	{
		echo"4";
	}
?>
	