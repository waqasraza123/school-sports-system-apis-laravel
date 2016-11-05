<div class="row">
    <div class="col-md-6" id="image-preview" style="margin-top: 30px;">
        {{ Form::hidden('image_scale', null, ['id' => 'image_scale']) }}
        <div class='frame col-md-12' style="width: 350px; height: 350px">
            <img id='sample_picture' src='img/arrow.png'>
        </div>

        <div id='controls' class="col-md-12" style="margin-top: -80px;">
            {{--<button id='rotate_left'  type='button' title='Rotate left'> &lt; </button>--}}
            <button id='zoom_out'     type='button' title='Zoom out'> - </button>
            <button id='fit'          type='button' title='Fit image'> [ ]  </button>
            <button id='zoom_in'      type='button' title='Zoom in'> + </button>
            {{--<button id='rotate_right' type='button' title='Rotate right'> &gt; </button>--}}
        </div>
    </div>
</div>