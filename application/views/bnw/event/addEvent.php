<div class="rightSide">
 <h2>Add new Event</h2>
 <hr class="hr-gradient"/>
  <div id="sucessmsg">
  <?php echo validation_errors(); ?>
  <?php if($this->session->flashdata('message')){echo $this->session->flashdata('message');}?>
  </div>
 <link rel="stylesheet" href="<?php echo base_url().'content/uploads/scripts/date.css';?>">
<script src="<?php echo base_url().'content/uploads/scripts/jquery-1.10.2.js'; ?>"></script>

 <script src="<?php echo base_url() . 'content/uploads/scripts/jquery-ui.js'; ?>" type="text/javascript"></script>
 <script>
  $(function() {
$( "#datepicker" ).datepicker();
});
 </script>
 
  <?php echo form_open_multipart('events/addevent');?>
      
 <p>Name:<br />
      <input type="text" name="event_name" value="<?php echo set_value('event_name'); ?>"  /> </p> 
 <p>Detail: <br/>
  <textarea name="detail" id="area1" cols="50" rows="5" ><?php echo set_value('detail'); ?></textarea>
 </p>
 <p>Location: <br/>
  <input type="text" name="location" value="<?php echo set_value('location'); ?>"  />
 </p>
 <p>Image: <br/>
     <input type="file" name="file" />
 </p>
 <p>When: <br/>
      <input type="text" id="datepicker" name="date" placeholder="event date" value="<?php echo date('20y-m-d'); ?>" /> 
 </p>
 <p>Time: <br/>
     <select name="hour">
         <option value="0">Hour</option>
         <?php for($i=1; $i<=24 ; $i++){ ?>
         <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
         <?php } ?>
     </select>
     <select name="min">
         <option value="0">Minutes</option>
         <?php for($i=1; $i<=60 ; $i++){ ?>
         <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
         <?php } ?>
     </select>
 </p>
 
 <input type="submit" value="Submit" />
  <?php echo form_close();?>




 </div>
<div class="clear"></div>
</div>






