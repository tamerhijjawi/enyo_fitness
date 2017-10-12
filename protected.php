<!DOCTYPE html>
<html lang="en">

<?php
$currentPage = 'Protected';
require 'core/init.php';
include 'includes/head.php'; 
?>

<body>
    <?php include 'includes/header.php'; ?>

    <div class = container>
   		<h1>Sorry, you need to be <a href="log-in.php">Logged In</a> to access this page.</h1>
    </div>

<!-- Footer -->
    <?php include 'includes/footer.php' ?>

</body>

</html>