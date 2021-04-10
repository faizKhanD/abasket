<?php  

session_start();

include('lib/connectdb.php');

include('lib/auth.php');

include('lib/get_functions.php');

date_default_timezone_set("Asia/Kolkata");

?>



<!DOCTYPE html>



<html lang="en">



<meta http-equiv="content-type" content="text/html;charset=UTF-8" /><!-- /Added by HTTrack -->



<head>



	<meta charset="utf-8">



	<meta http-equiv="X-UA-Compatible" content="IE=edge">



	<meta name="viewport" content="width=device-width, initial-scale=1">



	<title>Abasket - Manage Category</title>



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



				<h4><i class="icon-arrow-left52 position-left"></i> <span class="text-semibold">Category</span> - Manage Category</h4>

               <ul class="breadcrumb breadcrumb-caret position-right">



					<li><a href="manage_product.php">Home</a></li>



					<li><a href="manage_category.php">Manage Category</a></li>



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

						<button type="button" class="btn bg-teal-400 btn-labeled" onClick="window.location.href='add_category.php'"><b><i class="icon-add"></i></b> Add Category</button>
                        
                        
                        <button type="button" id="" onClick="global_all_delete('category','id');" class="btn btn-warning">Delete</button>

				</div>

                <table class="table datatable-basic table-striped">



						<thead>



							<tr>


                                <th><input type="checkbox" id="selectall" name="selectall"></th> 
								
                                <th>Date</th>

                                <th>Name</th>
								<th>Image</th>
								<th>Edit</th>

                                <th>Delete</th>


							</tr>



						</thead>



						<tbody>



						 <?php 
						 
						 include('lib/connectdb.php');
								$cat=$db->query("select * from category order by id desc");
								if($cat->num_rows>0)
								{
									$i=1; 
									while($cat_rows= $cat->fetch_assoc())
										{?>

                                <tr>

                                <td><input type="checkbox" name="assign_id[]" id="assign_id_<?php echo $cat_rows['id']; ?>" value="<?php echo $cat_rows['id']; ?>" class="checkboxall"></td>
                                
                                <td><?php echo date('d-m-Y',strtotime($cat_rows['date']));?></td>

                                <td><?php echo $cat_rows['name'];?></td>
								<td><img src="images/category/<?php echo $cat_rows['image'];?>" style="height:50px; width:50px"/></td>                         
								                                 
                                
                                <td><a href="edit_category.php?id=<?php echo $cat_rows['id'];?>"><i class="icon-pencil7"></i> Edit</a></td>
                                <td width="15%"><a href="javascript:void(0)" onClick="global_delete('category','id',<?php echo $cat_rows['id'] ?>);"><i class="icon-cancel-circle2"></i> Delete</a></td>
                                
							</tr>

                        <?php 			} 
								}

								
								?>

					  	</tbody>

					</table>

				</div>
				<!-- /striped rows -->
			</div>
			<!-- /main content -->

		</div>
		<!-- /page content -->
	</div>
	<!-- /page container -->

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
function set_featured(val,tablname,colname,id)
{
$.ajax({
	url: 'ajax/set_featured.php',
	data:{'val':val,'tablname':tablname,'colname':colname,'id':id,} ,
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



