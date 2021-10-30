<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
        <title>Open Data - Karawang</title>
        <meta content="Admin Dashboard" name="description" />
        <meta content="Themesbrand" name="author" />
        <link rel="shortcut icon" href="assets/images/favicon.ico">

        <link rel="stylesheet" href="assets/plugins/morris/morris.css">

        <link href="assets/css/bootstrap.min.css" rel="stylesheet" type="text/css">
        <link href="assets/css/metismenu.min.css" rel="stylesheet" type="text/css">
        <link href="assets/css/icons.css" rel="stylesheet" type="text/css">
        <link href="assets/css/style.css" rel="stylesheet" type="text/css">
    </head>

    <body>

        <!-- Begin page -->
        <div id="wrapper">

            <!-- Top Bar Start -->
            <div class="topbar">

                <!-- LOGO -->
                <div class="topbar-left">
                    <a href="index.html" class="logo">
                        <span>
                            <img src="assets/images/logo-light.png" alt="" height="18">
                        </span>
                        <i>
                            <img src="assets/images/logo-sm.png" alt="" height="22">
                        </i>
                    </a>
                </div>

                <nav class="navbar-custom">

                    <ul class="navbar-right d-flex list-inline float-right mb-0">
                        <li class="dropdown notification-list d-none d-sm-block">
                            <form role="search" class="app-search">
                                <div class="form-group mb-0"> 
                                    <input type="text" class="form-control" placeholder="Search..">
                                    <button type="submit"><i class="fa fa-search"></i></button>
                                </div>
                            </form> 
                        </li>

                        <li class="dropdown notification-list">
                            <a class="nav-link dropdown-toggle arrow-none waves-effect" data-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                                <i class="ti-bell noti-icon"></i>
                                <span class="badge badge-pill badge-danger noti-icon-badge">3</span>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right dropdown-menu-lg">
                                <!-- item-->
                                <h6 class="dropdown-item-text">
                                    Notifications (258)
                                </h6>
                                <div class="slimscroll notification-item-list">
                                    <!-- item-->
                                    <a href="javascript:void(0);" class="dropdown-item notify-item active">
                                        <div class="notify-icon bg-success"><i class="mdi mdi-cart-outline"></i></div>
                                        <p class="notify-details">Your order is placed<span class="text-muted">Dummy text of the printing and typesetting industry.</span></p>
                                    </a>
                                    <!-- item-->
                                    <a href="javascript:void(0);" class="dropdown-item notify-item">
                                        <div class="notify-icon bg-warning"><i class="mdi mdi-message"></i></div>
                                        <p class="notify-details">New Message received<span class="text-muted">You have 87 unread messages</span></p>
                                    </a>
                                    <!-- item-->
                                    <a href="javascript:void(0);" class="dropdown-item notify-item">
                                        <div class="notify-icon bg-info"><i class="mdi mdi-martini"></i></div>
                                        <p class="notify-details">Your item is shipped<span class="text-muted">It is a long established fact that a reader will</span></p>
                                    </a>
                                    <!-- item-->
                                    <a href="javascript:void(0);" class="dropdown-item notify-item">
                                        <div class="notify-icon bg-primary"><i class="mdi mdi-cart-outline"></i></div>
                                        <p class="notify-details">Your order is placed<span class="text-muted">Dummy text of the printing and typesetting industry.</span></p>
                                    </a>
                                    <!-- item-->
                                    <a href="javascript:void(0);" class="dropdown-item notify-item">
                                        <div class="notify-icon bg-danger"><i class="mdi mdi-message"></i></div>
                                        <p class="notify-details">New Message received<span class="text-muted">You have 87 unread messages</span></p>
                                    </a>
                                </div>
                                <!-- All-->
                                <a href="javascript:void(0);" class="dropdown-item text-center text-primary">
                                    View all <i class="fi-arrow-right"></i>
                                </a>
                            </div>        
                        </li>
                        <li class="dropdown notification-list">
                            <div class="dropdown notification-list nav-pro-img">
                                <a class="dropdown-toggle nav-link arrow-none waves-effect nav-user" data-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                                    <img src="assets/images/users/user-4.jpg" alt="user" class="rounded-circle">
                                </a>
                                <div class="dropdown-menu dropdown-menu-right profile-dropdown ">
                                    <!-- item-->
                                    <a class="dropdown-item" href="#"><i class="mdi mdi-account-circle m-r-5"></i> Profile</a>
                                    <a class="dropdown-item" href="#"><i class="mdi mdi-wallet m-r-5"></i> My Wallet</a>
                                    <a class="dropdown-item d-block" href="#"><span class="badge badge-success float-right">11</span><i class="mdi mdi-settings m-r-5"></i> Settings</a>
                                    <a class="dropdown-item" href="#"><i class="mdi mdi-lock-open-outline m-r-5"></i> Lock screen</a>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item text-danger" href="#"><i class="mdi mdi-power text-danger"></i> Logout</a>
                                </div>                                                                    
                            </div>
                        </li>

                    </ul>

                    <ul class="list-inline menu-left mb-0">
                        <li class="float-left">
                            <button class="button-menu-mobile open-left waves-effect">
                                <i class="mdi mdi-menu"></i>
                            </button>
                        </li>
                        <li class="d-none d-sm-block">
                            <div class="dropdown pt-3 d-inline-block">
                                <a class="btn btn-light dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    Create
                                </a>
                                
                                <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                    <a class="dropdown-item" href="#">Action</a>
                                    <a class="dropdown-item" href="#">Another action</a>
                                    <a class="dropdown-item" href="#">Something else here</a>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item" href="#">Separated link</a>
                                </div>
                            </div>
                        </li>
                    </ul>

                </nav>

            </div>
            <!-- Top Bar End -->

            <!-- ========== Left Sidebar Start ========== -->
            <div class="left side-menu">
                <div class="slimscroll-menu" id="remove-scroll">

                    <!--- Sidemenu -->
                    <div id="sidebar-menu">
                        <!-- Left Menu Start -->
                        <ul class="metismenu" id="side-menu">
                            <li class="menu-title">Main</li>
                            <li>
                                <a href="index.html" class="waves-effect">
                                    <i class="mdi mdi-view-dashboard"></i><span class="badge badge-primary badge-pill float-right">2</span> <span> Dashboard </span>
                                </a>
                            </li>
                            <li>
                                <a href="calendar.html" class="waves-effect"><i class="mdi mdi-calendar-check"></i><span> Calendar </span></a>
                            </li>

                            <li>
                                <a href="javascript:void(0);" class="waves-effect"><i class="mdi mdi-email-outline"></i><span> Email <span class="float-right menu-arrow"><i class="mdi mdi-chevron-right"></i></span> </span></a>
                                <ul class="submenu">
                                    <li><a href="email-inbox.html">Inbox</a></li>
                                    <li><a href="email-read.html">Email Read</a></li>
                                    <li><a href="email-compose.html">Email Compose</a></li>
                                </ul>
                            </li>

                            <li class="menu-title">Components</li>

                            <li>
                                <a href="javascript:void(0);" class="waves-effect"><i class="mdi mdi-buffer"></i> <span> UI Elements <span class="float-right menu-arrow"><i class="mdi mdi-chevron-right"></i></span> </span> </a>
                                <ul class="submenu">
                                    <li><a href="ui-alerts.html">Alerts</a></li>
                                    <li><a href="ui-buttons.html">Buttons</a></li>
                                    <li><a href="ui-badge.html">Badge</a></li>
                                    <li><a href="ui-cards.html">Cards</a></li>
                                    <li><a href="ui-carousel.html">Carousel</a></li>
                                    <li><a href="ui-dropdowns.html">Dropdowns</a></li>
                                    <li><a href="ui-grid.html">Grid</a></li>
                                    <li><a href="ui-images.html">Images</a></li>
                                    <li><a href="ui-lightbox.html">Lightbox</a></li>
                                    <li><a href="ui-modals.html">Modals</a></li>
                                    <li><a href="ui-pagination.html">Pagination</a></li>
                                    <li><a href="ui-popover-tooltips.html">Popover & Tooltips</a></li>
                                    <li><a href="ui-rangeslider.html">Range Slider</a></li>
                                    <li><a href="ui-session-timeout.html">Session Timeout</a></li>
                                    <li><a href="ui-progressbars.html">Progress Bars</a></li>
                                    <li><a href="ui-sweet-alert.html">Sweet-Alert</a></li>
                                    <li><a href="ui-tabs-accordions.html">Tabs & Accordions</a></li>
                                    <li><a href="ui-typography.html">Typography</a></li>
                                    <li><a href="ui-video.html">Video</a></li>


                                </ul>
                            </li>

                            <li>
                                <a href="javascript:void(0);" class="waves-effect"><i class="mdi mdi-clipboard-outline"></i><span> Forms <span class="badge badge-pill badge-success float-right">6</span> </span></a>
                                <ul class="submenu">
                                    <li><a href="form-elements.html">Form Elements</a></li>
                                    <li><a href="form-validation.html">Form Validation</a></li>
                                    <li><a href="form-advanced.html">Form Advanced</a></li>
                                    <li><a href="form-editors.html">Form Editors</a></li>
                                    <li><a href="form-uploads.html">Form File Upload</a></li>
                                    <li><a href="form-xeditable.html">Form Xeditable</a></li>

                                </ul>
                            </li>

                            <li>
                                <a href="javascript:void(0);" class="waves-effect"><i class="mdi mdi-chart-line"></i><span> Charts <span class="float-right menu-arrow"><i class="mdi mdi-chevron-right"></i></span> </span></a>
                                <ul class="submenu">
                                    <li><a href="charts-morris.html">Morris Chart</a></li>
                                    <li><a href="charts-chartist.html">Chartist Chart</a></li>
                                    <li><a href="charts-chartjs.html">Chartjs Chart</a></li>
                                    <li><a href="charts-flot.html">Flot Chart</a></li>
                                    <li><a href="charts-c3.html">C3 Chart</a></li>
                                    <li><a href="charts-other.html">Jquery Knob Chart</a></li>
                                </ul>
                            </li>

                            <li>
                                <a href="javascript:void(0);" class="waves-effect"><i class="mdi mdi-format-list-bulleted-type"></i><span> Tables <span class="float-right menu-arrow"><i class="mdi mdi-chevron-right"></i></span> </span></a>
                                <ul class="submenu">
                                    <li><a href="tables-basic.html">Basic Tables</a></li>
                                    <li><a href="tables-datatable.html">Data Table</a></li>
                                    <li><a href="tables-responsive.html">Responsive Table</a></li>
                                    <li><a href="tables-editable.html">Editable Table</a></li>
                                </ul>
                            </li>

                            <li>
                                <a href="javascript:void(0);" class="waves-effect"><i class="mdi mdi-album"></i> <span> Icons  <span class="float-right menu-arrow"><i class="mdi mdi-chevron-right"></i></span></span> </a>
                                <ul class="submenu">
                                    <li><a href="icons-material.html">Material Design</a></li>
                                    <li><a href="icons-ion.html">Ion Icons</a></li>
                                    <li><a href="icons-fontawesome.html">Font Awesome</a></li>
                                    <li><a href="icons-themify.html">Themify Icons</a></li>
                                    <li><a href="icons-dripicons.html">Dripicons</a></li>
                                    <li><a href="icons-typicons.html">Typicons Icons</a></li>
                                </ul>
                            </li>

                            <li>
                                <a href="javascript:void(0);" class="waves-effect"><i class="mdi mdi-google-maps"></i><span> Maps <span class="badge badge-pill badge-danger float-right">2</span> </span></a>
                                <ul class="submenu">
                                    <li><a href="maps-google.html"> Google Map</a></li>
                                    <li><a href="maps-vector.html"> Vector Map</a></li>
                                </ul>
                            </li>

                            <li class="menu-title">Extras</li>

                            <li>
                                <a href="javascript:void(0);" class="waves-effect"><i class="mdi mdi-account-location"></i><span> Authentication <span class="float-right menu-arrow"><i class="mdi mdi-chevron-right"></i></span> </span></a>
                                <ul class="submenu">
                                    <li><a href="pages-login.html">Login</a></li>
                                    <li><a href="pages-register.html">Register</a></li>
                                    <li><a href="pages-recoverpw.html">Recover Password</a></li>
                                    <li><a href="pages-lock-screen.html">Lock Screen</a></li>
                                </ul>
                            </li>

                            <li>
                                <a href="javascript:void(0);" class="waves-effect"><i class="mdi mdi-google-pages"></i><span> Extra Pages <span class="float-right menu-arrow"><i class="mdi mdi-chevron-right"></i></span> </span></a>
                                <ul class="submenu">
                                    <li><a href="pages-timeline.html">Timeline</a></li>
                                    <li><a href="pages-invoice.html">Invoice</a></li>
                                    <li><a href="pages-directory.html">Directory</a></li>
                                    <li><a href="pages-blank.html">Blank Page</a></li>
                                    <li><a href="pages-404.html">Error 404</a></li>
                                    <li><a href="pages-500.html">Error 500</a></li>
                                </ul>
                            </li>

                        </ul>

                    </div>
                    <!-- Sidebar -->
                    <div class="clearfix"></div>

                </div>
                <!-- Sidebar -left -->

            </div>
            <!-- Left Sidebar End -->

            <!-- ============================================================== -->
            <!-- Start right Content here -->
            <!-- ============================================================== -->
            <div class="content-page">
                <!-- Start content -->
                <div class="content">
                    <div class="container-fluid">

                        <div class="row">
                            <div class="col-sm-12">
                                <div class="page-title-box">
                                    <h4 class="page-title">Dashboard</h4>
                                    <ol class="breadcrumb">
                                        <li class="breadcrumb-item active">
                                            Welcome to Lexa Dashboard
                                        </li>
                                    </ol>
                                    <div class="state-information d-none d-sm-block">
                                        <div class="state-graph">
                                            <div id="header-chart-1"></div>
                                            <div class="info">Balance $ 2,317</div>
                                        </div>
                                        <div class="state-graph">
                                            <div id="header-chart-2"></div>
                                            <div class="info">Item Sold 1230</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- end row -->

                        <div class="row">
                                <div class="col-xl-3 col-md-6">
                                    <div class="card mini-stat bg-primary">
                                        <div class="card-body mini-stat-img">
                                            <div class="mini-stat-icon">
                                                <i class="mdi mdi-cube-outline float-right"></i>
                                            </div>
                                            <div class="text-white">
                                                <h6 class="text-uppercase mb-3">Orders</h6>
                                                <h4 class="mb-4">1,587</h4>
                                                <span class="badge badge-info"> +11% </span> <span class="ml-2">From previous period</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-3 col-md-6">
                                    <div class="card mini-stat bg-primary">
                                        <div class="card-body mini-stat-img">
                                            <div class="mini-stat-icon">
                                                <i class="mdi mdi-buffer float-right"></i>
                                            </div>
                                            <div class="text-white">
                                                <h6 class="text-uppercase mb-3">Revenue</h6>
                                                <h4 class="mb-4">$46,782</h4>
                                                <span class="badge badge-danger"> -29% </span> <span class="ml-2">From previous period</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-3 col-md-6">
                                    <div class="card mini-stat bg-primary">
                                        <div class="card-body mini-stat-img">
                                            <div class="mini-stat-icon">
                                                <i class="mdi mdi-tag-text-outline float-right"></i>
                                            </div>
                                            <div class="text-white">
                                                <h6 class="text-uppercase mb-3">Average Price</h6>
                                                <h4 class="mb-4">$15.9</h4>
                                                <span class="badge badge-warning"> 0% </span> <span class="ml-2">From previous period</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-3 col-md-6">
                                    <div class="card mini-stat bg-primary">
                                        <div class="card-body mini-stat-img">
                                            <div class="mini-stat-icon">
                                                <i class="mdi mdi-briefcase-check float-right"></i>
                                            </div>
                                            <div class="text-white">
                                                <h6 class="text-uppercase mb-3">Product Sold</h6>
                                                <h4 class="mb-4">1890</h4>
                                                <span class="badge badge-info"> +89% </span> <span class="ml-2">From previous period</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- end row -->
            
                            <div class="row">
            
                                <div class="col-xl-3">
                                    <div class="card m-b-20">
                                        <div class="card-body">
                                            <h4 class="mt-0 header-title">Monthly Earnings</h4>
            
                                            <div class="row text-center m-t-20">
                                                <div class="col-6">
                                                    <h5 class="">$56241</h5>
                                                    <p class="text-muted">Marketplace</p>
                                                </div>
                                                <div class="col-6">
                                                    <h5 class="">$23651</h5>
                                                    <p class="text-muted">Total Income</p>
                                                </div>
                                            </div>
            
                                            <div id="morris-donut-example" class="dashboard-charts morris-charts"></div>
                                        </div>
                                    </div>
                                </div>
            
                                <div class="col-xl-6">
                                    <div class="card m-b-20">
                                        <div class="card-body">
                                            <h4 class="mt-0 header-title">Email Sent</h4>
            
                                            <div class="row text-center m-t-20">
                                                <div class="col-4">
                                                    <h5 class="">$ 89425</h5>
                                                    <p class="text-muted">Marketplace</p>
                                                </div>
                                                <div class="col-4">
                                                    <h5 class="">$ 56210</h5>
                                                    <p class="text-muted">Total Income</p>
                                                </div>
                                                <div class="col-4">
                                                    <h5 class="">$ 8974</h5>
                                                    <p class="text-muted">Last Month</p>
                                                </div>
                                            </div>
            
                                            <div id="morris-area-example" class="dashboard-charts morris-charts"></div>
                                        </div>
                                    </div>
                                </div>
            
                                <div class="col-xl-3">
                                    <div class="card m-b-20">
                                        <div class="card-body">
                                            <h4 class="mt-0 header-title">Monthly Earnings</h4>
            
                                            <div class="row text-center m-t-20">
                                                <div class="col-6">
                                                    <h5 class="">$ 2548</h5>
                                                    <p class="text-muted">Marketplace</p>
                                                </div>
                                                <div class="col-6">
                                                    <h5 class="">$ 6985</h5>
                                                    <p class="text-muted">Total Income</p>
                                                </div>
                                            </div>
            
                                            <div id="morris-bar-stacked" class="dashboard-charts morris-charts"></div>
                                        </div>
                                    </div>
                                </div>
            
                            </div>
                            <!-- end row -->
            
                            <div class="row">
                                
                                <div class="col-xl-4 col-lg-6">
                                    <div class="card m-b-20">
                                        <div class="card-body">
                                            <h4 class="mt-0 header-title mb-3">Inbox</h4>
                                            <div class="inbox-wid">
                                                <a href="#" class="text-dark">
                                                    <div class="inbox-item">
                                                        <div class="inbox-item-img float-left mr-3"><img src="assets/images/users/user-1.jpg" class="thumb-md rounded-circle" alt=""></div>
                                                        <h6 class="inbox-item-author mt-0 mb-1">Misty</h6>
                                                        <p class="inbox-item-text text-muted mb-0">Hey! there I'm available...</p>
                                                        <p class="inbox-item-date text-muted">13:40 PM</p>
                                                    </div>
                                                </a>
                                                <a href="#" class="text-dark">
                                                    <div class="inbox-item">
                                                        <div class="inbox-item-img float-left mr-3"><img src="assets/images/users/user-2.jpg" class="thumb-md rounded-circle" alt=""></div>
                                                        <h6 class="inbox-item-author mt-0 mb-1">Melissa</h6>
                                                        <p class="inbox-item-text text-muted mb-0">I've finished it! See you so...</p>
                                                        <p class="inbox-item-date text-muted">13:34 PM</p>
                                                    </div>
                                                </a>
                                                <a href="#" class="text-dark">
                                                    <div class="inbox-item">
                                                        <div class="inbox-item-img float-left mr-3"><img src="assets/images/users/user-3.jpg" class="thumb-md rounded-circle" alt=""></div>
                                                        <h6 class="inbox-item-author mt-0 mb-1">Dwayne</h6>
                                                        <p class="inbox-item-text text-muted mb-0">This theme is awesome!</p>
                                                        <p class="inbox-item-date text-muted">13:17 PM</p>
                                                    </div>
                                                </a>
                                                <a href="#" class="text-dark">
                                                    <div class="inbox-item">
                                                        <div class="inbox-item-img float-left mr-3"><img src="assets/images/users/user-4.jpg" class="thumb-md rounded-circle" alt=""></div>
                                                        <h6 class="inbox-item-author mt-0 mb-1">Martin</h6>
                                                        <p class="inbox-item-text text-muted mb-0">Nice to meet you</p>
                                                        <p class="inbox-item-date text-muted">12:20 PM</p>
                                                    </div>
                                                </a>
                                                <a href="#" class="text-dark">
                                                    <div class="inbox-item">
                                                        <div class="inbox-item-img float-left mr-3"><img src="assets/images/users/user-5.jpg" class="thumb-md rounded-circle" alt=""></div>
                                                        <h6 class="inbox-item-author mt-0 mb-1">Vincent</h6>
                                                        <p class="inbox-item-text text-muted mb-0">Hey! there I'm available...</p>
                                                        <p class="inbox-item-date text-muted">11:47 AM</p>
                                                    </div>
                                                </a>
            
                                                <a href="#" class="text-dark">
                                                    <div class="inbox-item">
                                                        <div class="inbox-item-img float-left mr-3"><img src="assets/images/users/user-6.jpg" class="thumb-md rounded-circle" alt=""></div>
                                                        <h6 class="inbox-item-author mt-0 mb-1">Robert Chappa</h6>
                                                        <p class="inbox-item-text text-muted mb-0">Hey! there I'm available...</p>
                                                        <p class="inbox-item-date text-muted">10:12 AM</p>
                                                    </div>
                                                </a>
                                                
                                            </div>  
                                        </div>
                                    </div>
            
                                </div>
                                <div class="col-xl-4 col-lg-6">
                                    <div class="card m-b-20">
                                        <div class="card-body">
                                            <h4 class="mt-0 header-title mb-4">Recent Activity Feed</h4>
            
                                            <ol class="activity-feed mb-0">
                                                <li class="feed-item">
                                                    <div class="feed-item-list">
                                                        <span class="date">Jun 25</span>
                                                        <span class="activity-text">Responded to need “Volunteer Activities”</span>
                                                    </div>
                                                </li>
                                                <li class="feed-item">
                                                    <div class="feed-item-list">
                                                        <span class="date">Jun 24</span>
                                                        <span class="activity-text">Added an interest “Volunteer Activities”</span>
                                                    </div>
                                                </li>
                                                <li class="feed-item">
                                                    <div class="feed-item-list">
                                                        <span class="date">Jun 23</span>
                                                        <span class="activity-text">Joined the group “Boardsmanship Forum”</span>
                                                    </div>
                                                </li>
                                                <li class="feed-item">
                                                    <div class="feed-item-list">
                                                        <span class="date">Jun 21</span>
                                                        <span class="activity-text">Responded to need “In-Kind Opportunity”</span>
                                                    </div>
                                                </li>
                                            </ol>
            
                                            <div class="text-center">
                                                <a href="#" class="btn btn-sm btn-primary">Load More</a>
                                            </div>
                                        </div>
                                    </div>
            
                                </div>
                                <div class="col-xl-4">
                                    <div class="card widget-user m-b-20">
                                        <div class="widget-user-desc p-4 text-center bg-primary position-relative">
                                            <i class="fas fa-quote-left h3 text-white-50"></i>
                                            <p class="text-white mb-0">The European languages are members of the same family. Their separate existence is a myth. For science, music, sport, etc, Europe the same vocabulary. The languages only in their grammar.</p>
                                        </div>
                                        <div class="p-4">
                                            <div class="float-left mt-2 mr-3">
                                                <img src="assets/images/users/user-2.jpg" alt="" class="rounded-circle thumb-md">
                                            </div>
                                            <h6 class="mb-1">Marie Minnick</h6>
                                            <p class="text-muted mb-0">Marketing Manager</p>
                                        </div>
                                    </div>
                                    <div class="card m-b-20">
                                        <div class="card-body">
                                            <h4 class="mt-0 header-title">Yearly Sales</h4>
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <div>
                                                        <h4>52,345</h4>
                                                        <p class="text-muted">The languages only differ grammar</p>
                                                        <a href="#" class="text-primary">Learn more <i class="mdi mdi-chevron-double-right"></i></a>
                                                    </div>
                                                </div>
                                                <div class="col-md-8 text-right">
                                                    <div id="sparkline"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
            
                                </div>
                            </div>
                            <!-- end row -->
                            <div class="row">
                                <div class="col-xl-6">
                                    <div class="card m-b-20">
                                        <div class="card-body">
                                            <h4 class="mt-0 m-b-30 header-title">Latest Transactions</h4>
            
                                            <div class="table-responsive">
                                                <table class="table table-vertical">
            
                                                    <tbody>
                                                    <tr>
                                                        <td>
                                                            <img src="assets/images/users/user-2.jpg" alt="user-image" class="thumb-sm rounded-circle mr-2"/>
                                                            Herbert C. Patton
                                                        </td>
                                                        <td><i class="mdi mdi-checkbox-blank-circle text-success"></i> Confirm</td>
                                                        <td>
                                                            $14,584
                                                            <p class="m-0 text-muted font-14">Amount</p>
                                                        </td>
                                                        <td>
                                                            5/12/2016
                                                            <p class="m-0 text-muted font-14">Date</p>
                                                        </td>
                                                        <td>
                                                            <button type="button" class="btn btn-secondary btn-sm waves-effect waves-light">Edit</button>
                                                        </td>
                                                    </tr>
            
                                                    <tr>
                                                        <td>
                                                            <img src="assets/images/users/user-3.jpg" alt="user-image" class="thumb-sm rounded-circle mr-2"/>
                                                            Mathias N. Klausen
                                                        </td>
                                                        <td><i class="mdi mdi-checkbox-blank-circle text-warning"></i> Waiting payment</td>
                                                        <td>
                                                            $8,541
                                                            <p class="m-0 text-muted font-14">Amount</p>
                                                        </td>
                                                        <td>
                                                            10/11/2016
                                                            <p class="m-0 text-muted font-14">Date</p>
                                                        </td>
                                                        <td>
                                                            <button type="button" class="btn btn-secondary btn-sm waves-effect waves-light">Edit</button>
                                                        </td>
                                                    </tr>
            
                                                    <tr>
                                                        <td>
                                                            <img src="assets/images/users/user-4.jpg" alt="user-image" class="thumb-sm rounded-circle mr-2"/>
                                                            Nikolaj S. Henriksen
                                                        </td>
                                                        <td><i class="mdi mdi-checkbox-blank-circle text-success"></i> Confirm</td>
                                                        <td>
                                                            $954
                                                            <p class="m-0 text-muted font-14">Amount</p>
                                                        </td>
                                                        <td>
                                                            8/11/2016
                                                            <p class="m-0 text-muted font-14">Date</p>
                                                        </td>
                                                        <td>
                                                            <button type="button" class="btn btn-secondary btn-sm waves-effect waves-light">Edit</button>
                                                        </td>
                                                    </tr>
            
                                                    <tr>
                                                        <td>
                                                            <img src="assets/images/users/user-5.jpg" alt="user-image" class="thumb-sm rounded-circle mr-2"/>
                                                            Lasse C. Overgaard
                                                        </td>
                                                        <td><i class="mdi mdi-checkbox-blank-circle text-danger"></i> Payment expired</td>
                                                        <td>
                                                            $44,584
                                                            <p class="m-0 text-muted font-14">Amount</p>
                                                        </td>
                                                        <td>
                                                            7/11/2016
                                                            <p class="m-0 text-muted font-14">Date</p>
                                                        </td>
                                                        <td>
                                                            <button type="button" class="btn btn-secondary btn-sm waves-effect waves-light">Edit</button>
                                                        </td>
                                                    </tr>
            
                                                    <tr>
                                                        <td>
                                                            <img src="assets/images/users/user-6.jpg" alt="user-image" class="thumb-sm rounded-circle mr-2"/>
                                                            Kasper S. Jessen
                                                        </td>
                                                        <td><i class="mdi mdi-checkbox-blank-circle text-success"></i> Confirm</td>
                                                        <td>
                                                            $8,844
                                                            <p class="m-0 text-muted font-14">Amount</p>
                                                        </td>
                                                        <td>
                                                            1/11/2016
                                                            <p class="m-0 text-muted font-14">Date</p>
                                                        </td>
                                                        <td>
                                                            <button type="button" class="btn btn-secondary btn-sm waves-effect waves-light">Edit</button>
                                                        </td>
                                                    </tr>
            
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
            
                                <div class="col-xl-6">
                                    <div class="card m-b-20">
                                        <div class="card-body">
                                            <h4 class="mt-0 m-b-30 header-title">Latest Orders</h4>
            
                                            <div class="table-responsive">
                                                <table class="table table-vertical mb-1">
            
                                                    <tbody>
                                                    <tr>
                                                        <td>#12354781</td>
                                                        <td>
                                                            <img src="assets/images/users/user-1.jpg" alt="user-image" class="thumb-sm mr-2 rounded-circle"/>
                                                            Riverston Glass Chair
                                                        </td>
                                                        <td><span class="badge badge-pill badge-success">Delivered</span></td>
                                                        <td>
                                                            $185
                                                        </td>
                                                        <td>
                                                            5/12/2016
                                                        </td>
                                                        <td>
                                                            <button type="button" class="btn btn-secondary btn-sm waves-effect waves-light">Edit</button>
                                                        </td>
                                                    </tr>
            
                                                    <tr>
                                                        <td>#52140300</td>
                                                        <td>
                                                            <img src="assets/images/users/user-2.jpg" alt="user-image" class="thumb-sm mr-2 rounded-circle"/>
                                                            Shine Company Catalina
                                                        </td>
                                                        <td><span class="badge badge-pill badge-success">Delivered</span></td>
                                                        <td>
                                                            $1,024
                                                        </td>
                                                        <td>
                                                            5/12/2016
                                                        </td>
                                                        <td>
                                                            <button type="button" class="btn btn-secondary btn-sm waves-effect waves-light">Edit</button>
                                                        </td>
                                                    </tr>
            
                                                    <tr>
                                                        <td>#96254137</td>
                                                        <td>
                                                            <img src="assets/images/users/user-3.jpg" alt="user-image" class="thumb-sm mr-2 rounded-circle"/>
                                                            Trex Outdoor Furniture Cape
                                                        </td>
                                                        <td><span class="badge badge-pill badge-danger">Cancel</span></td>
                                                        <td>
                                                            $657
                                                        </td>
                                                        <td>
                                                            5/12/2016
                                                        </td>
                                                        <td>
                                                            <button type="button" class="btn btn-secondary btn-sm waves-effect waves-light">Edit</button>
                                                        </td>
                                                    </tr>
            
                                                    <tr>
                                                        <td>#12365474</td>
                                                        <td>
                                                            <img src="assets/images/users/user-4.jpg" alt="user-image" class="thumb-sm mr-2 rounded-circle"/>
                                                            Oasis Bathroom Teak Corner
                                                        </td>
                                                        <td><span class="badge badge-pill badge-warning">Shipped</span></td>
                                                        <td>
                                                            $8451
                                                        </td>
                                                        <td>
                                                            5/12/2016
                                                        </td>
                                                        <td>
                                                            <button type="button" class="btn btn-secondary btn-sm waves-effect waves-light">Edit</button>
                                                        </td>
                                                    </tr>
            
                                                    <tr>
                                                        <td>#85214796</td>
                                                        <td>
                                                            <img src="assets/images/users/user-5.jpg" alt="user-image" class="thumb-sm mr-2 rounded-circle"/>
                                                            BeoPlay Speaker
                                                        </td>
                                                        <td><span class="badge badge-pill badge-success">Delivered</span></td>
                                                        <td>
                                                            $584
                                                        </td>
                                                        <td>
                                                            5/12/2016
                                                        </td>
                                                        <td>
                                                            <button type="button" class="btn btn-secondary btn-sm waves-effect waves-light">Edit</button>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>#12354781</td>
                                                        <td>
                                                            <img src="assets/images/users/user-6.jpg" alt="user-image" class="thumb-sm mr-2 rounded-circle"/>
                                                            Riverston Glass Chair
                                                        </td>
                                                        <td><span class="badge badge-pill badge-success">Delivered</span></td>
                                                        <td>
                                                            $185
                                                        </td>
                                                        <td>
                                                            5/12/2016
                                                        </td>
                                                        <td>
                                                            <button type="button" class="btn btn-secondary btn-sm waves-effect waves-light">Edit</button>
                                                        </td>
                                                    </tr>
            
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- end row -->

                    </div> <!-- container-fluid -->

                </div> <!-- content -->

                <footer class="footer">
                        © 2018 - 2019 Lexa - <span class="d-none d-sm-inline-block"> Crafted with <i class="mdi mdi-heart text-danger"></i> by Themesbrand</span>.
                </footer>
                
            </div>

            <!-- ============================================================== -->
            <!-- End Right content here -->
            <!-- ============================================================== -->


        </div>
        <!-- END wrapper -->
            

        <!-- jQuery  -->
        <script src="assets/js/jquery.min.js"></script>
        <script src="assets/js/bootstrap.bundle.min.js"></script>
        <script src="assets/js/metisMenu.min.js"></script>
        <script src="assets/js/jquery.slimscroll.js"></script>
        <script src="assets/js/waves.min.js"></script>

        <script src="assets/plugins/jquery-sparkline/jquery.sparkline.min.js"></script>

        <!--Morris Chart-->
        <script src="assets/plugins/morris/morris.min.js"></script>
        <script src="assets/plugins/raphael/raphael-min.js"></script>
        <script src="assets/pages/dashboard.js"></script>

        <!-- App js -->
        <script src="assets/js/app.js"></script>

</body>

</html>