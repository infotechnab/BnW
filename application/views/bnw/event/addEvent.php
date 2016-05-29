<div class=" col-md-10 col-sm-9 col-lg-10 col-xs-8 rightside">
    <h2 id="titleinfo">Add Event / News&nbsp;&nbsp;&nbsp;&nbsp;<a href="<?php echo base_url().'index.php/events/allevents'; ?>">View All Events</a></h2>
 <hr class="hr-gradient"/>

<div id="sucessmsg">
  <?php if($this->session->flashdata('message'))
            {
            echo "<div class='alert alert-default fade in'>".$this->session->flashdata('message')."</div>"; 

            }?>
    <?php $validation_errors= validation_errors();
    if(isset($validation_errors)){
     echo "<div class='error'>".$validation_errors."</div>"; 

    }
  if(isset($error))
  {
         echo "<div class='error'>".$error."</div>"; 
       }
  ?>
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

  <?php echo form_open_multipart('events/addevent',array('class'=>'form-horizontal'));?>
<div class="form-group">
 <label>Name :</label>
 <input type="text" class="form-control" name="event_name" value="<?php echo set_value('event_name'); ?>"  /> 
 </div>
<div class="form-group">
 <label>Detail</label>
  <textarea name="detail" class="form-control" id="textara" cols="50" rows="15" ><?php echo set_value('detail'); ?></textarea>
 </div>

<div class="form-group">
  <label class="dashuppe-text-all">Image :</label>
      <input id="uploadImage"  type="file" name="file" accept="image/*"/>
     <!-- hidden inputs -->
		<input type="hidden" id="x" name="x" />
		<input type="hidden" id="y" name="y" />
		<input type="hidden" id="w" name="w" />
		<input type="hidden" id="h" name="h" />
</div>

<hr/>

<div data-toggle="buttons" id="mybutton">
            <label title="Set Aspect Ratio" data-option="1.7777777777777777" data-method="setAspectRatio" class="radio-inline">
                <input type="radio" value="1.7777777777777777" name="aspestRatio" id="aspestRatio1" class="sr-only">16:9
            </label>
            <label title="Set Aspect Ratio" data-option="1.3333333333333333" data-method="setAspectRatio" class="radio-inline">
                <input type="radio" value="1.3333333333333333" name="aspestRatio" id="aspestRatio2" class="sr-only" checked="checked">4:3
            </label>
            <label title="Set Aspect Ratio" data-option="1" data-method="setAspectRatio" class="radio-inline">
                <input type="radio" value="1" name="aspestRatio" id="aspestRatio3" class="sr-only">1:1
            </label>
            <label title="Set Aspect Ratio" data-option="0.6666666666666666" data-method="setAspectRatio" class="radio-inline">
                <input type="radio" value="0.6666666666666666" name="aspestRatio" id="aspestRatio4" class="sr-only">2:3
            </label>
            <label title="Set Aspect Ratio" data-option="NaN" data-method="setAspectRatio" class="radio-inline">
                <input type="radio" value="NaN" name="aspestRatio" id="aspestRatio5" class="sr-only">Free
            </label>
        </div>
 <hr>
  <img id="uploadPreview" class="img-responsive"  style="display:none;border:3px solid #ccc;box-shadow: 10px 10px 5px #888888;height:600px;"/>

  <div class="form-group">
  <label for="sel1">Event</label>
  <select class="form-control"  style=" padding:1px;"name="event_type" id="select_type">
   <option value="news" >News</option>
   <option value="event" id="evnt_show" >Event</option>
  </select>
  </div>   
  <div id="event_items" style="display: none;">
    <div class="form-group"> 
 <label>Location</label>
  <input type="text"  name="location" value="<?php echo set_value('location'); ?>"  />

  </div>
<div class="form-group">
<label> Start Date</label>
    <input type="text"  id="datepicker" name="start_date" placeholder="event date" value="<?php echo date('20y-m-d'); ?>" /> 
</div>


   <div class="form-group">

 <label> Start Time</label>
  <select class="input-text-small" name="start_min" id="sel1">
     <option value="0">Minutes</option>
         <?php for($i=1; $i<=60 ; $i++){ ?>
         <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
         <?php } ?>
  </select>
</div>
 <div class="form-group">

 <label> Start Time</label>
  <select class="input-text-small" name="start_hour" id="sel1">
     <?php for($i=1; $i<=24 ; $i++){ ?>
         <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
         <?php } ?>
  </select>
</div>


 <p class="dashuppe-text-all"> End Date<br/>
      <input type="text" class="input-text-small" id="datepicker_end" name="end_date" placeholder="end date" value="<?php echo date('20y-m-d'); ?>" /> 
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
 <div classs="form-group">
 
 <input type="submit" class="btn btn-default btn-lg btn-block"  value="Submit" />
 </div>
  <?php echo form_close();?>

 </div>
</div>






