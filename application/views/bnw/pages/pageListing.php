<div class="rightSide">
<div id="body">
    <h2>All Pages&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="<?php echo base_url().'index.php/page/addpage'; ?>">Add New Page</a></h2>
    <hr class="hr-gradient"/>
     <div id="sucessmsg">
   <?php if($this->session->flashdata('message'))
            {
            echo "<div class='alert alert-default fade in '><strong>".$this->session->flashdata('message')."</strong></div>"; 

            }?>
    </div>
    </div>
    
    <?php
        if(!empty($query)){
            ?>
    <div class="table-responsive">
    <table class="table table-hover table-bordered" >
        <thead>
            <th>Page Title</th>
            <th>Page Summary</th>         
            <th>Status</th>
            <th>Image</th>
            <th>Action</th>
        </thead>
    <?php
            foreach ($query as $data){
            ?>
        <tr class="action">    
              <td><?php echo substr($data->page_name, 0,50); ?></td>
              <td><?php echo strip_tags($data->page_summary); ?></td>            
            <td><?php if($data->page_status==0)
            {
                echo "Draft";
            }
                else
            {
                    echo "Published";
                    
            }
            ?></td>
            <td><?php if(!empty($data->images)){ ?><img src="<?php echo base_url().'content/uploads/images/'.$data->images; ?>" alt="" width="100" /> <?php }  else { echo "Image not set"; } ?></td>
            <td><?php echo anchor('page/editpage/'.$data->id,'<i class="fa fa-pencil-square-o"></i>'); ?> / 
                <span class="del_category" id="<?php echo $data->id; ?>"><i class="fa fa-trash-o"></i></span>
            </td>
        </tr>
            <?php    
            }
        }
 else {
     echo '<h3>Sorry pages are not available</h3>';
 }
    ?>
    </table>
    </div>
    <?php  echo $links; ?>
</div>
</div>
<div class="clear"></div>
</div>
<script>
    $(document).ready(function(){
       $(document).on("click", ".del_category", function(){
           var id = $(this).attr("id");
            var url = '<?php echo base_url().'index.php/page/deletepage' ?>';
            var hideid = $(this);
            senddata({id:id,url:url,thiss:hideid});
            
            
       });
    });
</script>