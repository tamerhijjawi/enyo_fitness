<!DOCTYPE html>
<html lang="en">

<?php 
$currentPage = 'Activate';
require 'core/init.php';
logged_in_redirect();
include 'includes/head.php'; 
?>

<body>

    <?php
    include 'includes/header.php';
    if(isset($_GET['success']) === true && empty($_GET['success']) === true){
    ?>
        <div class = container>
            <h1>Thanks we activated your account...</h1>
            <p>You're free to <a href="log-in.php">Log In</a></p>
            
        </div>
    <?php
    }else if(isset($_GET['email'], $_GET['email_code']) === true){
        $email = trim($_GET['email']);
        $email_code = trim($_GET['email_code']);

        if(email_exists($email) === false){
            $errors[] = 'Oops, something went wrong, and we couldn\'t find that email address';
        }else if (activate($email,$email_code) === false) {
            $errors[] = 'We had problems activating your account';
        }

        if(empty($errors) === false){
            ?>
            <h2>Oops...</h2>
            <?php
            echo output_errors($errors);
        }else{
            header('Location: activate.php?success');
        }

    }else {
        header('Location: index.php');
        exit();
    }
    ?>

    <?php
    include 'includes/footer.php' 
    ?>
    <!--/#footer-->
</body>
</html>
