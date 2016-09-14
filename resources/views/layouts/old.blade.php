<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta content="IE=edge" http-equiv="X-UA-Compatible">
    <meta content="width=device-width, initial-scale=1" name="viewport">
    <meta content="" name="description">
    <meta content="" name="author">
    <title>Sideline Studios-SFC Talon CMS</title><!-- Bootstrap Core CSS -->
    <link href="/bower_components/bootstrap/dist/css/bootstrap.min.css" rel=
    "stylesheet"><!-- MetisMenu CSS -->
    <link href="/bower_components/metisMenu/dist/metisMenu.min.css" rel=
    "stylesheet"><!-- Timeline CSS -->
    <link href="/dist/css/timeline.css" rel="stylesheet"><!-- Custom CSS -->
    <link href="/dist/css/sb-admin-2.css" rel="stylesheet">
    <!-- Morris Charts CSS -->
    <link href="/bower_components/morrisjs/morris.css" rel="stylesheet">
    <!-- Custom Fonts -->
    <link href="/bower_components/font-awesome/css/font-awesome.min.css" rel=
    "stylesheet" type="text/css">
    <link rel="stylesheet" href="//code.jquery.com/ui/1.11.2/themes/smoothness/jquery-ui.css">
    <link rel="stylesheet" href="/css/bootstrap-datetimepicker.css">

    {{--Select2.js fancy select look js--}}
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.2-rc.1/css/select2.min.css" rel="stylesheet" />

    {{-- ckeditor javascript import (rich text editor--}}
    <script src="/ckeditor/ckeditor.js"></script>




    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body class="hold-transition fixed sidebar-mini skin-green">
<div id="wrapper" class="wrapper">
    <header class="main-header">
        <a href="../../index2.html" class="logo">
            <!-- LOGO -->
            AdminLTE
        </a>
        <!-- Header Navbar: style can be found in header.less -->
        <nav class="navbar navbar-static-top" role="navigation">
            <!-- Navbar Right Menu -->
            <div class="navbar-custom-menu">
                <ul class="nav navbar-nav">
                    <!-- Messages: style can be found in dropdown.less-->
                    <li class="dropdown messages-menu">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <i class="fa fa-envelope-o"></i>
                            <span class="label label-success">4</span>
                        </a>
                        <ul class="dropdown-menu">
                            <li class="header">You have 4 messages</li>
                            <li>
                                <!-- inner menu: contains the actual data -->
                                <ul class="menu">
                                    <li><!-- start message -->
                                        <a href="#">
                                            <div class="pull-left">
                                                <img src="dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">
                                            </div>
                                            <h4>
                                                Sender Name
                                                <small><i class="fa fa-clock-o"></i> 5 mins</small>
                                            </h4>
                                            <p>Message Excerpt</p>
                                        </a>
                                    </li><!-- end message -->
                                    ...
                                </ul>
                            </li>
                            <li class="footer"><a href="#">See All Messages</a></li>
                        </ul>
                    </li>
                    <!-- Notifications: style can be found in dropdown.less -->
                    <li class="dropdown notifications-menu">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <i class="fa fa-bell-o"></i>
                            <span class="label label-warning">10</span>
                        </a>
                        <ul class="dropdown-menu">
                            <li class="header">You have 10 notifications</li>
                            <li>
                                <!-- inner menu: contains the actual data -->
                                <ul class="menu">
                                    <li>
                                        <a href="#">
                                            <i class="ion ion-ios-people info"></i> Notification title
                                        </a>
                                    </li>
                                    ...
                                </ul>
                            </li>
                            <li class="footer"><a href="#">View all</a></li>
                        </ul>
                    </li>
                    <!-- Tasks: style can be found in dropdown.less -->
                    <li class="dropdown tasks-menu">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <i class="fa fa-flag-o"></i>
                            <span class="label label-danger">9</span>
                        </a>
                        <ul class="dropdown-menu">
                            <li class="header">You have 9 tasks</li>
                            <li>
                                <!-- inner menu: contains the actual data -->
                                <ul class="menu">
                                    <li><!-- Task item -->
                                        <a href="#">
                                            <h3>
                                                Design some buttons
                                                <small class="pull-right">20%</small>
                                            </h3>
                                            <div class="progress xs">
                                                <div class="progress-bar progress-bar-aqua" style="width: 20%" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100">
                                                    <span class="sr-only">20% Complete</span>
                                                </div>
                                            </div>
                                        </a>
                                    </li><!-- end task item -->
                                    ...
                                </ul>
                            </li>
                            <li class="footer">
                                <a href="#">View all tasks</a>
                            </li>
                        </ul>
                    </li>
                    <!-- User Account: style can be found in dropdown.less -->
                    <li class="dropdown user user-menu">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <img src="dist/img/user2-160x160.jpg" class="user-image" alt="User Image">
                            <span class="hidden-xs">Alexander Pierce</span>
                        </a>
                        <ul class="dropdown-menu">
                            <!-- User image -->
                            <li class="user-header">
                                <img src="dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">
                                <p>
                                    Alexander Pierce - Web Developer
                                    <small>Member since Nov. 2012</small>
                                </p>
                            </li>
                            <!-- Menu Body -->
                            <li class="user-body">
                                <div class="col-xs-4 text-center">
                                    <a href="#">Followers</a>
                                </div>
                                <div class="col-xs-4 text-center">
                                    <a href="#">Sales</a>
                                </div>
                                <div class="col-xs-4 text-center">
                                    <a href="#">Friends</a>
                                </div>
                            </li>
                            <!-- Menu Footer-->
                            <li class="user-footer">
                                <div class="pull-left">
                                    <a href="#" class="btn btn-default btn-flat">Profile</a>
                                </div>
                                <div class="pull-right">
                                    <a href="/auth/logout" class="btn btn-default btn-flat">Sign out</a>
                                </div>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </nav>
    </header>
    <div class="main-sidebar">
        <!-- Inner sidebar -->
        <div class="sidebar">
            <!-- user panel (Optional) -->
            <div class="user-panel">
                <div class="pull-left image">
                    <img src="dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">
                </div>
                <div class="pull-left info">
                    <p>User Name</p>

                    <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
                </div>
            </div><!-- /.user-panel -->

            <!-- Search Form (Optional) -->
            <form action="#" method="get" class="sidebar-form">
                <div class="input-group">
                    <input type="text" name="q" class="form-control" placeholder="Search...">
                    <span class="input-group-btn">
          <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i></button>
        </span>
                </div>
            </form><!-- /.sidebar-form -->

            <ul class="sidebar-menu" id="side-menu">
                <li>
                    <a href="/home"><i class="fa fa-dashboard fa-fw"></i>
                        Settings</a>
                </li>
                @if(Auth::check())
                    @if(Auth::user()->email != 'admin@gmail.com')

                    @else
                        <li>
                            <a href="/schools"><i class="fa fa-dashboard fa-fw"></i>
                                Add School</a>
                        </li>
                    @endif
                @endif

                <li>
                    <a href="/staff"><i class="fa fa-edit fa-fw"></i>
                        Staff</a>
                </li>
                <li>
                    <a href="/opponents"><i class="fa fa-edit fa-fw"></i>
                        Opponents</a>
                </li>

                <li>
                    <a href="/sports"><i class="fa fa-edit fa-fw"></i>
                        Sports</a>
                </li>
                <li>
                    <a href="/sports-levels"><i class="fa fa-edit fa-fw"></i>
                        Sports Levels</a>
                </li>

                <li>
                    <a href="/rosters"><i class="fa fa-edit fa-fw"></i>
                        Rosters</a>
                </li>

                <li>
                    <a href="/students"><i class="fa fa-edit fa-fw"></i>
                        Students</a>
                </li>
                <li>
                    <a href="/locations"><i class="fa fa-edit fa-fw"></i>
                        Schedule Locations</a>
                </li>
                <li>
                    <a href="/news"><i class="fa fa-edit fa-fw"></i>
                        News</a>
                </li>
                <li>
                    <a href="#"><i class="fa fa-sitemap fa-fw"></i>
                        Fall Sports<span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level">
                        <li>
                            <a href="#">Football <span class=
                                                       "fa arrow"></span></a>
                            <ul class="nav nav-third-level">
                                <li>
                                    <a href="/rosters/1">Roster</a>
                                </li>
                                <li>
                                    <a href="/games/1">Schedules</a>
                                </li>
                                <li>
                                    <a href="/news/1">News</a>
                                </li>
                            </ul><!-- /.nav-third-level -->
                        </li>
                        <li>
                            <a href="#">Vollyball <span class=
                                                        "fa arrow"></span></a>
                            <ul class="nav nav-third-level">
                                <li>
                                    <a href="/rosters/2">Roster</a>
                                </li>
                                <li>
                                    <a href="/games/2">Games</a>
                                </li>
                                <li>
                                    <a href="/news/2">News</a>
                                </li>
                            </ul><!-- /.nav-third-level -->
                        </li>
                        <li>
                            <a href="#">Cross Country <span class=
                                                            "fa arrow"></span></a>
                            <ul class="nav nav-third-level">
                                <li>
                                    <a href="/rosters/4">Roster</a>
                                </li>
                                <li>
                                    <a href="/games/4">Schedules</a>
                                </li>
                                <li>
                                    <a href="/news/4">News</a>
                                </li>
                            </ul><!-- /.nav-third-level -->
                        </li>
                        <li>
                            <a href="#">Tennis <span class=
                                                     "fa arrow"></span></a>
                            <ul class="nav nav-third-level">
                                <li>
                                    <a href="/rosters/3">Roster</a>
                                </li>
                                <li>
                                    <a href="/games/3">Schedules</a>
                                </li>
                                <li>
                                    <a href="/news/3">News</a>
                                </li>
                            </ul><!-- /.nav-third-level -->
                        </li>
                        <li>
                            <a href="#">Water Polo <span class=
                                                         "fa arrow"></span></a>
                            <ul class="nav nav-third-level">
                                <li>
                                    <a href="/rosters/5">Roster</a>
                                </li>
                                <li>
                                    <a href="/games/5">Schedules</a>
                                </li>
                                <li>
                                    <a href="/news/5">News</a>
                                </li>
                            </ul><!-- /.nav-third-level -->
                        </li>
                        <li>
                            <a href="#">Cheer <span class=
                                                    "fa arrow"></span></a>
                            <ul class="nav nav-third-level">
                                <li>
                                    <a href="/rosters/6">Roster</a>
                                </li>
                                <li>
                                    <a href="/games/6">Schedules</a>
                                </li>
                                <li>
                                    <a href="/news/6">News</a>
                                </li>
                            </ul><!-- /.nav-third-level -->
                        </li>

                    </ul><!-- /.nav-second-level -->
                </li>
                <li>
                    <a href="#"><i class="fa fa-sitemap fa-fw"></i>
                        Winter Sports<span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level">
                        <li>
                            <a href="#">Boy's Basketball <span class=
                                                               "fa arrow"></span></a>
                            <ul class="nav nav-third-level">
                                <li>
                                    <a href="/rosters/8">Roster</a>
                                </li>
                                <li>
                                    <a href="/games/8">Schedules</a>
                                </li>
                                <li>
                                    <a href="/news/8">News</a>
                                </li>
                            </ul><!-- /.nav-third-level -->
                        </li>
                        <li>
                            <a href="#">Girl's Basketball<span class=
                                                               "fa arrow"></span></a>
                            <ul class="nav nav-third-level">
                                <li>
                                    <a href="/rosters/9">Roster</a>
                                </li>
                                <li>
                                    <a href="/games/9">Schedules</a>
                                </li>
                                <li>
                                    <a href="/news/9">News</a>
                                </li>
                            </ul><!-- /.nav-third-level -->
                        </li>
                        <li>
                            <a href="#">Boy's Soccer<span class=
                                                          "fa arrow"></span></a>
                            <ul class="nav nav-third-level">
                                <li>
                                    <a href="/rosters/10">Roster</a>
                                </li>
                                <li>
                                    <a href="/games/10">Schedules</a>
                                </li>
                                <li>
                                    <a href="/news/10">News</a>
                                </li>
                            </ul><!-- /.nav-third-level -->
                        </li>
                        <li>
                            <a href="#">Girl's Soccer<span class=
                                                           "fa arrow"></span></a>
                            <ul class="nav nav-third-level">
                                <li>
                                    <a href="/rosters/11">Roster</a>
                                </li>
                                <li>
                                    <a href="/games/11">Schedules</a>
                                </li>
                                <li>
                                    <a href="/news/11">News</a>
                                </li>
                            </ul><!-- /.nav-third-level -->
                        </li>
                        <li>
                            <a href="#">Girl's Water Polo<span class=
                                                               "fa arrow"></span></a>
                            <ul class="nav nav-third-level">
                                <li>
                                    <a href="/rosters/12">Roster</a>
                                </li>
                                <li>
                                    <a href="/games/12">Games</a>
                                </li>
                                <li>
                                    <a href="/news/12">News</a>
                                </li>
                            </ul><!-- /.nav-third-level -->
                        </li>


                    </ul><!-- /.nav-second-level -->
                </li>
                <li>
                    <a href="#"><i class="fa fa-sitemap fa-fw"></i>
                        Spring Sports<span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level">
                        <li>
                            <a href="#">Baseball <span class=
                                                       "fa arrow"></span></a>
                            <ul class="nav nav-third-level">
                                <li>
                                    <a href="/rosters/13">Roster</a>
                                </li>
                                <li>
                                    <a href="/games/13">Schedules</a>
                                </li>
                                <li>
                                    <a href="/news/13">News</a>
                                </li>
                            </ul><!-- /.nav-third-level -->
                        </li>
                        <li>
                            <a href="#">Softball <span class=
                                                       "fa arrow"></span></a>
                            <ul class="nav nav-third-level">
                                <li>
                                    <a href="/rosters/14">Roster</a>
                                </li>
                                <li>
                                    <a href="/games/14">Schedules</a>
                                </li>
                                <li>
                                    <a href="/news/14">News</a>
                                </li>
                            </ul><!-- /.nav-third-level -->
                        </li>
                        <li>
                            <a href="#">Boys Lacrosse <span class=
                                                            "fa arrow"></span></a>
                            <ul class="nav nav-third-level">
                                <li>
                                    <a href="/rosters/25">Roster</a>
                                </li>
                                <li>
                                    <a href="/games/25">Schedules</a>
                                </li>
                                <li>
                                    <a href="/news/25">News</a>
                                </li>
                            </ul><!-- /.nav-third-level -->
                        </li>
                        <li>
                            <a href="#">GirlsLacrosse <span class=
                                                            "fa arrow"></span></a>
                            <ul class="nav nav-third-level">
                                <li>
                                    <a href="/rosters/26">Roster</a>
                                </li>
                                <li>
                                    <a href="/games/26">Schedules</a>
                                </li>
                                <li>
                                    <a href="/news/26">News</a>
                                </li>
                            </ul><!-- /.nav-third-level -->
                        </li>
                        <li>
                            <a href="#">Track &amp; Field <span class=
                                                                "fa arrow"></span></a>
                            <ul class="nav nav-third-level">
                                <li>
                                    <a href="/rosters/28">Roster</a>
                                </li>
                                <li>
                                    <a href="/games/28">Schedules</a>
                                </li>
                                <li>
                                    <a href="/news/28">News</a>
                                </li>
                            </ul><!-- /.nav-third-level -->
                        </li>
                        <li>
                            <a href="#">Boys Volleyball <span class=
                                                              "fa arrow"></span></a>
                            <ul class="nav nav-third-level">
                                <li>
                                    <a href="/rosters/24">Roster</a>
                                </li>
                                <li>
                                    <a href="/games/24">Schedules</a>
                                </li>
                                <li>
                                    <a href="/news/24">News</a>
                                </li>
                            </ul><!-- /.nav-third-level -->
                        </li>
                        <li>
                            <a href="#">Boys Tennis <span class=
                                                          "fa arrow"></span></a>
                            <ul class="nav nav-third-level">
                                <li>
                                    <a href="/rosters/20">Roster</a>
                                </li>
                                <li>
                                    <a href="/games/20">Schedules</a>
                                </li>
                                <li>
                                    <a href="/news/20">News</a>
                                </li>
                            </ul><!-- /.nav-third-level -->
                        </li>
                        <li>
                            <a href="#">Swimming <span class=
                                                       "fa arrow"></span></a>
                            <ul class="nav nav-third-level">
                                <li>
                                    <a href="/rosters/18">Roster</a>
                                </li>
                                <li>
                                    <a href="/games/18">Schedules</a>
                                </li>
                                <li>
                                    <a href="/news/18">News</a>
                                </li>
                            </ul><!-- /.nav-third-level -->
                        </li>
                        <li>
                            <a href="#">Boys Golf <span class=
                                                        "fa arrow"></span></a>
                            <ul class="nav nav-third-level">
                                <li>
                                    <a href="/rosters/21">Roster</a>
                                </li>
                                <li>
                                    <a href="/games/21">Schedules</a>
                                </li>
                                <li>
                                    <a href="/news/21">News</a>
                                </li>
                            </ul><!-- /.nav-third-level -->
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
    <div id="page-wrapper" class="content-wrapper">

        @yield('content')

    </div><!-- /#wrapper -->


    <!-- jQuery -->
    <script src="/bower_components/jquery/dist/jquery.min.js">
    </script> <!-- Bootstrap Core JavaScript -->

    <script src="/bower_components/bootstrap/dist/js/bootstrap.min.js">
    </script> <!-- Metis Menu Plugin JavaScript -->

    <script src="/bower_components/metisMenu/dist/metisMenu.min.js">
    </script> <!-- Morris Charts JavaScript -->

    <script src="/bower_components/raphael/raphael-min.js">
    </script>
    <script src="/bower_components/morrisjs/morris.min.js">
    </script>

    <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
    <script src="/js/moment-with-locales.js"></script>
    <script src="/js/bootstrap-datetimepicker.js"></script>

    <script src="/dist/js/sb-admin-2.js"></script>
    <script src="http://www.kryogenix.org/code/browser/sorttable/sorttable.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.2-rc.1/js/select2.min.js"></script>
    @yield('footer')
</div>
</body>
</html>