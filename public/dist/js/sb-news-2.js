$(window).load(function(){
    //check if the modal for add/edit is open and if its open repopulate it
    if(document.getElementById('news_invisible_action') != null)
    {
        if(document.getElementById('news_invisible_action').value == 'add')
        {
            $('#photo').hide();
            $(".form_title").text("Add news");
            $(".submit_news_modal").val("Add news");
            $('#photo').attr('src',"")
        }
        else
        {
            $('#photo').show();
            $(".form_title").text("Edit news");
            $(".submit_game_modal").val("Update news");
        }
    }

    $("#add_news").click(function()
    {
        document.getElementById('title').value= '';
        var now = new Date();
        var todayUTC = new Date(Date.UTC(now.getFullYear(), now.getMonth(), now.getDate()));
        var current_time = todayUTC.toISOString().slice(0, 10).replace(/-/g, '-');
        document.getElementById('news_date').value = current_time;
        CKEDITOR.instances['content'].setData('');
        document.getElementById('photo').src = '';
        $('#sport_id').val($('.selected_sport_id').text()).change();
        $('#game_id').val('').change();
        $('#level_id').val('').change();
        $('#roster_id').val('').change();
        document.getElementById('news_invisible_id').value=$(this).data('id') ;
        document.getElementById('news_invisible_action').value="add" ;
        $('#photo').hide();
        $(".form_title").text("Add news");
        $(".submit_news_modal").val("Add news");
        $('#photo').attr('src',"")
    });

    $(".edit_news").click(function() {

        var $row = $(this).parent().parent().parent().parent().closest("tr");
        var $sports_id = $row.find(".sports_id").text();
        var $games_ids = $row.find(".games_ids").text();
        var $levels_ids = $row.find(".levels_ids").text();
        var $rosters_ids = $row.find(".rosters_ids").text();
        var parsed_sport_id = JSON.parse($sports_id);
        var parsed_game_id = JSON.parse($games_ids);
        var parsed_level_id = JSON.parse($levels_ids);
        var parsed_roster_id = JSON.parse($rosters_ids);
        $('#sport_id').val(parsed_sport_id).change();
        $('#game_id').val(parsed_game_id).change();
        $('#level_id').val(parsed_level_id).change();
        $('#roster_id').val(parsed_roster_id).change();

        var $title = $row.find(".title").text();
        var $news_date = $row.find(".news_date").text();
        var $content = $row.find(".content").text();
        var $photo = $row.find(".photo").text();

        document.getElementById('title').value= $title;
        document.getElementById('news_date').value = $news_date;
        CKEDITOR.instances['content'].setData($content);
        document.getElementById('photo').src = $photo;
        document.getElementById('news_invisible_id').value=$(this).data('id') ;
        document.getElementById('news_invisible_image').value=$photo ;
        document.getElementById('news_invisible_action').value="edit" ;
        $('#photo').show();
        $(".form_title").text("Edit news");
        $(".submit_news_modal").val("Update news");
    });

});//]]>


