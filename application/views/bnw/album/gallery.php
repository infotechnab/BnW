
<div class=" col-md-10 col-sm-9 col-lg-10 col-xs-8 rightside">

    <h2>Album/ Photos&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="<?php echo base_url() . 'index.php/album/addalbum'; ?>">View All Albums</a></h2>
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


<div class="row">
<div class="col-md-12 col-lg-12 col-sm-12">
        <?php
        if (isset($query)) {
            echo "<div class='row'>";
            foreach ($query as $data) {
                ?>        
    <div id="photodiv" class="col-md-3 action" style="border:1px solid #ccc marign-right:10px;">
   <img class="srcimage" src="<?php echo base_url(); ?>content/uploads/images/thumb_<?php echo $data->media_type; ?>" name="<?php echo $data->media_type ?>" id="galleryimage" />
    
   <h4> <?php echo $data->media_name; ?></h4>
<a href="#" style='font-size:23px;text-decoration:none;'  title=" Delete "> <span  id="<?php echo $data->id; ?>" class='del_category glyphicon glyphicon-trash'></span></a>
 </div>   
             <?php
            }
     echo "</div>";
        } else {
            ?>
            <div class="xyz">
                <p>No any photos found</p>   
            </div>
        <?php }
        ?>

</div>
<div class="col-md-12 col-lg-12 col-xs-12">
    <div class="add">
        <?php echo form_open_multipart('album/addphoto'); ?>
         <fieldset>
    <legend><h3>Add New Image</h3></legend>
        <input type="hidden" name="id" value="<?php echo $id; ?>" />

        <div class="form-group">
         <label>Image title :</label>

         <input type="text" class="form-control" name="title" required /> </p>         
        <input id="uploadImage"  type="file" name="file" accept="image/*" />
        </div>

        <!-- hidden inputs -->
        <input type="hidden" id="x" name="x" />
        <input type="hidden" id="y" name="y" />
        <input type="hidden" id="w" name="w" />
        <input type="hidden" id="h" name="h" /> 
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
        <input type="submit" class="btn btn-default btn-lg btn-block" name="submit"  value="Add Photo"   />
         </fieldset>
        <?php echo form_close(); ?>

    </div> 




    <script>
    $(document).ready(function () {
        $(document).on("click", ".del_category", function () {
            var id = $(this).attr("id");
            var url = '<?php echo base_url() . 'index.php/album/deletephoto' ?>';
            var hideid = $(this);
            senddata({id:id,url:url,thiss:hideid});
        });

  
    });
</script>

</div>
</div>
</div>

