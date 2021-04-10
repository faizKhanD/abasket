<?php  

session_start();

include('lib/connectdb.php');


include('lib/auth.php');

date_default_timezone_set("Asia/Kolkata");

$date=date('Y-m-d');


if(isset($_REQUEST['submit'])){

$db->query("INSERT INTO `time_slot` SET slot='".$_REQUEST['slot']."',date_added=NOW()");	
	echo "<script>alert('Time-Slot add Successfully');

	window.location.href='add_timeSlot.php';

	</script>";
}

?>



<!DOCTYPE html>



<html lang="en">



<meta http-equiv="content-type" content="text/html;charset=UTF-8" /><!-- /Added by HTTrack -->



<head>



	<meta charset="utf-8">



	<meta http-equiv="X-UA-Compatible" content="IE=edge">



	<meta name="viewport" content="width=device-width, initial-scale=1">



	<title>Abasket - Time-Slot</title>



<?php include('include/__js_css.php');?>

	<!-- Theme JS files -->

	<script type="text/javascript" src="assets/js/plugins/forms/selects/select2.min.js"></script>

	<script type="text/javascript" src="assets/js/plugins/forms/styling/uniform.min.js"></script>



	<script type="text/javascript" src="assets/js/core/app.js"></script>

	<script type="text/javascript" src="assets/js/pages/form_layouts.js"></script>

	<!-- /theme JS files -->

</head>

<body>

<?php include('include/__header.php');?>

	<!-- Page header -->



	<div class="page-header">



		<div class="page-header-content">



			<div class="page-title">



				<h4><i class="icon-arrow-left52 position-left"></i> <span class="text-semibold">Time-Slot</span> - Add Time-Slot</h4>

               
                <ul class="breadcrumb breadcrumb-caret position-right">



					<li><a href="home.php">Home</a></li>

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



				<!-- Vertical form options -->

				<div class="row">

					<div class="col-md-12">



	
						<form action="" method="post" name="add_option" id="add_party">

							<div class="panel panel-flat">

								<div class="panel-body">

							<div class="row">

								<div class="col-md-12">

									<fieldset>

					                	<legend class="text-semibold"> Add Time-Slot</legend>



										<div class="row">

                                        
                                        <div class="col-md-4">

												<div class="form-group">

													<label>Time-Slot:</label>

					<input type="text" placeholder="Eg.10am to 12am" class="form-control" name="slot" required>

												</div>
 										</div>
                                        
                                         <div class="col-md-4">
                            
                            <button type="submit" name="submit" class="btn btn-primary" style="    margin-top: 7%;">Submit <i class="icon-arrow-right14 position-right"></i>
                            </button>
 										</div>
                                        
                                        
                                        
                                        

										</div>

									</fieldset>
 
</form>


<table class="table datatable-basic table-striped">

						<thead>



							<tr>


                                <th><input type="checkbox" id="selectall" name="selectall"></th> 
								
                                <th>Time-Slot</th>
    
                                <th>Delete</th>


							</tr>



						</thead>



						<tbody>



						 <?php 
						 
						 //include('lib/connectdb.php');
								$option_value=$db->query("select * from time_slot order by id desc");
								if($option_value->num_rows>0)
								{
								while($option_value_rows= $option_value->fetch_assoc())
										{?>

                                <tr>

                                <td><input type="checkbox" name="assign_id[]" id="assign_id_<?php echo $option_value_rows['id']; ?>" value="<?php echo $option_value_rows['id']; ?>" class="checkboxall"></td>
                                

                                <td><?php echo $option_value_rows['slot'];?></td>
							    
                                 <td width="15%"><a href="javascript:void(0)" onClick="global_delete('time_slot','id',<?php echo $option_value_rows['id'] ?>);"><i class="icon-cancel-circle2"></i> Delete</a></td>
                                
                                </tr>

                        <?php } 
						 } else{ ?>
                         
                       <tr>
                       <td colspan="4">No Result Found...</td>
                       </tr>    
<?php }?>
					  	</tbody>

					</table>
								</div>

							</div>
                            
                            
                            

						</div>

							</div>

						


						<!-- /basic layout -->



					</div>

				</div>

				<!-- /vertical form options -->

			</div>

	</div>

</div>

<?php include('include/__footer.php');?>


<script>

function delete_option_value(id){

   var retVal = confirm("Are you sure want to delete ?");

	if( retVal == true ){

      $.ajax({

	  url:'ajax/delete_option_value.php',

	  type:'post',

	  data:{'id':id},

	  success:function(data){

		  //alert(data);

		 if(data==1){

			location.reload();

		  }

		 },

 	 }); 
 }else{
       return false;
   }
}

</script>
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


</body>



</html>



