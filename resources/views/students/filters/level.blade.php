@if($levels)
    @foreach($levels->rosters as $roster)
        @foreach($roster->students as $student)
            <tr>
                <td>{{$student->id}}</td>
                @if($student->photo)
                    <td><img src="{{asset('uploads/students/'.$student->photo)}}" height="50px" width="50px" alt="image"></td>
                @else
                    <td><img src="{{asset('uploads/def.png')}}" height="50px" width="50px" alt="image"></td>
                @endif
                <td>{{$student->name}}</td>
                <td>{{$student->height_feet.'\' '. $student->height_inches.'\'\''}}</td>
                <td>{{$student->academic_year}}</td>
                <td><a href="{{url('students/'. $student->id. '/edit')}}" class="btn btn-primary btn-sm">Edit</a></td>
                <td>{!! Form::open([    'method' => 'DELETE','url' => ['/students', $student->id]]) !!}{!! Form::submit('Delete', ['class' => 'btn btn-danger btn-sm']) !!}{!! Form::close() !!}</td>
            </tr>
        @endforeach
    @endforeach
@else
    <div class="alert alert-danger">
        No Students for this level.
    </div>
@endif