<div class=" col-md-10 col-sm-9 col-lg-10 col-xs-8 rightside">

<?php
        if($query){
           foreach ($query as $data){
           $id = $data->id;
           $title = $data->title;
           $body = $data->body;
           $status= $data->status; 
           $image = $data->image;
            }
        }
        
        if(isset($error))
        {
            
                echo $error;
            
        }
    ?>
<h2>Edit Activities id <?php echo $id ?></h2>
  <?php echo validation_errors();
   ?>
 
 
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
  <?php echo form_open_multipart('bnw/updateactivities');?>
  <p>Title:<br />
      <input type="hidden" name="id" value="<?php echo $id; ?>" />
      <input type="text" name="title" value="<?php echo htmlentities($title); ?>" />
  </p>
  <p>Body:<br />
  <textarea name="body" rows="5" cols="50" style="resize:none;"><?php echo $body; ?></textarea>
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
</div>
</div>
</div>