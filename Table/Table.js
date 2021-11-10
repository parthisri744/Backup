'use strict'

var app = angular.module('myApp', ['ngMaterial', 'md.data.table'])

.config(['$mdThemingProvider', function ($mdThemingProvider) {
    'use strict';

    $mdThemingProvider.theme('primary')
      .primaryPalette('blue');
}])

.controller('myController', ['$mdEditDialog', '$q', '$scope', '$timeout', '$http', '$interval', function ($mdEditDialog, $q, $scope, $timeout, $http, $interval) {
    $scope.selected = [];
    $scope.limitOptions = [5, 10, 15];

    $scope.customers = [];

    $scope.options = {
        rowSelection: true,
        multiSelect: true,
        autoSelect: true,
        decapitate: false,
        largeEditDialog: false,
        boundaryLinks: false,
        limitSelect: true,
        pageSelect: true
    };

    $scope.query = {
        order: 'Id',
        limit: 5,
        page: 1
    };


    $scope.loadData = function () {       

    $http.get('customers.php').success(function (response) {
        //debugger;
        $scope.customers = response;
    }).error(function (error) {
        alert(JSON.stringify(error));
    })
    }

    $interval(function () {
    $scope.promise = $timeout(function () {
        $http.get('customers.php').success(function (response) {
            //debugger;
            $scope.customers = response;
        }).error(function (error) {
            alert(JSON.stringify(error));
        })
    }, 2000);      
    }, 10000);

    $scope.toggleLimitOptions = function () {
        $scope.limitOptions = $scope.limitOptions ? undefined : [5, 10, 15];
    };

  
    $scope.loadStuff = function () {
        $scope.promise = $timeout(function () {
            // loading
        }, 2000);
    }

    $scope.logItem = function (item) {
        console.log(item.name, 'was selected');
    };

    $scope.logOrder = function (order) {
        console.log('order: ', order);
    };

    $scope.logPagination = function (page, limit) {
        console.log('page: ', page);
        console.log('limit: ', limit);
    }
}])