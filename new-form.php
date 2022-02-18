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
                    <div class="col-lg-8 p-r-0 title-margin-right">
                        <div class="page-header">
                            <div class="page-title">
                                <h1>Create New Form </h1>
                            </div>
                        </div>
                    </div>
                    <!-- /# column -->
                    <div class="col-lg-4 p-l-0 title-margin-left">
                        <div class="page-header">
                            <div class="page-title">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="projects.html">Project</a></li>
                                    <li class="breadcrumb-item active">New Form</li>
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
                        <div class="col-md-7">
                            <div class="form">
                                <label for="">New Form Name </label>
                                <input type="text" required name="title" id="allowalpha" placeholder="Enter Form Name"
                                    class="form-control form-control-sm" >
                                    <div id="nameChange" class="mt-2 w-100" style="font-size: 10px;"></div>
                                   
                            </div>
                            
                        </div>
                        <div class="col-md-5 d-flex">
                            <div class="form">
                                <label for="">Select Form Type</label>
                                <select class="form-control" name="type" aria-label="Default select example" required>
                                    <option value="">Select</option>
                                    <option value="1">Mini Category</option>
                                    <option value="2">Leads</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="row">
                                <div class="col-md-6">
                                    <input type="checkbox" id="scales" name="contorls[element][first_name]">
                                    <label for="scales">Source</label>
                                    <input type="checkbox" class="on-off-switch" name="contorls[element][first_name][is_required]" checked>
                                </div>
                                <div class="col-md-6">
                                    <input type="checkbox" id="scales" name="contorls[element][status]">
                                    <label for="scales">Status</label>
                                    
                                    <input type="checkbox" class="on-off-switch" name="contorls[element][status][is_required]" checked>
                                  </div>
                                  <div class="col-md-6">
                                    <input type="checkbox" id="scales" name="contorls[element][assigned]">
                                    <label for="scales">Assigned</label>
                                    
                                    <input type="checkbox" class="on-off-switch" name="contorls[element][assigned][is_required]" checked>
                                  </div>
                                  <div class="col-md-6">
                                    <input type="checkbox" id="scales" name="contorls[element][lead_temp]">
                                    <label for="scales">LeadTemprature</label>
                                    
                                    <input type="checkbox" class="on-off-switch" name="contorls[element][lead_temp][is_required]" checked>
                                  </div>
                                  <div class="col-md-6">
                                    <input type="checkbox" id="scales" name="contorls[element][rating]">
                                    <label for="scales">Lead Score/Rating</label>
                                    
                                    <input type="checkbox" class="on-off-switch" name="contorls[element][rating][is_required]" checked>


                                  </div>
                                  <div class="col-md-6">
                                    <input type="checkbox" id="scales" name="contorls[element][process_status]">
                                    <label for="scales">Process Status</label>
                                    
                                    <input type="checkbox" class="on-off-switch" name="contorls[element][process_status][is_required]" checked>

                                  </div>
                                  <div class="col-md-6">
                                    <input type="checkbox" id="scales" name="contorls[element][title]">
                                    <label for="scales">Title/Position</label>
                                    
                                    <input type="checkbox" class="on-off-switch" name="contorls[element][title][is_required]" checked>


                                  </div>
                                  <div class="col-md-6">
                                    <input type="checkbox" id="scales" name="contorls[element][first_name]">
                                    <label for="scales">First Name</label>
                                    
                                    <input type="checkbox" class="on-off-switch" name="contorls[element][first_name][is_required]" checked>


                                   
                                  </div>
                                  <div class="col-md-6">
                                    <input type="checkbox" id="scales" name="contorls[element][last_name]">
                                    <label for="scales">Last Name</label>
                                   
                                    <input type="checkbox" class="on-off-switch" name="contorls[element][last_name][is_required]" checked>
                                  </div>
                                  <div class="col-md-6">
                                    <input type="checkbox" id="scales" name="contorls[element][company_name]">
                                    <label for="scales">Company Name</label>
                                    
                                    <input type="checkbox" class="on-off-switch" name="contorls[element][company_name][is_required]" checked>
                                  </div>
                                  <div class="col-md-6">
                                    <input type="checkbox" id="scales" name="contorls[element][email]">
                                    <label for="scales">Email</label>
                                    
                                    <input type="checkbox" class="on-off-switch" name="contorls[element][email][is_required]" checked>
                                  </div>
                                  <div class="col-md-6">
                                    <input type="checkbox" id="scales" name="contorls[element][phone]">
                                    <label for="scales">Phone</label>
                                    
                                    <input type="checkbox" class="on-off-switch" name="contorls[element][phone][is_required]" checked>
                                  </div>
                                  <div class="col-md-6">
                                    <input type="checkbox" id="scales" name="contorls[element][fax]">
                                    <label for="scales">Fax</label>
                                    
                                    <input type="checkbox" class="on-off-switch" name="contorls[element][fax][is_required]" checked>
                                  </div>
                                  <div class="col-md-6">
                                    <input type="checkbox" id="scales" name="contorls[element][whatsapp]">
                                    <label for="scales">Whatsapp Number</label>
                                    
                                    <input type="checkbox" class="on-off-switch" name="contorls[element][whatsapp][is_required]" checked>
                                  </div>
                                  <div class="col-md-6">
                                    <input type="checkbox" id="scales" name="contorls[element][website]">
                                    <label for="scales">Website</label>
                                   
                                    <input type="checkbox" class="on-off-switch" name="contorls[element][website][is_required]" checked>
                                  </div>
                                  <div class="col-md-6">
                                    <input type="checkbox" id="scales" name="contorls[element][speaks]">
                                    <label for="scales">Speaks</label>
                                    
                                    <input type="checkbox" class="on-off-switch" name="contorls[element][speaks][is_required]" checked>
                                  </div>
                                  <div class="col-md-6">
                                    <input type="checkbox" id="scales" name="contorls[element][industry]">
                                    <label for="scales">Industry</label>
                                   
                                    <input type="checkbox" class="on-off-switch" name="contorls[element][industry][is_required]" checked>
                                  </div>
                                  <div class="col-md-6">
                                    <input type="checkbox" id="scales" name="contorls[element][notes]">
                                    <label for="scales">Notes</label>
                                    
                                    <input type="checkbox" class="on-off-switch" name="contorls[element][notes][is_required]" checked>
                                  </div>
                            </div>
                            
                        </div>
                        <div class="col-md-5 d-flex align-items-end">
                        </div>
                        <div class="col-md-12">
                            <button type="submit" id="enableCreate" class="btn btn-sm btn-primary mt-3" data-toggle="modal"
                            data-target="#exampleModal" >Create New Form
                    </button>
                        </div>
                        <div class="col-md-12 mt-3">
                            <h6 class="w-100">List of Existing Forms </h6>
                            <div id="myGrid" style="height: 500px; width:100%;" class="ag-theme-alpine"></div>
                        </div>
                    </div>
                </form>
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

<script type="text/javascript" src="assets/js/plugins/switch/on-off-switch.js"></script> 
<script type="text/javascript" src="assets/js/plugins/switch/on-off-switch-onload.js"></script> 
<script type="text/javascript" src="assets/js/custom/project/form.js?v=<?php echo time();?>"></script> 
    
<script type="text/javascript">
    new DG.OnOffSwitchAuto({
        cls: '.on-off-switch',
        textOn: 'Is Required',
        textOff: 'Not Required',
        height:30,
        textSizeRatio:0.35,
        
    });
</script>
   
</body>

</html>