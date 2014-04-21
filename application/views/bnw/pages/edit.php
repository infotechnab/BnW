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
 if(isset($error))
  {
     echo $error;
  }
        if(isset($query)){
            foreach ($query as $data){
           $id = $data->id;
           $name = $data->page_name;
           $body = $data->page_content;
           $summary = $data->page_summary;
           $status= $data->page_status;
           $order= $data->page_order;
           $type= $data->page_type;
           $tags= $data->page_tags;
           $comment=$data->allow_comment;
           $like=$data->allow_like;
           $share=$data->allow_share;
       }
        }
    ?>
    <div class="titleArea">
     <h2>Edit Page/ <?php echo $name; ?></h2>
<hr class="hr-gradient"/>   
    </div>
    <div id="forLeftPage"> 
 

  <?php echo validation_errors(); ?>
 
  <p id="sucessmsg">
  <?php echo $this->session->flashdata('message'); ?>
    </p>
  <?php echo form_open_multipart('bnw/updatepage');?>
  <p>Title:<br />
      <input type="hidden" name="id" value="<?php echo $id; ?>" >
      <input type="text" name="page_name" value="<?php echo $name; ?>" />
  </p>
  <p>Body:<br />
  <textarea name="page_content" id="area1" rows="5" cols="50" style="resize:none;">
      <?php echo $body; ?></textarea>
  </p>
  </div>
  
  <div id="forRightPage"> 
   <p> Order : <br/>
       <input type="text" name="page_order" /> </p>
   
   <p> Type : <br/>
       <input type="text" name="page_type" /> </p>
   
   <p> Tags : <br/>
       <input type="text" name="page_tasg "/> </p>
   
   <p>Status:<br />
  <?php 
  $options = array(
                  '1'  => 'publish',
                  '0'    => 'draft');
  echo form_dropdown('status',$options)
          
  ?>
  </p>
  
  <input type="checkbox" name="allow_comment" value="1" <?php if($set_data[0]==1 OR $comment==1 ) echo 'checked' ;?>>Allow people to post comment</input>
<br/>
<input type="checkbox" name="allow_like" value="1" <?php if($set_data[1]==1 OR $like==1 ) echo 'checked' ;?>>Allow people to like </input>
<br/>
<input type="checkbox" name="allow_share" value="1" <?php if($set_data[2]==1 OR $share==1 ) echo 'checked' ;?>>Allow people to share</input>
<br/>
  
  <input type="submit" value="Submit" />
  <?php echo form_close();?>
  
<p><b>Note:</b> Max file size: 500KB, Max Width: 1024px, Max Height: 768px </p>
</div></div>
<div class="clear"></div>
</div>