<?php 
$this->load->helper('summary_helper');
?>
<div class="rightSide">
   <div id="body"> 
    <h2>All Events&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="<?php echo base_url().'index.php/events/addevent'; ?>">Add New Event</a></h2>
     <hr class="hr-gradient"/>
      <div id="sucessmsg">
  <?php echo $this->session->flashdata('message'); ?>
    </div>
    <?php   
         if(!empty($event)){
             ?>
        <table class="tbl_full_width" border="1" cellpadding="10">
        <tr>
            
            <th> Name</th>
            <th>Description</th>
            <th>location</th>
            <th>Date and Time</th>
            <th>Image</th>
            <th>Type</th>
            
            <th>Action</th>
        </tr>
        <?php
            foreach ($event as $data){
            ?>
          <tr class="action">
              <td><?php echo $data->title; ?></td>
            
              <td><?php echo custom_echo(strip_tags($data->details)); ?></td>
            <td><?php echo $data->location ?></td>
            <td><?php  echo $data->date;?></td>
            <td><?php if(isset($data->image)==!'' && ($data->image)==!NULL ) { ?><img src="<?php echo base_url()."content/uploads/images/thumb_".$data->image; ?>" width="80" alt="<?php echo $data->image; ?>" /><?php } else { echo 'image not set' ;} ?></td>
            <td><?php echo $data->type; ?></td>
             
            <td><?php echo anchor('events/editevent/'.$data->id,'<i class="fa fa-pencil-square-o"></i>'); ?> / 
                <span class="del_category" id="<?php echo $data->id; ?>"><i class="fa fa-trash-o"></i></span>
            </td>
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
<script>
    $(document).ready(function(){
       $(document).on("click", ".del_category", function(){
           var id = $(this).attr("id");
            var url = '<?php echo base_url().'index.php/events/delevent' ?>';
            var hideid = $(this);
            senddata({id:id,url:url,thiss:hideid});
            
       });
    });
</script>
