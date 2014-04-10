<div class="rightSide">
<?php


 if(isset($query)){
            foreach ($query as $data){
           $id = $data->id;
           $name= $data->media_name;
           $image = $data->media_type;
           
                 
            }
        }
    ?>
  
<h2>Are You Sure To Delete  <?php echo $name ; ?>
  <?php echo validation_errors(); ?>
 
  <p id="sucessmsg">
  <?php if($this->session->flashdata('message')){echo $this->session->flashdata('message');}?>
    </p>
  <?php echo form_open_multipart('bnw/deletephoto/?image='.$image);?>
  
      <input type="hidden" name="id" value="<?php echo $id; ?>" />
      <input type="hidden" name="slide_image" value="<?php echo $image; ?>" />
      
  </p>
    <input type="submit" value="Yes" />
    <?php echo anchor('bnw/album', 'No');  ?>
  
</div>
<div class="clear"></div>
</div>

