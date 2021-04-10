<?php  

session_start();

include('lib/db_connection.php');
include('lib/auth.php');
include('lib/get_functions.php');


date_default_timezone_set("Asia/Kolkata");

?>

<!DOCTYPE html>

<html lang="en">
<meta http-equiv="content-type" content="text/html;charset=UTF-8" />
<!-- /Added by HTTrack -->

<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Abasket - Manage Product Option</title>
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
      <h4><i class="icon-arrow-left52 position-left"></i> <span class="text-semibold">Product Option</span> - Manage Option</h4>
      <ul class="breadcrumb breadcrumb-caret position-right">
        <li><a href="home.php">Home</a></li>
        <li><a href="product_option.php">Manage Product Option</a></li>
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
         <div class="panel-heading">
<button type="button" class="btn bg-teal-400 btn-labeled" onclick="window.location.href='add_option.php'"><b><i class="icon-add"></i></b> Add Option</button>
          <button type="button" id="delete_all" class="btn btn-warning">Delete</button>

				</div>
          
        </div>
        <table class="table datatable-basic table-striped">
          <thead>
            <tr>
              <th><input type="checkbox" id="selectall" name="selectall"></th>
              <th>S.N</th>
              <th>Name</th>
              <th>Add Value</th>
              <th>Edit</th>
              <th>Delete</th>
              
            </tr>
          </thead>
          <tbody>
            <?php $sel_party="SELECT * FROM `tabl_product_option` ORDER BY id DESC";

						 		$qry=mysql_query($sel_party) or die(mysql_error());
							$i=1;
								while($res=mysql_fetch_assoc($qry)){?>
            <tr>
              <td><input type="checkbox" name="assign_id[]" id="assign_id_<?php echo $res['id']; ?>" value="<?php echo $res['id']; ?>" class="checkboxall"></td>
              <td><?php echo $i;?></td>
              <td><?php echo $res['name'];?></td>
              <td><a href="add_option_value.php?id=<?php echo $res['id']; ?>">Add</a></td>
               
                                <td><a href="edit_option.php?id=<?php echo $res['id'];?>"><i class="icon-pencil7"></i> Edit</a></td>
                                <td width="15%"><a href="javascript:void(0)" onClick="delete_option(<?php echo $res['id'];?>)"><i class="icon-cancel-circle2"></i> Delete</a></td> 
              
            </tr>
            <?php $i++;} ?>
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

function delete_option(id){

   var retVal = confirm("Are you sure want to delete ?");

	if( retVal == true ){

      $.ajax({

	  url:'ajax/delete_option.php',

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
$("#selectall").click(function(){
        if(this.checked){
            $('.checkboxall').each(function(){
                this.checked = true;
            })
        }else{
            $('.checkboxall').each(function(){
                this.checked = false;
            })
        }
    });
</script> 
<script>
$('#delete_all').click(function(e){
    var values = [];
   $("input[name='assign_id[]']:checked").each( function () {
		values.push($(this).val());
	});
if(values!=""){
	var retVal = confirm("Are you sure want to Delete?");
	if( retVal == true ){
$.ajax({
	  url:'ajax/delete_all_option.php',
	  type:'post',
	  data:{'val':values},
	  success:function(data){
		 if(data==1){
		 location.reload();
		  }
  		 },
 	 }); 	
	}
	else{
		return false;
		}
}
else{
	alert("Please Select First !!!");
	}
});
</script>
</body>
</html>
