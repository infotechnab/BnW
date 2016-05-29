<div class=" col-md-10 col-sm-9 col-lg-10 col-xs-8 rightside">
<h2>Add new Slide&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="<?php echo base_url().'index.php/sliders/slider'; ?>">View All</a></h2>
<hr class="hr-gradient"/>
  

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
  <?php echo form_open_multipart('sliders/addslider',array('class'=>'form-horizontal'));?>
  <div class="form-group">
  <label>Title :</label>
  <input type="text" class="form-control" name="slide_name" value="<?php echo set_value('slide_name'); ?>" />
 </div>
 <div class="form-group">
   <label>Image :</label>  <span class=" glyphicon glyphicon-folder-open"></span>
<input type="file"  name="file_name" id="file" accept="image/*"/>
</div>
<div class="form-group">
  <label>Content :</label>
      <input type="text" class="form-control" name="slide_content" value="<?php echo set_value('slide_content'); ?>"/>
</div>
<div class="form-group">
   <input type="submit" class="btn btn-default btn-lg btn-block" value="Submit" />

 </div>
   <?php echo form_close();?>
</div>
