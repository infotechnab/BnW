<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
 if(isset($query)){
            foreach ($query as $data){
           $sid = $data->sid;
           $title = $data->title;
           $image = $data->image;
                 
            }
        }
    ?>
<h2>Edit Slider id <?php echo $sid; ?></h2>
  <?php echo validation_errors(); ?>
 
  <p id="sucessmsg">
  <?php if($this->session->flashdata('message')){echo $this->session->flashdata('message');}?>
    </p>
  <?php echo form_open_multipart('admin/updateslider');?>
  <p>Title:<br />
      <input type="hidden" name="id" value="<?php echo $sid; ?>" />
      <input type="text" name="title" value="<?php echo $title; ?>" />
  </p>
  <p> Image : <br/> <input type="file" name="userfile"/> </p>
    <input type="submit" value="Submit" />
  <?php echo form_close();?>
<p><b>Note:</b> Max file size: 500KB,  Width: 596px, Height: 220px </p>

