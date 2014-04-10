<div class="rightSide">
<?php


 if(isset($photoquery)){
            foreach ($photoquery as $adata){
           $id = $adata->id;
           
           $image = $adata->media_type;
           
           var_dump($image);      
            }
        }
    ?>
   
  <?php


 if(isset($albumquery)){
            foreach ($albumquery as $data){
           $id = $data->id;
           $album_name= $data->album_name;
                 
            }
        }
    ?>
<h2>Are You Sure To Delete  <?php echo $album_name ; ?>
  <?php echo validation_errors(); ?>
 
  <p id="sucessmsg">
  <?php if($this->session->flashdata('message')){echo $this->session->flashdata('message');}?>
    </p>
  <?php echo form_open_multipart('bnw/deletealbum/?image='.$image);?>
  
      <input type="hidden" name="id" value="<?php echo $id; ?>" />
      <input type="hidden" name="" value="<?php echo $image; ?>" />
      
  </p>
    <input type="submit" value="Yes" />
    <?php echo anchor('bnw/album', 'No');  ?>
  
</div>
<div class="clear"></div>
</div>

