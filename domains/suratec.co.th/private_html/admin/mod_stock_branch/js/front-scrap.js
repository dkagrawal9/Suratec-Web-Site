
function getQueryVariable(variable) {
    var query = window.location.search.substring(1);
    var vars = query.split("&");
    for (var i=0;i<vars.length;i++) {
        var pair = vars[i].split("=");
        if (pair[0] === variable) {
            return pair[1];
        }
    }
}

let app = angular.module('App',['ngAnimate', 'ngSanitize','ui.bootstrap']);

app.controller('FrontController',function ($scope,$http) {
    $scope.maxSize = 5;
    $scope.bigTotalItems = 0;
    $scope.currentPage = 1;
    $scope.itemsPerPage = 30;
    $scope.numPages = 0 ;

    $scope.ProductData = [];

    $scope.CategorySelected = '';
    $scope.Categorys = [];

    $scope.data= {};


    var start = moment().subtract(90, 'days');
    var end = moment();

    $scope.data.begin = start.format('YYYY-MM-DD');
    $scope.data.end = end.format('YYYY-MM-DD');

    $scope.data.name_product = '';
    $scope.data.id_branch = getQueryVariable('id_branch');

    let daterange = $('#datetimePicker').daterangepicker({
        open:'left',
        startDate: start,
        endDate: end
    });

    $('#datetimePicker').on('apply.daterangepicker', function(ev, picker) {
        $scope.data.begin = picker.startDate.format('YYYY-MM-DD');
        $scope.data.end = picker.endDate.format('YYYY-MM-DD');
    });


    $scope.setPage = function (pageNo) {
        $scope.currentPage = pageNo;
    };

    $scope.LoadList = function () {
        $scope.ProductData = [];
        $http.post('back-get-scrap.php',$scope.data).then(function (response) {
            $scope.ProductData = response.data;
            $scope.bigTotalItems = $scope.ProductData.length;
        });
    };

    $scope.LoadCategoryList = function () {
        $http.get('back-get-category-list.php').then(function (response) {
            $scope.Categorys = response.data;
        });
    };

    $scope.LoadList();

    $scope.Search = function () {
        $scope.LoadList();
    };

    $scope.StatusShow = function (status) {
        text = '';
        switch (parseInt(status)) {
            case 1:
                text = 'สูญหาย';
                break;
            case 2:
                text = 'แตก/พัง';
                break;
            case 3:
                text = 'อื่นๆ';
                break;

        };

        return text;
    };

    $scope.ConverterDateTime = function (time) {
        moment.locale();
        return moment(time, "YYYY-MM-DD hh:mm:ss").format('LL');
    };


    $scope.AddBack = function (id,index) {
        //console.log(index);
        realIndex = index + (($scope.currentPage-1)*$scope.itemsPerPage);

        //console.log($scope.ProductData[realIndex]);
        amount = $scope.ProductData[realIndex].amount;

        swal({
            title: 'บันทึกกลับคืนสต็อก',
            text: 'ป้อนตัวเลข',
            input: 'number',
            inputValidator : function (value) {
                if (value === '') {
                    return new Promise(function (resolve){
                        resolve('กรุณาป้อนตัวเลข');
                    });
                }else if(value <= 0){
                    return new Promise(function (resolve){
                        resolve('ตัวเลขต้องมากว่า 0');
                    });
                }else if(value > parseInt(amount)){
                    return new Promise(function (resolve){
                        resolve('ตัวเลขต้องไม่มากว่า '+amount);
                    });
                }
            },
            confirmButtonText: 'บันทึก',
            showCancelButton: true
        }).then((result) => {
            if (result.value) {
                sendData = {
                    id:id,
                    amount_back: result.value
                };
                $http.post('back-add-scrap-stock.php',sendData).then(function (response) {
                    location.reload(true);
                });

            }
        });
    };



});