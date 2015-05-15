<!DOCTYPE html>
<html>
  <head>
   <meta charset="utf-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="BnW is a MVC CMS. It is developed by using 'PHP', the programming language and as framework Codeigniter is used. It is developed from Chitwan. The motto of this is to make content management and web production easy, fast, reliable and convenient.">
    <meta name="keywords" content="cms, CMS, Cms, BNW, BnW, bnw, black and white, theme, templates, free template, free cms, cms site, bnw cms, free website, free admin theme, free admin template, admin theme, admin template, content management, content management system, free content management system, website, free responsive theme, responsive template, website for free, black and white theme, black and white theme, black and white admin theme, black and white, black and white admin template, templating, salyani org, salyani, salyani tech, salyani technologies, cms from chitwan, chitwan, bharatpur, narayanghat, narayangarh, free responsive cms, responsive web">
    <meta name="author" content="Salyani Technologies">
<?php if(!empty($headerlogo)){
            foreach($headerlogo as $logo){
                $hlogo = $logo->description;
            }
        } ?>
    <?php if(isset($meta))
{
     foreach ($meta as $data)
     {
         $title[] = $data->value;
     }
}
?> 
    <meta property="og:title" content="<?php echo $title[1]; ?>">
<meta property="og:type" content="website" />
<meta property="og:image" content="<?php echo base_url().'content/uploads/images/'.$hlogo; ?>">
<meta property="og:url" content="http://www.salyani.com.np/bnw"/>
<meta property="og:description" content=" "/>
    

     
    <link rel="shortcut icon" href="<?php echo base_url().'content/uploads/images/'.$title[4]; ?>">
	<title> <?php if(!empty($headTitles)) { echo $headTitles." - BnW CMS. "; } else { echo $title[1]; } ?>  </title>
        <link rel="stylesheet" href="<?php echo base_url().'content/uploads/styles/custom.css'; ?>">
<link rel="stylesheet" href="<?php echo base_url().'content/uploads/bootstrap/css/bootstrap.css'; ?>">
<link href="http://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
     <script src="<?php echo base_url().'content/uploads/scripts/jquery.js'; ?>"></script>
      <script src="<?php echo base_url().'content/bootstrap/js/bootstrap.min.js'; ?>"></script>  
      
      
      
  </head>
  <body>
      
   
<!--==============================header=================================-->
<header style="border-bottom: 1px solid#eee;"> 
    <div class="container" style="width:100%; margin: 0; padding: 0% 0% 0% 5%;">
  
        <?php if(!empty($headerlogo)){
            foreach($headerlogo as $logo){
                $hlogo = $logo->description;
            }
        } ?>
        <?php if(!empty($headertitle)){
            foreach($headertitle as $title){
                $htitle = $title->description;
            }
        } ?>
         <div class="col-lg-5">
        <a href="<?php echo base_url(); ?>"><img id="logo-image-header" src="<?php echo base_url().'content/uploads/images/'.$hlogo; ?>" alt="BGR_logo"> <h4 id="header-title-heading"><?php echo $htitle; ?> </h4></a>
       
      </div>
        
        <div class="menu_block">
           <nav  class="nav" >
            <ul class="nav-list">        
                    <?php

            $this->load->helper('navigation_helper');

            fetch_menu (query(0));


        ?>   
                    
            </ul>
              </nav>
             
           </div>
           <div class="clear"></div>
      </div>

</header>
<script>
;(function($) {
	$(function() {

		$('.nav').append($('<div class="nav-mobile"></div>'));

		$('.nav-item').has('ul').prepend('<span class="nav-click"><i class="nav-arrow"></i></span>');

		$('.nav-mobile').click(function(){
			$('.nav-list').toggle();
		});

		$('.nav-list').on('click', '.nav-click', function(){

			$(this).siblings('.nav-submenu').toggle();

			$(this).children('.nav-arrow').toggleClass('nav-rotate');
			
		});
	    
	});
	
})(jQuery);
</script>
<div class="clearfix"></div>     
      
 






      
      
      
      
  </body>