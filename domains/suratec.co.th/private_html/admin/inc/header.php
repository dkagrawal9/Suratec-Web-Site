<?php
require_once "admin/library/connect.php";
require_once "lang.php";
require_once "functions.php";
?>
<style type="text/css">
	.logo img{
		top:5px !important;
	}
	<?php
	$logo = logo();
	if($logo!==false){
		if($logo['name']!==''){
?>
				.pace,.theme-is-dark .pace { 
					background-image: url(uploads/logo/<?=$logo['name']?>) !important; 
				}
<?php
		}
	}
?>	
</style>

	<div class="preloader-cover-screen">
	</div>
	<div class="responsive-menu-wrap">
	<span class="mobile-menu-icon"><i class="mobile-menu-icon-toggle feather-icon-menu"></i></span>
		<div class="mobile-menu-toggle">
			<div class="logo-mobile">
<?php
	$logo = logo();
	if($logo!==false){
		if($logo['name']!==''){
?>
				<a href="<?=$logo['page']?>" target="<?=$logo['target']?>">
					<img class="logoimage" src="uploads/logo/<?=$logo['name']?>" alt="logo" />
				</a>	
<?php
		}
	}
?>				
			</div>
		</div>
	</div>
	<div class="responsive-mobile-menu">
		<div class="mobile-wpml-lang-selector-wrap">
		</div>
		<div class="mobile-social-header">				
			<div class="footer-column">
				
			</div>	
		</div>
		<!-- <form method="get" id="mobile-searchform" action="http://www.siamdragonshow.com/site/">
			<input type="text" value="" name="s" id="ms" class="right" />
			<button id="mobile-searchbutton" title="Search" type="submit"><i class="feather-icon-search"></i></button>
		</form>	 -->
		<nav>
			<ul id="menu-en_menu" class="mtree">
<?php
	$i=0;
	foreach (query_main() as $key => $value) {
		if(isset($_COOKIE['lang'])){
			switch ($_COOKIE['lang']) {
				case 'th':
					 $name = $value['name'];
				break;
				case 'en':
					 $name = $value['name_en'];
				break;
				case 'ch':
					 $name = $value['name_ch'];
				break;
			}
		}else{
			$name = $value['name'];
		}

		switch ($value['page']) {
			case 'index.php':
				$link = 'Site';
				break;
			case 'about.php':
				$link = 'About';
				break;
			case 'contact.php':
				$link = 'Contact';
				break;
			case 'show.php':
				$link = 'Show';
				break;
			case 'booking.php':
				$link = 'Booking';
				break;
			case 'policy-data.php':
				$link = 'Quality-Policy';
				break;
			case 'policy-personal.php':
				$link = 'Private-Policy';
				break;
			case 'policy-refunds.php':
				$link = 'Exchange-Policy';
				break;
			case 'policy-service.php':
				$link = 'Agreement';
				break;
			case 'how-to-pay.php':
				$link = 'How-to-pay';
				break;
			case 'event.php':
				$link = 'Event';
				break;
			default:
				$link = $value['page'];
				break;
		}
		$i++;
?>
				<li id="menu-item-8866" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-<?=$i?>">
					<a href="<?=$link?>"><?=$name?></a>
<?php
	if(check_sub($value['id_menu'])!==false){
		$query_sub = query_sub($value['id_menu']);
		?>
								<ul class="sub-menu"  style="color: white;">
		<?php
			foreach ($query_sub as $key_sub => $value_sub) {
				$name_sub = lang_menu($value_sub['name_sub'],$value_sub['name_en_sub'],$value_sub['name_ch_sub']);
				$link_sub = convert_page($value_sub['page']);
				?>
									<li class="lang-item lang-item-33 lang-item-en lang-item-first current-lang menu-item menu-item-type-custom menu-item-object-custom current_page_item menu-item-home menu-item-8867-en">
										<a  href="<?=$link_sub?>">
											<span style="margin-left:0.3em;"><?=$name_sub?></span>
										</a>
									</li>
				<?php

			}
				?>
								</ul>
				<?php

	}
?>
				</li>
<?php
	}

$data = fistmenu();
?>
				<li id="menu-item-8867" class="pll-parent-menu-item menu-item menu-item-type-custom menu-item-object-custom current-menu-parent menu-item-has-children menu-item-8867">
					<a href="#">
						<img src="admin/img/<?=$data['img']?>" title="English" alt="English" width="20" height="15" />
						<span style="margin-left:0.3em;"><?=$data['name']?></span>
					</a>
					<ul class="sub-menu" style="color: white;">
						<li class="lang-item lang-item-33 lang-item-en lang-item-first current-lang menu-item menu-item-type-custom menu-item-object-custom current_page_item menu-item-home menu-item-8867-en">
							<a hreflang="en-GB" lang="en-GB" data-id="en" class="lang" style="cursor: pointer;">
								<img src="admin/img/en-fl.jpg" title="English" alt="English" width="20" height="15" />
								<span style="margin-left:0.3em;">English</span>
							</a>
						</li>
						<li class="lang-item lang-item-36 lang-item-zh menu-item menu-item-type-custom menu-item-object-custom menu-item-8867-zh">
							<a hreflang="zh-CN" lang="zh-CN" data-id="ch" class="lang" style="cursor: pointer;">
								<img src="admin/img/chi-fl.jpg" title="中文 (中国)" alt="中文 (中国)"  width="20" height="15"/>
								<span style="margin-left:0.3em;">中文 (中国)</span>
							</a>
						</li>
						<li class="lang-item lang-item-40 lang-item-th menu-item menu-item-type-custom menu-item-object-custom menu-item-8867-th">
							<a hreflang="th" lang="th" data-id="th" class="lang" style="cursor: pointer;">
								<img src="admin/img/th-fl.png" title="ไทย" alt="ไทย" width="20" height="15" />
								<span style="margin-left:0.3em;">ไทย</span>
							</a>
						</li>
					</ul>
				</li>
			</ul>	
		</nav>
		<div class="cleafix"></div>
	</div>
	<!-- <div class="mtheme-fullscreen-toggle fullscreen-toggle-off">
		<i class="fa fa-expand"></i>
	</div>	 -->
	<div class="stickymenu-zone outer-wrap">
		<div class="outer-header-wrap clearfix">
			<nav>
				<div class="mainmenu-navigation">
					<div class="header-logo-section">
						<div class="logo">
<?php
	$logo = logo();
	if($logo!==false){
		if($logo['name']!==''){
			switch ($logo['page']) {
			case 'index.php':
				$link = 'Site';
				break;
			case 'about.php':
				$link = 'About';
				break;
			case 'contact.php':
				$link = 'Contact';
				break;
			case 'show.php':
				$link = 'Show';
				break;
			case 'booking.php':
				$link = 'Booking';
				break;
			case 'event.php':
				$link = 'Event';
				break;
			case 'policy-data.php':
				$link = 'Quality-Policy';
				break;
			case 'policy-personal.php':
				$link = 'Private-Policy';
				break;
			case 'policy-refunds.php':
				$link = 'Exchange-Policy';
				break;
			case 'policy-service.php':
				$link = 'Agreement';
				break;
			case 'how-to-pay.php':
				$link = 'How-to-pay';
				break;
			default:
				$link = $logo['page'];
				break;
		}
?>
							<a href="<?=$link?>" target="<?=$logo['target']?>">
								<img class="logo-theme-main" src="uploads/logo/<?=$logo['name']?>" alt="logo" />
							</a>

<?php
		}
	}
?>
							
						</div>
					</div>								
					<div class="homemenu">
						<ul id="menu-en_menu-1" class="sf-menu mtheme-left-menu">
<?php

function lang_menu($val_th,$val_en,$val_ch){
	if(isset($_COOKIE['lang'])){
			switch ($_COOKIE['lang']) {
				case 'th':
					 $name = $val_th;
				break;
				case 'en':
					 $name = $val_en;
				break;
				case 'ch':
					 $name = $val_ch;
				break;
			}
		}else{
			$name = $val_th;
		}
	return $name;
}

function convert_page($val){
	switch ($val) {
			case 'index.php':
				$link = 'Site';
				break;
			case 'about.php':
				$link = 'About';
				break;
			case 'contact.php':
				$link = 'Contact';
				break;
			case 'show.php':
				$link = 'Show';
				break;
			case 'booking.php':
				$link = 'Booking';
				break;
			case 'event.php':
				$link = 'Event';
				break;
			case 'theater.php':
				$link = 'Theater';
				break;
			case 'seating.php':
				$link = 'Seating-Chart';
				break;
			case 'service.php':
				$link = 'Rental-Service';
				break;
			case 'place.php':
				$link = 'Location';
				break;
			case 'job.php':
				$link = 'Siamdragonshow-Apply-Job';
				break;
			case 'policy-data.php':
				$link = 'Quality-Policy';
				break;
			case 'policy-personal.php':
				$link = 'Private-Policy';
				break;
			case 'policy-refunds.php':
				$link = 'Exchange-Policy';
				break;
			case 'policy-service.php':
				$link = 'Agreement';
				break;
			case 'how-to-pay.php':
				$link = 'How-to-pay';
				break;
			default:
				$link = $val;
				break;
		}
		return $link;
}

	$i=0;
	foreach (query_main() as $key => $value) {	
		$name = lang_menu($value['name'],$value['name_en'],$value['name_ch']);
		$link = convert_page($value['page']);
		$i++;
?>
							<li class="menu-item menu-item-type-post_type menu-item-object-page menu-item-<?=$i?>">
								<a href="<?=$link?>"><?=$name?></a>
<?php
	if(check_sub($value['id_menu'])!==false){
		$query_sub = query_sub($value['id_menu']);
		?>
								<ul class="sub-menu"  style="color: white;">
		<?php
			foreach ($query_sub as $key_sub => $value_sub) {
				$name_sub = lang_menu($value_sub['name_sub'],$value_sub['name_en_sub'],$value_sub['name_ch_sub']);
				$link_sub = convert_page($value_sub['page']);
				?>
									<li class="lang-item lang-item-33 lang-item-en lang-item-first current-lang menu-item menu-item-type-custom menu-item-object-custom current_page_item menu-item-home menu-item-8867-en">
										<a  href="<?=$link_sub?>">
											<span style="margin-left:0.3em;"><?=$name_sub?></span>
										</a>
									</li>
				<?php

			}
				?>
								</ul>
				<?php

	}
?>
							</li>
<?php
	}

$data = fistmenu();
?>
							<li class="pll-parent-menu-item menu-item menu-item-type-custom menu-item-object-custom current-menu-parent menu-item-has-children menu-item-8867">
								<a href="#">
									<img src="admin/img/<?=$data['img']?>" title="English" alt="English" width="15" height="11" />
									<span style="margin-left:0.3em;"><?=$data['name']?></span>
								</a>
								<ul class="sub-menu"  style="color: white;">
									<li class="lang-item lang-item-33 lang-item-en lang-item-first current-lang menu-item menu-item-type-custom menu-item-object-custom current_page_item menu-item-home menu-item-8867-en">
										<a  hreflang="en-GB" lang="en-GB" data-id="en" class="lang" style="cursor: pointer;">
											<img src="admin/img/en-fl.jpg" title="English" alt="English" width="15" height="11" />
											<span style="margin-left:0.3em;">English</span>
										</a>
									</li>
									<li class="lang-item lang-item-36 lang-item-zh menu-item menu-item-type-custom menu-item-object-custom menu-item-8867-zh">
										<a data-id="ch" class="lang" hreflang="zh-CN" lang="zh-CN" style="cursor: pointer;">
											<img src="admin/img/chi-fl.jpg" title="中文 (中国)" alt="中文 (中国)"  width="15" height="11"/>
											<span style="margin-left:0.3em;">中文 (中国)</span>
										</a>
									</li>
									<li class="lang-item lang-item-40 lang-item-th menu-item menu-item-type-custom menu-item-object-custom menu-item-8867-th">
										<a hreflang="th" lang="th" data-id="th" class="lang" style="cursor: pointer;">
											<img src="admin/img/th-fl.png" title="ไทย" alt="ไทย" width="15" height="11" />
											<span style="margin-left:0.3em;">ไทย</span>
										</a>
									</li>
								</ul>
							</li>
						</ul>							
					</div>											
				</div>
			</nav>
		</div>
	</div>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.js"></script>
<script type="text/javascript">
	$(document).on('click', '.lang', function(event) {
		var lang = $(this).attr('data-id');
		setCookie('lang',lang);
		location.reload();
	});

	 function setCookie(key, value) {
            var expires = new Date();
            expires.setTime(expires.getTime() + (1 * 24 * 60 * 60 * 1000));
            document.cookie = key + '=' + value + ';expires=' + expires.toUTCString();
        }

        function getCookie(key) {
            var keyValue = document.cookie.match('(^|;) ?' + key + '=([^;]*)(;|$)');
            return keyValue ? keyValue[2] : null;
      }
</script>
