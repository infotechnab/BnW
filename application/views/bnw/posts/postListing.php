<div class="rightSide">
    
<div id="body">
    <p id="sucessmsg">
  <?php echo $this->session->flashdata('message'); ?>
    </p>
    <p>List of all Posts</p>
    <table border="1" cellpadding="10">
        <tr>
            <th>S.N.</th>
            <th>Post Title</th>
            <th>Post Summary</th>
            <th>Image</th>
            <th>Published On</th>
            <th>Status</th>
            <th>Action</th>
        </tr>
    
    <?php
    
    
        if($query){
            foreach ($query as $data){
            ?>
          <tr>
            <td><?php echo $data->id ?></td>
            <td><?php echo $data->post_title ?></td>
            <td><?php echo $data->post_summary ?></td>
            <?php $image = "";
                if(($image=='')|| ($image=='0'))
                {
                    $image = 'Image not set'; ?>
            <td> <?php echo $image; ?></td>
              <?php   } else {
    ?> <td><img src="<?php echo base_url();?>uploads/<?php echo $image;?>" widht="50px" height="50px" /> 
</td> <?php } ?>
            <td><?php echo $data->post_date; ?></td>
            
            <td><?php if($data->post_status=="Active")
            {
                echo "Draft";
            }
                else
            {
                    echo "Published";
                    
            }
            ?></td>
            <td><?php echo anchor('bnw/editpost/'.$data->id,'Edit'); ?> / 
            <?php echo anchor('bnw/deletepost/'.$data->id,'Delete'); ?></td>
        </tr>
            <?php    
            }
        }
    ?>
    </table>
    <?php  echo $links; ?>
</div>
</div>
<div class="clear"></div>
</div><?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
?>
