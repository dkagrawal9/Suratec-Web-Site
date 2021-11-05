var app = angular.module('NewCustomer',['ngAnimate' ,'ngSanitize','ui.bootstrap']);

app.controller('AddUserFormController',function ($scope,$http) {
    $scope.data = {};

    $scope.Continent = [];

    $scope.Country = [];

    $scope.Sub = [];

    $http.get('../mod_countries/api/1').then(function (response) {
        $scope.Continent = response.data;
    });

    $scope.LoadCountry = function (id) {
        $http.get('../mod_countries/api/2/'+id).then(function (response) {
            $scope.Country = response.data;
        });
    };

    $scope.LoadSub = function (id) {
        $http.get('../mod_countries/api/3/'+id).then(function (response) {
            $scope.Sub = response.data;
        });
    };
});