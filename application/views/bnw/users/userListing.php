<div class="rightSide">
    
<div id="body">
  
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
            <th>First Name</th>
            <th>Last Name</th>
            <th>Email</th>
            <th>Status</th>
            <th>Type</th>
            <th>Action</th>
        </tr>
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
                <a href="<?php echo base_url().'user/edituser/'.$data->id; ?>"><i class="fa fa-pencil-square-o"></i></a> / 
                <span class="del_category" id="<?php echo $data->id; ?>"><i class="fa fa-trash-o"></i></span>
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
