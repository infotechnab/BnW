<div class="rightSide">

<div id="body">
    <p id="sucessmsg">
  <?php if($this->session->flashdata('message')){echo $this->session->flashdata('message');}?>
    </p>
    <h2>All slides</h2>
    <table border="1" cellpadding="10">
        <tr>
           
            <th>Title</th> 
            <th>Image</th>
            <th>Content</th>
            <th>Action</th>
        </tr>
    
    <?php
    
    
        if(isset($query)){
            foreach ($query as $data){
            ?>
          <tr>
            
            <td><?php echo $data->slide_name ?></td>
            <td><img src="<?php echo base_url()."content/images/".$data->slide_image; ?>" width="50px" height="50px" />  </td>
            <td><?php echo $data->slide_content ?></td>
            <td><?php echo anchor('bnw/editslider/'.$data->id,'Edit'); ?> / 
            <?php echo anchor('bnw/delslider/'.$data->id,'Delete'); ?></td>
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