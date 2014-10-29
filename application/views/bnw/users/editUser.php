<div class="rightSide">
 <?php

        if(!empty($query)){
            foreach ($query as $data){
           $id = $data->id;
           $name = $data->user_name;
           $fname = $data->user_fname;
           $lname = $data->user_lname;
           $email= $data->user_email;
           $pass= $data->user_pass;
           $status= $data->user_status;
         
       }
        
    ?>
<h2>Edit user/ <?php echo $name; ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="<?php echo base_url().'index.php/user/users'; ?>">View All</a></h2>
<hr class="hr-gradient"/>
  
 
  <p id="sucessmsg">
  <?php echo $this->session->flashdata('message');
   if(isset($error))
  {
     echo $error;
  }?>
      <?php echo validation_errors(); ?>
    </p>
  <?php echo form_open_multipart('user/updateuser');?>
   <p>Name:<br />
       <input type="hidden" name="id" value="<?php echo $id; ?>" >
  <input type="text" class="textInput" name="user_name" value="<?php echo $name; ?>" />
  </p>
  
  <p>First Name:<br />
  <input type="text" class="textInput" name="user_fname" value="<?php echo $fname; ?>" />
  </p>
  
  <p>Last Name:<br />
  <input type="text" class="textInput" name="user_lname" value="<?php echo $lname; ?>" />
  </p>
  
  <p>E-mail:<br />
  <input type="email" class="textInput" name="user_email" value="<?php echo $email; ?>" />
  </p>
  
  <p>Password:<br />
  <input type="password" class="textInput" name="user_pass" value="<?php //echo $pass; ?>" />
  </p>
  
   <p> User Status:<br />
  <?php 
  $status = array(
                  '1'  => 'publish',
                  '0'    => 'draft');
  echo form_dropdown('user_status',$status,'1')
  ?>
  </p>
  
  <p> User Type:<br />
  <?php 
  $useroptions = array('0' => 'Administrator', '1' => "User" );
  echo form_dropdown('user_type',$useroptions)
  ?>
  </p>
  
  <input type="submit" value="Submit" />
  <?php echo form_close();?>
   <?php } else{
     echo '<h3 id="sucessmsg">Sorry! the user is not found.</h3>';
        } ?>
</div>
<div class="clear"></div>
</div>