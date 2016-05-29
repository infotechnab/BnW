<div class=" col-md-10 col-sm-9 col-lg-10 col-xs-8 rightside">

    <h2>Subscribers&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="<?php echo base_url().'index.php/subscribers/viewContact'; ?>">View Contact List</a></h2>
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
            <th>Subscriber Name</th>
            <th>Email</th>         
            <th>Action</th>
        </thead>
    <?php
            foreach ($news as $data){
            ?>
        <tr class="action">    
            <td><?php echo $data->full_name; ?></td>
            <td><?php echo $data->email; ?></td>            
            <td>

     <a href="#" style='font-size:16px;text-decoration:none;'  title=" Delete "> <span  id="<?php echo $data->id; ?>" class='del_category glyphicon glyphicon-trash'></span></a>

            </td>
          </tr>
            <?php    
            }
        }
 else {
     echo '<h3>Sorry subscribers are not available</h3>';
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
            var url = '<?php echo base_url().'index.php/subscribers/deletesubs' ?>';
            var hideid = $(this);
            senddata({id:id,url:url,thiss:hideid});
       });
    });
</script>