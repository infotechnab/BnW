<div class="rightSide">
    <?php 
if ($miscSetting)
    
{
    $i=0;
    foreach ($miscSetting as $data)
    {        
       $set_data[$i] = $data->description;
       $i++;      
    }
 }
 ?>
    
    <?php
        if(!empty($query)){
            foreach ($query as $data){
            $id = $data->id;
            $post_title= $data->post_title;
            $post_content= $data->post_content;
            $post_image = $data->image;
           
            $post_status= $data->post_status;
            $post_comment_status= $data->comment_status;
            $post_tags= $data->post_tags;
            $post_category_id = $data->post_category;
            $comment=$data->allow_comment;
           $like=$data->allow_like;
           $share=$data->allow_share;
            $listOfCategory = $this->dbdashboard->get_list_of_category();
       }
        
    ?>
   <div class="titleArea">
     <h2>Edit Post/ <?php echo $post_title; ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="<?php echo base_url().'index.php/offers/posts'; ?>">View All</a></h2>
<hr class="hr-gradient"/>  
<div id="sucessmsg">
  <?php echo $this->session->flashdata('message');
  if(isset($error))
  {
     echo $error;
  } ?>
      <?php echo validation_errors(); ?>
    </div>
    </div> 
    <div id="forLeftPage">
 
  <?php echo form_open_multipart('offers/updatepost');?>
    <input type="hidden" name="hidden_image" value="<?php echo $post_image; ?>"/>
  <p>Offer Title:<br />
      <input type="hidden" name="id" value="<?php echo $id; ?>" >
      <input type="text" name="post_title" value="<?php echo $post_title; ?>" />
  </p>
  <p>Body:<br />
  <textarea name="post_content" id="area1" rows="5" cols="50" style="resize:none;">
      <?php echo $post_content; ?></textarea>
  </p>
   <?php if($post_image==!NULL) { ?> <div  >
    <div style="width:85px; height: 85px;">
    <img src="<?php echo base_url()."content/uploads/images/".$post_image; ?>" width="80" height="80" alt="<?php echo $post_image; ?>" />
    </div>
             <a href="<?php echo base_url();?>index.php/offers/offerImgdelete/?id=<?php echo $id; ?> " id="<?php echo $id; ?>" class="delbutton">
        <img src="<?php echo base_url();?>content/bnw/images/delete.png" id="close"/></a>
    </div> <?php }?>
  <p>
      Image:<br/> 
      <input type="file" name="file" />
  </p>
  
   <input type="submit" value="Submit" />
  <?php echo form_close();?>
  <p><b>Note:</b> Max file size: 500KB, Max Width: 1024px, Max Height: 768px </p> 
   <?php } else{
     echo '<h3 id="sucessmsg">Sorry! the post is not found.</h3>';
        } ?>
    </div>
    
   <!-- <div id="forRightPage">
  
   <p>Post Status:<br />
  <?php 
  /* $options = array(
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
            */    ?>
          
            </select>
       
   </p>
   
   <input type="checkbox" name="allow_comment" value="1" <?php //if($set_data[0]==1 OR $comment==1 ) echo 'checked' ;?> >Allow people to post comment</input>
<br/>
<input type="checkbox" name="allow_like" value="1" <?php //if($set_data[1]==1 OR $like==1 ) echo 'checked' ;?> >Allow people to like </input>
<br/>
<input type="checkbox" name="allow_share" value="1" <?php //if($set_data[2]==1 OR $share==1 ) echo 'checked' ;?> >Allow people to share</input>
<br/>
  
 
<p><b>Note:</b> Max file size: 500KB, Max Width: 1024px, Max Height: 768px </p>
    </div>-->
 </div>
<div class="clear"></div>
</div>