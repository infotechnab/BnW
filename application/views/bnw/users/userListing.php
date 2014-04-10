<div class="rightSide">
    
<div id="body">
    <p id="sucessmsg">
  <?php echo $this->session->flashdata('message'); ?>
    </p>
    <h2>List of all Users</h2>
    <table border="1" cellpadding="10">
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
    
    <?php
    
    
        if($query){
            foreach ($query as $data){
            ?>
          <tr>
            <td><?php echo $data->id ?></td>
            <td><?php echo $data->user_name ?></td>
            <td><?php echo $data->user_fname ?></td>
            <td><?php echo $data->user_lname ?></td>
            <td><?php echo $data->user_email ?></td>

            <td><?php if($data->user_status=="0")
            {
                echo "Draft";
            }
                else
            {
                    echo "Published";
                    
            }
            ?></td>
            
            <td><?php if($data->user_type=="1")
            {
                echo "User";
            }
                else
            {
                    echo "Administrator";
                    
            }
            ?></td>
            
            <td><?php echo anchor('bnw/edituser/'.$data->id,'Edit'); ?> / 
            <?php echo anchor('bnw/deleteuser/'.$data->id,'Delete'); ?></td>
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

