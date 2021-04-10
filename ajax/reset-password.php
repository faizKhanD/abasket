<?php
    session_start();
    include("../abasket@Master/lib/connectdb.php");
    $to=$_REQUEST["email"];
    if($_REQUEST['otp']==$_SESSION['otp'])
    {
        if($_REQUEST['password']==$_REQUEST['password1'])
        {
            $mdpass=md5($_REQUEST['password']);
            $to=$_REQUEST['email'];
            $reset=$db->query("UPDATE `member` SET `password`='".$mdpass."' WHERE `email`='$to'");					
        	if(mysqli_affected_rows ($db))
        	{
        	    echo "1";    
        	}
        	else
        	{
        	    echo "2";
        	}
        }
        else
        {
            echo "3";
        }
    }else{
        echo "4";
    }
    


?>