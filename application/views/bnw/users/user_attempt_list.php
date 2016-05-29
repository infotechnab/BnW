<div class=" col-md-10 col-sm-10 col-lg-10 col-xs-10 rightSide">
    
    <div id="body">
      
        
        <h2>All attempted users&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</h2>
        <hr class="hr-gradient"/>
        <div id="sucessmsg">
          <?php echo $this->session->flashdata('message'); ?>
      </div>
      <?php
      
      
      if(!empty($query)){
        ?>
        <div class="table-responsive">
        <table class="table table-bordered" >
            <thead>
                <th>S.N.</th>
                <th>User Name</th>
                <th>ip_address</th>
                <th>attempts</th>
                <th>last_attempt-date</th>
            </thead>
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
         var url = '<?php echo base_url().'user/deleteuser' ?>';
         var hideid = $(this);
         senddata({id:id,url:url,thiss:hideid});
         
     });
 });
</script>
