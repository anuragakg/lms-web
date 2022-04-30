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
    <?php include('classes/utils.php');?>

	<?php
	$utils=new Utils();
	$titleList=$utils->titleList();
    $languagesList=$utils->languagesList();
	
	?>
    <div class="content-wrap">
        <div class="main">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-8">
                        <div class="page-header">
                            <div class="page-title">
                                <h1>New Mini Category</h1>
                            </div>
                        </div>
                    </div>
                    <!-- /# column -->
                    <div class="col-lg-4">
                        <div class="page-header">
                            <div class="page-title">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="projects.html">Project</a></li>
                                    <li class="breadcrumb-item active">Create Product Mini Category </li>
                                </ol>
                            </div>
                        </div>
                    </div>
                    <!-- /# column -->
                </div>
                <!-- /# row -->

                <section id="main-content">
                    <form id="formID">
                        <div class="form row form-group">
                            <label class="col-md-3 col-form-label" for="">Select Product Form</label>
                            <div class="col-md-4">
                                <select onchange="getFormControls()" id="product_form_mini_id" name="product_form_mini_id" required class="form-control" aria-label="Default select example"></select>
                            </div>
                        </div>

                        <div class="form row form-group">
                            <label class="col-md-3 col-form-label" for="">Select Product Category</label>
                            <div class="col-md-4">
                                <select name="category_id" required id="category_id" class="form-control" aria-label="Default select example">
                                <option value="">Select</option>
                                </select>
                            </div>
                        </div>
                            
                        <div class="form row form-group">
                            <label class="col-md-3 col-form-label" for="">Select Product Sub Category</label>
                            <div class="col-md-4">
                                <select name="sub_category_id" required id="sub_category_id" class="form-control" aria-label="Default select example">
                                <option value="">Select</option>
                                </select>
                            </div>
                        </div> 
                            
                        <div class="form row form-group">
                            <label class="col-md-3 col-form-label" for="">Select Product Vertical</label>
                            <div class="col-md-4">
                                <select required name="product_vertical_id" id="product_vertical_id" class="form-control" aria-label="Default select example">
                                <option value="">Select</option>
                                </select>
                            </div>
                        </div>

                        <button type="submit"  class="btn btn-sm btn-primary mt-3">Submit</button>

                        <div class="row">    
                            <div class="col-md-4 col-sm-12 title" style="display:none">

                                <span><span class="text-danger">*</span> Title/Position</span>
                                <div class="input-group">
                                    <select name="title" id="title"
                                        class="form-control form-control-sm select2-hidden-accessible"  data-select2-id="select2-data-title_id" tabindex="-1"
                                        aria-hidden="true">
                                        <option value="">Select</option>
										<?php
										foreach ($titleList as $key => $title) {
                                            ?>
                                            <option><?php echo $title;?></option>
                                            <?php
                                        }
										?>
                                    </select>

                                </div>
                                <span class="text text-danger"></span>
                            </div>

                            <div class="col-md-4 col-sm-12 first_name" style="display:none">
                                <div class="form-group">
                                    <span><span class="text-danger" id="first_name_required"></span> First Name</span>
                                    <input type="text" name="first_name" id="first_name" 
                                        class="form-control form-control-sm"
                                        placeholder="Enter First Name">
                                </div>
                                <span class="text text-danger"></span>
                            </div>
                            <div class="col-md-4 col-sm-12 last_name" style="display:none">
                                <div class="form-group">
                                    <span><span class="text-danger" id="last_name_required"></span> Last Name</span>
                                    <input type="text" name="last_name" id="last_name" class="form-control form-control-sm"
                                        placeholder="Enter Last Name" data-validation="length"
                                        data-validation-length="2-20" >
                                </div>
                                <span class="text text-danger"></span>
                            </div>
                        </div>

                        <div class="row mt-2">

                            <div class="col-md-4 col-sm-12 email" style="display:none">
                                <span><span class="text-danger" id="email_required"></span> Email
                                </span>

                                <div class="input-group">
                                    <input type="text" id="email" name="email" class="form-control form-control-sm"
                                        placeholder="Enter Email" id="email">
                                </div>
                                <span class="text text-danger" id="email_error"></span>
                            </div>

                            <div class="col-md-4 col-sm-12 phone" style="display:none">
                                <span><span class="text-danger" id="phone_required"></span> Phone
                                </span>

                                <div class="input-group">
                                    <input type="number" id="phone" name="phone" class="form-control form-control-sm"
                                        placeholder="Enter Phone">
                                    <span class="text text-danger"></span>
                                </div>
                            </div>


                            <div class="col-md-4 col-sm-12 fax" style="display:none">
                                <span><span class="text-danger" id="fax_required"></span> Fax
                                </span>

                                <div class="input-group">
                                    <input type="text" id="fax" name="fax" class="form-control form-control-sm"
                                        placeholder="Enter Fax">
                                    <span class="text text-danger"></span>
                                </div>
                            </div>

                        </div>
                        <div class="row mt-3">

                            <div class="col-md-4 col-sm-12 whatsapp" style="display:none">
                                <div class="form-group">
                                    <span><span class="text-danger" id="whatsapp_required"></span> WhatsApp Number
                                    </span>
                                    <input type="number" id="whatsapp" name="whatsapp"
                                        class="form-control form-control-sm"
                                        placeholder="Enter Whatsapp Number" data-validation="length"
                                        data-validation-length="max12">
                                </div>
                                <span class="text text-danger"></span>
                            </div>


                            <div class="col-md-4 col-sm-12 website" style="display:none">
                                <div class="form-group">
                                    <span><span class="text-danger" id="website_required"></span> Website</span>
                                    <input type="text" name="website" id="website" class="form-control form-control-sm"
                                        placeholder="Enter Website">
                                </div>
                                <span class="text text-danger"></span>
                            </div>

                            <div class="col-md-4 col-sm-12 speaks" style="display:none">
                                <span><span class="text-danger" id="speaks_required"></span> Speaks</span>
                                <div class="input-group">
                                    <select name="speaks" id="speaks"
                                        class="form-control form-control-sm select2-hidden-accessible"
                                        data-select2-id="select2-data-languages_id" tabindex="-1"
                                        aria-hidden="true" >
                                        <?php
                                        foreach ($languagesList as $key => $language) {
                                            ?>
                                            <option><?php echo $language;?></option>
                                            <?php
                                        }
                                        ?>
                                    </select>
                                </div>
                                <span class="text text-danger"></span>
                            </div>

                            <div class="col-md-4 col-sm-12 industry" style="display:none">
                                <div class="form-group">
                                    <span><span class="text-danger" id="industry_required"></span>Industry</span>
                                    <input type="text" name="industry" id="industry" class="form-control form-control-sm">
                                </div>
                            </div>
                            <div class="col-md-4 col-sm-12 notes" style="display:none">
                                <div class="form-group">
                                    <span><span class="text-danger" id="notes_required"></span>Notes</span>
                                    <input type="text" name="notes" id="notes" class="form-control form-control-sm">
                                </div>
                            </div>
                            <div class="col-md-4 col-sm-12 company_name" style="display:none">
                                <div class="form-group">
                                    <span><span class="text-danger" id="company_name_required"></span>Company Name</span>
                                    <input type="text" name="company_name" id="company_name" class="form-control form-control-sm">
                                </div>
                            </div>
                        </div>

                        <div class="row mt-3">
                            <div class="col-md-4 col-sm-12 process_status" style="display:none">
                                <div class="form-group">
                                    <span><span class="text-danger" id="process_status_required"></span>Process Status</span>
                                    <input type="text" name="process_status" id="process_status" class="form-control form-control-sm">
                                </div>
                            </div>
                            <div class="col-md-4 col-sm-12 rating" style="display:none">
                                <div class="form-group">
                                    <span><span class="text-danger" id="rating_required"></span>Lead Score/Rating</span>
                                    <input type="text" name="rating" id="rating" class="form-control form-control-sm">
                                </div>
                            </div>
                            <div class="col-md-4 col-sm-12 lead_temp" style="display:none">
                                <div class="form-group">
                                    <span><span class="text-danger" id="lead_temp_required"></span>Lead Score/Rating</span>
                                    <input type="text" name="lead_temp" id="lead_temp" class="form-control form-control-sm">
                                </div>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-md-4 col-sm-12 assigned" style="display:none">
                                <div class="form-group">
                                    <span><span class="text-danger" id="assigned_required"></span>Assigned</span>
                                    <input type="text" name="assigned" id="assigned" class="form-control form-control-sm">
                                </div>
                            </div>
                            <div class="col-md-4 col-sm-12 status_field" style="display:none">
                                <div class="form-group">
                                    <span><span class="text-danger" id="status_field_required"></span>Status</span>
                                    <input type="text" name="status_field" id="status_field" class="form-control form-control-sm">
                                </div>
                            </div>
                            <div class="col-md-4 col-sm-12 source" style="display:none">
                                <div class="form-group">
                                    <span><span class="text-danger" id="source_required"></span>Source</span>
                                    <input type="text" name="source" id="source" class="form-control form-control-sm">
                                </div>
                            </div>
                        </div>
                        
                    </form>
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
<script type="text/javascript" src="assets/js/custom/project/minicategory.js?v=<?php echo time();?>"></script> 

</body>

</html>