<div class="rightSide">
    
<div id="body">
    <p id="sucessmsg">
  <?php echo $this->session->flashdata('message'); ?>
    </p>
    <h2>All Pages</h2>
    <hr class="hr-gradient"/>
    <table border="1" cellpadding="10" >
        <tr>
           
            <th>Page</th>
            <th>Page Summary</th>
            
            
            <th>Status</th>
            <th>Action</th>
        </tr>
    
    <?php
    
    
        if($query){
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
            <td><?php echo anchor('bnw/editpage/'.$data->id,'Edit'); ?> / 
            <?php echo anchor('bnw/deletepage/'.$data->id,'Delete'); ?></td>
        </tr>
            <?php    
            }
        }
    ?>
    </table>
    <?php  echo $links; ?>
</div>
</div>
<div class="clear"></div>
</div><?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
?>
