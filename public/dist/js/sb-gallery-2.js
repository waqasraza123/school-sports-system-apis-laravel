$(window).load(function(){

    $(".edit_gallery").click(function() {

        var $row = $(this).parent().closest("div");
        var $sports_id = $row.find(".sports_id").text();
        var $games_ids = $row.find(".games_ids").text();
        var $levels_ids = $row.find(".levels_ids").text();
        var $rosters_ids = $row.find(".rosters_ids").text();

        var parsed_sport_id = JSON.parse($sports_id);
        var parsed_game_id = JSON.parse($games_ids);
        var parsed_level_id = JSON.parse($levels_ids);
        var parsed_roster_id = JSON.parse($rosters_ids);

        $('#sport_modal_id').val(parsed_sport_id).change();
        $('#game_modal_id').val(parsed_game_id).change();
        $('#level_modal_id').val(parsed_level_id).change();
        $('#roster_modal_id').val(parsed_roster_id).change();
        document.getElementById('gallery_invisible_id').value=$(this).data('id') ;

    });

});//]]>
