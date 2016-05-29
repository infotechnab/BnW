<div class=" col-md-10 col-sm-9 col-lg-10 col-xs-8 rightside">


    <h2>Subscribers&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="<?php echo base_url().'index.php/subscribers/viewSubscriber'; ?>">View Newsletter Subscriber</a></h2>
    <hr class="hr-gradient"/>
   
<div id="sucessmsg">
  <?php if($this->session->flashdata('message'))
            {
            echo "<div class='alert alert-default fade in '>".$this->session->flashdata('message')."</div>"; 

            }?>
    <?php $validation_errors= validation_errors();
    if(isset($validation_errors)){
     echo "<div class='error'>".$validation_errors."</div>"; 

    }
  if(isset($error))
  {
         echo "<div class='error'>".$error."</div>"; 
       }
  ?>
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
            
     <a href="#" style='font-size:16px;text-decoration:none;'  title=" Delete "> <span  id="<?php echo $data->id; ?>" class='del_category glyphicon glyphicon-trash'></span></a>
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