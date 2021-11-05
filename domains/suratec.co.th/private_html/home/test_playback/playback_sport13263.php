<?php 
  require_once '../admin/library/connect.php';
  require_once '../admin/library/functions.php';
  checkMemUser($objConnect);
?>
<?php include 'header.php'
?>
<?php

    if(!isset($_SESSION)) 
    { 
        session_start(); 
    } 

$id = $_SESSION['id_customer'];

$sqlpro = "SELECT   *,mod_customer.telephone AS telephone ,mod_customer.id_customer AS id_customer, mod_customer.fname AS fname, mod_customer.lname AS lname FROM  mod_customer 
LEFT JOIN tbl_member ON mod_customer.id_customer = tbl_member.id_data_role
LEFT JOIN  mod_customer_address ON mod_customer_address.id_customer = mod_customer.id_customer
WHERE  mod_customer.id_customer = '$id' ";

 //echo $sqlpro;

$queryPro = mysqli_query($objConnect, $sqlpro);
$resultPro = mysqli_fetch_array($queryPro);

// var_dump($_SESSION);


?>
<?php include_once 'common.php'; ?>
<link rel="stylesheet" href="../admin/plugins/sweetalert2/dist/sweetalert2.min.css">
    <script src="../admin/plugins/sweetalert2/dist/sweetalert2.min.js"></script>
			<!--/ End Header -->
	  
			<!-- Breadcrumbs -->
			<section class="breadcrumbs overlay bg-image" style="background-image: url(../uploads/mod_central_information/<?=$pic_header['value']?>)">
				<div class="container">
					<div class="row">
						<div class="col-12">
							<!-- Bread Title -->
							<div class="bread-title">
								<h2><?=$lang['MENU_Playback_S']?><!--Profile--></h2>
							</div>
							<!-- Bread List -->
							<ul class="bread-list">
								<li><a href="./?index=st"><i class="fa fa-home"></i><?=$lang['MENU_HOME']?><!--Home--></a></li>
								<li class="active"><a href="playback_sport.php?playback_sport=st"><i class="fa fa-clone"></i><?=$lang['MENU_Playback_S']?><!--Profile--></a></li>
							</ul>
						</div>
					</div>
				</div>
			</section>
			<!--/ End Breadcrumbs -->
			
			<!-- Services -->
			<section class="services single section">
				<div class="container">
					<div class="row">
						
						<div class="col-lg-3 col-12">
							<!-- Service Sidebar -->
							<div class="services-sidebar">	
								<!-- Service Category -->
								<div class="single-sidebar category">
									<h2>หมวดหมู่บริการ</h2>
									<ul>
										<li class="active"><a href="playback_sport.php"><i class="fa fa-list"></i>Pressure Map</a></li>			
										<li><a href="playback_sport_GA.php"><i class="fa fa-handshake-o"></i>Gait Analysis</a></li>			
										<li><a href="playback_sport_BB.php"><i class="fa fa-gavel"></i>Balance Board</a></li>			
										<li><a href="playback_sport_DB.php"><i class="fa fa-globe"></i>Dasboard</a></li>		
									</ul>
								</div>
								<!--/ End Service Category -->
							</div>
							<!--/ End Service Sidebar -->
						</div>
						<div class="col-lg-5 col-12" style="text-align: right;">
							<svg class="itemleft" width="151.3" height="460" stroke-width="0.5"></svg>
							<!--<svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
	 viewBox="0 0 512.003 512.003" style="enable-background:new 0 0 512.003 512.003;" xml:space="preserve">
<g>
	<g>
		<g>
			<path d="M183.229,317.705c-3.447-15.701-4.173-55.373-4.173-85.879V70.998c0-7.706-4.087-14.771-10.411-18.005
				c-2.338-1.195-4.54-1.783-6.647-1.783c-1.843,0-3.618,0.461-5.342,1.365c-5.948,3.149-10.871,11.511-11.981,20.335
				c-3.072,34.014-19.046,207.215-29.38,247.125c-1.391,5.342-3.703,14.293-4.446,22.101c-1.109,11.699,2.33,22.938,9.421,30.839
				c6.366,7.083,14.967,10.897,24.858,11.025h8.38c11.639-0.145,19.319-5.828,23.714-10.581
				c7.475-8.081,11.298-19.567,10.487-31.514C187.418,337.614,184.807,324.788,183.229,317.705z"/>
			<path d="M234.684,307.826l-0.444-5.316c-1.911-23.202-3.883-47.181-3.883-70.682V68.269c0-37.641-30.626-68.267-68.267-68.267
				c-39.228,0-64.418,34.662-68.233,67.499c-0.179,2.014-18.295,202.121-28.032,239.693c-10.078,38.886-7.808,108.16,10.308,142.643
				c20.454,38.921,52.582,62.165,85.956,62.165c50.389,0,70.528-72.294,73.165-91.648c4.983-36.599,2.688-72.61-0.572-112.521
				V307.826z M189.747,385.01c-9.438,10.206-22.263,15.906-36.096,16.06H153.6h-8.576c-14.686-0.196-27.955-6.118-37.444-16.691
				c-10.274-11.435-15.275-27.418-13.722-43.844c0.802-8.465,2.953-17.229,4.907-24.781
				c10.223-39.433,27.059-223.787,28.937-244.676c1.86-14.754,10.078-27.819,20.975-33.587c8.585-4.548,18.441-4.437,27.725,0.307
				c11.981,6.11,19.721,19.149,19.721,33.203v160.828c0,41.327,1.374,71.279,3.772,82.193c0.444,1.98,4.369,19.755,4.838,26.735
				C205.858,357.362,200.397,373.49,189.747,385.01z"/>
			<path d="M446.176,307.191c-9.737-37.572-27.853-237.67-28.058-239.906C414.33,34.671,389.131,0,349.912,0
				c-37.641,0-68.267,30.626-68.267,68.267v163.558c0,23.424-1.963,47.334-3.866,70.451l-0.461,5.555v-0.009
				c-3.26,39.893-5.555,75.896-0.572,112.529C279.384,439.706,299.523,512,349.912,512c33.374,0,65.502-23.245,85.956-62.165
				C453.984,415.352,456.254,346.086,446.176,307.191z M404.218,384.375c-9.498,10.573-22.758,16.503-37.342,16.691h-8.644h-0.085
				c-13.841-0.154-26.658-5.845-36.104-16.06c-10.65-11.511-16.111-27.648-14.985-44.245c0.469-6.997,4.395-24.764,4.847-26.769
				c2.389-10.88,3.763-40.841,3.763-82.167V70.997c0-14.054,7.74-27.085,19.721-33.203c9.284-4.745,19.14-4.855,27.733-0.299
				c10.889,5.76,19.106,18.833,20.932,33.28c1.911,21.188,18.748,205.542,28.971,244.975c1.954,7.552,4.105,16.316,4.907,24.781
				C419.493,356.958,414.492,372.941,404.218,384.375z"/>
			<path d="M396.5,320.033c-10.342-39.91-26.317-213.111-29.414-247.424c-1.075-8.525-6.007-16.887-11.947-20.036
				c-3.686-1.937-7.612-1.818-11.989,0.418c-6.323,3.234-10.411,10.3-10.411,18.014v160.819c0,30.507-0.725,70.178-4.173,85.862
				c-1.579,7.1-4.19,19.942-4.489,24.235c-0.802,11.93,3.021,23.415,10.496,31.497c4.395,4.762,12.075,10.445,23.706,10.581h8.491
				c9.788-0.12,18.389-3.942,24.755-11.025c7.091-7.902,10.522-19.14,9.412-30.831C400.203,334.327,397.882,325.375,396.5,320.033z"
				/>
		</g>
	</g>
</g>
<g>
</g>
<g>
</g>
<g>
</g>
<g>
</g>
<g>
</g>
<g>
</g>
<g>
</g>
<g>
</g>
<g>
</g>
<g>
</g>
<g>
</g>
<g>
</g>
<g>
</g>
<g>
</g>
<g>
</g>
</svg>-->
						</div>
						<div class="col-lg-4 col-12">
							<svg class="itemright" width="460" height="460" stroke-width="0.5"></svg>
						</div>
					</div>
				</div>
			</section>
			<!--/ End Services -->

			
			<!-- Footer -->
			<?php include 'footer.php'?>
			<!--/ End footer -->
			<?php include 'footer_credit.php'?>	
		</div>
    </body>
</html>

<script src="https://d3js.org/d3.v4.min.js"></script>
<script src="https://d3js.org/d3-hsv.v0.1.min.js"></script>
<script src="https://d3js.org/d3-contour.v1.min.js"></script>
<script src="kign.js"></script>
<script>
/*w 87*/ /*h 61*/	

function getColor(t){
  t = Math.max(0, Math.min(1, t));
  return "rgb("
    + Math.max(0, Math.min(255, Math.round(34.61 + t * (1172.33 - t * (10793.56 - t * (33300.12 - t * (38394.49 - t * 14825.05))))))) + ", "
    + Math.max(0, Math.min(255, Math.round(23.31 + t * (557.33 + t * (1225.33 - t * (3574.96 - t * (1073.77 + t * 707.56))))))) + ", "
    + Math.max(0, Math.min(255, Math.round(27.2 + t * (3211.1 - t * (15327.97 - t * (27814 - t * (22569.18 - t * 6838.66)))))))
    + ")";
}
	
var svg 	= d3.select("svg.itemleft"),
	svg1 	= d3.select("svg.itemright"),
    width 	= +svg.attr("width"),
    height 	= +svg.attr("height"),
	width1 	= +svg1.attr("width"),
    height1 = +svg1.attr("height");
	
	var thresholds = d3.range(0, 600, 50);

var i0 = d3.interpolateHsvLong(d3.hsv(120, 1, 0.65), d3.hsv(60, 1, 0.90)),
    i1 = d3.interpolateHsvLong(d3.hsv(60, 1, 0.90), d3.hsv(0, 0, 0.95)),
    interpolateTerrain = function(t) { return t < 0.5 ? i0(t * 2) : i1((t - 0.5) * 2); };
    // color = d3.scaleSequential(interpolateTerrain).domain([123, 43]);
	var color = d3.scaleSequential(getColor).domain(d3.extent(thresholds))
	
d3.json("volcano.json", function(error, volcano) {
  if (error) throw error;
	
  svg.selectAll("path")
    .data(d3.contours()
        .size([volcano.width, volcano.height])
        .thresholds(d3.range(25, 195, 5))
      (volcano.values))
    .enter().append("path")
      .attr("d", d3.geoPath(d3.geoIdentity().scale(width / volcano.width)))
      .attr("fill", function(d) { return color(d.value); });
	
		var myimage = svg.append('image')
		.attr('xlink:href', '../images/foot_left.png')
		.attr('width', 152)
		.attr('height', 454.8)	
	
	  svg1.selectAll("path")
    .data(d3.contours()
        .size([volcano.width, volcano.height])
        .thresholds(d3.range(25, 195, 5))
      (volcano.values))
    .enter().append("path")
      .attr("d", d3.geoPath(d3.geoIdentity().scale(width / volcano.width)))
      .attr("fill", function(d) { return color(d.value); });
	
		var myimage = svg1.append('image')
		.attr('xlink:href', '../images/foot_right.png')
		.attr('width', 152)
		.attr('height', 454.8)
		
});		
	
const left_x = [
  3, 7, 3, 3,
  5, 7, 5, 7,
  3, 5, 7, 5,
  7, 5, 7, 7,
  3, 5, 7, 5,
  7, 3, 5, 7
]
const axis_y = [
  3, 3, 5, 7,
  7, 7, 11, 11,
  13, 13, 13, 15,
  15, 17, 17, 19,
  21, 21, 21, 23,
  23, 24, 24, 24
]
const right_x = [
  1.5, 5.5, 5.5, 1.5,
  3.5, 5.5, 1.5, 3.5,
  1.5, 3.5, 5.5, 1.5,
  3.5, 1.5, 3.5, 1.5,
  1.5, 3.5, 5.5, 1.5,
  3.5, 1.5, 3.5, 5.5
]

const n = 8, m = 24;
	
  function findLeftContourArray(lsensor) {
    const dataleft = [
      1, lsensor[0], 0, lsensor[1],
      0, lsensor[2], 0, 0,
      lsensor[3], 0, 0, 0,
      0, 0, 0, 0,
      0, lsensor[4], 0, 0,
      0, 0, 0, 0
    ]
    var variogram = kriging.train(
      dataleft,
      left_x,
      axis_y,
      'exponential',
      0,
      100)
    var lvalues = new Array(8 * 24)
    for (let j = 0.5, k = 0; j < m; ++j) {
      for (let i = 0.5; i < n; ++i, ++k) {
        lvalues[k] = kriging.predict(i, j, variogram);
        lvalues[k] = lvalues[k] > 0 ? lvalues[k] : 0;
      }
    }
    return lvalues
  }
	
function  findRightContourArray(rsensor) {
    const dataright = [
      rsensor[0], 0, 0, rsensor[1],
      0, rsensor[2], 0, 0,
      0, 0, rsensor[3], 0,
      0, 0, 0, 0,
      0, rsensor[4], 0, 0,
      0, 0, 0, 1
    ]
    var variogram = kriging.train(
      dataright,
      right_x,
      axis_y,
      'exponential',
      0,
      100)
    var rvalues = new Array(8 * 24)
    for (let j = 0.5, k = 0; j < m; ++j) {
      for (let i = 0.5; i < n; ++i, ++k) {
        rvalues[k] = kriging.predict(i, j, variogram);
        rvalues[k] = rvalues[k] > 0 ? rvalues[k] : 0;
      }
    }
    return rvalues;
  }
</script>