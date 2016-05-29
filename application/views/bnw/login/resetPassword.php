<?php
if (isset($_GET['resetPassword'])) {
            $token =  $_GET['resetPassword'];
        }else{$token =NULL;}

foreach ($query as $data){
                   $useremail= $data->user_email;
                   $userKey = $data->user_auth_key;
              }
?>

</div>
<div id="contentBackground">
        <div id="forgotpass">
             <?php if($token == $userKey){ ?>
            
            <div><?php echo form_open_multipart('login/setpassword');?>
                 <p id="sucessmsg">
                                    <?php if($this->session->flashdata('message')){echo $this->session->flashdata('message');}
                                echo validation_errors(); ?> </p>
   <input type="hidden" name="email" value="<?php echo $useremail; ?>">
   <input type="hidden" name="resetPassword" value="<?php echo $userKey; ?>">
  
  <p>New Password:<br />
  <input type="password" name="user_pass" id="newPassword" required/>
  </p>
  
  <p>Confirm Password:<br />
  <input type="password" name="user_confirm_pass" id="confirmPassword" required/>
  </p>
  
  <input type="submit" value="Submit" />
  <?php echo form_close();?>
</div>
             <?php }else{
                 echo 'Sorry ! Your token has been expired.';
             } ?>
        </div>
    </div>
</div>
