<?php
	ob_start();
	session_start();
	require 'database/connect.php';
	require 'functions/general.php';
	require 'functions/users.php';

	if(logged_in() === true){
		$session_user_id = $_SESSION['user_id'];
		$user_data = user_data($session_user_id);
		if(user_active($user_data['username']) === false){
			session_destroy();
			header('Location: index.php');
			exit();
		}
		if($currentPage !== 'Change Password' && $user_data['password_recover'] == 1){
			header('Location: changepassword.php?force');
			exit();
		}
	}


	$errors = array();
?>