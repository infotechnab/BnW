<div class=" col-md-10 col-sm-9 col-lg-10 col-xs-8 rightside">


<?php


 if(isset($query)){
            foreach ($query as $data){
           $id = $data->id;
           $slidename = $data->slide_name;
           $slideImage = $data->slide_image;
           $slidecontent = $data->slide_content;
                 
            }
        }
    ?>
  
<h2>Are You Sure To Delete Slide image <?php echo $slidename; ?>

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
  <?php echo form_open_multipart('sliders/deleteslider/?image='.$slideImage);?>
  
      <input type="hidden" name="id" value="<?php echo $id; ?>" />
      <input type="hidden" name="slide_image" value="<?php echo $slideImage; ?>" />
      
  </p>
    <input type="submit" value="Yes" />
    <?php echo anchor('sliders/slider', 'No');  ?>
  
</div>
<div class="clear"></div>
</div>

