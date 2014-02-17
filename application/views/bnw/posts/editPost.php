<div class="rightSide">
 <?php
 if(isset($error))
  {
     echo $error;
  }
        if(isset($query)){
            foreach ($query as $data){
            $id = $data->id;
            $post_title= $data->post_title;
            $post_content= $data->post_content;
            
           
            $post_status= $data->post_status;
            $post_comment_status= $data->comment_status;
            $post_tags= $data->post_tags;
            $post_category_id = $data->post_category;
            $listOfCategory = $this->dbmodel->get_list_of_category();
       }
        }
    ?>
<h2>Edit Post id <?php echo $id; ?></h2>
  <?php echo validation_errors(); ?>
 
  <p id="sucessmsg">
  <?php echo $this->session->flashdata('message'); ?>
    </p>
  <?php echo form_open_multipart('bnw/updatepost');?>
  <p>Post Title:<br />
      <input type="hidden" name="id" value="<?php echo $id; ?>" >
      <input type="text" name="post_title" value="<?php echo $post_title; ?>" />
  </p>
  <p>Body:<br />
  <textarea name="page_content" id="area1" rows="5" cols="50" style="resize:none;">
      <?php echo $post_content; ?></textarea>
  </p>
  
   <p>Post Status:<br />
  <?php 
  $options = array(
                  '1'  => 'publish',
                  '0'    => 'draft');
  echo form_dropdown('post_status',$options,'1')
  ?>
  </p>
  
 <p>Post Comment Status:<br />
  <?php 
  $options = array(
                '2'=> 'public',
                  '1'  => 'as defined',
                  '0'    => 'custom');
  echo form_dropdown('comment_status',$options,'2')
  ?>
  </p>   
   <p> Post Tags : <br/>
       <input type="text" name="post_tags" /> </p>
   
   <p>Select Category:<br/>
      
       <select name="selectCategory">
                <?php
                foreach ($listOfCategory as $data)
                {
                    ?>
               <option value="<?php echo $data->category_name; ?>" selected="<?php echo $post_category_id; ?>">
                    <?php echo $data->category_name; ?>
                </option>
                
                    <?php
                }
                ?>
          
            </select>
       
   </p>
  
  <input type="submit" value="Submit" />
  <?php echo form_close();?>
<p><b>Note:</b> Max file size: 500KB, Max Width: 1024px, Max Height: 768px </p>
</div>
<div class="clear"></div>
</div>