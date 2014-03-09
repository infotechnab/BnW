<div class="rightSide">  
<h2>Change Header Content</h2>
  <?php echo validation_errors();
  if(isset($error))
  {
      echo $error;
  }
  ?>
<p id="sucessmsg">
  <?php if($this->session->flashdata('message')){echo $this->session->flashdata('message');}?>
</p>
  <?php echo form_open_multipart('bnw/addHeader');?>
  
  <p>Header Title:<br />
  <input type="text" name="title" value="<?php echo set_value('title'); ?>" />
  </p>
  <p>Header Body:<br />
      <textarea name="content" id="area1" cols="50" rows="5" ><?php echo set_value('content'); ?></textarea>
  </p>  
  <p>Choose Header Colour:<br/> <input type="color" name="favouriteColor" class="color" />
      
  </p>
  
  <input type="submit" value="Submit" />
  <?php echo form_close();?>
</div>
<div class="clear"></div>
</div>