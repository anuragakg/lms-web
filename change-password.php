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
    <div class="content-wrap">
        <div class="main">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-8 p-r-0 title-margin-right">
                        <div class="page-header">
                            <div class="page-title">
                                <h1> Change Password </h1>
                            </div>
                        </div>
                    </div>
                    <!-- /# column -->
                    <div class="col-lg-4 p-l-0 title-margin-left">
                        <div class="page-header">
                            <div class="page-title">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="projects.html">Profile</a></li>
                                    <li class="breadcrumb-item active"> Change Password</li>
                                </ol>
                            </div>
                        </div>
                    </div>
                    <!-- /# column -->
                </div>
                <!-- /# row -->
                <section id="main-content">

                    <div class="row">
                        <div class="col-md-12">
                            <form id="formID">
                                <div class="form">
									<div class="row">
                                        <div class="col-md-6">
                                            <label for="">  Current Password </label>
                                            <input id="old_password" name="old_password" class="form-control" required>
                                        </div>
									</div>
									<div class="row">
                                        <div class="col-md-6">
                                            <label for="">New Password </label>
                                            <input type="text" name="password" id="password" placeholder="Enter Password" class="form-control form-control-sm" pattern="" required="">
                                        </div>
                                    </div>
									<div class="row">
                                        <div class="col-md-6">
                                            <label for="">  Confirm Password </label>
                                            <input id="password_confirmation" name="password_confirmation" class="form-control" required>
                                        </div>
									</div>
                                    
                                    <button type="submit"  class="btn btn-sm btn-primary mt-3">Create</button>
                                </div>    
                            </form>
                            
                            
                        </div>
                        <div class="col-md-5 d-flex align-items-end">
                        </div>
                     </div>
				</section>
			
			</div>


            
            
        </div>
    </div>
    <?php include('status_history_modal.php'); ?>
<?php include('parts/js-files.php'); ?>
<script type="text/javascript" src="assets/js/custom/change-password.js?v=<?php echo time();?>"></script> 
  

</body>

</html>