<div class="rightSide">
<div id="body">
    <h2>Subscribers&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="<?php echo base_url().'index.php/subscribers/viewContact'; ?>">View Contact List</a></h2>
    <hr class="hr-gradient"/>
     <div id="sucessmsg">
  <?php echo $this->session->flashdata('message'); ?>
    </div>
   
    
    
    <?php
        if(!empty($news)){
            ?>
    <table border="1" cellpadding="10" >
        <tr>
            <th>Subscriber Name</th>
            <th>Email</th>         
            <th>Action</th>
        </tr>
    <?php
            foreach ($news as $data){
            ?>
          <tr>    
            <td><?php echo $data->full_name; ?></td>
            <td><?php echo $data->email; ?></td>            
            <td><?php echo anchor('subscribers/deletesubs/'.$data->id,'Delete'); ?></td>
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
