@extends('layouts.master')

@section('content')

<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <h1>Ads</h1>
            <p class="lead">
                <a href="{{url('ads/create')}}"><button type="button" class="btn btn-success btn-sm">Create Ad</button></a>
            </p>

            <br>
                <div class="panel panel-primary">
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead  style="background-color:#000000; color:white">
                            <tr>
                                <th>#</th>
                                <th></th>
                                <th>Name</th>
                                <th>Url</th>
                                <th>Sponsor</th>
                                <th>&nbsp;</th>
                                <th>&nbsp;</th>
                            </tr>
                            </thead>
                            <tbody>
                                @if($ads)
                                    @foreach($ads as $ad)
                                        <tr>
                                            <td>{{$ad->id}}</td>
                                            <td><img src="{{$ad->image}}" width="50px" height="50px"></td>
                                            <td>{{$ad->name}}</td>
                                            <td>{{$ad->url}}</td>
                                            <td>{{$ad->sponsor->name}}</td>
                                            <td><a class="btn btn-sm btn-default" href='{{url("/ads/".$ad->id."/edit")}}'>Edit</a></td>
                                            <td>
                                                {!! Form::open(['url' => 'ads/'.$ad->id, 'method' => 'DELETE']) !!}
                                                {!! Form::submit('Delete', ['class' => 'btn btn-sm btn-danger']) !!}
                                                {!! Form::close() !!}
                                            </td>
                                        </tr>
                                    @endforeach
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
@stop

@section('footer')
@stop
