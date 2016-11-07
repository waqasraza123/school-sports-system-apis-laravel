@extends('layouts.master')
@section('content')
    <div class="container-fluid">
        <div style="margin: 20px auto; width: 100%">
        <h2 style="text-align: center">All Sports ({{$year}})</h2>

            {!! Form::open(['route' => 'year-sports']) !!}

            <div class="col-sm-3" style="width:50%" >
                {!! Form::selectYear('year', 2005, \Carbon\Carbon::now()->year,
                \Carbon\Carbon::now()->year, [
               'class' => 'form-control', 'id' => 'select_year_id', 'required' => true, 'onchange' => 'this.form.submit()']) !!}
            </div>
            <div class="col-md-3" style="width:50%">
                {!! Form::select('season_id', $seasonsList, null, ['id' => 'select_season_id', 'class' => 'form-control', 'onchange' => 'this.form.submit()']) !!}
            </div>
            {!! Form::close() !!}
        </div>

        <div class="row">
            <div class="table-responsive .table-striped .table-hover col-md-12">
                <p class="lead" style="margin-top: 20px; margin-bottom: -10px">
                    <a href="{{url('sports/create')}}"><button class="btn btn-primary">Add Sport</button></a>
                </p>
                <br>
                @include('partials.error-messages.success')
                @include('partials.error-messages.error')
                <div class="panel panel-primary">
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead  style="background-color:#000000; color:white">
                                <tr>
                                    <th>#</th>

                                    <th>Name</th>
                                    <th>Season</th>
                                    <th>School</th>
                                    <th>Year</th>
                                    <th>&nbsp;</th>
                                    <th>&nbsp;</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if($sports)
                                    @foreach($seasons as $season)
                                        @foreach($season->sports as $s)
                                            @foreach($s->years as $y)
                                                @if($y->year == $year && $s->school_id == $school_id)
                                                    <tr>
                                                        <td>{{$s->id}}</td>

                                                        <td>{{$s->sport_name}}</td>
                                                        <td>{{$season->name}}</td>
                                                        <td>{{$s->school->name}}</td>
                                                        <td>{{$y->year}}</td>
                                                        <td><a href="{{url('sports/'. $s->id. '/edit')}}" class="btn btn-primary btn-sm">Edit</a></td>
                                                        <td>{!! Form::open([    'method' => 'DELETE','url' => ['/sports', $s->id]]) !!}{!! Form::submit('Delete', ['class' => 'btn btn-danger btn-sm']) !!}{!! Form::close() !!}</td>
                                                    </tr>
                                                @else

                                                @endif
                                            @endforeach
                                        @endforeach
                                    @endforeach
                                @else
                                    <div class="alert alert-danger">No Sports added yet.</div>
                                @endif
                            </tbody>
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
