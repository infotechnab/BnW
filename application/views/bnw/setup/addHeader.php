<div class=" col-md-10 col-sm-9 col-lg-10 col-xs-8 rightside">
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
    
    


<h2> Header Content Management</h2>
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
<?php echo form_open_multipart('setting/headerupdate',array('class'=>'form-horizontal'));?>
 
<div class="form-group">
  <label>Header Title</label>
  <input type="text" class="textInput form-control" name="header_title" value="<?php echo $set_data[0]; ?>" />
  <?php if((trim($set_data[1]== NULL)) || trim($set_data[1] !== ' ')){ ?>
  </div>
<div class="form-group">
  <label>Existing Header Logo</label>
  <div style="width: 125px; height: 125px;">
      <img src="<?php echo base_url().'content/uploads/images/'.$set_data[1]; ?>" style="width: 125px; height: 125px;">
  </div>
  </div>
         
 <?php } ?>
 <div class="form-group">
  <label>Header Logo</label>
  <input type="file" class="textInput" name="file_name" id="file" accept="image/*" />
  <input type="hidden" name="existingImg" value="<?php echo $set_data[1]; ?>">
</div>
<div class="form-group">

  <label>Header Description</label>
  <input type="text" class="form-control" name="header_description" value="<?php echo $set_data[2]; ?>"/>
  </div>
  <div class="form-group">
 <input type="submit" class="btn btn-default btn-lg btn-block" value="Submit" />
</div>
 <?php echo form_close();?>
 </div>
