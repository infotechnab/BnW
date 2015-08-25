<div class="rightSide">
<?php 
if ($query)
    
{
    $i=0;
    foreach ($query as $data)
    {        
       $set_data[$i] = $data->description;
       $i++;      
    }
 }
 ?>
    
    


<h2> Header Content Management</h2>
<hr class="hr-gradient"/>
<div id="sucessmsg">
 <?php echo validation_errors();
 echo $this->session->flashdata("message");
  if(isset($error))
  {
      echo $error;
  }
  ?>
    </div>
<?php echo form_open_multipart('setting/headerupdate');?>
 

    <p class="dashuppe-text-all">Header Title *<br />
  <input type="text" class="textInput" name="header_title" value="<?php echo $set_data[0]; ?>" />
  </p>
  <?php if((trim($set_data[1]== NULL)) || trim($set_data[1] !== ' ')){ ?>
  
  <p class="dashuppe-text-all">Existing Header Logo<br/>
  <div style="width: 125px; height: 125px;">
      <img src="<?php echo base_url().'content/uploads/images/'.$set_data[1]; ?>" style="width: 125px; height: 125px;">
  </div>
      
      </p>       
 <?php } ?>
  <p class="dashuppe-text-all">Header Logo<br />
  <input type="file" class="textInput" name="file_name" id="file" accept="image/*" />
  <input type="hidden" name="existingImg" value="<?php echo $set_data[1]; ?>">
  </p>
  <p class="dashuppe-text-all">Header Description<br />
  <input type="text" class="textInput" name="header_description" value="<?php echo $set_data[2]; ?>"/>
  </p>
  
 <input type="submit" class="btn btn-primary btn-lg" value="Submit" />
  <?php echo form_close();?>
</div>
<div class="clear"></div>
</div>