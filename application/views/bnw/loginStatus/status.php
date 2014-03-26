<!DOCTYPE html>

<html>
  <head>
    <title>Example</title>
  </head>
  <body>
    <!-- Load the Facebook JavaScript SDK -->
    <div id="fb-root"></div>
    <script src="//connect.facebook.net/en_US/all.js"></script>
    
    <script type="text/javascript">
      FB.getLoginStatus(function(response) {
  if (response.status === 'connected') {
    // the user is logged in and has authenticated your
    // app, and response.authResponse supplies
    // the user's ID, a valid access token, a signed
    // request, and the time the access token 
    // and signed request each expire
    var uid = response.authResponse.userID;
    var accessToken = response.authResponse.accessToken;
  } else if (response.status === 'not_authorized') {
    // the user is logged in to Facebook, 
    // but has not authenticated your app
  } else {
    // the user isn't logged in to Facebook.
  }
 });
 
 FB.getLoginStatus(function(response) {
  // this will be called when the roundtrip to Facebook has completed
}, true);
      // Initialize the Facebook JavaScript SDK
      FB.init({
        appId: 'APP_ID',
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
          alert('User is authorized');
          
          // Hide the login button
          document.getElementById('loginButton').style.display = 'none';
          
          // Now Personalize the User Experience
          console.log('Access Token: ' + response.authResponse.accessToken);
        } else {
          alert('User is not authorized');
          
          // Display the login button
          document.getElementById('loginButton').style.display = 'block';
        }
      }
    </script>
    
    <input id="loginButton" type="button" value="Login!" onclick="authUser();" />
  </body>
</html>