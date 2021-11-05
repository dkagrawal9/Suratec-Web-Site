<?php
  $task_view = explode(",",$_SESSION['task_view']);
  $task_authen = explode(",",$_SESSION['task_authen']);
  if($_SESSION['permission']!='Super_admin'){
  	if(!isset($id_cookie)){
  		$set_cookie = explode("/", $local);
  		$push_cookie = $set_cookie[0].'/'.'front-manage.php';

  		$str_local = 'SELECT id_system,link_system,type FROM system WHERE link_system = "'.$push_cookie.'"'; #อยู่ในไฟล์ nav menu
		$query_local = mysqli_query($objConnect,$str_local);
		$result_local = mysqli_fetch_array($query_local);
		if(($key = array_search($result_local['id_system'],$task_view)) !== false){ 
			if($task_authen[$key]==1){
		        $button_open = '';
		        $button_del = '';
		        $button_del_s = 'display:none';
		        $button_edit = '';
		        $input_read = '';
		        $image_click = 'img-upload';

		        $task_manage = '';
		        $task_alert = 'display:none;';
		     }elseif($task_authen[$key]==2){
		        $button_open = '';
		        $button_del = 'display:none';
		        $button_del_s = 'display:none';
		        $button_edit = '';
		        $input_read = '';
		        $image_click = 'img-upload';

		        $task_manage = 'display:none;';
		        $task_alert = '';
		     }elseif($task_authen[$key]==3){
		        $button_open = 'display:none';
		        $button_del = 'display:none';
		        $button_del_s = 'display:none';
		        $button_edit = 'display:none';
		        $input_read = 'readonly';
		        $image_click = '';

		        $task_manage = 'display:none;';
		        $task_alert = '';
		      }
		    }else{
		      $button_open = 'display:none';
		      $button_del = 'display:none';
		      $button_del_s = 'display:none';
		      $button_edit = 'display:none';
		      $input_read = 'readonly';
		      $image_click = '';

		      $task_manage = 'display:none;';
		      $task_alert = '';
		    }
  	}else{
	    if(($key = array_search($id_cookie,$task_view)) !== false){ 
	      if($task_authen[$key]==1){
	        $button_open = '';
	        $button_del = '';
	        $button_del_s = 'display:none';
	        $button_edit = '';
	        $input_read = '';
	        $image_click = 'img-upload';

	        $task_manage = '';
	        $task_alert = 'display:none;';
	      }elseif($task_authen[$key]==2){
	        $button_open = '';
	        $button_del = 'display:none';
	        $button_del_s = 'display:none';
	        $button_edit = '';
	        $input_read = '';
	        $image_click = 'img-upload';

	        $task_manage = 'display:none;';
	        $task_alert = '';
	      }elseif($task_authen[$key]==3){
	        $button_open = 'display:none';
	        $button_del = 'display:none';
	        $button_del_s = 'display:none';
	        $button_edit = 'display:none';
	        $input_read = 'readonly';
	        $image_click = '';

	        $task_manage = 'display:none;';
	        $task_alert = '';
	      }
	    }else{
	      $button_open = 'display:none';
	      $button_del = 'display:none';
	      $button_del_s = 'display:none';
	      $button_edit = 'display:none';
	      $input_read = 'readonly';
	      $image_click = '';

	      $task_manage = 'display:none;';
	      $task_alert = '';
	    }
	}
  }else{
    $button_open = '';
    $button_del = '';
    $button_del_s = ''; #button delete for SUPER ADMIN
    $button_edit = '';
    $input_read = '';
    $image_click = 'img-upload';

    $task_manage = '';
    $task_alert = 'display:none;';
  }
   
?>