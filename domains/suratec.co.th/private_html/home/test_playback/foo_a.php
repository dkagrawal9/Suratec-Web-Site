<html>
<head>
<meta charset="utf-8">
<title>sfdfd</title>
</head>
	
<style>
  .insideWrapper {
      width:100%;
      height:100%;
      position:relative;
  }
  .coveredImage {
/*
      width:100%;
      height:100%;
*/
      position:absolute;
      top:0px;
      left:0px;
  }
  .coveringCanvas {
      width:100%;
      height:100%;
      position:absolute;
      top:0px;
      left:0px;
  }
	.inpt_date{
	height: 35 !important;
    font-size: 14px;
    width: 100%;
	}
	.but_lr{
    font-size: 14px;
	}
</style>	

<body>
<div class="row">
<div class="col-12">
	<div class="col-6">
<div class="outsideWrapper">
    <div class="insideWrapper">
        <img src="../images/foot_left.png" style="max-width: 160;" class="coveredImage">
        <canvas class="itemleft" id="itemleft" width="350" height="500"></canvas>
    </div>
</div>
					  </div>
<div class="col-6">
<div class="outsideWrapper">
    <div class="insideWrapper">
        <img src="../images/foot_right.png" style="max-width: 160;" class="coveredImage">
        <canvas class="itemright" id="itemright" width="350" height="500"></canvas>
    </div>
</div>
</div>
	</div>
	</div>
</body>

<script src="https://d3js.org/d3.v4.min.js"></script>
<script src="https://d3js.org/d3-hsv.v0.1.min.js"></script>
<script src="https://d3js.org/d3-contour.v1.min.js"></script>
<script src="kign.js"></script>
<script src="funtion_footall.js"></script>	


<script>	
//document.querySelector('#datee').onclick = function() { 
//    alert('lol'); 
//}	
	
//  $.get( "live-order.php?id_product=", function( data ) {
//  $( ".result" ).html( data );
//  swal.fire( "ทำการโหลด." );
//});	
	  	  
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
	  
	function findRightContourArray(rsensor) {
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
	  
    var values = findLeftContourArray([
      Math.floor(Math.random() * 600),
      Math.floor(Math.random() * 600),
      Math.floor(Math.random() * 600),
      Math.floor(Math.random() * 600),
      Math.floor(Math.random() * 600)
    ])
	
	var valuesright = findRightContourArray([
      Math.floor(Math.random() * 600),
      Math.floor(Math.random() * 600),
      Math.floor(Math.random() * 600),
      Math.floor(Math.random() * 600),
      Math.floor(Math.random() * 600),	
    ])

    function getColor(t) {
        t = Math.max(0, Math.min(1, t));
        return "rgb("
          + Math.max(0, Math.min(255, Math.round(34.61 + t * (1172.33 - t * (10793.56 - t * (33300.12 - t * (38394.49 - t * 14825.05))))))) + ", "
          + Math.max(0, Math.min(255, Math.round(23.31 + t * (557.33 + t * (1225.33 - t * (3574.96 - t * (1073.77 + t * 707.56))))))) + ", "
          + Math.max(0, Math.min(255, Math.round(27.2 + t * (3211.1 - t * (15327.97 - t * (27814 - t * (22569.18 - t * 6838.66)))))))
          + ")";
    }

    var canvas = document.getElementById("itemleft"),
      context = canvas.getContext("2d"),	
      color = d3.scaleSequential(getColor).domain(d3.extent(d3.range(0, 600, 50))),
      pathleft = d3.geoPath(null, context),
      thresholds = d3.range(0, 600, 50),
      contours = d3.contours().size([8, 24]);
	  
	 var canvasr = document.getElementById("itemright"),
      contextr = canvasr.getContext("2d"),	
      colorr = d3.scaleSequential(getColor).domain(d3.extent(d3.range(0, 600, 50))),
      pathr = d3.geoPath(null, contextr),
      thresholds = d3.range(0, 600, 50),
      contoursr = d3.contours().size([8, 24]);
	  
      context.scale(20, 20);
      context.translate(0, 0);
	  
	  contextr.scale(20, 20);
      contextr.translate(0, 0);  

    // d3.timer(function (t) {
    //   values = findLeftContourArray([
    //     Math.floor(Math.random() * 600),
    //     Math.floor(Math.random() * 600),
    //     Math.floor(Math.random() * 600),
    //     Math.floor(Math.random() * 600),
    //     Math.floor(Math.random() * 600)
    //   ])
    //   contours
    //     .thresholds(d3.range(0, 600, 50))
    //     (values)
    //     .forEach(fill);
    // }, 1000);
//		console.log(data.left_sensor);
//		console.log(data.right_sensor);
	
	
	var setleft = setInterval(function (t) {
		values = findLeftContourArray([
		  
		0,0,0,0,510		


      ])

      contours
        .thresholds (d3.range(0, 600, 50))
        (values)
        .forEach(fill);
	}, 1000)
	
	
	var setright = setInterval(function (ttr) {
      valuesright = findRightContourArray([
		  600,600,600,600,600

      ])
//	  console.log(iright)
      contoursr
        .thresholds(d3.range(0, 600, 50))
        (valuesright)
        .forEach(fillr);
    }, 1000)
	     
    function fill(geometry) {
      context.beginPath();
      pathleft(geometry);
      context.fillStyle = color(geometry.value);
      context.fill();
    }

    function value(x, y) {
      return Math.sin(x + y) * Math.sin(x - y);
    }
	  
	function fillr(geometry) {
      contextr.beginPath();
      pathr(geometry);
      contextr.fillStyle = colorr(geometry.value);
      contextr.fill();
    }

    function value(x, y) {
      return Math.sin(x + y) * Math.sin(x - y);
    }   
 
//
//      const left_x = [
//        3, 7, 3, 3,
//        5, 7, 5, 7,
//        3, 5, 7, 5,
//        7, 5, 7, 7,
//        3, 5, 7, 5,
//        7, 3, 5, 7
//      ]
//      const axis_y = [
//        3, 3, 5, 7,
//        7, 7, 11, 11,
//        13, 13, 13, 15,
//        15, 17, 17, 19,
//        21, 21, 21, 23,
//        23, 24, 24, 24
//      ]
//      const right_x = [
//        1.5, 5.5, 5.5, 1.5,
//        3.5, 5.5, 1.5, 3.5,
//        1.5, 3.5, 5.5, 1.5,
//        3.5, 1.5, 3.5, 1.5,
//        1.5, 3.5, 5.5, 1.5,
//        3.5, 1.5, 3.5, 5.5
//      ]
//	  
//	  ////////////////////////////////////////////////ค่าจุดของเท้า//////////////////////
//
//      const n = 8, m = 24;
//
//      function getColor(t) {
//        t = Math.max(0, Math.min(1, t));
//        return "rgb("
//          + Math.max(0, Math.min(255, Math.round(34.61 + t * (1172.33 - t * (10793.56 - t * (33300.12 - t * (38394.49 - t * 14825.05))))))) + ", "
//          + Math.max(0, Math.min(255, Math.round(23.31 + t * (557.33 + t * (1225.33 - t * (3574.96 - t * (1073.77 + t * 707.56))))))) + ", "
//          + Math.max(0, Math.min(255, Math.round(27.2 + t * (3211.1 - t * (15327.97 - t * (27814 - t * (22569.18 - t * 6838.66)))))))
//          + ")";
//      }
//		///////////////////////////ค่าสีของรองเท้า///////////////////////
//
//      function findLeftContourArray(lsensor) {
//        const dataleft = [
//          1, lsensor[0], 0, lsensor[1],
//          0, lsensor[2], 0, 0,
//          lsensor[3], 0, 0, 0,
//          0, 0, 0, 0,
//          0, lsensor[4], 0, 0,
//          0, 0, 0, 0
//        ]
//        var variogram = kriging.train(
//          dataleft,
//          left_x,
//          axis_y,
//          'exponential',
//          0,
//          100)
//        var lvalues = new Array(8 * 24)
//        for (let j = 0.5, k = 0; j < m; ++j) {
//          for (let i = 0.5; i < n; ++i, ++k) {
//            lvalues[k] = kriging.predict(i, j, variogram);
//            lvalues[k] = lvalues[k] > 0 ? lvalues[k] : 0;
//          }
//        }
//        return lvalues
//      }
//		
//	////////////////////////////////////////////////Left///////////////////
//		
//	function findRightContourArray(rsensor) {
//    const dataright = [
//      rsensor[0], 0, 0, rsensor[1],
//      0, rsensor[2], 0, 0,
//      0, 0, rsensor[3], 0,
//      0, 0, 0, 0,
//      0, rsensor[4], 0, 0,
//      0, 0, 0, 1
//    ]
//    var variogram = kriging.train(
//      dataright,
//      right_x,
//      axis_y,
//      'exponential',
//      0,
//      100)
//    var rvalues = new Array(8 * 24)
//    for (let j = 0.5, k = 0; j < m; ++j) {
//      for (let i = 0.5; i < n; ++i, ++k) {
//        rvalues[k] = kriging.predict(i, j, variogram);
//        rvalues[k] = rvalues[k] > 0 ? rvalues[k] : 0;
//      }
//    }
//    return rvalues;
//  }	
//		
//	////////////////////////////////////////////////Right///////////////////	
//
//      const thresholds = d3.range(0, 600, 50)
//      const color = d3.scaleSequential(getColor).domain(d3.extent(thresholds))
//
//      var data = findLeftContourArray([
//        Math.floor(Math.random() * 600),
//        Math.floor(Math.random() * 600),
//        Math.floor(Math.random() * 600),
//        Math.floor(Math.random() * 600),
//        Math.floor(Math.random() * 600)
//      ])
//
//      console.log(data)
//		
//	/////////////////////////////////////////////////////ขาซ้าย	
//
//      document.getElementById("itemleft").innerHTML += '<svg width="1000" height="1000" stroke="#fff" stroke-width="0.5"></svg>';
//
//      var svg = d3.select("svg"),
//        width = +svg.attr("width"),
//        height = +svg.attr("height");
//		
//		console.log(svg);
//
//      var i0 = d3.interpolateHsvLong(d3.hsv(120, 1, 0.65), d3.hsv(60, 1, 0.90)),
//        i1 = d3.interpolateHsvLong(d3.hsv(60, 1, 0.90), d3.hsv(0, 0, 0.95)),
//        interpolateTerrain = function (t) { return t < 0.5 ? i0(t * 2) : i1((t - 0.5) * 2); };
//
//      svg.selectAll("path")
//        .data(d3.contours()
//          .size([8, 24])
//          .thresholds(d3.range(0, 600, 50))
//          (data))
//        .enter().append("path")
//        .attr("d", d3.geoPath(d3.geoIdentity().scale(width / 24)))
//        .attr("fill", function (d) { return color(d.value); });
//		
////		var myimage = svg.append('image')
////		.attr('xlink:href', '../images/foot_left.png')
////		.attr('width', width)
////		.attr('height', height)
//	  	
//		/////////////////////////////////////////////////ขาขวา

  </script>