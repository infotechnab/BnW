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
 <?php echo validation_errors();
  if(isset($error))
  {
      echo $error;
  }
  ?>

    


<h2> Header Content Management</h2>
<hr class="hr-gradient"/>
<?php echo form_open_multipart('bnw/headerupdate');?>
 

    <p>Header Title :<br />
  <input type="text" name="header_title" value="<?php echo $set_data[0]; ?>" />
  </p>
  <?php if((trim($set_data[1]== NULL)) || trim($set_data[1] !== ' ')){ ?>
  
  <p>Existing Header Logo : <br/>
  <div style="width: 125px; height: 125px;">
      <img src="<?php echo base_url().'content/uploads/images/'.$set_data[1]; ?>" style="width: 125px; height: 125px;">
  </div>
      
      </p>       
 <?php } ?>
  <p>Header Logo :<br />
  <input type="file" name="file_name" id="file" />
  </p>
  <p>Header Description :<br />
  <input type="text" name="header_description" value="<?php echo $set_data[2]; ?>"/>
  </p>
  <p>Header Background Color :<br />
  <input type="color" class="color" name="header_bgcolor" value="<?php echo $set_data[3]; ?>"/>
  </p>
 <input type="submit" value="Submit" />
  <?php echo form_close();?>
</div>
<div class="clear"></div>
</div>