<?php
session_start();
unset($_SESSION['user']);
unset($_SESSION['admin_name']);
echo "<script>window.location.href='index.php';</script>";	
?>