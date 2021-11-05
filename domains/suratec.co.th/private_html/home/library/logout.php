<meta charset="utf-8">

<?php
	@session_start();

	//session_destroy();
	
	unset($_SESSION["id_google"],$_SESSION["id_facebook"],$_SESSION['user_id'],$_SESSION['permission'],$_SESSION['user_member'],$_SESSION['task_view'],$_SESSION['task_authen'],$_SESSION['id_customer']);


	
			echo"<script>";
			echo"window.location='../index.php?index=st';";
			echo"			
			  var auth2 = gapi.auth2.getAuthInstance();
			  auth2.signOut().then(function () {
				console.log('User signed out.');
			  });
			
		    ";
			echo"</script>";
?>

