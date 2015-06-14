<div class="rightSide">
    
<div id="body">
    <p id="sucessmsg">
  <?php echo $this->session->flashdata('message'); ?>
    </p>
    <h2>Media Libraries&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="<?php echo base_url().'index.php/media/addmedia'; ?>">Add New Media</a></h2>
    <hr class="hr-gradient"/>
     <?php
     if(isset($error))
  {
     echo $error;
  }
    
         if(!empty($query)){
             ?>
    <table border="1" cellpadding="10" class="tbl_full_width" >
        <tr>
            
            <th>Media Name</th>
            <th>Media Type</th>
            <th>Media Link</th>
            <th>Activity</th>
        </tr>
    
   <?php
            foreach ($query as $data){
            ?>
        <tr class="action">
            
            <td><?php echo $data->media_name; ?></td>
            
            
            <td><?php $exts = array('jpg','jpeg','png','gif','pdf','doc','ppt','odt','pptx','docx','xls','xlsx','key','txt'); $file= $data->media_type; $info = explode(".", $file); 
             $file_ext = strtolower(end($info));
             if(in_array($file_ext, $exts)) {
             
            
         if($file_ext=='jpg' || $file_ext=='png' || $file_ext=='jpeg' || $file_ext=='bmp'){ ?>
                <img src='<?php echo base_url().'content/uploads/images/'.$data->media_type; ?>' style="height: 60px; width: 60px"/>
                    <?php } else{ echo $file_ext.' file'; } ?> </td>
            <td><?php echo base_url().'content/uploads/images/'.$file; ?></td>
            <td><?php echo anchor('media/editmedia/'.$data->id,'<i class="fa fa-pencil-square-o"></i>'); ?> / 
                <span class="del_category" id="<?php echo $data->id; ?>"><i class="fa fa-trash-o"></i></span>
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

