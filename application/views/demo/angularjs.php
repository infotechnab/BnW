<!DOCTYPE html>
<html>
<head>
    <!-- CSS -->
    <link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.0.3/css/bootstrap.min.css" />
    <style>
        body     { padding-top:30px; }
    </style>
    <!-- JS -->
    <script src="http://code.angularjs.org/1.2.6/angular.js"></script>
</head>
<body ng-app="validationApp" ng-controller="mainController">
<div class="container">
    <!-- PAGE HEADER -->
    <!-- =================================================================== -->
    <!-- FORM ============================================================== -->
    <!-- =================================================================== -->
    <!-- pass in the variable if our form is valid or invalid -->
    <form name="userForm" ng-submit="submitForm(userForm.$valid)" novalidate>
        <!-- NAME -->
        <div class="form-group" ng-class="{ 'has-error' : userForm.name.$invalid && !userForm.name.$pristine }">
            <label>Name*</label>
            <input type="text" name="name" class="form-control" ng-model="user.name" required>
            <p ng-show="userForm.name.$invalid && !userForm.name.$pristine" class="help-block">You name is required.</p>
        </div> 
        <!-- USERNAME -->
        <div class="form-group" ng-class="{ 'has-error' : userForm.username.$invalid && !userForm.username.$pristine }">
            <label>Username</label>
            <input type="text" name="username" class="form-control" ng-model="user.username" ng-minlength="3" ng-maxlength="8">
            <p ng-show="userForm.username.$error.minlength" class="help-block">Username is too short.</p>
            <p ng-show="userForm.username.$error.maxlength" class="help-block">Username is too long.</p>
        </div>       
        <!-- EMAIL -->
        <div class="form-group" ng-class="{ 'has-error' : userForm.email.$invalid && !userForm.email.$pristine }">
            <label>Email</label>
            <input type="email" name="email" class="form-control" ng-model="user.email">
            <p ng-show="userForm.email.$invalid && !userForm.email.$pristine" class="help-block">Enter a valid email.</p>
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>    
</div>
</body>
</html>
<script>
// create angular app
var validationApp = angular.module('validationApp', []);

// create angular controller
validationApp.controller('mainController', function($scope) {

	// function to submit the form after all validation has occurred			
	$scope.submitForm = function(isValid) {

		// check to make sure the form is completely valid
		if (isValid) { 
			alert('our form is amazing');
		}

	};

});
</script>
