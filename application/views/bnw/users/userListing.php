<div class=" col-md-10 col-sm-10 col-lg-10 col-xs-10 rightSide">
    
<div id="body">
  
    <h2>All Users&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="<?php echo base_url().'index.php/user/adduser'; ?>">Add New User</a></h2>
     <hr class="hr-gradient"/>
       <div id="sucessmsg">
   <?php if($this->session->flashdata('message'))
            {
            echo "<div class='alert alert-default fade in '>".$this->session->flashdata('message')."</div>"; 

            }?>
    </div>
    </div>
 <?php
    
    
        if(!empty($query)){
            ?>
            <div class="table-responsive">
    <table class="table table-bordered" >
        <thead>
            <th>S.N.</th>
            <th>User Name</th>
            <th>First Name</th>
            <th>Last Name</th>
            <th>Email</th>
            <th>Status</th>
            <th>Type</th>
            <th>Action</th>
        </thead>
         <?php $sn_count = 1;
         foreach ($query as $data){  ?>
        <tr class="action">
            <td><?php echo $sn_count; ?></td>
           
            <td><?php echo $data->user_name ?></td>
            <td><?php echo $data->user_fname ?></td>
            <td><?php echo $data->user_lname ?></td>
            <td><?php echo $data->user_email ?></td>

            <td><?php if($data->user_status=="0")
            {
                echo "Inactive";
            }
                else
            {
                    echo "Active";
                    
            }
            ?></td>
            
            <td><?php if($data->user_type=="User")
            {
                echo "User";
            }
                else
            {
                    echo "Administrator";
                    
            }
            ?></td>
            
            <td>
  <a  href='<?php echo base_url().'user/edituser/'.$data->id; ?>'  title=" Edit " data-placement="top" style='font-size:16px;text-decoration:none;'> <span id='$menu_id' class='editNavs    glyphicon glyphicon-edit'></span> | </a> 
 <a href="#" style='font-size:16px;text-decoration:none;'  title=" Delete "> <span  id="<?php echo $data->id; ?>" class='del_category glyphicon glyphicon-trash'></span></a>

            </td>
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
