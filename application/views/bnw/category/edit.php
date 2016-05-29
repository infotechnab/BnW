
<div class=" col-md-10 col-sm-9 col-lg-10 col-xs-8 rightside">
 
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
 <hr class="hr-gradient"/>
   

<div id="sucessmsg">
  <?php if($this->session->flashdata('message'))
            {
            echo "<div class='alert alert-default fade in '>".$this->session->flashdata('message')."</div>"; 

            }?>
    <?php $validation_errors= validation_errors();
    if(isset($validation_errors)){
     echo "<div class='error'>".$validation_errors."</div>"; 

    }
  if(isset($error))
  {
         echo "<div class='error'>".$error."</div>"; 
       }
  ?>
</div>

  <?php echo form_open_multipart('dashboard/updatecategory');?>
  <div class="form-group">
  <label>Name</label>
       <input type="hidden" name="id" value="<?php echo $id; ?>" >
  <input type="text" class="form-control"  name="category_name" value="<?php echo htmlentities($categoryname); ?>" />
 </div>
 <div class="form-group">
 <input type="submit" class="btn btn-default btn-lg btn-block" value="Submit" />
 </div>
  <?php echo form_close();
        }
        else{
            echo "<b> Category Not Found!</b> ";
        }?>


</div>
