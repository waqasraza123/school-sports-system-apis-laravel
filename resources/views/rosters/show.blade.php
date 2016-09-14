@extends('layouts.master')
@section('content')
    <div class="container-fluid">
        @include('partials.error-messages.success')
        @include('partials.error-messages.error')
        <h2 style="text-align: center">All Rosters of year ({{$year}})</h2>
        <div class="row">
            {!! Form::open(['route' => 'year-rosters']) !!}
            <div class="col-md-3 col-md-offset-1">
                {!! Form::selectYear('year', 2005, \Carbon\Carbon::now()->year,
                \Carbon\Carbon::now()->year, [
               'class' => 'form-control', 'id' => 'select_year_id', 'required' => true, 'onchange' => 'this.form.submit()']) !!}
            </div>
            <div class="col-md-3">
                {!! Form::select('level_id', $levelsList, null, ['id' => 'select_level_id', 'class' => 'form-control', 'onchange' => 'this.form.submit()']) !!}
            </div>

            <div class="col-md-3">
                {!! Form::select('sport_id', $sportsList, null, ['id' => 'select_sport_id', 'class' => 'form-control', 'onchange' => 'this.form.submit()']) !!}
            </div>
            {!! Form::close() !!}
        </div>

        <div class="row">
            <div class="table-responsive .table-striped .table-hover col-md-12">
                <p class="lead">
                <a href="{{url('rosters/create')}}"><button class="btn btn-primary">Add Roster</button></a>
</p>
                <br>

                @include('partials.error-messages.success')
                @include('partials.error-messages.error')
                <div class="panel panel-primary">
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead  style="background-color:#000000; color:white">
                        <th>#</th>

                        <th>Name</th>
                        <th>&nbsp;</th>
                        <th>&nbsp;</th>
                        <th>&nbsp;</th>
                    </tr>
                    </thead>
                    <tbody>
                    @if($sports)
                        @foreach($sports as $s)

                            @foreach($rosters as $r)

                                @foreach($levels as $level)

                                    @if($r->sport_id == $s->id && $level->id == $r->level_id)
                                        @if($r->years)
                                            @foreach($r->years as $y)

                                                @if($y->year == $year)

                                                    <tr>
                                                        <td>{{$r->id}}</td>
                                                      
                                                        <td>{{$r->name}}</td>
                                                        <td><a href="{{url('rosters/'. $r->id. '/edit')}}" class="btn btn-primary btn-sm">Edit</a></td>
                                                        <td>{!! Form::open([    'method' => 'DELETE','url' => ['/rosters', $r->id]]) !!}{!! Form::submit('Delete', ['class' => 'btn btn-danger btn-sm']) !!}{!! Form::close() !!}</td>
                                                        <td><a href="{{route('roster-students', [$r->id])}}" class="btn btn-sm btn-default">Add Students</a></td>
                                                    </tr>
                                                @else

                                                @endif
                                            @endforeach
                                        @endif
                                    @endif
                                @endforeach
                            @endforeach
                        @endforeach
                    @else
                        <div class="alert alert-danger">Please add some sports first.</div>
                    @endif
                </table>
            </div>

        </div>
    </div>
  </div>
</div>
@endsection
@section('footer')
    @include('partials.error-messages.footer-script')
    <script>
        $("#select_year_id").val(<?php echo $year?>);
    </script>
@endsection
