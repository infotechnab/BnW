<div class="rightSide">

<div id="body">
    
    <h2>All Slides&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="<?php echo base_url().'index.php/sliders/addslider'; ?>">Add New Slide</a></h2>
       
   <hr class="hr-gradient"/>
   <div id="sucessmsg">
  <?php if($this->session->flashdata('message')){echo $this->session->flashdata('message');}?>
    <?php echo validation_errors();
  if(isset($error))
  {
      echo $error;
  }
  ?>
</div>
   
   
   
    <?php
        if(!empty($query)){   
   ?>
  
    <table border="1" cellpadding="10" class="tbl_full_width" >
        <tr>
           
            <th>Title</th> 
            <th>Image</th>
            <th>Content</th>
            <th>Action</th>
        </tr>
    
   
   <?php         foreach ($query as $data){
            ?>
        <tr class="action">
            
            <td><?php echo $data->slide_name ?></td>
            <td><img src="<?php echo base_url()."content/uploads/sliderImages/thumb_".$data->slide_image; ?>" width="50px" height="50px" />  </td>
            <td><?php echo $data->slide_content ?></td>
            <td><?php echo anchor('sliders/editslider/'.$data->id,'<i class="fa fa-pencil-square-o"></i>'); ?> / 
                <span class="del_category" id="<?php echo $data->id; ?>"><i class="fa fa-trash-o"></i></span>
            </td>
        </tr>
            <?php    
            }
        }
 else {
            echo '<h3>Sorry slides are not available</h3>';
 }
 
    ?>
       
    </table>
    <?php echo $links; ?>
</div>
</div>
<div class="clear"></div>
</div>

<script>
    $(document).ready(function(){
       $(document).on("click", ".del_category", function(){
           var id = $(this).attr("id");
            var url = '<?php echo base_url().'index.php/sliders/deleteslider' ?>';
            var hideid = $(this);
            senddata({id:id,url:url,thiss:hideid});
            
       });
    });
</script>