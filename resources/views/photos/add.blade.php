@extends('layouts.master')
@section('content')
    <div class="container-fluid">
        @include('partials.error-messages.error')
        @include('partials.error-messages.success')
        <div class="row">

        </div>
    </div>
@endsection
@section('footer')
    @include('partials.error-messages.footer-script')
@endsection