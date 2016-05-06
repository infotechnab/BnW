<div class="rightSide">
    
<div id="body">
<style>
td {
    text-align:center;
    font-size:19px;
}


</style>
  
    <h2>All Users&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="<?php echo base_url().'index.php/user/adduser'; ?>">Add New User</a></h2>
     <hr class="hr-gradient"/>
       <div id="sucessmsg">
  <?php echo $this->session->flashdata('message'); ?>
    </div>
 <?php
    
    
        if(!empty($query)){
            ?>
    <table border="1" cellpadding="10" class="tbl_full_width" >
        <tr>
            <th>S.N.</th>
            <th>User Name</th>
            <th>ip_address</th>
            <th>attempts</th>
            <th>last_attempt-date</th>
        </tr>
         <?php $sn_count = 1;
         foreach ($query as $data){  ?>
        <tr >
            <td><?php echo $sn_count; ?></td>
           
            <td><?php echo $data->name ?></td>
            <td><?php echo $data->ip_address ?></td>
            <td><?php echo $data->user_attempts ?></td>
            <td><?php echo $data->last_attempt_date ?></td>
        
        </tr>
            <?php    $sn_count++; 
            }
        }
 else {
            echo '<h3>Sorry, users are not available</h3>';
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
            var url = '<?php echo base_url().'user/deleteuser' ?>';
            var hideid = $(this);
            senddata({id:id,url:url,thiss:hideid});
            
       });
    });
</script>
