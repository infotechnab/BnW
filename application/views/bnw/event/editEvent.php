<link rel="stylesheet" href="<?php echo base_url().'content/uploads/scripts/date.css';?>">
<script src="<?php echo base_url().'content/uploads/scripts/jquery-1.10.2.js'; ?>"></script>

 <script src="<?php echo base_url() . 'content/uploads/scripts/jquery-ui.js'; ?>" type="text/javascript"></script>
 <script>
  $(function() {
$( "#datepicker" ).datepicker();
});
 </script>
<div class="rightSide">
  
    <?php
 if(isset($error))
  {
     echo $error;
  }
        if(!empty($event)){
            foreach ($event as $data){
            $id = $data->id;
            $name= $data->title;
            $description = $data->details;
            $location = $data->location;
            $dateTime= $data->date;
            $image= $data->image;
                      
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
    </div> 
<!--    <div id="forLeftPage">-->
 
  
 
  <div id="sucessmsg">
      <?php echo validation_errors(); ?>
      <?php echo $this->session->flashdata('message'); ?>
    </div>
  <?php echo form_open_multipart('events/update_event');?>
  <p>Name:<br />
      <input type="hidden" name="id" value="<?php echo $id; ?>" >
      <input type="text" name="Name" value="<?php echo $name; ?>" />
  </p>
  <p>Description:<br />
  <textarea name="description" id="area1" rows="5" cols="50" style="resize:none;">
      <?php echo $description; ?></textarea>
  </p>
  <p> Location : <br/>
            <input type="text" name="location" value="<?php echo $location; ?>" />

  </p>
   
  <?php if($image==!NULL) { ?> <div  >
    <div style="width:85px; height: 85px;">
    <img src="<?php echo base_url()."content/uploads/images/".$image; ?>" width="80" height="80" alt="<?php echo $image; ?>"/>
    </div>
             <a href="<?php echo base_url();?>index.php/events/Imgdelete/?id=<?php echo $id; ?> " id="<?php echo $id; ?>" class="delbutton">
        <img src="<?php echo base_url();?>content/bnw/images/delete.png" id="close"/></a>
    </div> <?php }?>
  
  <input type="hidden" name="hidden_image" value="<?php echo $data->image; ?>" />
 
  <p>Image: <br/>
  <input type="file" name="file" /></p>
  <p>When: <br/>
      <input type="text" id="datepicker" name="date" placeholder="event date" value="<?php echo $date; ?>" /> 
 </p>
  <p>Time: <br/>
     <select name="hour">
         <option value="0">Hour</option>
         <?php for($i=1; $i<=24 ; $i++){ ?>
         <option <?php if ($time_hr == $i ) echo 'selected'; ?> value="<?php echo $i; ?>"><?php echo $i; ?></option>
         <?php } ?>
     </select>
     <select name="min">
         <option value="0">Minutes</option>
         <?php for($i=1; $i<=60 ; $i++){ ?>
         <option <?php if ($time_min == $i ) echo 'selected'; ?> value="<?php echo $i; ?>"><?php echo $i; ?></option>
         <?php } ?>
     </select>
 </p>
 
  <input type="submit" value="Submit" />
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