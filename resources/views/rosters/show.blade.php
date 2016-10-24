@extends('layouts.master')

@section('content')
    <div class="container-fluid">
        @include('partials.error-messages.success')
        @include('partials.error-messages.error')
        <h2 style="text-align: center">All Rosters of year ({{ $year }})</h2>
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
                <br>
                <div class="row">
                    <div class="col-md-4">
                        <a href="{{ route('students.create') }}" class="btn btn-primary">Add Student</a>
                    </div>
                </div>    
                <br>
                <div class="panel panel-primary">
                    <div class="table-responsive">
                        <table class="table table-hover" border="0">
                            <thead  style="background-color:#000000; color:white">

                            <tr>
                                <th>#</th>
                                <th>Photo</th>
                                <th>Name</th>
                                <th>Level</th>
                                <th>Sport</th>
                                <th>Roster</th>
                                <th>Year</th>
                                <th></th>
                                <th></th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody>
                            @php
                                $i = 1
                            @endphp

                            @foreach($rosters as $r)
                                @foreach($r->students as $stu)
                                    <tr>
                                        <td class="text-center">{{ $i++ }}</td>
                                        <td class="text-center">
                                            @if($stu->photo == "")
                                                <img src="{{ asset('uploads/' . 'def.png') }}" width="60" height="40">
                                            @else
                                                <img src="{{$stu->photo}}" width="60" height="40">
                                            @endif
                                        </td>
                                        <td>{{ $stu->name }}</td>
                                        @foreach($levels as $level)
                                            @if($level->id == $r->level_id)
                                                <td>{{ $level->name }}</td>
                                            @endif
                                        @endforeach
                                        @foreach($sports as $sport)
                                            @if($sport->id == $r->sport_id)
                                                <td>{{ $sport->name }}</td>
                                            @endif
                                        @endforeach
                                        <td>{{ $r->name }}</td>
                                        <td>{{ $stu->academic_year }}</td>
                                        <td>
                                            <a href="{{url('students/'. $stu->id. '/edit')}}" class="btn btn-primary btn-sm">Edit</a>
                                        </td>
                                        <td>
                                            {{ Html::linkRoute('rosters.edit', 'Quick Edit', array($stu->id), ['class' => 'btn btn-warning btn-sm']) }}
                                        </td>
                                        <td>
                                            {!! Form::open([    'method' => 'DELETE','url' => ['/students', $stu->id]]) !!}{!! Form::submit('Delete', ['class' => 'btn btn-danger btn-sm']) !!}{!! Form::close() !!}
                                        </td>
                                    </tr>
                                @endforeach
                            @endforeach
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
