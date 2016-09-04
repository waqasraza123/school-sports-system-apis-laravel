@extends('layouts.master')

@section('content')

<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <h1>Sponsors</h1>
            <p class="lead">
                <a href="{{url('sponsors/create')}}"><button type="button" class="btn btn-primary btn-sm">Add Sponsor</button></a>
            </p>

            <br>
            @include('partials.error-messages.success')
            @include('partials.error-messages.error')
                <div class="panel panel-primary">
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead  style="background-color:#337AB7; color:white">
                            <tr>
                                <th> </th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Address</th>
                                <th>Tagline</th>
                                <th>Phone</th>
                                <th>&nbsp;</th>
                                <th>&nbsp;</th>
                            </tr>
                            </thead>
                            <tbody>

                            @foreach($sponsors as $sponsor)
                                <tr>
                                    @if($sponsor->photo)
                                        <td><img src="{{$sponsor->logo}}"  height="42"></td>
                                    @else
                                        <td><img src="{{asset('uploads/def.png') }}"  height="42"></td>
                                    @endif
                                    <td class="jersey">{{ $sponsor->name }}</td>
                                    <td class="first_name">{{ $sponsor->email }}</td>
                                    <td class="position">{{ $sponsor->address}}</td>
                                    <td class="position">{{ $sponsor->tagline}}</td>
                                    <td class="position">{{ $sponsor->phone}}</td>
                                    <td> <a href="{{url('sponsors/'.$sponsor->id.'/edit')}}"><button type="button" class="btn btn-primary btn-sm edit_school">Edit</button></a></td>
                                    <td> {!! Form::open([    'method' => 'DELETE','url' => ['sponsors/'.$sponsor->id]]) !!}{!! Form::submit('Delete', ['class' => 'btn btn-danger btn-sm']) !!}{!! Form::close() !!}</td>
                                </tr>
                            @endforeach

                            </tbody>
                        </table>
                    </div>
                </div>
        </div>
    </div>

</div>
    </div>
</div>
@stop

@section('footer')
    @include('partials.error-messages.footer-script')
@stop
