<div class="rightSide">
<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
?>
  <h2>Add New Photo </h2>
  <?php echo validation_errors();
    echo $error;  
  ?>
  <?php if($this->session->flashdata('message'))
            {
            echo "<div class='alert alert-default fade in '><strong>".$this->session->flashdata('message')."</strong></div>"; 

            }?>
  <?php echo form_open_multipart('bnw/addphoto');?>
  <p>Title: *<br />
  <input type="text" name="title" />
  </p>
<input type="file" name="userfile" size="20" />
<br /><br />

  <input class="btn btn-default" type="submit" value="Submit" />
  <?php echo form_close();?>

   <p><b>Note:</b> Max file size: 500KB, Max Width: 1024px, Max Height: 768px </p>  
</div>
<div class="clear"></div>
</div>