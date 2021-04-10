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
    $file_size1=$_FILES["feature_img"]["size"];
    $file_tmp1=$_FILES["feature_img"]["tmp_name"];
   
	
	if($file_name1==""){
		
		$db->query("UPDATE `product` SET 
		`cat_id`='".$_REQUEST['category']."',
		`name`='".$_REQUEST['name']."',
		`price`='".$_REQUEST['price']."',
		`sale_price`='".$_REQUEST['special_price']."',
		`description`='".mysqli_real_escape_string($db, $_REQUEST['description'])."',
		`date`=NOW() 
		WHERE `id`='".$_REQUEST['id']."'");
		if($db->affected_rows>0)
		{
			//echo"without image";
		}
 
		
		}
		else{
			
			if($_FILES['feature_img']['error']==0)
           {
               move_uploaded_file($file_tmp1,"images/product/".$file_name1);
           }
           else
           {
               echo"upload failed<br>";
           }
			//echo"$file_name1";exit;
			include('lib/connectdb.php');
			$db->query("UPDATE `product` SET 
			`cat_id`='".$_REQUEST['category']."',
			`name`='".$_REQUEST['name']."',
			`price`='".$_REQUEST['price']."',
			`sale_price`='".$_REQUEST['special_price']."',
			`description`='".mysqli_real_escape_string($db, $_REQUEST['description'])."',
			`image`='".$file_name1."',
			`date`=NOW() 
			WHERE `id`='".$_REQUEST['id']."'");
			
		if($db->affected_rows>0)
		{
			//echo"image";exit;
		}			

	}
		

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
                  product_id='".$_REQUEST['id']."',
				  image_name='".$multi_img."'");

	} 
	
	
$db->query("DELETE FROM `option_detail` WHERE `p_id`='".$_REQUEST['id']."'");	


for($i=1;$i<=6;$i++){

	if($_REQUEST['option_'.$i.'']!=0){
		
	$db->query("INSERT INTO `option_detail`(`p_id`, `option_id`, `value_id`, `price`, `sale_price`)
				VALUES ('".$_REQUEST['id']."','".$_REQUEST['option_'.$i.'']."','".$_REQUEST['option_value_'.$i.'']."','".$_REQUEST['option_price_'.$i.'']."','".$_REQUEST['option_sale_price_'.$i.'']."')"); 
		



	}



}	

echo "<script>alert('Product Update Successfully');

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

	<title>Abasket - Edit Product</title>

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

				<h4><i class="icon-arrow-left52 position-left"></i> <span class="text-semibold">Products</span> - Edit Products</h4>
               <ul class="breadcrumb breadcrumb-caret position-right">

					<li><a href="home.php">Home</a></li>

					<li><a href="manage_product.php">Manage Products</a></li>
                    
                    <li>Edit Product</li>

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
					
						$pro=$db->query("select * from product where id='".$_REQUEST['pro_id']."' ");
						if($pro->num_rows>0)
						{
							$rs= $pro->fetch_assoc();
						}
						?>
						<!-- Basic layout-->
						<form action="" method="post" id="add_party" enctype="multipart/form-data">
							<div class="panel panel-flat">
								<div class="panel-body">
							<div class="row">
              					<div class="col-md-12">
									<fieldset>
					                <legend class="text-semibold new_legend"> Edit Product</legend>

										<div class="row">
                                 
                                
                                   
                           <div class="col-md-6">
                              <div class="form-group">
													<label>Name:</label>
													<input type="text" placeholder="Name" class="form-control" name="name" value="<?php echo $rs['name']?>" required>
												</div>
                                                
							<div class="form-group">
								<label>Category</label>
								<select id="category" name="category" class="form-control" required>
									<option value="">Select Category</option>
								<?php
									$cat=$db->query("select * from category ");
									if($cat->num_rows>0)
									{
										while($cat_rows= $cat->fetch_assoc())
										{
											?>
											<option value="<?php echo $cat_rows['id']?>" <?php if($rs['cat_id']==$cat_rows['id']){echo"Selected";} ?>><?php echo $cat_rows['name']?></option>
											<?php
										}
									}
								?>
								</select>
							</div> 
							<div class="form-group">
													<label>maximum Price</label>
													<input type="text" placeholder="Price" required class="form-control" name="price" value="<?php echo $rs['price']?>">
												</div>     
                                                
                             <div class="form-group">
													<label>Minimum Price</label>
													<input type="text" placeholder="Offer Price" required class="form-control" name="special_price" value="<?php echo $rs['sale_price']?>">
												</div>	
							</div>
                              
                              <div class="col-md-6">
                              
                                                
                              <div class="form-group">
											<label>Description:</label>
											<textarea rows="5" cols="5" required class="form-control" id="description" name="description" ><?php echo $rs['description'];?></textarea>
										</div>  

											
											
											
                                                
                              </div>
                            
                                        
                                                   
                                            
                                            
										</div>
                                        
                                        
                                        <div class="row">
                                        
                                        <div class="col-md-1">
                                            <div class="form-group">
                                             <img src="images/product/<?php echo $rs['image']; ?>" style="height:50px; width:50px">
													
												</div>
                                            
                                            </div>
                                            
											<div class="col-md-3">
                                            <div class="form-group">
     									<label>Featured Image:</label>
												<input type="file" name="feature_img"  id="feature_img"/>
												</div>
                                            
                                            </div>
                                        </div>
                                        
                                       <div class="row">
								<div class="col-md-12">
									<fieldset>
					                	<legend class="text-semibold new_legend" >Other Product Images <span style="font-size: 11px;
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
                                        
									</fieldset>
								</div>
                                
                                   <div class="row">
                                     <div class="col-md-12">
                                      
                                       <table class="table datatable-basic table-striped">

						<thead>

							<tr>

								<th>Sno</th>
                                <th>Images</th>
                                <th>Action</th>

							</tr>

						</thead>

						<tbody>

						 <?php 
								include('lib/connectdb.php');
								$image=$db->query("select * from product_images where product_id='".$_REQUEST['pro_id']."' ");
								if($image->num_rows>0)
								{
									$i=1;
									while($res= $image->fetch_assoc())
									{
									?>
                                <tr>
                                 <td><?php echo $i;?></td>
                                 <td><img src="images/product-gallery/<?php echo $res['image_name']?>" style="height:50px; width:50px"></td>
                                 <td><a href="javascript:void(0)" onClick="global_delete('product_images','image_id',<?php echo $res['image_id'] ?>);"><i class="icon-cancel-circle2"></i> Delete</a></td>
                            
                                </tr>
                        <?php $i++; }
								}else{ ?>
							<tr>
                            <td colspan="3">No Image Found...</td>
                            </tr>
						<?php }?>
					  	</tbody>

					</table>
                    
                    
                                      
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
                                       <?php											
	  $option_d=$db->query("SELECT * FROM `option_detail` WHERE `p_id`='".$_REQUEST['pro_id']."' ");
								
									$r=1;
									while($opt_rows= $option_d->fetch_assoc())
									{
										?>
                                        <tr>
                                        <td><select name="option_<?php echo $r;?>" id="option_<?php echo $r;?>" class="form-control" onChange="set_option_value(this.value,<?php echo $r;?>);">
                                                       <option>-- Select--</option>
                                                   <?php 
						 
										 
														$option=$db->query("select * from option ");
														if($option->num_rows>0)
														{
															 
															while($option_rows= $option->fetch_assoc())
																{
																	
																	?>
																	<option <?php if($option_rows['id']==$opt_rows['option_id']){echo"Selected";}?> value="<?php echo $option_rows['id'];?>"><?php echo $option_rows['option'];?></option>
																	<?php
																}
														}		
														?>
                                                       </select></td>
                                                       
											
													   
                                        <td><select name="option_value_<?php echo $r;?>" id="option_value_<?php echo $r; ?>" class="form-control">
                                        <option>-- Select--</option>
                                        
                                         <?php
												
												$option_value=$db->query("select * from option_value WHERE option_id='".$opt_rows['option_id']."'");
												if($option_value->num_rows>0)
												{	
													while($option_values= $option_value->fetch_assoc())
													{
														?>
														<option <?php if($option_values['id']==$opt_rows['value_id']){echo"Selected";}?> value="<?php echo $option_values['id'];?>"><?php echo $option_values['value'];?></option>
														<?php
													}
												}


												?>
                                                      
                                                       </select></td>
													   
											  
                                                       
                                        <td><input type="text" placeholder="Price" class="form-control" name="option_price_<?php echo $r; ?>" id="option_price_<?php echo $r; ?>" value="<?php echo $opt_rows['price'];?>" ></td>
										<td><input type="text" placeholder="Sale Price" class="form-control" name="option_sale_price_<?php echo $r; ?>" id="option_sale_price_<?php echo $r; ?>" value="<?php echo $opt_rows['sale_price'];?>" ></td>
                                        </tr>
                                            <?php $r++;}
								for($j=$r; $j<=6; $j++)
	  {?>
		 <tr>

                                        <td><select name="option_<?php echo $j;?>" id="option_<?php echo $j;?>" class="form-control" onChange="set_option_value(this.value,<?php echo $j;?>);">

                                                       <option>-- Select--</option>

                                                       <?php 
						 
										 
														$options=$db->query("select * from option ");
														if($options->num_rows>0)
														{
															 
															while($options_rows= $options->fetch_assoc())
																{
																	?>
																	<option value="<?php echo $options_rows['id'];?>"><?php echo $options_rows['option'];?></option>
																	<?php
																}
														}		
														?>

                                                       </select></td>

                                                       

                                        <td><select name="option_value_<?php echo $j; ?>" id="option_value_<?php echo $j; ?>" class="form-control">

                                                       <option>-- Select--</option>

                                                      

                                                       </select></td>

                                                       
									
													   
													   
                                        <td><input type="text" placeholder="Price" class="form-control" name="option_price_<?php echo $j; ?>" id="option_price_<?php echo $j; ?>" ></td>
										<td><input type="text" placeholder="Sale Price" class="form-control" name="option_sale_price_<?php echo $j; ?>" id="option_sale_price_<?php echo $j; ?>" ></td>

                                        </tr>
                                            <?php } ?>     
                                        </table>   
                                                   
                                            
                                     
                                            
										</div>
								</fieldset>
       								</div>
							</div>
                                   
                                
                                   
                            <input type="hidden" value="<?php echo $_REQUEST['pro_id'];?>" name="id">
							<div class="text-right">
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

function delete_img(id){
	
   var retVal = confirm("Are you sure want to delete ?");
	if( retVal == true ){
      $.ajax({
	  url:'ajax/delete_product_img.php',
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
<script>s

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