<div class="rightSide">
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
  
  <p>Title:<br />
  <input type="text" name="page_name" value="<?php echo set_value('page_name'); ?>" />
  </p>
  <p>Body:<br />
      <textarea name="page_content" id="area1" cols="50" rows="5" value="<?php echo set_value('page_content'); ?>" ></textarea>
  
    </p>
    
  <p>Summary:<br />
      <textarea name="page_summary" id="area1" cols="50" rows="5" value="<?php echo set_value('page_summary'); ?>" ></textarea>
  
     </p>
   <p>Status:<br />
  <?php 
  $options = array(
                  '1'  => 'publish',
                  '0'    => 'draft');
  echo form_dropdown('page_status',$options,'1')
  ?>
  </p>
  
   <p> Order : <br/>
       <input type="text" name="page_order" /> </p>
   
   <p> Type : <br/>
       <input type="text" name="page_order" /> </p>
   
   <p> Tags : <br/>
       <input type="text" name="page_order" /> </p>
  
  <input type="submit" value="Submit" />
  <?php echo form_close();?>
</div>
<div class="clear"></div>
</div>