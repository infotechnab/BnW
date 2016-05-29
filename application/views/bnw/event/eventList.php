<?php 
$this->load->helper('summary_helper');
?>
<div class=" col-md-10 col-sm-9 col-lg-10 col-xs-8 rightside">
    <h2>All Events/ News&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="<?php echo base_url().'index.php/events/addevent'; ?>">Add New</a></h2>
     <hr class="hr-gradient"/>
    
<div id="sucessmsg">
  <?php if($this->session->flashdata('message'))
            {
            echo "<div class='alert alert-default fade in '>".$this->session->flashdata('message')."</div>"; 

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
    <?php   
         if(!empty($event)){
             ?>
             <div class="table-responsvie">
        <table class="table table-bordered">
        <thead>
            
            <th> Name</th>
            <th>Description</th>
            <th>location</th>
            <th>Date and Time</th>
            <th>Image</th>
            <th>Type</th>
            
            <th>Action</th>
        </thead>
        <?php  
                       
            foreach ($event as $data){
            ?>
          <tr class="action">
              <td><?php echo $data->title; ?></td>
            
              <td ><?php echo custom_echo(strip_tags($data->details)); ?></td>
            <td><?php echo $data->location ?></td>
            <td><?php 
            if($data->type=='event'){            
            if(!empty($data->start_date)){ $timestamp_start = strtotime($data->start_date); echo date('Y-m-d', $timestamp_start);}
            if(!empty($data->end_date)){ $timestamp_end = strtotime($data->end_date); echo ' to '. date('Y-m-d', $timestamp_end);}
            }
            if($data->type == 'news'){
                if(!empty($data->insert_date)){ $timestamp_insert = strtotime($data->insert_date); echo 'Published on '. date('Y-m-d', $timestamp_insert);} 
            }
            ?></td>
            <td><?php if(isset($data->image)==!'' && ($data->image)==!NULL ) { ?><img src="<?php echo base_url()."content/uploads/images/thumb_".$data->image; ?>" width="80" alt="<?php echo $data->image; ?>" /><?php } else { echo 'image not set' ;} ?></td>
            <td><?php echo $data->type; ?></td>
             
            <td>

   <a  href='<?php echo base_url().'events/editevent/'.$data->id; ?>'  title=" Edit " data-placement="top" style='font-size:16px;text-decoration:none;'> <span id='$menu_id' class='editNavs    glyphicon glyphicon-edit'></span> | </a> 
   <a href="#" style='font-size:16px;text-decoration:none;'  title=" Delete "> <span  id="<?php echo $data->id; ?>" class='del_category glyphicon glyphicon-trash'></span></a>
      
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
    </div>
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
