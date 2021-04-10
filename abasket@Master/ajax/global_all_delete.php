<?php
include('../lib/connectdb.php');

foreach($_REQUEST['val'] as $k=>$data){
		include('../lib/connectdb.php');
		$r=$db->query("DELETE FROM `".$_REQUEST['tablname']."` WHERE ".$_REQUEST['colname']."='".$data."'");	
		//$qry=mysqli_query($db,$r);
		
}
if(mysqli_affected_rows($db))
{
echo "1";
}


?>