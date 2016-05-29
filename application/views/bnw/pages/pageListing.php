<div class=" col-md-10 col-sm-9 col-lg-10 col-xs-8 rightside">

<div id="body">
    <h2>All Pages&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="<?php echo base_url().'index.php/page/addpage'; ?>">Add New Page</a></h2>
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
    </div>
    
    <?php
        if(!empty($query)){
            ?>
    <div class="table-responsive">
    <table class="table table-hover table-bordered " >
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
            <td>

<a  href='<?php echo base_url().'page/editpage/'.$data->id; ?>'  title=" Edit " data-placement="top" style='font-size:16px;text-decoration:none;'> <span id='$menu_id' class='editNavs    glyphicon glyphicon-edit'></span> | </a> 
 <a href="#" style='font-size:16px;text-decoration:none;'  title=" Delete "> <span  id="<?php echo $data->id; ?>" class='del_category glyphicon glyphicon-trash'></span></a>
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


