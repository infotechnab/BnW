<div class="rightSide">
 <?php
        if($query){
            foreach ($query as $data){
           $id = $data->id;
           $title = $data->title;
           $body = $data->body;
           $status= $data->status;
            
            }
        }
    ?>
<h2>Edit Gadget id <?php echo $id; ?></h2>
  <?php echo validation_errors(); ?>
 
  <p id="sucessmsg">
  <?php if($this->session->flashdata('message')){echo $this->session->flashdata('message');}?>
    </p>
  <?php echo form_open('bnw/updategadget');?>
    <input type="text" name="type" value="gadgets" />
  <p>Title:<br />
      <input type="hidden" name="id" value="<?php echo $id; ?>" />
      <input type="text" name="title" value="<?php echo $title; ?>" />
  </p>
  <p>Body:<br />
  <textarea name="body" rows="5" cols="50" style="resize:none;"><?php echo $body; ?></textarea>
  </p>
   <p>Status:<br />
  <?php 
  $options = array(
                  '1'  => 'publish',
                  '0'    => 'draft');
  echo form_dropdown('status',$options,$status)
  ?>
  </p>
  <input type="submit" value="Submit" />
  <?php echo form_close();?>
</div>
<div class="clear"></div>
</div>
