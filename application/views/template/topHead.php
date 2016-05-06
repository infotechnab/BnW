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
    <meta property="og:title" content="BnW - A complete CMS">
<meta property="og:type" content="website" />
<meta property="og:image" content="<?php echo base_url().'content/uploads/images/'.$hlogo; ?>">
<meta property="og:url" content="http://www.salyani.com.np/bnw"/>
<meta property="og:description" content="BnW is a MVC CMS. It is developed by using 'PHP', the programming language and as framework Codeigniter is used. It is developed from Chitwan. The motto of this is to make content management and web production easy, fast, reliable and convenient."/>
    

    <?php if(isset($meta))
{
     foreach ($meta as $data)
     {
         $title[] = $data->value;
     }
}
?>  
    <link rel="shortcut icon" href="<?php echo base_url().'content/uploads/images/'.$title[4]; ?>">
	<title> <?php if(!empty($headTitles)) { echo $headTitles." - BnW CMS. "; } else { echo $title[1]; } ?>  </title>
<link rel="stylesheet" href="<?php echo base_url().'content/uploads/bootstrap/css/bootstrap.css'; ?>">
<link href="http://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
     <script src="<?php echo base_url().'content/uploads/scripts/jquery.js'; ?>"></script>
      <script src="<?php echo base_url().'content/uploads/bootstrap/js/bootstrap.min.js'; ?>"></script>  
      
      <style>
          body {background-color: #fff;color: #424242;font-family: "Open Sans",sans-serif;font-size: 14px;line-height: 24px;margin: 0; padding: 0;}
          #header-top {background-color: #f8f8f8;border-bottom: 1px solid #eee;}
.top-bar {line-height: 45px;min-height: 45px;}
.top-bar form .form-control {border-radius: 20px;margin-top: 6px;transition: all 0.3s ease-in-out 0s;width: 150px;}
.top-bar button {background-color: transparent;border: 0 none;height: auto;line-height: 15px;margin: 0;padding: 0;position: absolute;right: 125px;top: 15px;width: auto;}
.top-bar .form-group {margin: 0;}
.top-bar a {color: #888;font-size: 13px;margin-right: 10px;}
.top-bar a:hover {text-decoration: none;cursor: pointer;}
.colored-text {color: #2196f3;}
.brand-bg a.facebook i {
    background: #3280e7 none repeat scroll 0 0;
}
.brand-bg a.facebook i:hover {
    background: #134fa0 none repeat scroll 0 0;
}
.brand-bg a.twitter i:hover {
    background: #188392 none repeat scroll 0 0;
}
.brand-bg a.twitter i {
    background: #32c8de none repeat scroll 0 0;
}
.brand-bg a.google-plus i {
    background: #f96f4a none repeat scroll 0 0;
}
.brand-bg a.google-plus i:hover {
    background: #eb6440 none repeat scroll 0 0;
}
.top-bar .tb-social i {
    font-size: 13px;
    margin: 0 2px 0 0;
}
.brand-bg a{  
   color: #999;
}
.brand-bg a i {
    color: #fff;
    display: inline-block;
    font-size: 14px;
    margin-right: 5px;
    text-align: center;
    text-decoration: none;
    transition: background 2s ease 0s;
}
.rounded-1 {
    border-radius: 2px !important;
}
.square-2 {
    display: inline-block;
    height: 25px;
    line-height: 25px;
    text-align: center;
    width: 25px;
}
#anchor_nav{
     padding: 2px 15px;
}
.navbar-default {
    background: #fff none repeat scroll 0 0;
    border: medium none;
    border-radius: 0;
    box-shadow: -1px 1px 1px rgba(0, 0, 0, 0.1);
    clear: both;
    font-family: "PT Sans",sans-serif;
    margin-bottom: 0;
    min-height: 70px;
    padding: 10px 0;
    transition: all 0.4s ease-in-out 0s;
    width: 100%;
}
.navbar-default .navbar-nav > li > a {
    color: #333;
    font-family: "Open Sans",sans-serif;
    font-size: 13px;
    font-weight: 600;
    text-transform: uppercase;
    background: none;
}
.navbar-nav > li > a:hover {
    color: #3280e7;
    
}
.navbar-nav > li.dropdown:hover > ul.dropdown-menu{
    display: block;
}
.navbar-nav > li.dropdown:hover > ul.dropdown-menu > li.dropdown{
    display: block;
}

.navbar-default .navbar-nav >li.active a
{
    background: #fff;
    color: #3280e7;
}
.navbar-default .navbar-nav > li.dropdown > ul li.dropdown:hover > ul.dropdown-menu{
    display: block;
}
.navbar-default .navbar-nav >li.active a
{
    background: #fff;
    color: #3280e7;
}
.navbar-default .navbar-nav >li.active
{
    background: #fff;
    color: #3280e7;
}
.navbar .dropdown-menu li a:hover {
    background-color: #2196f3;
    color: #fff;
}
.navbar .dropdown-menu li a {
    border-bottom: 1px solid #f3f3f3;
    color: #666;
    font-family: "Open Sans",sans-serif;
    font-size: 12px;
    font-weight: 400;
    line-height: 1.42857;
    padding: 10px 16px;
    text-transform: capitalize;
}
.fixedTop {position:fixed; top:0;z-index:100; width:100%;}
.center-heading {
    margin-bottom: 40px;
    text-align: center;
}
.center-heading h2 {
    color: #000;
    font-size: 20px;
    font-weight: 700;
    letter-spacing: 0.09em;
    line-height: 27px;
    margin-bottom: 5px;
    text-transform: uppercase;
}
.center-line {
    border-top: 1px solid #bbb;
    display: inline-block;
    height: 1px;
    margin: auto;
    width: 70px;
}
.center-heading p {
    margin-top: 10px;
}
p.sub-text {
    color: #bbb;
    font-size: 18px;
    font-style: normal;
    font-weight: 300;
    line-height: 29px;
}
.margin40 {
    margin-bottom: 40px;
}
.margin30 {
    margin-bottom: 30px;
}
.colored-boxed {
    text-align: center;
}
.colored-boxed.green i {
    border-color: #2196f3;
    color: #2196f3;
}
.colored-boxed.dark i {
    border-color: #333;
    color: #333;
}
.colored-boxed.blue i {
    border-color: #3b5998;
    color: #3b5998;
}
.colored-boxed.red i {
    border-color: #cb2027;
    color: #cb2027;
}
.colored-boxed p {
    color: #858d91;
    font-family: "Open Sans",sans-serif;
    font-weight: 400;
    line-height: 24px;
    margin: 10px 0 20px 0px;
}
.colored-boxed i {
    background-color: transparent;
    border: 1px solid;
    border-radius: 50%;
    font-size: 30px;
    height: 70px;
    line-height: 70px;
    text-align: center;
    width: 70px;
}
.colored-boxed h3 {
    font-size: 16px;
    font-weight: 600;
    margin-bottom: 0;
    margin-top: 20px;
    text-transform: uppercase;
}
.blue-bg {
    background-color: #2196f3;
    padding-bottom: 40px;
    padding-top: 70px;
}
.animated {
    animation-duration: 1s;
    animation-fill-mode: both;
}
.services-box{color: #fff;}
.services-box-icon {
    background: transparent none repeat scroll 0 0;
    display: inline-block;
    float: left;
    height: 35px;
    line-height: 35px;
    margin-right: 10px;
    position: relative;
    text-align: center;
    top: 5px;
    width: 50px;
}
.blue-bg .services-box i {
    box-shadow: none;
    font-size: 50px;
    margin-right: 25px;
}
.services-box-icon i {
    background-color: #2196f3;
    box-shadow: 2px 2px 1px 0 rgba(0, 0, 0, 0.1);
    color: #fff;
    font-size: 20px;
    height: 40px;
    line-height: 40px;
    text-align: center;
    width: 40px;
}
.cta-one .cta-one-content {
    padding: 20px 25px;
}
footer {
    background: #333333 none repeat scroll 0 0;
    border-top: 1px solid rgba(255, 255, 255, 0.05);
    color: #ccc;
    font-size: 12px;
    padding: 15px 10px 4px;
}
#download {   
    background-color: #2e363f;
    color: #fff; 
    padding: 20px 0px 20px 0px;
}

*::before, *::after {
    box-sizing: border-box;
}
*::before, *::after {
    box-sizing: border-box;
}
.btn.btn-color {
    background: #32c8de none repeat scroll 0 0;
    border: 1px solid #1faabe;
    color: #ffffff;
}
.cta-one .btn {
    margin-top: 30px;
    text-align: center;
}
.btn {
    border-radius: 2px;
    position: relative;
}
.btn.btn-color {
    background: #32c8de none repeat scroll 0 0;
    border: 1px solid #1faabe;
    color: #ffffff;
}
.list-2 li{list-style-type: none;}
.list-2 li::before {
    content: "";
    float: left;
    font-family: "FontAwesome";
    margin-left: -20px;
}
#footer {
    background: #111 none repeat scroll 0 0;
    clear: both;
    font-size: 0.9em;
    padding: 10px 0 0;
    position: relative;
}
.social-1 {
    margin: 0;
    padding: 0;
}
.footer-col h3 {
    color: #fff;
    font-size: 14px;
    font-style: normal;
    font-weight: 700;
    letter-spacing: 1px;
    margin-bottom: 25px;
}
.social-1 li a i {
    border-radius: 2px;
    color: #fff;
    font-size: 16px;
    height: 32px;
    line-height: 32px;
    text-align: center;
    transition: all 200ms ease-in 0s;
    width: 32px;
}
.social-1 li a i.fa-facebook {
    background-color: #3b5998;
}
.social-1 li a i.fa-twitter {
    background-color: #0084b4;
}
.social-1 li a i.fa-google-plus {
    background-color: #c63d2d;
}
.bold {
    font-weight: 600;
}
header#page-title {
    color: #2d2f3c;
}
header#page-title {
    background: #ddd none no-repeat scroll 50% 50% / cover ;
    color: #fff;
    margin-bottom: 40px;
    padding: 20px 0;
    position: relative;
}
.breadcrumb {
    background: rgba(0, 0, 0, 0) none repeat scroll 0 0;
    border-radius: 0;
    display: inline-block;
    font-size: 13px;
    margin: -3px 0 0;
    padding: 0;
    position: relative;
}
.error{color:red;}
      </style>  
      <script>
          $(document).ready(function() {
    var s =$('#undefined-sticky-wrapper');
    var pos = s.position();                    
    $(window).scroll(function() {
        var windowpos = $(window).scrollTop();
        if (windowpos >= pos.top) {
            s.addClass("fixedTop");
            s.css("height", "50px");
            $('.navbar-default').css("min-height", "50px");
            $('.navbar-default').css("padding", "0px");
        } else {
            s.removeClass("fixedTop"); 
            $('.navbar-default').css("min-height", "70px");
            $('.navbar-default').css("padding", "10px 0px");
        }
    });
    

$('.tab-links a').click(function(){
    $('.tab-links a').removeClass('selected')
    $(this).addClass('selected');
});


    $('li.dropdown').click(function(){
        $('li.dropdown').removeClass('active');
        $(this).addClass('active');
         $(this).css("background", "#fff");
         
    });
    
    
});
          </script>
      
    </head>
    
    <body>
       
        <header>
          <div id="header-top">
            <div class="container">
                <div class="top-bar">
                    <div class="pull-left sample-1right hidden-xs">
                        <a><i class="fa fa-phone"></i> Call us: <span class="colored-text">+977-56-533977</span> </a> 
                        <a><i class="fa fa-envelope"></i> Mail us: <span class="colored-text">info@salyani.com.np</span> </a>
                    </div>
                    
                    <div class="pull-right">
                        <form>
                            <div class="form-group">
                                <input type="text" placeholder="search..." class="form-control">

                                <button type="button"><i class="fa fa-search"></i></button>

                            </div><!--input group-->
                        </form><!--form-->
                    </div>
                    <div class="tb-social pull-right">
						<div class="brand-bg text-right">
							<!-- Brand Icons -->
                                                        <a class="facebook" href="https://www.facebook.com/bnwcms" target="_blank"><i class="fa fa-facebook square-2 rounded-1"></i></a>
<!--							<a class="twitter" href="#"><i class="fa fa-twitter square-2 rounded-1"></i></a>
							<a class="google-plus" href="#"><i class="fa fa-google-plus square-2 rounded-1"></i></a>-->
						</div>
					</div>
                    
                </div>
            </div>
        </div>  
            
            
            
            
            
        </header>   