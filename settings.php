<!DOCTYPE html>
<html lang="en">

<?php 
$currentPage = 'Settings';
require 'core/init.php';
protect_page();
include 'includes/head.php'; 

if(empty($_POST) === false){
    $required_fields = array('first_name', 'email', 'username');
    foreach($_POST as $key=>$value){
        if(empty($value) && in_array($key, $required_fields) === true){
            $errors[] = 'Fields marked with an asterisk are required';
            break 1;
        }
    }

    if(empty($errors) === true){
        if(filter_var($_POST['email'], FILTER_VALIDATE_EMAIL) === false){
            $errors[] = 'A valid email address is required';
        } else if(email_exists($_POST['email']) === true && $user_data['email'] !== $_POST['email']){
            $errors[] = 'Sorry, the email \'' . $_POST['email'] . '\' is already in use';
        }else if(user_exists($_POST['username']) === true && $user_data['username'] !== $_POST['username']){
            $errors[] = 'Sorry, the username \'' . $_POST['username'] . '\' is already in use';
        }
    }
}
?>

<body id = "sign">
    
    <?php include 'includes/header.php'; ?>

    <div class="form">

        <div id="input">   
            <h1>Update User Information</h1>

            <?php
            if (isset($_GET['success']) && empty($_GET['success'])){
                echo "<li>Your details have been updated.</li>";
            }else{
                if(empty($_POST) === false && empty($errors) === true){
                    if(empty($_POST) === false && empty($errors) === true){                         
                        $update_data = array(
                        'username'      => $_POST['username'],
                        'first_name'    => $_POST['first_name'],
                        'last_name'     => $_POST['last_name'],
                        'email'         => $_POST['email'],
                        'allow_email'    => ($_POST['allow_email'] == "on") ? 1:0,
                        );
                        update_user($session_user_id,$update_data);
                        header('Location: settings.php?success');
                        exit();
                    }
                }else if (empty($errors) === false){
                    echo output_errors($errors);
                }
            ?>

            <form action="" method="post">

                <div class="top-row">
                    <div class="field-wrap">
                        <p>First Name*:</b></p>
                        <input name="first_name" type="text" required autocomplete="off" value="<?php echo $user_data['first_name']; ?>"/>
                    </div>
                    <div class="field-wrap">
                        <p>Last Name:</b></p>
                        <input name="last_name" type="text" autocomplete="off" value="<?php echo $user_data['last_name']; ?>"/>
                    </div>
                </div>
                <div class="field-wrap">
                    <p>Email*:</b></p>
                    <input name="email" type="email" required autocomplete="off" value="<?php echo $user_data['email']; ?>"/>
                </div>
                <div class="field-wrap">
                    <p>User Name*:</b></p>
                    <input name="username" type="username" required autocomplete="off" value="<?php echo $user_data['username']; ?>"/>
                </div>

                <div class = "checkbox-form">
                    <input type="checkbox" name="allow_email" <?php if($user_data['allow_email'] == 1){ echo 'checked = "checked"';} ?>> Would you like to receive email from us?</label>
                </div>

                <button type="submit" name="submit" value="settings-user" class="button button-block"/>Update</button>

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
