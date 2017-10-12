<?php 
$currentPage = 'Contact';
require 'core/init.php';
?>

<!DOCTYPE html>
<html lang="en">

<?php
include 'includes/head.php'; 
?>

<body id = "sign">
    
    <?php include 'includes/header.php'; ?>

	<div class="form">
	    <div id="input">
	    	<h1 class="text-center">Contact Us</h1>
		    <?php
                if(isset($_GET['success']) === true && empty($_GET['success']) === true){
                    echo '<h2 class="text-center">Email has been sent. We will reply within 2 Business Days</h2>';
                }else{
                    if(empty($_POST) === false){
                        if(empty($_POST['name']) === true){
                            $errors[] = 'Name is required';
                        }
                        if(empty($_POST['email']) === true){
                            $errors[] = 'E-mail is required';
                        }
                        if(empty($_POST['body']) === true){
                            $errors[] = 'Body is required';
                        }
                        if(empty($errors) === false){
                            echo output_errors($errors);
                        }else{
                            contact_mail('Contact Us',$_POST['body'], $_POST['email']);
                            header('Location: contact.php?success');
                            exit();
                        }
                    }
            ?>
		    <form action="" method="post">
		        <div class="field-wrap">
		        	<p>Name:<span class="req">*</span></p>
		            <input type="text" name="name" class="form-control" required="required">
		        </div>
		        <div class="field-wrap">
		        	<p>email:<span class="req">*</span></p>
		            <input type="email" name="email" class="form-control" required="required">
		        </div>
		        <div class="field-wrap">
		        	<p>Body:<span class="req">*</span></p>
		            <textarea name="body" required="required" class="form-control" rows="8"></textarea>
		        </div>                     
		        <div class="form-group">
		            <input type="submit" name="submit" class="button button-block" value="Submit">
		        </div>
		    </form>
		    <?php
            	}
            ?>
		</div>
	</div>

    <?php include 'includes/footer.php' ?>
    <!--/#footer--> 
</body>
</html>
