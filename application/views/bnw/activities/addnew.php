<div class=" col-md-10 col-sm-9 col-lg-10 col-xs-8 rightside">

<h2>Add New News & Events </h2>
 
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
  <?php if($this->session->flashdata('message')){echo $this->session->flashdata('message');}?>
  <?php echo form_open_multipart('bnw/addactivity');?>
  <input type="text" name="type" value="event" />
  <p>Title:<br />
  <input type="text" name="title" />
  </p>
  <p>Body:<br />
  <textarea name="body" rows="5" cols="50" style="resize:none;"></textarea>
  </p>
  <p>Image(315px, 100px): <br />
    <input type="file" name="file" size="20" />
   <p>Status:<br />
  <?php 
  $options = array(
                  '1'  => 'publish',
                  '0'    => 'draft');
  echo form_dropdown('status',$options,'1')
  ?>
  </p>  

  <input type="submit" class="btn btn-default btn-lg btn-block" value="Submit" />
  <?php echo form_close();?>
  <p><b>Note:</b> Max file size: 500KB, Max Width: 1024px, Max Height: 768px </p>
  
</div>
</div>
</div>