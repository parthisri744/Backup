<?php  
require_once('Button.php'); 
$btn  =  new Button();
Table();
function Table(){
    $obj = new stdClass();
    $obj->head = head();
    $obj->thead = thead("yes","ParthiSri","yes");
    $obj->tbody = Tbody();
    $obj->tfoot  = Tfooter();
   return $obj;
}
?>

<?php function head(){  ?>
<!DOCTYPE html>
<html ng-app="myApp">
<head>
    <title></title>
    <meta charset="utf-8" />
    <link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/angular_material/1.0.0/angular-material.min.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="https://rawgit.com/daniel-nagy/md-data-table/master/dist/md-data-table.css">
</head>
<?php  } ?>
<?php  
function thead($header="yes",$title,$globalsearch){
?>
    <md-card>
        <?php if($header=='yes'){ ?>
        <md-toolbar>  <!-- class="md-whiteframe-1dp"  -->
            <div class="md-toolbar-tools"  class="md-margin">

                <div class="md-title "><?php echo trim($title) ?></div>
                <div flex></div>  
                
                <md-button class="md-raised md-accent">Button</md-button>
                <md-button class="md-raised md-warn ">Primary</md-button>
                <md-button class="md-icon-button md-raised md-accent" ng-click="loadStuff()">
                    <md-icon>refresh</md-icon>
                </md-button>
            </div> 
        </md-toolbar>    
        <?php if($globalsearch=='yes'){  ?>
         <md-toolbar class="md-table-toolbar md-default" ng-hide="options.rowSelection && selected.length">          
                  <div layout-gt-sm="row" layout-padding>
                    <md-input-container class="md-icon-float md-block">
                      <label>Search</label>
                      <md-icon md-svg-src="img/search_black_18dp.svg" class="name"></md-icon>
                      <input ng-model="filter.search">
                    </md-input-container>
                    <div flex></div> 
                    
            </div>
        </md-toolbar>   
        <?php  }   } 
        ?>     
            



        <!-- <md-toolbar class="md-table-toolbar alternate" ng-show="options.rowSelection && selected.length">
            <div class="md-toolbar-tools">
                <span>{{selected.length}} {{selected.length > 1 ? 'items' : 'item'}} selected</span>
            </div>
        </md-toolbar> -->

    <?php function Tbody(){   ?>
        <body ng-controller="myController" layout="column" ng-init="loadData()">
        <md-table-container>
            <table md-table md-row-select="options.rowSelection" multiple="{{options.multiSelect}}" md-progress="promise">
                <thead md-head md-order="query.order" md-on-reorder="logOrder">
                    <tr md-row>
                        <th md-column>
                            <span>Select</span>
                        </th>
                        <th md-column md-order-by="{{$index +1}}">
                            <span>SI.NO</span>
                        </th>
                        <th md-column md-order-by="hpatientid">
                            <span>CompanyName</span>
                        </th>
                        <th md-column>
                            <span>ContactName</span>
                        </th>
                        <th md-column>
                            <span>ContactTitle</span>
                        </th>
                        <th md-column>
                            <span>Address</span>
                        </th>
                        <th md-column>
                            <span>City</span>
                        </th>
                        <th md-column>
                            <span>PostalCode</span>
                        </th>
                        <th md-column>
                            <span>Country</span>
                        </th>
                        <th md-column>
                            <span>Phone</span>
                        </th>
                        <th md-column>
                            <span>Fax</span>
                        </th>
                    </tr>
                </thead>
                <tbody md-body>
                    <tr md-row ng-repeat="cust in customers| filter: filter.search | orderBy: query.order | limitTo: query.limit : (query.page -1) * query.limit">
                        <td md-cell> <md-checkbox ng-model="cbox" ng-value="{{cust.ID}}" aria-label="Checkbox 1">
                          </md-checkbox></td>
                        <td md-cell>{{$index +1}}</td>
                        <td md-cell>{{cust.hpatientid}}</td>
                        <td md-cell>{{cust.patientadd}}</td>
                        <td md-cell>{{cust.patientage}}</td>
                        <td md-cell>{{cust.patientgender}}</td>
                        <td md-cell>{{cust.patientid}}</td>
                        <td md-cell>{{cust.patientname}}</td>
                        <td md-cell>{{cust.patientphno}}</td>
                        <td md-cell>{{cust.submitime}}</td>
                        <td md-cell>{{cust.submitname}}</td>
                    </tr>
                </tbody>
            </table>
        </md-table-container>
       <?php  } function Tfooter(){ ?>
        <md-table-pagination md-limit="query.limit" md-limit-options="limitOptions" md-page="query.page" md-total="{{customers.length}}" md-page-select="options.pageSelect" md-boundary-links="options.boundaryLinks" md-on-paginate="logPagination"></md-table-pagination>
        <?php   } ?>
    </md-card>

    <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.4.8/angular.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.4.8/angular-animate.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.4.8/angular-aria.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/angular_material/1.0.0/angular-material.min.js"></script>
    <script src="https://rawgit.com/daniel-nagy/md-data-table/master/dist/md-data-table.js"></script>
</body>
</html>


<?php   }   ?>





























<script>

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
            console.log(response.Customers);
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
</script>