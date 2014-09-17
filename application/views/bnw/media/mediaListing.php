<div class="rightSide">
    
<div id="body">
    <p id="sucessmsg">
  <?php echo $this->session->flashdata('message'); ?>
    </p>
    <h2>Media Libraries&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="<?php echo base_url().'index.php/album/addmedia'; ?>">Add New Media</a></h2>
    <hr class="hr-gradient"/>
     <?php
     if(isset($error))
  {
     echo $error;
  }
    
         if(!empty($query)){
             ?>
    <table border="1" cellpadding="10">
        <tr>
            
            <th>Media Name</th>
            <th>Media Type</th>
           
            <th>Media Link</th>
            <th>Activity</th>
        </tr>
    
   <?php
            foreach ($query as $data){
            ?>
          <tr>
            
            <td><?php echo $data->media_name; ?></td>
            <td><?php echo $data->media_type; ?></td>
            
            <td><?php $file= $data->media_type; $info = new SplFileInfo($file); $ext = $info->getExtension(); if($ext=='jpg' || $ext=='png' || $ext=='jpeg' || $ext=='bmp'){ ?>
                <img src='<?php echo base_url().'content/uploads/images/thumb_'.$data->media_type; ?>' style="height: 60px; width: 60px"/>
                    <?php } else{ echo $ext.' file'; } ?> </td>
            <td><?php echo anchor('album/editmedia/'.$data->id,'Edit'); ?> / 
            <?php echo anchor('album/delmedia/'.$data->id,'Delete'); ?></td>
        </tr>
            <?php    
            }
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

