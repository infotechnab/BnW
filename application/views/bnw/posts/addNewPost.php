<div class="rightSide"> 
    <div id="forLeftPage">
<h2>Add new post</h2>
  <?php echo validation_errors();
  if(isset($error))
  {
      echo $error;
  }
  ?>
<p id="sucessmsg">
  <?php if($this->session->flashdata('message')){echo $this->session->flashdata('message');}?>
</p>
  <?php echo form_open_multipart('bnw/addpost');?>
  
  <p>Post Title:<br />
  <input type="text" name="post_title" value="<?php echo set_value('post_title'); ?>" />
  </p>
  <p>Body:<br />
      <textarea name="post_content" id="area1" cols="50" rows="5" ><?php echo set_value('post_content'); ?></textarea>
  
  </p>   
    </div>
    
    <div id="forRightPage"> 
    
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
                '2'=> 'as defined',
                  '1'  => 'public',
                  '0'    => 'custom');
  echo form_dropdown('comment_status',$options,'1')
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
                <option value="<?php echo $data->category_name; ?>">
                    <?php echo $data->category_name; ?>
                </option>
                    <?php
                }
                ?>
          
            </select>
       
   </p>
  
  <input type="submit" value="Submit" />
  <?php echo form_close();?>
  </div>
</div>
<div class="clear"></div>
</div>