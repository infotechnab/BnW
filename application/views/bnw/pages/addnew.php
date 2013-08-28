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
  <?php echo form_open_multipart('bnw/addpage');?>
    <input type="text" name="type" value="page" />
  <p>Title:<br />
  <input type="text" name="title" />
  </p>
  <p>Body:<br />
       <textarea name="area1" cols="50" rows="5"></textarea>
  
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
  <p>listing : <br/>
  <select name="listing">
  <?php foreach ($query as $data)
  { ?><option value="<?php echo $data->id;; ?>"><?php echo $data->title; ?></option> <?php } ?> 
      </select> </p>
   <p> Order : <br/>
       <input type="text" name="order" /> </p>
  
  <input type="submit" value="Submit" />
  <?php echo form_close();?>