http://www.shivasoft.in/blog/webtech/web/pagination-and-sorting-of-data-table-using-angularjs/
<div ng-app="myApp">
    <div ng-controller="TableCtrl">
        <div class="input-group">
            <input class="form-control" ng-model="searchText" placeholder="Search" type="search" ng-change="search()" /> <span class="input-group-addon">
      <span class="glyphicon glyphicon-search"></span>
</span>
        </div>
        <table class="table  table-hover data-table myTable">
            <thead>
                <tr>
                    <th class="EmpId"> <a href="#" ng-click="sort('EmpId',$event)">EmpId
                         <span class="{{Header[0]}}"></span>
                         </a>

                    </th>
                    <th class="name"> <a ng-click="sort('name')" href="#"> Name
                         <span class="{{Header[1]}}"></span></a>
                    </th>
                    <th class="Email"> <a ng-click="sort('Email')" href="#"> Email
                     <span class="{{Header[2]}}"></span></a>
                    </th>
                </tr>
            </thead>
            <tbody>
                <tr ng-repeat="item in ItemsByPage[currentPage] | orderBy:columnToOrder:reverse">
                    <td>{{item.EmpId}}</td>
                    <td>{{item.name}}</td>
                    <td>{{item.Email}}</td>
                </tr>
            </tbody>
        </table>
        <ul class="pagination pagination-sm">
            <li ng-class="{active:0}"><a href="#" ng-click="firstPage()">First</a>

            </li>
            <li ng-repeat="n in range(ItemsByPage.length)"> <a href="#" ng-click="setPage()" ng-bind="n+1">1</a>

            </li>
            <li><a href="#" ng-click="lastPage()">Last</a>

            </li>
        </ul>
        <div class="row">
            <div class="col-xs-3">
                <input type="text" ng-model="newEmpId" class="form-control" placeholder="EmpId">
            </div>
            <div class="col-xs-3">
                <input type="text" ng-model="newName" class="form-control" placeholder="Name">
            </div>
            <div class="col-xs-4">
                <input type="email" ng-model="newEmail" class="form-control" placeholder="Email">
            </div>
            <div class="col-xs-1">
                <button ng-click="add()" type="button" class="btn btn-primary"> <span class="glyphicon glyphicon-plus"></span>

                </button>
            </div>
        </div>
    </div>
    <!-- Ends Controller -->
</div>
<script>
    //Demo of Searching Sorting and Pagination of Table with AngularJS - Advance Example

var myApp = angular.module('myApp', []);

//Not Necessary to Create Service, Same can be done in COntroller also as method like add() method
myApp.service('filteredListService', function () {

    this.searched = function (valLists, toSearch) {
        return _.filter(valLists,

        function (i) {
            /* Search Text in all 3 fields */
            return searchUtil(i, toSearch);
        });
    };

    this.paged = function (valLists, pageSize) {
        retVal = [];
        for (var i = 0; i < valLists.length; i++) {
            if (i % pageSize === 0) {
                retVal[Math.floor(i / pageSize)] = [valLists[i]];
            } else {
                retVal[Math.floor(i / pageSize)].push(valLists[i]);
            }
        }
        return retVal;
    };

});

//Inject Custom Service Created by us and Global service $filter. This is one way of specifying dependency Injection
var TableCtrl = myApp.controller('TableCtrl', function ($scope, $filter, filteredListService) {

    $scope.pageSize = 4;
    $scope.allItems = getDummyData();
    $scope.reverse = false;

    $scope.resetAll = function () {
        $scope.filteredList = $scope.allItems;
        $scope.newEmpId = '';
        $scope.newName = '';
        $scope.newEmail = '';
        $scope.searchText = '';
        $scope.currentPage = 0;
        $scope.Header = ['', '', ''];
    }

    $scope.add = function () {
        $scope.allItems.push({
            EmpId: $scope.newEmpId,
            name: $scope.newName,
            Email: $scope.newEmail
        });
        $scope.resetAll();
    }

    $scope.search = function () {
        $scope.filteredList = filteredListService.searched($scope.allItems, $scope.searchText);

        if ($scope.searchText == '') {
            $scope.filteredList = $scope.allItems;
        }
        $scope.pagination();
    }

    // Calculate Total Number of Pages based on Search Result
    $scope.pagination = function () {
        $scope.ItemsByPage = filteredListService.paged($scope.filteredList, $scope.pageSize);
    };

    $scope.setPage = function () {
        $scope.currentPage = this.n;
    };

    $scope.firstPage = function () {
        $scope.currentPage = 0;
    };

    $scope.lastPage = function () {
        $scope.currentPage = $scope.ItemsByPage.length - 1;
    };

    $scope.range = function (input, total) {
        var ret = [];
        if (!total) {
            total = input;
            input = 0;
        }
        for (var i = input; i < total; i++) {
            if (i != 0 && i != total - 1) {
                ret.push(i);
            }
        }
        return ret;
    };

    $scope.sort = function (sortBy) {
        $scope.resetAll();

        $scope.columnToOrder = sortBy;

        //$Filter - Standard Service
        $scope.filteredList = $filter('orderBy')($scope.filteredList, $scope.columnToOrder, $scope.reverse);

        if ($scope.reverse) iconName = 'glyphicon glyphicon-chevron-up';
        else iconName = 'glyphicon glyphicon-chevron-down';

        if (sortBy === 'EmpId') {
            $scope.Header[0] = iconName;
        } else if (sortBy === 'name') {
            $scope.Header[1] = iconName;
        } else {
            $scope.Header[2] = iconName;
        }

        $scope.reverse = !$scope.reverse;

        $scope.pagination();
    };

    //By Default sort ny Name
    $scope.sort('name');

});

function searchUtil(item, toSearch) {
    /* Search Text in all 3 fields */
    return (item.name.toLowerCase().indexOf(toSearch.toLowerCase()) > -1 || item.Email.toLowerCase().indexOf(toSearch.toLowerCase()) > -1 || item.EmpId == toSearch) ? true : false;
}

/*Get Dummy Data for Example*/
function getDummyData() {
    return [{
        EmpId: 2,
        name: 'Jitendra',
        Email: 'jz@gmail.com'
    }, {
        EmpId: 1,
        name: 'Minal',
        Email: 'amz@gmail.com'
    }, {
        EmpId: 3,
        name: 'Rudra',
        Email: 'ruz@gmail.com'
    }, {
        EmpId: 21,
        name: 'Jitendra1',
        Email: 'jz@gmail.com'
    }, {
        EmpId: 11,
        name: 'Minal1',
        Email: 'amz@gmail.com'
    }, {
        EmpId: 31,
        name: 'Rudra1',
        Email: 'ruz@gmail.com'
    }, {
        EmpId: 22,
        name: 'Jitendra2',
        Email: 'jz@gmail.com'
    }, {
        EmpId: 12,
        name: 'Minal2',
        Email: 'amz@gmail.com'
    }, {
        EmpId: 32,
        name: 'Rudra2',
        Email: 'ruz@gmail.com'
    }, {
        EmpId: 23,
        name: 'Jitendra3',
        Email: 'jz@gmail.com'
    }, {
        EmpId: 13,
        name: 'Minal3',
        Email: 'amz@gmail.com'
    }, {
        EmpId: 33,
        name: 'Rudra3',
        Email: 'ruz@gmail.com'
    }];
}

    
    </script>