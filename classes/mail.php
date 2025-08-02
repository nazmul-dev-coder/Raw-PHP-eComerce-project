<?php

//Import PHPMailer classes into the global namespace
//These must be at the top of your script, not inside a function

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

//required files
require '../admin/phpmailer/src/Exception.php';
require '../admin/phpmailer/src/PHPMailer.php';
require '../admin/phpmailer/src/SMTP.php';


class mail{
private $mail;

public function __construct(){
 $this->mail= new PHPMailer(true);
}

public function sendMail($from,$to,$appPass,$body){
    
    //Server settings
    $this->mail->isSMTP();                              //Send using SMTP
    $this->mail->Host       = 'smtp.gmail.com';       //Set the SMTP server to send through
    $this->mail->SMTPAuth   = true;             //Enable SMTP authentication
    $this->mail->Username   = $from;   //SMTP write your email
    $this->mail->Password   = $appPass;      //SMTP password
    $this->mail->SMTPSecure = 'ssl';            //Enable implicit SSL encryption
    $this->mail->Port       = 465;                                    

    //Recipients
    $this->mail->setFrom($from); // Sender Email and name
    $this->mail->addAddress($to);     //Add a recipient email  
    $this->mail->addReplyTo($from); // reply to sender email

    //Content
    $this->mail->isHTML(true);               //Set email format to HTML
    $this->mail->Subject = "Mail from store website";   // email subject headings
    $this->mail->Body    = $body; //email message

    // Success sent message alert
    $this->mail->send();
   return 1;
   }
}

?>

