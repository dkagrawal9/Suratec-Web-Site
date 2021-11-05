<?php
require_once '../library/connect.php';
require_once '../library/functions.php';
//require_once 'Database.php';
checkAdminUser($objConnect);
// mysqli_set_charset($objConnect, "utf8");






?>


 <!-- gen key id GRYYXXXXX -->
 <?php 
                                                    $str = "SELECT max(`id_order`) as id_order FROM `mod_order`";

                                                   
                                                    $resultArray = array();
                                                    $query = mysqli_query($objConnect,$str);
                                                    $result = mysqli_fetch_array($query,MYSQLI_ASSOC);
                                                    
                                                    $leng = strlen($result['id_order']); 

                                                    $values = $result['id_order'];

													$yaer = (string)(date("Y") + 543);
													$strYear = substr($yaer,2,2);
                                                    $prefix = "BL";
                                                    
													if(null == $values){	
                                                        													 
														$key = $prefix . $strYear  . '00001';
													}else{

														$prefix = substr($values,0,2);
														$y = substr($values,2,2);
														if($y == $strYear){
														    $n = substr($values,4,6);
														    $no = (int) $n + 1;
														}else{
														    $y = $strYear;
														    $no = 1;
														}
														
														
														$format = '%s%s%05d';
														$key = sprintf($format, $prefix, $y ,$no);
                                                    }
                            
                                        
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
    


    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.6.3/css/bootstrap-select.min.css" /><!--bootstrap-select-->

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

.product_img_st {
    text-align:center;
   padding:2%;
}

.product_img_st img{
    border-radius: 5px;
    max-width: 60%;
    max-height: 60%;
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
            ใบขายใหม่
            </h1>
          
            <ol class="breadcrumb">
                <li><a href="../page_home/index.php"></i> Dashboard</a></li>
                <li class="active">ใบขายใหม่</li>
            </ol>
        </section>
        <!-- Main content -->
        <section class="content">
            <!-- SELECT2 EXAMPLE -->
            <div class="row">

        
            <div class="col-lg-8 col-md-8 col-sm-8">
                    <!-- Start box warning for ADD system -->
                    <div class="box box-primary callout-primary-box">
                        <div class="box-header with-border">
                            <h3 class="box-title">รายการสินค้า</h3>

                            <div class="box-tools pull-right">
                                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i></button>
                            </div>

                        </div>
                        <div class="box-body" >
                            <div class="box-body">


<div class="row">




<form id="upload-form-list-name-add" enctype="multipart/form-data"  class="upload-form-add form-horizontal">



<?php                             
// $sql = "SELECT *  FROM  product 
// LEFT JOIN product_image ON product.id_product = product_image.id_product
// LEFT JOIN product_attribute ON product.id_product = product_attribute.id_product
// LEFT JOIN mod_erp_branch ON product.id_branch = mod_erp_branch.id_branch
// WHERE product.id_branch='a89qb23079f81f064d3908d5a6ee0f20b5y' 
// and product.delete_datetime is null 
// GROUP BY product.id_product
// order by  product.id_product asc";
// $query = mysqli_query($objConnect, $sql);
?>


<?php                             
$sql_erp = "SELECT *  FROM  mod_erp_branch WHERE delete_datetime is null  ";
$query_erp = mysqli_query($objConnect, $sql_erp);

$sql_product = "SELECT *,mod_erp_branch.id_branch as id_branch_st  FROM  product
LEFT JOIN product_image ON product.id_product = product_image.id_product
LEFT JOIN product_attribute ON product.id_product = product_attribute.id_product
LEFT JOIN mod_erp_branch ON product.id_branch = mod_erp_branch.id_branch
WHERE product.delete_datetime is null 
GROUP BY product.id_product
order by  product.id_product asc";
$query_product = mysqli_query($objConnect, $sql_product);
?>

<div class="col-md-8">

<!-- <div class="form-group">
        <label for="">ร้านค้า</label>
        <select class="form-control   selectpicker  validate_from" data-show-subtext="true" data-live-search="true"  name="id_branch_store" id="id_branch_store"   onchange="fetch_select_store(this.value);">
        <option value="">- Select Store -</option>
        <?php while($res_erp = mysqli_fetch_array($query_erp)){?>
        <option  value="<?=$res_erp['id_branch']?>" ><?=$res_erp['name_branch']?></option>
        <?php } ?>
        </select>
        </div>-->


<div class="form-group">
        <label for="">สินค้า</label>
        <select class="form-control     validate_from"  name="product_id" id="product_id"  onchange="fetch_select(this.value);">
        <option value=""  selected="selected">- Select Product -</option>
<?php while($res_product = mysqli_fetch_array($query_product)){?>
        <option  value="<?=$res_product['id_product']?>" ><?=$res_product['name_product']?></option>
        <?php } ?>
        </select>
        </div>

        <!-- <div class="form-group">
        <label for="">คุณสมบัติ</label>
         <select name="product_id" id="product_id" class="form-control    ">
         <option value="" selected="selected">- Select Property -</option>
         </select>                                  
        </div>   -->



        <div class="form-group">
        <label for="">คุณสมบัติ</label>
         <select name="attr_id" id="attr_id" class="form-control    ">
         <option value="" selected="selected">- Select Property -</option>
         </select>                                  
        </div>  


    <div class="form-group ">
        <label for="">ราคา</label>
        <input type="text" name="product_price" id="product_price" class="form-control  validate_from" placeholder="" aria-describedby="helpId" disabled>
    </div>

    <div class="form-group">
        <label for="">จำนวน</label>
        <input type="number" name="amount" id="amount" class="form-control  validate_from" placeholder="" aria-describedby="helpId">
    </div>    

 

    </div>


<div class="col-md-4  product_img_st">
 <div id="product_img"  >
 <img src="../img/noimage.png" alt="">
 </div> 
 </div>



 </form>

 
 <div class="col-md-12">
 <button class="btn btn-info pull-right " onclick="fnc_send()"><i class="fa fa-plus"></i>&nbsp;เพิ่มสินค้า</button>
 </div>

</div>  <!--row-->
                    
<hr>

<div class="col-md-12" style="background-color: #cecece !important; padding:0.2%;">
<h4>รายการสินค้า</h4>
</div>

<br>                
                                <table class="table  table-bordered" id="list-drawer" width="100%">
                                    <thead>
                                
                                        <tr>
                                            <th>No.</th>
                                            <th>สินค้า</th>
                                            <th>คุณสมบัติ</th>
                                            <th>ราคา</th>
                                            <th>จำนวน</th>
                                            <th>ยอดเงิน</th>
                                            <th>ควบคุม</th>
                                        </tr>
                                    </thead>
                                     <tbody>
                                        
                                        </tbody> 

                                </table>
                            </div>
                        </div>

                    </div>
                </div>

               
 <!-- ---------------------------------------------------------------------------------------------------------------------------------- -->

 <form id="upload-form-add" enctype="multipart/form-data"  class="upload-form-add ">


 <input type="hidden" name="_method" value="CREATE_SUP_ITEM">
<input type="hidden"  name="bl_number" value="<?=$key?>" />
<input type="hidden" name="id_branch" id="id_branch">    
 
           <div class="col-lg-4 col-md-4 col-sm-4">
 
                <div class="box box-primary callout-primary-box">
                    <div class="box-header with-border">
                        <h3 class="box-title">ข้อมูลลูกค้า</h3>

                        <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i></button>
                        </div>

                    </div>

                    <div class="box-body" >
<div class="row"><!--row--> 

<?php                             
$sql = "SELECT * FROM  mod_customer WHERE   delete_datetime is null ";
$query = mysqli_query($objConnect, $sql);
?>
                                
<div class="col-md-8">
<div class="form-group">
        <label for="">ลูกค้า</label>
        <select class="form-control   selectpicker  " data-show-subtext="true" data-live-search="true"  name="id_customer" id="id_customer"  onchange="fetch_select_customer(this.value);">
        <option value="" selected="selected">- Select Customer -</option>
        <?php while($res = mysqli_fetch_array($query)){?>
        <option  value="<?=$res['id_customer']?>" ><?=$res['fname']?> <?=$res['lname']?></option>
        <?php } ?>
        </select>
</div>                        
</div>

<?php                             
// $sql = "SELECT * FROM  mod_customer 
// LEFT JOIN mod_customer_address on mod_customer_address.id_customer = mod_customer.id_customer
// WHERE   mod_customer_address.delete_datetime is null ";
// $query = mysqli_query($objConnect, $sql);
?>

<div class="col-md-8">
<div class="form-group">
        <label for="">ที่อยู่ในการจัดส่ง</label>

        <select name="id_address" id="id_address" class="form-control    ">
         <option value="" selected="selected">- Select Address -</option>
         </select>   

</div>                
</div>

<div class="col-md-12">




<hr>
<div style="background-color: #cecece !important; padding:0.2%;">
<h4>สรุปการสั่งซื้อ</h4>
</div>

<div class="row" style="padding:3%;"><!--inrow--> 
<div class="col-md-6"><label for="">จำนวน</label></div> <div class="col-md-6" style="text-align:right;"><label for=""><input type="text" name="sum_qty" id="sum_qty" class="form-control" placeholder="" readonly></label></div>

<div class="col-md-6"><label for="">ยอดรวม</label></div> <div class="col-md-6" style="text-align:right;"><label for=""><input type="text" name="sum_price" id="sum_price" class="form-control" placeholder="" readonly></label></div>


<?php                             
$sql = "SELECT * FROM  mod_shipping 
WHERE  delete_datetime is null ";
$query = mysqli_query($objConnect, $sql);
?>
<div class="col-md-6">
<hr>
<div class="form-group">
        <label for="">จัดส่งโดย</label>
        <select class="form-control   selectpicker  validate_from" data-show-subtext="true" data-live-search="true"  name="id_shipping" id="id_shipping"  onchange="fetch_shipping(this.value);">
        <option value="" selected="selected">- Select Shipping -</option>
        <?php while($res = mysqli_fetch_array($query)){?>
        <option value="<?=$res['id_shipping']?> "><?=$res['name_shipping']?></option>
        <?php } ?>
        </select>
</div>
<hr>                
</div>

<div class="col-md-12"></div>

<div class="col-md-6"><label for="">ค่าจัดส่ง</label></div> <div class="col-md-6" style="text-align:right;"><input type="text" name="shipping_price" id="shipping_price" class="form-control" placeholder="" readonly></div>


<div class="col-md-12"><hr></div>

<div class="col-md-6"><label for="">ยอดรวมทั้งสิ้น</label></div> <div class="col-md-6" style="text-align:right;"><input type="text" name="sum_all" id="sum_all" class="form-control" placeholder="" readonly></div>




</div><!--inrow--> 

</div>

</div> <!--row-->

<div class="col-md-12">
<hr>
<h4>เลือกวิธีชำระเงิน</h4>


<div class="form-check form-check-inline">
    <label class="form-check-label">
        <input class="form-check-input" type="radio" name="payment" id="payment" value="1"> โอนเงิน &nbsp;&nbsp;
        <!-- <input class="form-check-input" type="radio" name="payment" id="payment" value="2"> บัตรเครดิต &nbsp;&nbsp; -->
        <input class="form-check-input" type="radio" name="payment" id="payment" value="3"> เก็บเงินปลายทางผ่าน Kerry  
    </label>
</div>

</div>


  
                    </div>
        </div>

</form>
 </div>  
 <!-- ---------------------------------------------------------------------------------------------------------------------------------- -->

            </div>

        </section>

    </div>



    



    <div class="boxsave">
<div style="text-align:right;">
<button type="button" name="" id="" class="btn btn-danger" btn-lg btn-block">ยกเลิก</button>   
<button type="button" name="" id="btnSendAdd" class="btn btn-primary  btnSendAdd" btn-lg btn-block">บันทึก</button>  
</div> 
<!-- <div style="text-align:left;">
<button type="button" class="delmulti-menu btn btn-danger" style="transition: 0.4s;" id="MultiDelete" disabled><i class="fa fa-remove"></i> ลบรายการที่เลือก <span class="num_"></span></button>
</div> -->

    </div>
    <div class="control-sidebar-bg"></div>
</div>




<div class="modal fade" id="modal-default-edit">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title"><i class="fa fa-clone">&nbsp;&nbsp;</i>แก้ไขจำนวนสินค้า</h4>
                        </div>
                        <div class="modal-body">
                        
                            <form id="upload-form-edit" enctype="multipart/form-data"
                                class="upload-form-edit form-horizontal">
                                <input type="hidden" name="data_id_edit" id="data_id_edit" value="">
                                <input type="hidden" name="_method" value="PATCH">

                        
                                

                                <div class="form-group">
                                    <label class="col-sm-2">จำนวน</label>
                                    <div class="col-sm-10">
                                        <input type="number" id="amount_edit" name="amount_edit"
                                            class="form-control validate_from" placeholder="จำนวน" required>
                                    </div>
                                </div>

                         
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default pull-left"
                                data-dismiss="modal">ยกเลิก</button>
                            <button type="button" class="btn btn-success" onclick="change_data()" >บันทึก</button>
                        </div>
                    </div>
                    <!-- /.modal-content -->
                </div>
                <!-- /.modal-dialog -->
            </div>
            <!-- /.modal -->




            
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

<!-- <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script> -->

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



        <script src="//cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.6.3/js/bootstrap-select.min.js"></script>  <!--bootstrap-select-->

<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>


<script>
  AOS.init();
</script>

<script type="text/javascript">  //datatable -------------------------------------------------//




var  sum_p = [];
var  sum_qty = [];

var table, items = [], id = 0;
            function validate_fromdata(key_validate) {
                var result = false;
                var validate = document.getElementById(key_validate);
                var input = validate.getElementsByClassName("validate_from");
                console.log(input);

                for (i = 0; i < input.length; i++) {
                     console.log(input[i].value);
                    if (input[i].value == "") {
                         console.log('!!');
                        input[i].style.borderColor = "#d9534f"
                        swal({
                            title: 'กรุณากรอกข้อมูลให้ครบ!',
                            //text: "คุณยืนยันจะเพิ่มชนิดสินค้าหรือไม่?",
                            type: 'warning',
                            confirmButtonColor: '#3085d6',
                            cancelButtonColor: '#d33',
                            confirmButtonText: 'ยืนยัน!',
                        })
                        result = true;
                    } else {
                        input[i].style.borderColor = "#ccc"
                        // result = false;
                    }
                }

                return result;
            }



$(document).ready(function () {
                table = $('#list-drawer').DataTable({
                    language: {
                        lengthMenu: "แสดง _MENU_ แถวต่อหน้า",
                        zeroRecords: "ไม่พบข้อมูล",
                        info: "กำลังแสดงหน้าที่ _PAGE_ จาก _PAGES_",
                        infoEmpty: "ไม่พข้อมูล",
                        infoFiltered: "(จากทั้งหมด _MAX_)"
                    },
                    paging: false,
                    searching: false
                });
            });

</script>




<script type="text/javascript">



function fetch_select_store(val){
                console.log(val);
                $.ajax({
                    type: 'post',
                    url: 'function_g.php',
                    datatype:'json',
                    data: {option:val , _method:'SELECT_PRODUCT'},
                    success: function (response) {
  
                       console.log(response.data[0]);

                        var pot = "";
                        $.each(response.data, function (key, val) {
                                
                            if(val["name_product"] != ""){
                                pot += "<option value='" + val["id_product"] + "'>" + val["name_product"] +"</option>"
                            }else{
                                pot += "<option value='' disabled>" + 'None Data.'  +"</option>"
                            }  


                            // img_path ="../../uploads/product/";
                            // img = "<img  src='" + img_path + val["name_image"] + "'   data-aos='flip-right' >"    
                        });
                                    

                         $("#product_id").html(pot); 
                        // $("#product_img").html(img); 
                        // $("#product_price").val(response.data[0]['tmp_price']); 
                        $("#id_branch").val(response.data[0]['id_branch_st']); 
                        
                    }
                });
            }





            function fetch_select(val){
                console.log(val);
                $.ajax({
                    type: 'post',
                    url: 'function_g.php',
                    datatype:'json',
                    data: {option:val , _method:'SELECT_ATTR'},
                    success: function (response) {
  
                       console.log(response.data[0]['id_branch']);

                        var opt = "";
                        $.each(response.data, function (key, val) {
                                
                            if(val["option_name"] != ""){
                                opt += "<option value='" + val["id_attr"] + "'>" + val["option_name"] +"</option>"
                            }else{
                                opt += "<option value='' disabled>" + 'None Data.'  +"</option>"
                            }  


                            img_path ="../../uploads/product/";
                            img = "<img  src='" + img_path + val["name_image"] + "'   data-aos='flip-right' >"    
                        });
                                    

                        $("#attr_id").html(opt); 
                        $("#product_img").html(img); 
                        $("#product_price").val(response.data[0]['tmp_price']); 
                      // $("#id_branch").val(response.data[0]['id_branch']); 
                        
                    }
                });
            }



            function fetch_select_customer(val){
                console.log(val);
               
                $.ajax({
                    type: 'post',
                    url: 'function_g.php',
                    datatype:'json',
                    data: {option:val , _method:'SELECT_ADDRESS'},
                    success: function (response) {
  
                       console.log(response.data);

                        var opt = "";
                        $.each(response.data, function (key, val) {
                                
                            if(val["id_address"] != "" && val["fname"] != "" && val["lname"] != "" && val["address"] != "" && val["district"] != "" && val["amphur"] != "" ){
                                opt += "<option value='" + val["id_address"] + "'>" + val["fname"] +'&nbsp;&nbsp;'+ val["lname"] +"</option>"
                                opt += "<option disabled style='background:#696969 ; color:#fafafa;' value='" + val["id_address"] + "'>" + val["address"] +'&nbsp;&nbsp;'+ 'ต.'+ val["district"] +'&nbsp;&nbsp;'+ 'อ.'+ val["amphur"] +"</option>"
                                opt += "<option disabled style='background:#696969 ; color:#fafafa; ' value='" + val["id_address"] + "'>" + 'จ.'+ val["province"] +'&nbsp;&nbsp;'+ val["postalcode"] +"</option>"
                       
                            }else if(val["address"] == "" && val["district"] == "" && val["amphur"] != ""){
                                opt += "<option value='' disabled>" + ''  +"</option>"
                            }else if(val["id_address"] == ""){
                                opt += "<option value='' disabled>" + 'None Data.'  +"</option>"
                            }  
    
                        });
    

                        $("#id_address").html(opt); 
                        // $("#product_img").html(img); 
                        // $("#product_price").val(response.data[0]['tmp_price']); 
                    }
                });
            }




            function fetch_shipping(val){
                console.log(val);

               

                $.ajax({
                    type: 'post',
                    url: 'function_g.php',
                    datatype:'json',
                    data: {option:val , _method:'SELECT_SHIPPING'},
                    success: function (response) {

                       console.log(response.data);

                        $("#shipping_price").val(response.data[0]['price']); 
                        sum();
                    }
                });
            }


          function sum() { //--------------------sum all price -----------///
                var shipping_price = document.getElementById("shipping_price").value;  
                var sum_price = document.getElementById("sum_price").value; 

                shipping_price_fo = shipping_price * 1;
                sum_price_fo = sum_price * 1;

                console.log("sum_all : ",shipping_price_fo, sum_price_fo);
                sum_all = shipping_price_fo + sum_price_fo;
                
                $("#sum_all").val(sum_all); 
                console.log("sum_all : ",sum_all);
            }; 



</script>




<script   type="text/javascript" >

var sum_sqty ;

var sum_price;

function fnc_send(index){

    // document.getElementById("upload-form-add").reset();

                console.log($("#product_id").find(":selected").text());
                //var  sum_price = [];
                if (!validate_fromdata("upload-form-list-name-add")) {
                    var data = {
                        id_item: id++,
                        // id_order: $('#sale_id').val(),
                        name_product: $("#product_id").find(":selected").text(),
                        product_id: $("#product_id").val(),
                        attr_id: $('#attr_id').val(),
                        attr_id: $("#attr_id").find(":selected").text(),
                        qty: $('#amount').val(),
                        product_price: $('#product_price').val(),
                        sum: $('#amount').val() * $('#product_price').val(),
                        all_qty: $('#amount').val() * 1 ,
                       
                    }; 
                    
                    // create array
                     console.log("create array", data);

                    items.push(data); // push array 
                     console.log("push array", items);

                     sum_qty.push(data.all_qty);
                     console.log("sum array", sum_qty);
                     sum_p.push(data.sum);
                     console.log("sum array", sum_p);
                     

                     reload_datatable();
               }
//-----------sum array value -------------------------------------------------//
const reducer = (accumulator, currentValue) => accumulator + currentValue;

sum_sqty = sum_qty.reduce(reducer);
$('#sum_qty').val(sum_sqty);
console.log(sum_sqty);

sum_price = sum_p.reduce(reducer);
$('#sum_price').val(sum_price);
console.log(sum_price);
 //-----------sum array value -------------------------------------------------//

 sum();       
            }




           
            $('#list-drawer tbody').on('click', '.edit-data', function () {
                var data = table.row($(this).parents('tr')).data();
                 console.log(data);

                // select_products_edit(data.sale_id);


                // // set values
                $('#data_id_edit').val(data.id_item);
                $('#amount_edit').val(data.qty);
                // $('#unit_name_edit').val(data.unit_name);
                // // $('#sale_id_edit').val(data.sale_id);
               // $('#data_id_edit').val(data.data_id);

                // // show modal
                 $('#modal-default-edit').modal('show');
            });

           
            function change_data() {
                if (!validate_fromdata("upload-form-edit")) {
                    swal({
                        title: 'ยืนยัน?',
                        text: "คุณยืนยันจะแก้ไขข้อมูลหรือไม่?",
                        type: 'info',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'ยืนยัน!',
                        showLoaderOnConfirm: true
                    }).then((result) => {
                        if (result.value) {
                            var index = $('#data_id_edit').val();
                    

                             console.log("index_ch : ",index);
                             console.log("item_ch : ",items[index]);
                            

                            items[index] = {
                                //data_id: id++,
                                // sale_id: $('#sale_id').val(),
                                id_item : index,
                                name_product: $("#product_id").find(":selected").text(),
                                product_id: $("#product_id").val(),
            
                                attr_id: $("#attr_id").find(":selected").text(),
                                qty: $('#amount_edit').val(),
                                product_price: $('#product_price').val(),
                                sum: $('#amount_edit').val() * $('#product_price').val(),
                                all_qty: $('#amount').val() * 1 ,
                           

                            };
                             console.log('items[index] : ',items[index]);

                           console.log('items.all_qty : ',items.all_qty);

                            fnc_send();
                            items.splice(index+1, 1);
                            reload_datatable();

                            $('#modal-default-edit').modal('hide');
                        }
                    })
                }
            }





            
            $('#list-drawer tbody').on('click', '.del-data', function () {
                swal({
                    title: 'ยืนยัน?',
                    text: "คุณยืนยันจะลบข้อมูลหรือไม่ ?",
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'ยืนยัน!',
                    showLoaderOnConfirm: true
                }).then((result) => {
                    if (result.value) {
                        var data = table.row($(this).parents('tr')).data();
                         console.log(data.id_item);
                        var index = data.id_item;
                         console.log(items);

                        //  items[index] = {
                        //         //data_id: id++,
                        //         // sale_id: $('#sale_id').val(),
                        //         id_item : index,
                        //         name_product: $("#product_id").find(":selected").text(),
                        //         product_id: $("#product_id").val(),
            
                        //         attr_id: $("#attr_id").find(":selected").text(),
                        //         qty: $('#amount_edit').val(),
                        //         product_price: $('#product_price').val(),
                        //         sum: $('#amount_edit').val() * $('#product_price').val(),
                        //         all_qty: $('#amount').val() * 1 ,
                           

                        //     };


                        // remove data
                        items.splice(index, 1);
                        fnc_send();

                        reload_datatable()
                    }
                })
            });






function reload_datatable() {
  
               // clear datatable
                table.destroy();

                // create datatable
                table = $('#list-drawer').DataTable({
                    data: items,
                    columns: [{
                            data: "product_id",
                            render: function (data, type, full, meta) {
                                return meta.row + 1;
                            }
                        },
                        {
                            data: "name_product"
                        },
                        {
                            data: "attr_id"
                        },
                        {
                            data: "product_price"
                        },
                        {
                            data: "qty"
                        },
                        {
                            data: "sum"
                        },

                        {
                            defaultContent: "<button type=\"button\" class=\"btn btn-warning btn-sm edit-data\">Edit</button>&nbsp;<button type=\"button\" class=\"btn btn-danger btn-sm del-data\">Delete</button>"
                        }
                    ],
                    language: {
                        lengthMenu: "แสดง _MENU_ แถวต่อหน้า",
                        zeroRecords: "ไม่พบข้อมูล",
                        info: "กำลังแสดงหน้าที่ _PAGE_ จาก _PAGES_",
                        infoEmpty: "ไม่พข้อมูล",
                        infoFiltered: "(จากทั้งหมด _MAX_)"
                    },
                    paging: false,
                    searching: false,
                    scrollY: 250
               });
            }

            
               
</script>

<script>

$(document).ready(function () {


var data = '';
$('#btnSendAdd').click(function (event) {



    // if (!validate_fromdata("upload-form-add")) {
        var formData = new FormData($('#upload-form-add')[0]);
        console.log("test :: ",JSON.stringify(items));

console.log(formData);

        formData.append("products", JSON.stringify(items));
         for (var value of formData.values()) {
           //  console.log("data",value);
         }
        swal({
            title: 'ยืนยัน?',
            text: "ยืนยันการเพิ่มใบขาย",
            type: 'info',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'ยืนยัน!',
            showLoaderOnConfirm: true
        }).then((result) => {
          //  if (result.value) {
                //console.log(result.value);
                $.ajax({
                    type: "POST",
                    url: "function_g.php",
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function (data) {
                         console.log(data.status);
                         if(data.status==1){
                        swal('สำเร็จ',
                            'เพิ่มใบขายสินค้าสำเร็จ',
                            'success'
                        ).then((value) => {
                            // window.location = 'front-add.php?values=' + $('#sale_id').val();
                            window.location = '';
                        }); 
                    }                         
                    },
                });
           // }
        })
    // }


});
})




</script>



</body>
</html>
