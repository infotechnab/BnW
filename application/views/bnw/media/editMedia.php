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
           $mediaascID = $data->media_association_id;
           $medialink= $data->media_link;
                 
       }
        }
    ?>
<h2>Edit Media id <?php echo $id; ?></h2>
  <?php echo validation_errors(); ?>
 
  <p id="sucessmsg">
  <?php echo $this->session->flashdata('message'); ?>
    </p>
  <?php echo form_open_multipart('bnw/updatemedia');?>
   <p>Name:<br />
       <input type="hidden" name="id" value="<?php echo $id; ?>" >
  <input type="text" name="media_name" value="<?php echo $medianame; ?>" />
   </p>
    
  <p>Type<br />
  <input type="text" name="media_type" value="<?php echo $mediatype; ?>" />
  </p>
  
  <p>Association ID<br />
  <input type="text" name="media_association_id" value="<?php echo $mediaascID ; ?>" />
  </p>
  
  <p>Link<br />
  <input type="text" name="media_link" value="<?php echo $medialink; ?>" />
  </p>
  
  <input type="submit" value="Submit" />
  <?php echo form_close();?>
</div>
<div class="clear"></div>
</div>