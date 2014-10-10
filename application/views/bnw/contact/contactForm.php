<div class="rightSide">
<h2>Contact&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="<?php echo base_url().'index.php/album/media'; ?>">View</a></h2>
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
  <?php echo form_open_multipart('contact/addContact');?>
  
  <p>Name of Organization:<br />
  <input type="text" name="title" value="<?php echo set_value('media_name'); ?>" />
  </p>
  <p>Address 1(Street):<br />
  <input type="text" name="street" value="<?php echo set_value('media_name'); ?>" />
  </p>
  <p>Address 2(City):<br />
  <input type="text" name="city" value="<?php echo set_value('media_name'); ?>" />
  </p>
  <p>District:<br />
  <input type="text" name="district" value="<?php echo set_value('media_name'); ?>" />
  </p>
  <p>Country:<br />
  <input type="text" name="country" value="<?php echo set_value('media_name'); ?>" />
  </p>
  <p>Contact No.(Primary):<br />
  <input type="text" name="contact1" value="<?php echo set_value('media_name'); ?>" />
  </p>
  <p>Contact No.(Secondary):<br />
  <input type="text" name="contact2" value="<?php echo set_value('media_name'); ?>" />
  </p>
  <p>Email:<br />
  <input type="email" name="email" value="<?php echo set_value('media_name'); ?>" />
  </p>
  <input type="checkbox" value="showForm">Show Contact Form.<br/><br/>
  <input type="checkbox" value="showMap">Show Location Map.<br/><br/>
  
  
 
  
  
  <input type="submit" value="Submit" />
  <?php echo form_close();?>
</div>
<div class="clear"></div>
</div>