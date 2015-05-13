<?php
 if(isset($error))
  {
     echo $error;
  }
        if(!empty($query)){
           
            foreach ($query as $navdata){
           
                $id = $navdata->id;
                $name = $navdata->navigation_name;
       }
        
    ?>
<div class="rightSide">
    <h2>Edit Navigation/ <?php echo $name; ?></h2>
<hr class="hr-gradient"/>
    <div id="forLeftPage"> 
 

  <?php echo validation_errors(); ?>
 
  <p id="sucessmsg">
  <?php echo $this->session->flashdata('message'); ?>
    </p>
  <?php echo form_open_multipart('dashboard/updatenavigation');?>
  <p>Title:<br />
      <input type="hidden" name="id" value="<?php echo $id; ?>" >
      <input type="text" name="navigation_name" value="<?php echo $name; ?>" />
  </p>
  
  <input type="submit" value="Submit" />
  <?php echo form_close();?>
  

</div></div>
<div class="clear"></div>
</div>
<?php }
else{
    echo 'page not found';
}?>