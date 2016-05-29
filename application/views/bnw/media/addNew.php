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
<div class=" col-md-10 col-sm-9 col-lg-10 col-xs-8 rightside">

        
<h2>Add new Media&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="<?php echo base_url().'index.php/media/medias'; ?>">View All</a></h2>
<hr class="hr-gradient"/>
<div class="alert alert-info"><b>Allowed file types:</b> jpg, jpeg, png, gif, pdf, doc, ppt, odt, pptx, docx, xls, xlsx, key, txt<br/><br/>
<b>Note:</b> For images : Max file size: 20000KB,  Width: 10000px, Height: 10000px
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
  <?php echo form_open_multipart('media/addmedia');?>
  <div class="form-group">
  <label>Name </label>
  <input type="text" class="form-control" name="media_name" value="<?php echo set_value('media_name'); ?>" />
</div>
  <div class="form-group">
  <label>Type</label>
  <input type="file" class="textInput" name="file_name" id="file" multiple />
  </div>
  <div class="form-group"> 
  <label>Select Association Id</label>
         <select class="form-control" name="selectAlbum">
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
 </div>
  <div class="form-group">

  <input type="submit" class="btn btn-default btn-lg btn-block" value="Submit" />
  </div>

  <?php echo form_close();?>
</div>
</div>