<div class="main-sidebar">
    <!-- Inner sidebar -->
    <div class="sidebar">
        <!-- user panel (Optional) -->
        <div class="user-panel">
            <div class="pull-left image">
                <img src="{{$currentSchool->school_logo}}" class="img-circle" alt="User Image">
            </div>
            <div class="pull-left info">
                <p>{{$currentSchool->name}}</p>

                <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
        </div><!-- /.user-panel -->

        <ul class="sidebar-menu" id="side-menu">
            @if($superAdmin)
                <li>
                    <a href="/schools"><i class="fa fa-dashboard fa-fw"></i>
                        Schools</a>
                </li>
            @elseif($admin)
                <li>
                    <a href="{{route('school-show-add-users', [$currentSchool->id])}}"><i class="fa fa-dashboard fa-fw"></i>
                        Manage Users</a>
                </li>
            @endif
              <li>
                  <a href="/home"><i class="fa fa-dashboard fa-fw"></i>
                      Dashboard</a>
              </li>
            <li>
                <a href="/settings"><i class="fa fa-comment-o fa-fw"></i>
                    Push Notifications</a>
            </li>
            <li>
                <a href="/games"><i class="fa fa-calendar fa-fw"></i>
                    Schedules</a>
            </li>
            <li>
                <a href="/rosters"><i class="fa fa-users fa-fw"></i>
                    Rosters</a>
            </li>
            <li>
                <a href="/news"><i class="fa fa-newspaper-o fa-fw"></i>
                    News</a>
            </li>
            <li>
                <a href="/albums"><i class="fa fa-camera-retro fa-fw"></i>
                    Photos</a>
            </li>
            <li>
                <a href="/videos"><i class="fa fa-video-camera fa-fw"></i>
                    Videos</a>
            </li>
            <li>
                <a href="/sports"><i class="fa fa-futbol-o fa-fw"></i>
                    Sports</a>
            </li>
            <li>
                <a href="/staff"><i class="fa fa-user-plus fa-fw"></i>
                    Staff</a>
            </li>
            <li>
                <a href="/sponsors"><i class="fa fa-money  fa-fw"></i>
                    Sponsors</a>
            </li>
            <li>
                <a href="/settings"><i class="fa fa-cogs fa-fw"></i>
                    Settings</a>
            </li>
<!--
            <li>
                <a href="/sponsors"><i class="fa fa-cogs fa-fw"></i>
                    Add sponsor</a>
            </li>


            <li>
                <a href="/ads"><i class="fa fa-edit fa-fw"></i>
                    Ads</a>
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

-->

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
