<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <link rel="stylesheet" media="screen" href="<?php echo base_url(); ?>content/bnw/styles/dashBoardStyles.css" type="text/css" /> 
    <link rel="stylesheet" media="screen" href="<?php echo base_url(); ?>content/bnw/styles/stylesForGadgets.css" type="text/css" />
    <script src="<?php echo base_url(); ?>content/bnw/scripts/jquery.min.js" ></script>
    <script src="<?php echo base_url(); ?>content/bnw/scripts/jquery.js" ></script>
    <script src="<?php echo base_url(); ?>content/bnw/scripts/confirm.js" ></script>
    <!--        <script src="<?php //echo base_url(); ?>content/bnw/scripts/DeleteImage.js"></script>-->
    <script src="<?php echo base_url(); ?>content/bnw/scripts/gadgets.js"></script>
    <script src="<?php echo base_url(); ?>content/bnw/scripts/jquery.imgareaselect.pack.js"></script>
    <script src="<?php echo base_url(); ?>content/bnw/scripts/script.js"></script>
    <script src="<?php echo base_url(); ?>content/bnw/scripts/imgpos.js"></script>
    <script src="<?php echo base_url(); ?>content/bnw/scripts/media.js"></script>
    <script src="<?php echo base_url(); ?>content/bnw/scripts/navTrack.js"></script>
    <link rel="stylesheet" type="text/css" href="<?php echo base_url() . 'content/bnw/styles/imgareaselect-animated.css'; ?>" />
    <link href="http://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet">
    <script src="//cdn.tinymce.com/4/tinymce.min.js"></script>
    <?php if(isset($meta))
    {
       foreach ($meta as $data)
       {
           $title[] = $data->value;
       }
   }
   ?> 
   <link rel="shortcut icon" href="<?php echo base_url().'content/uploads/images/'.$title[4]; ?>">



   <script type="text/javascript">
    var base_url = '<?php echo base_url(); ?>';
    tinymce.init({
        fontsize_formats: "8pt 10pt 12pt 14pt 18pt 24pt 28pt 32pt 36pt 40pt 48pt 56pt 72pt",
        selector: "textarea",
        theme: "modern",
        relative_urls : false,
        remove_script_host : false,
        plugins: [
        "advlist autolink lists link image charmap print preview anchor",
        "searchreplace visualblocks code fullscreen",
        "emoticons template paste textcolor colorpicker textpattern",
        "insertdatetime media table contextmenu paste"
        ],
        toolbar: "insertfile undo redo | styleselect | sizeselect | bold italic | fontselect |  fontsizeselect | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image | print preview media | forecolor backcolor emoticons"
    });
</script>
        <!--<script type="text/javascript">
        
        bkLib.onDomLoaded(function() {
        new nicEditor().panelInstance('area1');
        new nicEditor({fullPanel : true}).panelInstance('area2');
        new nicEditor({iconsPath : '../nicEditorIcons.gif'}).panelInstance('area3');
        new nicEditor({buttonList : ['fontSize','bold','italic','underline','strikeThrough','subscript','superscript','html','image']}).panelInstance('area4');
        new nicEditor({maxHeight : 100}).panelInstance('area5');
        });
        
    </script>-->

    <script type="text/javascript">

        $(document).ready(function () {
            $("#topLeft").click(function () {
                $(".leftSide").toggle();
            });
        });


        $(document).ready(function () {
            $('.mainMenuItem').click(function () {
                $('.mainMenuItem').children("ul").hide();
                $(this).children("ul").show();
            });
        });


    </script>


    <?php
    if (isset($meta)) {
        foreach ($meta as $data) {
            $title[] = $data->value;
        }
    }
    ?>        
    <title><?php echo $title[1]; ?></title>

</head>
<body>

    <div class="full">
        <div id="top">

            <div id="topLeft">
               <a href="<?php echo base_url('bnw'); ?>"<img src="<?php echo base_url() . "content/bnw/images/menu.png"; ?>"/>
            </div>
            <img style="height:43px;" src="<?php echo base_url() . "content/bnw/images/bnw.png"; ?>"/>
            <a  href="<?php echo base_url(); ?>" target="_blank"><button type="button" id="switchLnk"><i  style="font-size:22px"class="fa fa-home" aria-hidden="true"></i>
View Site</button></a>



            <div class="dropdown">
              <button class="dropbtn"><i  style="font-size:22px "class="fa fa-plus" aria-hidden="true"></i>
Add new</button>
              <div class="dropdown-content">
                <a href="<?php echo base_url('offers/addpost'); ?>"><i class="fa fa-file-o" aria-hidden="true"></i>

post</a>
                <a href="<?php echo base_url('page/addpage'); ?>"><i class="fa fa-file-text" aria-hidden="true"></i>
page</a>
                <a href="<?php echo base_url('media/addmedia'); ?>"><i class="fa fa-picture-o" aria-hidden="true"></i>
media</a>
                <a href="<?php echo base_url('user/adduser'); ?>"><i class="fa fa-user" aria-hidden="true"></i>
user</a>
            </div> 
        </div>


        <?php if ($this->session->userdata('admin_logged_in')) { ?>
        <div id="topRight">


            <?php $username= $this->session->userdata('username'); ?>

            <div class="dropdown">
                <p></p>
                <button class="dropbtn"><i class="fa fa-user" aria-hidden="true"></i>
hellow, <?php echo $username." "; ?>
</button>
                <div class="dropdown-content">
                    <a href="<?php echo base_url('login/logout'); ?>" > <i class="fa fa-sign-out" aria-hidden="true"></i>Logout</a>    </div> 
            </div>






        </div>
        <?php } ?>
    </div>
    <div class="clear"></div>
    <!top company name and logged in as and logout div closed here>



  <!--media-->
  <div class="mediaPopUp">
    <div class="mediaAction">
        <div class="mediaUploadContainer">
            <form id="mediauploads"><input type="file" name="images[]" class="newuploads" multiple></form>
        </div>
        <div id="progress_bar">
            <div id="progressbar">
                <div id="progress" style="width:0px;"></div>
            </div>
        </div>
        <div id="status"></div>
        <div class="clear"></div>
        <div class="mediaClose">X</div>
    </div>
    <div class="mediaImgContainer">
        <div id="list"></div>
    </div>
    <div class="mediaDetails">
        ATTACHMENT DETAILS 
        <div class="imgprev">
            <img src="" height="100" width="100">
        </div>
        <br>
        <table>
            <tr>
                <td>
                    <label>Title</label>
                </td>
                <td>
                    <input type="text" class="imgName">
                </td>
            </tr>
            <tr>
                <td>
                    <label>Caption</label>
                </td>
                <td>
                    <input type="text" class="imgName">
                </td>
            </tr>
            <tr>
                <td>
                    <label>ALT Text</label>
                </td>
                <td>
                    <input type="text" class="imgName">
                </td>
            </tr>
            <tr>
                <td>
                    <label>Details</label>
                </td>
                <td>
                    <input type="text" class="imgName">
                </td>
            </tr>
        </table>

        
        <br>
        Edit Image
        Delete Image
    </div>
    <div class="clear"></div>
</div>
