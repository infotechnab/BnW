<div class="rightSide">
 <h2> Add New Menu </h2>
  <?php echo validation_errors(); ?>
 
  <p id="sucessmsg">
  <?php if($this->session->flashdata('message')){echo $this->session->flashdata('message');}?>
    </p>
  <?php echo form_open_multipart('bnw/addmenu');?>
  
  
      
 <p>Menu Name:<br />
      <input type="text" name="menu_name" value="<?php echo set_value('menu_name'); ?>"  /> </p> 
 
 <input type="submit" value="Submit" />
  <?php echo form_close();?>
</div>
<div class="clear"></div>
</div>