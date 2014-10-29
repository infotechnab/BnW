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


<h2> Sidebar Content Management</h2>
<hr class="hr-gradient"/>
<div id="sucessmsg">
 <?php echo validation_errors();
  if(isset($error))
  {
      echo $error;
  }
  ?>
    </div>

<?php echo form_open('setting/sidebarupdate');?>
  <p class="dashuppe-text-all">Sidebar Title<br />
  <input type="text" class="textInput" name="sidebar_title" value="<?php echo $set_data[4]; ?>" />
  </p>
  <p class="dashuppe-text-all">Sidebar Description<br />
  <input type="text" class="textInput" name="sidebar_description" value="<?php echo $set_data[5]; ?>"/>
  </p>
  
 <input type="submit" class="btn btn-primary btn-lg" value="Submit" />
  <?php echo form_close();?>
</div>
<div class="clear"></div>
</div>