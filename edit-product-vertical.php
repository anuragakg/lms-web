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

    <div class="sidebar sidebar-hide-to-small sidebar-shrink sidebar-gestures">
        <div class="nano">
            <div class="nano-content">
                <ul>
                    <div class="logo"><a href="dashboard.html">
                            <img src="assets/images/logo.jpeg" width="100%" alt="" />
                        </a></div>
                    <li><a href="dashboard.html"><i class="ti-home"></i> Dashboard </a></li>
                    
                    <li><a class="sidebar-sub-toggle"><i class="ti-layout-grid2-alt"></i> Project <span
                                class="sidebar-collapse-icon ti-angle-down"></span></a>
                        <ul>
                            <li><a class="sidebar-sub-toggle"><i class="ti-layout-grid2-alt"></i> Product Vertical <span
                                        class="sidebar-collapse-icon ti-angle-down"></span></a>
                                <ul>
                                    <li><a href="new-product-vertical.html">Create</a></li>
                                    <li><a href="edit-product-vertical.html">Edit / Delete</a></li>
                                    <li><a href="product-verticals.html">List</a></li>
                                </ul>
                            </li>
                            <li><a class="sidebar-sub-toggle"><i class="ti-layout-grid2-alt"></i> Product Category <span
                                        class="sidebar-collapse-icon ti-angle-down"></span></a>
                                <ul>
                                    <li><a href="new-product-category.html">Create</a></li>
                                    <li><a href="edit-product-category.html">Edit / Delete</a></li>
                                    <li><a href="product-categories.html">List</a></li>
                                </ul>
                            </li>
<li><a class="sidebar-sub-toggle"><i class="ti-layout-grid2-alt"></i> Product Sub Category
                                    <span class="sidebar-collapse-icon ti-angle-down"></span></a>
                                <ul>
                                    <li><a href="new-product-subcategory.html">Create</a></li>
                                    <li><a href="edit-product-subcategory.html">Edit / Delete</a></li>
                                    <li><a href="product-subcategories.html">List</a></li>
                                </ul>
                            </li>
                            <li><a class="sidebar-sub-toggle"><i class="ti-layout-grid2-alt"></i> Product Mini Category
                                <span class="sidebar-collapse-icon ti-angle-down"></span></a>
                            <ul>
                                <li><a href="new-product-minicategory.html">Create</a></li>
                                <li><a href="edit-product-minicategory.html">Edit / Delete</a></li>
                                <li><a href="product-minicategories.html">List</a></li>
                            </ul>
                        </li>
                       <li><a class="sidebar-sub-toggle"><i class="ti-bar-chart-alt"></i> Leads <span
                                class="sidebar-collapse-icon ti-angle-down"></span></a>
                        <ul>
                            <li><a href="new-lead.html">New Lead</a></li>
                            <li><a href="manage-lead.html">Manage Leads</a></li>
                            <li><a href="lead-source.html">Lead Sources</a></li>
                            <li><a href="lead-status.html">Lead Statuses</a></li>
                        </ul>
                    </li>
                    <li><a class="sidebar-sub-toggle"><i class="ti-layout-grid2-alt"></i> Forms
                        <span class="sidebar-collapse-icon ti-angle-down"></span></a>
                    <ul>
                        <li><a href="new-form.html">Create</a></li>
                        <li><a href="edit-form.html">Edit / Delete</a></li>
                        <li><a href="forms.html">List</a></li>
                    </ul>
                </li>

                        </ul>
                    </li>
                    <li><a class="sidebar-sub-toggle"><i class="ti-user"></i> Students <span
                                class="sidebar-collapse-icon ti-angle-down"></span></a>
                        <ul>
                            <li><a href="new-student.html">New Student</a></li>
                            <li><a href="students.html">Students</a></li>
                            <li><a href="student-tiles.html">Student Titles</a></li>
                        </ul>
                    </li>
                    <li><a class="sidebar-sub-toggle"><i class="ti-panel"></i> Staff Management <span
                                class="sidebar-collapse-icon ti-angle-down"></span></a>
                        <ul>
                            <li><a href="new-user.html">Staff Users</a></li>
                            <li><a href="roles.html">Roles</a></li>
                            <li><a href="permissions.html">Permissions</a></li>
                        </ul>
                    </li>
                    <li><a class="sidebar-sub-toggle"><i class="ti-files"></i> Invoices <span
                                class="sidebar-collapse-icon ti-angle-down"></span></a>
                        <ul>
                            <li><a href="new-invoice.html">New Invoice</a></li>
                            <li><a href="invoices.html">Invoices</a></li>
                        </ul>
                    </li>
                    <li><a class="sidebar-sub-toggle"><i class="ti-file"></i> Reports <span
                                class="sidebar-collapse-icon ti-angle-down"></span></a>
                        <ul>
                            <li><a href="new-report.html">New Report</a></li>
                            <li><a href="reports.html">Reports</a></li>
                        </ul>
                    </li>
                    <li><a href="index.html"><i class="ti-close"></i> Logout</a></li>
                </ul>
            </div>
        </div>
    </div>
    <!-- /# sidebar -->

    <div class="header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="float-left">
                        <div class="hamburger sidebar-toggle">
                            <span class="line"></span>
                            <span class="line"></span>
                            <span class="line"></span>
                        </div>
                    </div>
                    <div class="float-right">
                        <div class="dropdown dib">
                            <div class="header-icon" data-toggle="dropdown">
                                <i class="ti-bell"></i>
                                <div class="drop-down dropdown-menu dropdown-menu-right">
                                    <div class="dropdown-content-heading">
                                        <span class="text-left">Recent Notifications</span>
                                    </div>
                                    <div class="dropdown-content-body">
                                        <ul>
                                            <li>
                                                <a href="#">
                                                    <img class="pull-left m-r-10 avatar-img"
                                                        src="assets/images/avatar/3.jpg" alt="" />
                                                    <div class="notification-content">
                                                        <small class="notification-timestamp pull-right">02:34
                                                            PM</small>
                                                        <div class="notification-heading">Mr. John</div>
                                                        <div class="notification-text">5 members joined today </div>
                                                    </div>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="#">
                                                    <img class="pull-left m-r-10 avatar-img"
                                                        src="assets/images/avatar/3.jpg" alt="" />
                                                    <div class="notification-content">
                                                        <small class="notification-timestamp pull-right">02:34
                                                            PM</small>
                                                        <div class="notification-heading">Mariam</div>
                                                        <div class="notification-text">likes a photo of you</div>
                                                    </div>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="#">
                                                    <img class="pull-left m-r-10 avatar-img"
                                                        src="assets/images/avatar/3.jpg" alt="" />
                                                    <div class="notification-content">
                                                        <small class="notification-timestamp pull-right">02:34
                                                            PM</small>
                                                        <div class="notification-heading">Tasnim</div>
                                                        <div class="notification-text">Hi Teddy, Just wanted to let you
                                                            ...</div>
                                                    </div>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="#">
                                                    <img class="pull-left m-r-10 avatar-img"
                                                        src="assets/images/avatar/3.jpg" alt="" />
                                                    <div class="notification-content">
                                                        <small class="notification-timestamp pull-right">02:34
                                                            PM</small>
                                                        <div class="notification-heading">Mr. John</div>
                                                        <div class="notification-text">Hi Teddy, Just wanted to let you
                                                            ...</div>
                                                    </div>
                                                </a>
                                            </li>
                                            <li class="text-center">
                                                <a href="#" class="more-link">See All</a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="dropdown dib">
                            <div class="header-icon" data-toggle="dropdown">
                                <i class="ti-email"></i>
                                <div class="drop-down dropdown-menu dropdown-menu-right">
                                    <div class="dropdown-content-heading">
                                        <span class="text-left">2 New Messages</span>
                                        <a href="email.html">
                                            <i class="ti-pencil-alt pull-right"></i>
                                        </a>
                                    </div>
                                    <div class="dropdown-content-body">
                                        <ul>
                                            <li class="notification-unread">
                                                <a href="#">
                                                    <img class="pull-left m-r-10 avatar-img"
                                                        src="assets/images/avatar/1.jpg" alt="" />
                                                    <div class="notification-content">
                                                        <small class="notification-timestamp pull-right">02:34
                                                            PM</small>
                                                        <div class="notification-heading">Michael Qin</div>
                                                        <div class="notification-text">Hi Teddy, Just wanted to let you
                                                            ...</div>
                                                    </div>
                                                </a>
                                            </li>
                                            <li class="notification-unread">
                                                <a href="#">
                                                    <img class="pull-left m-r-10 avatar-img"
                                                        src="assets/images/avatar/2.jpg" alt="" />
                                                    <div class="notification-content">
                                                        <small class="notification-timestamp pull-right">02:34
                                                            PM</small>
                                                        <div class="notification-heading">Mr. John</div>
                                                        <div class="notification-text">Hi Teddy, Just wanted to let you
                                                            ...</div>
                                                    </div>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="#">
                                                    <img class="pull-left m-r-10 avatar-img"
                                                        src="assets/images/avatar/3.jpg" alt="" />
                                                    <div class="notification-content">
                                                        <small class="notification-timestamp pull-right">02:34
                                                            PM</small>
                                                        <div class="notification-heading">Michael Qin</div>
                                                        <div class="notification-text">Hi Teddy, Just wanted to let you
                                                            ...</div>
                                                    </div>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="#">
                                                    <img class="pull-left m-r-10 avatar-img"
                                                        src="assets/images/avatar/2.jpg" alt="" />
                                                    <div class="notification-content">
                                                        <small class="notification-timestamp pull-right">02:34
                                                            PM</small>
                                                        <div class="notification-heading">Mr. John</div>
                                                        <div class="notification-text">Hi Teddy, Just wanted to let you
                                                            ...</div>
                                                    </div>
                                                </a>
                                            </li>
                                            <li class="text-center">
                                                <a href="#" class="more-link">See All</a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="dropdown dib">
                            <div class="header-icon" data-toggle="dropdown">
                                <span class="user-avatar">Asmita Patel
                                    <i class="ti-angle-down f-s-10"></i>
                                </span>
                                <div class="drop-down dropdown-profile dropdown-menu dropdown-menu-right">
                                    <div class="dropdown-content-body">
                                        <ul>
                                            <li>
                                                <a href="profile.html">
                                                    <i class="ti-user"></i>
                                                    <span>Profile</span>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="setting.html">
                                                    <i class="ti-settings"></i>
                                                    <span>Setting</span>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="index.html">
                                                    <i class="ti-power-off"></i>
                                                    <span>Logout</span>
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="content-wrap">
        <div class="main">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-8 p-r-0 title-margin-right">
                        <div class="page-header">
                            <div class="page-title">
                                <h1>Product Vertical Search </h1>
                            </div>
                        </div>
                    </div>
                    <!-- /# column -->
                    <div class="col-lg-4 p-l-0 title-margin-left">
                        <div class="page-header">
                            <div class="page-title">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="projects.html">Project</a></li>
                                    <li class="breadcrumb-item active">Search Vertical</li>
                                </ol>
                            </div>
                        </div>
                    </div>
                    <!-- /# column -->
                </div>
                <!-- /# row -->
                <section id="main-content">

                    <div class="row">
                        <div class="col-md-7">
                            <div class="form">
                                <label for=""> </label>
                                <input type="text" id="filter-text-box" class="form-control form-control-sm"
                                    placeholder="Product Vertical Name..." oninput="onFilterTextBoxChanged()">
                            </div>
                        </div>
                        <div class="col-md-5 d-flex align-items-end">
                        </div>
                        <div class="col-md-12 mt-3">
                            <h6 class="w-100">List of Existing Product Vertical </h6>
                            <div id="myGrid" style="height: 500px; width:100%;" class="ag-theme-alpine"></div>
                        </div>
                    </div>
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
                    <h5 class="modal-title" id="exampleModalLabel">Delete Product Vertical </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-4">Vertical Name: </div>
                            <div class="col-md-8 text-secondary"><strong id="nameChange">Education</strong></div>
                        </div>
                        <div class="row mt-3">
                            <div class="col">
                                <h6 class="text-danger">Are you sure you want to delete the Vertical Name? </h6>

                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Yes, Delete it</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Product Vertical </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-5">Product Vertical: </div>
                            <div class="col-md-7 text-secondary"><strong id="nameDelChange">Education</strong></div>
                        </div>
                        <div class="row">
                            <div class="col-md-5">Product Vertical Rename: </div>
                            <div class="col-md-7 text-secondary">
                                <div class="form">
                                    <input type="text" name="name" placeholder="Enter Product Vertical"  id="allowalpha"
                                        class="form-control form-control-sm" pattern="[A-Za-z0-9]+" required="">
                                    <div id="nameValidate" class="mt-2 w-100" style="font-size: 10px;"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-warning" data-dismiss="modal" id="enableCreate" disabled>Update Product Vertical</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                </div>
            </div>
        </div>
    </div>

    <!-- jquery vendor -->
    <script src="assets/js/lib/jquery.min.js"></script>
    <script src="assets/js/lib/jquery.nanoscroller.min.js"></script>
    <!-- nano scroller -->
    <script src="assets/js/lib/menubar/sidebar.js"></script>
    <script src="assets/js/lib/preloader/pace.min.js"></script>
    <!-- sidebar -->

    <script src="assets/js/lib/bootstrap.min.js"></script>
    <script src="assets/js/scripts.js"></script>
    <!-- bootstrap -->

    <script src="assets/js/lib/calendar-2/moment.latest.min.js"></script>
    <script src="assets/js/lib/calendar-2/pignose.calendar.min.js"></script>
    <script src="assets/js/lib/calendar-2/pignose.init.js"></script>


    <script src="assets/js/lib/weather/jquery.simpleWeather.min.js"></script>
    <script src="assets/js/lib/weather/weather-init.js"></script>
    <script src="assets/js/lib/circle-progress/circle-progress.min.js"></script>
    <script src="assets/js/lib/circle-progress/circle-progress-init.js"></script>
    <script src="assets/js/lib/chartist/chartist.min.js"></script>
    <script src="assets/js/lib/sparklinechart/jquery.sparkline.min.js"></script>
    <script src="assets/js/lib/sparklinechart/sparkline.init.js"></script>
    <script src="assets/js/lib/owl-carousel/owl.carousel.min.js"></script>
    <script src="assets/js/lib/owl-carousel/owl.carousel-init.js"></script>
    <!-- scripit init-->
    <script src="assets/js/dashboard2.js"></script>
    <script src="https://unpkg.com/@ag-grid-enterprise/all-modules@26.2.0/dist/ag-grid-enterprise.min.js"></script>
    <script>
$(document).ready(function () {
            $("#allowalpha").each(function () {
                $(this).blur(function (e) {
                    if (Validate(this.id)) {
                        $("#nameValidate").text('Product Vertical is Available');
                        $("#nameValidate").css("color", "green");
                        $("#enableCreate").prop('disabled', false);

                    } else {
                        $("#nameValidate").text(
                            'Only Alphabet, Spaces and numbers to be allowed');
                        $("#nameValidate").css("color", "red");
                        $("#enableCreate").prop('disabled', true);
                    }
                });
            });

            function Validate(evt) {
                var isValid = false;
                var regex = /^([\s\.]?[a-zA-Z]+)+$/;
                isValid = regex.test($("#" + evt).val());
                return isValid;
            }
        });
        function onFilterTextBoxChanged() {
            gridOptions.api.setQuickFilter(document.getElementById('filter-text-box').value);
        }
        var columnDefs = [{
                headerName: "Names",
                field: "names",
                width: 130
            },
            {
                headerName: "Created Date",
                field: "createdDate",
                width: 135
            },
            {
                headerName: "Initiated By",
                field: "initiatedby",
                width: 125

            },
            {
                headerName: "Updated Date",
                field: "updatedate",
                width: 140
            },
            {
                headerName: "Updated By",
                field: "updatedby",
                width: 130
            },
            {
                headerName: "Status",
                field: "approvalStatus",
                width: 135,
                cellStyle: params => {
                    if (params.value === 'Approved') {
                        //mark police cells as red
                        return {
                            color: 'green',
                            fontWeight: 'bold'
                        };
                    } else{
                        return {
                            color: 'orange'
                        };
                    }
                    return null;
                }
            },
            {
                headerName: 'Actions',
                field: 'status',
                resizable: true,
                suppressAutoSize: true,
                cellRenderer: function (params) {
                    //for making cell as link
                    return `<a type='button' class='btn btn-sm text-primary' data-toggle='modal' data-target='#editModal' onclick="editFeature('${params.data.names}')"><span class='ti-pencil'></span>&nbsp;Edit</a>
                    <a type='button' class='btn btn-sm text-danger' data-toggle='modal' data-target='#exampleModal' onclick="editFeature('${params.data.names}')"><span class='ti-trash'></span>&nbsp;Delete</a>`;
                },
            }

        ];
        // specify the data
        var rowData = [{
                names: "Education",
                createdDate: "12/01/2022",
                initiatedby: "Tripti",
                updatedate: "-",
                updatedby: "-",
                approvalStatus: "Approved",
                edit: function () {
                    return ""
                }
            }, {
                names: "Trade Live With AP",
                createdDate: "12/01/2022",
                initiatedby: "Bejel",
                updatedate: "13/01/2022",
                updatedby: "Tripti",
                approvalStatus: "Pending: L2,L3",
            }, {
                names: "Price Alert",
                createdDate: "12/01/2022",
                initiatedby: "Tripti",
                updatedate: "14/01/2022",
                updatedby: "Rasila",
                approvalStatus: "Approved",
            },
            {
                names: "Book",
                createdDate: "13/01/2022",
                initiatedby: "Rasila",
                updatedate: "14/01/2022",
                updatedby: "Rasila",
                approvalStatus: "Pending: L3",
            },
            {
                names: "Software",
                createdDate: "15/01/2022",
                initiatedby: "Bejel",
                updatedate: "-",
                updatedby: "-",
                approvalStatus: "Approved",
            }
        ];

        // let the grid know which columns and what data to use
        var gridOptions = {
            columnDefs: columnDefs,
            rowData: rowData,
            defaultColDef: {
                sortable: true,
                filter: true,
            },
        };

        // setup the grid after the page has finished loading
        document.addEventListener('DOMContentLoaded', function () {
            var gridDiv = document.querySelector('#myGrid');
            new agGrid.Grid(gridDiv, gridOptions);
        });

        function editFeature(name){
            $("#nameChange").text(name);
            $("#nameDelChange").text(name);
        }
    </script>
</body>

</html>