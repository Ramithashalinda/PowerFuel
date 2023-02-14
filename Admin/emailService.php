<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

// require 'C:\xampp\htdocs\POWER-FUEL\phpmailer/src/Exception.php';
// require 'C:\Users\User\Desktop\xampp\htdocs\SDP_CW_01\phpmailer/src/PHPMailer.php';
// require 'C:\Users\User\Desktop\xampp\htdocs\SDP_CW_01\phpmailer/src/SMTP.php';

require 'C:\xampp\htdocs\POWER-FUEL\phpmailer\src/Exception.php';
require 'C:\xampp\htdocs\POWER-FUEL\phpmailer\src/PHPMailer.php';
require 'C:\xampp\htdocs\POWER-FUEL\phpmailer\src/SMTP.php';


// used to send xamp server
function statusChangeMail($to, $status){

    $name = "POWER-FUEL";
    $from = 'hasaralmayadunna@gmail.com';
    $mail_subject   = 'Email Sent From Power Fuel';
    $email_body     =  "This Email Sent Based On Your Fuel Request: <br>";
    $email_body     .= "<b>From:</b> {$name} <br>";
    $email_body     .= "<b>Your Fuel Request is :</b>" ."<p style=\"color:blue;\">" . $status ."</p>";

    $header = "From: {$from}\r\nContent-Type : text/html;";

    $send_mail_result = mail($to, $mail_subject, $email_body, $header);


    if($send_mail_result){
    
        echo "Mail sent ";

    }else{
        
        echo "Mail not sent";
    }

}


function emailSettings($to, $status, $body){

    $mail = new PHPMailer(true);
    
    try {
        //Server settings
        $mail->SMTPDebug = 0;                                       //Enable verbose debug output
        $mail->isSMTP();                                            //Send using SMTP
        $mail->Host       = 'smtp.gmail.com';                       //Set the SMTP server to send through
        $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
        $mail->Username   = 'hasaralmayadunna@gmail.com';           //SMTP username
        $mail->Password   = 'vpyujquwclaejqsh';                     //SMTP password
        $mail->SMTPSecure = 'ssl';                                  //Enable implicit TLS encryption
        $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`
    
        //Recipients
        $mail->setFrom('hasaralmayadunna@gmail.com', 'POWER FUEL');
        $mail->addAddress($to, 'recipient'); //Add a recipient
        $mail->addReplyTo('hasaralmayadunna@gmail.com', 'Information');
    
    
        //Content
        $mail->isHTML(true); //Set email format to HTML
        $mail->Subject = 'Fuel Request Status';
        $mail->Body    = '<b>'. $body ." : ". $status . '</b>';
    
        $mail->send();
        // echo 'Message has been sent';
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
}

function statusChangeEmail($to, $status){

   $body = 'Your Requested Fuel Stock Is ';

   emailSettings($to,$status,$body);

}

function fuelFillingConfirmEmail($to, $vehicleNo, $qty){

    $status = "Thank You!";
    $currentTime = date("Y/m/d");
    $body = "Your Fuel Request is Successfully done. <br>";
    $body .= "Date: {$currentTime} <br>";
    $body .= "Fuel Quantity: {$qty} <br>";
    $body .= "Vehicle No: {$vehicleNo} <br>";

   emailSettings($to,$status,$body);

}
function tokenReqEmail($to, $token, $fuelType, $category, $vehicleNo, $qty, $date, $time){

    $status = "Thank You!";
    $body = "Hi,<br><br>"; 
    $body .= "Your fuel request for {$vehicleNo} has been successfull<br>";
    $body .= "Token number: {$token}<br>";
    $body .= "Fuel: {$fuelType} {$category}<br>";
    $body .= "No of Liters : {$qty}<br>";
    $body .= "Date & Time : {$date} {$time}<br><br>";

    emailSettings($to,$status,$body);
 
 }


function dealerRegisterEmail($to, $name ,$mail, $password){

    $status = "Thank You!";

    // $body = "test";
    $body = "<b> Hi : </b> {$name} <br>";
    $body .= "Your Registraton is Successfully done. <br>";
    $body .= "Use Following email and Password to login to the system. <br>";
    $body .= "<b> Email : </b> {$mail} <br>";
    $body .= "<b> Password : </b> {$password} <br>";
    $body .= "-";

    emailSettings($to, $status, $body);
}



?>