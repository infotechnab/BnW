<div class=" col-md-10 col-sm-9 col-lg-10 col-xs-8 rightside">
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

<h2> Miscellaneous Setting</h2>
<hr class="hr-gradient"/>

<div id="sucessmsg">
  <?php if($this->session->flashdata('misc'))
            {
            echo "<div class='alert alert-default fade in '>".$this->session->flashdata('misc')."</div>"; 

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

<?php echo form_open_multipart('setting/miscsettingupdate');?>

<h3>Default Article Setting</h3>
<label><input type="checkbox" name="allow_comment" value="1" <?php if($set_data[0]==1) echo 'checked' ;?> >Allow people to post comment</label>
<br/><br/>
<label><input type="checkbox" name="allow_like" value="1" <?php if($set_data[1]==1) echo 'checked' ; ?> >Allow people to like page/ post</label>
<br/><br/>
<label><input type="checkbox" name="allow_share" value="1" <?php if($set_data[2]==1) echo 'checked' ; ?> >Allow people to share page/ post</label>
<br/>

<div class="form-group">
<label>Number of post to show at most:</label>
<input type="text" class="form-control" name="max_post_to_show" size="2" value="<?php echo $set_data[3]; ?>" required/>
</div>

<div class="form-group">
<label>Number of pages to show at most: </label>
<input type="text" class="form-control" name="max_page_to_show" size="2" value="<?php echo $set_data[4]; ?>" required/>
</div>

<h4>Slide Setting</h4>
<hr>

<div class="form-group">
<label>Slide Height:</label>
<input type="text" class="form-control" name="slide_height" value="<?php echo $set_data[5]; ?>" required/>
</div>

<div class="form-group">
<label>Slide Width</label>
<input type="text" class="form-control" name="slide_width" value="<?php echo $set_data[6]; ?>" required/>
</div>

<div class="form-group">
 <input class="btn btn-default btn-lg  btn-block" type="submit" value="Submit" />
 </div>

<?php echo form_close();?>
</div>
</div>
</div>
 
 
 