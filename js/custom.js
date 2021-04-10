	$(".login-btn").click(function(){
		$("#loginBox").show();
		$("#signupBox").hide();
		$("#forgotPasswordBox").hide();
		$("#changePasswordBox").hide();
	})
	$(".signup-btn").click(function(){
		$("#signupBox").show();
		$("#loginBox").hide();
		$("#forgotPasswordBox").hide();
        $("#changePasswordBox").hide();
	})
	$(".signin-btn").click(function(){
		$("#signupBox").hide();
		$("#loginBox").show();
    	$("#forgotPasswordBox").hide();
		$("#changePasswordBox").hide();
	})
	$(".forget-password").click(function(){
		$("#forgotPasswordBox").show();
		$("#loginBox").hide();

	})
	
	$('.edit-address').click(function(){
		$('#myaddress').toggle();
	})
	
	

	// registeration form
	$("#user-register").submit(function(e) {
		var name = $("#register-name").val(); 
		var email = $("#register-email").val();
		var mobile = $("#register-mobile").val();
		var password = $("#register-password1").val();
		var password2 = $("#register-password2").val();
		

		//$(".loader").show();	
		 $.ajax({
		  url:'ajax/register.php',
		  type:'post',
		  data:{'name':name,'email':email,'mobile':mobile,'password':password,'password2':password2},
		  success:function(data){
			 //alert(data);
			if(data==1)
			{ 
			  $(".register-alert").show();
		setInterval(function() {
			$("#loginBox").show();
			$("#signupBox").hide();
			$("#forgotPasswordBox").hide();
			
						}, 1000);
				}
			else if(data==2)
			{

			  $(".register-alert1").show();
		setInterval(function() {
		  $(".register-alert1").hide();
			
						}, 4000);	  

				}	
			else if(data==3)
			{

			  $(".register-alert2").show();
		setInterval(function() {
		  $(".register-alert2").hide();
			
						}, 4000);	  

				}
			else 
			{

			  $(".register-alert3").show();
		setInterval(function() {
		  $(".register-alert3").hide();
			
						}, 4000);	  

				}
			},
		  });
		e.preventDefault(); // avoid to execute the actual submit of the form.
	});
	
	
	
	//login form
	$("#user-loginform").submit(function(e) {
		
		var email = $("#login-email").val(); 
		var password = $("#login-password").val();
		 $.ajax({
		  url:'ajax/login.php',
		  type:'post',
		  data:{'user':email,'password':password},
		  success:function(data){
			 //alert(data);
			if(data==1)
			{ 
			 
				location.reload();
				}
			
			else if(data==2) 
			{

			  $(".login-alert").show();
					setInterval(function() {
		  $(".login-alert").hide();
			
						}, 4000);	  

			}
			else 
			{

			  $(".login-alert1").show();
			setInterval(function() {
		  $(".login-alert1").hide();
			
						}, 4000);	  
				}	
			},
		  });
		e.preventDefault(); // avoid to execute the actual submit of the form.
	});
	
		//Forgot password
	$("#user-forgotpass").submit(function(e) {
		var email = $("#forgot-email").val(); 
	
		 $.ajax({
		  url:'ajax/forgot-password.php',
		  type:'post',
		  data:{'email':email},
		  success:function(data){
			 //alert(data);
			if(data==1)
			{ 
    			$("#loginBox").hide();
        		$("#signupBox").hide();
        		$("#forgotPasswordBox").hide();
        		$("#changePasswordBox").show();
				}
			else if(data==2) 
			{

			  $(".forgot-alert").text('Invalid Email.');
		setInterval(function() {
		  $(".forgot-alert").text();
			
						}, 4000);	  

				}
			else 
			{

			  $(".forgot-alert").text('Something went wrong. Resend OTP');
		setInterval(function() {
		  $(".forgot-alert").text();
			
						}, 4000);	  

				}	
			
			},
		  });
		e.preventDefault(); // avoid to execute the actual submit of the form.
	});
	
		//RESET password
	$("#user-forgotpass1").submit(function(e) {
	    var otp = $("#forgot-otp").val(); 
		var password = $("#forgot-pass").val(); 
	    var password1 = $("#forgot-pass1").val();
	    var email = $("#forgot-email").val(); 
		 $.ajax({
		  url:'ajax/reset-password.php',
		  type:'post',
		  data:{'email':email,'otp':otp,'password':password,'password1':password1},
		  success:function(data){
			 //alert(data);
			if(data==1)
			{ 
    			$("#loginBox").show();
        		$("#signupBox").hide();
        		$("#forgotPasswordBox").hide();
        		$("#changePasswordBox").hide();
				}
			else if(data==2) 
			{

			  $(".forgot1-alert").text('Something went wrong.');
		setInterval(function() {
		  $(".forgot1-alert").text();
			
						}, 4000);	  

				}
				else if(data==4) 
			{

			  $(".forgot1-alert").text('Wrong OTP.');
		setInterval(function() {
		  $(".forgot1-alert").text();
			
						}, 4000);	  

				}
			else 
			{

			  $(".forgot1-alert").text('Password Should be Same');
		setInterval(function() {
		  $(".forgot1-alert").text();
			
						}, 4000);	  

				}	
			
			},
		  });
		e.preventDefault(); // avoid to execute the actual submit of the form.
	});
	
	
	// update address
	$("#addmyaddress").submit(function(e) {
		e.preventDefault(); // avoid to execute the actual submit of the form.
		var full_address = $("#full_address").val(); 
		var city = $("#city").val();
		var id_state = $("#id_state").val();
		var pin = $("#pin").val();
		var user_id = $("#user_id").val();
		var add_address = 'test';
		
		 $.ajax({
		  url:'ajax/update-address.php',
		  type:'post',
		  data:{'add_address':add_address,'full_address':full_address,'city':city,'id_state':id_state,'pin':pin,'user_id':user_id},
		  success:function(data){
			if(data==1)
			{ 
			  $(".address-alert").show();
		setInterval(function() {
		  $(".address-alert").hide();
			location.reload();
						}, 2000);
				}
			else if(data==2)
			{

			  $(".address-alert1").show();
		setInterval(function() {
		  $(".address-alert1").hide();
			
						}, 4000);	  

				}
			else if(data==3)
			{

			  $(".address-alert2").show();
		setInterval(function() {
		  $(".address-alert2").hide();
			
						}, 4000);	  

				}				
			},
		  });
		
	});
	
	$(".address-row").click(function(){
		var newVal = $(this).parent().find('.add-val').val();
		$("#add_id").val(newVal);
	})
	
	$("#editmyaddress").submit(function(e) {
		e.preventDefault(); // avoid to execute the actual submit of the form.
		var full_address = $("#full_addresss").val(); 
		var city = $("#citys").val();
		var id_state = $("#id_states").val();
		var pin = $("#pins").val();
		var add_id = $("#add_id").val();
		var edit_address = 'test';
		
		 $.ajax({
		  url:'ajax/update-address.php',
		  type:'post',
		  data:{'edit_address':edit_address,'full_address':full_address,'city':city,'id_state':id_state,'pin':pin,'add_id':add_id},
		  success:function(data){
			if(data==1)
			{ 
			  $(".address1-alert").show();
		setInterval(function() {
		  $(".address1-alert").hide();
			location.reload();
						}, 2000);
				}
			else if(data==2)
			{

			  $(".address1-alert1").show();
		setInterval(function() {
		  $(".address1-alert1").hide();
			
						}, 4000);	  

				}
			else if(data==3)
			{

			  $(".address1-alert2").show();
		setInterval(function() {
		  $(".address1-alert2").hide();
			
						}, 4000);	  

				}				
			},
		  });
		
	});
	

	function delete_address(id)
	{
	$.ajax({
		url: 'ajax/delete-address.php',
		data:{'add_id':id} ,
		success:function(data)
		{
			if(data==1)
			{
				 location.reload();
			}
		}
		});
	}



	// update password
	$("#changepasswordform").submit(function(e) {
		var old_password = $("#old_password").val(); 
		var new_password = $("#new_password").val();
		var verify_password = $("#verify_password").val(); 
		
		 $.ajax({
		  url:'ajax/update-password.php',
		  type:'post',
		  data:{'old_password':old_password,'new_password':new_password,'verify_password':verify_password},
		  success:function(data){
			if(data==1)
			{ 
			  $(".pass-alert").show();
				setInterval(function() {
				$(".pass-alert").hide();
				location.reload();
						}, 4000);
				}
			else if(data==2)
			{

			  $(".pass-alert1").show();
				setInterval(function() {
				$(".pass-alert1").hide();
			
						}, 4000);	  

				}
			else if(data==3)
			{

			  $(".pass-alert2").show();
		setInterval(function() {
		  $(".pass-alert2").hide();
			
						}, 4000);	  

				}
			else
			{
				$(".pass-alert3").show();
		setInterval(function() {
		  $(".pass-alert3").hide();
			
						}, 4000);
				}		
			},
		  });
		e.preventDefault(); // avoid to execute the actual submit of the form.
	});
	
	//update profile
	$("#updateprofile").submit(function(e) {
		var update_name = $("#update_name").val(); 
		var update_mobile = $("#update_mobile").val(); 
		
		 $.ajax({
		  url:'ajax/update-profile.php',
		  type:'post',
		  data:{'update_mobile':update_mobile,'update_name':update_name},
		  success:function(data){
			if(data==1)
			{ 
			  $(".pro-alert").show();
				setInterval(function() {
				$(".pro-alert").hide();
				location.reload();
						}, 4000);
				}
			else if(data==2)
			{

			  $(".pro-alert1").show();
				setInterval(function() {
				$(".pro-alert1").hide();
			
						}, 4000);	  
				}
			},
		  });
		e.preventDefault(); // avoid to execute the actual submit of the form.
	});
	
	 //quantity
	
$('.minus-btn').on('click', function(e) {
	
    e.preventDefault();
    var $this = $(this);
    var $input = $this.closest('div').find('input');
    var value = parseInt($input.val());
 
    if (value > 1) {
        value = value - 1;
    } else {
        value = 1;
    }
 
  $input.val(value);
 
});

$('.plus-btn').on('click', function(e) {
	
    e.preventDefault();
    var $this = $(this);
    var $input = $this.closest('div').find('input');
    var value = parseInt($input.val());
 
    if (value < 10) {
        value = value + 1;
    } else {
        value =1;
    }
 
    $input.val(value);
});

//login-alert

function myFunction() {
  document.getElementById('myAlert').style.display = 'block';
}



// card 
	function cartcount() {
		
			$.ajax({
			url: 'ajax/totalqty.php',
			type: 'post',
			success: function(data) {
                    var obj = $.parseJSON(data);      
					
					$('#total_cnt').text(obj.total);
					
              },
		});
		
	}

//updatecart
// function priceCount(e){
// 	var pro_id  = document.getElementById('hd'+e).value;
// 	debugger
// 			$.ajax({
// 			url: 'ajax/totalprice.php',
// 			type: 'post',
// 			data:{'cart_id':pro_id},
// 			success: function(data) {
//                     var obj = $.parseJSON(data);      
					
// 					$('#price'+e).text(obj);
					
//               },
// 		});
// 		e.preventDefault();
// }
function updateC(e,a,proID){
   debugger
  var qty  = document.getElementById('updatecart'+e).value;
  if(a=='1')
  {

	 if(parseInt(qty)<='1')
	 {
		 qty = 0;
		  
	 }
	 else
	 {
		  qty = parseInt(qty)-1;
		
	 }
  }
  else
  {
	 if(parseInt(qty)>='10')
	 {
		 qty = 10;
		  
	 }
	 else
	 {
		  qty = parseInt(qty)+1;
		
	 }
  }
  $.ajax({
  url:'ajax/update-cart.php',
  type:'post',
  data:{'cart_id':e,'qty':qty},
  success:function(data){
	var data = JSON.parse(data);
	if(data.statusCode==200){
		if(qty==0){
			$("#log" + proID).show();
			$("#dynamicbtn" + proID).hide();
			$("#cartData" + e).hide();
			$('#totalcost').html('<i class="fa fa-rupee"></i>&nbsp' + data.totalcost);
		}else{
			$('#updatecart'+e).val(qty);
			$('#price'+e).text(data.value);
			$('#totalcost').html('<i class="fa fa-rupee"></i>&nbsp' + data.totalcost);
		}
	}

	cartcount();

	},
  });

	
}



$(window).on('scroll', function () {
	if ($(window).scrollTop() > 100) {
		$('.header_moveble').addClass('navigation-background');
	} else {
		$('.header_moveble').removeClass('navigation-background');
	}
});