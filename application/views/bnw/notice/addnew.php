
<div class="rightSide">
<h2>Add New Notice</h2>
  <?php echo validation_errors(); ?>
  <?php if($this->session->flashdata('message')){echo $this->session->flashdata('message');}?>
  <?php echo form_open('bnw/addnotice');?>
    <input type="text" name="type" value="notice" />
  <p>Title:<br />
  <input type="text" name="title" />
  </p>
  <p>Body:<br />
  <textarea name="body" rows="5" cols="50" style="resize:none;"></textarea>
  </p>
   <p>Status:<br />
  <?php 
  $options = array(
                  '1'  => 'publish',
                  '0'    => 'draft');
  echo form_dropdown('status',$options,'1')
  ?>
  </p>  
  	<textarea name="content" style="width:100%">
</textarea>
  <input type="submit" value="Submit" />
  <?php echo form_close();?>
</div>
<div class="clear"></div>
</div>
