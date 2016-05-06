<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


    function notofication_email_body($name, $fname, $lname, $email, $pass, $status, $imglink)
{
    $body = '<div style="width: 750px; margin: 0 auto 0 auto; padding: 0px;font-family: calibri;border: 1px solid #000;" >
        <div style="text-align:center; min-height: 70px; background-color: #222; margin: 0 auto 0 auto;width: 100%;">
            <div style="margin: 0 auto;text-align: center;">
            <img src="'.$imglink.'" style="width:70px; margin:10px;vertical-align:middle;" alt=""/>
            <span style="color: #f8a54d;font-size: 40px;font-family: Trebuchet MS;font-weight:900;vertical-align:middle;">ISER - N</span>
            </div>
            </div>

   <div style="padding: 10px 20px 10px 20px;background-color: #fff;">
   
    
    <h4 style="font-family: calibri;font-weight: 500;font-size: 20px;">Dear '.$fname.' '.$lname.'  !</h4>

    <h5 style="font-size: 18px;text-align: center;">You are successfully registered in ISER - N. Your login credentials are as follows : <br/> User name: '.$name.'<br/> Email id: '.$email.'<br/> Password : '.$pass.'</h5>
    

 <br/><br/><br/>   

</div>
            

</div>';
   
   
   return $body;
}  

function send_notification_email($email, $subject, $message)
                {    
    $headers = "From: ISER-N <info@isernepal.org.np>" . "\r\n";
    $headers .= 'Reply-To: nfo@isernepal.org.np' . "\r\n";
    $headers .="MIME-Version: 1.0" . "\r\n";
    $headers .="Content-type:text/html;charset=UTF-8" . "\r\n";         

    if (mail($email, $subject, $message, $headers)) {
       
    } else {
         }    
   }
   
  function password_reset_email($to, $user, $token, $link, $imglink) {
    $body = '<div style="width: 750px; margin: 0 auto 0 auto; padding: 0px;font-family: calibri;border: 1px solid #000;" >
        <div style="text-align:center; min-height: 70px; background-color: #222; margin: 0 auto 0 auto;width: 100%;">
            <div style="margin: 0 auto;text-align: center;">
            <img src="'.$imglink.'" style="width:70px; margin:10px;vertical-align:middle;"/>
            <span style="color: #f8a54d;font-size: 40px;font-family: Trebuchet MS;font-weight:900;vertical-align:middle;">ISER - N</span>
            </div>
            </div>

   <div style="padding: 10px 20px 10px 20px;background-color: #fff;">
   
    
    <h4>Dear ' . $user . '  !</h4>

    <h3>Your request to reset password for email ' . $to . ' has been confirmed.</h3>
    
    <p>Click on the given link to reset your password <a href="' . $link . 'login/resetPassword?id=' . $to . '&&resetPassword=' . $token . '">Reset Password</a></p>
                <br/><br/><br/>   
<h5>Thank You</h5>
<h5>ISER-N Team</h5>
</div>
            
           <div style="text-align:center; height: 40px;padding-top: 10px;">
           <p>&copy; ISER-N</p>

            </div>

</div>';
    return $body;
}

function send_password_reset_email($to, $subject, $message) {
    //$headers = "From: admin<auseluco@box1007.bluehost.com>" . "\r\n";
    $headers = "From: ISER-N <info@isernepal.org.np>" . "\r\n";
    $headers .= 'Reply-To: nfo@isernepal.org.np' . "\r\n";
    $headers .="MIME-Version: 1.0" . "\r\n";
    $headers .="Content-type:text/html;charset=UTF-8" . "\r\n";    

    if (mail($to, $subject, $message, $headers)) {
        
    } else {
       
    }
}

  