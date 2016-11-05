$(window).load(function() {
    jQuery(function () {
        var picture = $('#sample_picture');


        $('#image-preview').hide();
        document.getElementById("photo").onchange = function () {
            var reader = new FileReader();

            reader.onload = function (e) {
                if (e.total > 250000) {
                    $('#imageerror').text('Image too large');
                    $jimage = $("#photo");
                    $jimage.val("");
                    $jimage.wrap('<form>').closest('form').get(0).reset();
                    $jimage.unwrap();
                    $('#sample_picture').removeAttr('src');
                    return;
                }
                $('#imageerror').text('');
                document.getElementById("sample_picture").src = e.target.result;
            };
            reader.readAsDataURL(this.files[0]);


            // Make sure the image is completely loaded before calling the plugin
            picture.one('load', function () {
                // Remove any existing instance
                if (picture.guillotine('instance')) picture.guillotine('remove');
                // Initialize plugin (with custom event)
                picture.guillotine({eventOnChange: 'guillotinechange'});
                picture.guillotine({width: 400, height: 300});
                // Display inital data
                var data = picture.guillotine('getData');
                for (var key in data) {
                    $('#' + key).html(data[key]);
                }

                // Bind button actions
//              $('#rotate_left').click(function(){ picture.guillotine('rotateLeft'); $('#image_scale').val(JSON.stringify(data)); });
//              $('#rotate_right').click(function(){ picture.guillotine('rotateRight'); $('#image_scale').val(JSON.stringify(data)); });
                $('#fit').click(function () {
                    picture.guillotine('fit');
                    $('#image_scale').val(JSON.stringify(data));
                });
                $('#zoom_in').click(function () {
                    picture.guillotine('zoomIn');
                    $('#image_scale').val(JSON.stringify(data));
                });
                $('#zoom_out').click(function () {
                    picture.guillotine('zoomOut');
                    $('#image_scale').val(JSON.stringify(data));
                });
                $('#image_scale').val(JSON.stringify(data));
                // Update data on change
                picture.on('guillotinechange', function (ev, data, action) {
                    data.scale = parseFloat(data.scale.toFixed(4));
                    $('#image_scale').val(JSON.stringify(data));
                    for (var k in data) {
                        $('#' + k).html(data[k]);
                    }
                });
            });

            if($('#photo-preview').length > 0)
            {
                $('#photo-preview').hide();
            }

            $('#image-preview').show();
        };

        // Make sure the 'load' event is triggered at least once (for cached images)
        if (picture.prop('complete')) picture.trigger('load')
    });
});