<?php
include('../lib/connectdb.php');
$option_value=$db->query("select * from option_value WHERE option_id='".$_REQUEST['id']."'");
if($option_value->num_rows>0)
{	
	while($option_values= $option_value->fetch_assoc())
	{
		echo '<option value="'.$option_values['id'].'">'.$option_values['value'].'</option>';
	}
}


?>