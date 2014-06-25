

</div>
<div id="contentBackground">
        <div id="forgotpass">
            <div><?php echo form_open_multipart('view/setpassword');?>
  
    <?php $token = $_GET['resetPassword'];
   ?>
    <input type="hidden" name="tokenid" value="<?php echo $token; ?>" />
  
  <p>New Password:<br />
  <input type="password" name="user_pass" id="newPassword" required/>
  </p>
  
  <p>Confirm Password:<br />
  <input type="password" name="user_confirm_pass" id="confirmPassword" required/>
  </p>
  
  <input type="submit" value="Submit" />
  <?php echo form_close();?>
</div>
        </div>
    </div>
</div>
