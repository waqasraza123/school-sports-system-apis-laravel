$(window).load(function(){
    //check if the modal for add/edit is open and if its open repopulate it
    if(document.getElementById('game_invisible_action').value != "")
    {
        if(document.getElementById('game_invisible_action').value == 'edit')
        {
            $(".form_title").text("Edit game");
            $(".submit_game_modal").val("Update game");
            $(".select_sport").css('display','none');
            var d1 = new Date();
            var d2 = new Date(document.getElementById('hidden_game_date').value.replace(' ', 'T'));
            if(d1>d2)
            {
                $('.past_game').css('display','block');
                $('.future_game').css('display','none');
            }
            else
            {
                $('.past_game').css('display','none');
                $('.future_game').css('display','block');
            }
        }
        else
        {
            $(".select_sport").css('display','block');
            $('.past_game').css('display','none');
            $('.future_game').css('display','block');
            $('#photo').css('display','none');
            $(".form_title").text("Add game");
            $(".submit_game_modal").val("Add game");
        }
    }

    $("#add_new_game").click(function() {
        $(".select_sport").css('display','block');
        $('#game_sport_id').val($(".selected_sport_id").text()).change();
        $('#game_level_id').val($(".selected_level_id").text()).change();
        $('.past_game').css('display','none');
        $('.future_game').css('display','block');
        document.getElementById('game_invisible_id').value="";
        $('#opponent').val('').change();
        document.getElementById('game_date').value="";
        $('#game_location_id').val('').change();
        $('#home_or_away').val('').change();
        document.getElementById('game_preview').value="";
        document.getElementById('game_recap').value="" ;
        document.getElementById('video').value="" ;
        document.getElementById('our_score').value="" ;
        document.getElementById('opponents_score').value="" ;
        document.getElementById('game_invisible_image').value="" ;
        document.getElementById('game_invisible_action').value="add" ;
        $('#photo').css('display','none');
        $(".form_title").text("Add game");
        $(".submit_game_modal").val("Add game");
        $('#photo').attr('src',"");
    });

    $(".edit_new_game").click(function() {
        $(".select_sport").css('display','none');
        $(".submit_game_modal").val("Update game");
        var $row = $(this).closest("tr");    // Find the row
        var $opponent = $row.find(".opponents_id").text();
        var $game_date = $row.find(".game_date").text();
        var $home_or_away = $row.find(".home_or_away").text();
        var $game_preview = $row.find(".game_preview").text();
        var $game_recap = $row.find(".game_recap").text();
        var $video = $row.find(".video").text();
        var $our_score = $row.find(".our_score").text();
        var $opponents_score = $row.find(".opponents_score").text();
        var $src=$row.find(".photo").text(); //Find the text $('.event').children('img').attr('src'

        var d1 = new Date();
        var d2 = new Date($row.find(".game_date").text().replace(' ', 'T'));
        //check for parst or future games
        if(d1>d2)
        {
            $('.past_game').css('display','block');
            $('.future_game').css('display','none');
        }
        else
        {
            $('.past_game').css('display','none');
            $('.future_game').css('display','block');
        }

        $('#photo').attr('src',$src);
        $('#photo').css('display','block');
        document.getElementById('game_invisible_id').value=$(this).data('id');
        $('#opponent').val($opponent).change();
        document.getElementById('game_date').value= $game_date;
        $('#home_or_away').val($home_or_away).change();
        document.getElementById('game_preview').value=$game_preview;
        document.getElementById('game_recap').value=$game_recap;
        document.getElementById('video').value=$video;
        document.getElementById('our_score').value=$our_score;
        document.getElementById('opponents_score').value=$opponents_score;
        document.getElementById('game_invisible_image').value=$src ;
        document.getElementById('game_invisible_action').value="edit";
        document.getElementById('hidden_game_date').value=$game_date;
        $(".form_title").text("Edit game");
    });


});//]]>


