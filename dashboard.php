<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin Dashboard</title>
    <!-- ================= Favicon ================== -->
    <!-- Standard -->
    <link rel="shortcut icon" href="http://placehold.it/64.png/000/fff">
    <!-- Retina iPad Touch Icon-->
    <link rel="apple-touch-icon" sizes="144x144" href="http://placehold.it/144.png/000/fff">
    <!-- Retina iPhone Touch Icon-->
    <link rel="apple-touch-icon" sizes="114x114" href="http://placehold.it/114.png/000/fff">
    <!-- Standard iPad Touch Icon-->
    <link rel="apple-touch-icon" sizes="72x72" href="http://placehold.it/72.png/000/fff">
    <!-- Standard iPhone Touch Icon-->
    <link rel="apple-touch-icon" sizes="57x57" href="http://placehold.it/57.png/000/fff">
    <!-- Styles -->
    <link href="assets/css/lib/calendar2/pignose.calendar.min.css" rel="stylesheet">
    <link href="assets/css/lib/chartist/chartist.min.css" rel="stylesheet">
    <link href="assets/css/lib/font-awesome.min.css" rel="stylesheet">
    <link href="assets/css/lib/themify-icons.css" rel="stylesheet">
    <link href="assets/css/lib/owl.carousel.min.css" rel="stylesheet" />
    <link href="assets/css/lib/owl.theme.default.min.css" rel="stylesheet" />
    <link href="assets/css/lib/weather-icons.css" rel="stylesheet" />
    <link href="assets/css/lib/menubar/sidebar.css" rel="stylesheet">
    <link href="assets/css/lib/bootstrap.min.css" rel="stylesheet">
    <link href="assets/css/lib/helper.css" rel="stylesheet">
    <link href="assets/css/style.css" rel="stylesheet">
</head>

<body>
	<?php include('parts/head-tag.php'); ?>
    <?php include('sidebar.php');?>
    <?php include('header.php');?>
    <!-- /# sidebar -->

    

    <div class="content-wrap">
        <div class="main">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-8">
                        <div class="page-header">
                            <div class="page-title">
                                <h1>Hello, Welcome Here </h1>
                            </div>
                        </div>
                    </div>
                    <!-- /# column -->
                    <div class="col-lg-4">
                        <div class="page-header">
                            <div class="page-title">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                                    <li class="breadcrumb-item active">Home</li>
                                </ol>
                            </div>
                        </div>
                    </div>
                    <!-- /# column -->
                </div>
                <!-- /# row -->
                <section id="main-content">
                    <div class="row">
                        <div class="col-lg-3">
                            <a href="new-product-vertical.php">
                            <div class="card">
                                <div class="stat-widget-one">
                                    <div class="stat-icon dib"><i class="ti-money color-success border-success"></i>
                                    </div>
                                    <div class="stat-content dib">
                                        <div class="stat-text font-weight-bold">Total Vertical</div>
                                        <div class="stat-digit" id="vertical_total">0</div>
                                    </div>
                                </div>
                            </div>
                            </a>
                        </div>
                        <div class="col-lg-3">
                            <a href="new-product-category.php">
                            <div class="card">
                                <div class="stat-widget-one">
                                    <div class="stat-icon dib"><i class="ti-user color-primary border-primary"></i>
                                    </div>
                                    <div class="stat-content dib">
                                        <div class="stat-text font-weight-bold">Total Category</div>
                                        <div class="stat-digit" id="category_total">0</div>
                                    </div>
                                </div>
                            </div>
                            </a>
                        </div>
                        <div class="col-lg-3">
                            <a href="new-form-list.php">
                            <div class="card">
                                <div class="stat-widget-one">
                                    <div class="stat-icon dib"><i class="ti-layout-grid2 color-pink border-pink"></i>
                                    </div>
                                    <div class="stat-content dib">
                                        <div class="stat-text font-weight-bold">Total Form</div>
                                        <div class="stat-digit" id="form_total">0</div>
                                    </div>
                                </div>
                            </div>
                            </a>
                        </div>
                        <div class="col-lg-3">
                            <a href="product-sub-category-list.php">
                            <div class="card">
                                <div class="stat-widget-one">
                                    <div class="stat-icon dib"><i class="ti-link color-danger border-danger"></i></div>
                                    <div class="stat-content dib">
                                        <div class="stat-text font-weight-bold">Sub Category</div>
                                        <div class="stat-digit" id="sub_category_total">0</div>
                                    </div>
                                </div>
                            </div>
                            </a>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-3">
                            <a href="product-mini-category-list.php?form_type=1">
                            <div class="card">
                                <div class="stat-widget-one">
                                    <div class="stat-icon dib"><i class="ti-money color-success border-success"></i>
                                    </div>
                                    <div class="stat-content dib">
                                        <div class="stat-text font-weight-bold">Mini Category</div>
                                        <div class="stat-digit" id="mini_category_total">0</div>
                                    </div>
                                </div>
                            </div>
                            </a>
                        </div>
                        <div class="col-lg-3">
                            <a href="product-lead-category-list.php?form_type=2">
                            <div class="card">
                                <div class="stat-widget-one">
                                    <div class="stat-icon dib"><i class="ti-user color-primary border-primary"></i>
                                    </div>
                                    <div class="stat-content dib">
                                        <div class="stat-text font-weight-bold">Lead Category</div>
                                        <div class="stat-digit" id="lead_category_total">0</div>
                                    </div>
                                </div>
                            </div>
                            </a>
                        </div>
                        <div class="col-lg-3">
                            <div class="card">
                                <div class="stat-widget-one">
                                    <div class="stat-icon dib"><i class="ti-layout-grid2 color-pink border-pink"></i>
                                    </div>
                                    <div class="stat-content dib">
                                        <div class="stat-tex font-weight-bold">Staff Users</div>
                                        <div class="stat-digit" id="staff_users"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="card">
                                <div class="stat-widget-one">
                                    <div class="stat-icon dib"><i class="ti-link color-danger border-danger"></i></div>
                                    <div class="stat-content dib">
                                        <div class="stat-text font-weight-bold">Invoices</div>
                                        <div class="stat-digit">121</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="card-title">
                                    <h4>Fee Collections and Expenses</h4>
                                </div>
                                <div class="card-body">
                                    <div class="ct-bar-chart m-t-30"></div>
                                </div>
                            </div>
                        </div>

                        <!--<div class="col-lg-4">
                            <div class="card">

                                <div class="card-body">
                                    <div class="ct-pie-chart"></div>
                                </div>
                            </div>
                        </div>-->
                    </div>
                    <div class="row">
                       <!-- <div class="col-lg-4">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="card bg-primary">
                                        <div class="weather-widget">
                                            <div id="weather-one" class="weather-one p-22"></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="card">
                                        <div class="testimonial-widget-one p-17">
                                            <div class="testimonial-widget-one owl-carousel owl-theme">
                                                <div class="item">
                                                    <div class="testimonial-content">
                                                        <div class="testimonial-text">
                                                            <i class="fa fa-quote-left"></i> Lorem ipsum dolor sit amet,
                                                            consectetur adipisicing elit, sed do eiusmod tempor
                                                            incididunt ut labore et dolore magna aliqua. Ut enim ad
                                                            minim veniam, quis
                                                            nostrud exercitation <i class="fa fa-quote-right"></i>
                                                        </div>
                                                        <img class="testimonial-author-img"
                                                            src="assets/images/avatar/1.jpg" alt="" />
                                                        <div class="testimonial-author">TYRION LANNISTER</div>
                                                        <div class="testimonial-author-position">Founder-Ceo. Dell Corp
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="item">
                                                    <div class="testimonial-content">
                                                        <div class="testimonial-text">
                                                            <i class="fa fa-quote-left"></i> Lorem ipsum dolor sit amet,
                                                            consectetur adipisicing elit, sed do eiusmod tempor
                                                            incididunt ut labore et dolore magna aliqua. Ut enim ad
                                                            minim veniam, quis
                                                            nostrud exercitation <i class="fa fa-quote-right"></i>
                                                        </div>
                                                        <img class="testimonial-author-img"
                                                            src="assets/images/avatar/1.jpg" alt="" />
                                                        <div class="testimonial-author">TYRION LANNISTER</div>
                                                        <div class="testimonial-author-position">Founder-Ceo. Dell Corp
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="item">
                                                    <div class="testimonial-content">
                                                        <div class="testimonial-text">
                                                            <i class="fa fa-quote-left"></i> Lorem ipsum dolor sit amet,
                                                            consectetur adipisicing elit, sed do eiusmod tempor
                                                            incididunt ut labore et dolore magna aliqua. Ut enim ad
                                                            minim veniam, quis
                                                            nostrud exercitation <i class="fa fa-quote-right"></i>
                                                        </div>
                                                        <img class="testimonial-author-img"
                                                            src="assets/images/avatar/1.jpg" alt="" />
                                                        <div class="testimonial-author">TYRION LANNISTER</div>
                                                        <div class="testimonial-author-position">Founder-Ceo. Dell Corp
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="item">
                                                    <div class="testimonial-content">
                                                        <div class="testimonial-text">
                                                            <i class="fa fa-quote-left"></i> Lorem ipsum dolor sit amet,
                                                            consectetur adipisicing elit, sed do eiusmod tempor
                                                            incididunt ut labore et dolore magna aliqua. Ut enim ad
                                                            minim veniam, quis
                                                            nostrud exercitation <i class="fa fa-quote-right"></i>
                                                        </div>
                                                        <img class="testimonial-author-img"
                                                            src="assets/images/avatar/1.jpg" alt="" />
                                                        <div class="testimonial-author">TYRION LANNISTER</div>
                                                        <div class="testimonial-author-position">Founder-Ceo. Dell Corp
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="item">
                                                    <div class="testimonial-content">
                                                        <div class="testimonial-text">
                                                            <i class="fa fa-quote-left"></i> Lorem ipsum dolor sit amet,
                                                            consectetur adipisicing elit, sed do eiusmod tempor
                                                            incididunt ut labore et dolore magna aliqua. Ut enim ad
                                                            minim veniam, quis
                                                            nostrud exercitation <i class="fa fa-quote-right"></i>
                                                        </div>
                                                        <img class="testimonial-author-img"
                                                            src="assets/images/avatar/1.jpg" alt="" />
                                                        <div class="testimonial-author">TYRION LANNISTER</div>
                                                        <div class="testimonial-author-position">Founder-Ceo. Dell Corp
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="item">
                                                    <div class="testimonial-content">
                                                        <div class="testimonial-text">
                                                            <i class="fa fa-quote-left"></i> Lorem ipsum dolor sit amet,
                                                            consectetur adipisicing elit, sed do eiusmod tempor
                                                            incididunt ut labore et dolore magna aliqua. Ut enim ad
                                                            minim veniam, quis
                                                            nostrud exercitation <i class="fa fa-quote-right"></i>
                                                        </div>
                                                        <img class="testimonial-author-img"
                                                            src="assets/images/avatar/1.jpg" alt="" />
                                                        <div class="testimonial-author">TYRION LANNISTER</div>
                                                        <div class="testimonial-author-position">Founder-Ceo. Dell Corp
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>-->
                        <!-- /# All Exam Result -->
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="card-title pr">
                                    <h4>All Exam Result</h4>

                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table student-data-table m-t-20">
                                            <thead>
                                                <tr>
                                                    <th><label><input type="checkbox" value=""></label>Exam Name</th>
                                                    <th>Subject</th>
                                                    <th>Grade Point</th>
                                                    <th>Percent Form</th>
                                                    <th>Percent Upto</th>
                                                    <th>Date</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>Class Test</td>
                                                    <td>Mathmatics</td>
                                                    <td>
                                                        4.00
                                                    </td>
                                                    <td>
                                                        95.00
                                                    </td>
                                                    <td>
                                                        100
                                                    </td>
                                                    <td>20/04/2017</td>
                                                </tr>
                                                <tr>
                                                    <td>Class Test</td>
                                                    <td>Mathmatics</td>
                                                    <td>
                                                        4.00
                                                    </td>
                                                    <td>
                                                        95.00
                                                    </td>
                                                    <td>
                                                        100
                                                    </td>
                                                    <td>20/04/2017</td>
                                                </tr>
                                                <tr>
                                                    <td>Class Test</td>
                                                    <td>English</td>
                                                    <td>
                                                        4.00
                                                    </td>
                                                    <td>
                                                        95.00
                                                    </td>
                                                    <td>
                                                        100
                                                    </td>
                                                    <td>20/04/2017</td>
                                                </tr>
                                                <tr>
                                                    <td>Class Test</td>
                                                    <td>Bangla</td>
                                                    <td>
                                                        4.00
                                                    </td>
                                                    <td>
                                                        95.00
                                                    </td>
                                                    <td>
                                                        100
                                                    </td>
                                                    <td>20/04/2017</td>
                                                </tr>
                                                <tr>
                                                    <td>Class Test</td>
                                                    <td>Mathmatics</td>
                                                    <td>
                                                        4.00
                                                    </td>
                                                    <td>
                                                        95.00
                                                    </td>
                                                    <td>
                                                        100
                                                    </td>
                                                    <td>20/04/2017</td>
                                                </tr>
                                                <tr>
                                                    <td>Class Test</td>
                                                    <td>English</td>
                                                    <td>
                                                        4.00
                                                    </td>
                                                    <td>
                                                        95.00
                                                    </td>
                                                    <td>
                                                        100
                                                    </td>
                                                    <td>20/04/2017</td>
                                                </tr>
                                                <tr>
                                                    <td>Class Test</td>
                                                    <td>Mathmatics</td>
                                                    <td>
                                                        4.00
                                                    </td>
                                                    <td>
                                                        95.00
                                                    </td>
                                                    <td>
                                                        100
                                                    </td>
                                                    <td>20/04/2017</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- /# All Exam Result -->
                    </div>
                    <!-- /# row -->

                    <div class="row">
                        <div class="col-lg-3">
                            <div class="card p-0">
                                <div class="stat-widget-three home-widget-three">
                                    <div class="stat-icon bg-facebook">
                                        <i class="ti-facebook"></i>
                                    </div>
                                    <div class="stat-content">
                                        <div class="stat-digit">8,268</div>
                                        <div class="stat-text">Likes</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="card p-0">
                                <div class="stat-widget-three home-widget-three">
                                    <div class="stat-icon bg-youtube">
                                        <i class="ti-youtube"></i>
                                    </div>
                                    <div class="stat-content">
                                        <div class="stat-digit">12,545</div>
                                        <div class="stat-text">Subscribes</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="card p-0">
                                <div class="stat-widget-three home-widget-three">
                                    <div class="stat-icon bg-twitter">
                                        <i class="ti-twitter"></i>
                                    </div>
                                    <div class="stat-content">
                                        <div class="stat-digit">7,982</div>
                                        <div class="stat-text">Tweets</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="card p-0">
                                <div class="stat-widget-three home-widget-three">
                                    <div class="stat-icon bg-danger">
                                        <i class="ti-linkedin"></i>
                                    </div>
                                    <div class="stat-content">
                                        <div class="stat-digit">9,658</div>
                                        <div class="stat-text">Followers</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-3">
                            <div class="card p-0">
                                <div class="stat-widget-three home-widget-three">
                                    <div class="stat-icon bg-facebook">
                                        <i class="ti-facebook"></i>
                                    </div>
                                    <div class="stat-content">
                                        <div class="stat-digit">10</div>
                                        <div class="stat-text">Leads</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="card p-0">
                                <div class="stat-widget-three home-widget-three">
                                    <div class="stat-icon bg-youtube">
                                        <i class="ti-youtube"></i>
                                    </div>
                                    <div class="stat-content">
                                        <div class="stat-digit">18</div>
                                        <div class="stat-text">Search</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="card p-0">
                                <div class="stat-widget-three home-widget-three">
                                    <div class="stat-icon bg-twitter">
                                        <i class="ti-twitter"></i>
                                    </div>
                                    <div class="stat-content">
                                        <div class="stat-digit">5</div>
                                        <div class="stat-text">Subscribe</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="card p-0">
                                <div class="stat-widget-three home-widget-three">
                                    <div class="stat-icon bg-danger">
                                        <i class="ti-linkedin"></i>
                                    </div>
                                    <div class="stat-content">
                                        <div class="stat-digit">20</div>
                                        <div class="stat-text">Connections</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <!--<div class="col-lg-4">
                            <div class="card">
                                <div class="card-body">
                                    <div class="year-calendar"></div>
                                </div>
                            </div>
                        </div>-->
                        <!-- /# column -->

                        <div class="col-lg-4">
                            <div class="card">
                                <div class="card-title">
                                    <h4>Task</h4>

                                </div>
                                <div class="todo-list">
                                    <div class="tdl-holder">
                                        <div class="tdl-content">
                                            <ul>
                                                <li>
                                                    <label>
                                                        <input type="checkbox"><i></i><span>22,Dec Publish The Final
                                                            Exam Result</span>
                                                        <a href='#' class="ti-close"></a>
                                                    </label>
                                                </li>
                                                <li>
                                                    <label>
                                                        <input type="checkbox" checked><i></i><span>First Jan Start Our
                                                            School</span>
                                                        <a href='#' class="ti-close"></a>
                                                    </label>
                                                </li>
                                                <li>
                                                    <label>
                                                        <input type="checkbox"><i></i><span>Recently Our Maganement
                                                            Programme Start</span>
                                                        <a href='#' class="ti-close"></a>
                                                    </label>
                                                </li>
                                                <li>
                                                    <label>
                                                        <input type="checkbox" checked><i></i><span>Check out some
                                                            Popular courses</span>
                                                        <a href='#' class="ti-close"></a>
                                                    </label>
                                                </li>

                                                <li>
                                                    <label>
                                                        <input type="checkbox" checked><i></i><span>First Jan Start Our
                                                            School</span>
                                                        <a href='#' class="ti-close"></a>
                                                    </label>
                                                </li>
                                                <li>
                                                    <label>
                                                        <input type="checkbox" checked><i></i><span>Connect with one new
                                                            person</span>
                                                        <a href='#' class="ti-close"></a>
                                                    </label>
                                                </li>
                                            </ul>
                                        </div>
                                        <input type="text" class="tdl-new form-control"
                                            placeholder="Write new item and hit 'Enter'...">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- /# Task column End -->
                        <div class="col-lg-4">
                            <div class="card">
                                <div class="card-title">
                                    <h4>Notice Board </h4>

                                </div>
                                <div class="recent-comment m-t-15">
                                    <div class="media">
                                        <div class="media-left">
                                            <a href="#"><img class="media-object" src="assets/images/avatar/1.jpg"
                                                    alt="..."></a>
                                        </div>
                                        <div class="media-body">
                                            <h4 class="media-heading color-primary">john doe</h4>
                                            <p>Cras sit amet nibh libero, in gravida nulla.</p>
                                            <p class="comment-date">10 min ago</p>
                                        </div>
                                    </div>
                                    <div class="media">
                                        <div class="media-left">
                                            <a href="#"><img class="media-object" src="assets/images/avatar/2.jpg"
                                                    alt="..."></a>
                                        </div>
                                        <div class="media-body">
                                            <h4 class="media-heading color-success">Mr. John</h4>
                                            <p>Cras sit amet nibh libero, in gravida nulla.</p>
                                            <p class="comment-date">1 hour ago</p>
                                        </div>
                                    </div>
                                    <div class="media">
                                        <div class="media-left">
                                            <a href="#"><img class="media-object" src="assets/images/avatar/3.jpg"
                                                    alt="..."></a>
                                        </div>
                                        <div class="media-body">
                                            <h4 class="media-heading color-danger">Mr. John</h4>
                                            <p>Cras sit amet nibh libero, in gravida nulla.</p>
                                            <div class="comment-date">Yesterday</div>
                                        </div>
                                    </div>
                                    <div class="media">
                                        <div class="media-left">
                                            <a href="#"><img class="media-object" src="assets/images/avatar/1.jpg"
                                                    alt="..."></a>
                                        </div>
                                        <div class="media-body">
                                            <h4 class="media-heading color-primary">john doe</h4>
                                            <p>Cras sit amet nibh libero, in gravida nulla.</p>
                                            <p class="comment-date">10 min ago</p>
                                        </div>
                                    </div>
                                    <div class="media">
                                        <div class="media-left">
                                            <a href="#"><img class="media-object" src="assets/images/avatar/2.jpg"
                                                    alt="..."></a>
                                        </div>
                                        <div class="media-body">
                                            <h4 class="media-heading color-success">Mr. John</h4>
                                            <p>Cras sit amet nibh libero, in gravida nulla.</p>
                                            <p class="comment-date">1 hour ago</p>
                                        </div>
                                    </div>
                                    <div class="media no-border">
                                        <div class="media-left">
                                            <a href="#"><img class="media-object" src="assets/images/avatar/3.jpg"
                                                    alt="..."></a>
                                        </div>
                                        <div class="media-body">
                                            <h4 class="media-heading color-info">Mr. John</h4>
                                            <p>Cras sit amet nibh libero, in gravida nulla.</p>
                                            <div class="comment-date">Yesterday</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- /# card -->
                        </div>
                        <!-- /# Notice Board  column End -->
                        <div class="col-lg-4">
                            <div class="card">
                                <div class="card-title">
                                    <h4>Timeline</h4>

                                </div>
                                <div class="card-body">
                                    <ul class="timeline">
                                        <li>
                                            <div class="timeline-badge primary"><i class="fa fa-smile-o"></i></div>
                                            <div class="timeline-panel">
                                                <div class="timeline-heading">
                                                    <h5 class="timeline-title">School promote video sharing</h5>
                                                </div>
                                                <div class="timeline-body">
                                                    <p>10 minutes ago</p>
                                                </div>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="timeline-badge warning"><i class="fa fa-sun-o"></i></div>
                                            <div class="timeline-panel">
                                                <div class="timeline-heading">
                                                    <h5 class="timeline-title">Ready our school website and online
                                                        service</h5>
                                                </div>
                                                <div class="timeline-body">
                                                    <p>20 minutes ago</p>
                                                </div>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="timeline-badge danger"><i class="fa fa-times-circle-o"></i>
                                            </div>
                                            <div class="timeline-panel">
                                                <div class="timeline-heading">
                                                    <h5 class="timeline-title">Routine pubish our website form
                                                        10/03/2017 </h5>
                                                </div>
                                                <div class="timeline-body">
                                                    <p>30 minutes ago</p>
                                                </div>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="timeline-badge success"><i class="fa fa-check-circle-o"></i>
                                            </div>
                                            <div class="timeline-panel">
                                                <div class="timeline-heading">
                                                    <h5 class="timeline-title">Principle quotation publish our website
                                                    </h5>
                                                </div>
                                                <div class="timeline-body">
                                                    <p>15 minutes ago</p>
                                                </div>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="timeline-badge warning"><i class="fa fa-sun-o"></i></div>
                                            <div class="timeline-panel">
                                                <div class="timeline-heading">
                                                    <h5 class="timeline-title">Class schedule publish our website</h5>
                                                </div>
                                                <div class="timeline-body">
                                                    <p>20 minutes ago</p>
                                                </div>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <!-- /# card -->
                        </div>
                        <!-- /# Timeline column End -->
                    </div>
                    <!-- /# row -->

                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="card-title pr">
                                    <h4>All Expense</h4>

                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table student-data-table m-t-20">
                                            <thead>
                                                <tr>
                                                    <th><label><input type="checkbox" value=""></label>ID</th>
                                                    <th>Expense Type</th>
                                                    <th>Amount</th>
                                                    <th>Status</th>
                                                    <th>Email</th>
                                                    <th>Date</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td><label><input type="checkbox" value=""></label>#2901</td>
                                                    <td>
                                                        Salary
                                                    </td>
                                                    <td>
                                                        $2000
                                                    </td>
                                                    <td>
                                                        <span class="badge badge-primary">Paid</span>
                                                    </td>
                                                    <td>
                                                        edumin@gmail.com
                                                    </td>
                                                    <td>
                                                        10/05/2017
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td><label><input type="checkbox" value=""></label>#2901</td>
                                                    <td>
                                                        Salary
                                                    </td>
                                                    <td>
                                                        $2000
                                                    </td>
                                                    <td>
                                                        <span class="badge badge-warning">Pending</span>
                                                    </td>
                                                    <td>
                                                        edumin@gmail.com
                                                    </td>
                                                    <td>
                                                        10/05/2017
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td><label><input type="checkbox" value=""></label>#2901</td>
                                                    <td>
                                                        Salary
                                                    </td>
                                                    <td>
                                                        $2000
                                                    </td>
                                                    <td>
                                                        <span class="badge badge-primary">Paid</span>
                                                    </td>
                                                    <td>
                                                        edumin@gmail.com
                                                    </td>
                                                    <td>
                                                        10/05/2017
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td><label><input type="checkbox" value=""></label>#2901</td>
                                                    <td>
                                                        Salary
                                                    </td>
                                                    <td>
                                                        $2000
                                                    </td>
                                                    <td>
                                                        <span class="badge badge-danger">Due</span>
                                                    </td>
                                                    <td>
                                                        edumin@gmail.com
                                                    </td>
                                                    <td>
                                                        10/05/2017
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td><label><input type="checkbox" value=""></label>#2901</td>
                                                    <td>
                                                        Salary
                                                    </td>
                                                    <td>
                                                        $2000
                                                    </td>
                                                    <td>
                                                        <span class="badge badge-primary">Paid</span>
                                                    </td>
                                                    <td>
                                                        edumin@gmail.com
                                                    </td>
                                                    <td>
                                                        10/05/2017
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- /# column -->
                    </div>


                    <div class="row">
                        <div class="col-lg-12">
                            <div class="footer">
                                <p>2022 © Global School of Trading.</p>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </div>
	<?php include('parts/js-files.php'); ?>
    <script type="text/javascript" src="assets/js/custom/dashboard.js?v=<?php echo time();?>"></script> 
    <!-- jquery vendor -->
   <?php /*?> <script src="assets/js/lib/jquery.min.js"></script>
    <script src="assets/js/lib/jquery.nanoscroller.min.js"></script>
    <!-- nano scroller -->
    <script src="assets/js/lib/menubar/sidebar.js"></script>
    <script src="assets/js/lib/preloader/pace.min.js"></script>
    <!-- sidebar -->

    <script src="assets/js/lib/bootstrap.min.js"></script>
    <script src="assets/js/scripts.js"></script>
    <!-- bootstrap -->

    <script src="assets/js/lib/calendar-2/moment.latest.min.js"></script>
    <script src="assets/js/lib/calendar-2/pignose.calendar.min.js"></script>


    <script src="assets/js/lib/weather/jquery.simpleWeather.min.js"></script>
    <script src="assets/js/lib/weather/weather-init.js"></script>
    <script src="assets/js/lib/circle-progress/circle-progress.min.js"></script>
    <script src="assets/js/lib/circle-progress/circle-progress-init.js"></script>
    <script src="assets/js/lib/chartist/chartist.min.js"></script>
    <script src="assets/js/lib/sparklinechart/jquery.sparkline.min.js"></script>
    <script src="assets/js/lib/owl-carousel/owl.carousel.min.js"></script>
    <script src="assets/js/lib/owl-carousel/owl.carousel-init.js"></script>
    <!-- scripit init-->
    <script src="assets/js/dashboard2.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />

    <script>
        $(function () {
            $('input[name="daterange"]').daterangepicker({
                opens: 'left'
            }, function (start, end, label) {
                console.log("A new date selection was made: " + start.format('YYYY-MM-DD') + ' to ' +
                    end.format('YYYY-MM-DD'));
            });
        });
    </script><?php */?>
</body>

</html>