<link rel="stylesheet" type="text/css" href="<?php echo base_url() . 'content/bnw/styles/imgareaselect-animated.css'; ?>" />
<script type="text/javascript" src="<?php echo base_url() . 'content/bnw/scripts/jquery.imgareaselect.pack.js'; ?>"></script>
<script type="text/javascript" src="<?php echo base_url() . 'content/bnw/scripts/script.js'; ?>"></script>

<div class=" col-md-10 col-sm-9 col-lg-10 col-xs-8 rightside">


    <?php
    if ($query) {
        $i = 0;
        foreach ($query as $data) {
            $set_data[$i] = $data->description;
            $i++;
        }
    }
    ?>
    <div class="titleArea">
        <h2>Add new Post&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="<?php echo base_url() . 'index.php/offers/posts'; ?>">View All</a></h2>
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
  
    
    <div>



        <?php echo form_open_multipart('offers/addpost'); ?>
       <div classs="form-group">
        <label>Post Title</label>
            <input type="text" class="form-control" name="post_title" value="<?php echo set_value('post_title'); ?>" />
      </div>
        <!--<p><span class="mediabtn">Media</span></p>-->
        <div class="form-group">

        <label>Body</label>
            <textarea name="post_content" id="textara" cols="50" rows="15" ><?php echo set_value('post_content'); ?></textarea>

        </div>
        <div class="form-group">
        <label>Image</label>
            <input id="uploadImage" class="btn btn-default" type="file" name="file" accept="image/*"/>
            <!-- hidden inputs -->
            <input type="hidden" id="x" name="x" />
            <input type="hidden" id="y" name="y" />
            <input type="hidden" id="w" name="w" />
            <input type="hidden" id="h" name="h" /> 
            
        </p> 
  <div data-toggle="buttons" id="mybutton">
            <label title="Set Aspect Ratio" data-option="1.7777777777777777" data-method="setAspectRatio" class="radio-inline active">
                <input type="radio" value="1.7777777777777777" name="aspestRatio" id="aspestRatio1" class="sr-only">16:9
            </label>
            <label title="Set Aspect Ratio" data-option="1.3333333333333333" data-method="setAspectRatio" class="radio-inline ">
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
       <div class="form-group">
  <label>Select Category</label>
 <select class="form-control" style="padding:1px" name="selectCategory">
                <option value="None">Select None</option>
                <?php
                foreach ($listOfCategory as $data) {
                    ?>

                    <option value="<?php echo $data->category_name; ?>">
    <?php echo $data->category_name; ?>
                    </option>
                        <?php
                    }
                    ?> 

            </select>

  </div> 
<input type="submit" class="btn btn-default btn-lg btn-block" value="Submit" />
<?php echo form_close(); ?>
    </div>

</div>
<div class="clear"></div>
</div>
<!--
  <p>Post Status:<br />
<?php /* $options = array(
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


