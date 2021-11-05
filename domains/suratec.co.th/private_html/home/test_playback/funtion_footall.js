
///////////////////////////////////////////////////////////////////////////////////////////////////////////////start left//

function findLeftContourArray_f(left_sensor1,left_sensor2,left_sensor3,left_sensor4,left_sensor5,number_all){

	var ileft = 0;
	var left_sensor1 = left_sensor1;
	var left_sensor2 = left_sensor2;
	var left_sensor3 = left_sensor3;
	var left_sensor4 = left_sensor4;
	var left_sensor5 = left_sensor5;
	var leftstop = number_all;
//	var leftstop = <?=$num?>;
//	var data_l = 
//	var json_l = JSON.parse(data_l);
	//var left1 = <?php// print_r($left_sensor[0])?>
//		console.log(data.left_sensor);
//		console.log(data.right_sensor);
		var setleft = setInterval(function (t) {
		values = findLeftContourArray([
			
//			left_sensor1,
//			left_sensor2,
//			left_sensor3,
//			left_sensor4,
//			left_sensor5
		  Math.floor(Math.random() * 600),
        Math.floor(Math.random() * 600),
        Math.floor(Math.random() * 600),
        Math.floor(Math.random() * 600),
        Math.floor(Math.random() * 600)	

//	    document.open(),
//      document.write(ileft),
//      document.close()
      ])
	
//	 	alert(ileft)
		//console.log(ileft);
			
//		console.log(ileft);
      contours
        .thresholds (d3.range(0, 600, 50))
        (values)
        .forEach(fill);
	}, 1000)
}
///////////////////////////////////////////////////////////////////////////////////////////////////////////////end left//

		
///////////////////////////////////////////////////////////////////////////////////////////////////////////////start right//		
	
function findRightContourArray_f(right_sensor1,right_sensor2,right_sensor3,right_sensor4,right_sensor5){

	var iright = 0;
	var rightstop = number_all;
	var right_sensor1 = right_sensor1;
	var right_sensor2 = right_sensor2;
	var right_sensor3 = right_sensor3;
	var right_sensor4 = right_sensor4;
	var right_sensor5 = right_sensor5;

	var setright = setInterval(function (tr) {
      valuesright = findRightContourArray_f([
		  
		  	right_sensor1,
			right_sensor2,
			right_sensor3,
			right_sensor4,
			right_sensor5
		  
//        Math.floor(Math.random() * 600),
//        Math.floor(Math.random() * 600),
//        Math.floor(Math.random() * 600),
//        Math.floor(Math.random() * 600),
//        Math.floor(Math.random() * 600)
//		  600,600,600,600,600
      ])
//	  console.log(iright)
      contoursr
        .thresholds(d3.range(0, 600, 50))
        (valuesright)
        .forEach(fillr);
    }, 1000)
}
///////////////////////////////////////////////////////////////////////////////////////////////////////////////end right//		
	     