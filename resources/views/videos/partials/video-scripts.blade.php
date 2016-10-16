<link href="{{asset('video/bootstrap-fileinput/css/fileinput.min.css')}}" media="all" rel="stylesheet" type="text/css" />
<!-- canvas-to-blob.min.js is only needed if you wish to resize images before upload.
     This must be loaded before fileinput.min.js -->
<script src="{{asset('video/bootstrap-fileinput/js/plugins/canvas-to-blob.min.js')}}" type="text/javascript"></script>
<!-- sortable.min.js is only needed if you wish to sort / rearrange files in initial preview.
     This must be loaded before fileinput.min.js -->
<script src="{{asset('video/bootstrap-fileinput/js/plugins/sortable.min.js')}}" type="text/javascript"></script>
<!-- purify.min.js is only needed if you wish to purify HTML content in your preview for HTML files.
     This must be loaded before fileinput.min.js -->
<script src="{{asset('video/bootstrap-fileinput/js/plugins/purify.min.js')}}" type="text/javascript"></script>
<!-- the main fileinput plugin file -->
<script src="{{asset('video/bootstrap-fileinput/js/fileinput.min.js')}}"></script>

<script>
    $("#video-file").fileinput();

    function getParameterByName(name, url) {
        if (!url) url = window.location.href;
        name = name.replace(/[\[\]]/g, "\\$&");
        var regex = new RegExp("[?&]" + name + "(=([^&#]*)|&|#|$)"),
                results = regex.exec(url);
        if (!results) return null;
        if (!results[2]) return '';
        return decodeURIComponent(results[2].replace(/\+/g, " "));
    }

    // with plugin options
    $("#video-file").fileinput({
        'showUpload':true,
        'previewFileType':'any',
        uploadAsync: true,
        'maxFileCount': 15
    });

</script>