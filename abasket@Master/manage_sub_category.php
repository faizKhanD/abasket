<?php  
session_start();

include('lib/connectdb.php');

include('lib/get_functions.php');

include('lib/auth.php');
?>

<!DOCTYPE html>

<html lang="en">
<meta http-equiv="content-type" content="text/html;charset=UTF-8" />
<!-- /Added by HTTrack -->

<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Abasket - Sub-Category</title>
<?php include('include/__js_css.php');?>

<!-- Theme JS files -->

<script type="text/javascript" src="assets/js/plugins/tables/datatables/datatables.min.js"></script>
<script type="text/javascript" src="assets/js/plugins/forms/selects/select2.min.js"></script>
<script type="text/javascript" src="assets/js/core/app.js"></script>
<script type="text/javascript" src="assets/js/pages/datatables_basic.js"></script>

<!-- /theme JS files -->

</head>

<body>
<?php include('include/__header.php');?>

<!-- Page header -->

<div class="page-header">
  <div class="page-header-content">
    <div class="page-title">
      <h4><i class="icon-arrow-left52 position-left"></i> <span class="text-semibold">Category</span> - Sub-Category</h4>
      <ul class="breadcrumb breadcrumb-caret position-right">
        <li><a href="manage_product.php">Home</a></li>
        <li><a href="manage_sub_category.php">Sub-Category</a></li>
      </ul>
    </div>
  </div>
</div>

<!-- /page header --> 

<!-- Page container -->

<div class="page-container"> 
  
  <!-- Page content -->
  
  <div class="page-content"> 
    
    <!-- Main content -->
    
    <div class="content-wrapper"> 
      
      <!-- Striped rows -->
      
      <div class="panel panel-flat">
        <div class="panel-heading">
         <button type="button" class="btn bg-teal-400 btn-labeled" onClick="window.location.href='add_sub_category.php'"><b><i class="icon-add"></i></b> Add Sub-Category</button>
          <button type="button" id="" onClick="global_all_delete('sub_category','id');" class="btn btn-warning">Delete</button>
        </div>
        <table class="table datatable-basic table-striped">

						<thead>

							<tr>

								<th><input type="checkbox" id="selectall" name="selectall"></th> 
                                
                                <th>S.N</th>
                                
                                <th>Date</th>
                                
                                <th>Name</th>
                                
                                <th>Image</th>

								<th>Category</th>
                                
                                <th>Edit</th>
                                
                                <th>Delete</th>
        
							</tr>

						</thead>

						<tbody>
                                <?php
								include('lib/connectdb.php');
								$sub=$db->query("select sub_category.*, category.name as cat_name from sub_category left join category on sub_category.cat_id=category.id order by id desc");
								if($sub->num_rows>0)
								{
									$i=1; 
									while($sub_rows= $sub->fetch_assoc())
									{
										?>
									<tr>
									 <td><input type="checkbox" name="assign_id[]" id="assign_id_<?php echo $sub_rows['id']; ?>" value="<?php echo $sub_rows['id']; ?>" class="checkboxall"></td>
									<td><?php echo $i; ?></td> 
									<td><?php echo date('j M, Y',strtotime($sub_rows['date']));?></td>
									<td><?php echo $sub_rows['name'];?></td>
									<td><img src="images/sub-category/<?php echo $sub_rows['image'];?>" style="height:50px; width:50px"/></td>                           
									
									<td><?php echo $sub_rows['cat_name'];?></td>
									
									
									
									<td><a href="edit_sub_category.php?sub_id=<?php echo $sub_rows['id'];?>"><i class="icon-pencil7"></i> Edit</a></td>
									<td width="15%"><a href="javascript:void(0)" onClick="global_delete('sub_category','id',<?php echo $sub_rows['id'] ?>);"><i class="icon-cancel-circle2"></i> Delete</a></td>
									
									</tr>
										<?php $i++; 
									}
								}
								
								 ?>
					  	</tbody>

					</table>
      </div>
      
      <!-- /striped rows --> 
      
    </div>
  </div>
</div>
<?php include('include/__footer.php');?>

<script>
function global_delete(tablname,colname,id){
	var retVal = confirm("Are you sure want to delete ?");
	if( retVal == true ){
	$.ajax({
	url:'ajax/global_delete.php',
	type:'post',
	data:{'tablname':tablname,'colname':colname,'id':id},
	success:function(data){
	  //alert(data);
		//if(data==1){
		location.reload();
		// }
		},
	}); 
}else{
       return false;
   }
}
</script>

<script>
$("#selectall").click(function(){
        if(this.checked){
            $('.checkboxall').each(function(){
                this.checked = true;
            })
        }else{
            $('.checkboxall').each(function(){
                this.checked = false;
            })
        }
    });
</script>

<script>
function global_all_delete(tablname,colname){
    var values = [];
   $("input[name='assign_id[]']:checked").each( function () {
		values.push($(this).val());
	});
if(values!=""){
	var retVal = confirm("Are you sure want to Delete?");
	if( retVal == true ){
$.ajax({
	  url:'ajax/global_all_delete.php',
	  type:'post',
	  data:{'tablname':tablname,'colname':colname,'val':values},
	  success:function(data){
		 //if(data==1){
		 location.reload();
		  //}
  		 },
 	 }); 	
	}
	else{
		return false;
		}
}
else{
	alert("Please Select First !!!");
	}
};
</script>



<script>

function delete_sub(id){

   var retVal = confirm("Are you sure want to delete ?");

	if( retVal == true ){

      $.ajax({

	  url:'ajax/delete_sub.php',

	  type:'post',

	  data:{'id':id},

	  success:function(data){

		  //alert(data);

		 //if(data==1){

			 location.reload();

		 // }

		 },

 	 }); 



   }else{



        return false;



   }

   

	}

</script>
<script>
function set_featured(val,tablname,id)
{
$.ajax({
	url: 'ajax/set_featured.php',
	data:{'val':val,'tablname':tablname,'id':id,} ,
	success:function(data)
	{
		if(data==1)
		{
			 location.reload();
		}
	}
	});
}


</script>

</body>
</html>
