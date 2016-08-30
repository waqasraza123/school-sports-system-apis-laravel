@extends('layouts.master')
@section('content')
    <div class="container-fluid">
        @include('partials.error-messages.success')
        @include('partials.error-messages.error')
        <div>
            <h2 style="
            text-align: center">All Sports Levels</h2>
        </div>
        <div class="row">
            <div class="table-responsive .table-striped .table-hover col-md-12">
                <br>
                <a href="{{url('sports-levels/create')}}"><button class="btn btn-primary">Add Sport's Level</button></a>
                <br>

                <table class="table">
                    <thead>
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
@endsection
@section('footer')
    @include('partials.error-messages.footer-script')
@endsection