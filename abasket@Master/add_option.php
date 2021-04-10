<?php  

session_start();

include('lib/connectdb.php');

include('lib/get_functions.php');

include('lib/auth.php');

date_default_timezone_set("Asia/Kolkata");

$date=date('Y-m-d');

if(isset($_REQUEST['submit'])){
	/*$image=$_FILES["image"]["name"];
         if($_FILES["image"]["error"]==0)
            {
                move_uploaded_file($_FILES["image"]["tmp_name"],"../assets/img/category/".$image);
            }
            else
            {
                $img="upload failed<br>";
            }
	
	*/
//include('lib/connectdb.php');
$fal=$db->query("select * from option where option like '%".$_REQUEST['name']."%'");
if($fal->num_rows>0)
{
		echo "<script>alert('Duplicate Option');

window.location.href='manage_option.php';

</script>";			
}
else
{
		$cat=$db->query("INSERT INTO `option` SET option='".$_REQUEST['name']."'");
	if(mysqli_affected_rows ($db))
	{
	echo "<script>alert('Option Added Successfully');

	window.location.href='manage_option.php';

	</script>";	
	}

}
				

	

		

//$ins=dbQuery("INSERT INTO `category` SET category_name='".$_REQUEST['name']."',date_added='".$date."'");



}

?>



<!DOCTYPE html>



<html lang="en">



<meta http-equiv="content-type" content="text/html;charset=UTF-8" /><!-- /Added by HTTrack -->



<head>



	<meta charset="utf-8">



	<meta http-equiv="X-UA-Compatible" content="IE=edge">



	<meta name="viewport" content="width=device-width, initial-scale=1">



	<title>Abasket - Add Option</title>



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



				<h4><i class="icon-arrow-left52 position-left"></i> <span class="text-semibold">Option</span> - Add Option</h4>

               <ul class="breadcrumb breadcrumb-caret position-right">



					<li><a href="home.php">Home</a></li>



					<li><a href="manage_option.php">Manage Option</a></li>

                    

                    <li><a href="add_option.php">Add Option</a></li>



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



						<!-- Basic layout-->

						<form action="" method="post" id="add_party" enctype="multipart/form-data">

							<div class="panel panel-flat">

								<div class="panel-body">

							<div class="row">

								<div class="col-md-12">

									<fieldset>

					                	<legend class="text-semibold"> Add Option</legend>



										<div class="row">

											<div class="col-md-6">

												<div class="form-group">

													<label>Option:</label>

													<input type="text" placeholder="Name" class="form-control" name="name" required>

												</div>
												
												<!--<div class="form-group">

													<label>Choose Image:</label>

													<input type="file" name="image" id="image" accept="image/*">

												</div>-->
                                                
                                      
                                                

											</div>



											

										</div>

									</fieldset>

                                    

                                    <button type="submit" name="submit" class="btn btn-primary">Submit <i class="icon-arrow-right14 position-right"></i></button>

								</div>

							</div>

						</div>

							</div>

						</form>

						<!-- /basic layout -->



					</div>

				</div>

				<!-- /vertical form options -->

			</div>

	</div>

</div>

<?php include('include/__footer.php');?>





</body>



</html>



