
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

app.controller('AppController',function ($scope,$http) {
    $scope.maxSize = 5;
    $scope.bigTotalItems = 0;
    $scope.currentPage = 1;
    $scope.itemsPerPage = 30;
    $scope.numPages = 0 ;

    $scope.ProductData = [];

    $scope.CategorySelected = '';
    $scope.Categorys = [];


    $scope.setPage = function (pageNo) {
        $scope.currentPage = pageNo;
    };

    $scope.LoadList = function () {
        $scope.ProductData = [];
        $http.get('back-get-branch-all-product.php?id_branch=' + getQueryVariable('id_branch') + '&cat_id=' + $scope.CategorySelected ).then(function (response) {
            $scope.ProductData = response.data;
            $scope.bigTotalItems = $scope.ProductData.length;
        });
    };

    $scope.LoadCategoryList = function () {
        $http.get('back-get-category-list.php').then(function (response) {
            $scope.Categorys = response.data;
        });
    };

    $scope.LoadCategoryList();
    $scope.LoadList();

    $scope.ClickAddNew = function(){
        location.href = 'front-add.php?id_branch=' + getQueryVariable('id_branch') ;
    };

    /**
     * @return {number}
     */
    $scope.FindIndex = function(array , key) {
        for(i=0 ; i < array.length ; i++){
            if(array[i].id === key){
                return i;
            }
        }

        return -1;
    };

    $scope.ClickEdit = function (id, index) {
        swal.mixin({
            input: 'number',
            confirmButtonText: 'Next &rarr;',
            showCancelButton: true,
            progressSteps: ['1', '2']
        }).queue([
            {
                title: 'ต่ำสุด',
                inputValue: $scope.ProductData[$scope.FindIndex($scope.ProductData,id)].min
            },
            {
                title: 'สูงสุด',
                inputValue: $scope.ProductData[$scope.FindIndex($scope.ProductData,id)].max
            }
        ]).then((result) => {
            if (result.value) {
                $scope.Save(result.value,id);
            }
        });
    };

    $scope.ClickStock = function (id,bid){
        location.href = 'front-stock-add.php?id_branch='+bid+'&pid='+id;
    };

    $scope.Save = function (value,id) {
        let sendData = {
            id: id,
            min: value[0]===''? 0:parseInt(value[0]),
            max: value[1]===''? 0:parseInt(value[1])
        };
        if(parseInt(value[0]) <= parseInt(value[1])){
            $http.post('back-edit-stock.php',sendData).then(function (response) {
                     if(response.data.error === 0){
                    swal('สำเร็ข','บันทึกเรียบร้อยแล้ว','success').then(function () {
                        $scope.LoadList();
                    });
                }else{
                    swal('ผิดพลาด','กรุณาลองใหม่อีกครั้ง','error');
                }

            });
        }else{
            swal('ผิดพลาด','ค่าต่ำสุดต้องมากว่าสูงสุด','error');
        }

    };

    $scope.ScrapAdd = function (id,index) {
        let show = swal.mixin({
            input: 'text',
            confirmButtonText: 'Next &rarr;',
            showCancelButton: true,
            progressSteps: ['1', '2' , '3']
        }).queue([
            {
                title: 'สาเหตุ',
                input: 'select',
                inputOptions: {
                    '1': 'สูญหาย',
                    '2': 'แตก/หัก/พัง/เสียหาย',
                    '3': 'อื่นๆ'
                },
                inputPlaceholder: 'เลือกสาเหตุ',
                inputValidator: function (value) {
                    if (value === '') {
                        return new Promise(function (resolve){
                            resolve('กรุณาเลือกสาเหตุ');
                        });
                    }
                }
            },
            {
                title: 'จำนวน',
                input: 'number',
                inputValue: 0,
                inputValidator: function (value) {
                    if (value === '') {
                        return new Promise(function (resolve){
                            resolve('กรอกตัวเลข');
                        });
                    }else if(value <= 0){
                        return new Promise(function (resolve){
                            resolve('ตัวเลขต้องมากกว่า 0');
                        });
                    }
                }
            },
            {
                title: 'หมายเหตุ',
                input: 'textarea',
                inputPlaceholder: '*หมายเหตุ',
                inputValidator: function (value) {
                    if (value === '') {
                        return new Promise(function (resolve){
                            resolve('กรุณาใส่หมายเหตุ');
                        });
                    }
                }

            }
        ]).then((result) => {
            if (result.value) {
                sendData = {
                    id_product_stock_branch:id,
                    amount: result.value[1],
                    remark: result.value[2],
                    status: result.value[0]
                };
                $http.post('back-add-scrap.php' , sendData).then(function (response) {
                    if(response.data.error === 0){
                        console.log(response);
                        $scope.LoadList();
                    }else{
                        swal('error','error','error');
                    }

                });
            }
        });
    };

    $scope.ScrapManage = function () {
        location.href = 'front-scrap.php?id_branch='+getQueryVariable('id_branch');
    };


});