@extends('layouts.master')

@section('jqueery')

<script src="{{ URL::asset('js/jquery.js') }}"></script>
	<script>
	
		$(document).ready(function(){
		
           
//			$("#levell").show();
			

			$("#sport_id").change(function(){
				$("#levell").show();
                return false;
	
			});
            
            
            
            
		});
        
        
	
	</script> 

@endsection

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
                <p class="lead">
                    <a href="{{url('rosters/create')}}"><button class="btn btn-primary">Add Roster</button></a>
                </p>
                <br>
                <div class="row">
                    <div class="col-md-4">
                        <form name="" id="sppt" method="post" action="{{ action('RostersController@yearRosters') }}">
                            <select name="sport_id" id="sport_id" class="form-control" onchange="this.form.submit()">
                                <option value="">Select Sport</option>
                                @foreach($sporttt as $sport)
                                    <option value="{{ $sport->id }}"> 
                                        {{ $sport->name }}
                                    </option>
                                @endforeach
                            </select>    
                        </form>                            
                    </div>
                    <div class="col-md-4" id="levell" style="display:none;">
                        <form method="post" action="{{ action('RostersController@yearRosters') }}">
                            <select name="level_id" class="form-control" onchange="this.form.submit()">
                                <option value="">Sport Level</option>
                                @foreach($levels as $level)
                                    @foreach($rosters as $rr)    
                                        @if($level->id == $rr->level_id)  
                                        <option value="{{ $level->id }}"> 
                                            {{ $level->name }}
                                        </option>
                                        @endif  
                                    @endforeach
                                @endforeach
                            </select>
                          <!--  <input type="hidden" name="sid" value="{{ $rr->sport_id }}">  -->
                        </form>
                    </div>
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
                                            {{ Html::linkRoute('rosters.edit', 'Edit', array($stu->id), ['class' => 'btn btn-success btn-sm']) }}
                                        </td>
                                        <td>
                                            {{ Html::linkRoute('rosters.edit', 'Quick Edit', array($stu->id), ['class' => 'btn btn-warning btn-sm']) }}
                                        </td>
                                        <td>
                                            <form method="POST" action="rosters/{{ $stu->id }}">
                                                <input type="hidden" name="_method" value="DELETE">
                                                <input type="submit" class="btn btn-danger btn-sm" name="submit" value="Delete">
                                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                            </form>
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
