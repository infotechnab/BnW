<div class=" col-md-10 col-sm-9 col-lg-10 col-xs-8 rightside">

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
    ?>


<h2><?php echo $meta_data[1]; ?> Dashboard Management</h2>
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

<?php echo form_open_multipart('setting/setupupdate',array('class'=>'form-horizontal'));?>
<div class="form-group">
<label>Site Url</label>
  <input type="text" class="form-control" name="url" value="<?php echo $meta_data[0]; ?>" />
  </div>
<div class="form-group">
<label>Title</label>

  <input type="text" class="form-control" name="title" value="<?php echo $meta_data[1]; ?>"/>
</div>
<div class="form-group"> 
<label>Keyword</label>
  <input type="text" class="form-control" name="keyword" value="<?php echo $meta_data[2]; ?>"/>
</div>

<div class="form-group">
<label>Description</label>
  <input type="text" class="form-control" name="description" value="<?php echo $meta_data[3]; ?>"/>
</div>

  <div class="form-group">
  <?php if((trim($meta_data[4]== NULL)) || trim($meta_data[4] !== ' '))
  { ?>

  <label>Favicon Image</label>
  <div style="width: 70px; height: 70px;">
      <img src="<?php echo base_url().'content/uploads/images/'.$meta_data[4]; ?>" >
  </div>
      <a href="<?php echo base_url();?>index.php/setting/deletefavicone/<?php echo $meta_data[4]; ?> " id="<?php echo $meta_data[4]; ?>" class="delbutton">
        <img src="<?php echo base_url();?>content/bnw/images/delete.png" id="close"/>
      </a>
      </p>       
 <?php } ?>
  
  </div>

<div class="form-group">
 <input type="hidden" value="<?php echo $meta_data[4]; ?>" name="faviconeName" />
  <label>Favicon Icon</label>
  <input type="file" class="textInput" name="file_name" id="file" />
  </div>

  <div class="form-group">


 <input type="submit" class="btn btn-default btn-lg btn-block" value="Submit" />
 </div>

  <?php echo form_close();?>
 <p><b>Note:</b> Max file size: 500KB,  Width: 100px, Height: 100px</p>