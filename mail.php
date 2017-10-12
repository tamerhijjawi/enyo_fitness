<!DOCTYPE html>
<html lang="en">

<?php 
$currentPage = 'Mail';
require 'core/init.php';
protect_page();
master_protect();
include 'includes/head.php'; 
?>

<body>

    <?php include 'includes/header.php'; ?>

    <div class = container>
	    <div class="col-md-6 col-sm-6 col-md-offset-3">
		    <div class="contact-form">
		    
			    <?php
				if(isset($_GET['success']) === true && empty($_GET['success']) === true){
					echo '<h2 class="text-center">Email has been sent.</h2>';
				}else{
					if(empty($_POST) === false){
						if(empty($_POST['subject']) === true){
							$errors[] = 'Subject is required';
						}
						if(empty($_POST['body']) === true){
							$errors[] = 'Body is required';
						}
						if(empty($errors) === false){
							echo output_errors($errors);
						}else{
							mail_users($_POST['subject'],$_POST['body']);
							header('Location: mail.php?success');
							exit();
						}
					}
				?>
		        <h2 class="text-center">Email Users</h2>
		        <form id="main-contact-form" name="contact-form" method="post">
		            <div class="form-group">
		                <input type="text" name="subject" class="form-control" required="required" placeholder="Subject">
		            </div>
		            <div class="form-group">
		                <textarea name="body" required="required" class="form-control" rows="8" placeholder="Your text here"></textarea>
		            </div>                        
		            <div class="form-group">
		                <input type="submit" name="submit" class="btn btn-submit" value="Submit">
		            </div>
		        </form>
		       	<?php
				}
				?>
		    </div>
		</div>
	</div>


<!-- Footer -->
    <?php include 'includes/footer.php' ?>

</body>

</html>