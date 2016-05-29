<div class=" col-md-10 col-sm-9 col-lg-10 col-xs-8 rightside">


<?php


 if(isset($photoquery))
                 
            
        
    ?>
   
  <?php


 if(isset($albumquery)){
            foreach ($albumquery as $data){
           $aid = $data->id;
           $album_name= $data->album_name;
                 
            }
        }
    ?>
<h2>Are You Sure To Delete  <?php echo $album_name ; ?></h2>
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
  <?php echo form_open_multipart('album/delete_album/'.$aid);?>
  
      <input type="hidden" name="id" value="<?php echo $aid; ?>" />
      
      

    <input type="submit" value="Yes" />
    <?php echo anchor('album/addalbum', 'No');  ?>
  
</div>

</div>
</div>


