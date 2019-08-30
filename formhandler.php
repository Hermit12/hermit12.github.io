<?php
if(isset($_POST['email'])) {

    $email_to = "brigitte-swoboda@gmx.at";
    $email_subject = "Website Kontaktformular-Anfrage";     
     
    $email = $_POST['email'];
    $name = $_POST['name'];
    $phone = $_POST['phone'];
    $message = $_POST['message']; 
          
    $email_message = "Message:\n\n";
     
    function clean_string($string) { 
      $bad = array("content-type","bcc:","to:","cc:","href"); 
      return str_replace($bad,"",$string);
    }

	function getUserIpAddr()
	{
    	if (!empty($_SERVER['HTTP_CLIENT_IP']))
	    {
        	return $_SERVER['HTTP_CLIENT_IP'];
    	}
    	else if (!empty($_SERVER['HTTP_X_FORWARDED_FOR']))
    	{
        	return $_SERVER['HTTP_X_FORWARDED_FOR'];
    	}
    	else
    	{
        	return $_SERVER['REMOTE_ADDR'];
    	}
	}    

    $email_message .= "IP address: ".getUserIpAddr()."\n";
    
    $email_message .= "Name: ".clean_string($name)."\n";
    $email_message .= "Email: ".clean_string($email)."\n";
    $email_message .= "Phone: ".clean_string($phone)."\n";
    $email_message .= "Message: ".clean_string($message)."\n";
 
	$headers = "MIME-Version: 1.0" . "\r\n";
	$headers .= "Content-type:text/plain;charset=UTF-8" . "\r\n";
	$headers .= 'From: '.$email. "\r\n";

	if (@mail($email_to, $email_subject, $email_message, $headers)) {
		header('Location: success.html');
	} else {
		header('Location: error.html');
	}
} 
?>