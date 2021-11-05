<?php 

require '../library/connect.php';
require '../library/functions.php';
checkAdminUser($objConnect);

function pay(){
  global $objConnect;
  $sql = "SELECT * FROM mod_transection WHERE status = 1";
  $query = mysqli_query($objConnect,$sql);
  $num_rows = mysqli_num_rows($query);
  return $num_rows;
}
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title><?php echo TITLE; ?></title>
  <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />
  <link rel="shortcut icon" type="image/png" href="../img/favicon.png"/>

  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="../bower_components/bootstrap/dist/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="../bower_components/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="../bower_components/Ionicons/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../dist/css/AdminLTE.min.css">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="../dist/css/skins/_all-skins.min.css">
  <!-- jvectormap -->
  <link rel="stylesheet" href="../bower_components/jvectormap/jquery-jvectormap.css">
   <!-- Pace style -->
  <link rel="stylesheet" href="../plugins/pace/pace.min.css">

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<style>
  .bgcolor{
    background-color: #228896;
    color: white;
  }
  .textcolor{
    color:black;
  }
</style>
<script>
  function startTime() {
    var today = new Date();
    var h = today.getHours();
    var m = today.getMinutes();
    var s = today.getSeconds();
    m = checkTime(m);
    s = checkTime(s);
    document.getElementById('realtime').innerHTML =
    h + ":" + m + ":" + s;
    var t = setTimeout(startTime, 500);
  }
  function checkTime(i) {
    if (i < 10) {i = "0" + i};  // add zero in front of numbers < 10
    return i;
  }
</script>
<body class="hold-transition skin-blue fixed sidebar-mini" onload="startTime()">
    <script src="https://unpkg.com/aos@next/dist/aos.js"></script>
    <script>
      AOS.init();
    </script>

<div class="wrapper">
    <!-- Sidebar toggle button-->
    <?php require_once '../template/nav_menu.php'; ?>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                แดชบอร์ด
            </h1>
        </section>
        <!-- Main content -->
        <section class="content" style="padding-bottom: 0px;">
            <!-- Info boxes -->
            <div class="row">
                <div data-aos="fade-down-right">
                <div class="col-md-3 col-sm-6 col-xs-12">
                    <a href="../mod_article/front-manage.php">
                        <div class="info-box">
                            <span class="info-box-icon bg-green"><i class="fa fa-first-order"></i></span>

                            <div class="info-box-content">
                                <span class="info-box-text">บทความ</span>
                                <?php
                                $str = "SELECT
    article.`id_article`,
    article.`name_article`,
    article.`image`,
    article.create_datetime
FROM
    `article`
    LEFT JOIN article_catagory ON article_catagory.id_catagory=article.id_catagory
WHERE
   article.`delete_datetime` IS NULL
   AND article_catagory.name_catagory LIKE '%บทความ%'";
                                $query = mysqli_query($objConnect, $str);
                                $result = mysqli_num_rows($query);

                                ?>
                                <span class="info-box-number"><?= $result ?> รายการ</span>
                            </div>
                            <!-- /.info-box-content -->
                       
                    </a>
                  </div>
                    <!-- /.info-box -->
                  </div>
              </div>
              <div  data-aos="flip-up">
                <div class="col-md-3 col-sm-6 col-xs-12">
                  <a href="../mod_contact/front-manage.php">
                      <div class="info-box">
                          <span class="info-box-icon bg-red"><i class="fa fa-product-hunt"></i></span>

                          <div class="info-box-content">
                              <span class="info-box-text">รายการติดต่อ</span>
                              <?php
                              $str = "SELECT * FROM mod_contact WHERE 1";
                              $query = mysqli_query($objConnect, $str);
                              $result = mysqli_num_rows($query);

                              ?>
                              <span class="info-box-number"><?= $result ?> รายการ</span>
                          </div>
                          <!-- /.info-box-content -->
                      </div>
                  </a>
                  <!-- /.info-box -->
              </div>
              </div>

              <div class="col-md-3 col-sm-6 col-xs-12">
                  <div data-aos="zoom-in-right">
                  <a href="../mod_customer/front-manage.php">
                      <div class="info-box">
                          <span class="info-box-icon bg-aqua"><i class="fa fa-users"></i></span>

                          <div class="info-box-content">
                              <span class="info-box-text">จัดการสมาชิก</span>
                              <?php
                              $str = "SELECT
    CONCAT(
        mod_customer.fname,
        ' ',
        mod_customer.lname
    ) AS name_cus,
    mod_customer.telephone,
    mod_customer.email,
    mod_customer.id_customer,
    CASE `type` WHEN '1' THEN 'การแพทย์' WHEN '2' THEN 'การกีฬา'
END AS type_cus,
tbl_member.user_member
FROM
    `mod_customer`
LEFT JOIN tbl_member ON tbl_member.id_data_role = mod_customer.id_customer
WHERE
    (`delete_datetime` IS NULL OR delete_datetime IS NULL)";
    if (isset($_SESSION['parent_id']) && $_SESSION['parent_id'] != '') {
        $str .= "  AND tbl_member.`parent_id`='".$_SESSION['parent_id']."'";
}
         
                              $query = mysqli_query($objConnect, $str);
                              $result = mysqli_num_rows($query);

                              ?>
                              <span class="info-box-number"><?= $result ?> รายการ</span>
                          </div>
                          <!-- /.info-box-content -->
                      </div>
                  </a>
                  <!-- /.info-box -->
              </div>
              </div>

             




             

            </section>




            
          



          
        


        
      

                <!-- /.col -->

                <!-- fix for small devices only -->
          
          
                <!-- /.col -->
                <!-- /.col -->
          
            
                <div class="col-*-12">
                    <!-- LINE CHART -->
                    <div class="box box-info">
                        <div class="box-header with-border">
                            <h3 class="box-title">กราฟเส้น  ยอดการใช้งาน </h3>
    
                            
    
                            <div class="box-tools pull-right">
                                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                                </button>
                                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                            </div>
                        </div>
                        <div class="box-body chart-responsive">
                            <div id="myfirstchart" style="width:100%;height: 250px;"></div>
                        </div>
                        <!-- /.box-body -->
                    </div>
                    <!-- /.box -->
    
                </div>
            
            
                <!-- /.col -->
            </div>

           
     <!-- 
            <div class="col-*-12">
                
                <div class="box box-info">
                    <div class="box-header with-border">
                        <h3 class="box-title">กราฟเส้น ยอดขาย</h3>

                        <div class="box-tools pull-right">
                            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                            </button>
                            <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                        </div>
                    </div>
                    <div class="box-body chart-responsive">
                        <div id="myfirstchartorder" style="width:100%;height: 250px;"></div>
                    </div>
                    
                </div>
                

            </div> -->
            <!-- /.row -->
            <!-- Main row -->

        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
    <!-- <footer class="main-footer">
      <div class="pull-right hidden-xs">
        <b>Version</b> 2.4.0
      </div>
      <strong>Copyright &copy; 2014-2016 <a href="https://adminlte.io">Almsaeed Studio</a>.</strong> All rights
      reserved.
    </footer> -->
    <!-- Control Sidebar -->
    <!-- /.control-sidebar -->
    <!-- Add the sidebar's background. This div must be placed
         immediately after the control sidebar -->
    <div class="control-sidebar-bg"></div>
</div>
<!-- ./wrapper -->

<script src="../bower_components/jquery/dist/jquery.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="../bower_components/jquery-ui/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<!-- Bootstrap 3.3.7 -->
<script src="../bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- PACE -->
<script src="../bower_components/PACE/pace.min.js"></script>
<!-- Slimscroll -->
<script src="../bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
<!-- AdminLTE App -->
<script src="../dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="../dist/js/demo.js"></script>

<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.css">
<script src="//cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.min.js"></script>


<script type="text/javascript">
    // To make Pace works on Ajax calls
    $(document).ajaxStart(function () {
        Pace.restart()
    });

    window.onload = function() {
        var data;
        var ctx;
        var config;




    };

    $(function () {
        $.ajax({
            url: 'back/ordersum.php?pos'
        }).done(function (result) {
            data = JSON.parse(result);
            console.log(data);

            new Morris.Line({
                // ID of the element in which to draw the chart.
                element: 'myfirstchart',
                // Chart data records -- each entry in this array corresponds to a point on
                // the chart.
                data: data,
                // The name of the data record attribute that contains x-values.
                xkey: 'date',
                // A list of names of data record attributes that contain y-values.
                ykeys: ['value'],
                // Labels for the ykeys -- will be displayed when you hover over the
                // chart.
                labels: ['ยอดการใช้งาน']
            });


        });


    });
</script>
</body>
</html>

