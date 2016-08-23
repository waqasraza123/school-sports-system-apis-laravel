@extends('layouts.master')

@section('content')
    <h1>@if (isset($type->name)){{ $type->name }} @endif News</h1>
    <p class="lead">
        <button type="button" id="add_news" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#newsModal">Add News?</button>

    </p>

    <br>
    @if (isset($type->name))<div class="selected_sport_id" style="display: none;"  >{{ $type->id }}</div>@endif
    @if (session()->has('success'))
        <div class="alert alert-success">
            {{Session::get('success')}}

        </div>
        <br>
    @endif
    <table class="table table-hover" id="myTable">
        <tbody>
            @if($news)
                @foreach($news as $new)
            <tr>
                <td class="id" style="display: none;" >{{ $new->id}}</td>
                <td class="sports_id" style="display: none;" >{{ json_encode($new->sports->lists('id'))}} </td>
                <td class="games_ids" style="display: none;" >{{ json_encode($new->games->lists('id'))}} </td>
                <td class="levels_ids" style="display: none;" >{{ json_encode($new->levels->lists('id'))}} </td>
                <td class="rosters_ids" style="display: none;" >{{ json_encode($new->rosters->lists('id'))}} </td>
                <td class="title" style="display: none;" >{{ $new->title}}</td>
                <td class="photo" style="display: none;" >{{asset('uploads/news/'.$new->image ) }}</td>
                <td class="author" style="display: none;" >{{ $new->author}}</td>
                <td class="news_date" style="display: none;" >{{ $new->news_date}}</td>
                <td class="category" style="display: none;" >{{ $new->category}}</td>
                <td class="intro" style="display: none;" >{{ $new->intro}}</td>
                <td class="content" style="display: none;" >{{ $new->content}}</td>
                <td class="link" style="display: none;" >{{ $new->link}}</td>
                <td>
                    {{--{{ dd($new->sports->lists('id')->lists('id')) }}--}}
                    <table>
                        <tr>
                            <td> <h3>
                                    {{$new->news_date}} {{$new->title}}
                                </h3></td>

                            <td>
                            <div style="padding-left: 15px;">  
                            <button type="button" class="btn btn-primary btn-sm edit_news" data-id="{{ $new->id}}" data-toggle="modal" data-target="#newsModal">Edit</button>
                            </div>
                            </td>
                            <td>
                             <div style="padding-left: 15px;"> 
                            {!! Form::open([    'method' => 'DELETE','route' => ['news.destroy', $new->id]]) !!}{!! Form::submit('Delete', ['class' => 'btn btn-danger btn-sm']) !!}{!! Form::close() !!}
                            </div>
                            </td>
                        </tr>
                    </table>



                <div class="col-lg-2">
                        <img class="col-lg-12" id="photo1" height="100"
                             src="{{asset('uploads/news/'.$new->image ) }}">
                        <a href="{{$new->link}}" class="col-lg-12">{{$new->link}}</a>
                    </div>
                    <label class="col-lg-10" style="font-size: 12px"> {{$new->author}}</label>
                        <p  style="text-align:justify">{!! $new->content !!}</p>
                        <p class="col-lg-12" style="font-size: 24px">
                            @foreach($new->sports as $sport_tag)<span class="label label-info" style="color: black; font-weight: lighter; font-size: 14px" >{{$sport_tag->name}}</span> @endforeach
                            @foreach($new->games as $games_tag)<span class="label label-info" style="color: black; font-weight: lighter; font-size: 14px">{{$schools[$games_tag->opponents_id]." ".$games_tag->game_date}}</span> @endforeach
                            @foreach($new->levels as $levels_tag)<span class="label label-info" style="color: black; font-weight: lighter; font-size: 14px">{{$levels_tag->name}}</span> @endforeach
                            @foreach($new->rosters as $roster_tag)<span class="label label-info" style="color: black; font-weight: lighter; font-size: 14px">{{$roster_tag->first_name}} {{$roster_tag->last_name}}</span> @endforeach
                        </p>
                </td>
                 </tr>
                @endforeach
                @else
                <h2>There are no results yet.</h2>
            @endif
        </tbody>
    </table>
        <!-- /.table-responsive -->

    <!-- /.panel-body -->
    </div>
    <!-- /.panel -->
    </div>

    @include('news.modals.news_form')


@stop

@section('footer')
    <script>
        // Replace the <textarea id="editor1"> with a CKEditor
        // instance, using default configuration.
        CKEDITOR.replace( 'content' );
    </script>
    <script type="text/javascript">
        $('#sport_id').select2();
        $('#game_id').select2();
        $('#level_id').select2();
        $('#roster_id').select2();

        $( "#news_date" ).datepicker({
            changeMonth: true,
            changeYear: true,
            dateFormat: 'yy-mm-dd'
        });

    </script>
    <script src="/dist/js/sb-news-2.js"></script>
    @if ($errors->has())

        <script>
            $('#photo').attr('src',document.getElementById('news_invisible_image').value);
            //open modal when error is made
            //display errors in modal and hid them with animation slide up in 3 sec
            $('div.alert').delay(4000).slideUp(300);
            $('#newsModal').modal();
            $('.newsModal').show();

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
