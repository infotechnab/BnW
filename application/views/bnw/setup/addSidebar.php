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
 echo validation_errors();
    ?>


<h2> Sidebar Content Management</h2>
<hr class="hr-gradient"/>

<?php echo form_open('setting/sidebarupdate');?>
  <p>Sidebar Title :<br />
  <input type="text" name="sidebar_title" value="<?php echo $set_data[4]; ?>" />
  </p>
  <p>Sidebar Description :<br />
  <input type="text" name="sidebar_description" value="<?php echo $set_data[5]; ?>"/>
  </p>
  <p>Sidebar Background Color :<br />
  <input type="color" class="color" name="sidebar_bgcolor" value="<?php echo $set_data[6]; ?>"/>
  </p>
 <input type="submit" value="Submit" />
  <?php echo form_close();?>
</div>
<div class="clear"></div>
</div>