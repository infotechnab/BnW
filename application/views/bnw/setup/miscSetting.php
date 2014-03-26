<div class="rightSide">
 

 <?php echo validation_errors();
  if(isset($error))
  {
      echo $error;
  }
  ?>

    


<h2> Miscellaneous Setting</h2>

<?php echo form_open_multipart('bnw/miscsettingupdate');?>
<h4>Default Article Setting</h4>
<input type="checkbox" >Allow people to post comment</input>
<br/><br/>
<input type="checkbox" >Allow people to like page/ post</input>
<br/><br/>
<input type="checkbox" >Allow people to share page/ post</input>
<br/><br/>

 <input type="submit" value="Submit" />
  <?php echo form_close();?>
</div>
<div class="clear"></div>
</div>