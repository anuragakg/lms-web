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
                                <h1> Users </h1>
                            </div>
                        </div>
                    </div>
                    <!-- /# column -->
                    <div class="col-lg-4">
                        <div class="page-header">
                            <div class="page-title">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="projects.html">Users</a></li>
                                    <li class="breadcrumb-item active"> User</li>
                                </ol>
                            </div>
                        </div>
                    </div>
                    <!-- /# column -->
                </div>
                <!-- /# row -->
                <section id="main-content">

                    <div class="row">
                        <div class="col-md-6">
                            <form id="formID">
                                <div class="form">
									<div class="row form-group">
                                        <label class="col-md-4 col-form-label" for="">  Name </label>
                                        <div class="col-md-6">
                                            <input type="text" name="name" id="name" placeholder="Enter Name" class="form-control form-control-sm" pattern="[A-Za-z0-9]+" required="">
                                        </div>
                                    </div>
                                    <div class="row form-group">
                                        <label class="col-md-4 col-form-label" for="">  Contact Number </label>
                                        <div class="col-md-6">
                                            <input type="text" name="phone" id="phone" placeholder="Enter phone" class="form-control form-control-sm" required="">
                                        </div>
                                    </div>
                                    <div class="row form-group">
                                        <label class="col-md-4 col-form-label" for="">  Official Contact Number </label>
                                        <div class="col-md-6">
                                            <input type="text" name="official_contact_number" id="official_contact_number" placeholder="Enter official contact number" class="form-control form-control-sm" required="">
                                        </div>
                                    </div>
                                    <div class="row form-group">
                                        <label class="col-md-4 col-form-label" for="">  Emergency Contact Number </label>
                                        <div class="col-md-6">
                                            <input type="text" name="emergency_contact_number" id="emergency_contact_number" placeholder="Enter Emergency contact number" class="form-control form-control-sm" required="">
                                        </div>
                                    </div>
                                    <div class="row form-group">
                                        <label class="col-md-4 col-form-label" for="">  Relation for the Contact Number </label>
                                        <div class="col-md-6">
                                            <input type="text" name="relation_contact_number" id="relation_contact_number" placeholder="Enter Relation of contact number" class="form-control form-control-sm" required="">
                                        </div>
                                    </div>
                                    <div class="row form-group">
                                        <label class="col-md-4 col-form-label" for="">  Official Email </label>
                                        <div class="col-md-6">
                                            <input type="text" name="email" id="email" placeholder="Enter email" class="form-control form-control-sm" pattern="[A-Za-z0-9]+" required="">
                                        </div>
                                    </div>
                                    <div class="row form-group">
                                        <label class="col-md-4 col-form-label" for="">  Personal Email Id</label>
                                        <div class="col-md-6">
                                            <input type="email" name="personal_email" id="personal_email" placeholder="Enter email" class="form-control form-control-sm"  required="">
                                        </div>
                                    </div>
                                    <div class="row form-group">
                                        <label class="col-md-4 col-form-label" for="">  Role </label>
                                        <div class="col-md-6">
                                            <select id="role" name="role" class="form-control" required>
                                                <option value="">Select Role</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="row form-group">
                                        <label class="col-md-4 col-form-label" for="">  Employee Code  </label>
                                        <div class="col-md-6">
                                            <input type="text" name="emp_code" id="emp_code" placeholder="Enter Employee Code" class="form-control form-control-sm" required="">
                                        </div>
                                    </div>
                                    <div class="row form-group">
                                        <label class="col-md-4 col-form-label" for="">Department  </label>
                                        <div class="col-md-6">
                                            <input type="text" name="dept" id="dept" placeholder="Enter Department" class="form-control form-control-sm" required="">
                                        </div>
                                    </div>
                                    <div class="row form-group">
                                        <label class="col-md-4 col-form-label" for="">Designation  </label>
                                        <div class="col-md-6">
                                            <input type="text" name="designation" id="designation" placeholder="Enter designation" class="form-control form-control-sm" required="">
                                        </div>
                                    </div>
                                    <div class="row form-group">
                                        <label class="col-md-4 col-form-label" for="">Reporting Manager  </label>
                                        <div class="col-md-6">
                                            <input type="text" name="rm" id="rm" placeholder="Enter Reporting Manager" class="form-control form-control-sm" required="">
                                        </div>
                                    </div>
                                    <div class="row form-group">
                                        <label class="col-md-4 col-form-label" for="">Permanent Address  </label>
                                        <div class="col-md-6">
                                            <input type="text" name="perm_address" id="perm_address" placeholder="Enter Permanent address"  class="form-control form-control-sm" required="">
                                        </div>
                                    </div>
                                    <div class="row form-group">
                                        <label class="col-md-4 col-form-label" for="">Communication Address  </label>
                                        <div class="col-md-6">
                                            <input type="text" name="comm_address" id="comm_address" placeholder="Enter communication address"  class="form-control form-control-sm" required="">
                                        </div>
                                    </div>
                                    <div class="row form-group">
                                        <label class="col-md-4 col-form-label" for="">Aadhar Card  </label>
                                        <div class="col-md-6">
                                            <input type="text" name="aadhar" id="aadhar" placeholder="Enter aadhar number" minlength="12" maxlength="12" class="form-control form-control-sm" required="">
                                        </div>
                                    </div>
                                    <div class="row form-group">
                                        <label class="col-md-4 col-form-label" for="">PAN Number  </label>
                                        <div class="col-md-6">
                                            <input type="text" name="pan_number" id="pan_number" placeholder="Enter pan number"  class="form-control form-control-sm" required="">
                                        </div>
                                    </div>
                                    <div class="row form-group">
                                        <label class="col-md-4 col-form-label" for=""> </label>
                                        <div class="col-md-6">
                                            <button type="submit"  class="btn btn-sm btn-primary">Create</button>
                                        </div>
                                    </div>
                                        
                                </div>    
                            </form>
                        </div>
                     </div>

				</section>
			
			</div>


            
            
        </div>
    </div>
    <?php include('status_history_modal.php'); ?>
<?php include('parts/js-files.php'); ?>
<script type="text/javascript" src="assets/js/custom/user/add.js?v=<?php echo time();?>"></script> 
  

</body>

</html>