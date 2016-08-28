@extends('layouts.master')
@section('content')
    <div class="container-fluid">
        <div class="row">

            @include('partials.error-messages.success')
            @include('partials.error-messages.error')

            <h2 style="text-align: center">All Staff</h2>
        </div>
    </div>
@endsection
@section('footer')
    @include('partials.error-messages.footer-script')
@endsection