<?php
function mail_users($subject, $body){
	global $con;
	$query = mysqli_query($con, "SELECT email, first_name FROM users WHERE allow_email = 1");
	while ($row = mysqli_fetch_assoc($query)){
	email($row['email'], $subject, "Hello " . $row['first_name'] . ",\n\n" . $body);
	}
}

function has_access($user_id){
	global $con;
	$user_id = (int)$user_id;
	$query = mysqli_query($con,"SELECT COUNT(user_id) FROM users WHERE user_id = '$user_id' AND type != 0"); 
	return (mysqli_result($query, 0) == 1) ? true:false;
}

function is_master($user_id){
	global $con;
	$user_id = (int)$user_id;
	$query = mysqli_query($con,"SELECT COUNT(user_id) FROM users WHERE user_id = '$user_id' AND type = '4'"); 
	return (mysqli_result($query, 0) == 1) ? true:false;
}

function recover($mode, $email){
	global $con;
	$mode = sanitize($mode);
	$email = sanitize($email);

	$user_data = user_data(user_id_from_email($email), 'first_name','username', 'user_id');

	if($mode =='username'){
		email($email, 'Your Username', "Hello " . $user_data['first_name'] . ",\n\nYour username is:\n\n" . $user_data['username'] . "\n\n- Enyo Fitness");
	}else if($mode == 'password'){
		$generated_password = substr(md5(rand(999,999999)),0,8);
		change_password($user_data['user_id'], $generated_password);
		update_user($user_data['user_id'], array('password_recover' => '1'));
		email($email, 'Your Password Recovery', "Hello " . $user_data['first_name'] . ",\n\nYour password is:\n\n" . $generated_password . "\n\n- Enyo Fitness");
	}
}

function update_user($user_id, $update_data){
	global $con;
	$update = array();
	array_walk($update_data, 'array_sanitize');

	foreach($update_data as $field=>$data){
		$update[] = $field . ' = \'' . $data . '\'';
	}
	mysqli_query($con,"UPDATE users SET " . implode(', ', $update) . " WHERE user_id = '$user_id'");
}

function activate($email, $email_code){
	global $con;
	$email = mysqli_real_escape_string($con, $email);
	$email_code = mysqli_real_escape_string($con, $email_code);
	$query = mysqli_query($con,"SELECT COUNT(user_id) FROM users WHERE active = '0' AND email = '$email' AND email_code = '$email_code'");
	$result = mysqli_result($query,0, 0);
	if ($result == 1){
		mysqli_query($con,"UPDATE users SET active = 1 WHERE email = '$email'");
	} else{
		return false;
	}
}

function change_password($user_id, $password){
	$user_id = (int)$user_id;
	$password = md5($password);
	global $con;
	mysqli_query($con,"UPDATE users SET password = '$password', password_recover = 0 WHERE user_id = '$user_id'");
}

function register_user($register_data){
	global $con;
	array_walk($register_data, 'array_sanitize');
	$register_data['password'] = md5($register_data['password']);
	$fields = implode(", ", array_keys($register_data));
	$data = "'" . implode("', '", $register_data) ."'";

	mysqli_query($con,"INSERT INTO users ($fields) VALUES ($data)");
	email($register_data['email'], 'Activate your account', "Hello " . $register_data['first_name'] . ",\n\nYou need to activate your account, so use the link below\n\nhttp://localhost:100/enyolr/activate.php?email=" . $register_data['email'] . "&email_code=" . $register_data['email_code']. "\n\n- Enyo Fitness");
}

function newsletter_register($newsletter_data){
	global $con;
	mysqli_query($con,"INSERT INTO newsletter (email) VALUES ('$newsletter_data')");
}

function user_count(){
	global $con;
	$query = mysqli_query($con,"SELECT COUNT(user_id) FROM users WHERE active = '1'");
	$result = mysqli_result($query,0, 0);
	return $result;
}

function user_data($user_id){

	 global $con;
	 
	 $user_id = (int)$user_id;

	 $func_num_args = func_num_args();
	 $func_get_args = func_get_args();

	 if ($func_num_args > 1) {
	  unset($func_get_args[0]);
	 }

	 $sql = "SELECT * FROM users WHERE user_id = '$user_id'";
	 $result = mysqli_query($con, $sql);
	 $data = mysqli_fetch_assoc($result);
	 return $data;

}

function logged_in(){
	return(isset($_SESSION['user_id']))? true:false;
}

function mysqli_result($res,$row,$col=0){ 
    $numrows = mysqli_num_rows($res); 
    if ($numrows && $row <= ($numrows-1) && $row >=0){
        mysqli_data_seek($res,$row);
        $resrow = (is_numeric($col)) ? mysqli_fetch_row($res) : mysqli_fetch_assoc($res);
        if (isset($resrow[$col])){
            return $resrow[$col];
        }
    }
    return false;
}

function user_exists($username){
 
 global $con;
 $username = sanitize($username);

 $query = mysqli_query($con,"SELECT COUNT(user_id) FROM users WHERE username = '$username'");
 // Count the amount of rows where username = $unsername
 $check = mysqli_num_rows($query);

 return (mysqli_result($query, 0) == 1) ? true:false;
}

function email_exists($email){
 
 global $con;
 $email = sanitize($email);

 $query = mysqli_query($con,"SELECT COUNT(user_id) FROM users WHERE email = '$email'");
 // Count the amount of rows where username = $unsername
 $check = mysqli_num_rows($query);

 return (mysqli_result($query, 0) == 1) ? true:false;
}

function newsletter_email_exists($email){
 
 global $con;
 $email = sanitize($email);

 $query = mysqli_query($con,"SELECT COUNT(user_id) FROM newsletter WHERE email = '$email'");
 // Count the amount of rows where username = $unsername
 $check = mysqli_num_rows($query);

 return (mysqli_result($query, 0) == 1) ? true:false;
}

function user_active($username){
 
 global $con;
 $username = sanitize($username);

 $query = mysqli_query($con,"SELECT COUNT(user_id) FROM users WHERE username = '$username' AND active = 1");
 
 $check = mysqli_num_rows($query);

 return (mysqli_result($query, 0) == 1) ? true:false;
}
	
function user_id_from_username($username){
	
	global $con;
	$username = sanitize($username);
	$query = mysqli_query($con,"SELECT user_id FROM users WHERE username = '$username'");
	return mysqli_result($query,0, 0);
}

function user_id_from_email($email){
	
	global $con;
	$email = sanitize($email);
	$query = mysqli_query($con,"SELECT user_id FROM users WHERE email = '$email'");
	return mysqli_result($query,0, 0);
}

function login($username, $password){
	$user_id = user_id_from_username($username);
	global $con;
	$username = sanitize($username);
	$password = md5($password);
	$query = mysqli_query($con,"SELECT COUNT(user_id) FROM users WHERE username = '$username' AND password = '$password'");

	return (mysqli_result($query, 0) == 1) ? $user_id:false;
}
?>