
<div class="rightSide">

<div id="body">
     <p style="color: red;">
            <?php if(isset($token_error)){ echo $token_error;} ?>
        </p>
         <p style="color: green;">
            <?php if(isset($token_sucess)){ echo $token_sucess;} ?>
        </p>
        
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
          
            <td><?php echo anchor('dashboard/up/'.$data->id,'<img title="move up" src="'.base_url().'content/bnw/images/up.png" width="15" height="15" />'); ?> | 
            <?php echo anchor('dashboard/down/'.$data->id,'<img title="move down " src="'.base_url().'content/bnw/images/down.png" width="15" height="15" />'); ?></td>
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