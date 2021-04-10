<?php
include('../lib/connectdb.php');
//$cat=$_REQUEST['cat'];
$r=$db->query("UPDATE `".$_REQUEST['tablname']."` SET is_featured='".$_REQUEST['val']."' WHERE id='".$_REQUEST['id']."'");	
  //dbQuery("UPDATE `tabl_product` SET is_featured='".$_REQUEST['val']."' WHERE id='".$_REQUEST['id']."'");
mysql_query($r);
  echo "1";

?>