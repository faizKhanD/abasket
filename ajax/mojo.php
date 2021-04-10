<?php 
session_start();
?>

<!DOCTYPE HTML>  

<html>
<head>
</head>
<body>  

<?php

    $result = $long = $res = $part = $longu = "";

    $_SESSION['name']=$_POST['name'];
    $_SESSION['email']=$_POST['email'];
    $_SESSION['mem_id']=$_POST['mem_id'];
    $_SESSION['amount']=$_POST['product_price'];

   
    
    $name=$_POST['name'];
    $email=$_POST['email'];
    $member_id=$_POST['mem_id'];
    $amount=$_POST['product_price'];



  if (empty($_POST["name"])) {
     ?>
     <script>
     alert("Please enter a name");
     window.location="place-order.php";
     </script>
     <?php
  } else {
    $name = test_input($_POST["name"]);
    if (!preg_match("/^[a-zA-Z ]*$/",$name)) {
     ?>
     <script>
     alert("Only letters and white space allowed");
     window.location="place-order.php";
     </script>
     <?php
    }
  }
	
  if (empty($_POST["product_name"])) {
     ?>
     <script>
     alert("Please enter a name");
     window.location="place-order.php";
     </script>
     <?php
  } else {
    $pro_name = test_input($_POST["product_name"]);
    if (!preg_match("/^[a-zA-Z ]*$/",$pro_name)) {
     ?>
     <script>
     alert("Only letters and white space allowed");
     window.location="place-order.php";
     </script>
     <?php
    }
  }
  if (empty($_POST["email"])) {
     ?>
     <script>
     alert("Email is required");
     window.location="place-order.php";
     </script>
     <?php
  } else {
    $email = test_input($_POST["email"]);
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
     ?>
     <script>
     alert("Invalid email format");
     window.location="place-order.php";
     </script>
     <?php 
    }
  }
    
 
  

  if (empty($_POST["product_price"])) {
     ?>
     <script>
     alert("Please enter a valid amount");
     window.location="place-order.php";
     </script>
    <?php 
  } else {
    $amount = test_input($_POST["product_price"]);
    if (($_POST["product_price"]) < 8) {
     ?>
     <script>
     alert("The Minimum amount that is required for the transaction is Rs 9");
     window.location="place-order.php";
     </script>
    <?php 
    }
  }

function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}

$ch = curl_init();

//curl_setopt($ch, CURLOPT_URL, 'https://test.instamojo.com/api/1.1/payment-requests/');  //This is the Test API endpoint
curl_setopt($ch, CURLOPT_URL, 'https://www.instamojo.com/api/1.1/payment-requests/');  //This is the Live API endpoint
curl_setopt($ch, CURLOPT_HEADER, FALSE);               
curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, TRUE);
curl_setopt($ch, CURLOPT_HTTPHEADER,array("X-Api-Key:a5e8dff6470c411446bb38933786b28f", "X-Auth-Token:9707184463fb8c192d8930e4c4025c4f"));
//curl_setopt($ch, CURLOPT_HTTPHEADER,array("X-Api-Key:test_b32bd7f30fca3ab753c4d5944d0", "X-Auth-Token:test_076a04f480a9d7b617159668496"));

$payload = Array(
    'purpose' => $pro_name,
    'amount' => $amount,
    'address' => $member_id,
    'buyer_name' => $name,
    'redirect_url' => 'http://sabjeebazar.com/ajax/success1.php', 
    'webhook' => 'http://sabjeebazar.com/ajax/webhook.php', 
    'send_email' => false,
    'send_sms' => false,
    'email' => $email,
    'allow_repeated_payments' => false
);

curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($payload));
$response = curl_exec($ch);
curl_close($ch); 

print $response;
echo '<br>';

$myArray = array(json_decode($response, true));

echo '<br>';
print_r($myArray);
echo '<br>';

$longu = $myArray[0]["payment_request"]["longurl"];        //Extracting the Payment link from the JSON response

echo '<br>';
echo $longu;
header('Location:' .$longu);                               //Redirecting the user to the Payment link. You can comment this line to see the JSON response on your screen.
                        
?>
</body>
</html>