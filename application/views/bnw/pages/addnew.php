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
    
    <div id="">   

  

  <?php echo form_open_multipart('page/addpage');?>
 <div class="form-group"> 
  <label>Title</label>
  <input type="text" class="form-control" name="page_name" value="<?php echo set_value('page_name'); ?>" />
</div>
 <div class="form-group">
  <label>Body</label>
      <textarea name="page_content" id="textara" cols="50" rows="15" ><?php echo set_value('page_content'); ?></textarea>
  </div> 
  
  <p class="dashuppe-text-all">Image<br />
     <input id="uploadImage" class="textInput" type="file" name="file" accept="image/*"/>
     <!-- hidden inputs -->
		<input type="hidden" id="x" name="x" />
		<input type="hidden" id="y" name="y" />
		<input type="hidden" id="w" name="w" />
		<input type="hidden" id="h" name="h" /> 
  </p> 
  <hr>

  <div data-toggle="buttons" id="mybutton" >
            <label title="Set Aspect Ratio" data-option="1.7777777777777777" data-method="setAspectRatio" class="radio-inline">
                <input type="radio" value="1.7777777777777777" name="aspestRatio" id="aspestRatio1" class="sr-only">16:9
            </label>
            <label title="Set Aspect Ratio" data-option="1.3333333333333333" data-method="setAspectRatio" class="radio-inline">
                <input type="radio" value="1.3333333333333333" name="aspestRatio" id="aspestRatio2" class="sr-only" checked="checked">4:3
            </label>
            <label title="Set Aspect Ratio" data-option="1" data-method="setAspectRatio" class="radio-inline">
                <input type="radio" value="1" name="aspestRatio" id="aspestRatio3" class="sr-only">1:1
            </label>
            <label title="Set Aspect Ratio" data-option="0.6666666666666666" data-method="setAspectRatio" class="radio-inline">
                <input type="radio" value="0.6666666666666666" name="aspestRatio" id="aspestRatio4" class="sr-only">2:3
            </label>
            <label title="Set Aspect Ratio" data-option="NaN" data-method="setAspectRatio" class="radio-inline">
                <input type="radio" value="NaN" name="aspestRatio" id="aspestRatio5" class="sr-only">Free
            </label>
        </div>
        <hr>
  <img id="uploadPreview" class="img-responsive"  style="display:none;border:3px solid #ccc;box-shadow: 10px 10px 5px #888888;height:600px;"/>
   
   <p class="dashuppe-text-all">Select Template<br />  
  <?php $options = array('1'  => 'Default ( full width )','2' => 'With left sidebar' ,'3' => 'With right sidebar');?>
       <select class="textInput" name="page_status">
         
         <?php foreach ($options as $key=>$data){ ?>
         <option value="<?php echo $key; ?>"><?php echo $data; ?></option>
         <?php } ?>
     </select>
  </p>
  
    </div>
    
    <div id=""> 
  
   <p class="dashuppe-text-all">Order<br/>
       <input type="text" class="textInput" name="page_order" /> </p>
   
   <p class="dashuppe-text-all">Type<br/>
       <input type="text" class="textInput" name="page_order" /> </p>
   
   <p class="dashuppe-text-all">Tags<br/>
       <input type="text" class="textInput" name="page_order" /> </p>
   <p class="dashuppe-text-all">Status<br />  
  <?php $options = array('1'  => 'publish','0'    => 'draft');?>
       <select class="textInput" name="page_status">
         
         <?php foreach ($options as $key=>$data){ ?>
         <option value="<?php echo $key; ?>"><?php echo $data; ?></option>
         <?php } ?>
     </select>
  </p>
<input type="checkbox" name="allow_comment" value="1" <?php if($set_data[0]==1) echo 'checked' ;?> >Allow people to post comment</input>
<br/>
<input type="checkbox" name="allow_like" value="1" <?php if($set_data[1]==1) echo 'checked' ;?> >Allow people to like </input>
<br/>
<input type="checkbox" name="allow_share" value="1" <?php if($set_data[2]==1) echo 'checked' ;?> >Allow people to share</input>
<br/>
<br>
  
  <input type="submit" class="btn btn-default btn-lg btn-block" value="Submit" />
  <?php echo form_close();?>
    </div>
    <div class="clear"></div>
</div>
<div class="clear"></div>
</div>