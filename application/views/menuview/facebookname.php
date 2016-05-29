<xmlns:fb="http://www.facebook.com/2008/fbml">
 
    <div id="fb-root"></div>
    <script>
        window.fbAsyncInit = function() {
            FB.init({
                appId: '798589833503780',
                cookie: true,
                xfbml: true,
                oauth: true
            });
 
 
        };
        (function() {
            var e = document.createElement('script'); e.async = true;
            e.src = document.location.protocol +
                '//connect.facebook.net/en_US/all.js';
            document.getElementById('fb-root').appendChild(e);
        }());
    </script>
    <fb:serverFbml>
        <script type="text/fbml">
            <div style="font-size:2em;" >
                Hello, <fb:userlink uid="loggedinuser"/>
            </div>
        </script>
 
    </fb:serverFbml>
 

    
    <div id="fb-root"></div>
<script src="http://connect.facebook.net/en_US/all.js#xfbml=1"></script>
<fb:comments href="http://localhost/bnw/index.php/view/p/3" ></fb:comments>