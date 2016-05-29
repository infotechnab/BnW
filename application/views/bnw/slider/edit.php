<div class=" col-md-10 col-sm-9 col-lg-10 col-xs-8 rightside">


<?php


 if(!empty($query)){
            foreach ($query as $data){
           $id = $data->id;
           $slidename = $data->slide_name;
           $slideImage = $data->slide_image;
           $slidecontent = $data->slide_content;
                 
            }
        
    ?>
<h2>Edit Slide/ <?php echo $slidename; ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="<?php echo base_url().'index.php/sliders/slider'; ?>">View All</a></h2>
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
  
  <?php echo form_open_multipart('sliders/updateslider');?>
  <div class="form-group">
  <label>Title</label>

      <input type="hidden" name="id" value="<?php echo $id; ?>" />
      <input type="text" class="form-control" name="slide_name" value="<?php echo htmlentities($slidename); ?>" />
  </div>
  
  <?php if((trim($slideImage== NULL)) || trim($slideImage !== ' ')){ ?>
  <div class="form-group">
  <label>Existing Slide Image</label>
  <div style="max-width: 150px; max-height: 150px;">
      <img src="<?php echo base_url().'content/uploads/sliderImages/'.$slideImage ?>" style="max-width: 150px; max-height: 150px;">
  </div>
  <?php } ?>
  </div>
  <div class="form-group">
  <label>Image</label>
   <input type="file" class="btn btn-default" name="file_name" id="file" accept="image/*"/><input type="hidden" name="prevImg" value="<?php echo $slideImage; ?>"> </p>
  </div>
  <div class="form-group">
  <label>Content</label>
   <input type="text" class="form-control" name="slide_content" value="<?php echo $slidecontent; ?>" />
  </div>
    <input type="submit" class="btn btn-default btn-lg btn-block" value="Submit" />
  <?php echo form_close();?>
<p><b>Note:</b> Max file size: 2000KB,  Width: 2000px, Height: 2000px </p>
 <?php } else{
     echo '<h3 id="sucessmsg">Sorry! the slide is not found.</h3>';
        } ?>
</div>
<div class="clear"></div>
</div>

