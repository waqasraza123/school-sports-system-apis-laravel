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
          <li>
              <a href="/home"><i class="fa fa-dashboard fa-fw"></i>
                  Dashboard</a>
          </li>
            <li>
                <a href="/home"><i class="fa fa-cogs fa-fw"></i>
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
                <a href="/games"><i class="fa fa-edit fa-fw"></i>
                    Games</a>
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
                <a href="/albums"><i class="fa fa-edit fa-fw"></i>
                    Albums</a>
            </li>

            <li>
                <a href="/locations"><i class="fa fa-edit fa-fw"></i>
                    Schedule Locations</a>
            </li>
            <li>
                <a href="/news"><i class="fa fa-edit fa-fw"></i>
                    News</a>
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
