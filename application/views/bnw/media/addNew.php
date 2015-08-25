<style>
    .alert {
padding: 8px 35px 8px 14px;
margin-bottom: 18px;
color: #c09853;
text-shadow: 0 1px 0 rgba(255, 255, 255, 0.5);
background-color: #efefef;
border: 1px solid #fbeed5;
-webkit-border-radius: 4px;
-moz-border-radius: 4px;
border-radius: 4px;
}

.alert-heading {
color: inherit;
}

.alert .close {
position: relative;
top: -2px;
right: -21px;
line-height: 18px;
}
.alert-info {
color: #333;
border-color: #555;
}
    </style>
    <div class="rightSide">
        
<h2>Add new Media&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="<?php echo base_url().'index.php/media/medias'; ?>">View All</a></h2>
<hr class="hr-gradient"/>
<div class="alert alert-info"><b>Allowed file types:</b> jpg, jpeg, png, gif, pdf, doc, ppt, odt, pptx, docx, xls, xlsx, key, txt<br/><br/>
<b>Note:</b> For images : Max file size: 20000KB,  Width: 10000px, Height: 10000px
</div>
<div id="sucessmsg">
  <?php if($this->session->flashdata('message')){echo $this->session->flashdata('message');}?>
    <?php echo validation_errors();
  if(isset($error))
  {
      echo $error;
  }
  ?>
</div>
  <?php echo form_open_multipart('media/addmedia');?>
  
  <p class="dashuppe-text-all">Name *<br />
  <input type="text" class="textInput" name="media_name" value="<?php echo set_value('media_name'); ?>" />
  </p>
  
  <p class="dashuppe-text-all">Type<br />
      <input type="file" class="textInput" name="file_name" id="file" multiple />
  
  </p>
  
  <p class="dashuppe-text-all">Select Association Id<br/>
         <select class="textInput" name="selectAlbum">
             <option value="selectNone">Select None</option>
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