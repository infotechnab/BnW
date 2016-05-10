 <!DOCTYPE html>
 <html>
 <head>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta charset="utf-8">
  <?php if(isset($meta))
  { foreach ($meta as $data){  $title[] = $data->value; }}?>        
  <title>.:Dashboard <?php echo $title[1]; ?></title>
  <!-- load boostrpa css -->
<link rel="stylesheet" href="<?php echo base_url().'content/bootstrap/css/bootstrap.min.css'; ?>">
<!-- load boostrap reponsvie csss -->

<link rel="stylesheet" href="<?php echo base_url().'content/bootstrap/css/bootstrap-responsive.min.css'; ?>">
<!-- load default style for  login panel -->

<link rel="stylesheet" href="<?php echo base_url().'content/bnw/styles/loginstyle.css'; ?>">
<!-- load angualr js  -->

<script src="<?php echo base_url().'content/angularjs/angular.min.js'; ?>"></script>
<!-- load jquery libaray -->

<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.2/jquery.min.js"></script>
 </head>  <!--head closed -->

<!-- >>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>body starts >>>>>>>>>>>>>>>>>>>>>>>>>>>>> -->
<body>
<!-- main  bootstrap container class define angualr js ng-appp= login and ng-controller ="loginctrl" -->

 <div class="container" ng-app="login" ng-controller="loginCtrl">
  <div class="modal-dialog">
  <!-- modal content -->

   <div class="modal-content">
   <!-- modal header -->

    <div class="modal-header" style="padding:10px 5px;">  
     <img  alt="bnw" src="<?php echo base_url()."content/bnw/images/bnw.png"; ?>"/>
    </div>
   <div class="modal-body" style="padding:20px 5px;">
   <?php  //if admin login eror occur
              $cookie_name = "attempts";

                 if(isset($_COOKIE[$cookie_name])) // if the cookie extis block user for 15 minutes in this pc;
                 {

                    // display error message for login attempt 
                   echo "<div class='alert alert-default fade in ' style='background-color:black;color:white;padding:2px font-size:13px;'><strong>3 wrong attempt plz wait for 15 minutes</strong></div>"; 
                   ?>

                   <!-- if  3 login attempt disabled all input field  -->
                   <script>
                    $(document).ready(function(){

                      $("input").attr('disabled', true);
                      

                    });
                  </script>
                  <?php

                }
                
                else {

                // display error mesage if username and password is not match 

                 $admin_login_error=$this->session->flashdata('message');
                 if(isset($admin_login_error))
                 {
                   echo "<div class='alert alert-default fade in ' style='background-color:black;color:white;'><strong>".$admin_login_error."</strong></div>"; 
                 } 
               }


               ?>
               <!-- form fo username -->
            <!-- form starts  -->
    <form role="form"  id="form" action="<?php echo base_url().'login/validate_credentials'; ?>" method="post"  name="myForm" novalidate>
           <!-- send url by hidden field -->

              <input type="hidden" name="requersUrl" value="<?php echo $link; ?>">

              <!-- form  form username -->

               <div class="form-group">
                <label for="usrname"><span class="glyphicon glyphicon-user"></span> Username</label>
                <input type="text" class="form-control" id="usrname" name="username" ng-model="username" placeholder="Enter username" required>
                <span  id="span" style="color:red" ng-show="myForm.username.$dirty && myForm.username.$invalid">
                  <span id="span" ng-show="myForm.username.$error.required">Username is required.</span>
                </span>
              </div>
              <!-- form for password  -->

              <div class="form-group">
                <label for="psw"><span class="glyphicon glyphicon-eye-open"></span> Password</label>
                <input type="password" class="form-control" id="psw"  ng-model="password" name="password" placeholder="Enter password" required>
                <span  id="span" style="color:red" ng-show="myForm.password.$dirty && myForm.password.$invalid">
                 <span  id="span" ng-show="myForm.password.$error.required">password is required. </span>
               </span>
             </div>
             <!-- form for checkbox -->

             <div class="checkbox">
               <label><input type="checkbox" value="1" name="checkMe">Stay Logged In</label>
             </div>
             <!-- form buttons  -->

             <button type="submit" ng-disabled="myForm.password.$dirty && myForm.password.$invalid ||
             myForm.username.$dirty && myForm.username.$invalid || incomplete " class="btn btn-default btn-lg btn-block" style="background-color:#000;color:#fff;"><span class="glyphicon glyphicon-off"></span> Login</button>
           
           </form>
           <br>
           <!-- forgot password link  -->

           <p class="pull-right"> <a  style="color:black;" href="<?php echo base_url().'index.php/login/forgotPassword'; ?>">Forgot Password</a></p>
         </div>
         <!-- modal footer starts -->
         <div class="modal-footer">
         </div>
         <!-- modal footer closed -->
        </div> <!-- modal content closed -->
     </div> <!--modal dialog closed -->
    </div> <!-- main container class -->

    <!-- angular template for form validation adn watch -->
   <script src="<?php echo base_url().'content/angularjs/logintemplate.js'; ?>"></script>
 </body> 
 <!-- body closed  -->
 </html>
 <!-- html closed  -->
