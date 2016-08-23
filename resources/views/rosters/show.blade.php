@extends('layouts.master')

@section('content')
<h1>{{ $type->name or "Roster Type"}} Roster</h1>
<p class="lead">
    <button type="button" id="add_new" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#myModal">Add Player?</button>
   
</p>

<ul class="nav nav-tabs">
	 <li class="active"><a href="/rosters/{{ $type->id or 1}}">All</a></li>
	@foreach($levels as $level)
  <li><a href="/rosters/{{ $type->id }}/filter/{{$level['id']}}">{{$level['name']}}</a></li>
    @endforeach
</ul>

@if(session()->has('poss'))
    <div class="poss" style="display: none;"  >{{session('poss')}}</div>
@endif
<br>
	<div class="selected_level_id" style="display: none;"  >1</div>
    <div class="selected_sport_id" style="display: none;"  >{{ $type->id or 1}}</div>
        @if (session()->has('success'))
  <div class="alert alert-success">
            {{Session::get('success')}}

    </div>
    <br>
        @endif

          @if ($rosters->isEmpty() )
<div class="bs-callout bs-callout-warning">
  <h4>No Results</h4>
  Nothing to see here please select another level, or create a player 
     <a  data-toggle="modal" data-target="#myModal">Here</a>
</div>

 @else

                        <div class="panel panel-primary">
                            <div class="table-responsive">
                                <table class="table table-hover sortable" id="myTable">
                                    <thead  style="background-color:#337AB7; color:white">
                                        <tr>
                                            <th class="sorttable_nosort"></th>
                                            {{--<td> {!! Form::open([    'method' => 'put','route' => ['rosters.show', $id_sport]]) !!}{{ Form::hidden('sortby', 'jersey') }}{!! Form::submit('Jersy', ['class' => 'btn btn-danger btn-sm']) !!}{!! Form::close() !!}</td>--}}
                                            <th style="cursor: pointer;">Jersey</th>
                                            <th style="cursor: pointer;">Name</th>
                                            <th style="cursor: pointer;">Position</th>
                                            <th style="cursor: pointer;">Level</th>
                                            <th style="cursor: pointer;">Year</th>
                                            <th style="cursor: pointer;" class="sorttable_nosort">&nbsp;</th>
                                            <th style="cursor: pointer;" class="sorttable_nosort">&nbsp;</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                    	@foreach($rosters as $roster)
                                        <tr>
                                        	<td><img src="{{asset('uploads/'.$roster->photo ) }}" height="42"></td>
                                            <td class="jersey">{{ $roster->jersey }}</td>
                                            <td class="name">{{ $roster->first_name }} {{ $roster->last_name }}</td>
                                            <td class="pos">@if($roster->position != null) {{ $positions[$roster->position]}} @endif</td>
                                            <td class="level">{{ $levels[$roster->level_id - 1]->name}}</td>
                                            <td class="year">{{ $years[$roster->year_id]}}</td>
                                            <td> <button type="button" class="btn btn-primary btn-sm use-address" data-id="{{ $roster->id}}" data-toggle="modal" data-target="#myModal">Edit</button></td>
                                            <td> {!! Form::open([    'method' => 'DELETE','route' => ['rosters.destroy', $roster->id]]) !!}{!! Form::submit('Delete', ['class' => 'btn btn-danger btn-sm']) !!}{!! Form::close() !!}</td>
                                            <td class="id" style="display: none;"  />{{ $roster->id}}</td>
                                            <td class="position" style="display: none;">{{$roster->position}}</td>
                                            <td class="level_id" style="display: none;">{{$roster->level_id}}</td>
                                            <td class="first_name" style="display: none;"  />{{ $roster->first_name}}</td>
                                            <td class="last_name" style="display: none;"  />{{ $roster->last_name}}</td>
                                            <td class="height_feet" style="display: none;"  />{{ $roster->height_feet}}</td>
                                            <td class="height_inches" style="display: none;"  />{{ $roster->height_inches}}</td>
                                            <td class="weight" style="display: none;"  />{{ $roster->weight}}</td>
                                            <td class="hometown" style="display: none;"  />{{ $roster->hometown}}</td>
                                            <td class="verse" style="display: none;"  />{{ $roster->verse}}</td>
                                            <td class="food" style="display: none;"  />{{ $roster->food}}</td>
                                            <td class="years_at_sfc" style="display: none;"  />{{ $roster->years_at_sfc}}</td>
                                            <td class="image_name" style="display: none;"  />{{ $roster->photo}}</td>
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
  @include('rosters.modals.rosters_form')



@stop

@section('footer')
    <script type="text/javascript">
        $('#sport_id').select2();

        $('#level_id').select2();
        $('#year_id').select2();
        $('#position').select2();
        $('#height_feet').select2({
            placeholder: "Select height in feet",
        });
        $('#height_inches').select2({
            placeholder: "Select height in inches",
        });
        $('#weight').select2({
            placeholder: "Select weight",
        });

    </script>
    @if ($errors->has('position'))
        <script type="text/javascript">
            $('#position').val('').change();
        </script>
    @endif
    @if ($errors->has('heightfeet'))
        <script type="text/javascript">
            $('#height_feet').val('').change();
        </script>
    @endif
    @if ($errors->has('heightinches'))
        <script type="text/javascript">
            $('#height_inches').val('').change();
        </script>
    @endif
    @if ($errors->has('weight'))
        <script type="text/javascript">
            $('#weight').val('').change();
        </script>
    @endif
    <script src="/dist/js/sb-rosters-2.js"></script>
          @if ($errors->has())

              <script>
                  //set the image when redirected back with errors
                  $('#photo').attr('src',document.getElementById('invisible_image').value);

                  //open modal when error is made
                  //display errors in modal and hid them with animation slide up in 3 sec
                  $('div.alert').delay(4000).slideUp(300);
                  $('#myModal').modal();
                  $('.myModal').show();

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
