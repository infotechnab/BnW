
<div class="rightSide">
<a href="addmenu">Add New Menu</a>
<a href="addnavigation">Add Navigation</a>
<div id="body">
    <p id="sucessmsg">
  <?php if($this->session->flashdata('message')){echo $this->session->flashdata('message');}?>
    </p>
    <p>List of all Navigation</p>
    <table border="1" cellpadding="10">
        <tr>
            <th>S.N.</th>
            <th>Title</th> 
            <th>Link</th>
            <th>Parent</th>
            <th>Type</th>
            <th>Navigation Slug</th>
            <th>Menu id </th>
            <th>Action</th>
        </tr>
    
    <?php    
        if(isset($query)){
            foreach ($query as $data){
                
            ?>
          <tr>
            <td><?php echo $data->id; ?></td>
            <td><?php echo $data->navigation_name; ?></td>
            <td><?php echo $data->navigation_link; ?>  </td>
            <td><?php echo $data->parent_id; ?>  </td>
            <td><?php echo $data->navigation_type; ?>  </td>
            <td><?php echo $data->navigation_slug; ?>  </td>
            <td><?php echo $data->menu_id; ?></td>
            <td><?php echo anchor('bnw/editnavigation/'.$data->id,'Edit'); ?> / 
            <?php echo anchor('bnw/deletenavigation/'.$data->id,'Delete'); ?></td>
        </tr>
            <?php    
            }
        }
    ?>
       
    </table>
    <?php// echo $links; ?>
</div>
</div>
<div class="clear"></div>
</div>