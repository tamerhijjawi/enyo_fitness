<!DOCTYPE html>
<html lang="en">

<?php 
$currentPage = 'Log-in';
require 'core/init.php';
logged_in_redirect();
include 'includes/head.php'; 
?>

<body id = "sign">

    <?php include 'includes/header.php'; ?>

    <?php
    //var_dump($_POST);
    if (empty($_POST) === false){

      $user = $_POST['username'];
      $pass = $_POST['password'];

      if(user_exists($user) === false){

        $errors[] = 'username does not exist, have you registered?';

      } else if(user_active($user) === false){

        $errors[] = 'You have not activated your account';

      } else {

        if(strlen($pass) > 32){
          $errors[]= 'Password too long';
        }

        $login = login($user,$pass);
        if($login === false){
          $errors[] = 'Username/password combination is incorrect';
        }else{
          $_SESSION['user_id'] = $login;
          header('Location: index.php');
          exit();
        }
      }

    } else {
      $errors[]='No data received';
    }
    ?>

    <div class="form">
        
        <div id="input">   
            <h1>Welcome Back!</h1>

            <?php
            if (empty($errors) === false && empty($_POST) === false){
            ?>
            <h2>We tried to log you in, but...</h2>
            <?php echo output_errors($errors); ?>
            <?php
            }
            ?>

            <form action="" method="post">
            
                <div class="field-wrap">
                    <label>
                      User Name<span class="req">*</span>
                    </label>
                    <input name= "username" type="username" required autocomplete="off"/>
                </div>

                <div class="field-wrap">
                    <label>
                    Password<span class="req">*</span>
                    </label>
                    <input name="password" type="password" required autocomplete="off"/>
                </div>

                <div class="forgot">
                    <p>Forgot your <a href ="recover.php?mode=username">username</a> or <a href="recover.php?mode=password"> Password</a>?</p>
                    <a href="register.php">Register</a>
                </div>

                <button type="submit" name="submit" value="login-user" class="button button-block"/>Log In</button>

            </form>
        </div>

    </div> <!-- /form -->

    <?php include 'includes/footer.php' ?>
    <!--/#footer-->
</body>
</html>
