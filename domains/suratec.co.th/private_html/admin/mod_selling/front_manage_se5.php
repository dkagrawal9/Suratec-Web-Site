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
            ????????????????????????????????? ??????????????????????????????
            </h1>
          
            <ol class="breadcrumb">
                <li><a href="../../index.php"></i> ????????????????????????</a></li>
                <li class="active">????????????????????????????????? ??????????????????????????????</li>
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
                            <h3 class="box-title">??????????????????</h3>

                            <div class="box-tools pull-right">
                                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i></button>
                            </div>

                        </div>
                        <div class="box-body" >
                            <div class="box-body">




    <div class="row">
     <div class="input-daterange">
      <div class="col-md-2">
       <input type="text"  id="min" name="min" class="form-control  min_date" />
      </div>
      <div class="col-md-2">
       <input type="text" id="max" name="max" class="form-control  max_date" />
      </div>      
     </div>
     <div class="col-md-2">
      <input type="button" name="search" id="search" value="Search" class="btn btn-info" />
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
                       
                                <table class="table table-bordered" id="order_list" width="100%"  style = "text-align:center">
                                    <thead>
                                
                                        <tr>
                                            <th>??????????????????</th>
                                            <th>????????????</th>
                                            <th>???????????????????????????</th>
                                            <th>??????????????????</th>
                                            <th>?????????????????????</th>
                                            <th>???????????????</th>
                                            <th>???????????????????????????????????????????????????</th>
                                            <th>???????????????????????????????????????????????????</th>
                                        </tr>
                                    </thead>

                                    <tbody>

                                    <?php                             
                                    $sql = "SELECT * FROM  mod_order  
                                     LEFT JOIN mod_customer on mod_customer.id_customer = mod_order.id_customer
                                     WHERE  mod_order.payment = 1 
                                    -- and  delete_datetime is null
                                    ";
                                    $query = mysqli_query($objConnect, $sql);
                                    ?>
                                    
                                    <?php while($res = mysqli_fetch_array($query)){?>
                                   
                                            <tr>
                                                <td><?=$res['order_datetime']?></td>
                                                <td><?=$res['']?></td>
                                                <td><?=$res['id_order']?></td>
                                                <td><?=$res['fname']?> <?=$res['lname']?></td>
                                                <td><?=$res['priceall']?></td>
                                                <td>
                                                <?php
                                                if($res['status'] == 'new_panding'){
                                                echo "???????????????????????????";
                                                }elseif($res['status'] == 'wait_shipping'){
                                                echo "????????????????????????";
                                                }elseif($res['status'] == 'complete_spending'){
                                                echo "????????????????????????";
                                                }
                                                ?>
                                                </td>
                                                <td>Pending Data.//GG</td>
                                                <td>
                                                <button type="button" name="" id="<?=$res['id_order']?>" class="btn btn-primary  confirm_btn" btn-lg btn-block">??????????????????</button>
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
        <button type="button" class="delmulti-menu btn btn-danger" style="transition: 0.4s;" id="MultiDelete" disabled><i class="fa fa-remove"></i> ???????????????????????????????????????????????? <span class="num_"></span></button>

    </div>
    <div class="control-sidebar-bg"></div>
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
    $('#order_list').DataTable( {
     
    } );
} );



// $(document).ready(function () {
//        $.fn.dataTable.ext.search.push(
//           function (settings, data, dataIndex) {
//         var min = $('#min').datepicker("getDate");
//         var max = $('#max').datepicker("getDate");
//         var startDate = new Date(data[4]);
//         if (min == null && max == null) { return true; }
//         if (min == null && startDate <= max) { return true;}
//         if(max == null && startDate >= min) {return true;}
//         if (startDate <= max && startDate >= min) { return true; }
//         return false;
//     }
//     );


//         $("#min").datepicker({ onSelect: function () { table.draw(); }, changeMonth: true, changeYear: true });
//         $("#max").datepicker({ onSelect: function () { table.draw(); }, changeMonth: true, changeYear: true });
//         var table = $('#list-drawer').DataTable();

//         // Event listener to the two range filtering inputs to redraw on input
//         $('#min, #max').change(function () {
//             table.draw();
//         });
//     });




// $(document).ready(function () {
//                 $('.min_date').datepicker({
//                     format: 'yyyy-mm-dd',
//                     todayBtn: true,
//                     language: 'th', //????????????????????? label ????????????????????? ?????????????????? ????????????????????? ?????????????????????   (????????????????????????????????? bootstrap-datepicker.th.min.js ?????????????????????)
//                     thaiyear: true //Set ?????????????????? ???.???.
//                 }).datepicker("setDate", "0"); //?????????????????????????????????????????????????????????

//                 $('.max_date').datepicker({
//                     format: 'yyyy-mm-dd',
//                     todayBtn: true,
//                     language: 'th', //????????????????????? label ????????????????????? ?????????????????? ????????????????????? ?????????????????????   (????????????????????????????????? bootstrap-datepicker.th.min.js ?????????????????????)
//                     thaiyear: true //Set ?????????????????? ???.???.
//                 }).datepicker("setDate", "0"); //?????????????????????????????????????????????????????????

//             });


</script>

<script>
  $('#list-drawer tbody').on('click', '.confirm_btn', function () {
                swal({
                    title: '???????????????????',
                    text: "?????????????????????????????????????????????????????????????????????????????? ?",
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: '??????????????????!',
                    showLoaderOnConfirm: true
                }).then((result) => {
                    if (result.value) {
                        var data = table.row($(this).parents('tr')).data();
                         console.log(data.id_item);
                        var index = data.id_item;
                         console.log(items);

                        // remove data
                        items.splice(index, 1);
                        // console.log(items);

                        reload_datatable()
                    }
                })
            });
</script>


</body>
</html>
