<div class=" col-md-10 col-sm-9 col-lg-10 col-xs-8 rightside">


  <div id="body">
    
    <h2>All Slides&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="<?php echo base_url().'index.php/sliders/addslider'; ?>">Add New Slide</a></h2>
    
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
  if(!empty($query)){   
   ?>
   <div class="table-responsive">
   
   <table class="table table-bordered">
    <thead>
     
      <th>Title</th> 
      <th>Image</th>
      <th>Content</th>
      <th>Action</th>
    </thead>
    
    
    <?php         foreach ($query as $data){
      ?>
      <tr class="action">
        
        <td><?php echo $data->slide_name ?></td>
        <td><img src="<?php echo base_url()."content/uploads/sliderImages/thumb_".$data->slide_image; ?>" width="50px" height="50px" />  </td>
        <td><?php echo $data->slide_content ?></td>
        <td>

 <a  href='<?php echo base_url().'sliders/editslider/'.$data->id; ?>'  title=" Edit " data-placement="top" style='font-size:16px;text-decoration:none;'> <span id='$menu_id' class='editNavs    glyphicon glyphicon-edit'></span> | </a> 
  <a href="#" style='font-size:16px;text-decoration:none;'  title=" Delete "> <span  id="<?php echo $data->id; ?>" class='del_category glyphicon glyphicon-trash'></span></a>
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
</div>
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