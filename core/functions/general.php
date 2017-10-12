<?php
function contact_mail($subject, $body, $email){
	mail('contact@enyofitness.com', $subject, $body, 'From: ' . $email);
}

function email($to, $subject, $body){
	mail($to, $subject, $body, 'From: contact@enyofitness.com');
}

function logged_in_redirect(){
	if(logged_in() === true){
		header('Location: index.php');
	}
}

function protect_page(){
	if(logged_in()===false){
		header('Location: protected.php');
		exit();
	}
}

function account_protect(){
	global $user_data;
	if(has_access($user_data['user_id']) === false){
		header('Location: index.php');
		exit();
	}
}

function master_protect(){
	global $user_data;
	if(is_master($user_data['user_id']) === false){
		header('Location: index.php');
		exit();
	}
}

function array_sanitize(&$item){
	global $con;
	$item = htmlentities(strip_tags(mysqli_real_escape_string($con, $item)));
}

function sanitize($data){
	global $con;
  	return htmlentities(strip_tags(mysqli_real_escape_string($con,$data)));
}


function output_errors($errors){
	
	return '<ul><li>' . implode('</li><li>', $errors) . '</li></ul>';
}

?>
