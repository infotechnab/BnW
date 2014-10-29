<div class="rightSide">
<div class="titleArea">
     <h2>Add new user&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="<?php echo base_url().'index.php/user/users'; ?>">View All</a></h2>
<hr class="hr-gradient"/>   
    </div>

  
<div id="sucessmsg">
  <?php if($this->session->flashdata('message')){echo $this->session->flashdata('message');}?>
    <?php echo validation_errors();
  if(isset($error))
  {
      echo $error;
  }
  ?>
</div>
  <?php echo form_open_multipart('user/adduser');?>
  
  <p>Name:<br />
  <input type="text" class="textInput" name="user_name" value="<?php echo set_value('user_name'); ?>" />
  </p>
  
  <p>First Name:<br />
  <input type="text" class="textInput" name="user_fname" value="<?php echo set_value('user_fname'); ?>" />
  </p>
  
  <p>Last Name:<br />
  <input type="text" class="textInput" name="user_lname" value="<?php echo set_value('user_lname'); ?>" />
  </p>
  
  <p>E-mail:<br />
  <input type="email" class="textInput" name="user_email" value="<?php echo set_value('user_email'); ?>" />
  </p>
  
  <p>Password:<br />
  <input type="password" class="textInput" name="user_pass" value="<?php echo set_value('user_pass'); ?>" />
  </p>
  
  <p> Contact : <br/>
  <input type="text" class="textInput" name="phone" value="<?php echo set_value('phone'); ?>" />
  </p>
  
  <p> Address : <br/>
      <textarea class="textInput" name="address"><?php echo set_value('address'); ?></textarea>
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