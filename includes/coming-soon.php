
<section id="coming-soon">        
     <div class="container">
        <div class="row">
            <div class="col-sm-8 col-sm-offset-2">                    
                <div class="text-center coming-content">
                    <a href="index.php"><img src="images\1jpg.jpg" alt="Enyo Fitness"></a>
                    <h1>UNDER CONSTRUCTION</h1>
                    <p>We're working around the clock in order to launch our new website. 
                        <br />We will offer great products and amazing deals to help you reach your fitness goals. <br />Join our mailing list or follow / subscribe to us on:<br /> Facebook, Instagram, or Youtube  to stay up to date.</p>                           
                    <div class="social-link">
                        <span><a href="https://www.facebook.com/Enyo-Fitness-666651990186431/" target="_blank"><i class="fa fa-facebook"></i></a></span>
                        <span><a href="https://www.instagram.com/enyofitness/" target="_blank"><i class="fa fa-instagram"></i></a></span>
                        <span><a href="https://www.youtube.com/channel/UCJty1641b2GyAKDgPeEh3PA" target="_blank"><i class="fa fa-youtube"></i></a></span>
                    </div>
                </div>                    
            </div>
            <div class="col-sm-12">
                <div class="time-count">
                    <ul id="countdown">
                        <li class="angle-one">
                            <span id = "days-countdown" class="days time-font"></span>
                            <p>Days</p>
                        </li>
                        <li class="angle-two">
                            <span id = "hours-countdown" class="hours time-font"></span>
                            <p>Hours</p>
                        </li>
                        <li class="angle-three">
                            <span id = "minutes-countdown" class="minutes time-font"></span>
                            <p class="minute">Mins</p>
                        </li>                            
                        <li class="angle-four">
                            <span id = "seconds-countdown" class="seconds time-font"></span>
                            <p>Secs</p>
                        </li>               
                    </ul>   
                </div>
            </div>
        </div>
    </div>       
</section>

<script>
    // Set the date we're counting down to
    var countDownDate = new Date("August 1, 2017 14:00:00").getTime();

    // Update the count down every 1 second
    var x = setInterval(function() {

    // Get todays date and time
    var now = new Date().getTime();

    // Find the distance between now an the count down date
    var distance = countDownDate - now;

    // Time calculations for days, hours, minutes and seconds
    var days = Math.floor(distance / (1000 * 60 * 60 * 24));
    var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
    var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
    var seconds = Math.floor((distance % (1000 * 60)) / 1000);

    // Display the result
    document.getElementById("days-countdown").innerHTML = days;
    document.getElementById("hours-countdown").innerHTML = hours; 
    document.getElementById("minutes-countdown").innerHTML = minutes; 
    document.getElementById("seconds-countdown").innerHTML = seconds; 

    // If the count down is finished, write some text 
    if (distance < 0) {
    clearInterval(x);
    document.getElementById("days-countdown").innerHTML = "EXPIRED";
    }
    }, 1000);
</script>

