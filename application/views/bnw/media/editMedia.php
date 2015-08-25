<div class="rightSide">
 <?php

        if(!empty($query)){
            foreach ($query as $data){
           $id = $data->id;
           $medianame = $data->media_name;
           $mediatype = $data->media_type;
           $media_association_id = $data->media_association_id;
           $medialink= $data->media_link;
           $listOfAlbum = $this->dbalbum->get_list_of_album();     
       }
        
    ?>
    <div class="titleArea">
<h2>Edit Media/ <?php echo $medianame; ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="<?php echo base_url().'index.php/media/medias'; ?>">Library</a></h2>
  <hr class="hr-gradient"/>   
    </div> 
 
  <div id="sucessmsg">
  <?php echo $this->session->flashdata('message'); ?>
      <?php  if(isset($error))
  {
     echo $error;
  } echo validation_errors(); ?>
    </div>
  <?php echo form_open_multipart('media/updatemedia');?>
   <p class="dashuppe-text-all">Name: *<br />
       <input type="hidden" name="id" value="<?php echo $id; ?>" >
  <input type="text" class="textInput" name="media_name" value="<?php echo htmlentities($medianame); ?>" />
   </p>
    
  <p class="dashuppe-text-all">Type<br />
<input type="file" class="textInput" name="file_name" id="file"/>
<input type="hidden" class="textInput" name="prevfile" id="file" value="<?php echo $mediatype; ?>"/>
  </p>
  
  <p class="dashuppe-text-all">Select Association Id<br/>
         <select class="textInput" name="selectAlbum">
             <option value=" ">Select None</option>
                <?php
                foreach ($listOfAlbum as $data)
                {
                    ?>
                <option value="<?php echo $data->album_name; ?>" selected="<?php echo $media_association_id; ?>">
                    <?php echo $data->album_name; ?>
                </option>
                    <?php
                }
                ?>
          
            </select>
   </p>
  
  
  
  <input type="submit" class="btn btn-primary btn-lg" value="Submit" />
  <?php echo form_close();?>
  <?php } else{
     echo '<h3 id="sucessmsg">Sorry! the media is not found.</h3>';
        } ?>
</div>
<div class="clear"></div>
</div>