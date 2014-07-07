<div class="rightSide">
    
<div id="body">
    <p id="sucessmsg">
  <?php echo $this->session->flashdata('message'); ?>
    </p>
    <h2>All Pages</h2>
    <hr class="hr-gradient"/>
    
    
    <?php
    
    
        if(!empty($query)){
            ?>
    <table border="1" cellpadding="10" >
        <tr>
           
            <th>Page Title</th>
            <th>Page Summary</th>         
            <th>Status</th>
            <th>Action</th>
        </tr>
    <?php
            foreach ($query as $data){
            ?>
          <tr>
            
            <td><?php echo $data->page_name ?></td>
            <td><?php echo $data->page_summary ?></td>
           
              
            
            <td><?php if($data->page_status=="Active")
            {
                echo "Draft";
            }
                else
            {
                    echo "Published";
                    
            }
            ?></td>
            <td><?php echo anchor('page/editpage/'.$data->id,'Edit'); ?> / 
            <?php echo anchor('page/deletepage/'.$data->id,'Delete'); ?></td>
        </tr>
            <?php    
            }
        }
 else {
     echo '<h3>Sorry pages are not available</h3>';
 }
    ?>
    </table>
    <?php  echo $links; ?>
</div>
</div>
<div class="clear"></div>
</div>
