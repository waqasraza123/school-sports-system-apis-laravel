$(window).load(function(){

    $(".edit_album").click(function() {

        var $row = $(this).parent().parent().parent().closest("div");
        var $sports_id = $row.find(".sports_id").text();
        var $games_ids = $row.find(".games_ids").text();
        var $levels_ids = $row.find(".levels_ids").text();
        var $schools_ids = $row.find(".schools_ids").text();
        var $years_ids = $row.find(".years_ids").text();

        var parsed_sport_id = JSON.parse($sports_id);
        var parsed_game_id = JSON.parse($games_ids);
        var parsed_level_id = JSON.parse($levels_ids);
        var parsed_school_id = JSON.parse($schools_ids);
        var parsed_year_id = JSON.parse($years_ids);

        $('#sport_modal_id').val(parsed_sport_id).change();
        $('#game_modal_id').val(parsed_game_id).change();
        $('#level_modal_id').val(parsed_level_id).change();
        $('#school_modal_id').val(parsed_school_id).change();
        $('#year_modal_id').val(parsed_year_id).change();
        document.getElementById('album_invisible_id').value=$(this).data('id') ;

    });

});//]]>
