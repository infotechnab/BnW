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
  
  <p class="dashuppe-text-all">Name *<br />
      <input type="text" class="textInput" required="" name="user_name" value="<?php echo set_value('user_name'); ?>" />
  </p>
  
  <p class="dashuppe-text-all">First Name *<br />
      <input type="text" class="textInput" required="" name="user_fname" value="<?php echo set_value('user_fname'); ?>" />
  </p>
  
  <p class="dashuppe-text-all">Last Name *<br />
      <input type="text" class="textInput" required="" name="user_lname" value="<?php echo set_value('user_lname'); ?>" />
  </p>
  
  <p class="dashuppe-text-all">E-mail *<br />
      <input type="email" class="textInput" required="" name="user_email" value="<?php echo set_value('user_email'); ?>" />
  </p>
  
  <p class="dashuppe-text-all">Password *<br />
      <input type="password" class="textInput" required="" name="user_pass" value="<?php echo set_value('user_pass'); ?>" />
  </p>
  
   <p class="dashuppe-text-all">User Status<br />
  <?php $options = array('1'  => 'Active', '0'    => 'Inactive');  ?>
       <select class="textInput" name="status">
         
         <?php foreach ($options as $key => $data){ ?>
         <option value="<?php echo $key; ?>"><?php echo $data; ?></option>
         <?php } ?>
     </select>
  </p>
  
  <p class="dashuppe-text-all">User Type<br />
  <?php $useroptions = array("0" => 'Administrator', "1" => "User" );  ?>
      <select class="textInput" name="user_type">
         
         <?php foreach ($useroptions as $data){ ?>
         <option value="<?php echo $data; ?>"><?php echo $data; ?></option>
         <?php } ?>
     </select>
  </p>
  
  
  <input type="submit" class="btn btn-primary btn-lg" value="Submit" />
  <?php echo form_close();?>
</div>
<div class="clear"></div>
</div>