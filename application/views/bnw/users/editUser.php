<div class=" col-md-10 col-sm-10 col-lg-10 col-xs-10 rightSide">
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
  
 
  <div id="sucessmsg">
  <?php if($this->session->flashdata('message')){echo $this->session->flashdata('message');}?>
    <?php echo validation_errors();
  if(isset($error))
  {
      echo $error;
  }
  ?>
</div>
  <?php echo form_open_multipart('user/updateuser');?>
 <div class="form-group">
   <label>Name :</label>
       <input type="hidden" name="id" value="<?php echo $id; ?>" >
  <input type="text" class="form-control" name="user_name" required value="<?php echo $name; ?>" />
</div>
  
   <div class="form-group">
  <label>First Name :</label>
  <input type="text" class="form-control" name="user_fname" value="<?php echo $fname; ?>" />
</div>
  
   <div class="form-group">
  <label>Last Name :</label>
  <input type="text" class="form-control" name="user_lname" value="<?php echo $lname; ?>" />
</div>
  
   <div class="form-group">
  <label>E-mail :</label>
  <input type="email" class="form-control" name="user_email" value="<?php echo $email; ?>" />
</div>
   <div class="form-group">
  <label>Password :</label>
  <input type="password" class="form-control" name="user_pass" value="<?php //echo $pass; ?>" />
</div>
  
   <div class="form-group">
   <label>User Status :</label>
   <?php $options = array('1'  => 'Active', '0'    => 'Inactive');  ?>
       <select class="form-control" name="status">
         
         <?php foreach ($options as $key=>$data){ ?>
         <option value="<?php echo $key; ?>" <?php if($key == $status) { echo "selected"; } ?>><?php echo $data; ?></option>
         <?php } ?>
     </select>

</div>
   <div class="form-group">
  <label>User Type:</label>
 <?php $useroptions = array("0" => 'Administrator', "1" => "User" );  ?>
      <select class="form-control" name="user_type">
         
         <?php foreach ($useroptions as $data){ ?>
         <option value="<?php echo $data; ?>" <?php if($data == $user_type) { echo "selected"; } ?>><?php echo $data; ?></option>
         <?php } ?>
     </select>
</div>
  
   <div class="form-group">
  <input type="submit" class="btn btn-default btn-lg btn-block" value="Submit" />
  </div>
  <?php echo form_close();?>
   <?php } else{
     echo '<h3 id="sucessmsg">Sorry! the user is not found.</h3>';
        } ?>
</div>