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


    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    

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
            จัดการส่งสินค้า
            </h1>
          
            <ol class="breadcrumb">
                <li><a href="../page_home/index.php"></i> Dashboard</a></li>
                <li class="active">จัดการส่งสินค้า</li>
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
                            <h3 class="box-title">รายการจัดส่งสินค้า</h3>

                            <div class="box-tools pull-right">
                                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i></button>
                            </div>

                        </div>
                        <div class="box-body" >
                            <div class="box-body">




    <div class="row">
     <div class="input-daterange">
      <div class="col-md-2">
       <input type="text"  id="min" name="min" class="form-control  datepicker" />
      </div>
      <div class="col-md-2">
       <input type="text" id="max" name="max" class="form-control  datepicker" />
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
                       
                               
<table class="table table-bordered" id="history_list" width="100%"  style="text-align:center;" >
                                    <thead >
                                
                                        <tr  style="text-align:center;">
                                            <th>วันที่ / เวลา</th>
                                            <th>ร้านค้า</th>
                                            <th>เลขที่บิล</th>
                                            <th>ลูกค้า</th>
                                            <th>ยอดเงิน</th>
                                            <th>ประเภทการชำระ</th>
                                            <th>จัดส่งโดย</th>
                                            <th>ควบคุม</th>
                                            <th width="10%">สถานะการส่งสินค้า</th>
                                        </tr>
                                    </thead>

                                    <tbody>

                                    <?php                             
                                    $sql = "SELECT * ,mod_customer.email as email_cus , mod_order.id_order as id_order ,mod_order_slip.id_order as id_order_slip FROM  mod_order 
                                    LEFT JOIN mod_order_slip on mod_order_slip.id_order = mod_order.id_order
                                    LEFT JOIN mod_erp_branch ON mod_erp_branch.id_branch = mod_order.id_branch
                                    LEFT JOIN mod_erp_branch_image ON mod_erp_branch.id_branch = mod_erp_branch_image.id_branch
                                    LEFT JOIN mod_shipping on mod_shipping.id_shipping = mod_order.id_shipping 
                                    LEFT JOIN mod_customer on mod_customer.id_customer = mod_order.id_customer
                                    WHERE  mod_order.status = 'wait_shipping'  
                                   -- and  delete_datetime is null
                                   ";
                                    $query = mysqli_query($objConnect, $sql);
                                    ?>
                                    
                                    <?php while($res = mysqli_fetch_array($query)){?>
                                   
                                            <tr>
                                                <td style="background-color:#cecece;" ><label><?=$res['order_datetime']?></label></td>
                                                <td><?=$res['name_branch']?></td>
                                                <td style="background-color:#cecece;" ><label><?=$res['id_order']?></label></td>
                                                <td><?=$res['fname']?> <?=$res['lname']?></td>
                                                <td><?=number_format($res['priceall'], 2)?></td>
                                                <td style="background-color:#cecece;">
                                                <label>
                                                <?php
                                                if($res['payment'] == 1){
                                                echo "โอนเงิน";
                                                }elseif($res['payment'] == 2){
                                                echo "บัตรเครดิต";
                                                }elseif($res['payment'] == 3){
                                                echo "เก็บเงินปลายทาง";
                                                }
                                                ?>
                                                </label>
                                                </td>

                                                <?php if($res['name_shipping'] == "KERRY" || $res['name_shipping'] == "Krery" ||  $res['name_shipping'] == "krery") {  ?>
                                                <td style="background-color:#f39c12; color:#fafafa;">
                                                 <label><?=$res['name_shipping']?></label>
                                                </td>
                                                <?php }else{  ?>

                                                <td style="background-color:#d73925; color:#fafafa;">
                                                <label><?=$res['name_shipping']?></label>
                                                </td>
                                                <?php } ?>

                                                <td >
                                                <button type="button" name="" id="<?=$res['id_order']?>" class="btn btn-primary  print_head_btn" btn-lg btn-block"><i class="fa fa-print" aria-hidden="true"></i> พิมพ์ใบจ่าหน้าซอง</button>
                                                <button type="button" name="" id="<?=$res['id_order']?>" class="btn btn-warning  print_number_parcel_btn " btn-lg btn-block"><i class="fa fa-print" aria-hidden="true"></i> แจ้งหมายเลขติดตามพัสดุ</button>

                                                <?php if($res['mail_status']==0){?>

                                                <button type="button" name="id_order" id="<?=$res['id_order']?>" class="btn btn-info   email_btn"
                                                    data-id="<?=$res['email_cus']?>" 
                                                    fname_to="<?=$res['fname']?>" 
                                                    lname_to="<?=$res['lname']?>" 

                                                    tex_num="<?=$res['tracking_number']?>"
                                                    data-toggle="tooltip" title="กรุณาทำการส่ง E-Mail แจ้งรายละเอียดแก่ลูกค้า"
                                                 ><i class="fa fa-reply" aria-hidden="true"></i> Send E-Mail </button>

                                                 <?php }elseif($res['mail_status']==1){ ?>

                                                    <button type="button" name="id_order" id="<?=$res['id_order']?>" class="btn btn-success   email_btn_agn"
                                                    data-id="<?=$res['email_cus']?>" 
                                                    fname_to="<?=$res['fname']?>" 
                                                    lname_to="<?=$res['lname']?>" 

                                                    tex_num="<?=$res['tracking_number']?>"
                                                    data-toggle="tooltip" title="ทำการส่ง E-Mail อีกครั้ง"
                                                 ><i class="fa fa-undo" aria-hidden="true"></i></i> Send E-Mail Again</button>

                                                <?php } ?>

                                                </td>

                                                <?php if($res['con_st'] == 0){ ?>

                                                <td  style="background-color: #ddd;">
                                                <button type="button" name="" id="<?=$res['id_order']?>" class="btn btn-default con_btn  btn-block" btn-lg "><i class="fa fa-empire" aria-hidden="true"></i> Update</button>
                                                </td>

                                                <?php }elseif($res['con_st'] == 1){ ?>
                                                <td style="background-color: #5cb85c54;">
                                                <button type="button" name="" id="<?=$res['id_order']?>" class="btn btn-success btn-block  con_edit_btn" btn-lg "><i class="fa fa-check-circle-o" aria-hidden="true"></i> ได้รับสินค้าแล้ว</button>
                                                </td>
                                                <?php }elseif($res['con_st'] == 2){  ?>

                                                <td style="background-color: #f39c124f;">
                                                <button type="button" name="" id="<?=$res['id_order']?>" class="btn btn-warning btn-block  con_edit_btn" btn-lg "><i class="fa fa-user-times" aria-hidden="true"></i> ถูกส่งกลับ / ไม่มีผู้รับ</button>
                                                </td>

                                                <?php }elseif($res['con_st'] == 3){  ?>

                                                <td style="background-color: #dd4b393d;">
                                                <button type="button" name="" id="<?=$res['id_order']?>" class="btn btn-danger btn-block  con_edit_btn" btn-lg "><i class="fa fa-ban" aria-hidden="true"></i> ขอคืนสินค้า</button>
                                                </td>

                                                <?php } ?>


                                            </tr>
                                    <?php } ?>
                                        </tbody>
                              
                                </table>

                            </div>

                        </div>

                    </div>
                </div>

            </div>

<!-- 
<div class="row">
<div class="col-md-12">
<label>หมายเหตุ : </label>
</div>
</div> -->


        </section>

    </div>




<!-- Modal Add Number Parcel-->
<div class="modal  modal fade" id="modal_number_parcel">
  <div class="modal-dialog">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title"><div id="modal_id_order"></div></h4>
        <input type="hidden" id="id_order_send">
        <label for="">เพิ่ม / แก้ไข หมายเลขติดตามพัสดุ </label>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">
        <form action="" method="post">
        
            <div class="form-group">
              <input type="text" name="number_parcel" id="number_parcel" class="form-control" placeholder="" aria-describedby="helpId">
            </div>                                            

        </form>
      </div>

      <!-- Modal footer -->
      <div class="modal-footer">
      <button type="button" class="btn btn-success  add_number_parcel_btn" name="" id="">บันทึก</button>
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
      </div>

    </div>
  </div>
</div>
 

<style>

.container {
  display: block;
  position: relative;
  padding-left: 35px;
  margin-bottom: 12px;
  cursor: pointer;
  font-size: 18px;
  -webkit-user-select: none;
  -moz-user-select: none;
  -ms-user-select: none;
  user-select: none;
}


.container input {
  position: absolute;
  opacity: 0;
  cursor: pointer;
}

/* Create a custom radio button */
.checkmark {
  position: absolute;
  top: 0;
  left: 0;
  height: 25px;
  width: 25px;
  background-color: #999;
  border-radius: 50%;
}

/* On mouse-over, add a grey background color */
.container:hover input ~ .checkmark {
  background-color: #ccc;
}

/* When the radio button is checked, add a blue background */
.container input:checked ~ .checkmark {
  background-color: #dd4b39;
}

/* Create the indicator (the dot/circle - hidden when not checked) */
.checkmark:after {
  content: "";
  position: absolute;
  display: none;
}

/* Show the indicator (dot/circle) when checked */
.container input:checked ~ .checkmark:after {
  display: block;
}

/* Style the indicator (dot/circle) */
.container .checkmark:after {
 	top: 9px;
	left: 9px;
	width: 8px;
	height: 8px;
	border-radius: 50%;
	background: white;
}
</style>


<!-- Modal -->
<div class="modal fade"  id="con_modal" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content"  style="top:280px;">
                <div class="modal-header" style="background-color: #00c0ef;">
                        <h3 class="modal-title" style="color:#fafafa;" ><i class="fa fa-pencil-square-o" aria-hidden="true"></i> อัพเดตสถานะการส่งสินค้า</h3>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                    </div>
            <div class="modal-body">

            <div class="row">
            <div class="col-md-6">
            
            <form>

            <input type="hidden" name="" id="id_order_md">
            <input type="hidden" name="" id="st_md">

            <label class="container">ลูกค้าได้รับสินค้าแล้ว
            <input type="radio" name="con_st" value="1" onclick="handleClick(this);">
            <span class="checkmark"></span>
            </label>
            <label class="container">สินค้าถูกส่งกลับ / ไม่มีผู้รับ
            <input type="radio" name="con_st" value="2" onclick="handleClick(this);">
            <span class="checkmark"></span>
            </label>
            <label class="container">ลูกค้าขอคืนสินค้า
            <input type="radio" name="con_st" value="3" onclick="handleClick(this);">
            <span class="checkmark"></span>
            </label>

            </form>
            
            </div>

            <div class="col-md-6" style="text-align:center;">
           
            <div id="st_img_ad"  >
            <img src="img/di.png" style=" width:50%; " alt="" >
            </div>
           
            </div>


            </div>
               
          

            </div>
            <div class="modal-footer" style="background-color: #00c0ef;">
                <button type="button" class="btn btn-danger  pull-left" data-dismiss="modal"><i class="fa fa-times" aria-hidden="true"></i> ยกเลิก</button>
                <button type="button" class="btn btn-success  update_btn"><i class="fa fa-floppy-o" aria-hidden="true"></i> บันทึก</button>
            </div>
        </div>
    </div>
</div>




<!-- Modal Edit-->
<div class="modal fade"  id="con_modal_edit" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content"  style="top:280px;">
                <div class="modal-header" style="background-color: #f39c12;">
                        <h3 class="modal-title" style="color:#fafafa;"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> แก้ไขสถานะการส่งสินค้า</h3>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                    </div>
            <div class="modal-body">

            <div class="row">

            <div class="col-md-6">
            <form>

            <input type="hidden" name="" id="id_order_md_edit">
            <input type="hidden" name="" id="st_md_edit">



            <div id="st_md_edit_1">
            <label class="container"  >ลูกค้าได้รับสินค้าแล้ว
            <input type="radio" name="con_st_ed"  value="1" onclick="edit_handleClick(this);">
            <span class="checkmark"></span>
            </label>
            </div>

            <div id="st_md_edit_2">
            <label class="container">สินค้าถูกส่งกลับ / ไม่มีผู้รับ
            <input type="radio" name="con_st_ed"  value="2" onclick="edit_handleClick(this);">
            <span class="checkmark"></span>
            </label>
            </div>
            
            <div id="st_md_edit_3">
            <label class="container">ลูกค้าขอคืนสินค้า
            <input type="radio" name="con_st_ed"  value="3" onclick="edit_handleClick(this);">
            <span class="checkmark"></span>
            </label>
            </div>

            </form>
            </div>

            <div class="col-md-6" style="text-align:center;">
          
            <div id="st_img" ></div>

            </div>
               


            </div>
            <div class="modal-footer" style="background-color: #f39c12;">
                <button type="button" class="btn btn-danger  pull-left" data-dismiss="modal"><i class="fa fa-times" aria-hidden="true"></i> ยกเลิก</button>
                <button type="button" class="btn btn-success  update_edit_btn"><i class="fa fa-floppy-o" aria-hidden="true"></i> บันทึกการแก้ไข</button>
            </div>
        </div>
    </div>
</div>





<!-- mail form -->
<form action="" method="post" id="send_mail_form">
<input type="hidden" name="email_data" id="email_data">
<input type="hidden" name="fname_to_data" id="fname_to_data">
<input type="hidden" name="lname_to_data" id="lname_to_data">
<input type="hidden" name="view_id_order" id="view_id_order">
</form>




    <div class="boxsave">
        <!-- <button type="button" class="delmulti-menu btn btn-danger" style="transition: 0.4s;" id="MultiDelete" disabled><i class="fa fa-remove"></i> ลบรายการที่เลือก <span class="num_"></span></button> -->

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

        <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>

        <script>
        AOS.init();
        </script>

        <script>
         var currentValue = 0;
            function handleClick(radio_value) {
            currentValue = radio_value.value;
            console.log(currentValue);

            $("#st_md").val(currentValue); 

            if(currentValue == 1){
                document.getElementById("st_img_ad").innerHTML = ' <img src="img/get_pro.png" style=" width:63%; " alt="">';
            }else if(currentValue == 2){
                document.getElementById("st_img_ad").innerHTML = ' <img src="img/not_img.png" style=" width:50%; " alt="">';
            }else if(currentValue == 3){
                document.getElementById("st_img_ad").innerHTML = ' <img src="img/ban_img.png" style=" width:50%; " alt="">';
            }
        }

       
        $(document).on('click', '.update_btn', function(event){ 


            st_md = $("#st_md").val(); 
            id_order = $("#id_order_md").val(); 
            console.log(currentValue);


            swal({
                            title: 'Confirm !',
                            text: "ยืนยันการ Update สถานะ ?",
                            type: 'info',
                            confirmButtonColor: '#3085d6',
                            confirmButtonText: 'ตกลง!',
                            showLoaderOnConfirm: true,

                            cancelButtonText: 'ยกเลิก',
                            showCancelButton: true,
                            cancelButtonColor: '#d33',
                        }).then((result) => {
                            // $("#modal_number_parcel").modal('show');

if (result.value) {
// ---------------------------------------------------
            $.ajax({   
            url:'function_g.php?id_order='+id_order, 
            method:'POST',  
            data:{_method:'UPDATE_ST',con_st:st_md},  
            dataType:"json",  
                success:function(response){  
                    console.log('response : ',response.status);

if(response.status == 1){
swal('สำเร็จ','บันถึงเรียบร้อย','success').then((result) => {
window.location = "";
})
}
                   
                    
                }, 
        
           });
// ---------------------------------------------------
}
                        })

});


            var edit_currentValue = 0;
            function edit_handleClick(radio_value) {
            edit_currentValue = radio_value.value;
            console.log(edit_currentValue);

            $("#st_md_edit").val(edit_currentValue); 

            if(edit_currentValue == 1){
                document.getElementById("st_img").innerHTML = ' <img src="img/get_pro.png" style=" width:63%; " alt="">';
            }else if(edit_currentValue == 2){
                document.getElementById("st_img").innerHTML = ' <img src="img/not_img.png" style=" width:50%; " alt="">';
            }else if(edit_currentValue == 3){
                document.getElementById("st_img").innerHTML = ' <img src="img/ban_img.png" style=" width:50%; " alt="">';
            }

        }


        </script>

<script>

$(document).on('click', '.con_edit_btn', function(event){  

    var id_order = $(this).attr("id"); 

    $.ajax({
    type: "POST",
    url: "function_g.php?id_order="+id_order,
    data:{_method:'CON_EDIT_SE'},  
    dataType:"json", 
    success: function (response) {
        console.log('con_st : ',response.data[0]['con_st']);
        //  console.log(data.status);

        $("#st_md_edit").val(response.data[0]['con_st']);
        var checked_st_1 = '';
        var checked_st_2 = '';
        var checked_st_3 = '';


        if(response.data[0]['con_st'] == 1){
            checked_st_1 = ' checked="checked" ';
            document.getElementById("st_md_edit_1").innerHTML = ' <label class="container"  >ลูกค้าได้รับสินค้าแล้ว <input type="radio" id="radio1" name="con_st_ed" value="1" ' + checked_st_1 + ' onclick="edit_handleClick(this);"> <span class="checkmark"></span>   </label>';
            document.getElementById("st_img").innerHTML = ' <img src="img/get_pro.png" style=" width:63%; " alt="">';
        }else if(response.data[0]['con_st'] == 2){
            checked_st_2 = ' checked="checked" ';
            document.getElementById("st_md_edit_2").innerHTML = '<label class="container">สินค้าถูกส่งกลับ / ไม่มีผู้รับ <input type="radio" id="radio2" name="con_st_ed" value="2" ' + checked_st_2 + ' onclick="edit_handleClick(this);">  <span class="checkmark"></span>  </label>';
            document.getElementById("st_img").innerHTML = ' <img src="img/not_img.png" style=" width:50%; " alt="">';
        }else if(response.data[0]['con_st'] == 3){
            checked_st_3 = ' checked="checked" ';
            document.getElementById("st_md_edit_3").innerHTML = ' <label class="container">ลูกค้าขอคืนสินค้า <input type="radio"  id="radio2" name="con_st_ed" value="3" ' + checked_st_3 + ' onclick="edit_handleClick(this);">  <span class="checkmark"></span> </label>';
            document.getElementById("st_img").innerHTML = ' <img src="img/ban_img.png" style=" width:50%; " alt="">';
        }

        $("#con_modal_edit").modal('show');
             
    },
});


    $("#id_order_md_edit").val(id_order); 
});



// ------------------------------------------------------------------------------------
$(document).on('click', '.update_edit_btn', function(event){ 


st_md = $("#st_md_edit").val(); 
id_order = $("#id_order_md_edit").val(); 
console.log(currentValue);


swal({
                title: 'Confirm !',
                text: "ยืนยันการ Update สถานะ ?",
                type: 'info',
                confirmButtonColor: '#3085d6',
                confirmButtonText: 'ตกลง!',
                showLoaderOnConfirm: true,

                cancelButtonText: 'ยกเลิก',
                showCancelButton: true,
                cancelButtonColor: '#d33',
            }).then((result) => {
                // $("#modal_number_parcel").modal('show');

if (result.value) {
// ---------------------------------------------------
$.ajax({   
url:'function_g.php?id_order='+id_order, 
method:'POST',  
data:{_method:'UPDATE_ST',con_st:st_md},  
dataType:"json",  
    success:function(response){  
        console.log('response : ',response.status);

if(response.status == 1){
swal('สำเร็จ','บันถึงเรียบร้อย','success').then((result) => {
window.location = "";
})
}
        
    }, 

});
// ---------------------------------------------------
}
            })

});
// ************************************************************************************





$(document).on('click', '.con_btn', function(event){  
    $("#con_modal").modal('show');

    var id_order = $(this).attr("id"); 

    $("#id_order_md").val(id_order); 
   
});


$(document).ready(function(){
  $('[data-toggle="tooltip"]').tooltip();   
});


$(document).on('click', '.email_btn', function(event){  

    var email = $(this).attr('data-id');
    var fname_to = $(this).attr('fname_to');
    var lname_to = $(this).attr('lname_to');
    var id_order = $(this).attr("id"); 
    var tex_num = $(this).attr("tex_num"); 
    
    $("#view_id_order").val(id_order); 
    $("#email_data").val(email); 
    $("#fname_to_data").val(fname_to); 
    $("#lname_to_data").val(lname_to);


    if(tex_num == ''){
   
   swal({
           title: 'คำเตือน !',
           text: "กรุณากรอกหมายเลขติดตามพัสดุ",
           type: 'warning',
           // showCancelButton: true,
           confirmButtonColor: '#3085d6',
           //  cancelButtonColor: '#d33',
           confirmButtonText: 'ตกลง!',
           showLoaderOnConfirm: true
       }).then((result) => {
           $("#modal_number_parcel").modal('show');
       })
   
   }else{

swal({
  title: 'ยืนยัน ?',
  text: "ทำการส่ง E-Mail ไปยังลูกค้า ",
  type: 'info',
  showCancelButton: true,
  confirmButtonColor: '#3085d6',
  cancelButtonColor: '#d33',
  confirmButtonText: 'ยืนยัน !'
}).then((result) => {
    if (result.value) {

   // -------------------------------------------------------------
   var formData = new FormData($('#send_mail_form')[0]);

$.ajax({
    type: "POST",
    url: "mail_to.php",
    data: formData,
    processData: false,
    contentType: false,
    success: function (data) {
         console.log(data.status);
        //  if(data.status==1){
        swal('สำเร็จ',
            'การส่ง E-mail สำเร็จ',
            'success'
        ).then((value) => {
            // window.location = 'front-add.php?values=' + $('#sale_id').val();
            window.location = '';
        }); 
  //  }                         
    },
});

}
// -----------------------------------------------------------------

});//


   }//else





}); 


</script>



<script>
$(document).on('click', '.email_btn_agn', function(event){  

    var email = $(this).attr('data-id');
    var fname_to = $(this).attr('fname_to');
    var lname_to = $(this).attr('lname_to');
    var id_order = $(this).attr("id"); 
    var tex_num = $(this).attr("tex_num"); 
    
    $("#view_id_order").val(id_order); 
    $("#email_data").val(email); 
    $("#fname_to_data").val(fname_to); 
    $("#lname_to_data").val(lname_to);


    if(tex_num == ''){
   
   swal({
           title: 'คำเตือน !',
           text: "กรุณากรอกหมายเลขติดตามพัสดุ",
           type: 'warning',
           // showCancelButton: true,
           confirmButtonColor: '#3085d6',
           //  cancelButtonColor: '#d33',
           confirmButtonText: 'ตกลง!',
           showLoaderOnConfirm: true
       }).then((result) => {
           $("#modal_number_parcel").modal('show');
       })
   
   }else{

swal({
  title: 'คำเตือน !',
 // text: "รายการจัดส่งนี้ได้ทำการส่ง E-Mail ไปยังลูกค้าแล้ว ต้องการส่งอีกครั้งหรือไม่ ? ",
 html:'<label>รายการจัดส่งนี้ได้ทำการส่ง E-Mail ไปยังลูกค้าแล้ว<br>ต้องการส่งอีกครั้งหรือไม่ ?</label>',
  type: 'info',
  showCancelButton: true,
  cancelButtonText: 'ยกเลิก',
  confirmButtonColor: '#3085d6',
  cancelButtonColor: '#d33',
  confirmButtonText: 'ยืนยัน !'
}).then((result) => {
    if (result.value) {

   // -------------------------------------------------------------
   var formData = new FormData($('#send_mail_form')[0]);

$.ajax({
    type: "POST",
    url: "mail_to.php",
    data: formData,
    processData: false,
    contentType: false,
    success: function (data) {
         console.log(data.status);
        //  if(data.status==1){
        swal('สำเร็จ',
            'การส่ง E-mail สำเร็จ',
            'success'
        ).then((value) => {
            // window.location = 'front-add.php?values=' + $('#sale_id').val();
            window.location = '';
        }); 
  //  }                         
    },
});

}
// -----------------------------------------------------------------

});//


   }//else





}); 


</script>





<script type="text/javascript">  //datatable -------------------------------------------------//


$(document).ready(function() {
    $('#history_list').DataTable( {
     
    } );
} );
</script>


<script>
$(document).on('click', '.print_head_btn', function(event){  

 //var tax = document.getElementById('number_parcel').value;
 var id_order = $(this).attr("id"); 
 $.ajax({   
            url:'function_g.php?add_id_order='+id_order, 
            method:'POST',  
            data:{_method:'EDIT_NUMBER_PARCEL'},  
            dataType:"json",  
                success:function(response){  
                    console.log(response.data[0]['tracking_number']);
                
                 var tax = response.data[0]['tracking_number'];

                //  if(tax == ''){
   
                //     swal({
                //             title: 'คำเตือน !',
                //             text: "กรุณากรอกหมายเลขติดตามพัสดุ",
                //             type: 'warning',
                //             // showCancelButton: true,
                //             confirmButtonColor: '#3085d6',
                //             //  cancelButtonColor: '#d33',
                //             confirmButtonText: 'ตกลง!',
                //             showLoaderOnConfirm: true
                //         }).then((result) => {
                //             $("#modal_number_parcel").modal('show');
                //         })
                    
                //     }else{
                   // var id_order = $(this).attr("id"); 
                    window.location = "print.php?id_order="+id_order;
                    // }
                 
                }, 
        
           }); 
}); 
</script>


<script>
$(document).on('click', '.print_number_parcel_btn', function(event){ 
    var id_order = $(this).attr("id"); 
    document.getElementById('modal_id_order').innerHTML='<label>Order : '+'<label style="color:#00a65a;">'+id_order+'</label>'+'</label>';
    $('#id_order_send').val(id_order);
    $.ajax({   
            url:'function_g.php?add_id_order='+id_order, 
            method:'POST',  
            data:{_method:'EDIT_NUMBER_PARCEL'},  
            dataType:"json",  
                success:function(response){  
                    console.log(response.data[0]['tracking_number']);
                  $("#number_parcel").val(response.data[0]['tracking_number']);
                  $("#modal_number_parcel").modal('show'); 
                }, 

                   
           });  





});


$(document).on('click', '.add_number_parcel_btn', function(event){  
            // var add_id_order = id_order; 
            var add_id_order = $('#id_order_send').val(); 
          
            var number_parcel = document.getElementById("number_parcel").value; 
            console.log(number_parcel); 
        
           $.ajax({   
            url:'function_g.php?add_id_order='+add_id_order, 
            method:'POST',  
            data:{_method:'ADD_NUMBER_PARCEL' , value:number_parcel},  
            dataType:"json",  
                success:function(data){  
                  // console.log(data);
                   if(data.status==1){
                        swal('สำเร็จ','บันทึกเรียบร้อยแล้ว','success').then(function(){
                        //   $("#add_modal").trigger("reset");
                          $('#modal_number_parcel').modal('hide');
                        
                             window.location = "";

                        });
                        

                    }else {
                        swal('ไม่สำเร็จ','เกิดปัญหากับระบบ','error')
                    }
                },  
           });  
}); 

</script>



<script>


function myTableReload() {
            table = $('#history_list').DataTable();
            table.destroy();
            table = $('#history_list').DataTable({
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
               // thaiyear: true //Set เป็นปี พ.ศ.
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


<script>

$(document).on('click', '.reply', function(event) {
                var email = $(this).attr('data-id');
                // var message = $(this).attr('message');
                // var subject = $(this).attr('subject');
                var fname_to = $(this).attr('fname_to');
                var lname_to = $(this).attr('lname_to');

                console.log(email);
                console.log(fname_to);
                console.log(lname_to);

                 $("#email").html("E-mail : "+email);
                 $("#name_to").html("User : "+fname_to+" "+lname_to);
                // $("#subject").html("Subject : "+subject);

                $("#email_data").val(email); 
                $("#fname_to_data").val(fname_to); 
                $("#lname_to_data").val(lname_to); 
                // $("#subject_data").val(subject); 
                // $("#message_data").val(message); 


                 $('#modal_mail').modal('show');
            
                // location.href = 'mailto:'+email;
            });



$(document).ready(function () {


var data = '';
$('#btnSendAdd').click(function (event) {

if($("#sub_to_reply").val() == "" || $("#mass_to_reply").val() == "" ){
    swal('คำเตือน!','กรุณากรอกข้อมูล','warning')
                    if($("#sub_to_reply").val() == ""){
                        $("#sub_to_reply").attr("style" , "border-color: red; border-width: 1px;");
                        setTimeout(function() {
                            $("#sub_to_reply").attr("style" , "");
                        }, 5000);
                    }
                    if($("#mass_to_reply").val() == ""){
                        $("#mass_to_reply").attr("style" , "border-color: red; border-width: 1px;");
                        setTimeout(function() {
                            $("#mass_to_reply").attr("style" , "");
                        }, 5000);
                    }
}else{
var formData = new FormData($('#send_mail_form')[0]);

        swal({
            title: 'ยืนยัน?',
            text: "ยืนยันการส่ง E-mail",
            type: 'info',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'ยืนยัน!',
            showLoaderOnConfirm: true
        }).then((result) => {
           if (result.value) {
                //console.log(result.value);
                $.ajax({
                    type: "POST",
                    url: "mail_to.php",
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function (data) {
                         console.log(data.status);
                        //  if(data.status==1){
                        swal('สำเร็จ',
                            'การส่ง E-mail สำเร็จ',
                            'success'
                        ).then((value) => {
                            // window.location = 'front-add.php?values=' + $('#sale_id').val();
                            window.location = '';
                        }); 
                  //  }                         
                    },
                });
            }
        })
     }
});
})





</script>



</body>
</html>
