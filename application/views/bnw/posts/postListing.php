<div class="rightSide">
    
<div id="body">
    
    <h2>All Posts&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="<?php echo base_url().'index.php/offers/addpost'; ?>">Add New Post</a></h2>
     <hr class="hr-gradient"/>
    <div id="sucessmsg">
  <?php echo $this->session->flashdata('message'); ?>
    </div>
    
    <?php
    
    
         if(!empty($query)){
             ?>
        <table border="1" cellpadding="10">
        <tr>
            
            <th>Post Title</th>
            <th>Post Summary</th>          
            <th>Image</th>
            <th>Category</th>
            <th>Action</th>
        </tr>
        <?php
            foreach ($query as $data){
            ?>
          <tr>
           
            <td><?php echo $data->post_title ?></td>
            <td><?php echo $data->post_summary ?></td>
            
            
            
            <td><?php if(isset($data->image)== !NULL && ($data->image)==!'' ){?> <img src="<?php echo base_url().'content/uploads/images/thumb_'.$data->image ?>" width="80" alt="<?php echo $data->image; ?>" />  <?php  }else{ echo  "Image not set";}          ?></td>
            <td><?php  
//            $catID = $this->dbdashboard->findcategory($data->post_category);
            
                echo $data->post_category;
            
            ?>
            </td>
            <td>
                <a href="<?php echo base_url().'index.php/offers/editpost/'.$data->id; ?>"><i class="fa fa-pencil-square-o"></i></a> | 
                <span class="del_category" id="<?php echo $data->id; ?>"><i class="fa fa-trash-o"></i></span>
            </td>
        </tr>
            <?php    
            }
        }
        else{
            echo '<h3>Sorry offer are not available</h3>';
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
<script>
    $(document).ready(function(){
       $(document).on("click", ".del_category", function(){
           var id = $(this).attr("id");
            $(this).confirm();
            var url = '<?php echo base_url().'index.php/offers/deletepost' ?>';
            $(this).confirm.yes({id:id,url:url});
            $(this).confirm.no();
            $(this).parent().parent().remove();
       });
    });
</script>