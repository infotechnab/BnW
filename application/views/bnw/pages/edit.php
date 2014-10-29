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
        
    ?>
    <div class="titleArea">
     <h2>Edit Page/ <?php echo $name; ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="<?php echo base_url().'index.php/page/pages'; ?>">View All</a></h2>
<hr class="hr-gradient"/> 
<div id="sucessmsg">
  <?php echo $this->session->flashdata('message');
  if(isset($error))
  {
     echo $error;
  }?>
      <?php echo validation_errors(); ?>
    </div>
    </div>
    <div id="forLeftPage"> 
 

  
 
  
  <?php echo form_open_multipart('page/updatepage');?>
  <p class="dashuppe-text-all">Title<br />
      <input type="hidden" name="id" value="<?php echo $id; ?>" >
      <input type="text" class="textInput" name="page_name" value="<?php echo $name; ?>" />
  </p>
  <p class="dashuppe-text-all">Body<br />
  <textarea name="page_content" id="area1" rows="5" cols="50" style="resize:none;">
      <?php echo $body; ?></textarea>
  </p>
  </div>
  
  <div id="forRightPage"> 
   <p class="dashuppe-text-all">Order<br/>
       <input type="text" class="textInput" name="page_order" /> </p>
   
   <p class="dashuppe-text-all">Type<br/>
       <input type="text" class="textInput" name="page_type" /> </p>
   
   <p class="dashuppe-text-all">Tags<br/>
       <input type="text" class="textInput" name="page_tasg "/> </p>
   
   <p class="dashuppe-text-all">Status<br />
  <?php $options = array('1'  => 'publish','0'    => 'draft');?>
       <select class="textInput" name="min">
         
         <?php foreach ($options as $data){ ?>
         <option value="<?php echo $data; ?>"><?php echo $data; ?></option>
         <?php } ?>
     </select>
  </p>
  
  <input type="checkbox" name="allow_comment" value="1" <?php if($set_data[0]==1 OR $comment==1 ) echo 'checked' ;?>>Allow people to post comment</input>
<br/>
<input type="checkbox" name="allow_like" value="1" <?php if($set_data[1]==1 OR $like==1 ) echo 'checked' ;?>>Allow people to like </input>
<br/>
<input type="checkbox" name="allow_share" value="1" <?php if($set_data[2]==1 OR $share==1 ) echo 'checked' ;?>>Allow people to share</input>
<br/>
  
  <input type="submit" class="btn btn-primary btn-lg" value="Submit" />
  <?php echo form_close();?>
  
  <p><b>Note:</b> Max file size: 500KB, Max Width: 1024px, Max Height: 768px </p>
        <?php } else{
     echo '<h3 id="sucessmsg">Sorry! the page is not found.</h3>';
        } ?>
</div></div>
<div class="clear"></div>
</div>