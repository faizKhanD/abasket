<?php
//Include the database configuration file
include('lib/connectdb.php');

if(!empty($_POST["category"])){
    //Fetch all state data
    $query = $db->query("SELECT * FROM sub_category WHERE cat_id = ".$_POST['category']." ORDER BY name ASC");
    
    //Count total number of rows
    $rowCount = $query->num_rows;
    
    //State option list
    if($rowCount > 0)
	{
        echo '<option value="">Select Sub-Category</option>';
        while($row = $query->fetch_assoc()){ 
            echo '<option value="'.$row['id'].'">'.$row['name'].'</option>';
        }
    }
	else
	{
        echo '<option value="">Sub-Category not available</option>';
    }
}elseif(!empty($_POST["sub_category"])){
    //Fetch all city data
    $query = $db->query("SELECT * FROM sub1_category WHERE sub_id = ".$_POST['sub_category']." ORDER BY name ASC");
    
    //Count total number of rows
    $rowCount = $query->num_rows;
    
    //City option list
    if($rowCount > 0){
        echo '<option value="">Select sub1_category</option>';
        while($row = $query->fetch_assoc()){ 
            echo '<option value="'.$row['id'].'">'.$row['name'].'</option>';
        }
    }else{
        echo '<option value="0">sub1_category not available</option>';
    }
}
?>