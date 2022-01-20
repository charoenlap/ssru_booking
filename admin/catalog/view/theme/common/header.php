<!doctype html>
<html lang="en">

    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <title>SSRU</title>
        <!-- Favicon -->
        <!-- <link rel="shortcut icon" href="assets/images/favicon.ico" /> -->
        <link rel="shortcut icon" href="assets/images/logo.png" />

        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="assets/css/bootstrap.min.css">
        <!-- Typography CSS -->
        <link rel="stylesheet" href="assets/css/typography.css">
        <!-- Style CSS -->
        <link rel="stylesheet" href="assets/css/style.css">
        <!-- Responsive CSS -->
        <link rel="stylesheet" href="assets/css/responsive.css">
        <!-- datatable -->
        <link rel="stylesheet" type="text/css" href="assets/datatables/datatables.bootstrap4.min.css">


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
        <!-- lottie JavaScript -->
        <script src="assets/js/lottie.js"></script>
        <!-- core JavaScript -->
        <script src="assets/js/core.js"></script>
        <!-- charts JavaScript -->
        <script src="assets/js/charts.js"></script>
        <!-- animated JavaScript -->
        <script src="assets/js/animated.js"></script>
        <!-- Chart Custom JavaScript -->
        <script src="assets/js/chart-custom.js"></script>
        <!-- Custom JavaScript -->
        <script src="assets/js/custom.js"></script>

        <!-- Datatables -->
        <script src="assets/datatables/datatables.min.js"></script>
        <script src="assets/datatables/dataTables.bootstrap4.min.js"></script>
        <?php if(isset($style)){ 
            foreach ($style as $key => $value) { ?>
        <link rel="stylesheet" href="<?php echo $value;?>">
        <?php } } ?>
        <?php 
        if(isset($script)){
        foreach ($script as $key => $value) { ?>
        <script src="<?php echo $value;?>"></script>
        <?php } } ?>
    </head>

    <body>
        <!-- loader Start -->
        <!-- <div id="loading">
         
      </div> -->
        <!-- loader END -->
        <!-- Wrapper Start -->
        <div class="wrapper">
            <!-- Sidebar  -->
            <div class="iq-sidebar">
                <div class="iq-sidebar-logo d-flex justify-content-between">
                    <a href="<?php echo route('dashboard/dashboard'); ?>">
                        <img src="assets/images/logo.png" class="img-fluid" alt="">
                        <span><?php echo "SSRU"; ?></span>
                    </a>
                    <div class="iq-menu-bt align-self-center">
                        <div class="wrapper-menu">
                            <div class="line-menu half start"></div>
                            <div class="line-menu"></div>
                            <div class="line-menu half end"></div>
                        </div>
                    </div>
                </div>
                <div id="sidebar-scrollbar">
                    <nav class="iq-sidebar-menu">
                        <ul class="iq-menu">
                            <li class="iq-menu-title"><i class="ri-separator"></i><span></span></li>
                            <li id="dashboard"><a href="<?php echo route('dashboard/dashboard'); ?>" class="iq-waves-effect"><i class="las la-home"></i><span>หน้าหลัก</span></a></li>

                            <!-- <li id="student"><a href="<?php echo route('student/home'); ?>" class="iq-waves-effect"><i class="las la-user-graduate"></i><span>ข้อมูลนักศึกษา</span></a></li> -->
                            <li id="student">
                                <a href="javascript:void(0);" class="iq-waves-effect"><i class="las la-user-graduate"></i><span>นักศึกษา</span><i class="ri-arrow-right-s-line iq-arrow-right"></i></a>
                                <ul class="iq-submenu">
                                    <li id="st1"><a href="<?php echo route('student/home'); ?>">ข้อมูลนักศึกษา</a></li>
                                    <li id="st2"><a href="<?php echo route('student/upload'); ?>">อัพโหลดรายชื่อนักศึกษา</a></li>
                                    <!-- <li id="a3"><a href="<?php echo route('activity/takeEventCancel'); ?>">นักศึกษาที่ยกเลิกกิจกรรม</a></li> -->
                                    <!-- <li id="a4"><a href="<?php echo route('activity'); ?>">กิจกรรมรายบุคคล</a></li> -->
                                </ul>
                            </li>
                            <!-- <li id="activity"><a href="<?php echo route('activity/home'); ?>" class="iq-waves-effect"><i class="las la-calendar-check"></i><span>กิจกรรม</span></a></li> -->
                            <li id="activity">
                                <a href="javascript:void(0);" class="iq-waves-effect"><i class="las la-calendar-check"></i><span>กิจกรรม</span><i class="ri-arrow-right-s-line iq-arrow-right"></i></a>
                                <ul class="iq-submenu">
                                    <li id="a1"><a href="<?php echo route('activity/home'); ?>">กิจกรรม</a></li>
                                    <li id="a2"><a href="<?php echo route('activity/upload'); ?>">อัพโหลดเอกสารกิจกรรม</a></li>
                                    <li id="a3"><a href="<?php echo route('activity/takeEventCancel'); ?>">นักศึกษาที่ยกเลิกกิจกรรม</a></li>
                                    <!-- <li id="a4"><a href="<?php echo route('activity'); ?>">กิจกรรมรายบุคคล</a></li> -->
                                </ul>
                            </li>
                            <!-- <li id="report"><a href="<?php echo route('report/home'); ?>" class="iq-waves-effect"><i class="las la-icons"></i><span>รายงาน</span></a></li> -->
                            <li id="report">
                                <a href="javascript:void(0);" class="iq-waves-effect"><i class="las la-file"></i><span>รายงาน</span><i class="ri-arrow-right-s-line iq-arrow-right"></i></a>
                                <ul class="iq-submenu">
                                    <li id="r1"><a href="<?php echo route('report/activity'); ?>">การเข้าจองกิจกรรม</a></li>
                                    <li id="r2"><a href="<?php echo route('report/bookingActivity'); ?>">สรุปผลการเข้าร่วมกิจกรรม</a></li>
                                    <li id="r3"><a href="<?php echo route('report/statusActivity'); ?>">สรุปผลการเข้าร่วมกิจกรรมของนักศึกษา</a></li>
                                    <!-- <li id="r4"><a href="<?php echo route('report/checkActivity'); ?>">การเข้ากิจกรรมรายบุลคล</a></li> -->
                                </ul>
                            </li>
                            <li id="behavior"><a href="<?php echo route('behavior/home'); ?>" class="iq-waves-effect"><i class="las la-user-tag"></i><span>ข้อมูลพฤติกรรม</span></a></li>
                            <!-- <li class="active">
                     <a href="javascript:void(0);" class="iq-waves-effect"><i class="las la-home"></i><span>Dashboard</span><i class="ri-arrow-right-s-line iq-arrow-right"></i></a>
                     <ul class="iq-submenu">
                        <li><a href="index.html">Dashboard 1</a></li>
                        <li class="active"><a href="dashboard1.html">Dashboard 2</a></li>
                     </ul>
                  </li>
                  <li>
                     <a href="javascript:void(0);" class="iq-waves-effect"><i class="las la-envelope-open"></i><span>Email</span><i class="ri-arrow-right-s-line iq-arrow-right"></i></a>
                     <ul class="iq-submenu">
                        <li><a href="app/index.html">Inbox</a></li>
                        <li><a href="app/email-compose.html">Email Compose</a></li>
                     </ul>
                  </li>
                     <li><a href="todo.html" class="iq-waves-effect"><i class="las la-check-square"></i><span>Todo</span></a></li>
                  <li>
                     <a href="javascript:void(0);" class="iq-waves-effect"><i class="las la-user-tie"></i><span>User</span><i class="ri-arrow-right-s-line iq-arrow-right"></i></a>
                     <ul class="iq-submenu">
                        <li><a href="profile.html">User Profile</a></li>
                        <li><a href="profile-edit.html">User Edit</a></li>
                        <li><a href="add-user.html">User Add</a></li>
                        <li><a href="user-list.html">User List</a></li>
                     </ul>
                  </li>
                  <li><a href="calendar.html" class="iq-waves-effect"><i class="las la-calendar"></i><span>Calendar</span></a></li>
                  <li><a href="chat.html" class="iq-waves-effect"><i class="las la-sms"></i><span>Chat</span></a></li>
                 
                  <li class="iq-menu-title"><i class="ri-separator"></i><span>Components</span></li>
                  <li>
                     <a href="javascript:void(0);" class="iq-waves-effect"><i class="lab la-elementor"></i><span>UI Elements</span><i class="ri-arrow-right-s-line iq-arrow-right"></i></a>
                     <ul class="iq-submenu">
                        <li><a href="ui-colors.html">colors</a></li>
                        <li><a href="ui-typography.html">Typography</a></li>
                        <li><a href="ui-alerts.html">Alerts</a></li>
                        <li><a href="ui-badges.html">Badges</a></li>
                        <li><a href="ui-breadcrumb.html">Breadcrumb</a></li>
                        <li><a href="ui-buttons.html">Buttons</a></li>
                        <li><a href="ui-cards.html">Cards</a></li>
                        <li><a href="ui-carousel.html">Carousel</a></li>
                        <li><a href="ui-embed-video.html">Video</a></li>
                        <li><a href="ui-grid.html">Grid</a></li>
                        <li><a href="ui-images.html">Images</a></li>
                        <li><a href="ui-list-group.html">list Group</a></li>
                        <li><a href="ui-media-object.html">Media</a></li>
                        <li><a href="ui-modal.html">Modal</a></li>
                        <li><a href="ui-notifications.html">Notifications</a></li>
                        <li><a href="ui-pagination.html">Pagination</a></li>
                        <li><a href="ui-popovers.html">Popovers</a></li>
                        <li><a href="ui-progressbars.html">Progressbars</a></li>
                        <li><a href="ui-tabs.html">Tabs</a></li>
                        <li><a href="ui-tooltips.html">Tooltips</a></li>
                     </ul>
                  </li>
                  <li>
                     <a href="javascript:void(0);" class="iq-waves-effect"><i class="las la-file-alt"></i><span>Forms</span><i class="ri-arrow-right-s-line iq-arrow-right"></i></a>
                     <ul class="iq-submenu">
                        <li><a href="form-layout.html">Form Elements</a></li>
                        <li><a href="form-validation.html">Form Validation</a></li>
                        <li><a href="form-switch.html">Form Switch</a></li>
                        <li><a href="form-chechbox.html">Form Checkbox</a></li>
                        <li><a href="form-radio.html">Form Radio</a></li>
                     </ul>
                  </li>
                  <li>
                        <a href="javascript:void(0);" class="iq-waves-effect"><i class="las la-database"></i><span>Forms Wizard</span><i class="ri-arrow-right-s-line iq-arrow-right"></i></a>
                        <ul class="iq-submenu">
                           <li><a href="form-wizard.html">Simple Wizard</a></li>
                           <li><a href="form-wizard-validate.html">Validate Wizard</a></li>
                           <li><a href="form-wizard-vertical.html">Vertical Wizard</a></li>
                        </ul>
                     </li>
                  <li>
                     <a href="javascript:void(0);" class="iq-waves-effect"><i class="las la-table"></i><span>Table</span><i class="ri-arrow-right-s-line iq-arrow-right"></i></a>
                     <ul class="iq-submenu">
                        <li><a href="tables-basic.html">Basic Tables</a></li>
                        <li><a href="data-table.html">Data Table</a></li>
                        <li><a href="table-editable.html">Editable Table</a></li>
                     </ul>
                  </li>
                  <li>
                     <a href="javascript:void(0);" class="iq-waves-effect"><i class="las la-chart-bar"></i><span>Charts</span><i class="ri-arrow-right-s-line iq-arrow-right"></i></a>
                     <ul class="iq-submenu">
                        <li><a href="chart-morris.html">Morris Chart</a></li>
                        <li><a href="chart-high.html">High Charts</a></li>
                        <li><a href="chart-am.html">Am Charts</a></li>
                        <li><a href="chart-apex.html">Apex Chart</a></li>
                     </ul>
                  </li>
                  <li>
                     <a href="javascript:void(0);" class="iq-waves-effect"><i class="las la-icons"></i><span>Icons</span><i class="ri-arrow-right-s-line iq-arrow-right"></i></a>
                     <ul class="iq-submenu">
                        <li><a href="icon-dripicons.html">Dripicons</a></li>
                        <li><a href="icon-fontawesome-5.html">Font Awesome 5</a></li>
                        <li><a href="icon-lineawesome.html">line Awesome</a></li>
                        <li><a href="icon-remixicon.html">Remixicon</a></li>
                        <li><a href="icon-unicons.html">unicons</a></li>
                     </ul>
                  </li>
                  <li class="iq-menu-title"><i class="ri-separator"></i><span>Pages</span></li>
                  <li>
                     <a href="javascript:void(0);" class="iq-waves-effect"><i class="las la-file-contract"></i><span>Authentication</span><i class="ri-arrow-right-s-line iq-arrow-right"></i></a>
                     <ul class="iq-submenu">
                        <li><a href="sign-in.html">Login</a></li>
                        <li><a href="sign-up.html">Register</a></li>
                        <li><a href="pages-recoverpw.html">Recover Password</a></li>
                        <li><a href="pages-confirm-mail.html">Confirm Mail</a></li>
                        <li><a href="pages-lock-screen.html">Lock Screen</a></li>
                     </ul>
                  </li>
                  <li>
                     <a href="javascript:void(0);" class="iq-waves-effect"><i class="las la-map-marker"></i><span>Maps</span><i class="ri-arrow-right-s-line iq-arrow-right"></i></a>
                     <ul class="iq-submenu">
                        <li><a href="pages-map.html">Google Map</a></li>
                        <li><a href="#">Vector Map</a></li>
                     </ul>
                  </li>
                  <li>
                     <a href="javascript:void(0);" class="iq-waves-effect"><i class="lab la-codepen"></i><span>Extra Pages</span><i class="ri-arrow-right-s-line iq-arrow-right"></i></a>
                     <ul class="iq-submenu">
                        <li><a href="pages-timeline.html">Timeline</a></li>
                        <li><a href="pages-invoice.html">Invoice</a></li>
                        <li><a href="blank-page.html">Blank Page</a></li>
                        <li><a href="pages-error.html">Error 404</a></li>
                        <li><a href="pages-error-500.html">Error 500</a></li>
                        <li><a href="pages-pricing.html">Pricing</a></li>
                        <li><a href="pages-pricing-one.html">Pricing 1</a></li>
                        <li><a href="pages-maintenance.html">Maintenance</a></li>
                        <li><a href="pages-comingsoon.html">Coming Soon</a></li>
                        <li><a href="pages-faq.html">Faq</a></li>
                     </ul>
                  </li> -->
                            <!-- <li id="banner"><a href="<?php echo route('banner/home'); ?>" class="iq-waves-effect"><i class="las la-image"></i><span>รูปภาพ</span></a></li> -->
                            <li id="setting">
                                <a href="javascript:void(0);" class="iq-waves-effect"><i class="las la-cog"></i><span>ตั้งค่า</span><i class="ri-arrow-right-s-line iq-arrow-right"></i></a>
                                <ul class="iq-submenu">
                                    <li id="s0"><a href="<?php echo route('setting/home'); ?>" class="iq-waves-effect">ทั่วไป</a></li>
                                    <li id="s1"><a href="<?php echo route('setting/event'); ?>">ประเภทกิจกรรม</a></li>
                                    <!-- <li id="s2"><a href="<?php echo route('setting/student'); ?>">ประเภทนักศึกษา</a></li> -->
                                    <!-- <li id="s3"><a href="<?php echo route('setting/year'); ?>">ชั้นปี</a></li> -->
                                    <li id="s4"><a href="<?php echo route('banner/home'); ?>" class="iq-waves-effect">เนื้อหา</a></li>
                                    <li id="s5"><a href="<?php echo route('setting/center'); ?>" class="iq-waves-effect">มหาวิทยาลัย</a></li>
                                    <li id="s6"><a href="<?php echo route('setting/group'); ?>" class="iq-waves-effect">คณะ</a></li>
                                    <li id="s7"><a href="<?php echo route('setting/branch'); ?>" class="iq-waves-effect">สาขา</a></li>
                                </ul>
                            </li>
                            <!-- <li id="setting"><a href="<?php echo route('setting/home'); ?>" class="iq-waves-effect"><i class="las la-cog"></i><span>ตั้งค่า</span></a></li> -->
                        </ul>
                    </nav>
                    <div class="p-3"></div>
                </div>
            </div>
            <!-- TOP Nav Bar -->
            <div class="iq-top-navbar">
                <div class="iq-navbar-custom">
                    <div class="iq-sidebar-logo">
                        <div class="top-logo">
                            <a href="index.html" class="logo">
                                <img src="assets/images/logo.gif" class="img-fluid" alt="">
                                <span></span>
                            </a>
                        </div>
                    </div>
                    <div class="navbar-breadcrumb">
                        <h5 class="mb-0"></h5>
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="#"></a></li>
                            </ol>
                        </nav>
                    </div>
                    <nav class="navbar navbar-expand-lg navbar-light p-0">
                        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                            <i class="ri-menu-3-line"></i>
                        </button>
                        <div class="iq-menu-bt align-self-center">
                            <div class="wrapper-menu">
                                <div class="line-menu half start"></div>
                                <div class="line-menu"></div>
                                <div class="line-menu half end"></div>
                            </div>
                        </div>
                        <div class="collapse navbar-collapse" id="navbarSupportedContent">
                            <ul class="navbar-nav ml-auto navbar-list">
                                <!-- <li class="nav-item">
                           <a class="search-toggle iq-waves-effect" href="#"><i class="ri-search-line"></i></a>
                           <form action="#" class="search-box">
                              <input type="text" class="text search-input" placeholder="Type here to search..." />
                           </form>
                        </li>
                        <li class="nav-item dropdown">
                           <a href="#" class="search-toggle iq-waves-effect">
                              <i class="ri-mail-line"></i>
                              <span class="badge badge-pill badge-dark badge-up count-mail">5</span>
                           </a>
                           <div class="iq-sub-dropdown">
                              <div class="iq-card shadow-none m-0">
                                 <div class="iq-card-body p-0 ">
                                    <div class="bg-primary p-3">
                                       <h5 class="mb-0 text-white">All Messages<small class="badge  badge-light float-right pt-1">5</small></h5>
                                    </div>
                                    <a href="#" class="iq-sub-card" >
                                       <div class="media align-items-center">
                                          <div class="">
                                             <img class="avatar-40 rounded" src="assets/images/user/01.jpg" alt="">
                                          </div>
                                          <div class="media-body ml-3">
                                             <h6 class="mb-0 ">Nik Emma Watson</h6>
                                             <small class="float-left font-size-12">13 Jun</small>
                                          </div>
                                       </div>
                                    </a>
                                    <a href="#" class="iq-sub-card" >
                                       <div class="media align-items-center">
                                          <div class="">
                                             <img class="avatar-40 rounded" src="assets/images/user/02.jpg" alt="">
                                          </div>
                                          <div class="media-body ml-3">
                                             <h6 class="mb-0 ">Lorem Ipsum Watson</h6>
                                             <small class="float-left font-size-12">20 Apr</small>
                                          </div>
                                       </div>
                                    </a>
                                    <a href="#" class="iq-sub-card" >
                                       <div class="media align-items-center">
                                          <div class="">
                                             <img class="avatar-40 rounded" src="assets/images/user/03.jpg" alt="">
                                          </div>
                                          <div class="media-body ml-3">
                                             <h6 class="mb-0 ">Why do we use it?</h6>
                                             <small class="float-left font-size-12">30 Jun</small>
                                          </div>
                                       </div>
                                    </a>
                                    <a href="#" class="iq-sub-card" >
                                       <div class="media align-items-center">
                                          <div class="">
                                             <img class="avatar-40 rounded" src="assets/images/user/04.jpg" alt="">
                                          </div>
                                          <div class="media-body ml-3">
                                             <h6 class="mb-0 ">Variations Passages</h6>
                                             <small class="float-left font-size-12">12 Sep</small>
                                          </div>
                                       </div>
                                    </a>
                                    <a href="#" class="iq-sub-card" >
                                       <div class="media align-items-center">
                                          <div class="">
                                             <img class="avatar-40 rounded" src="assets/images/user/05.jpg" alt="">
                                          </div>
                                          <div class="media-body ml-3">
                                             <h6 class="mb-0 ">Lorem Ipsum generators</h6>
                                             <small class="float-left font-size-12">5 Dec</small>
                                          </div>
                                       </div>
                                    </a>
                                 </div>
                              </div>
                           </div>
                        </li>
                        <li class="nav-item">
                           <a href="#" class="iq-waves-effect"><i class="ri-shopping-cart-2-line"></i></a>
                        </li>
                        <li class="nav-item">
                           <a href="#" class="search-toggle iq-waves-effect">
                              <i class="ri-notification-2-line"></i>
                              <span class="bg-danger dots"></span>
                           </a>
                           <div class="iq-sub-dropdown">
                              <div class="iq-card shadow-none m-0">
                                 <div class="iq-card-body p-0 ">
                                    <div class="bg-danger p-3">
                                       <h5 class="mb-0 text-white">All Notifications<small class="badge  badge-light float-right pt-1">4</small></h5>
                                    </div>
                                    <a href="#" class="iq-sub-card" >
                                       <div class="media align-items-center">
                                          <div class="media-body ml-3">
                                             <h6 class="mb-0 ">New Order Recieved</h6>
                                             <small class="float-right font-size-12">23 hrs ago</small>
                                             <p class="mb-0">Lorem is simply</p>
                                          </div>
                                       </div>
                                    </a>
                                    <a href="#" class="iq-sub-card" >
                                       <div class="media align-items-center">
                                          <div class="">
                                             <img class="avatar-40 rounded" src="assets/images/user/01.jpg" alt="">
                                          </div>
                                          <div class="media-body ml-3">
                                             <h6 class="mb-0 ">Emma Watson Nik</h6>
                                             <small class="float-right font-size-12">Just Now</small>
                                             <p class="mb-0">95 MB</p>
                                          </div>
                                       </div>
                                    </a>
                                    <a href="#" class="iq-sub-card" >
                                       <div class="media align-items-center">
                                          <div class="">
                                             <img class="avatar-40 rounded" src="assets/images/user/02.jpg" alt="">
                                          </div>
                                          <div class="media-body ml-3">
                                             <h6 class="mb-0 ">New customer is join</h6>
                                             <small class="float-right font-size-12">5 days ago</small>
                                             <p class="mb-0">Jond Nik</p>
                                          </div>
                                       </div>
                                    </a>
                                    <a href="#" class="iq-sub-card" >
                                       <div class="media align-items-center">
                                          <div class="">
                                             <img class="avatar-40" src="assets/images/small/jpg.svg" alt="">
                                          </div>
                                          <div class="media-body ml-3">
                                             <h6 class="mb-0 ">Updates Available</h6>
                                             <small class="float-right font-size-12">Just Now</small>
                                             <p class="mb-0">120 MB</p>
                                          </div>
                                       </div>
                                    </a>
                                 </div>
                              </div>
                           </div>
                        </li>
 -->
                                <li class="nav-item iq-full-screen"><a href="#" class="iq-waves-effect" id="btnFullscreen"><i class="ri-fullscreen-line"></i></a></li>
                            </ul>
                        </div>

                        <ul class="navbar-list">
                            <li>
                                <a href="#" class="search-toggle iq-waves-effect bg-primary text-white"><img src="assets/images/user/1.jpg" class="img-fluid rounded" alt="user"></a>
                                <div class="iq-sub-dropdown iq-user-dropdown">
                                    <div class="iq-card shadow-none m-0">
                                        <div class="iq-card-body p-0 ">
                                            <!-- <div class="bg-primary p-3">
                                    <h5 class="mb-0 text-white line-height">Hello Nik jone</h5>
                                    <span class="text-white font-size-12">Available</span>
                                 </div> -->
                                            <!-- <a href="profile.html" class="iq-sub-card iq-bg-primary-hover">
                                    <div class="media align-items-center">
                                       <div class="rounded iq-card-icon iq-bg-primary">
                                          <i class="ri-file-user-line"></i>
                                       </div>
                                       <div class="media-body ml-3">
                                          <h6 class="mb-0 ">My Profile</h6>
                                          <p class="mb-0 font-size-12">View personal profile details.</p>
                                       </div>
                                    </div>
                                 </a> -->

                                            <div class="d-inline-block w-100 text-center p-3">
                                                <a class="iq-bg-danger iq-sign-btn" href="<?php //echo route('signin'); ?>" role="button">ออกจากระบบ<i class="ri-login-box-line ml-2"></i></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </nav>
                </div>
            </div>
            <!-- TOP Nav Bar END -->