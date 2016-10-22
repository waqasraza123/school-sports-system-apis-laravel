@extends('layouts.master')

@section('jqueery')

<script src="{{ URL::asset('js/jquery.js') }}"></script>
	<script type="text/javascript">
	
		    
     /*       function get_data()
            {
                
                $.ajax({
                        
                        url : "{{ action('Ajax@show') }}",
                        type: "POST",
                        async: false,
                        data: {
    
                        },
                        success:function(re)
                        {
                            $('.detail').html(re);
                        }
                    });
                
            } */
        
            $(function(){
                
                $.ajaxSetup({
                   headers: {
                       'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                   } 
                });
                
                $('.click').click(function(){
                    var roster = $('#roster').val();
                //    var jersy = $('#jersy').val();
                //    var position = $('#position').val();
        
                    $.ajax({
                        
                        url : "{{ action('Ajax@save') }}",
                        type: "POST",
                        async: false,
                        data: {
    
                            'roster' : roster
                            
                        },
                        success:function(re)
                        {
                                  alert(re);
                        /*    var roster_name = re;
                            
                             var content_1 = "<tr class='item-row'><td><input type='hidden' name='roster_id[]' value=''><a class='delme' href='javascript:;' title='Remove row'>X</a></td>";
	                         var content_2 = "<td></td>";
	                         var content_3 = "<td><input type='text' readonly='readonly' name='rrr[]' value='"+roster_name+"'></td>";
                            var content_4 = "</tr>";
                            
                            $(".item-row:first").before(content_1+content_2+content_3+content_4);
                        */
                        }
                    });
                });
            });
             
        
        
        $('#items').on('click', '.delme', function() {
		    
                $(this).parents('.item-row').remove();
		   
		    }); 
        
	
	</script> 

@endsection

@section('content')
    <div class="container-fluid">
        <h2 style="text-align: center">Add Student</h2>

        @include('partials.error-messages.success')
        @include('partials.error-messages.error')

        {!! Form::open(array('route' => 'students.store')) !!}
        
        <div class="row">
            <div class="col-md-6">
                {{ Form::label('title', 'Name:', ['class' => 'control-label']) }}
                {{ Form::text('title', null, ['class' => 'fn form-control', 'required' => 'true']) }}
            </div>
            <div class="col-md-6">
                {{ Form::label('academic_year', 'Academic Year:', ['class' => 'control-label']) }}
                {{ Form::select('academic_year',
                        ['Freshman' => 'Freshman', 'Sohphomore' => 'Sohphomore',
                         'Junior' => 'Junior', 'Senior' => 'Senior'], 'Please Select'
                        ,['class' => 'form-control']) }}
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="row">
                    <div class="col-md-6">
                        {{ Form::label('roster', 'Roster:', ['class' => 'control-label']) }}
                        {{ Form::select('roster', 
                                (['0' => 'Select a Roster'] + $rosters), 
                                null, 
                                ['class' => 'form-control', 'id' => 'roster']) 
                        }}
                    </div>
                    <div class="col-md-6">
                        <label>&nbsp;</label><br>
                        <button style="" type="button" id="add_roster" class="btn btn-default click">
                        Add Roster</button>
                    </div>
                        
                </div>    
                
            </div>
            <div class="col-md-6">
                {{ Form::label('weight', 'Weight(pounds):', ['class' => 'control-label']) }}
                {{ Form::selectRange('weight', 80, 220, 80, ['class' => 'form-control']) }}
            </div>
        </div>
         
        <div class="row newfield">
            <div class="col-md-6">
                {{ Form::label('photo', 'Photo:', ['class' => 'control-label']) }}
                {{ Form::file('photo', ['class' => 'fn form-control']) }}
            </div>
        </div>
        <div class="row newfield">
            <div class="col-md-6">
                {{ Form::label('jersy', 'Jersy:', ['class' => 'control-label']) }}
                {{ Form::text('jersy', null, ['class' => 'fn form-control', 'required' => 'true', 'id' => 'jersy']) }} 
            </div>
            <div class="col-md-6">
                {{ Form::label('position', 'Position:', ['class' => 'control-label']) }}
                {{ Form::text('position', null, ['class' => 'fn form-control', 'required' => 'true', 'id' => 'position']) }} 
            </div>

        </div>

        <div class="row">
            <div class="col-md-6">
                {{ Form::label('number', 'Phone:', ['class' => 'control-label']) }}
                {{ Form::tel('number', null, ['class' => 'form-control']) }}
            </div>
            <div class="col-md-6">
                <div class="row">
                    <div class="col-md-6">
                        {{ Form::label('height_feet', 'Height in Feet:', ['class' => 'control-label']) }}
                        {{ Form::selectRange('height_feet', 4, 7, 4, ['class' => 'form-control']) }}
                    </div>
                    <div class="col-md-6">
                        {{ Form::label('height_inches', 'Height in Inches:', ['class' => 'control-label']) }}
                        {{ Form::selectRange('height_inches', 0, 12, 0, ['class' => 'form-control']) }}
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
            </div>
            <div class="col-md-6">

            </div>
        </div>
        
         <script type="text/javascript">
             
        </script>    
        
        <div class="row">
            <div class="col-md-6">
                {{ Form::label('pro_free', 'Pro/Free:', ['class' => 'control-label']) }}
                {{ Form::select('pro_free', ['' => 'Please Select', '0' => 'Free', '1' => 'Pro'],'please select',
                 ['class' => 'fn form-control', 'id'=>'pro_free_', 'onchange' => 'return pro()', 'required' => true]) }}
            </div>
            <div class="col-md-6">

            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                {{ Form::label('pro_head_photo', 'Pro Head Photo:', ['class' => 'control-label hide-pro']) }}
                {{ Form::file('pro_head_photo', ['class' => 'fn form-control hide-pro']) }}
            </div>
            <div class="col-md-6">
                {{ Form::label('pro_cover_photo', 'Pro Cover Photo:', ['class' => 'control-label hide-pro']) }}
                {{ Form::file('pro_cover_photo', ['class' => 'fn form-control hide-pro']) }}
            </div>
        </div>
        
        <div class="row">
            <div class="col-md-6">
                <table id="items" class="table table-condensed table-hover table-bordered">
                    <thead>
                    <tr>
                        <th></th>
                        <th>#</th>
                        <th>Roster</th>
                    </tr>
                    </thead>
                    <tbody class='item-row'>
                    
                    </tbody>    
                </table>
            </div>
        </div>
        
        <div class="row" style="margin: 20px 20px 20px 0px">
            <div class="col-md-12">
                <b>{{$school->name}} Custom Fields: </b>
                <button style="" type="button" id="add-field" class="btn btn-default">
                    Add Fields?</button>
            </div>
        </div>
        <div class="row" id="dynamic-fields-row">
            {{--will append the data on button click--}}
        </div>

    </div>{{--container fluid closed--}}
    <div class="container-fluid">
        @if($customFields)
            @foreach($customFields as $customField)

                    <div class="row" id="" style="">
                        <div class="col-md-6" id="">
                            <div class="row" style="margin-top: 10px">
                                <div class="col-md-6">
                                    <input value="{{$customField->custom_label}}" readonly type="text" name="custom-field-name[]" class="form-control col-md-3">
                                </div>
                                <div class="col-md-6">
                                    <input type="text" name="custom-field-value[]" class="form-control col-md-3" placeholder="Value">
                                </div>
                            </div>
                        </div>
                    </div>
            @endforeach
        @endif
        
        <div class="row" style="margin: 0 auto; width: 300px; padding: 10px">
            <div class="" style="margin-top: 20px; margin-left: 10px !important; float: left;">
                {{ Form::submit('Create Student', ['class' => 'btn btn-primary']) }}
                
            </div>
        </div>

        {!! Form::close() !!}
    </div>
@endsection
@section('footer')
    @include('partials.error-messages.footer-script')
    @include('students.partials.footer')
    
@endsection