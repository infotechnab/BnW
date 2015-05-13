
<div class="rightSide">

<div id="body">
    <p id="sucessmsg">
  <?php if($this->session->flashdata('message')){echo $this->session->flashdata('message');}?>
    </p>
    <h2>List of Navigation</h2>
    <hr class="hr-gradient"/>
    <?php    
        if(!empty($query)){
            ?>
    <table border="1" cellpadding="10">
        <tr>
            <th>S.N.</th>
            <th>Title</th> 
            <th>Link</th>
            <th>Parent</th>
            <th>Type</th>
            <th>Navigation Slug</th>
            
            <th>Action</th>
        </tr>
    
    <?php
            foreach ($query as $data){
                
            ?>
          <tr>
            <td><?php echo $data->id; ?></td>
            <td><?php echo $data->navigation_name; ?></td>
            <td><?php echo $data->navigation_link; ?>  </td>
            <td><?php echo $data->parent_id; ?>  </td>
            <td><?php echo $data->navigation_type; ?>  </td>
            <td><?php echo $data->navigation_slug; ?>  </td>
            
            <td><?php echo anchor('dashboard/editnavigation/'.$data->id,'Edit'); ?> / 
            <?php echo anchor('dashboard/deletenavigation/'.$data->id,'Delete'); ?></td>
        </tr>
            <?php    
            }
        }
 else {
            echo '<h3>Sorry navigation items are not available</h3>';
 }
    ?>
       
    </table>
   
</div>
</div>
<div class="clear"></div>
</div>