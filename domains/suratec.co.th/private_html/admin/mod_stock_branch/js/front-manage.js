let app = angular.module('App',['ngAnimate', 'ngSanitize','ui.bootstrap']);

function getQueryVariable(variable) {
    var query = window.location.search.substring(1);
    var vars = query.split("&");
    for (var i=0;i<vars.length;i++) {
        var pair = vars[i].split("=");
        if (pair[0] === variable) {
            return pair[1];
        }
    }
    return '';
}

app.controller('AppController',function ($scope,$http) {

    $scope.maxSize = 5;
    $scope.bigTotalItems = 0;
    $scope.bigCurrentPage = 1;
    $scope.itemsPerPage = 20;
    $scope.numPages = 0 ;
    $scope.currentPage = 1;
    $scope.BranchData = [];

    $http.get('back-branch.php').then(function (response) {
        $scope.BranchData = response.data;
        $scope.bigTotalItems = $scope.BranchData.length;
        console.log($scope.BranchData);
    });


    $scope.setPage = function (pageNo) {
        $scope.currentPage = pageNo;
    };

    $scope.pageChanged = function() {
        $log.log('Page changed to: ' + $scope.currentPage);
    };

    $scope.OpenList = function (id_branch) {
        console.log(id_branch);
        location.href = 'front-product-list.php?id_branch=' + id_branch;
    };


});


