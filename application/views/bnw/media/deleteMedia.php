<div class="rightSide">
<?php


 if(isset($query)){
            foreach ($query as $data){
           $id = $data->id;
           $medianame = $data->media_name;
           $mediaImage = $data->media_type;
           
                 
            }
        }
    ?>
  
<h2>Are You Sure To Delete Media <?php echo $medianame; ?>
  <?php echo validation_errors(); ?>
 
  <p id="sucessmsg">
  <?php if($this->session->flashdata('message')){echo $this->session->flashdata('message');}?>
    </p>
  <?php echo form_open_multipart('album/deletemedia/?image='.$mediaImage);?>
  
      <input type="hidden" name="id" value="<?php echo $id; ?>" />
      <input type="hidden" name="slide_image" value="<?php echo $mediaImage; ?>" />
      
  </p>
    <input type="submit" value="Yes" />
    <?php echo anchor('album/media', 'No');  ?>
  
</div>
<div class="clear"></div>
</div>

