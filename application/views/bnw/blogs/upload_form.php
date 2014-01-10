<div class="rightSide">
<h2>Add New Blogs </h2>
<div id="body">    
     <p id="sucessmsg">
  <?php if($this->session->flashdata('message')){echo $this->session->flashdata('message');}?>
    </p>
    
<?php echo $error;?>
<?php echo form_open_multipart('bnw/uploads');?>
<p>Title:<br />
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
<input type="submit" value="upload" />
</form>
 <p><b>Note:</b> Max file size: 500KB, Max Width: 1024px, Max Height: 768px </p>  
 </div>
</div>
<div class="clear"></div>
</div>