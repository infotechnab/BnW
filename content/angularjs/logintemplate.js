var app = angular.module('login', []);
app.controller('loginCtrl', function($scope) {
    $scope.username = '';
    $scope.password = '';
    $scope.incomplete=true;

$scope.$watch('username',function() {$scope.test();});
$scope.$watch('password',function() {$scope.test();});
$scope.test = function() {
  if ( $scope.username.length && $scope.password.length ){
     $scope.incomplete = false;
  }
  else {
    $scope.incomplete=true;
  }
};

});