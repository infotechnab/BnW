<div class="rightSide">
<h2>Add new User</h2>
  <?php echo validation_errors();
  if(isset($error))
  {
      echo $error;
  }
  ?>
<p id="sucessmsg">
  <?php if($this->session->flashdata('message')){echo $this->session->flashdata('message');}?>
</p>
  <?php echo form_open_multipart('bnw/adduser');?>
  
  <p>Name:<br />
  <input type="text" name="user_name" value="<?php echo set_value('user_name'); ?>" />
  </p>
  
  <p>First Name:<br />
  <input type="text" name="user_fname" value="<?php echo set_value('user_fname'); ?>" />
  </p>
  
  <p>Last Name:<br />
  <input type="text" name="user_lname" value="<?php echo set_value('user_lname'); ?>" />
  </p>
  
  <p>E-mail:<br />
  <input type="email" name="user_email" value="<?php echo set_value('user_email'); ?>" />
  </p>
  
  <p>Password:<br />
  <input type="password" name="user_pass" value="<?php echo set_value('user_pass'); ?>" />
  </p>
  
   <p> User Status:<br />
  <?php 
  $options = array(
                  '1'  => 'publish',
                  '0'    => 'draft');
  echo form_dropdown('user_status',$options)
  ?>
  </p>
  
  <p> User Type:<br />
  <?php 
  $useroptions = array("0" => 'Administrator', "1" => "User" );
  echo form_dropdown('user_type',$useroptions)
  ?>
  </p>
  
  
  <input type="submit" value="Submit" />
  <?php echo form_close();?>
</div>
<div class="clear"></div>
</div>