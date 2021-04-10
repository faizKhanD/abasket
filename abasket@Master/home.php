<?php  

session_start();

include('lib/connectdb.php');

include('lib/auth.php');

include('lib/get_functions.php');

date_default_timezone_set("Asia/Kolkata");

?>

<!DOCTYPE html>



<html lang="en">

<head>

	<meta charset="utf-8">

	<meta http-equiv="X-UA-Compatible" content="IE=edge">

	<meta name="viewport" content="width=device-width, initial-scale=1">

	<title>Abasket - Dashboard</title>



	<?php include('include/__js_css.php');?>

    

	<!-- Theme JS files -->

	<script type="text/javascript" src="assets/js/pages/dashboard.js"></script>

	<!-- /theme JS files -->





</head>



<body>

<?php include('include/__header.php');?>

	<!-- Page header -->

	<div class="page-header">

		<div class="page-header-content">

			<div class="page-title">

				<h4>

					<i class="icon-arrow-left52 position-left"></i>

					<span class="text-semibold">Home</span> - Dashboard

				</h4>

			</div>



			<!--<div class="heading-elements">

				<div class="heading-btn-group">

					<a href="#" class="btn btn-link btn-float has-text"><i class="icon-bars-alt text-primary"></i><span>Statistics</span></a>

					<a href="#" class="btn btn-link btn-float has-text"><i class="icon-calculator text-primary"></i> <span>Invoices</span></a>

					<a href="#" class="btn btn-link btn-float has-text"><i class="icon-calendar5 text-primary"></i> <span>Schedule</span></a>

				</div>

			</div>-->

		</div>

	</div>

	<!-- /page header -->





	<!-- Page container -->

	<div class="page-container">



		<!-- Page content -->

		<div class="page-content">



			<!-- Main content -->

			<div class="content-wrapper">

				<!-- Dashboard content -->

				<?php /*?><div class="row">

					<div class="col-lg-12">

						

                        

						<!-- Quick stats boxes -->

						<div class="row">

							<div class="col-lg-6">



								<!-- Members online -->

								<div class="panel bg-teal-400">

									<div class="panel-body">

 									<h3 class="no-margin"><?php echo total_sale(1000);?></h3>

										Total Sale

										<div class="text-muted text-size-small">Overall Sale from all market place</div>

									</div>



									<div class="container-fluid">

										<div id="members-online"></div>

									</div>

								</div>

								<!-- /members online -->



							</div>



							<div class="col-lg-6">



								<!-- Current server load -->

								<div class="panel bg-pink-400">

									<div class="panel-body">

									<h3 class="no-margin"><?php echo total_purchase_overall();?></h3>

										Total Purchase

										<div class="text-muted text-size-small">Overall Purchase from all market place</div>

									</div>



									<div id="server-load"></div>

								</div>

								<!-- /current server load -->



							</div>

						</div>

						<!-- /quick stats boxes -->

                        

						<!-- Marketing campaigns -->

						<div class="panel panel-flat">

							<div class="table-responsive">

								<table class="table text-nowrap">

									<thead>

										<tr>

											<th>Market Place</th>

											<th class="col-md-2">Total Sale</th>

											<th class="col-md-2">Total Order</th>

											<th class="col-md-2">Total Return</th>

											<th class="col-md-2">Total Defected</th>

											

										</tr>

									</thead>

									<tbody>

										<tr class="active border-double">

											<td colspan="4">Today</td>

											<td class="text-right">

												<span class="progress-meter" id="today-progress" data-progress="30"></span>

											</td>

										</tr>

								<?php for($i=1;$i<=7;$i++){?>	

                                        

                                        <tr>

											<td>

												<div class="media-left media-middle">

											<?php 

											if($i==1){

												echo '<img src="images/amazon.png" class="img-circle img-xs" alt="" style="width:96px !important;height:auto !important">';

											   }else if($i==2){

												echo '<img src="images/flipkart.png" class="img-circle img-xs" alt="" style="width:96px !important;height:auto !important">';

											   }else if($i==3){

												echo '<img src="images/snapdeal.png" class="img-circle img-xs" alt="" style="width:96px !important;height:auto !important">';

											   }else if($i==4){

												echo '<img src="images/shopclues.png" class="img-circle img-xs" alt="" style="width:96px !important;height:auto !important">';

											   }else if($i==5){

												echo '<img src="images/ebay.in.png" class="img-circle img-xs" alt="" style="width:96px !important;height:auto !important">';

											   }else if($i==6){

												echo '<img src="images/paytm.png" class="img-circle img-xs" alt="" style="width:96px !important;height:auto !important">';

											   }else{

												echo '<img src="images/offline_icon.png" class="img-circle img-xs" alt="" style="width:96px !important;height:auto !important">';

											   }

												?>		

 

												</div>

											</td>

											<td><span class="text-muted"><?php echo today_sale($i);?></span></td>

											<td><span class="text-success-600"><?php echo today_order($i);?></span></td>

											<td><h6 class="text-semibold"><?php echo today_return($i);?></h6></td>

											<td><?php echo today_defect($i);?></td>

										</tr>

                                        

                                        <?php } ?>

									

                                    </tbody>

								</table>

							</div>

						</div>

						<!-- /marketing campaigns -->

					</div>

				</div><?php */?>

				<!-- /dashboard content -->



			</div>

			<!-- /main content -->



		</div>

		<!-- /page content -->



	</div>

	<!-- /page container -->

<!-- Footer -->

	<?php include('include/__footer.php');?>

	<!-- /footer -->



</body>

</html>

