

let app = angular.module('GroupeApp',[]);



app.controller('GroupListController',function ($scope,$http) {
    $scope.GroupData = [];

    $scope.LoadGroup = function () {
        $http.get('back/groups.php?do=2').then(function (response) {
            $scope.GroupData = response.data;
        });
    };

    $scope.LoadGroup();

    $scope.data = {};
    $scope.data.name_group = '';
    $scope.data.detail_group = '';

    $scope.Add = function () {
        $http.post('back/groups.php?do=1',$scope.data).then(function (response) {
            if(response.data.error === 0){
                $('#modalAdd3').modal('hide');
                swal('Success','Add Success.','success');
                $scope.data = {};
                $scope.data.name_group = '';
                $scope.data.detail_group = '';
            }else{
                swal('Error','Error ' + response.data.msg ,'error');
            }
        });
    };

});






