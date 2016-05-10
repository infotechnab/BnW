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
            <div class="table-responsive">
    <table class="table table-bordered" >
        <thead>
            <th>Feed Email</th>
            <th>Feed</th>         
            <th>Action</th>
        </thead>
    <?php
            foreach ($news as $data){
            ?>
        <tr class="action">    
            <td><?php echo $data->email; ?></td>
            <td><?php echo $data->remarks; ?></td>            
            <td>
                <span class="del_category" id="<?php echo $data->id; ?>"><i class="fa fa-trash-o"></i></span>
            </td>
        </tr>
            <?php    
            }
        }
 else {
     echo '<h3>Sorry contact lists are not available</h3>';
 }
    ?>
    </table>
    </div>
        
</div>
</div>
<div class="clear"></div>
</div>
<script>
    $(document).ready(function(){
       $(document).on("click", ".del_category", function(){
            var id = $(this).attr("id");
            var url = '<?php echo base_url().'index.php/subscribers/deleteRemarks' ?>';
             var hideid = $(this);
            senddata({id:id,url:url,thiss:hideid});
            
       });
    });
</script>