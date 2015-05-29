<link rel="stylesheet" type="text/css" href="<?php echo base_url() . 'content/bnw/styles/imgareaselect-animated.css'; ?>" />
<script type="text/javascript" src="<?php echo base_url() . 'content/bnw/scripts/jquery.imgareaselect.pack.js'; ?>"></script>
<script type="text/javascript" src="<?php echo base_url() . 'content/bnw/scripts/script.js'; ?>"></script>
<style type="text/css">
    /* popup_box DIV-Styles*/
    #popup_box { 
        display:none; /* Hide the DIV */
        position:absolute;  
        background:#FFFFFF;  
        z-index:100; /* Layering ( on-top of others), if you have lots of layers: I just maximized, you can change it yourself */
    }
    #fadeDiv{position: absolute;background: rgba(0,0,0,0.7);z-index: 99;top: 0;left: 0;}
    #popupBoxClose{float: right;}
    #loading{position: absolute;top: 50%;left: 50%;}
    /* This is for the positioning of the Close Link */
</style>
<script type="text/javascript">
    $(document).ready(function () {
        // When site loaded, load the Popupbox First
        $('.srcimage').click(function () {
            $("#fadeDiv").width($(document).width());
            $("#fadeDiv").height($(document).height());
            $("#fadeDiv").show();
            $("#loading").show();
            var w = $(window).width();
            var h = $(window).height();
            var topp = $(window).scrollTop();


            $("#pqr").prop("src", "");
            var srcimg = $(this).attr('name');
            var img = new Image();
            img.src = "<?php echo base_url() . "content/uploads/images/"; ?>" + srcimg; //path of HD image.
            img.onload = function () {
                $("#pqr").prop("src", this.src);
                var p = $("#popup_box").width();
                var hp = $("#popup_box").height();
                var b = w - p;
                var lr = b / 2;
                var tp = (h - hp) / 2;
                var toppos = topp + tp;


                $('#popup_box').css("left", lr);
                $('#popup_box').css("top", toppos);
                $('#popup_box').show();

                $("#loading").hide();
            };

        });

        $('#popupBoxClose').click(function () {
            $('#popup_box').hide();
            $("#fadeDiv").hide();
        });

    });


</script>
<div id="fadeDiv"></div>
<div class="rightSide">
    <h2>Album/ Photos&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="<?php echo base_url() . 'index.php/album/addalbum'; ?>">View All Albums</a></h2>
    <hr class="hr-gradient"/>
    <div id="sucessmsg">
        <?php
        echo validation_errors();
        echo $this->session->flashdata('message');
        if (isset($error)) {
            echo $error;
        }
        ?> </div>
    <div>
        <?php
        if (isset($query)) {
            foreach ($query as $data) {
                ?>    
        <div id="photodiv" class="action" style="min-height: 201px;overflow: hidden;">
            <div style="width: 200px;overflow: hidden;">
                    <img class="srcimage" src="<?php echo base_url(); ?>content/uploads/images/thumb_<?php echo $data->media_type; ?>" name="<?php echo $data->media_type ?>" id="galleryimage" />
                    </div>
                    <div id="imagetitle"> <?php echo $data->media_name; ?>

                    </div>
                    <span class="del_category" id="<?php echo $data->id; ?>"><i class="fa fa-trash-o"></i></span>

            
                </div> 
                <?php
            }
        } else {
            ?>
            <div class="xyz" style="width:200px; height:150px; float:left; margin-right:5px;">
                <p>No any photos found</p>   
            </div>
        <?php }
        ?>
    </div>
    <div id="popup_box">	<!-- OUR PopupBox DIV-->
        <div style="padding: 1%;">
            <i class="fa fa-remove" id="popupBoxClose" style="cursor: pointer;"></i>
            <div class="clear"></div>
        </div>
        <img src="<?php echo base_url() . 'content/bnw/images/loading.gif' ?>" id="loading">
        <img  src="" height="500" id="pqr"/>
    </div>

    <div class="add" style="width:250px; margin: 10px;" >
        <?php echo form_open_multipart('album/addphoto'); ?>
        <input type="hidden" name="id" value="<?php echo $id; ?>" />
        <p class="dashuppe-text-all">Image Title <br/>
            <input type="text" class="input-text-small" name="title" required /> </p>         
        <input id="uploadImage" class="input-text-small" type="file" name="file" accept="image/*" />

        <!-- hidden inputs -->
        <input type="hidden" id="x" name="x" />
        <input type="hidden" id="y" name="y" />
        <input type="hidden" id="w" name="w" />
        <input type="hidden" id="h" name="h" /> 
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
        <input type="submit" name="submit" class="submit-button-small" value="add photo"   />
        <?php echo form_close(); ?>

    </div> 

</div>
<div class="clear"></div>
</div>

<script>
    $(document).ready(function(){
       $(document).on("click", ".del_category", function(){
           var id = $(this).attr("id");
            $(this).confirm();
            var url = '<?php echo base_url().'index.php/album/deletephoto' ?>';
            var hideid = $(this);
            $(this).confirm.yes({id:id,url:url,thiss:hideid});
            $(this).confirm.no();
            
       });
    });
</script>