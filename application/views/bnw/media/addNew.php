<div class="rightSide">
<h2>Add new Media</h2>
  <?php echo validation_errors();
  if(isset($error))
  {
      echo $error;
  }
  ?>
<p id="sucessmsg">
  <?php if($this->session->flashdata('message')){echo $this->session->flashdata('message');}?>
</p>
  <?php echo form_open_multipart('bnw/addmedia');?>
  
  <p>Name:<br />
  <input type="text" name="media_name" value="<?php echo set_value('media_name'); ?>" />
  </p>
  
  <p>Type<br />
  <input type="file" name="file_name" id="file" />
  
  </p>
  
  <p>Select Association Id:<br/>
         <select name="selectAlbum">
                <?php
                foreach ($listOfAlbum as $data)
                {
                    ?>
                <option value="<?php echo $data->album_name; ?>">
                    <?php echo $data->album_name; ?>
                </option>
                    <?php
                }
                ?>
          
            </select>
   </p>
  
  <p>Link<br />
  <input type="text" name="media_link" value="<?php echo set_value('media_link'); ?>" />
  </p>
  
  <input type="submit" value="Submit" />
  <?php echo form_close();?>
</div>
<div class="clear"></div>
</div>