<div class="rightSide">
 <h2> Add New Navigation </h2>
  <?php echo validation_errors(); ?>
 
  <p id="sucessmsg">
  <?php if($this->session->flashdata('message')){echo $this->session->flashdata('message');}?>
    </p>
  <?php echo form_open_multipart('bnw/addnavigation');?>
  
      
 <p>Name:<br />
      <input type="text" name="navigation_name" value="<?php echo set_value('navigation_name'); ?>"  /> </p> 
 <p>Link : <br/>
       <input type="text" name="navigation_link" value="<?php echo set_value('navigation_link'); ?>" /> </p>
  <p> Parent ID : <br/>
      <input type="text" name="parent_id" value="<?php echo set_value('parent_id'); ?>" /> </p>
 <p> Type : <br/>
      <input type="text" name="navigation_type" value="<?php echo set_value('navigation_type'); ?>" /> </p>
 <p> Slug : <br/>
       <input type="txt" name="navigation_slug" value="<?php echo set_value('navigation_slug'); ?>" /> </p>
 <p> Menu ID : <br/>
      <input type="text" name="menu_id" /> </p>
  
 
    <input type="submit" value="Submit" />
  <?php echo form_close();?>
</div>
<div class="clear"></div>
</div>