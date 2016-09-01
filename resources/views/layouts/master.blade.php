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
    {{--<script src="/ckeditorjs/sample.js"></script>--}}
    {{--<link rel="stylesheet" href="/ckeditor/css/samples.css">--}}
    {{--<link rel="stylesheet" href="/ckeditor/toolbarconfigurator/lib/codemirror/neo.css">--}}




    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body>
<div id="wrapper">
    <!-- Navigation -->
    <nav class="navbar navbar-default navbar-static-top" role="navigation"
         style="margin-bottom: 0">
        <div class="navbar-header" >
            <button class="navbar-toggle" data-target=".navbar-collapse"
                    data-toggle="collapse" type="button"><span class=
                                                               "sr-only">Toggle navigation</span> <span class=
                                                                                                        "icon-bar"></span> <span class="icon-bar"></span> <span class=
                                                                                                                                                                "icon-bar"></span></button> 
            <img src="/img/logo.png" style="width:75px;">
        </div><!-- /.navbar-header -->
        <ul class="nav navbar-top-links navbar-right">
            <li class="dropdown">
                <a  href="https://twitter.com/sidelinestudios"><i class="fa fa-twitter  fa-fw"></i>
                    <ul class="dropdown-menu dropdown-messages">
                        <li>
                            <a href="#">
                                <div>
                                    <strong>John Smith</strong> <span class=
                                                                      "pull-right text-muted"><em>Yesterday</em></span>
                                </div>
                                <div>
                                    Lorem ipsum dolor sit amet, consectetur
                                    adipiscing elit. Pellentesque eleifend...
                                </div></a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a href="#">
                                <div>
                                    <strong>John Smith</strong> <span class=
                                                                      "pull-right text-muted"><em>Yesterday</em></span>
                                </div>
                                <div>
                                    Lorem ipsum dolor sit amet, consectetur
                                    adipiscing elit. Pellentesque eleifend...
                                </div></a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a href="#">
                                <div>
                                    <strong>John Smith</strong> <span class=
                                                                      "pull-right text-muted"><em>Yesterday</em></span>
                                </div>
                                <div>
                                    Lorem ipsum dolor sit amet, consectetur
                                    adipiscing elit. Pellentesque eleifend...
                                </div></a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a class="text-center" href="#"><strong>Read All
                                    Messages</strong> <i class=
                                                         "fa fa-angle-right"></i></a>
                        </li>-->
                    </ul>
            </li><!-- /.dropdown -->
            <li class="dropdown">
                <a class="dropdown-toggle" data-toggle="dropdown" href=
                "https://www.facebook.com/sidelinestudios?_rdr=p"><i class="fa fa-facebook-square fa-fw"></i> </a>
                <ul class="dropdown-menu dropdown-tasks">
                    <li>
                        <a href="#">
                            <div>
                                <p><strong>Task 1</strong> <span class=
                                                                 "pull-right text-muted">40% Complete</span></p>
                                <div class="progress progress-striped active">
                                    <div aria-valuemax="100" aria-valuemin="0"
                                         aria-valuenow="40" class=
                                         "progress-bar progress-bar-success" role=
                                         "progressbar" style="width: 40%">
                                        <span class="sr-only">40% Complete
                                        (success)</span>
                                    </div>
                                </div>
                            </div></a>
                    </li>
                    <li class="divider"></li>
                    <li>
                        <a href="#">
                            <div>
                                <p><strong>Task 2</strong> <span class=
                                                                 "pull-right text-muted">20% Complete</span></p>
                                <div class="progress progress-striped active">
                                    <div aria-valuemax="100" aria-valuemin="0"
                                         aria-valuenow="20" class=
                                         "progress-bar progress-bar-info" role=
                                         "progressbar" style="width: 20%">
                                        <span class="sr-only">20%
                                        Complete</span>
                                    </div>
                                </div>
                            </div></a>
                    </li>
                    <li class="divider"></li>
                    <li>
                        <a href="#">
                            <div>
                                <p><strong>Task 3</strong> <span class=
                                                                 "pull-right text-muted">60% Complete</span></p>
                                <div class="progress progress-striped active">
                                    <div aria-valuemax="100" aria-valuemin="0"
                                         aria-valuenow="60" class=
                                         "progress-bar progress-bar-warning" role=
                                         "progressbar" style="width: 60%">
                                        <span class="sr-only">60% Complete
                                        (warning)</span>
                                    </div>
                                </div>
                            </div></a>
                    </li>
                    <li class="divider"></li>
                    <li>
                        <a href="#">
                            <div>
                                <p><strong>Task 4</strong> <span class=
                                                                 "pull-right text-muted">80% Complete</span></p>
                                <div class="progress progress-striped active">
                                    <div aria-valuemax="100" aria-valuemin="0"
                                         aria-valuenow="80" class=
                                         "progress-bar progress-bar-danger" role=
                                         "progressbar" style="width: 80%">
                                        <span class="sr-only">80% Complete
                                        (danger)</span>
                                    </div>
                                </div>
                            </div></a>
                    </li>
                    <li class="divider"></li>
                    <li>
                        <a class="text-center" href="#"><strong>See All
                                Tasks</strong> <i class=
                                                  "fa fa-angle-right"></i></a>
                    </li>
                </ul><!-- /.dropdown-tasks -->
            </li><!-- /.dropdown -->
            <li class="dropdown">
                <a class="dropdown-toggle" data-toggle="dropdown" href=
                "#"><i class="fa fa-bell fa-fw"></i> <i class=
                                                        "fa fa-caret-down"></i></a>
                <ul class="dropdown-menu dropdown-alerts">
                    <li>
                        <a href="#">
                            <div>
                                <i class="fa fa-comment fa-fw"></i> New Comment
                                <span class="pull-right text-muted small">4
                                minutes ago</span>
                            </div></a>
                    </li>
                    <li class="divider"></li>
                    <li>
                        <a href="#">
                            <div>
                                <i class="fa fa-twitter fa-fw"></i> 3 New
                                Followers <span class=
                                                "pull-right text-muted small">12 minutes
                                ago</span>
                            </div></a>
                    </li>
                    <li class="divider"></li>
                    <li>
                        <a href="#">
                            <div>
                                <i class="fa fa-envelope fa-fw"></i> Message
                                Sent <span class=
                                           "pull-right text-muted small">4 minutes
                                ago</span>
                            </div></a>
                    </li>
                    <li class="divider"></li>
                    <li>
                        <a href="#">
                            <div>
                                <i class="fa fa-tasks fa-fw"></i> New Task
                                <span class="pull-right text-muted small">4
                                minutes ago</span>
                            </div></a>
                    </li>
                    <li class="divider"></li>
                    <li>
                        <a href="#">
                            <div>
                                <i class="fa fa-upload fa-fw"></i> Server
                                Rebooted <span class=
                                               "pull-right text-muted small">4 minutes
                                ago</span>
                            </div></a>
                    </li>
                    <li class="divider"></li>
                    <li>
                        <a class="text-center" href="#"><strong>See All
                                Alerts</strong> <i class=
                                                   "fa fa-angle-right"></i></a>
                    </li>
                </ul><!-- /.dropdown-alerts -->
            </li><!-- /.dropdown -->
            <li class="dropdown">
                <a class="dropdown-toggle" data-toggle="dropdown" href=
                "#"><i class="fa fa-user fa-fw"></i> <i class=
                                                        "fa fa-caret-down"></i></a>
                <ul class="dropdown-menu dropdown-user">
                    <li>
                        <a href="#"><i class="fa fa-user fa-fw"></i> User
                            Profile</a>
                    </li>
                    <li>
                        <a href="#"><i class="fa fa-gear fa-fw"></i>
                            Settings</a>
                    </li>
                    <li class="divider"></li>
                    <li>
                        <a href="/auth/logout"><i class=
                                                  "fa fa-sign-out fa-fw"></i> Logout</a>
                    </li>
                </ul><!-- /.dropdown-user -->
            </li><!-- /.dropdown -->
        </ul><!-- /.navbar-top-links -->
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-4">

                </div>
            </div>
        </div>
        <div class="navbar-default sidebar" role="navigation">
            <div class="sidebar-nav navbar-collapse">
                <ul class="nav" id="side-menu">
                    <!--
                    <li class="sidebar-search">
                        <div class="input-group custom-search-form">
                            <input class="form-control" placeholder=
                            "Search..." type="text"> <span class=
                            "input-group-btn"><button class=
                            "btn btn-default" type="button"><span class=
                            "input-group-btn"><span class=
                            "input-group-btn"><i class=
                            "fa fa-search"></i></span></span></button></span>
                        </div>
                    </li>
                -->
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
            </div><!-- /.sidebar-collapse -->
        </div><!-- /.navbar-static-side -->
    </nav>
    <div id="page-wrapper">

        <!-- **************SAVE ME************
    <div class="container">
        @if(Session::has('flash_message'))
                <div class="alert alert-success">
                    {{ Session::get('flash_message') }}
                </div>
            @endif
                -->
        <!-- *******************************Foot******************************* -->

        @yield('content')

                <!-- *******************************Foot******************************* -->

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
