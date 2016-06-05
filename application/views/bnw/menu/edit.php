<div class=" col-md-10 col-sm-9 col-lg-10 col-xs-8 rightside">


    <?php if(isset($query)){
            foreach ($query as $data){
           $id = $data->id;
           $menuname = $data->menu_name;
           }
        }
    ?>
<h2>Edit Menu/&nbsp; &nbsp; &nbsp; <?php echo $menuname; ?></h2>
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

  <?php echo form_open_multipart('dashboard/updatemenu');?>
  <div class="form-group">
    <input type="hidden" name="id" value="<?php echo $id; ?>" />
     <label>Menu Name :</label>
      <input type="text" class="form-control" name="menu_name" value="<?php echo htmlentities($menuname); ?>" />
 </div>
 <div class="form-group">
    <input type="submit" class="btn btn-default btn-block btn-lg" value="Submit" />
  
</div>
<?php echo form_close();?>
</div>
