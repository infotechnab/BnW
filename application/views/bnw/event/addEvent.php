<div class="rightSide">
    <h2>Add Event / News&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="<?php echo base_url().'index.php/events/allevents'; ?>">View All Events</a></h2>
 <hr class="hr-gradient"/>
  <div id="sucessmsg">
  <?php echo validation_errors(); ?>
  <?php if($this->session->flashdata('message')){echo $this->session->flashdata('message');}?>
  </div>
 <link rel="stylesheet" href="<?php echo base_url().'content/bnw/scripts/date.css';?>">
 <script src="<?php echo base_url() . 'content/bnw/scripts/jquery-ui.js'; ?>" type="text/javascript"></script>
 <link rel="stylesheet" type="text/css" href="<?php echo base_url().'content/bnw/styles/imgareaselect-animated.css'; ?>" />
 <script type="text/javascript" src="<?php echo base_url().'content/bnw/scripts/jquery.imgareaselect.pack.js'; ?>"></script>
	<script type="text/javascript" src="<?php echo base_url().'content/bnw/scripts/script.js'; ?>"></script>
 <script>
     $(document).ready(function(){
         $('#select_type').change(function(){
             var a = $('#select_type').val();
            // alert(a);
            if(a=='event'){
               $('#event_items').show(); 
            }
            else{
               $('#event_items').hide(); 
            }

  });
     });
     
  $(function() {
$( "#datepicker" ).datepicker();
});
 $(function() {
$( "#datepicker_end" ).datepicker();
});


 </script>
 
  <?php echo form_open_multipart('events/addevent');?>
      
 <p class="dashuppe-text-all">Name *<br />
      <input type="text" class="textInput" name="event_name" value="<?php echo set_value('event_name'); ?>"  /> </p> 
 <p class="dashuppe-text-all">Detail<br/>
  <textarea name="detail" id="textara" cols="50" rows="15" ><?php echo set_value('detail'); ?></textarea>
 </p>
  <p class="dashuppe-text-all">Image<br/>
      <input id="uploadImage" class="textInput" type="file" name="file" accept="image/*"/>
     <!-- hidden inputs -->
		<input type="hidden" id="x" name="x" />
		<input type="hidden" id="y" name="y" />
		<input type="hidden" id="w" name="w" />
		<input type="hidden" id="h" name="h" />
 </p>
 <div data-toggle="buttons" id="mybutton" class="btn-group btn-group-justified">
            <label title="Set Aspect Ratio" data-option="1.7777777777777777" data-method="setAspectRatio" class="btn btn-primary active">
                <input type="radio" value="1.7777777777777777" name="aspestRatio" id="aspestRatio1" class="sr-only">16:9
            </label>
            <label title="Set Aspect Ratio" data-option="1.3333333333333333" data-method="setAspectRatio" class="btn btn-primary">
                <input type="radio" value="1.3333333333333333" name="aspestRatio" id="aspestRatio2" class="sr-only" checked="checked">4:3
            </label>
            <label title="Set Aspect Ratio" data-option="1" data-method="setAspectRatio" class="btn btn-primary">
                <input type="radio" value="1" name="aspestRatio" id="aspestRatio3" class="sr-only">1:1
            </label>
            <label title="Set Aspect Ratio" data-option="0.6666666666666666" data-method="setAspectRatio" class="btn btn-primary">
                <input type="radio" value="0.6666666666666666" name="aspestRatio" id="aspestRatio4" class="sr-only">2:3
            </label>
            <label title="Set Aspect Ratio" data-option="NaN" data-method="setAspectRatio" class="btn btn-primary">
                <input type="radio" value="NaN" name="aspestRatio" id="aspestRatio5" class="sr-only">Free
            </label>
        </div>
  <img id="uploadPreview" style="display:none;width:1000px;"/>
  <p class="dashuppe-text-all">Type<br/>
      <select class="textInput" name="event_type" id="select_type">
          <option value="news" >News</option>
          <option value="event" id="evnt_show" >Event</option>
      </select>
 </p>
 <div id="event_items" style="display: none;">
     
 <p class="dashuppe-text-all">Location<br/>
  <input type="text" class="textInput" name="location" value="<?php echo set_value('location'); ?>"  />
 </p>
<p class="dashuppe-text-all"> Start Date<br/>
      <input type="text" class="textInput" id="datepicker" name="start_date" placeholder="event date" value="<?php echo date('20y-m-d'); ?>" /> 
 </p>
 
 <p class="dashuppe-text-all"> Start Time<br/>
     <select class="input-text-small" name="start_hour">
         <option value="0">Hour</option>
         <?php for($i=1; $i<=24 ; $i++){ ?>
         <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
         <?php } ?>
     </select>
     <select class="input-text-small" name="start_min">
         <option value="0">Minutes</option>
         <?php for($i=1; $i<=60 ; $i++){ ?>
         <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
         <?php } ?>
     </select>
 </p>
 
 <p class="dashuppe-text-all"> End Date<br/>
      <input type="text" class="textInput" id="datepicker_end" name="end_date" placeholder="end date" value="<?php echo date('20y-m-d'); ?>" /> 
 </p>
 
 <p class="dashuppe-text-all"> End Time<br/>
     <select class="input-text-small" name="end_hour">
         <option value="0">Hour</option>
         <?php for($i=1; $i<=24 ; $i++){ ?>
         <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
         <?php } ?>
     </select>
     <select class="input-text-small" name="end_min">
         <option value="0">Minutes</option>
         <?php for($i=1; $i<=60 ; $i++){ ?>
         <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
         <?php } ?>
     </select>
 </p>

 </div>
 
 <input type="submit" class="btn btn-primary btn-lg" value="Submit" />
  <?php echo form_close();?>

 </div>
<div class="clear"></div>
</div>






