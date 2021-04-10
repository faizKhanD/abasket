<?php  
session_start();

include('lib/connectdb.php');

include('lib/get_functions.php');

include('lib/auth.php');
?>

<!DOCTYPE html>

<html lang="en">
<meta http-equiv="content-type" content="text/html;charset=UTF-8" />
<!-- /Added by HTTrack -->

<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Abasket - Manage Customer</title>
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
      <h4><i class="icon-arrow-left52 position-left"></i> <span class="text-semibold">Customer</span> - Manage Customer</h4>
      <ul class="breadcrumb breadcrumb-caret position-right">
        <li><a href="#">Home</a></li>
        <li><a href="manage_customer.php">Manage Customer</a></li>
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
        <div class="panel-heading">
          
          <!--<button type="button" id="delete_all" class="btn btn-warning">Delete</button>-->
        </div>
        <table class="table datatable-basic table-striped">
          <thead>
            <tr>
              
              <th>S.N</th>
              <th>Date</th>
              <th>Name</th>
			  <th>Email</th>
			  <th>Mobile</th>
			  <!-- <th>Status</th> -->
			  <th>Delete</th>
              
            </tr>
          </thead>
          <tbody>
            <?php 
								include('lib/connectdb.php');
								$user=$db->query("select * from member ORDER BY id desc ");
								if($user->num_rows>0)
								{
									$i=1;
										while($user_rows= $user->fetch_assoc())
										{?>
										<tr>
										
										  <td><?php echo $i;?></td>
										  <td><?php echo date('d-m-Y',strtotime($user_rows['date']));?></td>
										  <td><?php echo $user_rows['name'];?></td>
											
										  <td><?php echo $user_rows['email'];?></td>
										  <td><?php echo $user_rows['mobile'];?></td>
										  
										<!-- <td style="width:15%;">
										<select name="is_status" id="is_status" class="form-control" onChange="set_status(this.value,'member','id',<?php echo $user_rows['id'];?>)">
											   <option value="0" <?php if($user_rows['status']==0){echo "selected";}else{echo "";} ?> >De-Activated</option>
											   <option value="1" <?php if($user_rows['status']==1){echo "selected";}else{echo "";} ?>>Activated</option>
										</select>
										</td> -->
										<td>
										<a href="ajax/delete_user.php?id=<?php echo $user_rows['id'] ;?>" class="btn btn-danger">Delete</a>
										</td>
										
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
  </div>
</div>
<?php include('include/__footer.php');?>
<script>
function set_status(val,tablname,colname,id)
{
$.ajax({
	url: 'ajax/set_status.php',
	data:{'val':val,'tablname':tablname,'colname':colname,'id':id,} ,
	success:function(data)
	{
		if(data==1)
		{
			 location.reload();
		}
	}
	});
}


</script>

</body>
</html>
