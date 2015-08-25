<link rel="stylesheet" type="text/css" href="<?php echo base_url() . 'content/bnw/styles/imgareaselect-animated.css'; ?>" />
<script type="text/javascript" src="<?php echo base_url() . 'content/bnw/scripts/jquery.imgareaselect.pack.js'; ?>"></script>
<script type="text/javascript" src="<?php echo base_url() . 'content/bnw/scripts/script.js'; ?>"></script>

<div class="rightSide">
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
<?php if ($this->session->flashdata('message')) {
    echo $this->session->flashdata('message');
} ?>
            <?php
            echo validation_errors();
            if (isset($error)) {
                echo $error;
            }
            ?>
        </div>
    </div>
  
    
    <div>



        <?php echo form_open_multipart('offers/addpost'); ?>

        <p class="dashuppe-text-all">Post Title *<br />
            <input type="text" class="textInput" name="post_title" value="<?php echo set_value('post_title'); ?>" />
        </p>
        <p><span class="mediabtn">Media</span></p>
        <p class="dashuppe-text-all">Body *<br />
            <textarea name="post_content" id="textara" cols="50" rows="15" ><?php echo set_value('post_content'); ?></textarea>

        </p> 
        <p class="dashuppe-text-all">Image<br />
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
        <p class="dashuppe-text-all">Select Category<br/>
            <select class="textInput" name="selectCategory">
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

        </p>
        <input type="submit" class="btn btn-primary btn-lg" value="Submit" />
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


