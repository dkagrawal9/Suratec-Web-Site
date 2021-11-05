<?php
   if(!isset($_SESSION)) 
       { 
           session_start(); 
       } 
   require_once '../library/connect.php';
   require_once '../library/functions.php';
   checkAdminUser($objConnect);
   
   $title = 'Report Data';
   ?>
<!DOCTYPE html>
<html lang="en">
   <head>
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <link rel="shortcut icon" type="image/png" href="../img/favicon.png"/>
      
       <!-- start Date -->
      <link rel="stylesheet" href="../bower_components/bootstrap/dist/css/bootstrap.min.css">
      <link rel="stylesheet" media="all" type="text/css" href="jquerydatepicker/jquery-ui.css" />
      <link rel="stylesheet" media="all" type="text/css" href="jquerydatepicker/jquery-ui-timepicker-addon.css" />
      <link rel="stylesheet" href="../bower_components/bootstrap-daterangepicker/daterangepicker.css">
      <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css"/>
       <!-- End  Date -->
       

     
      <title>Report | Suratec</title>
      <!-- Bootstrap -->
      <link href="css/style.css" rel="stylesheet">     
   </head>
   <style>
   .progress-circle {
   font-size: 20px;
   margin :10px auto 15px;
   position: relative; /* so that children can be absolutely positioned */
   padding: 0;
   width: 5em;
   height: 5em;
   background-color: #1ABC9C; 
   border-radius: 50%;
   line-height: 5em;
}
@media print{
   #Suranapa_Image{
       display: block !important;
       visibility: visible !important;
       opacity: 1 !important;
       margin-bottom: -60px !important;
   }
   .mybox{
       padding-top:35px !important;
   }
   .s-peak-box1{
       margin-top:400px !important;
   }
   .s-title-big12{
       margin-top:45px !important;
   }
   .myimg-onbox{
      margin-bottom: -49px !important;
   }
   .s-title-big1{
       margin-top:50px !important;
   }
  .print-type-hinden{
    visibility: hidden !important;
    display: none !important;
    opacity: 0 !important;
  }
  .right-foot-print{
      margin-top:100px !important;
      text-align:center !important;
  }
  .s-report-user-print-size{
      margin-top:-10px;
  }
  .report-11{
      margin-top:-8px;
  }
  .two-half-width-box .s-phase-two-box .s-peak-top:first-child .s-peak-left {
    left: -5px !important;
  }
  #pr1{
     margin-left:170px !important;
  }
  #pl3{
      margin-left:12px !important;
  }
  .two-half-width-box .s-phase-two-box .s-peak-top:first-child .s-peak-base{
      left:-50px !important;
      top:190px !important;
  }
  .two-half-width-box .s-phase-two-box .s-peak-top:nth-child(2) .s-peak-base {
    top: 140px;
    right: -53px;
  }
  #pr4{
      margin-top:-75px !important;
  }
  .two-half-width-box .s-phase-two-box .s-peak-top:first-child .s-peak-bottom {
    top: 245px !important;
    left: -20px !important;
  }
  #pr5{
      margin-top:-134px !important;
  }
  .myDIV1{
    visibility: hidden !important;
    display: none !important;
    opacity: 0 !important;
  }
  .mybox{
      margin-top:13px !important;
  }
  .progess-1-new{
    background: #1ABC9C !important; 
  }
  .inside-circle1{
    background: #fff !important; 
  }
  .inside-circle1 span{
    background: #fff !important; 
  }
  .s-content-list ul{
  padding-top:40px !important;
  }
}
.progess-1-new{
    width: 150px;
    height: 150px;
    font-size: 30px;
    color: #fff;
    border-radius: 50%;
    position: relative;
    background: #1ABC9C; 
    text-align: center;
    line-height: 200px;
    margin:10px auto 15px;
}
.inside-circle1 span{
    width: 130px;
    height: 130px;
    border-radius: 50%;
    background: #fff;
    line-height: 130px;
    text-align: center;
    margin-top: 10px;
    margin-left: 10px;
    position: absolute;
    color: #000;
    display: flex;
    align-items: center;
    justify-content: center;
    z-index: 10;
}
.inside-circle1 img{
    z-index: 11;
    height: 60px;
    position: absolute;
    bottom: -17px;
    left: 0;
    right: 0;
    margin: 0 auto;
}
.circle-wrap1{
    margin: 10px auto 15px;
    width: 150px;
    height: 150px;
    background: #e6e2e7;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
}
.progress-circle:after{
    border: none;
    position: absolute;
    top: 0.35em;
    left: 0.35em;
    text-align: center;
    display: block;
    border-radius: 50%;
    width: 4.3em;
    height: 4.3em;
    background-color: white;
    content: " ";
}
/* Text inside the control */
.progress-circle span {
    position: absolute;
    line-height: 5em;
    text-align: center;
    display: block;
    color: #53777A;
    z-index: 2;
}
.left-half-clipper { 
   /* a round circle */
   border-radius: 50%;
   width: 5em;
   height: 5em;
   position: absolute; /* needed for clipping */
   clip: rect(0, 5em, 5em, 2.5em); /* clips the whole left half*/ 
}
/* when p>50, don't clip left half*/
.progress-circle.over50 .left-half-clipper {
   clip: rect(auto,auto,auto,auto);
}
.value-bar {
   /*This is an overlayed square, that is made round with the border radius,
   then it is cut to display only the left half, then rotated clockwise
   to escape the outer clipping path.*/ 
   position: absolute; /*needed for clipping*/
   clip: rect(0, 2.5em, 5em, 0);
   width: 5em;
   height: 5em;
   border-radius: 50%;
   border: 0.45em solid #53777A; /*The border is 0.35 but making it larger removes visual artifacts */
   /*background-color: #4D642D;*/ /* for debug */
   box-sizing: border-box;
  
}
/* Progress bar filling the whole right half for values above 50% */
.progress-circle.over50 .first50-bar {
   /*Progress bar for the first 50%, filling the whole right half*/
   position: absolute; /*needed for clipping*/
   clip: rect(0, 5em, 5em, 2.5em);
   background-color: #53777A;
   border-radius: 50%;
   width: 5em;
   height: 5em;
}
.progress-circle:not(.over50) .first50-bar{ display: none; }


/* Progress bar rotation position */
.progress-circle.p0 .value-bar { display: none; }
.progress-circle.p1 .value-bar { transform: rotate(4deg); }
.progress-circle.p2 .value-bar { transform: rotate(7deg); }
.progress-circle.p3 .value-bar { transform: rotate(11deg); }
.progress-circle.p4 .value-bar { transform: rotate(14deg); }
.progress-circle.p5 .value-bar { transform: rotate(18deg); }
.progress-circle.p6 .value-bar { transform: rotate(22deg); }
.progress-circle.p7 .value-bar { transform: rotate(25deg); }
.progress-circle.p8 .value-bar { transform: rotate(29deg); }
.progress-circle.p9 .value-bar { transform: rotate(32deg); }
.progress-circle.p10 .value-bar { transform: rotate(36deg); }
.progress-circle.p11 .value-bar { transform: rotate(40deg); }
.progress-circle.p12 .value-bar { transform: rotate(43deg); }
.progress-circle.p13 .value-bar { transform: rotate(47deg); }
.progress-circle.p14 .value-bar { transform: rotate(50deg); }
.progress-circle.p15 .value-bar { transform: rotate(54deg); }
.progress-circle.p16 .value-bar { transform: rotate(58deg); }
.progress-circle.p17 .value-bar { transform: rotate(61deg); }
.progress-circle.p18 .value-bar { transform: rotate(65deg); }
.progress-circle.p19 .value-bar { transform: rotate(68deg); }
.progress-circle.p20 .value-bar { transform: rotate(72deg); }
.progress-circle.p21 .value-bar { transform: rotate(76deg); }
.progress-circle.p22 .value-bar { transform: rotate(79deg); }
.progress-circle.p23 .value-bar { transform: rotate(83deg); }
.progress-circle.p24 .value-bar { transform: rotate(86deg); }
.progress-circle.p25 .value-bar { transform: rotate(90deg); }
.progress-circle.p26 .value-bar { transform: rotate(94deg); }
.progress-circle.p27 .value-bar { transform: rotate(97deg); }
.progress-circle.p28 .value-bar { transform: rotate(101deg); }
.progress-circle.p29 .value-bar { transform: rotate(104deg); }
.progress-circle.p30 .value-bar { transform: rotate(108deg); }
.progress-circle.p31 .value-bar { transform: rotate(112deg); }
.progress-circle.p32 .value-bar { transform: rotate(115deg); }
.progress-circle.p33 .value-bar { transform: rotate(119deg); }
.progress-circle.p34 .value-bar { transform: rotate(122deg); }
.progress-circle.p35 .value-bar { transform: rotate(126deg); }
.progress-circle.p36 .value-bar { transform: rotate(130deg); }
.progress-circle.p37 .value-bar { transform: rotate(133deg); }
.progress-circle.p38 .value-bar { transform: rotate(137deg); }
.progress-circle.p39 .value-bar { transform: rotate(140deg); }
.progress-circle.p40 .value-bar { transform: rotate(144deg); }
.progress-circle.p41 .value-bar { transform: rotate(148deg); }
.progress-circle.p42 .value-bar { transform: rotate(151deg); }
.progress-circle.p43 .value-bar { transform: rotate(155deg); }
.progress-circle.p44 .value-bar { transform: rotate(158deg); }
.progress-circle.p45 .value-bar { transform: rotate(162deg); }
.progress-circle.p46 .value-bar { transform: rotate(166deg); }
.progress-circle.p47 .value-bar { transform: rotate(169deg); }
.progress-circle.p48 .value-bar { transform: rotate(173deg); }
.progress-circle.p49 .value-bar { transform: rotate(176deg); }
.progress-circle.p50 .value-bar { transform: rotate(180deg); }
.progress-circle.p51 .value-bar { transform: rotate(184deg); }
.progress-circle.p52 .value-bar { transform: rotate(187deg); }
.progress-circle.p53 .value-bar { transform: rotate(191deg); }
.progress-circle.p54 .value-bar { transform: rotate(194deg); }
.progress-circle.p55 .value-bar { transform: rotate(198deg); }
.progress-circle.p56 .value-bar { transform: rotate(202deg); }
.progress-circle.p57 .value-bar { transform: rotate(205deg); }
.progress-circle.p58 .value-bar { transform: rotate(209deg); }
.progress-circle.p59 .value-bar { transform: rotate(212deg); }
.progress-circle.p60 .value-bar { transform: rotate(216deg); }
.progress-circle.p61 .value-bar { transform: rotate(220deg); }
.progress-circle.p62 .value-bar { transform: rotate(223deg); }
.progress-circle.p63 .value-bar { transform: rotate(227deg); }
.progress-circle.p64 .value-bar { transform: rotate(230deg); }
.progress-circle.p65 .value-bar { transform: rotate(234deg); }
.progress-circle.p66 .value-bar { transform: rotate(238deg); }
.progress-circle.p67 .value-bar { transform: rotate(241deg); }
.progress-circle.p68 .value-bar { transform: rotate(245deg); }
.progress-circle.p69 .value-bar { transform: rotate(248deg); }
.progress-circle.p70 .value-bar { transform: rotate(252deg); }
.progress-circle.p71 .value-bar { transform: rotate(256deg); }
.progress-circle.p72 .value-bar { transform: rotate(259deg); }
.progress-circle.p73 .value-bar { transform: rotate(263deg); }
.progress-circle.p74 .value-bar { transform: rotate(266deg); }
.progress-circle.p75 .value-bar { transform: rotate(270deg); }
.progress-circle.p76 .value-bar { transform: rotate(274deg); }
.progress-circle.p77 .value-bar { transform: rotate(277deg); }
.progress-circle.p78 .value-bar { transform: rotate(281deg); }
.progress-circle.p79 .value-bar { transform: rotate(284deg); }
.progress-circle.p80 .value-bar { transform: rotate(288deg); }
.progress-circle.p81 .value-bar { transform: rotate(292deg); }
.progress-circle.p82 .value-bar { transform: rotate(295deg); }
.progress-circle.p83 .value-bar { transform: rotate(299deg); }
.progress-circle.p84 .value-bar { transform: rotate(302deg); }
.progress-circle.p85 .value-bar { transform: rotate(306deg); }
.progress-circle.p86 .value-bar { transform: rotate(310deg); }
.progress-circle.p87 .value-bar { transform: rotate(313deg); }
.progress-circle.p88 .value-bar { transform: rotate(317deg); }
.progress-circle.p89 .value-bar { transform: rotate(320deg); }
.progress-circle.p90 .value-bar { transform: rotate(324deg); }
.progress-circle.p91 .value-bar { transform: rotate(328deg); }
.progress-circle.p92 .value-bar { transform: rotate(331deg); }
.progress-circle.p93 .value-bar { transform: rotate(335deg); }
.progress-circle.p94 .value-bar { transform: rotate(338deg); }
.progress-circle.p95 .value-bar { transform: rotate(342deg); }
.progress-circle.p96 .value-bar { transform: rotate(346deg); }
.progress-circle.p97 .value-bar { transform: rotate(349deg); }
.progress-circle.p98 .value-bar { transform: rotate(353deg); }
.progress-circle.p99 .value-bar { transform: rotate(356deg); }
.progress-circle.p100 .value-bar { transform: rotate(360deg); }
      .insideWrapper {
      width:100%;
      height:100%;
      position:relative;
      }
      .coveredImage {
    
      position:absolute;
      top:0px;
      left:0px;
      }
      .red{
    color: red;
    font-weight: bolder;
    text-shadow: 1px 1px;
    }
    .green{
    color: green;
    font-weight: bolder;
    text-shadow: 1px 1px;
    }
    .yellow{
    color: yellow;
    font-weight: bolder;
    text-shadow: 1px 1px;
    }
      .coveringCanvas {
      width:100%;
      height:100%;
      position:absolute;
      top:0px;
      left:0px;
      }
      .ui-state-default, .ui-widget-content .ui-state-default, .ui-widget-header .ui-state-default {
      background: #00efb8 !important;
      }
      .ui-state-active, .ui-widget-content .ui-state-active, .ui-widget-header .ui-state-active {
      background: #ffffff !important;
      border: solid 1px #00efb8 !important;
      }
      .btn {
      border: none;
      outline: none;
      padding: 10px 16px;
      background-color: #f1f1f1;
      cursor: pointer;
      font-size: 16px;
    }
    
    /* Style the active class, and buttons on mouse-over */
    .active, .btn:hover {
      background-color: #1a73e8;
      color: white;
    }
   </style>
   <?php
      $id_user = $_SESSION["id_employee"];
      $playback_type = '';
      $sql_type = "SELECT role.role_name FROM `mod_employee`
      LEFT JOIN role ON role.role_id=mod_employee.role_id WHERE mod_employee.id_employee ='".$id_user."' ";
      $query_type = mysqli_query($objConnect,$sql_type);
      $result_type = mysqli_fetch_array($query_type,MYSQLI_ASSOC);
      
      $disable_type = "";
      if ($result_type["role_name"]=='Doctor' ) {
        $disable_type = "disabled";
        $playback_type = '1';
      }else if ($result_type["role_name"]=='Coach') {
        $disable_type = "disabled";
        $playback_type = '2';
      }
      if (isset($_GET['id_customer'])) {
            $id_customer = $_GET['id_customer'];
          }else{
            $id_customer = '';
          }
           $userData = "SELECT * FROM `mod_customer` WHERE `id_customer` = '".$id_customer."' AND (`delete_datetime` IS NULL OR delete_datetime IS NULL)";
           $query_type = mysqli_query($objConnect,$userData);
          while ($userDataRec = mysqli_fetch_array($query_type)) {
            $fname =  $userDataRec['fname'];
              $email =  $userDataRec['email'];
              $age =  $userDataRec['age'];
              $weight =  $userDataRec['weight'];
              $height =  $userDataRec['height'];
              $create_datetime =  $userDataRec['create_datetime'];
              $img_path =  $userDataRec['img_path'];
              $sex =  ($userDataRec['sex']==0)?'Male':'FeMale';
              
        }
           $surapodaData = "SELECT * FROM `surapodo` WHERE `user_id` = '".$id_customer."'";
           $query_type1 = mysqli_query($objConnect,$surapodaData);
           $surapodaData1 = "SELECT * FROM `surapodo` WHERE `user_id` = '".$id_customer."'";
           $query_type11 = mysqli_query($objConnect,$surapodaData1);
           $filedata = [];
           $x = [];
           $y = [];
           $z = [];
           $a = [];
           $b = [];
           $xx = [];
           $yy = [];
           $zz = [];
           $aa = [];
           $bb = [];

           $in=0;
           while ($suraPodaDataRec1 = mysqli_fetch_array($query_type11)) {
            //$filedata[date('d-m-Y',strtotime($suraPodaDataRec1['created_at']))]['x']=date('d-m-Y',strtotime($suraPodaDataRec1['created_at']));
            //$filedata[date('d-m-Y',strtotime($suraPodaDataRec1['created_at']))]['y']=$suraPodaDataRec1['left_fr_ratio'];
            //$filedata[date('d-m-Y',strtotime($suraPodaDataRec1['created_at']))]['z']=$suraPodaDataRec1['right_fr_ratio'];
            $x[date('d-m-Y',strtotime($suraPodaDataRec1['created_at']))]= date('d-m-Y',strtotime($suraPodaDataRec1['created_at']));
            $y[date('d-m-Y',strtotime($suraPodaDataRec1['created_at']))]= $suraPodaDataRec1['left_fr_ratio'];
            $z[date('d-m-Y',strtotime($suraPodaDataRec1['created_at']))]= $suraPodaDataRec1['right_fr_ratio'];
            $a[date('d-m-Y',strtotime($suraPodaDataRec1['created_at']))]= $suraPodaDataRec1['left_peak_pressure'];
            $b[date('d-m-Y',strtotime($suraPodaDataRec1['created_at']))]= $suraPodaDataRec1['right_peak_pressure'];
            $in++;
           }
           foreach($x as $x1){
            $xx[]= $x1;
          }
           foreach($y as $y1){
            $yy[]= floatval($y1);
           }
          foreach($z as $z1){
            $zz[]= floatval($z1);
          }
          foreach($a as $a1){
            $aa[]= floatval($a1);
           }
          foreach($b as $b1){
            $bb[]= floatval($b1);
          }
          
           //$newfiledata = json_encode($filedata);
           $newfiledata_x = json_encode($xx);
           $newfiledata_y = json_encode($yy);
           $newfiledata_z = json_encode($zz);
           $newfiledata_a = json_encode($aa);
           $newfiledata_b = json_encode($bb);
          if (isset($_POST['playback_type'])) {
            $playback_type = $_POST['playback_type'];
          }else{
            $playback_type = $playback_type;
          }
      
          if (isset($_POST['datetimepicker'])) {
            $datetimepicker = $_POST['datetimepicker'];
          }else{
            $datetimepicker = '';
          }
          if (isset($_POST['playback_time'])) {
            $playback_time = $_POST['playback_time'];             
          }else{
            $playback_time = '';
          }
          if (isset($_POST['status_play'])) {
            $status_play = $_POST['status_play'];
          }else{
            $status_play = '';
          }
          if (isset($_POST['upload_csv'])) {
            $upload_csv = $_POST['upload_csv'];
          }else{
            $upload_csv = '';
          }
          $str_photo = "";
        if(isset($_FILES['upload_csv'])) { $str_photo = trim($_FILES['upload_csv']['name']); }
      ?>
   <body>
      <div id="s-wrapper" class="s-wrapper">
         <main class="s-main-page s-bg-primary">
            <div class="s-rightbar">
               <div class="s-dashboard">
                  <image id="Suranapa_Image" data-name="Suranapa Image" width="10%"  src="https://www.suratec.co.th/admin/mod_playback/images/reportLogo.jpeg">
                 
                  <div class="s-inner-dashboard">
                     <div class="s-report s-br-16 s-bg-primary s-p20">
                        <div class="s-fill-report">
                           <h4 class="s-main-title text-white">
                              <font style="vertical-align: inherit;"><font style="vertical-align: inherit;">
                              Fill in the report
                              </font></font>
                           </h4>
                           <div class="s-form-row s-d-flex">
                              <div class="s-form-control">
                                 <label>User type</label>
                                 <select class="s-select s-common-btn" <?php echo $disable_type ?> name="playback_type" id='playback_type' onchange="playback_time_func()">
                                    <option value="0">Select Playback</option>
                                    <option <?php
                                          if ($playback_type == '1') {
                                                echo "selected";
                                             }
                                             ?> value="1">การแพทย์</option>
                                                <option  <?php
                                                      if ($playback_type == '2') {
                                                        echo "selected";
                                                      }
                                                      ?>
                                                   value="2">การกีฬา
                                             </option>
                                 </select>
                              </div>
                              <div class="s-form-control">
                                 <label>Date</label>
                                   <input type='text' class="s-calendar s-common-btn" name="datetimepicker" id='datetimepicker' autocomplete="off" onchange="playback_time_func()" value="<?php echo $datetimepicker ?>"/>                                 
                              </div>
                              <div class="s-form-control">
                                 <label>Time</label>
                                 <SELECT class="s-select s-common-btn" name="playback_time" id='playback_time'>
                                    <option value="0">เวลา Playback</option>
                                 </SELECT>                                 
                              </div>
                              <div class="s-form-control">
                                 <label>SuraPodo Data</label>
                                 <SELECT class="s-select s-common-btn" name="chappal_csv_dropdown" id='chappal_csv_dropdown'>
                                    <option value="0" selected>Select Surapodo</option>
                                    <?php
                                    while ($suraPodaDataRec = mysqli_fetch_array($query_type1)) {
                                        ?>
                                        <option value="<?=$suraPodaDataRec['upload_file_name']?>" data-arch="<?=$suraPodaDataRec['left_arch_index']?>" data-surapodo_id="<?=$suraPodaDataRec['id']?>" <?=($upload_csv == $suraPodaDataRec['upload_file_name'])?'selected':''?>><?=date('d-m-Y',strtotime($suraPodaDataRec['created_at']))?><?=' ('?><?=$suraPodaDataRec['file_name']?><?=')'?></option>                                        
                                        <?php
                                    }
                                    ?>
                                 </SELECT>                                 
                              </div>
                              <div class="s-form-control">
                                 <label>GAIT Distance (meter)</label>
                                 <input type="number" id="gait_distance" class="s-common-btn" min="0" max="99" placeholder="GAIT Distance">                                 
                              </div>
                              <div class="s-form-control">
                                    <input id="print_button" type="button" onclick="window.print()" class="s-download s-common-btn" value="Download report ">
                                    <input type="button" onclick="function_play()"  class="s-report s-common-btn search_date" value="Display report">                               
                                    <!-- <input type="button" onclick="delete_file()"  class="s-report s-common-btn search_date" value="Delete File">                                -->
                              </div>
                           </div>
                        </div>
                        <form action="csvUpload.php" id="csvUploadForm" method="post" enctype="multipart/form-data">
                                <div class="s-form-control">
                                 <label class="print-type-hinden">Upload SuraPodo Data</label>
                                 <div class="s-upload-btn-wrapper">
                                    <button class="s-btn print-type-hinden">
                                        <font style="vertical-align: inherit;"><font style="vertical-align: inherit;" id="filenameis">select file</font></font></button>
                                    <span id="file_error"></span>
                                    <input  type="file" name="upload_chappal_csv" id="upload_chappal_csv" class="fillup">
                                    <input  type="hidden" id="left_arch_index" name="left_arch_index" value="0">
                                    <input type="hidden"  name="user_id" value="<?=$id_customer?>">
                                    <input  type="hidden" id="right_arch_index" name="right_arch_index" value="0">
                                    <input  type="hidden" id="left_fr_ratio" name="left_fr_ratio" value="0">
                                    <input  type="hidden" id="right_fr_ratio" name="right_fr_ratio" value="0">
                                    <input  type="hidden" id="left_foot_type" name="left_foot_type" value="0">
                                    <input  type="hidden" id="right_foot_type" name="right_foot_type" value="0">
                                    <input  type="hidden" id="left_peak_pressure" name="left_peaK_pressure" value="0">
                                    <input  type="hidden" id="right_peak_pressure" name="right_peak_pressure" value="0">
                                    <input  type="hidden" id="left_peak_zone" name="left_peak_zone" value="0">
                                    <input  type="hidden" id="right_peak_zone" name="right_peak_zone" value="0">
                                 </div>
                              </div>
                            </form>
                        <p class="s-note text-color"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">*All fields should be filled in before clicking the Show Report button.</font></font></p>
                     </div>
                     <div class="s-report s-br-16" style="margin-top:3px">
                        <div class="bg-dark-color">
                           <img src="images/bg-gray-dark.jpg" alt="bg-color" />
                        </div>
                        <div class="s-report-wrap s-d-flex">
                           <div class="s-report-list">
                              <h2 class="s-title text-white report-11">รายงานข้อมูลของ</h2>
                              <div class="s-report-user s-report-user-print-size">
                              <?php 
                                 if($img_path == null || $img_path == ''){
                                    ?>
                                    <img src="images/noimage.png"  alt="profile"/>
                                 <?php 
                                 }else{
                                    ?>
                                    <img src="https://api1.suratec.co.th/pic/<?=$img_path?>" alt="profile"/>
                                 <?php 
                                 }
                              ?>
                                 
                              </div>
                           </div>
                           <div class="s-report-name">
                              <h3 class="s-title text-white">
                              <?=$fname?>
                              </h3>
                              <ul>
                                 <li>
                                    <p>Height <span><?=$height?> ซม.</span></p>
                                 </li>
                                 <li>
                                    <p>Age <span><?=$age?> ปี</span></p>
                                 </li>
                                 <li>
                                    <p>Weight <span><?=$weight?> กก.</span></p>
                                 </li>                                 
                                 <li>
                                    <p>Gender <span><?=$sex?></span></p>
                                 </li>                                 
                              </ul>
                           </div>
                           <div class="s-report-date">
                              <ul>
                                 <li>
                                    <p>Used since <span><?=date('d-m-Y',strtotime($create_datetime))?></span></p>
                                 </li>
                              </ul>
                           </div>
                        </div>
                     </div>
                  </div>
                  <div class="s-box-shadow s-br-16 bg-secondary s-p20 s-statistic-box">
                     <h5 class="s-title-big">
                        Static Data Analysis
                     </h5>
                     <img src="images/pd.png" alt="bg-green" class="d-block mx-auto myclass-mt-0"/>
                     <div class="s-box-wrapper">
                        <div class="s-box-item">
                           <div class="btn-wrap">
                              <a href="#" class="s-btn s-green">
                              <img src="images/left foot.png" alt="bg-green" />
                              </a>
                           </div>
                           <div class="s-chart s-cricle s-circle-border-green">
                           <img id="ft1" src="https://www.suratec.co.th/admin/mod_playback/images/N1.png" alt="Left-foot">
                           </div>
                           <div class="s-content text-center">
                              <h6><span id = "tft1">NORMAL</span></h6>
                              <p class="text-green">Arch Index<span id="ai1">0.00</span></p>
                              <p class="text-green">F/R Ratio<span id="fr1">0.00</span></p>
                              <p class="text-green">Foot Length<span id="lfl">0.00 cm</span></p>
                              <p class="text-green">Foot Width<span id="lfw">0.00 cm</span></p>
                           </div>
                        </div>
                        <div class="s-box-item" style="margin: -20px;">
                           <div class="s-graph">
                           <div class="chappalNodata" style="border: 1px solid;padding: 70px;">
                                <h3 style="text-align: center;">No Data Found</h3>
                            </div>
                            <div id="contour_div"></div>
                            <canvas id="chappal_chart" style="margin-bottom: -135px;"></canvas>
                            <img src="img/foottype.jpeg"  style="height: 150px; width: auto;margin: 0 auto;display: block;"/>
            
                            <div class="chappalYesData length-width">
                            </div>
                             
                           </div>
                        </div>
                        <div class="s-box-item">
                           <div class="btn-wrap">
                              <a href="#" class="s-btn s-blue">
                              <img src="images/right foot.png" alt="bg-blue" />
                              </a>
                           </div>
                           <div class="s-chart s-cricle s-circle-border-blue">
                           <img id="ft2" src="https://www.suratec.co.th/admin/mod_playback/images/N2.png" alt="Right-foot">
                           </div>
                           <div class="s-content text-center">
                              <h6><span id = "tft2">NORMAL</span></h6>
                              <p>Arch Index<span id="ai2">0.00</span></p>
                              <p>F/R Ratio<span id="fr2">0.00</span></p>
                              <p>Foot Length<span id="rfl">0.00 cm</span></p>
                              <p>Foot Width<span id="rfw">0.00 cm</span></p>
                           </div>
                        </div>
                     </div>
                                </div>
                     <div class="s-box-shadow s-br-16 bg-secondary s-p20 s-statistic-box">
                     <h5 class="s-title-big s-title-big1">
                        Surapodo Progress Chart
                     </h5>
                     <div id="myDIV" class="myDIV1">
                     <button class="btn btn1" onclick="changeData1()">F/R Ratio</button>
                     <button class="btn btn2" onclick="changeData2()">Peak Pressure</button>
                    </div>
                     <div class="chart-container print-size-grapg" style="position: relative; height:400px;">
                           <canvas id="chart-0"></canvas>
                    </div>
                                </div>
                  <div class="s-box-shadow s-br-16 bg-secondary s-p20 s-phase-box two-half-width-box s-box-shadow-print">
                     <h5 class="s-title-big s-title-big1">
                     Injury Risk Analysis at Different Foot Zones
                     </h5>
                     <div class="s-phase-two-box">
                        <div class="s-phase-item">
                           <img src="images/2.png" alt="peak" />
                        </div>
                        <div class="s-phase-item">
							<div class="s-peak-div">
								<div class="s-peak-img">
									<img src="images/lag1.png" alt="peak" /> 
								</div>	
                                <div class="s-peak-wrap">
                                    <div class="s-peak-top">
                                        <p class="s-peak-left"><span id="pl1" class="green">1</span></p>
                                        <ul class="s-peak-middle">
                                            <li><span id="pl2" class="green">2</span></li>
                                            <li><span id="pl3" class="green">3</span></li>
                                        </ul>
                                        <p class="s-peak-base"><span id="pl4" class="green">4</span></p>
                                        <p class="s-peak-bottom"><span id="pl5" class="green">5</span></p>
                                    </div>
                                    <div class="s-peak-top">
                                        <p class="s-peak-left"><span id="pr1" class="green">6</span></p>
                                        <ul class="s-peak-middle">
                                            <li><span id="pr2" class="green">7</span></li>
                                            <li><span id="pr3" class="green">8</span></li>
                                        </ul>
                                        <p class="s-peak-base"><span id="pr4" class="green">9</span></p>
                                        <p class="s-peak-bottom"><span id="pr5" class="green">10</span></p>
                                    </div>
                                </div>
							</div>
                        </div>
                     </div>
                  </div>
                  <div class="s-box-shadow s-br-16 bg-secondary s-p20 s-dynamic-box" >
                     <h5 class="s-title-big">
                        Dynamic Data Analysis
                     </h5>
                     <div class="s-content-list">
                        <img src="images/border-img.png" class="img-tag" />
                        <ul>
                                 <li>
                                    <p><span  id="ws">0</span><span>Cadence <br/> (steps/min)</span></p>
                                </li>
                                <li>
                                <p><span id="sc">0</span><span>Step count <br/> (steps)</span></p>
                                </li>
                                <li>
                                <p><span id="gs">NA</span><span>GAIT speed<br/> (m/s)</span></p>
                                </li>
                        
                        </ul>
                     </div>
                     <div class="s-box-wrapper">
                        <div class="s-box-item">
                           <a href="#" class="common-btn">
                           <img src="images/left balance.png" />
                           </a>
                           <canvas id="balance_left" width="300px"  height="300px" style="margin: 0 auto;"></canvas>
                           <div class="s-content text-center">
                              <p>Stance Time<span id="lst">0 Sec</span></p>
                              <p>Swing Time<span id="lsw">0 Sec</span></p>
                              
                           </div>
                        </div>
                        <div class="s-box-item">
                           <a href="#" class="common-btn">
                           <img src="images/cop.png" />
                           </a>
                           <canvas id="cop" width="300px" height="300px" style="margin: 0 auto;"></canvas>
                           <div class="s-content text-center">
                              <p>Cycle Time<span id="gst">0 Sec</span></p>
                           </div>
                        </div>
                        <div class="s-box-item">
                           <a href="#" class="common-btn">
                           <img src="images/right balance.png" />
                           </a>
                           <canvas id="balance_right" width="300px"  height="300px" style="margin: 0 auto;"></canvas>
                           <div class="s-content text-center">
                              <p>Stance Time<span id="rst">0 Sec</span></p>
                              <p>Swing Time<span id="rsw">0 Sec</span></p>
                              
                           </div>
                        </div>
                     </div>
                  </div>
                  <div class="s-box-shadow s-br-16 bg-secondary s-p20 s-phase-box">
                     <h5 class="s-title-big s-title-big12">
                        Gait Cycle Analysis
                     </h5>
                     <div class="s-phase-two-box">
                        <div class="s-phase-item">
                           <p class="s-phase-title">Left Side</p>
                           <!-- <ul class="s-phase-left s-phase-common">
                              <li><p>Stance phase</p> <span>Swing phase</span></li>
                              </ul> -->
                           <img src="images/left phase.png" alt="left-side" class="img-tag" />
                          
                           <ul class="s-phase-name s-ul first">
                              <li><span id="l1t">0s</span></li>
                              <li><span id="l2t">0s</span></li>
                              <li class="my_sm_box"><span id="l3t">0s</span></li>
                              <li class="my_lg_box"><span id="l4t">0s</span></li>
                           
                           </ul>
                           <ul class="s-phase-name s-ul first">
                              <li><span id="l1p">0%</span></li>
                              <li><span id="l2p">0%</span></li>
                              <li class="my_sm_box"><span id="l3p">0%</span></li>
                              <li class="my_lg_box"><span id="l4p">0%</span></li>
                              
                           </ul>
                        </div>
                        <div class="s-phase-item">
                           <p class="s-phase-title">Right Side</p>
                           <!-- <ul class="s-phase-right s-phase-common">
                              <li><p>Stance phase</p> <span>Swing phase</span></li>
                              </ul> -->
                           <img src="images/right phase.png" alt="right-side" class="img-tag" />
                           
                           <ul class="s-phase-name s-ul first">
                              <li><span id="r1t">0s</span></li>
                              <li><span id="r2t">0s</span></li>
                              <li class="my_sm_box"><span id="r3t">0s</span></li>
                              <li class="my_lg_box"><span id="r4t">0s</span></li>
                        
                           </ul>
                           <ul class="s-phase-name s-ul first">
                              <li><span id="r1p">0%</span></li>
                              <li><span id="r2p">0%</span></li>
                              <li class="my_sm_box"><span id="r3p">0%</span></li>
                              <li class="my_lg_box"><span id="r4p">0%</span></li>
                          
                           </ul>
                        </div>
                     </div>
                  </div>
                 <!-- <div class="page-brack"></div> -->
                  <div class="s-box-shadow s-br-16 bg-secondary s-p20 s-gait-box s-gait-box1 " style="">
                     <h5 class="s-title-big s-gait-box2">
                        Gait Pattern
                     </h5>
           
                     <h4 style="text-align: center; font-weight: bold;">Left Foot</h4>
                     <div class="tab-contents ">
                         <img src="images/pti_left1.png" alt="right-side" class="img-tag d-block mx-auto myimg-onbox" />

                         <div class="wrap-circle mybox s-gait-box3" >
                        <div id="pc1" class="progress-circle p0 progess-1-new">
                            <div class="inside-circle1">
                               <span id="FL">0%</span>
                               <img src="img/fore_foot.png">
                            </div>
                            <div class="left-half-clipper">
                            <div class="first50-bar"></div>
                             <div class="value-bar"></div>
                         </div>
                         </div>
                         <div id="pc2" class="progress-circle p0 progess-1-new">
                           <div class="inside-circle1">
                              <span id="ML">0%</span>
                              <img src="img/mid_foot.png">
                          </div>   
                         
                            <div class="left-half-clipper">
                            <div class="first50-bar"></div>
                             <div class="value-bar"></div>
                         </div>
                         </div>
                         <div id="pc3" class="progress-circle p0 progess-1-new">
                         <div class="inside-circle1">
                             <span id="HL">0%</span>
                             <img src="img/heel.png">
                        </div> 
                            <div class="left-half-clipper">
                            <div class="first50-bar"></div>
                             <div class="value-bar"></div>
                             
                         </div>
                         </div>
                         <!--
                           <div class="circle-wrap">
                              <div class="circle">
                                 <div class="mask full">
                                    <div class="fill"></div>
                                 </div>
                                 <div class="mask half">
                                    <div class="fill"></div>
                                 </div>
                                 <div class="inside-circle">
                                    <span id="FL">0%</span>
                                    <img src="img/fore_foot.png">
                                 </div>
                              </div>
                           </div>
                           <div class="circle-wrap">
                              <div class="circle">
                                 <div class="mask full">
                                    <div class="fill"></div>
                                 </div>
                                 <div class="mask half">
                                    <div class="fill"></div>
                                 </div>
                                 <div class="inside-circle">
                                     <span id="ML">0%</span>
                                    <img src="img/mid_foot.png">
                                 </div>
                              </div>
                           </div>
                           <div class="circle-wrap">
                              <div class="circle">
                                 <div class="mask full">
                                    <div class="fill"></div>
                                 </div>
                                 <div class="mask half">
                                    <div class="fill"></div>
                                 </div>
                                 <div class="inside-circle">
                                    <span id="HL">0%</span>
                                    <img src="img/heel.png">
                                 </div>
                              </div>
                           </div>-->
                        </div> 
                        <div class="chart-container" style="position: relative; height:400px;">
                           <canvas id="gait_left"></canvas>
                        </div>
                         <br><br> 
                         
                         <h4 style="text-align: center; font-weight: bold;" class="right-foot-print">Right Foot</h4>
                        <img src="images/pti_right1.png" alt="right-side" class="img-tag d-block mx-auto myimg-onbox" />
                        <div class="wrap-circle mybox" style="margin-top: 15px;">
                        <div id="pc4"class="progress-circle p0 progess-1-new">
                        <div class="inside-circle1">
                           <span id="FR">0%</span>
                           <img src="img/fore_foot.png">
                       </div>   
                            <div class="left-half-clipper">
                            <div class="first50-bar"></div>
                             <div class="value-bar"></div>
                         </div>
                         </div>
                         <div id="pc5"class="progress-circle p0 progess-1-new">
                         <div class="inside-circle1">
                           <span id="MR">0%</span>
                           <img src="img/mid_foot.png">
                        </div>  
                            <div class="left-half-clipper">
                            <div class="first50-bar"></div>
                             <div class="value-bar"></div>
                         </div>
                         </div>
                         <div id="pc6"class="progress-circle p0 progess-1-new">
                         <div class="inside-circle1">   
                           <span id="HR">0%</span>
                           <img src="img/heel.png">
                        </div>  
                            <div class="left-half-clipper">
                            <div class="first50-bar"></div>
                             <div class="value-bar"></div>
                         </div>
                         </div>
                        </div>

                        <div class="chart-container" style="position: relative; height:400px;">
                           <canvas id="gait_right"></canvas>
                        </div>
                     </div>
                  </div>
                  <div class="s-box-shadow s-br-16 bg-secondary s-p20 s-peak-box s-peak-box1">
                     <h5 class="s-title-big">
                       Risk of Ulcer References
                     </h5>
                    <div class="ulcerParagrapha">
                    <b>References:-<b><br>
                        <ol>
                            <li>
                            Fawzy OA, Arafa AI, El Wakeel MA, et al. “Plantar pressure as a risk assessment tool for diabetic foot ulceration in Egyptian patients with diabetes.” Clin Med Insights Endocrinol Diabetes 2014.
                            </li>
                            <li>
                            “The forefoot-to-rearfoot plantar pressure ratio is increased in severe diabetic neuropathy and can predict foot ulceration.” Caselli A, Pham H, Giurini JM, Armstrong DG, Veves A. Diabetes Care. 2002 Jun;25(6):1066-71.
                            </li>
                            <li>
                            Bus, S. A., Maas, M., de Lange, A., Michels, R. P., & Levi, M. (2005). “Elevated plantar pressures in neuropathic diabetic patients with claw/hammer toe deformity.” Journal of biomechanics, 38(9), 1918–1925.
                            </li>
                            <li>
                            Mueller, Michael J et al. “Plantar stresses on the neuropathic foot during barefoot walking.” Physical therapy vol. 88,11 (2008): 1375-84. doi:10.2522/ptj.20080011.
                            </li>
                        </ol>                    
                  </div>               
                  </div>
               </div>
            </div>
         </main>
      </div>
      <input type="hidden" name="per_button_edit" id="per_button_edit" value="<?php echo $button_edit ?>">
      <input type="hidden" name="per_button_del" id="per_button_del" value="<?php echo $button_del ?>">
      <input type="hidden" name="per_button_open" id="per_button_open" value="<?php echo $button_open ?>">
      <input type="hidden" name="per_input_read" id="per_input_read" value="<?php echo $input_read ?>">
      <input type="hidden" name="id_customer" id="id_customer" value="<?php echo $id_customer ?>">
      <input type="hidden" name="get_time" id="get_time" value="<?php echo $playback_time ?>">
      <input type="hidden" name="status_play" id="status_play" value="<?php echo $status_play?>">
      <input type="hidden" name="upload_csv" id="upload_csv" value="<?php echo $upload_csv?>">
      <form id="form-del">
      <input type="hidden" name="_method" value="DELETE">
      <input type="hidden" name="id_customer" value id="form-del-cus">
      </form>
      <script src="report_js/jquery.min.js"></script>
      <script type="text/javascript" src="jquerydatepicker/jquery-ui.min.js"></script>
      
      <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.22.2/moment.min.js"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.3/Chart.min.js"></script>
      <script src="http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.4.0/Chart.bundle.js"></script>
      <script src ="https://cdn.jsdelivr.net/npm/chart.js@2.9.3/dist/Chart.min.js"></script>
      <script src="https://cdn.plot.ly/plotly-latest.min.js"></script>
      <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
      <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>      
      <script type="text/javascript" src="js/jquery.redirect.js"></script>
      
      <!-- Include all compiled plugins (below), or include individual files as needed -->
      <script src="report_js/custom.js"></script>   
      <script>      
      <?php
         $sql_date = "SELECT DATE_FORMAT(`action`, '%Y-%m-%d') AS date_action FROM `surasole` WHERE `id_customer` = '".$id_customer."' GROUP BY DATE_FORMAT(`action`, '%Y-%m-%d') ";
         $invalid_date = array();
         $query_date = mysqli_query($objConnect, $sql_date);
         while ($result_date = mysqli_fetch_array($query_date)) {
           $date_part = substr($result_date['date_action'], 0, 10);
           list($year, $month, $day) = explode('-', $date_part);
           $invalid_date[] = $year . '-' .$month . '-' . $day;
         }
         ?>
      /* ******************File Upload End************************ */
      var invalidDate = <?php echo json_encode($invalid_date); ?>;
         function beforeShowDay(date) {
            var date = new Date(date),
             mnth = ("0" + (date.getMonth() + 1)).slice(-2),
             day = ("0" + date.getDate()).slice(-2);
           var searchDate = date.getFullYear() + '-' +mnth + '-' + day;
           // indexOf() จะให้ค่า -1 หากไม่มีค่าที่ตรวจสอบอยู่ใน Array
           if (invalidDate.indexOf(searchDate) === -1) {
             // บอก Datepicker ว่า วันที่นี้สามารถเลือกได้
             
             return [false, "", ""];
           }
           
           
           return [true, "", ""];
         }

         function myStopFunction() {
         
         if(typeof(setleft) != "undefined" && setleft !== null) {
         clearInterval(setleft);
         clearInterval(setright);
         }
       
       }
         $(function () {
          $('#datetimepicker').datepicker({
              todayBtn: "linked",
              language: "it",
              autoclose: true,
              todayHighlight: true,
              format: 'yyyy-mm-dd'
              
          });
               });
        var newfiledata_x = '<?=$newfiledata_x?>';
        var newfiledata_y = '<?=$newfiledata_y?>';
        var newfiledata_z = '<?=$newfiledata_z?>';
        var newfiledata_a = '<?=$newfiledata_a?>';
        var newfiledata_b = '<?=$newfiledata_b?>';
        var newfiledata_xx = JSON.parse(newfiledata_x);
        var newfiledata_yy = JSON.parse(newfiledata_y);
        var newfiledata_zz = JSON.parse(newfiledata_z);
        var newfiledata_aa = JSON.parse(newfiledata_a);
        var newfiledata_bb = JSON.parse(newfiledata_b);
        const demo_x = [];
        const demo_y = [];
        const demo_z = [];
        const demo_a = [];
        const demo_b = [];

        newfiledata_xx.forEach(function(row1, x_i) {
            demo_x.push(row1);
        });
        newfiledata_yy.forEach(function(row2, y_i) {
            demo_y.push(row2);
        });
       
        newfiledata_zz.forEach(function(row3, z_i) {
            demo_z.push(row3);
        });
        newfiledata_aa.forEach(function(row4, a_i) {
            demo_a.push(row4);
        });
       
        newfiledata_bb.forEach(function(row5, b_i) {
            demo_b.push(row5);
        });
       
       function playback_time_func(){
         id_customer =  $("#id_customer").val();  
         playback_type =  $("#playback_type").val();  
         datetimepicker =  $("#datetimepicker").val();
         get_time =  $("#get_time").val();
       
       if (id_customer != '' && playback_type != '0' && datetimepicker!= '') {
          $.ajax({   
                   url:'report_test_time.php?id_customer='+id_customer, 
                   method:'POST',  
                   data:{id_customer:id_customer, playback_type:playback_type, datetimepicker:datetimepicker,get_time:get_time},  
                       success:function(data){ 
                      
                       $("#playback_time").html(data); 
                       status_play =  $("#status_play").val();  
                       if (status_play=='1') {
                      //    search_date();
                       }
       
                       }, 
       
                          
                  });
            }        
       } 
            /* ******************File Upload start************************ */
    
            $("#upload_chappal_csv").change(function() {
                id_customer =  $("#id_customer").val();  
                filename =  this.files[0].name;  
                filesize =  this.files[0].size / 1024;  
        
                var fileExtension = filename.substring(filename.lastIndexOf('.') + 1); 
                if(!(fileExtension == "csv")){
                    alert("Invalid Extension, Please Upload in CSV Format Only");
                    return false;
                }
                if(filesize > 5120){
                    alert("File is too big, Maximum Allowed Size is 5MB");
                    return false;
                }
                
                $.ajax({   
                   url:'csvUploadOrNot.php', 
                   method:'POST',  
                   data:{user_id:id_customer,filename:filename},  
                       success:function(data){ 
                            if (data==1) {
                                readURLcsvUpdate(this);    

                            }else{
                                alert(['This file already Uploaded. Please check'])
                            }       
                       }, 
                  });
            });
            

        async function readURLcsvUpdate(input) {  
            if(Validate(input)){
                if (input.files && input.files[0]) {
                    var reader = new FileReader();
                    reader.readAsDataURL(input.files[0]); // convert to base64 string
                    
                }
                $( "#csvUploadForm" ).submit();
            }
        }

      $("#chappal_csv").change(function() {
            readURL(this);
        });
        function readURL(input) {
            if(Validate(input)){
                if (input.files && input.files[0]) {
                    var reader = new FileReader();
                    reader.onload = function(e) {
                    chappalGraph(e.target.result)
                    if(e.target.result != localStorage.getItem('chappal_key') && localStorage.getItem('chappal_key') !=''){
                            location.reload();
                        }
                }

                reader.readAsDataURL(input.files[0]); // convert to base64 string
                }
            }
        }
        var sFileName  = '';
        var _validFileExtensions = [".csv"];    
                function Validate(oForm) {                  
                    var arrInputs = oForm;
                        var oInput = arrInputs;
                        if (oInput.type == "file") {
                            var sFileName = oInput.value;
                            if (sFileName.length > 0) {
                                var blnValid = false;
                                for (var j = 0; j < _validFileExtensions.length; j++) {
                                    var sCurExtension = _validFileExtensions[j];
                                    if (sFileName.substr(sFileName.length - sCurExtension.length, sCurExtension.length).toLowerCase() == sCurExtension.toLowerCase()) {
                                        blnValid = true;
                                        $('#chappal_chart').show();
                                        $('.chappalNodata').hide();
                                        $('.chappalYesData').show();
                                        return true;
                                        break;
                                    }
                                }
                                
                                if (!blnValid) {
                                    localStorage.setItem('chappal_key',''); 
                                    $('#chappal_chart').hide();
                                    $('.chappalNodata').show();
                                    $('.chappalYesData').hide();
                                    alert("Sorry, " + sFileName + " is invalid, allowed extensions are: " + _validFileExtensions.join(", "));
                                    return false;
                                }
                            }
                        }
                    return true;
                }
    //    function delete_file() {
    //         jConfirm('Are you sure??',  '', function(r) {
    //             if (r == true) {                    
    //                 var surapodo_id = $('#chappal_csv_dropdown').find(':selected').attr('data-surapodo_id');
    //                 alert(surapodo_id);                   
    //             }  
    //    }
       function function_play() {
         id_customer =  $("#id_customer").val();  
         gait_distance =  $("#gait_distance").val();  
         localStorage.setItem('gait_distance',gait_distance); 
         playback_type =  $("#playback_type").val();  
         datetimepicker =  $("#datetimepicker").val();  
         playback_time =  $("#playback_time").val();
         var files =$('#chappal_csv_dropdown').val();              
         localStorage.setItem('chappal_key',files);    
         $.redirect("newReportData4.php?id_customer="+id_customer, {playback_type: playback_type, datetimepicker: datetimepicker, playback_time: playback_time, status_play: '1',upload_csv:files}, "POST", ""); 
       } 
       
         playback_time_func();
         $("#datetimepicker").datepicker({
           beforeShowDay: beforeShowDay,
           dateFormat: 'yy-mm-dd',
         changeMonth: true,
         changeYear: true
         });

const xlabels = [];
const xlabels_display = [];
const xlabels_int = [];
var foreL = [];
var midL = [];
var heelL = [];
var foreR = [];
var midR = [];
var heelR = [];
var foreL_display = [];
var midL_display = [];
var heelL_display = [];
var foreR_display = [];
var midR_display = [];
var heelR_display = [];
const totalL = [];
const totalR =[];
const box_new_x =[];
const box_new_y =[];
const box_length =[];


const storage_left_balance = [];
const storage_right_balance = [];
const storage_left_balance_kpa = [];
const storage_right_balance_kpa = [];
const storage_cop = [];
const storage_cop_kpa = [];
const step_count_pdf = [];
const new_sec_pdf = [];
const fl_pdf = [];
const ml_pdf = [];
const hl_pdf = [];
const fr_pdf = [];
const mr_pdf = [];
const hr_pdf = [];
const new_x_mean_pdf = [];
const new_y_mean_pdf = [];
const new_x_sd_square_pdf = [];
const new_y_sd_square_pdf = [];
var new_ticks = 0;
var max_rs1_static = 0
var max_rs2_static = 0
var max_rs3_static = 0
var max_rs4_static = 0
var max_rs5_static = 0
			
var max_ls1_static = 0
var max_ls2_static  = 0
var max_ls3_static  = 0
var max_ls4_static  = 0
var max_ls5_static  = 0
/* ********End************* */
      
         call();
         
         if(localStorage.getItem('chappal_key') && localStorage.getItem('chappal_key') !=''&& localStorage.getItem('chappal_key') !=0){
            chappalGraph(localStorage.getItem('chappal_key'))
            $('.chappalNodata').hide();
            $('#chappal_chart').show();
            $('.chappalYesData').show();
      }else{
        $('.chappalNodata').show();
            $('#chappal_chart').hide();
            $('.chappalYesData').hide();
      }
         function replaceAll(string, search, replace) {
         return string.split(search).join(replace);
         }
         
         async function call(){
             await getData(); // Get Data from CSV File
             chartIt_left_balance();
             chartIt_cop();
             chartIt_right_balance();
             chartIt_left_gait();
             chartIt_right_gait();
         }
        
         function chartIt_left_balance() {

const ctx = document.getElementById('balance_left').getContext('2d');
const balance_left = new Chart(ctx, {
    type: 'scatter',
    options: {
        responsive: false,
        hover: true,
        legend: {
            display: false
        },
        layout: {
            padding: {
                left: 20,
                right: 0,
                top: 0,
                bottom: 0
            }
        },

        scales: {
            xAxes: [{
                scaleLabel: {
                    display: true,
                    labelString: 'LX'
                },
                ticks: {
                    min: -1000,
                    max: 1000,
                    stepSize: 250
                },
                gridLines: {
                    color: 'orange',
                    drawOnChartArea: true
                }
            }],
            yAxes: [{
                ticks: {
                    min: -1000,
                    max: 1000,
                    stepSize: 250
                },
                scaleLabel: {
                    display: true,
                    labelString: 'LY'
                },
                gridLines: {
                    color: 'orange',
                    drawOnChartArea: true
                }
            }]
        }
    },
    data: {
        datasets: [{
                data: storage_left_balance,
                showLine: true,
                backgroundColor: "rgba(75,75,192,0.4)",
                borderCapStyle: 'butt',
                borderDash: [],
                borderDashOffset: 0.0,
                borderJoinStyle: 'miter',
                pointBorderColor: 'rgba(75,75,192,1)',
                pointBackgroundColor: "#fff",
                pointBorderWidth: 1,
                pointHoverRadius: 5,
                pointHoverBackgroundColor: "rgba(75,72,192,1)",
                PointHoverBorderColor: "rgba(220,220,220,1)",
                pointHoverBorderWidth: 2,
                pointRadius: 1,
                pointHitRadius: 10,
                fill: false,
                pointRadius: 0,
                borderColor: [
                    'rgba(75, 75, 192, 1)'

                ],
                borderWidth: 2
            },
            {
                type: 'scatter',
                showLine: true,
                borderColor: "rgba(0,0,0,0.6)",
                pointRadius: 0,
                borderWidth: 1.0,
                data: [{
                        x: -1000,
                        y: 0
                    },
                    {
                        x: 1000,
                        y: 0
                    },
                ]
            },
            {
                type: 'scatter',
                showLine: true,
                borderColor: "rgba(0,0,0,0.6)",
                pointRadius: 0,
                borderWidth: 1.0,
                data: [{
                        x: 0,
                        y: 1000
                    },
                    {
                        x: 0,
                        y: -1000
                    }
                ]
            }
        ],
    }

});
}

function chartIt_cop() {
const ctx = document.getElementById('cop').getContext('2d');
const cop = new Chart(ctx, {
    type: 'scatter',
    options: {
        responsive: false,
        hover: true,
        legend: {
            display: false
        },
        layout: {
            padding: {
                left: 20,
                right: 0,
                top: 0,
                bottom: 0
            }
        },

        scales: {
            xAxes: [{
                scaleLabel: {
                    display: true,
                    labelString: 'COP-X'
                },
                ticks: {
                    min: -2000,
                    max: 2000,
                    stepSize: 500
                },
                gridLines: {
                    color: 'orange',
                    drawOnChartArea: true
                }
            }],
            yAxes: [{
                scaleLabel: {
                    display: true,
                    labelString: 'COP-Y'
                },
                ticks: {
                    min: -2000,
                    max: 2000,
                    stepSize: 500
                },
                gridLines: {
                    color: 'orange',
                    drawOnChartArea: true
                }
            }]
        }
    },
    data: {
        datasets: [{
                data: storage_cop,
                showLine: true,
                backgroundColor: "rgba(75,75,192,0.4)",
                borderCapStyle: 'butt',
                borderDash: [],
                borderDashOffset: 0.0,
                borderJoinStyle: 'miter',
                pointBorderColor: 'rgba(75,75,192,1)',
                pointBackgroundColor: "#fff",
                pointBorderWidth: 1,
                pointHoverRadius: 5,
                pointHoverBackgroundColor: "rgba(75,72,192,1)",
                PointHoverBorderColor: "rgba(220,220,220,1)",
                pointHoverBorderWidth: 2,
                pointRadius: 1,
                pointHitRadius: 10,
                fill: false,
                pointRadius: 0,
                borderColor: [
                    'rgba(75, 75, 192, 1)'

                ],
                borderWidth: 2
            },
            {
                type: 'scatter',
                showLine: true,
                borderColor: "rgba(0,0,0,0.6)",
                pointRadius: 0,
                borderWidth: 1.0,
                data: [{
                        x: -2000,
                        y: 0
                    },
                    {
                        x: 2000,
                        y: 0
                    },
                ]
            },
            {
                type: 'scatter',
                showLine: true,
                borderColor: "rgba(0,0,0,0.6)",
                pointRadius: 0,
                borderWidth: 1.0,
                data: [{
                        x: 0,
                        y: 2000
                    },
                    {
                        x: 0,
                        y: -2000
                    }
                ]
            },

        ],
    }

});
}

function chartIt_right_balance() {
const ctx = document.getElementById('balance_right').getContext('2d');
const balance_right = new Chart(ctx, {
    type: 'scatter',
    options: {
        responsive: false,
        hover: true,
        legend: {
            display: false
        },
        layout: {
            padding: {
                left: 20,
                right: 0,
                top: 0,
                bottom: 0
            }
        },

        scales: {
            xAxes: [{
                scaleLabel: {
                    display: true,
                    labelString: 'RX'
                },
                ticks: {
                    min: -1000,
                    max: 1000,
                    stepSize: 250
                },
                gridLines: {
                    color: 'orange',
                    drawOnChartArea: true
                }
            }],
            yAxes: [{
                ticks: {
                    min: -1000,
                    max: 1000,
                    stepSize: 250
                },
                scaleLabel: {
                    display: true,
                    labelString: 'RY'
                },
                gridLines: {
                    color: 'orange',
                    drawOnChartArea: true
                }
            }]
        }
    },
    data: {
        datasets: [{
                data: storage_right_balance,
                showLine: true,
                backgroundColor: "rgba(75,75,192,0.4)",
                borderCapStyle: 'butt',
                borderDash: [],
                borderDashOffset: 0.0,
                borderJoinStyle: 'miter',
                pointBorderColor: 'rgba(75,75,192,1)',
                pointBackgroundColor: "#fff",
                pointBorderWidth: 1,
                pointHoverRadius: 5,
                pointHoverBackgroundColor: "rgba(75,72,192,1)",
                PointHoverBorderColor: "rgba(220,220,220,1)",
                pointHoverBorderWidth: 2,
                pointRadius: 1,
                pointHitRadius: 10,
                fill: false,
                pointRadius: 0,
                borderColor: [
                    'rgba(75, 75, 192, 1)'

                ],
                borderWidth: 2
            },
            {
                type: 'scatter',
                showLine: true,
                borderColor: "rgba(0,0,0,0.6)",
                pointRadius: 0,
                borderWidth: 1.0,
                data: [{
                        x: -1000,
                        y: 0
                    },
                    {
                        x: 1000,
                        y: 0
                    },
                ]
            },
            {
                type: 'scatter',
                showLine: true,
                borderColor: "rgba(0,0,0,0.6)",
                pointRadius: 0,
                borderWidth: 1.0,
                data: [{
                        x: 0,
                        y: 1000
                    },
                    {
                        x: 0,
                        y: -1000
                    }
                ]
            }

        ],
    }

});
}

function chartIt_left_gait() {
const ctx = document.getElementById('gait_left').getContext('2d');

const gait_left = new Chart(ctx, {
    type: 'line',
    options: {
        responsive: true,
        maintainAspectRatio: false,
        legend: {
            position: 'bottom',
            display: true,
        },
        hover: true,
        scales: {
            xAxes: [{
                scaleLabel: {
                    display: true,
                    labelString: 'Time (Second)',
                },
                ticks: {
                    display: true,
                    maxTicksLimit: 18,
                },
                gridLines: {
                    color: "rgba(0, 0, 0, 0)",
                },

            }],
            yAxes: [{
                scaleLabel: {
                    display: true,
                    labelString: 'Sensor signal'
                },
                ticks: {
                    max: 800,
                    min: 0,
                    stepSize: 100
                },
                gridLines: {
                    color: "rgba(0, 0, 0, 0)",
                }
            }]
        },

        layout: {
            padding: {
                left: 20,
                right: 0,
                top: 0,
                bottom: 0
            }
        },
    },
    data: {
        labels: xlabels_display,
        datasets: [{
                label: 'Fore Foot',
                data: foreL_display,
                backgroundColor: "rgba(75,75,192,0.4)",
                borderCapStyle: 'butt',
                borderDash: [],
                borderDashOffset: 0.0,
                borderJoinStyle: 'miter',
                pointBorderColor: 'rgba(75,75,192,1)',
                pointBackgroundColor: "#fff",
                pointBorderWidth: 1,
                pointHoverRadius: 5,
                pointHoverBackgroundColor: "rgba(75,72,192,1)",
                PointHoverBorderColor: "rgba(220,220,220,1)",
                pointHoverBorderWidth: 2,
                pointRadius: 1,
                pointHitRadius: 10,
                fill: true,
                pointRadius: 0,
                borderColor: [
                    'rgba(75, 75, 192, 1)'

                ],
                borderWidth: 1

            },
            {
                label: 'Mid Foot',
                data: midL_display,
                backgroundColor: "rgba(75,200,60,0.4)",
                borderCapStyle: 'butt',
                borderDash: [],
                borderDashOffset: 0.0,
                borderJoinStyle: 'miter',
                pointBorderColor: 'rgba(75,200,60,1)',
                pointBackgroundColor: "#fff",
                pointBorderWidth: 1,
                pointHoverRadius: 5,
                pointHoverBackgroundColor: "rgba(72,200,60,1)",
                PointHoverBorderColor: "rgba(220,220,220,1)",
                pointHoverBorderWidth: 2,
                pointRadius: 1,
                pointHitRadius: 10,
                fill: true,
                pointRadius: 0,
                borderColor: [
                    'rgba(75, 200, 60, 1)'

                ],

                borderWidth: 1
            },
            {
                label: 'Heel',
                data: heelL_display,
                backgroundColor: "rgba(192,65,60,0.4)",
                borderCapStyle: 'butt',
                borderDash: [],
                borderDashOffset: 0.0,
                borderJoinStyle: 'miter',
                pointBorderColor: 'rgba(192,65,60,1)',
                pointBackgroundColor: "#fff",
                pointBorderWidth: 1,
                pointHoverRadius: 5,
                pointHoverBackgroundColor: "rgba(192,62,60,1)",
                PointHoverBorderColor: "rgba(220,220,220,1)",
                pointHoverBorderWidth: 2,
                pointRadius: 1,
                pointHitRadius: 10,
                fill: true,
                pointRadius: 0,
                borderColor: [
                    'rgba(192, 65, 60, 1)'
                ],
                borderWidth: 1
            }

        ]
    },

});

}

function chartIt_right_gait() {
const ctx = document.getElementById('gait_right').getContext('2d');
const myChart2 = new Chart(ctx, {
    type: 'line',
    options: {
        responsive: true,
        maintainAspectRatio: false,
        legend: {
            position: 'bottom',
            display: true,
        },
        hover: true,

        scales: {
            xAxes: [{

                scaleLabel: {
                    display: true,
                    labelString: 'Time (Second)'
                },
                ticks: {
                    display: true,
                    maxTicksLimit: 18
                },
                gridLines: {
                    color: "rgba(0, 0, 0, 0)",
                }
            }],
            yAxes: [{

                scaleLabel: {
                    display: true,
                    labelString: 'Sensor signal'
                },
                ticks: {
                    max: 800,
                    min: 0,
                    stepSize: 100
                },
                gridLines: {
                    color: "rgba(0, 0, 0, 0)",
                }
            }]
        },
        layout: {
            padding: {
                left: 20,
                right: 0,
                top: 0,
                bottom: 0
            }
        },
    },
    data: {
        labels: xlabels_display,
        datasets: [{
                label: 'Fore Foot',
                data: foreR_display,
                backgroundColor: "rgba(75,75,192,0.4)",
                borderCapStyle: 'butt',
                borderDash: [],
                borderDashOffset: 0.0,
                borderJoinStyle: 'miter',
                pointBorderColor: 'rgba(75,75,192,1)',
                pointBackgroundColor: "#fff",
                pointBorderWidth: 1,
                pointHoverRadius: 5,
                pointHoverBackgroundColor: "rgba(75,72,192,1)",
                PointHoverBorderColor: "rgba(220,220,220,1)",
                pointHoverBorderWidth: 2,
                pointRadius: 1,
                pointHitRadius: 10,
                fill: true,
                pointRadius: 0,
                borderColor: [
                    'rgba(75, 75, 192, 1)'

                ],
                borderWidth: 1

            },
            {
                label: 'Mid Foot',
                data: midR_display,
                backgroundColor: "rgba(75,200,60,0.4)",
                borderCapStyle: 'butt',
                borderDash: [],
                borderDashOffset: 0.0,
                borderJoinStyle: 'miter',
                pointBorderColor: 'rgba(75,200,60,1)',
                pointBackgroundColor: "#fff",
                pointBorderWidth: 1,
                pointHoverRadius: 5,
                pointHoverBackgroundColor: "rgba(72,200,60,1)",
                PointHoverBorderColor: "rgba(220,220,220,1)",
                pointHoverBorderWidth: 2,
                pointRadius: 1,
                pointHitRadius: 10,
                fill: true,
                pointRadius: 0,
                borderColor: [
                    'rgba(75, 200, 60, 1)'
                ],
                borderWidth: 1
            },
            {
                label: 'Heel',
                data: heelR_display,
                backgroundColor: "rgba(192,65,60,0.4)",
                borderCapStyle: 'butt',
                borderDash: [],
                borderDashOffset: 0.0,
                borderJoinStyle: 'miter',
                pointBorderColor: 'rgba(192,65,60,1)',
                pointBackgroundColor: "#fff",
                pointBorderWidth: 1,
                pointHoverRadius: 5,
                pointHoverBackgroundColor: "rgba(192,62,60,1)",
                PointHoverBorderColor: "rgba(220,220,220,1)",
                pointHoverBorderWidth: 2,
                pointRadius: 1,
                pointHitRadius: 10,
                fill: true,
                pointRadius: 0,
                borderColor: [
                    'rgba(192, 65, 60, 1)'

                ],

                borderWidth: 1
            }

        ]
    },

});

}
var data1 = {
labels: demo_x,
datasets: [{
    label: "Left F/R Ratio",
    data: demo_y,
    lineTension: 0,
    backgroundColor: "rgba(26, 188, 156, 0.5)",
    borderColor: "rgba(26, 188, 156, 1)",
    borderWidth: 1,
    pointRadius: 4,
    borderWidth: 2
}, {
    label: "Right F/R Ratio",
    data: demo_z,
    lineTension: 0,
    backgroundColor: "rgba(78, 124, 243, 0.3)",
    borderColor: "rgba(78, 124, 243, 1)",
    borderWidth: 1,
    pointRadius: 4,
    borderWidth: 2

}]
};
var data2 = {
labels: demo_x,
datasets: [{
    label: "Left Peak Pressure",
    data: demo_a,
    lineTension: 0,
    backgroundColor: "rgba(130, 237, 12, 0.3)",
    borderColor: "rgba(0, 128, 0, 1)",
    borderWidth: 1,
    pointRadius: 4,
    borderWidth: 2
}, {
    label: "Right Peak Pressure",
    data: demo_b,
    lineTension: 0,
    backgroundColor: "rgba(0, 179, 249, 0.5)",
    borderColor: "rgba(0, 112, 192, 1)",
    borderWidth: 1,
    pointRadius: 4,
    borderWidth: 2
}]
};

var options1 = {
responsive: true,
maintainAspectRatio: false,
bezierCurve: false,
legend: {
    position: 'bottom',
    align: 'center',
    display: true,
    labels: {
        fontSize: 13,
    }

},
scales: {
    xAxes: [{
        type: 'time',
        time: {
            parser: 'DD-MM-YYYY',
            tooltipFormat: 'll',
            unit: 'week',
            unitStepSize: 1,
            displayFormats: {
                'month': 'DD/MM'
            }
        },
        ticks: {
            fontSize: 13
        },
        stacked: false,
        scaleLabel: {
            display: true,
            labelString: 'Date',
            fontColor: "grey",
            fontSize: 15
        },
        gridLines: {
            color: "rgba(0, 0, 0, 0)",
        },
    }],
    yAxes: [{
        scaleLabel: {
            display: true,
            labelString: 'F/R Ratio',
            fontColor: "green",
            fontSize: 15,
        },
        ticks: {
            fontSize: 14
        },
        gridLines: {
            color: "rgba(0, 0, 0, 0)",
        },
        gridLines: {
            zeroLineColor: '#ff00f0',
            display: true,
            drawOnChartArea: false
        },
    }]
},
layout: {
    padding: {
        left: 20,
        right: 20,
        top: 20,
        bottom: 0
    }
},
plugins: {
    datalabels: {
        display: false,
    },
}
};

var options2 = {
responsive: true,
maintainAspectRatio: false,
bezierCurve: false,
legend: {
    position: 'bottom',
    align: 'center',
    display: true,
    labels: {
        fontSize: 13,
    }
},
scales: {
    xAxes: [{
        type: 'time',
        time: {
            parser: 'DD-MM-YYYY',
            tooltipFormat: 'll',
            unit: 'week',
            unitStepSize: 1,
            displayFormats: {
                'month': 'DD/MM'
            }
        },
        ticks: {
            fontSize: 13
        },
        stacked: false,
        scaleLabel: {
            display: true,
            labelString: 'Date',
            fontColor: "grey",
            fontSize: 15
        },
        gridLines: {
            color: "rgba(0, 0, 0, 0)",
        },
    }],
    yAxes: [{
        scaleLabel: {
            display: true,
            labelString: 'Peak Pressure (kPa)',
            fontColor: "blue",
            fontSize: 16,
        },
        ticks: {
            fontSize: 14
        },
        gridLines: {
            color: "rgba(0, 0, 0, 0)",
        },
        gridLines: {
            zeroLineColor: '#ff00f0',
            display: true,
            drawOnChartArea: false
        },
    }]
},
layout: {
    padding: {
        left: 20,
        right: 20,
        top: 20,
        bottom: 0
    }
},
plugins: {
    datalabels: {
        display: false,
    },
}
};
const ctx1 = document.getElementById('chart-0').getContext('2d');
const chart = new Chart(ctx1, {
type: 'line',
data: data1,
options: options1
});

$(".btn1").addClass("active");

function changeData1() {
    $(".btn1").addClass("active");
    $(".btn2").removeClass("active");
    console.log("Button1");
     chart = new Chart(ctx1, {
        type: 'line',
        data: data1,
        options: options1
    });
    chart.update();
}

function changeData2() {
    $(".btn2").addClass("active");
    $(".btn1").removeClass("active");
    chart.destroy();
    console.log("Button2");
     chart = new Chart(ctx1, {
        type: 'line',
        data: data2,
        options: options2
    });
    chart.update();
}
         
/* ------------------------------------Surapodo Calculation Start --------------------------------------------------*/
async function chappalGraph(sFileName) {
    if (sFileName == '' && sFileName == 0) {
        alert(1);
        return false;
    } else {


        // const data = await response.text();

        localStorage.setItem('chappal_key', sFileName);
        if (sFileName && localStorage.getItem('chappal_key') != '') {
            if (localStorage.getItem('filenameis') && localStorage.getItem('filenameis') != '') {
                geekss = localStorage.getItem('filenameis');
                // $("#filenameis").text(geekss);
            }
            const chappalData = [];
            const avgChappalData = [];
            if (sFileName != '' && sFileName != 0) {
                const filename = 'uploadcsv/' + sFileName;
                const chappalresponse = await fetch(filename); // Upload CSV 
                const fileData = await chappalresponse.text();
                const table = fileData.split('\n').slice(1);

                table.forEach(function(row, i) {
                    const columns = row.split(',');
                    var length = fileData.split("\n").length;
                    chappalData[i] = columns;
                });


                chappalData.forEach(function(row, indexData) {
                    chappalData[indexData] = chappalData[indexData].toString().replace('{""l"":[{""p"":[', "")
                    chappalData[indexData] = chappalData[indexData].split(",");
                    var rowWiseData = replaceAll(chappalData[indexData].toString(), '"{""p"":[', '');
                    rowWiseData = replaceAll(rowWiseData.toString(), ']}', '');
                    chappalData[indexData] = rowWiseData.split(",");
                });
                /* Start column wise sum and after than avg */
                result = chappalData.reduce(function(r, a) {
                    a.forEach(function(b, i) {
                        r[i] = (r[i] || 0) + parseInt(b.replace('"', ""));
                    });
                    return r;
                }, []);
                // document.write('<pre>' + JSON.stringify(result, 0, 4) + '</pre>');
                result.forEach(function(avgrow1, avgindex) {
                    result[avgindex] = parseInt(avgrow1 / chappalData.length);
                });
                // var resizeData = resize(result,[50][50],0);
                const newResizeArr = [];
                const finalArr = [];
                while (result.length) newResizeArr.push(result.splice(0, 50));
                var x, x_length = 50,
                    y, y_length = 50,
                    map = [],
                    map1 = [],
                    map2 = [];

                // Don't be lazy
                for (x = 0; x < x_length; x++) {
                    map[x] = []
                    for (y = 0; y < y_length; y++) {
                        map[x][y] = newResizeArr[y][49 - x];
                    }
                }

                for (x = 0; x < x_length; x++) {
                    map2[x] = []
                    for (y = 0; y < y_length; y++) {
                        if (map[x][y] >= 30) {
                            map2[x][y] = (3.68177 * Math.pow(1.00163, (map[x][y]))).toFixed(2);
                        } else map2[x][y] = 0;
                    }
                }

                var d3 = Plotly.d3
                var canvas = document.getElementById('chappal_chart');
                var ctx = canvas.getContext('2d');
                var graph_image = new Image();
                var data = [];
                var data = [{
                    z: map2,
                    x: [0, 0.7, 1.4, 2.1, 2.8, 3.5, 4.2, 4.9, 5.6, 6.3, 7, 7.7, 8.4, 9.1, 9.8, 10.5, 11.2, 11.9, 12.6, 13.3, 14, 14.7, 15.4, 16.1, 16.8, 17.5, 18.2, 18.9, 19.6, 20.3, 21, 21.7, 22.4, 23.1, 23.8, 24.5, 25.2, 25.9, 26.6, 27.3, 28, 28.7, 29.4, 30.1, 30.8, 31.5, 32.2, 32.9, 33.6, 34.3],
                    y: [0, 0.7, 1.4, 2.1, 2.8, 3.5, 4.2, 4.9, 5.6, 6.3, 7, 7.7, 8.4, 9.1, 9.8, 10.5, 11.2, 11.9, 12.6, 13.3, 14, 14.7, 15.4, 16.1, 16.8, 17.5, 18.2, 18.9, 19.6, 20.3, 21, 21.7, 22.4, 23.1, 23.8, 24.5, 25.2, 25.9, 26.6, 27.3, 28, 28.7, 29.4, 30.1, 30.8, 31.5, 32.2, 32.9, 33.6, 34.3],

                    type: 'contour',
                    colorscale: [
                        [0, 'rgb(255,255,255)'],
                        [0.25, 'rgb(31,120,180)'],
                        [0.45, 'rgb(178,223,138)'],
                        [0.65, 'rgb(51,160,44)'],
                        [0.85, 'rgb(251,154,153)'],
                        [1, 'rgb(227,26,28)']
                    ],
                    autocontour: true,
                    contours: {
                        coloring: 'heatmap',
                        start: 50,
                        end: 1500,
                        size: 100
                    },
                    colorbar: {
                        title: 'Pressure (kPa)',
                        titleside: 'right',
                        titlefont: {
                            size: 16,
                            family: 'Arial, sans-serif'
                        }
                    }
                }];

                var layout = {

                    xaxis: {
                        title: {
                            text: 'Width in CM',
                            font: {
                                family: 'Courier New, monospace',
                                size: 18,
                                color: '#7f7f7f'
                            }
                        },
                    },
                    yaxis: {
                        title: {
                            text: 'Height in CM',
                            font: {
                                family: 'Courier New, monospace',
                                size: 18,
                                color: '#7f7f7f'
                            }
                        },
                    },
                    autosize: true,
                    width: 400,
                    height: 390
                }

                Plotly.plot(
                        'contour_div',
                        data,
                        layout)
                    .then(
                        function(gd) {
                            Plotly.toImage(gd, {

                                })
                                .then(
                                    function(url) {
                                        graph_image.src = url;
                                        return Plotly.toImage(gd, {
                                            format: 'svg',
                                        });
                                    })
                            //location.reload();
                        });

                /*start calculation  part  */
                map.forEach(function(rowdata, rowindex) {
                    map1[rowindex] = [];
                    rowdata.forEach(function(columandata, indexData1) {
                        if (columandata >= 30 && columandata != 'NaN') {
                            map1[rowindex][indexData1] = 1;
                        } else {
                            map1[rowindex][indexData1] = 0;
                        }
                    });
                }, []);
                for (let indexCali = 1; indexCali <= 48; indexCali++) {
                    for (let indexCalJ = 1; indexCalJ <= 48; indexCalJ++) {
                        if (map1[indexCali][indexCalJ] == 1) {
                            list = [map1[indexCali - 1][indexCalJ - 1], map1[indexCali - 1][indexCalJ], map1[indexCali - 1][indexCalJ + 1], map1[indexCali + 1][indexCalJ - 1], map1[indexCali + 1][indexCalJ], map1[indexCali - 1][indexCalJ + 1], map1[indexCali][indexCalJ - 1], map1[indexCali][indexCalJ + 1]]
                            var sum = list.reduce(function(a, b) {
                                return a + b;
                            }, 0);
                            if (sum == 0) {
                                map1[indexCali][indexCalJ] = 0;
                            }
                        }

                    }
                }
                var arr_left_height = []
                var arr_right_height = []
                var arr_left_width = []
                var arr_right_width = []
                var count_left = []
                var count_right = []
                var count_left_kpa = []
                var count_right_kpa = []
                var map2_left = []
                var map2_right = []
                //Left
                for (let leftpressurei = 0; leftpressurei <= 49; leftpressurei++) {
                    var temp_left = 0
                    var temp_left_kpa = 0
                    for (let leftpressureJ = 0; leftpressureJ < 25; leftpressureJ++) {
                        if (map1[leftpressurei][leftpressureJ] == 1) {
                            temp_left = temp_left + 1
                            temp_left_kpa = parseFloat(temp_left_kpa) + parseFloat(map2[leftpressurei][leftpressureJ])
                            arr_left_height.push(leftpressurei)
                            arr_left_width.push(leftpressureJ)
                            map2_left.push(map2[leftpressurei][leftpressureJ])
                        }
                        count_left[leftpressurei] = temp_left
                        count_left_kpa[leftpressurei] = temp_left_kpa
                    }
                }
                //Right
                for (let rightpressurei = 0; rightpressurei <= 49; rightpressurei++) {
                    var temp_right = 0
                    var temp_right_kpa = 0
                    for (let rightpressureJ = 25; rightpressureJ < 50; rightpressureJ++) {
                        if (map1[rightpressurei][rightpressureJ] == 1) {
                            temp_right = temp_right + 1
                            temp_right_kpa = parseFloat(temp_right_kpa) + parseFloat(map2[rightpressurei][rightpressureJ])
                            arr_right_height.push(rightpressurei)
                            arr_right_width.push(rightpressureJ)
                            map2_right.push(map2[rightpressurei][rightpressureJ])
                        }
                        count_right[rightpressurei] = temp_right
                        count_right_kpa[rightpressurei] = temp_right_kpa
                    }
                }

                function getMax(a) {
                    return Math.max(...a.map(e => Array.isArray(e) ? getMax(e) : e));
                }
                var left_peak_pressure = getMax(map2_left);
                var right_peak_pressure = getMax(map2_right);
                var left_peak_row = 0;
                var right_peak_row = 0;
                for (let max_lefti = 0; max_lefti <= 49; max_lefti++) {
                    for (let max_leftJ = 0; max_leftJ < 25; max_leftJ++) {
                        if (left_peak_pressure == map2[max_lefti][max_leftJ]) {
                            left_peak_row = max_lefti
                            break
                        }
                    }
                }
                for (let max_righti = 0; max_righti <= 49; max_righti++) {
                    for (let max_rightJ = 25; max_rightJ < 50; max_rightJ++) {
                        if (right_peak_pressure == map2[max_righti][max_rightJ]) {
                            right_peak_row = max_righti
                            break
                        }
                    }
                }

                var left_sort = arr_left_height.sort((a, b) => a - b);
                var right_sort = arr_right_height.sort((a, b) => a - b);
                var left_sort_width = arr_left_width.sort((a, b) => a - b);
                var right_sort_width = arr_right_width.sort((a, b) => a - b);
                var left_foot_length = (left_sort[left_sort.length - 1] - left_sort[0] + 1) * 0.7
                var right_foot_length = (right_sort[right_sort.length - 1] - right_sort[0] + 1) * 0.7
                var left_foot_width = ((left_sort_width[left_sort_width.length - 1] - left_sort_width[0] + 1) * 0.7).toFixed(1)
                var right_foot_width = ((right_sort_width[right_sort_width.length - 1] - right_sort_width[0] + 1) * 0.7).toFixed(1)

                /* # Left */
                var start_row_left = left_sort[left_sort.length - 1] - 5;
                var end_row_left = left_sort[0];
                var reminder_left = (start_row_left - end_row_left + 1) % 3;

                if (reminder_left == 1) {
                    start_row_left = start_row_left + 2;
                } else if (reminder_left == 2) {
                    start_row_left = start_row_left + 1
                }
                var per_foot_left = parseInt((start_row_left + 1 - end_row_left) / 3)

                /* # Right */
                var start_row_right = right_sort[right_sort.length - 1] - 5;
                var end_row_right = right_sort[0];
                var reminder_right = (start_row_right - end_row_right + 1) % 3;
                if (reminder_right == 1) {
                    start_row_right = start_row_right + 2;
                } else if (reminder_right == 2) {
                    start_row_right = start_row_right + 1;
                }
                var per_foot_right = parseInt((start_row_right + 1 - end_row_right) / 3);

                var left_peak_zone = ""
                var right_peak_zone = ""

                if (left_peak_row <= (end_row_left + per_foot_left)) {
                    left_peak_zone = "Heel";
                } else if (left_peak_row <= (end_row_left + (2 * per_foot_left))) {
                    left_peak_zone = "Mid foot"
                } else {
                    left_peak_zone = "Forefoot"
                }

                if (right_peak_row <= (end_row_right + per_foot_right)) {
                    right_peak_zone = "Heel";
                } else if (right_peak_row <= (end_row_right + (2 * per_foot_right))) {
                    right_peak_zone = "Mid foot"
                } else {
                    right_peak_zone = "Forefoot"
                }

                /* # Left */
                var Heel_foot_left = sum_array(end_row_left, end_row_left + per_foot_left, count_left);
                var mid_foot_left = sum_array(end_row_left + per_foot_left, end_row_left + 2 * (per_foot_left), count_left);
                var fore_foot_left = sum_array(end_row_left + 2 * (per_foot_left), start_row_left + 1, count_left);

                var Heel_foot_left_kpa = sum_array(end_row_left, end_row_left + per_foot_left, count_left_kpa);
                var fore_foot_left_kpa = sum_array(end_row_left + 2 * (per_foot_left), start_row_left + 1, count_left_kpa);


                /* # Right */
                var Heel_foot_right = sum_array(end_row_right, end_row_right + per_foot_right, count_right);
                var mid_foot_right = sum_array(end_row_right + per_foot_right, end_row_right + 2 * (per_foot_right), count_right);
                var fore_foot_right = sum_array(end_row_right + 2 * (per_foot_right), start_row_right + 1, count_right);

                var Heel_foot_right_kpa = sum_array(end_row_right, end_row_right + per_foot_right, count_right_kpa);
                var fore_foot_right_kpa = sum_array(end_row_right + 2 * (per_foot_right), start_row_right + 1, count_right_kpa);

                function sum_array(start, end, arr) {
                    var sum = 0;
                    for (var i = start; i < end; i++) {
                        sum = sum + arr[i];
                    }
                    return sum;
                }
                var left_arch_index = (mid_foot_left / (fore_foot_left + mid_foot_left + Heel_foot_left)).toFixed(2);
                var right_arch_index = (mid_foot_right / (fore_foot_right + mid_foot_right + Heel_foot_right)).toFixed(2);

                var left_fr_ratio = ((fore_foot_left_kpa) / (Heel_foot_left_kpa)).toFixed(2);
                var right_fr_ratio = ((fore_foot_right_kpa) / (Heel_foot_right_kpa)).toFixed(2);
                var foot_type1 = "";
                var foot_type2 = "";
                $('#ai1').text(left_arch_index);
                $('#ai2').text(right_arch_index);
                $('#lfl').text((left_foot_length.toFixed(1) + ' cm'));
                $('#rfl').text((right_foot_length.toFixed(1) + ' cm'));
                $('#lfw').text((left_foot_width) + ' cm');
                $('#rfw').text((right_foot_width) + ' cm');
                $('#fr1').text(left_fr_ratio);
                $('#fr2').text(right_fr_ratio);

                if (left_arch_index < 0.21) {
                    foot_type1 = "HIGH"
                    $('#tft1').text('HIGH');
                    $('#ft1').attr("src", "images/H1.png");
                } else if (left_arch_index > 0.28) {
                    foot_type1 = "FLAT"
                    $('#tft1').text('FLAT');
                    $('#ft1').attr("src", "images/F1.png");
                } else {
                    foot_type1 = "NORMAL"
                    $('#tft1').text('NORMAL');
                    $('#ft1').attr("src", "images/N1.png");
                }
                if (right_arch_index < 0.21) {
                    foot_type2 = "HIGH"
                    $('#tft2').text('HIGH');
                    $('#ft2').attr("src", "images/H2.png");
                } else if (right_arch_index > 0.28) {
                    foot_type2 = "FLAT"
                    $('#tft2').text('FLAT');
                    $('#ft2').attr("src", "images/F2.png");
                } else {
                    foot_type2 = "NORMAL"
                    $('#tft2').text('NORMAL');
                    $('#ft2').attr("src", "images/N2.png");
                }
                // To upload in Database
                var upload_file_name = $('#chappal_csv_dropdown').val();
                var arch = $('#chappal_csv_dropdown').find(':selected').attr('data-arch');
                if (arch == 0) {
                    $('#left_arch_index').val(left_arch_index);
                    $('#right_arch_index').val(right_arch_index);
                    $('#left_fr_ratio').val(left_fr_ratio);
                    $('#right_fr_ratio').val(right_fr_ratio);
                    $('#left_foot_length').val(left_foot_length);
                    $('#right_foot_length').val(right_foot_length);
                    $('#left_foot_width').val(left_foot_width);
                    $('#right_foot_width').val(right_foot_width);
                    $('#left_foot_type').val(foot_type1);
                    $('#right_foot_type').val(foot_type2);
                    $('#left_peak_pressure').val(left_peak_pressure);
                    $('#right_peak_pressure').val(right_peak_pressure);
                    $('#left_peak_zone').val(left_peak_zone);
                    $('#right_peak_zone').val(right_peak_zone);
                    $('#right_peak_zone').val(right_peak_zone);

                    $.ajax({
                        url: 'updatecsvdata.php',
                        method: 'POST',
                        data: {
                            user_id: id_customer,
                            left_arch_index: left_arch_index,
                            right_arch_index: right_arch_index,
                            left_fr_ratio: left_fr_ratio,
                            right_fr_ratio: right_fr_ratio,
                            left_foot_length: left_foot_length,
                            right_foot_length: right_foot_length,
                            left_foot_width: left_foot_width,
                            right_foot_width: right_foot_width,
                            left_foot_type: foot_type1,
                            right_foot_type: foot_type2,
                            left_peak_pressure: left_peak_pressure,
                            right_peak_pressure: right_peak_pressure,
                            left_peak_zone: left_peak_zone,
                            right_peak_zone: right_peak_zone,
                            upload_file_name: upload_file_name
                        },
                        success: function(data) {
                            console.log(data);
                        },
                    });
                }

            }
        }
    }
}
  /* ------------------------------------Surapodo Calculation End --------------------------------------------------*/     
       
         async function getData() { 
  <?php
      $sec =explode(".",$playback_time)[2]; 
      $cutTime =    round($sec*0.20);
    //   $startTime = explode(".",$playback_time)[0];
      $startTime = date("H:i:s", strtotime(explode(".",$playback_time)[0]) + $cutTime);
      $addedtime = date("H:i:s", strtotime(explode(".",$playback_time)[0]) + (($sec + 1)- $cutTime));
      
      

    $strSQL = "SELECT distinct ROUND(CONCAT(TIME_TO_SEC(surasole.action), '.', TIME_FORMAT(surasole.action, '%f'))-(SELECT CONCAT(TIME_TO_SEC(`action`), '.', TIME_FORMAT(`action`, '%f')) FROM `surasole` LEFT JOIN mod_customer ON mod_customer.id_customer = surasole.id_customer WHERE surasole.`id_customer`='$id_customer' AND  surasole.`type`='$playback_type'  AND surasole.action BETWEEN '$datetimepicker $startTime' AND '$datetimepicker $addedtime' ORDER BY `duration` ASC limit 1),3) as duration
    ,surasole.left_sensor1,surasole.left_sensor2,surasole.left_sensor3,
    surasole.left_sensor4,surasole.left_sensor5,surasole.right_sensor1,surasole.right_sensor2,
    surasole.right_sensor3,surasole.right_sensor4,surasole.right_sensor5,(surasole.left_sensor1+surasole.left_sensor2+surasole.left_sensor3)/3 as left_stride_F,
    (surasole.left_sensor3-surasole.left_sensor2) as left_balance_x,(((surasole.left_sensor2+surasole.left_sensor3)/2)-surasole.left_sensor5) as left_balance_y,(surasole.right_sensor1+surasole.right_sensor2+surasole.right_sensor3)/3 as right_stride_F,(surasole.right_sensor3-surasole.right_sensor2) as right_balance_x,
    (((surasole.right_sensor2+surasole.right_sensor3)/2)-surasole.right_sensor5) as right_balance_y,((surasole.right_sensor1+surasole.right_sensor2+surasole.right_sensor3)/3 +surasole.right_sensor4+surasole.right_sensor5)-((surasole.left_sensor1+surasole.left_sensor2+surasole.left_sensor3)/3+surasole.left_sensor4+surasole.left_sensor5) as body_COP_x,(((surasole.left_sensor1+surasole.left_sensor2+surasole.left_sensor3)/3)+((surasole.right_sensor1+surasole.right_sensor2+surasole.right_sensor3)/3))-(surasole.right_sensor5+surasole.left_sensor5) as body_COP_y
    
FROM
    `surasole`
LEFT JOIN mod_customer ON mod_customer.id_customer = surasole.id_customer
WHERE surasole.`left_sensor1` < 1024 AND surasole.`left_sensor2` < 1024 AND surasole.`left_sensor3` < 1024 AND surasole.`left_sensor4` < 1024 AND surasole.`left_sensor5` < 1024 AND surasole.`right_sensor1` < 1024 AND surasole.`right_sensor2` < 1024 AND surasole.`right_sensor3` < 1024 AND surasole.`right_sensor4` < 1024 AND surasole.`right_sensor5` < 1024 AND surasole.`id_customer`='$id_customer' AND  surasole.`type`='$playback_type'  AND surasole.action BETWEEN '$datetimepicker $startTime' AND '$datetimepicker $addedtime' ORDER BY surasole.action";
$result = mysqli_query($objConnect, $strSQL);
$i = 2;
?>
var mysec = '<?=$sec?>';
var columns1 = [];
var column29 = [];
var column30 = [];
var column31 = [];
var column32 = [];
var column33 = [];
var column34 = [];
var left_sen1 = [];
var left_sen2 = [];
var left_sen3 = [];
var right_sen1 = [];
var right_sen2 = [];
var right_sen3 = [];
var wssum = [];
var columnsData1 = [];
var columnsData12 = [];

<?php
$mainData = [];
  while($columnsData = mysqli_fetch_assoc($result)){   
        $columnsDataStr =  implode(",",$columnsData);  
        array_push($mainData,$columnsDataStr);        
      }
?>
selectsec = '<?php echo $sec; ?>';
columnsData12 = '<?php echo json_encode($mainData); ?>';
const columnsDataFinal = columnsData12.split('","').slice(1);
    columnsDataFinal.forEach(function (row, i) {
        const columns = row.split(',');
        const time = columns[0];
        xlabels.push(time);
        xlabels_display.push(parseFloat(time).toFixed(1));
        xlabels_int.push(parseInt(time)); 
        const fore_left = columns[11];
        foreL.push(fore_left);
		
		// Left Mid-foot
        const mid_left = parseInt(columns[4]);
        midL.push(mid_left);

		const heel_left = parseInt(columns[5]);
		heelL.push(heel_left);
		
		//Left Balance
        const lx = columns[12]
        const ly = columns[13]
        var json_left = {
            x: lx,
            y: ly
        };
        storage_left_balance.push(json_left);
		
		// COP Balance
        const cop_x = columns[17]
        const cop_y = columns[18]
        var json_cop = {
            x: cop_x,
            y: cop_y
        };
        storage_cop.push(json_cop);
		
		//Right Balance
        const rx = columns[15]
        const ry = columns[16]
        var json_right = {
            x: rx,
            y: ry
        };
        storage_right_balance.push(json_right);

		// Right Fore-foot ((S2+S3)/2)
        const fore_right = columns[14];
		foreR.push(fore_right);
		
		//Right Mid-foot
        const mid_right = parseInt(columns[9]);
		midR.push(mid_right);
		
		//Right Heel
        const heel_right = parseInt(columns[10]);
		heelR.push(heel_right);
	
    const left_s1 = parseInt(columns[1]);
    const left_s2 = parseInt(columns[2]);
    const left_s3 = parseInt(columns[3]);
	const right_s1 = parseInt(columns[6]);
    const right_s2 = parseInt(columns[7]);
    const right_s3 = parseInt(columns[8]);
    left_sen1.push(left_s1);
	left_sen2.push(left_s2);
	left_sen3.push(left_s3);
	right_sen1.push(right_s1);
	right_sen2.push(right_s2);
	right_sen3.push(right_s3);
    
 
        columns[29] = (parseInt(columns[1])+parseInt(columns[2])+parseInt(columns[3])+parseInt(columns[4])+parseInt(columns[5]));// Sum LEFT
        columns[30] = (parseInt(columns[6])+parseInt(columns[7])+parseInt(columns[8])+parseInt(columns[9])+parseInt(columns[10]));//Sum RIGHT
        columns[31] = (parseInt(columns[29]) - parseInt(columns[30]));  // LEFT - RIGHT    
        columns[32] = (parseInt(columns[30]) - parseInt(columns[29]));  // RIGHT - LEFT
		columns[33] = parseInt((parseInt(columns[1])+parseInt(columns[2])+parseInt(columns[3])) /3); //Left Fore Foot (Avg. of 3 sensors)
		columns[34] = parseInt((parseInt(columns[6])+parseInt(columns[7])+parseInt(columns[8])) /3); //Right Fore Foot (Avg. of 3 sensors)
    
        column29.push(columns[29]); // Sum LEFT
        column30.push(columns[30]); // Sum RIGHT
        column31.push(columns[31]); // Left - RIGHT
        column32.push(columns[32]); // RIGHT - LEFT
		column33.push(columns[33]); //Left Fore Foot
        column34.push(columns[34]); //Right Fore Foot 
        
        
    });

/********************** Step Count, Walking Speed, GAIT Speed**********Start********** */
var subject_count = [];
var new_x = [];
var new_y = [];
var step_count = 0;
var walking_speed = 0;
var gait_dis = localStorage.getItem('gait_distance');
$('#gait_distance').val(gait_dis);
var gait_speed = 0;
column31.forEach(function(row1, ival) {
    if ((column31[ival] < 0 && column31[ival + 1] >= 0) || (column31[ival] > 0 && column31[ival + 1] <= 0)) {
        step_count = step_count + 1
    }
    if (column31[ival] < 0 && column31[ival + 1] >= 0) {
        subject_count.push(ival)
    }
});

step_count_pdf[0] = step_count;
new_sec = xlabels[xlabels.length - 1];
new_ticks = new_sec;
new_sec_pdf[0] = new_sec;
var status = 0;
if (step_count > 5) {
    status = 1;
}
if ( gait_dis > 0) {
    gait_speed = (gait_dis / mysec).toFixed(2);
}

walking_speed = (Math.round((step_count / new_sec) * 60));
if (isNaN(walking_speed)) walking_speed = 0;
gait_speed = isFinite(gait_speed) ? gait_speed : 0.0;

if (status == 1){
    $('#sc').text(step_count);
    $('#ws').text(walking_speed);
    $('#gs').text((gait_speed));
}
else{
    $('#sc').text(0);
    $('#ws').text(0);
    $('#gs').text((0));
}


/********************** Step Count, Walking Speed, GAIT Speed**********End********** */

//-------------------------------------------------------------Peak Pressure Calculation --------------Start-----------------

var index_left = [];
var index_right = [];

for (var i = 2; i < column31.length - 4; i++) {

    if ((column31[i] > 1000) && (column29[i] > 1200) && (column29[i] > column29[i - 1]) && (column29[i] > column29[i + 1])) {
        index_left.push(i);
    }
    if ((column29[i] == column29[i - 1]) && (column29[i] == column29[i + 1])) {

        if ((column29[i + 1] > column29[i + 2]) && (column31[i + 1] > 1000) && (column29[i + 1] > 1200)) {
            index_left.push(i + 1)
        } else if ((column29[i + 2] > column29[i + 3]) && (column31[i + 2] > 1000) && (column29[i + 2] > 1200)) {
            index_left.push(i + 2)
        } else if ((column29[i + 3] > column29[i + 4]) && (column31[i + 3] > 1000) && (column29[i + 3] > 1200)) {
            index_left.push(i + 3)
        }
    }

    if ((column29[i] > column29[i - 1]) && (column29[i] == column29[i + 1])) {

        if ((column29[i + 1] > column29[i + 2]) && (column31[i + 1] > 1000) && (column29[i + 1] > 1200)) {
            index_left.push(i + 1)
        } else if ((column29[i + 2] > column29[i + 3]) && (column31[i + 2] > 1000) && (column29[i + 2] > 1200)) {
            index_left.push(i + 2)
        } else if ((column29[i + 3] > column29[i + 4]) && (column31[i + 3] > 1000) && (column29[i + 3] > 1200)) {
            index_left.push(i + 3)
        }
    }


}

for (var i = 2; i < column31.length - 4; i++) {

    if ((column32[i] > 1000) && (column30[i] > 1200) && (column30[i] > column30[i - 1]) && (column30[i] > column30[i + 1])) {
        index_right.push(i);
    }
    if ((column30[i] == column30[i - 1]) && (column30[i] == column30[i + 1])) {

        if ((column30[i + 1] > column30[i + 2]) && (column32[i + 1] > 1000) && (column30[i + 1] > 1200)) {
            index_right.push(i + 1)
        } else if ((column30[i + 2] > column30[i + 3]) && (column32[i + 2] > 1000) && (column30[i + 2] > 1200)) {
            index_right.push(i + 2)
        } else if ((column30[i + 3] > column30[i + 4]) && (column32[i + 3] > 1000) && (column30[i + 3] > 1200)) {
            index_right.push(i + 3)
        }
    }

    if ((column30[i] > column30[i - 1]) && (column30[i] == column30[i + 1])) {

        if ((column30[i + 1] > column30[i + 2]) && (column32[i + 1] > 1000) && (column30[i + 1] > 1200)) {
            index_right.push(i + 1)
        } else if ((column30[i + 2] > column30[i + 3]) && (column32[i + 2] > 1000) && (column30[i + 2] > 1200)) {
            index_right.push(i + 2)
        } else if ((column30[i + 3] > column30[i + 4]) && (column32[i + 3] > 1000) && (column30[i + 3] > 1200)) {
            index_right.push(i + 3)
        }
    }

}

var new_left = []
var new_right = []

for (var i = 0; i < index_left.length - 1; i++) {
    if ((index_left[i + 1] - index_left[i]) > 5) {
        new_left.push(index_left[i])
    }
}

for (var i = 0; i < index_right.length - 1; i++) {
    if ((index_right[i + 1] - index_right[i]) > 5) {
        new_right.push(index_right[i])
    }
}

start_peak = Math.min(new_left[0], new_right[0]);
end_peak = Math.max(new_left[new_left.length - 1], new_right[new_right.length - 1]);
new_left.push.apply(new_left, new_right);
arr_peak = new_left;
x_peak = arr_peak.sort((a, b) => a - b);
length_peak = x_peak.length;

var max_l1 = []
var max_l1_new = []
var distance_from_mean_l1 = []
var max_l2 = []
var max_l2_new = []
var distance_from_mean_l2 = []
var max_l3 = []
var max_l3_new = []
var distance_from_mean_l3 = []
var max_l4 = []
var max_l4_new = []
var distance_from_mean_l4 = []
var max_l5 = []
var max_l5_new = []
var distance_from_mean_l5 = []

var max_r1 = []
var max_r1_new = []
var distance_from_mean_r1 = []
var max_r2 = []
var max_r2_new = []
var distance_from_mean_r2 = []
var max_r3 = []
var max_r3_new = []
var distance_from_mean_r3 = []
var max_r4 = []
var max_r4_new = []
var distance_from_mean_r4 = []
var max_r5 = []
var max_r5_new = []
var distance_from_mean_r5 = []

if (start_peak == new_left[0]) {
    for (var j = 0; j < length_peak - 1; j++) {
        if (j % 2 == 0) {
            var max_rs1 = 0
            var max_rs2 = 0
            var max_rs3 = 0
            var max_rs4 = 0
            var max_rs5 = 0
            for (var i = x_peak[j]; i < x_peak[j + 1] + 6; i++) {

                if (right_sen1[i] > max_rs1) {
                    max_rs1 = right_sen1[i]
                }

                if (right_sen2[i] > max_rs2) {
                    max_rs2 = right_sen2[i]
                }

                if (right_sen3[i] > max_rs3) {
                    max_rs3 = right_sen3[i]
                }

                if (midR[i] > max_rs4) {
                    max_rs4 = midR[i]
                }

                if (heelR[i] > max_rs5) {
                    max_rs5 = heelR[i]
                }
            }
            max_r1.push(parseFloat(0.497 * Math.exp(0.0088 * max_rs1)).toFixed(2));
            max_r2.push(parseFloat(0.497 * Math.exp(0.0088 * max_rs2)).toFixed(2));
            max_r3.push(parseFloat(0.497 * Math.exp(0.0088 * max_rs3)).toFixed(2));
            max_r4.push(parseFloat(0.497 * Math.exp(0.0088 * max_rs4)).toFixed(2));
            max_r5.push(parseFloat(0.497 * Math.exp(0.0088 * max_rs5)).toFixed(2));
        } else {
            var max_ls1 = 0
            var max_ls2 = 0
            var max_ls3 = 0
            var max_ls4 = 0
            var max_ls5 = 0
            for (var k = x_peak[j]; k < x_peak[j + 1] + 6; k++) {

                if (left_sen1[k] > max_ls1) {
                    max_ls1 = left_sen1[k]
                }

                if (left_sen2[k] > max_ls2) {
                    max_ls2 = left_sen2[k]
                }

                if (left_sen3[k] > max_ls3) {
                    max_ls3 = left_sen3[k]
                }

                if (midL[k] > max_ls4) {
                    max_ls4 = midL[k]
                }

                if (heelL[k] > max_ls5) {
                    max_ls5 = heelL[k]
                }
            }

            max_l1.push(parseFloat(0.497 * Math.exp(0.0088 * max_ls1)).toFixed(2));
            max_l2.push(parseFloat(0.497 * Math.exp(0.0088 * max_ls2)).toFixed(2));
            max_l3.push(parseFloat(0.497 * Math.exp(0.0088 * max_ls3)).toFixed(2));
            max_l4.push(parseFloat(0.497 * Math.exp(0.0088 * max_ls4)).toFixed(2));
            max_l5.push(parseFloat(0.497 * Math.exp(0.0088 * max_ls5)).toFixed(2));
        }
    }
}

if (start_peak == new_right[0]) {
    for (var j = 0; j < length_peak - 1; j++) {
        if (j % 2 != 0) {
            var max_rs1 = 0
            var max_rs2 = 0
            var max_rs3 = 0
            var max_rs4 = 0
            var max_rs5 = 0

            for (var i = x_peak[j]; i < x_peak[j + 1] + 6; i++) {
                if (right_sen1[i] > max_rs1) {
                    max_rs1 = right_sen1[i]
                }

                if (right_sen2[i] > max_rs2) {
                    max_rs2 = right_sen2[i]
                }

                if (right_sen3[i] > max_rs3) {
                    max_rs3 = right_sen3[i]
                }

                if (midR[i] > max_rs4) {
                    max_rs4 = midR[i]
                }

                if (heelR[i] > max_rs5) {
                    max_rs5 = heelR[i]
                }
            }

            max_r1.push(parseFloat(0.497 * Math.exp(0.0088 * max_rs1)).toFixed(2));
            max_r2.push(parseFloat(0.497 * Math.exp(0.0088 * max_rs2)).toFixed(2));
            max_r3.push(parseFloat(0.497 * Math.exp(0.0088 * max_rs3)).toFixed(2));
            max_r4.push(parseFloat(0.497 * Math.exp(0.0088 * max_rs4)).toFixed(2));
            max_r5.push(parseFloat(0.497 * Math.exp(0.0088 * max_rs5)).toFixed(2));
        } else {
            var max_ls1 = 0
            var max_ls2 = 0
            var max_ls3 = 0
            var max_ls4 = 0
            var max_ls5 = 0
            for (var k = x_peak[j]; k < x_peak[j + 1] + 6; k++) {

                if (left_sen1[k] > max_ls1) {
                    max_ls1 = left_sen1[k]
                }

                if (left_sen2[k] > max_ls2) {
                    max_ls2 = left_sen2[k]
                }

                if (left_sen3[k] > max_ls3) {
                    max_ls3 = left_sen3[k]
                }

                if (midL[k] > max_ls4) {
                    max_ls4 = midL[k]
                }

                if (heelL[k] > max_ls5) {
                    max_ls5 = heelL[k]
                }
            }
            max_l1.push(parseFloat(0.497 * Math.exp(0.0088 * max_ls1)).toFixed(2));
            max_l2.push(parseFloat(0.497 * Math.exp(0.0088 * max_ls2)).toFixed(2));
            max_l3.push(parseFloat(0.497 * Math.exp(0.0088 * max_ls3)).toFixed(2));
            max_l4.push(parseFloat(0.497 * Math.exp(0.0088 * max_ls4)).toFixed(2));
            max_l5.push(parseFloat(0.497 * Math.exp(0.0088 * max_ls5)).toFixed(2));
        }
    }
}
var sum_peak_l1 = 0;
var sum_peak_l2 = 0;
var sum_peak_l3 = 0;
var sum_peak_l4 = 0;
var sum_peak_l5 = 0;
var sum_peak_r1 = 0;
var sum_peak_r2 = 0;
var sum_peak_r3 = 0;
var sum_peak_r4 = 0;
var sum_peak_r5 = 0;

var sum_peak_l1_new = 0;
var sum_peak_l2_new = 0;
var sum_peak_l3_new = 0;
var sum_peak_l4_new = 0;
var sum_peak_l5_new = 0;
var sum_peak_r1_new = 0;
var sum_peak_r2_new = 0;
var sum_peak_r3_new = 0;
var sum_peak_r4_new = 0;
var sum_peak_r5_new = 0;

var mean_l1 = 0;
var mean_l2 = 0;
var mean_l3 = 0;
var mean_l4 = 0;
var mean_l5 = 0;
var mean_r1 = 0;
var mean_r2 = 0;
var mean_r3 = 0;
var mean_r4 = 0;
var mean_r5 = 0;

var sd_l1 = 0;
var sd_l2 = 0;
var sd_l3 = 0;
var sd_l4 = 0;
var sd_l5 = 0;
var sd_r1 = 0;
var sd_r2 = 0;
var sd_r3 = 0;
var sd_r4 = 0;
var sd_r5 = 0;

for (var i = 0; i < max_l1.length; i++) {
    sum_peak_l1 = parseFloat(sum_peak_l1) + parseFloat(max_l1[i]);
}
for (var i = 0; i < max_l2.length; i++) {
    sum_peak_l2 = parseFloat(sum_peak_l2) + parseFloat(max_l2[i]);
}
for (var i = 0; i < max_l3.length; i++) {
    sum_peak_l3 = parseFloat(sum_peak_l3) + parseFloat(max_l3[i]);
}
for (var i = 0; i < max_l4.length; i++) {
    sum_peak_l4 = parseFloat(sum_peak_l4) + parseFloat(max_l4[i]);
}
for (var i = 0; i < max_l5.length; i++) {
    sum_peak_l5 = parseFloat(sum_peak_l5) + parseFloat(max_l5[i]);
}
for (var i = 0; i < max_r1.length; i++) {
    sum_peak_r1 = parseFloat(sum_peak_r1) + parseFloat(max_r1[i]);
}
for (var i = 0; i < max_r2.length; i++) {
    sum_peak_r2 = parseFloat(sum_peak_r2) + parseFloat(max_r2[i]);
}
for (var i = 0; i < max_r3.length; i++) {
    sum_peak_r3 = parseFloat(sum_peak_r3) + parseFloat(max_r3[i]);
}
for (var i = 0; i < max_r4.length; i++) {
    sum_peak_r4 = parseFloat(sum_peak_r4) + parseFloat(max_r4[i]);
}
for (var i = 0; i < max_r5.length; i++) {
    sum_peak_r5 = parseFloat(sum_peak_r5) + parseFloat(max_r5[i]);
}

//Remove Outliers
mean_l1 = sum_peak_l1 / max_l1.length;
mean_l2 = sum_peak_l2 / max_l2.length;
mean_l3 = sum_peak_l3 / max_l3.length;
mean_l4 = sum_peak_l4 / max_l4.length;
mean_l5 = sum_peak_l5 / max_l5.length;
mean_r1 = sum_peak_r1 / max_r1.length;
mean_r2 = sum_peak_r2 / max_r2.length;
mean_r3 = sum_peak_r3 / max_r3.length;
mean_r4 = sum_peak_r4 / max_r4.length;
mean_r5 = sum_peak_r5 / max_r5.length;

var total_l1 = 0;
var total_l2 = 0;
var total_l3 = 0;
var total_l4 = 0;
var total_l5 = 0;
var total_r1 = 0;
var total_r2 = 0;
var total_r3 = 0;
var total_r4 = 0;
var total_r5 = 0;

var temp_l1 = 0;
var temp_l2 = 0;
var temp_l3 = 0;
var temp_l4 = 0;
var temp_l5 = 0;
var temp_r1 = 0;
var temp_r2 = 0;
var temp_r3 = 0;
var temp_r4 = 0;
var temp_r5 = 0;
//L1
for (var i = 0; i < max_l1.length; i++) {
    distance_from_mean_l1.push(Math.abs(max_l1[i] - mean_l1));
    total_l1 = total_l1 + Math.pow((max_l1[i] - mean_l1), 2);
}
temp_l1 = total_l1 / max_l1.length;
sd_l1 = Math.sqrt(temp_l1).toFixed(2);
for (var i = 0; i < max_l1.length; i++) {
    if (distance_from_mean_l1[i] < 2 * sd_l1) {
        max_l1_new.push(max_l1[i]);
    }
}
//L2  
for (var i = 0; i < max_l2.length; i++) {
    distance_from_mean_l2.push(Math.abs(max_l2[i] - mean_l2));
    total_l2 = total_l2 + Math.pow((max_l2[i] - mean_l2), 2);
}
temp_l2 = total_l2 / max_l2.length;
sd_l2 = Math.sqrt(temp_l2).toFixed(2);
for (var i = 0; i < max_l2.length; i++) {
    if (distance_from_mean_l2[i] < 2 * sd_l2) {
        max_l2_new.push(max_l2[i]);
    }
}
//L3
for (var i = 0; i < max_l3.length; i++) {
    distance_from_mean_l3.push(Math.abs(max_l3[i] - mean_l3));
    total_l3 = total_l3 + Math.pow((max_l3[i] - mean_l3), 2);
}
temp_l3 = total_l3 / max_l3.length;
sd_l3 = Math.sqrt(temp_l3).toFixed(2);
for (var i = 0; i < max_l3.length; i++) {
    if (distance_from_mean_l3[i] < 2 * sd_l3) {
        max_l3_new.push(max_l3[i]);
    }
}
//L4
for (var i = 0; i < max_l4.length; i++) {
    distance_from_mean_l4.push(Math.abs(max_l4[i] - mean_l4));
    total_l4 = total_l4 + Math.pow((max_l4[i] - mean_l4), 2);
}
temp_l4 = total_l4 / max_l4.length;
sd_l4 = Math.sqrt(temp_l4).toFixed(2);
for (var i = 0; i < max_l4.length; i++) {
    if (distance_from_mean_l4[i] < 2 * sd_l4) {
        max_l4_new.push(max_l4[i]);
    }
}
//L5
for (var i = 0; i < max_l5.length; i++) {
    distance_from_mean_l5.push(Math.abs(max_l5[i] - mean_l5));
    total_l5 = total_l5 + Math.pow((max_l5[i] - mean_l5), 2);
}
temp_l5 = total_l5 / max_l5.length;
sd_l5 = Math.sqrt(temp_l5).toFixed(2);
for (var i = 0; i < max_l5.length; i++) {
    if (distance_from_mean_l5[i] < 2 * sd_l5) {
        max_l5_new.push(max_l5[i]);
    }
}
//R1
for (var i = 0; i < max_r1.length; i++) {
    distance_from_mean_r1.push(Math.abs(max_r1[i] - mean_r1));
    total_r1 = total_r1 + Math.pow((max_r1[i] - mean_r1), 2);
}
temp_r1 = total_r1 / max_r1.length;
sd_r1 = Math.sqrt(temp_r1).toFixed(2);
for (var i = 0; i < max_r1.length; i++) {
    if (distance_from_mean_r1[i] < 2 * sd_r1) {
        max_r1_new.push(max_r1[i]);
    }
}
//R2  
for (var i = 0; i < max_r2.length; i++) {
    distance_from_mean_r2.push(Math.abs(max_r2[i] - mean_r2));
    total_r2 = total_r2 + Math.pow((max_r2[i] - mean_r2), 2);
}
temp_r2 = total_r2 / max_r2.length;
sd_r2 = Math.sqrt(temp_r2).toFixed(2);
for (var i = 0; i < max_r2.length; i++) {
    if (distance_from_mean_r2[i] < 2 * sd_r2) {
        max_r2_new.push(max_r2[i]);
    }
}
//R3
for (var i = 0; i < max_r3.length; i++) {
    distance_from_mean_r3.push(Math.abs(max_r3[i] - mean_r3));
    total_r3 = total_r3 + Math.pow((max_r3[i] - mean_r3), 2);
}
temp_r3 = total_r3 / max_r3.length;
sd_r3 = Math.sqrt(temp_r3).toFixed(2);
for (var i = 0; i < max_r3.length; i++) {
    if (distance_from_mean_r3[i] < 2 * sd_r3) {
        max_r3_new.push(max_r3[i]);
    }
}
//R4
for (var i = 0; i < max_r4.length; i++) {
    distance_from_mean_r4.push(Math.abs(max_r4[i] - mean_r4));
    total_r4 = total_r4 + Math.pow((max_r4[i] - mean_r4), 2);
}
temp_r4 = total_r4 / max_r4.length;
sd_r4 = Math.sqrt(temp_r4).toFixed(2);
for (var i = 0; i < max_r4.length; i++) {
    if (distance_from_mean_r4[i] < 2 * sd_r4) {
        max_r4_new.push(max_r4[i]);
    }
}
//R5
for (var i = 0; i < max_r5.length; i++) {
    distance_from_mean_r5.push(Math.abs(max_r5[i] - mean_r5));
    total_r5 = total_r5 + Math.pow((max_r5[i] - mean_r5), 2);
}
temp_r5 = total_r5 / max_r5.length;
sd_r5 = Math.sqrt(temp_r5).toFixed(2);
for (var i = 0; i < max_r5.length; i++) {
    if (distance_from_mean_r5[i] < 2 * sd_r5) {
        max_r5_new.push(max_r5[i]);
    }
}

for (var i = 0; i < max_l1_new.length; i++) {
    sum_peak_l1_new = parseFloat(sum_peak_l1_new) + parseFloat(max_l1_new[i]);
}
for (var i = 0; i < max_l2_new.length; i++) {
    sum_peak_l2_new = parseFloat(sum_peak_l2_new) + parseFloat(max_l2_new[i]);
}
for (var i = 0; i < max_l3_new.length; i++) {
    sum_peak_l3_new = parseFloat(sum_peak_l3_new) + parseFloat(max_l3_new[i]);
}
for (var i = 0; i < max_l4_new.length; i++) {
    sum_peak_l4_new = parseFloat(sum_peak_l4_new) + parseFloat(max_l4_new[i]);
}
for (var i = 0; i < max_l5_new.length; i++) {
    sum_peak_l5_new = parseFloat(sum_peak_l5_new) + parseFloat(max_l5_new[i]);
}
for (var i = 0; i < max_r1_new.length; i++) {
    sum_peak_r1_new = parseFloat(sum_peak_r1_new) + parseFloat(max_r1_new[i]);
}
for (var i = 0; i < max_r2_new.length; i++) {
    sum_peak_r2_new = parseFloat(sum_peak_r2_new) + parseFloat(max_r2_new[i]);
}
for (var i = 0; i < max_r3_new.length; i++) {
    sum_peak_r3_new = parseFloat(sum_peak_r3_new) + parseFloat(max_r3_new[i]);
}
for (var i = 0; i < max_r4_new.length; i++) {
    sum_peak_r4_new = parseFloat(sum_peak_r4_new) + parseFloat(max_r4_new[i]);
}
for (var i = 0; i < max_r5_new.length; i++) {
    sum_peak_r5_new = parseFloat(sum_peak_r5_new) + parseFloat(max_r5_new[i]);
}


for (var i = 0; i < column29.length; i++) {

    if (right_sen1[i] > max_rs1_static) {
        max_rs1_static = right_sen1[i]
    }

    if (right_sen2[i] > max_rs2_static) {
        max_rs2_static = right_sen2[i]
    }

    if (right_sen3[i] > max_rs3_static) {
        max_rs3_static = right_sen3[i]
    }

    if (midR[i] > max_rs4_static) {
        max_rs4_static = midR[i]
    }

    if (heelR[i] > max_rs5_static) {
        max_rs5_static = heelR[i]
    }
    if (left_sen1[i] > max_ls1_static) {
        max_ls1_static = left_sen1[i]
    }

    if (left_sen2[i] > max_ls2_static) {
        max_ls2_static = left_sen2[i]
    }

    if (left_sen3[i] > max_ls3_static) {
        max_ls3_static = left_sen3[i]
    }

    if (midL[i] > max_ls4_static) {
        max_ls4_static = midL[i]
    }

    if (heelL[i] > max_ls5_static) {
        max_ls5_static = heelL[i]
    }
}
//Left 1			 			
if (max_l1.length == 0) {
    avg_peak_l1 = parseInt(0.497 * Math.exp(0.0088 * max_ls1_static));
} else {
    avg_peak_l1 = Math.round(sum_peak_l1_new / max_l1_new.length);
}
//Left 2
if (max_l2.length == 0) {
    avg_peak_l2 = parseInt(0.497 * Math.exp(0.0088 * max_ls2_static));
} else {
    avg_peak_l2 = Math.round(sum_peak_l2_new / max_l2_new.length);
}
//Left 3
if (max_l3.length == 0) {
    avg_peak_l3 = parseInt(0.497 * Math.exp(0.0088 * max_ls3_static));
} else {
    avg_peak_l3 = Math.round(sum_peak_l3_new / max_l3_new.length);
}
//Left 4
if (max_l4.length == 0) {
    avg_peak_l4 = parseInt(0.497 * Math.exp(0.0088 * max_ls4_static));
} else {
    avg_peak_l4 = Math.round(sum_peak_l4_new / max_l4_new.length);
}
//Left 5
if (max_l5.length == 0) {
    avg_peak_l5 = parseInt(0.497 * Math.exp(0.0088 * max_ls5_static));
} else {
    avg_peak_l5 = Math.round(sum_peak_l5_new / max_l5_new.length);
}
//Right 1			 			
if (max_r1.length == 0) {
    avg_peak_r1 = parseInt(0.497 * Math.exp(0.0088 * max_rs1_static));
} else {
    avg_peak_r1 = Math.round(sum_peak_r1_new / max_r1_new.length);
}
// Right 2
if (max_r2.length == 0) {
    avg_peak_r2 = parseInt(0.497 * Math.exp(0.0088 * max_rs2_static));
} else {
    avg_peak_r2 = Math.round(sum_peak_r2_new / max_r2_new.length);
}
//Right 3
if (max_r3.length == 0) {
    avg_peak_r3 = parseInt(0.497 * Math.exp(0.0088 * max_rs3_static));
} else {
    avg_peak_r3 = Math.round(sum_peak_r3_new / max_r3_new.length);
}
//Right 4
if (max_r4.length == 0) {
    avg_peak_r4 = parseInt(0.497 * Math.exp(0.0088 * max_rs4_static));
} else {
    avg_peak_r4 = Math.round(sum_peak_r4_new / max_r4_new.length);
}
//Right 5
if (max_r5.length == 0) {
    avg_peak_r5 = parseInt(0.497 * Math.exp(0.0088 * max_rs5_static));
} else {
    avg_peak_r5 = Math.round(sum_peak_r5_new / max_r5_new.length);
}

$('#pl1').text(avg_peak_l1);
$('#pl2').text(avg_peak_l2);
$('#pl3').text(avg_peak_l3);
$('#pl4').text(avg_peak_l4);
$('#pl5').text(avg_peak_l5);

$('#pr1').text(avg_peak_r1);
$('#pr2').text(avg_peak_r2);
$('#pr3').text(avg_peak_r3);
$('#pr4').text(avg_peak_r4);
$('#pr5').text(avg_peak_r5);

if (avg_peak_l1 < 335) {
    $('#pl1').addClass("green");
} else if (avg_peak_l1 < 588) {
    $('#pl1').addClass("yellow");
} else {
    $('#pl1').addClass("red");
}

if (avg_peak_l2 < 335) {
    $('#pl2').addClass("green");
} else if (avg_peak_l2 < 588) {
    $('#pl2').addClass("yellow");
} else {
    $('#pl2').addClass("red");
}

if (avg_peak_l3 < 335) {
    $('#pl3').addClass("green");
} else if (avg_peak_l3 < 588) {
    $('#pl3').addClass("yellow");
} else {
    $('#pl3').addClass("red");
}

if (avg_peak_l4 < 335) {
    $('#pl4').addClass("green");
} else if (avg_peak_l4 < 588) {
    $('#pl4').addClass("yellow");
} else {
    $('#pl4').addClass("red");
}

if (avg_peak_l5 < 335) {
    $('#pl5').addClass("green");
} else if (avg_peak_l5 < 588) {
    $('#pl5').addClass("yellow");
} else {
    $('#pl5').addClass("red");
}

if (avg_peak_r1 < 335) {
    $('#pr1').addClass("green");
} else if (avg_peak_r1 < 588) {
    $('#pr1').addClass("yellow");
} else {
    $('#pr1').addClass("red");
}

if (avg_peak_r2 < 335) {
    $('#pr2').addClass("green");
} else if (avg_peak_r2 < 588) {
    $('#pr2').addClass("yellow");
} else {
    $('#pr2').addClass("red");
}

if (avg_peak_r3 < 335) {
    $('#pr3').addClass("green");
} else if (avg_peak_r3 < 588) {
    $('#pr3').addClass("yellow");
} else {
    $('#pr3').addClass("red");
}

if (avg_peak_r4 < 335) {
    $('#pr4').addClass("green");
} else if (avg_peak_r4 < 588) {
    $('#pr4').addClass("yellow");
} else {
    $('#pr4').addClass("red");
}

if (avg_peak_r5 < 335) {
    $('#pr5').addClass("green");
} else if (avg_peak_r5 < 588) {
    $('#pr5').addClass("yellow");
} else {
    $('#pr5').addClass("red");
}

//-------------------------------------------------------------Peak Pressure Calculation --------------End-----------------

//-------------------------------------------------------------Pressure Time Integral --------------Start-----------------
var FL_min = Math.min.apply(Math, foreL);
var ML_min = Math.min.apply(Math, midL);
var HL_min = Math.min.apply(Math, heelL);
var FR_min = Math.min.apply(Math, foreR);
var MR_min = Math.min.apply(Math, midR);
var HR_min = Math.min.apply(Math, heelR);


var FL_pressure = 0;
var ML_pressure = 0;
var HL_pressure = 0;

var FR_pressure = 0;
var MR_pressure = 0;
var HR_pressure = 0;

var FL_pti = 0;
var ML_pti = 0;
var HL_pti = 0;

var FR_pti = 0;
var MR_pti = 0;
var HR_pti = 0;

//Display
var foreL_min = [];
var midL_min = [];
var heelL_min = [];
var foreR_min = [];
var midR_min = [];
var heelR_min = [];

// Min Calculation for Each Gait Cycle
for (var i = 0; i < subject_count.length - 1; i++) {
    foreL_min_temp = 999;
    midL_min_temp = 999;
    heelL_min_temp = 999;
    foreR_min_temp = 999;
    midR_min_temp = 999;
    heelR_min_temp = 999;
    for (var j = subject_count[i]; j < subject_count[i + 1]; j++) {
        if (foreL[j] < foreL_min_temp) {
            foreL_min_temp = foreL[j];
        }
        if (midL[j] < midL_min_temp) {
            midL_min_temp = midL[j];
        }
        if (heelL[j] < heelL_min_temp) {
            heelL_min_temp = heelL[j];
        }

        if (foreR[j] < foreR_min_temp) {
            foreR_min_temp = foreR[j];
        }
        if (midR[j] < midR_min_temp) {
            midR_min_temp = midR[j];
        }
        if (heelR[j] < heelR_min_temp) {
            heelR_min_temp = heelR[j];
        }
    }
    foreL_min.push(foreL_min_temp);
    midL_min.push(midL_min_temp);
    heelL_min.push(heelL_min_temp);

    foreR_min.push(foreR_min_temp);
    midR_min.push(midR_min_temp);
    heelR_min.push(heelR_min_temp);
}
subject_count[0] = 0;
subject_count[subject_count.length - 1] = foreL.length - 1;
var count_min = 0;

for (var i = 0; i < subject_count.length - 1; i++) {
    for (var j = subject_count[i]; j < subject_count[i + 1]; j++) {

        if (foreL[j] - foreL_min[count_min] < 0) {
            foreL_display[j] = 0;
        } else {
            foreL_display[j] = foreL[j] - foreL_min[count_min];
        }

        if (midL[j] - midL_min[count_min] < 0) {
            midL_display[j] = 0;
        } else {
            midL_display[j] = midL[j] - midL_min[count_min];
        }

        if (heelL[j] - heelL_min[count_min] < 0) {
            heelL_display[j] = 0;
        } else {
            heelL_display[j] = heelL[j] - heelL_min[count_min];
        }

        if ((foreR[j] - foreR_min[count_min]) < 0) {
            foreR_display[j] = 0;
        } else {
            foreR_display[j] = foreR[j] - foreR_min[count_min];
        }

        if (midR[j] - midR_min[count_min] < 0) {
            midR_display[j] = 0;
        } else {
            midR_display[j] = midR[j] - midR_min[count_min];
        }

        if (heelR[j] - heelR_min[count_min] < 0) {
            heelR_display[j] = 0;
        } else {
            heelR_display[j] = heelR[j] - heelR_min[count_min];
        }
    }
    count_min = count_min + 1;
}
foreL_display[foreL.length - 1] = foreL[foreL.length - 1] - foreL_min[foreL_min.length - 1];
midL_display[foreL.length - 1] = midL[foreL.length - 1] - midL_min[midL_min.length - 1];
heelL_display[foreL.length - 1] = heelL[foreL.length - 1] - heelL_min[heelL_min.length - 1];

foreR_display[foreL.length - 1] = foreR[foreL.length - 1] - foreR_min[foreR_min.length - 1];
midR_display[foreL.length - 1] = midR[foreL.length - 1] - midR_min[midR_min.length - 1];
heelR_display[foreL.length - 1] = heelR[foreL.length - 1] - heelR_min[heelR_min.length - 1];

if (status == 0) {
    foreL_display = foreL;
    midL_display = midL;
    heelL_display = heelL;
    foreR_display = foreR;
    midR_display = midR;
    heelR_display = heelR;
}

 //****************************************Filter ************START******************
var array_foreL = []
var array_midL = []
var array_heelL = []
var array_foreR = []
var array_midR = []
var array_heelR = []

var foreL_max = []
var midL_max = []
var heelL_max = []
var foreR_max = []
var midR_max = []
var heelR_max = []

var index_fl = 0;
var index_ml = 0;
var index_hl = 0;
var index_fr = 0;
var index_mr = 0;
var index_hr = 0;

//Left Fore-foot
while(index_fl < foreL.length-1){
    if (foreL_display[index_fl] == 0){
        array_foreL.push(index_fl);
        index_fl = index_fl + 3;
    }
    else{
        index_fl = index_fl + 1;
    }
}
array_foreL.push(foreL_display.length);


for (var i = 0 ; i < array_foreL.length-1 ; i++){
    var temp_fL = -999;
    var temp1_fL = 1000;
    for (var j = array_foreL[i] ; j < array_foreL[i+1] ; j++){
        if (foreL_display[j] >= temp_fL){
            temp_fL = foreL_display[j];
            temp1_fL = j;
        }
    }
     foreL_max.push(temp1_fL);
}   

for (var index_1 = 1 ; index_1 < foreL_max.length ; index_1++){
    for (var index_2 = foreL_max[index_1-1] ; index_2 < array_foreL[index_1] ; index_2++){
        if (foreL_display[index_2] < foreL_display[index_2+1] && foreL_display[index_2+1] != 0){
            foreL_display[index_2+1] = 0;
        }
    }
} 

for (var index_2 = foreL_max[foreL_max.length-1] ; index_2 < foreL_display.length -1 ; index_2++){
        if (foreL_display[index_2] < foreL_display[index_2+1] && foreL_display[index_2+1] != 0){
            foreL_display[index_2+1] = 0;
        }
    }

//Left Mid-foot
while(index_ml < midL.length-1){
    if (midL_display[index_ml] == 0){
        array_midL.push(index_ml);
        index_ml = index_ml + 3;
    }
    else{
        index_ml = index_ml + 1;
    }
}
array_midL.push(midL_display.length);


for (var i = 0 ; i < array_midL.length-1 ; i++){
    var temp_mL = -999;
    var temp1_mL = 1000;
    for (var j = array_midL[i] ; j < array_midL[i+1] ; j++){
        if (midL_display[j] >= temp_mL){
            temp_mL = midL_display[j];
            temp1_mL = j;
        }
    }
     midL_max.push(temp1_mL);
}   

for (var index_1 = 1 ; index_1 < midL_max.length ; index_1++){
    for (var index_2 = midL_max[index_1-1] ; index_2 < array_midL[index_1] ; index_2++){
        if (midL_display[index_2] < midL_display[index_2+1] && midL_display[index_2+1] != 0){
            midL_display[index_2+1] = 0;
        }
    }
} 

for (var index_2 = midL_max[midL_max.length-1] ; index_2 < midL_display.length -1 ; index_2++){
        if (midL_display[index_2] < midL_display[index_2+1] && midL_display[index_2+1] != 0){
            midL_display[index_2+1] = 0;
        }
    }

//Left Heel
while(index_hl < heelL.length-1){
    if (heelL_display[index_hl] == 0){
        array_heelL.push(index_hl);
        index_hl = index_hl + 3;
    }
    else{
        index_hl = index_hl + 1;
    }
}
array_heelL.push(heelL_display.length);


for (var i = 0 ; i < array_heelL.length-1 ; i++){
    var temp_hL = -999;
    var temp1_hL = 1000;
    for (var j = array_heelL[i] ; j < array_heelL[i+1] ; j++){
        if (heelL_display[j] >= temp_hL){
            temp_hL = heelL_display[j];
            temp1_hL = j;
        }
    }
     heelL_max.push(temp1_hL);
}   

for (var index_1 = 1 ; index_1 < heelL_max.length ; index_1++){
    for (var index_2 = heelL_max[index_1-1] ; index_2 < array_heelL[index_1] ; index_2++){
        if (heelL_display[index_2] < heelL_display[index_2+1] && heelL_display[index_2+1] != 0){
            heelL_display[index_2+1] = 0;
        }
    }
} 

for (var index_2 = heelL_max[heelL_max.length-1] ; index_2 < heelL_display.length -1 ; index_2++){
        if (heelL_display[index_2] < heelL_display[index_2+1] && heelL_display[index_2+1] != 0){
            heelL_display[index_2+1] = 0;
        }
    }

//Right Fore-foot

while(index_fr < foreR.length-1){
    if (foreR_display[index_fr] == 0){
        array_foreR.push(index_fr);
        index_fr = index_fr + 3;
    }
    else{
        index_fr = index_fr + 1;
    }
}
array_foreR.push(foreR_display.length);


for (var i = 0 ; i < array_foreR.length-1 ; i++){
    var temp_fR = -999;
    var temp1_fR = 1000;
    for (var j = array_foreR[i] ; j < array_foreR[i+1] ; j++){
        if (foreR_display[j] >= temp_fR){
            temp_fR = foreR_display[j];
            temp1_fR = j;
        }
    }
     foreR_max.push(temp1_fR);
}   

for (var index_1 = 1 ; index_1 < foreR_max.length ; index_1++){
    for (var index_2 = foreR_max[index_1-1] ; index_2 < array_foreR[index_1] ; index_2++){
        if (foreR_display[index_2] < foreR_display[index_2+1] && foreR_display[index_2+1] != 0){
            foreR_display[index_2+1] = 0;
        }
    }
} 

for (var index_2 = foreR_max[foreR_max.length-1] ; index_2 < foreR_display.length -1 ; index_2++){
        if (foreR_display[index_2] < foreR_display[index_2+1] && foreR_display[index_2+1] != 0){
            foreR_display[index_2+1] = 0;
        }
    }

//Right Mid-foot

while(index_mr < midR.length-1){
    if (midR_display[index_mr] == 0){
        array_midR.push(index_mr);
        index_mr = index_mr + 3;
    }
    else{
        index_mr = index_mr + 1;
    }
}
array_midR.push(midR_display.length);


for (var i = 0 ; i < array_midR.length-1 ; i++){
    var temp_mR = -999;
    var temp1_mR = 1000;
    for (var j = array_midR[i] ; j < array_midR[i+1] ; j++){
        if (midR_display[j] >= temp_mR){
            temp_mR = midR_display[j];
            temp1_mR = j;
        }
    }
     midR_max.push(temp1_mR);
}   

for (var index_1 = 1 ; index_1 < midR_max.length ; index_1++){
    for (var index_2 = midR_max[index_1-1] ; index_2 < array_midR[index_1] ; index_2++){
        if (midR_display[index_2] < midR_display[index_2+1] && midR_display[index_2+1] != 0){
            midR_display[index_2+1] = 0;
        }
    }
} 

for (var index_2 = midR_max[midR_max.length-1] ; index_2 < midR_display.length -1 ; index_2++){
        if (midR_display[index_2] < midR_display[index_2+1] && midR_display[index_2+1] != 0){
            midR_display[index_2+1] = 0;
        }
    }

//Right Heel

while(index_hr < heelR.length-1){
    if (heelR_display[index_hr] == 0){
        array_heelR.push(index_hr);
        index_hr = index_hr + 3;
    }
    else{
        index_hr = index_hr + 1;
    }
}
array_heelR.push(heelR_display.length);


for (var i = 0 ; i < array_heelR.length-1 ; i++){
    var temp_hR = -999;
    var temp1_hR = 1000;
    for (var j = array_heelR[i] ; j < array_heelR[i+1] ; j++){
        if (heelR_display[j] >= temp_hR){
            temp_hR = heelR_display[j];
            temp1_hR = j;
        }
    }
     heelR_max.push(temp1_hR);
}   

for (var index_1 = 1 ; index_1 < heelR_max.length ; index_1++){
    for (var index_2 = heelR_max[index_1-1] ; index_2 < array_heelR[index_1] ; index_2++){
        if (heelR_display[index_2] < heelR_display[index_2+1] && heelR_display[index_2+1] != 0){
            heelR_display[index_2+1] = 0;
        }
    }
} 

for (var index_2 = heelR_max[heelR_max.length-1] ; index_2 < heelR_display.length -1 ; index_2++){
        if (heelR_display[index_2] < heelR_display[index_2+1] && heelR_display[index_2+1] != 0){
            heelR_display[index_2+1] = 0;
        }
    }

                    
//****************************************Filter ************END******************

                   


//-------------------------------------------------------------GAIT CYCLE PHASES Start-------------------------------------

//Left Foot
var count = [];
var count_left1 = [];
var count_left2 = [];
var count_left3 = [];
var count_left4 = [];
var arr1 = [];
var arr = [];
var total_length = column31.length

for (var i = 1; i < total_length; i++) {
    if (heelL_display[i - 1] == 0 && heelL_display[i] > 0) {
        count_left1.push(i);
    }

    if (heelL_display[i] > 0 && midL_display[i] > 0 && foreL_display[i] > 0) {
        count_left2.push(i);
    }

    if (heelL_display[i] < 10 && midL_display[i] < 10 && foreL_display[i] > 50 && column30[i] > 200) {
        count_left3.push(i);
    }
    if (column29[i] < 200 && column30[i] > 200) {
        count_left4.push(i);
    }

}

count_left1.push.apply(count_left1, count_left2);
count_left1.push.apply(count_left1, count_left3);
count_left1.push.apply(count_left1, count_left4);

arr1 = count_left1
arr = arr1.sort((a, b) => a - b)
count.push(count_left1[0])

for (var i = 1; i < arr.length - 1; i++) {
    if ((arr[i] > count[count.length - 1]) && (count_left1.includes(count[count.length - 1])))
        for (var l2 = 0; l2 < count_left2.length - 1; l2++)
            if (arr[i] == count_left2[l2])
                count.push(arr[i])

    else if ((arr[i] > count[count.length - 1]) && (count_left2.includes(count[count.length - 1])))
        for (var l3 = 0; l3 < count_left3.length - 1; l3++)
            if (arr[i] == count_left3[l3])
                count.push(arr[i])

    else if ((arr[i] > count[count.length - 1]) && (count_left3.includes(count[count.length - 1])))
        for (var l4 = 0; l4 < count_left4.length - 1; l4++)
            if (arr[i] == count_left4[l4])
                count.push(arr[i])

    else if ((arr[i] > count[count.length - 1]) && (count_left4.includes(count[count.length - 1])))
        for (var l1 = 0; l1 < count_left1.length - 1; l1++)
            if (arr[i] == count_left1[l1])
                count.push(arr[i])
}

var reminder_left = (count.length - 1) % 4
var left_length = count.length - reminder_left
var left_phase_count = parseInt(count.length / 4)

var l1_total_time = 0
var l2_total_time = 0
var l3_total_time = 0
var l4_total_time = 0
for (var j = 0; j < (left_length - 2); j++) {
    var i;
    if (j % 4 == 0) {
        for (i = count[j]; i <= count[j + 1]; i++) {
            l1_total_time = (parseFloat(l1_total_time) + parseFloat(xlabels[i + 1] - xlabels[i])).toFixed(2);
        }
    } else if (j % 4 == 1) {
        for (i = count[j]; i <= count[j + 1]; i++) {
            l2_total_time = (parseFloat(l2_total_time) + parseFloat(xlabels[i + 1] - xlabels[i])).toFixed(2);
        }
    } else if (j % 4 == 2) {
        for (i = count[j]; i <= count[j + 1]; i++) {
            l3_total_time = (parseFloat(l3_total_time) + parseFloat(xlabels[i + 1] - xlabels[i])).toFixed(2);
        }
    } else {
        for (i = count[j]; i <= count[j + 1]; i++) {
            l4_total_time = (parseFloat(l4_total_time) + parseFloat(xlabels[i + 1] - xlabels[i])).toFixed(2);
        }
    }
}

var l1_time = parseFloat(l1_total_time / left_phase_count);
var l2_time = parseFloat(l2_total_time / left_phase_count);
var l3_time = parseFloat(l3_total_time / left_phase_count);
var l4_time = parseFloat(l4_total_time / left_phase_count);

var left_total_time = parseFloat(l1_time + l2_time + l3_time + l4_time);
var gait_time = parseFloat(l1_time + l2_time + l3_time + l4_time).toFixed(2);
var l1_per = Math.round(parseFloat((l1_time / left_total_time) * 100));
var l2_per = Math.round(parseFloat((l2_time / left_total_time) * 100));
var l3_per = Math.round(parseFloat((l3_time / left_total_time) * 100));
var l4_per = Math.round(parseFloat((l4_time / left_total_time) * 100));

var left_stance_time = parseFloat(left_total_time - l4_time).toFixed(2);
var left_sway_time = l4_time.toFixed(2);

//Right Foot
var countR = [];
var count_right1 = [];
var count_right2 = [];
var count_right3 = [];
var count_right4 = [];
var arr2 = [];
var arr3 = [];
var total_length_right = column31.length

for (var i = 1; i < total_length_right; i++) {
    if (heelR_display[i - 1] == 0 && heelR_display[i] > 0) {
        count_right1.push(i);
    }

    if (heelR_display[i] > 0 && midR_display[i] > 0 && foreR_display[i] > 0) {
        count_right2.push(i);
    }

    if (heelR_display[i] < 10 && midR_display[i] < 10 && foreR_display[i] > 50 && column29[i] > 200) {
        count_right3.push(i);
    }
    if (column30[i] < 200 && column29[i] > 200) {
        count_right4.push(i);
    }
}
count_right1.push.apply(count_right1, count_right2);
count_right1.push.apply(count_right1, count_right3);
count_right1.push.apply(count_right1, count_right4);
arr2 = count_right1
arr3 = arr2.sort((a, b) => a - b)
countR.push(count_right1[0])

for (var i = 1; i < arr3.length - 1; i++) {
    if ((arr3[i] > countR[countR.length - 1]) && (count_right1.includes(countR[countR.length - 1])))
        for (var r2 = 0; r2 < count_right2.length - 1; r2++)
            if (arr3[i] == count_right2[r2])
                countR.push(arr3[i])

    else if ((arr3[i] > countR[countR.length - 1]) && (count_right2.includes(countR[countR.length - 1])))
        for (var r3 = 0; r3 < count_right3.length - 1; r3++)
            if (arr3[i] == count_right3[r3])
                countR.push(arr3[i])

    else if ((arr3[i] > countR[countR.length - 1]) && (count_right3.includes(countR[countR.length - 1])))
        for (var r4 = 0; r4 < count_right4.length - 1; r4++)
            if (arr3[i] == count_right4[r4])
                countR.push(arr3[i])

    else if ((arr3[i] > countR[countR.length - 1]) && (count_right4.includes(countR[countR.length - 1])))
        for (var r1 = 0; r1 < count_right1.length - 1; r1++)
            if (arr3[i] == count_right1[l1])
                countR.push(arr3[i])
}

var reminder_right = (countR.length - 1) % 4
var right_length = countR.length - reminder_right
var right_phase_count = parseInt(countR.length / 4)

var r1_total_time = 0
var r2_total_time = 0
var r3_total_time = 0
var r4_total_time = 0

for (var j = 0; j < (right_length - 2); j++) {
    var i;
    if (j % 4 == 0) {
        for (i = countR[j]; i <= countR[j + 1]; i++) {
            r1_total_time = (parseFloat(r1_total_time) + parseFloat(xlabels[i + 1] - xlabels[i])).toFixed(2);
        }
    } else if (j % 4 == 1) {
        for (i = countR[j]; i <= countR[j + 1]; i++) {
            r2_total_time = (parseFloat(r2_total_time) + parseFloat(xlabels[i + 1] - xlabels[i])).toFixed(2);
        }
    } else if (j % 4 == 2) {
        for (i = countR[j]; i <= countR[j + 1]; i++) {
            r3_total_time = (parseFloat(r3_total_time) + parseFloat(xlabels[i + 1] - xlabels[i])).toFixed(2);
        }
    } else {
        for (i = countR[j]; i <= countR[j + 1]; i++) {
            r4_total_time = (parseFloat(r4_total_time) + parseFloat(xlabels[i + 1] - xlabels[i])).toFixed(2);
        }
    }
}

var r1_time = parseFloat(r1_total_time / right_phase_count);
var r2_time = parseFloat(r2_total_time / right_phase_count);
var r3_time = parseFloat(r3_total_time / right_phase_count);
var r4_time = parseFloat(r4_total_time / right_phase_count);

var right_total_time = parseFloat(r1_time + r2_time + r3_time + r4_time);
var r1_per = Math.round(parseFloat((r1_time / right_total_time) * 100));
var r2_per = Math.round(parseFloat((r2_time / right_total_time) * 100));
var r3_per = Math.round(parseFloat((r3_time / right_total_time) * 100));
var r4_per = Math.round(parseFloat((r4_time / right_total_time) * 100));
var right_stance_time = parseFloat(right_total_time - r4_time).toFixed(2);
var right_sway_time = r4_time.toFixed(2);

var l1time = l1_time.toFixed(2);
var l2time = l2_time.toFixed(2);
var l3time = l3_time.toFixed(2);
var l4time = l4_time.toFixed(2);
var r1time = r1_time.toFixed(2);
var r2time = r2_time.toFixed(2);
var r3time = r3_time.toFixed(2);
var r4time = r4_time.toFixed(2);

if (isNaN(l1time)) l1time = 0;
if (isNaN(l2time)) l2time = 0;
if (isNaN(l3time)) l3time = 0;
if (isNaN(l4time)) l4time = 0;
if (isNaN(r1time)) r1time = 0;
if (isNaN(r2time)) r2time = 0;
if (isNaN(r3time)) r3time = 0;
if (isNaN(r4time)) r4time = 0;

if (isNaN(left_sway_time)) left_sway_time = 0;
if (isNaN(right_sway_time)) right_sway_time = 0;
if (isNaN(left_stance_time)) left_stance_time = 0;
if (isNaN(right_stance_time)) right_stance_time = 0;
if (isNaN(gait_time)) gait_time = 0;

if (isNaN(l1_per)) l1_per = 0;
if (isNaN(l2_per)) l2_per = 0;
if (isNaN(l3_per)) l3_per = 0;
if (isNaN(l4_per)) l4_per = 0;
if (isNaN(r1_per)) r1_per = 0;
if (isNaN(r2_per)) r2_per = 0;
if (isNaN(r3_per)) r3_per = 0;
if (isNaN(r4_per)) r4_per = 0;

if(status == 1){

$('#l1t').text(l1time + 's');
$('#l2t').text(l2time + 's');
$('#l3t').text(l3time + 's');
$('#l4t').text(l4time + 's');
$('#r1t').text(r1time + 's');
$('#r2t').text(r2time + 's');
$('#r3t').text(r3time + 's');
$('#r4t').text(r4time + 's');

$('#l1p').text(l1_per + '%');
$('#l2p').text(l2_per + '%');
$('#l3p').text(l3_per + '%');
$('#l4p').text(l4_per + '%');
$('#r1p').text(r1_per + '%');
$('#r2p').text(r2_per + '%');
$('#r3p').text(r3_per + '%');
$('#r4p').text(r4_per + '%');
$('#lsw').text(left_sway_time + ' sec');
$('#lst').text(left_stance_time + ' sec');
$('#gst').text(gait_time + ' sec');
$('#rsw').text(right_sway_time + ' sec');
$('#rst').text(right_stance_time + ' sec');
}
else{

$('#l1t').text(0 + 's');
$('#l2t').text(0 + 's');
$('#l3t').text(0 + 's');
$('#l4t').text(0 + 's');
$('#r1t').text(0 + 's');
$('#r2t').text(0 + 's');
$('#r3t').text(0 + 's');
$('#r4t').text(0 + 's');

$('#l1p').text(0 + '%');
$('#l2p').text(0 + '%');
$('#l3p').text(0 + '%');
$('#l4p').text(0 + '%');
$('#r1p').text(0 + '%');
$('#r2p').text(0 + '%');
$('#r3p').text(0 + '%');
$('#r4p').text(0 + '%');
$('#lsw').text(0 + ' sec');
$('#lst').text(0 + ' sec');
$('#gst').text(0 + ' sec');
$('#rsw').text(0 + ' sec');
$('#rst').text(0 + ' sec');
}

//---------------------------------------------------------------------GAIT CYCLE Phases End--------------------------------------------------

//---------------------------------------------------------------------PTI Calculation Start--------------------------------------------------

for (var i = 1; i < (foreL.length - 1); i++) {

    if (foreL[i] <= foreL[i - 1]) {
        FL_pressure = FL_pressure + parseFloat(foreL_display[i] * 0.1)
    }

    if (foreL[i] > foreL[i - 1]) {
        FL_pressure = FL_pressure + parseFloat((foreL_display[i - 1] * 0.1))
    }

    if (midL[i] <= midL[i - 1]) {
        ML_pressure = ML_pressure + parseFloat(midL_display[i] * 0.1)
    }

    if (midL[i] > midL[i - 1]) {
        ML_pressure = ML_pressure + parseFloat(midL_display[i - 1] * 0.1)
    }

    if (heelL[i] <= heelL[i - 1]) {
        HL_pressure = HL_pressure + parseFloat(heelL_display[i] * 0.1)
    }

    if (heelL[i] > heelL[i - 1]) {
        HL_pressure = ML_pressure + parseFloat(heelL_display[i - 1] * 0.1)
    }

    if (foreR[i] <= foreR[i - 1]) {
        FR_pressure = FR_pressure + parseFloat(foreR_display[i] * 0.1)
    }

    if (foreR[i] > foreR[i - 1]) {
        FR_pressure = FR_pressure + parseFloat(foreR_display[i - 1] * 0.1)
    }

    if (midR[i] <= midR[i - 1]) {
        MR_pressure = MR_pressure + parseFloat(midR_display[i] * 0.1)
    }

    if (midR[i] > midR[i - 1]) {
        MR_pressure = MR_pressure + parseFloat(midR_display[i - 1] * 0.1)
    }

    if (heelR[i] <= heelR[i - 1]) {
        HR_pressure = HR_pressure + parseFloat(heelR_display[i] * 0.1)
    }

    if (heelR[i] > heelR[i - 1]) {
        HR_pressure = HR_pressure + parseFloat(heelR_display[i - 1] * 0.1)
    }

}

FL_pti = Math.round((FL_pressure / (FL_pressure + ML_pressure + HL_pressure)) * 100)
ML_pti = Math.round((ML_pressure / (FL_pressure + ML_pressure + HL_pressure)) * 100)
HL_pti = Math.round((HL_pressure / (FL_pressure + ML_pressure + HL_pressure)) * 100)

FR_pti = Math.round((FR_pressure / (FR_pressure + MR_pressure + HR_pressure)) * 100)
MR_pti = Math.round((MR_pressure / (FR_pressure + MR_pressure + HR_pressure)) * 100)
HR_pti = Math.round((HR_pressure / (FR_pressure + MR_pressure + HR_pressure)) * 100)


fl_avg = Math.round(FL_pti);
if (isNaN(fl_avg)) fl_avg = 0;
fl_pdf[0] = fl_avg;
$('#FL').text(fl_avg + '%')
ml_avg = Math.round(ML_pti);
if (isNaN(ml_avg)) ml_avg = 0;
ml_pdf[0] = ml_avg;
$('#ML').text(ml_avg + '%')
hl_avg = 100 - fl_avg - ml_avg;
if (isNaN(hl_avg)) hl_avg = 0;
hl_pdf[0] = hl_avg;
$('#HL').text(hl_avg + '%')

fr_avg = Math.round(FR_pti);
if (isNaN(fr_avg)) fr_avg = 0;
fr_pdf[0] = fr_avg;
$('#FR').text(fr_avg + '%')
mr_avg = Math.round(MR_pti);
if (isNaN(mr_avg)) mr_avg = 0;
mr_pdf[0] = mr_avg;
$('#MR').text(mr_avg + '%')
hr_avg = 100 - fr_avg - mr_avg;
if (isNaN(hr_avg)) hr_avg = 0;
hr_pdf[0] = hr_avg;
$('#HR').text(hr_avg + '%')
$("#pc1").removeClass("over50");
$("#pc2").removeClass("over50");
$("#pc3").removeClass("over50");
$("#pc4").removeClass("over50");
$("#pc5").removeClass("over50");
$("#pc6").removeClass("over50");

$("#pc1").removeClass("p0");
$("#pc2").removeClass("p0");
$("#pc3").removeClass("p0");
$("#pc4").removeClass("p0");
$("#pc5").removeClass("p0");
$("#pc6").removeClass("p0");

$("#pc1").addClass("p" + fl_avg);
$("#pc2").addClass("p" + ml_avg);
$("#pc3").addClass("p" + hl_avg);
$("#pc4").addClass("p" + fr_avg);
$("#pc5").addClass("p" + mr_avg);
$("#pc6").addClass("p" + hr_avg);

if (fl_avg >= 50) {
    $("#pc1").addClass("over50");
}
$("#pc1").addClass("p" + fl_avg);
if (ml_avg >= 50) {
    $("#pc2").addClass("over50");
}
$("#pc2").addClass("p" + ml_avg);
if (hl_avg >= 50) {
    $("#pc3").addClass("over50");
}
$("#pc3").addClass("p" + hl_avg);
if (fr_avg >= 50) {
    $("#pc4").addClass("over50");
}
$("#pc4").addClass("p" + fr_avg);
if (mr_avg >= 50) {
    $("#pc5").addClass("over50");
}
$("#pc5").addClass("p" + mr_avg);
if (hr_avg >= 50) {
    $("#pc6").addClass("over50");
}
$("#pc6").addClass("p" + hr_avg);

}
          
          $('input[type="file"]').change(function(e) {
                var geekss = e.target.files[0].name;
                localStorage.setItem('filenameis',geekss); 
                // $("#filenameis").text(geekss);
  
            });
            function Neuropathy(val){
                swal(val);
            }
      </script>
   </body>
</html>