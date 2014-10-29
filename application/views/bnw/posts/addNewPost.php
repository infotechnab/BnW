
 <link rel="stylesheet" type="text/css" href="<?php echo base_url().'content/bnw/styles/imgareaselect-animated.css'; ?>" />
 <script type="text/javascript" src="<?php echo base_url().'content/bnw/scripts/jquery.imgareaselect.pack.js'; ?>"></script>
	<script type="text/javascript" src="<?php echo base_url().'content/bnw/script/script.js'; ?>"></script>
<div class="rightSide">
    <?php 
if ($query)
    
{
    $i=0;
    foreach ($query as $data)
    {        
       $set_data[$i] = $data->description;
       $i++;      
    }
 }
 ?>
    <div class="titleArea">
     <h2>Add new Post&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="<?php echo base_url().'index.php/offers/posts'; ?>">View All</a></h2>
<hr class="hr-gradient"/>  
<div id="sucessmsg">
  <?php if($this->session->flashdata('message')){echo $this->session->flashdata('message');}?>
      <?php echo validation_errors();
  if(isset($error))
  {
      echo $error;
  }
  ?>
</div>
    </div>
    
    <div id="forLeftPage">

  

  <?php echo form_open_multipart('offers/addpost');?>
  
  <p class="dashuppe-text-all">Post Title<br />
  <input type="text" class="textInput" name="post_title" value="<?php echo set_value('post_title'); ?>" />
  </p>
  <p class="dashuppe-text-all">Body<br />
      <textarea name="post_content" id="area1" cols="50" rows="5" ><?php echo set_value('post_content'); ?></textarea>
  
  </p> 
  <p class="dashuppe-text-all">Image<br />
      <input id="uploadImage" class="textInput" type="file" name="file" />
     <!-- hidden inputs -->
		<input type="hidden" id="x" name="x" />
		<input type="hidden" id="y" name="y" />
		<input type="hidden" id="w" name="w" />
		<input type="hidden" id="h" name="h" /> 
  </p> 
  <img id="uploadPreview" style="display:none;width:1000px;"/>
   <input type="submit" class="btn btn-primary btn-lg" value="Submit" />
  <?php echo form_close();?>
 
    </div>
    
    <div id="forRightPage"> 
    
 
   
 <!--   <input type="checkbox" name="allow_comment" value="1" <?php //if($set_data[0]==1) echo 'checked' ;?> >Allow people to post comment</input>
<br/>
<input type="checkbox" name="allow_like" value="1" <?php // if($set_data[1]==1) echo 'checked' ;?> >Allow people to like </input>
<br/>
<input type="checkbox" name="allow_share" value="1" <?php //if($set_data[2]==1) echo 'checked' ;?> >Allow people to share</input>
<br/> -->
  
 
  </div>
</div>
<div class="clear"></div>
</div>

<!--
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
       
   </p>--> */ ?>