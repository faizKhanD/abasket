<?php  

session_start();

include('lib/connectdb.php');
include('lib/auth.php');
include('lib/functions.php');
date_default_timezone_set("Asia/Kolkata");
$date=date('Y-m-d H:i:s');

if(isset($_REQUEST['submit'])){
	
	$file_name1=$_FILES["banner_img"]["name"];
    $file_size1=$_FILES["banner_img"]["size"];
    $file_tmp1=$_FILES["banner_img"]["tmp_name"];
    $file_type1=$_FILES["banner_img"]["type"];
	
	
	if($file_name1==""){
	

			if(mysqli_affected_rows($db))
			{
					
				echo "<script>alert('Banner Updated Successfully');

	window.location.href='banner.php';

	</script>";			
			}else
			{
				echo "<script>alert('Bannessr Update failed');

	window.location.href='banner.php';

	</script>";			
			}
		
		}
		else
		{
			
			if($_FILES["banner_img"]["error"]==0)
            {
                move_uploaded_file($_FILES["banner_img"]["tmp_name"],"../images/main-banner/".$file_name1);
            }
            else
            {
                $img="upload failed<br>";
            }
  
    
		$sub=$db->query("UPDATE `main_banner` SET `mainbn_img`='".$file_name1."' 
					WHERE `id`='".$_REQUEST['id']."'");
						if(mysqli_affected_rows($db))
			{
					
	echo "<script>alert('Banner Upadte Successfully');

	window.location.href='banner.php';

	</script>";			
			}else
			{
				echo "<script>alert('Banner Update failed');

	window.location.href='banner.php';

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



	<title>Abasket - Edit Banner</title>



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

                    

                    <li><a href="edit_banner.php">Edit Banner</a></li>



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
										<?php 
											$bann=$db->query("select * from main_banner where id='".$_REQUEST['id']."'");
											if($bann->num_rows>0)
											{
												$res= $bann->fetch_assoc();
											}
										?>
                                        
                                        <div class="col-md-6">
                                        
                                    
                                                
                                              
                                        
                                               <div class="form-group">

													<label>Banner Image(Change):</label>

												<input type="file" required name="banner_img" tabindex="5">
                                                <input type="hidden" name="id" value="<?php echo $res['id'];?>">	

												</div>
												
         							    	</div>

											<div class="col-md-6">
                                            
                                                
                                         

												<div class="form-group">

											<img src="../images/main-banner/<?php echo $res['mainbn_img'];?>">	


												</div>
         							    	</div>


										</div>

									</fieldset>

                                    

                                    <button type="submit" name="submit" class="btn btn-primary">Update <i class="icon-arrow-right14 position-right"></i></button>

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