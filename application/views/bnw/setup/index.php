<div class="rightSide">
<?php 
if ($meta)
{
    $i=0;
    foreach ($meta as $data)
    {        
       $meta_data[$i] = $data->value;
       $i++;      
    }
 }
    ?>


<h2><?php echo $meta_data[1]; ?> Dashboard Management</h2>
<hr class="hr-gradient"/>
<div id="sucessmsg">
    
    <?php
        echo $this->session->flashdata("message");
     echo validation_errors();
 if(isset($error)){
     echo $error;
 }
    ?>
</div>

<?php echo form_open_multipart('setting/setupupdate');?>
  <p class="dashuppe-text-all">Site Url *<br />
  <input type="text" class="textInput" name="url" value="<?php echo $meta_data[0]; ?>" />
  </p>
  <p class="dashuppe-text-all">Title *<br />
  <input type="text" class="textInput" name="title" value="<?php echo $meta_data[1]; ?>"/>
  </p>
  <p class="dashuppe-text-all">Keyword *<br />
  <input type="text" class="textInput" name="keyword" value="<?php echo $meta_data[2]; ?>"/>
  </p>
  <p class="dashuppe-text-all">Description *<br />
  <input type="text" class="textInput" name="description" value="<?php echo $meta_data[3]; ?>"/>
  </p>
  
  <?php if((trim($meta_data[4]== NULL)) || trim($meta_data[4] !== ' ')){ ?>
  
  <p class="dashuppe-text-all">Favicon Image<br/>
  <div style="width: 70px; height: 70px;">
      <img src="<?php echo base_url().'content/uploads/images/'.$meta_data[4]; ?>" >
  </div>
      <a href="<?php echo base_url();?>index.php/setting/deletefavicone/<?php echo $meta_data[4]; ?> " id="<?php echo $meta_data[4]; ?>" class="delbutton">
        <img src="<?php echo base_url();?>content/bnw/images/delete.png" id="close"/>
      </a>
      </p>       
 <?php } ?>
  
  <input type="hidden" value="<?php echo $meta_data[4]; ?>" name="faviconeName" />
  <p class="dashuppe-text-all">Favicon Icon<br/>
  <input type="file" class="textInput" name="file_name" id="file" /></p>
 <input type="submit" class="btn btn-primary btn-lg" value="Submit" />
  <?php echo form_close();?>
 <p><b>Note:</b> Max file size: 500KB,  Width: 100px, Height: 100px</p>
</div>

<div class="clear"></div>
</div>