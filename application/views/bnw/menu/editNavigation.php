<div class="rightSide">
    <div id="forLeftPage"> 
 <?php
 if(isset($error))
  {
     echo $error;
  }
        if(isset($query)){
           
            foreach ($query as $navdata){
           
       }
        }
    ?>
<h2>Edit Navigation id <?php echo $navdata->id; ?></h2>
  <?php echo validation_errors(); ?>
 
  <p id="sucessmsg">
  <?php echo $this->session->flashdata('message'); ?>
    </p>
  <?php echo form_open_multipart('bnw/updatenavigation');?>
  <p>Title:<br />
      <input type="hidden" name="id" value="<?php echo $navdata->id; ?>" >
      <input type="text" name="navigation_name" value="<?php echo $navdata->navigation_name; ?>" />
  </p>
  
  <input type="submit" value="Submit" />
  <?php echo form_close();?>
  

</div></div>
<div class="clear"></div>
</div>