<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <link rel="stylesheet" media="screen" href="<?php echo base_url(); ?>content/bnw/styles/dashBoardStyles.css" type="text/css" /> 
   <link rel="stylesheet" media="screen" href="<?php echo base_url(); ?>content/bnw/styles/stylesForGadgets.css" type="text/css" />
    <script src="<?php echo base_url(); ?>content/bnw/scripts/jquery.min.js" > </script>
    <script src="<?php echo base_url(); ?>content/bnw/scripts/jquery.js" > </script>
      <script src="<?php echo base_url(); ?>content/bnw/scripts/nicEdit.js"></script>
       <script src="<?php echo base_url(); ?>content/bnw/scripts/gadgets.js"></script>
       <script src="<?php echo base_url(); ?>content/bnw/scripts/calendar.js"></script>
       <script src="<?php echo base_url(); ?>content/bnw/scripts/jquery.imgareaselect.pack.js"></script>
       <script src="<?php echo base_url(); ?>content/bnw/scripts/script.js"></script>
       <link rel="stylesheet" type="text/css" href="<?php echo base_url().'content/bnw/styles/imgareaselect-animated.css'; ?>" />
<script type="text/javascript">

bkLib.onDomLoaded(function() {
new nicEditor().panelInstance('area1');
new nicEditor({fullPanel : true}).panelInstance('area2');
new nicEditor({iconsPath : '../nicEditorIcons.gif'}).panelInstance('area3');
new nicEditor({buttonList : ['fontSize','bold','italic','underline','strikeThrough','subscript','superscript','html','image']}).panelInstance('area4');
new nicEditor({maxHeight : 100}).panelInstance('area5');
});

</script>

    <script type="text/javascript">

$(document).ready(function(){
  $("#topLeft").click(function(){
      $(".leftSide").toggle();   
  });
});


$(document).ready(function() {
            $('ul li.mainMenuItem a').each(function(i){
            var subUl = $(this).parent().find('ul'); //Get the sub ul.
            $(this).bind('click',function(){
                    
                    $('.mainMenuItem ul').hide(); // hide all the other ULs
                    
                    subUl.toggle();
                }) ;   
            });
        }); 


  </script>
  
	
<?php if(isset($meta))
{
     foreach ($meta as $data)
     {
         $title[] = $data->value;
     }
}
?>        
	<title><?php echo $title[1]; ?></title>

</head>
<body onload='loadCategories()'>
   
    <div class="full">
        <div id="top">
            
            <div id="topLeft">
                <img src="<?php echo base_url()."content/bnw/images/menu.png"; ?>"/>
            </div>
            <img src="<?php echo base_url()."content/bnw/images/bnw.png"; ?>"/>
            <a href="<?php echo base_url(); ?>" target="_blank"><button type="button" id="switchLnk">View Site</button></a>
            <?php  if ($this->session->userdata('admin_logged_in')){ ?>
            <div id="topRight">
             <p>    
               
                    <?php echo $this->session->userdata ('username'); ?>
                    <?php echo anchor('bnw/logout','Log Out') ?>
                </p>
            </div>
            <?php } ?>
        </div>
        <div class="clear"/></div>
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