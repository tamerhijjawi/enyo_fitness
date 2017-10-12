<header id="header">
    <nav id = "top-header">
        <div class = "container">
            <div class = "row">
                <div class="col-sm-6 overflow"> 
                    <?php 
                        $user_count = user_count();
                        $suffix = ($user_count != 1) ? 's' : '';
                     ?> 
                    <p>We Currently Have <?php echo $user_count; ?> Registered User<?php echo $suffix; ?></p>
                </div>
                <div class="col-sm-6 overflow">
                   <div class="social-icons pull-right">
                        <ul class="nav nav-pills">
                            <li><a href="https://www.facebook.com/Enyo-Fitness-666651990186431/" target="_blank"><i class="fa fa-facebook"></i></a></li>
                            <li><a href="https://www.instagram.com/enyofitness/" target="_blank"><i class="fa fa-instagram"></i></a></li>
                            <li><a href="https://www.youtube.com/channel/UCJty1641b2GyAKDgPeEh3PA" target="_blank"><i class="fa fa-youtube"></i></a></li>
                        </ul>
                    </div> 
                </div>
            </div>  
        </div>
    </nav>
        
    <div class = "example3">
        <nav class="navbar navbar-default navbar-static-top" role="banner">
            <div class="container">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="index.php"><img src="images\3png.png" alt="Enyo Fitness"></a>
                    <!--<a class="navbar-brand" href="index.php"Enyo Fitness</a>-->
                    
                </div>
                <div class="collapse navbar-collapse">
                    <ul class="nav navbar-nav navbar-right">
                        <li class="<?php if($currentPage =='Home'){echo 'active';}?>"><a href="index.php">Home</a></li>
                        <li class="<?php if($currentPage =='Products'){echo 'active';}?>"><a href="products.php">Products</a></li>
                        <li class="<?php if($currentPage =='About'){echo 'active';}?>"><a href="about.php">About Us</a></li>
                        <li class="<?php if($currentPage =='Contact'){echo 'active';}?>"><a href="contact.php">Contact</a></li>
                        <li class="<?php if($currentPage =='Register'){echo 'active';}?>"><a href="register.php">Register</a></li>               
                        
                        <?php
                        if(logged_in() === true){
                        ?>
                            <li class="dropdown"><a href=# class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Hi <?php echo $user_data['first_name']; ?>!<span class="caret"></span></a>
                                <ul class="dropdown-menu" role="menu">
                                    <li><a href="changepassword.php">Change Password</a></li>
                                    <li><a href="settings.php">Settings</a></li>
                                    <li><a href="log-out.php">Log Out</a></li>
                                </ul>
                            </li>
                        <?php
                        }else{
                        ?>
                            <li class="<?php if($currentPage =='Log-in'){echo 'active';}?>"><a href="log-in.php">Log In</a></li>
                        <?php
                        }
                        ?>
                                                                    
                    </ul>
                </div>
            </div>
        </nav> 
    </div>
      
</header>