@extends('layouts.master')

@section('content')



    <h1>Opponents</h1>
    <p class="lead">
        <button type="button" id="add_new_school" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#schoolModal">Add Opponent?</button>

    </p>

    <br>
    @if (session()->has('success'))
        <div class="alert alert-success">
            {{Session::get('success')}}

        </div>
        <br>
    @endif

    @if ($schools->isEmpty() )
        <div class="bs-callout bs-callout-warning">
            <h4>No Results</h4>
            Nothing to see here please create an Opponent
            <a  data-toggle="modal" data-target="#schoolModal">Here</a>
        </div>

    @else

        <div class="panel panel-primary">
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead  style="background-color:#337AB7; color:white">
                    <tr>
                        <th> </th>
                        <th>Name</th>
                        <th>City</th>
                        <th>State</th>
                        <th>Website</th>
                        <th>&nbsp;</th>
                        <th>&nbsp;</th>
                    </tr>
                    </thead>
                    <tbody>

                    @foreach($schools as $school)
                        <tr>
                            <td><img src="{{asset('uploads/schools/'.$school->school_logo ) }}"  height="42"></td>
                            <td class="jersey">{{ $school->name }}</td>
                            <td class="first_name">{{ $school->city }}</td>
                            <td class="position">{{ $school->state}}</td>
                            <td class="position">{{ $school->website}}</td>
                            <td> <a href="{{url('schools/edit', [$school->id])}}"><button type="button" class="btn btn-primary btn-sm edit_school">Edit</button></a></td>
                            <td> {!! Form::open([    'method' => 'DELETE','route' => ['schools.destroy', $school->id]]) !!}{!! Form::submit('Delete', ['class' => 'btn btn-danger btn-sm']) !!}{!! Form::close() !!}</td>
                            <td class="id" style="display: none;"  />{{ $school->id}}</td>
                            <td class="name" style="display: none;"  />{{  $school->name}}</td>
                            <td class="short_name" style="display: none;"  />{{ $school->short_name}}</td>
                            <td class="mascot_name" style="display: none;"  />{{ $school->mascot_name}}</td>
                            <td class="athletics_logo" style="display: none;"  />{{asset('uploads/schools/'.$school->athletics_logo ) }}</td>
                            <td class="bio" style="display: none;"  />{{ $school->bio}}</td>
                            <td class="adress" style="display: none;"  />{{  $school->adress}}</td>
                            <td class="city" style="display: none;"  />{{ $school->city}}</td>
                            <td class="state" style="display: none;"  />{{ $school->state}}</td>
                            <td class="zip" style="display: none;"  />{{ $school->zip}}</td>
                            <td class="phone" style="display: none;"  />{{ $school->phone}}</td>
                            <td class="website" style="display: none;"  />{{  $school->website}}</td>
                            <td class="twitter" style="display: none;"  />{{ $school->twitter}}</td>
                            <td class="facebook" style="display: none;"  />{{ $school->facebook}}</td>
                            <td class="instagram" style="display: none;"  />{{ $school->instagram}}</td>
                            <td class="youtube" style="display: none;"  />{{ $school->youtube}}</td>
                            <td class="vimeo" style="display: none;"  />{{ $school->vimeo}}</td>
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
        @include('schools.modals.schools_form')



@stop

@section('footer')
    <script src="/dist/js/sb-schools-2.js"></script>
    @if ($errors->has())

        <script>
            //set the image when redirected back with errors
            $('#photo').attr('src',document.getElementById('school_invisible_image').value);

            //open modal when error is made
            //display errors in modal and hid them with animation slide up in 3 sec
            $('div.alert').delay(4000).slideUp(300);
            $('#schoolModal').modal();
            $('.schoolModal').show();

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
