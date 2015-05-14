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
      <script src="<?php echo base_url().'content/bootstrap/js/bootstrap.min.js'; ?>"></script>  
      
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
      </style>  
      
      
    </head>
    
    <body>
       
        <header>
          <div id="header-top">
            <div class="container">
                <div class="top-bar">
                    <div class="pull-left sample-1right hidden-xs">
                        <a><i class="fa fa-phone"></i> Call us: <span class="colored-text">+02 34543454</span> </a> 
                        <a><i class="fa fa-envelope"></i> Mail us: <span class="colored-text">Support@domain.com</span> </a>
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
							<a class="facebook" href="#"><i class="fa fa-facebook square-2 rounded-1"></i></a>
							<a class="twitter" href="#"><i class="fa fa-twitter square-2 rounded-1"></i></a>
							<a class="google-plus" href="#"><i class="fa fa-google-plus square-2 rounded-1"></i></a>
						</div>
					</div>
                    
                </div>
            </div>
        </div>  
            
            
            
            
            
        </header>   