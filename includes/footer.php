<?php

    $errors_newsletter = array();

    if (empty($_POST) === false){
        
        if(empty($_POST['newsletter-email'])){
            $errors_newsletter[] = 'Please Enter an email Address';
        }

        if(empty($errors_newsletter) === true){
            if(filter_var($_POST['newsletter-email'], FILTER_VALIDATE_EMAIL) === false){
                $errors_newsletter[] = 'A valid email address is required';
            }
            if(newsletter_email_exists($_POST['newsletter-email']) === true){
                $errors_newsletter[] = 'You are already subscribed!';
            }
        }
    }

?>

<div id = "footer">
    <div class = "container">
        <div class="text-center">
            <img src="images\2png.png" width="200" alt="Enyo Fitness">
        </div>
        <form id = "newsletter" action="" method="post">
            <div class="form-group col-md-12 text-center">
                <h2>Subscribe to Receive Updates and Amazing Deals!</h2>
            </div>
            <div class="form-group col-md-4 col-md-offset-4">
                <input type="email" class="form-control" name="newsletter-email" placeholder="Enter your Email">
            </div>
            <div class="form-group col-md-4 col-md-offset-4">
                <button type = "submit" name="submit" value="newsletter-register" class="btn btn-block btn-danger">Subscribe</button>  
            </div>

        <?php

            if (isset($_GET['n-success']) && empty($_GET['n-success'])){
                echo "<h4 class = 'text-center'>You've been added to our newsletter!</h4>";                   
            } else {
                if(empty($_POST) === false && empty($errors_newsletter) === true){                                                    
                    $newsletter_data = $_POST['newsletter-email'];
                    newsletter_register($newsletter_data);
                    //echo "<script type='text/javascript'>alert('$newsletter_data');</script>";
                    $url = substr($_SERVER['REQUEST_URI'], 7, strlen($_SERVER['REQUEST_URI']));
                    header('Location:' . $url . '?n-success');
                    exit();

                }else if(empty($errors_newsletter) === false){                         
                    echo "<h4 class = 'text-center'>" . implode(', ', $errors_newsletter) . "</h4>";
                }
            }

        ?>

        </form>
    </div>

    <div id = "bottom-footer">
        <div class = "container">
            <div class="row">
                 <div class="col-md-12 col-sm-12">
                    <div class="copyright-text">
                        <p>&copy; 2017 Enyo Fitness. All Rights Reserved. <a href="contact.php">Contact Us</a></p>
                    </div>               
                </div>  
            </div>  
        </div>
    </div>  

</div>

<script type="text/javascript" src="js/jquery.js"></script>
<script type="text/javascript" src="js/bootstrap.js"></script>
<script type="text/javascript" src="js/bootstrap.min.js"></script>
<script type="text/javascript" src="js/wow.min.js"></script>
<script type="text/javascript" src="js/lightbox.min.js"></script>  
<script type="text/javascript" src="js/main.js"></script> 
<script>
    $(document).ready(function () {
        $('.dropdown-toggle').dropdown();
    });
</script>


