
<html>
<body>
<p id="str1"></p>
<?php
//	for ($i=1; $i<=20; $i++)
//		echo "[".rand(1,1023).",".rand(1,1023).",".rand(1,1023).",".rand(1,1023).",".rand(1,1023)."],<br>";
	?>	
<svg class="itemleft" width="468" height="460" stroke-width="0.5"></svg>	
<script src="https://d3js.org/d3.v4.min.js"></script>
<script src="https://d3js.org/d3-hsv.v0.1.min.js"></script>
<script src="https://d3js.org/d3-contour.v1.min.js"></script>
<script src="kign.js"></script>
<script>
	function getColor(t){
  t = Math.max(0, Math.min(1, t));
  return "rgb("
    + Math.max(0, Math.min(255, Math.round(34.61 + t * (1172.33 - t * (10793.56 - t * (33300.12 - t * (38394.49 - t * 14825.05))))))) + ", "
    + Math.max(0, Math.min(255, Math.round(23.31 + t * (557.33 + t * (1225.33 - t * (3574.96 - t * (1073.77 + t * 707.56))))))) + ", "
    + Math.max(0, Math.min(255, Math.round(27.2 + t * (3211.1 - t * (15327.97 - t * (27814 - t * (22569.18 - t * 6838.66)))))))
    + ")";
}
	
var svg 	= d3.select("svg.itemleft"),
//	svg1 	= d3.select("svg.itemright"),
    width 	= +svg.attr("width"),
    height 	= +svg.attr("height");
//	width1 	= +svg1.attr("width"),
//    height1 = +svg1.attr("height");
	
	var thresholds = d3.range(0, 600, 50);

var i0 = d3.interpolateHsvLong(d3.hsv(120, 1, 0.65), d3.hsv(60, 1, 0.90)),
    i1 = d3.interpolateHsvLong(d3.hsv(60, 1, 0.90), d3.hsv(0, 0, 0.95)),
    interpolateTerrain = function(t) { return t < 0.5 ? i0(t * 2) : i1((t - 0.5) * 2); };
    // color = d3.scaleSequential(interpolateTerrain).domain([123, 43]);
	var color = d3.scaleSequential(getColor).domain(d3.extent(thresholds))
			
	
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
	
	
	
//const mockup = [
//	[
//		Math.floor(Math.random() * 1000),
//		Math.floor(Math.random() * 1000),
//		Math.floor(Math.random() * 1000),
//		Math.floor(Math.random() * 1000),
//		Math.floor(Math.random() * 1000)
//	],
//	[
//		Math.floor(Math.random() * 1000),
//		Math.floor(Math.random() * 1000),
//		Math.floor(Math.random() * 1000),
//		Math.floor(Math.random() * 1000),
//		Math.floor(Math.random() * 1000)
//	],
//	[
//		Math.floor(Math.random() * 1000),
//		Math.floor(Math.random() * 1000),
//		Math.floor(Math.random() * 1000),
//		Math.floor(Math.random() * 1000),
//		Math.floor(Math.random() * 1000)
//	],
//	[
//		Math.floor(Math.random() * 1000),
//		Math.floor(Math.random() * 1000),
//		Math.floor(Math.random() * 1000),
//		Math.floor(Math.random() * 1000),
//		Math.floor(Math.random() * 1000)
//	],
//	[
//		Math.floor(Math.random() * 1000),
//		Math.floor(Math.random() * 1000),
//		Math.floor(Math.random() * 1000),
//		Math.floor(Math.random() * 1000),
//		Math.floor(Math.random() * 1000)
//	]
//];
	
	var counter = 0;
var schedule = 1;
var DataArr = 20;
var Delay = 60;
var i = setInterval(function(){
    counter++;
    if(counter/Delay === schedule){
        schedule++;
		var data = findLeftContourArray([
			 Math.floor(Math.random() * 1000),
			 Math.floor(Math.random() * 1000),
			 Math.floor(Math.random() * 1000),
			 Math.floor(Math.random() * 1000),
			 
		 ])	
 
  svg.selectAll("path")
    .data(d3.contours()
        .size([8, 24])
        .thresholds(d3.range(25, 195, 5))
      (data))
    .enter().append("path")
      .attr("d", d3.geoPath(d3.geoIdentity().scale(width / 8)))
      .attr("fill", function(d) { return color(d.value); });
	
		var myimage = svg.append('image')
		.attr('xlink:href', '../images/foot_left.png')
		.attr('width', width)
		.attr('height', height)	
        // document.getElementById("str1").innerHTML = schedule;
    }
    if(DataArr === schedule){
        clearInterval(i);
    }
}, DataArr);
</script>

</body>
</html>



<script>
	

	data = FileAttachment("volcano.json").json(),
	
	function($data1,$data2,$data3,$data4,$data5){
	var data = findLeftContourArray([
			mockup[DataArr]
		 ])	
 //console.log(data)
  svg.selectAll("path")
    .data(d3.contours()
        .size([8, 24])
        .thresholds(d3.range(25, 195, 5))
      (data))
    .enter().append("path")
      .attr("d", d3.geoPath(d3.geoIdentity().scale(width / 8)))
      .attr("fill", function(d) { return color(d.value); });
	
		var myimage = svg.append('image')
		.attr('xlink:href', '../images/foot_left.png')
		.attr('width', width)
		.attr('height', height)	
	}
</script>