let app = angular.module('AppFrontAdd',['ngAnimate', 'ngSanitize','ui.bootstrap']);

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


app.controller('FrontController',function ($scope,$http) {
    $scope.maxSize = 20;
    $scope.bigTotalItems = 0;
    $scope.bigCurrentPage = 1;
    $scope.itemsPerPage = 20;
    $scope.numPages = 0;

    $scope.ProductData = [];
    $scope.TmpProductData = [];
    $scope.TempProductAttr = [];

    $scope.ProductIdSelected = '';
    $scope.AttributeIdSelected = '';

    $scope.BranchId = getQueryVariable('id_branch');

    $http.get('back-get-all-item.php?id_branch='+$scope.BranchId).then(function (response) {
        $scope.ProductData = response.data;
        $scope.bigTotalItems = $scope.ProductData.length;
        console.log($scope.ProductData);
    });

    $scope.ProductTableSelect = function (id, item) {
        $('#modal-attr-select').modal();
        $scope.TempProductAttr = item.attr;
        $scope.ProductIdSelected = id;
        $scope.selectProduct = item.product;
        // console.log($scope.TempProductAttr);
    };

    $scope.AttributeSelected = function (id) {
        $scope.AttributeIdSelected = id;

        swal.mixin({
            input: 'number',
            confirmButtonText: 'ถัดไป &rarr;',
            cancelButtonText: 'ยกเลิก',
            showCancelButton: true,
            progressSteps: ['ต่ำสุด', 'สูงสุด']
        }).queue([
            {
                title: 'จำนวนในสต็อกต่ำสุด'
            },
            {
                title: 'จำนวนในสต็อกสูงสุด'
            }
        ]).then((result) => {
            if (result.value) {
                $scope.Save(result.value,id);
            }
        });
    };

    $scope.Save = (value,id) => {
        sendData = {
            id_branch: $scope.BranchId,
            id_product: $scope.ProductIdSelected,
            id_attr: id,
            min: value[0]===''? 0:parseInt(value[0]),
            max: value[1]===''? 0:parseInt(value[1])
        };
        if(parseInt(value[0]) <= parseInt(value[1])){
            $http.post('back-add-product-to-branch.php',sendData).then(function (response) {
                const swalWithBootstrapButtons = swal.mixin({
                    confirmButtonClass: 'btn btn-success',
                    cancelButtonClass: 'btn btn-info ',
                    buttonsStyling: true,
                });

                if(response.data.error === 0){
                    swalWithBootstrapButtons({
                        title: 'สำเร็จ',
                        text: "ต้องการเพิ่มสินรายต่อหรือไม่",
                        type: 'success',
                        showCancelButton: true,
                        confirmButtonText: 'ไปหน้าจัดการ',
                        cancelButtonText: 'อยู่ต่อ',
                        reverseButtons: true
                    }).then((result) => {
                        if (result.value) {
                            location.href = 'front-product-list.php?id_branch=' + $scope.BranchId;
                        } else if (result.dismiss === swal.DismissReason.cancel) {
                            location.reload(true);
                        }
                    });
                }else{
                    swal('ผิดพลาด','กรุณาลองใหม่อีกครั้ง','error');
                }

            });
        }else{
            swal('ผิดพลาด','ค่าต่ำสุดต้องมากว่าสูงสุด','error');
        }

    };

    //clear data on modal dismiss
    $('#modal-attr-select').on('hidden.bs.modal', function () {
        $scope.TempProductAttr = [];
        $scope.ProductIdSelected = '';
        $scope.AttributeIdSelected = '';
    });


});


