<script>
    $('#add_new_sport_level_btn').click(function () {

        var level = ($('#add_new_sport_level'));
        if(($.trim(level.val()) == '')){
            level.attr('placeholder', 'required');
            level.css('border', '1px solid red');
        }
        else{
            if($("#level_id option").length > 0){
                var number = $('#level_id option:last-child').val();
            }

            var temp = 0;
            $('#level_id').append($('<option>', {
                value: level.val(),
                text: level.val()
            }));

        }
    });
</script>