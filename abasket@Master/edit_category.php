<?php  

session_start();

include('lib/connectdb.php');

include('lib/get_functions.php');

include('lib/auth.php');

date_default_timezone_set("Asia/Kolkata");

$date=date('Y-m-d');


if(isset($_REQUEST['submit'])){
$file_name1=$_FILES["feature_img"]["name"];
if($file_name1=="")
{
$cat=$db->query("UPDATE `category` SET 
name='".$_REQUEST['name']."',
date=NOW()
where id='".$_REQUEST['id']."'");
	if(mysqli_affected_rows($db)>0)
	{
		echo "<script>alert('Category Updated Successfully');

	window.location.href='manage_category.php';

	</script>";			
	}
	else
	{
		echo "<script>alert('Category not uploaded');
	</script>";			
	}
}
else
{
	$ext = pathinfo($file_name1, PATHINFO_EXTENSION);
	if($ext=='png' || $ext=='PNG')
	{
		if($_FILES["feature_img"]["error"]==0)
		{
			move_uploaded_file($_FILES["feature_img"]["tmp_name"],"images/category/".$file_name1);
		}
		else
		{
			$image="upload failed<br>";
		}
		$cat=$db->query("UPDATE `category` SET 
				name='".$_REQUEST['name']."',
				image='$file_name1',
				date=NOW()
				where id='".$_REQUEST['id']."'");
		if(mysqli_affected_rows($db)>0)
		{
			echo "<script>alert('Category Updated Successfully');

		window.location.href='manage_category.php';

		</script>";			
		}
		else
		{
			echo "<script>alert('Category not uploaded');
		</script>";			
		}
	}
	else
	{
		echo "<script>alert('image should be in PNG Format');
		</script>";
	}



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



	<title>Abasket - Edit Category</title>



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



				<h4><i class="icon-arrow-left52 position-left"></i> <span class="text-semibold">Categories</span> - Edit Category</h4>

               <ul class="breadcrumb breadcrumb-caret position-right">



					<li><a href="manage_product.php">Home</a></li>



					<li><a href="manage_category.php">Manage Category</a></li>

                    

                    <li><a href="edit_category.php">Edit Category</a></li>



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
<?php
include('lib/connectdb.php');
$cat=$db->query("select * from category where id='".$_REQUEST['id']."'");
if($cat->num_rows>0)
{
	$cat_rows= $cat->fetch_assoc();
	?>
	<form action="" method="post" id="add_party" enctype="multipart/form-data">

							<div class="panel panel-flat">

								<div class="panel-body">

							<div class="row">

								<div class="col-md-12">

									<fieldset>

					                	<legend class="text-semibold"> Edit Category</legend>



										<div class="row">

											<div class="col-md-6">
													
												<div class="form-group">

													<label>Name:</label>
								
													<input type="text" placeholder="Name" class="form-control" value="<?php echo $cat_rows['name']; ?>" name="name" required>

												</div>
                                                
                                                
                                                
                                                
                                                
                                                
											</div>

										</div>
										<div class="row">
											<div class="col-md-1">
                                            <div class="form-group">
                                             <img src="images/category/<?php echo $cat_rows['image'] ?>" style="height:50px; width:50px">
													
												</div>
                                            
                                            </div>
                                            
											<div class="col-md-5">
                                            <div class="form-group">
											<label>Choose Image:</label> <span class="ml-5 pl-5" style="color:red">(Image should be in PNG format)</span>
												<input type="file" name="feature_img" accept="image/*" id="feature_img"/>
												</div>
                                            
                                            </div>
                                        </div>

									</fieldset>

                                    
				<input type="hidden" value="<?php echo $cat_rows['id'];?>" name="id">
                                    <button type="submit" name="submit" class="btn btn-primary">Submit <i class="icon-arrow-right14 position-right"></i></button>

								</div>

							</div>

						</div>

							</div>

						</form>
	
	<?php
}
?>
						

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



