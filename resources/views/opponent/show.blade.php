@extends('layouts.master')
@section('content')
    <div class="container-fluid">

        <div style="margin: 20px auto; width: 300px">
            <h2 style="
            float: left">All Opponents ({{$year}})</h2>
            {!! Form::open(['route' => 'year-opponents']) !!}
            <div class="col-sm-6" style="float: left; margin: 20px">
                {!! Form::selectYear('year', 2005, \Carbon\Carbon::now()->year,
                \Carbon\Carbon::now()->year, [
               'class' => 'form-control col-xs-2', 'id' => 'select_year_id', 'required' => true, 'onchange' => 'this.form.submit()']) !!}
            </div>
            {!! Form::close() !!}
        </div>
        <div class="row">
            <div class="table-responsive .table-striped .table-hover col-md-12">
                <br>
                <p class="lead">
                <a href="{{url('opponents/create')}}"><button class="btn btn-primary">Add opponents</button></a>
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
                            <th>Image</th>
                            <th>Name</th>
                            <th>Nick</th>
                            <th>School</th>
                            <th>&nbsp;</th>
                            <th>&nbsp;</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if($opponents)
                            @foreach($opponents as $s)
                                @foreach($s->years as $y)
                                    @if($y->year == $year && $y->year_type == 'App\Opponent')
                                        <tr>
                                            <td>{{$s->id}}</td>
                                            @if($s->photo)
                                                <td><img src="{{asset('uploads/opponents/'.$s->photo)}}" height="50px" width="50px" alt="image"></td>
                                            @else
                                                <td><img src="{{asset('uploads/def.png')}}" height="50px" width="50px" alt="image"></td>
                                            @endif
                                            <td>{{$s->name}}</td>
                                            <td>{{$s->nick}}</td>
                                            <td>{{$s->school->name}}</td>
                                            <td><a href="{{url('opponents/'. $s->id. '/edit')}}" class="btn btn-primary btn-sm">Edit</a></td>
                                            <td>{!! Form::open([    'method' => 'DELETE','url' => ['/opponents', $s->id]]) !!}{!! Form::submit('Delete', ['class' => 'btn btn-danger btn-sm']) !!}{!! Form::close() !!}</td>
                                        </tr>
                                    @else
                                        {{--<div class="alert alert-danger" class="no-opponents">No opponents for {{$y->year}}</div>--}}
                                    @endif
                                @endforeach
                            @endforeach
                        @else
                            <div class="alert alert-danger">No opponents added yet.</div>
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
