<div class="rightSide">
 <?php
 if(isset($error))
  {
     echo $error;
  }
        if(isset($query)){
            foreach ($query as $data){
           $id = $data->id;
           $medianame = $data->media_name;
           $mediatype = $data->media_type;
           $media_association_id = $data->media_association_id;
           $medialink= $data->media_link;
           $listOfAlbum = $this->dbalbum->get_list_of_album();     
       }
        }
    ?>
<h2>Edit Media/ <?php echo $medianame; ?></h2>
  <?php echo validation_errors(); ?>
 
  <p id="sucessmsg">
  <?php echo $this->session->flashdata('message'); ?>
    </p>
  <?php echo form_open_multipart('album/updatemedia');?>
   <p>Name:<br />
       <input type="hidden" name="id" value="<?php echo $id; ?>" >
  <input type="text" name="media_name" value="<?php echo $medianame; ?>" />
   </p>
    
  <p>Type<br />
<input type="file" name="file_name" id="file"/>
  </p>
  
  <p>Select Association Id:<br/>
         <select name="selectAlbum">
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
  
  
  
  <input type="submit" value="Submit" />
  <?php echo form_close();?>
</div>
<div class="clear"></div>
</div>