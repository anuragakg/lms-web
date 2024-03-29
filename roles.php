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
                    <div class="col-lg-8">
                        <div class="page-header">
                            <div class="page-title">
                                <h1>Roles</h1>
                            </div>
                        </div>
                    </div>
                    <!-- /# column -->
                    <div class="col-lg-4">
                        <div class="page-header">
                            <div class="page-title">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="new-user.html">Staff Members</a></li>
                                    <li class="breadcrumb-item active">Roles</li>
                                </ol>
                            </div>
                        </div>
                    </div>
                    <!-- /# column -->
                </div>
                <!-- /# row -->
                <div class="hidden role_add col-md-12">
                    <form id="formID">
                        <div class="row form">
                            <div class="col-md-2 mt-2"><label for=""> Role Name </label></div>
                            <div class="col-md-3 mb-2"><input type="text" name="title" id="title" placeholder="Enter Role" class="form-control form-control-sm"  required="">
                                <div id="nameChange" class="mt-2 w-100" style="font-size: 10px;"></div></div>
                            <div class="col-md-2"><button type="submit"  class="btn btn-sm btn-primary">Create</button></div>
                        </div>    
                    </form>
                </div>
                <section id="main-content">
                    <div class="mt-3">
                           <!-- <h6 class="w-100">List of Roles </h6> -->
                            <div id="myGrid" class="table-responsive">
                                <table width="100%" id="list" class="table table-striped table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th>SR.No</th>
                                            <th>Role</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                     </tbody>
                                </table>
                            </div>
                    </div>
                </section>
            </div>

        </div>
    </div>

    <?php include('parts/js-files.php'); ?>

	<script type="text/javascript" src="assets/js/custom/roles.js?v=<?php echo time();?>"></script> 

</body>

</html>