<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

function send_user_credentials($name, $fname, $lname, $email, $pass, $status)
{
    
}
    function contact_email_hotel($name, $email, $phone, $imglink, $htitle, $messagess)
{
    $body = '<div style="width: 750px; margin: 0 auto 0 auto; padding: 0px;font-family: calibri;border: 1px solid #000;" >
        <div style="text-align:center; min-height: 70px; background-color: #222; margin: 0 auto 0 auto;width: 100%;">
            <div style="margin: 0 auto;text-align: center;">
            <img src="'.$imglink.'" style="width:70px; margin:10px;vertical-align:middle;" alt=""/>
            <span style="color: #f8a54d;font-size: 40px;font-family: Trebuchet MS;font-weight:900;vertical-align:middle;">'.$htitle.'</span>
            </div>
            </div>

   <div style="padding: 10px 20px 10px 20px;background-color: #fff;">
   
    
    <h4 style="font-family: calibri;font-weight: 500;font-size: 20px;">Dear '.$htitle.'  !</h4>

    <h3 style="font-size: 35px;text-align: center;">You have new contact message by '.$name.' with email id '.$email.' and phone number '.$phone.'!</h3>
    
    <p style="font-size: 18px;font-weight: 100;line-height: 24px;">Contact message is as follows :<br/>
    "'.$messagess.'"</p>
    

 <br/><br/><br/>   

</div>
            

</div>';
   
    return $body;
}  

function send_contact_email_hotel($hotelEmail,$email, $subject, $message)
                {    
    $headers = "From: ".$email. "\r\n";
    $headers .= "Reply-To: ".$email. "\r\n";
    $headers .="MIME-Version: 1.0" . "\r\n";
    $headers .="Content-type:text/html;charset=UTF-8" . "\r\n";          

    if (mail($hotelEmail, $subject, $message, $headers)) {
       
    } else {
         }    
   }
   
 

    function contact_email_user($name, $email, $imglink, $htitle)
{
    $body = '<div style="width: 750px; margin: 0 auto 0 auto; padding: 0px;font-family: calibri;border: 1px solid #000;" >
        <div style="text-align:center; min-height: 70px; background-color: #222; margin: 0 auto 0 auto;width: 100%;">
            <div style="margin: 0 auto;text-align: center;">
            <img src="'.$imglink.'" style="width:70px; margin:10px;vertical-align:middle;" alt=""/>
            <span style="color: #f8a54d;font-size: 40px;font-family: Trebuchet MS;font-weight:900;vertical-align:middle;">'.$htitle.'</span>
            </div>
            </div>

   <div style="padding: 10px 20px 10px 20px;background-color: #fff;">
   
    
    <h4 style="font-family: calibri;font-weight: 500;font-size: 20px;">Dear '.$name.'  !</h4>

    <h3 style="font-size: 35px;text-align: center;">Thank you for your contact request to the '.$htitle.'!</h3>
    
    <p style="font-size: 18px;font-weight: 100;line-height: 24px;">We will contact you as soon as possible.</p>
    

 <br/><br/><br/>   

</div>
            

</div>';
   
    return $body;
}  

function send_contact_email_user($hotelEmail,$email, $subject, $message)
                {    
    $headers = "From: ".$hotelEmail. "\r\n";
    $headers .= "Reply-To: ".$hotelEmail. "\r\n";
    $headers .="MIME-Version: 1.0" . "\r\n";
    $headers .="Content-type:text/html;charset=UTF-8" . "\r\n";          

    if (mail($email, $subject, $message, $headers)) {
       
    } else {
         }    
   }
   
  
  
   
   
   
   
   
   
   
   
 
   
   
   
   
   
   
   
   
 