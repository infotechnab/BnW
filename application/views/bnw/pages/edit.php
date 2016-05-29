<?php $this->load->helper("summary_helper"); ?>
<div class=" col-md-10 col-sm-9 col-lg-10 col-xs-8 rightside">

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
  <?php if($this->session->flashdata('message'))
            {
            echo "<div class='alert alert-default fade in '>".$this->session->flashdata('message')."</div>"; 

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
    </div>
    <div id=""> 
 

  
 
  
  <?php echo form_open_multipart('page/updatepage');?>
  <div class="form-group">
 <label>Title </label>
      <input type="hidden" name="id" value="<?php echo $id; ?>" >
      <input type="text" class="form-control" name="page_name" value="<?php echo htmlentities($name); ?>" />
</div>
<div class="form-group">
 <label>Body </label>
  <textarea name="page_content" id="textara" rows="15" cols="50" style="resize:none;">
      <?php echo $body; ?></textarea>
</div>
  
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
           <label>Image</label> 
                <input id="uploadImage" class="form-control" type="file" name="file" accept="image/*"/>
                <!-- hidden inputs -->
                <input type="hidden" id="x" name="x" />
                <input type="hidden" id="y" name="y" />
                <input type="hidden" id="w" name="w" />
                <input type="hidden" id="h" name="h" /> 
          </div>
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
       <img id="uploadPreview" class="img-responsive"  style="display:none;border:3px solid #ccc;box-shadow: 10px 10px 5px #888888;height:600px;"/>
      <div class="form-group">
           <label>Select Template</label>  
  <?php $options = array('1'  => 'Default ( full width )','2' => 'With left sidebar' ,'3' => 'With right sidebar');?>
       <select class="form-control" name="page_status">
         
         <?php foreach ($options as $key=>$data){ ?>
         <option value="<?php echo $key; ?>"><?php echo $data; ?></option>
         <?php } ?>
     </select>
</div>
 
<div class="form-group">
  <label>Order</label>
       <input type="text" class="form-control" name="page_order" /> 
   </div>
   <div class="form-group">
  <label>Type</label>
       <input type="text" class="form-control" name="page_type" />
   </div>
   <div class="form-group">
  <label>Tags</label>
   <input type="text" class="form-control" name="page_tasg "/> 
   </div>
   <div class="form-group">
  <label>Status</label>
  <?php $options = array('1'  => 'publish','0'    => 'draft');?>
       <select class="form-control" name="page_status">
         
         <?php foreach ($options as $key=>$data){ ?>
         <option value="<?php echo $key; ?>"><?php echo $data; ?></option>
         <?php } ?>
     </select>
</div>
  <div class="form-group">
 <p> <input type="checkbox" name="allow_comment" value="1" <?php if($set_data[0]==1 OR $comment==1 ) echo 'checked' ;?>>Allow people to post comment</input></p>
 <p><input type="checkbox" name="allow_like" value="1" <?php if($set_data[1]==1 OR $like==1 ) echo 'checked' ;?>>Allow people to like </input></p>
 <p><input type="checkbox" name="allow_share" value="1" <?php if($set_data[2]==1 OR $share==1 ) echo 'checked' ;?>>Allow people to share</input></p>
</div>
  <div class="form-group">
  <input type="submit" class="btn btn-default btn-lg btn-block" value="Submit" />
 
</div>
 <?php echo form_close();?>
  
        <?php } else{
     echo '<h3 id="sucessmsg">Sorry! the page is not found.</h3>';
        } ?></div>
<div class="clear"></div>
</div>