<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/en_US/all.js#xfbml=1";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>

<div id="fb-root"></div>
<script>
  window.fbAsyncInit = function() {
  FB.init({
    appId      : '798589833503780',
    status     : true, // check login status
    cookie     : true, // enable cookies to allow the server to access the session
    xfbml      : true  // parse XFBML
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
  (function(d){
   var js, id = 'facebook-jssdk', ref = d.getElementsByTagName('script')[0];
   if (d.getElementById(id)) {return;}
   js = d.createElement('script'); js.id = id; js.async = true;
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

<!--
  Below we include the Login Button social plugin. This button uses the JavaScript SDK to
  present a graphical Login button that triggers the FB.login() function when clicked. -->

<fb:login-button show-faces="true" width="200" max-rows="1"></fb:login-button>


  <?php $nav= $this->uri->uri_string();
        $assc_id= str_replace('','', $nav); ?>   
    <?php if($selectedpostquery){
    foreach ($selectedpostquery as $post) {
                    ?>
                    <div class="container">
                        <div class="containerHeader">
                            <h3> <?php echo $post->post_title ; ?> </h3>
                            
                        </div>
                        <div class="content">

                            <p class="paragraph"><?php echo $post->post_content; ?></p>        
                        </div>
       <!--comment button and show comment-->                 
                        <div class="comment">                    
   <?php foreach ($commentallowquery as $data) {
                    ?>
                       
    <?php if($data->description==1)
    { 
        //================ IF ALL ALLOW COMMENT ================//
        ?>
        
                
 <div class="fb-comments" data-href="<?php echo 'http://localhost/bnw/index.php/'.$assc_id;?>" data-numposts="5" data-colorscheme="light"></div>
 
 <script src="//connect.facebook.net/en_US/all.js"></script>
    <?php }
 else {
     if($post->allow_comment==1)
     {
         //============== IF ONE POST ALLOW ==========//
         ?>
                
 <div class="fb-comments" data-href="<?php echo 'http://localhost/bnw/index.php/'.$assc_id;?>" data-numposts="5" data-colorscheme="light"></div>
 
 <script src="//connect.facebook.net/en_US/all.js"></script>
                
  
     <?php }  }   ?>                      
                <?php } ?>                      
   
                        </div> 
     
      <!--comment button closed -->
     
         <!--like button-->                 
                        <div class="comment">                    
   <?php foreach ($likeallowquery as $likedata) {
                    ?>
                       
    <?php if($likedata->description==1)
    { 
        //================ IF ALL ALLOW LIKE ================//
        ?>
                            
    <div class="fb-like" data-href="<?php echo 'http://localhost/bnw/index.php/'.$assc_id;?>" data-layout="standard" data-action="like" data-show-faces="false" data-share="false"></div>

     <!--<div class="fb-like" data-href="<?php echo 'http://localhost/bnw/index.php/'.$assc_id;?>" data-layout="standard" data-action="like" data-show-faces="false" data-share="false"></div>-->
      
     
                
    <?php }
 else {
     if($post->allow_like==1)
     {
         //============== IF ONE POST ALLOW ==========//
         ?>
                        
 <div class="fb-like" data-href="<?php echo 'http://localhost/bnw/index.php/'.$assc_id;?>" data-layout="standard" data-action="like" data-show-faces="false" data-share="false"></div>
     <?php }   }    ?>                  
                
                <?php } ?>                      
   
                        </div> 
     
      <!--like button closed -->
                    
       <!--share button -->                 
                        <div class="comment">                    
   <?php foreach ($shareallowquery as $sharedata) {
                    ?>
                       
    <?php if($sharedata->description==1)
    { 
        //================ IF ALL ALLOW share ================//
        ?>
                           
   
<div class="fb-share-button" data-href="<?php echo 'http://localhost/bnw/index.php/'.$assc_id;?>" data-type="button_count"></div>
     
                
    <?php }
 else {
     if($post->allow_share==1)
     {
         //============== IF ONE POST ALLOW ==========//
         ?>
                             
   
<div class="fb-share-button" data-href="<?php echo 'http://localhost/bnw/index.php/'.$assc_id;?>" data-type="button_count"></div>
     
    
   
  
     <?php }
       
    }
                        
                        
       ?>                  
                
                <?php } ?>                      
   
                        </div> 
     
      <!--share button closed -->
     
                    </div> 

                <?php }}
                else {
     echo '<h3> Sorry the page you requested is not found.</h3>';
} ?>



            </div>

            <div class="clear"></div>
            <!class full is closed here>