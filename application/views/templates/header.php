<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link href="/application/third_party/tabulator/dist/css/tabulator.min.css" rel="stylesheet">
    <link href="/application/third_party/tabulator/dist/css/bootstrap/tabulator_bootstrap4.min.css" rel="stylesheet">
    <link href="/application/third_party/jQuery/jquery-ui.min.css" rel="stylesheet">
    <link href="/application/third_party/jQuery/jquery-ui.structure.min.css" rel="stylesheet">
    <link href="/application/third_party/jQuery/jquery-ui.theme.min.css" rel="stylesheet">
    <link rel="icon" type="image/x-icon" href="/images/favicon.ico">

    <!-- Stylesheets -->
    <link rel="stylesheet" href="/css/bootstrap.min.css">
    <link rel="stylesheet" href="/css/bootstrap-extend.min.css">
    <link rel="stylesheet" href="/css/site.min.css">

    <!-- Plugins -->
    <link rel="stylesheet" href="/application/vendor/animsition/animsition.css">
    <link rel="stylesheet" href="/application/vendor/asscrollable/asScrollable.css">
    <link rel="stylesheet" href="/application/vendor/switchery/switchery.css">
    <link rel="stylesheet" href="/application/vendor/intro-js/introjs.css">
    <link rel="stylesheet" href="/application/vendor/slidepanel/slidePanel.css">
    <link rel="stylesheet" href="/application/vendor/flag-icon-css/flag-icon.css">
    <link rel="stylesheet" href="/application/vendor/jvectormap/jquery-jvectormap.css">
    <link rel="stylesheet" href="/application/vendor/chartist-plugin-tooltip/chartist-plugin-tooltip.css">
    <link rel="stylesheet" href="/application/vendor/alertify/alertify.min.css">
    <link rel="stylesheet" href="/application/fonts/ionicons/ionicons.min.css">
    <link href="/application/third_party/tabulator/dist/css/tabulator.min.css" rel="stylesheet">
    <link href="/application/third_party/tabulator/dist/css/bootstrap/tabulator_bootstrap4.min.css" rel="stylesheet">
    <link href="/application/vendor/bootstrap-select/bootstrap-select.min.css" rel="stylesheet">

    <!-- Fonts -->
    <link rel="stylesheet" href="/application/fonts/weather-icons/weather-icons.css">
    <link rel="stylesheet" href="/application/fonts/web-icons/web-icons.min.css">
    <link rel="stylesheet" href="/application/fonts/brand-icons/brand-icons.min.css">
    <link rel="stylesheet" href="/application/fonts/font-awesome/font-awesome.min.css">
    <link rel='stylesheet' href='http://fonts.googleapis.com/css?family=Roboto:300,400,500,300italic'>

    <!-- Core  -->
    <script src="/application/vendor/babel-external-helpers/babel-external-helpers.js"></script>
    <script src="/application/vendor/jquery/jquery.js"></script>
    <script src="/application/vendor/popper-js/umd/popper.min.js"></script>
    <script src="/application/vendor/bootstrap/bootstrap.js"></script>
    <script src="/application/vendor/animsition/animsition.js"></script>
    <script src="/application/vendor/mousewheel/jquery.mousewheel.js"></script>
    <script src="/application/vendor/asscrollbar/jquery-asScrollbar.js"></script>
    <script src="/application/vendor/asscrollable/jquery-asScrollable.js"></script>
    <script src="/application/vendor/ashoverscroll/jquery-asHoverScroll.js"></script>
    <script type="text/javascript" src="/application/vendor/moment/moment/min/moment-with-locales.min.js"></script>
    <script type="text/javascript" src="/application/third_party/tabulator/dist/js/tabulator.min.js"></script>
    <script type="text/javascript" src="/application/third_party/tinymce/tinymce.min.js"></script>
    <script type="text/javascript" src="/application/vendor/bootstrap-select/bootstrap-select.min.js"></script>

    <title><?php echo $title; ?></title>

    <!--[if lt IE 9]>
    <script src="/application/vendor/html5shiv/html5shiv.min.js"></script>
    <![endif]-->

    <!--[if lt IE 10]>
    <script src="/application/vendor/media-match/media.match.min.js"></script>
    <script src="/application/vendor/respond/respond.min.js"></script>
    <![endif]-->

    <!-- Scripts -->
    <script src="/application/vendor/breakpoints/breakpoints.js"></script>
    <script>
        Breakpoints();
    </script>
</head>

<body class="animsition dashboard">

<link rel="stylesheet" href="/application/vendor/flag-icon-css/flag-icon.css">
<link rel="stylesheet" href="/application/vendor/chartist/chartist.css">
<link rel="stylesheet" href="/application/vendor/jvectormap/jquery-jvectormap.css">
<link rel="stylesheet" href="/application/vendor/chartist-plugin-tooltip/chartist-plugin-tooltip.css">

<nav class="site-navbar navbar navbar-default navbar-fixed-top navbar-mega" role="navigation">

    <div class="navbar-header">
        <button type="button" class="navbar-toggler hamburger hamburger-close navbar-toggler-left hided"
                data-toggle="menubar">
            <span class="sr-only">Toggle navigation</span>
            <span class="hamburger-bar"></span>
        </button>
        <div class="navbar-brand navbar-brand-center">
            <img class="navbar-brand-logo" src="/images/default.jpeg" title="logo">
            <span class="navbar-brand-text"> DET 550</span>
        </div>
    </div>

    <div class="navbar-container container-fluid">
        <!-- Navbar Collapse -->
        <div class="collapse navbar-collapse navbar-collapse-toolbar" id="site-navbar-collapse">
            <!-- Navbar Toolbar -->
            <ul class="nav navbar-toolbar">
                <li class="nav-item hidden-float" id="toggleMenubar">
                    <a class="nav-link" data-toggle="menubar" href="#" role="button">
                        <i class="icon hamburger hamburger-arrow-left">
                            <span class="sr-only">Toggle menubar</span>
                            <span class="hamburger-bar"></span>
                        </i>
                    </a>
                </li>
                <li class="nav-item hidden-sm-down" id="toggleFullscreen">
                    <a class="nav-link icon icon-fullscreen" data-toggle="fullscreen" href="#" role="button">
                        <span class="sr-only">Toggle fullscreen</span>
                    </a>
                </li>
            </ul>
            <!-- End Navbar Toolbar -->

            <!-- Navbar Toolbar Right -->
            <ul class="nav navbar-toolbar navbar-right navbar-toolbar-right">
                <li class="nav-item dropdown">
                    <a class="nav-link" href="/index.php/cadet/home" title="Home" role="button">
                        <i class="icon wb-home" aria-hidden="true"></i>
                    </a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link" href="/index.php/login/logout" title="Log Out" role="button">
                        Log Out
                    </a>
                </li>
            </ul>
            <!-- End Navbar Toolbar Right -->
        </div>
        <!-- End Navbar Collapse -->
</nav>

<div class="site-menubar">
    <div class="site-menubar-body">
        <div>
            <div>
                <ul class="site-menu" data-plugin="menu">
                    <li class="site-menu-category">General</li>
                    <li class="site-menu-item has-sub">
                        <a href="javascript:void(0)">
                            <i class="site-menu-icon fa-calendar-check-o" aria-hidden="true"></i>
                            <span class="site-menu-title">Attendance</span>
                            <span class="site-menu-arrow"></span>
                        </a>
                        <ul class="site-menu-sub">
                            <li class="site-menu-item">
                                <a href="/index.php/attendance/view">
                                    <span class="site-menu-title">Event Attendance</span>
                                </a>
                            </li>
                            <?php
                                if( $this->ion_auth->is_admin() || $this->session->userdata('attendance') )
                                {
                                    echo '<li class="site-menu-item">
                                            <a href="/index.php/attendance/admin">
                                                <span class="site-menu-title">Admin Attendance</span>
                                            </a>
                                        </li>';
                                    echo '<li class="site-menu-item">
                                            <a href="/index.php/attendance/master">
                                                <span class="site-menu-title">View Attendance</span>
                                            </a>
                                        </li>';
                                }
                            ?>
                        </ul>
                    </li>
                    <li class="site-menu-item">
                        <a href="/index.php/cadet/profile">
                            <i class="site-menu-icon fa-user" aria-hidden="true"></i>
                            <span class="site-menu-title">My Profile</span>
                        </a>
                    </li>
                    <li class="site-menu-item">
                        <a href="/index.php/cadetdirectory/view">
                            <i class="site-menu-icon fa-list-alt" aria-hidden="true"></i>
                            <span class="site-menu-title">Directory</span>
                        </a>
                    </li>
                    <li class="site-menu-item">
                        <a href="/index.php/announcement/view">
                            <i class="site-menu-icon fa-comment" aria-hidden="true"></i>
                            <span class="site-menu-title">Announcement</span>
                        </a>
                    </li>
                    <li class="site-menu-item">
                        <a href="/index.php/wiki/view">
                            <i class="site-menu-icon fa-newspaper-o" aria-hidden="true"></i>
                            <span class="site-menu-title">Wiki</span>
                        </a>
                    </li>
                    <li class="site-menu-item">
                        <a href="/documentation/site/index.html">
                            <i class="site-menu-icon fa-book" aria-hidden="true"></i>
                            <span class="site-menu-title">Documentation</span>
                        </a>
                    </li>
                    <li class="site-menu-item">
                        <a href="/index.php/cadet/wingstructure">
                            <i class="site-menu-icon fa-fighter-jet" aria-hidden="true"></i>
                            <span class="site-menu-title">Wing Structure</span>
                        </a>
                    </li>

                    <li class="site-menu-item">
                        <a href="/index.php/email/view">
                            <i class="site-menu-icon fa-envelope" aria-hidden="true"></i>
                            <span class="site-menu-title">Send Email</span>
                        </a>
                    </li>

                    <li class="site-menu-item has-sub">
                        <a href="javascript:void(0)">
                            <i class="site-menu-icon fa-external-link" aria-hidden="true"></i>
                            <span class="site-menu-title">External Links</span>
                            <span class="site-menu-arrow"></span>
                        </a>
                        <ul class="site-menu-sub">
                            <li class="site-menu-item">
                                <a href="https://rpi.account.box.com/login">
                                    <span class="site-menu-title">Box</span>
                                </a>
                            </li>
                            <li class="site-menu-item">
                                <a href="https://1drv.ms/u/s!AuvfGdTu423La0njOdUq_ubV2R8?e=eyODRf">
                                    <span class="site-menu-title">Photos</span>
                                </a>
                            </li>
                            <li class="site-menu-item">
                                <a href="https://1drv.ms/u/s!AuvfGdTu423LggbFuMcGqLDuT68s?e=tm3aE7">
                                    <span class="site-menu-title">OneDrive</span>
                                </a>
                            </li>
                            <li class="site-menu-item">
                                <a href="https://calendar.google.com/calendar?cid=aDBlM2lkOW5pYThhZDc0M2xwY2Zxa3Y3Z29AZ3JvdXAuY2FsZW5kYXIuZ29vZ2xlLmNvbQ">
                                    <span class="site-menu-title">Calendar</span>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="site-menu-item has-sub">
                        <a href="javascript:void(0)">
                            <i class="site-menu-icon wb-table" aria-hidden="true"></i>
                            <span class="site-menu-title">Alumni</span>
                            <span class="site-menu-arrow"></span>
                        </a>
                        <ul class="site-menu-sub">
                            <li class="site-menu-item">
                                <a href="/index.php/alumni/view">
                                    <span class="site-menu-title">View Alumni</span>
                                </a>
                            </li>
                            <?php
                                if( $this->ion_auth->is_admin() )
                                {
                                    echo '<li class="site-menu-item">
                                        <a href="/index.php/cadet/view">
                                            <span class="site-menu-title">Admin</span>
                                        </a>
                                    </li>';
                                    echo '<li class="site-menu-item">
                                        <a href="/index.php/alumni/modify">
                                            <span class="site-menu-title">Modify Alumni</span>
                                        </a>
                                    </li>';
                                }
                            ?>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>

<!-- Page -->
<div class="page">
    <div class="page-content container-fluid">
