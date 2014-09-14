<!DOCTYPE html>
<html>
    <head>
        <title>Central College </title>
<meta property="og:title" content="Central College" />
<meta property="og:type" content="Text" />
<meta property="og:url" content="http://www.centralcollege.com.np" />
<meta property="og:image" content="http://www.centralcollege.com.np/content/uploads/images/Central_College_color.png" />

        <meta name="viewport" content="width-device-width" initial-scale="1.0">
        <link rel="stylesheet" href="<?php echo base_url().'content/uploads/styles/style.css';?>" type="text/css"> 
        <link rel="stylesheet" href="<?php echo base_url().'content/uploads/bootstrap/css/bootstrap.min.css';?>" type="text/css"> 
        <link rel="stylesheet" href="<?php echo base_url().'content/uploads/bootstrap/css/bootstrap-responsive.min.css';?>" type="text/css"> 
        <link rel="stylesheet" href="<?php echo base_url().'content/uploads/bootstrap/css/bootstrap-flat-extras.min.css';?>" type="text/css"> 
        <link rel="stylesheet" href="<?php echo base_url().'content/uploads/bootstrap/css/bootstrap-flat.min.css';?>" type="text/css"> 
        
       <script src="<?php echo base_url().'content/uploads/bootstrap/js/bootstrap.min.js'; ?>"></script> 
        <script src="<?php echo base_url().'content/uploads/scripts/jquery.js'; ?>"></script> 
    <script>
        $(function() {
            $('#myCarousel').carousel({
               interval: 2000
            });
           
           $("#pagetop").mouseover(function(){
              $(this).css("opacity","1");
           });
           
           
        });
        
        
        var pagetop, menu, yPos, base_url='<?php echo base_url(); ?>'; 
        function yScroll(){
            pagetop = document.getElementById('pagetop');
            menu = document.getElementById('menu');
            yPos = window.pageYOffset;
            if(yPos > 120){ 
                pagetop.style.height = "36px";
                pagetop.style.paddingTop = "4px";
                pagetop.style.filter  = 'alpha(opacity=50)';  //IE fallback
                menu.style.height = "40px";
                $(".logo_").css("background","#fff");
                $(".logo_").css("margin-top","-7px");
                $(".logo_").css("padding", "1%")
                $(".logo_").html("<img src=" + base_url + "content/uploads/images/Central_College_logo_.png>");
            } else {
                pagetop.style.filter  = 'alpha(opacity=100)';  //IE fallback
                pagetop.style.height = "130px";
                pagetop.style.paddingTop = "10px";
                menu.style.height = "40px"; 
                $(".logo_").css("background","#880000");
                $(".logo_").css("margin-top","0px");
                $(".logo_").css("padding", "0%")
                $(".logo_").html(" ");
            } 
        }
        window.addEventListener("scroll", yScroll);
    </script>
    </head>
    <body>
        <div id="fb-root"></div>
        <script>(function(d, s, id) {
                var js, fjs = d.getElementsByTagName(s)[0];
                if (d.getElementById(id))
                    return;
                js = d.createElement(s);
                js.id = id;
                js.src = "//connect.facebook.net/en_US/all.js#xfbml=1";
                fjs.parentNode.insertBefore(js, fjs);
            }(document, 'script', 'facebook-jssdk'));</script>

        <div id="fb-root"></div>
        <script>
            window.fbAsyncInit = function() {
                FB.init({
                    appId: '798589833503780',
                    status: true, // check login status
                    cookie: true, // enable cookies to allow the server to access the session
                    xfbml: true  // parse XFBML
                });

                // Here we subscribe to the auth.authResponseChange JavaScript event. This event is fired
                // for any authentication related change, such as login, logout or session refresh. This means that
                // whenever someone who was previously logged out tries to log in again, the correct case below 
                // will be handled. 
                FB.Event.subscribe('auth.authResponseChange', function(response) {
                    // Here we specify what we do with the response anytime this event occurs. 
                    if (response.status === 'connected') {
                        // The response object is returned with a status field that lets the app know the current
                        // login status of the person. In this case, we're handling the situation where they 
                        // have logged in to the app.
                        testAPI();
                    } else if (response.status === 'not_authorized') {
                        // In this case, the person is logged into Facebook, but not into the app, so we call
                        // FB.login() to prompt them to do so. 
                        // In real-life usage, you wouldn't want to immediately prompt someone to login 
                        // like this, for two reasons:
                        // (1) JavaScript created popup windows are blocked by most browsers unless they 
                        // result from direct interaction from people using the app (such as a mouse click)
                        // (2) it is a bad experience to be continually prompted to login upon page load.
                        FB.login();
                    } else {
                        // In this case, the person is not logged into Facebook, so we call the login() 
                        // function to prompt them to do so. Note that at this stage there is no indication
                        // of whether they are logged into the app. If they aren't then they'll see the Login
                        // dialog right after they log in to Facebook. 
                        // The same caveats as above apply to the FB.login() call here.
                        FB.login();
                    }
                });
            };

            // Load the SDK asynchronously
            (function(d) {
                var js, id = 'facebook-jssdk', ref = d.getElementsByTagName('script')[0];
                if (d.getElementById(id)) {
                    return;
                }
                js = d.createElement('script');
                js.id = id;
                js.async = true;
                js.src = "//connect.facebook.net/en_US/all.js";
                ref.parentNode.insertBefore(js, ref);
            }(document));

            // Here we run a very simple test of the Graph API after login is successful. 
            // This testAPI() function is only called in those cases. 
            function testAPI() {
                console.log('Welcome!  Fetching your information.... ');
                FB.api('/me', function(response) {
                    console.log('Good to see you, ' + response.name + '.');
                });
            }
        </script>


        
        
        <div class="containe">
        <div class="header">
            
            <div id="pagetop">
                <?php foreach ($headerlogo as $header) {
                    ?>
    
                
                <img src="<?php echo base_url().'content/uploads/images/'.$header->description ; ?>" style="height: 90px;" />
               
                <?php } ?>
<!--                        <img src="<?php //echo base_url().'content/uploads/images/Central_College_color.png'; ?>">-->
                     
                        
                    <div class="fb-like" data-href="<?php echo base_url(); ?>" data-layout="button_count" data-action="like" data-show-faces="false" data-share="false"></div>
                  
                    <div id="menu">
                
                        <!--<div class="logo_" style="float:left;width:5%;text-align: center;padding: 3px;margin: 4px;"></div>-->
                <ul>
                    <li class="logo_"></li>
                     <?php

            $this->load->helper('viewmenuhelper');

            fetch_menu (query(0));

        ?>

                </ul>
                </div>
               
            </div>
            </div>
              
            
                  
        </div>
            
         
<div class="main">
    