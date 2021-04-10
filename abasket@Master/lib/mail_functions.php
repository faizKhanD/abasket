<?php

function send_email($email,$msg){
// Multiple recipients
$to = $email; // note the comma

// Subject
$subject = 'Enquiry Reply From Adil Computers';

// Message
$message = '<html><head>
  <title>Enquiry Reply From Adil Computers</title>
</head>
<body>
  Hello Sir,<br/>
  '.$msg.'<br/>
  Team Adil Computers.
</body>
</html>';

// To send HTML mail, the Content-type header must be set
$headers[] = 'MIME-Version: 1.0';
$headers[] = 'Content-type: text/html; charset=iso-8859-1';

// Additional headers
$headers[] = 'From: Adil Computers <info@adilcomputers.com>';

// Mail it
mail($to, $subject, $message, implode("\r\n", $headers));
    }	
			
?>