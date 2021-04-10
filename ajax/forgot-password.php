<?php
    session_start();
    include("../abasket@Master/lib/connectdb.php");
    $to=$_REQUEST["email"];
    
    $r=$db->query("SELECT * FROM `member` WHERE `email`='$to'");
    if($r->num_rows>0)
    {
		$rows= $r->fetch_assoc();
		
		$name=$rows["name"];
		$rand=rand(100000,999999);
		$_SESSION["otp"] = $rand;
		
		$subject = 'abasket Reset Password'; 
        
        $random_hash = md5(date('r', time())); 
        
        $headers = "From: info@cityfunnels.com \r\nReply-To: info@cityfunnels.com";
        
        $headers .= "MIME-Version: 1.0\r\n";
        
        $headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
        
        $message = '<html>
					<body>';
        
        $message .= '<table width="600" border="0" cellpadding="2" cellspacing="2">' ;
                 
        $message .= '<tr>
        				<td><b>Hi! '. $name .' </b> ,</td>
        			</tr>';
		 $message .= '<tr>
            <td><br/>You recently requested to reset your password for your cityfunnels Account with your registered Email ID: <b> ' . $to .' .</b></td></tr>' ;
		
         $message .= '<tr>
        				<td><b><br/>Here is your OTP -' . $rand .'.</b> <br/>
						
        				</tr>';
		 $message .= '<tr>
            <td><br/>Thanks, <br/> <b>cityfunnels</b></td></tr>' ;
		
        
        $message .= '</table>';
        
        $message .= "</body></html>";
        
        $mail_sent = @mail($to, $subject, $message, $headers );
        //print_r($mail_sent);
        if($mail_sent){
            echo "1";
        }else{
           echo "3"; 
        }
        
						
			
	}
	else
	{
		echo "2";
	}


?>