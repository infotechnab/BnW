<div class="rightSide">
    
<div id="body">
    <p id="sucessmsg">
  <?php echo $this->session->flashdata('message'); ?>
    </p>
    <p>List of Media Library</p>
    <table border="1" cellpadding="10">
        <tr>
            <th>S.N.</th>
            <th>Media Name</th>
            <th>Media Type</th>
            <th>Media Association ID</th>
            <th>Media Link</th>
            <th>Activity</th>
        </tr>
    
    <?php
    
    
        if($query){
            foreach ($query as $data){
            ?>
          <tr>
            <td><?php echo $data->id ?></td>
            <td><?php echo $data->media_name ?></td>
            <td><?php echo $data->media_type ?></td>
            <td><?php echo $data->media_association_id ?></td>
            <td> <img src='<?php echo base_url().'content/images/'.$data->media_type; ?>' style="height: 60px; width: 60px"/> </td>
            <td><?php echo anchor('bnw/editmedia/'.$data->id,'Edit'); ?> / 
            <?php echo anchor('bnw/deletemedia/'.$data->id,'Delete'); ?></td>
        </tr>
            <?php    
            }
        }
    ?>
    </table>
    <?php echo $links; ?>
</div>
</div>
<div class="clear"></div>
</div>

