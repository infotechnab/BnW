<div class=" col-md-10 col-sm-9 col-lg-10 col-xs-8 rightside">

    
<div id="body">
    
    <h2>All Posts&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="<?php echo base_url().'index.php/offers/addpost'; ?>">Add New Post</a></h2>
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
     <br>
    <div>
        <?php echo form_open('offers/searchCategory'); ?>
        <select name="category_name">
            <option value="allPost" selected>All</option>
            <?php foreach($get_post_category as $cat){ ?>
            <option value="<?php echo $cat->post_category; ?>"><?php echo $cat->post_category; ?></option>
            <?php } ?>
        </select>
        <input type="submit" class="btn btn-default btn-sm" value="Go" >
        <?php echo form_close(); ?>
    </div>
     <br>
    <?php
    
    
         if(!empty($query)){
             ?>
        <div class="table-responsive">
        <table class="table table-bordered" >
        <thead>
            
            <th>Post Title</th>
            <th>Post Summary</th>          
            <th>Image</th>
            <th>Action</th>
        </thead>
        <?php
            foreach ($query as $data){
            ?>

        <tr class="action">
           
            <td><?php echo $data->post_title; ?></td>
            <td><?php echo strip_tags($data->post_summary); ?></td>
            
            
            
            <td>
                
                <?php if(isset($data->image)== !NULL && ($data->image)==!'' ){?> 
                <div class="imageContainer" >
                    <span>
                        <img class="srcimage" id="galleryimage" style="height:50px;width: 50px;" src="<?php echo base_url().'content/uploads/images/thumb_'.$data->image ?>" name='<?php echo $data->image; ?>' alt="<?php echo $data->image; ?>" /> 
                 <?php  }else{ echo  "Image not set";}          ?>
                </span>
                </div>
            </td>
            <td>
     <a  href='<?php echo base_url().'index.php/offers/editpost/'.$data->pid; ?>'  title=" Edit " data-placement="top" style='font-size:16px;text-decoration:none;'> <span id='$menu_id' class='editNavs    glyphicon glyphicon-edit'></span> | </a> 
     <a href="#" style='font-size:16px;text-decoration:none;'  title=" Delete "> <span  id="<?php echo $data->pid; ?>" class='del_category glyphicon glyphicon-trash'></span></a>
          
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
    <?php  echo $links; ?>
</div>
</div>
<div class="clear"></div>
</div><?php


?>
<script>
    $(document).ready(function(){
       $(document).on("click", ".del_category", function(){
           var id = $(this).attr("id");
            var url = '<?php echo base_url().'index.php/offers/deletepost' ?>';
            var hideid = $(this);
            senddata({id:id,url:url,thiss:hideid});
            
       });
    });
</script>
