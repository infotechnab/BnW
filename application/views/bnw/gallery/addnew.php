<div class=" col-md-10 col-sm-9 col-lg-10 col-xs-8 rightside">


<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
?>
  <h2>Add New Photo </h2>
 
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
  <?php echo form_open_multipart('bnw/addphoto');?>
  <div class="form-group">
  <label>Title</label>

  <input type="text" class="form-control" name="title" />
</div>
<div class="form-group">
<lable>upload file</lable>
<input type="file" class="btn btn-default" name="userfile" size="20" />
</div>
  <input class="btn btn-default btn-lg btn-block" type="submit" value="Submit" />
  <?php echo form_close();?>

   <p><b>Note:</b> Max file size: 500KB, Max Width: 1024px, Max Height: 768px </p>  
</div>
<div class="clear"></div>
</div>