<div class="rightSide">
   <div id="body">
    <p id="sucessmsg">
  <?php echo $this->session->flashdata('message'); ?>
    </p>
    <h2>All Events</h2>
     <hr class="hr-gradient"/>
    <?php   
         if(!empty($event)){
             ?>
        <table border="1" cellpadding="10">
        <tr>
            
            <th> Name</th>
            <th>Description</th>
            <th>location</th>
            <th>Date and Time</th>
            <th>Image</th>
            
            <th>Action</th>
        </tr>
        <?php
            foreach ($event as $data){
            ?>
          <tr>
              <td><?php echo $data->title; ?></td>
            
            <td><?php echo $data->details; ?></td>
            <td><?php echo $data->location ?></td>
            <td><?php  echo $data->date;?></td>
            <td><?php if(isset($data->image)==!'' && ($data->image)==!NULL ) { ?><img src="<?php echo base_url()."content/uploads/images/".$data->image; ?>" width="50" height="50" ale="<?php echo $data->image; ?>" /><?php } else { echo 'image not set' ;} ?></td>
            
             
            <td><?php echo anchor('events/editevent/'.$data->id,'Edit'); ?> / 
            <?php echo anchor('events/delevent/'.$data->id,'Delete'); ?></td>
        </tr>
            <?php    
            }
        }
        else{
            echo '<h3>Sorry events are not available</h3>';
        }
            
    ?>
    </table>
    <?php  echo $links; ?>
</div>
    
    
</div>
<div class="clear"></div>
</div>