<!DOCTYPE html>
<html lang="en">

<?php 
$currentPage = 'Register';
require 'core/init.php';
logged_in_redirect();
include 'includes/head.php'; 
?>

<body id = "sign">
    
    <?php include 'includes/header.php'; ?>

    <?php

    if (empty($_POST) === false){
        $required_fields = array('username', 'password', 'password_again', 'first_name', 'email');
        foreach ($_POST as $key => $value) {
            if(empty($value) && in_array($key, $required_fields) === true){
                $errors[] = 'Fields marked with an asterisk are required';
                break 1;
            }
        }

        if (empty($errors) === true){
            if (user_exists($_POST['username']) === true){
                $errors[] = 'Sorry, the username \'' . $_POST['username'] . '\' is already taken.';
            }
            if(preg_match("/\\s/", $_POST['username']) == true){
                $errors[] = 'Your username must not contain any spaces.';
            }
            if(strlen($_POST['password']) < 6){
                $errors[] = 'Your password must be at least 6 characters.';
            }
            if($_POST['password'] !== $_POST['password_again']){
                $errors[] = 'Your passwords do not match.';
            }
            if(filter_var($_POST['email'], FILTER_VALIDATE_EMAIL) === false){
                $errors[] = 'A valid email address is required';
            }
            if(email_exists($_POST['email']) === true){
                $errors[] = 'Sorry, the email \'' . $_POST['email'] . '\' is already in use.';
            }
        }
    }
    ?>

    <div class="form">

        <div id="input">   
            <h1>Sign Up for Free</h1>

            <?php

            if (isset($_GET['success']) && empty($_GET['success'])){
                echo "<li>You've been registered successfully!, Please check your email to activate your account.</li>";                   
            } else {
                date_default_timezone_set('America/Toronto');
                if(empty($_POST) === false && empty($errors) === true){                         
                    $register_data = array(
                    'username'      => $_POST['username'],
                    'password'      => $_POST['password'],
                    'first_name'    => $_POST['first_name'],
                    'last_name'     => $_POST['last_name'],
                    'email'         => $_POST['email'],
                    'email_code'    => md5($_POST['username'] . microtime()),
                    'date'          => date('Y-m-d H:i:s'),
                    );
                    register_user($register_data);
                    header('Location: register.php?success');
                    exit();

                }else if(empty($errors) === false){                         
                    echo output_errors($errors);
                }                
            ?>
          
            <form action="" method="post">

                <div class="top-row">
                    <div class="field-wrap">
                        <label>
                        First Name<span class="req">*</span>
                        </label>
                        <input name="first_name" type="text" required autocomplete="off" />
                    </div>

                    <div class="field-wrap">
                        <label>
                        Last Name<span></span>
                        </label>
                        <input name="last_name" type="text" autocomplete="off"/>
                    </div>
                </div>

                <div class="field-wrap">
                    <label>
                      Email Address<span class="req">*</span>
                    </label>
                    <input name="email" type="email" required autocomplete="off"/>
                </div>

                <div class="field-wrap">
                    <label>
                      User Name<span class="req">*</span>
                    </label>
                    <input name= "username" type="username" required autocomplete="off"/>
                </div>

                <div class="field-wrap">
                    <label>
                      Set A Password<span class="req">*</span>
                    </label>
                    <input name="password" type="password" required autocomplete="off"/>
                </div>

                <div class="field-wrap">
                    <label>
                      Re-type Password<span class="req">*</span>
                    </label>
                    <input name="password_again" type="password" required autocomplete="off"/>
                </div>

                <button type="submit" name="submit" value="register-user" class="button button-block"/>Get Started</button>

            </form>
            <?php
            }
            ?>
        </div>


    </div> <!-- /form -->

    <?php
    include 'includes/footer.php' 
    ?>
    <!--/#footer-->  
</body>
</html>
