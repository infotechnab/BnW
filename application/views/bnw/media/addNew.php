<div class="rightSide">
<h2>Add new Media&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="<?php echo base_url().'index.php/album/media'; ?>">View All</a></h2>
<hr class="hr-gradient"/>
<p>Allowed file types: jpg, jpeg, png, gif, pdf, doc, ppt, odt, pptx, docx, xls, xlsx, key</p>
  <p><b>Note:</b>For images : Max file size: 2000KB,  Width: 1024px, Height: 768px </p>
<div id="sucessmsg">
  <?php if($this->session->flashdata('message')){echo $this->session->flashdata('message');}?>
    <?php echo validation_errors();
  if(isset($error))
  {
      echo $error;
  }
  ?>
</div>
  <?php echo form_open_multipart('album/addmedia');?>
  
  <p class="dashuppe-text-all">Name<br />
  <input type="text" class="textInput" name="media_name" value="<?php echo set_value('media_name'); ?>" />
  </p>
  
  <p class="dashuppe-text-all">Type<br />
  <input type="file" class="textInput" name="file_name" id="file" />
  
  </p>
  
  <p class="dashuppe-text-all">Select Association Id<br/>
         <select class="textInput" name="selectAlbum">
             <option value=" ">Select None</option>
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
  
  
  <input type="submit" class="btn btn-primary btn-lg" value="Submit" />
  <?php echo form_close();?>
</div>
<div class="clear"></div>
</div>