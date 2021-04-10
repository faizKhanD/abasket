<?php
session_start();
unset($_SESSION['mem_email']);
unset($_SESSION['mem_name']);
unset($_SESSION['mem_id']);
$token = time();
setcookie('usertoken',$token, time() + (86400 * 30), "/");
echo "<script>window.location.href='../index.php';</script>";	
?>