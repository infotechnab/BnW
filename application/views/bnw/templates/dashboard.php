
<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" media="screen" href="<?php echo base_url(); ?>content/styles/dashBoardStyles.css" type="text/css" /> 
    <script src="<?php echo base_url(); ?>content/jquery-1.9.1.min.js" > </script>
    <script type="text/javascript" src="http://js.nicedit.com/nicEdit-latest.js"></script> 
    
    <script type="text/javascript" src="<?php echo base_url()."/contents/scripts/jquery.min.js"; ?>"></script>
    
    <script type="text/javascript">

$(document).ready(function(){
  $("#topLeft").click(function(){
      $(".leftSide").toggle();   
  });
});

$(document).ready(function(){
  $("#mainMenuItemId").click(function(){
     $(this).children("ul:first").toggle(); 
     
  });
});




  </script>
	<meta charset="utf-8">
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
    
        <div class="leftSide">
            <div class="menuItems">
                <ul class="menu">
                    <li class="mainMenuItem" id="mainMenuItemId"> <a href="#">Control Panel</a><?php //echo anchor('bnw', 'Control Panel') ?>
                        <ul class="subMenu">
                            <li><?php echo anchor('bnw', 'Home') ?></li>
                            <li><?php echo anchor('bnw/menu', 'Navigation') ?></li>
                            <li><?php echo anchor('bnw', 'Categories') ?></li>
                        </ul>
                    </li>
                    <li class="mainMenuItem"><?php echo anchor('bnw', 'Pages') ?>
                        <ul class="subMenu">
                            <li><?php echo anchor('bnw/pages', 'Add New') ?></li>
                            <li><?php echo anchor('bnw', 'All Pages') ?></li>
                        </ul>
                    </li>
                    <li class="mainMenuItem"><?php echo anchor('bnw', 'Users') ?>
                        <ul class="subMenu">
                            <li><?php echo anchor('bnw', 'Add New') ?></li>
                            <li><?php echo anchor('bnw', 'All Users') ?></li>
                            <li><?php echo anchor('bnw', 'My Profile') ?></li>
                        </ul>
                    </li>
                    <li class="mainMenuItem"><?php echo anchor('bnw/menu', 'Menu') ?></li>
                    <li class="mainMenuItem"><?php echo anchor('bnw/pages', 'Pages') ?></li>
                    <li class="mainMenuItem"><?php echo anchor('bnw/activities', 'News & Events') ?></li>
                    <li class="mainMenuItem"><?php echo anchor('bnw/notice', 'Notice') ?></li>
                    <li class="mainMenuItem"><?php echo anchor('bnw/gadget', 'Gadget') ?></li>
                    <li class="mainMenuItem"><?php echo anchor('bnw/album', 'Album') ?></li>
                    <li class="mainMenuItem"><?php echo anchor('bnw/slider','Slider') ?> </li>
                    <li class="mainMenuItem"><?php echo anchor('bnw/blog', 'Blog') ?></li>
                    <li class="mainMenuItem"><?php echo anchor('bnw/download', 'Media') ?></li>
                    <li class="mainMenuItem"><?php echo anchor('bnw/setup', 'Setup') ?></li>    
                </ul>   
            </div>
        </div>
        
        
        <!left side is cleared and closed here>
        
        <div class="rightSide">
            
            <p>Welcome to dashboard of <b> B&W </b>. All the pages, Activities, News, Alumnae and Results manages through this page.
            Adding, Editing and Deleting content using this dashboard.
            </p>
            <p>
                This dashboard has been maintaining by <a href="http://www.salyani.com.np">Salyani Technologies (P) Ltd.</a>.<br/>
                For the support and maintenance please contact <a href="http://salyani.com.np" target="_blank">salyani Technologies</a>. 
            </p>
        </div>
        <div class="clear"></div>
        
    
        
        
        
    </div>
    <div id="footer">
            B&W 1.5 Copyright &copy 2014. All rights reserved to <a href="#">B&W</a>
        </div>
</body>
</html>
    
    
   
       
        
        
