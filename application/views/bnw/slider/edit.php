<div class="rightSide">
<?php


 if(isset($query)){
            foreach ($query as $data){
           $id = $data->id;
           $slidename = $data->slide_name;
           $slideImage = $data->slide_image;
           $slidecontent = $data->slide_content;
                 
            }
        }
    ?>
<h2>Edit Slider id <?php echo $id; ?></h2>
  <?php echo validation_errors(); ?>
 
  <p id="sucessmsg">
  <?php if($this->session->flashdata('message')){echo $this->session->flashdata('message');}?>
    </p>
  <?php echo form_open_multipart('bnw/updateslider');?>
  <p>Title:<br />
      <input type="hidden" name="id" value="<?php echo $id; ?>" />
      <input type="text" name="slide_name" value="<?php echo $slidename; ?>" />
  </p>
  
  <?php if((trim($slideImage== NULL)) || trim($slideImage !== ' ')){ ?>
  
  <p>Existing Slide Image : <br/>
  <div style="max-width: 150px; max-height: 150px;">
      <img src="<?php echo base_url().'content/images/'.$slideImage ?>" style="max-width: 150px; max-height: 150px;">
  </div>
  <?php } ?>
  <p> Image : <br/> <input type="file" name="file_name" id="file"/> </p>
  <p>Content:<br />
   <input type="text" name="slide_content" value="<?php echo $slidecontent; ?>" />
  </p>
    <input type="submit" value="Submit" />
  <?php echo form_close();?>
<p><b>Note:</b> Max file size: 2000KB,  Width: 2000px, Height: 2000px </p>
</div>
<div class="clear"></div>
</div>

