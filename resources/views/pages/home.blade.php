@extends('layouts.master')

@section('content')
    @if (session()->has('success'))
        <div class="alert alert-danger">
            {{Session::get('success')}}
        </div>
        <br>
    @endif
    @if(Auth::check())
        @if(Auth::user()->email != 'admin@gmail.com')
            <h1>Your School Info</h1>
            @include('schools.update_schools_form', array('schools' => $userSchool, 'social' => $social))
        @else
            @include('schools.show', array('schools' => $schools))
        @endif
    @endif
@stop

@section('footer')
    @if (session()->has('success'))
        <script>
            //display success message in the top when successfully updated roster
            $('div.alert').delay(4000).slideUp(300);
        </script>
    @endif
@stop