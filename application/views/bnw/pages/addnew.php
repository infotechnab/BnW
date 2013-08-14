

<h2>Add new page</h2>
  <?php echo validation_errors();
  if(isset($error))
  {
      echo $error;
  }
  ?>

<p id="sucessmsg">
  <?php if($this->session->flashdata('message')){echo $this->session->flashdata('message');}?>
</p>
  <?php echo form_open_multipart('admin/addpage');?>
  <p>Title:<br />
  <input type="text" name="title" />
  </p>
  <p>Body:<br />
  <textarea name="body" rows="5" cols="50" style="resize:none;"></textarea>
    </p>
    <p> Image : <br/> <input type="file" name="file" id="file" /> </p>
   <p>Status:<br />
  <?php 
  $options = array(
                  '1'  => 'publish',
                  '0'    => 'draft');
  echo form_dropdown('status',$options,'1')
  ?>
  </p>

</textarea>
  <input type="submit" value="Submit" />
  <?php echo form_close();?>
