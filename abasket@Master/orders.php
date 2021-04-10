<?php  
session_start();
include('lib/connectdb.php');
include('lib/auth.php');
date_default_timezone_set("Asia/Kolkata");
?>

<!DOCTYPE html>

<html lang="en">

<meta http-equiv="content-type" content="text/html;charset=UTF-8" /><!-- /Added by HTTrack -->

<head>

	<meta charset="utf-8">

	<meta http-equiv="X-UA-Compatible" content="IE=edge">

	<meta name="viewport" content="width=device-width, initial-scale=1">

	<title>Abasket- Orders</title>

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

				<h4><i class="icon-arrow-left52 position-left"></i> <span class="text-semibold">User</span> - Manage Orders</h4>
               <ul class="breadcrumb breadcrumb-caret position-right">

					<li><a href="home.php">Home</a></li>

					<li><a href="orders.php">Orders</a></li>

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

				<div class="panel panel-flat">
                
                <table class="table datatable-basic table-striped">

						<thead>

							<tr>
								<th>S.NO</th>
                                <th>Order#</th>  
								<th>Buyer</th>
                                
								<th>Total Price</th>
                                <th>Date</th>
                                <th>Status</th>
                                <th>View</th>
     						</tr>

						</thead>

						<tbody>
						<tr>
						 <?php 
								$order=$db->query("SELECT `orders`.*, `member`.`name` FROM `orders` LEFT JOIN `member` ON `orders`.`member_id`=`member`.`id` ORDER BY ord_id DESC");
								if($order->num_rows>0)
								{
									$i=1;
									while($ord= $order->fetch_assoc())
										
									{?>
										<td><?php echo $i;?></td>
										  <td><a href="order_details.php?order_id=<?php echo $ord['ord_id']; ?>">CF1900<?php echo $ord['ord_id'];?></a></td>
										<td><?php echo $ord['name'];?></td>
										<td><?php echo $ord['total_price'];?></td>
										<td><?php echo $ord['date_added'];?></td>
										<td><?php if($ord['ord_status']==0){echo 'Process'; }
										elseif($ord['ord_status']==1){
											echo 'Dispatched';
											}elseif($ord['ord_status']==2){
											echo 'Shipping';
											}elseif($ord['ord_status']==3){
											echo 'Completed';
											}elseif($ord['ord_status']==4){
											echo 'Cancelled';
											}else{
											echo 'Shipped';
											}?></td>
											<td><a href="order_details.php?order_id=<?php echo $ord['ord_id']; ?>"><input type="button" name="submit" class="btn btn-info" value="Order Detail"></a></td>
											
								  </tr>
									<?php $i++;
									}
								}
						 	 ?>
					  	</tbody>

					</table>

				</div>

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

