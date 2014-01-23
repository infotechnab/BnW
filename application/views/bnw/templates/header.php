<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <link rel="stylesheet" media="screen" href="<?php echo base_url(); ?>content/styles/dashBoardStyles.css" type="text/css" /> 
    <script src="<?php echo base_url(); ?>content/jquery-1.9.1.min.js" > </script>
     <script type="text/javascript" src="http://js.nicedit.com/nicEdit-latest.js"></script> <script type="text/javascript">
//<![CDATA[
bkLib.onDomLoaded(function() {
new nicEditor().panelInstance('area1');
new nicEditor({fullPanel : true}).panelInstance('area2');
new nicEditor({iconsPath : '../nicEditorIcons.gif'}).panelInstance('area3');
new nicEditor({buttonList : ['fontSize','bold','italic','underline','strikeThrough','subscript','superscript','html','image']}).panelInstance('area4');
new nicEditor({maxHeight : 100}).panelInstance('area5');
});
//]]>
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
	<title>.:Dashboard <?php echo $title[1]; ?></title>

</head>
<body>
   
    <div class="full">
        <div id="top">
            
            <div id="topLeft">
                <img src="<?php echo base_url()."/content/images/menu.png"; ?>"/>
            </div>
            <img src="<?php echo base_url()."/content/images/bnw.png"; ?>"/>
            <?php  if ($this->session->userdata('logged_in')){ ?>
            <div id="topRight">
                <p>
                    <?php echo $this->session->userdata('username'); ?>
                    <?php echo anchor('bnw/logout','Log Out') ?>
                </p>
            </div>
            <?php } ?>
        </div>
        <div class="clear"/></div>
        <!top company name and logged is as and logout div closed here>