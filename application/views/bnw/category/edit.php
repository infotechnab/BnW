
<div class="rightSide">
 <?php
 if(isset($error))
  {
     echo $error;
  }
        if(isset($query)){
            foreach ($query as $data){
           $id = $data->id;
           $categoryname=$data->category_name;
           
       }
        }
        if(isset($categoryname)){
    ?>
    <h2>Edit Category/ <?php echo $categoryname;  ?></h2>
  <?php echo validation_errors(); ?>
 <hr class="hr-gradient"/>
  <p id="sucessmsg">
  <?php echo $this->session->flashdata('message'); ?>
    </p>
  <?php echo form_open_multipart('dashboard/updatecategory');?>
  <p>Name:<br />
       <input type="hidden" name="id" value="<?php echo $id; ?>" >
  <input type="text" name="category_name" value="<?php echo $categoryname; ?>" />
   </p>
 <input type="submit" value="Submit" />
  <?php echo form_close();
        }
        else{
            echo "<b> Category Not Found!</b> ";
        }?>


</div>
<div class="clear"></div>
</div>