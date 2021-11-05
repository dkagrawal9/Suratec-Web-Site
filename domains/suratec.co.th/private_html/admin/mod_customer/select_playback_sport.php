<?php
if(!isset($_SESSION)) 
    { 
        session_start(); 
    } 

require_once '../library/connect.php';



// if(isset($_POST['_method'])){
// 		if($_POST['_method']=='pressure_map'){
// 			pressure_map();
// 			exit;
// 		}
// }




  global $objConnect;
  global $date;

  $id = $_GET['id_customer'];
  $fruits = $_POST['fruits'];
  $playback_time_arr_left = $_POST['playback_time_arr_left'];
    $playback_time_arr_right = $_POST['playback_time_arr_right'];
  //print_r($fruits);
   // print_r($playback_time_arr);
// for ($i=0; $i < count($playback_time_arr_left) ; $i++) { 
 //  echo $playback_time_arr_left;
//   echo "<br>";
// }

// for ($i=0; $i < count($playback_time_arr_right) ; $i++) { 
//   echo $playback_time_arr_right[$i];
// }

$sqlpro = "SELECT   *,mod_customer.telephone AS telephone ,mod_customer.id_customer AS id_customer, mod_customer.fname AS fname, mod_customer.lname AS lname FROM  mod_customer 
LEFT JOIN tbl_member ON mod_customer.id_customer = tbl_member.id_data_role
LEFT JOIN  mod_customer_address ON mod_customer_address.id_customer = mod_customer.id_customer
WHERE  mod_customer.id_customer = '$id' ";

$queryPro = mysqli_query($objConnect, $sqlpro);
$resultPro = mysqli_fetch_array($queryPro);

 $sql = 'SELECT `id`,`action`,`left_sensor1`,`left_sensor2`,`left_sensor3`,`left_sensor4`,`left_sensor5`,`right_sensor1`,`right_sensor2`,`right_sensor3`,`right_sensor4`,`right_sensor5`,`id_customer` FROM `surasole` WHERE `id_customer` = "'.$id.'"  ORDER BY `id` ASC';
  $query = mysqli_query($objConnect,$sql);
  $num = mysqli_num_rows($query);
   // while ($result = mysqli_fetch_array($query)) {
   //               $left_1=$result['left_sensor1'];
   //              $left_2=$result['left_sensor2'];
   //              $left_3=$result['left_sensor3'];
   //              $left_4=$result['left_sensor4'];
   //              $left_5=$result['left_sensor5'];
   //            echo($left_1.",".$left_2.",".$left_3.",".$left_4.",".$left_5."");
   //            echo "<br>";
   //              }

?>

<div class="col-md-6" style="text-align: center;" align="center">
    <h4>Pressure Map</h4>
<div class="col-md-6">              
<div class="outsideWrapper">
    <div class="insideWrapper">
        <img src="img/foot_left.png" style="max-width: 160;" class="coveredImage">
        <canvas class="itemleft" id="itemleft" width="350" height="500"></canvas>
    </div>
</div>
</div>

<div class="col-md-6"> 
<div class="outsideWrapper">
    <div class="insideWrapper">
        <img src="img/foot_right.png" style="max-width: 160;" class="coveredImage">
        <canvas class="itemright" id="itemright" width="350" height="500"></canvas>
    </div>
</div>
</div>

</div>




            <div class="col-md-6" align="center">
              <h4>Balance Board</h4>
              <div class="col-lg-12 col-12">
                <div class="row" style="text-align: center;">
                  <div class="col-lg-1 col-12"> 
                  </div>
                  <div class="col-lg-11 col-12">
                    <div id="my_dataviz"></div>
                  </div>
                </div>
              <div class="row" style="text-align: center;">
                <div class="col-lg-1 col-12"> 
                </div>
                <div class="col-lg-5 col-12" style="background: #cccccc; border-top: 1px solid; border-left: 1px solid; border-right: 1px solid;">
                  <span>Balance Board</span>
                </div>
                <div class="col-lg-1">  
                </div>
                <div class="col-lg-5" style="background: #cccccc; border-top: 1px solid; border-left: 1px solid; border-right: 1px solid;">
                  <span>Time in Zone</span>
                </div>
              </div>
              <div class="row" style="text-align: center;">
                <div class="col-lg-1">  
                </div>
                <div class="col-lg-5" style="border-bottom: 1px solid; border-left: 1px solid; border-right: 1px solid;">
                  <span>0</span>
                </div>
                <div class="col-lg-1">  
                </div>
                <div class="col-lg-5" style="border-bottom: 1px solid; border-left: 1px solid; border-right: 1px solid;">
                  <span>0 s</span>
                </div>
              </div><br>
                <div class="row">
                <div class="col-lg-1">
                </div> 
                <div class="col-lg-11" style="text-align: center;background-color: #e6e6e6; padding: 20px;">
                  <span>การทรงตัว : พอใช้</span>
                  <p>หมั่นฝึกฝนต่อไป เพื่อการทรงตัวที่ดียิ่งขึ้น</p>
                </div>
              </div>    
          </div>      
        </div>

<script>
	  	  
   


    
    


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


	var ileft = 0;	
<?php $i=0 ?>
    var setleft = setInterval(function (t) {
	ileft++;
      values = findLeftContourArray([
//		  Math.floor(Math.random() * 600),
//        Math.floor(Math.random() * 600),
//        Math.floor(Math.random() * 600),
//        Math.floor(Math.random() * 600),
//        Math.floor(Math.random() * 600)

		  <?php 
     for ($i=0; $i < count($playback_time_arr_left) ; $i++) { 
        echo $playback_time_arr_left[$i];
      }
        // if ($i==count($playback_time_arr_left)) {
        //   $i=0; 
        // }else{
        //   $i++; 
        // }
     						 
							  
		  ?>
      ])
      contours
        .thresholds (d3.range(0, 600, 50))
        (values)
        .forEach(fill);
    }, 3000)
	<?php $c=0 ?>
	var setright = setInterval(function (ttr) {
      valuesright = findRightContourArray([
//        Math.floor(Math.random() * 600),
//        Math.floor(Math.random() * 600),
//        Math.floor(Math.random() * 600),
//        Math.floor(Math.random() * 600),
//        Math.floor(Math.random() * 600)
//		  600,600,600,600,600

		  	<?php 
        //for ($i=0; $i < count($playback_time_arr_right) ; $i++) { 
          echo $playback_time_arr_right[$c];
        //}
        // if ($i==count($playback_time_arr_right)) {
        //   $c=0; 
        // }else{
        //   $c++; 
        // }
							//   $result = mysqli_fetch_array($query);
							//   $left_1=$result['left_sensor1'];
							//   $left_2=$result['left_sensor2'];
							//   $left_3=$result['left_sensor3'];
							//   $left_4=$result['left_sensor4'];
							//   $left_5=$result['left_sensor5'];
							// echo($left_1.",".$left_2.",".$left_3.",".$left_4.",".$left_5."");
		  	?>
      ])
//	  console.log(valuesright)
      contoursr
        .thresholds(d3.range(0, 600, 50))
        (valuesright)
        .forEach(fillr);
    }, 3000)
	     
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

 


  </script>

<!-- Load d3.js -->

<script>

// set the dimensions and margins of the graph
var width = 285,
    height = 285,
    margin = 10

// The radius of the pieplot is half the width or half the height (smallest one). I subtract a bit of margin.
var radius = Math.min(width, height) / 2 - margin

// append the svg object to the div called 'my_dataviz'
var svg = d3.select("#my_dataviz")
  .append("svg")
    .attr("width", width)
    .attr("height", height)
  .append("g")
    .attr("transform", "translate(" + width / 2 + "," + height / 2 + ")");

// Create dummy data
var data = {" ": 25, " ": 25, " ":25, " ":25}

// set the color scale
var colorb = d3.scaleOrdinal()
  .domain(data)
  .range(d3.schemeSet2);

// Compute the position of each group on the pie:
var pie = d3.pie()
  .value(function(d) {return d.value; })
var data_ready = pie(d3.entries(data))
// Now I know that group A goes from 0 degrees to x degrees and so on.

// shape helper to build arcs:
var arcGenerator = d3.arc()
  .innerRadius(0)
  .outerRadius(radius)

// Build the pie chart: Basically, each part of the pie is a path that we build using the arc function.
svg
  .selectAll('mySlices')
  .data(data_ready)
  .enter()
  .append('path')
    .attr('d', arcGenerator)
    .attr('fill', function(d){ return(colorb(d.data.key)) })
//    .attr("stroke", "black")
    .style("stroke-width", "2px")
    .style("opacity", 0.7)

// Now add the annotation. Use the centroid method to get the best coordinates
svg
  .selectAll('mySlices')
  .data(data_ready)
  .enter()
  .append('text')
  .text(function(d){ return " " + d.data.key})
  .attr("transform", function(d) { return "translate(" + arcGenerator.centroid(d) + ")";  })
  .style("text-anchor", "middle")
  .style("font-size", 14)

</script>
