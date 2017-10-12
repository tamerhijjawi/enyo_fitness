<?php
	$connect_error = 'Error message';
	$con = mysqli_connect('localhost','root','');
	mysqli_select_db($con,'enyolr') or die($connect_error);
?>