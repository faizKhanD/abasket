<?php
    session_start();
	if(isset($_POST['add_address']))
	{
		$full_address=$_POST["full_address"];
		$city=$_POST["city"];
		$id_state=$_POST["id_state"];
		$pin=$_POST["pin"];
		$user_id=$_POST["user_id"];
		
		include("../abasket@Master/lib/connectdb.php");
		if($user_id=='0')
		{
			echo"3";
		}
		else
		{
			$db->query("INSERT INTO `member_address`( `member_id`, `address`, `city`, `state`, `pin`, `date`) VALUES ('$user_id', '$full_address','$city','$id_state','$pin',NOW())"); 
			if(mysqli_affected_rows($db)>0)
			{
				echo "1";
			}
			else
			{
				echo "2";
			}
			$db->close();
		}
	}
	if(isset($_POST['edit_address']))
	{
		$full_address=$_POST["full_address"];
		$city=$_POST["city"];
		$id_state=$_POST["id_state"];
		$pin=$_POST["pin"];
		$add_id=$_POST["add_id"];
		
		include("../abasket@Master/lib/connectdb.php");
		$db->query("UPDATE `member_address` SET `address`='$full_address',`city`='$city',`state`='$id_state',`pin`='$pin',`date`=NOW() WHERE `id`='$add_id'"); 
		if(mysqli_affected_rows($db)>0)
		{
			echo "1";
		}
		else
		{
			echo "2";
		}
		$db->close();
	}
	
	
	
?>