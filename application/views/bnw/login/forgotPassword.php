<!DOCTYPE html>
<html>
<head>
  <meta name="viewport" content="width=device-width, initial-scale=1">
   <meta charset="utf-8">
<?php if(isset($meta))
{ foreach ($meta as $data) {  $title[] = $data->value; }}
?>        
    <title>.:Dashboard <?php echo $title[1]; ?></title>
</head>
   <link rel="stylesheet" href="<?php echo base_url().'content/bootstrap/css/bootstrap.min.css'; ?>">
  <link rel="stylesheet" href="<?php echo base_url().'content/bootstrap/css/bootstrap-responsive.min.css'; ?>">
   <link rel="stylesheet" href="<?php echo base_url().'content/bnw/styles/loginstyle.css'; ?>">
   <script src="<?php echo base_url().'content/angularjs/angular.min.js'; ?>"></script>
</head>
<div class="container" >
<div class="modal-dialog">
       <div class="modal-content">
        <div class="modal-header" style="padding:30px 20px;">  
         <img  alt="bnw" src="<?php echo base_url()."content/bnw/images/bnw.png"; ?>"/>
        </div>
 <div class="modal-body" style="padding:50px 50px;">

<form ng-app="myApp" action="<?php echo  base_url().'login/email' ; ?>" method="post" ng-controller="validateCtrl" 
name="myForm" novalidate>

           <?php  //if  eror occur
           $admin_login_error=$this->session->flashdata('message');
                if(isset($admin_login_error)) {
                echo "<div class='alert alert-default fade in ' style='background-color:black;color:white;'><strong>".$admin_login_error."</strong></div>"; } ?>

<table>
<tr>
<td>
<input type="email" class="form-control"  name="user_email" ng-model="email" required>


</td>
<td>


<input   type="submit"  class="  btn btn-default btn-block " value="submit email"
  ng-disabled="incomplete ||
  myForm.user_email.$dirty && myForm.user_email.$invalid ">
</td>
</tr>

</table>
<p>
<span style="color:red" ng-show="myForm.user_email.$dirty && myForm.user_email.$invalid">
<span ng-show="myForm.user_email.$error.required">Email is required.</span>
<span ng-show="myForm.user_email.$error.email">Invalid email address.</span>
</span>
</p>


</form>
</div>
  <script src="<?php echo base_url().'content/angularjs/forgotpasswordtemplate.js'; ?>"></script>


</script>

</body>
</html>
