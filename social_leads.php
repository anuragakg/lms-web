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
    <link href="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap-switch-button@1.1.0/css/bootstrap-switch-button.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap-switch-button@1.1.0/dist/bootstrap-switch-button.min.js"></script>
<link rel="stylesheet" type="text/css" href="assets/css/plugins/switch/on-off-switch.css"/>
</head>

<body>

    <?php include('parts/head-tag.php'); ?>
    <?php include('sidebar.php');?>
    <?php include('header.php');?>
    <div class="content-wrap">
        <div class="main">
            <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="page-header">
                                <div class="page-title">
                                    <h1>Social Media Leads </h1>
                                </div>
                            </div>
                        </div>
                        <!-- /# column -->
                    </div>
                    <!-- /# row -->

                    <div class="form-group customForm">
                        <label class="col-form-label">Child Code</label>
                        <input type="text" name="main_code" id="main_code" class="form-control" > 
                    
                        <label class="col-form-label">Parent Code</label>
                        <input type="text" name="parent_code" id="parent_code" class="form-control" >
                        
                        <button type="button" class="btn btn-primary" id="search-btn"> Search</button>
                    </div>

                    <section id="main-content">
                        <div class="mt-3">
                            <!--<h6 class="w-100">Social Media Leads</h6> -->
                            <div id="myGrid" class="table-responsive">
                                <table width="100%" id="list" class="table table-striped table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th>SR.No</th>
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>Phone</th>
                                            <th>Source</th>
                                            <th>Add name</th>
                                            <th>Child code</th>
                                            <th>Parent Code</th>
                                            <th>Created Date</th>
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
        <?php include('status_history_modal.php'); ?>
        <?php include('parts/js-files.php'); ?>
<script type="text/javascript" src="assets/js/custom/social_leads.js?v=<?php echo time();?>"></script> 
   
</body>

</html>