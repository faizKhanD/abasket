<?php  

session_start();

include('lib/connectdb.php');

include('lib/get_functions.php');

include('lib/auth.php');

date_default_timezone_set("Asia/Kolkata");

$date=date('Y-m-d');

if(isset($_REQUEST['submit'])){
	$file_name1=$_FILES["banner_img"]["name"];
		if($_FILES["banner_img"]["error"]==0)
            {
                
                move_uploaded_file($_FILES["banner_img"]["tmp_name"],"images/main-banner/".$file_name1);
            }
            else
            {
                $img="upload failed<br>";
            }
   
	

$ins=$db->query("INSERT INTO `main_banner` SET mainbn_title='".$_REQUEST['title']."',mainbn_descp='".$_REQUEST['description']."', 	mainbn_link='".mysqli_real_escape_string($db, $_REQUEST['link'])."', mainbn_img='".$file_name1."',mainbn_date='NOW()'");
if(mysqli_affected_rows($db))
{
	echo "<script>alert('Banner added Successfully');

window.location.href='banner.php';

</script>";			

}
else
{
echo "<script>alert('Banner added Failed');

window.location.href='add_banner.php';

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



	<title>Abasket - Add Banner</title>



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



				<h4><i class="icon-arrow-left52 position-left"></i> <span class="text-semibold">Banner</span> - Add banner</h4>

               <ul class="breadcrumb breadcrumb-caret position-right">



					<li><a href="home.php">Home</a></li>



					<li><a href="banner.php">Manage Banner</a></li>

                    

                    <li><a href="add_banner.php">Add Banner</a></li>



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

						<form action="" method="post" enctype="multipart/form-data">

							<div class="panel panel-flat">

								<div class="panel-body">

							<div class="row">

								<div class="col-md-12">

									<fieldset>

					                	<legend class="text-semibold"> Add Banner</legend>



										<div class="row">

											<div class="col-md-6">

												<div class="form-group">

													<label>Title:</label>

												<input type="text" required name="title" class="form-control" tabindex="1">	

												</div>
                                                
                                                                                                
                                                <div class="form-group">

													<label>Description:</label>

												<input type="text" required name="description" class="form-control" tabindex="3">	

												</div>
											
                                                
                                                  
                                                
                                                <div class="form-group">

													<label>Banner Image:</label>

												<input type="file"  name="banner_img" required tabindex="5">	

												</div>
												
												
                                                <div class="form-group">

													<label>Button link:</label>

												<input type="text" required name="link" class="form-control" value="#" tabindex="4">	

												</div>
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



