
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
  <p class="dashuppe-text-all">Title *<br />
  <input type="text" class="textInput" name="slide_name" value="<?php echo set_value('slide_name'); ?>" />
  </p>
   <p class="dashuppe-text-all">Image<br/> <input type="file" class="textInput" name="file_name" id="file" accept="image/*"/> </p>
  <p class="dashuppe-text-all">Content<br />
      <input type="text" class="textInput" name="slide_content" value="<?php echo set_value('slide_content'); ?>"/>
  </p>
  <input type="submit" class="btn btn-primary btn-lg" value="Submit" />
  <?php echo form_close();?>
 <!--<p><b>Note:</b> Max file size: 500KB,  Width: 600px, Height: 200px </p>-->
 </div>
<div class="clear"></div>
</div>
