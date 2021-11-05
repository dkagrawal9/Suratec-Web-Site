<?php

function lang_menu($val_th,$val_en){
 // if(isset($_COOKIE['lang'])){
    //  switch ($_COOKIE['lang']) {
      //  case 'th':
           $name = $val_th;
      //  break;
        // case 'aud':
        //    $name = $val_en;
        // break;
   //   }
   // }
    
    // else{
    //   $name = $val_en;
    // }
  return $name;
}

function lang($th,$en){
	// if(isset($_COOKIE['lang'])){
	//	switch ($_COOKIE['lang']) {
	//		case 'th':
				return $th;
			//	break;
			// case 'aud':
			// 	return $en;
			// 	break;
//		}
  //}
  
  // else{
	// 	return $en;
	// }
}


?>