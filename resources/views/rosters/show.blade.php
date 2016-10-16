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
                <p class="lead">
                    <a href="{{url('rosters/create')}}"><button class="btn btn-primary">Add Roster</button></a>
                </p>
                <br>
                <div class="panel panel-primary">
                    <div class="table-responsive">
                        <table class="table table-hover" border="0">
                            <thead  style="background-color:#000000; color:white">

                            <tr>
                                <th class="text-center" style="width: 5%;">#</th>
                                <th class="text-center" style="width: 7%;">Thumb</th>
                                <th style="width: 31%;">Name</th>
                                <th style="width: 30%;">Roster</th>
                                <th style="width: 6%;">Year</th>
                                <th style="width: 6%;">Edit</th>
                                <th style="width: 8%;">Quick Edit</th>
                                <th style="width: 7%;">Delete</th>
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
                                                <img src="{{ asset('img/' . 'no_image.jpg') }}" width="60" height="40">
                                            @else
                                                <img src="{{ asset('images/' . $pproperty->picture) }}" width="60" height="40">
                                            @endif
                                        </td>
                                        <td>{{ $stu->name }}</td>
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
