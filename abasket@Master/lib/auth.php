<?php
@session_start();
if(@$_SESSION['admin_name']==""){
echo "<script>window.location.href='index.php';</script>";	
}
?>