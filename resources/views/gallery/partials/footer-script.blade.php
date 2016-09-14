<script src="/dist/js/sb-gallery-2.js"></script>
<script src="/js/dropzone.js"></script>
<script type="text/javascript">
    $('#student_id').select2();
    $('#student_modal_id').select2();

    submitForms = function(){
        document.getElementById("form1").submit();
        document.getElementById("form2").submit();
    }

    var scntDiv = $('#inputs');
    var i = $('#inputs p').size() + 1;
    $('#addInput').click(function() {

        $('<p><label for="title" class="control-label">Video url:</label><input type="text" class="fn form-control" id="url' + i +'" size="20" name="url' + i +'" value="" placeholder="Input Value" /></label> <a href="#" id="remInput" class="btn btn-danger" onclick="removeMe('+ i +')">Remove</a> ').appendTo('#inputs');

        i++;
        return false;
    });

    removeMe = function(id){
        if( i > 1 ) {
            $('#url'+id+'').parents('p').remove();
            i--;
        }
        return false;
    };

</script>
<script>

    jQuery(document).ready(function() {
        var uploadSizeMax = 8000000;
        var uploadSizeTotal = 0;

        Dropzone.options.myAwesomeDropzone = { // The camelized version of the ID of the form element

            // The configuration we've talked about above
            autoProcessQueue: false,
            previewsContainer: ".dropzone-previews",
            acceptedFiles: 'image/*',
            addRemoveLinks: true,
            uploadMultiple: true,
            url: '{{$album_id}}/image/upload',
            parallelUploads: 100,
            maxThumbnailFilesize: 10,
            maxFiles: 100,
            dictRemoveFile: 'Remove',
            dictFileTooBig: 'Image is bigger than 8MB',
            dictDefaultMessage: "Drop image files here",

            accept: function(file, done) {
                var isOk = true;

                if (!(file.type == "image/jpeg" || file.type == "image/png")) {

                    isOk = false;
                    alert("Error! We mostly accept JPG and PNG image files");
                }

                if (uploadSizeTotal + file.size > uploadSizeMax)
                {
                    isOk = false;
                    alert("Sorry, you have reached the max size allowed to upload (8MB)");

                    var _ref;
                    if ((_ref = file.previewElement) != null) {
                        _ref.parentNode.removeChild(file.previewElement);
                    }
                    return this._updateMaxFilesReachedClass();
                }

                if (isOk)
                {
                    //Add file size
                    uploadSizeTotal += file.size;

                    done();
                }
            },

            // The setting up of the dropzone
            init: function() {
                var myDropzone = this;

                // First change the button to actually tell Dropzone to process the queue.
                $("#submitUpload").click(function (e) {
                    e.preventDefault();
                    e.stopPropagation();
                    myDropzone.processQueue();
                });

                // Listen to the sendingmultiple event. In this case, it's the sendingmultiple event instead
                // of the sending event because uploadMultiple is set to true.
                this.on("sendingmultiple", function() {
                    // Gets triggered when the form is actually being sent.
                    // Hide the success button or the complete form.
                });
                this.on("successmultiple", function(files, response) {
                    // Gets triggered when the files have successfully been sent.
                    // Redirect user or notify of success.
                });
                this.on("errormultiple", function(files, response) {
                    // Gets triggered when there was an error sending the files.
                    // Maybe show form again, and notify user of error
                });
            }

        }

    });


</script>