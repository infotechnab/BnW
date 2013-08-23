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
    ?>


<h2><?php echo $meta_data[1]; ?> Dashboard Management</h2>

<p>This page to setup domain.</p>

<?php echo form_open('bnw/setupupdate');?>
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
 <input type="submit" value="Submit" />
  <?php echo form_close();?>