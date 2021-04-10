<?php  

session_start();

include('lib/connectdb.php');


include('lib/auth.php');

date_default_timezone_set("Asia/Kolkata");

$date=date('Y-m-d');


if(isset($_REQUEST['submit'])){
	$db->query("SELECT * FROM `delivery_charge`");
	if(mysqli_affected_rows($db)>0)
	{
		$db->query("UPDATE `delivery_charge` SET `charges`='".$_REQUEST['option_value']."',`date_added`=NOW()");	
		echo "<script>alert('Charges Update Successfully');

	window.location.href='add_delivery.php';

	</script>";
	}	
	else
	{
		$db->query("INSERT INTO `delivery_charge`(`charges`, `date_added`) VALUES ('".$_REQUEST['option_value']."',NOW())");	
		echo "<script>alert('Charges add Successfully');

	window.location.href='add_delivery.php';

	</script>";
	}
}


?>



<!DOCTYPE html>



<html lang="en">



<meta http-equiv="content-type" content="text/html;charset=UTF-8" /><!-- /Added by HTTrack -->



<head>



	<meta charset="utf-8">



	<meta http-equiv="X-UA-Compatible" content="IE=edge">



	<meta name="viewport" content="width=device-width, initial-scale=1">



	<title>Abasket - Delivery Charges</title>



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



				<h4><i class="icon-arrow-left52 position-left"></i> <span class="text-semibold">Delivery Charges</span> - Add Value</h4>

               
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

					                	<legend class="text-semibold"> Add Delivery Charges</legend>



										<div class="row">

						 <?php 
						 
						 //include('lib/connectdb.php');
								$delivery_charge=$db->query("SELECT * FROM `delivery_charge`");
								if($delivery_charge->num_rows>0)
								{
									$rows= $delivery_charge->fetch_assoc();
								}
								?>
											
                                        <div class="col-md-4">

												<div class="form-group">

													<label>Charges:</label>

					<input type="tel" placeholder="" value="<?php if(isset($rows['charges'])){echo $rows['charges'];}?>" class="form-control" name="option_value" required>

												</div>
 										</div>
                                        
                                         <div class="col-md-4">
                            
                            <button type="submit" name="submit" class="btn btn-primary" style="    margin-top: 7%;">Submit <i class="icon-arrow-right14 position-right"></i>
                            </button>
 										</div>
                                        
                                        
                                        
                                        

										</div>

									</fieldset>
 
</form>


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



