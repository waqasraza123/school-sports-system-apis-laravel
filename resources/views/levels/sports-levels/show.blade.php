@extends('layouts.master')
@section('content')
<div class="container-fluid">
<div style="margin: 20px auto; width: 1000px">  <div style="width:50%">
    <h2 style="text-align: center">Available Sport Levels</h2>
        </div>
      </div>
        <div class="row">
            <div class="table-responsive .table-striped .table-hover col-md-12">
                <p class="lead">
                <a href="{{url('sports-levels/create')}}"><button class="btn btn-primary">Add Sport's Level</button></a>
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
                            <th>&nbsp;</th>
                            <th>&nbsp;</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if($levels)
                            @foreach($levels as $level)
                                <tr><td>{{$level->id}}</td>
                                <td>{{$level->name}}</td>
                                <td><a href="{{url('sports-levels/'. $level->id. '/edit')}}" class="btn btn-primary btn-sm">Edit</a></td>
                                <td>{!! Form::open(['method' => 'DELETE','url' => ['/sports-levels', $level->id]]) !!}{!! Form::submit('Delete', ['class' => 'btn btn-danger btn-sm']) !!}{!! Form::close() !!}</td>
                                </tr>
                            @endforeach
                        @else
                            <div class="alert alert-danger">No levels added yet.</div>
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
@endsection
