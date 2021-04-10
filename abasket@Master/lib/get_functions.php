<?php



function get_party_name($id){



$sql=mysql_query("SELECT name FROM `tabl_party` WHERE id='".$id."'");



			$res=mysql_fetch_assoc($sql);



				return $res['name'];







}





#############################################################################



function get_total_stock($id){



	



	$stock=mysql_query("SELECT `in_stock`-`out_stock` as total_stock FROM `tabl_stock_master` WHERE product_id='".$id."'");



		$total_stock=mysql_fetch_assoc($stock);



			return $total_stock['total_stock'];	



}







#############################################################################





function total_received($id){

	



	$sql=mysql_query("SELECT SUM(`total`) as total FROM `tabl_sale` WHERE shop_id='".$id."' AND received='1'");



		$res=mysql_fetch_assoc($sql);



			if($res['total']==""){



			   return 0;



			   }else{



			return number_format($res['total'],2);



			   }



	}







############################################################################







function total_not_received($id){



	



	$sql=mysql_query("SELECT SUM(`total`) as total FROM `tabl_sale` WHERE shop_id='".$id."' AND received='0'");



		$res=mysql_fetch_assoc($sql);



		   if($res['total']==""){



			   return 0;



			   }else{



			return  number_format($res['total'],2);



			   }



	}







############################################################################







function total_return($id){



	



	$sql=mysql_query("SELECT count(*) as total_return FROM `tabl_sale` WHERE shop_id='".$id."' AND `return`='1'");



		$res=mysql_fetch_assoc($sql);



			return $res['total_return'];



	}







###########################################################################				











function total_received_by_date($id,$from_date,$to_date){



	



	$from_date=date('Y-m-d',strtotime($from_date));



	$to_date=date('Y-m-d',strtotime($to_date));



	



	



	$sql=mysql_query("SELECT SUM(`total`) as total FROM `tabl_sale` WHERE shop_id='".$id."' AND date_added >= '".$from_date."' AND date_added <= '".$to_date."' AND received='1'");



		$res=mysql_fetch_assoc($sql);



		   



		   if($res['total']==""){



			   return 0;



			   }else{



			return  number_format($res['total'],2);



			   }



	}







############################################################################







function total_not_received_by_date($id,$from_date,$to_date){



	



	



	$from_date=date('Y-m-d',strtotime($from_date));



	$to_date=date('Y-m-d',strtotime($to_date));



	



	



	$res=mysql_query("SELECT SUM(`total`) as total FROM `tabl_sale` WHERE shop_id='".$id."' AND date_added >= '".$from_date."' AND date_added <= '".$to_date."' AND received='0'");



		$res=mysql_fetch_assoc($res);



		   if($res['total']==""){



			   return 0;



			   }else{



			return  number_format($res['total'],2);



			   }



	}







############################################################################











function total_return_by_date($id,$from_date,$to_date){



	



	$from_date=date('Y-m-d',strtotime($from_date));



	$to_date=date('Y-m-d',strtotime($to_date));



	



	



	$sql=mysql_query("SELECT count(*) as total_return FROM `tabl_sale` WHERE shop_id='".$id."' AND date_added >= '".$from_date."' AND date_added <= '".$to_date."' AND `return`='1'");



		$res=mysql_fetch_assoc($sql);



			return $res['total_return'];



	}



##########################################################################







function total_amount_party($id){



	$sql=mysql_query("SELECT SUM(`total`) as total FROM `tabl_purchase_master` WHERE party_id='".$id."'");



		$res=mysql_fetch_assoc($sql);



			return $res['total'];



	



	}



	



##########################################################################	







function total_paid_party($id){



	$sql=mysql_query("SELECT SUM(`paid`) as total FROM `tabl_purchase_master` WHERE party_id='".$id."'");



		$res=mysql_fetch_assoc($sql);



			return $res['total'];



	



	}



##########################################################################	











function total_balance_party($id){



	$sql=mysql_query("SELECT (SUM(`total`) - SUM(`paid`)) as total FROM `tabl_purchase_master` WHERE party_id='".$id."'");



		$res=mysql_fetch_assoc($sql);



			return $res['total'];



	



	}



##########################################################################	







function total_purchase($id){



	if($id!=1000){	



	 $sel="SELECT product_id FROM tabl_sale WHERE shop_id ='".$id."'";  



	}else{



		 $sel="SELECT product_id FROM tabl_sale";



		}



						 $qry=mysql_query($sel) or die(mysql_error());



						



						 $total=0;	



						 while($res=mysql_fetch_assoc($qry)){	



												



 					$sel_pro="SELECT sum(`total`) as total, sum(`qty`) as qty FROM `tabl_purchase` WHERE product_id='".$res['product_id']."'";



						 $qry_pro=mysql_query($sel_pro);								  



						 $res_pro=mysql_fetch_assoc($qry_pro);



						@$total +=$res_pro['total']/$res_pro['qty'];



				}



   return number_format($total);



}







##########################################################################



function total_purchase_date_wise($id,$from_date,$to_date){



	if($id!=1000){	



	 $sel="SELECT product_id FROM tabl_sale WHERE date_added >= '".$from_date."' AND date_added <= '".$to_date."' AND shop_id ='".$id."'";  



	}else{



		 $sel="SELECT product_id FROM tabl_sale WHERE date_added >= '".$from_date."' AND date_added <= '".$to_date."'";



		}



						 $qry=mysql_query($sel) or die(mysql_error());



						



						 $total=0;	



						 while($res=mysql_fetch_assoc($qry)){	



												



 					$sel_pro="SELECT sum(`total`) as total, sum(`qty`) as qty FROM `tabl_purchase` WHERE product_id='".$res['product_id']."'";



						 $qry_pro=mysql_query($sel_pro);								  



						 $res_pro=mysql_fetch_assoc($qry_pro);



						@$total +=$res_pro['total']/$res_pro['qty'];



				}



   return number_format($total);



}







##########################################################################



function total_purchase_overall(){



												



 					$sel="SELECT sum(`total`) as total FROM `tabl_purchase`";



						 $qry=mysql_query($sel);								  



						 $res=mysql_fetch_assoc($qry);



				return number_format($res['total'],2);



				}



##########################################################################	















function total_sale($id){



	   if($id!=1000){



	    $sel="SELECT sum(`total`) as total FROM tabl_sale WHERE shop_id ='".$id."'";  



	       }else{



			   $sel="SELECT sum(`total`) as total FROM tabl_sale"; 



			   }



		$qry=mysql_query($sel) or die(mysql_error());



		$res=mysql_fetch_assoc($qry);



		return number_format($res['total']);



}



##########################################################################











function total_sale_date_wise($id,$from_date,$to_date){



	   if($id!=1000){



	    $sel="SELECT sum(`total`) as total FROM tabl_sale WHERE date_added >= '".$from_date."' AND date_added <= '".$to_date."' AND shop_id ='".$id."'";  



	       }else{



			   $sel="SELECT sum(`total`) as total FROM tabl_sale WHERE date_added >= '".$from_date."' AND date_added <= '".$to_date."'"; 



			   }



		$qry=mysql_query($sel) or die(mysql_error());



		$res=mysql_fetch_assoc($qry);



		return number_format($res['total']);



}



##########################################################################



function total_profit($id){



	if($id!=1000){



	    $sel="SELECT * FROM tabl_sale WHERE shop_id ='".$id."'"; 	



	}else{



		$sel="SELECT * FROM tabl_sale";



		}



						 $qry=mysql_query($sel) or die(mysql_error());



						



						 $total_purchase=0;



						 $total_sale=0;



						 



						 while($res=mysql_fetch_assoc($qry)){	



												



 					$sel_pro="SELECT sum(`total`) as total, sum(`qty`) as qty FROM `tabl_purchase` WHERE product_id='".$res['product_id']."'";



						 $qry_pro=mysql_query($sel_pro);								  



						 $res_pro=mysql_fetch_assoc($qry_pro);



						 @$total_purchase +=$res_pro['total']/$res_pro['qty'];



						 $total_sale +=$res['total'];



						



						 







   }



   return  number_format($total_sale - $total_purchase); 



 }



##########################################################################



function total_profit_date_wise($id,$from_date,$to_date){



	if($id!=1000){



	    $sel="SELECT * FROM tabl_sale WHERE date_added >= '".$from_date."' AND date_added <= '".$to_date."' AND shop_id ='".$id."'"; 	



	}else{



		$sel="SELECT * FROM tabl_sale WHERE date_added >= '".$from_date."' AND date_added <= '".$to_date."'";



		}



						 $qry=mysql_query($sel) or die(mysql_error());



						



						 $total_purchase=0;



						 $total_sale=0;



						 



						 while($res=mysql_fetch_assoc($qry)){	



												



 					$sel_pro="SELECT sum(`total`) as total, sum(`qty`) as qty FROM `tabl_purchase` WHERE product_id='".$res['product_id']."'";



						 $qry_pro=mysql_query($sel_pro);								  



						 $res_pro=mysql_fetch_assoc($qry_pro);



						 @$total_purchase +=$res_pro['total']/$res_pro['qty'];



						 $total_sale +=$res['total'];



						



						 







   }



   return  number_format($total_sale - $total_purchase); 



 }



##########################################################################















function today_sale($i){



	



	$sel="SELECT sum(`total`) as total FROM tabl_sale WHERE shop_id='".$i."' AND date_added=CURDATE()";



	$qry=mysql_query($sel) or die(mysql_error());



	$res=mysql_fetch_assoc($qry);



	if($res['total']==""){



		return "0.00";



	}else{



	return number_format($res['total'],2);



	}



}



##########################################################################







function total_order(){



	



	$sel="SELECT sum(`qty`) as qty FROM tabl_sale";



	$qry=mysql_query($sel) or die(mysql_error());



	$res=mysql_fetch_assoc($qry);



	if($res['qty']==""){



		return "0";



	}else{



	return $res['qty'];



	}



}







##########################################################################







function today_order($i){



	



	$sel="SELECT sum(`qty`) as qty FROM tabl_sale WHERE  shop_id='".$i."' AND date_added=CURDATE()";



	$qry=mysql_query($sel) or die(mysql_error());



	$res=mysql_fetch_assoc($qry);



	if($res['qty']==""){



		return "0";



	}else{



	return $res['qty'];



	}



}



##########################################################################







function today_return($i){



	



	$sel="SELECT sum(`return`) as returns FROM tabl_sale WHERE date_added=CURDATE()";



	$qry=mysql_query($sel) or die(mysql_error());



	$res=mysql_fetch_assoc($qry);



	if($res['returns']==""){



		return "0";



	}else{



	return $res['returns'];



	}



}



##########################################################################

function today_defect($i){



	



	$sel="SELECT sum(`defected`) as defected FROM tabl_sale WHERE date_added=CURDATE()";



	$qry=mysql_query($sel) or die(mysql_error());



	$res=mysql_fetch_assoc($qry);



	if($res['defected']==""){



		return "0";



	}else{



	return $res['defected'];



	}



}





##########################################################################



function get_all_category($id){

include('connectdb.php');
	$r=$db->query("SELECT * FROM category ORDER BY category_name ASC");	

	//$sel="SELECT * FROM category ORDER BY category_name ASC";

	$qry=mysql_query($r) or die(mysql_error());

	

echo '<option value="0">-- SELECT --</option>';	

	while($res=mysql_fetch_assoc($qry)){

		

		if($res['category_id']==$id){$selected='selected="selected"';}else{$selected='';}

			

echo '<option value="'.$res['category_id'].'" '.$selected.' >'.$res['category_name'].'</option>';

	}

}





##########################################################################



function get_parent_category($id){



	$sel="SELECT name FROM tabl_category WHERE id='".$id."'";

	$qry=mysql_query($sel) or die(mysql_error());

    $res=mysql_fetch_assoc($qry);

	if($res['name']==""){

		echo 'No';

		}else{

		echo $res['name']; 	

		}

 }

 



##########################################################################



function get_category_without_parent($id){



	$sel="SELECT * FROM tabl_category WHERE  parent_id=0";

	$qry=mysql_query($sel) or die(mysql_error());

    $res=mysql_fetch_assoc($qry);

		

echo '<option value="0">-- SELECT --</option>';	

	while($res=mysql_fetch_assoc($qry)){

		

		

			if($res['id']==$id){$selected='selected="selected"';}else{$selected='';}

echo '<option value="'.$res['id'].'" '.$selected.' >'.$res['name'].'</option>';

	}

 } 

 

##########################################################################
function get_all_product($id){
	$sel="SELECT * FROM tabl_product";
	$qry=mysql_query($sel) or die(mysql_error());
    $res=mysql_fetch_assoc($qry);
echo '<option value="0">-- SELECT --</option>';	
	while($res=mysql_fetch_assoc($qry)){
		if($res['id']==$id){$selected='selected="selected"';}else{$selected='';}	
echo '<option value="'.$res['id'].'" '.$selected.'>'.$res['name'].'</option>';
	}
 } 
##########################################################################
function get_cart_total($session){
	$qty=mysql_query("SELECT sum(qty) as Ttl_Qty FROM tabl_cart WHERE session_id='".$session."'");
					      $cart_total=mysql_fetch_assoc($qty);
                         $cart= $cart_total['Ttl_Qty'];
                  if($cart==""){
					  return 0;
					  }else{
						  return $cart;
				  }
}
##########################################################################
function get_category_name($id){
	$res=mysql_query("SELECT name FROM tabl_category WHERE id='".$id."'");
					      $res=mysql_fetch_assoc($res);
      echo $res['name'];
}
##########################################################################
function get_product_description($id){
	$res=mysql_query("SELECT description FROM tabl_product WHERE id='".$id."'");
					      $res=mysql_fetch_assoc($res);
      echo $res['description'];
}
##########################################################################
function get_product_name($id){
	$res=mysql_query("SELECT name FROM tabl_product WHERE id='".$id."'");
					      $res=mysql_fetch_assoc($res);
      return $res['name'];
}
##########################################################################
function get_seller_name($id){
	$res=mysql_query("SELECT fname,lname FROM tabl_vendor WHERE id='".$id."'");
					      $res=mysql_fetch_assoc($res);
      return $res['fname'].' '.$res['lname'];
}
##########################################################################
function get_seller_details($id){
	$res=mysql_query("SELECT tabl_vendor.*,tabl_zone.name as State FROM tabl_vendor INNER JOIN tabl_zone ON tabl_zone.zone_id=tabl_vendor.state WHERE tabl_vendor.id='".$id."'");
					      $res=mysql_fetch_assoc($res);
      return $res['fname'].' '.$res['lname'].'~~~'.$res['about'].'~~~'.$res['image'].'~~~'.$res['address'].'~~~'.$res['city'].'~~~'.$res['State'].'~~~'.$res['mobile'].'~~~'.$res['email'];
}
##########################################################################
function get_product_image($id){
	$res=mysql_query("SELECT feature_img FROM tabl_product WHERE id='".$id."'");
					      $res=mysql_fetch_assoc($res);
      return $res['feature_img'];
}
##########################################################################
function get_parent_id($id){
	$res=mysql_query("SELECT parent_id FROM tabl_category  WHERE id='".$id."'");
					      $res=mysql_fetch_assoc($res);
      return $res['parent_id'];
}
##########################################################################
function get_parent_cat_name($id){
	$sel=mysql_query("SELECT parent_id FROM tabl_category WHERE id='".$id."'");
					      $res=mysql_fetch_assoc($sel);
		  if($res['parent_id']>0){
			  $sel1=mysql_query("SELECT name FROM tabl_category WHERE id='".$res['parent_id']."'");
					      $res1=mysql_fetch_assoc($sel1);
      echo $res1['name'].'&nbsp;>&nbsp;';
		  }else{
			  echo '';
			  }
}
#############################################################################
function get_color($id){
$sel1=mysql_query("SELECT option_value FROM tabl_product_option_value WHERE id='".$id."' AND option_id='2'");
					      $res1=mysql_fetch_assoc($sel1); 
						  return $res1['option_value'];
	}
#############################################################################
function get_size($id){
		$sel1=mysql_query("SELECT option_value FROM tabl_product_option_value WHERE id='".$id."' AND option_id='1'");
					      $res1=mysql_fetch_assoc($sel1); 
						  return $res1['option_value'];
	}
#############################################################################
function get_color_cart($id){
$sel1=mysql_query("SELECT option_value FROM tabl_product_option_value WHERE id='".$id."' AND option_id='2'");
					      $res1=mysql_fetch_assoc($sel1); 
						  echo $res1['option_value'];
	}
#############################################################################
function get_size_cart($id){
		$sel1=mysql_query("SELECT option_value FROM tabl_product_option_value WHERE id='".$id."' AND option_id='1'");
					      $res1=mysql_fetch_assoc($sel1); 
						  echo $res1['option_value'];
	}
##########################################################################
function get_all_state($id){
	$sel="SELECT * FROM tabl_zone ORDER BY name ASC";
	$qry=mysql_query($sel) or die(mysql_error());
echo '<option value=" ">Province/State</option>';	
	while($res=mysql_fetch_assoc($qry)){
		if($res['zone_id']==$id){$selected='selected="selected"';}else{$selected='';}
echo '<option value="'.$res['zone_id'].'" '.$selected.' >'.$res['name'].'</option>';
	}
}
##########################################################################
function get_all_country($id){
	$sel="SELECT * FROM tabl_country ORDER BY name ASC";
	$qry=mysql_query($sel) or die(mysql_error());
echo '<option value=" ">Country</option>';	
	while($res=mysql_fetch_assoc($qry)){
		if($res['country_id']==$id){$selected='selected="selected"';}else{$selected='';}
echo '<option value="'.$res['country_id'].'" '.$selected.' >'.$res['name'].'</option>';
	}
}
####################################################################
function get_state_country_wise($country,$state){
 $sel="SELECT * FROM tabl_zone WHERE country_id='".$country."' ORDER BY name ASC";
	$qry=mysql_query($sel) or die(mysql_error());
	while($res=mysql_fetch_assoc($qry)){
		if($res['zone_id']==$state){$selected='selected="selected"';}else{$selected='';}
echo '<option value="'.$res['zone_id'].'" '.$selected.' >'.$res['name'].'</option>';
	}
}
####################################################################
function get_state_name($state){
 $sel="SELECT name FROM tabl_zone WHERE zone_id='".$state."' ORDER BY name ASC";
	$qry=mysql_query($sel) or die(mysql_error());
	$res=mysql_fetch_assoc($qry);
	return  $res['name'];
}
####################################################################
function get_country_name($country){
 $sel="SELECT name FROM tabl_country WHERE country_id='".$country."' ORDER BY name ASC";
	$qry=mysql_query($sel) or die(mysql_error());
	$res=mysql_fetch_assoc($qry);
	return  $res['name'];
}
####################################################################
function get_tax_value($amt){
	     $taxable_amt=($amt*13)/100;
		 return $taxable_amt;
	}
####################################################################
function get_all_customer($id){

	$sel="SELECT * FROM tabl_customer ORDER BY firstname ASC";

	$qry=mysql_query($sel) or die(mysql_error());

	while($res=mysql_fetch_assoc($qry)){
		if($res['id']==$id){$selected='selected="selected"';}else{$selected='';}
echo '<option value="'.$res['id'].'" '.$selected.' >'.$res['firstname'].'</option>';
	}
}

#######################################################################

function get_wallet_amount($id){
	
	$sel="SELECT * FROM tabl_wallet WHERE c_id='".$id."'";
	$qry=mysql_query($sel) or die(mysql_error());
$res=mysql_fetch_assoc($qry);
    $amount=number_format($res['in_amount']-$res['out_amount'],2);
	
	return $amount;
}



	

	