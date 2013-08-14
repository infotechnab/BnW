<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
?>

 <?php
        if($query){
           foreach ($query as $data){
           $aid = $data->aid;
           $title = $data->title;
           $body = $data->body;
           $status= $data->status;            
            }
        }
        
        if(isset($error))
        {
            
                echo $error;
            
        }
    ?>
<h2>Edit Activities id <?php echo $aid ?></h2>
  <?php echo validation_errors();
   ?>
 
  <p id="sucessmsg">
  <?php if($this->session->flashdata('message')){echo $this->session->flashdata('message');}?>
    </p>
  <?php echo form_open_multipart('admin/updateactivities');?>
  <p>Title:<br />
      <input type="hidden" name="id" value="<?php echo $aid; ?>" />
      <input type="text" name="title" value="<?php echo $title; ?>" />
  </p>
  <p>Body:<br />
  <textarea name="body" rows="5" cols="50" style="resize:none;"><?php echo $body; ?></textarea>
  </p>
  <p>Image(315px, 100px): <br />
    <input type="file" name="file" size="20" />
   
   <p>Status:<br />
  <?php 
  $options = array(
                  '1'  => 'publish',
                  '0'    => 'draft');
  echo form_dropdown('status',$options,$status)
  ?>
  </p>
  <input type="submit" value="Submit" />
  <?php echo form_close(); ?>
 <p><b>Note:</b> Max file size: 500KB, Max Width: 1024px, Max Height: 768px </p>  