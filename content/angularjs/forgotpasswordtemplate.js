var app = angular.module('myApp', []);
app.controller('validateCtrl', function($scope) {
    $scope.email = '';
    $scope.incomplete=true;

   $scope.$watch('email',function() {$scope.test();});
$scope.test = function() {
  if ( $scope.email.length  ){
     $scope.incomplete = false;
  }
  else {
    $scope.incomplete=true;
  }
};
});