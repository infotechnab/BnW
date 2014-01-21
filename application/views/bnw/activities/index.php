<div class="rightSide">

<div id="body">
    
     <p id="sucessmsg">
  <?php if($this->session->flashdata('message')){echo $this->session->flashdata('message');}?>
    </p>
    <p>List of News and Events</p>
    <table border="1" cellpadding="10">
        <tr>
            <th>S.N.</th>
            <th>News & Events </th>  
            <th> Image </th>
            <th>Action</th>
        </tr>
    
    <?php
    
    
        if($query){
            foreach ($query as $data){
            ?>
          <tr>
            <td><?php echo $data->id ?></td>
            <td><?php echo $data->title ?></td>
             <?php $image = $data->image;
                if(($image=='')|| ($image=='0'))
                {
                    $image = 'Image not set'; ?>
            <td> <?php echo $image; ?></td>
              <?php   } else {
?><td><img src="<?php echo base_url();?>uploads/<?php echo $image;?>" widht="50px" height="50px" />  </td> <?php } ?>
            <td><?php echo anchor('bnw/editactivities/'.$data->id,'Edit') ?> / <?php echo anchor('bnw/deleteactivities/'.$data->id,'Delete') ?></td>
      
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