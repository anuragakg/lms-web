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
                                <h1>Create New Form </h1>
                            </div>
                        </div>
                    </div>
                    <!-- /# column -->
                    <div class="col-lg-4">
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
                        <div class="col-md-3">
                            <div class="form">
                                <label for="">New Form Name </label>
                                <input type="text" required name="title" id="title" placeholder="Enter Form Name"
                                    class="form-control form-control-sm" >
                                    <div id="nameChange" class="mt-2 w-100" style="font-size: 10px;"></div>
                                   
                            </div>
                            
                        </div>
                        <div class="col-md-3">
                            <div class="form">
                                <label for="">Select Form Type</label>
                                <select class="form-control" name="type" id="type" aria-label="Default select example" required>
                                    <option value="">Select</option>
                                    <option value="1">Mini Category</option>
                                    <option value="2">Leads</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="row">
                                <div class="col-md-6 mt-2">
                                    <input type="checkbox" id="scales" name="contorls[element][source][input]">
                                    <label for="scales">Source</label> <strong>(Text Box)</strong>
                                    <input type="checkbox" class="on-off-switch" name="contorls[element][source][is_required]" checked>
                                </div>
                                <div class="col-md-6 mt-2">
                                    <input type="checkbox" id="scales" name="contorls[element][status_field][input]">
                                    <label for="scales">Status<strong>(Text Box)</strong></label>
                                    
                                    <input type="checkbox" class="on-off-switch" name="contorls[element][status_field][is_required]" checked>
                                  </div>
                                  <div class="col-md-6 mt-2">
                                    <input type="checkbox" id="scales" name="contorls[element][assigned][input]">
                                    <label for="scales">Assigned<strong>(Text Box)</strong></label>
                                    
                                    <input type="checkbox" class="on-off-switch" name="contorls[element][assigned][is_required]" checked>
                                  </div>
                                  <div class="col-md-6 mt-2">
                                    <input type="checkbox" id="scales" name="contorls[element][lead_temp][input]">
                                    <label for="scales">LeadTemprature<strong>(Text Box)</strong></label>
                                    
                                    <input type="checkbox" class="on-off-switch" name="contorls[element][lead_temp][is_required]" checked>
                                  </div>
                                  <div class="col-md-6 mt-2">
                                    <input type="checkbox" id="scales" name="contorls[element][rating][input]">
                                    <label for="scales">Lead Score/Rating<strong>(Text Box)</strong></label>
                                    
                                    <input type="checkbox" class="on-off-switch" name="contorls[element][rating][is_required]" checked>


                                  </div>
                                  <div class="col-md-6 mt-2">
                                    <input type="checkbox" id="scales" name="contorls[element][process_status][input]">
                                    <label for="scales">Process Status</label><strong>(Text Box)</strong>
                                    
                                    <input type="checkbox" class="on-off-switch" name="contorls[element][process_status][is_required]" checked>

                                  </div>
                                  <div class="col-md-6 mt-2">
                                    <input type="checkbox" id="scales" name="contorls[element][title][input]">
                                    <label for="scales">Title/Position</label> <a href="javascript:void(0)" type="button" class="text-danger" data-toggle="modal" data-target="#titleModal">View Options</a>
                                    
                                    <input type="checkbox" class="on-off-switch" name="contorls[element][title][is_required]" checked>


                                  </div>
                                  <div class="col-md-6 mt-2">
                                    <input type="checkbox" id="scales" name="contorls[element][first_name][input]">
                                    <label for="scales">First Name</label><strong>(Text Box)</strong>
                                    
                                    <input type="checkbox" class="on-off-switch" name="contorls[element][first_name][is_required]" checked>


                                   
                                  </div>
                                  <div class="col-md-6 mt-2">
                                    <input type="checkbox" id="scales" name="contorls[element][last_name][input]">
                                    <label for="scales">Last Name</label><strong>(Text Box)</strong>
                                   
                                    <input type="checkbox" class="on-off-switch" name="contorls[element][last_name][is_required]" checked>
                                  </div>
                                  <div class="col-md-6 mt-2">
                                    <input type="checkbox" id="scales" name="contorls[element][company_name][input]">
                                    <label for="scales">Company Name</label><strong>(Text Box)</strong>
                                    
                                    <input type="checkbox" class="on-off-switch" name="contorls[element][company_name][is_required]" checked>
                                  </div>
                                  <div class="col-md-6 mt-2">
                                    <input type="checkbox" id="scales" name="contorls[element][email][input]">
                                    <label for="scales">Email</label><strong>(Text Box)</strong>
                                    
                                    <input type="checkbox" class="on-off-switch" name="contorls[element][email][is_required]" checked>
                                  </div>
                                  <div class="col-md-6 mt-2">
                                    <input type="checkbox" id="scales" name="contorls[element][phone][input]">
                                    <label for="scales">Phone</label><strong>(Text Box)</strong>
                                    
                                    <input type="checkbox" class="on-off-switch" name="contorls[element][phone][is_required]" checked>
                                  </div>
                                  <div class="col-md-6 mt-2">
                                    <input type="checkbox" id="scales" name="contorls[element][fax][input]">
                                    <label for="scales">Fax</label><strong>(Text Box)</strong>
                                    
                                    <input type="checkbox" class="on-off-switch" name="contorls[element][fax][is_required]" checked>
                                  </div>
                                  <div class="col-md-6 mt-2">
                                    <input type="checkbox" id="scales" name="contorls[element][whatsapp][input]">
                                    <label for="scales">Whatsapp Number</label><strong>(Text Box)</strong>
                                    
                                    <input type="checkbox" class="on-off-switch" name="contorls[element][whatsapp][is_required]" checked>
                                  </div>
                                  <div class="col-md-6 mt-2">
                                    <input type="checkbox" id="scales" name="contorls[element][website][input]">
                                    <label for="scales">Website</label><strong>(Text Box)</strong>
                                   
                                    <input type="checkbox" class="on-off-switch" name="contorls[element][website][is_required]" checked>
                                  </div>
                                  <div class="col-md-6 mt-2">
                                    <input type="checkbox" id="scales" name="contorls[element][speaks][input]">
                                    <label for="scales">Speaks</label><a href="javascript:void(0)" type="button" class="text-danger" data-toggle="modal" data-target="#titleLanguage">View Options</a>
                                    
                                    <input type="checkbox" class="on-off-switch" name="contorls[element][speaks][is_required]" checked>
                                  </div>
                                  <div class="col-md-6 mt-2">
                                    <input type="checkbox" id="scales" name="contorls[element][industry][input]">
                                    <label for="scales">Industry</label><strong>(Text Box)</strong>
                                   
                                    <input type="checkbox" class="on-off-switch" name="contorls[element][industry][is_required]" checked>
                                  </div>
                                  <div class="col-md-6 mt-2">
                                    <input type="checkbox" id="scales" name="contorls[element][notes][input]">
                                    <label for="scales">Notes</label><strong>(Text Box)</strong>
                                    
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
                        
                    </div>
                </form>
            </div>


            
            </section>
        </div>
    </div>
    </div>


<!-- Modal -->
<div id="titleModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Title</h4>
      </div>
      <div class="modal-body">
        <table class="table table-bordered table-striped table-hover">
            <thead>
                <tr>
                    <td>SR.No</td>
                    <td>Options</td>
                </tr>
            </thead>
            <tbody>
                <?php $i=0;
                foreach ($titleList as $key => $title) {
                    ++$i;
                    ?>
                    <tr>
                        <td><?php echo $i;?></td>
                        <td><?php echo $title;?></td>
                    </tr>
                    <?php
                }
                ?>
            </tbody>
        </table>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>
<div id="titleLanguage" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Title</h4>
      </div>
      <div class="modal-body">
        <table class="table table-bordered table-striped table-hover">
            <thead>
                <tr>
                    <td>SR.No</td>
                    <td>Options</td>
                </tr>
            </thead>
            <tbody>
                <?php $i=0;
                foreach ($languagesList as $key => $language) {
                    ++$i;
                    ?>
                    <tr>
                        <td><?php echo $i;?></td>
                        <td><?php echo $language;?></td>
                    </tr>
                    <?php
                }
                ?>
            </tbody>
        </table>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
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