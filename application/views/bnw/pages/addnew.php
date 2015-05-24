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
     <h2>Add new page&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="<?php echo base_url().'index.php/page/pages'; ?>">View All</a></h2>
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

  

  <?php echo form_open_multipart('page/addpage');?>
  
  <p class="dashuppe-text-all">Title<br />
  <input type="text" class="textInput" name="page_name" value="<?php echo set_value('page_name'); ?>" />
  </p>
  <p class="dashuppe-text-all">Body<br />
      <textarea name="page_content" id="textara" cols="50" rows="5" ><?php echo set_value('page_content'); ?></textarea>
  </p>    
  
  <p class="dashuppe-text-all">Image<br />
     <input id="uploadImage" class="textInput" type="file" name="file" accept="image/*"/>
     <!-- hidden inputs -->
		<input type="hidden" id="x" name="x" />
		<input type="hidden" id="y" name="y" />
		<input type="hidden" id="w" name="w" />
		<input type="hidden" id="h" name="h" /> 
  </p> 
   <img id="uploadPreview" style="display:none;width:1000px;"/>
  
    </div>
    
    <div id="forRightPage"> 
  
   <p class="dashuppe-text-all">Order<br/>
       <input type="text" class="textInput" name="page_order" /> </p>
   
   <p class="dashuppe-text-all">Type<br/>
       <input type="text" class="textInput" name="page_order" /> </p>
   
   <p class="dashuppe-text-all">Tags<br/>
       <input type="text" class="textInput" name="page_order" /> </p>
   <p class="dashuppe-text-all">Status<br />  
  <?php $options = array('1'  => 'publish','0'    => 'draft');?>
       <select class="textInput" name="status">
         
         <?php foreach ($options as $data){ ?>
         <option value="<?php echo $data; ?>"><?php echo $data; ?></option>
         <?php } ?>
     </select>
  </p>
<input type="checkbox" name="allow_comment" value="1" <?php if($set_data[0]==1) echo 'checked' ;?> >Allow people to post comment</input>
<br/>
<input type="checkbox" name="allow_like" value="1" <?php if($set_data[1]==1) echo 'checked' ;?> >Allow people to like </input>
<br/>
<input type="checkbox" name="allow_share" value="1" <?php if($set_data[2]==1) echo 'checked' ;?> >Allow people to share</input>
<br/>
  
  <input type="submit" class="btn btn-primary btn-lg" value="Submit" />
  <?php echo form_close();?>
    </div>
    <div class="clear"></div>
</div>
<div class="clear"></div>
</div>