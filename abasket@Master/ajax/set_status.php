<?php
include('../lib/connectdb.php');
$r=$db->query("UPDATE `".$_REQUEST['tablname']."` SET status='".$_REQUEST['val']."' WHERE ".$_REQUEST['colName']."='".$_REQUEST['id']."'");	
if(mysqli_affected_rows($db))
{
	echo "1";
}
?>