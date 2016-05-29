<div class=" col-md-10 col-sm-10 col-lg-10 col-xs-10 rightside">

 <h2> Add New Navigation </h2>
 <div id="sucessmsg">
  <?php if($this->session->flashdata('message'))
  {
    echo "<div class='alert alert-default fade in '>".$this->session->flashdata('message')."</div>"; 

  }?>
  <?php $validation_errors= validation_errors();
  if(isset($validation_errors)){
   echo "<div class='error'>".$validation_errors."</div>"; 

 }
 if(isset($error))
 {
   echo "<div class='error'>".$error."</div>"; 
 }
 ?>
</div>
  <?php echo form_open_multipart('dashboard/addnavigation');?>
  
      
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
  
 
    <input class="btn btn-default btn-block" type="submit" value="Submit" />
  <?php echo form_close();?>
</div>
<div class="clear"></div>
</div>