<div class="rightSide">
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
  <?php echo validation_errors(); ?>
 
  <p id="sucessmsg">
  <?php if($this->session->flashdata('message')){echo $this->session->flashdata('message');}?>
    </p>
  <?php echo form_open_multipart('sliders/deleteslider/?image='.$slideImage);?>
  
      <input type="hidden" name="id" value="<?php echo $id; ?>" />
      <input type="hidden" name="slide_image" value="<?php echo $slideImage; ?>" />
      
  </p>
    <input type="submit" value="Yes" />
    <?php echo anchor('bnw/slider', 'No');  ?>
  
</div>
<div class="clear"></div>
</div>

