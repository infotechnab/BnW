<div class="rightSide">
<?php


 if(isset($photoquery))
                 
            
        
    ?>
   
  <?php


 if(isset($albumquery)){
            foreach ($albumquery as $data){
           $aid = $data->id;
           $album_name= $data->album_name;
                 
            }
        }
    ?>
<h2>Are You Sure To Delete  <?php echo $album_name ; ?>
  <?php echo validation_errors(); ?>
 
  <p id="sucessmsg">
   <?php if($this->session->flashdata('message'))
            {
            echo "<div class='alert alert-default fade in '><strong>".$this->session->flashdata('message')."</strong></div>"; 

            }?>
    </p>
  <?php echo form_open_multipart('album/delete_album/'.$aid);?>
  
      <input type="hidden" name="id" value="<?php echo $aid; ?>" />
      
      

    <input type="submit" value="Yes" />
    <?php echo anchor('album/addalbum', 'No');  ?>
  
</div>
<div class="clear"></div>
</div>

