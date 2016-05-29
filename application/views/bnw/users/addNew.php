<div class=" col-md-10 col-sm-10 col-lg-10 col-xs-10 rightSide">
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
<style>
.form-control{

  width:50%;
}
</style>
  <?php echo form_open_multipart('user/adduser');?>
  <div class="form-group">
  <label>Name</label>
      <input type="text" class="form-control" required="" name="user_name" value="<?php echo set_value('user_name'); ?>" />
  </div>
  
  <div class="form-group">
  <label>First Name </label>
      <input type="text" class="form-control" required="" name="user_fname" value="<?php echo set_value('user_fname'); ?>" />
  </div>
  
  <div class="form-group">
  <label>Last Name </label>
      <input type="text" class="form-control" required="" name="user_lname" value="<?php echo set_value('user_lname'); ?>" />
  </div>
  
  <div class="form-group">
  <label>E-mail </label>
      <input type="email" class="form-control" required="" name="user_email" value="<?php echo set_value('user_email'); ?>" />
  </div>
  
  <div class="form-group">
  <label>Password </label>
      <input type="password" class="form-control" required="" name="user_pass" value="<?php echo set_value('user_pass'); ?>" />
  </div>
  <div class="form-group">
   <label>User Status</label>
  <?php $options = array('1'  => 'Active', '0'    => 'Inactive');  ?>
       <select class="form-control" name="status">
         
         <?php foreach ($options as $key => $data){ ?>
         <option value="<?php echo $key; ?>"><?php echo $data; ?></option>
         <?php } ?>
     </select>
  </div>
  <div class="form-group">
  <label>User Type</label>
  <?php $useroptions = array("0" => 'Administrator', "1" => "User" );  ?>
      <select class="form-control" name="user_type">
         
         <?php foreach ($useroptions as $data){ ?>
         <option value="<?php echo $data; ?>"><?php echo $data; ?></option>
         <?php } ?>
     </select>
  </div>
  <div class="form-group">
  <input type="submit" class="btn btn-default btn-lg  btn-block" value="Submit" />
  </div>
  <?php echo form_close();?>
</div>
</div>