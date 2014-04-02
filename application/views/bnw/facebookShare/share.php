<!DOCTYPE HTML>
<html>
    <head></head>
    
    <body>
        
<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/en_US/all.js#xfbml=1";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>

<div class="fb-like" data-href="http://facebook.com/salyani.organization" data-layout="button_count" data-action="like" data-show-faces="false" data-share="false"></div>
<!--<div id="fb-comments" class="fb-like" data-href="" data-layout="button_count" data-action="like" data-show-faces="false" data-share="false"></div>-->
<!--<div class="fb-like" data-href="http://facebook.com/salyani.organization" data-layout="standard" data-action="like" data-show-faces="false" data-share="false"></div>-->
<?php $nav= $this->uri->uri_string();
        $assc_id= str_replace('','', $nav); ?>

<div id="fb-comments" class="fb-share-button" data-href="" data-type="button_count"></div>

<div id="fb-comments" class="fb-comments" data-href=<?php echo 'http://localhost/bnw/index.php/'.$assc_id;?> data-numposts="5" data-colorscheme="light"></div>


</div>
    </body>
</html>



