<?php $this->load->helper("summary_helper"); ?>
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
           $image = $data->images;
       }
        
    ?>
    <div class="titleArea">
        <h2>Edit Page/ <?php echo custom_echo_ed($name); ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="<?php echo base_url().'index.php/page/pages'; ?>">View All</a></h2>
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
    <div id=""> 
 

  
 
  
  <?php echo form_open_multipart('page/updatepage');?>
  <p class="dashuppe-text-all">Title *<br />
      <input type="hidden" name="id" value="<?php echo $id; ?>" >
      <input type="text" class="textInput" name="page_name" value="<?php echo htmlentities($name); ?>" />
  </p>
  <p class="dashuppe-text-all">Body *<br />
  <textarea name="page_content" id="textara" rows="5" cols="50" style="resize:none;">
      <?php echo $body; ?></textarea>
  </p>
  
   <?php if (!empty($image)) { ?> 
                <div style="border: 1px solid #eee;padding: 1%;display: inline-block;min-height: 100px;">
                    <div style="">
                        <img src="<?php echo base_url() . "content/uploads/images/" . $image; ?>" width="80" height="80" alt="<?php echo $image; ?>" />
                    </div>
                    <div style="text-align: center;">
                    <a href="<?php echo base_url(); ?>index.php/page/pageImgdelete/?id=<?php echo $id; ?> " title="Delete" id="<?php echo $id; ?>" class="delbutton">
                        <i class="fa fa-trash-o" id="close"></i>
                    </a>
                    </div>
                    <input type="hidden" name="imageName" value="<?php echo $image; ?>">
                </div> <?php } ?>
            <p class="dashuppe-text-all">Image<br/> 
                <input id="uploadImage" class="textInput" type="file" name="file" accept="image/*"/>
                <!-- hidden inputs -->
                <input type="hidden" id="x" name="x" />
                <input type="hidden" id="y" name="y" />
                <input type="hidden" id="w" name="w" />
                <input type="hidden" id="h" name="h" /> 
            </p>
            <div data-toggle="buttons" id="mybutton" class="btn-group btn-group-justified">
            <label title="Set Aspect Ratio" data-option="1.7777777777777777" data-method="setAspectRatio" class="btn btn-primary active">
                <input type="radio" value="1.7777777777777777" name="aspestRatio" id="aspestRatio1" class="sr-only">16:9
            </label>
            <label title="Set Aspect Ratio" data-option="1.3333333333333333" data-method="setAspectRatio" class="btn btn-primary">
                <input type="radio" value="1.3333333333333333" name="aspestRatio" id="aspestRatio2" class="sr-only" checked="checked">4:3
            </label>
            <label title="Set Aspect Ratio" data-option="1" data-method="setAspectRatio" class="btn btn-primary">
                <input type="radio" value="1" name="aspestRatio" id="aspestRatio3" class="sr-only">1:1
            </label>
            <label title="Set Aspect Ratio" data-option="0.6666666666666666" data-method="setAspectRatio" class="btn btn-primary">
                <input type="radio" value="0.6666666666666666" name="aspestRatio" id="aspestRatio4" class="sr-only">2:3
            </label>
            <label title="Set Aspect Ratio" data-option="NaN" data-method="setAspectRatio" class="btn btn-primary">
                <input type="radio" value="NaN" name="aspestRatio" id="aspestRatio5" class="sr-only">Free
            </label>
        </div>
            <img id="uploadPreview" style="display:none;width:1000px;"/>
            
 
  </div>
  
  <div id=""> 
   <p class="dashuppe-text-all">Order<br/>
       <input type="text" class="textInput" name="page_order" /> </p>
   
   <p class="dashuppe-text-all">Type<br/>
       <input type="text" class="textInput" name="page_type" /> </p>
   
   <p class="dashuppe-text-all">Tags<br/>
       <input type="text" class="textInput" name="page_tasg "/> </p>
   
   <p class="dashuppe-text-all">Status<br />
  <?php $options = array('1'  => 'publish','0'    => 'draft');?>
       <select class="textInput" name="page_status">
         
         <?php foreach ($options as $key=>$data){ ?>
         <option value="<?php echo $key; ?>"><?php echo $data; ?></option>
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
  
        <?php } else{
     echo '<h3 id="sucessmsg">Sorry! the page is not found.</h3>';
        } ?>
</div></div>
<div class="clear"></div>
</div>