@extends('layouts.master')

@section('content')

    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <h1>Locations</h1>
                <p class="lead">
                    <button type="button" id="add_new_location" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#locationModal">Add Location?</button>
                </p>

                <br>
                @if (session()->has('success'))
                    <div class="alert alert-success">
                        {{Session::get('success')}}

                    </div>
                    <br>
                @endif

                @if ($locations->isEmpty() )
                    <div class="bs-callout bs-callout-warning">
                        <h4>No Results</h4>
                        Nothing to see here please create a location
                        <a  data-toggle="modal" data-target="#schoolModal">Here</a>
                    </div>

                @else

                    <div class="panel panel-primary">
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead  style="background-color:#337AB7; color:white">
                                <tr>
                                    <th>Name</th>
                                    <th>City</th>
                                    <th>State</th>
                                    <th>&nbsp;</th>
                                    <th>&nbsp;</th>
                                </tr>
                                </thead>
                                <tbody>

                                @foreach($locations as $location)
                                    <tr>
                                        <td class="name">{{ $location->name }}</td>
                                        <td class="city">{{ $location->city }}</td>
                                        <td class="state">{{ $location->state}}</td>
                                        <td> <button type="button" class="btn btn-primary btn-sm edit_location" data-id="{{ $location->id}}" data-toggle="modal" data-target="#locationModal">Edit</button></td>
                                        <td> {!! Form::open([    'method' => 'DELETE','route' => ['locations.destroy', $location->id]]) !!}{!! Form::submit('Delete', ['class' => 'btn btn-danger btn-sm']) !!}{!! Form::close() !!}</td>
                                        <td class="id" style="display: none;"  />{{ $location->id}}</td>
                                        <td class="adress" style="display: none;"  />{{  $location->adress}}</td>

                                        <td class="state" style="display: none;"  />{{ $location->state}}</td>
                                        <td class="zip" style="display: none;"  />{{ $location->zip}}</td>
                                        <td class="lat" style="display: none;"  />{{ $location->lat}}</td>
                                        <td class="lon" style="display: none;"  />{{  $location->lon}}</td>
                                    </tr>
                                @endforeach
                                @endif

                                </tbody>
                            </table>
                        </div>
                        <!-- /.table-responsive -->
                    </div>
                    <!-- /.panel-body -->
            </div>
            <!-- /.panel -->
        </div>

        <!-- Modal -->
        @include('locations.modals.locations_form')
            </div>
        </div>
    </div>

@stop

@section('footer')
    <script src="/dist/js/sb-locations-2.js"></script>
    @if ($errors->has())

        <script>
            //open modal when error is made
            //display errors in modal and hid them with animation slide up in 3 sec
            $('div.alert').delay(4000).slideUp(300);
            $('#locationModal').modal();
            $('.locationModal').show();

            {{ $errors = null }}
        </script>

    @endif

    @if (session()->has('success'))
        <script>
            //display success message in the top when successfully updated roster
            $('div.alert').delay(4000).slideUp(300);
        </script>
    @endif
@stop
