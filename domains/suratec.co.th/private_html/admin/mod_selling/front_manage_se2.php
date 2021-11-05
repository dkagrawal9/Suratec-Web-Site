<?php
require_once '../library/connect.php';
require_once '../library/functions.php';
//require_once 'Database.php';
checkAdminUser($objConnect);
// mysqli_set_charset($objConnect, "utf8");






?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title><?=TITLE?></title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.7 -->
    <link rel="stylesheet" href="../bower_components/bootstrap/dist/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="../bower_components/font-awesome/css/font-awesome.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="../bower_components/Ionicons/css/ionicons.min.css">
    <!-- iCheck for checkboxes and radio inputs -->
    <link rel="stylesheet" href="../plugins/iCheck/all.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="../dist/css/AdminLTE.min.css">
    <!-- AdminLTE Skins. Choose a skin from the css/skins
         folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="../dist/css/skins/_all-skins.min.css">
    <!-- Pace style -->
    <link rel="stylesheet" href="../plugins/pace/pace.min.css">
    <!--sweet alert -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-sweetalert/1.0.1/sweetalert.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-sweetalert/1.0.1/sweetalert.min.css">
    <!-- Google Font -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tagsinput/0.8.0/bootstrap-tagsinput.css" crossorigin="anonymous">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">

    <!-- <link rel="stylesheet" href="https://cdn.datatables.net/1.10.18/css/dataTables.bootstrap.min.css"> -->
    
    
    <link href="../plugins/sweetalert2/dist/sweetalert2.min.css" rel="stylesheet">

    <link rel="stylesheet" href="../bower_components/select2/dist/css/select2.min.css">
    <link rel="stylesheet" href="../dist/css/alt/AdminLTE-select2.css">

    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.5.6/css/buttons.dataTables.min.css">
    

    <style type="text/css">
        .header-attribute td{
            padding: 3px;
            border:1px solid #ddd;
        }
        .header-attribute th{
            padding: 8px;
            /*border:1px solid white;*/
            /*background-color: #ddd;*/
            background:#fcfcfc;
        }
        .control-label{
            padding-top: 7px;
            text-align: right;
            padding-right: 0px;
        }
        .normal-product{
            margin-bottom: 13px;
        }
        /*    .table-attribute th,td{
              padding: 5px;
            }*/
        .overlay-allpage{
            position: fixed;
            width: 100%;
            height: 100%;
            top:0;
            left:0;
            background-color: rgba(0,0,0,0.7);
            cursor: pointer;
            z-index: 999999;
        }
        /* transition: 0.5s;
       }*/
        .hidden-xy{
            overflow: hidden;
        }
        .overlay-allpage>.fa{
            position: absolute;
            color: white;
            top:50%;
            left:50%;
            font-size: 60px;
            margin-top: -35px;
            margin-left: -35px;
            z-index: 999999;
        }
        .text-image .fa{
            font-size: 40px;
        }
        /*table tr,td{
          vertical-align: top;
          height: 50px;
          border-bottom:1px solid #efefef;
        }*/
        .form-group{
            margin-bottom: 5px;
        }
        .btn-default.active{
            border:none;
        }
        /*  .btn-default:hover{
            border:none;
          }*/
        .btn-primary.active{
            border:none;
        }
        /*    .btn-primary:hover{
              border:none;
            }*/
        .btn-success{
            background-color: #5cb85c;
            border: none;
        }
        .btn-warning{
            border:none;
        }
        .style{
            background-color: #e6e6e6;
            border:1px solid #b5b5b5;
            transition: 0.4s;
        }
        .style:hover{
            background-color: #f7f7f7;
            border:1px solid #b5b5b5;
            /*color: white;*/
        }
        .style:focus{
            color: white;
        }
        .check-active-ready{
            background-color:#4cad40 !important;
            border-color:#4cad40 !important;
            color:white !important;
        }
        .check-active-ready:hover{
            background-color: white !important;
            border-color: #4cad40 !important;
            color: #4cad40 !important;
        }
        .check-active-soon{
            background-color:#FDA323 !important;
            border-color:#FDA323 !important;
            color:white !important;
        }
        .check-active-soon:hover{
            background-color: white !important;
            border-color: #FDA323 !important;
            color: #FDA323 !important;
        }
        .check-active-out{
            background-color:#FD6F3B !important;
            border-color:#FD6F3B !important;
            color:white !important;
        }
        .check-active-out:hover{
            background-color: white !important;
            border-color: #FD6F3B !important;
            color: #FD6F3B !important;
        }
        .check-active-des{
            background-color:#EFA694 !important;
            border-color: #EFA694 !important;
            color:white !important;
        }
        .check-active-des:hover{
            background-color: white !important;
            border-color:#EFA694 !important;
            color: #EFA694 !important;
        }
        .sweet-alert .sa-icon{
            margin-bottom: 35px;
        }
        .sps{
            border:1px solid;
            border-color: #ddd;
            border-radius: 4px;
            width: 100%;
            max-height: 100%;
            padding-top: 10px;
            padding-bottom: 10px;
            cursor: pointer;
            transition: 0.4s
        }
        .sps:hover{
            border:1px solid #399bf2;
            box-shadow:0px 0px 5px 0px #16B1F0;
        }
        .check_suit{
            display: none;
        }
        .active_ssp{
            border-color: #399bf2 !important;
            color: #399bf2 !important;
            box-shadow:0px 0px 5px 0px #16B1F0;
        }
        /* width */
        .text-cat::-webkit-scrollbar {
            width: 5px;
        }

        /* Track */
        .text-cat::-webkit-scrollbar-track {
            border-radius: 10px;
            background: #f1f1f1;
        }

        /* Handle */
        .text-cat::-webkit-scrollbar-thumb {
            border-radius: 10px;
            background: #888;
        }

        /* Handle on hover */
        .text-cat::-webkit-scrollbar-thumb:hover {
            background: #555;
        }
        .bg-option{
            background-color: #ddd;
            color:white;
        }
        .bg-option1{
            background-color: grey;
            color:white;
        }
        .bootstrap-tagsinput{
            border:none;
            box-shadow: none;
        }
        .drop_area{
            transition: 0.4s;
        }
        .remove-item{
            transition: 0.4s;
            background-color: #fff4f4 !important;
        }
        .bootstrap-tagsinput{
            background-color: transparent;
        }
        tr:hover{
            background-color: #fcfcfc;
        }
        .attr_change{
            margin-top: 10px;
        }
        .overlay{
            position: absolute;
            width: 100%;
            height: 100%;
            top:0;
            left:0;
            background-color: rgba(255,255,255,0.7);
            cursor: pointer;
            z-index: 40;
        }
        .tag span{
            display: none;
        }
        .bootstrap-tagsinput input{
            display: none;
        }
        .border_check{
            border-color: orange;
        }
        .bootstrap-select button{
            background-color: white;
        }
        .dropdown-menu{
            z-index: 1030;
        }
        #share{
            opacity: 0.5;
            transform: rotate(90deg);
        }

        .nav-tabs-custom-edit>.nav-tabs>li.active{
            border-top-color: #f39c12 !important;
        }

        .nav-tabs-custom-add>.nav-tabs>li.active{
            border-top-color: #00c0ef !important;
        }
        .box-box-fa{
            cursor: pointer;
            text-align: center;
            margin-top: 10px;
            margin-left: 15px;
            color: #ddd;
            width: 130px;
            font-size: 86px;
            border:1px #ddd solid;
            border-radius: 4px;
        }
        .content-choice{
            padding: 5px 15px 5px 15px;
        }
        .group-btn-custom{
            margin-top: 10px;
        }
        .active_link{
            background-color: #5cb85c;
            border-color: #5cb85c;
            color: white;
        }
        .btn-default:hover, .btn-default:active, .btn-default.hover{
            background: none !important;
        }

        .callout-primary{
            background-color: #3c8dbc;
            color: white;
            border-color: #367fa9;
            border-radius: 0;
        }
        .font{
            margin-bottom: 0 !important;
        }
        .callout-warning-new{
            background-color: #e08e0b;
            color: white;
            border-color: #c97d00;
            border-radius: 0;
        }
        textarea {
            resize: vertical;
        }


        .btn-file {
    position: relative;
    overflow: hidden;
}
.btn-file input[type=file] {
    position: absolute;
    top: 0;
    right: 0;
    min-width: 100%;
    min-height: 100%;
    font-size: 100px;
    text-align: right;
    filter: alpha(opacity=0);
    opacity: 0;
    outline: none;
    background: white;
    cursor: inherit;
    display: block;
}

#img-upload{
    width: 50%;
    height: 50%;
}

#edit-img-upload{
    width: 50%;
    height: 50%;
}




button.dt-button, div.dt-button, a.dt-button {
    background-color: #008d4c !important;
}




    </style>
</head>

<body class="hold-transition skin-blue sidebar-mini fixed" onload="startTime()">
<div class="wrapper">
    <?php require_once '../template/nav_menu.php';

    ?>
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
            จัดการใบขาย แบบเก็บเงินปลายทาง
            </h1>
          
            <ol class="breadcrumb">
                <li><a href="../../index.php"></i> แดชบอร์ด</a></li>
                <li class="active">จัดการใบขาย แบบเก็บเงินปลายทาง</li>
            </ol>
        </section>
        <!-- Main content -->
        <section class="content">
            <!-- SELECT2 EXAMPLE -->
            <div class="row">
            

                <div class="col-lg-12 col-md-12 col-sm-12">
                    <!-- Start box warning for ADD system -->
                    <div class="box box-primary callout-primary-box">
                        <div class="box-header with-border">
                            <h3 class="box-title">รายการ</h3>

                            <div class="box-tools pull-right">
                                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i></button>
                            </div>

                        </div>
                        <div class="box-body" >
                            <div class="box-body">




                            <div class="row">
                                        <div class="input-daterange">
                                            <div class="col-md-2">
                                                <input type="text" id="min" name="min" class="form-control datepicker" />
                                            </div>
                                            <div class="col-md-2">
                                                <input type="text" id="max" name="max" class="form-control datepicker" />
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <input type="button" name="search" id="search" value="Search"
                                                class="btn btn-info" />
                                        </div>
                                    </div>

     

     <div class="col-md-6">

     <!-- <div class="row"> -->
         <!-- <div class="col-md-6">
         <div class="form-group">
        <select  class="form-control" name="" id="">
          <option>POS</option>
          <option>POS</option>
          <option>POS</option>
        </select>
      </div>
    </div> -->
    <!-- <div class="col-md-6">
      <input type="button" name="search" id="search_POS" value="Search" class="btn btn-info" />
     </div> -->

     <!-- </div> -->

     </div>
    </div>
<br>
                       
                                 <table class="table table-bordered" id="delivery_list" width="100%"  style="text-align:center;">

                                    <thead>
                                
                                        <tr style="text-align:center;">
                                            <th>วันที่ / เวลา</th>
                                            <th>ร้านค้า</th>
                                            <th>เลขที่บิล</th>
                                            <th>ลูกค้า</th>
                                            <th>ยอดเงิน</th>
                                            <th>สถานะ</th>
                                            <!-- <th>รายละเอียดการชำระ</th> -->
                                            <th>ยืนยันการชำระเงิน</th>
                                        </tr>
                                    </thead>

                                    <tbody>

                                    <?php                             
                                   $sql = "SELECT *, mod_order.id_order as id_order ,mod_order_slip.id_order as id_order_slip FROM  mod_order  
                                    LEFT JOIN mod_order_slip on mod_order_slip.id_order = mod_order.id_order
                                    LEFT JOIN mod_erp_branch ON mod_erp_branch.id_branch = mod_order.id_branch
                                    LEFT JOIN mod_erp_branch_image ON mod_erp_branch.id_branch = mod_erp_branch_image.id_branch
                                    LEFT JOIN mod_shipping on mod_shipping.id_shipping = mod_order.id_shipping
                                    LEFT JOIN mod_customer on mod_customer.id_customer = mod_order.id_customer
                                    WHERE  mod_order.payment = 3 and mod_order.delete_datetime is null
                                    ";
                                    $query = mysqli_query($objConnect, $sql);
                                    ?>
                                    
                                    <?php while($res = mysqli_fetch_array($query)){?>
                                   
                                        <tr>
                                                <td style="background-color:#cecece;"><label><?=$res['order_datetime']?></label></td>
                                                <td><?=$res['name_branch']?></td>
                                                <td style="background-color:#cecece;"><label><?=$res['id_order']?></label></td>
                                                <td><?=$res['fname']?> <?=$res['lname']?></td>
                                                <td><?=number_format($res['priceall'], 2)?></td>
                                                <?php
                                                if($res['status'] == 'new_pending'){
                                                echo '<td style="background-color:#d73925; color:#fafafa;">   
                                                         <label>รอการชำระ</label>
                                                        </td>' ;
                                                }elseif($res['status'] == 'wait_shipping'){
                                                    echo '<td style="background-color:#00a65a; color:#fafafa;">   
                                                            <label>รอการจัดส่ง</label>
                                                            </td>' ;
                                                }elseif($res['status'] == 'complete_spending' || $res['status'] == 'complete spending'){
                                                    echo '<td style="background-color:#f39c12; color:#fafafa;">   
                                                            <label>รอการยืนยัน</label>
                                                            </td>' ;
                                                }
                                                ?>

                                                <!-- <td>
                                                <?php if($res['id_order'] == $res['id_order_slip']){  ?>
                                                <button type="button" name="view_detail" id="<?=$res['id_order']?>" class="btn btn-success  btn-block  view_detail_btn"><i class="fa fa-eye" aria-hidden="true"></i> View Detail</button>
                                                <?php }else{  ?>
                                                <button type="button" name="" id="" class="btn btn-danger  btn-block disabled"><i class="fa fa-eye-slash" aria-hidden="true"></i> Pending...</button>
                                                <?php } ?>
                                                </td> -->

                                                <td>
                                                <!-- <?php
                                                if($res['status'] == 'new_pending'){ ?>
                                                 <button type="button" name="id_order" id="<?=$res['id_order']?>" class="btn btn-danger  btn-block  " disabled><i class="fa fa-circle-o-notch" aria-hidden="true"></i> Pending...</button>
                                                <?php } ?> -->
            
                                                <?php
                                                if($res['status'] == 'complete_spending' || $res['status'] == 'complete spending' || $res['status'] == 'new_pending'){ ?>
                                                 <button type="button" name="id_order" id="<?=$res['id_order']?>" class="btn btn-warning  btn-block  confirm_btn"><i class="fa fa-check-square-o" aria-hidden="true"></i> Confirm</button>
                                                <?php } ?>

                                                <?php
                                                if($res['status'] == 'wait_shipping'){ ?>
                                                <label for="" style="color:#00a65a;"><i class="fa fa-truck" aria-hidden="true"></i> Shipping</label>
                                                <?php } ?>
                                                </td>
                                            </tr>
                                    <?php } ?>
                                        </tbody>
                              
                                </table>

                            </div>
                        </div>

                    </div>
                </div>

            </div>
        </section>

    </div>







    <div class="boxsave">
        <button type="button" class="delmulti-menu btn btn-danger" style="transition: 0.4s;" id="MultiDelete" disabled><i class="fa fa-remove"></i> ลบรายการที่เลือก <span class="num_"></span></button>

    </div>
    <div class="control-sidebar-bg"></div>
</div>



<!-- Modal View -->
<div class="modal  modal fade" id="modal_view">
  <div class="modal-dialog">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title"><div id="modal_id_order"></div></h4>
        <label for="">รายละเอียดการชำระ</label>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <style>
.product_img_st img{
    border-radius: 5px;
    max-width: 100%;
    max-height: 100%;
}
      </style>

      <!-- Modal body -->
      <div class="modal-body">
        <form action="" method="post">
        
    
        <div class="product_img_st">
        <div id="path_slip"  ></div> 
        </div>                                         

        </form>
      </div>

      <!-- Modal footer -->
      <div class="modal-footer">
      <!-- <button type="button" class="btn btn-success  add_number_parcel_btn" name="" id="">บันทึก</button> -->
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
      </div>

    </div>
  </div>
</div>




<!-- ./wrapper -->


<!-- jQuery 3 -->
<script src="https://code.jquery.com/jquery-3.3.1.js"></script>
<!-- <script src="../bower_components/jquery/dist/jquery.min.js"></script> -->
<!-- Bootstrap 3.3.7 -->
<script src="../bower_components/bootstrap/dist/js/bootstrap.min.js"></script>

<script src="../bower_components/select2/dist/js/select2.full.min.js"></script>

<!-- SlimScroll -->
<script src="../bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
<!-- FastClick -->
<script src="../bower_components/fastclick/lib/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="../dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="../dist/js/demo.js"></script>

<script src="../bower_components/inputmask/dist/jquery.inputmask.bundle.js"></script>


<!-- <script src="https://cdn.datatables.net/1.10.18/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.18/js/dataTables.bootstrap.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.2/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.bootstrap.min.js"></script> -->



<script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.6/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.6/js/buttons.flash.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.6/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.6/js/buttons.print.min.js"></script>











<link rel="stylesheet" href="js/jquery.Thailand.min.css">
<script src="js/jquery.Thailand.min.js"></script>
<script src="js/JQL.min.js"></script>
<script src="js/typeahead.bundle.js"></script>
<script src="js/zip.js"></script>

<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

<script src="../plugins/sweetalert2/dist/sweetalert2.min.js"></script>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/blueimp-file-upload/9.22.0/css/jquery.fileupload-ui.min.css" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/blueimp-file-upload/9.22.0/css/jquery.fileupload.min.css" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/blueimp-file-upload/9.22.0/js/vendor/jquery.ui.widget.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/blueimp-file-upload/9.22.0/js/jquery.iframe-transport.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/blueimp-file-upload/9.22.0/js/jquery.fileupload.min.js"></script>

<!-- <script src="https://cdn.datatables.net/plug-ins/1.10.19/filtering/row-based/range_dates.js"></script> -->


        <!-- bootstrap datepicker -->
        <script src="../bower_components/bootstrap-daterangepicker/daterangepicker.js"></script>
        <script src="../bower_components/bootstrap-datepicker-custom/js/bootstrap-datepicker-custom.js"></script>
        <script src="../bower_components/bootstrap-datepicker-custom/locales/bootstrap-datepicker.th.min.js"></script>


<script type="text/javascript">  //datatable -------------------------------------------------//

$(document).ready(function() {
    $('#delivery_list').DataTable( {
     
    } );
} );

</script>

<script>

$(document).on('click', '.confirm_btn', function(event){  
var id_order = $(this).attr("id"); 

swal.fire({
  title: 'ยืนยัน ?',
  text: "การชำระเงิน !",
  type: 'info',
  showCancelButton: true,
  confirmButtonColor: '#3085d6',
  cancelButtonColor: '#d33',
  confirmButtonText: 'ยืนยัน !'
}).then((result) => {
  if (result.value) {
    $.ajax({
    method:'POST', 
    url:'function_g.php?id_order='+id_order, 
    data:{_method:'CONFIRM_ORDER'},  
    // contentType: false,
    success: function(data) {
    if(data.status==1){
        swal.fire('สำเร็จ','ยืนยันเรียบร้อย','success').then(function(){ 
    window.location = "";
    })
    }
},
});
}
});


}); 







</script>



<script>
$(document).on('click', '.view_detail_btn', function(event){ 
    var id_order = $(this).attr("id"); 
    document.getElementById('modal_id_order').innerHTML='<label>Order : '+'<label style="color:#00a65a;">'+id_order+'</label>'+'</label>';

    $.ajax({   
            url:'function_g.php?view_id_order='+id_order, 
            method:'POST',  
            data:{_method:'VIEW_DETAIL'},  
            dataType:"json",  
                success:function(response){  
                    console.log(response.data[0]['path_slip']);
                    if(response.data[0]['path_slip'] == ""){
                        img_path ="../img/noimage.png";
                        img = "<img  src='" + img_path + "'   data-aos='flip-right' >"  
                    }else{
                        img_path ="../../uploads/slip/";
                        img = "<img  src='" + img_path + response.data[0]['path_slip'] + "'   data-aos='flip-right' >"    
                    }
                                
                
                //  $("#path_slip").val(response.data[0]['path_slip']);
                  $("#path_slip").html(img); 
                  $("#modal_view").modal('show'); 
                }, 

                   
           });  


});




function myTableReload() {
            table = $('#delivery_list').DataTable();
            table.destroy();
            table = $('#delivery_list').DataTable({
                dom: 'Bfrtip',
                buttons: [
                   // 'excel', 'pdf', 'print'
                ],
                language: {
                    url: "https://cdn.datatables.net/plug-ins/1.10.19/i18n/Thai.json"
                }
            });
        }




$(document).ready(function () {
            
            myTableReload();

            $('.datepicker').datepicker({
                format: 'yyyy-mm-dd',
                todayBtn: true,
               // language: 'th', //เปลี่ยน label ต่างของ ปฏิทิน ให้เป็น ภาษาไทย   (ต้องใช้ไฟล์ bootstrap-datepicker.th.min.js นี้ด้วย)
              //  thaiyear: true //Set เป็นปี พ.ศ.
            }).datepicker("setDate", "0"); //กำหนดเป็นวันปัจุบัน

            $(document).on('click', '#search', function () {
                var start_date = $('#min').val();
                var end_date = $('#max').val();
                if (start_date != "") {
                    table
                        .column(0).search(start_date)
                        .draw();
                }
                if (end_date != "") {
                    table
                        .column(1).search(end_date)
                        .draw();
                }
                if (start_date == "" && end_date == "") {
                    myTableReload();
                }
            });
        });


</script>


</body>
</html>
