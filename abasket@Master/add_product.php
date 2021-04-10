<?php  

session_start();

error_reporting(0);

include('lib/connectdb.php');

include('lib/auth.php');

date_default_timezone_set("Asia/Kolkata");

$date=date('y-m-d');

if(isset($_REQUEST['submit'])){
$file_name1=$_FILES["feature_img"]["name"];
if($_FILES['feature_img']['error']==0)
{
   
   move_uploaded_file($_FILES['feature_img']['tmp_name'],"images/product/".$file_name1);
}
else
{
   echo"upload failed<br>";
}
$name=$_REQUEST['name'];
$type=$_REQUEST['category'];

$price=$_REQUEST['price'];
$special_price=$_REQUEST['special_price'];


   
   

$product=$db->query("INSERT INTO `product`(`cat_id`, `name`, `price`, `sale_price`, `description`, `is_featured`, `image`, `date`) VALUES ('$type','$name','$price','$special_price','".mysqli_real_escape_string($db, $_REQUEST['description'])."','0','$file_name1',NOW())");
 
  
  
$lastkey=mysqli_insert_id($db);


$path='images/product-gallery/';

foreach ($_FILES['img']['name'] as $f => $img) {
	$multi_img=$img;	
		if ($_FILES['img']['error'][$f] == 4) {
			continue; // Skip file if any error found
		}	      
		elseif ($_FILES['img']['error'][$f] == 0) 
		{
		   move_uploaded_file($_FILES['img']['tmp_name'][$f],"images/product-gallery/".$multi_img);
		}
		else
		{
		   echo"upload failed<br>";
		}
		$image=$db->query("INSERT INTO `product_images` SET 
						  product_id='".$lastkey."',
						  image_name='".$multi_img."'");

	}

for($i=1;$i<=6;$i++){

	if($_REQUEST['option_'.$i.'']!=0){
		
	$db->query("INSERT INTO `option_detail`( `p_id`, `option_id`, `value_id`, `price`, `sale_price`)
				VALUES ('".$lastkey."','".$_REQUEST['option_'.$i.'']."','".$_REQUEST['option_value_'.$i.'']."','".$_REQUEST['option_price_'.$i.'']."','".$_REQUEST['option_sale_price_'.$i.'']."')"); 
		
	}
}	
	

echo "<script>alert('Product add Successfully');

window.location.href='manage_product.php';

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



	<title>Abasket - Add Product</title>



<?php include('include/__js_css.php');?>



	<!-- Theme JS files -->

 

  <link  type="text/css" src="assets/css/bootstrap-select.min.css"/>

     <script src="https://cdn.ckeditor.com/ckeditor5/1.0.0-beta.2/classic/ckeditor.js"></script>

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



				<h4><i class="icon-arrow-left52 position-left"></i> <span class="text-semibold">Products</span> - Add Products</h4>

               <ul class="breadcrumb breadcrumb-caret position-right">



					<li><a href="manage_product.php">Home</a></li>



					<li><a href="manage_product.php">Manage Products</a></li>

                    

                    <li><a href="add_product.php">Add Product</a></li>



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

						<form action="" method="post" id="add_party" enctype="multipart/form-data" novalidate>

							<div class="panel panel-flat">

								<div class="panel-body">

							<div class="row">

                                        

                                        

                           <div class="col-md-6">

							<div class="form-group">
							<label>Name:</label>
							<input type="text" placeholder="Name" class="form-control" name="name" required>
							</div>
                    

                            <div class="form-group">
							<label>Category</label>
							<?php
								
								$cat=$db->query("select * from category");
								if($cat->num_rows>0)
								{
									?>
									<select id="category" name="category" class="form-control" required>
									<option value="">Select Category</option>
									<?php
									while($cat_rows= $cat->fetch_assoc())
									{
										?>
										<option value="<?php echo $cat_rows['id']?>"><?php echo $cat_rows['name']?></option>
										<?php
									}
									?>
									</select>
									<?php
								}
							?>
							</div> 
								<div class="form-group">

									<label>Maximum Price</label>

									<input type="text" required placeholder="eg-100" class="form-control" name="price" >

								</div> 
								<div class="form-group">

									<label>Minimum Price</label>

									<input type="text" required placeholder="eg-1000" class="form-control" name="special_price" >

								</div>            

                              </div>

                              

                              <div class="col-md-6">

								<div class="form-group">

									<label>Description:</label>

									<textarea rows="5" required cols="5" class="form-control" id="description" name="description" ></textarea>

								</div> 

								    

                                                

								
									
								 
                                                

                              </div>

                            

                                        

                                                   

                                            

                                            

										</div>

                                        

                             <div class="row">

                                        

										<div class="col-md-3">

                                            <div class="form-group">

     									<label>Featured Image:</label>

												<input type="file" name="feature_img" id="feature_img" required/>

												</div>

                                            

                                            </div>

                                        </div>           

                                        

                            

                            <div class="row">

								<div class="col-md-12">

									<fieldset>

					                	<legend class="text-semibold new_legend">Other Product Images <span style="font-size: 11px;

    font-weight: 700;">(Here you can choose more then one image at same time)</span></legend>



										<div class="row">

											<div class="col-md-12">

                                            <div class="form-group">

                                                       <label>Other Images:</label>

                                                        <input type="file" name="img[]" id="img" multiple/>

                                             </div>

                                             </div>

                                            

										</div>

								</fieldset>

       								</div>

							</div>
							
							
							<div class="row">

								<div class="col-md-12">

									<fieldset>

					                	<legend class="text-semibold new_legend">Product Option</legend>



										<div class="row">

											

                                            

                                        <table class="table">

                                        

                                        <tr>

                                        <td>Option</td>

                                        <td>Option Value</td>
										

                                        <td>Price</td>
										<td>Sale Price</td>

                                        </tr>

                                        <?php for($i=1;$i<=6;$i++){?>

                                        <tr>

                                        <td><select name="option_<?php echo $i;?>" id="option_<?php echo $i;?>" class="form-control" onChange="set_option_value(this.value,<?php echo $i;?>);">

                                                       <option>-- Select--</option>

                                                       <?php 
						 
										 
														$option=$db->query("select * from option ");
														if($option->num_rows>0)
														{
															 
															while($option_rows= $option->fetch_assoc())
																{
																	?>
																	<option value="<?php echo $option_rows['id'];?>"><?php echo $option_rows['option'];?></option>
																	<?php
																}
														}		
														?>

											</select></td>

                                                       

                                        <td><select name="option_value_<?php echo $i; ?>" id="option_value_<?php echo $i; ?>" class="form-control">

                                                       <option>-- Select--</option>

                                                      

										   </select></td>

                                                       
										
													   
													   
                                        <td><input type="text" placeholder="Price" class="form-control" name="option_price_<?php echo $i; ?>" id="option_price_<?php echo $i; ?>" ></td>
										<td><input type="text" placeholder="Sale Price" class="form-control" name="option_sale_price_<?php echo $i; ?>" id="option_sale_price_<?php echo $i; ?>" ></td>

                                        </tr>

                                            <?php } ?>   

                                        </table>   

                                                   

                                            

                                     

                                            

										</div>

								</fieldset>

       								</div>

							</div>

                            


                            

                                



							<div class="text-right">

								<button type="submit" name="submit" class="btn btn-primary">Submit <i class="icon-arrow-right14 position-right"></i></button>

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
                    $('#sub1_category').html('<option value="">Select Sub-Category first</option>'); 
                }
            }); 
        }else{
            $('#sub_category').html('<option value="">Select category first</option>');
            $('#sub1_category').html('<option value="">Select Sub-Category first</option>'); 
        }
    });
    
    $('#sub_category').on('change',function(){
        var sub_category = $(this).val();
        if(sub_category){
            $.ajax({
                type:'POST',
                url:'ajaxData.php',
                data:'sub_category='+sub_category,
                success:function(html){
                    $('#sub1_category').html(html);
                }
            }); 
        }else{
            $('#sub1_category').html('<option value="">Select sub_category first</option>'); 
        }
    });
});
</script>
</body>

</html>



<script>



function validate(evt)

{

    if(evt.keyCode!=8)

    {

        var theEvent = evt || window.event;

        var key = theEvent.keyCode || theEvent.which;

        key = String.fromCharCode(key);

        var regex = /[0-9]|\./;

        if (!regex.test(key))

        {

            theEvent.returnValue = false;



            if (theEvent.preventDefault)

                theEvent.preventDefault();

            }

        }

    }

</script>

<script>



function set_option_value(id,increment_id){

	

	  $.ajax({



	  url:'ajax/get_option_value.php',



	  type:'post',



	  data:{'id':id},



	  success:function(data){



		  //alert(data);



		 if(data!=""){

			$("#option_value_"+increment_id).html(data);



		  }



		 },



 	 });

	



	}

</script>





<script>

    ClassicEditor

        .create( document.querySelector( '#description' ) )

        .catch( error => {console.error( error );

        });

</script>

<script>

    ClassicEditor

        .create( document.querySelector( '#short_description' ) )

        .catch( error => {console.error( error );

        });

</script>



<style>

.new_legend{

background-color: #535965;

    color: white;

    padding: 8px !important;

    font-size: 15px;	

	}

</style>