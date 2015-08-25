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
           $status = $data->user_status;
           $user_type = $data->user_type;
         
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
   <p class="dashuppe-text-all">Name *<br />
       <input type="hidden" name="id" value="<?php echo $id; ?>" >
  <input type="text" class="textInput" name="user_name" value="<?php echo $name; ?>" />
  </p>
  
  <p class="dashuppe-text-all">First Name *<br />
  <input type="text" class="textInput" name="user_fname" value="<?php echo $fname; ?>" />
  </p>
  
  <p class="dashuppe-text-all">Last Name *<br />
  <input type="text" class="textInput" name="user_lname" value="<?php echo $lname; ?>" />
  </p>
  
  <p class="dashuppe-text-all">E-mail *<br />
  <input type="email" class="textInput" name="user_email" value="<?php echo $email; ?>" />
  </p>
  
  <p class="dashuppe-text-all">Password *<br />
  <input type="password" class="textInput" name="user_pass" value="<?php //echo $pass; ?>" />
  </p>
  
   <p class="dashuppe-text-all">User Status<br />
   <?php $options = array('1'  => 'Active', '0'    => 'Inactive');  ?>
       <select class="textInput" name="status">
         
         <?php foreach ($options as $key=>$data){ ?>
         <option value="<?php echo $key; ?>" <?php if($key == $status) { echo "selected"; } ?>><?php echo $data; ?></option>
         <?php } ?>
     </select>
  </p>
  
  <p class="dashuppe-text-all">User Type<br />
 <?php $useroptions = array("0" => 'Administrator', "1" => "User" );  ?>
      <select class="textInput" name="user_type">
         
         <?php foreach ($useroptions as $data){ ?>
         <option value="<?php echo $data; ?>" <?php if($data == $user_type) { echo "selected"; } ?>><?php echo $data; ?></option>
         <?php } ?>
     </select>
  </p>
  
  <input type="submit" class="btn btn-primary btn-lg" value="Submit" />
  <?php echo form_close();?>
   <?php } else{
     echo '<h3 id="sucessmsg">Sorry! the user is not found.</h3>';
        } ?>
</div>
<div class="clear"></div>
</div>