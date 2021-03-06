<?php
include_once 'common.php';

if(!isset($_SESSION)) 
{ 
    session_start(); 
} 

require_once '../admin/library/connect.php';

if(isset($_SESSION)) { 
$proimg = "SELECT * FROM  mod_customer 
LEFT JOIN tbl_member ON mod_customer.id_customer = tbl_member.id_data_role
WHERE id_customer = '".$_SESSION['id_customer']."' ";

$queryProimg = mysqli_query($objConnect, $proimg);
$resimgPro = mysqli_fetch_array($queryProimg);

$img = $resimgPro['img_path'];
} 

?>
<?php
require_once '../admin/library/connect.php';
function contact_usc($val){
        global $objConnect;
    
        $str = "SELECT * FROM contact WHERE id = '".$val."'";
        $query = mysqli_query($objConnect,$str);
        $result = mysqli_fetch_array($query);
    
        if($result['value']!=''){
            return $result;
        }else{
            return false;
        }
        
    }  

    $name            = contact_usc(1);
    $tel           	 = contact_usc(19);
	$phone           = contact_usc(20);
    $email           = contact_usc(27);
    $openshop        = contact_usc(4);
    $timeopen        = contact_usc(28);
	$heading         = contact_usc(3);
    $address         = contact_usc(18);
    $contact1        = contact_usc(7);
    $contact2        = contact_usc(8);
    $about1          = contact_usc(9);
    $about2          = contact_usc(10);
    $about3          = contact_usc(11);
    $abouttext       = contact_usc(32);
    $product         = contact_usc(29);
    $services        = contact_usc(30);
    $toservices      = contact_usc(31);
    $s_tec_name      = contact_usc(25);
    $pic_header      = contact_usc(17);
	$pic_logo		 = contact_usc(16);
	$pic_header		 = contact_usc(17);
	$titel		     = contact_usc(2);
	$s_tec_img		 = contact_usc(26);
?>
<?php
$sql_icon = "SELECT * FROM mod_footer  WHERE del_flg = 0 ";
$query_icon = mysqli_query($objConnect, $sql_icon);
?>

</style>
<!DOCTYPE html>
<html class="no-js" lang="th">
    <head>
        <!-- Meta Tags -->
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<meta name="keywords" content="SURATEC" />
		<meta name="description" content="SURATEC">
		<meta name='copyright' content='SURATEC'>
		
		<meta property="og:url"           content="https://www.suratec.co.th/home/?index=st" />
	    <meta property="og:type"          content="website" />
	    <meta property="og:title"         content="SURATEC" />
	    <meta property="og:description"   content="SURATEC" />
	    <meta property="og:image"         content="https://www.suratec.co.th/images/SURATEC%20LOGO.png" />

        <!-- Title Tag -->
        <title>SURATEC</title>
		<!-- Favicon -->
		<link rel="icon" type="image/png" href="../images/favicon.png">	
		<!-- Google Font -->
		<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800" rel="stylesheet">
		
		<!-- Bootstrap CSS -->
		<link rel="stylesheet" href="../css/bootstrap.min.css">
		<!-- Animate CSS -->
        <link rel="stylesheet" href="../css/animate.min.css">
		<!-- Animate Text CSS -->
        <link rel="stylesheet" href="../css/animate-text.css">
		<!-- Icofont CSS -->
        <link rel="stylesheet" href="../css/icofont.css">
		<!-- Font Awesome CSS -->
        <link rel="stylesheet" href="../css/font-awesome.min.css">
		<!-- Jquery Ui CSS -->
        <link rel="stylesheet" href="../css/jquery-ui.css">
		<!-- Flex Slider CSS -->
        <link rel="stylesheet" href="../css/flex-slider.min.css">
		<!-- Dzs Parallaxer CSS -->
        <link rel="stylesheet" href="../css/dzsparallaxer.min.css">
		<!-- Owl Carousel CSS -->
        <link rel="stylesheet" href="../css/owl.carousel.min.css">
		<!-- Slick Nav CSS -->
        <link rel="stylesheet" href="../css/slicknav.min.css">
		<!-- Youtube Player CSS -->
        <link rel="stylesheet" href="../css/ytplayer.min.css">
		<!-- FancyBox CSS -->
        <link rel="stylesheet" href="../css/fancybox.min.css">
		<!-- Nice Select CSS -->
        <link rel="stylesheet" href="../css/niceselect.css">
		<!-- Cube Portfolio CSS -->
        <link rel="stylesheet" href="../css/cubeportfolio.min.css">
		<!-- Magnific Popup CSS -->
        <link rel="stylesheet" href="../css/magnific-popup.css">
		
		<!-- Trendbiz CSS -->
        <link rel="stylesheet" href="style.css">
        <link rel="stylesheet" href="../css/responsive.css">
		
		<!-- Trendbiz Color -->
		<link rel="stylesheet" href="../css/skin/skin1.css">
		<!--<link rel="stylesheet" href="css/skin/skin2.css">-->
		<!--<link rel="stylesheet" href="css/skin/skin3.css">-->
		<!--<link rel="stylesheet" href="css/skin/skin4.css">-->
		<!--<link rel="stylesheet" href="css/skin/skin5.css">-->
		<!--<link rel="stylesheet" href="css/skin/skin6.css">-->
		<!--<link rel="stylesheet" href="css/skin/skin7.css">-->
		<!--<link rel="stylesheet" href="css/skin/skin8.css">-->
		<!--<link rel="stylesheet" href="css/skin/skin9.css">-->
		<!--<link rel="stylesheet" href="css/skin/skin10.css">-->
		<!--<link rel="stylesheet" href="css/skin/skin11.css">-->
		<!--<link rel="stylesheet" href="css/skin/skin12.css">-->
		<!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
		
		<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
		<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
		<!--[if lt IE 9]>
		  <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
		  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
		<![endif]-->
    </head>
	
<!-- Header -->
<style>
.center {
  display: block;
  margin-left: auto;
  margin-right: auto;
  width: 50%;
	}
</style>
<style>
	input 	{font-family: 'Sarabun', sans-serif;}
</style>	
	 <body class="box-bg">
		<div class="boxed-layout">
			<header class="header">
				<!-- Header Inner -->
				<div class="header-inner">
					<div class="container">
						<div class="row">
							<div class="col-lg-2 col-md-2 col-12">
								<!-- Logo -->
								<div class="logo">
									<a href="./?index=st">
									<img src="../uploads/mod_central_information/<?=$pic_logo['value']?>" width="110px;" height="50px;" alt="logo">
									</a>
								</div>
								<!--/ End Logo -->
								<div class="mobile-nav"></div>
							</div>
							<div class="col-lg-10 col-md-10 col-12">
								<div class="menu-area">
									<!-- Main Menu -->
									<nav class="navbar navbar-expand-lg">
										<div class="navbar-collapse">	
											<div class="nav-inner">	
												<ul class="nav main-menu navbar-nav"><!-- class="active" -->
													<li class="<?php if($_GET['index']=='st'){print 'active';}else{print '';} ?>"><a href="./?index=st"><?php echo $lang['MENU_HOME']; ?><!--?????????????????????<!--Home--></a></li>
													<li class="<?php if($_GET['product_and_service']=='st'){print 'active';}else{print '';} ?>"><a href="./product_and_service.php?product_and_service=st"><?php echo $lang['MENU_PRODUCT_AND_SERVICE']; ?><!--?????????????????????????????????????????????<!--Product And Service--></a></li>
													<li class="<?php if($_GET['about_us']=='st'){print 'active';}else{print '';} ?>"><a href="./about_us.php?about_us=st"><?php echo $lang['MENU_ABOUT_US']; ?><!--????????????????????????????????????<!--About Us--></a></li>
													<li class="<?php if($_GET['our_team']=='st'){print 'active';}else{print '';} ?>"><a href="./our_team.php?our_team=st"><?php echo $lang['MENU_our_team']; ?><!--????????????????????????????????????<!--Our Team--></a></li>
													<li class="<?php if($_GET['shop']=='st'){print 'active';}else{print '';} ?>"><a href="#">??????????????????<?php// echo $lang['MENU_our_team']; ?><!--????????????????????????????????????<!--Our Team--><i class="fa fa-angle-down"></i></a>
														<ul class="dropdown">
															<li><a href="./shop-list.php?shop=st"><span> ????????????????????????????????????<?php// echo $lang['MENU_Profile']; ?><!--Profile--></span> </a></li>
															<li><a href="./shop-grid.php?shop=st">????????????????????????????????????<?php// echo $lang['MENU_Playback_S']; ?></a></li>
															<li><a href="./cart.php?shop=st">??????????????????<?php// echo $lang['MENU_Playback_S']; ?></a></li>
															<li><a href="./checkout.php?shop=st">????????????????????????<?php// echo $lang['MENU_Playback_S']; ?></a></li>
														</ul>
													</li>
													<li class="<?php if($_GET['contact_us']=='st'){print 'active';}else{print '';} ?>"><a href="./contact_us.php?contact_us=st"><?php echo $lang['MENU_contact_us']; ?><!--???????????????????????????<!--Contact Us--></a></li>
													<?php if(isset($_SESSION["id_customer"])){?>
						<img src="<?php if($resimgPro['id_facebook'] != ''){
                        print $resimgPro['img_path'];
                        }else if( empty($img) ){ print"../img/bg-img/25.jpg"; }else{print "../uploads/customer/".$resimgPro['img_path'];} ?>"  style ="width: 50px; height: 50px;  border-radius: 100%; margin-top: 12px; margin-left: 5px;" alt="">
													<li class="<?php if($_GET['profile']=='st'){print 'active';}else{print '';} ?>"><a href="#"><?php if($resimgPro['id_facebook'] != '' ){print $resimgPro['fname'];}else{print $resimgPro['user_member'];}?><i class="fa fa-angle-down"></i></a>
														<ul class="dropdown">
															<li><a href="./profile.php?profile=st"><i class="fa fa-cogs" aria-hidden="true"></i><span> <?php echo $lang['MENU_Profile']; ?><!--Profile--></span> </a></li>
															<li><a href="./playback_sport.php"><?php echo $lang['MENU_Playback_S']; ?></a></li>
															<li><a href="coming-soon.php"><?php echo $lang['MENU_Playback_D']; ?></a></li>
															<li><a class="logout" href="<?='library/logout.php'?>"><i class="fa fa-sign-out logout" aria-hidden="true"></i> <?php echo $lang['MENU_logout']; ?><!--Logout--></a></li>
														</ul>
													</li>
													<?php }else{ ?>
													<li class="<?php if($_GET['Signin_Signup']=='st'){print 'active';}else{print '';} ?>"><a href="./Signin_Signup.php?Signin_Signup=st"><?php echo $lang['MENU_Signin_Signup']; ?><!--????????????????????????????????? / ???????????????????????????<!--Login / Register--></a></li>
													<?php } ?>
													
													<?php
													if($lang_file == 'lang.th.php'){
														echo '<li><a href="#">?????????: <img src="../images/th.png" style="display:unset; margin-bottom: 3px;"><i class="fa fa-angle-down"></i></a>
														<ul class="dropdown">
															<li style="background:#1BBC9B;"><a href="?lang=th"><span style="color:#fff;">?????????:</span> <img src="../images/th.png" style="display:unset; margin-bottom: 3px;"></a></li>
															<li><a href="?lang=en"><span>??????????????????:</span> <img src="../images/gb.png" style="display:unset; margin-bottom: 3px;"></a></li>
														</ul>
													</li>';
													}
													else{
														echo '<li><a href="#">English: <img src="../images/gb.png" style="display:unset; margin-bottom: 3px;"><i class="fa fa-angle-down"></i></a>
														<ul class="dropdown">
															<li><a href="?lang=th"><span>?????????:</span> <img src="../images/th.png" style="display:unset; margin-bottom: 3px;"></a></li>
															<li style="background:#1BBC9B;"><a href="?lang=en"><span style="color:#fff;">English:</span> <img src="../images/gb.png" style="display:unset; margin-bottom: 3px;"></a></li>
														</ul>
													</li>';
													 }
													?>
													<!--<li class="active"><a href="#">Home<i class="fa fa-angle-down"></i></a>
														<ul class="dropdown">
															<li><a href="index.html">Homepage V1</a></li>
															<li><a href="index2.html">Homepage V2</a></li>
														</ul>
													</li>	
													<li><a href="#">Pages<i class="fa fa-angle-down"></i></a>
														<ul class="dropdown">
															<li><a href="about.html">About Us</a></li>
															<li><a href="timeline.html">Timeline</a></li>
															<li><a href="pricing.html">Pricing Plans</a></li>
															<li><a href="faq.html">Faqs</a></li>
															<li><a href="404.html">Error Page</a></li>
															<li><a href="coming-soon.html">Coming Soon</a></li>
														</ul>
													</li>														
													<li><a href="#">Services<i class="fa fa-angle-down"></i></a>
														<ul class="dropdown">
															<li><a href="services.html">Our Services</a></li>
															<li><a href="#">Services Single<i class="fa fa-angle-right"></i></a>
																<ul class="dropdown sub-dropdown">
																	<li><a href="service-single.html">Service Single</a></li>	
																	<li><a href="service-single-gallery.html">Service Single Gallery</a></li>	
																	<li><a href="service-single-video.html">Service Single Video</a></li>	
																	<li><a href="service-single-full.html">Service Single Full</a></li>	
																</ul>
															</li>
														</ul>
													</li>													
													<li><a href="#">Portfolio<i class="fa fa-angle-down"></i></a>
														<ul class="dropdown">
															<li><a href="#">Portfolio<i class="fa fa-angle-right"></i></a>
																<ul class="dropdown sub-dropdown">
																	<li><a href="portfolio-full.html">Portfolio Full With</a></li>	
																	<li><a href="portfolio-masonry.html">Portfolio Full Masonry</a></li>	
																	<li><a href="portfolio.html">Portfolio 3 Column</a></li>	
																	<li><a href="portfolio-2-column.html">Portfolio 2 Column</a></li>	
																</ul>
															</li>
															<li><a href="#">Portfolio Single<i class="fa fa-angle-right"></i></a>
																<ul class="dropdown sub-dropdown">
																	<li><a href="portfolio-single.html">Portfolio Single</a></li>	
																	<li><a href="portfolio-single-gallery.html">Portfolio Single Gallery</a></li>	
																	<li><a href="portfolio-single-video.html">Portfolio Single Video</a></li>	
																	<li><a href="portfolio-single-full.html">Portfolio Single Full</a></li>	
																</ul>
															</li>
														</ul>
													</li>			
													<li><a href="#">Blog<i class="fa fa-angle-down"></i></a>
														<ul class="dropdown">
															<li><a href="blog-grid.html">Blog Grid</a></li>
															<li><a href="blog-grid-sidebar.html">Blog Grid Sidebar</a></li>
															<li><a href="blog-list.html">Blog List</a></li>
															<li><a href="blog.html">Blog List Sidebar</a></li>
															<li><a href="blog-single.html">Blog Single</a></li>
															<li><a href="blog-single-gallery.html">Blog Single Gallery</a></li>
															<li><a href="blog-single-video.html">Blog Single Video</a></li>
														</ul>
													</li>
													<li><a href="#">Shop<i class="fa fa-angle-down"></i></a>
														<ul class="dropdown">
															<li><a href="shop-grid.html">Shop Grid</a></li>
															<li><a href="shop-list.html">Shop List</a></li>
															<li><a href="shop-single.html">Shop Single</a></li>
															<li><a href="cart.html">Cart</a></li>
															<li><a href="checkout.html">Checkout</a></li>
														</ul>
													</li>													
													<li><a href="contact.html">Contact</a></li>-->					
												</ul>	
												<!-- Right Bar -->
												<div class="right-bar">
													<!-- Shopping Cart -->
													<div class="single-bar shopping">
														<a class="icon"><i class="fa fa-shopping-basket"></i><span class="count">0</span></a>
														<!-- Shopping Item -->
														<div class="shopping-item">
															<ul class="shopping-list">
																<!--<li>
																	<a href="#" class="remove" title="Remove this item"><i class="fa fa-remove"></i></a>
																	<a class="cart-img" href="#"><img src="images/product/product-1.jpg" alt="#"></a>
																	<h4><a href="#">Women navy blue</a></h4>
																	<p class="quantity">2x - <span class="amount">$52.94</span></p>
																</li>
																<li>
																	<a href="#" class="remove" title="Remove this item"><i class="fa fa-remove"></i></a>
																	<a class="cart-img" href="#"><img src="images/product/product-3.jpg" alt="#"></a>
																	<h4><a href="#">Black & White shirt</a></h4>
																	<p class="quantity">3x - <span class="amount">$88.50</span></p>
																</li>
																<li>
																	<a href="#" class="remove" title="Remove this item"><i class="fa fa-remove"></i></a>
																	<a class="cart-img" href="#"><img src="images/product/product-7.jpg" alt="#"></a>
																	<h4><a href="#">Digital watch</a></h4>
																	<p class="quantity">1x - <span class="amount">$150.00</span></p>
																</li>-->
															</ul>
															<div class="bottom">
																<p class="total">Total Amount:<span>0</span></p>
																<a href="checkout.php" class="btn animate">Checkout</a>
															</div>
														</div>
														<!--/ End Shopping Item -->
													</div>
													<!--/ End Shopping Cart -->
													<!-- Nav Icon -->
													<div class="single-bar nav-icon">
														<a class="bar"><i class="fa fa-bars"></i></a>
													</div>
													<!--/ End Nav Icon -->
												</div>
												<!--/ End Right Bar -->
											</div>
										</div>
									</nav>
									<!--/ End Main Menu -->							
								</div>
							</div>
						</div>
					</div>
				</div>
				<!--/ End Header Inner -->
				<!-- Sidebar Area -->
				<div class="side-area">
					<div class="cross">
						<a class="btn"><i class="fa fa-remove" style="margin-top: 10;"></i></a>
					</div>
					<!-- Logo -->
					<div class="logo">
						<a href="./?index=st"><img src="../uploads/mod_central_information/<?=$pic_logo['value']?>" width="110px;" height="50px;" alt="Logo"></a>
					</div>
					<!--/ End Logo -->
					<!-- Menu -->
					<ul class="nav navbar-nav">			
						<li><a href="about_us.php?about_us=st"><?php echo $lang['MENU_ABOUT_US']; ?><!--About Us--></a></li>				
						<li><a href="our_team.php?our_team=st"><?php echo $lang['MENU_our_team']; ?> <!--Our_team--></a></li>				
						<li><a href="product_and_service.php?product_and_service=st"><?php echo $lang['MENU_PRODUCT_AND_SERVICE']; ?><!--Product And Service--></a></li>				
						<!--<li><a href="shop.html">Our Product</a></li>				
						<li><a href="blog.html">Latest News</a></li>-->				
						<li><a href="contact_us.php?contact_us=st"><?php echo $lang['MENU_contact_us']; ?><!--Contact Us--></a></li>		
					</ul>	
					<!--/ End Menu -->
					<!-- Side Bottom -->
					<div class="side-bottom">
						<ul class="social">
							<?php while($res_icon = mysqli_fetch_array($query_icon)){  ?>
							<li><a href="<?=$res_icon['linked']?>"><img src="../uploads/mod_manage_links/<?=$res_icon['icon']?>" alt="" width="30" style="border-radius: 20%;"></a></li>
							<?php  } ?>
							<!--<li><a href="#"><i class="icofont icofont-social-twitter"></i></a></li>
							<li><a href="#"><i class="icofont icofont-social-linkedin"></i></a></li>
							<li><a href="#"><i class="icofont icofont-social-youtube"></i></a></li>
							<li><a href="#"><i class="icofont icofont-social-dribbble"></i></a></li>-->
						</ul>
						<?php $copyright_Y = '2019'; ?>
              			 <span>Copyright &copy; <?=$copyright_Y?> - <?php if($copyright_Y === date('Y')){echo 'Present.';}else{echo date('Y');}?> www.suratec.co.th, All Right Reserved. Developed by <a href="https://www.tpse.co.th" target="_blank"><span><br>TPS Enterprise</span> </a>
					</div>
					<!-- End Side Bottom -->
				</div>
				<!--/ End Sidebar Area -->	
			</header>
			<!--/ End Header -->