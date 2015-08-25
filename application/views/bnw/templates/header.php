<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <link rel="stylesheet" media="screen" href="<?php echo base_url(); ?>content/bnw/styles/dashBoardStyles.css" type="text/css" /> 
        <link rel="stylesheet" media="screen" href="<?php echo base_url(); ?>content/bnw/styles/stylesForGadgets.css" type="text/css" />
        <script src="<?php echo base_url(); ?>content/bnw/scripts/jquery.min.js" ></script>
        <script src="<?php echo base_url(); ?>content/bnw/scripts/jquery.js" ></script>
        <script src="<?php echo base_url(); ?>content/bnw/scripts/confirm.js" ></script>
    <!--      <script src="<?php echo base_url(); ?>content/bnw/scripts/nicEdit.js"></script>-->
        <script src="<?php echo base_url(); ?>content/bnw/scripts/gadgets.js"></script>
        <script src="<?php echo base_url(); ?>content/bnw/scripts/jquery.imgareaselect.pack.js"></script>
        <script src="<?php echo base_url(); ?>content/bnw/scripts/script.js"></script>
        <script src="<?php echo base_url(); ?>content/bnw/scripts/imgpos.js"></script>
        <script src="<?php echo base_url(); ?>content/bnw/scripts/media.js"></script>
        <script src="<?php echo base_url(); ?>content/bnw/scripts/navTrack.js"></script>
        <link rel="stylesheet" type="text/css" href="<?php echo base_url() . 'content/bnw/styles/imgareaselect-animated.css'; ?>" />
        <link href="http://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet">
        <script src="//tinymce.cachefly.net/4.1/tinymce.min.js"></script>
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
    selector: "textarea",
    plugins: [
        "advlist autolink lists link image charmap print preview anchor",
        "searchreplace visualblocks code fullscreen",
        "insertdatetime media table contextmenu paste"
    ],
    toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image"
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
                    <img src="<?php echo base_url() . "content/bnw/images/menu.png"; ?>"/>
                </div>
                <img src="<?php echo base_url() . "content/bnw/images/bnw.png"; ?>"/>
                <a href="<?php echo base_url(); ?>" target="_blank"><button type="button" id="switchLnk">View Site</button></a>
                <?php if ($this->session->userdata('admin_logged_in')) { ?>
                    <div id="topRight">
                        <p>    

                            <?php echo $this->session->userdata('username'); ?>
                            <?php echo anchor('login/logout', 'Log Out') ?>
                        </p>
                    </div>
                <?php } ?>
            </div>
            <div class="clear"></div>
        <!top company name and logged in as and logout div closed here>
    <style>
        #switchLnk {
            -moz-user-select: none;
            background-image: none;
            border: 1px solid transparent;
            cursor: pointer;
            display: inline-block;
            font-size: 14px;
            font-weight: 400;
            border-radius: 3px;
            line-height: 1.5;
            padding: 5px 10px;
            width: auto;
            margin: -45px 0px 0px 40px;
            padding: 6px 12px;
            text-align: center;
            vertical-align: middle;
            white-space: nowrap;
        }
    </style>
    
    
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
