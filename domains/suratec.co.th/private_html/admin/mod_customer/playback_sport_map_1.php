<script src="https://d3js.org/d3.v4.min.js"></script>
<script src="https://d3js.org/d3-hsv.v0.1.min.js"></script>
<script src="https://d3js.org/d3-contour.v1.min.js"></script>
<script src="kign.js"></script>
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
	$( '#datee' ).keyup(function() {
		
	var ileft = 0;
	var leftstop = <?=$num?>;
//	var data_l = 
//	var json_l = JSON.parse(data_l);
	<?php //$i = 0; ?>
	//var left1 = <?php// print_r($left_sensor[0])?>
	var datee = $('#datee').val();
	var id_customer = $('#id_customer').val();
	var time_l = $('#timee').val();	
		
	var strCount = id_customer;
	var strCount = datee;
	var numStr = strCount.length;
	
	$.ajax({
    url: "function_m.php",
    type: "post",
    data:{_method:'json_all',
		 datee:datee,
		 id_customer:id_customer 
		 },
    dataType: "json",
    success: function(data) {
//		console.log(data.left_sensor);
//		console.log(data.right_sensor);
		var setleft = setInterval(function (t) {
		values = findLeftContourArray([		
		  
		 // data.left_sensor[0]	
		  
		  Math.floor(Math.random() * 600),
        Math.floor(Math.random() * 600),
        Math.floor(Math.random() * 600),
        Math.floor(Math.random() * 600),
        Math.floor(Math.random() * 600)
		  <?php 
//							  $result = mysqli_fetch_array($query);
//							  $left_1=$result['left_sensor1'];
//							  $left_2=$result['left_sensor2'];
//							  $left_3=$result['left_sensor3'];
//							  $left_4=$result['left_sensor4'];
//							  $left_5=$result['left_sensor5'];
//							echo($left_1.",".$left_2.",".$left_3.",".$left_4.",".$left_5."");
			//print_r($left_sensor[$i]);$i++;//ค่าตัวแปรที่จะแสดงแรงกดของเท้า		

		  ?>
			
			

//	    document.open(),
//      document.write(ileft),
//      document.close()
      ])
	
//	 	alert(ileft)
		//console.log(ileft);
		 if(data.number_all === ileft){
			 clearInterval(setleft)
		 }
			
		ileft++
//		console.log(ileft);
      contours
        .thresholds (d3.range(0, 600, 50))
        (values)
        .forEach(fill);
	}, 1000)
		}
	});
	});
	
	
	$( '#timee' ).keyup(function() {
	var iright = 0;
	var rightstop = <?=$num?>;
	<?php $new_l = $ileft=0?>;
	var setright = setInterval(function (ttr) {
      valuesright = findRightContourArray([
        Math.floor(Math.random() * 600),
        Math.floor(Math.random() * 600),
        Math.floor(Math.random() * 600),
        Math.floor(Math.random() * 600),
        Math.floor(Math.random() * 600)
//		  600,600,600,600,600
		  	<?php 
//							  $result = mysqli_fetch_array($query);
//							  $right_1=$result['right_sensor1'];
//							  $right_2=$result['right_sensor2'];
//							  $right_3=$result['right_sensor3'];
//							  $right_4=$result['right_sensor4'];
//							  $right_5=$result['right_sensor5'];
//							echo($right_1.",".$right_2.",".$right_3.",".$right_4.",".$right_5."");
		  	?>
      ])
//	  console.log(iright)
		 if(rightstop === iright){
			 clearInterval(setright)
		 }
	  iright++	
      contoursr
        .thresholds(d3.range(0, 600, 50))
        (valuesright)
        .forEach(fillr);
    }, 1000)
	});
	     
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

<!-- Load d3.js -->
<script src="https://d3js.org/d3.v4.js"></script>
<!-- Color scale -->
<script src="https://d3js.org/d3-scale-chromatic.v1.min.js"></script>
<script>
      var canvas_b = document.getElementById('myCanvas_l');
      var context_b = canvas_b.getContext('2d');
      var centerX_b = canvas_b.width / 2;
      var centerY_b = canvas_b.height / 2;
      var radius_b = 70;

//      context_b.beginPath();
//      context_b.arc(142.5, 142.5, 6, 0, 2 * Math.PI, false);
//	  context_b.closePath();
//	  context_b.arc(142.5, 142.5, 16, 0, 2 * Math.PI, false);
////	  context_b.arc(142.5, 142.5, 46, 0, 2 * Math.PI, false);
////	  context_b.arc(142.5, 142.5, 66, 0, 2 * Math.PI, false);
////	  context_b.arc(142.5, 142.5, 66, 0, 2 * Math.PI, false);
////    context_b.fillStyle = 'yellow';
////    context_b.fill();
//      context_b.lineWidth = 1;
////      context.strokeStyle = '#003300';
//      context_b.stroke();	

context_b.fillStyle = "#fff";
context_b.beginPath();
context_b.setLineDash([0]);	
context_b.arc(142.5, 142.5, 126.75, 0, Math.PI*2, false);
	
context_b.closePath();
context_b.lineWidth = 1;
context_b.strokeStyle = '#999';
context_b.fill();
context_b.stroke();	
	
context_b.fillStyle = "#fff";
context_b.beginPath();
context_b.setLineDash([8]);	
context_b.arc(142.5, 142.5, 103, 0, Math.PI*2, false);
	
context_b.closePath();
context_b.lineWidth = 1;
context_b.strokeStyle = '#999';		
context_b.fill();
context_b.stroke();		
	
context_b.fillStyle = "#fff";
context_b.beginPath();
context_b.setLineDash([0]);	
context_b.arc(142.5, 142.5, 79.25, 0, Math.PI*2, false);
	
context_b.closePath();
context_b.lineWidth = 1;
context_b.strokeStyle = '#999';		
context_b.fill();
context_b.stroke();
	
context_b.fillStyle = "#fff";
context_b.beginPath();
context_b.setLineDash([8]);	
context_b.arc(142.5, 142.5, 55.5, 0, Math.PI*2, false);

context_b.closePath();
context_b.lineWidth = 1;
context_b.strokeStyle = '#999';		
context_b.fill();
context_b.stroke();	
	
context_b.fillStyle = "#fff";
context_b.beginPath();
context_b.setLineDash([0]);	
context_b.arc(142.5, 142.5, 31.75, 0, Math.PI*2, false);
context_b.moveTo(142.5, 0);
context_b.lineTo(142.5, 285);
context_b.moveTo(285, 142.5);
context_b.lineTo(0, 142.5);		
context_b.closePath();
context_b.lineWidth = 1;
context_b.strokeStyle = '#999';		
context_b.fill();
context_b.stroke();	
	
context_b.fillStyle = "yellow";
context_b.beginPath();
context_b.arc(142.5, 142.5, 8, 0, Math.PI*2, false);
context_b.closePath();
context_b.lineWidth = 1;
context_b.strokeStyle = '#999';		
context_b.fill();
context_b.stroke();		
</script>
<!--
<script>
      var canvas2 = document.getElementById('myCanvas');
      var context2 = canvas.getContext('2d');
      var centerX2 = canvas.width / 2;
      var centerY2 = canvas.height / 2;
      var radius2 = 70;

      context2.beginPath();
      context2.arc(142.5, 142.5, 16, 0, 2 * Math.PI, false);
//      context2.fillStyle = 'yellow';
      context2.fill();
      context2.lineWidth = 1;
//      context2.strokeStyle = '#003300';
      context2.stroke();	
</script> -->


<!--balance r-->
<script>
      var canvas_r = document.getElementById('myCanvas_r');
      var context_r= canvas_r.getContext('2d');
      var centerX_r = canvas_r.width / 2;     
	  var centerY_r = canvas_r.height / 2;
      var radius_r = 70;

//      context_b.beginPath();
//      context_b.arc(142.5, 142.5, 6, 0, 2 * Math.PI, false);
//	  context_b.closePath();
//	  context_b.arc(142.5, 142.5, 16, 0, 2 * Math.PI, false);
////	  context_b.arc(142.5, 142.5, 46, 0, 2 * Math.PI, false);
////	  context_b.arc(142.5, 142.5, 66, 0, 2 * Math.PI, false);
////	  context_b.arc(142.5, 142.5, 66, 0, 2 * Math.PI, false);
////    context_b.fillStyle = 'yellow';
////    context_b.fill();
//      context_b.lineWidth = 1;
////      context.strokeStyle = '#003300';
//      context_b.stroke();	

context_r.fillStyle = "#fff";
context_r.beginPath();
context_r.setLineDash([0]);	
context_r.arc(142.5, 142.5, 126.75, 0, Math.PI*2, false);
	
context_r.closePath();
context_r.lineWidth = 1;
context_r.strokeStyle = '#999';
context_r.fill();
context_r.stroke();	
	
context_r.fillStyle = "#fff";
context_r.beginPath();
context_r.setLineDash([8]);	
context_r.arc(142.5, 142.5, 103, 0, Math.PI*2, false);
	
context_r.closePath();
context_r.lineWidth = 1;
context_r.strokeStyle = '#999';		
context_r.fill();
context_r.stroke();		
	
context_r.fillStyle = "#fff";
context_r.beginPath();
context_r.setLineDash([0]);	
context_r.arc(142.5, 142.5, 79.25, 0, Math.PI*2, false);
	
context_r.closePath();
context_r.lineWidth = 1;
context_r.strokeStyle = '#999';		
context_r.fill();
context_r.stroke();
	
context_r.fillStyle = "#fff";
context_r.beginPath();
context_r.setLineDash([8]);	
context_r.arc(142.5, 142.5, 55.5, 0, Math.PI*2, false);

context_r.closePath();
context_r.lineWidth = 1;
context_r.strokeStyle = '#999';		
context_r.fill();
context_r.stroke();	
	
context_r.fillStyle = "#fff";
context_r.beginPath();
context_r.setLineDash([0]);	
context_r.arc(142.5, 142.5, 31.75, 0, Math.PI*2, false);
context_r.moveTo(142.5, 0);
context_r.lineTo(142.5, 285);
context_r.moveTo(285, 142.5);
context_r.lineTo(0, 142.5);		
context_r.closePath();
context_r.lineWidth = 1;
context_r.strokeStyle = '#999';		
context_r.fill();
context_r.stroke();	
	
context_r.fillStyle = "yellow";
context_r.beginPath();
context_r.arc(142.5, 142.5, 8, 0, Math.PI*2, false);
context_r.closePath();
context_r.lineWidth = 1;
context_r.strokeStyle = '#999';		
context_r.fill();
context_r.stroke();		
</script>
