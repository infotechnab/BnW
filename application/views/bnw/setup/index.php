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
 echo validation_errors();
 if(isset($error)){
     echo $error;
 }
    ?>


<h2><?php echo $meta_data[1]; ?> Dashboard Management</h2>
<hr class="hr-gradient"/>

<?php echo form_open_multipart('bnw/setupupdate');?>
  <p>Site Url :<br />
  <input type="text" name="url" value="<?php echo $meta_data[0]; ?>" />
  </p>
  <p>Title :<br />
  <input type="text" name="title" value="<?php echo $meta_data[1]; ?>"/>
  </p>
  <p>Keyword :<br />
  <input type="text" name="keyword" value="<?php echo $meta_data[2]; ?>"/>
  </p>
  <p>Description :<br />
  <input type="text" name="description" value="<?php echo $meta_data[3]; ?>"/>
  </p>
  
  <?php if((trim($meta_data[4]== NULL)) || trim($meta_data[4] !== ' ')){ ?>
  
  <p>Favicon Image : <br/>
  <div style="width: 70px; height: 70px;">
      <img src="<?php echo base_url().'content/uploads/images/'.$meta_data[4]; ?>" >
  </div>
      <a href="<?php echo base_url();?>index.php/bnw/deletefavicone/<?php echo $meta_data[4]; ?> " id="<?php echo $meta_data[4]; ?>" class="delbutton">
        <img src="<?php echo base_url();?>content/bnw/images/delete.png" id="close"/>
      </a>
      </p>       
 <?php } ?>
  
  <input type="hidden" value="<?php echo $meta_data[4]; ?>" name="faviconeName" />
  <p> Favicon Icon : <br/>
  <input type="file" name="file_name" id="file" /></p>
 <input type="submit" value="Submit" />
  <?php echo form_close();?>
 <p><b>Note:</b> Max file size: 500KB,  Width: 100px, Height: 100px</p>
</div>

<div class="clear"></div>
</div>