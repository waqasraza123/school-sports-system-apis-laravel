@extends('layouts.master')

@section('content')

{!! Form::open([
    'route' => 'rosters.store'

]) !!}

<div class="form-group">
    {!! Form::label('title', 'Sport:', ['class' => 'control-label']) !!}
    {{ Form::select('sport_id', $sports), ['class' => 'form-control'] }}
</div>
<div class="form-group">
    {!! Form::label('title', 'Level:', ['class' => 'control-label']) !!}
     {{ Form::select('level_id', $levels), ['class' => 'form-control'] }}
<div class="form-group">
    {!! Form::label('title', 'Year:', ['class' => 'control-label']) !!}
     {{ Form::select('year_id', $years), ['class' => 'form-control'] }}
</div>

<div class="form-group">
    {!! Form::label('title', 'First Name:', ['class' => 'control-label']) !!}
    {!! Form::text('first_name', null, ['class' => 'fn']) !!}
</div>
<div class="form-group">
    {!! Form::label('title', 'Last Name:', ['class' => 'control-label']) !!}
    {!! Form::text('last_name', null, ['class' => 'ln']) !!}
</div>
<div class="form-group">
    {!! Form::label('title', 'Jersey:', ['class' => 'control-label']) !!}
    {!! Form::text('jersey', null, ['class' => 'jersey']) !!}
</div>

<div class="form-group">
    {!! Form::label('title', 'Position:', ['class' => 'control-label']) !!}
    {!! Form::text('position', null, ['class' => 'form-control']) !!}
</div>
<div class="form-group">
    {!! Form::label('title', 'Height:', ['class' => 'control-label']) !!}
    {!! Form::text('height_feet', null, ['class' => 'form-control']) !!}
    {!! Form::text('height_inches', null, ['class' => 'form-control']) !!}
</div>
<div class="form-group">
    {!! Form::label('title', 'Weight:', ['class' => 'control-label']) !!}
    {!! Form::text('weight', null, ['class' => 'form-control']) !!}
</div>
<div class="form-group">
    {!! Form::label('title', 'Hometown:', ['class' => 'control-label']) !!}
    {!! Form::text('hometown', null, ['class' => 'form-control']) !!}
</div>
<div class="form-group">
    {!! Form::label('title', 'Years at SFC:', ['class' => 'control-label']) !!}
    {!! Form::text('years_at_sfc', null, ['class' => 'form-control']) !!}
</div>
<div class="form-group">
    {!! Form::label('title', 'Verse:', ['class' => 'control-label']) !!}
    {!! Form::text('verse', null, ['class' => 'form-control']) !!}
</div>
<div class="form-group">
    {!! Form::label('title', 'Food:', ['class' => 'control-label']) !!}
    {!! Form::text('food', null, ['class' => 'form-control']) !!}
</div>
<div class="form-group">
    {!! Form::label('title', 'Photo:', ['class' => 'control-label']) !!}
    {!! Form::text('photo', null, ['class' => 'picture']) !!}
</div>


{!! Form::submit('Create Player', ['class' => 'btn btn-primary']) !!}

{!! Form::close() !!}
</div>
@stop
