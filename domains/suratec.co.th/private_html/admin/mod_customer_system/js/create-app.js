var app = angular.module('CreateApp',[]);

app.controller('CreateDetail',['$scope','$http', function ($scope , $http) {
    $scope.pr = [];

    $scope.userData = [];

    $scope.PRSelectItem = [];

    $scope.Supplier = [];

    $scope.TmpItemList = [];

    $scope.SupplierSelected = 0;

    $scope.ItemSelected = 0;

    $scope.TmpItem = [];

    $scope.pr.detail = '';

    $scope.LoadUserDetail = function () {
        $http.get('backend.php?call=3').then(function (response) {
            $scope.pr.name = response.data.username + ' ' + response.data.surname;
            $scope.pr.branch = response.data.name_branch;
            $scope.pr.date = moment().format('LLL');
            $scope.pr.user_id  = response.data.id_member;
            $scope.pr.id_branch = response.data.id_branch;

            $scope.userData = response.data;
        });
    };

    $scope.ClickAddNew = function () {
        $http.get('backend.php?call=1').then(function (response) {
            $scope.Supplier = response.data.data;
            console.log($scope.Supplier);
            $('#show-supplier-modal').modal();
        });
    };

    $scope.ClickSelectSupplier = function (index) {
        $scope.SupplierSelected = $scope.Supplier[index].supplier;
        $scope.TmpItemList = $scope.Supplier[index];
        $('#show-supplier-modal').modal('hide');
        $('#show-supplier-item-modal').modal();
    };

    $scope.ClickSelectSupplierItem = function (index) {

        $scope.ItemSelected = $scope.TmpItemList.supplier_item[index];

        if($scope.PRSelectItem.length >= 1){
            dup = $scope.FindIndex($scope.PRSelectItem , $scope.ItemSelected.id );
            //console.log(dup);
            if(dup !== -1){
                $scope.PRSelectItem[dup].amount += 1;
                $('#show-supplier-item-modal').modal('hide');

                return;
            }
        }

        //console.log($scope.ItemSelected);

        $scope.TmpItem = {};

        $scope.TmpItem.product_name = $scope.ItemSelected.name_product;
        $scope.TmpItem.option_name = $scope.ItemSelected.option_name;
        $scope.TmpItem.amount = 1;
        $scope.TmpItem.price = $scope.ItemSelected.price;
        $scope.TmpItem.id_supplier_item = $scope.ItemSelected.id;

        $scope.PRSelectItem.push($scope.TmpItem);


        $('#show-supplier-item-modal').modal('hide');


    };

    $scope.RemoveSelectItem = function (index) {
        $scope.PRSelectItem.splice(index,1);

    };

    $scope.FindIndex = function(array , key) {
        for(i=0 ; i < array.length ; i++){
            if(array[i].id_supplier_item === key){
                return i;
            }
        }

        return -1;
    };



    $scope.PRSaveButton = function () {
        if($scope.PRSelectItem.length !== 0){

        }else{
            swal('ผิดผลาด' ,'กรุณาเพิ่มรายการ' , 'error');
            return;
        }
        $scope.items = {};


        console.log($scope.items);

        $scope.datasend = {
            id_branch:$scope.pr.id_branch,
            id_member:$scope.pr.user_id,
            detail:$scope.pr.detail,
            items:$scope.PRSelectItem
        };





        // $scope.datasend.id_branch = $scope.pr.id_branch;
        // $scope.datasend.id_member = $scope.pr.user_id ;
        //$scope.datasend.items = $scope.PRSelectItem;

        $http.post('backend.php?call=5' , $scope.datasend).then(function (response) {
            location.href = 'front-manage.php';
        });

    };

    $scope.CheckNoDecimal = function (index) {
        if(parseInt($scope.PRSelectItem[index].amount) !== $scope.PRSelectItem[index].amount || $scope.PRSelectItem[index].amount  > 9999){
            $scope.PRSelectItem[index].amount = 1;
        }

    };




}]);





