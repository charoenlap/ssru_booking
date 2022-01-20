<!DOCTYPE html>
<html class="no-js css-menubar" lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>SSRU</title>

  <link rel="apple-touch-icon" href="assets/assets/images/apple-touch-icon.png">
  <link rel="shortcut icon" href="assets/assets/images/favicon.ico">

  <!-- Stylesheets -->
  <?php if(isset($style)){ 
      foreach ($style as $key => $value) { ?>
    <link rel="stylesheet" href="<?php echo $value;?>">
  <?php } } ?>
  <link rel="stylesheet" href="assets/boostrap_jquery/css/bootstrap.min.css">
  <!-- <link rel="stylesheet" href="assets/global/css/bootstrap-extend.min.css"> -->
  <!-- <link rel="stylesheet" href="assets/css/site.min.css"> -->

  <link rel="stylesheet" href="assets/css/main.css">

  
  <!--[if lt IE 9]>
    <script src="assets/global/vendor/html5shiv/html5shiv.min.js"></script>
    <![endif]-->

  <!--[if lt IE 10]>
    <script src="assets/global/vendor/media-match/media.match.min.js"></script>
    <script src="assets/global/vendor/respond/respond.min.js"></script>
    <![endif]-->


  <script src="assets/boostrap_jquery/js/jquery.js"></script>
  <script src="assets/boostrap_jquery/js/popper.js"></script>
  <script src="assets/boostrap_jquery/js/bootstrap.min.js"></script>
  <script src="assets/fontawesome/js/all.js"></script>
  <?php 
  if(isset($script)){
  foreach ($script as $key => $value) { ?>
    <script src="<?php echo $value;?>"></script>
  <?php } } ?>
</head>
<body class="<?php echo (isset($class_body)?$class_body:''); ?>">
  <!--[if lt IE 8]>
        <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
    <![endif]-->
<nav class="navbar navbar-expand-lg navbar-light bg-white border-dark mb-4">
  <a class="navbar-brand" href="<?php echo route('index/home'); ?>"><img src="assets/images/logo.png" alt="" width="50" class="mr-3"> ระบบบริหารจัดการกิจกรรมนักศึกษามหาวิทยาลัยราชภัฏสวนสุนันทา</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
  <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav ml-auto">
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <i class="fa fa-user"></i> รหัสนักศึกษา <?php echo $stu_code; ?> <?php echo $stu_prefix; ?> <?php echo $stu_name; ?> <?php echo $stu_lname; ?> <?php echo $stu_detail['level_name']; ?>
        </a>
        <div class="dropdown-menu rounded-0" aria-labelledby="navbarDropdown">
          <a class="dropdown-item" href="<?php echo route('member/edit'); ?>">แก้ไขข้อมูลส่วนตัว</a>
          <div class="dropdown-divider"></div>
          <a class="dropdown-item" href="<?php echo route('home/logout'); ?>">ออกจากระบบ</a>
        </div>
      </li>
    </ul>
  </div>
</nav>

<div class="container">
  <div class="row my-3">
    <div class="col-md-4">
      <a href="<?php echo route('activity/home'); ?>" class="menu-card" id="activity">
        <!-- <img src="" alt="" class="w-100"> -->
        <div style="background: url('uploads/setting/<?php echo $banner_1; ?>');background-size:cover;background-position: center;height:140px;"></div>
        <p>ตรวจสอบกิจกรรมที่ได้เข้าร่วม</p>
      </a>
    </div>
    <div class="col-md-4">
      <a href="<?php echo route('check/home'); ?>" class="menu-card" id="check">
        <div style="background: url('uploads/setting/<?php echo $banner_2; ?>');background-size:cover;background-position: center;height:140px;"></div>
        <p>ตรวจสอบคะแนนพฤติกรรม</p>
      </a>
    </div>
    <div class="col-md-4">
      <a href="<?php echo route('booking/home'); ?>" class="menu-card" id="booking">
        <div style="background: url('uploads/setting/<?php echo $banner_3; ?>');background-size:cover;background-position: center;height:140px;"></div>
        <p>เข้าจองกิจกรรม</p>
      </a>
    </div>
  </div>
</div>
