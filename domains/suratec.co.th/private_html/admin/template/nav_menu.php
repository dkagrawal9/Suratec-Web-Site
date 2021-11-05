<?php
  require '../library/connect.php';
  $url = $_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];
  $cut_url = explode('/', $url);

  $num_fo = count($cut_url)-2;
  $num_fi = count($cut_url)-1;

  $folder = $cut_url[$num_fo];
  $file = $cut_url[$num_fi];

  $local = $cut_url[$num_fo].'/'.$cut_url[$num_fi];

  $str_local = 'SELECT link_system,type FROM system WHERE link_system = "'.$local.'"';
  $query_local = mysqli_query($objConnect,$str_local);
  $result_local = mysqli_fetch_array($query_local);

  //query member for get id_data_role
  $str_member = "SELECT * FROM tbl_member WHERE id_member = '".$_SESSION['user_member']."'";
  $query_member = mysqli_query($objConnect,$str_member);
  $result_member = mysqli_fetch_array($query_member);
  //query employee

  $str_tbl = "SHOW TABLES LIKE 'mod_employee'";
  $query_tbl = mysqli_query($objConnect,$str_tbl);
  if($num = mysqli_num_rows($query_tbl)== 1){

    $str_em = "SELECT * FROM mod_employee WHERE id_employee = '".$result_member['id_data_role']."'";
    $query_em = mysqli_query($objConnect,$str_em);
    $result_em = mysqli_fetch_array($query_em);

    $module = explode(',',$result_em['task_view']);
  }else{
    $module = '';
  }


  


?>

<style type="text/css">
  .nav-custom{
    width: 50%;
    text-align: center;
  }
  .nav-tabs-set>li>a {
    margin-right: 0;
    border:none;
    transition: 0.4s;
  }
  .nav-set>li>a:hover{
    background:none;
    border:none;
    color: white;
  }
  .nav-tabs-set>li.active>a.nav-system{
    background-color: #3c8dbc !important;
    border:none;
    color: white;
  }
  .nav-tabs-set>li.active>a.nav-design{
    background-color: #fdad2a !important;
    border:none;
    color: white;
  }
  .border_orage{
    border-bottom: 3px solid #fdad2a;
  }
  .border_blue{
    border-bottom: 3px solid #3c8dbc;
  }
  .skin-blue .sidebar-menu>li.active>.left-design{
    border-left-color:orange !important;
  }
  .fixed .content-wrapper, .fixed .right-side {
    padding-top: 50px;
  }
</style>
  <header class="main-header">
    <!-- Logo -->
    <a href="http://www.suratec.co.th" class="logo">
    <!-- <a href="https://www.suratec.co.th/admin" target="_blank" class="logo"> -->
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><?PHP echo HEAD_LOGO_MINI; ?></span>
      <!-- logo for regular state and mobile devices -->
      <?php echo HEAD_LOGO; ?>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">      
      <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
        <span class="sr-only">Toggle navigation</span>
      </a>
      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
          <!-- <li>
            <a href="#" class="lang" data-id="th">
               <img class="flag-lang" src="../img/th-fl.png" width="22" height="15">
            </a>
          </li> -->
          <!-- <li>
            <a href="#" class="lang" data-id="aud">
               <img class="flag-lang" src="../img/en-fl.jpg" width="22" height="15">
            </a>
          </li> -->
          
          <!-- Messages: style can be found in dropdown.less-->
<?php 
  $str_member = "SELECT * FROM tbl_member WHERE id_member = '".$_SESSION['user_member']."'";
  $query_member = mysqli_query($objConnect,$str_member);
  $result_member = mysqli_fetch_array($query_member);

  $str_tbl = "SHOW TABLES LIKE 'mod_employee'";
  $query_tbl = mysqli_query($objConnect,$str_tbl);
  if($num = mysqli_num_rows($query_tbl)== 1){

    $str_em = "SELECT * FROM mod_employee WHERE id_employee = '".$result_member['id_data_role']."'";
    $query_em = mysqli_query($objConnect,$str_em);
    $result_em = mysqli_fetch_array($query_em);

    $link_id = $result_em['id_employee'];
    $position = $result_em['position'];

    $str_image = "SELECT * FROM mod_employee_image WHERE id_employee = '".$result_member['id_data_role']."'";
    $query_image = mysqli_query($objConnect,$str_image);
    $num_image = mysqli_num_rows($query_image);
    if($num_image > 0){
      $result_image = mysqli_fetch_array($query_image);
      $dir_image = $result_image['name_image'];
      $image = '../../uploads/employee/'.$dir_image;
    }else{
      $image = LOGO;
    }
  }else{
    $position = '';
    $link_id = '';
    $image = LOGO;
  }

  if($result_member['permission']=='Super_admin'){
    $text_header = 'Super Admin';
  }else{
    $text_header = $result_em['username'];
  }
  $notificationCount = 0;

  if (!empty($result_member['id_data_role'])) {
    $notifResult = $objConnect->query("SELECT COUNT(*) count FROM notifications WHERE `status`=1 AND id_user='".$result_member['id_data_role']."'")->fetch_object();
    $notificationCount = $notifResult->count;
  }

?>
          
          <li class="nav-item dropdown">
            <a class="nav-link" href="../notifications/index.php">
              <i class="fa fa-bell"></i>
              <span id="notification-count">&nbsp;(<span><?php echo $notificationCount ?></span>)</span>
            </a>
          </li>
          <!-- User Account: style can be found in dropdown.less -->
          <li class="dropdown user user-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <img src="<?php echo $image; ?>" class="user-image" alt="User Image">
              <span class="hidden-xs"><?PHP echo $text_header; ?></span>
            </a>
            <ul class="dropdown-menu">
              <!-- User image -->
              
              <li class="user-header">
                <img src="<?php echo $image; ?>" class="img-circle" alt="User Image">

                <p>
                  <?php echo $result_member['permission']; ?>
                  <small><?php echo $position; ?></small>
                </p>
              </li>
              
              <!-- Menu Footer-->
              <li class="user-footer">
<?php

if($cut_url[$num_fo]=='mod_employee'){
      $link = 'front-edit.php?id='.$link_id.'';
    }else{
      $link = '../mod_employee/front-edit.php?id='.$link_id.'';
    }

if($result_member['permission']!='Super_admin'){
  if($result_member['permission']!='Read'){
?>
                <div class="pull-left">
                  <a href="<?php echo $link; ?>" class="btn btn-default btn-flat"><?=lang('แก้ไขโปรไฟล์','Profile')?></a>
                </div>
<?php
  }
}
?>
                
                <div class="pull-right">
                  <a href="?logout=main" class="btn btn-default btn-flat"><?=lang('ออกจากระบบ','Signout')?></a>
                </div>
              </li>
            </ul>
          </li>        
        </ul>
      </div>
        <!-- Sidebar toggle button-->
    </nav>
  </header>
  <!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image" style="height: 50px;">          
            <img src="<?php echo $image; ?>" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p><a href="" target="_blank" style="color: white;">
            <i class="fa fa-circle text-success"></i>
          </a><?PHP echo $text_header; ?></p>
          
          <div id="realtime" style="padding-left: 15px;"></div>
        </div>
      </div>
      <!-- search form -->
      <!-- <form action="#" method="get" class="sidebar-form">
        <div class="input-group">
          <input type="text" name="q" class="form-control" placeholder="Search...">
          <span class="input-group-btn">
                <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
                </button>
              </span>
        </div>
      </form> -->
      <!-- /.search form -->
      <!-- sidebar menu: : style can be found in sidebar.less -->
<?php 


echo '<script>
        var local = "'.$result_local['type'].'";
      </script>';

if($result_local['type']==1){
  $system_active = 'active';
  $design_active = '';
  $color_nav = 'border_blue';
}elseif($result_local['type']==2){
  $system_active = '';
  $design_active = 'active';
  $color_nav = 'border_orage';
}else{
  $system_active = 'active';
  $design_active = '';
  $color_nav = 'border_blue';
}

?>
      <ul class="sidebar-menu" data-widget="tree">
<?php
if($result_member['permission']=='Super_admin'){
  if($system_config=='1'){
    if($cut_url[$num_fo]=='page_system'){
      $active = 'active';
      $link = 'front-manage.php?page="manage"';
    }else{
      $active = '';
      $link = '../page_system/front-manage.php?page="manage"';
    }
}
    ?>
            <li class="<?php echo $active; ?>">
              <a href="<?php echo $link; ?>">
                <i class="fa fa-circle-o text-yellow"></i>
                <span>SYSTEM</span>
              </a>
            </li>
 <?php }
?>
        <ul class="nav nav-tabs nav-tabs-set nav-set <?php echo $color_nav ?>">
              <li class="nav-custom nav-custom-system <?php echo $system_active; ?>" >
                <a href="#tab-system" data-toggle="tab" aria-expanded="true" style="border-radius: 0" class="nav-desy nav-system" id="nav-system">Content</a>
              </li>
              <li class="nav-custom nav-custom-design <?php echo $design_active; ?>">
                <a href="#tab-design" data-toggle="tab" aria-expanded="false" style="border-radius: 0" class="nav-desy nav-design" id="nav-design">Design</a>
              </li>
            </ul>
        </ul>
      </ul>
      <div class="tab-content">
        <div class="tab-pane <?php echo $system_active; ?>" id="tab-system">
          <ul class="sidebar-menu" data-widget="tree">
            <!-- <li class="active">
              <a href="#" data-link="../page_system/front-manage.php" class="link_nav">
                <i class="fa fa-circle-o text-yellow"></i>
                <span>SYSTEM</span>
              </a>
            </li> -->



            <li class="header"><?=lang('หน้าหลัก','Main')?></li>
<?php 
if($cut_url[$num_fo]=='page_home'){
  $active = 'active';
  $link = 'index.php';
}else{
  $active = '';
  $link = '../page_home/index.php';
}
?>
            <li class="<?php echo $active; ?>">
              <a href="<?php echo $link; ?>">
                <i class="fa fa-th-large"></i> <span><?=lang('แดชบอร์ด','Dashboard')?></span>
                <span class="pull-right-container">
                  <!-- <small class="label pull-right bg-green">new</small> -->
                </span>
              </a>
            </li>
            <li class="header"><?=lang('จัดการระบบ','Manage System')?></li>
<?php 

$strSQL = "SELECT * FROM system WHERE level = '1' AND type = '1' ORDER BY sort";
$objQuery = mysqli_query($objConnect,$strSQL);

$cont = 1;
while ($objResult = mysqli_fetch_array($objQuery)) {
  //check task_view in system of level 1
  if($result_member['permission']!='Super_admin'){
    if(!in_array($objResult['id_system'],$module)){
      continue;
    }
  }
  //------end check--------
  $link_b = $objResult['link_system'];
  $cut_link = explode('/', $link_b);
  if($objResult['link_system']=='#'){
    $link = '#';
    $tree = 'treeview';
     if($folder==$cut_link[0]){
      $active = 'active';
    }else{
      $active = '';
    }
  }else{
    if($folder==$cut_link[0]){ //------------------------------mod_product == mod_product
      $link = $cut_link[1];    //------------------------------front-add.php
      if($file==$cut_link[1]){
        $active = 'active';
        $id_cookie = $objResult['id_system'];
      }else{
        $active = '';
      }   
    }else{
      $link = '../'.$link_b;   //------------------------------mod_nmorder/front-add.php
      $active = '';
    }

    $tree = '';
  }
  if($objResult['icon']==''){
    $icon = '<i class="fa fa-circle-o"></i>';
  }else{
    $icon = $objResult['icon'];
  }

  $urlCut = explode("/",$_SERVER['REQUEST_URI']);
  $appActive = ((end($urlCut) == 'appointments-calendar.php') OR (end($urlCut) == 'appointments.php')) ? 'active' : '';  

  $urlCut = explode("/",$_SERVER['REQUEST_URI']);
  $myPatientActive = end($urlCut) == 'my-patients.php' ? 'active' : '';  



?>

            <li class="check_system_level1 
                       check_top_level1-<?php echo $objResult['id_system']; ?> 
                       <?php echo $tree.' '.$active; ?>">
              <a href="#" data-link="<?php echo $link; ?>" data-id="<?php echo $objResult['id_system']; ?>" class="setcookie">
              <?php if($cont > 9){echo ''.$cont.'.';}else{echo '0'.$cont.'.';}  ?> <?php echo $icon ?> <span><?php echo lang_menu($objResult['name_system'],$objResult['name_system_en']); ?></span>
<?php 
$strSQL1 = "SELECT * FROM system WHERE level = '2' AND groups = '".$objResult['id_system']."'";
$objQuery1 = mysqli_query($objConnect,$strSQL1);
$numQuery1 = mysqli_num_rows($objQuery1);
$cont2 = $cont++;
if($numQuery1<=0)
{
?>
              </a>
            </li>
<?php
continue;
}else{?>
                <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                </span>
              </a>
              <ul class="treeview-menu">
<?php 
 }
$cont3=1;
while($objResult1 = mysqli_fetch_array($objQuery1)){
  
  //check task_view in system of level 2
  if($result_member['permission']!='Super_admin'){
    if(!in_array($objResult1['id_system'],$module)){
      continue;
    }
  }
  //------end check--------
  $link_b1 = $objResult1['link_system'];
  $cut_link1 = explode('/', $link_b1);
  if($objResult1['link_system']=='#'){
    $link1 = '#';
    $tree1 = 'treeview';
    if($folder==$cut_link[0]){
      $active1 = 'active';
    }else{
      $active1 = '';
    }
  }else{
    if($folder==$cut_link1[0]){
      $link1 = $cut_link1[1];
      if($file==$cut_link1[1]){
        $active1 = 'active';
        $id_cookie = $objResult1['id_system'];
      }else{
        $active1 = '';
      }
    }else{
      $link1 = '../'.$link_b1;
      $active1 = '';
    }

    $tree1 = '';
  }
  if($objResult1['icon']==''){
    $icon1 = '<i class="fa fa-circle-o"></i>';
  }else{
    $icon1 = $objResult1['icon'];
  }
?>
                <li class="check_system_level2 
                           check_top_level2-<?php echo $objResult1['id_system']; ?>                                               
                           <?php echo $tree1.' '.$active1; ?>"
                    data-top1="<?php echo $objResult['id_system']; ?>">
                  <a href="#" data-link="<?php echo $link1; ?>" data-id="<?php echo $objResult1['id_system']; ?>" class="setcookie">
                  <?php if($cont3 > 9){echo ''.$cont2.'.'.$cont3;}else{if($cont2 > 9){echo ''.$cont2.'.0'.$cont3;}else{echo '0'.$cont2.'.0'.$cont3;}; }  ?>  <?php echo $icon1; ?> <?php echo lang_menu($objResult1['name_system'],$objResult1['name_system_en']); ?>
<?php 
$strSQL2 = "SELECT * FROM system WHERE level = '3' AND groups = '".$objResult1['id_system']."'";
$objQuery2 = mysqli_query($objConnect,$strSQL2);
$numQuery2 = mysqli_num_rows($objQuery2);
$cont3++;
if($numQuery2<=0)
{
?>
                  </a>
                </li>
<?php
continue;
}else{?>
                    <span class="pull-right-container">
                      <i class="fa fa-angle-left pull-right"></i>
                    </span>
                  </a>
                  <ul class="treeview-menu">
<?php
}
while($objResult2 = mysqli_fetch_array($objQuery2)){
  //check task_view in system of level 3
  if($result_member['permission']!='Super_admin'){
    if(!in_array($objResult2['id_system'],$module)){
      continue;
    }
  }
  //------end check--------
  $link_b2 = $objResult2['link_system'];
  $cut_link2 = explode('/', $link_b2);
  if($objResult2['link_system']=='#'){
    $link2 = '#';
    $tree2 = 'treeview';
  }else{
    if($folder==$cut_link2[0]){
      $link2 = $cut_link2[1];
    }else{
      $link2 = '../'.$link_b2;
    }

    $tree2 = '';
  }
  if($objResult2['icon']==''){
    $icon2 = '<i class="fa fa-circle-o"></i>';
  }else{
    $icon2 = $objResult2['icon'];
  }

  if($folder==$cut_link2[0]){
    if($file==$cut_link2[1]){
      $active2 = 'active';
      $id_cookie = $objResult2['id_system'];
    }else{
      $active2 = '';
    }
  }else{
      $active2 = '';
  }
  
?>
                    <li class="check_system_level3 <?php echo $tree2.' '.$active2; ?> "
                        data-top1="<?php echo $objResult['id_system']; ?>"
                        data-top2="<?php echo $objResult1['id_system']; ?>">
                      <a href="#" data-link="<?php echo $link2; ?>" data-id="<?php echo $objResult2['id_system']; ?>" class="setcookie">
                        <?php echo $icon2; ?> <?php echo lang_menu($objResult2['name_system'],$objResult2['name_system_en']); ?>
                      </a>
                    </li>
<?php 
 
}
?>
                  </ul>
                </li>
<?php
}
?>
              </ul>
            </li>
<?php

}// END LEVEL 1 
?>
<li class="<?= $appActive ?> check_top_level1-1 ">
        <a href="#" data-link="../mod_customer/appointments-calendar.php" data-id="1" class="setcookie">
         <i class="fa fa-calendar"></i> <span><?=lang('Appointments','Appointments')?></span>
        <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
        </span>
        </a>
        <ul class="treeview-menu">
        <li class="check_system_level2 check_top_level2-13" data-top1="1">
            <a href="#" data-link="../mod_customer/appointments-calendar.php" data-id="13" class="setcookie">
                 <i class="fa fa-circle-o"></i> Calander View
            </a>
            <a href="#" data-link="../mod_customer/appointments.php" data-id="13" class="setcookie">
                 <i class="fa fa-circle-o"></i> List View
            </a>
        </li>
        </ul>
    </li>

<li class="<?= $myPatientActive ?>">
  <a href="../mod_customer/my-patients.php">
    <i class="fa fa-users"></i> <span>My Patients</span>
    <span class="pull-right-container">
    </span>
  </a>
</li>
          </ul>
        </div>
        <div class="tab-pane <?php echo $design_active; ?>" id="tab-design">
          <ul class="sidebar-menu" data-widget='tree'>
            <li class="header">บริหารหน้าหลัก</li>
<?php
$strSQL = "SELECT * FROM system WHERE level = '1' AND type = '2'  ORDER BY sort";
$objQuery = mysqli_query($objConnect,$strSQL);
$i = 1;
$start = $i++;
while ($objResult = mysqli_fetch_array($objQuery)) {
  //check task_view in design of level 1
  if($result_member['permission']!='Super_admin'){
    if(!in_array($objResult['id_system'],$module)){
      continue;
    }
  }
  //------end check--------
  $link_b = $objResult['link_system'];
  $cut_link = explode('/', $link_b);
  if($objResult['link_system']=='#'){
    $link = '#';
    $tree = 'treeview';
     if($folder==$cut_link[0]){
      $active = 'active';
    }else{
      $active = '';
    }
  }else{
    if($folder==$cut_link[0]){ //------------------------------mod_product == mod_product
      $link = $cut_link[1];    //------------------------------front-add.php
      if($file==$cut_link[1]){
        $active = 'active';
        $id_cookie = $objResult['id_system'];
      }else{
        $active = '';
      }   
    }else{
      $link = '../'.$link_b;   //------------------------------mod_nmorder/front-add.php
      $active = '';
    }

    $tree = '';
  }
  if($objResult['icon']==''){
    $icon = '<i class="fa fa-circle-o"></i>';
  }else{
    $icon = $objResult['icon'];
  }
?>
            <li class="check_design_level1 
                       check_top_level1-<?php echo $objResult['id_system']; ?> 
                      <?php echo $tree.' '.$active; ?>">
              <a class="left-design setcookie" href="#" data-link="<?php echo $link; ?>" data-id="<?php echo $objResult['id_system']; ?>" >
             <?php echo $icon ?> <span><?php echo lang_menu($objResult['name_system'],$objResult['name_system_en']); ?></span>
<?php 
$strSQL1 = "SELECT * FROM system WHERE level = '2' AND groups = '".$objResult['id_system']."'";
$objQuery1 = mysqli_query($objConnect,$strSQL1);
$numQuery1 = mysqli_num_rows($objQuery1);
if($numQuery1<=0)
{
?>
              </a>
            </li>
<?php
continue;
}else{?>
                <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                </span>
              </a>
              <ul class="treeview-menu">
<?php 
 }
while($objResult1 = mysqli_fetch_array($objQuery1)){
   //check task_view in design of level 2
  if($result_member['permission']!='Super_admin'){
    if(!in_array($objResult1['id_system'],$module)){
      continue;
    }
  } 
  //------end check-------
  $link_b1 = $objResult1['link_system'];
  $cut_link1 = explode('/', $link_b1);
  if($objResult1['link_system']=='#'){
    $link1 = '#';
    $tree1 = 'treeview';
    if($folder==$cut_link[0]){
      $active1 = 'active';
    }else{
      $active1 = '';
    }
  }else{
    if($folder==$cut_link1[0]){
      $link1 = $cut_link1[1];
      if($file==$cut_link1[1]){
        $active1 = 'active';
        $id_cookie = $objResult1['id_system'];
      }else{
        $active1 = '';
      }
    }else{
      $link1 = '../'.$link_b1;
      $active1 = '';
    }

    $tree1 = '';
  }
  if($objResult1['icon']==''){
    $icon1 = '<i class="fa fa-circle-o"></i>';
  }else{
    $icon1 = $objResult1['icon'];
  }
?>
                <li class="check_design_level2 
                           check_top_level2-<?php echo $objResult1['id_system']; ?>     
                          <?php echo $tree1.' '.$active1; ?>"
                    data-top1="<?php echo $objResult['id_system']; ?>">
                  <a class="left-design setcookie" href="#" data-link="<?php echo $link1; ?>" data-id="<?php echo $objResult1['id_system']; ?>">
                    <?php echo $icon1; ?> <?php echo lang_menu($objResult1['name_system'],$objResult1['name_system_en']); ?>
<?php 
$strSQL2 = "SELECT * FROM system WHERE level = '3' AND groups = '".$objResult1['id_system']."'";
$objQuery2 = mysqli_query($objConnect,$strSQL2);
$numQuery2 = mysqli_num_rows($objQuery2);
if($numQuery2<=0)
{
?>
                  </a>
                </li>
<?php
continue;
}else{?>
                    <span class="pull-right-container">
                      <i class="fa fa-angle-left pull-right"></i>
                    </span>
                  </a>
                  <ul class="treeview-menu">
<?php
}
while($objResult2 = mysqli_fetch_array($objQuery2)){
  //check task_view in design of level 3
  if($result_member['permission']!='Super_admin'){
    if(!in_array($objResult2['id_system'],$module)){
      continue;
    }
  }
  //------end check--------
  $link_b2 = $objResult2['link_system'];
  $cut_link2 = explode('/', $link_b2);
  if($objResult2['link_system']=='#'){
    $link2 = '#';
    $tree2 = 'treeview';
  }else{
    if($folder==$cut_link2[0]){
      $link2 = $cut_link2[1];
    }else{
      $link2 = '../'.$link_b2;
    }

    $tree2 = '';
  }
  if($objResult2['icon']==''){
    $icon2 = '<i class="fa fa-circle-o"></i>';
  }else{
    $icon2 = $objResult2['icon'];
  }

  if($file==$cut_link2[1]){
    $active2 = 'active go_to-top';
    $id_cookie = $objResult2['id_system'];
  }else{
    $active2 = '';
  }
?>
                    <li class="check_design_level3 <?php echo $tree2.' '.$active2; ?> "
                        data-top1="<?php echo $objResult['id_system']; ?>"
                        data-top2="<?php echo $objResult1['id_system']; ?>">
                      <a class="left-design setcookie" href="#" data-link="<?php echo $link2; ?>" data-id="<?php echo $objResult3['id_system']; ?>">
                        <?php echo $icon2; ?> <?php echo lang_menu($objResult2['name_system'],$objResult2['name_system_en']); ?>
                      </a>
                    </li>
<?php 
}
?>
                  </ul>
                </li>
<?php
}
?>
              </ul>
            </li>
<?php
}// END LEVEL 1 
?>

          </ul>
        </div>
      </div>
    </section>
    <!-- /.sidebar -->
  </aside>
  <script src="../bower_components/jquery/dist/jquery.min.js"></script>
  <script type="text/javascript">

        function setCookie(key, value) {
            var expires = new Date();
            expires.setTime(expires.getTime() + (1 * 24 * 60 * 60 * 1000));
            document.cookie = key + '=' + value + ';expires=' + expires.toUTCString()+"; path=/www.prfoodland.com/admin"; 
        }

        // function getCookie(key) {
        //     var keyValue = document.cookie.match('(^|;) ?' + key + '=([^;]*)(;|$)');
        //     return keyValue ? keyValue[2] : null;
        // }

    $(document).ready(function() {

      $(document).on('click', '.lang', function(event) {
        var lang = $(this).attr('data-id');
        setCookie('lang',lang);
        location.reload();
      });

       $(document).on('click', '.setcookie', function () {
            var i = $(this).attr('data-id');
            var link = $(this).attr('data-link');
            // alert(i);
            setCookie('id_system', i);
            location.href = link;
        })

      $(document).on('click', '#nav-system', function(event) {
        $('.nav-tabs-set').removeClass('border_orage');
        $('.nav-tabs-set').addClass('border_blue');
      });
      $(document).on('click', '#nav-design', function(event) {
        $('.nav-tabs-set').removeClass('border_blue');
        $('.nav-tabs-set').addClass('border_orage');
      });

      function fetch_active(){
        if(local==1){
          var text = 'system';
        }else{
          var text = 'design';
        }

        var i = 0;
        
        $('.check_'+text+'_level3').each(function(){
          if($(this).hasClass('active')){
            i++;
            var top1 = $(this).attr('data-top1');
            var top2 = $(this).attr('data-top2');
            $('.check_top_level2-'+top2).addClass('active');
            $('.check_top_level1-'+top1).addClass('active');
            $('.check_top_level2-'+top2).addClass('menu-open');
            $('.check_top_level1-'+top1).addClass('menu-open');
          }
        });
        if(i<=0){
          $('.check_'+text+'_level2').each(function(){
            if($(this).hasClass('active')){
              var top1 = $(this).attr('data-top1');
              $('.check_top_level1-'+top1).addClass('active');
              $('.check_top_level1-'+top1).addClass('menu-open');
            }
          });
        }
      }
      fetch_active();
      // $(document).on('click', '.link_nav',function(){
      //   var redirectUrl = $(this).attr('data-link');
      //   var value = 'page';
      //   myRedirect(redirectUrl,value);
      // });
    });
    // function myRedirect (redirectUrl,value) {
    //     var form = $('<form action="' + redirectUrl + '" method="post">' +
    //     '<input type="text" name="page" value="' + value + '" />' +
    //     '</form>');
    //     $('body').append(form);
    //     $(form).submit();
    // };
  </script>

<!-- ============================================================== -->
			    <script>
var first = true;

var today = new Date();

function startTime() {

    today.setSeconds(today.getSeconds() + 1);

    var h = today.getHours();
    var m = today.getMinutes();
    var s = today.getSeconds();
    m = checkTime(m);
    s = checkTime(s);
	document.getElementById('realtime').innerHTML =
        "เวลาปัจจุบัน : " + h + ":" + m + ":" + s;


    var t = setTimeout(startTime, 1000);
}

function checkTime(i) {
    if (i < 10) {
        i = "0" + i
    }; // add zero in front of numbers < 10
    return i;
}

$(function() {
    startTime();
});
			    </script>
