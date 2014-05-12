<div>


   <?php if(isset($query)){
            foreach ($query as $data){
            $to = $data->user_email;
           $token = $data->user_auth_key; 
       }
        }
    ?>
            
    
    <p>click the following link to reset your password <a href="<?php echo base_url();?>index.php/login/resetPassword?id=<?php echo $to; ?>&&resetPassword=<?php echo $token; ?>"> RESET PASSWORD</a></p>
   


</div>
<div class="clear"></div>
</div>