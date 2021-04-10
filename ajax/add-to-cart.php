<?php
	session_start();
	include("../abasket@Master/lib/connectdb.php");
	if(isset($_COOKIE['usertoken'])) 
	{	
		$id= $_COOKIE['usertoken'];
		$pro_id=$_POST["pro_id"];
		$cat=$_REQUEST['cat'];
		$detail_id=$_POST["detail_id"];
		$r=$db->query("INSERT INTO `cart`(`member_id`, `p_id`,`qty`, `option_detail`, `date_added`) VALUES ('".$id."','".$pro_id."','1','".$detail_id."',NOW())");
		if(mysqli_affected_rows($db))
		{	
			$last_id = mysqli_insert_id($db);
			$plcement='<span class="btn-qty minus-btn btn_increment_dec"
														onclick="updateC('.$last_id.',1,'.$pro_id.')">-</span>
														<span class="qty">
														<input type="text" class="form-control" name="qua_name"
															id="updatecart'.$last_id.'"
															value="1">
														</span>
														<span class="btn-qty plus-btn btn_increment_dec"
														onclick="updateC('.$last_id.',2,'.$pro_id.')">+</span>';
				echo $plcement;		
		}
			else
		{
			echo 2;
		}
	}
	elseif(isset($_SESSION['mem_id'])) 
	{
		$id= $_SESSION['mem_id'];
		$pro_id=$_POST["pro_id"];
		$cat=$_REQUEST['cat'];
		$detail_id=$_POST["detail_id"];
		$r=$db->query("INSERT INTO `cart`(`member_id`, `p_id`,`qty`, `option_detail`, `date_added`) VALUES ('".$id."','".$pro_id."','1','".$detail_id."',NOW())");
		if(mysqli_affected_rows($db))
		{	
			$last_id = mysqli_insert_id($db);
			$plcement='<span class="btn-qty minus-btn btn_increment_dec"
														onclick="updateC('.$last_id.',1,'.$pro_id.')">-</span>
														<span class="qty">
														<input type="text" class="form-control" name="qua_name"
															id="updatecart'.$last_id.'"
															value="1">
														</span>
														<span class="btn-qty plus-btn btn_increment_dec"
														onclick="updateC('.$last_id.',2,'.$pro_id.')">+</span>';
				echo $plcement;	
				
		}
			else
		{
			echo 2;
		}
	}
	else{
	
		$token = time();
		setcookie('usertoken',$token, time() + (86400 * 30), "/");
		
		$id= $_COOKIE['usertoken'];
		$pro_id=$_POST["pro_id"];
		$cat=$_REQUEST['cat'];
		$detail_id=$_POST["detail_id"];
		$r=$db->query("INSERT INTO `cart`(`member_id`, `p_id`,`qty`, `option_detail`, `date_added`) VALUES ('".$id."','".$pro_id."','1','".$detail_id."',NOW())");
		if(mysqli_affected_rows($db))
		{	
			$last_id = mysqli_insert_id($db);
			$plcement='<span class="btn-qty minus-btn btn_increment_dec"
														onclick="updateC('.$last_id.',1,'.$pro_id.')">-</span>
														<span class="qty">
														<input type="text" class="form-control" name="qua_name"
															id="updatecart'.$last_id.'"
															value="1">
														</span>
														<span class="btn-qty plus-btn btn_increment_dec"
														onclick="updateC('.$last_id.',2,'.$pro_id.')">+</span>';
				echo $plcement;		
		}
			else
		{
			echo 2;
		}
	
	}
?>