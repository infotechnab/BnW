<div class="rightSide">
    
<div id="body">
    
    <h2>All Posts&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="<?php echo base_url().'index.php/offers/addpost'; ?>">Add New Post</a></h2>
     <hr class="hr-gradient"/>
    <div id="sucessmsg">
  <?php echo $this->session->flashdata('message'); ?>
    </div>
     <br>
    <div>
        <?php echo form_open('offers/searchCategory'); ?>
        <select name="category_name">
            <option value="allPost" selected>All</option>
            <?php foreach($get_post_category as $cat){ ?>
            <option value="<?php echo $cat->post_category ?>"><?php echo $cat->post_category; ?></option>
            <?php } ?>
        </select>
        <input type="submit" value="Go" class="">
        <?php echo form_close(); ?>
    </div>
     <br>
    <?php
    
    
         if(!empty($query)){
             ?>
        <table border="1" cellpadding="10" class="tbl_full_width" >
        <tr>
            
            <th>Post Title</th>
            <th>Post Summary</th>          
            <th>Image</th>
            <th>Action</th>
        </tr>
        <?php
            foreach ($query as $data){
            ?>
        <tr class="action">
           
            <td><?php echo $data->post_title ?></td>
            <td><?php echo strip_tags($data->post_summary); ?></td>
            
            
            
            <td>
                
                <?php if(isset($data->image)== !NULL && ($data->image)==!'' ){?> 
                <div class="imageContainer" style="height: 50px;width: 50px;">
                    <span>
                        <img class="srcimage" id="galleryimage" src="<?php echo base_url().'content/uploads/images/thumb_'.$data->image ?>" name='<?php echo $data->image; ?>' alt="<?php echo $data->image; ?>" /> 
                 <?php  }else{ echo  "Image not set";}          ?>
                </span>
                </div>
            </td>
            <td>
                <a href="<?php echo base_url().'index.php/offers/editpost/'.$data->pid; ?>"><i class="fa fa-pencil-square-o"></i></a> | 
                <span class="del_category" id="<?php echo $data->pid; ?>"><i class="fa fa-trash-o"></i></span>
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
        imgPos();
       $(document).on("click", ".del_category", function(){
           var id = $(this).attr("id");
            var url = '<?php echo base_url().'index.php/offers/deletepost' ?>';
            var hideid = $(this);
            senddata({id:id,url:url,thiss:hideid});
       });
    });
</script>