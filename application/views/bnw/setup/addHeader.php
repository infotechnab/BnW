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

<?php echo form_open_multipart('bnw/headerupdate');?>
 <p>Favicon Iamge :<br />
<!--  <input type="file" name="favicone_name" id="fvicon"  />-->
  </p>

    <p>Header Title :<br />
  <input type="text" name="header_title" value="<?php echo $set_data[0]; ?>" />
  </p>
  
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