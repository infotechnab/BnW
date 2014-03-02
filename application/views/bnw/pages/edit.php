<div class="rightSide">
 <?php
 if(isset($error))
  {
     echo $error;
  }
        if(isset($query)){
            foreach ($query as $data){
           $id = $data->id;
           $name = $data->page_name;
           $body = $data->page_content;
           $summary = $data->page_summary;
           $status= $data->page_status;
           $order= $data->page_order;
           $type= $data->page_type;
           $tags= $data->page_tags;
       }
        }
    ?>
<h2>Edit Page id <?php echo $id; ?></h2>
  <?php echo validation_errors(); ?>
 
  <p id="sucessmsg">
  <?php echo $this->session->flashdata('message'); ?>
    </p>
  <?php echo form_open_multipart('bnw/updatepage');?>
  <p>Title:<br />
      <input type="hidden" name="id" value="<?php echo $id; ?>" >
      <input type="text" name="page_name" value="<?php echo $name; ?>" />
  </p>
  <p>Body:<br />
  <textarea name="page_content" id="area1" rows="5" cols="50" style="resize:none;">
      <?php echo $body; ?></textarea>
  </p>
  
  
  
   <p>Status:<br />
  <?php 
  $options = array(
                  '1'  => 'publish',
                  '0'    => 'draft');
  echo form_dropdown('status',$options)
          
  ?>
  </p>
   <p> Order : <br/>
       <input type="text" name="page_order" /> </p>
   
   <p> Type : <br/>
       <input type="text" name="page_type" /> </p>
   
   <p> Tags : <br/>
       <input type="text" name="page_tasg "/> </p>
  
  <input type="submit" value="Submit" />
  <?php echo form_close();?>
<p><b>Note:</b> Max file size: 500KB, Max Width: 1024px, Max Height: 768px </p>
</div>
<div class="clear"></div>
</div>