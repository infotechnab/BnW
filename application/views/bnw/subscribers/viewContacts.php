<div class="rightSide">
<div id="body">
    <h2>Subscribers&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="<?php echo base_url().'index.php/subscribers/viewSubscriber'; ?>">View Newsletter Subscriber</a></h2>
    <hr class="hr-gradient"/>
     <div id="sucessmsg">
  <?php echo $this->session->flashdata('message'); ?>
    </div>
    
    <?php
        if(!empty($news)){
            ?>
    <table border="1" cellpadding="10" >
        <tr>
            <th>Feed Email</th>
            <th>Feed</th>         
            <th>Action</th>
        </tr>
    <?php
            foreach ($news as $data){
            ?>
          <tr>    
            <td><?php echo $data->email; ?></td>
            <td><?php echo $data->remarks; ?></td>            
            <td><?php echo anchor('subscribers/deleteRemarks/'.$data->id,'Delete'); ?></td>
        </tr>
            <?php    
            }
        }
 else {
     echo '<h3>Sorry pages are not available</h3>';
 }
    ?>
    </table>
        
</div>
</div>
<div class="clear"></div>
</div>
