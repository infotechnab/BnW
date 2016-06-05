<div class=" col-md-10 col-sm-9 col-lg-10 col-xs-8 rightside">

    
<div id="body">
 
     <h2>Media Libraries&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="<?php echo base_url().'index.php/media/addmedia'; ?>">Add New Media</a></h2>
   
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
    <table class="table table-bordered" >
        <thead>
            
            <th>Media Name</th>
            <th>Media Type</th>
            <th>Media Link</th>
            <th>Activity</th>
        </thead>
    
   <?php
            foreach ($query as $data){
            ?>
        <tr class="action">
            
            <td><?php echo $data->media_name; ?></td>
            
            
            <td><?php $exts = array('jpg','jpeg','png','gif','pdf','doc','ppt','odt','pptx','docx','xls','xlsx','key','txt'); $file= $data->media_type; $info = explode(".", $file); 
             $file_ext = strtolower(end($info));
             if(in_array(trim($file_ext), $exts)) {
            
         if($file_ext=='jpg' || $file_ext=='png' || $file_ext=='jpeg' || $file_ext=='bmp'){ ?>
                <img src='<?php echo base_url().'content/uploads/images/thumb_'.$data->media_type; ?>' style="height: 60px; width: 60px"/>
                    <?php } else{ echo $file_ext.' file'; } ?> </td>
            <td><?php echo base_url().'content/uploads/images/'.$file; ?></td>
            <td>
 <a  href='<?php echo base_url().'media/editmedia/'.$data->id; ?>'  title=" Edit " data-placement="top" style='font-size:16px;text-decoration:none;'> <span id='$menu_id' class='editNavs    glyphicon glyphicon-edit'></span> | </a> 
 <a href="#" style='font-size:16px;text-decoration:none;'  title=" Delete "> <span  id="<?php echo $data->id; ?>" class='del_category glyphicon glyphicon-trash'></span></a>
            </td>
        </tr>
            <?php    
            } }
            
        }
 else {
     echo '<h3>Sorry Library is unavailable</h3>';
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
            var url = '<?php echo base_url().'index.php/media/deletemedia' ?>';
            var hideid = $(this);
            senddata({id:id,url:url,thiss:hideid});
            
       });
    });
</script>

