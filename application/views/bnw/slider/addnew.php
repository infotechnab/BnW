
<div class="rightSide">
    
<h2>Add new Slide&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="<?php echo base_url().'index.php/sliders/slider'; ?>">View All</a></h2>
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
  <?php echo form_open_multipart('sliders/addslider');?>
  <p>Title:<br />
  <input type="text" name="slide_name" value="<?php echo set_value('slide_name'); ?>" />
  </p>
   <p> Image : <br/> <input type="file" name="file_name" id="file" /> </p>
  <p>Content:<br />
  <input type="text" name="slide_content" />
  </p>
  <input type="submit" value="Submit" />
  <?php echo form_close();?>
 <p><b>Note:</b> Max file size: 500KB,  Width: 600px, Height: 200px </p>
 </div>
<div class="clear"></div>
</div>
