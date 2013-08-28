 <?php
 if(isset($error))
  {
     echo $error;
  }
        if(isset($query)){
            foreach ($query as $data){
           $id = $data->id;
           $title = $data->title;
           $body = $data->body;
           $image = $data->image;
           $status= $data->status;
       }
        }
    ?>
<h2>Edit Page id <?php echo $id; ?></h2>
  <?php echo validation_errors(); ?>
 
  <p id="sucessmsg">
  <?php if($this->session->flashdata('message')){echo $this->session->flashdata('message');}?>
    </p>
  <?php echo form_open_multipart('bnw/update');?>
  <p>Title:<br />
      <input type="hidden" name="id" value="<?php echo $id; ?>" />
      <input type="text" name="title" value="<?php echo $title; ?>" />
  </p>
  <p>Body:<br />
  <textarea name="area1" rows="5" cols="50" style="resize:none;"><?php echo $body; ?></textarea>
  </p>
  <?php if($image !=="")
  {?>  
  <p>Present image : <br/>
  <div >
      <img src="<?php echo base_url(); ?>uploads/<?php echo $data->image; ?>" width="250px" height="150px" /> 
      <a href="<?php echo base_url();?>index.php/bnw/delete_page_image/<?php echo $id; ?>">
        <img src="<?php echo base_url();?>content/images/delete.png" width="20px" height="20px"/></a>
  </div>
  <?php }?>
  <p> Image : <br/> <input type="file" name="file"/> </p>
    
   <p>Status:<br />
  <?php 
  $options = array(
                  '1'  => 'publish',
                  '0'    => 'draft');
  echo form_dropdown('status',$options,$status)
  ?>
  </p>
  <input type="submit" value="Submit" />
  <?php echo form_close();?>
<p><b>Note:</b> Max file size: 500KB, Max Width: 1024px, Max Height: 768px </p>