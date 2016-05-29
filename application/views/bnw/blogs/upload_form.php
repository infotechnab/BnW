<div class=" col-md-10 col-sm-10 col-lg-10 col-xs-10 rightside">

<h2>Add New Blogs </h2>
<div id="body">    
     <p id="sucessmsg">
  <?php if($this->session->flashdata('message')){echo $this->session->flashdata('message');}?>
    </p>
    
<?php echo $error;?>
<?php echo form_open_multipart('bnw/uploads');?>
<p>Title:<br /></p>
    <input type="text" name="title" />
    <br/><br/>
<input type="file" name="userfile" size="20" />
<br /><br />
<p>Status:<br />
  <?php 
  $options = array(
                  '1'  => 'publish',
                  '0'    => 'draft');
  echo form_dropdown('status',$options,'1')
  ?>
  </p>
<input type="submit" class="btn btn-default" value="upload" />
<?php echo form_close(); ?>
 <p><b>Note:</b> Max file size: 500KB, Max Width: 1024px, Max Height: 768px </p>  
 </div>
</div>
</div>
</div>

