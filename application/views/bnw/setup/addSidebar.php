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


<h2> Sidebar Content Management</h2>
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

<?php echo form_open('setting/sidebarupdate');?>
  <p class="dashuppe-text-all">Sidebar Title<br />
  <input type="text" class="textInput form-control" name="sidebar_title" value="<?php echo $set_data[4]; ?>" />
  </p>
  <p class="dashuppe-text-all">Sidebar Description<br />
  <input type="text" class="textInput form-control" name="sidebar_description" value="<?php echo $set_data[5]; ?>"/>
  </p>
  
 <input type="submit" class="btn btn-default btn-lg" value="Submit" />
  <?php echo form_close();?>
</div>
<div class="clear"></div>
</div>