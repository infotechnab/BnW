<div class="rightSide">
    <h2>Add new Event&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="<?php echo base_url().'index.php/events/event'; ?>">View All Events</a></h2>
 <hr class="hr-gradient"/>
  <div id="sucessmsg">
  <?php echo validation_errors(); ?>
  <?php if($this->session->flashdata('message')){echo $this->session->flashdata('message');}?>
  </div>
 <link rel="stylesheet" href="<?php echo base_url().'content/bnw/scripts/date.css';?>">
 <script src="<?php echo base_url() . 'content/bnw/scripts/jquery-ui.js'; ?>" type="text/javascript"></script>
 <link rel="stylesheet" type="text/css" href="<?php echo base_url().'content/bnw/styles/imgareaselect-animated.css'; ?>" />
 <script type="text/javascript" src="<?php echo base_url().'content/bnw/scripts/jquery.imgareaselect.pack.js'; ?>"></script>
	<script type="text/javascript" src="<?php echo base_url().'content/bnw/script/script.js'; ?>"></script>
 <script>
  $(function() {
$( "#datepicker" ).datepicker();
});
 </script>
 <div id="forLeftPage">  
  <?php echo form_open_multipart('events/addevent');?>
      
 <p class="dashuppe-text-all">Name<br />
     <input type="text" class="textInput" name="event_name" value="<?php echo set_value('event_name'); ?>"  /> </p> 
 <p class="dashuppe-text-all">Detail<br/>
  <textarea name="detail" id="area1" cols="50" rows="5" ><?php echo set_value('detail'); ?></textarea>
 </p>
 <p class="dashuppe-text-all">Location<br/>
  <input type="text" class="textInput" name="location" value="<?php echo set_value('location'); ?>"  />
 </p>
 
 <p class="dashuppe-text-all">Image<br/>
     
     <input id="uploadImage" class="textInput" type="file" name="file" />
     <!-- hidden inputs -->
		<input type="hidden" id="x" name="x" />
		<input type="hidden" id="y" name="y" />
		<input type="hidden" id="w" name="w" />
		<input type="hidden" id="h" name="h" />
 </p>
 <img id="uploadPreview" style="display:none;width:1000px;"/>
 </div>
 <div id="forRightPage"> 
 <p class="dashuppe-text-all">When<br/>
      <input type="text" class="textInput" id="datepicker" name="date" placeholder="event date" value="<?php echo date('20y-m-d'); ?>" /> 
 </p>
 <p class="dashuppe-text-all">Time<br/>
     <select class="input-text-small" name="hour">
         <option value="0">Hour</option>
         <?php for($i=1; $i<=24 ; $i++){ ?>
         <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
         <?php } ?>
     </select>
     <select class="input-text-small" name="min">
         <option value="0">Minutes</option>
         <?php for($i=1; $i<=60 ; $i++){ ?>
         <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
         <?php } ?>
     </select>
 </p>
 
 <input type="submit" class="btn btn-primary btn-lg" value="Submit" />
 </div>
  <?php echo form_close();?>




 </div>
<div class="clear"></div>
</div>






