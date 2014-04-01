<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/en_US/all.js#xfbml=1";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>
    
    
    <?php foreach ($selectedpostquery as $post) {
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
        <script type="text/javascript">
         var currentUrl = window.location.href;
    document.getElementById("fb-comments").setAttribute("href", currentUrl);   
 </script> 
                
 <div id="fb-comments" ><fb:comments href="http://localhost/bnw/index.php/view/post/3"   ></fb:comments></div>
 
 <script src="//connect.facebook.net/en_US/all.js"></script>
    <?php }
 else {
     if($post->allow_comment==1)
     {
         //============== IF ONE POST ALLOW ==========//
         ?>

<script type="text/javascript">
         var currentUrl = window.location.href;
    document.getElementById("fb-comments").setAttribute("href", currentUrl);   
 </script> 
                
 <div id="fb-comments" ><fb:comments href="http://localhost/bnw/index.php/view/post/3"   ></fb:comments></div>
 
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
    <script type="text/javascript">
var sUrl = location.href;
document.getElementById('fb-like').setAttribute('data-href', sUrl);
</script>                        
    <div class="fb-like" id="fb-like" data-href="" data-layout="button_count" data-action="like" data-show-faces="false" data-share="false"></div>

     
      
     
                
    <?php }
 else {
     if($post->allow_like==1)
     {
         //============== IF ONE POST ALLOW ==========//
         ?>
<script type="text/javascript">
var sUrl = location.href;

document.getElementById('fb-like').setAttribute('data-href', sUrl);
</script>                        
    <div class="fb-like" id="fb-like" data-href="" data-layout="button_count" data-action="like" data-show-faces="false" data-share="false"></div>
  
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
       <script type="text/javascript">
var sUrl = location.href;
document.getElementById('fb-share').setAttribute('data-href', sUrl);
</script>                    
   
<div class="fb-share-button" id="fb-share" data-href="" data-type="button_count"></div>
     
                
    <?php }
 else {
     if($post->allow_share==1)
     {
         //============== IF ONE POST ALLOW ==========//
         ?>
         
    <script type="text/javascript">
var sUrl = location.href;
document.getElementById('fb-share').setAttribute('data-href', sUrl);
document.write(sUrl);
</script>                    
   
<div class="fb-share-button" id="fb-share" data-href="" data-type="button_count"></div>
     
    
   
  
     <?php }
       
    }
                        
                        
       ?>                  
                
                <?php } ?>                      
   
                        </div> 
     
      <!--share button closed -->
     
                    </div> 

                <?php } ?>



            </div>

            <div class="clear"></div>
            <!class full is closed here>