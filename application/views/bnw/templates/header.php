
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" media="screen" href="<?php echo base_url().'content/bootstrap/css/bootstrap.css'; ?>">
    <link rel="stylesheet" media="screen" href="<?php echo base_url(); ?>content/bnw/styles/dashBoardStyles.css" type="text/css" /> 
    <link rel="stylesheet" media="screen" href="<?php echo base_url(); ?>content/bnw/styles/stylesForGadgets.css" type="text/css" />
    <script src="<?php echo base_url().'content/angularjs/angular.min.js'; ?>"></script>
    <script src="<?php echo base_url(); ?>content/bnw/scripts/jquery.min.js" ></script>
    <script src="<?php echo base_url(); ?>content/bnw/scripts/jquery.js" ></script>
    <script src="<?php echo base_url(); ?>content/bnw/scripts/confirm.js" ></script>
    <script src="<?php echo base_url(); ?>content/bnw/scripts/nicEdit.js"></script>
    <script src="<?php echo base_url(); ?>content/bnw/scripts/DeleteImage.js"></script>
    <script src="<?php echo base_url(); ?>content/bnw/scripts/gadgets.js"></script>
    <script src="<?php echo base_url(); ?>content/bnw/scripts/jquery.imgareaselect.pack.js"></script>
    <script src="<?php echo base_url(); ?>content/bnw/scripts/script.js"></script>
    <script src="<?php echo base_url(); ?>content/bnw/scripts/imgpos.js"></script>
    <script src="<?php echo base_url(); ?>content/bnw/scripts/media.js"></script>
    <script src="<?php echo base_url(); ?>content/bnw/scripts/navTrack.js"></script>
    <script src="<?php echo base_url(); ?>content/bootstrap/js/bootstrap.min.js" ></script>
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
   
   <!-- <link rel="shortcut icon" href="<?php echo base_url().'content/uploads/images/'.$title[4]; ?>"> -->



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
        -->
        
<!--     </script> -->

    <script type="text/javascript">

        $(document).ready(function () {
            $('.mainMenuItem').click(function () {

                $('.mainMenuItem').children("ul").hide();
                $(this).children("ul").show();
            });
        });


    </script>

    <script>
$(document).ready(function(){
    $("#uploadImage").click(function(){
 $(".leftside").css({"background-color": "#222", "height": "2200"});
  $(".rightside").css({"background-color": "#fff", "height": "2200"});
    });
});
 </script>
     <script>
          $(document).ready(function(){
            $("#toggle").click(function() {
                $(".leftside").toggle();

            });


        });

      </script>
 
    <?php 
    if (isset($meta)) {
        foreach ($meta as $data) {
            $title[] = $data->value;// isssue of title is solved
        }
    }
    ?>        
    <title><?php echo $title[1]; ?></title>

</head>
<body>
<script type="text/javascript">
  
  $(document).ready(function(){
            $("#togglemenu").click(function() {
                $(".collapse").toggle();

            });


        });

</script>


    <nav class="navbar navbar-inverse navbar-fixed-top">
     <div class="container-fluid">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle" id="togglemenu" data-toggle="collapse" data-target="#myNavbar">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>                        
        </button>
      <a href="<?php echo base_url('bnw'); ?>"> <img style="height:43px;" src="<?php echo base_url() . "content/bnw/images/bnw.png"; ?>"/></a>
      <a href="#" id="toggle"> <img style="height:43px;" src="<?php echo base_url() . "content/bnw/images/toggle.png"; ?>"/></a>
  </div>
  <div class="collapse navbar-collapse" id="myNavbar">

      <ul class="nav navbar-nav">
       <li><a id="switchlink" href="<?php echo base_url(); ?>" target="_blank" ><i style="font-size:18px"  class="fa fa-home" aria-hidden="true"> View Site</i></a></li>
       <div class="dropdown">
          <ul class="dropbtn"><i  style="font-size:18px" class="fa fa-plus" aria-hidden="true" > Add new </i>
            <li class="dropdown-content">
                <a href="<?php echo base_url('offers/addpost'); ?>"><i class="fa fa-file-o" aria-hidden="true"></i>

                    Post</a>
                    <a href="<?php echo base_url('page/addpage'); ?>"><i class="fa fa-file-text" aria-hidden="true"></i>
                        Page</a>
                        <a href="<?php echo base_url('media/addmedia'); ?>"><i class="fa fa-picture-o" aria-hidden="true"></i>
                            Media</a>
                            <a href="<?php echo base_url('user/adduser'); ?>"><i class="fa fa-user" aria-hidden="true"></i>
                                User</a>
                            </li> 
                        </ul>
                    </div>

                </ul>
                <ul class="nav navbar-nav navbar-right">
                 <?php if ($this->session->userdata('admin_logged_in')) { ?>
                 <?php $username= $this->session->userdata('username'); ?>

                 <div class="dropdowns">

                   <ul  class="dropbtns"><i class="fa fa-user" aria-hidden="true"></i>
                    hellow, <?php echo $username; ?>
                    <li class="dropdown-contents">
                      <a href="<?php echo base_url('login/logout'); ?>" > <span class="glyphicon glyphicon-log-in"></span>Logout</a>  
                  </li>
                  </ul>



              </div>
              <?php } ?> 
          </ul>
      </div>
  </div>
</nav>

