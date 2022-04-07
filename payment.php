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
                    <div class="col-lg-8 p-r-0 title-margin-right">
                        <div class="page-header">
                            <div class="page-title">
                                <h1>Payment Info </h1>
                            </div>
                        </div>
                    </div>
                    <!-- /# column -->
                    <div class="col-lg-4 p-l-0 title-margin-left">
                        <div class="page-header">
                            <div class="page-title">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="social_leads.php">Leads</a></li>
                                    <li class="breadcrumb-item active">Payment Info </li>
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
                                    <label for="" id="user_name"></label>
                                       
                                </div>
                                
                            </div>
                            <div class="col-md-5 d-flex">
                                <div class="form">
                                    <label for="" id="email_id"></label>
                                    
                                </div>

                            </div>
                            <div class="col-md-5 d-flex">
                                <div class="form">
                                    <label for="" >Select Program</label>
                                    <select id="program_id" name="program_id" onchange="getProgramInfo()" class="form-control">
                                        <option value="">Select Programs</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-5 d-flex">
                                <div class="form">
                                    <label for="" id="fund_receivable"></label>
                                    
                                </div>
                                
                            </div>
                            <div class="col-md-5 d-flex">
                                <div class="form">
                                    <label for="" id="fund_received"></label>
                                    
                                </div>
                                
                            </div>
                            <div class="col-md-5 d-flex">
                                <div class="form">
                                    <label for="" id="balance_amount"></label>
                                    
                                </div>
                            </div>
                        </div>
                        
                        <h5>Fee Details</h5>
                        <div class="row">
                            
                            <div class="col-md-12">
                                

                                
                                <div class="row">
                                            
                                    <div class="col-md-6">
                                        <label for="scales">Gross Payable</label> 
                                        <input type="text" class="form-control " name="gross_payable" id="gross_payable" readonly>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="scales">Exemption</label> 
                                        <input type="text" class="form-control fee" name="exemption" id="exemption" value="0">
                                    </div>
                                    <div class="col-md-6">
                                        <label for="scales">Base Fee</label> 
                                        <input type="text" class="form-control " name="base_fee" id="base_fee" value="0" readonly>
                                    </div>

                                    <div class="col-md-6">
                                        <label for="scales">Net Base fee</label> 
                                        <input type="text" class="form-control " name="net_base_fee" id="net_base_fee" value="0" readonly>
                                    </div>
                                        
                                </div>
                                
                            </div>
                        </div>    
                        <h5>Fee Structure</h5>
                        <div class="row">
                            <div id="">
                                <table class="table table-border  ">
                                    <thead>
                                        <tr>
                                            <td>Installment</td>
                                            <td>Date</td>
                                            <td>Amount</td>
                                            
                                            <td><a href="javascript:void(0)" onclick="add_installments()" ><i class="fa fa-plus"></i></a></td>
                                        </tr>
                                    </thead>
                                    <tbody id="installment_dates_container">
                                        
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <td colspan="2">Total</td>
                                            <td ><input class="form-control" type="text" name="installment_total" id="installment_total" ></td>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <button type="submit" id="enableCreate" class="btn btn-sm btn-primary mt-3" data-toggle="modal" data-target="#exampleModal" >Submit</button>
                        </div>
                        
                        
                    </form>
            </div>


            
            </section>
        </div>
    </div>
    </div>


<?php include('parts/js-files.php'); ?>

<script type="text/javascript" src="assets/js/custom/payment.js?v=<?php echo time();?>"></script> 
<script id="installment_template" type="text/template">
    <tr id="installment_{{random_id}}">
        <td><input type="text" class="form-control installment_no" name="instalment[installment_num][]" id="installmane_num_{{random_id}}" value=""></td>
        <td><input type="text" class="form-control date" name="instalment[installment_date][]" id="installment_date_{{random_id}}" readonly required></td>
        <td><input type="text" class="form-control installment_amount" name="instalment[installment_amount][]" required autocomplete="off" id="installment_amount_{{random_id}}"></td>
        <td><a href="javascript:void(0)" onclick="remove_installments({{random_id}})" ><i class="fa fa-minus"></i></a></td>
        
    </tr>
</script>
</body>

</html>