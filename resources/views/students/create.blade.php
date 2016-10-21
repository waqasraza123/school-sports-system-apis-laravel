@extends('layouts.master')

@section('jqueery')
    
<script type="text/javascript">

/*
function getRoster() {
	$.ajax({
	 data: {
	  roster_id: $("#roster_title").val(),
	
	 },
	 type: 'POST',
	 dataType: 'json',
	 url: '',
	 success: function(response) {
//	   var product_name = response.product_name;
//	   var product_manual_id = response.product_manual_id;
//	   var warehouse_name = response.warehouse_name;
	   
	   var product_id = $("#product_id").val();
	   var quantity = $("#quantity").val();
	   var cost = $("#cost").val();
	   var warehouse_id = $("#warehouse_id").val();
         
	   var content_1 = "<tr class='item-row'><td><div class='delete-wpr'>"+product_manual_id+"<input type='hidden' name='product_id[]' value='"+product_id+"'><a class='delme' href='javascript:;' title='Remove row'>X</a></div></td>";
	   var content_2 = "<td>"+product_name+"</td>";
	   var content_3 = "<td><input type='text' readonly='readonly' class='qty' name='qty[]' value='"+quantity+"'></td>";
	   var content_4 = "<td><input type='text' readonly='readonly' class='cost' name='cost[]' value='"+cost+"'></td>";
    //   var content_44 = "<td><input type='text' readonly='readonly' class='price' name='price[]' value='"+selling_price+"'></td>";
 //   var content_444 = "<td><input type='hidden' readonly='readonly' class='ttax' name='ttax[]' value='"+tax+"'></td>"; 
	   var content_5 = "<td>"+warehouse_name+"<input type='hidden' name='warehouse_id[]' value='"+warehouse_id+"'></td>";
	   var content_6 = 	"<td class='total'>"+cost*quantity+"</td></tr>";   
	   
	   content_4.innerHTML='<input id=cost value='+content_4+'>';
	   
	   $(".item-row:first").before(content_1+content_2+content_3+content_4+content_5+content_6);
	   
	   $("#product_id").select2("val", null);
	   $("#quantity").val('');
	   $("#cost").val(''); 
	   $("#warehouse_id").select2("val", null);
	   update_total();
	   porana_baqaya();
	   }
	});
}
	$(document).ready(function(e) {
    	$("#add_product").click(function() {
			getProduct();
		});    
	//delete Row.
	$('#items').on('click', '.delme', function() {
		   $(this).parents('.item-row').remove();
		   update_total();
		   porana_baqaya();
		});
    });
			
*/	
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
                {{ Form::label('roster_title', 'Roster:', ['class' => 'control-label']) }}
                {{ Form::select('roster_title', 
                        (['0' => 'Select a Roster'] + $rosters), 
                        null, 
                        ['class' => 'form-control', 'id' => 'roster_title']) 
                }}
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
                {{ Form::text('jersy', null, ['class' => 'fn form-control', 'required' => 'true']) }} 
            </div>
            <div class="col-md-6">
                {{ Form::label('position', 'Position:', ['class' => 'control-label']) }}
                {{ Form::text('position', null, ['class' => 'fn form-control', 'required' => 'true']) }} 
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