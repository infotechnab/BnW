<link rel="stylesheet" type="text/css" href="<?php echo base_url() . 'content/bnw/styles/imgareaselect-animated.css'; ?>" />
<script type="text/javascript" src="<?php echo base_url() . 'content/bnw/scripts/jquery.imgareaselect.pack.js'; ?>"></script>
<script type="text/javascript" src="<?php echo base_url() . 'content/bnw/scripts/script.js'; ?>"></script>
<?php 
$this->load->helper('summary_helper');
?>
<div class="rightSide">
    <?php
    if ($miscSetting) {
        $i = 0;
        foreach ($miscSetting as $data) {
            $set_data[$i] = $data->description;
            $i++;
        }
    }
    ?>

    <?php
    if (!empty($query)) {
        foreach ($query as $data) {
            $id = $data->id;
            $post_title = $data->post_title;
            $post_content = $data->post_content;
            $post_image = $data->image;

            $post_status = $data->post_status;
            $post_comment_status = $data->comment_status;
            $post_tags = $data->post_tags;
            $post_category_id = $data->post_category;
            $comment = $data->allow_comment;
            $like = $data->allow_like;
            $share = $data->allow_share;
            $listOfCategory = $this->dbdashboard->get_list_of_category();
        }
        ?>
        <div class="titleArea">
            <h2>Edit Post/ <?php echo custom_echo_ed($post_title); ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="<?php echo base_url() . 'index.php/offers/posts'; ?>">View All</a></h2>
            <hr class="hr-gradient"/>  
            <div id="sucessmsg">
    <?php
    echo $this->session->flashdata('message');
    if (isset($error)) {
        echo $error;
    }
    ?>
                <?php echo validation_errors(); ?>
            </div>
        </div> 
        <div id="">

    <?php echo form_open_multipart('offers/updatepost'); ?>
            <input type="hidden" name="hidden_image" value="<?php echo $post_image; ?>"/>
            <p class="dashuppe-text-all">Title *<br />
                <input type="hidden" name="id" value="<?php echo $id; ?>" >
                <input type="text" class="textInput" name="post_title" value="<?php echo htmlentities($post_title); ?>" />
            </p>
            <p class="dashuppe-text-all">Body *<br />
                <textarea name="post_content" id="textara" rows="5" cols="50" style="resize:none;">
    <?php echo $post_content; ?></textarea>
            </p>
                    <?php if ($post_image == !NULL) { ?> 
                <div style="border: 1px solid #eee;padding: 1%;display: inline-block;min-height: 100px;">
                    <div style="">
                        <img src="<?php echo base_url() . "content/uploads/images/" . $post_image; ?>" width="80" height="80" alt="<?php echo $post_image; ?>" />
                    </div>
                    <div style="text-align: center;">
                    <a href="<?php echo base_url(); ?>index.php/offers/offerImgdelete/?id=<?php echo $id; ?> " title="Delete" id="<?php echo $id; ?>" class="delbutton">
                        <i class="fa fa-trash-o" id="close"></i>
                    </a>
                    </div>
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
            <p class="dashuppe-text-all">Select Category<br/>

                <select class="textInput" name="selectCategory">
                    <option value="None">Select None</option>
    <?php
    foreach ($listOfCategory as $data) {
        ?>
                        
                        <option value="<?php echo $data->category_name; ?>" <?php if ($data->category_name == $post_category_id) { ?> selected="selected" <?php } ?> >
                        <?php echo $data->category_name; ?>
                        </option>

                            <?php
                        }
                        ?>

                </select>

            </p>

            <input type="submit" class="btn btn-primary btn-lg" value="Submit" />
    <?php echo form_close(); ?>
<?php
} else {
    echo '<h3 id="sucessmsg">Sorry! the post is not found.</h3>';
}
?>
    </div>

    <!-- <div id="forRightPage">
   
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
  '2'=> 'public',
  '1'  => 'as defined',
  '0'    => 'custom');
  echo form_dropdown('comment_status',$options,'2')
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
  <option value="<?php echo $data->category_name; ?>" selected="<?php echo $post_category_id; ?>">
  <?php echo $data->category_name; ?>
  </option>

  <?php
  }
 */ ?>
           
             </select>
        
    </p>
    
    <input type="checkbox" name="allow_comment" value="1" <?php //if($set_data[0]==1 OR $comment==1 ) echo 'checked' ; ?> >Allow people to post comment</input>
 <br/>
 <input type="checkbox" name="allow_like" value="1" <?php //if($set_data[1]==1 OR $like==1 ) echo 'checked' ; ?> >Allow people to like </input>
 <br/>
 <input type="checkbox" name="allow_share" value="1" <?php //if($set_data[2]==1 OR $share==1 ) echo 'checked' ; ?> >Allow people to share</input>
 <br/>
   
  
 <p><b>Note:</b> Max file size: 500KB, Max Width: 1024px, Max Height: 768px </p>
     </div>-->
</div>
<div class="clear"></div>
</div>
