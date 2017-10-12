<!DOCTYPE html>
<html lang="en">

<?php 
$currentPage = 'Recover';
require 'core/init.php';
logged_in_redirect();
include 'includes/head.php'; 
?>

<body id = "sign">
    
    <?php include 'includes/header.php'; ?>

    <div class="form">

        <div id="input">   
            <h1>Recover Account Information</h1>

            <?php
                if(isset($_GET['success']) === true && empty($_GET['success'] === true)){
                    echo "<li>Thanks, we've emailed you!</li>";
                }
                else{
                    $mode_allowed = array('username','password');
                    if(isset($_GET['mode']) === true && in_array($_GET['mode'], $mode_allowed) === true){
                        if(isset($_POST['email']) === true && empty($_POST['email']) === false){
                            if(email_exists($_POST['email']) === true){
                                recover($_GET['mode'], $_POST['email']);
                                header('Location: recover.php?success');
                            }else{
                                echo "<li>Oops, we couldn't find that email address</li>";
                            }
                        }
                    }else{
                        header('Location: index.php');
                        exit();
                    }                    
                ?>         
            <form action="" method="post">

                <div class="field-wrap">
                    <label>
                    Enter Email<span class="req">*</span>
                    </label>
                    <input name="email" type="email" required autocomplete="off" />
                </div>

                <button type="submit" name="submit" value="recover" class="button button-block"/>Recover</button>
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
