@extends('layouts.master')
@section('content')
    <div class="container-fluid">

        <div style="margin: 20px auto; width: 300px">
            <h2 style="
            float: left">All Staff ({{$year}})</h2>
            {!! Form::open(['route' => 'year-staff']) !!}
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
                <a href="{{url('staff/create')}}"><button class="btn btn-primary">Add Staff</button></a>
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
                            <th>Title</th>
                            <th>Phone</th>
                            <th>Email</th>
                            <th>School</th>
                            <th>&nbsp;</th>
                            <th>&nbsp;</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if($staff)
                            @foreach($staff as $s)
                                @foreach($s->years as $y)
                                    @if($y->year == $year && $y->year_type == 'App\Staff')
                                        <tr>
                                            <td>{{$s->id}}</td>
                                            @if($s->photo)
                                                <td><img src="{{asset($s->photo)}}" height="50px" width="50px" alt="image"></td>
                                            @else
                                                <td><img src="{{asset('uploads/def.png')}}" height="50px" width="50px" alt="image"></td>
                                            @endif
                                            <td>{{$s->title}}</td>
                                            <td>{{$s->phone}}</td>
                                            <td>{{$s->email}}</td>
                                            <td>{{$s->school->name}}</td>
                                            <td><a href="{{url('staff/'. $s->id. '/edit')}}" class="btn btn-primary btn-sm">Edit</a></td>
                                            <td>{!! Form::open([    'method' => 'DELETE','url' => ['/staff', $s->id]]) !!}{!! Form::submit('Delete', ['class' => 'btn btn-danger btn-sm']) !!}{!! Form::close() !!}</td>
                                        </tr>
                                    @else
                                        {{--<div class="alert alert-danger" class="no-staff">No Staff for {{$y->year}}</div>--}}
                                    @endif
                                @endforeach
                            @endforeach
                        @else
                            <div class="alert alert-danger">No Staff added yet.</div>
                        @endif
                    </tbody>
                </table>
            </div>
</div>
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
