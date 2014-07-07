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

 <?php echo validation_errors();
  if(isset($error))
  {
      echo $error;
  }
  ?>

    


<h2> Miscellaneous Setting</h2>
<hr class="hr-gradient"/>

<?php echo form_open_multipart('setting/miscsettingupdate');?>
<h4>Default Article Setting</h4>
<input type="checkbox" name="allow_comment" value="1" <?php if($set_data[0]==1) echo 'checked' ;?> >Allow people to post comment</input>
<br/><br/>
<input type="checkbox" name="allow_like" value="1" <?php if($set_data[1]==1) echo 'checked' ; ?> >Allow people to like page/ post</input>
<br/><br/>
<input type="checkbox" name="allow_share" value="1" <?php if($set_data[2]==1) echo 'checked' ; ?> >Allow people to share page/ post</input>
<br/>
<p>Number of post to show at most:
<input type="text" name="max_post_to_show" size="2" value="<?php echo $set_data[3]; ?>" required/> posts</p>
<p>Number of pages to show at most:
<input type="text" name="max_page_to_show" size="2" value="<?php echo $set_data[4]; ?>" required/> pages</p>
<h4>Slide Setting</h4>
<p>Slide Height:<br/>
<input type="text" name="slide_height" value="<?php echo $set_data[5]; ?>" required/></p>
<p>Slide Width:<br/>
<input type="text" name="slide_width" value="<?php echo $set_data[6]; ?>" required/></p>



 <input type="submit" value="Submit" />
  <?php echo form_close();?>
 
 
 
 
 
 
 
 
</div>

<div class="clear"></div>
</div>