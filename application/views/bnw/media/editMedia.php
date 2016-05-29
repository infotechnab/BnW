<div class=" col-md-10 col-sm-9 col-lg-10 col-xs-8 rightside">

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
  <?php echo form_open_multipart('media/updatemedia');?>
<div class="form-group">
   <label>Name :</label>
       <input type="hidden" name="id" value="<?php echo $id; ?>" >
       <input type="text" class="form-control" name="media_name" value="<?php echo htmlentities($medianame); ?>" />
 </div>
<div class="form-group">
<label>Type :</label>
<input type="file" class="textInput" name="file_name" id="file"/>
<input type="hidden" class="textInput" name="prevfile" id="file" value="<?php echo $mediatype; ?>"/>
</div>
  
 <div class="form-group">
 <label>Select Association Id :</label>
         <select class="form-control" name="selectAlbum">
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
   </div>
  
  
  <div class="form-group">
  <input type="submit" class="btn btn-default btn-lg btn-block" value="Submit" />
  </div>
  <?php echo form_close();?>
  <?php } else{
     echo '<h3 id="sucessmsg">Sorry! the media is not found.</h3>';
        } ?>
</div>
</div>