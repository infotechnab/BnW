<?php foreach ($selectedpagequery as $page) {
                    ?>
                    <div class="container">
                        <div class="containerHeader">
                            <h3> <?php echo $page->page_name ; ?> </h3>
                            
                        </div>
                        <div class="content">

                            <p class="paragraph"><?php echo $page->page_content; ?></p>        
                        </div>
                        
                             <div class="comment">                    
   <?php foreach ($commentallowquery as $data) {
                    ?>
                       
    <?php if($data->description==1)
    { 
        //================ IF ALL ALLOW COMMENT ================//
        ?>
                            
    <div id="fb-root"></div>
    <script src="//connect.facebook.net/en_US/all.js"></script>
    
    <script type="text/javascript">
      
      // Initialize the Facebook JavaScript SDK
      FB.init({
        appId: '798589833503780',
        xfbml: true,
        status: true,
        cookie: true
      });
      
      // Check if the current user is logged in and has authorized the app
      FB.getLoginStatus(checkLoginStatus);
      
      // Login in the current user via Facebook and ask for email permission
      function authUser() {
        FB.login(checkLoginStatus, {scope:'email'});
      }
      
      // Check the result of the user status and display login button if necessary
      function checkLoginStatus(response) {
        if(response && response.status == 'connected') {
          //alert('User is authorized');
          
          // Hide the login button
          document.getElementById('loginButton').style.display = 'none';
          
          
          // Now Personalize the User Experience
          console.log('Access Token: ' + response.authResponse.accessToken);
        } else {
          alert('User is not authorized');
          
          // Display the login button
          document.getElementById('loginButton').style.display = 'block';
          document.getElementById('subformDiv').style.display = 'none';
        }
      }
    </script>
    
    <input id="loginButton" type="button" value="Login!" onclick="authUser();" />
   <div id="subformDiv">
        <?php $nav= $this->uri->uri_string();
        $assc_id= str_replace('view/','', $nav); ?>
        <?php echo form_open_multipart('view/addcomment/?post_id='.$assc_id); ?>
       
        <input type="hidden" value="<?php echo $assc_id ;?>" />
        
        <textarea name="comment"></textarea>
        <input type="submit" value="Submit" />
        <?php echo form_close();?>
    </div>                  
    <?php }
 else {
     if($page->allow_comment==1)
     {
         //============== IF ONE POST ALLOW ==========//
         ?>
         <div id="fb-root"></div>
    <script src="//connect.facebook.net/en_US/all.js"></script>
    
    <script type="text/javascript">
      
      // Initialize the Facebook JavaScript SDK
      FB.init({
        appId: '798589833503780',
        xfbml: true,
        status: true,
        cookie: true
      });
      
      // Check if the current user is logged in and has authorized the app
      FB.getLoginStatus(checkLoginStatus);
      
      // Login in the current user via Facebook and ask for email permission
      function authUser() {
        FB.login(checkLoginStatus, {scope:'email'});
      }
      
      // Check the result of the user status and display login button if necessary
      function checkLoginStatus(response) {
        if(response && response.status == 'connected') {
          //alert('User is authorized');
          
          // Hide the login button
          document.getElementById('loginButton').style.display = 'none';
          
          
          // Now Personalize the User Experience
          console.log('Access Token: ' + response.authResponse.accessToken);
        } else {
          alert('User is not authorized');
          
          // Display the login button
          document.getElementById('loginButton').style.display = 'block';
          document.getElementById('subformDiv').style.display = 'none';
        }
      }
    </script>
    
    <input id="loginButton" type="button" value="Login!" onclick="authUser();" />
    <div id="subformDiv">
        <?php $nav= $this->uri->uri_string();
        $assc_id= str_replace('view/','', $nav); ?>
        <?php echo form_open_multipart('view/addcomment/?post_id='.$assc_id); ?>
       
        <input type="hidden" value="<?php echo $assc_id ;?>" />
        
        <textarea name="comment"></textarea>
        <input type="submit" value="Submit" />
        <?php echo form_close();?>
    </div>
     <?php }
       
    }
                        
                        
       ?>                  
                
                <?php } ?>                      
   
                        </div> 
                 
                        
      <div class="showComments">
        <h3>Comments:</h3>
      <?php foreach ($viewcomments as $data){   ?> 
        
        <div class="paragraph"> <?php echo $data->comment ; ?></div>
       
          
     <?php }  ?>
              
        
    </div> 
                        
                        
                        
                        
                        
                        
                    </div> 

                <?php } ?>
            </div>

            <div class="clear"></div>
            <!class full is closed here>