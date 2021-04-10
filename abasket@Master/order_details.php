<?php  
session_start();
include('lib/connectdb.php');
include('lib/auth.php');

?>

<!DOCTYPE html>

<html lang="en">

<meta http-equiv="content-type" content="text/html;charset=UTF-8" /><!-- /Added by HTTrack -->

<head>

	<meta charset="utf-8">

	<meta http-equiv="X-UA-Compatible" content="IE=edge">

	<meta name="viewport" content="width=device-width, initial-scale=1">

	<title>Abasket - Order Details</title>

    <?php include('include/__js_css.php');?>
	<!-- Theme JS files -->

	<script type="text/javascript" src="assets/js/plugins/tables/datatables/datatables.min.js"></script>

	<script type="text/javascript" src="assets/js/plugins/forms/selects/select2.min.js"></script>
	<script type="text/javascript" src="assets/js/core/app.js"></script>

	<script type="text/javascript" src="assets/js/pages/datatables_basic.js"></script>

	<!-- /theme JS files -->
</head>
<body>
<?php include('include/__header.php');?>
	<!-- Page header -->

	<div class="page-header">

		<div class="page-header-content">

			<div class="page-title">

				<h4><i class="icon-arrow-left52 position-left"></i> <span class="text-semibold">User</span> - Manage Enquiry</h4>
               <ul class="breadcrumb breadcrumb-caret position-right">

					<li><a href="home.php">Home</a></li>

					<li><a href="orders.php">Orders</a></li>
                    	<li><a href="order_details.php">Order Details</a></li>

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

				<!-- Striped rows -->

				
<?php  
include('lib/connectdb.php');
$order=$db->query("SELECT `orders`.*,product.name, option_value.value as opt_val FROM `orders` LEFT JOIN product ON product.id=orders.p_id LEFT JOIN option_value ON option_value.id=orders.value_id WHERE ord_id='".$_REQUEST['order_id']."'");


if($order->num_rows>0)
 {
	$ord_rows= $order->fetch_assoc();
	?>
	<div class="panel panel-flat">
	<table class="table">
  <thead class="thead-dark">
    <tr style="background:#3d4c5a;color:#FFF;">
      <td colspan="2">Order Details</td>
    </tr>
  </thead>
  <tbody>
    <tr>
      <td>Order No</td>
      <td>CF1900<?php echo  $ord_rows['ord_id'] ?></td>
    </tr>
		
    <tr>
      <td>Payment Method</td>
       <td><?php if($ord_rows['payment']=='0'){echo"Cash On Delivery";}else{echo "Online Pay";  } ?></td>
    </tr>
    <tr>
      <td>Order Date</td>
       <td><?php echo  $ord_rows['date_added'] ?></td>
    </tr>
    
        <tr>
      <td>Status</td>
      <td>
      <div class="input-group">
      <input type="hidden" value="<?php echo $_REQUEST['order_id'];?>" id="order_id" name="order_id">
        <select name="status" id="status" class="form-control">
                <option value="0" <?php if($ord_rows['ord_status']=='0'){echo'selected';}else{echo '';} ?> >Process</option>
                <option value="1" <?php if($ord_rows['ord_status']=='1'){echo'selected';}else{echo '';} ?>>Dispatched</option>
                <option value="2" <?php if($ord_rows['ord_status']=='2'){echo'selected';}else{echo '';} ?>>Shipping</option>
                <option value="3" <?php if($ord_rows['ord_status']=='3'){echo'selected';}else{echo '';} ?>>Completed</option>
                <option value="4" <?php if($ord_rows['ord_status']=='4'){echo'selected';}else{echo '';} ?>>Cancelled</option>
 </select>
      <span class="input-group-btn">
        <button class="btn btn-secondary m_status" type="button" >Modify Status</button>
      </span>
    </div>
    </td>
    </tr>
    
  </tbody>
</table>

<table class="table">
  <thead class="thead-dark">
    <tr style="background:#3d4c5a;color:#FFF;">
      <td colspan="4">Order Item</td>
    </tr>
  </thead>
  <tbody>
     
    <tr style="background:#CCC">
      <th><b>Item(s)</b></th>
	  <th><b>Unit Type</b></th>
      <th><b>Unit Price</b></th>
      <th><b>Total</b></th>
    </tr>
	  <?php
	  	$pro_array = explode(",",$ord_rows['p_id']);
		$price_array = explode(",",$ord_rows['p_price']);
		$qty_array = explode(",",$ord_rows['qty']);
		$val_array = explode(",",$ord_rows['opt_val']);
		$c = array_combine($pro_array, $qty_array);
		
	$i=0;
	foreach($c as $key => $value)
	{	
		$pr=$db->query("SELECT * FROM `product` WHERE id='".$key."'");
		if($pr->num_rows>0)
		{
			$pr_row= $pr->fetch_assoc();
			?>
	  		<tr>
			   <td style=" width: 76%;"><?php echo $pr_row['name'].' x '.$value; ?><br/> </td>
			   <td><?php echo $ord_rows['opt_val']; ?></td>
			   <td>Rs.<?php echo $price_array[$i]; ?></td>
			   <td>Rs.<?php echo $price_array[$i]*$value; ?></td>
			 </tr>
	  		<?php
		}
		$i++;
		
	}

	  ?>
	
   
    <tr>
      <td style=" width: 76%;">Sub-Total</td>
      <td></td>
	  <td></td>
      <td>Rs.<?php echo $ord_rows['total_price']; ?></td>
    </tr>
    
     
     <tr>
      <td style=" width: 76%;">Grand Total</td>
      <td></td>
	  <td></td>
      <td>Rs.<?php echo $ord_rows['total_price']; ?></td>
    </tr>
	 
        
    
  </tbody>
</table>



<table class="table">
  <thead class="thead-dark">
    <tr style="background:#3d4c5a;color:#FFF;">
      <td colspan="3">Shipping Information</td>
    </tr>
  </thead>
  <?php
		include('lib/connectdb.php');
		$add_order=$db->query("SELECT `orders`.*, `member`.* FROM `orders` LEFT JOIN `member` ON `orders`.`member_id`=`member`.`id` WHERE ord_id='".$_REQUEST['order_id']."'");

		if($add_order->num_rows>0)
		{
			$or_add= $add_order->fetch_assoc();
	?>
  <tbody>
    <tr>
      <td style=" width: 17%;"><b>Name</b></td>
      <td><?php echo $or_add['name'];?></td>
    </tr>
    <tr>
      <td style=" width: 17%;"><b>Mobile</b></td>
      <td><?php echo $or_add['mobile'];?></td>
    </tr>
	<tr>
      <td style=" width: 17%;"><b>Email ID</b></td>
      <td><?php echo $or_add['email'];?></td>
    </tr>
    <tr>
      <td style=" width: 17%;"><b>Address</b></td>
      <td><?php echo $ord_rows['address'];?></td>
    </tr>
    <tr>
      <td style=" width: 17%;"><b>City</b></td>
      <td><?php echo $ord_rows['city'];?></td>
    </tr>
    <tr>
      <td style=" width: 17%;"><b>State</b></td>
      <td><?php echo $ord_rows['state'];?></td>
    </tr>
   	<tr>
      <td style=" width: 17%;"><b>Pin Code</b></td>
      <td><?php echo $ord_rows['pin'];?></td>
    </tr>
    <tr>
      <td style=" width: 17%;"><b>Time-Slot</b></td>
      <td><?php echo $ord_rows['time_slot'];?></td>
    </tr>
    <tr>
      <td style=" width: 17%;"><b>Note</b></td>
      <td><?php echo $ord_rows['comment'];?></td>
    </tr>
   
    
    </tbody>
 <?php 
  }
	?>
</table>

	</div>
	<?php
}
			//$sel=dbQuery("SELECT * FROM `tabl_order` WHERE order_id='".$_REQUEST['order_id']."'");
           //$res=mysql_fetch_assoc($sel);
 ?>
                

				<!-- /striped rows -->

			</div>

			<!-- /main content -->



		</div>

		<!-- /page content -->



	</div>

	<!-- /page container -->





<?php include('include/__footer.php');?>

<script>
function delete_enquiry(id){
   var retVal = confirm("Are you sure want to delete ?");
	if( retVal == true ){
      $.ajax({
	  url:'ajax/delete_enquiry.php',
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
function set_status(val,id)
{
	$.ajax({ 
	url:'ajax/enquiry_status.php',
	type:'post',
	data:{'val': val,
	      'id':id},
     success:function(data){
		 if(data==1)
		 {
			location.reload(); 
		 }
		 
		 }
	
	 });
	
}
</script>



<script>
function mark_read(id)
{
	
	$.ajax({ 
	url:'ajax/mark_read.php',
	type:'post',
	data:{'id':id},
     success:function(data){
		 if(data==1)
		 {
			location.reload(); 
		 }
		 
		 }
	
	 });
	
}
</script>
<script>
$(".m_status").click(function(){
var status=$("#status").val();
var order_id=$("#order_id").val();
	$.ajax({
		url:'ajax/set_modify_status.php',
		type:'post',
		data:{'status':status,'order_id':order_id},
		success:function(data){
			location.reload();
		
  		 },
	  })
	})
</script>
<style>
.reject
{
background-color:#F57696 !important;	
}

.order
{
background-color:#6FDC63 !important;	
}
</style>


</body>

</html>



