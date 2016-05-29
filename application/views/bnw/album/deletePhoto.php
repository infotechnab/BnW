<div class=" col-md-10 col-sm-9 col-lg-10 col-xs-8 rightside">


<?php


 if(isset($query)){
            foreach ($query as $data){
           $id = $data->id;
           $name= $data->media_name;
           $image = $data->media_type;
           
                 
            }
        }
    ?>
  
<h2>Are You Sure To Delete  <?php echo $name ; ?></h2>
  <?php echo validation_errors(); ?>
 
 
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
  <?php echo form_open_multipart('album/deletephoto/?image='.$image);?>
  
      <input type="hidden" name="id" value="<?php echo $id; ?>" />
      <input type="hidden" name="slide_image" value="<?php echo $image; ?>" />
      
  
    <input type="submit" value="Yes" />
    <?php echo form_close(); ?>
    
    <?php echo anchor('album/addalbum', '<button>No</button>');  ?>
  
</div>

</div>
</div>
