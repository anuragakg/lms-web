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
                                <h1>Payment Installation </h1>
                            </div>
                        </div>
                    </div>
                    <!-- /# column -->
                    <div class="col-lg-4 p-l-0 title-margin-left">
                        <div class="page-header">
                            <div class="page-title">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="social_leads.php">Leads</a></li>
                                    <li class="breadcrumb-item active">Payment Installation </li>
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
                                    <label for="" >User Name</label>
                                    <p id="user_name"></p>
                                </div>
                                
                            </div>
                            <div class="col-md-5 d-flex">
                                <div class="form">
                                    <label for="" >Email</label>
                                    <p id="email_id"></p>
                                </div>

                            </div>
                            <div class="col-md-5 d-flex">
                                <div class="form">
                                    <label for="" > Program</label>
                                    <p id="programme"></p>
                                </div>
                            </div>
                            <div class="col-md-5 d-flex">
                                <div class="form">
                                    <label for="" >Fund Receivable</label>
                                    <p for="" id="fund_receivable">0</p>
                                </div>
                                
                            </div>
                            <div class="col-md-5 d-flex">
                                <div class="form">
                                    <label for="">Fund Received</label>
                                    <p  id="fund_received"></p>
                                </div>
                                
                            </div>
                            <div class="col-md-5 d-flex">
                                <div class="form">
                                    <label for="" >Balance Amount</label>
                                    <p id="balance_amount"></p>
                                </div>
                            </div>
                        </div>
                        
                        <h5>Fee Details</h5>
                        <div class="row">
                            
                            <div class="col-md-12">
                                

                                
                                <div class="row">
                                            
                                    <div class="col-md-6">
                                        <label for="scales">Gross Payable</label> 
                                        <p id="gross_payable"></p>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="scales">Exemption</label> 
                                        <p id="exemption" ></p>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="scales">Base Fee</label> 
                                        <p id="base_fee" ></p>
                                    </div>
                                    
                                    <div class="col-md-6">
                                        <label for="scales">Net Base fee</label> 
                                        <p id="net_base_fee" ></p>
                                    </div>
                                        
                                </div>
                                
                            </div>
                        </div>    
                        <h5>Installment</h5>
                        <div class="row">
                            <div id="">
                                <table class="  ">
                                    <thead>
                                        <tr>
                                            <td>Installment</td>
                                            <td>Date</td>
                                            <td>Amount</td>
                                            <td>W Fees</td>
                                            <td>GST</td>
                                            <td>Total Received</td>
                                            <td>M.O.P</td>
                                            <td>Received By</td>
                                            <td>Received Date</td>
                                            
                                        </tr>
                                    </thead>
                                    <tbody id="installment_dates_container">
                                        
                                    </tbody>
                                    <!-- <tfoot>
                                        <tr>
                                            <td colspan="2">Total</td>
                                            <td ><input class="form-control" type="text" name="installment_total" id="installment_total" ></td>
                                        </tr>
                                    </tfoot> -->
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

<script type="text/javascript" src="assets/js/custom/installment_payment.js?v=<?php echo time();?>"></script> 
<script id="installment_template" type="text/template">
    <tr id="installment_{{random_id}}">
        <td><input type="text" class="form-control installment_no" name="instalment[installment_num][{{data.id}}]" id="installmane_num_{{random_id}}" value="{{data.installment_num}}" readonly></td>
        <td><input type="text" class="form-control "  id="installment_date_{{random_id}}" readonly value="{{data.installment_date}}" ></td>
        <td><input type="text" class="form-control installment_amount"  id="installment_amount_{{random_id}}" value="{{data.installment_amount}}" readonly></td>

        <td><input type="text" name="w_fee[{{data.id}}]" class="form-control "  id="w_fee_{{random_id}}" onkeyup="check_total_received({{random_id}})" value="{{data.w_fee}}"></td>
        <td><input type="text" value="{{gst}}" name="gst[{{data.id}}]" class="form-control " onkeyup="check_total_received({{random_id}})" readonly id="gst_{{random_id}}" ></td>
        <td><input type="text" value="{{data.total_received}}" name="total_received[{{data.id}}]" class="form-control "  id="total_received_{{random_id}}" readonly value="0"></td>
        <td>
            <select name="mop[{{data.id}}]" class="form-control "  id="mop_{{random_id}}" >
                <option value="">Select MOP</option>
                <option value="GPay">GPay</option>
                <option value="Paytm">Paytm</option>
                <option value="BhimUpi">Bhim Upi</option>
                <option value="Cash">Cash</option>
                <option value="Cheque">Cheque</option>
            </select>
        </td>
        <td><input type="text" name="received_by[{{data.id}}]" class="form-control "  id="received_by_{{random_id}}" value="{{data.received_by}}"></td>
        <td><input type="text" value="{{data.received_date}}" name="received_date[{{data.id}}]" class="form-control "  id="received_date_{{random_id}}" ></td>
       
        
    </tr>
</script>
</body>

</html>