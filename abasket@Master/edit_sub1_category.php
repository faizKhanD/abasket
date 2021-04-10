<?php  
session_start();
error_reporting(0);
include('lib/connectdb.php');
include('lib/auth.php');
include('lib/functions.php');
include('lib/get_functions.php');
date_default_timezone_set("Asia/Kolkata");
$date=date('Y-m-d');
if(isset($_REQUEST['submit'])){
$file_name1=$_FILES["feature_img"]["name"];
if($file_name1=="")
{
$cat=$db->query("UPDATE `sub1_category` SET 
		name='".$_REQUEST['name']."',
		sub_id='".$_REQUEST['sub_category']."',
		date='".$date."'
		where id='".$_REQUEST['id']."'");
	if(mysqli_affected_rows($db)>0)
	{
		echo "<script>alert('Sub1-Category Updated Successfully');

	window.location.href='manage_sub1_category.php';

	</script>";			
	}
	else
	{
		echo "<script>alert('Sub_Category not uploaded');
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
			move_uploaded_file($_FILES["feature_img"]["tmp_name"],"images/sub1-category/".$file_name1);
		}
		else
		{
			$image="upload failed<br>";
		}
		$cat=$db->query("UPDATE `sub1_category` SET 
			name='".$_REQUEST['name']."',
			sub_id='".$_REQUEST['sub_category']."',
			image='".$file_name1."',
			date='".$date."'
			where id='".$_REQUEST['id']."'");
		if(mysqli_affected_rows($db)>0)
		{
			echo "<script>alert('Sub1-Category Updated Successfully');

		window.location.href='manage_sub1_category.php';

		</script>";			
		}
		else
		{
			echo "<script>alert('Sub1-Category not uploaded');
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

	<title>Abasket - Edit Sub1-Category</title>

<?php include('include/__js_css.php');?>
	<!-- Theme JS files -->
    <script src="https://cdn.ckeditor.com/ckeditor5/1.0.0-beta.2/classic/ckeditor.js"></script>
    <link  type="text/css" src="assets/css/bootstrap-select.min.css"/>
    <script type="text/javascript" src="assets/js/bootstrap-select.min.js"></script>
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

				<h4><i class="icon-arrow-left52 position-left"></i> <span class="text-semibold">Sub1-Category</span> - Edit Sub1-category</h4>
               <ul class="breadcrumb breadcrumb-caret position-right">

					<li><a href="manage_product.php">Home</a></li>

					<li><a href="manage_sub1_category.php">Manage Sub1-Category</a></li>
                    
                    <li>Edit Sub1-Category</li>

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
                        
						<?php
							$esub=$db->query("select sub1_category.*, sub_category.cat_id from sub1_category left join sub_category on sub1_category.sub_id=sub_category.id where sub1_category.id='".$_REQUEST['sub_id']."' ");
							if($esub->num_rows>0)
							{
								$esub_rows= $esub->fetch_assoc();
								?>
						<!-- Basic layout-->
						<form action="" method="post" id="add_party" enctype="multipart/form-data">
							<div class="panel panel-flat">
								<div class="panel-body">
							<div class="row">
              					<div class="col-md-12">
									<fieldset>
					                <legend class="text-semibold new_legend"> Edit Sub1-Category</legend>

										<div class="row">
                                     
										<div class="col-md-6">
									   
											<div class="form-group">
												<label>Name:</label>
												<input type="text" placeholder="Name" class="form-control" name="name" value="<?php echo $esub_rows['name']?>" required>
											</div>
											<div class="form-group">
												<label class="form-label" for="exampleInputEmail1">Category</label>
												<select class="form-control" id="category" name="category" required>
												  
												  <option value="">Select Category</option>
												  <?php 
										  
													$cat=$db->query("select * from category");
													if($cat->num_rows>0)
													{
														while($cat_rows= $cat->fetch_assoc())
														{
															?>
															<option value="<?php echo"$cat_rows[id]";?>" <?php if($esub_rows['cat_id']==$cat_rows['id']){echo"Selected";} ?>><?php echo"$cat_rows[name]";?></option>
															<?php
														}
													}
												   ?>
												</select>
											</div>
											<div class="form-group">
												<label class="form-label" for="exampleInputEmail1">Category</label>
												<select class="form-control" id="sub_category" name="sub_category" required>
												  
												  <option value="">Select Sub-Category</option>
												  <?php 
										  
													$scat=$db->query("select * from sub_category where cat_id='".$esub_rows['cat_id']."'");
													if($scat->num_rows>0)
													{
														while($scat_rows= $scat->fetch_assoc())
														{
															?>
															<option value="<?php echo"$scat_rows[id]";?>" <?php if($esub_rows['sub_id']==$scat_rows['id']){echo"Selected";} ?>><?php echo"$scat_rows[name]";?></option>
															<?php
														}
													}
												   ?>
												</select>
											</div>		
										</div>
                            
                     					</div>
                                        <div class="row">
                                        <div class="col-md-1">
                                            <div class="form-group">
                                             <img src="images/sub1-category/<?php echo $esub_rows['image'] ?>" style="height:50px; width:50px">
													
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
								</div>
                                
                                       
                                   
                            <input type="hidden" value="<?php echo $_REQUEST['sub_id'];?>" name="id">
							<div class="text-left">
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


</body>

</html>

<style>
.new_legend{
background-color: #535965;
    color: white;
    padding: 8px !important;
    font-size: 15px;	
	}
</style>