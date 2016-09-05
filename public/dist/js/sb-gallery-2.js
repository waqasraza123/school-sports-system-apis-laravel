$(window).load(function(){

    $("#video_box").hide();
    $("#photo_box").show();

    $("#upload_switch").click(function() {
        if($("#upload_switch").text() == "Add video url")
        {
            $("#upload_switch").text("Add image");
            $("#video_box").show();
            $("#photo_box").hide();
        }
        else
        {
            $("#upload_switch").text("Add video url");
            $("#video_box").hide();
            $("#photo_box").show();
        }
    });

    $(".edit_gallery").click(function() {

        var $row = $(this).parent().closest("div");
        var $rosters_ids = $row.find(".rosters_ids").text();
        var parsed_roster_id = JSON.parse($rosters_ids);

        $('#roster_modal_id').val(parsed_roster_id).change();
        document.getElementById('gallery_invisible_id').value=$(this).data('id') ;

    });

    $(".edit_video").click(function() {

        var $row = $(this).closest("div");
        var $rosters_ids = $row.find(".video_rosters_ids").text();
        console.log($row);
        var parsed_roster_id = JSON.parse($rosters_ids);

        $('#roster_modal_id').val(parsed_roster_id).change();
        document.getElementById('gallery_invisible_id').value=$(this).data('id') ;

    });

});//]]>
