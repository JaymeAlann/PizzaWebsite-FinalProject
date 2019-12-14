<?php
  $name = $_POST['name'];
  $email = $_POST['email'];
  $message = $_POST['message'];


  $email_from = 'Papis Pies Pizzeria Webpage';
  $email_subject = 'New Message from Papis!';
  $email_body = "Name: $name.\n".
                "Email: $email.\n".
                "Message: $message.\n";

  $to = "youreEmail@here";
  $headers = "From: $email_from \r\n";
  $headers .= "Reply-To: $email \r\n";

  //mail('phone@tmomail.net', "PHP TEXT IS WORKING","From james website<james@papis.com>\r\n");
  if(mail($to, $email_subject, $email_body, $headers)){
	   header("location: ../success.html");
  }else{
	  echo 'alert("message not successfully sent")';
  }

 

 ?>
