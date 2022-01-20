<!DOCTYPE html>
<html class="no-js css-menubar" lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>SSRU</title>
  <!-- <script src="https://www.google.com/recaptcha/api.js" async defer></script> -->
  <!-- Stylesheets -->
  <?php if(isset($style)){ 
    foreach ($style as $key => $value) { ?>
    <link rel="stylesheet" href="<?php echo $value;?>">
  <?php } } ?>
  <link rel="stylesheet" href="assets/boostrap_jquery/css/bootstrap.min.css">
  <link rel="stylesheet" href="assets/css/main.css">
  <script src="assets/boostrap_jquery/js/jquery.js"></script>
  <script src="assets/boostrap_jquery/js/bootstrap.min.js"></script>
  <script src="assets/fontawesome/js/all.js"></script>
  <style>
    .text-head {
      color: #f06eaa;
      font-weight: bold;
    }
  </style>

   <!--<script src="https://www.google.com/recaptcha/api.js"></script>
    <script>
     function onSubmit(token) {
       document.getElementById("loginform").submit();
     }
   </script>-->
  
</head>
<body>
<div class="container">
  <div class="row justify-content-center mt-5">
    <div class="col-md-10 text-center">
      <img src="assets/images/logo.png" alt="" width="120" class="mb-3">
      <p class="text-head">ระบบบริหารจัดการกิจกรรมนักศึกษามหาวิทยาลัยราชภัฏสวนสุนันทา</p>
    </div>
  </div>
	<div class="row justify-content-center">
		<div class="col-md-6 col-lg-4 col-sm-12">
			<div class="card rounded-0">
				<div class="card-body">
          <div class="row">
            <div class="col-md-12 text-center">
              <h5 class="font-weight-bold text-dark">เข้าสู่ระบบ</h5>
              <hr>
            </div>
          </div>
          <?php if(!empty($result)){?>
            <?php if($result == 'fail_captcha'){?>
            <p class="alert alert-danger">Captcha Fail</p>
            <?php }else{?>
            <p class="alert alert-danger">โปรตรวจสอบการเข้าสู่ระบบอีกครั้งหนึ่ง</p>
            <?php } ?>
          <?php } ?>
					<form action="<?php echo $action;?>" method="POST" id="loginform">
            <div class="row">
              <div class="col-md-12 mb-3">
                <label for="">รหัสนักศึกษา</label>
                <input type="text" name="stu_code" class="form-control rounded-0">
              </div>
              <div class="col-md-12 mb-3">
                <label for="">รหัส</label>
                <input type="password" name="stu_password" class="form-control rounded-0">
              </div>
              <div class="col-md-12">

              </div>
              <div class="col-md-12 mt-2">
                <input type="submit" class="btn btn-primary rounded-0 w-100" value="SIGN IN">
                <!-- <button class="g-recaptcha btn btn-primary rounded-0 w-100" 
        data-sitekey="6LcuA94ZAAAAAOqDBtrLkYr251tuKRzGmmNqKzm1" 
        data-callback='onSubmit' 
        data-action='submit'>SIGN IN</button> -->
              </div>
            </div>     
          </form>
				</div>
			</div>
		</div>
	</div>
</div>
</body>
</html>
