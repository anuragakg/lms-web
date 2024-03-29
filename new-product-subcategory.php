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
                                <h1>Create New Product Sub Category </h1>
                            </div>
                        </div>
                    </div>
                    <!-- /# column -->
                    <div class="col-lg-4">
                        <div class="page-header">
                            <div class="page-title">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="projects.html">Project</a></li>
                                    <li class="breadcrumb-item active">Create Product Sub Category </li>
                                </ol>
                            </div>
                        </div>
                    </div>
                    <!-- /# column -->
                </div>
                <!-- /# row -->
                <section id="main-content">
                    <form id="formID">
                        <div class="row">
                            <div class="col-md-6 mt-3">
                                <div class="form row form-group">
                                    <label class="col-md-6 col-form-label" for="">New Product Sub Category</label>
                                    <div class="col-md-6">
                                        <input type="text" required name="sub_category" id="sub_category" placeholder="Enter Product Sub Category" class="form-control form-control-sm" pattern="[A-Za-z0-9]+" required="">
                                        <div id="nameChange" class="mt-2 w-100" style="font-size: 10px;"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 mt-3">
                                <div class="form row form-group">
                                    <label class="col-md-6 col-form-label" for="">Select Product Category</label>
                                    <div class="col-md-6">
                                        <select name="category_id" required id="category_id" class="form-control" aria-label="Default select example">
                                            <option value="">Select</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 mt-3">
                                <div class="form row form-group">
                                    <label class="col-md-6 col-form-label" for="">Select Product Vertical</label>
                                    <div class="col-md-6">
                                        <select required name="product_vertical_id" id="product_vertical_id" class="form-control" aria-label="Default select example">
                                            <option value="">Select</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 mt-3">
                                <div class="form row form-group">
                                    <label class="col-md-6 col-form-label" for="">Select Product Mini Category Form</label>
                                    <div class="col-md-6">
                                        <select required name="product_form_mini_id" id="product_form_mini_id" class="form-control" aria-label="Default select example">
                                            <option value="">Select</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 mt-3">
                                <div class="form  row form-group">
                                    <label class="col-md-6 col-form-label" for="">Select Lead Form</label>
                                    <div class="col-md-6">
                                        <select required name="product_form_lead_id" id="product_form_lead_id" class="form-control" aria-label="Default select example">
                                            <option value="">Select</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12 d-flex align-items-end">
                                <button type="submit" class="btn btn-sm btn-primary mt-3" >Save</button>
                            </div>
                        </div>
                    </form>
                    <div class="row">
                        <div class="col-md-12 mt-3">
                            <h6 class="w-100">List of Existing Product Sub Categories </h6>
                            <div id="myGrid" style="height: 500px; width:100%;" class="ag-theme-alpine"></div>
                        </div>
                    </div>
                </section>

                <div class="row">
                    <div class="col-lg-12">
                        <div class="footer">
                            <p>2022 © Global School of Trading.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Temporary Created and sent for approval
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <?php include('parts/js-files.php'); ?>
<script type="text/javascript" src="assets/js/custom/project/project-sub-category.js?v=<?php echo time();?>"></script> 
</body>

</html>