<div class="rightSide">
<?php


 if(isset($query)){
            foreach ($query as $data){
           $id = $data->id;
                 
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

<?php echo form_open('bnw/headertest');?>
  
  <p>Header Logo :<br />
      <input type="hidden" name="id" value="<?php echo $id; ?>" />
  <input type="file" name="file_name" id="file"  />
  </p>

 <input type="submit" value="Submit" />
  <?php echo form_close();?>
</div>
<div class="clear"></div>
</div>