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


 </script>
<div class="rightSide">
  
    <?php
         if(!empty($event)){
            foreach ($event as $data){
            $id = $data->id;
            $name= $data->title;
            $description = $data->details;
            $location = $data->location;
            $dateTime= $data->date;
            $image= $data->image;
            $type = $data->type;
                      
            //$listOfCategory = $this->dbmodel->get_list_of_category();
       }
       
       $datebrk = date_parse($dateTime);
       $date = $datebrk['year'].'-'.$datebrk['month'].'-'.$datebrk['day'];
       $time_hr = $datebrk['hour'];
       $time_min = $datebrk['minute'];
       
       ?>
        <div class="titleArea">
     <h2>Edit Event&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="<?php echo base_url().'index.php/events/event'; ?>">View All</a></h2>
<hr class="hr-gradient"/>   
<div id="sucessmsg">
      <?php echo validation_errors();
     if(isset($error)) {
     echo $error;
  }?>
      <?php echo $this->session->flashdata('message'); ?>
    </div>
    </div> 
<!--    <div id="forLeftPage">-->
 
  
 
  
  <?php echo form_open_multipart('events/update_event');?>
  <p class="dashuppe-text-all">Name<br />
      <input type="hidden" name="id" value="<?php echo $id; ?>" >
      <input type="text" class="textInput" name="Name" value="<?php echo $name; ?>" />
  </p>
  <p class="dashuppe-text-all">Description<br />
  <textarea name="description" id="area1" rows="5" cols="50" style="resize:none;">
      <?php echo $description; ?></textarea>
  </p>
 
   
  <?php if($image==!NULL) { ?> <div  >
    <div style="width:85px; height: 85px;">
    <img src="<?php echo base_url()."content/uploads/images/".$image; ?>" width="80" height="80" alt="<?php echo $image; ?>"/>
    </div>
             <a href="<?php echo base_url();?>index.php/events/Imgdelete/?id=<?php echo $id; ?> " id="<?php echo $id; ?>" class="delbutton">
        <img src="<?php echo base_url();?>content/bnw/images/delete.png" id="close"/></a>
    </div> <?php }?>
  
  <input type="hidden" name="hidden_image" value="<?php echo $data->image; ?>" />
 
  <p class="dashuppe-text-all">Image<br/>
 <input id="uploadImage" class="textInput" type="file" name="file" />
   <!-- hidden inputs -->
		<input type="hidden" id="x" name="x" />
		<input type="hidden" id="y" name="y" />
		<input type="hidden" id="w" name="w" />
                <input type="hidden" id="h" name="h" /></p>
  <img id="uploadPreview" style="display:none;width:1000px;"/>
   <p class="dashuppe-text-all">Type<br/>
      <select class="textInput" name="event_type" id="select_type">
          <option value="news" <?php if($type=="news"){ ?> selected="selected" <?php } ?> >News</option>
          <option value="event" id="evnt_show" <?php if($type=="event"){?> selected="selected" <?php } ?> >Event</option>
      </select>
 </p>
 <p class="dashuppe-text-all">Date<br/>
      <input type="text" id="datepicker" class="textInput" name="date" placeholder="event date" value="<?php echo $date; ?>" /> 
 </p>
 <div id="event_items" <?php if($type=="event"){ ?>style="display: block;"<?php } else { ?>style="display: none;"<?php } ?>>
   <p class="dashuppe-text-all"> Location<br/>
            <input type="text" class="textInput" name="location" value="<?php echo $location; ?>" />

  </p>
  
  <p class="dashuppe-text-all">Time<br/>
     <select class="input-text-small" name="hour">
         <option value="0">Hour</option>
         <?php for($i=1; $i<=24 ; $i++){ ?>
         <option <?php if ($time_hr == $i ) echo 'selected'; ?> value="<?php echo $i; ?>"><?php echo $i; ?></option>
         <?php } ?>
     </select>
     <select class="input-text-small" name="min">
         <option value="0">Minutes</option>
         <?php for($i=1; $i<=60 ; $i++){ ?>
         <option <?php if ($time_min == $i ) echo 'selected'; ?> value="<?php echo $i; ?>"><?php echo $i; ?></option>
         <?php } ?>
     </select>
 </p>
 </div>

 
  <input type="submit" class="btn btn-primary btn-lg" value="Submit" />
  <?php echo form_close();?>
  </div>
 
<div class="clear"></div>
 
   
    

     <?php    }
    else {
    echo " <b> Content not found! </b> ";    
    }
     
    ?>
  
  
</div>
<div class="clear"></div>
</div>