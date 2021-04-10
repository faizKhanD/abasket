<?php
	    session_start();
	    
		$cart_id=$_REQUEST['cart_id'];
		$cokieeId=$_COOKIE['usertoken'];
		if(isset($_SESSION['mem_id']))
		{
			include('../abasket@Master/lib/connectdb.php');
        	$r=$db->query("delete from cart where cart_id='$cart_id' ");
			if(mysqli_affected_rows($db)>0)
			{
				echo "1"; 
			}
			else{
				echo "2";
			}
		}
		elseif(isset($_COOKIE['usertoken']))
		{
			include('../abasket@Master/lib/connectdb.php');
        	$r=$db->query("delete from cart where cart_id='$cart_id' ");
			if(mysqli_affected_rows($db)>0)
			{
				echo "1"; 
			}
			else{
				echo "2";
			}
		}
		
	
?>
