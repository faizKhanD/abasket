<?php  

session_start();

include('lib/connectdb.php');

include('lib/get_functions.php');

include('lib/auth.php');

date_default_timezone_set("Asia/Kolkata");

$date=date('Y-m-d');

if(isset($_REQUEST['submit'])){
$image=$_FILES["image"]["name"];
$ext = pathinfo($image, PATHINFO_EXTENSION);
if($ext=='png' || $ext=='PNG')
{
	if($_FILES["image"]["error"]==0)
	{
		move_uploaded_file($_FILES["image"]["tmp_name"],"images/sub1-category/".$image);
	}
	else
	{
		$img="upload failed<br>";
	}
	$sub=$db->query("INSERT INTO `sub1_category` SET name='".$_REQUEST['name']."', date=NOW(), sub_id='".$_REQUEST['sub_category']."', image='$image'");
	if(mysqli_affected_rows($db)>0)
	{
		echo "<script>alert('Sub-Category add Successfully');

	window.location.href='manage_sub1_category.php';

	</script>";			
	}
	else
	{
		echo "<script>alert('Sub-Category not uploaded');
	</script>";			
	}
}
else
{
	echo "<script>alert('image should be in PNG Format');
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



	<title>Abasket - Add Sub1-Category</title>



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



				<h4><i class="icon-arrow-left52 position-left"></i> <span class="text-semibold">Sub1-Category</span> - Add Sub1-Category</h4>

               <ul class="breadcrumb breadcrumb-caret position-right">



					<li><a href="manage_product.php">Home</a></li>

					<li><a href="manage_sub1_category.php">Manage Sub1-Category</a></li>

                    

                    <li><a href="add_sub1_category.php">Add Sub1-Category</a></li>



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

						<form action="" method="post" id="add_party" enctype="multipart/form-data" >

							<div class="panel panel-flat">

								<div class="panel-body">

							<div class="row">

								<div class="col-md-12">

									<fieldset>

					                	<legend class="text-semibold"> Add Sub1-Category</legend>



										<div class="row">

											<div class="col-md-6">

												<div class="form-group">

													<label>Name:</label>

													<input type="text" placeholder="Name" class="form-control" name="name" required>

												</div>
                                                
												<div class="form-group">

													<label>Category:</label>

													<select name="category" id="category" class="form-control" required>
													<option value="">Select Category</option>
													   <?php 
														$cat=$db->query("select * from category");
														if($cat->num_rows>0)
														{
															while($cat_rows= $cat->fetch_assoc())
															{
																?>
																<option value="<?php echo"$cat_rows[id]";?>"><?php echo"$cat_rows[name]";?></option>
																<?php
															}
														}
													   ?>                 
													
													</select>

												</div>
												<div class="form-group">

													<label>Sub-Category:</label>
													<select name="sub_category" id="sub_category" class="form-control" required>
													<option value="">Select Category First</option>
													</select>
												</div> 
												
                                                <div class="form-group">

													<label>Choose Image:</label> <span class="ml-5 pl-5" style="color:red">(Image should be in PNG format)</span>

													<input type="file" name="image" required id="image" accept="image/*">

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
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script type="text/javascript">
$(document).ready(function(){
    $('#category').on('change',function(){
        var category = $(this).val();
        if(category){
            $.ajax({
                type:'POST',
                url:'ajaxData.php',
                data:'category='+category,
                success:function(html){
                    $('#sub_category').html(html);
                }
            }); 
        }else{
            $('#sub_category').html('<option value="">Select category first</option>');
        }
    });
    
});
</script>


</html>



