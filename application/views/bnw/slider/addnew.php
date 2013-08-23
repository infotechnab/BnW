<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
?>
<h2>Add new Slider</h2>
  <?php echo validation_errors();
  if(isset($error))
  {
      echo $error;
  }
  ?>

<p id="sucessmsg">
  <?php if($this->session->flashdata('message')){echo $this->session->flashdata('message');}?>
</p>
  <?php echo form_open_multipart('bnw/addslider');?>
  <p>Title:<br />
  <input type="text" name="title" />
  </p>
   <p> Image : <br/> <input type="file" name="file" id="file" /> </p>
  
  <input type="submit" value="Submit" />
  <?php echo form_close();?>
 <p><b>Note:</b> Max file size: 500KB,  Width: 596px, Height: 220px </p>
