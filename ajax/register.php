<?php
    session_start();
		$name=$_POST["name"];
        $email=$_POST["email"];
        $mobile=$_POST["mobile"];
        $password=md5($_POST["password"]);
		$password1=md5($_POST["password2"]);
	 	//$address=$_POST["address"];
		
		
		
		include("../abasket@Master/lib/connectdb.php");
		$db->query("select * from member where email='$email'"); 
    	$num = $db->affected_rows;
		if($num>0)
		{
		    echo "4";
		}
		else
		{
		    if($password==$password1)
    		{
    		    $db->query("INSERT INTO `member`( `name`, `email`, `mobile`, `password`, `status`, `date`) VALUES ('$name','$email','$mobile', '$password','1',NOW())"); 
        		if($db->affected_rows>0)
                {
					$subject = 'Welcome to abasket'; 

					$random_hash = md5(date('r', time())); 

					$headers = "From:info@cityfunnels.com \r\nReply-To:info@cityfunnels.com ";

					$headers .= "MIME-Version: 1.0\r\n";

					$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";

					$message = '<html>  <link href="css/style.css" rel="stylesheet" type="text/css" /> <body>';

					$message .= '<table width="600" border="0" cellpadding="2" cellspacing="2">' ;
					$message .= '<tr>
						 <td colspan="2"><b>Welcome to cityfunnels</b> </td>
						 </tr>' ;
					$message .= '<tr>
						<td colspan="2">
					Dear Mr./Ms.</td>
					  </tr>' ;
					$message .= '<tr>

									<td><b>Name :</b> :' . strip_tags($name) .'</td>
								</tr>';


					$message .= '<tr>
									<td><b>Mobile Number:</b> :' . strip_tags($mobile) .'</td>
									<td><b>Email :</b> :' . strip_tags($email) .'</td><br /><br /><br /><br />
									</tr>';

					$message .= '<tr>


									</tr>' ;

					

					$message .= '<tr>
						<td>Wishing You All the Best.<br /><br />
						<br />
						<b>info@cityfunnels.com</b> </td>
						<td>&nbsp;</td>
					   </tr>' ;
					$message .= '</table>
					';



					$message .= "</body></html>";

					$mail_sent = @mail( $email, $subject, $message, $headers );
					$mail_sent = @mail( 'info@cityfunnels.com', $subject, $message, $headers );
                    echo "1";
                }
                else
        		{
        			echo "2";
        		}
                $db->close();
        	}
    		else
    		{
    		    echo "3";
    		}
		}
?>