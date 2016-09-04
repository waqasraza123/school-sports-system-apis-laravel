<div class="main-sidebar">
    <!-- Inner sidebar -->
    <div class="sidebar">
        <!-- user panel (Optional) -->
        <div class="user-panel">
            <div class="pull-left image">
                <img src="{{asset('/uploads/schools/'.$currentSchool->school_logo)}}" class="img-circle" alt="User Image">
            </div>
            <div class="pull-left info">
                <p>{{$currentSchool->name}}</p>

                <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
        </div><!-- /.user-panel -->

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
                <a href="/sponsors"><i class="fa fa-edit fa-fw"></i>
                    Sponsors</a>
            </li>

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
                    Fall Sports<span class="fa arrow treeview"></span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
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
                    Winter Sports<span class="fa arrow treeview"></span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
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
                    Spring Sports<span class="fa arrow treeview"></span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
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
<style>
    .active-menu {
        color: #fff;
        background: #00a65a;
        border-left-color: #00a65a;
    }
</style>