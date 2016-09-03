@extends('layouts.master')
@section('content')
    <div class="container-fluid">
        @include('partials.error-messages.success')
        @include('partials.error-messages.error')
        <h2 style="text-align: center">All Students of year ({{$year}})</h2>
        <div class="row">
            @include('students.filters.form')
        </div>

        <div class="row">
            <div class="table-responsive .table-striped .table-hover col-md-12">
                <br>
                <a href="{{url('students/create')}}"><button class="btn btn-primary">Add Student</button></a>
                <br>

                <table class="table">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>Photo</th>
                        <th>Name</th>
                        <th>Height</th>
                        <th>Academic Year</th>
                        <th>&nbsp;</th>
                        <th>&nbsp;</th>
                    </tr>
                    </thead>
                    <tbody>
                        @if($yearId)

                            @if($sportId)
                                @include('students.filters.sport')

                            @elseif($levelId)
                                @include('students.filters.level')

                            @elseif($rosterId)
                                @include('students.filters.roster')
                            @else
                                @include('students.filters.year')
                            @endif
                        @endif
                    </tbody>
                </table>
            </div>

        </div>
    </div>
@endsection
@section('footer')
    @include('partials.error-messages.footer-script')
    <script>
        $("#select_year_id").val(<?php echo $year?>);
    </script>
@endsection