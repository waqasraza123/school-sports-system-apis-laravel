{!! Form::open(['url' => 'students/filter']) !!}
<div class="col-md-3">
    {!! Form::selectYear('year', 2005, \Carbon\Carbon::now()->year,
    \Carbon\Carbon::now()->year, [
   'class' => 'form-control', 'id' => 'select_year_id', 'required' => true, 'onchange' => 'this.form.submit()']) !!}
</div>
<div class="col-md-3">
    {!! Form::select('level_id', $levelsList, null, ['id' => 'select_level_id', 'class' => 'form-control', 'onchange' => 'this.form.submit()']) !!}
</div>

<div class="col-md-3">
    {!! Form::select('sport_id', $sportsList, null, ['id' => 'select_sport_id', 'class' => 'form-control', 'onchange' => 'this.form.submit()']) !!}
</div>

<div class="col-md-3">
    {!! Form::select('roster_id', $rostersList, null, ['id' => 'select_roster_id', 'class' => 'form-control', 'onchange' => 'this.form.submit()']) !!}
</div>
{!! Form::close() !!}