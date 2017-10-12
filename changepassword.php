<!DOCTYPE html>
<html lang="en">

<?php 
$currentPage = 'Change Password';
require 'core/init.php';
protect_page();
include 'includes/head.php'; 
?>

<body id = "sign">
    
    <?php include 'includes/header.php'; ?>

    <?php

    if (empty($_POST) === false){
        $required_fields = array('current_password','password', 'password_again');
        foreach ($_POST as $key => $value) {
            if(empty($value) && in_array($key, $required_fields) === true){
                $errors[] = 'Fields marked with an asterisk are required';
                break 1;
            }
        }
        if (md5($_POST['current_password']) == $user_data['password']){
            if(trim($_POST['password']) !== trim($_POST['password_again'])){
                $errors[] = 'Your new passwords do not match';
            } else if (strlen($_POST['password']) < 6){
                $errors[] = 'Your password must be at least 6 characters';
            }
        }else{
            $errors[] = 'Your current password is incorrect';
        }
    }
    ?>

    <div class="form">

        <div id="input">   
            <h1>Change Password</h1>

            <?php
            if(isset($_GET['success']) && empty($_GET['success'])){
                echo "<li>Your password has been changed successfully!</li>";
            }else{
                if(isset($_GET['force']) && empty($_GET['force'])){
                    echo "<li>You must change your recovery password to access the site.</li>";
                }
                if(empty($_POST) === false && empty($errors) === true){
                    change_password($session_user_id,$_POST['password']);
                    header('Location: changepassword.php?success');
                } else if(empty($errors) ===false){
                    echo output_errors($errors);
                }
            ?>
          
            <form action="" method="post">

                <div class="field-wrap">
                    <label>
                    Current Password<span class="req">*</span>
                    </label>
                    <input name="current_password" type="password" required autocomplete="off" />
                </div>

                <div class="field-wrap">
                    <label>
                    New Password<span class="req">*</span>
                    </label>
                    <input name="password" type="password" autocomplete="off"/>
                </div>

                <div class="field-wrap">
                    <label>
                      Re-type New Password<span class="req">*</span>
                    </label>
                    <input name="password_again" type="password"required autocomplete="off"/>
                </div>

                <button type="submit" name="submit" value="change-password" class="button button-block"/>Change Password</button>

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
