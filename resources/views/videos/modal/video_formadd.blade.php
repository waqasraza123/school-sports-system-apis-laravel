<div class="modal fade" id="videoModaladd" role="dialog">
    <div class="modal-dialog modal-md">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">

                <h4 class="modal-title form_title">Edit video tags</h4>
            </div>
            <div class="modal-body">
                <div class="row">

                    <div class="col-md-6">
                        <div class="form-group-sm">



                          <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
                          <script>
                          $(document).ready(function(){
                              $('#RootNode').click(function(){

                               var id = 'dQw4w9WgXcQ';
                          var url = 'https://www.youtube.com/watch?v=' + id;
                          var jobName = document.getElementById("setvalue").value;
                          $.getJSON('https://noembed.com/embed',
                              {format: 'json', url: jobName}, function (data) {
                          if (typeof data.title === "undefined") {
                              alert('Sorry we can not locate your video \nPlease use a url such as: \nhttps://www.youtube.com/watch?v=MYbQiuSfvmw');
                          }
                          else {
                           document.getElementById("txtsetvalue").value = data.title;
                          document.getElementById("imgsetvalue").src = data.thumbnail_url;
                          }
                          });
                              });
                          });
                          </script>



                          <p>Enter Youtube video in following format: https://www.youtube.com/watch?v=MYbQiuSfvmw</p>
                              <input type="text" id="setvalue" />

                          <button id='RootNode'>Verify Video</button>

                          <br>

                          <p>Title</p>
                           <input type="text" id="txtsetvalue" value="Enter value above" />
                          <p>Preview Image</p>
                          <img id="imgsetvalue" src="http://placehold.it/480x360">










                            <div class="col-s-3">

                                    {!! Form::open(array('url'=>'videos/', 'method'=>'POST', 'files'=>true)) !!}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-group select_sport">
                    {!! Form::label('title', 'Player:', ['class' => 'control-label']) !!}
                    {{ Form::select('student_modal_id[]', $students, null, ['class' => 'form-control','id' => 'student_modal_id', 'style' => 'width: 100%', 'multiple']) }}
                    {!! Form::label('title', 'Roster:', ['class' => 'control-label']) !!}
                    {{ Form::select('roster_modal_id[]', $rosters, null, ['class' => 'form-control','id' => 'roster_modal_id', 'style' => 'width: 100%', 'multiple']) }}

                    {{ Form::hidden('video_invisible_id', null, ['id' => 'video_invisible_id']) }}
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group-sm">
                            <div class="col-s-3">
                                <br>

                                {!! Form::submit('Update photo tags', ['class' => 'submit_news_modal btn btn-primary']) !!}
                                &nbsp;
                                <button style="vertical-align: center;" type="button" class="btn btn-default"
                                        data-dismiss="modal">Close
                                </button>
                            </div>
                        </div>
                    </div>
                </div>


                {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>
