<?php

$uri=$_SERVER['REQUEST_URI'];
$url = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";

$parts = parse_url($url);
$path=$parts['path'];
?>
<div class="sidebar sidebar-hide-to-small sidebar-shrink sidebar-gestures">
        <div class="nano">
            <div class="nano-content">
                <ul>
                    <div class="logo">
						<a href="dashboard.php">
                            <img src="assets/images/logo.jpeg" width="100%" alt="" />
						</a>
                    </div>
                    <?php 
                    if(strpos($path, 'dashboard')!==false)
                    {
                        $dashboard='active';
                        $dashboard_collapse='in';
                    }
                    ?>
                    <li class="<?php echo isset($dashboard)?$dashboard:'';?>"><a href="dashboard.php"><i class="ti-home"></i> Dashboard </a></li>
                    <?php 
                    $project_open='';
                    if(strpos($path, 'new-product-vertical')!==false)
                    {
                        $new_product_vertical_open='open';
                        $new_product_vertical='active';
                        $project_open='open';
                    }
                    if(strpos($path, 'new-product-category')!==false)
                    {
                        $new_product_category_open='open';
                        $new_product_category='active';
                        $project_open='open';
                    }
                    if(strpos($path, 'new-form.php')!==false)
                    {
                        $new_form_open='open';
                        $new_form_create='active';
                        $project_open='open';
                    }
                    if(strpos($path, 'new-form-list.php')!==false)
                    {
                        $new_form_open='open';
                        $new_form_list='active';
                        $project_open='open';
                    }
                    if(strpos($path, 'new-product-subcategory.php')!==false)
                    {
                        $new_product_sub_category_open='open';
                        $new_product_category_form='active';
                        $project_open='open';
                    }
                    if(strpos($path, 'product-sub-category-list.php')!==false)
                    {
                        $new_product_sub_category_open='open';
                        $new_product_sub_category_form='active';
                        $project_open='open';
                    }
                    if(strpos($path, 'new-product-minicategory.php')!==false)
                    {
                        $new_product_mini_category_open='open';
                        $new_product_mini_category_form='active';
                        $project_open='open';
                    }
                    if(strpos($path, 'product-mini-category-list.php')!==false)
                    {
                        $new_product_mini_category_open='open';
                        $new_product_mini_category_list='active';
                        $project_open='open';
                    }
                    if(strpos($path, 'add-users.php')!==false)
                    {
                        $staff_open='open';
                        $add_users_form='active';
                        
                    }
                    if(strpos($path, 'users-list.php')!==false)
                    {
                        $staff_open='open';
                        $users_list='active';
                       
                    }
                    if(strpos($path, 'roles.php')!==false)
                    {
                        $staff_open='open';
                        $roles_list='active';
                       
                    }
                

                    if(strpos($path, 'new-product-leadcategory.php')!==false)
                    {
                        $new_product_lead_category_open='open';
                        $new_product_lead_category_form='active';
                        $project_open='open';
                    }
                    if(strpos($path, 'product-lead-category-list.php')!==false)
                    {
                        $new_product_lead_category_open='open';
                        $new_product_lead_category_list='active';
                        $project_open='open';
                    }    
                    ?>

                    <li class="<?php echo $project_open;?>"><a class="sidebar-sub-toggle"><i class="ti-layout-grid2-alt"></i> Project <span
                                class="sidebar-collapse-icon ti-angle-down"></span></a>
                        <ul>
                            <li class="<?php echo isset($new_product_vertical_open)?$new_product_vertical_open:'';?>"><a class="sidebar-sub-toggle"><i class="ti-layout-grid2-alt"></i> Product Vertical <span
                                        class="sidebar-collapse-icon ti-angle-down"></span></a>
                                <ul>
                                    <li class="hidden project_vertical_view project_vertical_add project_vertical_status <?php echo isset($new_product_vertical)?$new_product_vertical:'';?>"><a href="new-product-vertical.php">List</a></li>
                                   
                                </ul>
                            </li>
                            <li class="<?php echo isset($new_product_category_open)?$new_product_category_open:'';?>"><a class="sidebar-sub-toggle"><i class="ti-layout-grid2-alt"></i> Product Category <span
                                        class="sidebar-collapse-icon ti-angle-down"></span></a>
                                <ul>
                                    <li class="hidden project_category_add project_category_view project_category_status <?php echo isset($new_product_category)?$new_product_category:'';?>"><a href="new-product-category.php">List</a></li>
                                    
                                </ul>
                            </li>
                             <li class="<?php echo isset($new_form_open)?$new_form_open:'';?>"><a class="sidebar-sub-toggle"><i class="ti-layout-grid2-alt"></i> Forms
                                    <span class="sidebar-collapse-icon ti-angle-down"></span></a>
                                <ul>
                                    <li class="hidden project_forms_add <?php echo isset($new_form_create)?$new_form_create:'';?>"><a href="new-form.php">Create</a></li>
                                    <li class="hidden project_forms_view <?php echo isset($new_form_list)?$new_form_list:'';?>"><a href="new-form-list.php">List</a></li>
                                </ul>
                            </li>
                            <li class="<?php echo isset($new_product_sub_category_open)?$new_product_sub_category_open:'';?>"><a class="sidebar-sub-toggle"><i class="ti-layout-grid2-alt"></i> Product Sub Category
                                    <span class="sidebar-collapse-icon ti-angle-down"></span></a>
                                <ul>
                                    <li class="hidden project_sub_category_add <?php echo isset($new_product_category_form)?$new_product_category_form:'';?>"><a href="new-product-subcategory.php">Create</a></li>
                                    <li class="hidden project_sub_category_view <?php echo isset($new_product_sub_category_form)?$new_product_sub_category_form:'';?>"><a href="product-sub-category-list.php">List</a></li>
                                </ul>
                            </li>
                            <li class="<?php echo isset($new_product_mini_category_open)?$new_product_mini_category_open:'';?>"><a class="sidebar-sub-toggle"><i class="ti-layout-grid2-alt"></i> Product Mini Category
                                    <span class="sidebar-collapse-icon ti-angle-down"></span></a>
                                <ul>
                                    <li class="hidden project_mini_category_add <?php echo isset($new_product_mini_category_form)?$new_product_mini_category_form:'';?>"><a href="new-product-minicategory.php">Create</a></li>
                                    <li class="hidden project_mini_category_view <?php echo isset($new_product_mini_category_list)?$new_product_mini_category_list:'';?>"><a href="product-mini-category-list.php?form_type=1">List</a></li>
                                </ul>
                            </li>
                            <li class="<?php echo $new_product_lead_category_open??'';?>"><a class="sidebar-sub-toggle"><i class="ti-bar-chart-alt"></i> Leads <span
                                        class="sidebar-collapse-icon ti-angle-down"></span></a>
                                <ul>
                                    <li class="hidden project_mini_category_add <?php echo $new_product_lead_category_form??'';?>"><a href="new-product-leadcategory.php">Create</a></li>
                                    <li class="hidden project_mini_category_view <?php echo $new_product_lead_category_list??'';?>"><a href="product-lead-category-list.php?form_type=2">List</a></li>
                                </ul>
                            </li>
                           

                        </ul>
                    </li>
                    <!-- <li><a class="sidebar-sub-toggle"><i class="ti-user"></i> Students <span
                                class="sidebar-collapse-icon ti-angle-down"></span></a>
                        <ul>
                            <li><a href="new-student.html">New Student</a></li>
                            <li><a href="students.html">Students</a></li>
                            <li><a href="student-tiles.html">Student Titles</a></li>
                        </ul>
                    </li> -->
                    <li class="<?php echo isset($staff_open)?$staff_open:'';?>"><a class="sidebar-sub-toggle"><i class="ti-panel"></i> Staff Management <span
                                class="sidebar-collapse-icon ti-angle-down"></span></a>
                        <ul>
                            <li class="hidden user_management_add <?php echo $add_users_form??'';?>"><a href="add-users.php">Add Users</a></li>
                            <li class="hidden user_management_view user_management_edit <?php echo $users_list??'';?>"><a href="users-list.php">Staff Users</a></li>
                            <li class="hidden role_view <?php echo $roles_list??'';?>"><a href="roles.php">Roles</a></li>
                            <!-- <li><a href="permissions.html">Permissions</a></li> -->
                        </ul>
                    </li>
                    <li><a class="sidebar-sub-toggle"><i class="ti-files"></i> Invoices <span
                                class="sidebar-collapse-icon ti-angle-down"></span></a>
                        <ul>
                            <!-- <li><a href="new-invoice.html">New Invoice</a></li>
                            <li><a href="invoices.html">Invoices</a></li> -->
                        </ul>
                    </li>
                    <li><a class="sidebar-sub-toggle"><i class="ti-file"></i> Reports <span
                                class="sidebar-collapse-icon ti-angle-down"></span></a>
                        <ul>
                            <!-- <li><a href="new-report.html">New Report</a></li>
                            <li><a href="reports.html">Reports</a></li> -->
                        </ul>
                    </li>
                    <li><a href="javascript:void(0)" onclick="TRIFED.logout();"><i class="ti-close"></i> Logout</a></li>
                </ul>
            </div>
        </div>
    </div>
