<!doctype html>
<html lang="en">
   <head>
      <!-- Required meta tags -->
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
      <title>SSRU - ADMIN</title>
      <script src="https://www.google.com/recaptcha/api.js" async defer></script>
      <!-- Favicon -->
      <link rel="shortcut icon" href="images/favicon.ico" />
      <!-- Bootstrap CSS -->
      <link rel="stylesheet" href="assets/css/bootstrap.min.css">
      <!-- Typography CSS -->
      <link rel="stylesheet" href="assets/css/typography.css">
      <!-- Style CSS -->
      <link rel="stylesheet" href="assets/css/style.css">
      <!-- Responsive CSS -->
      <link rel="stylesheet" href="assets/css/responsive.css">



   <script src="https://www.google.com/recaptcha/api.js"></script>
    <script>
     function onSubmit(token) {
       document.getElementById("loginform").submit();
     }
   </script>
   </head>
   <body>
      <!-- loader Start -->
      <div id="loading">
         
      </div>
      <!-- loader END -->
        <!-- Sign in Start -->
          <section class="sign-in-page">
            <div class="container p-0">
                <div class="row no-gutters">
                    <div class="col-sm-12 align-self-center">
                        <div class="sign-in-from bg-white">
                            <h1 class="mb-0">Sign in</h1>
                            <p>Enter your username and password to access admin panel.</p>
                            <form class="mt-4" method="POST" action="<?php echo $action; ?>" id="loginform">
                                <div class="form-group">
                                    <label for="">Username</label>
                                    <input type="text" class="form-control mb-0" id="" placeholder="Enter email" name="username">
                                </div>
                                <div class="form-group">
                                    <label for="">Password</label>
                                    <!-- <a href="#" class="float-right">Forgot password?</a> -->
                                    <input type="password" class="form-control mb-0" id="" placeholder="Password" name="password">
                                </div>
                                <div class="col-md-12">
                                  <!-- <div class="g-recaptcha" data-sitekey="6LctAt4ZAAAAADyuIPgodsoxn8WP-Mhc91khBxoN"></div> -->

                                  <!-- <div class="g-recaptcha" id="g-recaptcha" data-sitekey="6Lf6raYZAAAAANbx3W_S-0frleppYd_9p6U4CcJ2"></div> -->
                                </div>
                                <div class="d-inline-block w-100">
                                    <div class="custom-control custom-checkbox d-inline-block mt-2 pt-1">
                                        <input type="checkbox" class="custom-control-input" id="customCheck1">
                                        <!-- <label class="custom-control-label" for="customCheck1">Remember Me</label> -->
                                    </div>
                                    <button type="submit" class="btn btn-primary float-right">Sign in</button>

                                   <!-- <button class="g-recaptcha btn btn-primary float-right" 
                            data-sitekey="6LcuA94ZAAAAAOqDBtrLkYr251tuKRzGmmNqKzm1" 
                            data-callback='onSubmit' 
                            data-action='submit'>SIGN IN</button>-->
                                </div>
                                <!-- <div class="sign-info">
                                    <span class="dark-color d-inline-block line-height-2">Don't have an account? <a href="#">Sign up</a></span>
                                    <ul class="iq-social-media">
                                        <li><a href="#"><i class="ri-facebook-box-line"></i></a></li>
                                        <li><a href="#"><i class="ri-twitter-line"></i></a></li>
                                        <li><a href="#"><i class="ri-instagram-line"></i></a></li>
                                    </ul>
                                </div> -->
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- Sign in END -->
      <!-- Optional JavaScript -->
      <!-- jQuery first, then Popper.js, then Bootstrap JS -->
      
      <script src="assets/js/jquery.min.js"></script>
      <script src="assets/js/popper.min.js"></script>
      <script src="assets/js/bootstrap.min.js"></script>
      <!-- Appear JavaScript -->
      <script src="assets/js/jquery.appear.js"></script>
      <!-- Countdown JavaScript -->
      <script src="assets/js/countdown.min.js"></script>
      <!-- Counterup JavaScript -->
      <script src="assets/js/waypoints.min.js"></script>
      <script src="assets/js/jquery.counterup.min.js"></script>
      <!-- Wow JavaScript -->
      <script src="assets/js/wow.min.js"></script>
      <!-- Apexcharts JavaScript -->
      <script src="assets/js/apexcharts.js"></script>
      <!-- Select2 JavaScript -->
      <script src="assets/js/select2.min.js"></script>
      <!-- Owl Carousel JavaScript -->
      <script src="assets/js/owl.carousel.min.js"></script>
      <!-- Magnific Popup JavaScript -->
      <script src="assets/js/jquery.magnific-popup.min.js"></script>
      <!-- Smooth Scrollbar JavaScript -->
      <script src="assets/js/smooth-scrollbar.js"></script>
      <!-- Chart Custom JavaScript -->
      <script src="assets/js/chart-custom.js"></script>
      <!-- Custom JavaScript -->
      <script src="assets/js/custom.js"></script>
   </body>
</html>
